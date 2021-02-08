<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class StudentController extends Controller
{

    function CreataGroup(Request $request){
        $message = '';
        $group = DB::table('groups')->where('grp_title',$request->groupName)->get();

        if($group->count() > 0){
            $message = 'Group Name Already Taken!';
        }
        else{
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = substr(str_shuffle($permitted_chars), 0, 4).'-'.substr(str_shuffle($permitted_chars), 0, 6);
            $grp_id = $this->getGroupID();

            $grp = DB::table('groups')
                     ->insert([
                        'grp_title' => $request->groupName,
                        'grp_researchtitle' => $request->groupResearchTitle,
                        'grp_code' => $code,
                        'crs_id' => $request->crs_id,
                        'readyfor' => 2
                     ]);
            if($grp){
                $adv = DB::table('advisergroups')
                         ->insert([
                            'grp_id' => $grp_id
                         ]);
                $user = DB::table('users')
                          ->where('id', $request->id)
                          ->update([
                            'grp_id' => $grp_id
                          ]);
                $caps1sys = DB::table('tbl_capston1systemchecking')
                             ->insert(['sys1_grp' => $grp_id]);
                if($user){
                    $message = 'Success';
                }
                else{
                    $message = 'Somethings got Wrong!';
                }
            }
            else{
                $message = 'Somethings got Wrong1!';
            }


        }
        return response()->JSON(['message'=>$message],200);
    }
    function getGroupID(){
        $id = DB::table('groups')->get();

        return $id->count() + 1;
    }
    function Capstone1Info(){
        $cap1 = DB::table('groups')
                  ->join('courses', 'groups.crs_id', 'courses.crs_id')
                  ->select('groups.grp_id','groups.grp_title','groups.grp_researchtitle','courses.crs_title','courses.crs_id')
                  ->where('groups.grp_id', '>', '1')
                  ->get();

        return response()->JSON(['cap1'=> $cap1],200);
    }
    function JoinGroup(Request $request){
        $message = '';
        $join = DB::table('groups')
                  ->where('grp_id', $request->grp_id)
                  ->where('grp_code', $request->grp_code)
                  ->get();

        if($join->count() > 0){
            DB::table('users')->where('id', $request->id)->update(['grp_id' => $request->grp_id]);
            $message = 'Success';
        }
        else{
            $message = 'Group Code is Invalid!';
        }

        return response()->JSON(['message' => $message],200);

    }
    function JoinSection(Request $request){
        $section = DB::table('sections')->where('sec_code', $request->sec_code)->get();
        $message = '';
        if($section->count() > 0){
            $user = DB::table('users')->where('id', $request->id)
                      ->update([
                        'sec_id' => $section[0]->sec_id
                      ]);
            if($user){
                $message = 'Success';
            }
            else{
                $message = 'Somethins went wrong';
            }

        }
        else{
            $message = 'No Section based on the Code '.$request->sec_code.' given';
        }

        return response()->JSON(['message' => $message],200);
    }

    function SubmitDocs(Request $request){
        $message = '';
        $rev = DB::table('tbl_documentsubmission')
                ->where('dcs_grp', $request->grp_id)
                ->where('docstanding', $request->standing)
                ->get();
        $checkapprove = DB::table('tbl_documentsubmission')
                            ->where('dcs_grp', $request->grp_id)
                            ->where('dcs_status', 4)
                            ->where('docstanding', $request->standing)
                            ->get();
        if($checkapprove->count() > 0){
            return ['message' => 'Already Approve by adviser'];
        }
        else if($request->file == ''){
            $message = 'Select your chapters';
        }
        else if($rev->count() > 0){
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = $request->grp_title.$request->chapter.'-'.$rev->count().'.'.$ext;
            $check = DB::table('tbl_documentsubmission')
                        ->where('dcs_grp', $request->grp_id)
                        ->where('dcs_status', 1)
                        ->where('docstanding', $request->standing)
                        ->get();
            if($check->count() > 0){
                $message = 'Wait for the adviser to check.';
            }
            else{
                if ($request->standing == 1) {
                    if(Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone1/', $file, $name)){
                        $submit = DB::table('tbl_documentsubmission')
                                    ->insert([
                                        'dcs_revID' => $rev->count(),
                                        'dcs_document' => $request->chapter,
                                        'dcs_date' => $request->date,
                                        'dcs_submitby' => $request->submitby,
                                        'dcs_submitto' => $request->submitto,
                                        'dcs_grp' => $request->grp_id,
                                        'dcs_status' => 1,
                                        'dcs_file' => $name,
                                        'docstanding' => $request->standing
                                    ]);
                        if($submit){
                            $message = 'success';
                        }
                        else{
                            $message = 'Somethings went wrong. Try again later.';
                        }
                    }
                }
                else{
                    if(Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $file, $name)){
                        $submit = DB::table('tbl_documentsubmission')
                                    ->insert([
                                        'dcs_revID' => $rev->count(),
                                        'dcs_document' => $request->chapter,
                                        'dcs_date' => $request->date,
                                        'dcs_submitby' => $request->submitby,
                                        'dcs_submitto' => $request->submitto,
                                        'dcs_grp' => $request->grp_id,
                                        'dcs_status' => 1,
                                        'dcs_file' => $name,
                                        'docstanding' => $request->standing
                                    ]);
                        if($submit){
                            $message = 'success';
                        }
                        else{
                            $message = 'Somethings went wrong. Try again later.';
                        }
                    }
                }
            }
        }
        else{
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = $request->grp_title.$request->chapter.'-'.$rev->count().'.'.$ext;
            if ($request->standing == 1) {
                if(Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone1/', $file, $name)){
                    $submit = DB::table('tbl_documentsubmission')
                                ->insert([
                                    'dcs_revID' => $rev->count(),
                                    'dcs_document' => $request->chapter,
                                    'dcs_date' => $request->date,
                                    'dcs_submitby' => $request->submitby,
                                    'dcs_submitto' => $request->submitto,
                                    'dcs_grp' => $request->grp_id,
                                    'dcs_status' => 1,
                                    'dcs_file' => $name,
                                    'docstanding' => $request->standing
                                ]);
                    if($submit){
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later.';
                    }
                }
            }
            else{
                if(Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $file, $name)){
                    $submit = DB::table('tbl_documentsubmission')
                                ->insert([
                                    'dcs_revID' => $rev->count(),
                                    'dcs_document' => $request->chapter,
                                    'dcs_date' => $request->date,
                                    'dcs_submitby' => $request->submitby,
                                    'dcs_submitto' => $request->submitto,
                                    'dcs_grp' => $request->grp_id,
                                    'dcs_status' => 1,
                                    'dcs_file' => $name,
                                    'docstanding' => $request->standing
                                ]);
                    if($submit){
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later.';
                    }
                }
            }

        }


        return ['message' => $message];
    }
    function UpdateDocs(Request $request){
        $message = '';
        $rev = DB::table('tbl_documentsubmission')->where('dcs_id', $request->dcs_id)->get();
        $newRev = $rev->count();
        if($request->file == ''){
            $message = 'Select your chapters';
        }
        else if($newRev > 0){
            $oldRev = $newRev - 1;
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = $request->grp_title.$request->chapter.'-'.$oldRev.'.'.$ext;
            if ($request->standing == 1) {
                if(Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone1/', $file, $name)){
                    $submit = DB::table('tbl_documentsubmission')
                                ->where('dcs_id', $request->dcs_id)
                                ->update([
                                    'dcs_date' => $request->date,
                                    'dcs_submitby' => $request->submitby,
                                    'dcs_grp' => $request->grp_id,
                                    'dcs_file' => $name,
                                ]);
                    if($submit){
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later.';
                    }
                }
            }
            else{
                if(Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $file, $name)){
                    $submit = DB::table('tbl_documentsubmission')
                                ->where('dcs_id', $request->dcs_id)
                                ->update([
                                    'dcs_date' => $request->date,
                                    'dcs_submitby' => $request->submitby,
                                    'dcs_grp' => $request->grp_id,
                                    'dcs_file' => $name,
                                ]);
                    if($submit){
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later.';
                    }
                }
            }

        }
        else{
            $message = 'No Data Found';
        }


        return ['message' => $message];
    }
    function GetCapstone1SubmittedDocs($id){
        $documents1 = DB::table('tbl_documentsubmission')
                       ->join('users as uby', 'tbl_documentsubmission.dcs_submitby', 'uby.id')
                       ->join('users as uto', 'tbl_documentsubmission.dcs_submitto', 'uto.id')
                       ->join('submit_status', 'tbl_documentsubmission.dcs_status', 'submit_status.ss_id')
                       ->select('tbl_documentsubmission.*', 'uby.name as submitby', 'uto.name as submitto', 'submit_status.ss_title', 'submit_status.ss_id')
                       ->where('tbl_documentsubmission.dcs_grp', $id)
                       ->where('tbl_documentsubmission.docstanding', 1)
                       ->latest('tbl_documentsubmission.dcs_revID')
                       ->get();
        $documents2 = DB::table('tbl_documentsubmission')
                       ->join('users as uby', 'tbl_documentsubmission.dcs_submitby', 'uby.id')
                       ->join('users as uto', 'tbl_documentsubmission.dcs_submitto', 'uto.id')
                       ->join('submit_status', 'tbl_documentsubmission.dcs_status', 'submit_status.ss_id')
                       ->select('tbl_documentsubmission.*', 'uby.name as submitby', 'uto.name as submitto', 'submit_status.ss_title', 'submit_status.ss_id')
                       ->where('tbl_documentsubmission.dcs_grp', $id)
                       ->where('tbl_documentsubmission.docstanding', 2)
                       ->latest('tbl_documentsubmission.dcs_revID')
                       ->get();

        return ['documents1' => $documents1, 'documents2' => $documents2];
    }
    function GetStudentGroupSchedule($id){
        $schedule = DB::table('tbl_defenseschedule')
                      ->join('defense_status', 'tbl_defenseschedule.def_status', 'defense_status.ds_id')
                      ->join('scheduletypes', 'tbl_defenseschedule.def_type', 'scheduletypes.styp_id')
                      ->select('tbl_defenseschedule.*', 'defense_status.*','scheduletypes.*')
                      ->where('tbl_defenseschedule.def_grp', $id)
                      ->get();

        return ['schedule' => $schedule];

    }
    function GroupSubmitReviseToPanel(Request $request){
        $message = '';
        if ($request->file == '') {
            $message = 'Provide File';
        }
        else if($request->comment == ''){
            $message = 'Provide comment';
        }
        else{
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = $request->group.$request->chapter.'-Panel-'.$request->id.'-'.$request->rev_revID.'.'.$ext;
            if ($request->standing == 1) {
                if (Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone1/', $file, $name)) {
                    $revise = DB::table('tbl_panelrevisefile')
                                ->where('rev_id', $request->rev_id)
                                ->update([
                                    'rev_grpfile' => $name,
                                    'rev_grpdate' => $request->date,
                                    'rev_grpcomment' => $request->comment
                                ]);
                    if ($revise) {
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later';
                    }

                }
            }
            else{
                if (Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $file, $name)) {
                    $revise = DB::table('tbl_panelrevisefile')
                                ->where('rev_id', $request->rev_id)
                                ->update([
                                    'rev_grpfile' => $name,
                                    'rev_grpdate' => $request->date,
                                    'rev_grpcomment' => $request->comment
                                ]);
                    if ($revise) {
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later';
                    }

                }
            }

        }
        return ['message' => $message];
    }
    function UpdateGroupSubmitReviseToPanel(Request $request){
        $message = '';
        if ($request->file == '') {
                $revise = DB::table('tbl_panelrevisefile')
                            ->where('rev_id', $request->rev_id)
                            ->update([
                                'rev_grpdate' => $request->date,
                                'rev_grpcomment' => $request->comment
                            ]);
                if ($revise) {
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try again later';
                }
        }
        else if($request->comment == ''){
            $message = 'Provide comment';
        }
        else{
            $file = $request->file('file');
            $name = $request->filename;
            if ($request->standing == 1) {
                if (Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone1/', $file, $name)) {
                    $revise = DB::table('tbl_panelrevisefile')
                                ->where('rev_id', $request->rev_id)
                                ->update([
                                    'rev_grpdate' => $request->date,
                                    'rev_grpcomment' => $request->comment
                                ]);
                    if ($revise) {
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later';
                    }
                }
            }
            else{
                if (Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone1/', $file, $name)) {
                    $revise = DB::table('tbl_panelrevisefile')
                                ->where('rev_id', $request->rev_id)
                                ->update([
                                    'rev_grpdate' => $request->date,
                                    'rev_grpcomment' => $request->comment
                                ]);
                    if ($revise) {
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later';
                    }
                }
            }
        }
        return ['message' => $message];
    }
    function GetSystemCertificate($id){
        $certificate = DB::table('tbl_capston2systemchecking')
                        ->join('submit_status', 'tbl_capston2systemchecking.sys_status', 'submit_status.ss_id')
                        ->where('sys_grp', $id)
                        ->select('tbl_capston2systemchecking.*', 'submit_status.*')
                        ->get();
        return $certificate;
    }
    function UploadSystemCertificate(Request $request){
        $message = '';
        $acceptance =  $request->file('acceptance');
        $acceptExt = $acceptance->getClientOriginalExtension();
        $acceptName = $request->group.'Acceptance.'.$acceptExt;

        $deployment = $request->file('deployment');
        $deployExt = $deployment->getClientOriginalExtension();
        $deployName = $request->group.'Deployment.'.$deployExt;

        if (Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $acceptance, $acceptName) && Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $deployment, $deployName)) {
            $system = DB::table('tbl_capston2systemchecking')
                        ->insert([
                            'sys_grp' => $request->grp_id,
                            'sys_status' => 1,
                            'sys_acceptfile' => $acceptName,
                            'sys_deployfile' => $deployName,
                            'sys_grpdate' => $request->date
                        ]);
            if($system){
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later';
            }
        }
        return ['message' => $message];
    }

    function UpdateSystemCertificate(Request $request){
        $message = '';
        if ($request->acceptance == '' && $request->deployment == '') {
            $message = 'Nothing Changes';
        }
        else if($request->acceptance == ''){
            $deployment = $request->file('deployment');
            if (Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $deployment, $request->deployname)) {
                $system = DB::table('tbl_capston2systemchecking')
                            ->where('sys_grp', $request->grp_id)
                            ->update([
                                'sys_grpdate' => $request->date
                            ]);
                if ($system) {
                    $message = 'success';
                }
                else{
                    $message = 'Somethins went wrong. Try again.';
                }
            }
        }
        else if($request->deployment == ''){
            $acceptance = $request->file('acceptance');
            if (Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $acceptance, $request->acceptname)) {
                $system = DB::table('tbl_capston2systemchecking')
                            ->where('sys_grp', $request->grp_id)
                            ->update([
                                'sys_grpdate' => $request->date
                            ]);
                if ($system) {
                    $message = 'success';
                }
                else{
                    $message = 'Somethins went wrong. Try again.';
                }
            }
        }
        else{
            $deployment =  $request->file('deployment');
            $acceptance = $request->file('acceptance');
            if (Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $deployment, $request->deployname) && Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone2/', $acceptance, $request->acceptname)) {
                $system = DB::table('tbl_capston2systemchecking')
                            ->where('sys_grp', $request->grp_id)
                            ->update([
                                'sys_grpdate' => $request->date
                            ]);
                if ($system) {
                    $message = 'success';
                }
                else{
                    $message = 'Somethins went wrong. Try again.';
                }
            }
        }

        return ['message' => $message];
    }
    function FinalSubmission(Request $request){
        $message = '';
        $check = DB::table('tbl_finalchecklist')
                    ->where('fc_grp', $request->grp_id)
                    ->where('fc_status', 1)
                    ->get();
        $checkCount = DB::table('tbl_finalchecklist')
                        ->where('fc_grp', $request->grp_id)
                        ->get();
        if ($request->file == '') {
            $message = 'Please Provide Zip File';
        }
        else if($check->count() > 0){
            $message = 'Waiting for the RC to Check';
        }
        else{
            $final =  $request->file('file');
            $finalExt = $final->getClientOriginalExtension();
            $finalName = $request->group.$checkCount->count().'Final.'.$finalExt;

            if (Storage::disk('myfiles')->putFileAs('Submittedfiles/Done/', $final, $finalName)) {
                    $checklist = DB::table('tbl_finalchecklist')
                                    ->insert([
                                        'fc_grp' => $request->grp_id,
                                        'fc_status' => 1,
                                        'fc_rcID' => 1,
                                        'fc_date' => $request->date,
                                        'fc_file' => $finalName
                                    ]);
                    if ($checklist) {
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Try again later';
                    }
            }
        }

        return ['message' => $message];
    }
    function UpdateFinalSubmission(Request $request){
        $message = '';
        if ($request->file == '') {
            $message = 'Please Provide Zip File';
        }
        else{
            $file =  $request->file('file');
            if(Storage::disk('myfiles')->putFileAs('Submittedfiles/Done/', $file, $request->filename)) {
                $update = DB::table('tbl_finalchecklist')
                            ->where('fc_id', $request->id)
                            ->update([
                                'fc_date' => $request->date
                            ]);
                if ($update) {
                    $message = 'success';
                }
                else{
                    $message = 'Somethings Went wrong. Try again later';
                }
            }
        }

        return ['message' => $message];
    }
    function GetFinalChecklist(Request $request){
        $checklist = DB::table('tbl_finalchecklist')
                        ->join('users', 'tbl_finalchecklist.fc_rcID', 'users.id')
                        ->join('submit_status', 'tbl_finalchecklist.fc_status' , 'submit_status.ss_id')
                        ->select('tbl_finalchecklist.*','submit_status.*', 'users.name')
                        ->where('tbl_finalchecklist.fc_grp', $request->id)
                        ->latest('tbl_finalchecklist.fc_date')
                        ->get();
       return $checklist;
    }
    function GetSectionList($id){
        $section = DB::table('users')
                    ->join('sections', 'users.sec_id', 'sections.sec_id')
                    ->select('sections.sec_id', 'sections.sec_code')
                    ->where('grp_id', $id)
                    ->get();

        return ['sections' => $section];
    }
    function UpdateGroupSection(Request $request){
        $message = '';
        if ($request->type == 1) {
            if ($request->secid == '') {
                $message = 'Please Select Section';
            }
            else{
                $section = DB::table('groups')
                            ->where('grp_id', $request->grpid)
                            ->update([
                                'sec_id' => $request->secid
                            ]);
                if ($section) {
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try again Later';
                }
            }
        }
        else{

        }
        return ['message' => $message];
    }
}
