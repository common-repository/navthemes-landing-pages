<?php
/**
 * This file is responsible for the view of landing page dashboard.
 * 
 */?>
<div class="nt_landing_page_dash" id="wpbody" role="main">
  <div class="wrap">
	<div>
		<div class="tabs">
			<div class="tab-content">
			<div class="row">
				<img src="<?php echo plugins_url('/navthemes-landing-pages/assets/images/navthemeslogo.png') ?>" />
			<div class="col-md-12" style="text-align: right;">	
		     <!--  <a href="<?php //echo esc_url(admin_url( 'admin.php?page=nt-landing-dash' )); ?>" target="_blank" class="button button-link"><?php// echo esc_html('Landing Page Documentation') ?></a> -->
	     	</div>
			<div> 
				<h1> <?php echo esc_html('Welcome') ?> </h1>
				<h3><?php echo esc_html(' Thank you for choosing the NavThemes Landing Page plugin.') ?></h3>
	        	<br>
	        </div>
	        <br>
	      </div>
		</div>
	</div>
  	</div>
  </div>

 <div class="nt_landing_page_main" id="wpbody" role="main">
  <div class="wrap">
		  <div>
		    <div class="nt_landing_page_body">
			    <div style="display: none;  position: fixed;  top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;  background: #ffffffd9; text-align: center;" id="loadingtag" class="ntlploader">
	        		<img src="<?php echo plugins_url( '/assets/images/puff.svg', __FILE__ ) ?>" style="margin-top:130px; ">
	        		<div class="por">
	        			<h1 style="color: #000;">Please Wait...</h1>
	        		</div>
	        	</div>
			    <?php 

			    $templateimagearray = NavThemes_landing_pages_name;

                     $templateurlarray = NavThemes_landing_pages_url;
                      $count=0;
			    foreach ($templateimagearray as $value) { ?>
			    	
				    <div class="nt_landing_page_templates">
				      <img src="<?php echo plugins_url( '/assets/thumbs/template-'.$value.'.png', __FILE__ ) ?>">

				      <a href="<?php echo $templateurlarray[$count]?>" id="preview" target="_blank" class="button action template_btns nt_btns_hide preview_btn">Preview</a>

				      <input type="submit" name="Template-<?php echo $value; ?>" id="update" class="button button-primary button-large update template_btns nt_btns_hide templateset_btn" value="Set Template">
				    </div>
			    <?php $count++;} ?>
			   <!-- The Modal -->
					<div id="nt_name_modal" class="nt_modal nt_name_modal">
					  <div class="modal-content">
					    <div class="modal-header">
					      <span class="close">&times;</span>
					      <h2><?php echo esc_html('Page Name') ?></h2>
					    </div>
					    <div class="modal-body">
					     <input type="text" id="nt_page_name" value="" class="regular-text">
					     <input type="button" class="button button-primary button-large template_btns nt_template_name_btn" value="Submit">
					    </div>
					  </div>
					</div>
 
			    <!-- The Modal -->
					<div id="nt_success_modal" class="nt_modal nt_modal_edit">
					  <!-- Modal content -->
					  <div class="modal-content">
					    <div class="modal-header">
					      <span class="close closeidsec">&times;</span>
					      <img src="<?php echo plugins_url( '/assets/images/Success-PNG-Image.png', __FILE__ ) ?>">
					      <h2><?php echo esc_html('Congratulations') ?></h2>
					    </div>
					    <div class="modal-body">
					     <a href="#" target="_blank"  id="preview"  class="button action template_btns preview_btn"><?php echo esc_html('Preview') ?></a>
					      <a href="#" target="_blank" class="button button-primary button-large template_btns templateedit_btn"><?php echo esc_html('Edit Template') ?></a>
					    </div>
					  </div>
					</div>
		    </div>
  	</div>
  </div>
 </div>