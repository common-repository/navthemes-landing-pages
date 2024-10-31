<?php
/**
 * This file is responsible for the view of landing page onboarding.
 * 
 */
acf_form_head();
?>
<div class="nt_landing_page_onboarding" id="wpbody" role="main">
	<div id="ntlploader">
	    <img src="<?php echo plugins_url('/navthemes-landing-pages/assets/images/puff.svg') ?>" />  
	    <h3>Please Wait..</h3>
	</div>
  <div class="wrap">

	<div class="tab-content">
    	<img src="<?php echo plugins_url('/navthemes-landing-pages/assets/images/navthemeslogo.png') ?>" />
		<h3><?php echo esc_html('Thank You For Choosing NavThemes Landing Page Plugin.') ?></h3>
	</div>
<div class="tab">
		  <button class="tablinks" onclick="nt_lp_setupwizard(event, 'step1')" id="defaultOpen">&nbsp;</button>
		  <button class="tablinks step2" onclick="nt_lp_setupwizard(event, 'step2')" disabled>&nbsp;</button>
		  <button class="tablinks step3" onclick="nt_lp_setupwizard(event, 'step3')" disabled>&nbsp;</button>
		  <button class="tablinks step4" onclick="nt_lp_setupwizard(event, 'step4')" disabled>&nbsp;</button>
		</div>

	<div class="mainonbordingclass">
		
		<div id="step1" class="tabcontent">
			<h3>Required Plugins</h3>
            <div class="nt_lp_steps">

				<div class="nt_lp_step">
					<div class="nt_lp_stepimages">
					   <img src="<?php echo plugins_url('/navthemes-landing-pages/assets/images/contact-form-7.png') ?>"/>            		
					</div>
					<div class="nt_lp_stepcontent">
						<h2> Contact Form 7 </h2>
					</div>
				</div>
	
				<div class="nt_lp_step">
					<div class="nt_lp_stepimages">
					   <img src="<?php echo plugins_url('/navthemes-landing-pages/assets/images/contact-form-7.png') ?>"/>            		
					</div>
					<div class="nt_lp_stepcontent">
						<h2> Contact Form 7 Gutenberg Block </h2>
					</div>
				</div>
				<div class="nt_lp_step">
					<div class="nt_lp_stepimages">
					   <img src="<?php echo plugins_url('/navthemes-landing-pages/assets/images/navthems.png') ?>"/>            		
					</div>
					<div class="nt_lp_stepcontent">
						<h2> NavThemes Font Awesome Icon </h2>
					</div>
				</div>
			</div>
	  
			<div class="nt_lp_nextstep">
				<button class="button button--wayra button--border-thin button--round-s" onclick="nt_lp_setupwizard1();">Next</button>
			</div>
		</div> <!--Step 1 End-->

		<div id="step2" class="tabcontent">
				<h3>Recommended Plugins</h3>

			<div class="nt_lp_steps">
				<div class="nt_lp_step1">
					<div class="nt_lp_stepimages">
					   <img src="<?php echo plugins_url('/navthemes-landing-pages/assets/images/mailchimp.png') ?>"/>            		
					</div>
					<div class="nt_lp_stepcontent">
						<h2>Mail Chimp</h2>
					</div>
					<div class="nt_lp_stepinst">
						<ul class="tg-list">
						    <li class="tg-list-item">
								  <input type="checkbox" id="mailchimpid" class="recpluginbtn" style="display:none"/>
								  <label for="mailchimpid" class="toggle">
								    <span>
								      <svg width="10px" height="10px" viewBox="0 0 10 10">
								        <path d="M5,1 L5,1 C2.790861,1 1,2.790861 1,5 L1,5 C1,7.209139 2.790861,9 5,9 L5,9 C7.209139,9 9,7.209139 9,5 L9,5 C9,2.790861 7.209139,1 5,1 L5,9 L5,1 Z"></path>
								      </svg>
								    </span>
								  </label> 
							</li>
						</ul>
					</div>
				</div>

				<div class="nt_lp_step1">
					
					<div class="nt_lp_stepimages">
					   <img src="<?php echo plugins_url('/navthemes-landing-pages/assets/images/yoast.jpg') ?>"/>  
					</div>
					<div class="nt_lp_stepcontent">
						<h2>Yoast Seo</h2>
					</div>
					<div class="nt_lp_stepinst">
						<?php 

							if(is_plugin_active( 'wordpress-seo/wp-seo.php' )){
							?>
							<ul class="tg-list">
						    <li class="tg-list-item">
						   
						     <img src="<?php echo plugins_url('/navthemes-landing-pages/assets/images/installeddone.png') ?>"/>
						    </li>
						</ul>
						<?php		
							}
							else{ ?>
							<ul class="tg-list">
						    <li class="tg-list-item">
						 
						     	<input type="checkbox" id="yoastseowp" class="recpluginbtn" style="display:none"/>
								  <label for="yoastseowp" class="toggle">
								    <span>
								      <svg width="10px" height="10px" viewBox="0 0 10 10">
								        <path d="M5,1 L5,1 C2.790861,1 1,2.790861 1,5 L1,5 C1,7.209139 2.790861,9 5,9 L5,9 C7.209139,9 9,7.209139 9,5 L9,5 C9,2.790861 7.209139,1 5,1 L5,9 L5,1 Z"></path>
								      </svg>
								    </span>
								  </label> 
							</li>
						</ul>		 
						<?php } ?>
					</div>
				</div> <!--Step 1 end-->
			  </div>

				<div class="nt_lp_nextstep">
				<button class="button button-skip button--wayraskip button--border-thin button--round-s" id="installcheckedpluginskip">Skip</button>
					<button class="button button--wayra button--border-thin button--round-s" id="installcheckedplugin">Next</button>
				</div>

			</div>  <!--Step 2 End-->

			<div id="step3" class="tabcontent">
				<h3>Additional Content</h3>
				<div class="nt_lp_stepsform step-3-form">
				<?php 
				    $jsheadselector = get_field('field_5ca852c35e308', 'options');

				    $jsfooterselector = get_field('field_5ca852e55e309', 'options');

				    $cssselector = get_field('field_5ca853145e30a', 'options');
				?>
				<form method="post">
						<h4 class="text-center" style="font-size:17px; font-weight: 400;"><!-- top header --></h4>
					<div class="ntlpadditionalwrapper">
					   <div class="ntlpadditional col-xl-6 col-md-6">
							<label><b>Additional JS in header</b> (Do not need to write &lt;script&gt; tag)</label>
					    	<textarea id="ntlpheadjs" name="ntlpheadjs"><?php echo $jsheadselector; ?></textarea>
						</div>
						<div class="ntlpadditional col-xl-6 col-md-6">
						    <label><b>Additional JS in footer</b> (Do not need to write &lt;script&gt; tag)</label>
						    <textarea id="ntlpfootjs" name="ntlpfootjs"><?php echo $jsfooterselector; ?></textarea>
					    </div>
					    <div class="ntlpadditional col-xl-6 col-md-6">
						    <label><b>Additional CSS</b> (Do not need to write &lt;style&gt; tag)</label>
						    <textarea id="ntlpcss" name="ntlpcss"><?php echo $cssselector; ?></textarea>
					    </div>
				    </div>

				</form>
			</div><!-- nt_lp_steps -->
			  <div class="nt_lp_nextstep ">
				    	<button class="button button-skip button--wayraskip button--border-thin button--round-s" id="ntlpadditonalformskip" >Skip</button>
					    <button class="button button--wayra button--border-thin button--round-s" type="submit" name="submit" value="Next" id="ntlpadditonalform">Next</button>
					</div>
			</div> <!--Step 3 End-->

			<div id="step4" class="tabcontent">
				<h3>Choose A Landing Page</h3>
			 	<?php include('page-viewlandingpages.php'); ?>
			 	  <a href="<?php echo admin_url('admin.php?page=nt-landing-dash'); ?>" class="button button--wayra button--border-thin button--round-s" id="backtodashboard">Back To Landing Page</a>
			</div> <!--Step 4 End-->

					</div>	
				</div>
	      </div>
	  	</div>
	  </div>
	</div>



<div class="ntlppluginnotice">			
	
	</div>


<script>
function nt_lp_setupwizard(evt, steps) {

  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(steps).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

</script>

<?php add_action('admin_footer','navthemes_lp_step1_ajax');
  function navthemes_lp_step1_ajax(){

    $url = admin_url('admin-ajax.php'); // Ajax Url

?>
<script type="text/javascript">
jQuery(document).ready(function(){
 jQuery("#installcheckedplugin").click(function(){
    if(jQuery('#mailchimpid').is(":checked")){
  		var mailchimpidval = 'on';
  	}else{
  		var mailchimpidval = 'off';
  	}	

    if(jQuery('#ninjaformid').is(":checked")){
  		var ninjaformidval = 'on';
  	}
  	else{
  		var ninjaformidval = 'off';
  	}

 	if(jQuery('#yoastseowp').is(":checked")){
  		var yoastseowpval = 'on';
  	}
  	else{
  		var yoastseowpval = 'off';
  	}

    var ajaxurl = "<?php echo $url; ?>";

	    var data = {
	        'action': 'ntinstall_plugins',
	        'mailchimp' : mailchimpidval,
	        'ninjaform' : ninjaformidval,
	        'yoastseo'  : yoastseowpval,
	      };
	    method: "POST",
	    jQuery.post(ajaxurl, data, function(response) {
	    	if(response){
	          	nt_lp_setupwizard(event, 'step3');
	          	jQuery('.step3').removeAttr("disabled");
	          	jQuery('.step3').addClass('active');
	          }else{
	          	alert('notactive');
	          }
	    });
  });
  jQuery("#installcheckedpluginskip").click(function(){
  		nt_lp_setupwizard(event, 'step3');
  		jQuery('.step3').removeAttr("disabled");
	  	jQuery('.step3').addClass('active');
 });

});


	
	  var $ntlploader = jQuery('#ntlploader').hide();
       //Attach the event handler to any element
       jQuery(document).ajaxStart(function () {
            //ajax request went so show the loading image
             $ntlploader.show();
         })
       jQuery(document).ajaxStop(function () {
           //got response so hide the loading image
            $ntlploader.hide();
        });

       	function nt_lp_setupwizard1(){
       	jQuery('#ntlploader').show();
			var data = {
			        'action': 'ntlpinstallrequiredplugin',
			      };
			    method: "POST",
			    jQuery.post(ajaxurl, data, function(response) {
	    			jQuery('.step2').removeAttr("disabled");
	    			jQuery('.step2').addClass('active');
       				jQuery('#ntlploader').hide();
	    			nt_lp_setupwizard(event, 'step2');
			    });
		}


        jQuery('#ntlpadditonalform').on('click',function(e){
        	e.preventDefault();
        		var ntlpheadjs = jQuery('#ntlpheadjs').val();

        		var ntlpfootjs = jQuery('#ntlpfootjs').val();

        		var ntlpcss = jQuery('#ntlpcss').val();

			    var data = {
			        'action': 'ntlpsaveadditonaldata',
			        'ntlpheadjs' : ntlpheadjs,
			        'ntlpfootjs' : ntlpfootjs,
			        'ntlpcss'  : ntlpcss,
			      };
			    method: "POST",
			    jQuery.post(ajaxurl, data, function(response) {
			    	nt_lp_setupwizard(event, 'step4');
		          	jQuery('.step4').removeAttr("disabled");
		          	jQuery('.step4').addClass('active');
			    });

        });
 	  
 	  jQuery('#ntlpadditonalformskip').on('click',function(e){
 	  	nt_lp_setupwizard(event, 'step4');
		          	jQuery('.step4').removeAttr("disabled");
		          	jQuery('.step4').addClass('active');
 	  });

        
</script>
<?php } ?>