<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Configuration;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            WilayaSeeder::class,
            DairaSeeder::class,
        ]);

        $web_guard_permissions = [
            "user-create", "user-edit", "user-delete", "user-index",
            "service-create", "service-edit", "service-delete", "service-index",
            "patient-create", "patient-edit", "patient-delete", "patient-index",
            "appoin-create", "appoin-edit", "appoin-delete", "appoin-index",
            "healthcare-entity-create", "healthcare-entity-edit", "healthcare-entity-delete", "healthcare-entity-index",
            "edit-config"
        ];

        foreach ($web_guard_permissions as $web_guard_permission)
            Permission::create(["name" => $web_guard_permission, "guard_name" => "web"]);


        $superRole = Role::create(["name"       => "super-admin", "guard_name" => "web",]);
        $superRole->givePermissionTo(Permission::where("guard_name" , "web")->get());

         $s_user = \App\Models\User::factory()->create([
                'name'      => 'WebDev',
                'email'     => 'abderraoufdjebel@gmail.com',
                'password'  => bcrypt("0000")
         ]);
         $s_user->assignRole($superRole);


         $config = Configuration::create([
             'site_title'   => 'Chahboub Med',
             'site_slogan'  => 'Platforme pour le suivi et la prise en ligne des rendez-vous',
             'site_phones'  => '0664866225',
             'site_email'   => 'abderraoufdjebel@gmail.com'
         ]);
    }
}
