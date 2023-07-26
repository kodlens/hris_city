

<?php $__env->startSection('content'); ?>
    <personal-data-sheet prop-civils='<?php echo json_encode($civils, 15, 512) ?>'
        prop-citizenships='<?php echo json_encode($citizenships, 15, 512) ?>'
        prop-data='<?php echo json_encode($user, 15, 512) ?>'>
    </personal-data-sheet>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\etien\OneDrive\Desktop\Github Proj\hris_city\resources\views/user/personal-data-sheet.blade.php ENDPATH**/ ?>