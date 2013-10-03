<?php
$action = isset($_REQUEST['action'])? $_REQUEST['action'] : '';
$function_action = 'trwr_action_'.$action;
if(function_exists($function_action))
{
    call_user_func($function_action);
}

function trwr_action_process_create_image()
{
    @error_reporting( 0 ); // Don't break the JSON result

	header( 'Content-type: application/json' );

	$id = (int) $_REQUEST['id'];
	$image = get_post( $id );

	if ( ! $image || 'attachment' != $image->post_type || 'image/' != substr( $image->post_mime_type, 0, 6 ) )
		die( json_encode( array( 'error' => sprintf( __( 'Failed resize: %s is an invalid image ID.', 'regenerate-thumbnails' ), esc_html( $_REQUEST['id'] ) ) ) ) );

	if ( ! current_user_can( 'manage_options' ) )
        die( json_encode( array( 'error' => sprintf( __( '&quot;%1$s&quot; (ID %2$s) failed to resize. The error message was: %3$s', 'regenerate-thumbnails' ), esc_html( get_the_title( $image->ID ) ), $image->ID, __( "Your user account doesn't have permission to resize images") ) ) ) );

	$fullsizepath = get_attached_file( $image->ID );

	if ( false === $fullsizepath || ! file_exists( $fullsizepath ) )
        die( json_encode( array( 'error' => sprintf( __( '&quot;%1$s&quot; (ID %2$s) failed to resize. The error message was: %3$s', 'regenerate-thumbnails' ), esc_html( get_the_title( $image->ID ) ), $image->ID,sprintf( __( 'The originally uploaded image file cannot be found at %s', 'regenerate-thumbnails' ), '<code>' . esc_html( $fullsizepath ) . '</code>' ) ) ) ) );

	@set_time_limit( 900 ); // 5 minutes per image should be PLENTY

	$metadata = wp_generate_attachment_metadata( $image->ID, $fullsizepath );

	if ( is_wp_error( $metadata ) )
        die( json_encode( array( 'error' => sprintf( __( '&quot;%1$s&quot; (ID %2$s) failed to resize. The error message was: %3$s', 'regenerate-thumbnails' ), esc_html( get_the_title( $image->ID ) ), $image->ID,$metadata->get_error_message() ) ) ) );
	if ( empty( $metadata ) )
        die( json_encode( array( 'error' => sprintf( __( '&quot;%1$s&quot; (ID %2$s) failed to resize. The error message was: %3$s', 'regenerate-thumbnails' ), esc_html( get_the_title( $image->ID ) ), $image->ID,  __( 'Unknown failure reason.', 'regenerate-thumbnails' ) ) ) ) );

	// If this fails, then it just means that nothing was changed (old value == new value)
	wp_update_attachment_metadata( $image->ID, $metadata );

	die( json_encode( array( 'success' => sprintf( __( '&quot;%1$s&quot; (ID %2$s) was successfully resized in %3$s seconds.', 'regenerate-thumbnails' ), esc_html( get_the_title( $image->ID ) ), $image->ID, timer_stop() ) ) ) );
    
    exit;
}