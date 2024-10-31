<?php 
/*
* This file is responsible for enqueuing navthemes blocks
*
*/
if(!function_exists( 'navthemes_landing_pages_blocks_editor_assets' )) {
 function navthemes_landing_pages_blocks_editor_assets() { 


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function nt_lp_editor_support_setup() {
        // Add support for editor styles.
          add_theme_support( 'editor-styles' );
}
add_action( 'after_setup_theme', 'nt_lp_editor_support_setup' );

add_action( 'wp_print_styles', 'my_deregister_javascript', 1 );
function my_deregister_javascript() {
    wp_deregister_style( 'twentynineteen-style' );
    //wp_deregister_style( 'digg-digg' );
    wp_deregister_script( 'twentynineteen-script' );
}

  // get post meta data of URL'S 
  $detailsbytheme = get_post_meta( get_the_ID(), get_the_ID() ,true);
  if($detailsbytheme){
    $build_js = $detailsbytheme['json']; // json file url   
    $build_editorblockcss = $detailsbytheme['buildeditorcss'];//build editor css
    $build_blockcss = $detailsbytheme['buildcss'];//build css
    $build_indexcss = $detailsbytheme['indexcss'];//index Front end  css
    $build_index_editorcss = $detailsbytheme['indexeditorcss'];//index back end  css
    $extra_js = $detailsbytheme['extra_js'];
	}
    // Scripts.
    wp_enqueue_script('navthemes_blocks-'.get_the_ID().'-js', $build_js, 
      array( 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-api', 'wp-editor' ),  true
    );  
    // Styles.
    wp_enqueue_style(
        'navthemes_blocks-'.get_the_ID().'-editor-css', $build_editorblockcss , array( 'wp-edit-blocks' )
    );

        // Styles.
    wp_enqueue_style(
        'navthemes_blocks-'.get_the_ID().'-editor-css-second', $build_index_editorcss ,
        array( 'wp-edit-blocks' )
    );



   wp_enqueue_style( 'ntgooglestylefirst', 'https://fonts.googleapis.com/css?family=Montserrat');   

    wp_enqueue_style( 'ntgooglestylesecond', 'https://fonts.googleapis.com/css?family=Open+Sans');


   wp_enqueue_style( 'ntgooglestylefontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'); 

// Hook: Editor assets.
}
add_action( 'enqueue_block_editor_assets', 'navthemes_landing_pages_blocks_editor_assets' );

function navthemes_landing_pages_remove_editor_style() {
  remove_theme_support('editor-styles');
}
}


add_action( 'admin_init', 'navthemes_landing_pages_remove_editor_style' );

add_filter( 'block_categories', function( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'navthemes-blocks',
                'title' => __( 'NavThemes Blocks', 'navthemes-blocks' ),
            ),
        )
    );
}, 10, 2 );
$attributes = array();