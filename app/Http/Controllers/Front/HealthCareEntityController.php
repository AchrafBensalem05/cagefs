<?php

namespace App\Http\Controllers\Front;

use App\DataTables\Front\Healthcare\AppointmentDataTable;
use App\DataTables\Front\Healthcare\DemandesDataTable;
use App\DataTables\Front\Healthcare\RegistrationDataTable;
use App\DataTables\Front\Healthcare\VoucherDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HealthCareTrait;
use App\Http\Requests\Front\OwnHealthcareRequest;
use App\Mail\NotifyPatientAppointment;
use App\Mail\NotifyPatientTimeSession;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment;
use App\Models\Article;
use App\Models\Configuration;
use App\Models\HealthcareEntity;
use App\Models\Patient;
use App\Models\Pricing;
use App\Models\Service;
use App\Models\Voucher;
use App\Models\Wilaya;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTimeZone;


class HealthCareEntityController extends Controller
{
    use HealthCareTrait;

    protected  $configuration;
    public function __construct()
    {
        $this->configuration  = Configuration::find(1);
    }

    public function dashboard()
    {
        $profile = Auth::guard('healthcare')->user();
        if($profile->type != 4)
        return view('front.healthcares.pages.dashboard' ,
            [
                'profile'       => $profile,
                'config'        => $this->configuration,
                'registrations' => $profile->registrations_for_the_opened_day,
                'title'         => 'Passing patients for today'
            ]);
        else
            return  redirect()->route('healthcare.get_my_medication_demandes_page');
    }

    public function profile()
    {
        $profile = Auth::guard('healthcare')->user();
        $profile->load(['services' , 'daira']);
        return view('front.healthcares.pages.profile', [
            'title'         => 'My Profile',
            'config'        => $this->configuration,
            'services'      => Service::all(),
            'wilayas'       => Wilaya::all(),
            'profile'       => $profile,
            'patients'      => Patient::all(),
            'healthcares'   => HealthcareEntity::with('daira')->where('type' , $profile->type)->where('id' , '<>' , $profile->id)->get(),
        ]);
    }

    public  function profile_post(OwnHealthcareRequest $request)
    {
        $healthcareEntity = Auth::guard('healthcare')->user();
        $data = $request->except(["_method" , "_token" , 'password' , 'blocked' , 'tags' , 'languages' ,'experience' , 'diplomas' , 'equipment' , 'customers_result' , 'expired_at']);
        $data = array_merge($data ,
             [
                 "tags"         => json_encode($request->get('tags') , JSON_UNESCAPED_UNICODE),
                 "languages"    => json_encode($request->get('languages') , JSON_UNESCAPED_UNICODE),
                 "experience"   => json_encode($request->get('experience'), JSON_UNESCAPED_UNICODE),
                 "diplomas"     => json_encode($request->get('diplomas') , JSON_UNESCAPED_UNICODE),
                 "equipment"    => json_encode($request->get('equipment') , JSON_UNESCAPED_UNICODE),
                 "healthcares"  => json_encode($request->get('healthcares') , JSON_UNESCAPED_UNICODE)
             ]);
        if($healthcareEntity->type == 3 and $request->get('customers_result'))
        {
            $customers = [];
            foreach($request->get('customers_result') as $item)
            {
               if(is_numeric($item))
               {
                  $patient = Patient::find($item);
                  array_push($customers , $patient->name);
               }
               else
                   array_push($customers , $item);
            }
            $data = array_merge($data , ['customers_result' => json_encode($customers)]);
        }


        if($request->file('avatar'))
        {
            $healthcareEntity->clearMediaCollection('avatar');
            $healthcareEntity->addMedia($request->file('avatar'))->toMediaCollection('avatar');
        }
        if($request->file('thumbnail'))
        {
            $healthcareEntity->clearMediaCollection('thumbnail');
            $healthcareEntity->addMedia($request->file('thumbnail'))->toMediaCollection('thumbnail');
        }

        if($request->file('background'))
        {
            $healthcareEntity->clearMediaCollection('background');
            if($request->file('background'))
                foreach($request->file('background') as $file)
                {
                    $healthcareEntity->addMedia($file)->toMediaCollection('background');
                }
        }

        if ($request->get('password')[0] != null and ($request->get('password')[0] == $request->get('password')[1]))
            array_push($data, ['password' => bcrypt($request->get('password')[0])]);
        elseif($request->get('password')[0] != null)
        {
            flash('Passwords does not match' , ['alert alert-warning']);
            return redirect()->back();
        }
        try {
            $healthcareEntity->update($data);
            flash("Entity " . $healthcareEntity->name ." has been successfully modified" , ['alert alert-success alert-dismissible']);
        }catch (\PDOException $exception)
        {
            flash("Problem in Modification , check your fields" , ['alert alert-danger alert-dismissible']);
        }
        return redirect()->back();
    }


    /*PAGES RETURNS*/
    public  function get_my_opening_hours_page()
    {
        $profile = Auth::guard('healthcare')->user();
        return view('front.healthcares.pages.my_opening_hours' ,
            [
                "profile"  => $profile,
                'config'   => $this->configuration,
                "title"    => "Checking My Opening Hours",
                "schedule" =>  json_decode($profile->opening_hours , true)
            ]
        );
    }

    public  function get_voucher_page(VoucherDataTable $dataTable)
    {
        $profile = Auth::guard('healthcare')->user();
        return $dataTable->render('front.healthcares.pages.my_vouchers_page' ,
            [
                "profile"  => $profile,
                'config'   => $this->configuration,
                "title"    => "My Vouchers "
            ]
        );
    }

    public function add_voucher_page()
    {
        $profile = Auth::guard('healthcare')->user();
        return view('front.healthcares.pages.add_voucher' , [
            'profile'       => $profile,
            'config'        => $this->configuration,
            'pricings'      => Pricing::all(),
            'title'         => 'Add new Voucher'
        ]);
    }

    public function add_voucher_post(Request $request)
    {
        $profile = Auth::guard('healthcare')->user();
        $data = $request->except(['_token']);
        if($profile)
        {
            $voucher = Voucher::create(
                [
                    "status"                => "pending",
                    'title'                 => $data['title'],
                    "healthcare_id"         => $profile->id
                ]);
            if($request->file('file'))
            {
                $voucher->addMedia($request->file('file'))->toMediaCollection('file');
            }
        }
        flash("Voucher successfully Added" , ['alert alert-success alert-dismissible w-100']);
        return redirect()->back();
    }

    public function get_my_calendar_page()
    {
        $profile = Auth::guard('healthcare')->user();

        return view("front.healthcares.pages.my_calendar" ,
            [
                'profile'           => $profile,
                'config'            => $this->configuration,
                'title'             => "Checking my Calendar",
                'appoints'          => $profile->appointments,
                'registrations'     => $profile->registrations
            ]);
    }

    public function get_my_chat_page(Request $request , $current = null)
    {
        $profile = Auth::guard('healthcare')->user();
        if($current)
            $current = Patient::find($current);
        return view("front.healthcares.pages.my_chat" ,
            [
                'profile'           => $profile,
                'config'            => $this->configuration,
                'title'             => "Chat Page",
                'contacts'          => $profile->chat_patients(),
                'current'           => $current,
                'messages'          => $current ? $current->chat_with_healthcare($profile->id) : null
            ]);
    }

    public function get_my_registrations_page(RegistrationDataTable $registrationDataTable)
    {
        $profile = Auth::guard('healthcare')->user();
        return view('front.healthcares.pages.my_registrations' ,
            [
                "profile"                   => $profile,
                'config'                    => $this->configuration,
                "registration_datatable"    => $registrationDataTable->html(),
                "title"                     => "My Patients Registrations",

            ]
        );
    }

    public function get_my_registrations_data(RegistrationDataTable $registrationDataTable)
    {
        return $registrationDataTable->render("front.healthcares.pages.my_registrations" );
    }

    public function get_my_appointments_page(AppointmentDataTable $appointmentDataTable)
    {
        $profile = Auth::guard('healthcare')->user();
        return view('front.healthcares.pages.my_appointments' ,
            [
                "profile"                   => $profile,
                'config'                    => $this->configuration,
                "title"                     => "My Patients Appointments",
                "appointment_datatable"     => $appointmentDataTable->html(),
            ]
        );
    }

    public function get_my_appointment_data(AppointmentDataTable $appointmentDataTable)
    {
        return $appointmentDataTable->render("front.healthcares.pages.my_appointments");
    }

    public function get_my_medication_demandes_page(DemandesDataTable $demandesDataTable)
    {
        $profile = Auth::guard('healthcare')->user();
        return view('front.healthcares.pages.my_medication_demandes' ,
            [
                "profile"                   => $profile,
                'config'                    => $this->configuration,
                "title"                     => "My Medication Demandes",
                "demandes_datatable"        => $demandesDataTable->html(),
            ]
        );
    }

    public function get_medication_demands_data(DemandesDataTable $demandesDataTable)
    {
        return $demandesDataTable->render("front.healthcares.pages.my_medication_demandes");
    }

    public function add_registration()
    {
        $profile = Auth::guard('healthcare')->user();
        return view('front.healthcares.pages.add_registration' , [
            'profile'       => $profile,
            'config'        => $this->configuration,
            'services'      => $profile->services,
            'registrations' => $profile->registrations_for_the_opened_day,
            'title'         => 'Add new Registration'
        ]);
    }

    public function delete_registration(Appointment $appointment)
    {
        $profile = Auth::guard('healthcare')->user();
        if ($appointment->healthcare_entity_id == $profile->id)
        {
            $appointment->delete();
            flash("registration  has been deleted successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->back();
        }else return redirect()->back();
    }

    public function add_registration_post(Request $request)
    {
        $profile = Auth::guard('healthcare')->user();

        $data = $request->except(['_token']);
        if($profile)
        {
            $registration = Appointment::create(
                [
                    'type'                  => "registration",
                    "status"                => "pending",
                    "patient_id"            => null ,
                    'name'                  => $data['name'],
                    "phone"                 => $data['phone'],
                    "added_by"              => $profile->id,
                    "service_id"            => $data['service_id'],
                    "started_at"            => Carbon::parse($profile->opening_hours_obj->nextOpen(new  \DateTime($profile->open_registration_for_day , new DateTimeZone('Africa/Algiers'))))->addMinutes($profile->average_patient_time * ($profile->registrations_for_the_opened_day ? $profile->registrations_for_the_opened_day->count() + 1 : 1   ))->toDateTimeString(),
                    "healthcare_entity_id"  => $profile->id
                ]);
        }
        flash("Registration successfully Added" , ['alert alert-success alert-dismissible w-100']);
        return redirect()->back();
    }

    public function toggle_status()
    {
        $profile = Auth::guard('healthcare')->user();
        if($profile->closed_in_date)
            $profile->closed_in_date = null;
        else
            $profile->closed_in_date  = Carbon::now()->toDateString();
        $profile->save();
        flash("Status  has been successfully changed" , ['alert alert-success alert-dismissible']);
        return redirect()->back();
    }

    public function validate_appointment(Appointment $appointment)
    {
        $profile = Auth::guard('healthcare')->user();
        if ($appointment->healthcare_entity_id == $profile->id)
        {
            $appointment->status ="pending";
            $appointment->save();
            try
            {
                if ($appointment->patient)
                    Mail::to($appointment->patient->email)->send(new NotifyPatientAppointment(['appointment' => $appointment , 'patient' => $appointment->patient]));
            }catch (\Exception)
            {

            }
            flash("Status  has been successfully changed" , ['alert alert-success alert-dismissible']);
            return redirect()->back();
        }else return redirect()->back();
    }

    /* JSON OUTPUT */
    public function pass_registration(Request $request)
    {
        $entity = Auth::guard('healthcare')->user();
        if($request->get('time') or $request->get('id'))
        {
            $timeArray = explode(":", $request->get('time'));
            $registration = Appointment::find($request->get('id'));
            if ($registration)
            {
                $registration->status = 'done';
                $registration->save();
                $next = $entity->registrations_for_the_opened_day->where('status' , 'pending')->where("id"  ,'<>' ,$registration->id)->first();
                if ($next)
                {
                    $next->current = 'yes';
                    $next->save();
                }
                 foreach ($entity->registrations_for_the_opened_day as $item)
                 {
                     if ($item->id != optional($next)->id)
                     {
                         $item->current = null;
                         $item->save();
                     }
                 }
                //$entity->average_patient_time =  (( $timeArray[0] * 60 + $timeArray[1]) + $entity->average_patient_time) / 2 ;
                $entity->save();
                return true;
            }
        }else return false;
    }

    public function bypass_registration(Request $request)
    {
        $entity = Auth::guard('healthcare')->user();
        $current = $entity->get_current_registration_for_day;
        if ($current)
        {
            $current->current = null;
            $last    = $entity->registrations_for_the_opened_day->last();
            $current->started_at = Carbon::parse($last->started_at)->addMinutes(intval($entity->average_patient_time))->toDateTimeString();
            $current->save();

            try
            {
                if($current->patient)
                    Mail::to($current->patient->email)->send(new NotifyPatientAppointment(
                        "Votre Rendez vous de la visite résérvée chez le compte " .
                        "<strong>" . $entity->fname . $entity->lname . "</strong>".
                        "sous le nom de ".
                        "<strong>" . $current->name . "</strong>".
                        " A été <strong>Reporté</strong>  "
                    ));
            }catch (\Exception $exception)
            {}

            $next = $entity->registrations_for_the_opened_day->where('status' , 'pending')->where("id"  ,'<>' ,$current->id)->first();
            foreach ($entity->registrations_for_the_opened_day->where('status' , 'pending') as $item)
            {
                if($item->id != $current->id)
                {
                    $item->started_at = Carbon::parse($item->started_at)->subMinutes(intval($entity->average_patient_time))->toDateTimeString();
                    $item->save();
                }
                try
                {
                    if ($item->patient)
                        Mail::to($item->patient->email)->send(new NotifyPatientTimeSession(['healthcare' => $entity->fname . $entity->lname , 'patient' => $item->name , 'started_at' => $item->started_at]));
                }catch (\Exception $exception)
                {}
            }
            if($next)
            {
                $next->current = 'yes';
                $next->save();
            }
            return true;
        }else return false;

    }


    public function delay_registration(Request $request)
    {
        $entity = Auth::guard('healthcare')->user();
        $current = $entity->get_current_registration_for_day;
        if ($current)
        {
            $current->current = null;
            $next = $entity->registrations_for_the_opened_day->where('status' , 'pending')->where("id"  ,'<>' ,$current->id)->first();

            $current->started_at = Carbon::parse($next->started_at)->addMinutes(intval($entity->average_patient_time))->toDateTimeString();
            $current->save();
            try
            {
                if($current->patient)
                    Mail::to($current->patient->email)->send(new NotifyPatientAppointment(
                        "Votre Rendez vous de la visite résérvée chez le compte " .
                        "<strong>" . $entity->fname . $entity->lname . "</strong>".
                        "sous le nom de ".
                        "<strong>" . $current->name . "</strong>".
                        " A été <strong>Reporté  vers ". $entity->started_at ."</strong>  "
                    ));
            }catch (\Exception $exception)
            {}

            foreach ($entity->registrations_for_the_opened_day->where('status' , 'pending') as $item)
            {
                if($item->id != $current->id)
                {
                    $item->started_at = Carbon::parse($item->started_at)->subMinutes(intval($entity->average_patient_time))->toDateTimeString();
                    $item->save();
                }
                try
                {
                    if ($item->patient)
                        Mail::to($item->patient->email)->send(new NotifyPatientTimeSession(['healthcare' => $entity->fname . $entity->lname , 'patient' => $item->name , 'started_at' => $item->started_at]));
                }catch (\Exception $exception)
                {}
            }
            if($next)
            {
                $next->current = 'yes';
                $next->save();
            }
            return true;
        }else return false;

    }


    public function cancel_registration(Request $request)
    {
        $entity = Auth::guard('healthcare')->user();
        $current = $entity->get_current_registration_for_day;
        if ($current)
        {
            $current->status  = "canceled";
            $current->current = null;
            $current->save();
            try
            {
                if ($current->patient)
                    Mail::to($current->patient->email)->send(new NotifyPatientAppointment(
                        "Votre Rendez vous de la visite résérvée chez le compte " .
                        "<strong>" . $entity->fname . $entity->lname . "</strong>".
                        "sous le nom de ".
                        "<strong>" . $current->name . "</strong>".
                            " A été <strong>Annulé</strong>  "
                        ));
            }catch (\Exception $exception)
            {}
            $next = $entity->registrations_for_the_opened_day->where('status' , 'pending')->where("id"  ,'<>' ,$current->id)->first();
            foreach ($entity->registrations_for_the_opened_day->where('status' , 'pending') as $item)
            {
                $item->started_at = Carbon::parse($item->started_at)->subMinutes(intval($entity->average_patient_time))->toDateTimeString();
                $item->save();
            }
            if ($next)
            {
                $next->current = 'yes';
                $next->save();
            }
            return true;
        }else return false;

    }

    public function get_current_registration_for_day()
    {
        $profile = Auth::guard('healthcare')->user();
        return json_encode($profile->get_current_registration_for_day);
    }

    /*SETTERS*/

    public function close_registrations_for_day()
    {
        try {
            $profile = Auth::guard('healthcare')->user();
            $profile->open_registration_for_day = $profile->opening_hours_obj->nextOpen(now())->format('Y-m-d');
            $profile->save();
            flash("Open registration day is set to  " . $profile->open_registration_for_day , ['alert alert-success alert-dismissible']);
        }catch (\Exception)
        {
            flash("failed to apply changes , check your opening hours" , ['alert alert-danger alert-dismissible']);
        }
        return redirect()->back();
    }

    public function set_my_opening_hours(Request $request)
    {
        $profile = Auth::guard('healthcare')->user();
        try {
            $profile->update(
                [
                    'opening_hours'                         => $this->schedule_format($request),
                    'limit_patient'                         => $request->get('limit_patient'),
                    'closure_reason'                        => $request->get('closure_reason'),
                    'opening_hours_display'                 => $request->get('opening_hours_display'),
                    'open_registration_for_day'             => $request->get('open_registration_for_day'),
                    'time_before_open_registration_for_day' => $request->get('time_before_open_registration_for_day'),
                    "payments"                              => json_encode($request->get('payments')),
                ]);
            flash('Your Opening Hours has been changed ' , ['alert alert-success']);

            if ($profile->opening_hours_obj and ($request->get('open_registration_for_day') and $profile->opening_hours_obj->isOpenOn($request->get('open_registration_for_day'))))
                $profile->update(
                    [
                        'open_registration_for_day' => $request->get('open_registration_for_day'),
                        'average_patient_time'      => $request->get('average_patient_time'),
                    ]);
            flash('Your Opening Registration day is set to  ' . $profile->open_registration_for_day , ['alert alert-success']);
        }catch (\Exception $exception)
        {
            flash('Your Opening Hours has not been changed , check your fields ' , ['alert alert-warning']);
        }
        return redirect()->back();
    }

    public function pin_medication_demand(Article $article)
    {
        $profile = Auth::guard('healthcare')->user();

        if ($article->pin == 'active' and ($article->healthcare_id == null or $article->healthcare_id == $profile->id))
        {
            $article->pin = 'pinned';
            $article->pinner_id = $profile->id;
            $article->save();
            flash('Article Demand Validated' , ['alert alert-success']);
        }
        else{
            flash("Problem pinning" , ['alert alert-warning']);
        }
        return redirect()->back();
     }


    /* DATA */
    public function get_healthcares_data(Request $request)
    {
        $query = $request->input('q');

        $healthcares = HealthcareEntity::where('name', 'like', "%$query%")
            ->orWhere('fname', 'like', "%$query%")
            ->orWhere('lname', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('phones',  'like' ,"%$query%")
            ->get(['id', 'name' ,'lname' , 'fname' , 'email' , 'phones as phone']);
        $healthcares->each(function (&$item) {
                $item['url'] = route('patient.get_my_chat_page' , ["type" => "healthcare" , "current" => $item['id']]);
            });
        return response()->json($healthcares);
    }

}
