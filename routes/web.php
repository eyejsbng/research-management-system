<?php

//Route Index
Route::get('/', function () {
    return view('index');
});
Auth::routes();
Route::post('/regresearchpersonnel', 'Auth\ResearchPersonnelController@register')->name('registerrp');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/account/conflictAccount', function() {
    return view('pages.conflict');
});

//Route for Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function(){
    Route::get('/dashboard', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/profile', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/notification', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/messenger', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/schedule', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/student', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/subjectteacher', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/researchpersonnel', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/capstone1', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/capstone2', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/groupdone', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/viewminutes', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/titleoutlineminutes', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/finalminutes', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/viewdocuments', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/adddocument', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/adviserreports', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/evaluationreport', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/groupprogressreport', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/listofresearchreport', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/researchpersonnelreport', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/schedulereport', function(){
        return view('pages.admin');
    })->middleware('validateuser');
});

//Route for Subject Teacher
Route::group(['prefix' => 'subjectteacher', 'middleware' => ['auth','subjectteacher']], function(){
    Route::get('/dashboard', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/schedule', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/sections1', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/sections2', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/groups', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/profile', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/notification', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/messenger', function(){
        return view('pages.admin');
    })->middleware('validateuser');
});

//Route for Adviser
Route::group(['prefix' => 'adviser', 'middleware' => ['auth','adviser']], function(){
    Route::get('/dashboard', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/profile', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/notification', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/messenger', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/grouprequest', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/capstone1', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/capstone2', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/schedule', function(){
        return view('pages.admin');
    })->middleware('validateuser');
});

//Route for Panel
Route::group(['prefix' => 'panel', 'middleware' => ['auth','panel']], function(){
    Route::get('/dashboard', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/profile', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/notification', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/messenger', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/grouprequest', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/group', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/schedule', function(){
        return view('pages.admin');
    })->middleware('validateuser');
});

//Route for Student
Route::group(['prefix' => 'student', 'middleware' => ['auth','student']], function(){
    Route::get('/dashboard', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/profile', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/notification', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/messenger', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/group', function(){
        return view('pages.admin');
    });
    Route::get('/schedule', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/researchlist', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/evaluation', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/information', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/submission', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/section', function(){
        return view('pages.admin');
    })->middleware('validateuser');
    Route::get('/minutes', function(){
        return view('pages.admin');
    })->middleware('validateuser');
});


Route::get('/linkstorage', function () {
    $exitCode = Artisan::call('storage:link', []);
});
