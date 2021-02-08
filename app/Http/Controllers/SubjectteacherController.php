<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SubjectteacherController extends Controller
{
    function Dashboard($id){
        $student = 0;
        $groups = [];
        $section = DB::table('s_t_sections')
                      ->where('user_id', $id)
                      ->get();

        if ($section->count() > 0) {
            $student = DB::table('users')
                        ->where('sec_id', $section[0]->sec_id)
                        ->get();
            $groups = DB::table('groups')
                        ->where('sec_id', $section[0]->sec_id)
                        ->get();
        }

        return ['student' => $student->count(), 'section' => $section->count(), 'groups' => $groups->count()];
    }
}
