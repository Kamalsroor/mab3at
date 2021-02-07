<!DOCTYPE html>
<html lang="en" <?php if((!cache('direction') && config('config.direction') == 'rtl') || cache('direction') == 'rtl'): ?> dir="rtl" <?php endif; ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="ScriptMint">
        <title><?php echo e(env('APP_NAME')); ?></title>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
        <link rel="shortcut icon" href="/images/favicon.png">
            <link href="<?php echo e(mix('/css/style-rtl.css')); ?>" id="direction" rel="stylesheet">

   


          <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/font-awesome/css/font-awesome.min.css')); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/adminlte.min.css')); ?>">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- bootstrap rtl -->
        <link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/bootstrap-rtl.min.css')); ?>">
        <!-- template rtl version -->
        <link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/custom-style.css')); ?>">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <div class="preloader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
            </div>
        <div id="root">
            <router-view></router-view>
        </div>
            <!-- jQuery -->
    <script src="<?php echo e(asset('admin/plugins/jquery/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo e(asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo e(asset('admin/dist/js/adminlte.min.js')); ?>"></script>
        <script src="/js/lang"></script>
        <script src="<?php echo e(mix('/js/plugin.js')); ?>"></script>
        <script src="<?php echo e(mix('/js/app.js')); ?>"></script>
    </body>
    <?php if(App::environment('production')): ?>
        <script>
          function initFreshChat() {
            window.fcWidget.init({
              token: "9b37e9c3-7b1c-4960-8c27-68abf13e07c0",
              host: "https://wchat.freshchat.com"
            });
          }
          function initialize(i,t){var e;i.getElementById(t)?initFreshChat():((e=i.createElement("script")).id=t,e.async=!0,e.src="https://wchat.freshchat.com/js/widget.js",e.onload=initFreshChat,i.head.appendChild(e))}function initiateCall(){initialize(document,"freshchat-js-sdk")}window.addEventListener?window.addEventListener("load",initiateCall,!1):window.attachEvent("load",initiateCall,!1);
        </script>
    <?php endif; ?>
</html>
<?php /**PATH E:\laragon\www\vue\resources\views/home.blade.php ENDPATH**/ ?>