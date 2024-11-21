<?php

namespace App\Http\Controllers\Back;

use App\DataTables\PricingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:service-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:service-edit' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:service-delete' , ['only' => ['show' , 'destroy']]);
        $this->middleware('permission:service-index' , ['only' => ['index' , 'get_index']]);
    }


    public function index(PricingDataTable $pricingDataTable)
    {
        return view("back.pricings.index"  ,
            [
                "pricing_datatable"   =>  $pricingDataTable->html(),
                'title'               =>  "PRICING MANAGEMENT" ,
            ]);
    }



    public function get_index(PricingDataTable $pricingDataTable)
    {
        return $pricingDataTable->render("back.pricings.index" , [
        ]);
    }



    public function create()
    {
        return view('back.pricings.create' , [
            'title'       =>  "New Pricing"
        ]);
    }



    public function store(Request $request)
    {
        $data = $request->except(["_method" , "_token"]);
        try {
            $pricing = Pricing::create([
                "title"             => $data['title']
            ]);

            flash("Pricing  " . $pricing->title . " has been added successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('pricings.index' );
        }catch (\PDOException $exception)
        {
            flash("Erreur d'insértion" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function show(Pricing $pricing)
    {
        return view('back.pricings.delete' , [
            'pricing'  => $pricing ,
            'title'    => $pricing->title
        ]);
    }



    public function edit(Pricing $pricing)
    {
        return view('back.pricings.edit' , [
            'pricings'              =>  $pricing,
            'title'                 =>  "Editing Pricing : ".$pricing->title,
        ]);
    }



    public function update(Request $request, Pricing $pricing)
    {
        $data = $request->except(["_method" , "_token"]);
        try {
            $pricing->update([
                "title"             => $data['title']
            ]);
            flash("Pricing " . $pricing->title ."has been modified successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('pricings.index' );
        }catch (\PDOException $exception)
        {
            flash("Editing problem  , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function destroy( Pricing $pricing)
    {
        try{
            $pricing->delete();
            flash("Pricing " . $pricing->title . " has been deleted successfully"  , ['alert alert-success alert-dismissible']);
            return redirect()->route('pricings.index');
        }catch (\PDOException  $exception)
        {
            flash("Deletion problem , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();}
    }
}
