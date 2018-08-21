<?php
function wps_scripts() {
    /* Theme CSS */
    wp_enqueue_style(
        'wps-style',
        get_stylesheet_uri(),
        array( 'bootstrap' ),
        '1.0.0'
    );

    /* Bootstrap CSS */
    wp_enqueue_style(
        'bootstrap',
        get_template_directory_uri() . '/css/bootstrap.min.css',
        array(),
        '4.1.0'
    );

    /* Bootstrap JS */
    wp_enqueue_script(
        'bootstrap',
        get_template_directory_uri() . '/js/bootstrap.min.js',
        array( 'jquery' ),
        '4.1.0',
        true
    );
}

add_action( 'wp_enqueue_scripts', 'wps_scripts' );

if (function_exists('register_sidebar')) {

   register_sidebar(array('name' => 'Sidebar',
                          'id' => 'sidebar',
                          'description' => '',
                          'before_widget' => '<div class="col-8 col-md-4 ml-md-auto order-2">',
                          'after_widget' => '</div>',
                          'before_title' => '<h4>',
                          'after_title' => '</h4>'));

   register_sidebar(array('name' => 'Kontaktform',
                          'id' => 'contactform',
                          'description' => '',
                          'before_widget' => '<div class="col-12 col-md-4 ml-md-auto order-2">',
                          'after_widget' => '</div>',
                          'before_title' => '<h4>',
                          'after_title' => '</h4>'));

   register_sidebar(array('name' => 'Footer',
                          'id' => 'footer',
                          'description' => '',
                          'before_widget' => '',
                          'after_widget' => '',
                          'before_title' => '<h4>',
                          'after_title' => '</h4>'));
}

function pwwp_micsimplesite_setup() {
   register_nav_menus(  array(
                        'primary' => __('Primary Navigation', 'micsimplesite')
                        )
                     );
   add_theme_support('custom-logo', array( 'height' => 80,
                                           'width' => 300,
                                           'flex-height' => false,
                                           'flex‐width' => false));

   $args = array( 'width'         => 1024,
                  'height'        => 320,
                  'default-image' => get_template_directory_uri() . '/images/Header.jpg',
                  'uploads'       => true
                );
   add_theme_support( 'custom-header', $args );
}
// this will hook the setup function in after other setup actions.
add_action( 'after_setup_theme', 'pwwp_micsimplesite_setup' );

if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
   // file does not exist... return an error.
   return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
   // file exists... require it.
    require_once( get_template_directory() . '/class-wp-bootstrap-navwalker.php' );
}

/**
 * Hide email from Spam Bots using a shortcode.
 *
 * @param array  $atts    Shortcode attributes. Not used.
 * @param string $content The shortcode content. Should be an email address.
 *
 * @return string The obfuscated email address.
 */
function wpcodex_hide_email_shortcode( $atts , $content = null ) {
   if ( ! is_email( $content ) ) {
      return;
   }

   $content = antispambot( $content );

   $email_link = sprintf( 'mailto:%s', $content );

   return sprintf( '<a href="%s">%s</a>', esc_url( $email_link, array( 'mailto' ) ), esc_html( $content ) );
}
add_shortcode( 'email', 'wpcodex_hide_email_shortcode' );

/* Tipp Nr. 8: Das URL-Feld aus Kommentarformularen entfernen */
function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}

add_filter('comment_form_default_fields', 'remove_comment_fields');

add_action( 'init', 'add_wohnung_angebote');
add_action( 'admin_init', 'wohnung_angebote_metaboxen');
add_action( 'save_post', 'wohnung_angebote_speichern');

function add_wohnung_angebote() {
   $labels = array(
      'name' => _x('Angebote', 'post type general name'),
      'singular name' => _x('Angebot', 'post type singular name'),
      'add_new' => _x('Hinzufügen', 'Angebot'),
      'add_new_item' => __('Neues Angebot hinzufügen'),
      'edit_item' => __('Angebot bearbeiten'),
      'new_item' => __('Neues Angebot'),
      'view_item' => __('Angebot ansehen'),
      'search_items' => __('Nach Angeboten suchen'),
      'not_found' => __('Keine Angebote gefunden'),
      'not_found_in_trash' => __('Keine Angebote im Paperkorb'),
      'parent_item_colon' => ''
   );

   $supports = array( 'title' );

   $args = array(
      'labels' => $labels,
      'description' => 'Seitentyp für Wohnungsangebote',
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      '_builtin' => false,
      'show_in_menu' => true,
      'query_var' => true,
      'rewrite' => array( "slug" => "angebote" ),
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => false,
      'menu_position' => 5,
      'supports' => $supports,
      'show_in_nav_menus' => false
   );

   register_post_type( 'angebot', $args );
}

function wohnung_angebote_metaboxen() {
   add_meta_box( "typ-meta", "Wohnungstyp", "wohnung_feld_typ", "angebot",
      "normal", "high" );
   add_meta_box( "groesse-meta", "Wohnungsgröße", "wohnung_feld_groesse", "angebot",
      "normal", "high" );
   add_meta_box( "stockwerk-meta", "Stockwerk", "wohnung_feld_stockwerk", "angebot",
      "normal", "high" );
   add_meta_box( "kaltmiete-meta", "Kaltmiete", "wohnung_feld_kaltmiete", "angebot",
      "normal", "high" );
   add_meta_box( "nebenkosten-meta", "Nebenkosten", "wohnung_feld_nebenkosten", "angebot",
      "normal", "high" );
   add_meta_box( "wbeschreibung-meta", "Beschreibung", "wohnung_feld_beschreibung", "angebot",
      "normal", "high" );
   add_meta_box( "wkontakt-meta", "Kontakt", "wohnung_feld_kontakt", "angebot",
      "normal", "high" );
}

function wohnung_feld_typ() {
   global $post;
   $custom = get_post_custom($post->ID);
   $typ = $custom["typ"][0];
   echo '<input name="typ" size="100" value="' . $typ . '" />';
}

function wohnung_feld_groesse() {
   global $post;
   $custom = get_post_custom($post->ID);
   $groesse = $custom["groesse"][0];
   echo '<input name="groesse" type="number" value="' . $groesse . '" /> qm';
}

function wohnung_feld_stockwerk() {
   global $post;

   // Add an nonce field so we can check for it later.
   wp_nonce_field( 'wdm_meta_box', 'wdm_meta_box_nonce' );

   /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
   $custom = get_post_custom($post->ID);
   $stw = $custom["stockwerk"][0];

   echo '<input type="radio" name="stockwerk" value="-" ' . checked($stw, '-', false) . '>- &nbsp;&nbsp;';
   echo '<input type="radio" name="stockwerk" value="EG" ' . checked($stw, 'EG', false) . '>EG &nbsp;&nbsp;';
   echo '<input type="radio" name="stockwerk" value="1.OG" ' . checked($stw, '1.OG', false) . '>1.OG &nbsp;&nbsp;';
   echo '<input type="radio" name="stockwerk" value="2.OG" ' . checked($stw, '2.OG', false) . '>2.OG ';
   ?>

   <?php
}

function wohnung_feld_kaltmiete() {
   global $post;
   $custom = get_post_custom($post->ID);
   $kaltmiete = $custom["kaltmiete"][0];
   echo '<input name="kaltmiete" type="number" step="0.01" min="0" placeholder="0.00" value="' . $kaltmiete . '" /> €';
}

function wohnung_feld_nebenkosten() {
   global $post;
   $custom = get_post_custom($post->ID);
   $nebenkosten = $custom["nebenkosten"][0];
   echo '<input name="nebenkosten" size="100" value="' . $nebenkosten . '" />';
}

function wohnung_feld_beschreibung() {
   global $post;
   $custom = get_post_custom($post->ID);
   $wbeschreibung = $custom["wbeschreibung"][0];
   echo '<textarea name="wbeschreibung" cols="200" rows="10" width="300" height="100">' . $wbeschreibung . ' </textarea>';
}

function wohnung_feld_kontakt() {
   global $post;
   $custom = get_post_custom($post->ID);
   $wkontakt = $custom["wkontakt"][0];
   echo '<input name="wkontakt" size="100" value="' . $wkontakt . '" />';
}

function wohnung_angebote_speichern() {
   global $post;
   update_post_meta($post->ID, "typ", $_POST["typ"]);
   update_post_meta($post->ID, "groesse", $_POST["groesse"]);
   update_post_meta($post->ID, "kaltmiete", $_POST["kaltmiete"]);
   update_post_meta($post->ID, "nebenkosten", $_POST["nebenkosten"]);
   update_post_meta($post->ID, "wbeschreibung", $_POST["wbeschreibung"]);
   update_post_meta($post->ID, "wkontakt", $_POST["wkontakt"]);

   /*
   * We need to verify this came from our screen and with proper authorization,
   * because the save_post action can be triggered at other times.
   */

   // Check if our nonce is set.
   if ( !isset( $_POST['wdm_meta_box_nonce'] ) ) {
      return;
   }

   // Verify that the nonce is valid.
   if ( !wp_verify_nonce( $_POST['wdm_meta_box_nonce'], 'wdm_meta_box' ) ) {
      return;
   }

   // If this is an autosave, our form has not been submitted, so we don't want to do anything.
   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
      return;
   }

   // Check the user's permissions.
   if ( !current_user_can( 'edit_post', $post_id ) ) {
      return;
   }

   // get user input.
   $new_meta_value = (isset($_POST['stockwerk']) ? $_POST['stockwerk'] : '-');

   // Update the meta field in the database.
   update_post_meta($post->ID, 'stockwerk', $new_meta_value);
}

add_filter("manage_edit-angebot_columns", "wohnung_angebot_spalten");
add_action("manage_posts_custom_column", "angebot_neue_spalte");

function wohnung_angebot_spalten($columns) {
   $columns = array(
      "cb" => "<input type=\"checkbox\" />",
      "title" => "Angebotsbezeichnung",
      "typ" => "Wohnungstyp",
      "groesse" => "Wohnungsgröße",
      "wbeschreibung" => "Wohnungsbeschreibung",
      "date" => "Hinzugefügt"
   );

   return $columns;
}

function angebot_neue_spalte($column) {
   global $post;

   if ("typ" == $column) {
      $custom = get_post_custom();
      echo $custom["typ"][0];
   } elseif ("groesse" == $column) {
      $custom = get_post_custom();
      echo $custom["groesse"][0];
   } elseif ("wbeschreibung" == $column) {
      $custom = get_post_custom();
      echo $custom["wbeschreibung"][0];
   }
}

?>
