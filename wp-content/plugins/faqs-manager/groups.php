<?php
if ($_GET['type'] == "delete" && $_GET['id']) {
  $this->wpdb->query("DELETE FROM {$this->wpdb->prefix}inic_faq_group WHERE id='{$_GET['id']}'");
}
?>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
  <h2>Manage FAQs Groups <a class="add-new-h2" href="admin.php?page=inic_faq&type=add">Add New</a></h2>

  <?php
  $_where = false;
  if($_POST['s']) {
    $_where = " WHERE g.group_name LIKE '%{$_POST['s']}%'";
  }
  
  if($_POST['filter_group'] == 'Filter') {
    
    if($_POST['filter_by_search_box'] == 'yes') {
      $_where .= $_where ? " AND (g.search_box = '1')" : " WHERE (g.search_box = '1')";
    } else if($_POST['filter_by_search_box'] == 'no') {
      $_where .= $_where ? " AND (g.search_box = '0')" : " WHERE (g.search_box = '0')";
    }
    
    if($_POST['filter_by_ask_box'] == 'yes') {
      $_where .= $_where ? " AND (g.ask_box = '1')" : " WHERE (g.ask_box = '1')";
    } else if($_POST['filter_by_ask_box'] == 'no') {
      $_where .= $_where ? " AND (g.ask_box = '0')" : " WHERE (g.ask_box = '0')";
    }
    
    if($_POST['filter_by_status'] == 'Active') {
      $_where .= $_where ? " AND (g.status = '1')" : " WHERE (g.status = '1')";
    } else if($_POST['filter_by_status'] == 'Inactive') {
      $_where .= $_where ? " AND (g.status = '0')" : " WHERE (g.status = '0')";
    }
    
  }
  
  $listing = new iNIC_listing("SELECT g.*, COUNT(q.id) AS question FROM {$this->wpdb->prefix}inic_faq_group g LEFT JOIN {$this->wpdb->prefix}inic_faq_question q ON (g.id = q.group_id){$_where} GROUP BY g.id");
  $listing->add_columns('group_name', "Name", true);
  $listing->add_columns('question', "Question", true);
  $listing->add_columns('search_box', "Search Box", true);
  $listing->add_columns('ask_box', "Ask Box", true);
  $listing->add_columns('status', "Status", true);
  $listing->add_columns('shortcode', "Shortcode");

  $listing->add_action("group_name", "edit", "<a href='admin.php?page=inic_faq&type=add&id=id'>Edit</a>");
  $listing->add_action("group_name", "delete", "<a href='admin.php?page=inic_faq&type=delete&id=id'>Delete</a>");
  $listing->add_action("group_name", "question", "<a href='admin.php?page=inic_faq&type=order_question&id=id'>Order Questions</a>");
  
  $filter_by_searchbox_yes_selected = $_POST['filter_by_search_box'] == 'yes' ? ' selected="selected"' : '';
  $filter_by_searchbox_no_selected = $_POST['filter_by_search_box'] == 'no' ? ' selected="selected"' : '';
  $filter_by_askbox_yes_selected = $_POST['filter_by_ask_box'] == 'yes' ? ' selected="selected"' : '';
  $filter_by_askbox_no_selected = $_POST['filter_by_ask_box'] == 'no' ? ' selected="selected"' : '';
  $filter_by_status_active_selected = $_POST['filter_by_status'] == 'Active' ? ' selected="selected"' : '';
  $filter_by_status_inactive_selected = $_POST['filter_by_status'] == 'Inactive' ? ' selected="selected"' : '';
  
  $listing->table_nav_top = <<<HTML
          <div class="alignleft actions">
            <select name="filter_by_search_box">
              <option value="0">Search Box</option>
              <option value="yes"{$filter_by_searchbox_yes_selected}>Yes</option>
              <option value="no"{$filter_by_searchbox_no_selected}>No</option>
            </select>
            
            <select name="filter_by_ask_box">
              <option value="0">Ask Box</option>
              <option value="yes"{$filter_by_askbox_yes_selected}>Yes</option>
              <option value="no"{$filter_by_askbox_no_selected}>No</option>
            </select>
            
            <select name="filter_by_status">
              <option value="0">Status</option>
              <option value="Active"{$filter_by_status_active_selected}>Active</option>
              <option value="Inactive"{$filter_by_status_inactive_selected}>Inactive</option>
            </select>
              
            <input type="submit" value="Filter" class="button-secondary" name="filter_group">
         </div>
HTML;
            
  $listing->rendar();

  function column_group_name($item, $column_name) {
    global $wpdb;
    
    $_post_for_shortcode = $wpdb->get_results("SELECT post_title, ID FROM {$wpdb->prefix}posts WHERE post_status='publish' AND post_content LIKE '%[INICfaq id={$item['id']}%'");
    if($_post_for_shortcode) {
      $post_link = get_permalink( $_post_for_shortcode[0]->ID );
      return "<a href=\"{$post_link}\" target=\"_blank\"><strong>{$item[$column_name]}</strong></a>";
    } else {
      return "<strong>{$item[$column_name]}</strong>";
    }
    //return "<a href=\"#\"><strong>{$item[$column_name]}</strong></a>";
  }
  
  function column_status($item, $column_name) {
    
    if($item[$column_name]) {
      return "<span style=\"color:green\">Active</span>";
    } else {
      return "Inactive";
    }
  }
  
  function column_shortcode($item, $column_name) {
    return "[iNICfaq id={$item['id']}]";
  }
  
  function prepare_action($_action, $_item, $_column_name) {
    if($_item['id'] == 1) {
      unset($_action['delete']);
    }
    return $_action;
  }
  
  ?>
</div>

<style>
  .column-group_name {width: 40%;}
</style>