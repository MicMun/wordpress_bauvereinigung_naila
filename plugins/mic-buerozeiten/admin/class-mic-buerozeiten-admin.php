<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    mic-buerozeiten
 * @subpackage mic-buerozeiten/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    mic-buerozeiten
 * @subpackage mic-buerozeiten/admin
 * @author     Michael Munzert <Mic.Mun@gmx.de
 */
class Mic_Buerozeiten_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/mic-buerozeiten-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/mic-buerozeiten-admin.js', array( 'jquery' ), $this->version, false );

	}

   /**
   * custom option and settings for mic-buerozeiten.
   */
   public function micbde_settings_init() {
      // register a new setting for "micbde" page
      register_setting( 'micbde', 'micbde_options' );

      // register a new section in the "micbde" page
      add_settings_section(
         'micbde_main_section',
         __( 'Settings for Mic-Buerozeiten.', 'mic-buerozeiten' ),
         __CLASS__.'::micbde_main_section_cb',
         'micbde'
       );

      // register a new field in the "micbde_main_section" section, inside the "micbde" page
      add_settings_field(
         'micbde_field_title',
         __( 'Time Title', 'mic-buerozeiten' ),
         __CLASS__.'::micbde_field_title_cb',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'micbde_field_title',
         ]
      );

      add_settings_field(
         'monday_checked',
         __( 'Monday', 'mic-buerozeiten' ),
         __CLASS__.'::setting_monday_fn',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'monday_checked',
         ]
      );

      add_settings_field(
         'tuesday_checked',
         __( 'Tuesday', 'mic-buerozeiten' ),
         __CLASS__.'::setting_tuesday_fn',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'tuesday_checked',
         ]
      );

      add_settings_field(
         'wednesday_checked',
         __( 'Wednesday', 'mic-buerozeiten' ),
         __CLASS__.'::setting_wednesday_fn',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'wednesday_checked',
         ]
      );

      add_settings_field(
         'thursday_checked',
         __( 'Thursday', 'mic-buerozeiten' ),
         __CLASS__.'::setting_thursday_fn',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'thursday_checked',
         ]
      );

      add_settings_field(
         'friday_checked',
         __( 'Friday', 'mic-buerozeiten' ),
         __CLASS__.'::setting_friday_fn',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'friday_checked',
         ]
      );

      add_settings_field(
         'saturday_checked',
         __( 'Saturday', 'mic-buerozeiten' ),
         __CLASS__.'::setting_saturday_fn',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'saturday_checked',
         ]
      );

      add_settings_field(
         'sunday_checked',
         __( 'Sunday', 'mic-buerozeiten' ),
         __CLASS__.'::setting_sunday_fn',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'sunday_checked',
         ]
      );

      add_settings_field(
         'text_reachable',
         __( 'Reachable Text', 'mic-buerozeiten' ),
         __CLASS__.'::setting_reachable_text_fn',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'text_reachable',
         ]
      );

      add_settings_field(
         'text_unreachable',
         __( 'Unreachable Text', 'mic-buerozeiten' ),
         __CLASS__.'::setting_unreachable_text_fn',
         'micbde',
         'micbde_main_section',
         [
            'label_for' => 'text_unreachable',
         ]
      );
   }

   // section callbacks can accept an $args parameter, which is an array.
   // $args have the following keys defined: title, id, callback.
   // the values are defined at the add_settings_section() function.
   public function micbde_main_section_cb( $args ) {
      echo "<p id='".esc_attr( $args['id'] )."'>".esc_html_e( 'Set your values.', 'mic-buerozeiten' )."</p>";
   }

   // field callbacks can accept an $args parameter, which is an array.
   // $args is defined at the add_settings_field() function.
   // wordpress has magic interaction with the following keys: label_for, class.
   // the "label_for" key value is used for the "for" attribute of the <label>.
   // the "class" key value is used for the "class" attribute of the <tr> containing the field.
   // you can add custom key value pairs to be used inside your callbacks.
   public function micbde_field_title_cb( $args ) {
      // get the value of the setting we've registered with register_setting()
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      // output the field
      echo "<input id='micbde_field_title' name='micbde_options[micbde_field_title]'
         size='40' type='text' value='{$options['micbde_field_title']}' />";
   }

   // Callback for monday settings
   public function setting_monday_fn() {
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      if ($options['monday_checked']) {
         $checked = ' checked="checked" ';
      }

      echo "<input ".$checked." id='monday_checked'
         name='micbde_options[monday_checked]' type='checkbox' />";
      echo "<input id='monday_time' name='micbde_options[monday_time]'
         type='text' value='".$options['monday_time']."'/>";
   }

   // Callback for tuesday settings
   public function setting_tuesday_fn() {
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      if ($options['tuesday_checked']) {
         $checked = ' checked="checked" ';
      }

      echo "<input ".$checked." id='tuesday_checked'
         name='micbde_options[tuesday_checked]' type='checkbox' />";
      echo "<input id='tuesday_time' name='micbde_options[tuesday_time]'
         type='text' value='".$options['tuesday_time']."'/>";
   }

   // Callback for wednesday settings
   public function setting_wednesday_fn() {
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      if ($options['wednesday_checked']) {
         $checked = ' checked="checked" ';
      }

      echo "<input ".$checked." id='wednesday_checked'
         name='micbde_options[wednesday_checked]' type='checkbox' />";
      echo "<input id='wednesday_time' name='micbde_options[wednesday_time]'
         type='text' value='".$options['wednesday_time']."'/>";
   }

   // Callback for thursday settings
   public function setting_thursday_fn() {
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      if ($options['thursday_checked']) {
         $checked = ' checked="checked" ';
      }

      echo "<input ".$checked." id='thursday_checked'
         name='micbde_options[thursday_checked]' type='checkbox' />";
      echo "<input id='thursday_time' name='micbde_options[thursday_time]'
         type='text' value='".$options['thursday_time']."'/>";
   }

   // Callback for friday settings
   public function setting_friday_fn() {
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      if ($options['friday_checked']) {
         $checked = ' checked="checked" ';
      }

      echo "<input ".$checked." id='friday_checked'
         name='micbde_options[friday_checked]' type='checkbox' />";
      echo "<input id='friday_time' name='micbde_options[friday_time]'
         type='text' value='".$options['friday_time']."'/>";
   }

   // Callback for saturday settings
   public function setting_saturday_fn() {
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      if ($options['saturday_checked']) {
         $checked = ' checked="checked" ';
      }

      echo "<input ".$checked." id='saturday_checked'
         name='micbde_options[saturday_checked]' type='checkbox' />";
      echo "<input id='saturday_time' name='micbde_options[saturday_time]'
         type='text' value='".$options['saturday_time']."'/>";
   }

   // Callback for sunday settings
   public function setting_sunday_fn() {
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      if ($options['sunday_checked']) {
         $checked = ' checked="checked" ';
      }

      echo "<input ".$checked." id='sunday_checked'
         name='micbde_options[sunday_checked]' type='checkbox' />";
      echo "<input id='sunday_time' name='micbde_options[sunday_time]'
         type='text' value='".$options['sunday_time']."'/>";
   }

   // Callback for reachable text settings
   public function setting_reachable_text_fn() {
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      echo "<input id='text_reachable' name='micbde_options[text_reachable]'
         type='text' value='".$options['text_reachable']."'/>";
   }

   // Callback for unreachable text settings
   public function setting_unreachable_text_fn() {
      $options = get_option( 'micbde_options',
         [
            'micbde_field_title' => 'Bürozeiten',
            'monday_checked' => true,
            'monday_time' => '09:30-11:30',
            'tuesday_checked' => true,
            'tuesday_time' => '09:30-11:30',
            'wednesday_checked' => false,
            'wednesday_time' => '09:30-11:30',
            'thursday_checked' => true,
            'thursday_time' => '09:30-11:30',
            'friday_checked' => true,
            'friday_time' => '09:30-11:30',
            'saturday_checked' => false,
            'saturday_time' => '',
            'sunday_checked' => false,
            'sunday_time' => '',
            'text_reachable' => 'Erreichbar',
            'text_unreachable' => 'Nicht Erreichbar'
         ] );

      echo "<input id='text_unreachable' name='micbde_options[text_unreachable]'
         type='text' value='".$options['text_unreachable']."'/>";
   }

   /**
    * sub level menu
    */
   public function micbde_options_page() {
      // add sub level menu page
      add_menu_page(
         __('Mic-Buerozeiten Settings', 'mic-buerozeiten'),
         'Mic-Buerozeiten',
         'edit_pages',
         'micbde',
         __CLASS__.'::micbde_options_page_html'
      );
   }

   public function micbde_options_page_html() {
      // check user capabilities
      if ( ! current_user_can( 'edit_pages' ) ) {
         return;
      }

      // add error/update messages

      // check if the user have submitted the settings
      // wordpress will add the "settings-updated" $_GET parameter to the url
      if ( isset( $_GET['settings-updated'] ) ) {
         // add settings saved message with the class of "updated"
         add_settings_error( 'micbde_messages', 'micbde_message', __( 'Settings Saved', 'mic-buerozeiten' ), 'updated' );
      }

      // show error/update messages
      settings_errors( 'micbde_messages' );
      ?>
      <div class="wrap">
      <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      <form action="options.php" method="post">
      <?php
         // output security fields for the registered setting "micbde_options"
         settings_fields( 'micbde' );
         // output setting sections and their fields
         // (sections are registered for "micbde", each field is registered to a specific section)
         do_settings_sections( 'micbde' );
         // output save settings button
         submit_button( __('Save Settings', 'mic-buerozeiten') );
      ?>
      </form>
      </div>
      <?php
   }

}
