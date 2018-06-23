<?php /* Template Name: Kontakt */ ?>

<?php get_header(); ?>
<div class="row justify-content-around mt-3">
   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
   <div class="col-12 col-md-8 order-1">
      <?php the_content('Weiterlesen...'); ?>
      <?php endwhile; endif; ?>
   </div>
   <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
