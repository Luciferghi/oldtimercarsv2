<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav"></ul>
</div>


<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        
        <li><a href="<?php echo e(url('/')); ?>" target="_blank"><i class="fa fa-home"></i> <span><?php echo e(trans('admin::messages.Home')); ?></span></a></li>
        
        <?php if(auth()->guest()): ?>
            <li><a href="<?php echo e(admin_url('login')); ?>"><?php echo e(trans('admin::messages.login')); ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo e(admin_url('logout')); ?>"><i class="fa fa-btn fa-sign-out"></i> <?php echo e(trans('admin::messages.logout')); ?></a></li>
        <?php endif; ?>
        
    </ul>
</div>
