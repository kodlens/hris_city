


<?php $__env->startSection('extracss'); ?>
    <style>
        
       
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="welcome-container">
        <div class="columns is-centered w-margin-top">
            <div class="column">
                <div class="title-content is-flex is-flex-direction-column is-justify-content-center is-align-content-center">
                    <div class="welcome-title">LeaMS</div>
                    <p class="welcome-subtitle">A Multiplatform Employee Leave Management System for the LGU of Tangub City</p>
                </div>
            </div>

            <div class="column">
                <div class="box">
                    <div class="box-heading">Login Account</div>

                    <div class="box-body">
                        <login-component></login-component>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\etien\OneDrive\Desktop\Github Proj\hris_city\resources\views/welcome.blade.php ENDPATH**/ ?>