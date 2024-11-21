<?php

namespace App\Http\Controllers\Back;

use App\DataTables\DiseaseDataTable;
use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{


    public function index(DiseaseDataTable $diseaseDataTable)
    {
        return view("back.diseases.index"  ,
            [
                "disease_datatable"   =>  $diseaseDataTable->html(),
                'title'               =>  "CHRONIC DISEASES MANAGEMENT" ,
            ]);
    }



    public function get_index(DiseaseDataTable $diseaseDataTable)
    {
        return $diseaseDataTable->render("back.diseases.index" );
    }


    public function create()
    {
        return view('back.diseases.create' , [
            'title'       =>  "New Chronic Disease",
        ]);
    }



    public function store(Request $request)
    {
        $data = $request->except(["_method" , "_token"]);
        try {
            $disease = Disease::create([
                "title"  => $data['title'],
            ]);

            flash("Disease " . $disease->title . " has been added successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('diseases.index');
        }catch (\PDOException $exception)
        {
            flash("Erreur d'insértion" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function show(Disease $disease)
    {
        return view('back.diseases.delete' , [
            'disease' => $disease ,
            'title' => "Deleting Disease :" . $disease->title
        ]);
    }



    public function edit(Disease $disease)
    {
        return view('back.diseases.edit' , [
            'disease'           =>  $disease,
            'title'             =>  "Editing Disease : ".$disease->title
        ]);
    }



    public function update(Request $request, Disease $disease)
    {
        $data = $request->except(["_method" , "_token"]);
        try {
            $disease->update([
                "title"             => $data['title']
            ]);
            flash("Disease " . $disease->title ." has been modified successfully" , ['alert alert-success alert-dismissible']);
            return redirect()->route('diseases.index');
        }catch (\PDOException )
        {
            flash("Editing problem  , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function destroy(Disease $disease)
    {
        try{
            $disease->delete();
            flash("Disease " . $disease->title . " has been deleted successfully"  , ['alert alert-success alert-dismissible']);
            return redirect()->route('diseases.index');
        }catch (\PDOException  $exception)
        {
            flash("Deletion problem , check your fields" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();}
    }
}
