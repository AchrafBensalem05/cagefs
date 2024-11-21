<?php

namespace App\Http\Controllers\Back;

use App\DataTables\HealthcareEntityDataTable;
use App\DataTables\VoucherDataTable;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\HealthCareTrait;
use App\Http\Requests\Back\HealthcareRequest;
use App\Models\Daira;
use App\Models\HealthcareEntity;
use App\Models\Service;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\OpeningHours\OpeningHours;
use App\Models\Wilaya;

class HealthCareEntityController extends Controller
{

    use HealthCareTrait;
    private  $services ;
    public function __construct()
    {
        $this->middleware('permission:healthcare-entity-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:healthcare-entity-edit' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:healthcare-entity-delete' , ['only' => ['show' , 'destroy']]);
        $this->middleware('permission:healthcare-entity-index' , ['only' => ['index' , 'get_index']]);
        $this->services = Service::all();
    }


    public function index($type , HealthcareEntityDataTable $healthcareEntityDataTable)
    {
        return view("back.healthcareEntities.index"  ,
            [
                "healthcare_entity_datatable"   =>  $healthcareEntityDataTable->html(),
                'title'                         =>  HealthcareEntity::Types[$type] .  " Management" ,
                'type'                          =>  $type
            ]);
    }


    public function create($type)
    {
        return view('back.healthcareEntities.create' , [
            'title'                 =>  'New ' . HealthcareEntity::Types[$type],
            'type'                  =>  $type ,
            'services'              =>  $this->services,
            "wilayas"               => Wilaya::all()
            ]);
    }

    public function store($type , HealthcareRequest $request)
    {
        $data = array_merge($request->except(["_method" , "_token" , 'services' , 'opening_hours']) , [
            'type'          => $type,
            'password'      => bcrypt($request->get("password")),
            'opening_hours' => $this->schedule_format($request),
        ]);

        try {
            $healthcareEntity = HealthcareEntity::create($data);
            flash("Entity " . HealthcareEntity::Types[$type] . " is added succesfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('healthcareEntity.index' , $type);
        }catch (\PDOException $exception)
        {
            flash("Insertion problem , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }

    public function show($type, HealthcareEntity $healthcareEntity)
    {
        return view('back.healthcareEntities.delete' , [
            'healthcareEntity' => $healthcareEntity ,
            'title' => "Deleting :" . $healthcareEntity->name,
            'type' => $type
        ]);
    }

    public function edit($type,HealthcareEntity $healthcareEntity)
    {
        $healthcareEntity->load(['services']);
        return view('back.healthcareEntities.edit' , [
            'healthcareEntity'      =>  $healthcareEntity,
            'type'                  =>  $type,
            'title'                 =>  "Edit Entity : " .$healthcareEntity->name ,
            'services'              =>  $this->services,
            "wilayas"               =>  Wilaya::all()
        ]);
    }

    public function update($type , HealthcareRequest $request, HealthcareEntity $healthcareEntity)
    {
        $data =  array_merge($request->except(["_method" , "_token"  , "opening_hours"]) , [
            'password'      => ( $request->get("password") ?  $request->get("password") : $healthcareEntity->password),
            'opening_hours' => $this->schedule_format($request),
        ]);
        try {
            $healthcareEntity->update($data);
            flash("Entity " . $healthcareEntity->name ." has been successfully modified" , ['alert alert-success alert-dismissible']);
            return redirect()->route('healthcareEntity.index' , $type);
        }catch (\PDOException $exception)
        {
            flash("Problem in Modification , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }

    public function destroy($type , HealthcareEntity $healthcareEntity)
    {
        try{
            $healthcareEntity->delete();
            flash("L'utilisateur a été supprimé avec succès" , ['alert alert-success alert-dismissible']);
            return redirect()->route('healthcareEntity.index' , $type);
        }catch (\PDOException  $exception)
        {
            flash("Problème de supréssion , entité peut etre utilisée autre part " , ['alert alert-danger alert-dismissible']);
            return redirect()->back();}
    }

    public function entity_status_change(HealthcareEntity $healthcareEntity)
    {
        try {
            $healthcareEntity->blocked = ($healthcareEntity->blocked == 'yes' ? "no" : "yes");
            $healthcareEntity->save();
            flash("Status of " . $healthcareEntity->name . " has been changed successfully" , ['alert alert-success alert-dismissible']);
        }catch (\Exception $exception)
        {
            flash("Editing Problem  " . $healthcareEntity->name  , ['alert alert-warning alert-dismissible']);
        }
        return redirect()->back();
    }


    public function set_expiration_day(HealthcareEntity  $healthcareEntity , Request $request)
    {
        try
        {
            $healthcareEntity->update(['expired_at' => Carbon::parse($request->get('expired_at')) ]);
            flash("Expiration day for " . $healthcareEntity->name . " has been changed successfully" , ['alert alert-success alert-dismissible']);
        }catch(\Exception $exception)
        {
            flash("Failed to change experiation of " . $healthcareEntity->name . " " , ['alert alert-warning alert-dismissible']);
        }
        return redirect()->back();

    }


    public function set_healthcare_billing_status(Voucher $voucher,Request $request)
    {
        try
        {
            $voucher->update(['status' => $request->get('status') ]);
            flash("Voucher Updated day for has been changed successfully" , ['alert alert-success alert-dismissible']);
        }catch(\Exception $exception)
        {
            flash("Failed to change " , ['alert alert-warning alert-dismissible']);
        }
        return redirect()->back();
    }

    // JSON RESULTS

    public function get_index($type , HealthcareEntityDataTable $healthcareEntityDataTable)
    {
        return $healthcareEntityDataTable->render("back.healthcareEntities.index");
    }

    public function get_services_of_healthcare_entity(HealthcareEntity $healthcareEntity)
    {
        return json_encode($healthcareEntity->services);
    }


    public function get_vouchers_page(VoucherDataTable $dataTable)
    {
        return $dataTable->render('back.healthcareEntities.vouchers' ,
            [
                'title' => 'Billing and Accounts Vouchers'
            ]
        );
    }




}
