<?php 
	require_once('../../../wp-load.php');
	require_once('../../../wp-admin/includes/admin.php');
	do_action('admin_init');
 
	if ( ! is_user_logged_in() )
		die('You must be logged in to access this script.');
 
	if(!isset($indianic_faq))
		$indianic_faq = new iNIC_faq();
    
    $_group_list_options = false;
    $_group_list = $indianic_faq->wpdb->get_results("SELECT g.*, COUNT(q.id) AS question FROM {$indianic_faq->wpdb->prefix}inic_faq_group g LEFT JOIN {$indianic_faq->wpdb->prefix}inic_faq_question q ON (g.id = q.group_id) GROUP BY g.id");
    if($_group_list) {
      foreach($_group_list as $_group_list) {
        $_group_list->status = $_group_list->status ? "Active" : "Inactive";
        $_group_list_options .= "<option value=\"{$_group_list->id}\">{$_group_list->group_name} ( {$_group_list->status} ) ( {$_group_list->question} Questions )</option>";
      }
    }
    global $indianic_faq;
?>
(function(){
	tinymce.create('tinymce.plugins.inicfaqs', {
		createControl : function(id, controlManager) {
			if (id == 'iNICfaqs_button') {
				var button = controlManager.createButton('iNICfaqs_button', {
					title : 'Faqs Shortcode', // title of the button
					image : '<?php echo $indianic_faq->pluginUrl; ?>icon_shortcode.png',  // path to the button's image
					onclick : function() {
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'IndiaNIC FAQs Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=inicfaqs-form' );
					}
				});
				return button;
			}
			return null;
		}
	});

	tinymce.PluginManager.add('inicfaqs', tinymce.plugins.inicfaqs);
	
	jQuery(function(){
		var form = jQuery('<div id="inicfaqs-form"><table id="inicfaqs-table" class="form-table">\
			<tr>\
				<th><label for="faqs_group">FAQs Group</label></th>\
				<td><select name="faqs_group" name="faqs_group"><?php echo $_group_list_options; ?></select><br /></td>\
			</tr>\
			<tr>\
				<th><label for="faqs_search_box">Show Search Box</label></th>\
                <td><select name="faqs_search_box"><option value="default">As per Group</option><option value="1">Yes</option><option value="0">No</option></select><br />\
				<small>place a search box above the group questions on the front-end</small>\
			</tr>\
			<tr>\
				<th><label for="faqs_ask_box">Show Ask Box</label></th>\
                <td><select name="faqs_ask_box"><option value="default">As per Group</option><option value="1">Yes</option><option value="0">No</option></select><br />\
				<small>place a submission box below the group questions for users to ask question</small>\
			</tr>\
		</table>\
		<p class="submit">\
			<a href="javascript:void(0)" id="inicfaqs-shortcode-submit" class="button-secondary"><strong>Insert FAQs Shortcode</strong></a>\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
        
		form.find('#inicfaqs-shortcode-submit').click(function(e){
			
			var shortcode = '[iNICfaq';
            shortcode += ' id='+table.find('select[name=faqs_group] option:selected').attr('value');
            
            var search_box_val = table.find('select[name=faqs_search_box] option:selected').attr('value');
            if(search_box_val != 'default') {
              shortcode += ' searchbox='+search_box_val;
            }
            
            var ask_box_val = table.find('select[name=faqs_ask_box] option:selected').attr('value');
            if(ask_box_val != 'default') {
              shortcode += ' askbox='+ask_box_val;
            }
			
			shortcode += ']';
            
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			tb_remove();
		});
	});
})()