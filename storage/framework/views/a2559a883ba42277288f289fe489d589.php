<?php
    use Knuckles\Scribe\Tools\Utils as u;
?>
# <?php echo e(u::trans("scribe::headings.auth")); ?>


<?php if(!$isAuthed): ?>
<?php echo u::trans("scribe::auth.none"); ?>

<?php else: ?>
<?php echo $authDescription; ?>


<?php echo $extraAuthInfo; ?>

<?php endif; ?>
<?php /**PATH C:\Users\Richard\Documents\GitHub\quiero-tu-voz-api\resources\views/vendor/scribe/markdown/auth.blade.php ENDPATH**/ ?>