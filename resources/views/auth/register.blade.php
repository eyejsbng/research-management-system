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
        CCERMS | Registration
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <link href="https://unpkg.com/tailwindcss@1.4.6/dist/tailwind.min.css" rel="stylesheet">
    <link rel="canonical" href="https://www.creative-tim.com/product/material-kit-pro" />
    <meta name="keywords"
        content="bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, material, material kit, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit, premium bootstrap 4 ui kit, premium template, bootstrap 4 template">
    <meta name="description"
        content="Start Your Development With A Badass Bootstrap 4 UI Kit inspired by Material Design">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <!-- <link href="../assets/css/material-kit.mind1f1.css?v=2.2.0" rel="stylesheet" /> -->
    <link rel="stylesheet" href="/NewUI/css/main.d810cf0ae7f39f28f336.css">
</head>
<style>
    a {
        color: #3697f7
    }

</style>

<body>
    <div class="">
        <!-- <a href="/">
            <img src="/img/CCE.png" width="220px" style="display:block;margin-left: auto;
    margin-right: auto;margin-bottom:-25px">
        </a> -->
        <!-- <div class="row">

            <div class="col-md-6 mx-auto">
                <h2 class="text-center" style="color:#6a6d73">Register to continue</h2>
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-danger">

                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active show" href="#profile" data-toggle="tab">
                                            <i class="material-icons">face</i>
                                            Student
                                            <div class="ripple-container"></div></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#messages" data-toggle="tab">
                                            <i class="material-icons">admin_panel_settings</i>
                                            Research Personnel
                                            <div class="ripple-container"></div></a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="tab-content text-center">
                            <div class="tab-pane active show" id="profile">
                                <form method="POST" action="{{ route('register') }}" class="form">
                                    @csrf
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">account_circle</i>
                                                </span>
                                            </div>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}" placeholder="Full Name">
                                        </div>
                                    </span>
                                    <strong>{{ $errors->first('name') }}</strong>
                                    <br>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">email</i>
                                                </span>
                                            </div>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="Email">
                                        </div>
                                    </span>
                                    <strong>{{ $errors->first('email') }}</strong>
                                    <br>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">lock</i>
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password">
                                        </div>
                                    </span>
                                    <strong>{{ $errors->first('password') }}</strong>
                                    <br>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">lock</i>
                                                </span>
                                            </div>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Confirm Password">
                                        </div>
                                    </span>
                                    <br>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">school</i>
                                                </span>
                                            </div>
                                            <select class="form-control selectpicker" data-style="btn btn-link"
                                                name="course">
                                                @foreach($courses as $course)
                                                <option id="course" value="{{ $course->crs_id }}">
                                                    {{ $course->crs_title }}</option>
                                                @endforeach


                                            </select>
                                        </div>
                                    </span>
                                    <strong>{{ $errors->first('password') }}</strong>
                                    <br>

                                    <button type="submit" class="btn btn-github btn-block brn-round"><i
                                            class="material-icons">forward</i> Register</button>
                                </form>
                            </div>
                            <div class="tab-pane" id="messages">
                                <form method="POST" action="{{ route('registerrp') }}" class="form">
                                    @csrf
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">account_circle</i>
                                                </span>
                                            </div>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ old('name') }}" placeholder="Full Name">
                                        </div>
                                    </span>
                                    <strong>{{ $errors->first('name') }}</strong>
                                    <br>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">email</i>
                                                </span>
                                            </div>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email') }}" placeholder="Email">
                                        </div>
                                    </span>
                                    <strong>{{ $errors->first('email') }}</strong>
                                    <br>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">lock</i>
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password">
                                        </div>
                                    </span>
                                    <strong>{{ $errors->first('password') }}</strong>
                                    <br>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">lock</i>
                                                </span>
                                            </div>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Confirm Password">
                                        </div>
                                    </span>
                                    <br>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">local_library</i>
                                                </span>
                                            </div>
                                            <input type="text" name="specialty" class="form-control"
                                                value="{{ old('specialty') }}" placeholder="Specialization">
                                        </div>
                                    </span>
                                    <strong>{{ $errors->first('specialty') }}</strong>
                                    <br>
                                    <span class="bmd-form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">account_circle</i>
                                                </span>
                                            </div>
                                            <select class="form-control selectpicker" data-style="btn btn-link"
                                                name="usertype">
                                                @foreach($usertypes as $usertype)
                                                <option id="usertype" value="{{ $usertype->typ_id }}">
                                                    {{ $usertype->typ_title }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </span>
                                    <strong>{{ $errors->first('usertype') }}</strong>
                                    <br>

                                    <button type="submit" class="btn btn-raised btn-github btn-block"> <i
                                            class="material-icons">forward</i>Register</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div> -->

    </div>
    <div class="row mt-5">
        <a class="mx-auto" href="/"><img src="/img/logo.png" width="200" height="70"></a>
    </div>
    <div class="mx-auto col-md-5 mt-5">
        <div class="mb-3 card">
            <div class="p-0 card-body">
                <div class="dropdown-menu-header mt-0 mb-0">
                    <div class="dropdown-menu-header-inner">

                        <div class="menu-header-content text-dark">
                            <h4 class="menu-header-title">Sign up</h4>

                        </div>
                    </div>
                </div>
                <ul class=" tabs-animated nav nav-justified p-3">
                    <li class="nav-item">
                        <a role="tab" class="nav-link active show" id="tab-c-0" data-toggle="tab" href="#tab-animated-0"
                            aria-selected="false">
                            <span class="mx-auto">Student</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a role="tab" class="nav-link" id="tab-c-1" data-toggle="tab" href="#tab-animated-1"
                            aria-selected="false">
                            <span class="mx-auto"> Research Personnel</span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-animated-0" role="tabpanel">
                        <form class="m-3" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="w-full">
                                        <label class="self-start block  text-gray-700  font-bold mb-2">
                                            Full Name
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                            type="text" name="name" value="{{ old('name') }}"
                                            placeholder="Juan Dela Cruz">
                                        <p class="text-red-500 text-xs">{{ $errors->first('name') }}</p>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class=" w-full">

                                        <label class="self-start block  text-gray-700  font-bold mb-2"">
                                            Email
                                        </label>
                                        <input
                                            class=" appearance-none block w-full bg-gray-100 text-gray-700 border
                                            border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none
                                            focus:bg-white focus:border-gray-500" name="email"
                                            value="{{ old('email') }}" type="text"
                                            placeholder="j.delacruz.123456@email.com">
                                            <p class="text-red-500 text-xs">{{ $errors->first('email') }}</p>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="w-full">
                                        <label class="self-start block  text-gray-700  font-bold mb-2">
                                            Password
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            name="password" type="password" placeholder="******************">
                                        <p class="text-red-500 text-xs">{{ $errors->first('password') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="w-full">
                                        <label class="self-start block  text-gray-700  font-bold mb-2">
                                            Confirm Password
                                        </label>
                                        <input
                                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            type="password" name="password_confirmation"
                                            placeholder="******************">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="w-full">
                                        <label class="self-start block  text-gray-700  font-bold mb-2"">
                                            Course
                                        </label>
                                        <div class=" relative">
                                            <select
                                                class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                name="course">
                                                @foreach($courses as $course)
                                                <option id="course" value="{{ $course->crs_id }}">
                                                    {{ $course->crs_title }}</option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg>
                                            </div>
                                            <p class="text-red-500 text-xs">{{ $errors->first('course') }}</p>
                                    </div>
                                </div>

                            </div>
                    </div>
                    <div class="row">
                        <div class="mt-4 w-full px-3">
                            <button type="submit"
                                style="width:100%;padding:10px;background-color:#198cf7;color:white;border-radius:10px">
                                Register
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="tab-pane" id="tab-animated-1" role="tabpanel">
                    <form class="m-3" method="POST" action="{{ route('registerrp') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="w-full">
                                    <label
                                        class="self-start block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Full Name
                                    </label>
                                    <input
                                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                        name="name" value="{{ old('name') }}" type="text" placeholder="Jane">
                                    <p class="text-red-500 text-xs">{{ $errors->first('name') }}</p>
                                </div>

                            </div>
                            <div class="col-md-6"">
                                <div class=" w-full">

                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    Email
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    type="email" name="email" value="{{ old('email') }}" placeholder="Doe">
                                <p class="text-red-500 text-xs">{{ $errors->first('email') }}</p>
                            </div>
                        </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6"">
                                <div class=" w-full px-3">

                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Field of Expertise
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="text" name="specialty" value="{{ old('specialty') }}"
                        placeholder="Data Mining, C++, Java, System Analysis and Design">
                    <p class="text-red-500 text-xs">{{ $errors->first('specialty') }}</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="self-start block uppercase  text-gray-700  font-bold mb-2">
                        Password
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="password" type="password" placeholder="******************">
                    <p class="text-red-500 text-xs">{{ $errors->first('password') }}</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Confirm Password
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        name="password_confirmation" type="password" placeholder="******************">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">

                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Account Type
                    </label>
                    <div class="relative">
                        <select
                            class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="usertype">
                            @foreach($usertypes as $usertype)
                            <option id="usertype" value="{{ $usertype->typ_id }}">{{ $usertype->typ_title }}
                            </option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-red-500 text-xs">{{ $errors->first('usertype') }}</p>
                </div>
                <div class="mt-4 w-full px-3">
                    <button type="submit"
                        style="width:100%;padding:10px;background-color:#198cf7;color:white;border-radius:10px">
                        Register
                    </button>

                </div>
            </div>
            </form>
        </div>
    </div>
    </div>
    </div>
    <p class="text-center">Do you have already an account? <a href="/login">Click here to login</a></p>
    </div>
    <!-- <div class="bg-gray-100 w-full justify-center items-center ,">

        <div
            class="max-w-md border border-gray-200 shadow-xs mx-auto rounded-lg p-10 bg-white text-center space-y-6 flex-grow">
            <div class="max-w-lg flex flex-wrap" data-tabs="tabs">
                <div class="w-1/2  h-12"> <a data-toggle="tab" href="#student"
                        style="width:100%;padding:10px;background-color:#198cf7;color:white;">
                        Student
                    </a></div>
                <div class="w-1/2  h-12"> <a data-toggle="tab" href="#rp"
                        style="width:100%;padding:10px;background-color:#198cf7;color:white;">
                        Research Personnel
                    </a></div>
            </div>
            <form class="tab-pane w-full max-w-lg" id="student">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="self-start block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Full Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-100 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="Jane">
                        <p class="text-red-500 text-xs">Please fill out this field.</p>
                    </div>

                </div>
                <div class="flex flex-wrap -mx-3 mb-6"">
        <div class=" w-full px-3">

                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-last-name">
                        Email
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="text" placeholder="Doe">
                </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="self-start block uppercase  text-gray-700  font-bold mb-2" for="grid-password">
                    Password
                </label>
                <input
                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-password" type="password" placeholder="******************">
                <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Confirm Password
                </label>
                <input
                    class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-password" type="password" placeholder="******************">
                <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">

            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                    State
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state">
                        <option>New Mexico</option>
                        <option>Missouri</option>
                        <option>Texas</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mt-4 w-full px-3">
                <button style="width:100%;padding:10px;background-color:#198cf7;color:white;border-radius:10px">
                    Register
                </button>

            </div>
        </div>
        </form>
        <form class="tab-pane w-full max-w-lg" id="rp">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="self-start block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Full Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-first-name" type="text" placeholder="Jane">
                        <p class="text-red-500 text-xs">Please fill out this field.</p>
                    </div>

                </div>
                <div class="flex flex-wrap -mx-3 mb-6"">
        <div class=" w-full px-3">

                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-last-name">
                        Emailsss
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-last-name" type="text" placeholder="Doe">
                </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="self-start block uppercase  text-gray-700  font-bold mb-2" for="grid-password">
                    Password
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-password" type="password" placeholder="******************">
                <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Confirm Password
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-password" type="password" placeholder="******************">
                <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">

            <div class="w-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
                    State
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state">
                        <option>New Mexico</option>
                        <option>Missouri</option>
                        <option>Texas</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mt-4 w-full px-3">
                <button style="width:100%;padding:10px;background-color:#198cf7;color:white;border-radius:10px">
                    Register
                </button>

            </div>
        </div>
        </form>


    </div> -->
    </div>



    <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
    <script src="../assets/js/plugins/moment.min.js"></script>
    <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
    <script src="../assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2Yno10-YTnLjjn_Vtk0V8cdcY5lC4plU"></script>
    <script src="../assets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="../assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
    <!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="../assets/js/plugins/jasny-bootstrap.min.js" type="text/javascript"></script>
    <!--	Plugin for Small Gallery in Product Page -->
    <script src="../assets/js/plugins/jquery.flexisel.js" type="text/javascript"></script>
    <!-- Plugins for presentation and navigation  -->
    <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-kit.mind1f1.js?v=2.2.0" type="text/javascript"></script>
</body>


</html>
