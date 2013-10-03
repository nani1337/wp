<?php

if (!class_exists('WP_List_Table')) {
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class iNIC_listing extends WP_List_Table {

  var $no_item_message = "No record found.";
  var $_sql = false;
  var $_columns = array();
  var $_sortable_columns = array();
  var $_hidden_columns = array();
  var $_bulk_action = array();
  var $_search_box = true;
  var $_action = array();
  var $table_nav = false;
  var $table_nav_top = false;
  var $table_nav_bottom = false;
  var $per_page = 10;

  function __construct($_sql = false) {

    if ($_sql) {
      parent::__construct(array('singular' => "", 'plural' => "", 'ajax' => false));
      $this->_sql = $_sql;
    }
  }

  function no_items() {
    _e($this->no_item_message);
  }

  /*
   * @example: add_columns('cb', '<input type="checkbox" />');
   */

  function add_columns($_key, $_val, $_is_sortable = false) {
    $this->_columns[$_key] = $_val;

    if ($_is_sortable === true) {
      $this->add_sortable_columns($_key);
    } else if($_is_sortable) {
      $this->add_sortable_columns($_key, false, $_is_sortable);
    }
  }

  function add_hidden_columns() {
    
  }

  function add_sortable_columns($_key, $_is_all_ready_sorted = false, $_is_sortable_other_key = false) {
    
    if($_is_sortable_other_key) {
      $this->_sortable_columns[$_key] = array($_is_sortable_other_key, $_is_all_ready_sorted);
    } else if ($_key) {
      $this->_sortable_columns[$_key] = array($_key, $_is_all_ready_sorted);
    }
      
  }

  function add_action($_column, $_key, $_val) {
    $this->_action[$_column][$_key] = $_val;
  }

  function column_default($item, $column_name) {

    $_column_finction_name = "column_$column_name";

    if (array_key_exists($column_name, $this->_action)) {
      $_action = array();
      foreach ($this->_action[$column_name] as $k => $v) {
        foreach ($item as $_k => $_v) {
          $v = str_replace("{$_k}={$_k}", "{$_k}={$_v}", $v);
        }
        $_action[$k] = $v;
      }

      if (function_exists($_column_finction_name)) {
        $item[$column_name] = $_column_finction_name($item, $column_name);
      }

      if (function_exists("prepare_action")) {
        $_action = prepare_action($_action, $item, $column_name);
      }

      return sprintf('%1$s %2$s', $item[$column_name], $this->row_actions($_action));
    } else if (array_key_exists($column_name, $this->_columns)) {
      if (function_exists($_column_finction_name)) {
        $item[$column_name] = $_column_finction_name($item, $column_name);
      }
      return $item[$column_name];
    } else {
      return print_r($item, true);
    }
  }

  function extra_tablenav($witch) {

    echo $this->table_nav;

    if ($witch == 'top') {
      echo $this->table_nav_top;
    } else if ($witch == 'bottom') {
      echo $this->table_nav_bottom;
    }
  }

  function get_bulk_actions() {
    return $this->_bulk_action;
  }

  function add_bulk_actions($_key, $_val) {
    $this->_bulk_action[$_key] = $_val;
  }

  function usort_reorder($a, $b) {
    $orderby = (!empty($_GET['orderby']) ) ? $_GET['orderby'] : false;
    $order = (!empty($_GET['order']) ) ? $_GET['order'] : 'asc';
    $result = strcmp($a[$orderby], $b[$orderby]);
    return ( $order === 'asc' ) ? $result : -$result;
  }

  function pr($_array) {
    echo "<pre>";
    print_r($_array);
    echo "</pre>";
  }

  function prepare_items() {
    $this->_column_headers = array($this->_columns, $this->_hidden_columns, $this->_sortable_columns);
    $sort_order = isset($_GET['order']) ? $_GET['order'] : "ASC";
    $orderby_column = isset($_GET['orderby']) ? " ORDER BY {$_GET['orderby']} {$sort_order}" : false;

    global $wpdb;
    if (is_array($this->_sql)) {
      if ($orderby_column == false) {
        $data = $this->_sql;
      } else {
        $data = $this->_sql;
        usort($data, array(&$this, 'usort_reorder'));
      }
    } else {
      $data = $wpdb->get_results("{$this->_sql}{$orderby_column}", ARRAY_A);
    }

    $current_page = $this->get_pagenum();
    $total_items = count($data);
    if (!empty($_POST)) {
      $this->per_page = $total_items ? $total_items : 1;
    }
    $data = array_slice($data, (($current_page - 1) * $this->per_page), $this->per_page);
    $this->items = $data;


    $this->set_pagination_args(array('total_items' => $total_items, 'per_page' => $this->per_page, 'total_pages' => ceil($total_items / $this->per_page)));
  }

  function rendar() {

    $this->prepare_items();

    if ($this->_search_box == true) {
      echo "<form method=\"post\" name=\"search\" action=\"\">";
      $this->search_box('search', 'search_id');
      echo "</form>";
    }

    echo "<form method=\"post\" name=\"listing_loop\" action=\"\">";
    $this->display();
    echo "</form>";
  }

  function __call($name, $arguments) {
    if (function_exists($name)) {
      return $name($arguments);
    } else {
      return false;
    }
  }

}

?>
