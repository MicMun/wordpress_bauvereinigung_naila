
<?php if ( is_front_page() ) : ?>
   <?php if (!function_exists('dynamic_sidebar') || dynamic_sidebar('Sidebar')) : ?>
   <?php endif; ?>

<?php else : ?>

   <?php if (!function_exists('dynamic_sidebar') || dynamic_sidebar('Kontaktform')) : ?>
   <?php endif; ?>

<?php endif; ?>
