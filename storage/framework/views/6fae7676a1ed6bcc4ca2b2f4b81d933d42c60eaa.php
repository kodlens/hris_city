<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <div>
        <?php echo $__env->yieldContent('extracss'); ?>
    </div>


</head>

<body>

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">

            <a class="navbar-item" href="/">
                <h1 class="ml-5" style="font-weight: bolder; font-size: 1.7em;">LeaMS</h1>
               
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            

            <div class="navbar-end">
                <div class="navbar-item">
                    <?php if(auth()->guard()->check()): ?>
                        <div class="buttons">
                            <button class="button is-danger has-text-weight-bold" 
                                icon-right="logout"
                                onclick="formLogout()">
                                <span class="mdi mdi-logout"></span>
                                Log out
                            </button>
                        </div>

                        <form action="/logout" method="post" id="logout">
                            <?php echo csrf_field(); ?>
                        </form>
                    <?php else: ?>
                        <div class="buttons">
                            <a class="button is-primary" href="/sign-up">
                                <strong>Sign up</strong>
                            </a>
                            <a class="button is-light" href="/login">
                                Log in
                            </a>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        <div class="logo-container">
            <img src="/img/logo.png" class="logo" alt="Tangub City Logo" srcset="">
        </div>

    </nav>

   


    <div id="app">
        <div>
            <?php echo $__env->yieldContent('content'); ?>
        </div>


    </div>

    <script>

       

        document.addEventListener('DOMContentLoaded', () => {

            // Get all "navbar-burger" elements
            const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

            // Add a click event on each of them
            $navbarBurgers.forEach(el => {
                el.addEventListener('click', () => {

                    // Get the target from the "data-target" attribute
                    const target = el.dataset.target;
                    const $target = document.getElementById(target);

                    // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                    el.classList.toggle('is-active');
                    $target.classList.toggle('is-active');

                });
            });

        });


        function formLogout(){
            document.getElementById('logout').submit();
        }


    </script>
</body>

</html>
<?php /**PATH C:\Users\etien\OneDrive\Desktop\Github Proj\hris_city\resources\views/layouts/app.blade.php ENDPATH**/ ?>