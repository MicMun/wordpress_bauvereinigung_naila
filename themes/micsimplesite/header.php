<!doctype html>

<html lang="de">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title><?php wp_title('|', 1, 'right'); ?> <?php bloginfo('name'); ?> </title>

   <meta name="theme-color" content="#563d7c">
   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="referrer" content="no-referrer"/>
   <meta http-equiv="content-security-policy" content="frame-src 'none'; referrer no-referrer; X-Content-Type-Options 'nosniff';X-XSS-Protection 1;" />
   <meta name="description" content="<?php bloginfo('description'); ?>" />

<?php wp_head() ?>
</head>
<body>
   <header class="header">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
         <div class="container">
            <a class="navbar-brand" href="<?php bloginfo('url'); ?>"
               aria-label="<?php bloginfo('name'); ?>">
               <?php if ( has_custom_logo() ) : ?>
                  <img src="<?php
                     $custom_logo_id = get_theme_mod( 'custom_logo' );
                     $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                     echo $image[0]; ?>"
                       alt="" class="mx-auto">
               <?php else : ?>
                  <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Logo.jpg"
                       alt="Logo von <?php bloginfo('name'); ?>" class="mx-auto">
            <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <?php /* Primary navigation */
                  wp_nav_menu( array(
                                 'theme_location'    => 'primary',
                                 'depth'             => 2,
                                 'container'         => false,
                                 'menu_class'        => 'navbar-nav mr-auto',
                                 'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                 'walker' => new WP_Bootstrap_Navwalker())
                              );
               ?>
            </div>
         </div>
      </nav>
   </header>

   <div class="container">
