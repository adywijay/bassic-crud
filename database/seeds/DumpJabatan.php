<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DumpJabatan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            [
                'jabatan_code' => "CEO",
                'jabatan_name' => "Chief Executive Officer",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'jabatan_code' => "CFO",
                'jabatan_name' => "Chief Financial Officer",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'jabatan_code' => "COO",
                'jabatan_name' => "Chief Operation Officer",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'jabatan_code' => "CTO",
                'jabatan_name' => "Chief Technology Officer",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'jabatan_code' => "IT-Dev.Jr",
                'jabatan_name' => "IT-Developer.Junior",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'jabatan_code' => "IT-Dev.Mr",
                'jabatan_name' => "IT-Developer.Middle",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'jabatan_code' => "IT-Dev.Sr",
                'jabatan_name' => "IT-Developer.Senior",
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
        ]);
    }
}