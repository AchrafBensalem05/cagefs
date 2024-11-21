<?php

namespace App\Http\Controllers\Front;

use App\DataTables\Front\ArticleDataTable;
use App\DataTables\Front\Patient\AppointmentDataTable;
use App\DataTables\Front\SaveAnnouncesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Configuration;
use App\Models\Disease;
use App\Models\Favoritearticle;
use App\Models\HealthcareEntity;
use App\Models\Patient;
use App\Services\HealthCare\HealthCareService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Wilaya;

class PatientController extends Controller
{
    use HealthCareService;

    protected  $configuration;
    public function __construct()
    {
        $this->configuration  = Configuration::find(1);
    }

    public function dashboard(Request $request)
    {
        return view('front.patients.pages.healthcare_entities' , [
            'title'         => __('Getting Treatment'),
            'config'        => $this->configuration,
            'profile'       => Auth::guard('patient')->user(),
            'healthcares'   => $this->filter_healthcare((new HealthcareEntity)->newQuery()->where('blocked' , 'no') , $request)->simplePaginate(6),
            'wilayas'       => Wilaya::all()
        ]);
    }


    public function profile()
    {
        return view('front.patients.pages.profile', [
            'title'         => 'My Profile',
            'diseases'      => Disease::all(),
            'config'        => $this->configuration,
            'profile'       => Auth::guard('patient')->user()
        ]);
    }

    public function timeline(ArticleDataTable $articleDataTable)
    {
        $profile = Auth::guard('patient')->user();
        return view('front.patients.pages.timeline' ,
            [
                "profile"                   => $profile,
                'config'                    => $this->configuration,
                "article_datatable"         => $articleDataTable->html(),
                "title"                     => __('Manage Published Posts In Timeline'),
            ]
        );
    }

    public function saved_announces(SaveAnnouncesDataTable $announcesDataTable)
    {
        $profile = Auth::guard('patient')->user();
        return view('front.patients.pages.saved_announces' ,
            [
                "profile"                   => $profile,
                'config'                    => $this->configuration,
                "announces_datatable"       => $announcesDataTable->html(),
                "title"                     => __('Manage Published Posts In Timeline'),
            ]
        );
    }

    public function get_article_details(Article $article)
    {
        $profile = Auth::guard('patient')->user();
        return view('front.pages.article_details' ,
            [
                "profile"                   => $profile,
                'config'                    => $this->configuration,
                "article"                   => $article,
                "title"                     => $article->title,
            ]
        );
    }

    public function get_timeline_data(ArticleDataTable $articleDataTable)
    {
        return $articleDataTable->render("front.patients.pages.timeline");
    }

    public function get_saved_announces_data(SaveAnnouncesDataTable $announcesDataTable)
    {
        return $announcesDataTable->render('front.patients.pages.saved_announces');
    }


    public function get_my_appointments_page(AppointmentDataTable $appointmentDataTable)
    {
        $profile = Auth::guard('patient')->user();
        return view('front.patients.pages.appointments' ,
            [
                "profile"                       => $profile,
                'config'                        => $this->configuration,
                "appointment_datatable"         => $appointmentDataTable->html(),
                "title"                         => __('My Appointments'),
            ]
        );
    }

    public function get_my_appointment_data(AppointmentDataTable $appointmentDataTable)
    {
        return $appointmentDataTable->render('front.patients.pages.appointments');
    }



    public  function profile_post(Request $request)
    {
        try {
            $profile = Auth::guard('patient')->user();
            $request->validate([
                'fname'             => ['string', 'nullable'],
                'lname'             => ['string', 'nullable'],
                'name'              => ['string', 'required'],
                'phone'             => ['string', 'nullable'],
                'birth_date'        => ['date' , 'required'],
                'donor'             => ["string" , 'required' , Rule::in(['yes' , 'no'])],
                "sex"               => ['string' , "required" , Rule::in(['male' , 'female'])],
                "blood"             => ["string" , 'required' , Rule::in(Patient::bloud_group)],
                'email'             => ['email', Rule::unique('patients', 'email')->ignore($profile->id)],
                'chronic_diseases'  => ['nullable']
            ]);
            $data = $request->except(['_method', '_token', 'blocked' , 'password']);
            if ($request->get('password')[0] != null and ($request->get('password')[0] == $request->get('password')[1]))
                array_push($data, ['password' => bcrypt($request->get('password')[0])]);
            elseif($request->get('password')[0] != null)
            {
                flash('Passwords does not match' , ['alert alert-warning']);
                return redirect()->back();
            }
            if($request->file('avatar'))
            {
                $profile->clearMediaCollection('avatar');
                $profile->addMedia($request->file('avatar'))->toMediaCollection('avatar');
            }
            if(!array_key_exists('chronic_diseases', $data))
                $data['chronic_diseases'] = json_encode([]);
            $profile->update($data);
            flash('Successfully Modified' , ['alert text-center w-100 alert-success alert-dismissible']);
            return redirect()->back();
        }catch (\Exception $exception)
        {
            flash('Editing Problem' , ['alert text-center w-100 alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }

    public function get_healthcare_page($slug)
    {
        $healthcareEntity = HealthcareEntity::where('slug' , $slug)->first();
        if ($healthcareEntity == null)
            abort(404);

        return view('front.patients.pages.healthcare_details' ,
            [
                "profile"   => Auth::guard('patient')->user(),
                'entity'    => $healthcareEntity,
                'config'    => $this->configuration,
                'title'     => HealthcareEntity::Types[$healthcareEntity->type] . ' ' .$healthcareEntity->fname . " ".$healthcareEntity->lname
            ]);
    }


    public function get_my_chat_page($type  , $current = null)
    {
        $profile = Auth::guard('patient')->user();
        if($current)
            $current = ($type == 'healthcare' ?  HealthcareEntity::find($current) : Patient::find($current) );
        return view("front.patients.pages.my_chat" ,
            [
                'profile'           => $profile,
                'config'            => $this->configuration,
                'title'             => __("Chat Page"),
                'contacts'          => $type  == 'healthcare' ? $profile->chat_healthcares() : $profile->chat_patients() ,
                'current'           => $current,
                'type'              => $type,
                'messages'          => $current ? ($type == "healthcare"  ? $profile->chat_with_healthcare($current->id) : $profile->chat_with_patient($current->id)  ) : null
            ]);
    }


    public function article_status_change(Article $article , Request $request)
    {
        $profile = Auth::guard('patient')->user();
        if($article->author_id == $profile->id and in_array($request->get('status') , ['canceled', 'active', 'done']))
        {
            $article->status = $request->get("status");
            $article->save();
            flash('Your post has been changed successfully ' , ['alert text-center w-100 alert-success alert-dismissible']);
        }else
            flash('Error Editing , check your data ' , ['alert text-center w-100 alert-warning alert-dismissible']);
        return redirect()->back();
    }

    public function article_pin_change(Article $article , Request $request)
    {
        $profile = Auth::guard('patient')->user();
        if($article->author_id == $profile->id and in_array($request->get('status') , ['canceled', 'active', 'done']))
        {
            $article->status = $request->get("status");
            $article->save();
            flash('Your post has been changed successfully ' , ['alert text-center w-100 alert-success alert-dismissible']);
        }else
            flash('Error Editing , check your data ' , ['alert text-center w-100 alert-warning alert-dismissible']);
        return redirect()->back();
    }

    public function submit_blood_article(Request $request)
    {
        $request->validate([
            'blood_group' => ['nullable', Rule::in(Patient::bloud_group)]
        ]);
        $data = $request->all();
        try{

            $article = Article::create([
                'section'       => 'blood',
                'title'         => 'Need Blood ' . $data['blood_group'],
                'content'       => $data['content'],
                'location'      => $data['location'],
                'wilaya'        => $data['wilaya'],
                'daira'         => $data['daira'],
                'emergency'     => $data['emergency'],
                'language'      => $data['language'],
                'blood'         => $data['blood_group'],
                'started_at'    => ($request->get('campaign') and $request->get('campaign') == 'on') ? $data['started_at'] : null,
                'author_id'     => Auth::guard('patient')->user()->id,
                'status'        => 'active',
            ]);
            flash('Your post has been added succefully ' , ['alert text-center w-100 alert-success alert-dismissible']);
        }catch (\Exception $exception)
        {
            flash('Error insertion check your fields' , ['alert text-center w-100 alert-warning alert-dismissible']);
        }
        return redirect()->back();
    }

    public function submit_medication_article(Request $request)
    {
        $request->validate([
            'medication_type' => ['required', Rule::in(['offer' , 'search'])],
            'area'            => [Rule::in(['local' ,'foreign'])],
        ]);
        $data = $request->all();
        try{
            $article = Article::create([
                'section'           => 'medication',
                'title'             => 'Medication ' . $data['medication_type'],
                'medication_type'   => $data['medication_type'],
                'content'           => $data['content'],
                'wilaya'            => $data['wilaya'],
                'daira'             => $data['daira'],
                'area'              => $data['area'],
                'author_id'         => Auth::guard('patient')->user()->id,
                'status'            => 'active',
            ]);

            if($request->file('gallery'))
            {
                if($request->file('gallery'))
                    foreach($request->file('gallery') as $file)
                    {
                        $article->addMedia($file)->toMediaCollection('gallery');
                    }
            }
            flash('Your post has been added succefully ' , ['alert text-center w-100 alert-success alert-dismissible']);
        }catch (\Exception $exception)
        {
            flash('Error insertion check your fields' , ['alert text-center w-100 alert-warning alert-dismissible']);
        }
        return redirect()->route('front.get_medication_timeline_page' , $data["medication_type"]);
    }

    public function like_article($type , Article $article,Request $request)
    {
        if(!in_array($type , ['like' , 'favorite' , 'report']))
            abort(404);
        else
            $relationship = ($type == "like" ? "likes" : ($type == 'favorite' ?  "favorites" : "reports"));
        $profile = Auth::guard('patient')->user();
        if(in_array($profile->id , $article->{$relationship}->pluck('user_id')->toArray()))
        {
            $like = $article->{$relationship}->where('user_id' , $profile->id)->first();
            $like->delete();
        }else
        {
            $like = Favoritearticle::create(
                [
                    'article_id' => $article->id,
                    'user_id'    => $profile->id,
                    'type'       => $type
                ]);
        }
        try{
            flash('Action done successfully' , ['alert text-center w-100 alert-success alert-dismissible']);
        }catch (\Exception $exception)
        {
            flash('Error , check your page' , ['alert text-center w-100 alert-warning alert-dismissible']);
        }
        return redirect()->back();
    }

    public function pin_article(Article $article)
    {
        $profile = Auth::guard('patient')->user();
        if($article->pin == 'active')
        {
            $article->pin       = 'request';
            $article->pinner_id = $profile->id;
            $article->save();
            flash('you pinned this article' , ['alert text-center w-100 alert-success alert-dismissible']);
        }else
            flash('already pinned' , ['alert text-center w-100 alert-warning alert-dismissible']);
        return redirect()->back();
    }

    public function confirm_pinning(Article $article, Request $request)
    {
        $profile = Auth::guard('patient')->user();

        if($article->author_id == $profile->id and in_array($request->get('pin') , ['active', 'pinned']))
        {
            $article->pin = $request->get("pin");
            $article->save();
            flash('Your post has been changed successfully ' , ['alert text-center w-100 alert-success alert-dismissible']);
        }else
            flash('Error Editing , check your data ' , ['alert text-center w-100 alert-warning alert-dismissible']);
        return redirect()->back();

    }



    public function get_patient_data(Patient $patient)
    {
        $patient->load(['daira.wilaya']);
        return json_encode($patient->only(["fname" , "lname" , "phone" , "daira"]));
    }

    public function get_patients_data(Request $request)
    {
        $query = $request->input('q');

        $patients = Patient::where('name', 'like', "%$query%")
            ->orWhere('fname', 'like', "%$query%")
            ->orWhere('lname', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('phone',  'like' ,"%$query%")
            ->get(['id', 'name' ,'lname' , 'fname' , 'email' , 'phone']);

        $patients->each(function (&$item) {
                $item['url'] = route('patient.get_my_chat_page' , ["type" => "patient" , "current" => $item['id']]);
            });
        return response()->json($patients);
    }


}
