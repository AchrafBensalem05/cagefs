<?php

namespace App\Http\Controllers\Back;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private  $roles;


    public function __construct()
    {
        $this->roles  = Role::all();

        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:user-delete' , ['only' => ['show' , 'destroy']]);
        $this->middleware('permission:user-index' , ['only' => ['index' , 'get_index']]);

    }


    public function index(UserDataTable $userDataTable)
    {
        return view("back.users.index"  ,
            [
                "users_datatable"   =>  $userDataTable->html(),
                'title'             =>  "GESTION DES UTILISATEURS" ,
            ]);
    }



    public function get_index(UserDataTable $userDataTable)
    {
        return $userDataTable->render("back.users.index" );
    }



    public function create()
    {
        return view('back.users.create' , [
            'title'       =>  "Nouveau utilisateur",
            'roles'       =>  $this->roles
        ]);
    }



    public function store(Request $request)
    {
        $request->validate(
            [
                "name"          => "required|unique:users|string|min:5",
                "email"         => "required|unique:users|email",
                "password"      => "required|string",
            ]);

        $data = $request->except(["_method" , "_token"]);
        try {
            $user = User::create([
                "name"      => $data['name'],
                "email"     => $data['email'],
                "password"  => bcrypt($data['password']),
            ]);
            if(!empty($data['roles']))
                $user->syncRoles($data["roles"]);

            flash("L'utilisateur a été ajouté avec succès" , ['alert alert-success alert-dismissible']);
            return redirect()->route('users.index');
        }catch (\PDOException $exception)
        {
            flash("Erreur d'insértion" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function show(User $user)
    {
        return view('back.users.delete' , [
            'user' => $user ,
            'title' => "Suppression Compte utilisateur :" . $user->name
        ]);
    }



    public function edit(User $user)
    {
        return view('back.users.edit' , [
            'user'          => $user,
            'roles'         =>  $this->roles,
            'title'         =>  "Modifier l'utilisateur : ".$user->name
        ]);
    }



    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                "name"          => ["required",Rule::unique('users' , 'name')->ignore($user->id),"string" , "min:5"],
                "email"         => ["required" ,Rule::unique('users' , 'email')->ignore($user->id) , "email" ]
            ]);

        $data = $request->except(["_method" , "_token"]);
        try {
            $user->update([
                "name" => $data['name'],
                "email" => $data['email'],
                "password" => $data["password"] ?  bcrypt($data['password']) : $user->password,
            ]);
            if(!empty($data['roles']))
                $user->syncRoles($data["roles"]);
            flash("L'utilisateur " . $user->name ." a été modifié avec succès" , ['alert alert-success alert-dismissible']);
            return redirect()->route('users.index');
        }catch (\PDOException | RoleAlreadyExists $exception)
        {
            flash("L'utilisateur n'a pas été modifié, vérifiez les champs insérés" , ['alert alert-danger alert-dismissible']);
            return redirect()->back();
        }
    }



    public function destroy(User $user)
    {
        try{
            $user->delete();
            flash("L'utilisateur a été supprimé avec succès" , ['alert alert-success alert-dismissible']);
            return redirect()->route('users.index');
        }catch (\PDOException  $exception)
        {
            flash("Problème de supréssion , entité peut etre utilisée autre part " , ['alert alert-danger alert-dismissible']);
            return redirect()->back();}
    }
}
