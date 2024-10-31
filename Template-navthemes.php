<html>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php
ob_start();
do_action("wpseo_head");
$yoast = ob_get_contents();
ob_end_clean();
print_r($yoast);
?>   
<body>
<style type="text/css">
body{
    margin:0px;
    padding:0px;  
 }
 /*PAge Load Loder*/

.nt_loader {
    position: fixed;
    left: 0px;
    right: 0;
    top: 0;
    padding-top: 10%;
    width: 100%;
    height: 100%;
    z-index: 99999;
    background:#fff;
}



</style>

    <script type="text/javascript">
        <?php echo get_field('script_one_on_header','option');  ?>
    </script>
    <style type="text/css">
         <?php echo get_field('style_css','option');  ?>
    </style>

    <script type="text/javascript">
      <?php echo get_field('script_one_on_header');  ?>
    </script>
    <style type="text/css">
         <?php echo get_field('style_css');  ?>
    </style>
 
<?php
/*
* Template Name: Template-NavThemes
*/
?>
<?php

if(!function_exists( 'navthemes_landing_pages_blocks_block_assets' )) {
  function navthemes_landing_pages_blocks_block_assets() { 
    // Styles.
     $nt_template_name = get_option( 'nt_template_name' );
     $click_template_name = explode("|", $nt_template_name);
     foreach ($click_template_name as $templatename) {
        $templatename = $templatename;
     }

    $detailsbytheme = get_post_meta( get_the_ID(), get_the_ID() ,true);
    
    $build_js = $detailsbytheme['json'];
    $build_editorblockcss = $detailsbytheme['buildeditorcss'];
    $build_blockcss = $detailsbytheme['buildcss'];
    $build_indexcss = $detailsbytheme['indexcss'];
    $build_index_editorcss = $detailsbytheme['indexeditorcss'];
    $extra_js = $detailsbytheme['extra_js'];
    $templatedata = explode("-", $templatename);
    $templatenm = $templatedata[1];
   
     wp_enqueue_style(
        'navthemes_blocks-style-css', // Handle.
        $build_indexcss, // Block style CSS.
        array( 'wp-editor' ) // Dependency to include the CSS after it.
    );

   if($extra_js==''){

    }
    else{
      wp_enqueue_script('navthemes_blocks-'.get_the_ID().'-faq-js', $extra_js, 
      array( 'wp-editor' ),  true
    );
    }

    switch ($templatenm) {
      case 'spa':
        wp_enqueue_style( 'ntgooglestyle', 'https://fonts.googleapis.com/css?family=Tangerine'  );
      wp_enqueue_style( 'ntgooglestylesecond', 'https://fonts.googleapis.com/css?family=Open+Sans');
     break;
     
     case 'makeup':
        wp_enqueue_style( 'ntgooglestyle', 'https://fonts.googleapis.com/css?family=Tangerine');
    wp_enqueue_style( 'ntgooglestylesecond', 'https://fonts.googleapis.com/css?family=Open+Sans'); 
     break;
     case 'yoga':
        wp_enqueue_style( 'ntgooglestyle', 'https://fonts.googleapis.com/css?family=Tangerine'  );
     break;

    }

   wp_enqueue_style( 'wp-block-library' );

   wp_enqueue_style( 'ntgooglestylesecond', 'https://fonts.googleapis.com/css?family=Montserrat'); 

   wp_enqueue_style( 'ntgooglestylefontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');   




  
  
    
}

// Hook: Frontend assets.
add_action( 'wp_footer', 'navthemes_landing_pages_blocks_block_assets' );
}
?>
<div class="nt_loader" style=" text-align: center; ">
    <img src="<?php echo plugins_url( '/assets/images/puff.svg', __FILE__ ) ?>">
<!--  <div class="lds-ripple"><div></div><div></div></div> -->
</div>
	<?php if(have_posts() ) : while ( have_posts() ) : the_post();
		the_content();
		endwhile;
		endif;
	 ?> 
<?php
wp_footer();




?>

    <script type="text/javascript">
        <?php echo get_field('script_second_on_footer','option');  ?>
    </script>

     <script type="text/javascript">
      <?php echo get_field('script_second_on_footer');  ?>

      jQuery(window).load(function(){
            jQuery('.nt_loader').fadeOut();
       });


    </script>



</body>
</html>
