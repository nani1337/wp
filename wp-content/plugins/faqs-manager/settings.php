<?php

function _set_default_add_inic_faqs_quicktags($qtInit) {
  $qtInit['buttons'] = 'strong,ul,ol,li,link,code,close';

  return $qtInit;
}

add_filter('quicktags_settings', '_set_default_add_inic_faqs_quicktags', 10, 1);

function _add_inic_faqs_quicktags() {
  echo '<script type="text/javascript">';
  echo "QTags.addButton( 'inic_faqs_id', '{#ID}', '{#ID}' );";
  echo "QTags.addButton( 'inic_faqs_question', '{#Question}', '{#Question}' );";
  echo "QTags.addButton( 'inic_faqs_answer', '{#Answer}', '{#Answer}' );";

  echo "QTags.addButton( 'inic_faqs_loop', '[LOOP]', '[LOOP]', '[/LOOP]');";
  echo "QTags.addButton( 'inic_faqs_search_box', '[SearchBox]', '[SearchBox]', '[/SearchBox]');";
  echo "QTags.addButton( 'inic_faqs_ask_box', '[AskBox]', '[AskBox]', '[/AskBox]');";

  echo "QTags.addButton( 'inic_faqs_search_box_input', '{#SearchBoxInput}', '{#SearchBoxInput}' );";
  echo "QTags.addButton( 'inic_faqs_search_box_btn', '{#SearchBoxButton}', '{#SearchBoxButton}' );";

  echo "QTags.addButton( 'inic_faqs_ask_box_email_input', '{#AskBoxEmailInput}', '{#AskBoxEmailInput}' );";
  echo "QTags.addButton( 'inic_faqs_ask_box_question_input', '{#AskBoxQuestionInput}', '{#AskBoxQuestionInput}' );";
  echo "QTags.addButton( 'inic_faqs_ask_box_captcha_input', '{#AskBoxCaptchaInput}', '{#AskBoxCaptchaInput}' );";
  echo "QTags.addButton( 'inic_faqs_ask_box_captcha_img', '{#AskBoxCaptchaImage}', '{#AskBoxCaptchaImage}' );";
  echo "QTags.addButton( 'inic_faqs_ask_box_submit_btn', '{#AskBoxSubmitButton}', '{#AskBoxSubmitButton}' );";
  echo "QTags.addButton( 'inic_faqs_ask_box_error', '{#AskBoxValidationMessage}', '{#AskBoxValidationMessage}' );";
  echo "</script>";
}

add_action('admin_print_footer_scripts', '_add_inic_faqs_quicktags');
?>

<div class="wrap">
  <div id="icon-options-general" class="icon32 icon32-posts-post"><br></div>
  <h2>Settings</h2>

  <div id="message" class="below-h2"></div>

  <form method="POST" action="" name="settings">
    <input type="hidden" name="action" value="inic_faq_settings" />
    <div class="metabox-holder">
      <div class="postbox">
        <h3><span>Ask Questions Settings</span></h3>
        <div class="inside">
          <table class="form-table">
            <tbody>
              <tr>
                <th>Get Notification Email</th>
                <td>
                  <input type="text" name="alert_email_address" value="<?php echo get_option("inic_faq_alert_email_address"); ?>" class="regular-text" />
                  <p class="description">get an email notification on above you provided email when the user has been asked question</p>
                </td>
              </tr>
              <tr>
                <th>Capture Email Address</th>
                <td>
                  <input type="radio" name="capture_email" value="1"<?php echo get_option("inic_faq_capture_email") ? ' checked="checked"' : ''; ?> /> Yes &nbsp; 
                  <input type="radio" name="capture_email" value="0"<?php echo get_option("inic_faq_capture_email") ? '' : ' checked="checked"'; ?> /> No
                  <p class="description">require an email address from a user when submitting a question</p>
                </td>
              </tr>
              <tr>
                <th>Notify when Answered</th>
                <td>
                  <input type="radio" name="notify_when_answered" value="1"<?php echo get_option("inic_faq_notify_when_answered") ? ' checked="checked"' : ''; ?> /> Yes &nbsp; 
                  <input type="radio" name="notify_when_answered" value="0"<?php echo get_option("inic_faq_notify_when_answered") ? '' : ' checked="checked"'; ?> /> No
                  <p class="description">send an email notification to the user when the question has been answered</p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="metabox-holder">
      <div class="postbox">
        <h3><span>Listing Template</span></h3>
        <div class="inside">
          <?php wp_editor(stripslashes(get_option('inic_faq_listing_template')), 'listing_template', array('media_buttons' => true, 'textarea_rows' => 15, 'tinymce' => false, 'class' => 'required')); ?>
        </div>
      </div>
    </div>

    <div class="metabox-holder">
      <div class="postbox">
        <h3><span>HTML Settings</span></h3>
        <div class="inside">
          <table class="form-table">
            <tbody>
              <tr>
                <th>Custom CSS</th>
                <td>
                  <textarea name="custom_css" rows="10" style="width: 100%;"><?php echo stripslashes(get_option('inic_faq_custom_css')); ?></textarea>
                </td>
              </tr>
              <tr>
                <th>Custom JS</th>
                <td>
                  <textarea name="custom_js" rows="10" style="width: 100%;"><?php echo stripslashes(get_option('inic_faq_custom_js')); ?></textarea>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <p class="submit">
      <img src="/wp-admin/images/wpspin_light.gif" style="vertical-align: middle;" class="ajax-loading" />
      <input type="submit" value="Save Settings" class="button-primary" name="submit" accesskey="s">
      <a href="javascript:void(0)" class="button-secondary" id="reset_settings">Reset All Settings</a>
    </p>

  </form>
</div>

<script>
  jQuery("form[name=settings]").submit(function(e){
    var _this = jQuery(this);    
    jQuery("img.ajax-loading").css('visibility', 'visible');
    _this.find("input[type=submit]").attr('disabled', 'disabled');    
    jQuery.post(ajaxurl, _this.serialize(), function(data) {
      jQuery("#message").addClass('updated').html("<p>"+data+"</p>");
      jQuery("img.ajax-loading").css('visibility', 'hidden');
      _this.find("input[type=submit]").removeAttr('disabled');
      jQuery("html, body").animate({ scrollTop: 0 }, 500);
    });    
    e.preventDefault();
  });
  
  jQuery("#reset_settings").click(function(e){
    var r = confirm("Are you sure want to reset settings?");
    if(r == true) {
      var _this = jQuery(this);    
      jQuery("img.ajax-loading").css('visibility', 'visible');  
      jQuery.post(ajaxurl, {action:'inic_faq_settings_default'}, function() {
        window.location.reload();
      });
    }    
    e.preventDefault();
  });
</script>