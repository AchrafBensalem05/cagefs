<?php

namespace App\Http\Controllers\Back;

use App\DataTables\BloodDonationDataTable;
use App\DataTables\PatientDataTable;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:patient-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patient-edit' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:patient-delete' , ['only' => ['show' , 'destroy']]);
        $this->middleware('permission:patient-index' , ['only' => ['index' , 'get_index']]);

    }


    public function index(PatientDataTable $patientDataTable)
    {
        return view("back.patients.index"  ,
            [
                "patient_datatable"   =>  $patientDataTable->html(),
                'title'             =>  "PATIENTS MANAGEMENT" ,
            ]);
    }



    public function get_index(PatientDataTable $patientDataTable)
    {
        return $patientDataTable->render("back.patients.index" );
    }


    public function blood_index(BloodDonationDataTable $bloodDonationDataTable)
    {
        return view("back.patients.blood_index"  ,
            [
                "blood_donation_datatable"   =>  $bloodDonationDataTable->html(),
                'title'             =>  "LISTING BLOOD DONATORS" ,
            ]);
    }



    public function blood_get_index(BloodDonationDataTable $bloodDonationDataTable)
    {
        return $bloodDonationDataTable->render("back.patients.blood_index" );
    }



    public function create()
    {
        return view('back.patients.create' , [
            'title'             =>  "New Patient",
            'wilayas'           => Wilaya::all()
        ]);
    }



    public function store(Request $request)
    {
        $request->validate(
            [
                "name"          => "required|unique:patients|string|min:5",
                "email"         => "required|unique:patients|email",
                "password"      => "required|string",
                "lname"         => "string|nullable",
                "fname"         => "string|nullable",
                "birth_date"    => 'date|nullable',
                'daira_id'      => 'string|nullable',
                "address"       => 'string|nullable',
                "phone"         => 'string|nullable',
                "donor"         => 'string|nullable',
                "blood"         => Rule::in(Patient::bloud_group),
                "sex"           => Rule::in(['male' , 'female']),
                "blocked"       => Rule::in(['yes' , 'no'])
            ]);

        $data = $request->except(["_method" , "_token"]);

        try {
            $patient = Patient::create([
                "name"          => $data['name'],
                "email"         => $data['email'],
                "password"      => bcrypt($data['password']),
                "lname"         => $data['lname'],
                "fname"         => $data['fname'],
                "phone"         => $data['phone'],
                'daira_id'      => $data['daira_id'],
                "birth_date"    => $data['birth_date'],
                "address"       => $data['address'],
                "blocked"       => $data['blocked'],
                "blood"         => $data['blood'],
                "sex"           => $data['sex']
            ]);
            flash("Patient " . $patient->name . " has been added successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('patients.index');
        }catch (\PDOException $exception)
        {
            flash("Insertion Problem" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function show(Patient $patient)
    {
        return view('back.patients.delete' , [
            'patient' => $patient ,
            'title' => "Deleting Patient :" . $patient->name
        ]);
    }



    public function edit(Patient $patient)
    {
        return view('back.patients.edit' , [
            'patient'           =>  $patient,
            'title'             =>  "Editing Patient : ".$patient->name,
            'wilayas'           => Wilaya::all()
        ]);
    }



    public function update(Request $request, Patient $patient)
    {
        $request->validate(
            [
                "name"          => ["required",Rule::unique('patients' , 'name')->ignore($patient->id),"string" , "min:5"],
                "email"         => ["required" ,Rule::unique('patients' , 'email')->ignore($patient->id) , "email" ],
                "lname"         => "string|nullable",
                "fname"         => "string|nullable",
                'password'      => 'nullable',
                "birth_date"    => 'date|nullable',
                'daira_id'      => 'string|nullable',
                "address"       => 'string|nullable',
                "phone"         => 'string|nullable',
                "donor"         => 'string|nullable',
                "blood"         => Rule::in(Patient::bloud_group),
                "sex"           => Rule::in(['male' , 'female']),
                "blocked"       => Rule::in(['yes' , 'no'])
            ]);

        $data = $request->except(["_method" , "_token"]);

        try {
            $patient->update([
                "name"          => $data['name'],
                "email"         => $data['email'],
                "password"      => $data["password"] ?  bcrypt($data['password']) : $patient->password,
                "lname"         => $data['lname'],
                "phone"         => $data['phone'],
                "fname"         => $data['fname'],
                "daira_id"      => $data['daira_id'],
                "birth_date"    => $data['birth_date'],
                "address"       => $data['address'],
                "blood"         => $data['blood'],
                "donor"         => $data['donor'],
                "blocked"       => $data['blocked'],
                "sex"           => $data['sex']
            ]);
            flash("Patient " . $patient->name ."has been modified successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('patients.index');
        }catch (\PDOException )
        {
            flash("Editing problem  , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function destroy(Patient $patient)
    {
        try{
            $patient->delete();
            flash("Patient " . $patient->name . " has been deleted successfully"  , ['alert alert-success alert-dismissible']);
            return redirect()->route('patients.index');
        }catch (\PDOException  $exception)
        {
            flash("Deletion problem , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();}
    }


    public function get_patient_info(Patient $patient)
    {
        return json_encode($patient);
    }
}
