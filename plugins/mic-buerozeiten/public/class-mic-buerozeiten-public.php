<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    mic-buerozeiten
 * @subpackage mic-buerozeiten/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    mic-buerozeiten
 * @subpackage mic-buerozeiten/public
 * @author     Michael Munzert <Mic.Mun@gmx.de>
 */
class Mic_Buerozeiten_Public {

   /**
    * The ID of this plugin.
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $plugin_name    The ID of this plugin.
    */
   private $plugin_name;

   /**
    * The version of this plugin.
    *
    * @since    1.0.0
    * @access   private
    * @var      string    $version    The current version of this plugin.
    */
   private $version;

   /**
    * Initialize the class and set its properties.
    *
    * @since    1.0.0
    * @param      string    $plugin_name       The name of the plugin.
    * @param      string    $version    The version of this plugin.
    */
   public function __construct( $plugin_name, $version ) {

      $this->plugin_name = $plugin_name;
      $this->version = $version;

   }

   /**
    * Register the stylesheets for the public-facing side of the site.
    *
    * @since    1.0.0
    */
   public function enqueue_styles() {

      /**
       * This function is provided for demonstration purposes only.
       *
       * An instance of this class should be passed to the run() function
       * defined in Mic_Buerozeiten_Loader as all of the hooks are defined
       * in that particular class.
       *
       * The Mic_Buerozeiten_Loader will then create the relationship
       * between the defined hooks and the functions defined in this
       * class.
       */

      wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mic-buerozeiten-public.css', array(), $this->version, 'all' );

   }

   /**
    * Register the JavaScript for the public-facing side of the site.
    *
    * @since    1.0.0
    */
   public function enqueue_scripts() {

      /**
       * This function is provided for demonstration purposes only.
       *
       * An instance of this class should be passed to the run() function
       * defined in Mic_Buerozeiten_Loader as all of the hooks are defined
       * in that particular class.
       *
       * The Mic_Buerozeiten_Loader will then create the relationship
       * between the defined hooks and the functions defined in this
       * class.
       */

      wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mic-buerozeiten-public.js', array( 'jquery' ), $this->version, false );

   }

   /**
    * Register shortcode for widget.
    *
    * @since   1.0.0
    */
   public function micbde_shortcodes_init() {
      // Returns the text of reachable or not
      function isReachable( $options ) {
         date_default_timezone_set('Europe/Berlin');

         $tage = array( "sunday_checked", "monday_checked", "tuesday_checked",
                        "wednesday_checked", "thursday_checked",
                        "friday_checked", "saturday_checked" );
         $tagoption = array( "sunday_time", "monday_time", "tuesday_time",
                             "wednesday_time", "thursday_time",
                             "friday_time", "saturday_time" );
         $dayofweek = $tage[date('w')];
         $tagopt = $tagoption[date('w')];

         if ( ! $options[$dayofweek] ) {
            return $options['text_unreachable'];
         }

         $area = $options[$tagopt];
         $index = strpos($area, '-');
         if ($index == false || $index == 0)
            return $options['text_unreachable'];

         $from = substr($area, 0, $index);
         $to = substr($area, (-1) * $index);

         $dtimeFrom = strtotime($from);
         $dtimeTo = strtotime($to);

         $now = time();

         if ($now >= $dtimeFrom && $now <= $dtimeTo) {
            return $options['text_reachable'];
         }

         return $options['text_unreachable'];
      }

      function micbde_widget_shortcode($atts = [], $content = null) {
         $options = get_option( 'micbde_options' );

         $content = "<h4>".$options['micbde_field_title']."</h4>";

         $reachable = isReachable($options);
         $reachableClass = 'micbde_unreachable';
         if ($reachable == $options['text_reachable']) {
            $reachableClass = 'micbde_reachable';
         }

         $content .= "<div class='micbde_status ". $reachableClass ."'>".$reachable."</div>";

         $content .= "<div class='micbde_times'>";

         if ($options['monday_checked']) {
            $content .= "<div class='daybox'>";
            $content .= __('Monday', 'mic-buerozeiten') . ": </div>";
            $content .= "<div class='daybox'>" . $options['monday_time'];
            $content .= "</div>";
         }
         if ($options['tuesday_checked']) {
            $content .= "<div class='daybox'>";
            $content .= __('Tuesday', 'mic-buerozeiten') . ": </div>";
            $content .= "<div class='daybox'>" . $options['tuesday_time'];
            $content .= "</div>";
         }
         if ($options['wednesday_checked']) {
            $content .= "<div class='daybox'>";
            $content .= __('Wednesday', 'mic-buerozeiten') . ": </div>";
            $content .= "<div class='daybox'>" . $options['wednesday_time'];
            $content .= "</div>";
         }
         if ($options['thursday_checked']) {
            $content .= "<div class='daybox'>";
            $content .= __('Thursday', 'mic-buerozeiten') . ": </div>";
            $content .= "<div class='daybox'>" . $options['thursday_time'];
            $content .= "</div>";
         }
         if ($options['friday_checked']) {
            $content .= "<div class='daybox'>";
            $content .= __('Friday', 'mic-buerozeiten') . ": </div>";
            $content .= "<div class='daybox'>" . $options['friday_time'];
            $content .= "</div>";
         }
         if ($options['saturday_checked']) {
            $content .= "<div class='daybox'>";
            $content .= __('Saturday', 'mic-buerozeiten') . ": </div>";
            $content .= "<div class='daybox'>" . $options['saturday_time'];
            $content .= "</div>";
         }
         if ($options['sunday_checked']) {
            $content .= "<div class='daybox'>";
            $content .= __('Sunday', 'mic-buerozeiten') . ": </div>";
            $content .= "<div class='daybox'>" . $options['sunday_time'];
            $content .= "</div>";
         }

         $content .= "</div>";

         return $content;
      }
      add_shortcode( 'micbde-widget', 'micbde_widget_shortcode' );
   }
}
