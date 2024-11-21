<?php

namespace App\Http\Controllers\Back;

use App\DataTables\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:service-delete' , ['only' => ['show' , 'destroy']]);
        $this->middleware('permission:service-index' , ['only' => ['index' , 'get_index']]);
    }


    public function index($type , ServiceDataTable $serviceDataTable)
    {
        return view("back.services.index"  ,
            [
                "service_datatable"   =>  $serviceDataTable->html(),
                'title'               =>  "SERVICE " . $type . " MANAGEMENT" ,
                'type'                =>  $type
            ]);
    }



    public function get_index($type ,ServiceDataTable $serviceDataTable)
    {
        return $serviceDataTable->render("back.services.index" , [
            'type' =>  $type
        ]);
    }



    public function create($type)
    {
        return view('back.services.create' , [
            'title'       =>  "New Service",
            'type'        =>  $type
        ]);
    }



    public function store($type , Request $request)
    {
        $data = $request->except(["_method" , "_token"]);
        try {
            $service = Service::create([
                "title"             => $data['title'],
                "description"       => $data['description'],
                "icon"              => $data['icon'],
                'type'              =>  $type
            ]);
            if($request->file('icon'))
                $service->addMedia($request->file('icon'))->toMediaCollection('icon');

            flash("Service " . $service->title . " has been added successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('services.index' , $type);
        }catch (\PDOException $exception)
        {
            flash("Erreur d'insértion" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function show($type ,Service $service)
    {
        return view('back.services.delete' , [
            'service'  => $service ,
            'title'    => "Deleting Service :" . $service->title,
            'type'     =>  $type
        ]);
    }



    public function edit($type , Service $service)
    {
        return view('back.services.edit' , [
            'service'           =>  $service,
            'title'             =>  "Editing Service : ".$service->title,
            'type'              =>  $type
        ]);
    }



    public function update($type , Request $request, Service $service)
    {
        $data = $request->except(["_method" , "_token"]);
        try {
            $service->update([
                "title"             => $data['title'],
                "description"       => $data['description'],
                "icon"              => $data['icon'],
                'type'              => $type
            ]);
            if($request->file('icon')) {
                $service->clearMediaCollection('icon');
                $service->addMedia($request->file('icon'))->toMediaCollection('icon');
            }
            flash("Service " . $service->title ."has been modified successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('services.index' , $type);
        }catch (\PDOException $exception)
        {
            flash("Editing problem  , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function destroy($type , Service $service)
    {
        try{
            $service->delete();
            flash("Service " . $service->title . " has been deleted successfully"  , ['alert alert-success alert-dismissible']);
            return redirect()->route('services.index' , $type);
        }catch (\PDOException  $exception)
        {
            flash("Deletion problem , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();}
    }
}
