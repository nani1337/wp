<?php
/*
Plugin Name: TR Timthumb Thumbnail
Plugin URI: http://ngoctrinh.net/
Description: Timthumb. Use filter "tr_timthumb" params: (url,args): - url to image, args: array('w'=>100,'h'=>100,zc=>1,q=>'100') , or you can use shortcode : [tr_timthumb w="100" h="100" zc="1" q="90" class="class" alt="title"]
Version: 1.0.4
Author: Trinh
Author URI: http://ngoctrinh.net/
License: GPL2
*/


define('TRTT_FILE', __FILE__);
define('TRTT_URL', plugins_url('/',__FILE__));
define('TRTT_PATH',plugin_dir_path(__FILE__).'/');

if(is_admin())
{
    include(TRTT_PATH.'inc/admin.php');
}
else
{
    include(TRTT_PATH.'inc/front.php');
}

