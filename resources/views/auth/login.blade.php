<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        CCERMS | Login
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link rel="stylesheet" href="/new-landing/plugins/bootstrap-4.3.1/css/bootstrap.min.css">
    <link href="https://unpkg.com/tailwindcss@1.4.6/dist/tailwind.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <link href="../assets/css/material-kit.mind1f1.css?v=2.2.0" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/2c38c92347.js" crossorigin="anonymous"></script> -->

</head>
<style>
    body {
        background-color: #fcfcfc;
    }

    img {
        margin-left: auto;
        margin-right: auto;

    }

    a {
        color: #3697f7
    }
</style>

<body>

    <!-- <div class="container">
   
    <a href="/"> <img src="/img/CCE.png" width="220px" style="display:block;margin-left: auto;
    margin-right: auto;margin-bottom:-25px">
    </a>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                  <h2 class="text-center" style="color:#6a6d73">Sign in to continue</h2>

                    @if ($errors->has('email'))

                    <div class="alert alert-danger">

                        <div class="alert-icon">
                            <i class="material-icons">warning</i>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="material-icons">clear</i></span>
                        </button>
                        <strong>{{ $errors->first('email') }}</strong><br>
                        <strong>{{ $errors->first('password') }}</strong>

                    </div>
                    @endif
                    <div class="card card-login card-hidden">


                        <div class="card-body ">
                    
                            <span class="bmd-form-group md-valid">
                                <div class="input-group ">
                                    <div class="input-group-prepend ">
                                        <span class="input-group-text">
                                            <i class="material-icons">email</i>
                                        </span>
                                    </div>

                                    <input type="email" name="email" id="email" class="form-control md-input"
                                        value="{{ old('email') }}" placeholder="Email">
                                </div>
                            </span>
                            <div class="invalid-feedback">{{ $errors->first('email') }} </div>
                            <span class="bmd-form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">lock_outline</i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password">
                                </div>
                            </span>

                        </div>
                        <div class="card-footer justify-content-center">

                            <div class="d-grid gap-2 col-12 mt-3">
                                <button type="submit" style="width:100%" class="btn btn-block btn-github">Login</button>
                            </div>
                        </div>
                       
                    </div>
                  
                            
                      
                </form>
                <p class="text-center" style="color:black;"><strong>Don't have an account? <a href="/register">Sign up here</a></strong></p>
            </div>
        </div>
    </div> -->
    
    
    <div class="row mt-5">
            <a  class="mx-auto" href="/"><img src="/img/logo.png" width="200" height="70"></a>         
    </div>
    <div class="row mt-5">
    <form method="POST" action="{{ route('login') }}"
            class="max-w-md border border-gray-200 shadow-xs mx-auto rounded-lg p-10 bg-white text-center space-y-6 flex-grow">
            <h4 class="items-center text-black">Sign in to continue</h4>
           
            @csrf
            <div class="flex flex-col">
                <label for="email" class="self-start mb-2 font-medium text-gray-800">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="j.delacruz.12345@email.com"
                    class="outline-none px-2 py-2 border shadow-sm text-black placeholder-gray-500 opacity-50 rounded"
                    autocomplete="off" />
                    <p class="self-start text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
            </div>
            <div class="flex flex-col">
                <label for="pass" class="self-start mb-2 font-medium text-gray-800">Password</label>
                <input type="password" name="password" placeholder="********"
                    class="outline-none px-2 text-black py-2 border shadow-sm placeholder-gray-500 opacity-50 rounded"
                    autocomplete="off" />
            </div>
            <div class="flex justify-between">

                <!-- <span class="text-indigo-A300 font-semibold text-gray-800"
                  >Forgot Password?</span
               > -->
            </div>
            <button style="width:100%;padding:10px;background-color:#198cf7;color:white;border-radius:10px">
                Sign in
            </button>
            <div class="flex items-center text-gray-800">
                <div class="mx-auto text-center">Don't have an account? <a href="/register">Sign up here</a></div>
            </div>
            <div class="flex justify-around text-center divide-x divide-gray-300">


            </div>
        </form>
    </div>
        
   

    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>



</body>


</html>