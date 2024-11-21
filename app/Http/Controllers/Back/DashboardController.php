<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private $configuration;

    public function __construct()
    {
        $this->configuration = Configuration::find(1);
        $this->middleware('permission:edit-config', ['only' => ['edit_config', 'post_config']]);
    }


    public function dashboard()
    {
        return view('back.dashboard');
    }


    public function edit_config()
    {
        return view('back.config',
            [
                "config" => $this->configuration, 'title' => "Paramètres Site-web"
            ]);
    }


    public function post_config(Request $request)
    {
        $data = $request->except(['_token' , "_method" , 'site_logo']);
        try{
            $this->configuration->update($data);

            if($request->file('site_logo'))
            {
                $this->configuration->clearMediaCollection('images');
                $this->configuration->addMedia($request->file('site_logo'))->toMediaCollection('images');
            }

            flash("Les Modifications sont efféctuées" , ['alert alert-success alert-dismissible']);
            return redirect()->back();
        }
        catch (\PDOException $exception)
        {
            flash("Probleme de modification , vérifiez les champs insérés" , ['alert alert-warning alert-dismissible']);
            return redirect()->back();
        }
    }
}
