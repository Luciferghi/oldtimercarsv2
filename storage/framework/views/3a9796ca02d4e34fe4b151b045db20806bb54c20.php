<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo e(isset($title) ? $title.' :: '.config('app.name').' Admin' : config('app.name').' Admin'); ?>

    </title>
    
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <?php echo $__env->yieldContent('before_styles'); ?>
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/')); ?>/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/')); ?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/')); ?>/dist/css/skins/_all-skins.min.css">
    
    <link rel="stylesheet" href="<?php echo e(asset('vendor/admin/pnotify/pnotify.custom.min.css')); ?>">
    
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/adminlte/')); ?>/plugins/iCheck/square/blue.css">
    
    <!-- Admin Global CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('vendor/admin/style.css') . vTime()); ?>">

    <?php echo $__env->yieldContent('after_styles'); ?>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <?php echo $__env->yieldContent('recaptcha_scripts'); ?>
</head>
<body class="hold-transition <?php echo e(config('larapen.admin.skin')); ?> login-page">
<div class="login-box">
    
    <div class="login-logo">
        <a href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(\Storage::url(config('settings.app.logo')) . getPictureVersion()); ?>" style="width:200px; height:auto;">
        </a>
    </div>
    <!-- /.login-logo -->
    
    <?php echo $__env->yieldContent('content'); ?>
    
</div>
<!-- /.login-box -->

<?php echo $__env->yieldContent('before_scripts'); ?>

<!-- jQuery 2.2.3 -->
<script src="<?php echo e(asset('vendor/adminlte/')); ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(asset('vendor/adminlte/')); ?>/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo e(asset('vendor/adminlte/')); ?>/plugins/iCheck/icheck.min.js"></script>

<script src="<?php echo e(asset('vendor/adminlte')); ?>/dist/js/app.min.js"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>

<?php echo $__env->make('admin::inc.alerts', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('after_scripts'); ?>

</body>
</html>
