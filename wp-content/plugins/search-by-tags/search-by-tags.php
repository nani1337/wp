<?php

/**
* Plugin Name: Search by Tags
* Description: Let your readers search the web or your website directly from your posts content for any of your Tags. It will also improve your website's SEO.
* Version: 1.0.0
* Author: Mayerz
* License: GPL2
*/

error_reporting(0);

if (!class_exists('SearchByTag')) {

    class SearchByTag {

        public $_name = 'SearchByTag';


        public function __construct() {
            // to add menu to the admin panel's menu structure
            add_action('admin_menu', array($this, 'admin_menu'));
            add_action('admin_head',array($this, 'admin_head'));
            add_action('wp_enqueue_scripts', array($this, 'enqueue_client_styles'));
            add_filter('the_content', array($this, 'client_pages_filter'),100);
            wp_enqueue_script('searchbytag', plugin_dir_url(__FILE__) . 'client_side/js/searchbytag.js', array('jquery'));
        }

        /*
         * To add menu to the admin panel's menu structure
         */
        public function admin_menu() {
            add_menu_page('SearchByTag Plugin Settings', 'SearchByTag', 'administrator'
                    , __FILE__, array($this, 'admin_settings_page'));

            add_submenu_page( __FILE__, __( 'Edit SearchByTag Settings' ), __( 'Edit'),
		'administrator', __FILE__, array($this, 'admin_settings_page') );

            add_action('admin_init', array($this, 'register_settings'));
        }

        public function admin_head() {
		$stylesheet = plugin_dir_url(__FILE__) . '/styles.css';
		echo '<link rel="stylesheet" href="' . $stylesheet . '" type="text/css" media="screen" />';
	}
        /*
         * Function for outputting the Settings page content
         */
        public function admin_settings_page() {
            include_once 'options_page.php';
        }



        /*
         * To register settings
         */
        public function register_settings() {
            register_setting('sbt-settings-group', 'open_lightbox_event'); // Open Lightbox event (on mouse over/ on mouse click)
            register_setting('sbt-settings-group', 'open_link_in_new_page'); // Open links in New page  (yes/ no)
            register_setting('sbt-settings-group', 'display_google_search'); // Display “Search TagX on google” option  (yes/ no)
            register_setting('sbt-settings-group', 'display_wp_tags_page'); // Display “View all posts tagged as TagX” option  (yes/ no)
            register_setting('sbt-settings-group', 'display_wiki_search'); // Display “Find TagX related info in WikiPedia” option  (yes/ no)
        }

        /*
         * To add plugin CSS to the wordpress generated page
         */
        public function enqueue_client_styles() {
            if (!is_admin()) {
                wp_enqueue_style('my-custom-style', plugin_dir_url(__FILE__) . 'client_side/css/styles.css', false, '1.1', 'all');
            }
        }


        /*
         * To filter the content of the post after it is retrieved from the database and before it is printed to the screen.
         */
        public function client_pages_filter($content) {

            global $post;


            $l_google_search = get_option('display_google_search',1);
            $l_wp_tags_page = get_option('display_wp_tags_page',1);
            $l_wiki_search = get_option('display_wiki_search',1);

            // if all options deactivated - return the original content
            if ((empty($l_google_search) || ($l_google_search==0)) && (empty($l_wp_tags_page) || ($l_wp_tags_page==0)) && (empty($l_wiki_search) || ($l_wiki_search==0)))
            return $content;

            // if PHP version less then 5 - return the original content
            $version = explode('.', PHP_VERSION);
            $major_version = intval($version[0]);
            if ($major_version<5) return $content;

            // else - search tags
            //
            // get tags of this post (array of the names)
            $tags = wp_get_post_tags( $post->ID );

            foreach($tags as $tag){
                $tag_title = $tag->name;
                $tag_link = get_tag_link($tag->term_id);
                $content = $this->highlight_paragraph($content,$tag_link,$tag_title);
            }

            $items_count = 0;

            // Search on google li
            if ($l_google_search!=0)
                $items_count++;
            if ($l_wp_tags_page!=0)
                $items_count++;
            if ($l_wiki_search!=0)
                $items_count++;

            ob_start();
            include_once 'client_side/SearchByTag-popup-in.php';
            $span = ob_get_contents();
            ob_end_clean();
            return sprintf($span,'1','1','1','1')."<script type='text/javascript'> var l_height = ".$items_count."*43+46; jQuery(document).ready(function(){ie7_css_correct();});</script>".$content;
        }

	public function highlight_paragraph($string,$tag_link, $keyword) {
                $dom = new DOMDocument();
                $dom->loadHtml('<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /></head><body>'.$string.'</body></html>');

                // Search for all text blocks containing the keyword
                $xpath = new DOMXpath($dom);
				$textNodes = $xpath->query('//*/text()');
                foreach ($textNodes as $textNode) {
                    $fragment = $dom->createDocumentFragment();
                    $text = $textNode->nodeValue;
                    $parent_tag_name = $textNode->parentNode->tagName;
                    $parent_class = $textNode->parentNode->getAttribute('class');
                    if($parent_tag_name=='script' || ($parent_tag_name=='span' && $parent_class=='SearchByTag-tag'))
                        continue;

                    while (($pos = stripos($text, $keyword)) !== false) {
                        $fragment->appendChild(new DOMText(substr($text, 0, $pos)));
                        $word = substr($text, $pos, strlen($keyword));

                        $highlight = $dom->createElement('span');
                        $highlight->appendChild(new DOMText($word));
                        $highlight->setAttribute('class', 'SearchByTag-tag');
                        $l_event=get_option('open_lightbox_event','hover');
                        if ($l_event=='click')
                            $highlight->setAttribute("onclick","show_searchByTags_click(this,'".$keyword."','".$tag_link."');");
                        else {
                            $highlight->setAttribute("onmouseover","show_searchByTags_enter(this,'".$keyword."','".$tag_link."');");
                            $highlight->setAttribute("onmouseout","show_searchByTags_leave();");
                        }
                        $fragment->appendChild($highlight);

                        $text = substr($text, $pos + strlen($keyword));
                    }

                    if (!empty($text))
                        $fragment->appendChild(new DOMText($text));

                    $textNode->parentNode->replaceChild($fragment, $textNode);
                }
		$html = $dom->saveHTML();
                $html = preg_replace('#</?(body|html|head|meta)[^>]*>#i', '', $html);
                $html = preg_replace('#<!DOCTYPE[^>]*>#i', '', $html);
                return $html;
            }

   }

}
$oSearchByTag = new SearchByTag();
?>
