<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class AdviserController extends Controller
{
    function GetAdviserGroupRequest($id){
        $group = DB::table('advisergroups')
                   ->join('groups', 'advisergroups.grp_id', 'groups.grp_id')
                   ->join('courses', 'groups.crs_id', 'courses.crs_id')
                   ->select('advisergroups.*','groups.grp_id', 'groups.grp_title', 'groups.grp_researchtitle','courses.crs_id', 'courses.crs_title')
                   ->where('advisergroups.id', $id)
                   ->where('advisergroups.us_id', 3)
                   ->get();

        return ['group' => $group];
    }
    function UpdateAdviserGroups(Request $request){
        $message = '';
        if($request->us_id == 2){
            $this->validate($request, [
                'reason' => 'required|string|max:255',
            ]);
        }
        $req = DB::table('advisergroups')->where('id', $request->id)->where('grp_id', $request->grp_id)
                    ->update([
                    'us_id' => $request->us_id,
                    'adv_reason' => $request->reason
                    ]);
            if($req){
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later';
            }

        return ['message' => $message];
    }
    function GetAdviserCapstone1($id){
        $c1 = DB::table('advisergroups')
                ->join('groups', 'advisergroups.grp_id', 'groups.grp_id')
                ->join('courses', 'groups.crs_id', 'courses.crs_id')
                ->join('scheduletypes', 'groups.readyfor', 'scheduletypes.styp_id')
                ->select('advisergroups.*', 'groups.*', 'courses.crs_id', 'courses.crs_title','scheduletypes.styp_id', 'scheduletypes.styp_title')
                ->where('advisergroups.id', $id)
                ->whereIn('groups.grp_standing', [1,0])
                ->get();
        $c2 = DB::table('advisergroups')
                ->join('groups', 'advisergroups.grp_id', 'groups.grp_id')
                ->join('courses', 'groups.crs_id', 'courses.crs_id')
                ->join('scheduletypes', 'groups.readyfor', 'scheduletypes.styp_id')
                ->select('advisergroups.*', 'groups.*', 'courses.crs_id', 'courses.crs_title','scheduletypes.styp_id', 'scheduletypes.styp_title')
                ->where('advisergroups.id', $id)
                ->where('groups.grp_standing', 2)
                ->get();
        $c3 = DB::table('advisergroups')
                ->join('groups', 'advisergroups.grp_id', 'groups.grp_id')
                ->join('courses', 'groups.crs_id', 'courses.crs_id')
                ->join('scheduletypes', 'groups.readyfor', 'scheduletypes.styp_id')
                ->select('advisergroups.*', 'groups.*', 'courses.crs_id', 'courses.crs_title','scheduletypes.styp_id', 'scheduletypes.styp_title')
                ->where('advisergroups.id', $id)
                ->where('groups.grp_standing', 3)
                ->where('groups.isDone', 1)
                ->get();
        $active = $c1->count() + $c2->count();
        $done = $c3->count();
        return ['c1' => $c1, 'c2' => $c2, 'active' => $active, 'done' => $done];
    }
    function GetCapstone1CheckDocs(Request $request){
        if ($request->id != '') {
            $document1 = DB::table('tbl_documentsubmission')
                        ->join('users as uby', 'tbl_documentsubmission.dcs_submitby', 'uby.id')
                        ->join('submit_status', 'tbl_documentsubmission.dcs_status', 'submit_status.ss_id')
                        ->select('tbl_documentsubmission.*', 'uby.name as submitby', 'submit_status.ss_title')
                        ->where('tbl_documentsubmission.dcs_grp', $request->grp_id)
                        ->where('tbl_documentsubmission.dcs_submitto', $request->id)
                        ->where('tbl_documentsubmission.docstanding', 1)
                        ->latest('tbl_documentsubmission.dcs_revID')
                        ->get();
        $document2 = DB::table('tbl_documentsubmission')
                        ->join('users as uby', 'tbl_documentsubmission.dcs_submitby', 'uby.id')
                        ->join('submit_status', 'tbl_documentsubmission.dcs_status', 'submit_status.ss_id')
                        ->select('tbl_documentsubmission.*', 'uby.name as submitby', 'submit_status.ss_title')
                        ->where('tbl_documentsubmission.dcs_grp', $request->grp_id)
                        ->where('tbl_documentsubmission.dcs_submitto', $request->id)
                        ->where('tbl_documentsubmission.docstanding', 2)
                        ->latest('tbl_documentsubmission.dcs_revID')
                        ->get();
        }
        else{
            $document1 = DB::table('tbl_documentsubmission')
                        ->join('users as uby', 'tbl_documentsubmission.dcs_submitby', 'uby.id')
                        ->join('submit_status', 'tbl_documentsubmission.dcs_status', 'submit_status.ss_id')
                        ->select('tbl_documentsubmission.*', 'uby.name as submitby', 'submit_status.ss_title')
                        ->where('tbl_documentsubmission.dcs_grp', $request->grp_id)
                        ->where('tbl_documentsubmission.docstanding', 1)
                        ->latest('tbl_documentsubmission.dcs_revID')
                        ->get();
        $document2 = DB::table('tbl_documentsubmission')
                        ->join('users as uby', 'tbl_documentsubmission.dcs_submitby', 'uby.id')
                        ->join('submit_status', 'tbl_documentsubmission.dcs_status', 'submit_status.ss_id')
                        ->select('tbl_documentsubmission.*', 'uby.name as submitby', 'submit_status.ss_title')
                        ->where('tbl_documentsubmission.dcs_grp', $request->grp_id)
                        ->where('tbl_documentsubmission.docstanding', 2)
                        ->latest('tbl_documentsubmission.dcs_revID')
                        ->get();
        }


        return ['document1' => $document1, 'document2' => $document2];
    }
    function AdviserCheckCaps1Docs(Request $request){
        $message = '';
        $rev = DB::table('tbl_documentsubmission')->where('dcs_id', $request->dcs_id)->get();
        $newRev = $rev->count();
        $oldRev = $newRev - 1;
        if($request->dcs_status == 3){
            $this->validate($request, [
                'file' => 'required',
                'comment' => 'required|max:255',
            ]);
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = $request->name.$request->group.$oldRev.'.'.$ext;
            if ($request->standing == 1) {
                if(Storage::disk('myfiles')->putFileAs('Adviserfiles/Capstone1/', $file, $name)){
                    $document = DB::table('tbl_documentsubmission')
                                  ->where('dcs_id', $request->dcs_id)
                                  ->update([
                                      'dcs_status' => $request->dcs_status,
                                      'adv_comment' => $request->comment,
                                      'adv_file' => $name,
                                      'adv_date' => $request->adv_date
                                  ]);
                    if($document){
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Please try again later';
                    }
                }
            }
            else{
                if(Storage::disk('myfiles')->putFileAs('Adviserfiles/Capstone2/', $file, $name)){
                    $document = DB::table('tbl_documentsubmission')
                                  ->where('dcs_id', $request->dcs_id)
                                  ->update([
                                      'dcs_status' => $request->dcs_status,
                                      'adv_comment' => $request->comment,
                                      'adv_file' => $name,
                                      'adv_date' => $request->adv_date
                                  ]);
                    if($document){
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Please try again later';
                    }
                }
            }

        }
        else{
            if($request->file != ''){
                $file = $request->file('file');
                $ext = $file->getClientOriginalExtension();
                $name = $request->name.$request->group.$oldRev.'.'.$ext;
                if ($request->standing == 1) {
                    if(Storage::disk('myfiles')->putFileAs('Adviserfiles/Capstone1/', $file, $name)){
                        $document = DB::table('tbl_documentsubmission')
                                    ->where('dcs_id', $request->dcs_id)
                                    ->update([
                                        'dcs_status' => $request->dcs_status,
                                        'adv_comment' => $request->comment,
                                        'adv_file' => $name,
                                        'adv_date' => $request->adv_date
                                    ]);
                        $group = DB::table('groups')
                                    ->where('grp_id', $request->grp_id)
                                    ->update([
                                        'caps1' => 1,
                                        'grp_percent' => 10,
                                        'adv_percent' => 25,
                                    ]);
                                DB::table('tbl_finaldocuments')
                                    ->insert([
                                        'fin_grp' => $request->grp_id,
                                        'fin_file' => $request->filename
                                    ]);
                        if($document && $group){
                            $message = 'success';
                        }
                        else{
                            $message = 'Somethings went wrong. Please try again later';
                        }
                    }
                }
                else{
                    if(Storage::disk('myfiles')->putFileAs('Adviserfiles/Capstone2/', $file, $name)){
                        $document = DB::table('tbl_documentsubmission')
                                    ->where('dcs_id', $request->dcs_id)
                                    ->update([
                                        'dcs_status' => $request->dcs_status,
                                        'adv_comment' => $request->comment,
                                        'adv_file' => $name,
                                        'adv_date' => $request->adv_date
                                    ]);
                        $group = DB::table('groups')
                                    ->where('grp_id', $request->grp_id)
                                    ->update([
                                        'caps2' => 2,
                                        'grp_percent' => 70,
                                        'adv_percent' => 90
                                    ]);
                                    DB::table('tbl_finaldocuments')
                                    ->where('fin_grp', $request->grp_id)
                                    ->update([
                                        'fin_file' => $request->filename
                                    ]);
                        if($document && $group){
                            $message = 'success';
                        }
                        else{
                            $message = 'Somethings went wrong. Please try again later';
                        }
                    }
                }
            }
            else{
                if ($request->standing == 1) {
                    DB::table('groups')
                    ->where('grp_id', $request->grp_id)
                    ->update([
                        'caps1' => 1,
                        'grp_percent' => 10,
                        'adv_percent' => 25,
                    ]);
                    DB::table('tbl_finaldocuments')
                    ->insert([
                        'fin_grp' => $request->grp_id,
                        'fin_file' => $request->filename
                    ]);
                }
                else{
                    DB::table('groups')
                    ->where('grp_id', $request->grp_id)
                    ->update([
                        'caps2' => 2,
                        'grp_percent' => 70,
                        'adv_percent' => 90
                    ]);
                    DB::table('tbl_finaldocuments')
                    ->where('fin_grp', $request->grp_id)
                    ->update([
                        'fin_file' => $request->filename
                    ]);
                }
                $document = DB::table('tbl_documentsubmission')
                                ->where('dcs_id', $request->dcs_id)
                                ->update([
                                    'dcs_status' => $request->dcs_status,
                                    'adv_comment' => $request->comment,
                                    'adv_date' => $request->adv_date
                                ]);
                    if($document){
                        $message = 'success';
                    }
                    else{
                        $message = 'Somethings went wrong. Please try again later';
                    }
            }
        }

        return ['message' => $message];
    }
    function GetCapstone1CheckSys($id){
        $check = DB::table('tbl_capston1systemchecking')
                    ->join('users', 'tbl_capston1systemchecking.sys1_advID', 'users.id')
                    ->select('tbl_capston1systemchecking.*', 'users.id', 'users.name')
                    ->where('sys1_grp', $id)->get();

        if($check->count() > 0){
            return $check;
        }
        else{
            return ['system' => 'no data'];
        }
    }
    function AdviserCheckSystem(Request $request){
        $message = '';
        $update = '';
        $sys = DB::table('tbl_capston1systemchecking')
                    ->where('sys1_c1', 1)
                    ->where('sys1_c2', 1)
                    ->where('sys1_c3', 1)
                    ->where('sys1_c4', 1)
                    ->where('sys1_c5', 1)
                    ->where('sys1_grp', $request->grp)
                    ->get();
        if($sys->count() > 0){
            return ['message' => 'Already Check the System'];
        }
        if($request->complied['sys1_c1'] == 1 && $request->complied['sys1_c2'] == 1 &&
            $request->complied['sys1_c3'] == 1 && $request->complied['sys1_c4'] == 1 &&
            $request->complied['sys1_c5'] == 1){
               $group =  DB::table('groups')
                  ->where('grp_id', $request->grp)
                  ->update([
                    'caps1' => 2,
                    'grp_percent' => 20,
                    'adv_percent' => 40,
                  ]);
            $update = 'Updated';
        }
        $check = DB::table('tbl_capston1systemchecking')
                    ->where('sys1_grp', $request->grp)
                    ->update([
                        'sys1_advID' => $request->id,
                        'sys1_c1' => $request->complied['sys1_c1'],
                        'sys1_c2' => $request->complied['sys1_c2'],
                        'sys1_c3' => $request->complied['sys1_c3'],
                        'sys1_c4' => $request->complied['sys1_c4'],
                        'sys1_c5' => $request->complied['sys1_c5'],
                        'sys1_remarks1' => $request->complied['sys1_remarks1'],
                        'sys1_remarks2' => $request->complied['sys1_remarks2'],
                        'sys1_remarks3' => $request->complied['sys1_remarks3'],
                        'sys1_remarks4' => $request->complied['sys1_remarks4'],
                        'sys1_remarks5' => $request->complied['sys1_remarks5'],
                    ]);

        if($check){
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong! Try again later';
        }

        return ['message' => $message, 'update' => $update];
    }
    function UploadGrammarly(Request $request){
        $message = '';
        if($request->file == ''){
            $message = 'Please Attach the Grammarly docx file';
        }
        else if($request->percentage == ''){
            $message = 'Please Attach the Percentage of the file';
        }
        else{
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = $request->grp_title.$request->document.'.'.$ext;
            if(Storage::disk('myfiles')->putFileAs('Adviserfiles/Grammarly/', $file, $name) && Storage::disk('myfiles')->putFileAs('Submittedfiles/Capstone1/', $file, $name)){
                $grammar = DB::table('tbl_caps1grammarly')
                              ->insert([
                                'gra_file' => $name,
                                'gra_grp' => $request->grp_id,
                                'gra_advID' => $request->id,
                                'gra_percent' => $request->percentage,
                                'gra_document' => $request->document,
                                'gra_date' => $request->date,
                                'gra_standing' => $request->standing
                              ]);

                if($grammar){
                    if ($request->standing == 1) {
                        DB::table('groups')
                            ->where('grp_id', $request->grp_id)
                            ->update([
                                'grp_percent' => 40,
                                'adv_percent' => 50
                            ]);
                    }
                    else{
                        DB::table('groups')
                        ->where('grp_id', $request->grp_id)
                        ->update([
                            'grp_percent' => 90,
                            'adv_percent' => 100
                        ]);
                    }

                    DB::table('tbl_finaldocuments')
                        ->where('fin_grp', $request->grp_id)
                        ->update(['fin_file' => $name]);
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try again later';
                }
            }
        }

        return ['message' => $message];
    }
    function getCapstone1Grammarly($id){
        $grammar = DB::table('tbl_caps1grammarly')
                    ->join('users', 'tbl_caps1grammarly.gra_advID', 'users.id')
                    ->select('users.id','users.name','tbl_caps1grammarly.*')
                    ->where('tbl_caps1grammarly.gra_grp', $id)
                    ->where('tbl_caps1grammarly.gra_standing', 1)
                    ->get();
        $grammar2 = DB::table('tbl_caps1grammarly')
                    ->join('users', 'tbl_caps1grammarly.gra_advID', 'users.id')
                    ->select('users.id','users.name','tbl_caps1grammarly.*')
                    ->where('tbl_caps1grammarly.gra_grp', $id)
                    ->where('tbl_caps1grammarly.gra_standing', 2)
                    ->get();

        $plagiarism = DB::table('tbl_caps1plagiarism')
                    ->join('users', 'tbl_caps1plagiarism.pla_rcID', 'users.id')
                    ->select('users.id','users.name','tbl_caps1plagiarism.*')
                    ->where('tbl_caps1plagiarism.pla_grp', $id)
                    ->where('tbl_caps1plagiarism.pla_standing', 1)
                    ->get();
        $plagiarism2 = DB::table('tbl_caps1plagiarism')
                    ->join('users', 'tbl_caps1plagiarism.pla_rcID', 'users.id')
                    ->select('users.id','users.name','tbl_caps1plagiarism.*')
                    ->where('tbl_caps1plagiarism.pla_grp', $id)
                    ->where('tbl_caps1plagiarism.pla_standing', 2)
                    ->get();

        return ['grammar' => $grammar,'grammar2' => $grammar2, 'plagiarism' => $plagiarism,'plagiarism2' => $plagiarism2];
    }
}
