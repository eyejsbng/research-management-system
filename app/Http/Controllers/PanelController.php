<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class PanelController extends Controller
{
    function GetPanelGroupRequest($id){
        $list = DB::table('panel_defenses')
                  ->join('groups', 'panel_defenses.grp_id', 'groups.grp_id')
                  ->join('courses', 'groups.crs_id', 'courses.crs_id')
                  ->select('panel_defenses.*', 'groups.grp_id','groups.grp_title','groups.grp_researchtitle','courses.crs_id','courses.crs_title')
                  ->where('panel_defenses.pan1_ID', $id)
                  ->where('panel_defenses.us_id', 3)
                  ->get();

        return ['groups' => $list];
    }
    function UpdatePanelGroups(Request $request){
        $message = '';
        if($request->us_id == 2){
            $this->validate($request, [
                'reason' => 'required|string|max:255',
            ]);
        }
        $req = DB::table('panel_defenses')->where('pan1_ID', $request->id)->where('grp_id', $request->grp_id)
                    ->update([
                    'us_id' => $request->us_id,
                    'pan_reason' => $request->reason
                    ]);
            if($req){
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later';
            }

        return ['message' => $message];
    }
    function GetPanelGroups($id){
        $group = DB::table('panel_defenses')
                    ->join('groups', 'panel_defenses.grp_id', 'groups.grp_id')
                    ->join('courses', 'groups.crs_id', 'courses.crs_id')
                    ->select('panel_defenses.*' ,'groups.*', 'courses.crs_id' ,'courses.crs_title')
                    ->where('panel_defenses.pan1_ID', $id)
                    ->where('panel_defenses.us_id', 1)
                    ->get();
        $active = DB::table('panel_defenses')
                    ->join('groups', 'panel_defenses.grp_id', 'groups.grp_id')
                    ->join('courses', 'groups.crs_id', 'courses.crs_id')
                    ->select('panel_defenses.*' ,'groups.*', 'courses.crs_id' ,'courses.crs_title')
                    ->where('panel_defenses.pan1_ID', $id)
                    ->where('panel_defenses.us_id', 1)
                    ->whereIn('groups.grp_standing', [1,2])
                    ->get();
        $done = DB::table('panel_defenses')
                    ->join('groups', 'panel_defenses.grp_id', 'groups.grp_id')
                    ->join('courses', 'groups.crs_id', 'courses.crs_id')
                    ->select('panel_defenses.*' ,'groups.*', 'courses.crs_id' ,'courses.crs_title')
                    ->where('panel_defenses.pan1_ID', $id)
                    ->where('panel_defenses.us_id', 1)
                    ->where('groups.grp_standing', 3)
                    ->where('groups.isDone', 1)
                    ->get();
        return ['groups' => $group, 'active' => $active->count(), 'done' => $done->count()];
    }
    function GetRatingScale(){
        $rating = DB::table('tbl_ratingscale')->get();

        return ['rating' => $rating];
    }
    function DecissionSubmission(Request $request){
        $message = '';
        if ($request->standing == 1) {
            $decide = DB::table('tbl_documentevaluation1')
                    ->where('dt_panID', $request->id)
                    ->where('dt_grp', $request->grp)
                    ->update([
                        'dt_status' => $request->status
                    ]);
            if($decide){
                $count = DB::table('tbl_documentevaluation1')
                        ->where('dt_grp', $request->grp)
                        ->where('dt_status', 4)
                        ->get();
                $message = 'success';
                if($request->rev_id != ''){
                    DB::table('tbl_panelrevisefile')
                        ->where('rev_id', $request->rev_id)
                        ->update([
                            'rev_status' => $request->status,
                            'rev_date' => $request->date
                        ]);
                    DB::table('tbl_finaldocuments')
                        ->where('fin_grp', $request->grp)
                        ->update(['fin_file' => $request->filename]);
                }
                if($count->count() == 3){
                    DB::table('groups')
                        ->where('grp_id', $request->grp)
                        ->update([
                            'grp_percent' => 30,
                            'pan_percent' => 20
                        ]);
                }
            }
            else{
                $message = 'Somethings went wrong. Try again later.';
            }
        }
        else{
            $decide = DB::table('tbl_documentevaluation2')
                    ->where('dt_panID', $request->id)
                    ->where('dt_grp', $request->grp)
                    ->update([
                        'dt_status' => $request->status
                    ]);
            if($decide){
                $count = DB::table('tbl_documentevaluation2')
                        ->where('dt_grp', $request->grp)
                        ->where('dt_status', 4)
                        ->get();
                $message = 'success';
                if($request->rev_id != ''){
                    DB::table('tbl_panelrevisefile')
                        ->where('rev_id', $request->rev_id)
                        ->update([
                            'rev_status' => $request->status,
                            'rev_date' => $request->date
                        ]);
                    DB::table('tbl_finaldocuments')
                        ->where('fin_grp', $request->grp)
                        ->update(['fin_file' => $request->filename]);
                }
                if($count->count() == 3){
                    DB::table('groups')
                        ->where('grp_id', $request->grp)
                        ->update([
                            'grp_percent' => 80,
                            'pan_percent' => 70
                        ]);
                }
            }
            else{
                $message = 'Somethings went wrong. Try again later.';
            }
        }
       return ['message' => $message];
    }
    function GetCapstone1Evaluation(Request $request){
        $eval1 = '';
        $eval2 = '';
        if($request->id == ''){
            $eval1 = DB::table('tbl_documentevaluation1')
                    ->join('users', 'tbl_documentevaluation1.dt_panID', 'users.id')
                    ->join('submit_status', 'tbl_documentevaluation1.dt_status', 'submit_status.ss_id')
                    ->select('tbl_documentevaluation1.*', 'users.id', 'users.name', 'submit_status.ss_title')
                    ->where('tbl_documentevaluation1.dt_grp', $request->grp)
                    ->get();
            $eval2 = DB::table('tbl_documentevaluation2')
                    ->join('users', 'tbl_documentevaluation2.dt_panID', 'users.id')
                    ->join('submit_status', 'tbl_documentevaluation2.dt_status', 'submit_status.ss_id')
                    ->select('tbl_documentevaluation2.*', 'users.id', 'users.name', 'submit_status.ss_title')
                    ->where('tbl_documentevaluation2.dt_grp', $request->grp)
                    ->get();
        }
        else{
            $eval1 = DB::table('tbl_documentevaluation1')
                    ->join('users', 'tbl_documentevaluation1.dt_panID', 'users.id')
                    ->join('submit_status', 'tbl_documentevaluation1.dt_status', 'submit_status.ss_id')
                    ->select('tbl_documentevaluation1.*', 'users.id', 'users.name', 'submit_status.ss_title')
                    ->where('tbl_documentevaluation1.dt_grp', $request->grp)
                    ->where('tbl_documentevaluation1.dt_panID', $request->id)
                    ->get();
            $eval2 = DB::table('tbl_documentevaluation2')
                    ->join('users', 'tbl_documentevaluation2.dt_panID', 'users.id')
                    ->join('submit_status', 'tbl_documentevaluation2.dt_status', 'submit_status.ss_id')
                    ->select('tbl_documentevaluation2.*', 'users.id', 'users.name', 'submit_status.ss_title')
                    ->where('tbl_documentevaluation2.dt_grp', $request->grp)
                    ->where('tbl_documentevaluation2.dt_panID', $request->id)
                    ->get();
        }
        return ['eval1' => $eval1, 'eval2' => $eval2];
    }
    function GetCapstone1Revisefile(Request $request){
        $revise1 = '';
        $revise2 = '';
        if ($request->id == '') {
            $revise1 = DB::table('tbl_panelrevisefile')
                        ->join('users', 'tbl_panelrevisefile.rev_panID', 'users.id')
                        ->join('groups', 'tbl_panelrevisefile.rev_grp', 'groups.grp_id')
                        ->join('submit_status', 'tbl_panelrevisefile.rev_status', 'submit_status.ss_id')
                        ->select('tbl_panelrevisefile.*','users.id','users.name','groups.grp_id','groups.grp_title','submit_status.ss_id','submit_status.ss_title')
                        ->where('tbl_panelrevisefile.rev_grp', $request->grp)
                        ->where('tbl_panelrevisefile.rev_standing', 1)
                        ->latest('tbl_panelrevisefile.rev_revID')
                        ->get();
            $revise2 = DB::table('tbl_panelrevisefile')
                        ->join('users', 'tbl_panelrevisefile.rev_panID', 'users.id')
                        ->join('groups', 'tbl_panelrevisefile.rev_grp', 'groups.grp_id')
                        ->join('submit_status', 'tbl_panelrevisefile.rev_status', 'submit_status.ss_id')
                        ->select('tbl_panelrevisefile.*','users.id','users.name','groups.grp_id','groups.grp_title','submit_status.ss_id','submit_status.ss_title')
                        ->where('tbl_panelrevisefile.rev_grp', $request->grp)
                        ->where('tbl_panelrevisefile.rev_standing', 2)
                        ->latest('tbl_panelrevisefile.rev_revID')
                        ->get();

        }
        else{
            $revise1 = DB::table('tbl_panelrevisefile')
                        ->join('users', 'tbl_panelrevisefile.rev_panID', 'users.id')
                        ->join('groups', 'tbl_panelrevisefile.rev_grp', 'groups.grp_id')
                        ->join('submit_status', 'tbl_panelrevisefile.rev_status', 'submit_status.ss_id')
                        ->select('tbl_panelrevisefile.*','users.id','users.name','groups.grp_id','groups.grp_title','submit_status.ss_id','submit_status.ss_title')
                        ->where('tbl_panelrevisefile.rev_grp', $request->grp)
                        ->where('tbl_panelrevisefile.rev_panID', $request->id)
                        ->where('tbl_panelrevisefile.rev_standing', 1)
                        ->latest('tbl_panelrevisefile.rev_revID')
                        ->get();
            $revise2 = DB::table('tbl_panelrevisefile')
                        ->join('users', 'tbl_panelrevisefile.rev_panID', 'users.id')
                        ->join('groups', 'tbl_panelrevisefile.rev_grp', 'groups.grp_id')
                        ->join('submit_status', 'tbl_panelrevisefile.rev_status', 'submit_status.ss_id')
                        ->select('tbl_panelrevisefile.*','users.id','users.name','groups.grp_id','groups.grp_title','submit_status.ss_id','submit_status.ss_title')
                        ->where('tbl_panelrevisefile.rev_grp', $request->grp)
                        ->where('tbl_panelrevisefile.rev_panID', $request->id)
                        ->where('tbl_panelrevisefile.rev_standing', 2)
                        ->latest('tbl_panelrevisefile.rev_revID')
                        ->get();
        }

        return ['revise1' => $revise1, 'revise2' => $revise2];
    }
    function PanelSendReviseFile(Request $request){
        $message = '';
        if($request->file == ''){
            $message .= 'Provide Document.';
        }
        else if($request->comment == ''){
            $message .= 'Add your Comment.';
        }
        else{
            $count = DB::table('tbl_panelrevisefile')
                    ->where('tbl_panelrevisefile.rev_grp', $request->grp)
                    ->where('tbl_panelrevisefile.rev_panID', $request->id)
                    ->where('tbl_panelrevisefile.rev_standing', $request->standing)
                    ->get();
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = $request->name.$request->group.$request->standing.'-'.$count->count().'.'.$ext;
            if (Storage::disk('myfiles')->putFileAs('Panelfiles/', $file, $name)) {
                $revise = DB::table('tbl_panelrevisefile')
                            ->insert([
                                'rev_grp' => $request->grp,
                                'rev_panID' => $request->id,
                                'rev_revID' => $count->count(),
                                'rev_date' => $request->date,
                                'rev_panfile' => $name,
                                'rev_document' => $request->chapter,
                                'rev_comment' => $request->comment,
                                'rev_status' => 1,
                                'rev_standing' => $request->standing,
                            ]);
                if($revise){
                    if ($request->standing == 1) {
                        DB::table('tbl_documentevaluation1')
                            ->where('dt_panID', $request->id)
                            ->where('dt_grp', $request->grp)
                            ->update(['dt_status' => 3]);
                    }
                    else{
                        DB::table('tbl_documentevaluation2')
                            ->where('dt_panID', $request->id)
                            ->where('dt_grp', $request->grp)
                            ->update(['dt_status' => 3]);
                    }
                    $message = 'success';
                    if($request->rev_id != ''){
                        DB::table('tbl_panelrevisefile')
                            ->where('rev_id', $request->rev_id)
                            ->update([
                                'rev_status' => 3,
                                'rev_date' => $request->date
                            ]);
                    }
                }
                else{
                    $message = 'Somethings went wrong. Try again later';
                }
            }
        }
        return ['message' => $message];

    }
    function UpdatePanelSendReviserFile(Request $request){
        $message = '';
        if ($request->file == '') {
            $revise = DB::table('tbl_panelrevisefile')
                        ->where('rev_id', $request->rev_id)
                        ->update([
                            'rev_date' => $request->date,
                            'rev_comment' => $request->comment
                        ]);
            if($revise){
                $message = 'success';
            }
            else{
                $message = 'Somethings went wrong. Try again later.';
            }
        }
        else {
            $file = $request->file('file');
            $name = $request->filename;
            if (Storage::disk('myfiles')->putFileAs('Panelfiles/', $file, $name)) {
                $revise = DB::table('tbl_panelrevisefile')
                        ->where('rev_id', $request->rev_id)
                        ->update([
                            'rev_date' => $request->date,
                            'rev_comment' => $request->comment
                        ]);
                if($revise){
                    $message = 'success';
                }
                else{
                    $message = 'Somethings went wrong. Try again later.';
                }
            }
        }

        return ['message' => $message];
    }
    function Evaluation1(Request $request){
        $message = '';
        $update =  '';
        $this->validate($request, [
            'dt_recommendation' => 'required',
            'dt_sintro' => 'required|numeric|min:70|max:100',
            'dt_sgeneral' => 'required|numeric|min:70|max:100',
            'dt_soral' => 'required|numeric|min:70|max:100',
            'dt_srelated' => 'required|numeric|min:70|max:100',
            'dt_stechnical' => 'required|numeric|min:70|max:100',
            'dt_stotal' => 'required|numeric',
            'dt_pintro' => 'required|numeric',
            'dt_pgeneral' => 'required|numeric',
            'dt_poral' => 'required|numeric',
            'dt_prelated' => 'required|numeric',
            'dt_ptechnical' => 'required|numeric',
            'dt_ptotal' => 'required|numeric',
        ]);
        $eval = DB::table('tbl_documentevaluation1')
                    ->where('dt_grp', $request->dt_grp)
                    ->where('dt_panID', $request->dt_panID)
                    ->update([
                        'dt_date' => date("Y-m-d"),
                        'dt_comments' => $request->dt_comments,
                        'dt_recommendation' => $request->dt_recommendation,
                        'dt_sintro' => $request->dt_sintro,
                        'dt_sgeneral' => $request->dt_sgeneral,
                        'dt_soral' => $request->dt_soral,
                        'dt_srelated' => $request->dt_srelated,
                        'dt_stechnical' => $request->dt_stechnical,
                        'dt_stotal' => $request->dt_stotal,
                        'dt_pintro' => $request->dt_pintro,
                        'dt_pgeneral' => $request->dt_pgeneral,
                        'dt_poral' => $request->dt_poral,
                        'dt_prelated' => $request->dt_prelated,
                        'dt_ptechnical' => $request->dt_ptechnical,
                        'dt_ptotal' => $request->dt_ptotal,
                    ]);
        if($eval){
            $check = DB::table('tbl_documentevaluation1')
                    ->where('dt_grp', $request->dt_grp)
                    ->where('dt_date','!=', null)
                    ->get();
            if($check->count() == 3){
                DB::table('groups')
                    ->where('grp_id', $request->dt_grp)
                    ->update([
                        'caps1' => 3,
                        'grp_percent' => 35,
                        'pan_percent' => 35
                    ]);
                $update = 'updated';
            }
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong. Try again later.';
        }

        return ['message' => $message, $update => $update];
    }
    function Evaluation2(Request $request){
        $message = '';
        $update =  '';
        $this->validate($request, [
            'dt_recommendation' => 'required',
            'dt_sintro' => 'required|numeric|min:70|max:100',
            'dt_sgeneral' => 'required|numeric|min:70|max:100',
            'dt_soral' => 'required|numeric|min:70|max:100',
            'dt_srelated' => 'required|numeric|min:70|max:100',
            'dt_ssystem' => 'required|numeric|min:70|max:100',
            'dt_stotal' => 'required|numeric',
            'dt_pintro' => 'required|numeric',
            'dt_pgeneral' => 'required|numeric',
            'dt_poral' => 'required|numeric',
            'dt_prelated' => 'required|numeric',
            'dt_psystem' => 'required|numeric',
            'dt_ptotal' => 'required|numeric',
        ]);
        $eval = DB::table('tbl_documentevaluation2')
                    ->where('dt_grp', $request->dt_grp)
                    ->where('dt_panID', $request->dt_panID)
                    ->update([
                        'dt_date' => date("Y-m-d"),
                        'dt_comments' => $request->dt_comments,
                        'dt_recommendation' => $request->dt_recommendation,
                        'dt_sintro' => $request->dt_sintro,
                        'dt_sgeneral' => $request->dt_sgeneral,
                        'dt_soral' => $request->dt_soral,
                        'dt_srelated' => $request->dt_srelated,
                        'dt_ssystem' => $request->dt_ssystem,
                        'dt_stotal' => $request->dt_stotal,
                        'dt_pintro' => $request->dt_pintro,
                        'dt_pgeneral' => $request->dt_pgeneral,
                        'dt_poral' => $request->dt_poral,
                        'dt_prelated' => $request->dt_prelated,
                        'dt_psystem' => $request->dt_psystem,
                        'dt_ptotal' => $request->dt_ptotal,
                    ]);
        if($eval){
            $check = DB::table('tbl_documentevaluation2')
                    ->where('dt_grp', $request->dt_grp)
                    ->where('dt_date','!=', null)
                    ->get();
            if($check->count() == 3){
                DB::table('groups')
                    ->where('grp_id', $request->dt_grp)
                    ->update([
                        'caps2' => 3,
                        'grp_percent' => 85,
                        'pan_percent' => 85
                    ]);
                $update = 'updated';
            }
            $message = 'success';
        }
        else{
            $message = 'Somethings went wrong. Try again later.';
        }

        return ['message' => $message, $update => $update];
    }
    function GetCapstone1Validation(Request $request){
        $validation = '';
        $validation2 = '';
        if($request->id == ''){
            $validation = DB::table('tbl_validator1')
                            ->join('users', 'tbl_validator1.val_panID', 'users.id')
                            ->select('users.id', 'users.name', 'tbl_validator1.*')
                            ->where('tbl_validator1.val_grp', $request->grp)
                            ->get();
            $validation2 = DB::table('tbl_validator2')
                            ->join('users', 'tbl_validator2.val_panID', 'users.id')
                            ->select('users.id', 'users.name', 'tbl_validator2.*')
                            ->where('tbl_validator2.val_grp', $request->grp)
                            ->get();
        }
        else{
            $validation = DB::table('tbl_validator1')
                            ->select('tbl_validator1.*')
                            ->where('tbl_validator1.val_grp', $request->grp)
                            ->where('tbl_validator1.val_panID', $request->id)
                            ->get();
            $validation2 = DB::table('tbl_validator2')
                            ->select('tbl_validator2.*')
                            ->where('tbl_validator2.val_grp', $request->grp)
                            ->where('tbl_validator2.val_panID', $request->id)
                            ->get();
        }

        return ['valid' => $validation, 'valid2' => $validation2 ];
    }
    function Validation1(Request $request){
        $message ='';
        $this->validate($request ,[
            'val_doca' => 'required|numeric|min:1|max:10',
            'val_docb' => 'required|numeric|min:1|max:10',
            'val_docc' => 'required|numeric|min:1|max:20',
            'val_docd' => 'required|numeric|min:1|max:20',
            'val_sysa' => 'required|numeric|min:1|max:20',
            'val_sysb' => 'required|numeric|min:1|max:10',
            'val_sysc' => 'required|numeric|min:1|max:10',
        ]);
        $validate = DB::table('tbl_validator1')
                    ->where('val_grp', $request->val_grp)
                    ->where('val_panID', $request->val_panID)
                    ->update([
                        'val_doca' => $request->val_doca,
                        'val_docb' => $request->val_docb,
                        'val_docc' => $request->val_docc,
                        'val_docd' => $request->val_docd,
                        'val_sysa' => $request->val_sysa,
                        'val_sysb' => $request->val_sysb,
                        'val_sysc' => $request->val_sysc,
                        'val_total' => $request->val_total
                    ]);
        if($validate){
            $count = DB::table('tbl_validator1')
                        ->where('val_grp', $request->val_grp)
                        ->where('val_total', '!=', 0)
                        ->get();
            $message = 'success';
            if ($count->count() == 3) {
                DB::table('groups')
                    ->where('grp_id', $request->val_grp)
                    ->update([
                        'grp_percent' => 50,
                        'pan_percent' => 50
                    ]);
            }
        }
        else{
            $message = 'Somethings went wrong. Try again later';
        }

        return ['message' => $message];
    }
    function Validation2(Request $request){
        $message ='';
        $this->validate($request ,[
            'val_doca' => 'required|numeric|min:1|max:10',
            'val_docb' => 'required|numeric|min:1|max:10',
            'val_docc' => 'required|numeric|min:1|max:10',
            'val_docd' => 'required|numeric|min:1|max:10',
            'val_doce' => 'required|numeric|min:1|max:10',
            'val_sysa' => 'required|numeric|min:1|max:10',
            'val_sysb' => 'required|numeric|min:1|max:10',
            'val_sysc' => 'required|numeric|min:1|max:10',
            'val_sysd' => 'required|numeric|min:1|max:10',
            'val_syse' => 'required|numeric|min:1|max:10',
        ]);
        $validate = DB::table('tbl_validator2')
                    ->where('val_grp', $request->val_grp)
                    ->where('val_panID', $request->val_panID)
                    ->update([
                        'val_doca' => $request->val_doca,
                        'val_docb' => $request->val_docb,
                        'val_docc' => $request->val_docc,
                        'val_docd' => $request->val_docd,
                        'val_doce' => $request->val_doce,
                        'val_sysa' => $request->val_sysa,
                        'val_sysb' => $request->val_sysb,
                        'val_sysc' => $request->val_sysc,
                        'val_sysd' => $request->val_sysd,
                        'val_syse' => $request->val_syse,
                        'val_total' => $request->val_total
                    ]);
        if($validate){
            $count = DB::table('tbl_validator2')
                        ->where('val_grp', $request->val_grp)
                        ->where('val_total', '!=', 0)
                        ->get();
            $message = 'success';
            if($count->count() == 3) {
                DB::table('groups')
                    ->where('grp_id', $request->val_grp)
                    ->update([
                        'grp_percent' => 100,
                        'pan_percent' => 100
                    ]);
            }
        }
        else{
            $message = 'Somethings went wrong. Try again later';
        }

        return ['message' => $message];
    }
}
