<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/img/icon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="title" content="CCERMS">
  <meta name="description" content="CCERMS - A Multiplatform Research Management System for College of Computing Education">
  
  <title>
    CCERMS - A Multiplatform Research Management System for College of Computing Education
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />

  {{-- laravel css --}}
  <link rel="stylesheet" href="/css/app.css">

 
  <link rel="stylesheet" href="/new-landing/plugins/bootstrap-4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/new-landing/plugins/meanmenu/meanmenu.css">
  <!-- fonts -->
  <link rel="stylesheet" href="/new-landing/fonts/ep-icon-fonts/css/style.css">
  <link rel="stylesheet" href="/new-landing/fonts/fontawesome-5/css/all.min.css">
  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="/new-landing/css/settings.css">
  <link rel="stylesheet" href="/new-landing/css/style.css">
  
  <script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js-mit@3.0.0/minified/introjs.min.css">
  <!-- <link rel="stylesheet" href="/NewUI/css/main.d810cf0ae7f39f28f336.css"> -->
  <script src="https://kit.fontawesome.com/2c38c92347.js" crossorigin="anonymous"></script>
 </head>

<body class="landing-page sidebar-collapse" style="background-color:white">

  <div id="app" class="site-wrapper">

    <router-view > </router-view>
  
       
  </div>

  <script src="/js/app.js"></script>
  <script src="/assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="/new-landing/plugins/meanmenu/jquery.meanmenu.js"></script>
  <script src="/new-landing/js/active.js"></script>
   
</body>

</html>
