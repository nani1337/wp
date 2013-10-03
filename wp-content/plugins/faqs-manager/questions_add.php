<?php
if(isset($_GET['id']) && $_GET['id'] && is_numeric($_GET['id'])) {
  $_current_question = $this->wpdb->get_results("SELECT * FROM {$this->wpdb->prefix}inic_faq_question WHERE id='{$_REQUEST['id']}'", "ARRAY_A");
  extract($_current_question[0]);
} else {
  $id = $question = $answer = $group_id = $who_asked = false;
  $status = 1;
}
?>

<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
  <h2>Save a Question <a class="add-new-h2" href="admin.php?page=inic_faq_questions">View All</a></h2>

  <div id="message" class="below-h2"></div>
  
  <form name="save_question" method="POST" action="">

    <input type="hidden" name="action" value="inic_faq_questions" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <input type="hidden" name="who_asked" value="<?php echo $who_asked; ?>" />
    
    <div id="poststuff">
      <div id="post-body" class="metabox-holder columns-2">

        <div id="post-body-content">

          <div id="titlediv">
            <div id="titlewrap">
              <label for="title" id="title-prompt-text">Enter question here</label>
              <input type="text" autocomplete="off" id="title" value="<?php echo $question; ?>" tabindex="1" name="question">
            </div>
          </div>

          <div class="inside">
            <?php wp_editor(stripslashes($answer), 'answer', array('media_buttons' => false, 'textarea_rows' => 15, 'tinymce' => false, 'tabindex' => 2)); ?>
          </div>

        </div>

        <div id="postbox-container-1" class="postbox-container">

          <div class="meta-box-sortables ui-sortable" id="side-sortables">

            <div class="postbox">
              <h3>FAQ Group</h3>
              <div class="inside">
                <select name="group_id" style="width:100%;" tabindex="3">
                  <?php
                  $_groups = $this->wpdb->get_results("SELECT g.*, COUNT(q.id) AS question FROM {$this->wpdb->prefix}inic_faq_group g LEFT JOIN {$this->wpdb->prefix}inic_faq_question q ON (g.id = q.group_id) GROUP BY g.id");
                  if($_groups) {
                    foreach($_groups as $_groups) {
                      $_group_status = $_groups->status ? "Active" : "Inactive";
                      $_is_selected = $group_id == $_groups->id ? ' selected="selected"' : '';
                      echo "<option value=\"{$_groups->id}\"{$_is_selected}>{$_groups->group_name} ({$_group_status}) ({$_groups->question} Questions)</option>";
                    }
                  } else {
                    echo "<option value=\"0\">No group created at.</option>";
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="postbox">
              <h3>Save FAQ</h3>
              <div class="inside">

                <div class="misc-pub-section">
                  <label style="font-weight: bold; width:75px; display:inline-block;">Status:</label>
                  <input type="radio" name="status" value="1"<?php echo $status ? ' checked="checked"' : '' ?> tabindex="4" /> Active &nbsp; 
                  <input type="radio" name="status" value="0"<?php echo $status ? '' : ' checked="checked"' ?> tabindex="5" /> Inactive &nbsp; 
                </div>

                <div id="major-publishing-actions">
                  <div id="publishing-action">
                    <img alt="" class="ajax-loading" src="/wp-admin/images/wpspin_light.gif" style="vertical-align:middle;">
                    <input type="submit" accesskey="s" value="Save Question" class="button-primary" name="save_question" tabindex="6" />
                    <a href="javascript:void(0);" id="add_new" accesskey="n" class="button-primary" style="display:none;">New</a>
                  </div>
                  <div class="clear"></div>
                </div>

              </div>
            </div>

          </div>

        </div>

      </div>
      <br class="clear">
    </div>

  </form>
</div>

<script>
  jQuery("input[name=question]").keyup(function(){
    var _this = jQuery(this);
    
    if(_this.val().length > 0) {
      _this.prev('label').hide();
    } else {
      _this.prev('label').show();
    }
    
  });
  jQuery("input[name=question]").trigger("keyup");
  
  jQuery("form[name=save_question]").submit(function(e){
    var _this = jQuery(this);    
    jQuery("img.ajax-loading").css('visibility', 'visible');
    _this.find("input[type=submit]").attr('disabled', 'disabled');    
    jQuery.post(ajaxurl, _this.serialize(), function(data) {
      
      if(data.success) {
        jQuery("#message").removeClass('error').addClass('updated').html("<p>"+data.success+"</p>");
        if(data.id) {
          jQuery("input[name=id]").val(data.id);
        }
        
      } else if(data.error) {
        jQuery("#message").removeClass('updated').addClass('error').html("<p>"+data.error+"</p>");
      }
      
      jQuery("img.ajax-loading").css('visibility', 'hidden');
      _this.find("input[type=submit]").removeAttr('disabled');
      
      jQuery("a#add_new").css("display","inline-block");

    }, 'json');    
    e.preventDefault();
  });
  
jQuery("a#add_new").click(function(){
  jQuery("input[name=id]").val('');
  jQuery("form[name=save_question]").trigger('submit');
});
</script>