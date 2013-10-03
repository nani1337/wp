<?php

if(isset($_GET['id']) && $_GET['id'] && is_numeric($_GET['id'])) {
  $_current_group = $this->wpdb->get_results("SELECT * FROM {$this->wpdb->prefix}inic_faq_group WHERE id='{$_REQUEST['id']}'", "ARRAY_A");
  extract($_current_group[0]);
} else {
  $id = $group_name = false;
  $search_box = $ask_box = $status = 1;
}
?>

<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
  <h2>Save a Group <a class="add-new-h2" href="admin.php?page=inic_faq">View All</a></h2><br />
  
  <div id="message" class="below-h2"></div>
  
  <form method="POST" action="" name="save_group">
    <input type="hidden" name="action" value="inic_faq_groups" />
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    
    <table class="form-table">
      
      <tbody>
        <tr>
          <th>Group Name</th>
          <td>
            <input type="text" name="group_name" value="<?php echo $group_name; ?>" class="regular-text" />
            <p class="description">the name of your group for identification purposes</p>
          </td>
        </tr>
        
        <tr>
          <th>Show Search Box</th>
          <td>
            <input type="radio" name="search_box" value="1"<?php echo $search_box ? ' checked="checked"' : ''; ?> /> Yes &nbsp; 
            <input type="radio" name="search_box" value="0"<?php echo $search_box ? '' : ' checked="checked"'; ?> /> No
            <p class="description">place a search box above the group questions on the front-end</p>
          </td>
        </tr>
        
        <tr>
          <th>Show Ask Box</th>
          <td>
            <input type="radio" name="ask_box" value="1"<?php echo $ask_box ? ' checked="checked"' : ''; ?> /> Yes &nbsp; 
            <input type="radio" name="ask_box" value="0"<?php echo $ask_box ? '' : ' checked="checked"'; ?> /> No
            <p class="description">place a submission box below the group questions for users/members to ask question</p>
          </td>
        </tr>
        
        <tr>
          <th>Status</th>
          <td>
            <input type="radio" name="status" value="1"<?php echo $status ? ' checked="checked"' : ''; ?> /> Active &nbsp; 
            <input type="radio" name="status" value="0"<?php echo $status ? '' : ' checked="checked"'; ?> /> Inactive
            <p class="description">deactivating a group will prevent it's questions from being show on the front-end</p>
          </td>
        </tr>
        
      </tbody>
      
    </table>
    <p class="submit">
      <input type="submit" value="Save Group" class="button-primary" id="submit" name="submit">
      <img src="/wp-admin/images/wpspin_light.gif" style="vertical-align: middle;" class="ajax-loading" />
    </p>
    
  </form>
</div>

<script>
  jQuery("form[name=save_group]").submit(function(e){
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

    }, 'json');    
    e.preventDefault();
  });
</script>