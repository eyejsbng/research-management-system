<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Mail\EmailConfirmation;
use App\Mail\EmailCreation;
class AdminController extends Controller
{
    function Dashboard(){
        $student = DB::table('users')
                     ->where('typ_id', 3)
                     ->where('id', '!=', 2)
                     ->get();

        $adviser = DB::table('users')
                     ->where('typ_id', 2)
                     ->orWhere('typ_id', 6)
                     ->get();

        $st = DB::table('users')
                ->where('typ_id', 4)
                ->get();

        $panel = DB::table('users')
                   ->where('typ_id',5)
                   ->orWhere('typ_id', 6)
                   ->get();

        $group = DB::table('groups')
                   ->where('grp_id', '!=' , 1)
                   ->get();

        $archived = DB::table('researchfiles')
                      ->get();

        $sched = DB::table('calendars')
                    ->whereDay('start_date','=',date('d'))
                    ->whereMonth('start_date','=',date('m'))
                    ->whereYear('start_date', '=', date('Y'))
                    ->select('calendars.*')
                    ->get();

        $c1 = DB::table('groups')
                ->join('courses', 'groups.crs_id', 'courses.crs_id')
                ->join('scheduletypes', 'groups.readyfor', 'scheduletypes.styp_id')
                ->select('groups.*', 'courses.crs_id', 'courses.crs_title', 'scheduletypes.styp_id', 'scheduletypes.styp_title')
                ->whereIn('grp_standing', [0,1])
                ->where('grp_id', '!=', 1)
                ->get();

        $c2 = DB::table('groups')
                ->join('courses', 'groups.crs_id', 'courses.crs_id')
                ->join('scheduletypes', 'groups.readyfor', 'scheduletypes.styp_id')
                ->select('groups.*', 'courses.crs_id', 'courses.crs_title', 'scheduletypes.styp_id', 'scheduletypes.styp_title')
                ->where('grp_standing', 2)
                ->where('grp_id', '!=', 1)
                ->get();

        $c3 = DB::table('groups')
                ->join('courses', 'groups.crs_id', 'courses.crs_id')
                ->join('scheduletypes', 'groups.readyfor', 'scheduletypes.styp_id')
                ->select('groups.*', 'courses.crs_id', 'courses.crs_title', 'scheduletypes.styp_id', 'scheduletypes.styp_title')
                ->where('grp_standing', 3)
                ->where('grp_id', '!=', 1)
                ->get();

        return response()->JSON([
                'student'=> $student->count(),
                'adviser' => $adviser->count(),
                'st' => $st->count(),
                'panel' => $panel->count(),
                'group' => $group->count(),
                'archived' => $archived->count(),
                'sched' => $sched->count(),
                'c1' => $c1,
                'c2' => $c2,
                'c3' => $c3
            ],200);
    }
    function Dependencies(){
        $schedType = DB::table('scheduletypes')
                       ->where('styp_id','>',1)
                       ->get();
        $defStatus = DB::table('defense_status')
                       ->get();
        $studCourse = DB::table('courses')
                        ->get();
        $userStatus = DB::table('user_status')
                        ->get();
        $userTypes = DB::table('usertypes')
                        ->whereIn('typ_id', [2,5,6])
                        ->get();

        return response()->JSON([
            'schedType' => $schedType,
            'defStatus' => $defStatus,
            'studCourse' => $studCourse,
            'userStatus' => $userStatus,
            'userTypes' => $userTypes,
        ],200);
    }
    function AdviserList(){
        $list = DB::table('users')
                  ->join('usertypes', 'users.typ_id', 'usertypes.typ_id')
                  ->select('users.id', 'users.name', 'users.specialty','usertypes.typ_title')
                  ->whereIn('users.typ_id', [1,2,4,6])
                  ->get();
        return ['adviser' => $list];
    }
    function PanelList(){
        $list = DB::table('users')
                ->join('usertypes', 'users.typ_id', 'usertypes.typ_id')
                ->select('users.id', 'users.name', 'users.specialty','usertypes.typ_title')
                ->whereIn('users.typ_id', [1,4,5,6])
                ->get();

        return ['panel' => $list];
    }
    function Getc3List(){
        $list = DB::table('groups')
                    ->join('courses', 'groups.crs_id', 'courses.crs_id')
                    ->join('scheduletypes', 'groups.readyfor', 'scheduletypes.styp_id')
                    ->select('groups.*', 'courses.crs_id', 'courses.crs_title', 'scheduletypes.styp_id', 'scheduletypes.styp_title')
                    ->where('grp_standing', 3)
                    ->where('grp_id', '!=', 1)
                    ->where('isuploaded', 0)
                    ->get();

        return $list;
    }
    function GetArchivedGroupID(){
        $id = DB::table('researhfilegroups')
                ->get();


        return  $id->count();
    }
    function GetArchivedGroupName($groupname){
        $gname = DB::table('researhfilegroups')
                ->where('rfg_groupName', $groupname)
                ->get();

        return $gname->count();
    }
    function CreateArchiveResearch(Request $request){
        $message = '';
        $rfgID = '';
        $this->validate($request, [
            'title' => 'required',
            'groupname' => 'required',
            'author1' => 'required',
            'adviser' => 'required',
            'year' => 'required',
            'course' => 'required',
            'file' => 'required',
        ]);

        $rfg = DB::table('researhfilegroups')
                ->insert([
                    'rfg_groupName' => $request->groupname,
                    'rfg_author1' => $request->author1,
                    'rfg_author2' => $request->author2,
                    'rfg_author3' => $request->author3,
                    'rfg_author4' => $request->author4,
                    'rfg_adviser' => $request->adviser
                ]);
        if ($rfg) {
            $rfgID = $this->GetArchivedGroupID();
            $gname = $this->GetArchivedGroupName($request->groupname);
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = $request->groupname.$gname.'.'.$ext;
            if (Storage::disk('myfiles')->putFileAs('Files/Doneresearch/', $file, $name)) {
                $research = DB::table('researchfiles')
                                ->insert([
                                    'res_title' => $request->title,
                                    'rfg_id' => $rfgID,
                                    'crs_id' => $request->course,
                                    'res_ysdate' => $request->year,
                                    'res_file' => $name,
                                ]);
                if ($research) {
                    DB::table('groups')
                        ->where('grp_id', $request->grp_id)
                        ->update([
                            'isuploaded' => 1
                        ]);
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try to refresh';
                }
            }
        }
        return ['message' => $message];
    }
    function UpdateArchiveResearch(Request $request){
        $message = '';
        $rfgID = '';
        $this->validate($request, [
            'title' => 'required',
            'groupname' => 'required',
            'author1' => 'required',
            'adviser' => 'required',
            'year' => 'required',
            'course' => 'required',
        ]);

        $rfg = DB::table('researhfilegroups')
                ->where('rfg_id', $request->id)
                ->update([
                    'rfg_groupName' => $request->groupname,
                    'rfg_author1' => $request->author1,
                    'rfg_author2' => $request->author2,
                    'rfg_author3' => $request->author3,
                    'rfg_author4' => $request->author4,
                    'rfg_adviser' => $request->adviser
                ]);
        $name = $request->filename;
        if ($request->file == '') {
            $research = DB::table('researchfiles')
                            ->where('res_id', $request->id)
                            ->update([
                                'res_title' => $request->title,
                                'crs_id' => $request->course,
                                'res_ysdate' => $request->year,
                                'res_file' => $name,
                            ]);
            if ($research) {
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try to refresh';
            }
        }
        else{
            $file = $request->file('file');
            if (Storage::disk('myfiles')->putFileAs('Files/Doneresearch/', $file, $name)) {
                $research = DB::table('researchfiles')
                                ->where('res_id', $request->id)
                                ->update([
                                    'res_title' => $request->title,
                                    'crs_id' => $request->course,
                                    'res_ysdate' => $request->year,
                                    'res_file' => $name,
                                ]);
                if ($research) {
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try to refresh';
                }
            }
        }

        return ['message' => $message];
    }
    function Archiveresearch(){
        return DB::table('researchfiles')
                ->join('researhfilegroups', 'researchfiles.rfg_id', '=', 'researhfilegroups.rfg_id')
                ->join('courses', 'researchfiles.crs_id', '=', 'courses.crs_id')
                ->select('researchfiles.*', 'researhfilegroups.*', 'courses.*')
                ->latest('res_ysdate')
                ->paginate(10);
    }
    function ArchivedSearch(){
        $countSearch;
        $countResearch;
        $percent;
        $research = DB::table('researchfiles')->select('researchfiles.*')->get();
        $countResearch = $research->count();
        if ($search = \Request::get('q')) {
            $files = DB::table('researchfiles')
                        ->join('researhfilegroups', 'researchfiles.rfg_id', '=', 'researhfilegroups.rfg_id')
                        ->join('courses', 'researchfiles.crs_id', '=', 'courses.crs_id')
                        ->select('researchfiles.*', 'researhfilegroups.*', 'courses.*')
                        ->where('res_title', 'LIKE', "%$search%")
                        // ->where('res_ysdate',)
                        ->latest('res_ysdate')
                        ->paginate(6);
            $countSearch = $files->count();
            $percent = ($countSearch / $countResearch) * 100;
        }
        else{
            $files =  DB::table('researchfiles')
                ->join('researhfilegroups', 'researchfiles.rfg_id', '=', 'researhfilegroups.rfg_id')
                ->join('courses', 'researchfiles.crs_id', '=', 'courses.crs_id')
                ->select('researchfiles.*', 'researhfilegroups.*', 'courses.*')
                ->latest('res_ysdate')
                ->paginate(6);
                $countSearch = $files->count();
                $percent = ($countSearch / $countResearch) * 100;
        }

        return ['files'=>$files, 'countSearch' => $countSearch, 'countResearch' => $countResearch];
    }

    function GetGroupsforDefense($id){
        $groups = '';
        if($id == 2 || $id == 3){
            $groups = DB::table('groups')
                        ->whereIn('grp_standing', [0,1])
                        ->where('grp_id', '!=', 1)
                        ->select('groups.grp_id', 'groups.grp_title')
                        ->get();
        }
        else{
            $groups = DB::table('groups')
                        ->where('grp_standing', 2)
                        ->where('grp_id', '!=', 1)
                        ->select('groups.grp_id', 'groups.grp_title')
                        ->get();
        }

        return ['groups' => $groups];
    }
    function CreateDefenseSchedule(Request $request){
        $message = '';
        $check = DB::table('tbl_defenseschedule')
                    ->where('def_grp' , $request->group)
                    ->where('def_type', $request->type)
                    ->whereIn('def_status', [1,3,4])
                    ->get();
        $checkSched = DB::table('tbl_defenseschedule')
                        ->where('def_grp' , $request->group)
                        ->where('def_type', $request->type - 1)
                        ->whereIn('def_status', [3,4])
                        ->get();
        $checkPanel = DB::table('panel_defenses')
                        ->where('grp_id', $request->group)
                        ->where('us_id', 1)
                        ->get();
        $checkAdviser = DB::table('advisergroups')
                          ->where('grp_id', $request->group)
                          ->where('us_id', 1)
                          ->get();
        $checkAvailabilty = DB::table('tbl_defenseschedule')
                            ->where('def_type', $request->type)
                            ->where('def_date', $request->date)
                            ->where('def_etime', $request->etime)
                            ->where('def_status', 1)
                            ->get();
        $this->validate($request, [
            'type' => 'required',
            'group' => 'required',
            'date' => 'required',
            'stime' => 'required',
            'etime' => 'required',
            'venue' => 'required',
            'status' => 'required'
        ]);
        if($check->count() > 0){
            return ['message' => 'Groups Defense Schedule Already Created.'];
        }
        else if($request->type > 2 && $checkSched->count() == 0){
            return ['message' => 'Groups Defense Schedule are not Applicable.'];
        }
        else if($checkAdviser->count() != 1){
            return ['message' => 'Assign Adviser first to the Group.'];
         }
        else if($checkPanel->count() != 3){
           return ['message' => 'Assign Panels first to the Group. <br> Make sure Panels Accept the group.'];
        }
        else if($checkAvailabilty->count() > 0){
            return ['message' => 'Time not available.'];
        }
        $sched = DB::table('tbl_defenseschedule')
                        ->insert([
                            'def_type' => $request->type,
                            'def_grp' => $request->group,
                            'def_date' => $request->date,
                            'def_stime' => $request->stime,
                            'def_etime' => $request->etime,
                            'def_status' => $request->status,
                            'def_address' => $request->venue
                        ]);
        if($sched){
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong. Try again later.';
        }

        return ['message' => $message];
    }
    function UpdateDefenseSchedule(Request $request){
        $message = '';
        $this->validate($request, [
            'type' => 'required',
            'date' => 'required',
            'stime' => 'required',
            'etime' => 'required',
            'venue' => 'required',
            'status' => 'required'
        ]);
        $update = DB::table('tbl_defenseschedule')
                    ->where('def_id', $request->def_id)
                    ->update([
                        'def_type' => $request->type,
                        'def_date' => $request->date,
                        'def_stime' => $request->stime,
                        'def_etime' => $request->etime,
                        'def_status' => $request->status,
                        'def_address' => $request->venue
                    ]);
        if($update){
            if ($request->status == 3 || $request->status == 4) {
                if ($request->type == 2 || $request->type == 3) {
                    if ($request->type == 3) {
                        DB::table('groups')
                            ->where('grp_id', $request->group)
                            ->update([
                                'grp_standing' => 1,
                                'readyfor' => $request->type
                            ]);
                    }
                        DB::table('titleoutlineminutes')
                        ->insert([
                            'deftype_id' => $request->type
                        ]);
                        DB::table('minutes')
                        ->insert([
                            'min_status' => $request->status,
                            'grp_id' => $request->group,
                            'min_date' => $request->date,
                            'min1_id' => $this->getTitleOutlineID(),
                        ]);
                }
                else{
                    $min2 = $this->getFinalID();
                    DB::table('finalminutes')
                    ->insert([
                        'min2_id' => $min2
                    ]);
                    DB::table('minutes')
                    ->insert([
                        'min_status' => $request->status,
                        'grp_id' => $request->group,
                        'min_date' => $request->date,
                        'min2_id' => $min2
                    ]);
                }
            }
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong. Try again later.';
        }

        return ['message' => $message];

    }
    function GetDefenseSchedule(){
        $sched = DB::table('tbl_defenseschedule')
                    ->join('groups', 'tbl_defenseschedule.def_grp', 'groups.grp_id')
                    ->join('defense_status', 'tbl_defenseschedule.def_status', 'defense_status.ds_id')
                    ->join('scheduletypes', 'tbl_defenseschedule.def_type', 'scheduletypes.styp_id')
                    ->select('tbl_defenseschedule.*', 'groups.grp_id','groups.grp_title','defense_status.*','scheduletypes.*')
                    ->latest('tbl_defenseschedule.def_date')
                    ->paginate(6);
        return ['sched' => $sched];
    }
    function SearchDefenseSchedule(Request $request){
        if ($request->grp == '') {
            return $this->GetDefenseSchedule();
        }
        else{
            $sched = DB::table('tbl_defenseschedule')
                    ->join('groups', 'tbl_defenseschedule.def_grp', 'groups.grp_id')
                    ->join('defense_status', 'tbl_defenseschedule.def_status', 'defense_status.ds_id')
                    ->join('scheduletypes', 'tbl_defenseschedule.def_type', 'scheduletypes.styp_id')
                    ->select('tbl_defenseschedule.*', 'groups.grp_id','groups.grp_title','defense_status.*','scheduletypes.*')
                    ->where('groups.grp_title','LIKE', "%$request->grp%")
                    ->where('tbl_defenseschedule.def_type', $request->type)
                    ->paginate(6);
        }

        return ['sched' => $sched];
    }
    function GetMinutes(Request $request){
        $sched = '';
        $sched2 = '';
        $minutes = '';
        $message = '';
        if ($request->type == '' && $request->grp != '') {
            if ($request->isCaps1 == 1) {
                $sched = DB::table('minutes')
                    ->join('defense_status', 'minutes.min_status', 'defense_status.ds_id')
                    ->join('titleoutlineminutes', 'minutes.min1_id', 'titleoutlineminutes.min1_id')
                    ->join('scheduletypes', 'titleoutlineminutes.deftype_id', 'scheduletypes.styp_id')
                    ->join('groups', 'minutes.grp_id', 'groups.grp_id')
                    ->select('minutes.*','titleoutlineminutes.*', 'defense_status.ds_title', 'groups.*', 'scheduletypes.styp_title')
                    ->where('minutes.grp_id', $request->grp)
                    ->get();
                $sched2 = DB::table('minutes')
                    ->join('defense_status', 'minutes.min_status', 'defense_status.ds_id')
                    ->join('finalminutes', 'minutes.min2_id', 'finalminutes.min2_id')
                    ->join('groups', 'minutes.grp_id', 'groups.grp_id')
                    ->select('minutes.*','finalminutes.*', 'defense_status.ds_title', 'groups.*')
                    ->where('minutes.grp_id', $request->grp)
                    ->get();
            }
            else{
                $sched = DB::table('minutes')
                    ->join('defense_status', 'minutes.min_status', 'defense_status.ds_id')
                    ->join('finalminutes', 'minutes.min2_id', 'finalminutes.min2_id')
                    ->join('groups', 'minutes.grp_id', 'groups.grp_id')
                    ->select('minutes.*','finalminutes.*', 'defense_status.ds_title', 'groups.*')
                    ->where('minutes.grp_id', $request->grp)
                    ->get();
            }
        }
        else if($request->type == '' && $request->grp == ''){
            $sched = DB::table('minutes')
                    ->join('defense_status', 'minutes.min_status', 'defense_status.ds_id')
                    ->join('titleoutlineminutes', 'minutes.min1_id', 'titleoutlineminutes.min1_id')
                    ->join('scheduletypes', 'titleoutlineminutes.deftype_id', 'scheduletypes.styp_id')
                    ->join('groups', 'minutes.grp_id', 'groups.grp_id')
                    ->select('minutes.*','titleoutlineminutes.*', 'defense_status.ds_title', 'groups.*', 'scheduletypes.styp_title')
                    ->paginate(8);
            $sched2 = DB::table('minutes')
                    ->join('defense_status', 'minutes.min_status', 'defense_status.ds_id')
                    ->join('finalminutes', 'minutes.min2_id', 'finalminutes.min2_id')
                    ->join('groups', 'minutes.grp_id', 'groups.grp_id')
                    ->select('minutes.*','finalminutes.*', 'defense_status.ds_title', 'groups.*')
                    ->paginate(8);
        }
        else{
            if ($request->isCaps1 == 1) {
                $sched = DB::table('minutes')
                      ->join('defense_status', 'minutes.min_status', 'defense_status.ds_id')
                      ->join('titleoutlineminutes', 'minutes.min1_id', 'titleoutlineminutes.min1_id')
                      ->select('minutes.*','titleoutlineminutes.*', 'defense_status.ds_title')
                      ->where('minutes.grp_id', $request->grp)
                      ->where('titleoutlineminutes.deftype_id', $request->type)
                      ->get();
                if ($sched->count() == 0) {
                    $message = 'No Data';
                }
            }
        }
        return ['sched' => $sched, 'sched2' => $sched2, 'message' => $message];
    }
    function CreateTitleOutlineMinutes(Request $request){
        $message = '';
        if ($request->grp_id == '') {
            return ['message' => 'No Data Found'];
        }
        $minutes = DB::table('minutes')
                     ->where('min_id', $request->min_id)
                     ->update([
                         'min_DocumentFormat' => $request->min_DocumentFormat,
                         'min_references' => $request->min_references,
                         'min_others' => $request->min_others,
                     ]);
        $titleoutline = DB::table('titleoutlineminutes')
                        ->where('min1_id', $request->min1_id)
                        ->update([
                            'min1_title' => $request->min1_title,
                            'min1_IP' => $request->min1_IP,
                            'min1_PD' => $request->min1_PD,
                            'min1_OG' => $request->min1_OG,
                            'min1_specific' => $request->min1_specific,
                            'min1_rrl' => $request->min1_rrl,
                            'min1_tb' => $request->min1_tb,
                        ]);
        if ($minutes && $titleoutline) {
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong. Try again later.';
        }

        return ['message' => $message];
    }
    function getTitleOutlineID(){
        $data = DB::table('titleoutlineminutes')
                    ->get();

        return $data->count();
    }
    function CreateFinalMinutes(Request $request){
        $message = '';
        if ($request->grp_id == '') {
            return ['message' => 'No Data Found'];
        }
        $minutes = DB::table('minutes')
                     ->where('min_id', $request->min_id)
                     ->update([
                         'min_DocumentFormat' => $request->min_DocumentFormat,
                         'min_references' => $request->min_references,
                         'min_others' => $request->min_others,
                     ]);
        $finalminutes = DB::table('finalminutes')
                        ->where('min2_id', $request->min2_id)
                        ->update([
                            'min2_chapter1' => $request->min2_chapter1,
                            'min2_chapter2' => $request->min2_chapter2,
                            'min2_chapter3' => $request->min2_chapter3,
                            'min2_methodology' => $request->min2_methodology,
                            'min2_RD' => $request->min2_RD,
                            'min2_conclusion' => $request->min2_conclusion,
                            'min2_recommendation' => $request->min2_recommendation,
                            'min2_AS' => $request->min2_AS
                        ]);

        if ($minutes && $finalminutes) {
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong. Try again later.';
        }
        return ['message' => $message];
    }
    function getFinalID(){
        $data = DB::table('finalminutes')
                    ->get();

        return $data->count() + 1;
    }
    function GetMessenger(Request $request){
        $user = '';
        $group = '';
        if($request->typ == 1){
            $user = DB::table('users')
                        ->join('usertypes','users.typ_id', 'usertypes.typ_id')
                        ->join('groups', 'users.grp_id','groups.grp_id')
                        ->select('users.name','users.id','usertypes.typ_title')
                        ->where('id', '!=', $request->id)
                        ->where('id', '!=', 2)
                        ->where('groups.isDone', 0)
                        ->get();
            $group = DB::table('groups')
                        ->join('courses', 'groups.crs_id', 'courses.crs_id')
                        ->select('groups.*','courses.crs_title')
                        ->where('groups.grp_id','!=', 1)
                        ->where('groups.isDone', 0)
                        ->get();
        }
        else if($request->typ == 2){
            $user = DB::table('advisergroups')
                      ->join('groups', 'advisergroups.grp_id', 'groups.grp_id')
                      ->join('users', 'groups.grp_id' ,'users.grp_id')
                      ->join('usertypes','users.typ_id', 'usertypes.typ_id')
                      ->select('users.name','users.id','usertypes.typ_title')
                      ->where('groups.isDone', 0)
                      ->where('advisergroups.id', $request->id)
                      ->get();
            $group = DB::table('advisergroups')
                      ->join('groups', 'advisergroups.grp_id', 'groups.grp_id')
                      ->join('courses', 'groups.crs_id', 'courses.crs_id')
                      ->select('groups.*','courses.crs_title')
                      ->where('advisergroups.id', $request->id)
                      ->where('groups.isDone', 0)
                      ->get();
        }
        else if($request->typ == 3){
            $user = DB::table('users')
                       ->join('usertypes','users.typ_id', 'usertypes.typ_id')
                       ->select('users.name','users.id','usertypes.typ_title')
                       ->where('id', 1)
                       ->orWhere('grp_id', $request->grp)
                       ->where('id', '!=', $request->id)
                       ->get();

            $group = DB::table('groups')
                        ->join('courses', 'groups.crs_id', 'courses.crs_id')
                        ->select('groups.*','courses.crs_title')
                        ->where('groups.grp_id', $request->grp)
                        ->get();
        }


        return ['users' => $user, 'groups' => $group];
    }

    // Student functions
    function AllStudent(){
        $student = DB::table('users')
                     ->join('courses', 'users.crs_id', 'courses.crs_id')
                     ->join('groups', 'users.grp_id', 'groups.grp_id')
                     ->join('user_status', 'users.us_id', 'user_status.us_id')
                     ->select('users.*', 'courses.crs_id','courses.crs_title','groups.grp_id','groups.grp_title','user_status.us_id','user_status.us_title')
                     ->where('typ_id', 3)
                     ->where('id', '!=', 2)
                     ->paginate(5);

        return response()->JSON(['student' => $student], 200);

    }
    function SearchStudent(Request $request){
        if($request->search == ''){
            return $this->AllStudent();
        }
        else{
            $student = DB::table('users')
                        ->join('courses', 'users.crs_id', 'courses.crs_id')
                        ->join('groups', 'users.grp_id', 'groups.grp_id')
                        ->join('user_status', 'users.us_id', 'user_status.us_id')
                        ->select('users.*', 'courses.crs_id','courses.crs_title','groups.grp_id','groups.grp_title','user_status.us_id','user_status.us_title')
                         ->where('users.typ_id', 3)
                         ->where('users.crs_id', $request->course)
                         ->where('users.us_id', $request->status)
                         ->where('users.name','LIKE', "%$request->search%")
                         ->paginate(5);

            return response()->JSON(['student' => $student], 200);

        }

    }
    function CreateStudent(Request $request){
        $message = '';
        $email = DB::table('users')->where('email', $request->email)->get();
        if($email->count() > 0){
            $message = 'Email Already taken.';
        }
        else{
            $stud = DB::table('users')
                      ->insert([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => Hash::make($request->password),
                        'crs_id' => $request->crs_id,
                        'typ_id' => 3,
                        'us_id' => 1
                      ]);
            if($stud){
                $email = $request->email;
                $messageData = ['email'=>$request->email, 'name'=>$request->name, 'password'=>$request->password];
                // Mail::send('pages.registeremail', $messageData, function($message) use($email){
                //     $message->to($email)->subject('Account Registered in CCERMS');
                // });
                // Mail::to($request->email)->send(new EmailCreation($messageData));
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong';
            }
        }

        return ['message' => $message];
    }
    function UpdateStudent(Request $request){
        $message = '';
        if($request->type == 'approval'){
            $stud = DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'us_id' => $request->us_id
                ]);

            if($stud){
                $email = $request->email;
                $messageData = ['email'=> $request->email, 'name'=> $request->name, 'us_id' => $request->us_id, 'type' => $request->type];
                // Mail::send('pages.email', $messageData, function($message) use($email){
                //     $message->to($email)->subject('Account Approved in CCERMS');
                // });
                // Mail::to($email)->send(new EmailConfirmation($messageData));
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong';
            }

            return ['message' => $message];
        }
        else if($request->type == 'update'){
            $message = '';
            $email = DB::table('users')->where('id', '!=', $request->id)->where('email', $request->email)->get();
            if($email->count() > 0){
                $message = 'Email Already Exist';
            }
            else{
                if($request->password == ''){
                    $student = DB::table('users')->where('id', $request->id)
                                 ->update([
                                    'name' => $request->name,
                                    'email' => $request->email,
                                    'crs_id' => $request->crs_id
                                 ]);
                    if($student){
                        $email = $request->email;
                        $messageData = ['email'=> $request->email, 'name'=> $request->name,'password' => $request->password,'type' => $request->type];
                        // Mail::send('pages.email', $messageData, function($message) use($email){
                        //     $message->to($email)->subject('Account Updated in CCERMS');
                        // });
                        // Mail::to($request->email)->send(new EmailConfirmation($messageData));
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong';
                    }
                }
                else{
                    $student = DB::table('users')->where('id', $request->id)
                                 ->update([
                                    'name' => $request->name,
                                    'email' => $request->email,
                                    'password' => Hash::make($request->password),
                                    'crs_id' => $request->crs_id
                                 ]);
                    if($student){
                        $email = $request->email;
                        $messageData = ['email'=> $request->email, 'name'=> $request->name,'password' => $request->password,'type' => $request->type];
                        // Mail::send('pages.email', $messageData, function($message) use($email){
                        //     $message->to($email)->subject('Account Updated in CCERMS');
                        // });
                        // Mail::to($request->email)->send(new EmailConfirmation($messageData));
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong';
                    }
                }
            }
            return ['message' => $message];
        }

    }

    // st functions
    function AllST(){
        $st = DB::table('users')
                ->join('user_status', 'users.us_id', 'user_status.us_id')
                ->select('users.*','user_status.*')
                ->where('users.typ_id', 4)
                ->paginate(5);

        return ['st' => $st];
    }

    function CreateST(Request $request){
        $message = '';
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
        ]);

        $st = DB::table('users')->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'specialty' => $request->specialty,
                    'crs_id' => 1,
                    'typ_id' => 4,
                    'us_id' => 1,
                ]);
        if($st){
            $email = $request->email;
            $messageData = ['email'=>$request->email, 'name'=>$request->name, 'password'=>$request->password];
            // Mail::send('pages.registeremail', $messageData, function($message) use($email){
            //     $message->to($email)->subject('Account Registered in CCERMS');
            // });
            // Mail::to($request->email)->send(new EmailCreation($messageData));
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong. try again later';
        }
        return ['message' => $message];
    }
    function UpdateST(Request $request){
        $message = '';
        if($request->type == 'update'){
            $email = DB::table('users')
                        ->where('id', '!=', $request->id )
                        ->where('email', $request->email)
                        ->get();
            if($email->count() > 0){
                $message = 'Email Already taken.';
            }
            else{
                $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'specialty' => 'required|string|max:255',
                ]);
                if($request->password == ''){
                    $st = DB::table('users')->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'specialty' => $request->specialty
                        ]);
                    if($st){
                        $email = $request->email;
                        $messageData = ['email'=> $request->email, 'name'=> $request->name,'password' => $request->password,'type' => $request->type];
                        // Mail::send('pages.email', $messageData, function($message) use($email){
                        //     $message->to($email)->subject('Account Updated in CCERMS');
                        // });
                        // Mail::to($request->email)->send(new EmailConfirmation($messageData));
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later';
                    }
                }
                else{
                    $st = DB::table('users')->where('id', $request->id)
                        ->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'password' => Hash::make($request->password),
                            'specialty' => $request->specialty
                        ]);
                    if($st){
                        $email = $request->email;
                        $messageData = ['email'=> $request->email, 'name'=> $request->name,'password' => $request->password,'type' => $request->type];
                        // Mail::send('pages.email', $messageData, function($message) use($email){
                        //     $message->to($email)->subject('Account Updated in CCERMS');
                        // });
                        // Mail::to($request->email)->send(new EmailConfirmation($messageData));
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later';
                    }
                }
            }
            return ['message' => $message];
        }
        else if($request->type == 'approval'){
            $id = DB::table('users')->where('id', $request->id)->get();
            if($id->count() > 0){
                $st = DB::table('users')->where('id', $request->id)
                        ->update([
                            'us_id' => $request->us_id
                        ]);
                if($st){
                    $email = $request->email;
                    $messageData = ['email'=> $request->email, 'name'=> $request->name, 'us_id' => $request->us_id, 'type' => $request->type];
                    // Mail::send('pages.email', $messageData, function($message) use($email){
                    //     $message->to($email)->subject('Account Approved in CCERMS');
                    // });
                    // Mail::to($request->email)->send(new EmailConfirmation($messageData));
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try again later';
                }
            }
            return ['message' => $message];
        }
    }
    function SearchST(Request $request){
        if($request->search == ''){
            return $this->AllST();
        }
        else{
           $st =  DB::table('users')
                ->join('user_status', 'users.us_id', 'user_status.us_id')
                ->select('users.*','user_status.*')
                ->where('users.typ_id', 4)
                ->where('users.us_id', $request->status)
                ->where('users.name','LIKE', "%$request->search%")
                ->paginate(5);

            return ['st' => $st];
        }
    }
    //RP Functions
    function AllRP(){
        $rp = DB::table('users')
                ->join('usertypes', 'users.typ_id', 'usertypes.typ_id')
                ->join('user_status', 'users.us_id', 'user_status.us_id')
                ->select('users.*','usertypes.*','user_status.*')
                ->whereIn('users.typ_id', [2,5,6])
                ->paginate(5);
        return ['rp' => $rp];
    }
    function CreateRP(Request $request){
        $message = '';
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'typ_id' => 'required'
        ]);
        $rp = DB::table('users')->insert([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'typ_id' => $request->typ_id,
                    'crs_id' => 1,
                    'us_id' => 1,
                    'specialty' => $request->specialty
                ]);
        if ($rp) {
            $email = $request->email;
            $messageData = ['email'=>$request->email, 'name'=>$request->name, 'password'=>$request->password];
            // Mail::send('pages.registeremail', $messageData, function($message) use($email){
            //     $message->to($email)->subject('Account Registered in CCERMS');
            // });
            // Mail::to($request->email)->send(new EmailCreation($messageData));
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong. Try again later';
        }

        return ['message' => $message];
    }
    function UpdateRP(Request $request){
        $message = '';
        if($request->type == 'update'){
            $email = DB::table('users')->where('id', '!=', $request->id)->where('email', $request->email)->get();
            if ($email->count() > 0) {
                $message = 'Email alredy taken';
            }
            else{
                $this->validate($request, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'specialty' => 'required|string|max:255',
                    'typ_id' => 'required'
                ]);
                if ($request->password == '') {
                    $rp = DB::table('users')->where('id', $request->id)
                            ->update([
                                'name' => $request->name,
                                'email' => $request->email,
                                'specialty' => $request->specialty,
                                'typ_id' => $request->typ_id
                            ]);
                    if($rp){
                        $email = $request->email;
                        $messageData = ['email'=> $request->email, 'name'=> $request->name,'password' => $request->password,'type' => $request->type];
                        // Mail::send('pages.email', $messageData, function($message) use($email){
                        //     $message->to($email)->subject('Account Updated in CCERMS');
                        // });
                        // Mail::to($request->email)->send(new EmailConfirmation($messageData));
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later.';
                    }
                }
                else{
                    $rp = DB::table('users')->where('id', $request->id)
                            ->update([
                                'name' => $request->name,
                                'email' => $request->email,
                                'specialty' => $request->specialty,
                                'password' => $request->password,
                                'typ_id' => $request->typ_id
                            ]);
                    if($rp){
                        $email = $request->email;
                        $messageData = ['email'=> $request->email, 'name'=> $request->name,'password' => $request->password,'type' => $request->type];
                        // Mail::send('pages.email', $messageData, function($message) use($email){
                        //     $message->to($email)->subject('Account Updated in CCERMS');
                        // });
                        // Mail::to($request->email)->send(new EmailConfirmation($messageData));
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later.';
                    }
                }
            }
            return ['message' => $message];
        }
        else if($request->type == 'approval'){
            $rp = DB::table('users')->where('id', $request->id)
                        ->update([
                            'us_id' => $request->us_id
                        ]);
            if($rp){
                $email = $request->email;
                $messageData = ['email'=> $request->email, 'name'=> $request->name, 'us_id' => $request->us_id, 'type' => $request->type];
                // Mail::send('pages.email', $messageData, function($message) use($email){
                //     $message->to($email)->subject('Account Approved in CCERMS');
                // });
                // Mail::to($request->email)->send(new EmailConfirmation($messageData));
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later';
            }
            return ['message' => $message];
        }
    }
    function SearchRP(Request $request){
        if($request->search == ''){
            return $this->AllRP();
        }
        else{
           $rp =  DB::table('users')
                ->join('usertypes', 'users.typ_id', 'usertypes.typ_id')
                ->join('user_status', 'users.us_id', 'user_status.us_id')
                ->select('users.*','usertypes.*','user_status.*')
                ->where('users.us_id', $request->status)
                ->where('users.name','LIKE', "%$request->search%")
                ->whereIn('users.typ_id', [2,5,6])
                ->paginate(5);

            return ['rp' => $rp];
        }
    }

    // Capstone 1 Functions
    function SelectCapstone1($id){
        $panels = '';
        $info = DB::table('groups')
                    ->join('scheduletypes', 'groups.readyfor', 'scheduletypes.styp_id')
                    ->select('groups.*','scheduletypes.styp_title')
                    ->where('grp_id', $id)
                    ->get();
        $members = DB::table('users')
                    ->select('id','name')
                    ->where('grp_id', $id)
                    ->get();
        $adviser = DB::table('advisergroups')
                    ->join('users', 'advisergroups.id', 'users.id')
                    ->join('user_status', 'advisergroups.us_id', 'user_status.us_id')
                    ->where('advisergroups.grp_id', $id)
                    ->select('advisergroups.ag_id','advisergroups.adv_reason','users.id', 'users.name','user_status.us_id','user_status.us_title')
                    ->get();

        $panel = DB::table('panel_defenses')
                   ->join('users', 'panel_defenses.pan1_ID', 'users.id')
                   ->join('user_status', 'panel_defenses.us_id', 'user_status.us_id')
                   ->where('panel_defenses.grp_id', $id)
                   ->select('panel_defenses.id','panel_defenses.pan_reason', 'users.id', 'users.name','user_status.us_id', 'user_status.us_title')
                   ->get();
        if($panel->count() > 0){
            $panels = $panel;
        }
        else{
            $panels = [['id' =>1,'name' =>'No Panels Yet'],['id' =>2,'name' =>'No Panels Yet'],['id' =>3,'name' =>'No Panels Yet']];
        }

        return response()->JSON(['members' => $members, 'adviser' => $adviser[0], 'panels' => $panels, 'info' => $info[0]], 200);
    }
    function SelectAdviser(Request $request){
        $message = '';
        $checkpanel = DB::table('panel_defenses')->where('pan1_ID', $request->id)->where('grp_id', $request->grp_id)->get();
        if($checkpanel->count() > 0){
            $message = 'Adviser Already the Panel';
        }
        else if($request->id == 1){
            $cap1 = DB::table('advisergroups')->where('grp_id', $request->grp_id)
                     ->update([
                        'id' => $request->id,
                        'us_id' => 1,
                        'adv_reason' => null
                     ]);
            if($cap1){
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later';
            }
        }
        else{
            $cap1 = DB::table('advisergroups')->where('grp_id', $request->grp_id)
                     ->update([
                        'id' => $request->id,
                        'us_id' => 3,
                        'adv_reason' => null
                     ]);
            if($cap1){
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later';
            }
        }
        return ['message' => $message];
    }
    function SelectPanel(Request $request){
        $message = '';

        $checkadviser = DB::table('advisergroups')->where('id', $request->id)->where('grp_id', $request->grp_id)->get();
        $checkpanel = DB::table('panel_defenses')->where('pan1_ID', $request->id)->where('grp_id', $request->grp_id)->get();
        $checkcapacity = DB::table('panel_defenses')->where('grp_id', $request->grp_id)->get();
        if($checkadviser->count() > 0){
            $message = 'Panel Already the Adviser';
        }
        else if($checkpanel->count() > 0){
            $message = 'Panel Already Selected';
        }
        else if($checkcapacity->count() == 3){
            $message = 'Already Selcted 3 Panel';
        }
        else{
            DB::table('tbl_documentevaluation1')->insert([
                'dt_grp' => $request->grp_id,
                'dt_panID' => $request->id
            ]);
            DB::table('tbl_documentevaluation2')->insert([
                'dt_grp' => $request->grp_id,
                'dt_panID' => $request->id
            ]);
            DB::table('tbl_validator1')->insert([
                'val_grp' => $request->grp_id,
                'val_panID' => $request->id
            ]);
            DB::table('tbl_validator2')->insert([
                'val_grp' => $request->grp_id,
                'val_panID' => $request->id
            ]);
            if($request->id == 1){
                $panel = DB::table('panel_defenses')->insert([
                    'pan1_ID' => $request->id,
                    'grp_id' => $request->grp_id,
                    'us_id' => 1
                    ]);
                if($panel){
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try Again later';
                }
            }
            else{
                $panel = DB::table('panel_defenses')->insert([
                    'pan1_ID' => $request->id,
                    'grp_id' => $request->grp_id,
                    'us_id' => 3
                            ]);
                if($panel){
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try Again later';
                }
            }

        }

        return ['message' => $message];
    }
    function ChangeGroupPanel(Request $request){
        $message = '';
        $checkadviser = DB::table('advisergroups')->where('grp_id', $request->grp_id)->where('id', $request->new_id)->get();
        $checkpanel = DB::table('panel_defenses')->where('grp_id', $request->grp_id)->where('pan1_ID', $request->new_id)->get();
        if($checkadviser->count() > 0){
            $message = 'Panel Already the Adviser';
        }
        else if($checkpanel->count() > 0){
            $message = 'Panel Already Selected';
        }
        else{
            DB::table('tbl_documentevaluation1')
                ->where('dt_grp', $request->grp_id)
                ->where('dt_panID', $request->old_id)
                ->update([
                    'dt_panID' => $request->new_id
                ]);
            DB::table('tbl_documentevaluation2')
                ->where('dt_grp', $request->grp_id)
                ->where('dt_panID', $request->old_id)
                ->update([
                    'dt_panID' => $request->new_id
                ]);
            DB::table('tbl_validator1')
                ->where('val_grp', $request->grp_id)
                ->where('val_panID', $request->old_id)
                ->update([
                    'val_panID' => $request->new_id
                ]);
            DB::table('tbl_validator2')
                ->where('val_grp', $request->grp_id)
                ->where('val_panID', $request->old_id)
                ->update([
                    'val_panID' => $request->new_id
                ]);
            if($request->new_id == 1){
                $panel = DB::table('panel_defenses')
                            ->where('grp_id', $request->grp_id)
                            ->where('pan1_ID', $request->old_id)
                            ->update([
                                'pan1_ID' => $request->new_id,
                                'us_id' => 1
                            ]);
                if($panel){
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try again later!';
                }
            }
            else{
                $panel = DB::table('panel_defenses')
                            ->where('grp_id', $request->grp_id)
                            ->where('pan1_ID', $request->old_id)
                            ->update([
                                'pan1_ID' => $request->new_id,
                                'us_id' => 3
                            ]);
                if($panel){
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try again later!';
                }
            }
        }

        return ['message' => $message];
    }
    function UploadPlagiarism(Request $request){
        $message = '';
        if($request->file == ''){
            $message = 'Please Attach the Plagiarism docx file';
        }
        else if($request->percentage == ''){
            $message = 'Please Attach the Percentage of the file';
        }
        else{
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = $request->grp_title.$request->document.'.'.$ext;
            if(Storage::disk('myfiles')->putFileAs('RCFiles/Plagiarism/', $file, $name)){
                $grammar = DB::table('tbl_caps1plagiarism')
                                ->insert([
                                'pla_file' => $name,
                                'pla_grp' => $request->grp_id,
                                'pla_rcID' => $request->id,
                                'pla_percent' => $request->percentage,
                                'pla_document' => $request->document,
                                'pla_date' => $request->date,
                                'pla_standing' => $request->standing
                                ]);
                if($grammar){
                    if ($request->standing == 1) {
                        DB::table('groups')
                        ->where('grp_id', $request->grp_id)
                        ->update([
                            'caps1' => 4,
                            'grp_percent' => 45
                        ]);
                    }
                    else{
                        DB::table('groups')
                        ->where('grp_id', $request->grp_id)
                        ->update([
                            'caps2' => 4,
                            'grp_percent' => 95
                        ]);
                    }

                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try again later';
                }
            }
        }

        return ['message' => $message];
    }
    function CapstoneApproval(Request $request){
        $message = '';
        if($request->grp_standing == 1){
            $approval = DB::table('groups')
                            ->where('grp_id', $request->grp_id)
                            ->update([
                                'grp_standing' => 2,
                                'readyfor' => 4,
                            ]);
            if($approval){
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later';
            }
        }
        else{
            $approval = DB::table('groups')
                            ->where('grp_id', $request->grp_id)
                            ->update([
                                'grp_standing' => 3
                            ]);
            if($approval){
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later';
            }
        }

        return ['message' => $message];
    }
    function FinalDocuments($id){
        $final = DB::table('tbl_finaldocuments')
                    ->where('fin_grp', $id)
                    ->get();

        return ['final' => $final];
    }
    function AdminSystemCheckCaps2(Request $request){
        $message = '';
        if($request->status == 3) {
            if ($request->comment == '') {
                $message = 'Provide Comment';
            }
            else{
                $check = DB::table('tbl_capston2systemchecking')
                        ->where('sys_grp', $request->grp_id)
                        ->update([
                            'sys_rcdate' => $request->date,
                            'sys_status' => $request->status,
                            'sys_rccomment' => $request->comment
                        ]);
                if ($check) {
                    // if($request->status == 4){
                    //     DB::table('groups')
                    //         ->where('grp_id', $request->grp_id)
                    //         ->update([
                    //             'caps2' => 1,
                    //             'grp_percent' => 60
                    //         ]);
                    // }
                $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try again later';
                }
            }
        }
        else{
            $check = DB::table('tbl_capston2systemchecking')
                    ->where('sys_grp', $request->grp_id)
                    ->update([
                        'sys_rcdate' => $request->date,
                        'sys_status' => $request->status
                    ]);
            if ($check) {
                if($request->status == 4){
                    DB::table('groups')
                        ->where('grp_id', $request->grp_id)
                        ->update([
                            'caps2' => 1,
                            'grp_percent' => 60
                        ]);
                }
            $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later';
            }
        }
        return ['message' => $message];
    }
    function ChecklistDecission(Request $request){
        $message = '';
        if ($request->status == 3 && $request->comment == '') {
            return ['message' => 'Provide your comment!'];
        }
        $check = DB::table('tbl_finalchecklist')
                    ->where('fc_id', $request->id)
                    ->update([
                        'fc_status' => $request->status,
                        'fc_comment' => $request->comment
                    ]);
        if ($check) {
            DB::table('groups')
                ->where('grp_id', $request->grp)
                ->update(['isDone' => 1]);
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong. Try again later.';
        }
        return ['message' => $message];
    }

    // Reports functions
    public function GetAdviserList(){
        $adviser =DB::table('advisergroups')
                    ->join('groups', 'advisergroups.grp_id', '=', 'groups.grp_id')
                    ->join('users as ag','advisergroups.id', 'ag.id')
                    ->join('users as st', 'groups.grp_id', 'st.grp_id')
                    ->join('sections', 'st.sec_id','sections.sec_id')
                    ->select('advisergroups.ag_id', 'ag.name', DB::raw('GROUP_CONCAT(st.name) as student'), DB::raw('GROUP_CONCAT(sections.sec_code) as sec_code'))
                    ->groupBy('advisergroups.ag_id', 'ag.name')
                    ->where('groups.isDone', 0)
                    ->where('advisergroups.id', '!=', 2)
                    ->get();
        return ['adviser' => $adviser];
    }
    public function GetResearchPerson(){
        $adviser = DB::table('users')
                    ->where('typ_id', 2)
                    ->orWhere('typ_id', 6)
                    ->where('us_id', 1)
                    ->select('users.id','users.name', 'users.specialty')
                    ->get();

        $panel = DB::table('users')
                    ->where('typ_id', 5)
                    ->orWhere('typ_id', 6)
                    ->where('us_id', 1)
                    ->select('users.id','users.name', 'users.specialty')
                    ->get();

        return ['adviser' => $adviser, 'panel' => $panel];
    }
    function GetSectionList(){
        $sections = DB::table('s_t_sections')
                    ->join('sections', 's_t_sections.sec_id', 'sections.sec_id')
                    ->join('users', 's_t_sections.user_id', 'users.id')
                    ->select('users.name', 'sections.*')
                    ->get();

        return ['sections' => $sections];

    }
    function GetSectionGroupProgress($id){
        $groups = DB::table('groups')
                    ->select('grp_id', 'grp_title', 'grp_percent')
                    ->where('sec_id', $id)
                    ->orWhere('sec_id2', $id)
                    ->get();

        return ['groups' => $groups];
    }
}
