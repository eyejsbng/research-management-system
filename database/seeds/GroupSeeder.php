<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'grp_title' => 'No Group',
            'grp_code' => 'dummy101',
            'gs_id' => 3,
            'crs_id' => 1,
        ]);
    }
}
