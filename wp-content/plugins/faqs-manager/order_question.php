<?php
if ($_GET['type'] == "delete" && $_GET['id']) {
  $this->wpdb->query("DELETE FROM {$this->wpdb->prefix}inic_faq_group WHERE id='{$_GET['id']}'");
}
?>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
  <h2>Order Group Question <a class="add-new-h2" href="admin.php?page=inic_faq">All Groups</a> <a class="add-new-h2" href="admin.php?page=inic_faq&type=add">Add New Group</a> <a class="add-new-h2" href="admin.php?page=inic_faq_questions">All Questions</a> <a class="add-new-h2" href="admin.php?page=inic_faq_questions&type=add">Add New Questions</a></h2>

  <?php
  $_current_group_question = $this->wpdb->get_results("SELECT * FROM {$this->wpdb->prefix}inic_faq_question WHERE group_id='{$_GET['id']}' ORDER BY ord_by ASC", ARRAY_A);
  
  if($_current_group_question) {
    
    echo '<ul id="sortable">';
    
    foreach($_current_group_question as $_current_group_question) {
      echo '<li id="sort_'.$_current_group_question['id'].'" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'.$_current_group_question['question'].'</li>';
    }
    
    echo '</ul>';
    
    echo '<style>
	#sortable { list-style-type: none; margin: 0; padding: 0; width: 100%; cursor:ns-resize; }
	#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 13px;}
	#sortable li span { position: absolute; margin-left: -1.3em; }
	</style>';
    
    echo '<link rel="stylesheet" href="'.$this->pluginUrl.'jquery/jquery-ui.css" type="text/css" media="all" />
      <script src="'.$this->pluginUrl.'jquery/jquery-ui.min.js"></script>
      <script>
        jQuery(function() {
          jQuery( "#sortable" ).sortable({
            update: function(event, ui) {
              jQuery.post(ajaxurl, jQuery(this).sortable("serialize")+"&action=inic_faq_order_question");
            }
          });
          jQuery( "#sortable" ).disableSelection();
        });
      </script>';    
  } else {
    echo "<h3>No Question found, <a href='admin.php?page=inic_faq_questions&type=add'><strong>click here</strong></a> to create.</h3>";
  }
  ?>
  
</div>