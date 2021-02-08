<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Admin Routes
Route::get('/adminDashboard', 'AdminController@Dashboard'); //Count aLL the user and etc.
Route::get('/Dependencies', 'AdminController@Dependencies'); //get dependencies for admin
Route::get('/adviserlist', 'AdminController@AdviserList'); //get all AdviserList
Route::get('/panellist', 'AdminController@PanelList'); //get all PanelList
Route::get('/getc3list', 'AdminController@Getc3List');// get Done Group
Route::post('/createarchiveresearch', 'AdminController@CreateArchiveResearch'); //create Archived Research
Route::post('/updatearchiveresearch', 'AdminController@UpdateArchiveResearch'); //update Archived Research
Route::get('/archiveresearch', 'AdminController@Archiveresearch'); //get all archived research
Route::get('/searcharchived', 'AdminController@ArchivedSearch'); //searching for archived research
Route::get('/getgroupsfordefense/{id}', 'AdminController@GetGroupsforDefense'); // get Groups for Defense
Route::post('/createdefenseschedule', 'AdminController@CreateDefenseSchedule'); // Create Defense Schedule
Route::post('/updatedefenseschedule', 'AdminController@UpdateDefenseSchedule'); // Update Defense Schedule
Route::post('/searchdefenseschedule', 'AdminController@SearchDefenseSchedule'); // Search Defense Schedule
Route::get('/getdefenseschedule', 'AdminController@GetDefenseSchedule'); // get Defense Schedule
Route::post('/getminutes', 'AdminController@GetMinutes'); // get Group Minutes
Route::post('/createtitleoutlineminutes', 'AdminController@CreateTitleOutlineMinutes'); //Create Group Title Outline Minutes
Route::post('/createfinalminutes', 'AdminController@CreateFinalMinutes'); //Create Group Final Minutes
Route::post('/getmessenger', 'AdminController@GetMessenger'); // get users and groups for messenger
//Users
    //student for admin
Route::get('/allstudent', 'AdminController@AllStudent'); //get all student data
Route::post('/CreateStudent', 'AdminController@CreateStudent'); // create new student
Route::post('/updatestudent', 'AdminController@UpdateStudent'); //update student
Route::post('/searchstudent', 'AdminController@SearchStudent'); //search student
    // st for admin
Route::get('/allst', 'AdminController@AllST'); //get all st data
Route::post('/createST', 'AdminController@CreateST'); //create new st
Route::post('/updateST', 'AdminController@UpdateST'); //update st
Route::post('/searchST', 'AdminController@SearchST'); //search st
    // rp for admin
Route::get('/allRP', 'AdminController@AllRP'); //get all st data
Route::post('/createRP', 'AdminController@CreateRP'); //create new st
Route::post('/updateRP', 'AdminController@UpdateRP'); //update st
Route::post('/searchRP', 'AdminController@SearchRP'); //search st
//End of Users
//Groups
    //Capstone 1
Route::get('/selectCap1/{id}', 'AdminController@SelectCapstone1'); //get Capstone 1 Information
Route::post('/selectadviser', 'AdminController@SelectAdviser'); //Select Adviser for Capstone 1
Route::post('/selectpanel', 'AdminController@SelectPanel'); //Select Panel for Capstone 1
Route::post('/changegrouppanel', 'AdminController@ChangeGroupPanel'); //Change Panel for Group
Route::post('/uploadplagiarism', 'AdminController@UploadPlagiarism'); //Upload Plagiarism
Route::post('/capstoneapproval', 'AdminController@CapstoneApproval'); //Capstone Approval
Route::get('/finaldocuments/{id}', 'AdminController@FinalDocuments'); //Get Capstone 1 Final Documents
    //Capstone 2
Route::post('/adminsystemcheckcaps2', 'AdminController@AdminSystemCheckCaps2'); // Admin will check the certificaes

    //Done Groups
Route::post('/checklistdecission', 'AdminController@ChecklistDecission'); //Admin will decide the final Checklist
// Reports API
Route::get('/getadviserlist', 'AdminController@GetAdviserList');
Route::get('/getresearchperson', 'AdminController@GetResearchPerson');
Route::get('/getsectionlist', 'AdminController@GetSectionList');
Route::get('/getsectiongrouprogress/{id}', 'AdminController@GetSectionGroupProgress');

//Adviser Routes
Route::get('/getadvisergrouprequest/{id}', 'AdviserController@GetAdviserGroupRequest'); //get groups request for adviser
Route::post('/updateadvisergroups', 'AdviserController@UpdateAdviserGroups'); //Decssion for group request
Route::get('/getadvisercapstone1/{id}', 'AdviserController@GetAdviserCapstone1'); //get Capstone 1 for adviser
Route::post('/getcapstone1checkdocs', 'AdviserController@GetCapstone1CheckDocs'); //get Capstone1 check documents
Route::post('/advisercheckcaps1docs', 'AdviserController@AdviserCheckCaps1Docs'); //Adviser Check Capston1 Documents
Route::get('/getcapstone1checksys/{id}', 'AdviserController@GetCapstone1CheckSys'); // get Capstone 1 check System
Route::post('/adviserchecksystem', 'AdviserController@AdviserCheckSystem'); //Adviser Check Capstone 1 System
Route::post('/uploadgrammarly', 'AdviserController@UploadGrammarly'); //Adviser Upload Capstone 1 Grammarly
Route::get('/getcapstone1grammarly/{id}', 'AdviserController@getCapstone1Grammarly'); //Adviser get Capstone 1 Grammarly

//Panel Routes
Route::get('/getpanelgrouprequest/{id}', 'PanelController@GetPanelGroupRequest'); //get group request for panel
Route::post('/updatepanelgroups', 'PanelController@UpdatePanelGroups'); //decession for group request
Route::get('/getpanelgroups/{id}', 'PanelController@GetPanelGroups'); //Get Panel Groups
Route::get('/getratingscale', 'PanelController@GetRatingScale'); //Get Rating Scale
Route::post('/decissionsubmission', 'PanelController@DecissionSubmission'); //Decission for Capstone Documents
Route::post('/getcapstone1evaluation', 'PanelController@GetCapstone1Evaluation'); //Get Capstone 1 Document Evaluation
Route::post('/getcapstone1revisefile', 'PanelController@GetCapstone1Revisefile'); // Get Panel Revise file
Route::post('/panelsendreviserfile', 'PanelController@PanelSendReviseFile'); // Panel Send Revise File
Route::post('/updatepanelsendreviserfile', 'PanelController@UpdatePanelSendReviserFile'); //Panel Update Revise File
Route::post('/panelevaluation1', 'PanelController@Evaluation1'); //Capstone 1 Evaluation
Route::post('/panelevaluation2', 'PanelController@Evaluation2'); //Capstone 1 Evaluation
Route::post('/getcastone1validation', 'PanelController@GetCapstone1Validation'); // Get Capstone 1 validation
Route::post('/caps1validate', 'PanelController@Validation1'); //Capstone 1 Validation
Route::post('/caps2validate', 'PanelController@Validation2'); //Capstone 2 Validation

//Subject Teacher Routes
Route::get('/getstdashboard/{id}', 'SubjectteacherController@Dashboard'); //Subject Teacher Dashboard

//Student Routes
Route::post('/createGroup', 'StudentController@CreataGroup'); //student create group
Route::post('/JoinGroup', 'StudentController@JoinGroup'); //student join group
Route::post('/JoinSection', 'StudentController@JoinSection'); //student join section
Route::get('/Capstone1Info', 'StudentController@Capstone1Info');//student get information in capstone 1 status
Route::get('/getstudentgroupschedule/{id}', 'StudentController@GetStudentGroupSchedule'); //Student get Schedule

    //get Section List
Route::get('/getsectionlist/{id}', 'StudentController@GetSectionList'); //Student Get Section List
Route::post('/updategroupsection', 'StudentController@UpdateGroupSection'); //Student Update GroupSection



    //Group Submission
Route::post('/SubmitDocs', 'StudentController@SubmitDocs'); //student submit chapters
Route::post('/UpdateDocs', 'StudentController@UpdateDocs'); //Student update chapters
Route::get('/getcapstone1submitteddocs/{id}', 'StudentController@GetCapstone1SubmittedDocs');// student get Submitted docs
Route::post('/groupsubmitrevisetopanel', 'StudentController@GroupSubmitReviseToPanel'); //Group Submit Revise File to Panel
Route::post('/updategroupsubmitrevisetopanel', 'StudentController@UpdateGroupSubmitReviseToPanel'); // Update Group Revise File
Route::get('/getsystemcertificate/{id}', 'StudentController@GetSystemCertificate'); // Get Group Certificate
Route::post('/uploadsystemcertificate', 'StudentController@UploadSystemCertificate'); //Group Submit Certificates
Route::post('/updatesystemcertificate', 'StudentController@UpdateSystemCertificate'); //Group Update Certificates
Route::post('/finalsubmission', 'StudentController@FinalSubmission'); //Group Final Submission
Route::get('/getfinalchecklist/{id}', 'StudentController@GetFinalChecklist'); //Group Get Final Checklist/Submission
Route::post('/updatefinalsubmission', 'StudentController@UpdateFinalSubmission'); //Group Update Final Submission

//For Mobile Routes
Route::post('/m/login', 'MobileController@Login'); // login api for mobile
Route::post('/m/register', 'MobileController@Register'); //register api for mobile
