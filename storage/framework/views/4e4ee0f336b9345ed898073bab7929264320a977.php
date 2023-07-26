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

    <!-- Fonts -->
    
    

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
</head>

<body>

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
          

            <a class="navbar-item" href="/">
                <h1 class="ml-5" style="font-weight: bolder; font-size: 2em;">LeaMS</h1>
            </a>
      
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
      
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">

            </div>
      
          <div class="navbar-end">
            <a class="navbar-item" href="/home">
                Home
            </a>
            <a class="navbar-item" href="/personal-data-sheet">
                Personal Data Sheet
            </a>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    <?php echo e(strtoupper(\Auth::user()->fname)); ?>

                </a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/change-password">
                        Change Password
                    </a>
                    
                </div>
            </div>

            <div class="navbar-item has-dropdown is-hoverable">
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/change-password">
                        Change Password
                    </a>
                </div>
            </div>
            
            <div class="navbar-item">
              <div class="buttons">
                <a class="button is-outlined is-danger" onclick="logout()">
                    Log out
                    <i class="mdi mdi-logout"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </nav>

      <form id="form-logout" action="/logout" method="post">
        <?php echo csrf_field(); ?>
      </form>


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
            $navbarBurgers.forEach( el => {
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

        function logout(){
            document.getElementById('form-logout').submit();
        }

    </script>
</body>

</html>
<?php /**PATH C:\Users\etien\OneDrive\Desktop\Github Proj\hris_city\resources\views/layouts/user.blade.php ENDPATH**/ ?>