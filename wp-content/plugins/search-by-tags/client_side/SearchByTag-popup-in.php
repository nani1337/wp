<?php
/*
 * The html template for the popup window
 */
    $l_event=get_option('open_lightbox_event','hover'); 
    $l_new_link = get_option('open_link_in_new_page',1);
    $l_google_search = get_option('display_google_search',1);
    $l_wp_tags_page = get_option('display_wp_tags_page',1);
    $l_wiki_search = get_option('display_wiki_search',1);
    
    if ($l_new_link==0)
        $target = '';
    else $target = 'target="_blank"';
    
    
    if ($l_event=='hover'){
        $div_popup_mouseenter=" onmouseover = 'popup_mouseenter();'";
        $div_popup_mouseleave=" onmouseout = 'popup_mouseleave();'";
    }   
    
    
    
?>

    
    <div class='SearchByTag-popup <?php echo 'l_google_search='.$l_google_search.';'; ?>' <?php echo $div_popup_mouseenter;?> <?php echo $div_popup_mouseleave;?>>
        <div class='SearchByTag-popup-top'></div>
        <div class='SearchByTag-popup-content'>
            <ul>
                <?php  if ($l_google_search!=0){ ?>
                <li <?php if ($l_wiki_search==0 && $l_wp_tags_page==0) echo 'class="last"';?>><a class="sbt-google-search" href="http://www.google.com?cx=partner-pub-9761369273396159:6077738498&ie=UTF-8&q=%s" <?php echo $target; ?>>Search TagX on Google</a></li>
                <?php } ?>
                <?php if ($l_wp_tags_page!=0){ ?>
                <li <?php if ($l_wiki_search==0) echo 'class="last"';?>><a class="sbt-wp-search" href="%s" <?php echo $target; ?>>View all posts tagged as Tagx</a></li>
                <?php } ?>
                <?php if ($l_wiki_search!=0){ ?>
                <li class="last"> <a class="sbt-wiki-search" href="http://en.wikipedia.org/wiki/%s" <?php echo $target; ?>>Find TagX related info in WikiPedia</a></li>
                <?php } ?>
            </ul>    
        </div>
        <div class='SearchByTag-popup-bottom'></div>
    </div>
