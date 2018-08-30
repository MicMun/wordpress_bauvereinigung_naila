   </div>
   <footer class="footer text-center">
      <nav class="navbar navbar-expand navbar-dark bg-dark">
         <div class="container">
            <?php /* Secondary navigation */
               wp_nav_menu( array(
                              'theme_location'    => 'secondary',
                              'depth'             => 1,
                              'container'         => false,
                              'menu_class'        => 'navbar-nav mr-auto ml-auto list-inline',
                              'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                              'walker' => new WP_Bootstrap_Navwalker())
                           );
            ?>
         </div>
      </nav>
   </footer>
<?php wp_footer(); ?>
</body>
</html>
