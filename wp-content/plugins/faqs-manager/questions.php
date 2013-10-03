<?php
if ($_GET['type'] == "delete" && $_GET['id']) {
  $this->wpdb->query("DELETE FROM {$this->wpdb->prefix}inic_faq_question WHERE id='{$_GET['id']}'");
}
?>

<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
  <h2>Manage FAQs Questions <a class="add-new-h2" href="admin.php?page=inic_faq_questions&type=add">Add New</a></h2>

  <?php
  
  $_where = false;
  if ($_POST['s']) {
    $_where = " WHERE q.question LIKE '%{$_POST['s']}%'";
  }

  if ($_POST['filter_question'] == "Filter") {
    
    if ($_POST['filter_by_group']) {
      $_where .= $_where ? " AND (q.group_id = '{$_POST['filter_by_group']}')" : " WHERE (q.group_id = '{$_POST['filter_by_group']}')";
    }
    
    if ($_POST['filter_by_answer'] == "answered") {
      $_where .= $_where ? " AND (q.answer != '')" : " WHERE (q.answer != '')";
    } else if ($_POST['filter_by_answer'] == "unanswered") {
      $_where .= $_where ? " AND (q.answer = '')" : " WHERE (q.answer = '')";
    }
    
    if ($_POST['filter_by_status'] == 'Active') {
      $_where .= $_where ? " AND (q.status = '1')" : " WHERE (q.status = '1')";
    } else if ($_POST['filter_by_status'] == 'Inactive') {
      $_where .= $_where ? " AND (q.status = '0')" : " WHERE (q.status = '0')";
    }
    
  }

  if($_POST['move_to_another_group'] == 'Move' && !empty($_POST['cb_bulk'])) {
    foreach($_POST['cb_bulk'] as $_bulk_id) {
      $this->wpdb->update("{$this->wpdb->prefix}inic_faq_question", array("group_id"=>$_POST['move_to_group_id']), array("id"=>$_bulk_id));
    }
  }
  
  $listing = new iNIC_listing("SELECT q.*, g.group_name FROM {$this->wpdb->prefix}inic_faq_question q LEFT JOIN {$this->wpdb->prefix}inic_faq_group g ON (q.group_id = g.id){$_where}");
  $listing->per_page = 10;
  $listing->add_columns("cb", '<input type="checkbox" />', false);
  $listing->add_columns('question', "Question", true);
  $listing->add_columns('group_name', "Group Name", "g.group_name");
  $listing->add_columns('status', "Status", true);
  $listing->add_columns('who_asked', "Who Asked", true);
  $listing->add_columns('date_time', "Date", true);

  $listing->add_action("question", "edit", "<a href='admin.php?page=inic_faq_questions&type=add&id=id'>Edit</a>");
  $listing->add_action("question", "delete", "<a href='admin.php?page=inic_faq_questions&type=delete&id=id'>Delete</a>");

  $_filter_group_option = $_move_to_group_option = false;
  $_groups = $this->wpdb->get_results("SELECT id, group_name FROM {$this->wpdb->prefix}inic_faq_group ORDER BY group_name");
  if ($_groups) {
    foreach ($_groups as $_groups) {
      $_is_selected = $_POST['filter_by_group'] == $_groups->id ? ' selected="selected"' : '';
      $_filter_group_option .= "<option value=\"{$_groups->id}\"{$_is_selected}>{$_groups->group_name}</option>";

      $_is_selected = $_POST['move_to_group_id'] == $_groups->id ? ' selected="selected"' : '';
      $_move_to_group_option .= "<option value=\"{$_groups->id}\"{$_is_selected}>{$_groups->group_name}</option>";
    }
  }

  $_filter_by_answer_answered_selected = $_POST['filter_by_answer'] == 'answered' ? ' selected="selected"' : '';
  $_filter_by_answer_unanswered_selected = $_POST['filter_by_answer'] == 'unanswered' ? ' selected="selected"' : '';
  $_filter_by_status_active_selected = $_POST['filter_by_status'] == 'Active' ? ' selected="selected"' : '';
  $_filter_by_status_inactive_selected = $_POST['filter_by_status'] == 'Inactive' ? ' selected="selected"' : '';
  
  $listing->table_nav_top = <<<HTML
          <div class="alignleft actions">
            <select name="filter_by_group">
            <option value="0">View all Group</option>
            {$_filter_group_option}
            </select>
            
            <select name="filter_by_answer">
              <option value="0">View all Answer</option>
              <option value="answered"{$_filter_by_answer_answered_selected}>Only Answered</option>
              <option value="unanswered"{$_filter_by_answer_unanswered_selected}>Only Unanswer</option>
            </select>
            
            <select name="filter_by_status">
              <option value="0">Status</option>
              <option value="Active"{$_filter_by_status_active_selected}>Active</option>
              <option value="Inactive"{$_filter_by_status_inactive_selected}>Inactive</option>
            </select>
              
            <input type="submit" value="Filter" class="button-secondary" name="filter_question">
         </div>
         
         <div class="alignleft actions">
            <select name="move_to_group_id">
            <option value="0">Move to Group</option>
            {$_move_to_group_option}
            </select>
            <input type="submit" value="Move" class="button-secondary" name="move_to_another_group">
         </div>
HTML;

  $listing->rendar();

  function column_cb($item) {
    $_POST['cb_bulk'] = (isset($_POST['cb_bulk']) && !empty($_POST['cb_bulk'])) ? $_POST['cb_bulk'] : array();
    $_is_checked_cb = (in_array($item[0]['id'], $_POST['cb_bulk'])) ? ' checked="checked"' : '';
    return sprintf('<input type="checkbox" name="cb_bulk[]" value="%s"%s />', $item[0]['id'], $_is_checked_cb);
  }

  function column_status($item, $column_name) {

    if ($item[$column_name]) {
      return "<span style=\"color:green\">Active</span>";
    } else {
      return "Inactive";
    }
  }

  function column_date_time($item, $column_name) {
    return date("d M Y", strtotime($item[$column_name]));
  }
  ?>
</div>

<style>
  .column-status {width: 9%;}
  .column-who_asked {width: 20%;}
  .column-date_time {width: 10%;}
</style>

<script>
  jQuery(".row-actions .delete a").click(function(e){
    
    var r = confirm("Are you sure want to delete this question?");
    
    if(r == false)
      e.preventDefault();
    
  });
  
  jQuery("input[name=move_to_another_group]").click(function(e){
    var r = confirm("Are you sure want to Move selected question to selected group?");
    
    if(r == false)
      e.preventDefault();
  });
</script>