<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DumpRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role_name' => "Dept#MGT-WC@MASTER-Group",
                'role_desc' => "Departement Management Content web & Master Groups",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'role_name' => "Dept@CE-Group",
                'role_desc' => "Departement Chief Excecutive Groups",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'role_name' => "Dept@IT-Group",
                'role_desc' => "Departement Information Technology Groups",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'role_name' => "Dept@HR/GA-Group",
                'role_desc' => "Departement Human Resource / General Affairs Groups",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'role_name' => "Dept@CS-Group",
                'role_desc' => "Departement Customer Service Groups",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'role_name' => "Dept@SECG-Group",
                'role_desc' => "Departement Security General Groups",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'role_name' => "Dept@MNG-Group",
                'role_desc' => "Departement Team Management Groups",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'role_name' => "BSC@AC-Group",
                'role_desc' => "Bassic of Access Groups",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
        ]);
    }
}