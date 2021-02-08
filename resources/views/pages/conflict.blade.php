<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CCERMS | Conflict Account</title>

        <!-- Fonts -->
        <link rel="icon" type="image/png" href="/img/icon.png">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    </head>
    <style>
      
    </style>
    <body>
        <div class="container justify-content-center" style="margin-top:240px;">
            <div class="content">
                
                <div class="row">
                    
                    <div class="col-lg-12 col-sm-12">
                        <h1 class="text-center">
                            Account is pending for approval, wait for the admin to update!
                        </h1>
                        <p class="text-center text-danger">You will be notify via email once your account has been approve.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12 mr-auto ml-auto">
                        <a href="/student/dashboard" class="btn btn-primary btn-block">Check for Update</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
