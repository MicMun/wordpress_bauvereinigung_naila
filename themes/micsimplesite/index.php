<?php get_header(); ?>
<div class="row justify-content-around">
      <div class="col-12 al">
         <div class="media">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Banner.jpg"
            alt="Banner mit Bild und Text zur Bauvereinigung Naila" class="mx-auto">
         </div>
      </div>
   </div>
   <div class="row justify-content-around">
      <div class="col-12 col-md-7 order-1 ">
         <h4>Willkommen bei der <?php bloginfo('name'); ?></h4>
      </div>
   <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
