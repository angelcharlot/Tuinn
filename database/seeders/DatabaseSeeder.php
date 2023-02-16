<?php

namespace Database\Seeders;

use App\Models\alargeno;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $role1=Role::create(['name' => 'admin']);
        Role::create(['name' => 'camarero']);
        Role::create(['name' => 'cocinero']);

        //asignar permisos a admin
        $Permission1 = Permission::create(['name' => 'config.negocio'])->assignRole($role1);//linl de panel o dasboart


        //1
        $alargenico=new alargeno();
        $alargenico->name="Altramuz";
        $alargenico->img="images/Altramuz.png";
        $alargenico->save();

         //2
         $alargenico=new alargeno();
         $alargenico->name="Apio";
         $alargenico->img="images/Apio.png";
         $alargenico->save();

          //3
        $alargenico=new alargeno();
        $alargenico->name="Cacahuetes";
        $alargenico->img="images/Cacahuetes.png";
        $alargenico->save();

         //4
         $alargenico=new alargeno();
         $alargenico->name="Crustaceos";
         $alargenico->img="images/Crustaceos.png";
         $alargenico->save();

          //5
        $alargenico=new alargeno();
        $alargenico->name="Frutos secos";
        $alargenico->img="images/Frutos_secos.png";
        $alargenico->save();

         //6
         $alargenico=new alargeno();
         $alargenico->name="Huevos";
         $alargenico->img="images/Huevos.png";
         $alargenico->save();

          //7
        $alargenico=new alargeno();
        $alargenico->name="Lácteos";
        $alargenico->img="images/Lácteos.png";
        $alargenico->save();

         //8
         $alargenico=new alargeno();
         $alargenico->name="Moluscos";
         $alargenico->img="images/Moluscos.png";
         $alargenico->save();

          //9
        $alargenico=new alargeno();
        $alargenico->name="Mostaza";
        $alargenico->img="images/Mostaza.png";
        $alargenico->save();

         //10
         $alargenico=new alargeno();
         $alargenico->name="Pescado";
         $alargenico->img="images/Pescado.png";
         $alargenico->save();

          //11
        $alargenico=new alargeno();
        $alargenico->name="Soja";
        $alargenico->img="images/Soja.png";
        $alargenico->save();

         //12
         $alargenico=new alargeno();
         $alargenico->name="Sulfitos";
         $alargenico->img="images/Sulfitos.png";
         $alargenico->save();

          //13
        $alargenico=new alargeno();
        $alargenico->name="Gluten";
        $alargenico->img="images/Gluten.png";
        $alargenico->save();

         //14
         $alargenico=new alargeno();
         $alargenico->name="Sésamo";
         $alargenico->img="images/Sésamo.png";
         $alargenico->save();


        
       
    }
}
