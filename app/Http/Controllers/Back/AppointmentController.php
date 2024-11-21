<?php

namespace App\Http\Controllers\Back;

use App\DataTables\AppointmentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\HealthcareEntity;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AppointmentController extends Controller
{

    private $healthcare_entities , $patients;
    public function __construct()
    {
        $this->middleware('permission:appoin-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:appoin-edit' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:appoin-delete' , ['only' => ['show' , 'destroy']]);
        $this->middleware('permission:appoin-index' , ['only' => ['index' , 'get_index']]);

        $this->healthcare_entities = HealthcareEntity::where('blocked' , 'no' );
        $this->patients            = Patient::where('blocked' , 'no');
    }


    public function index($type , AppointmentDataTable $appointmentDataTable)
    {
        return view("back.appointments.index"  ,
            [
                "appointment_datatable"   =>  $appointmentDataTable->html(),
                'title'                   =>  $type  . " management" ,
                'type'                    =>  $type
            ]);
    }



    public function get_index($type , AppointmentDataTable $appointmentDataTable)
    {
        return $appointmentDataTable->render("back.appointments.index" );
    }



    public function create($type)
    {
        return view('back.appointments.create' , [
            'title'                     =>  "New " . $type,
            'type'                      =>  $type ,
            'healthcare_entities'       =>  $this->healthcare_entities->get(),
            'patients'                  =>  $this->patients->get()
        ]);
    }



    public function store($type , Request $request)
    {
        $data = $request->except(["_method" , "_token"]);
        if ($request->get('patient_id'))
            $patient = Patient::find($request->get('patient_id'));
        try {
            $appointment = Appointment::create([
                'type'                  => $type,
                "status"                => "pending",
                "patient_id"            => array_key_exists("anonym" , $data) ? null : optional($patient)->id,
                'name'                  => (array_key_exists("anonym" , $data)) ? $data['name'] : optional($patient)->name,
                "phone"                 => $data['phone'],
                "service_id"            => $data['service_id'],
                "started_at"            => $data['started_at'],
                "healthcare_entity_id"  => $data['healthcare_entity_id']
            ]);
            flash($type." of " . $appointment->name . " has been added successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('appointment.index' , $type);
        }catch (\PDOException $exception)
        {
            flash("Erreur d'insértion" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }


    public function show($type , Appointment $appointment)
    {
        return view('back.appointments.delete' , [
            'appointment' => $appointment ,
            'title' => "Deleting appointment :" . $appointment->name,
            'type'  => $type
        ]);
    }



    public function edit($type , Appointment $appointment)
    {
        return view('back.appointments.edit' , [
            'appointment'           =>  $appointment,
            'title'                 =>  "Editing $type : ".$appointment->name,
            'healthcare_entities'   =>  $this->healthcare_entities->get(),
            'patients'              =>  $this->patients->get(),
            'type'                  =>  $type,
            'services'              =>  $appointment->healthcareEntity->services
        ]);
    }


    public function update($type , Request $request, Appointment $appointment)
    {
        $data = $request->except(["_method" , "_token"]);
        if ($request->get('patient_id'))
            $patient = Patient::find($request->get('patient_id'));
        try {
            $appointment->update([
                'type'                  => $type,
                "status"                => $data['status'],
                "patient_id"            => array_key_exists("anonym" , $data) ? null : optional($patient)->id,
                'name'                  => (array_key_exists("anonym" , $data)) ? $data['name'] : optional($patient)->name,
                "phone"                 => $data['phone'],
                "service_id"            => $data['service_id'],
                "started_at"            => $data['started_at'],
                "healthcare_entity_id"  => $data['healthcare_entity_id']
            ]);
            flash($type." of " . $appointment->name . " has been added successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('appointment.index' , $type);
        }catch (\PDOException )
        {
            flash("Editing problem  , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function destroy($type,Appointment $appointment)
    {
        try{
            $appointment->delete();
            flash("appointment of  " . $appointment->name . " has been deleted successfully"  , ['alert alert-success alert-dismissible']);
            return redirect()->route('appointment.index' , $type);
        }catch (\PDOException  $exception)
        {
            flash("Deletion problem , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();}
    }
}
