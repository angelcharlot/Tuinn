<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class role extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dato=[
            [
                'name'=>'admin',
                'guard_name'=>'web',
                
            ],
            [
                'name'=>'cocinero',
                'guard_name'=>'web',
                
            ],
            [
                'name'=>'camarero',
                'guard_name'=>'web',
                
            ],
        ];
        DB::table('roles')->insert($dato);
    }
}
