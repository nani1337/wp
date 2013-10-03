<?php

class iNIC_FAQsWidget extends WP_Widget {

  var $wpdb = false;

  public function __construct() {
    parent::__construct('iNIC_faqs_widget', 'IndiaNIC FAQs Widget', array('description' => __('Use this widget to Display FAQs Groups.', 'text_domain')));

    global $wpdb;
    $this->wpdb = $wpdb;
  }

  public function form($instance) {

    if (isset($instance['title'])) {
      $title = $instance['title'];
    } else {
      $title = __('Title', 'text_domain');
    }

    $_field_id = $this->get_field_id('title');
    $_field_name = $this->get_field_name('title');
    echo <<<HTML
<p>
  <label for="{$_field_id}">Title:</label> 
  <input class="widefat" id="{$_field_id}" name="{$_field_name}" type="text" value="{$title}" />
</p>
HTML;
  }

  public function update($new_instance, $old_instance) {
    /* $instance = array();
      $instance['title'] = strip_tags($new_instance['title']);
     */
    return $new_instance;
  }

  public function widget($args, $instance) {

    extract($args);

    $_faq_groups = array();
    $_faq_groups_data = $this->wpdb->get_results("SELECT id, group_name FROM {$this->wpdb->prefix}inic_faq_group WHERE status='1'", ARRAY_A);
    if ($_faq_groups_data) {
      $i = 0;
      foreach ($_faq_groups_data as $_faq_groups_data) {
        $_post_for_shortcode = $this->wpdb->get_results("SELECT post_title, ID FROM {$this->wpdb->prefix}posts WHERE post_status='publish' AND post_content LIKE '%[INICfaq id={$_faq_groups_data['id']}%'", ARRAY_A);
        if ($_post_for_shortcode) {
          $_faq_groups[$i]['url'] = get_permalink($_post_for_shortcode[0]['ID']);
          foreach ($_faq_groups_data as $k => $v) {
            $_faq_groups[$i][$k] = $v;
          }
          ++$i;
        }
      }
    }

    if (!empty($_faq_groups)) {
      $title = apply_filters('widget_title', $instance['title']);

      echo $before_widget;
      if (!empty($title))
        echo $before_title . $title . $after_title;

      echo "<ul>";
      foreach($_faq_groups as $_faq_groups) {
        echo "<li><a href=\"{$_faq_groups['url']}\">{$_faq_groups['group_name']}</a></li>";
      }
      echo "</ul>";

      echo $after_widget;
    }
  }

}
?>
