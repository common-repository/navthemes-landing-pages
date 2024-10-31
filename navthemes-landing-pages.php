<?php
/**
 * Plugin Name:  NavThemes Landing Pages
 * Description:  Plugin to add landing pages
 * Version:      1.1
 * Author:       NavThemes
 * Author URI:   https://www.navthemes.com/
 * License:      GPL2
 * Text Domain:  navthemes_landing_pages
 *
 */
?>
<?php 
/* Redirect When Plugin Activates */
function navthemes_landing_pages_activation_redirect( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_safe_redirect( admin_url( 'admin.php?page=nt-landing-onboard' ) ) );
    }
}
add_action( 'activated_plugin', 'navthemes_landing_pages_activation_redirect' );

require_once( ABSPATH . 'wp-includes/pluggable.php' );
if( ! class_exists('ACF') ) :
include_once('admin/acf.php' );
add_filter('acf/settings/show_admin', '__return_false');
endif;
include('acf-json/fields.php');
acf_form_head();
// lets include admin

/*Define All Pages Name */
if ( !defined( 'NavThemes_landing_pages_name' ) ) {
    define( 'NavThemes_landing_pages_name', array('cakes','cargo','carrepair','carwash','cbdoil' ) );
}
 //  The ACF class doesn't exist, so you can probably redefine your functions here

   
/*Define All url */
if ( !defined( 'NavThemes_landing_pages_url' ) ) {
    define( 'NavThemes_landing_pages_url', array('http://demo.navthemes.com/landing/mm/','http://demo.navthemes.com/landing/cargo-2/','http://demo.navthemes.com/landing/caronline/','http://demo.navthemes.com/landing/carcccc/','http://demo.navthemes.com/landing/cbdoil-2/' ) );
}



if(!function_exists( 'getPluginAssetsPath' )) {
function getPluginAssetsPath($path) {
    return plugin_dir_url( __FILE__ ) .$path;
}
}


/**
* NavThemes Align Wide Support
*/
function nt_align_support(){
 add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'nt_align_support' );


/* Enqueue Landing Page Admin Styles */
if(!function_exists('navthemes_landing_pages_enqueue')):
function navthemes_landing_pages_enqueue() { 
  wp_enqueue_style( 'ntlandingpagestyle', plugins_url( '/assets/style.css', __FILE__ ),'1.1' );

  wp_enqueue_style( 'ntgooglestyle', 'https://fonts.googleapis.com/css?family=Tangerine');
   
  wp_enqueue_style( 'ntgooglestylesecond', 'https://fonts.googleapis.com/css?family=Open+Sans'); 
  }
add_action( 'admin_enqueue_scripts', 'navthemes_landing_pages_enqueue' );
endif;

/*----------------------------
    Including NavThemes Blocks File 
    -----------------------------*/
  include('navthemes-blocks.php');

/* Navthemes Landing Page Menu */

add_action('admin_menu', 'navthemes_landing_pages_menu');
function navthemes_landing_pages_menu(){
  add_menu_page('Landing Pages', 'Landing Pages', 'manage_options', 'nt-landing-dash', 'navthemes_landing_pages_dashboard', '', 7);

  add_submenu_page( "nt-landing-dash", __( 'On Boarding', 'navthemes_landing_onboard' ) , __( 'On Boarding', 'navthemes_landing_onboard' ), "manage_options", "nt-landing-onboard", "navthemes_landing_pages_onboard" );

  }

  // add sub page
  acf_add_options_sub_page(array(
    'page_title'  => 'Settings',
    'menu_title'  => 'Setting',
    'parent_slug'   => 'nt-landing-dash',
  ));


/* Navthemes Setting Custom Template */
if(get_option( 'nt_template_name' ) !== null){
  include('pagetemplater.php');
  $pagetemplater = new PageTemplater();
}


/* Navthemes Landing Page Onboarding*/
if(!function_exists('navthemes_landing_pages_onboard')){
function navthemes_landing_pages_onboard(){
 if( isset($_REQUEST['page']) && sanitize_text_field($_REQUEST['page'])=='nt-landing-onboard'){ include('page-viewonboardingpage.php'); }
 }
}

/* Navthemes Landing Page Dashboard */
if(!function_exists('navthemes_landing_pages_dashboard')){
function navthemes_landing_pages_dashboard(){
 if( isset($_REQUEST['page']) && sanitize_text_field($_REQUEST['page'])=='nt-landing-dash'){ 
  include('page-viewdashboard.php'); }
}
}



/* Navthemes Template Edit and Template Update Ajax */
  add_action( 'wp_ajax_update_template', 'ntupdatetemplate' );
  add_action( 'wp_ajax_nopriv_update_template', 'ntupdatetemplate' );
  add_action( 'wp_ajax_edit_template', 'ntedittemplate' );
  add_action( 'wp_ajax_nopriv_edit_template', 'ntedittemplate' );
			
	/* Navthemes Setup Wizard Ajax */
  add_action( 'wp_ajax_np_lp_checkinstplugin', 'np__lp_checkinstplugin' );
  add_action( 'wp_ajax_nopriv_np_lp_checkinstplugin', 'np__lp_checkinstplugin' );
  add_action( 'wp_ajax_ntinstall_plugins', 'navthemes_recommended_plugin' );
  add_action( 'wp_ajax_nopriv_ntinstall_plugins', 'navthemes_recommended_plugin' );

  /* Navthemes Save Onboarding Additional Data */
  add_action( 'wp_ajax_ntlpsaveadditonaldata', 'nt_lp_saveadditonaldata' );
  add_action( 'wp_ajax_nopriv_ntlpsaveadditonaldata', 'nt_lp_saveadditonaldata' );

    /* Navthemes Save Onboarding Additional Data */
  add_action( 'wp_ajax_ntlpinstallrequiredplugin', 'nt_lp_installrequiredplugin' );
  add_action( 'wp_ajax_nopriv_ntlpinstallrequiredplugin', 'nt_lp_installrequiredplugin' );


  function nt_lp_installrequiredplugin(){
 
    if(!is_plugin_active( 'navthemes-fontawesome-icons/navthemesfa.php' ) || 
      !is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ||
      !is_plugin_active( 'cf-7-gutenberg/cf7-gutenberg.php' )) {

      $required_plugins_slugs = array(
                      'contact-form-7',
                      'navthemes-fontawesome-icons',
                      'cf-7-gutenberg'
                      );
      foreach ($required_plugins_slugs as $required_plugins_slug) {
     
                  $args = 
                    array(
                      'slug' => $required_plugins_slug, // plugin slug
                      'fields' => array(
                          'version' => true
                      )
                  );   
                
                // Make request and extract plug-in object. Action is query_plugins
                 $response = wp_remote_post(
                       'http://api.wordpress.org/plugins/info/1.0/',
                       array(
                         'body' => array(
                         'action' => 'plugin_information',
                         'request' => serialize((object)$args)
                        )
                      )
                    );
             
               if ( !is_wp_error($response) ) {
                $returned_object = unserialize(wp_remote_retrieve_body($response));   
                   
                  if ($returned_object) {
                    
                      $pluginzip = $returned_object->download_link;
                    
                       include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                    
                        wp_cache_flush();
                    
                        $upgrader = new Plugin_Upgrader();

                      $installed = $upgrader->install( $pluginzip );

           
                    }
              // Make request and extract plug-in object. Action is query_plugins
            }


          } //end foreach
    
      }// End if

       //all required plugins file urls
        $pluginpaths = array(
                        'contact-form-7/wp-contact-form-7.php',
                        'cf-7-gutenberg/cf7-gutenberg.php',
                        'navthemes-fontawesome-icons/navthemesfa.php',
                        );

        foreach ($pluginpaths as $pluginpath) {
          //if pluginpath exists 
          if ( ! is_file( $abspluginpath = WPMU_PLUGIN_DIR . '/'. $pluginpath ) ) {

              activate_plugin( $abspluginpath );
          }

        }

    wp_die();
  }

  function nt_lp_saveadditonaldata(){
    $ntlpheadjs = $_REQUEST['ntlpheadjs'];
    $ntlpfootjs = $_REQUEST['ntlpfootjs'];
    $ntlpcss = $_REQUEST['ntlpcss'];
      
    update_field('field_5ca852c35e308', $ntlpheadjs , 'options'); 
    update_field('field_5ca852e55e309', $ntlpfootjs , 'options'); 
    update_field('field_5ca853145e30a', $ntlpcss , 'options'); 
    wp_die();
  }
					

/*Recommended Plugin Install or not*/

function navthemes_recommended_plugin(){
 
    $mailchimp = $_REQUEST['mailchimp'];
    $ninjaform = $_REQUEST['ninjaform'];
    $yoastseo = $_REQUEST['yoastseo'];

    $recommended_plugins_slugs = array();

    //If mailchimp is selected, push slug
    if($mailchimp == 'on'){
      array_push($recommended_plugins_slugs, 'mailchimp-for-wp');
    }

    //If ninja form is selected, push slug
    if($ninjaform == 'on'){
      array_push($recommended_plugins_slugs, 'ninja-forms','ninja-gutenberg-blocks-gutenberg-blocks-collection');
    }

    //If yoast seo is selected, push slug
    if($yoastseo == 'on'){
      array_push($recommended_plugins_slugs, 'wordpress-seo');
    }
      
    //Install if not installed (ON)
    foreach ($recommended_plugins_slugs as $recommended_plugins_slug) {
     
                  $args = 
                    array(
                      'slug' => $recommended_plugins_slug, // plugin slug
                      'fields' => array(
                          'version' => true
                      )
                  );   
                
                // Make request and extract plug-in object. Action is query_plugins
                 $response = wp_remote_post(
                       'http://api.wordpress.org/plugins/info/1.0/',
                       array(
                         'body' => array(
                         'action' => 'plugin_information',
                         'request' => serialize((object)$args)
                        )
                      )
                    );
             
               if ( !is_wp_error($response) ) {
                $returned_object = unserialize(wp_remote_retrieve_body($response));   
                   
                  if ($returned_object) {
                    
                      $pluginzip = $returned_object->download_link;
                    
                       include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
                    
                        wp_cache_flush();
                    
                        $upgrader = new Plugin_Upgrader();

                      $installed = $upgrader->install( $pluginzip );

           
                    }
              // Make request and extract plug-in object. Action is query_plugins
            }


      } //end foreach

      //all recommended plugins file urls
      $pluginpaths = array(
                      'ninja-forms/ninja-forms.php',
                      'ninja-gutenberg-blocks-gutenberg-blocks-collection/plugin.php',
                      'mailchimp-for-wp/mailchimp-for-wp.php',
                      'wordpress-seo/wp-seo.php'
                      );

      foreach ($pluginpaths as $pluginpath) {
        //if pluginpath exists 
        if ( ! is_file( $abspluginpath = WPMU_PLUGIN_DIR . '/'. $pluginpath ) ) {

            activate_plugin( $abspluginpath );
        }

      }

  echo 'TRUE';
}

/* Navthemes Template Update */
function ntupdatetemplate(){
  $template_id = $_REQUEST['template_id'];
  $template_title = $_REQUEST['template_title'];
  $template_title = preg_replace('/\s+/', '', $template_title);
  
  $templatename = explode("-",$template_id);

  // All Data urls;

   $blockcss = plugins_url( '/navthemes-blocks/'.$templatename[1].'/dist/blocks.style.build.css', __FILE__ );
   $blockbuildcss = plugins_url( '/navthemes-blocks/'.$templatename[1].'/dist/blocks.editor.build.css', __FILE__ );
   $indexcss = plugins_url( '/navthemes-blocks/'.$templatename[1].'/dist/index.css', __FILE__ );
   $indexbuildcss = plugins_url( '/navthemes-blocks/'.$templatename[1].'/dist/index.editor.css', __FILE__ );
   $json_string_data = plugins_url( '/navthemes-blocks/'.$templatename[1].'/dist/blocks.build.js', __FILE__ );
   $extra_js_file = plugins_url( '/navthemes-blocks/'.$templatename[1].'/dist/faq.js', __FILE__ );

   $json_string = plugins_url( '/json/'.$template_id.'.json', __FILE__ );
   $jsondata = file_get_contents($json_string);
   $obj = json_decode($jsondata);

   $block_content =  $obj->content;

    $nt_template_name = get_option( 'nt_template_name' );
    $nt_template_name .= '|'.$template_id;
    update_option( 'nt_template_name', $nt_template_name );

    $new_page_title = $template_title;
    $new_page_content = $block_content;
    $new_page_template = 'Template-navthemes.php'; //ex. template-custom.php. Leave blank if you don't want a custom page template.


//* Contact Form Create */


// class wp contact 7 form and start contact 7 code form
if(class_exists('WPCF7_ContactFormTemplate')){

  // Appointment Form path
  $main_form_path = plugins_url( '/navthemes-blocks/'.$templatename[1].'/main-form.php', __FILE__ );

  // Subscribe Form path
  $subscribe_form_path = plugins_url( '/navthemes-blocks/'.$templatename[1].'/subscribe-form.php', __FILE__ );

  //get main data 
  $main_form_data = file_get_contents($main_form_path);

  //get subscribe data
  $subscribe_form_data = file_get_contents($subscribe_form_path);

  // Form Data 
  $my_post_main = get_page_by_title( $templatename[1].'-form', OBJECT, 'wpcf7_contact_form' );


   $post_form_id = $my_post_main->ID;

 
  // Appointment Form Save In Contact form 7
  if($main_form_data==''){ }
  else{

    $contactform_data = array (
      'ID' => $post_form_id,
      'post_type' => 'wpcf7_contact_form',
      'post_title' => $templatename[1].'-form',
      'post_content' => $main_form_data,
      'post_status' => 'publish'
    );

    $posts = get_posts(array(
      'post_type'     => 'wpcf7_contact_form',
      'numberposts'   => -1
    ));

    foreach($posts as $p){
      $contactname[] = $p->post_title; // push in array
    }

    if (in_array($templatename[1].'-form',$contactname)) {} // array check
    else{
      $the_post_id = wp_insert_post($contactform_data); // insert post name and data
      update_post_meta($the_post_id, '_form', $main_form_data); // updata post meta data
    }
    
}


// Subscribe Form Save In Contact form 7
if($subscribe_form_data==''){ }
else{
    $subscribeform_data = array (
      'ID' => $post_form_id,
      'post_type' => 'wpcf7_contact_form',
      'post_title' => $templatename[1].'-subscribe-form',
      'post_content' => $subscribe_form_data,
      'post_status' => 'publish'
    );

    $posts = get_posts(array(
      'post_type'     => 'wpcf7_contact_form',
      'numberposts'   => -1
    ));

    foreach($posts as $p){
      $subscribename[] = $p->post_title; // push in array
    }

    if (in_array($templatename[1].'-subscribe-form',$subscribename)) {} // array check
    else{
      $the_sub_id = wp_insert_post($subscribeform_data); // insert post name and data
      update_post_meta($the_sub_id, '_form', $subscribe_form_data); // updata post meta data
    }
  }


//echo $newphrasecon;

}

/*Contact Form Shortcode Replace*/
  $my_post_main = get_page_by_title( $templatename[1].'-form', OBJECT, 'wpcf7_contact_form' );

  $post_form_id = $my_post_main->ID;

  $shortcode_main = '[contact-form-7 id="'.$post_form_id.'" title="'.$templatename[1].'-form"]';

  $search_word_main = "main_this_is_contact_form_id_shortcode_main";

  $newphrase = str_replace($search_word_main, $shortcode_main, $new_page_content);


//Subscuribtion form Repllace
   $my_post_sub = get_page_by_title( $templatename[1].'-subscribe-form', OBJECT, 'wpcf7_contact_form' );  

  $post_form_id = $my_post_sub->ID;

   $shortcode_sub = '[contact-form-7 id="'.$post_form_id.'" title="'.$templatename[1].'-subscribe-form"]';

   $search_word_sub = "sub_this_is_contaact_form_id_shortcode_sub";

   $newjsonreplaced = str_replace($search_word_sub, $shortcode_sub, $newphrase);

  /*Contact Form Shortcode Replace end*/


/*Contact  Form Create End*/

 
    $page_check = get_page_by_title($new_page_title);
    $new_page = array(
        'post_type' => 'page',
        'post_title' => $new_page_title,
        'post_content' => $newjsonreplaced,
        'post_status' => 'publish',
        'post_author' => 1,
    );

    if(!isset($page_check->ID)){
        $new_page_id = wp_insert_post($new_page);
        if(!empty($new_page_template)){
            update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
        } 
    //wp_safe_redirect( admin_url( 'post.php?post='.$new_page_id.'&action=edit' ) );

    // insert the post and set the category 

     // Add to database
      $detailsbytheme = array(
          'json' => $json_string_data,
          'templatename'    => $template_id,
          'buildeditorcss' => $blockbuildcss,
          'buildcss' => $blockcss,
          'indexcss' => $indexcss,
          'indexeditorcss' => $indexbuildcss,
          'extra_js' => $extra_js_file,
      );
    add_post_meta( $new_page_id, $new_page_id, $detailsbytheme );

    echo $new_page_title;

  }
  else{

    echo "nt_page_already_found";

  }
    
    wp_die();
}

/* Navthemes Template Edit */
  function ntedittemplate(){
     $template_title = $_REQUEST['template_title'];
     $template_title = preg_replace('/\s+/', '', $template_title);
     $page = get_page_by_title($template_title);
     $page_url = admin_url( 'post.php?post=' . $page->ID ).'&action=edit';
     $slug = get_post_field( 'post_name', $page->ID );
     echo json_encode(array("page_url" => $page_url, "slug" => $slug));
     wp_die();
  }
?>
<?php add_action('admin_footer','navthemes_landing_pages_ajax');
  function navthemes_landing_pages_ajax(){

    $url = admin_url('admin-ajax.php'); // Ajax Url




?>
<script type="text/javascript">

  /* Loder Js */
  jQuery("#loadingtag").ajaxStart(function(){
     jQuery(this).show();
   });
  jQuery("#loadingtag").ajaxComplete(function(){
     jQuery(this).hide();
   });
  /* Loder JS End*/


  jQuery(".nt_landing_page_templates").hover(function(){
      jQuery(this).find('.template_btns').toggleClass("nt_btns_show");
   });
   jQuery(".update").click(function(e){
      e.preventDefault();
        nt_templateid = jQuery(this).attr('name');
        nt_name_modal.style.display = "block";

    });


   jQuery("#nt_name_modal .nt_template_name_btn").click(function(e){
      e.preventDefault();
      nt_name_modal.style.display = "none";
      var template_title = jQuery(this).parent().find('#nt_page_name').val();
      navthemes_landing_pages_set_template(template_title);
    });

    // Ajax For Update Template
   function navthemes_landing_pages_set_template($template_title){
      var ajaxurl = "<?php echo $url; ?>";
        var data = {
            'action': 'update_template',
             template_id : nt_templateid,
             template_title : $template_title,
          };
        method: "POST",
        jQuery.post(ajaxurl, data, function(response) {
          if(response == 'nt_page_already_found'){
              alert("This Page Already Exist...");
              location.reload();
          }
          else{
           navthemes_landing_pages_edit_template(response,$template_title);
        }
        });
        
        jQuery('#nt_page_name').val('');

   }
   
   // Ajax For Edit Template
   function navthemes_landing_pages_edit_template($response,$template_title){
        var ajaxurl = "<?php echo $url; ?>";
          var data = {
              'action': 'edit_template',
               template_title : $response,
            };
          jQuery.post(ajaxurl, data, function(response) {
           
              var response = JSON.parse(response);
              var preview = "<?php echo site_url() ?>/"+response.slug;
              jQuery('#nt_success_modal .templateedit_btn').attr('href',response.page_url);
              jQuery('#nt_success_modal .preview_btn').attr('href',preview);
                nt_modal.style.display = "block";
          });     
        }

      // Get the first modal
      var nt_modal = document.getElementById('nt_success_modal');

      // Get the second modal
      var nt_name_modal = document.getElementById('nt_name_modal');

      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("close")[0];

      // Get the <span> element that closes the modal
      var closeidsec = document.getElementsByClassName("closeidsec")[0];

      // When the user clicks on <span> (x), close the First modal
      span.onclick = function() {
        nt_modal.style.display = "none";
        nt_name_modal.style.display = "none";
      }

      // When the user clicks on <span> (x), close the Second modal
      closeidsec.onclick = function() {
        nt_modal.style.display = "none";
        nt_name_modal.style.display = "none";
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == nt_modal) {
          nt_modal.style.display = "none";
        }
        if (event.target == nt_modal) {
          nt_name_modal.style.display = "none";
        }
      }

</script>
<?php  }