<div class="wrap">
  <form method="post" action="options.php">
    <h2><?php echo $this->_name ?></h2>
    <div class="sbt-options-block">
        <h3><span>General settings</span></h3>
            <?php settings_fields('sbt-settings-group'); ?>
            <table class="form-table sbt">
                <?php
                $l_event = get_option('open_lightbox_event','hover');
                $l_new_link = get_option('open_link_in_new_page',1);
                $l_google_search = get_option('display_google_search',1);
                $l_wp_tags_page = get_option('display_wp_tags_page',1);
                $l_wiki_search = get_option('display_wiki_search',1);
                ?>
                <tr><td style="width:5px;"><input type="radio" name="open_lightbox_event" value="hover" <?php if ($l_event == 'hover') echo " checked"; ?>/></td><th scope="row"  style="width:330px;">Open Lightbox on mouse over</th></tr>
                <tr valign="top"><td style="width:5px;"><input type="radio" name="open_lightbox_event" value="click" <?php if ($l_event == 'click') echo " checked"; ?>/></td><th scope="row"  style="width:330px;"> Open Lightbox on mouse click</th></tr>
                <tr valign="top"> <td style="width:5px;"><input type="checkbox" name="open_link_in_new_page" value="1" <?php if ($l_new_link == 1) echo " checked"; ?>/></td><th scope="row"  style="width:330px;">Open links in New page </th></tr>        
            </table> 
    </div>
    <div class="sbt-options-block">
        <h3><span>Lightbox settings</span></h3>        
        <table class="form-table sbt">
            <tr valign="top"> <td style="width:5px;"><input type="checkbox" name="display_google_search" value=1"  <?php if ($l_google_search == 1) echo " checked"; ?>/></td><th scope="row"  style="width:330px;">Display “Search TagX on google” option </th></tr>        
            <tr valign="top"> <td style="width:5px;"><input type="checkbox" name="display_wp_tags_page" value="1"  <?php if ($l_wp_tags_page == 1) echo " checked"; ?>/></td><th scope="row"  style="width:330px;">Display “View all posts tagged as TagX” option</th></tr>        
            <tr valign="top"> <td style="width:5px;"><input type="checkbox" name="display_wiki_search" value="1"  <?php if ($l_wiki_search == 1) echo " checked"; ?>/></td><th scope="row"  style="width:330px;">Display “Find TagX related info in WikiPedia” option</th></tr>        
        </table>
    </div>
    <p class="submit">
        <input type="submit" class="sbt-button-save" value="<?php _e('Save Changes') ?>" />
    </p>
</form>

</div>    

