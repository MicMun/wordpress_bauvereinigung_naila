<?php get_header(); ?>
<div class="row justify-content-around mt-3">
   <div class="col-12 col-md-10 order-1">
      <br/>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         <?php $custom_fields = get_post_custom( $post->ID ); ?>

         <h4><?php the_title(); ?> <i><small>(Stand: <?php the_date('d.m.Y'); ?>)</small></i></h4>
         <div class="container">
            <div class="row justify-content-start">
               <div class="col-6 col-md-2">
                  Wohnungstyp:
               </div>
               <div class="col-6 col-md-3 ml-auto">
                  <em class="cfvalue"><?php echo $custom_fields["typ"][0] ?></em>
               </div>
               <div class="col-6 col-md-2">
                  Wohnungsgr&ouml;&szlig;e:
               </div>
               <div class="col-6 col-md-5 ml-auto">
                  <em class="cfvalue"><?php echo $custom_fields["groesse"][0] ?> qm</em>
               </div>
            </div>
            <div class="row">
               <div class="col-6 col-md-2">
                  Stockwerk:
               </div>
               <div class="col-6 col-md-3">
                  <em class="cfvalue"><?php echo $custom_fields["stockwerk"][0]; ?></em>
               </div>
               <div class="col-6 col-md-2">
                  Kaltmiete:
               </div>
               <div class="col-6 col-md-3">
                  <em class="cfvalue"><?php echo number_format($custom_fields["kaltmiete"][0], 2, ",", "."); ?> &euro;</em>
               </div>
            </div>
            <div class="row">
               <div class="col-6 col-md-2">
                  Nebenkosten:
               </div>
               <div class="col-6 col-md-5">
                  <em class="cfvalue"><?php echo $custom_fields["nebenkosten"][0]; ?></em>
               </div>
            </div>
            <div class="row">
               <div class="col-4 col-md-2">
                  Beschreibung:
               </div>
               <div class="col-8 col-md-10">
                  <em class="cfvalue"><?php echo $custom_fields["wbeschreibung"][0] ?></em>
               </div>
            </div>
            <div class="row">
               <div class="col-4 col-md-2">
                  Kontakt:
               </div>
               <div class="col-8 col-md-10">
                  <em class="cfvalue"><?php echo $custom_fields["wkontakt"][0] ?></em>
               </div>
            </div>
         </div>
      <?php endwhile; endif; ?>
   </div>
</div>
<?php get_footer(); ?>
