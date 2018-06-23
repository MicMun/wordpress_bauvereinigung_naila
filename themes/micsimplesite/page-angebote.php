<?php /* Template Name: Angebote */ ?>

<?php get_header(); ?>
<div class="row justify-content-around mt-3">
   <div class="col-12 col-md-10 order-1">
      <h2>Unsere aktuellen Angebote</h2>
      <br/>
      <?php
         query_posts('post_type=angebot&post_status=publish');

         if ( have_posts() ) : while ( have_posts() ) : the_post();
      ?>
         <?php $custom_fields = get_post_custom( $post->ID ); ?>

         <h5><?php the_title(); ?> <i><small>(Stand: <?php the_date('d.m.Y'); ?>)</small></i></h5>
         <div class="container">
            <div class="row justify-content-start">
               <div class="col-6 col-md-2">
                  Wohnungstyp:
               </div>
               <div class="col-6 col-md-3 ml-auto">
                  <em class="cfvalue"><?php echo $custom_fields["typ"][0]; ?></em>
               </div>
               <div class="col-6 col-md-2">
                  Wohnungsgr&ouml;&szlig;e:
               </div>
               <div class="col-6 col-md-5 ml-auto">
                  <em class="cfvalue"><?php echo $custom_fields["groesse"][0]; ?> qm</em>
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
                  <em class="cfvalue"><?php echo $custom_fields["wbeschreibung"][0]; ?></em>
               </div>
            </div>
            <div class="row">
               <div class="col-4 col-md-2">
                  Kontakt:
               </div>
               <div class="col-8 col-md-10">
                  <em class="cfvalue"><?php echo $custom_fields["wkontakt"][0]; ?></em>
               </div>
            </div>
         </div>
         <br/><br/>
      <?php endwhile; else : ?>
         <p>Aktuell sind keine Wohnungsangebote vorhanden.</p>
      <?php endif; wp_reset_query(); ?>
   </div>
</div>
<?php get_footer(); ?>
