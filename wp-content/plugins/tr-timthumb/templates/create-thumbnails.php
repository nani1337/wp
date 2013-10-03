<div id="message" class="updated fade" style="display:none"></div>

<div class="wrap regenthumbs">
	<h2><?php _e('reCreate Thumbnails'); ?></h2>

<?php

global $wpdb;

    wp_enqueue_script('jquery-ui');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-progressbar');
    wp_enqueue_style('jquery-ui',TRTT_URL.'css/jquery-ui-1.10.2.custom.min.css');
    
    
    
		// If the button was clicked
		if ( ! empty( $_POST['tr-thumbnails'] ) || ! empty( $_REQUEST['ids'] ) ) {
			// Capability check
			if ( ! current_user_can( 'manage_options' ) )
				wp_die( __( 'Cheatin&#8217; uh?' ) );

			// Form nonce check
			check_admin_referer( 'tr-thumbnails' );

			// Create the list of image IDs
			if ( ! empty( $_REQUEST['ids'] ) ) {
				$images = array_map( 'intval', explode( ',', trim( $_REQUEST['ids'], ',' ) ) );
				$ids = implode( ',', $images );
			} else {
				// Directly querying the database is normally frowned upon, but all
				// of the API functions will return the full post objects which will
				// suck up lots of memory. This is best, just not as future proof.
				if ( ! $images = $wpdb->get_results( "SELECT ID FROM $wpdb->posts WHERE post_type = 'attachment' AND post_mime_type LIKE 'image/%' ORDER BY ID DESC" ) ) {
					echo '	<p>' . sprintf( __( "Unable to find any images. Are you sure <a href='%s'>some exist</a>?", 'tr-thumbnails' ), admin_url( 'upload.php?post_mime_type=image' ) ) . "</p></div>";
					return;
				}

				// Generate the list of IDs
				$ids = array();
				foreach ( $images as $image )
					$ids[] = $image->ID;
				$ids = implode( ',', $ids );
			}

			echo '	<p>' . __( "Please be patient while the thumbnails are reCreated. This can take a while if your server is slow (inexpensive hosting) or if you have many images. Do not navigate away from this page until this script is done or the thumbnails will not be resized. You will be notified via this page when the regenerating is completed.", 'tr-thumbnails' ) . '</p>';

			$count = count( $images );

			$text_goback = ( ! empty( $_GET['goback'] ) ) ? sprintf( __( 'To go back to the previous page, <a href="%s">click here</a>.', 'tr-thumbnails' ), 'javascript:history.go(-1)' ) : '';
			$text_failures = sprintf( __( 'All done! %1$s image(s) were successfully resized in %2$s seconds and there were %3$s failure(s). To try regenerating the failed images again, <a href="%4$s">click here</a>. %5$s', 'tr-thumbnails' ), "' + rt_successes + '", "' + rt_totaltime + '", "' + rt_errors + '", esc_url( wp_nonce_url( admin_url( 'tools.php?page=tr-thumbnails&goback=1' ), 'tr-thumbnails' ) . '&ids=' ) . "' + rt_failedlist + '", $text_goback );
			$text_nofailures = sprintf( __( 'All done! %1$s image(s) were successfully resized in %2$s seconds and there were 0 failures. %3$s', 'tr-thumbnails' ), "' + rt_successes + '", "' + rt_totaltime + '", $text_goback );
?>


	<noscript><p><em><?php _e( 'You must enable Javascript in order to proceed!', 'tr-thumbnails' ) ?></em></p></noscript>

	<div id="regenthumbs-bar" style="position:relative;height:25px;">
		<div id="regenthumbs-bar-percent" style="position:absolute;left:50%;top:50%;width:300px;margin-left:-150px;height:25px;margin-top:-9px;font-weight:bold;text-align:center;"></div>
	</div>

	<p><input type="button" class="button hide-if-no-js" name="regenthumbs-stop" id="regenthumbs-stop" value="<?php _e( 'Abort Resizing Images', 'tr-thumbnails' ) ?>" /></p>

	<h3 class="title"><?php _e( 'Debugging Information', 'tr-thumbnails' ) ?></h3>

	<p>
		<?php printf( __( 'Total Images: %s', 'tr-thumbnails' ), $count ); ?><br />
		<?php printf( __( 'Images Resized: %s', 'tr-thumbnails' ), '<span id="regenthumbs-debug-successcount">0</span>' ); ?><br />
		<?php printf( __( 'Resize Failures: %s', 'tr-thumbnails' ), '<span id="regenthumbs-debug-failurecount">0</span>' ); ?>
	</p>
    <div  style="overflow: auto;max-height:500px;">
    	<ul id="regenthumbs-debuglist">
    		<li style="display:none"></li>
    	</ul>
    </div>
	<script type="text/javascript">
	// <![CDATA[
		jQuery(document).ready(function($){
			var i;
			var rt_images = [<?php echo $ids; ?>];
			var rt_total = rt_images.length;
			var rt_count = 1;
			var rt_percent = 0;
			var rt_successes = 0;
			var rt_errors = 0;
			var rt_failedlist = '';
			var rt_resulttext = '';
			var rt_timestart = new Date().getTime();
			var rt_timeend = 0;
			var rt_totaltime = 0;
			var rt_continue = true;

			// Create the progress bar
			$("#regenthumbs-bar").progressbar();
			$("#regenthumbs-bar-percent").html( "0%" );

			// Stop button
			$("#regenthumbs-stop").click(function() {
				rt_continue = false;
				$('#regenthumbs-stop').val("<?php echo  __( 'Stopping...') ; ?>");
			});

			// Clear out the empty list element that's there for HTML validation purposes
			$("#regenthumbs-debuglist li").remove();

			// Called after each resize. Updates debug information and the progress bar.
			function RegenThumbsUpdateStatus( id, success, response ) {
				$("#regenthumbs-bar").progressbar( "value", ( rt_count / rt_total ) * 100 );
				$("#regenthumbs-bar-percent").html( Math.round( ( rt_count / rt_total ) * 1000 ) / 10 + "%" );
				

				if ( success ) {
					rt_successes = rt_successes + 1;
					$("#regenthumbs-debug-successcount").html(rt_successes);
					$("#regenthumbs-debuglist").prepend("<li>"+rt_count+'. ' + response.success + "</li>");
				}
				else {
					rt_errors = rt_errors + 1;
					rt_failedlist = rt_failedlist + ',' + id;
					$("#regenthumbs-debug-failurecount").html(rt_errors);
					$("#regenthumbs-debuglist").prepend("<li>"+rt_count+'. '  + response.error + "</li>");
				}
                rt_count = rt_count + 1;
			}

			// Called when all images have been processed. Shows the results and cleans up.
			function RegenThumbsFinishUp() {
				rt_timeend = new Date().getTime();
				rt_totaltime = Math.round( ( rt_timeend - rt_timestart ) / 1000 );

				$('#regenthumbs-stop').hide();

				if ( rt_errors > 0 ) {
					rt_resulttext = '<?php echo $text_failures; ?>';
				} else {
					rt_resulttext = '<?php echo $text_nofailures; ?>';
				}

				$("#message").html("<p><strong>" + rt_resulttext + "</strong></p>");
				$("#message").show();
			}

			// Regenerate a specified image via AJAX
			function RegenThumbs( id ) {
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: { action: "process_create_image", id: id },
					success: function( response ) {
						if ( response !== Object( response ) || ( typeof response.success === "undefined" && typeof response.error === "undefined" ) ) {
							response = new Object;
							response.success = false;
							response.error = "<?php printf( esc_js( __( 'The resize request was abnormally terminated (ID %s). This is likely due to the image exceeding available memory or some other type of fatal error.', 'tr-thumbnails' ) ), '" + id + "' ); ?>";
						}

						if ( response.success ) {
							RegenThumbsUpdateStatus( id, true, response );
						}
						else {
							RegenThumbsUpdateStatus( id, false, response );
						}

						if ( rt_images.length && rt_continue ) {
							RegenThumbs( rt_images.shift() );
						}
						else {
							RegenThumbsFinishUp();
						}
					},
					error: function( response ) {
						RegenThumbsUpdateStatus( id, false, response );

						if ( rt_images.length && rt_continue ) {
							RegenThumbs( rt_images.shift() );
						}
						else {
							RegenThumbsFinishUp();
						}
					}
				});
			}

			RegenThumbs( rt_images.shift() );
		});
	// ]]>
	</script>
<?php
		}

		// No button click? Display the form.
		else {
?>
	<form method="post" action="">
<?php wp_nonce_field('tr-thumbnails') ?>

	<p><?php printf( __( "Use this tool to reCreate thumbnails for all images that you have uploaded to your blog. This is useful if you've changed any of the thumbnail dimensions on the <a href='%s'>media settings page</a>. Old thumbnails will be kept to avoid any broken images due to hard-coded URLs.", 'tr-thumbnails' ), admin_url( 'options-media.php' ) ); ?></p>

	<p><?php printf( __( "You can regenerate specific images (rather than all images) from the <a href='%s'>Media</a> page. Hover over an image's row and click the link to resize just that one image or use the checkboxes and the &quot;Bulk Actions&quot; dropdown to resize multiple images (WordPress 3.1+ only).", 'tr-thumbnails '), admin_url( 'upload.php' ) ); ?></p>

	<p><?php _e( "Thumbnail regeneration is not reversible, but you can just change your thumbnail dimensions back to the old values and click the button again if you don't like the results.", 'tr-thumbnails' ); ?></p>

	<p><?php _e( 'To begin, just press the button below.', 'tr-thumbnails '); ?></p>

	<p><input type="submit" class="button hide-if-no-js" name="tr-thumbnails" id="tr-thumbnails" value="<?php _e( 'Regenerate All Thumbnails', 'tr-thumbnails' ) ?>" /></p>

	<noscript><p><em><?php _e( 'You must enable Javascript in order to proceed!', 'tr-thumbnails' ) ?></em></p></noscript>

	</form>
<?php
		} // End if button
?>
</div>