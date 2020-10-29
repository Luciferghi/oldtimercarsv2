<?php $__env->startSection('content'); ?>
	
	<?php if(isset($errors) and $errors->any()): ?>
		<div class="col-xl-12 m-t-15">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php echo e($error); ?><br>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	<?php endif; ?>
    
    <div class="login-box-body">
        <p class="login-box-msg"><?php echo e(trans('admin::messages.administration')); ?></p>
        
        <form action="<?php echo e(admin_url('login')); ?>" method="post">
            <?php echo csrf_field(); ?>

            
            <div class="form-group has-feedback<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                <input type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-control" placeholder="<?php echo e(trans('admin::messages.email_address')); ?>">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
            
            <div class="form-group has-feedback<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                <input type="password" name="password" class="form-control" placeholder="<?php echo e(trans('admin::messages.password')); ?>">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    
                <?php if($errors->has('password')): ?>
                    <span class="help-block">
                        <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
	
			<?php echo $__env->make('layouts.inc.tools.recaptcha', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <div class="row">
                <div class="col-xs-7">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> <?php echo e(trans('admin::messages.remember_me')); ?>

                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-5">
                    <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo e(trans('admin::messages.login')); ?></button>
                </div>
                <!-- /.col -->
            </div>
            
        </form>
        
        <a href="<?php echo e(admin_url('password/reset')); ?>"><?php echo e(trans('admin::messages.forgot_your_password')); ?></a><br>
    
    </div>
    <!-- /.login-box-body -->
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::auth.layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>