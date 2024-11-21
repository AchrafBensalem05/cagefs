<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Auth\RegisterRequest;
use App\Http\Requests\FrontPatientRequest;
use App\Mail\Contact;
use App\Models\Appointment;
use App\Models\Article;
use App\Models\Configuration;
use App\Models\Disease;
use App\Models\HealthcareEntity;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Wilaya;
use App\Services\Article\ArticleFilter;
use App\Services\HealthCare\HealthCareService;
use App\Services\Patient\PatientFilter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use DateTimeZone;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpKernel\Profiler\Profile;

class PageController extends Controller
{
    use HealthCareService;

    private  $configuration , $slides;

    public function __construct()
    {
            $this->configuration =  Configuration::find(1);
    }

    public function home()
    {
        return view('front.pages.home' ,
            [
                'config' => $this->configuration,
                'title'  => $this->configuration->site_title .' | ' . $this->configuration->site_slogan
            ]);
    }


    public function get_signup_page()
    {
        return view('front.pages.signup' , [
            'config' => $this->configuration,
            'title'  => $this->configuration->site_title .' | ' . "Sign up"
        ]);
    }


    public function login_patient()
    {
        return view('front.auth.login_patient' ,
            [
                'config' => $this->configuration,
                'title'  => $this->configuration->site_title .' | '  . 'Patient Sign in'
            ]);
    }

    public function login_healthcare($type)
    {
        if(!array_key_exists($type , HealthcareEntity::Types ))
            abort(404);

        return view('front.auth.login_healthcare' ,
            [
                'config' => $this->configuration,
                'title'  => $this->configuration->site_title .' | '  . ' ' . HealthcareEntity::Types[$type] . ' Sign in',
                'type'   => $type
            ]);
    }

    public function register_patient()
    {
        return view('front.auth.register_patient',
        [
            'diseases'  => Disease::all(),
            'config'    => $this->configuration,
            'title'     => $this->configuration->site_title .' | '  . 'Patient Sign up'
        ]);
    }

    public function register_healthcare($type)
    {
        if(!array_key_exists($type , HealthcareEntity::Types ))
            abort(404);

        return view('front.auth.register_healthcare',
            [
                'type'      => $type,
                'wilayas'   => Wilaya::all(),
                'config'    => $this->configuration,
                'services'  => $type == 3 ? Service::where('type' , 'labo')->get() : Service::where('type' ,  'healthcare')->get(),
                'title'     => $this->configuration->site_title .' | '  . 'Healthcare ' . HealthcareEntity::Types[$type] . ' Sign up'
            ]);
    }

    public function register_patient_post(FrontPatientRequest $request)
    {
        $data = $request->only(["phone" , "name" , 'fname' , 'lname' , 'birth_date' , 'password' , 'email' , 'sex' , 'address' , 'chronic_diseases']);
        try {
            $patient = Patient::create([
                "name"              => $data['name'],
                "email"             => $data['email'],
                "password"          => bcrypt($data['password']),
                "lname"             => $data['lname'],
                "fname"             => $data['fname'],
                "phone"             => $data['phone'],
                "birth_date"        => $data['birth_date'],
                "address"           => $data['address'],
                "chronic_diseases"  => json_encode($data['chronic_diseases']),
                "blocked"           => "no",
                "sex"               => $data['sex']
            ]);
            flash("Patient " . $patient->name . " has been added successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->back();
        }catch (\PDOException $exception)
        {
            flash("Insertion Problem" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }

    public function register_healthcare_post($type , Request $request)
    {
        $request->validate(
            [
                "name"          => "required|unique:healthcare_entities|string|min:5",
                "email"         => "required|unique:healthcare_entities|email",
                "password"      => "required|string",
                "lname"         => "string|nullable",
                "fname"         => "string|nullable",
                "phone"         => 'string|nullable',
                "address"       => "string|nullable",
                "daira_id"      => "nullable",
                "description"   => "string|nullable",
                "sex"           => ["nullable" , Rule::in(['male' , 'female' , 'both'])]
            ]);

        $data = $request->except(["_method" , "_token" , 'services']);
        try {
            $healthcareEntity = HealthcareEntity::create([
                'type'          => $type,
                "name"          => $data['name'],
                "email"         => $data['email'],
                "password"      => bcrypt($data['password']),
                "lname"         => $data['lname'],
                "fname"         => $data['fname'],
                "daira_id"      => $data['daira_id'],
                "address"       => $data['address'],
                "description"   => $data['description'],
                "sex"           => $data['sex']  ?? "both"
            ]);
            if (!empty($request->get("services")))
                $healthcareEntity->services()->sync($request->get('services'));
            if($request->file('avatar'))
                $healthcareEntity->addMedia($request->file('avatar'))->toMediaCollection('avatar');
            if($request->file('thumbnail'))
                $healthcareEntity->addMedia($request->file('thumbnail'))->toMediaCollection('thumbnail');
            if($request->file('background'))
                $healthcareEntity->addMedia($request->file('background'))->toMediaCollection('background');

            flash("Entity " . HealthcareEntity::Types[$type] . " is added succesfully" , ['alert alert-success alert-dismissible']);
            return redirect()->back();
        }catch (\PDOException $exception)
        {
            flash("Insertion problem , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }

    public function get_services_page()
    {
            return view('front.pages.services' ,
                [
                    'title'     => 'Find a Doctor',
                    "services"  =>  Service::where("type" , 'healthcare')->get()
                ]
            );
    }

    public function get_laboratories_page()
    {
        return view('front.pages.labo_services' ,
            [
                'title'     => 'Laboratories',
                "services"  =>  Service::where("type" , 'labo')->get()
            ]
        );
    }


    public function get_blood_donation_page()
    {
        return view('front.pages.blood.blood-search' ,
            [
                'title'     => 'Blood Donations',
            ]
        );
    }

    public function get_medication_selector_page()
    {
        return view('front.pages.medications.medications-search' ,
            [
                'title'     => 'Medications Timeline',
            ]
        );
    }


    public function get_medication_timeline_page($medication_type , Request $request)
    {
        if(!in_array($medication_type , ['search' , 'offer']))
            abort(404);

        $articles = ArticleFilter::filters(['wilaya_id' , 'daira_id'  , 'area' , 'language' , 'created_at'] , Article::where('section' , 'medication')->where('medication_type' , $medication_type)->whereNull('started_at')->where('status', 'active') , $request);

        return view('front.pages.medications.medications-timeline' ,
            [
                'articles'          =>  $articles->simplePaginate(5),
                'title'             => 'Medications Timeline',
                'favorites'         =>  optional(Auth::guard("patient")->user())->favorites ,
                'wilayas'           =>  Wilaya::all(),
                'medication_type'   =>  $medication_type
            ]);
    }

    public function get_blood_donors_listing_page($group , Request $request)
    {
        if (!in_array($group , Patient::bloud_group ))
            abort(404);

        $patients = PatientFilter::filters(['daira_id' , 'q' , 'wilaya'] , Patient::where('donor' , 'yes')->where('blood' , $group) , $request);

        return view('front.pages.blood.donors' ,
            [
                'title'      =>  "Blood Donors | " . $group ,
                'wilayas'    =>  Wilaya::all(),
                'patients'   =>  $patients->get()
            ]);
    }

    public function get_blood_donation_timeline_page(Request $request)
    {

        $articles = ArticleFilter::filters(['wilaya_id' , 'daira_id' , 'emergency' , 'blood' , 'language'] , Article::where('section' , 'blood')->whereNull('started_at')->where('status', 'active') , $request) ;
        $campaigns = Article::where('section' , 'blood')->where('status', 'active')->whereNotNull("started_at")->where('wilaya' , $request->get('wilaya_id'))->get();

        return view('front.pages.blood.blood-timeline' ,
            [
                'articles'   =>  $articles->simplePaginate(5),
                'title'      =>  "Blood Donors | Timeline "  ,
                'wilayas'    =>  Wilaya::all(),
                'campaigns'  =>  $campaigns
            ]);
    }

    public function get_healthcare_entities_by_service(Request $request , $slug)
    {
        $service = Service::where('slug' , $slug)->first();
        if($service)
            return view('front.pages.healthcares' ,
                [
                    "title"              => "Get Treatement" . " | " . $service->title,
                    "wilayas"            => Wilaya::all(),
                    "healthcares"        => $this->filter_healthcare(HealthcareEntity::where('blocked' , 'no')->whereHas("services" , function($q) use ($service) { $q->where('service_id' , $service->id ); }) , $request)->get()
                ]);
        else
            abort(404);
    }

    public function get_healthcare_entities_page(Request $request)
    {
            return view('front.pages.healthcares' ,
                [
                    "title"              => "Get Treatement" . " | " ,
                    "wilayas"            => Wilaya::all(),
                    "healthcares"        => $this->filter_healthcare(HealthcareEntity::where('blocked' , 'no') , $request)->get()
                ]);
    }

    public function get_healthcare_entity_page($slug)
    {
        $healthcare_entity = HealthcareEntity::where('slug' , $slug)->first();
        if($healthcare_entity)
        {
            return view('front.pages.healthcare_details' ,
                [
                    "title"              => HealthcareEntity::Types[$healthcare_entity->type] . " | " . $healthcare_entity->name,
                    'healthcare'         => $healthcare_entity,
                    'registrations'      => $healthcare_entity->registrations_for_the_opened_day
                ]);
        }else
            abort(404);
    }


    public function get_healthcare_poster_page($slug)
    {
        $healthcareEntity = HealthcareEntity::where('slug' , $slug)->first();
        if ($healthcareEntity == null)
            abort(404);

        return view('front.pages.poster' ,
            [
                'entity'    => $healthcareEntity,
            ]);
    }

    public function book_registration(Request $request , $slug)
    {
        $entity = HealthcareEntity::where('slug' , $slug)->first();
        $data = $request->except(['_token']);
        
        if($entity)
        {
            $registration = Appointment::create(
                [
                    'type'                  => "registration",
                    "status"                => "pending",
                    "patient_id"            => null ,
                    'name'                  => $data['name'],
                    "phone"                 => $data['phone'],
                    "service_id"            => $data['service_id'],
                    "started_at"            => Carbon::parse($entity->opening_hours_obj->nextOpen(new  \DateTime($entity->open_registration_for_day , new DateTimeZone('Africa/Algiers'))))->addMinutes($entity->average_patient_time * ($entity->registrations_for_the_opened_day ? $entity->registrations_for_the_opened_day->count() + 1 : 1   ))->toDateTimeString(),
                    "healthcare_entity_id"  => $entity->id
                ]);
        }
        flash("Registration successfully Added" , ['alert alert-success alert-dismissible w-100']);
        return redirect()->back();
    }


    public function ask_medication_healthcare(Request $request , $slug)
    {
        $request->validate(['collecting_time' => "string"]);

        $healthcare_entity = HealthcareEntity::where('slug' , $slug)->first();

        $article = Article::create([
            'section'           => 'medication_demand',
            'title'             => 'Medication demand for ' . $healthcare_entity->name ,
            'collecting_time'   => $request->get('collecting_time'),
            'payments'          => json_encode($request->payments),
            'medication'        => json_encode($request->medication),
            'healthcare_id'     => $healthcare_entity->id,
            'author_id'         => Auth::guard('patient')->user()->id,
            'status'            => 'active',
        ]);
        if($request->file('gallery'))
            $article->addMedia($request->file('gallery'))->toMediaCollection('gallery');
        flash('Your post has been added succefully ' , ['alert text-center w-100 alert-success alert-dismissible']);
        return redirect()->back();
    }


    public function book_registration_auth(Request $request , $slug)
    {
        $entity     = HealthcareEntity::where('slug' , $slug)->first();
        $profile    = Auth::guard('patient')->user();
        $data = $request->except(['_token']);
        if(!$profile and Auth::guard("patient")->attempt($request->only(['email' , 'password'])))
        {
            $request->session()->regenerate();
            $profile  = Auth::guard('patient')->user();
        }
        if ($profile)
        {
                $registration = Appointment::create(
                    [
                        'type'                  => "registration",
                        "status"                => "pending",
                        "patient_id"            => $profile->id ,
                        'name'                  => $data['name'],
                        "phone"                 => $profile->phone,
                        "service_id"            => $data['service_id'],
                        "started_at"            => Carbon::parse($entity->opening_hours_obj->nextOpen(new  \DateTime($entity->open_registration_for_day , new DateTimeZone('Africa/Algiers'))))->addMinutes($entity->average_patient_time * ($entity->registrations_for_the_opened_day ? $entity->registrations_for_the_opened_day->count() + 1 : 1   ))->toDateTimeString(),
                        "healthcare_entity_id"  => $entity->id
                    ]);
            flash("Registration successfully Added" , ['alert alert-success alert-dismissible w-100']);
        }else
            flash("check your credentials" , ['alert alert-warning alert-dismissible w-100']);
        return redirect()->back();
    }

    public function book_appointment(Request $request , $slug)
    {
        $entity = HealthcareEntity::where('slug' , $slug)->first();
        $data = $request->except(['_token']);
        if($entity)
        {
            $appoint = Appointment::create(
                [
                    'type'                  => "appointment",
                    "status"                => "waiting",
                    "patient_id"            => null ,
                    'name'                  => $data['name'],
                    "phone"                 => $data['phone'],
                    "service_id"            => $data['service_id'],
                    "started_at"            => $request->get('date') ." " . Carbon::parse($entity->opening_hours_obj->nextOpen(new  \DateTime($entity->open_registration_for_day , new DateTimeZone('Africa/Algiers'))))->addMinutes($entity->average_patient_time * ($entity->registrations_for_the_opened_day ? $entity->registrations_for_the_opened_day->count() + 1 : 1   ))->toTimeString(),
                    "healthcare_entity_id"  => $entity->id
                ]);
        }
        flash("Apointment successfully Added" , ['alert alert-success alert-dismissible w-100']);
        return redirect()->back();
    }

    public function post_contact_page(Request $request)
    {
        try
        {
            $data = $request->only(['name' , 'email' , 'phone' , 'message']);
            $contact_mailer = new Contact([
                'name'          => $data['name'] ,
                'email'         => $data['email'],
                'phone'         => $data['phone'],
                'message'       => $data['message']
            ]);
            Mail::to($this->configuration->site_email)->send($contact_mailer);
            session(['message' => "Votre message a été bien bien envoyé"]);
            return redirect()->back();
        }
        catch (\Exception $swift_TransportException)
        {
            return redirect()->back();
        }
    }




}
