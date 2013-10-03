<?php

/*
  Plugin Name: IndiaNIC FAQs Manager
  Plugin URI: http://wordpress.org/extend/plugins/faqs-manager/
  Description: Managing Frequently Asked Questions was Never So Easy.
  Author: IndiaNIC
  Version: 1.0
  Author URI: http://profiles.wordpress.org/indianic
 */

class iNIC_faq {

  var $pluginPath;
  var $wpdb;
  var $db_version = '1.0';

  public function __construct() {

    global $wpdb;
    $this->wpdb = $wpdb;
    $this->ds = DIRECTORY_SEPARATOR;
    $this->pluginPath = plugin_dir_path(__FILE__);
    $this->pluginUrl = plugin_dir_url(__FILE__);

    $this->init();
  }

  private function init() {
    add_action('admin_menu', array($this, 'register_admin_menu'));
    add_action('wp_ajax_inic_faq_settings', array($this, 'inic_faq_settings'));
    add_action('wp_ajax_inic_faq_groups', array($this, 'inic_faq_groups'));
    add_action('wp_ajax_inic_faq', array($this, 'inic_faq_groups'));
    add_action('wp_ajax_inic_faq_questions', array($this, 'inic_faq_questions'));
    add_action('wp_ajax_nopriv_inic_faq_questions', array($this, 'inic_faq_questions'));
    add_action('wp_ajax_inic_faq_order_question', array($this, 'inic_faq_order_question'));
    add_action('wp_ajax_inic_faq_settings_default', array($this, 'register_options'));

    add_shortcode('iNICfaq', array($this, 'shortcode'));
    add_action('admin_init', array($this, 'action_admin_init'));

    require_once $this->pluginPath . 'wp_list_table.php';

    add_action('wp_head', array($this, 'custom_css_js'));
  }

  function shortcode($atts) {

    $_html = false;
    
    if ($atts['id']) {
      $_current_group = $this->wpdb->get_results("SELECT * FROM {$this->wpdb->prefix}inic_faq_group WHERE id='{$atts['id']}' AND status='1'");

      if ($_current_group) {
        $_current_group = $_current_group[0];

        if (isset($atts['searchbox'])) {
          $_current_group->search_box = $atts['searchbox'];
        }

        if (isset($atts['askbox'])) {
          $_current_group->ask_box = $atts['askbox'];
        }

        $_template = stripslashes(get_option('inic_faq_listing_template'));

        $_searchbox_tpl = $_loop_tpl = $_askbox_tpl = false;

        if ($_current_group->search_box) {
          preg_match('#\[SearchBox](.+?)\[/SearchBox]#s', $_template, $_searchbox_tpl);
          if ($_searchbox_tpl[1])
            $_searchbox_tpl = $_searchbox_tpl[1];
        }

        if ($_current_group->ask_box) {
          preg_match('#\[AskBox](.+?)\[/AskBox]#s', $_template, $_askbox_tpl);
          if ($_askbox_tpl[1])
            $_askbox_tpl = $_askbox_tpl[1];
        }

        preg_match('#\[LOOP](.+?)\[/LOOP]#s', $_template, $_loop_tpl);
        if ($_loop_tpl[1])
          $_loop_tpl = $_loop_tpl[1];


        $_keyword = $_where = false;
        if (isset($_POST['iNICfaqsButton']) && $_POST['iNICfaqsButton']) {
          $_keyword = $_POST['iNICfaqsS'];

          $_where = " AND (question LIKE '%" . mysql_real_escape_string($_keyword) . "%' OR answer LIKE '%" . mysql_real_escape_string($_keyword) . "%')";
        }
        $_question = $this->wpdb->get_results("SELECT * FROM {$this->wpdb->prefix}inic_faq_question WHERE group_id='{$atts['id']}' AND status='1' AND answer != ''{$_where} ORDER BY ord_by ASC");

        if ($_question) {

          $_html .= "<div id=\"iNICfaqs_{$atts['id']}\">";

          if ($_searchbox_tpl) {
            $_html .= "<form name=\"iNICfaqsSearchForm\" method=\"POST\" action=\"\">";
            $_search = array("{#SearchBoxInput}", "{#SearchBoxButton}");
            $_replace = array('<input name="iNICfaqsS" id="iNICfaqsS" class="iNICfaqs" value="' . $_keyword . '" />', '<input type="submit" name="iNICfaqsButton" id="iNICfaqsButton" value="Search" />');
            $_html .= str_replace($_search, $_replace, $_searchbox_tpl);
            $_html .= "</form>";
          }


          $_html .= "<div id=\"iNICfaqs_questions\">";
          foreach ($_question as $_question) {
            $_search = array("{#ID}", "{#Question}", "{#Answer}");
            $_replace = array($_question->id, stripslashes($_question->question), stripslashes($_question->answer));
            $_html .= str_replace($_search, $_replace, $_loop_tpl);
          }
          $_html .= "</div>";

          if ($_askbox_tpl) {
            $_captcha_code = rand("1111", "9999");
            $_search = array("{#AskBoxEmailInput}", "{#AskBoxQuestionInput}", "{#AskBoxCaptchaImage}", "{#AskBoxCaptchaInput}", "{#AskBoxSubmitButton}", "{#AskBoxValidationMessage}");
            $_replace = array('<input type="text" name="who_asked" id="who_asked" value="" />', '<input type="text" name="question" id="question" value="" />', "<img src=\"{$this->pluginUrl}captcha.php?code={$_captcha_code}\" style=\"vertical-align:middle;\" />", '<input type="text" name="captcha_code" id="captcha_code" value="" />', '<input type="submit" name="faq_submit" value="Ask Question" id="faq_submit" />', '<div id="validation"></div>');

            $_html .= "<form name=\"iNICfaqsAskForm_{$atts['id']}\" method=\"POST\" action=\"\">";
            $_html .= "<input type=\"hidden\" name=\"group_id\" value=\"{$atts['id']}\" />";
            $_html .= "<input type=\"hidden\" name=\"from_user\" value=\"1\" />";
            $_html .= "<input type=\"hidden\" name=\"action\" value=\"inic_faq_questions\" />";
            $_html .= "<input type=\"hidden\" name=\"captcha\" value=\"{$_captcha_code}\" />";
            $_html .= str_replace($_search, $_replace, $_askbox_tpl);
            $_html .= "</form>";

            $_html .= "<script>
              jQuery('form[name=iNICfaqsAskForm_{$atts['id']}]').submit(function(e){
               jQuery('form[name=iNICfaqsAskForm_{$atts['id']}] #faq_submit').attr('disabled','disabled');
               jQuery.post('".get_site_url()."/wp-admin/admin-ajax.php', jQuery(this).serialize(), function(data){
                  if(data.error) {
                    jQuery('form[name=iNICfaqsAskForm_{$atts['id']}] #validation').addClass('error').removeClass('success').html(data.error);
                  } else if(data.success) {
                    jQuery('form[name=iNICfaqsAskForm_{$atts['id']}] #validation').addClass('success').removeClass('error').html(data.success);
                    jQuery('form[name=iNICfaqsAskForm_{$atts['id']}]')[0].reset();
                  }
                  jQuery('form[name=iNICfaqsAskForm_{$atts['id']}] #faq_submit').removeAttr('disabled');
               }, 'json');
                e.preventDefault();
              });
            </script>";
          }

          $_html .= "</div>";
        }
      }
    }
    return $_html;
  }

  function action_admin_init() {
    add_filter('mce_buttons', array($this, 'filter_faqs_button'));
    add_filter('mce_external_plugins', array($this, 'filter_faqs_plugin'));
  }

  function filter_faqs_button($buttons) {
    array_push($buttons, '|', 'iNICfaqs_button');
    return $buttons;
  }

  function filter_faqs_plugin($plugins) {
    $plugins['inicfaqs'] = plugin_dir_url(__FILE__) . 'plugin_js.php';
    return $plugins;
  }

  function register_admin_menu() {

    add_menu_page('iNIC FAQs', 'iNIC FAQs', 'administrator', "inic_faq", array($this, 'inic_faq_groups'), $this->pluginUrl . "/icon.png");
    add_submenu_page("inic_faq", "Groups", "Groups", 'administrator', "inic_faq", array($this, 'inic_faq_groups'));
    add_submenu_page("inic_faq", "Questions", "Questions", 'administrator', "inic_faq_questions", array($this, 'inic_faq_questions'));
    add_submenu_page("inic_faq", "Settings", "Settings", 'administrator', "inic_faq_settings", array($this, 'inic_faq_settings'));
  }

  function inic_faq_groups() {
    if (isset($_POST['action']) && $_POST['action'] == 'inic_faq_groups') {
      if ($_POST['group_name']) {
        $_data = array(
            "group_name" => $_POST['group_name'],
            "search_box" => $_POST['search_box'],
            "ask_box" => $_POST['ask_box'],
            "status" => $_POST['status']
        );

        if (isset($_POST['id']) && $_POST['id'] && is_numeric($_POST['id'])) {
          $this->wpdb->update("{$this->wpdb->prefix}inic_faq_group", $_data, array('id' => $_POST['id']));
        } else {
          $this->wpdb->insert("{$this->wpdb->prefix}inic_faq_group", $_data);
          $_message['id'] = $this->wpdb->insert_id;
        }

        if (mysql_error()) {
          $_message['error'] = mysql_error();
        } else {
          $_message['success'] = "Group has been saved successfully.";
        }
      } else {
        $_message['error'] = "Group name must be required.";
      }
      echo json_encode($_message);
      die();
    } else if (isset($_GET['type']) && $_GET['type'] == 'add') {
      require($this->pluginPath . "groups_add.php");
    } else if (isset($_GET['type']) && $_GET['type'] == 'order_question') {
      require($this->pluginPath . "order_question.php");
    } else {
      require($this->pluginPath . "groups.php");
    }
  }

  function inic_faq_questions() {
    if (isset($_POST['action']) && $_POST['action'] == 'inic_faq_questions') {

      $_data = array(
          "group_id" => $_POST['group_id'],
          "question" => stripslashes($_POST['question']),
          "who_asked" => $_POST['who_asked'],
          "answer" => stripslashes($_POST['answer']),
          "status" => $_POST['status']
      );

      if (!$_POST['question']) {
        $_message['error'] = "Question must be reuired.";
        echo json_encode($_message);
        die();
      }

      if (isset($_POST['who_asked']) && get_option('inic_faq_capture_email') && isset($_POST['from_user'])) {
        if (!$this->isValidEmail($_POST['who_asked'])) {
          $_message['error'] = "Please enter a valid email address.";
          echo json_encode($_message);
          die();
        }
      }

      if (isset($_POST['captcha_code']) && isset($_POST['captcha']) && isset($_POST['from_user'])) {
        if ($_POST['captcha_code'] != $_POST['captcha']) {
          $_message['error'] = "Please enter a correct captcha.";
          echo json_encode($_message);
          die();
        }
      }

      if (isset($_POST['id']) && $_POST['id'] && is_numeric($_POST['id'])) {
        $this->wpdb->update("{$this->wpdb->prefix}inic_faq_question", $_data, array('id' => $_POST['id']));

        if (get_option('inic_faq_notify_when_answered') && $_POST['status'] == 1 && $_POST['answer'] && $this->wpdb->rows_affected > 0) {
          @mail($_POST['who_asked'], nl2br(stripslashes($_POST['question'])), nl2br(stripslashes($_POST['answer'])), "From: " . get_option('blogname') . "\r\nContent-type: text/html\r\n");
        }
      } else {
        $this->wpdb->insert("{$this->wpdb->prefix}inic_faq_question", $_data);
        $_message['id'] = $this->wpdb->insert_id;

        if (get_option('inic_faq_alert_email_address') && $this->wpdb->insert_id > 0 && isset($_POST['from_user'])) {
          @mail(get_option('inic_faq_alert_email_address'), "Some one asked question to you.", nl2br(stripslashes($_POST['question'])), "From: {$_POST['who_asked']}\r\nContent-type: text/html\r\n");
        }
      }

      if (mysql_error()) {
        $_message['error'] = mysql_error();
      } else {
        $_message['success'] = "Question has been saved successfully.";
      }


      echo json_encode($_message);
      die();
    } else if (isset($_GET['type']) && $_GET['type'] == 'add') {
      require($this->pluginPath . "questions_add.php");
    } else {
      require($this->pluginPath . "questions.php");
    }
  }

  function inic_faq_order_question() {
    if (isset($_POST['action']) && $_POST['action'] == 'inic_faq_order_question') {

      if (!empty($_POST['sort'])) {
        foreach ($_POST['sort'] as $k => $v) {
          $this->wpdb->update("{$this->wpdb->prefix}inic_faq_question", array('ord_by' => $k), array('id' => $v));
        }
      }

      die();
    }
  }

  function inic_faq_settings() {
    if (isset($_POST['action']) && $_POST['action'] == 'inic_faq_settings') {

      update_option("inic_faq_alert_email_address", $_POST['alert_email_address']);
      update_option("inic_faq_capture_email", $_POST['capture_email']);
      update_option("inic_faq_notify_when_answered", $_POST['notify_when_answered']);
      update_option("inic_faq_captcha", $_POST['captcha']);
      update_option("inic_faq_custom_css", $_POST['custom_css']);
      update_option("inic_faq_custom_js", $_POST['custom_js']);
      update_option("inic_faq_listing_template", $_POST['listing_template']);

      echo "Setting has been saved successfully.";

      die();
    } else {
      require($this->pluginPath . "settings.php");
    }
  }

  function custom_css_js() {
    $_css = get_option('inic_faq_custom_css');
    if (!empty($_css)) {
      echo "\n<style type=\"text/css\">\n/* Plugin Author: IndiaNIC\nAuthor URL: http://www.indianic.com/ */\n\n" . stripslashes($_css) . "\n</style>";
    }

    $_js = get_option('inic_faq_custom_js');
    if (!empty($_js)) {
      echo "<script>if (typeof jQuery == 'undefined') {
          document.write(unescape('%3Cscript src=\"{$this->pluginUrl}jquery/jquery.min.js\"%3E%3C/script%3E'));
          }</script>\n
          <script type=\"text/javascript\" src=\"{$this->pluginUrl}jquery/jquery-ui.min.js\"></script>\n
          <link media=\"all\" type=\"text/css\" href=\"{$this->pluginUrl}jquery/jquery-ui.css\" rel=\"stylesheet\" />
          <script type=\"text/javascript\">\n/* Plugin Author: IndiaNIC\nAuthor URL: http://www.indianic.com/ */\n\n" . stripslashes($_js) . "\n</script>";
    }
  }

  function install() {

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta("CREATE TABLE {$this->wpdb->prefix}inic_faq_group (
    id int(11) NOT NULL AUTO_INCREMENT,
    group_name varchar(512) NOT NULL,
    search_box tinyint(1) NOT NULL DEFAULT 0,
    ask_box tinyint(1) NOT NULL DEFAULT 0,
    status tinyint(1) NOT NULL DEFAULT 1,
    date_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY group_name (group_name),
    KEY status (status))");

    dbDelta("CREATE TABLE {$this->wpdb->prefix}inic_faq_question (
    id int(11) NOT NULL AUTO_INCREMENT,
    group_id int(11) NOT NULL DEFAULT 0,
    ord_by int(11) NOT NULL DEFAULT 10,
    question varchar(1024) NOT NULL,
    who_asked varchar(512) NOT NULL,
    answer text NOT NULL,
    status tinyint(1) NOT NULL DEFAULT 1,
    date_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY group_id (group_id),
    KEY ord_by (ord_by),
    KEY status (status))");

    dbDelta("INSERT INTO {$this->wpdb->prefix}inic_faq_group (id, group_name, search_box, ask_box, status) VALUES('1', 'General','1','1','1')");

    update_option("indianic_faq_db_version", $this->db_version);
    $this->register_options(true);
  }

  function register_options($_if_not_exist = false) {

    $_default_option = array(
        'inic_faq_alert_email_address' => get_option("admin_email"),
        'inic_faq_capture_email' => '1',
        'inic_faq_notify_when_answered' => '1',
        'inic_faq_custom_js' => '$(document).ready(function() {
    $("#iNICfaqs_questions").accordion({header: ".accordion_header", autoHeight: false,navigation: true,collapsible: true});
  });',
        'inic_faq_custom_css' => '#iNICfaqs_questions {font-size:12px;}
#faqs_ask_box {background: #DDD; border: 1px solid #CCC;  border-radius: 3px;  padding: 15px 1.625em 35px 1.625em; margin-top:20px;}
#faqs_ask_box_title {color: #373737; font-size: 24px; font-weight: bold; line-height: 30px;}
p.faq-form-field {position: relative; font-size: 12px; margin: 0px;}
p.faq-form-field .required {color: #BD3500; font-size: 22px; font-weight: bold; left: 90%; position: absolute; top: 54px; z-index: 1;}
p.faq-form-field label {line-height: 2.2em; background: #EEE; -webkit-box-shadow: 1px 2px 2px rgba(204, 204, 204, 0.8); -moz-box-shadow: 1px 2px 2px rgba(204,204,204,0.8); box-shadow: 1px 2px 2px rgba(204, 204, 204, 0.8); color: #555; display: inline-block; font-size: 13px; left: 4px; min-width: 100px; padding: 4px 10px; position: relative; top: 40px; z-index: 1;}
p.faq-form-field input[type="text"] {display: block; height: 24px; width: 90%;}
p.faq-form-field input[type="text"], p.faq-form-field textarea {background: white; border: 4px solid #EEE; -moz-border-radius: 5px; border-radius: 5px; -webkit-box-shadow: inset 0 1px 3px rgba(204, 204, 204, 0.95); -moz-box-shadow: inset 0 1px 3px rgba(204,204,204,0.95); box-shadow: inset 0 1px 3px rgba(204, 204, 204, 0.95); position: relative; padding: 10px; text-indent: 120px;}
p.faq-form-field input[type="text"]:focus, p.faq-form-field textarea:focus {text-indent: 0; z-index: 1;}
p.faq-form-submit {float: right;}
p.faq-form-submit input[type=submit] {background: #222; border: none; -moz-border-radius: 3px; border-radius: 3px; -webkit-box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3); -moz-box-shadow: 0px 1px 2px rgba(0,0,0,0.3); box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.3); color: #EEE !important; cursor: pointer; font-size: 15px; margin: 20px 0; padding: 5px 42px 5px 22px; position: relative; left: 30px; text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.3);}
#faqs_search_box {background:#DDD; border: 1px solid #CCC; border-radius: 3px; padding: 15px; margin-bottom:15px;}
#faqs_search_box input[name=iNICfaqsS] {width:50%;}
#faqs_search_box input {margin:0px;}
#iNICfaqs #validation.error {color:red;}
#iNICfaqs #validation.success {color:green;}',
        'inic_faq_listing_template' => '[SearchBox]
<div id="faqs_search_box"><label>Keyword   </label>{#SearchBoxInput}{#SearchBoxButton}</div>
[/SearchBox]

[LOOP]
<div class="accordion_header"><a href="#">{#Question}</a></div>
<div>{#Answer}</div>
[/LOOP]

[AskBox]
<div id="faqs_ask_box">
<div id="faqs_ask_box_title">Ask Question</div>
<p style="font-size:11px; margin-bottom: 0px;">Your email address will not be published. Required fields are marked <span class="required">*</span></p>
{#AskBoxValidationMessage}
<p class="faq-form-field"><label for="who_asked">Email</label><span class="required">*</span>{#AskBoxEmailInput}</p>
<p class="faq-form-field"><label for="question">Question</label><span class="required">*</span>{#AskBoxQuestionInput}</p>
<p class="faq-form-field"><label for="captcha_code">{#AskBoxCaptchaImage}</label><span class="required">*</span>{#AskBoxCaptchaInput}</p>
<p class="faq-form-submit">{#AskBoxSubmitButton}</p></div>
[/AskBox]');

    if ($_if_not_exist == true) {
      foreach ($_default_option as $_name => $_value) {
        if (!get_option($_name)) {
          update_option($_name, $_value);
        }
      }
    } else {
      foreach ($_default_option as $_name => $_value) {
        update_option($_name, $_value);
      }
    }
  }

  function isValidEmail($email = false, $checkDNS = true) {

    if ($email == false) {
      return false;
    }

    $valid = (function_exists('filter_var') and filter_var($email, FILTER_VALIDATE_EMAIL)) || (
            strlen($email) <= 320 and preg_match_all(
                    '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?))' .
                    '{255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?))' .
                    '{65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|' .
                    '(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))' .
                    '(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|' .
                    '(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|' .
                    '(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})' .
                    '(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126})' . '{1,}' .
                    '(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|' .
                    '(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|' .
                    '(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::' .
                    '(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|' .
                    '(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|' .
                    '(?:(?!(?:.*[a-f0-9]:){5,})' . '(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::' .
                    '(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|' .
                    '(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|' .
                    '(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD', $email)
            );

    if ($valid) {
      if ($checkDNS && ($domain = end(explode('@', $email, 2)))) {
        return checkdnsrr($domain . '.', 'MX');
      }
      return true;
    }
    return false;
  }

}

$indianic_faq = new iNIC_faq();
register_activation_hook(__FILE__, array($indianic_faq, 'install'));
if (get_option("indianic_faq_db_version") != $indianic_faq->db_version) {
  $indianic_faq->install();
}

require_once 'widget.php';
add_action('widgets_init', create_function('', 'register_widget( "iNIC_FAQsWidget" );'));
?>
