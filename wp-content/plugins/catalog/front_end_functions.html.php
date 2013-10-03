<?php 


function html_front_end_single_product($rows,$reviews_rows,  $params,$category_name,$rev_page,$reviews_count,$rating,$voted,$product_id,$ident){
   ob_start();
    global $ident;
?>
<div>
<?php if($params['enable_rating']): ?>
<style type="text/css">
.star-rating 					{ background: url(<?php echo plugins_url("Front_images",__FILE__).'/star'.$params['rating_star'].'.png'; ?>) top left repeat-x !important; margin-top:0px;}
.star-rating li a:hover			{ background: url(<?php echo plugins_url("Front_images",__FILE__).'/star'.$params['rating_star'].'.png'; ?>) left bottom !important; }
.star-rating li.current-rating 	{ background: url(<?php echo plugins_url("Front_images",__FILE__).'/star'.$params['rating_star'].'.png'; ?>) left center !important; }
.star-rating1 					{ background: url(<?php echo plugins_url("Front_images",__FILE__).'/star'.$params['rating_star'].'.png'; ?>) top left repeat-x !important;  margin-top:0px;}
.star-rating1 li.current-rating	{ background: url(<?php echo plugins_url("Front_images",__FILE__).'/star'.$params['rating_star'].'.png'; ?>) left center !important; }
</style>
<?php
endif;
if ($params['rounded_corners']):


?>
<style type="text/css">
select.spidercataloginput{
margin: 0 0 24px 0 !important;
top: -11px !important;
position: relative;
}

#productMainDiv
{
	-webkit-border-radius: 8px !important;
	-moz-border-radius: 8px !important;
	border-radius: 8px !important;
	
}
.spidercatalogbutton, .spidercataloginput
{
	font-size:11px !important;
	-webkit-border-radius: 8px !important;
	-moz-border-radius: 8px !important;
	border-radius: 8px !important;
	
}

#productMainDiv td, #productMainDiv tr, #productMainDiv tbody,  #productMainDiv div{
	line-height:inherit !important;
	background-color:inherit;
	color:inherit;
	opacity:inherit !important;
	
}
#productMainDiv{
	min-width:540px;
}
#productMainDiv #prodTitle
{
	font-size:10px;
-webkit-border-top-right-radius: 8px;
-webkit-border-top-left-radius: 8px;
-moz-border-radius-topright: 8px;
-moz-border-radius-topleft: 8px;
border-top-right-radius: 8px;
border-top-left-radius: 8px;
}

#spider_caltalog_top_table table, #spider_caltalog_top_table th,  #spider_caltalog_top_table tbody,  #spider_caltalog_top_table tr,  #spider_caltalog_top_table td , #spider_caltalog_top_table body {
	vertical-align:middle;
	line-height:inherit;
	font-weight:bold;
	text-align:left;


}
#spider_caltalog_top_table
{
	border-collapse:inherit;
	padding:inherit;
	margin:inherit;
	border:inherit !important;
}
#spider_caltalog_top_table ul, #spider_caltalog_top_table li, #spider_caltalog_top_table a{
	background-color:inherit;
	list-style:inherit;
}


#prodMiddle tr td, #prodMiddle td, #prodMiddle tr, #prodMiddle table, #prodMiddle table,#prodMiddle {
	border:0 !important;
}


#spider_catalog_informaton_teble ul, #spider_catalog_informaton_teble li{
	width:inherit !important;
	float:right;
	overflow-x:inherit !important;
	overflow-y:inherit !important;

	

}
#spider_catalog_informaton_teble, #spider_catalog_informaton_teble table,  #spider_catalog_informaton_teble tbody{
	width:inherit !important;
	float:right;
	border-collapse:inherit;


}
#spider_catalog_informaton_teble td{

	text-align:left;

}
#tdviewportheight div, #tdviewportheight td, #tdviewportheight{
	vertical-align:middle;



}
#spider_catalog_image_table{
	border-spacing:inherit;



}

#prodTitle{
	font-family:inherit;
}



input,
textarea {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-transition: all 0.2s linear;
  -webkit-transition-delay: 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
}






#productMainDiv textarea,
#productMainDiv input[type="text"]
 {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-background-clip: padding;
  -moz-background-clip: padding;
  background-clip: padding-box;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;




  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-appearance: none;
  background-color: white;
  border: 1px solid #cccccc;
  color: black;
  outline: 0;
  margin: 0;
  padding: 3px 4px;
  text-align: left !important;
  font-size: 13px;
  font-family: Arial, "Liberation Sans", FreeSans, sans-serif;
  height: 2.2em;
  vertical-align: top;
  *padding-top: 2px;
  *padding-bottom: 1px;
  *height: auto;
}
#productMainDiv textarea[disabled],
#productMainDiv input[type="text"][disabled]
{
  background-color: #eeeeee;
}
#productMainDiv textarea:focus,
#productMainDiv input[type="text"]:focus {
  border-color: rgba(82, 168, 236, 0.8);
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
}


#productMainDiv input[disabled],
#productMainDiv textarea[disabled] {
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  -moz-user-select: -moz-none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  user-select: none;
  color: #888888;
  cursor: default;
}

#productMainDiv input::-webkit-input-placeholder,
#productMainDiv textarea::-webkit-input-placeholder {
  color: #888888;
}

#productMainDiv input:-moz-placeholder,
#productMainDiv textarea:-moz-placeholder {
  color: #888888;
}

#productMainDiv input.placeholder_text,
#productMainDiv textarea.placeholder_text {
  color: #888888;
}




#productMainDiv textarea {
  min-height: 80px;
  overflow: auto;
  padding: 5px;
  resize: vertical;
  width: 100%;
}

#productMainDiv optgroup {
  color: black;
  font-style: normal;
  font-weight: normal;
  font-family: Arial, "Liberation Sans", FreeSans, sans-serif;
}
#productMainDiv optgroup::-moz-focus-inner {
  border: 0;
  padding: 0;
}
.rating_stars ul, .rating_stars li, .rating_stars ul li{
	list-style-type:none !important;
}
#spider_catalog_captcha_table span, #spider_catalog_captcha_table, #spider_catalog_captcha_table tr, #spider_catalog_captcha_table td, #spider_catalog_captcha_table img, #spider_catalog_captcha_table tr td{
	vertical-align:middle !important;
	padding:2px;
	border:0 !important;
}
#message_text{
	min-height:100px;
	max-width:inherit !important;
}
#full_name{
	max-width:inherit !important;
}


</style>
<?php
endif;
$posss = strrpos(get_permalink(), "?");
$frontpage_id = get_option('page_for_posts');
$rest = explode("&",$_SERVER['QUERY_STRING']);
$nnn=count($rest );
if($posss){
if( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_home() ){
      $page_link1=get_permalink($frontpage_id);
	  $ff='&'.$rest[$nnn-3].'&'.$rest[$nnn-2];
	 
   }
	   else if(is_home())
	   {
		   $page_link1=site_url().'/index.php';
		   if(isset($rest[$nnn-3]) && isset ($rest[$nnn-2]))
		   $ff='?'.$rest[$nnn-3].'&'.$rest[$nnn-2];
		   else  $ff='?';
		   
	   }
	   else
	   {
		   $page_link1=get_permalink();
		   $ff='&'.$rest[$nnn-3].'&'.$rest[$nnn-2];
		   
	   }
}else{
if( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_home() ){
      $page_link1=get_permalink($frontpage_id);
	  $ff='?'.$rest[$nnn-4].'&'.$rest[3];

   }
	   else if(is_home())
	   {
		   $page_link1=site_url().'/index.php';
		   $ff='?'.$rest[$nnn-3].'&'.$rest[$nnn-2];
		   
	   }
	   else
	   {
		   $page_link1=get_permalink();
		   $ff='?'.$rest[$nnn-3].'&'.$rest[$nnn-2];
		   
	   }
}     

if((isset($_GET['ident']) && $_GET['ident']== $ident) || !(isset($_GET['product_id']) && $_GET['product_id'])){
foreach($rows as $row)
{

if($_GET['product_id']== $row->id)
echo '<span id="back_to_spidercatalog_button"><a href="'.$page_link1.$ff.'" >'.__('Back to Catalog','sp_catalog').'</a></span>';

$widt_spider_cat_prod_page='';
if($params['spider_catalog_product_page_width']!='')
{
	$widt_spider_cat_prod_page="width:".$params['spider_catalog_product_page_width']."px !important; ";
}
echo '<div id="productMainDiv" style="'.$widt_spider_cat_prod_page.' border-width:'.$params['border_width'].'px;border-color:'.$params['border_color'].';border-style:'.$params['border_style'].';'.(($params['text_size_big']!='')?('font-size:'.$params['text_size_big'].'px;'):'').(($params['text_color']!='')?('color:'.$params['text_color'].';'):'').(($params['background_color']!='')?('background-color:'.$params['background_color'].';'):'').'">';



echo '<div id="prodTitle" style="'.(($params['title_color']!='')?('color:'.$params['title_color'].';'):'').(($params['title_background_color']!='')?('background-color:'.$params['title_background_color'].';'):'').'padding:0px;"><table id="spider_caltalog_top_table" border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td  style="padding:7px !important;font-size:'.$params['title_size_big'].'px;">' . stripslashes($row->name).'</td>';

if($params['enable_rating'])
{

echo '<td style="padding-right:10px;"><div style="overflow:hidden; vertical-align:top; height:25px;">
<div id="voting' . $row->id . '" class="rating_stars" style="width:130px; margin-left:auto;">';

if($voted==0)
		{
		if($rating==0)
			$title=__('Not rated Yet.','sp_catalog');
		else 
			$title=$rating;

			echo "
			<ul class='star-rating'>	
				<li class='current-rating' id='current-rating' style=\"width:".($rating*25)."px\"></li>
				<li><a href=\"#\" onclick=\"vote(1,".$row->id.",'voting".$row->id."','".__('Rated.','sp_catalog')."','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"		title='".$title."' class='one-star'>1</a></li>
				<li><a href=\"#\" onclick=\"vote(2,".$row->id.",'voting".$row->id."','".__('Rated.','sp_catalog')."','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"     title='".$title."' class='two-stars'>2</a></li>	
				<li><a href=\"#\" onclick=\"vote(3,".$row->id.",'voting".$row->id."','".__('Rated.','sp_catalog')."','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"      title='".$title."' class='three-stars'>3</a></li>
				<li><a href=\"#\" onclick=\"vote(4,".$row->id.",'voting".$row->id."','".__('Rated.','sp_catalog')."','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"     title='".$title."' class='four-stars'>4</a></li>
				<li><a href=\"#\" onclick=\"vote(5,".$row->id.",'voting".$row->id."','".__('Rated.','sp_catalog')."','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"		title='".$title."' class='five-stars'>5</a></li>
			</ul>";
		}
else
		{
		if($rating==0)
			$title=__('Not rated Yet.','sp_catalog');
		else 
			$title=__('Rating','sp_catalog').' '.$rating.'&nbsp;&nbsp;&nbsp;&nbsp;&#013;'.__('You have already rated this product.','sp_catalog');
			
			
			echo "
			<ul class='star-rating1'>	
			<li class='current-rating' id='current-rating' style=\"width:".($rating*25)."px\"></li>
			<li><a  title='".$title."' class='one-star'>1</a></li>
			<li><a  title='".$title."' class='two-stars'>2</a></li>
			<li><a title='".$title."' class='three-stars'>3</a></li>
			<li><a title='".$title."' class='four-stars'>4</a></li>
			<li><a title='".$title."' class='five-stars'>5</a></li>
			</ul>";
		}
		
echo '</div></div></td>';

}

echo '</tr></table></div>

<table id="prodMiddle" style="border:inherit !impotrtant" cellspacing="0" cellpadding="0"><tbody>
<tr>
<td valign="top" style="width:280px !important" >
<table id="spider_catalog_image_table" cellpadding="0" cellspacing="5" border="0" style="margin:0px;">';
$imgurl=explode(";;;",$row->image_url);
if(!($row->image_url!="" and $row->image_url!="******0"))
{
	$imgurl[0]=plugins_url("Front_images/noimage.jpg",__FILE__);

	echo '<tr><td colspan="2" id="prod_main_picture_container" valign="top"><div style="border: #CCCCCC solid 2px;padding:5px;background-color:white;width:'.($params['large_picture_width']).'px;height:'.($params['large_picture_height']).'px;"><div id="prod_main_picture_'.$ident.'" style="width:'.($params['large_picture_width']).'px;height:'.($params['large_picture_height']).'px; background:url('.$imgurl[0].') center no-repeat;background-size:contain;">&nbsp;</div></div></td></tr>';
}
else{
	$imgurl[0]=explode('******',$imgurl[0]);
	echo '<tr><td colspan="2" id="prod_main_picture_container" valign="top">
<div style="border: #CCCCCC solid 2px;padding:5px;background-color:white;width:'.($params['large_picture_width']).'px;">
<a href="'.$imgurl[0][0].'" target="_blank" id="prod_main_picture_a_'.$ident.'" style="text-decoration:none;">
<div id="prod_main_picture_'.$ident.'" style="width:'.($params['large_picture_width']).'px;height:'.($params['large_picture_height']).'px; background:url('.$imgurl[0][0].') center no-repeat;background-size:contain;">&nbsp;</div></a></div>
</td></tr>';
}
echo'
<tr><td style="text-align:justify;">';

$small_images_str='';
$small_images_count=0;
$imgurl=explode(";;;",$row->image_url);
foreach($imgurl as $img)
{
	
if($img!=='******0')
{
	
	$image_with_atach_id=explode('******',$img);
	if(isset($image_with_atach_id[1]) && $image_with_atach_id[1])
	{
	$array_with_sizes=wp_get_attachment_image_src( $image_with_atach_id[1], 'thumbnail' );
	$attach_url=$array_with_sizes[0];
	}
	else{
	$attach_url=$image_with_atach_id[0];
	}
	$img=$image_with_atach_id[0];
$small_images_str.='<a href="'.$img.'" target="_blank"><img style="max-width:50px;max-height:50px" src="'.$attach_url.'" vspace="0" hspace="0" onMouseOver="prod_change_picture(\''.$img.'\','.$ident.',this,'.$params['large_picture_width'].','.$params['large_picture_height'].');" /></a>
';
$small_images_count++;
}
}
if($small_images_count>1)
echo $small_images_str;
else
echo '&nbsp;';

echo '</td></tr>
</table></td>
<td valign="top" align="right">';

if ($params['price'] and $row->cost != 0 and $row->cost != '')
echo '<div id="prodCost" style="font-size:'.$params['price_size_big'].'px !important; color:'.$params['price_color'].' !important;margin:15px;">' .(($params['currency_symbol_position']==0)?($params['currency_symbol']):'').' '.$row->cost . ' ' .(($params['currency_symbol_position']==1)?$params['currency_symbol']:' ') . '</div>';


if( $params['market_price'] and $row->market_cost!=0 and $row->market_cost!='' )
echo '<div id="prodCost" style="font-size:'.($params['price_size_big']/1.7).'px !important; margin:15px;">'.__('Market Price:','sp_catalog').' <span style=" text-decoration:line-through;color:'.$params['price_color'].';"> ' .(($params['currency_symbol_position']==0)?($params['currency_symbol']):'').' '.$row->market_cost . ' ' .(($params['currency_symbol_position']==1)?$params['currency_symbol']:' ') . '</span></div>';

	echo '<div style="margin: 15px;"><table border="0" id="spider_catalog_informaton_teble" cellspacing="0" cellpadding="5" style="margin:10px;border-width:'.$params['border_width'].'px !important;border-color:'.$params['border_color'].';border-style:'.$params['border_style'].' !important ;'.(($params['review_background_color']!='')?('background-color:'.$params['review_background_color'].';'):'').'">';
$param_chan_color=0;
if($category_name!=""){
echo '<tr style="'.(($params['params_background_color1']!='')?('background-color:'.$params['params_background_color1'].';'):'').' vertical-align:middle;"><td><b>'.__('Category:','sp_catalog').'</b></td><td style="'.(($params['params_color']!='')?('color:'.$params['params_color'].';'):'').'"><span id="cat_' . $row->id . '">' .$category_name.'</span></td></tr>';
$param_chan_color++;
}
else
echo '<span id="cat_' . $row->id . '"></span>';

		
			



//--------------------------------------------------------------------------

$par_data=explode("par_",$row->param);

for($j=0;$j<count($par_data);$j++)
	if($par_data[$j]!='')
	{
		
		$par1_data=explode("@@:@@",$par_data[$j]);

		$par_values=explode("	",$par1_data[1]);

				$countOfPar=0;
					for($k=0;$k<count($par_values);$k++)
						if($par_values[$k]!="")
						$countOfPar++;
		$bgcolor=(($param_chan_color%2)?(($params['params_background_color2']!='')?('background-color:'.$params['params_background_color2'].';'):''):(($params['params_background_color1']!='')?('background-color:'.$params['params_background_color1'].';'):''));	


		if($countOfPar!=0)
		{
			
			$param_chan_color++;
		
                echo '<tr style="' . $bgcolor . 'text-align:left !important;"><td><b>' . stripslashes($par1_data[0]) . ':</b></td>';
                

                    echo '<td style="text-align:left !important;' . (($params['text_size_list'] != '') ? ('font-size:' . $params['text_size_list'] . 'px;') : '') . $bgcolor . (($params['params_color'] != '') ? ('color:' . $params['params_color'] . ';') : '') . 'width:' . $params['parameters_select_box_width'] . 'px;"><ul class="spidercatalogparamslist">';
                    
                    for ($k = 0; $k < count($par_values); $k++)
                        if ($par_values[$k] != "")
                            echo '<li>' . stripslashes($par_values[$k]) . '</li>';
                    
                    echo '</ul></td></tr>';

		}
	}	
//--------------------------------------------------------------------------



echo '</table></div>';

echo '</td></tr></tbody></table><br />';


echo '<div id="prodDescription">' . stripslashes($row->description ). '</div><br />
<br />';



if($params['enable_review'])
{

echo '<div><a name="rev" style="color:inherit;text-decoration:inherit;font-size:150%">'.__('Add your review here','sp_catalog').'</a></div>';


$pos=strpos($_SERVER['QUERY_STRING'], 'rev_page_'.$ident)-1;
$reviews_perpage=$params['reviews_perpage'];
if($pos>0)
$url=substr($_SERVER['QUERY_STRING'],0,$pos);
else
$url=$_SERVER['QUERY_STRING'];


	$poss = strrpos(get_permalink(), "?");
$part_of_url="";
if( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_home() ){
    if($poss)
    {
	  $part_of_url=get_permalink($frontpage_id);
    }
    else
    {
	  $part_of_url=get_permalink($frontpage_id)."?";
    }
}
else if(is_home()){ 
	  $pos1=strrpos(site_url().'/index.php', "?");
	  if($pos1)
      {
	     $part_of_url=site_url().'/index.php';
      }
      else
      {
    	$part_of_url=site_url().'/index.php'."?";
      }
}
else{
      if($poss)
      {
    	$part_of_url=get_permalink();
      }
      else
      {
    	$part_of_url=get_permalink()."?";
      }
}

echo '
<div style="margin:3px; padding:10px; border-width:'.$params['border_width'].'px;border-color:'.$params['border_color'].';border-style:'.$params['border_style'].';'.(($params['review_background_color']!='')?('background-color:'.$params['review_background_color'].';'):'').'">

<form  action="'.$part_of_url.''.$url.'#rev"  name="review_'.$ident.'" method="post" >

				<div style="font-weight:bold;">'.__('Name','sp_catalog').'</div>

				<div style="margin: 0 15px 0 0;"><input type="text" name="full_name_'.$ident.'" id="full_name_'.$ident.'" style="width:100%; margin:0px;" /></div>
<br />
<br />

				<div style="font-weight:bold;">'.__('Message:','sp_catalog').'</div>
				<div style="margin: 0 15px 0 0;"><textarea rows="4" 
				name="message_text_'.$ident.'" id="message_text_'.$ident.'" style="width:100%; margin:0px;"></textarea></div>

	<input type="hidden" name="product_id" value="'.$row->id.'" />
	
	
	<input type="hidden" name="review_'.$ident.'" value="1" />';

	?><br />
<br />

    <table cellpadding="0" id="spider_catalog_captcha_table" cellspacing="10" border="0" valign="middle" width="100%"> <tr><td>
    <?php echo __('Please enter the code:','sp_catalog') ?>
    </td><td style="max-width:100px !important;">
   <span id="wd_captcha"><img style="width:80px" src="<?php echo  admin_url('admin-ajax.php?action=spidercatalogwdcaptchae') ?>" id="wd_captcha_img_<?php echo $ident; ?>" height="24" width="80" /></span><a href="javascript:refreshCaptcha(<?php echo $ident; ?>);" style="text-decoration:none">&nbsp;<img src="<?php echo plugins_url("",__FILE__) ?>/Front_images/refresh.png" border="0" style="border:none" /></a>&nbsp;</td><td><input type="text" name="code_<?php echo $ident; ?>" id="review_capcode_<?php echo $ident; ?>" size="6" /><span style="display:none;" id="caphid_<?php echo $ident; ?>"></span>
   </td>
   <td style="text-align:right !important;" align="right">   <input type="button" class="spidercatalogbutton" style="<?php echo 'background:'.$params['button_background_color'].'; color:'.$params['button_color' ] ?>; width:inherit;margin-right:10px;" value="<?php echo __('Send','sp_catalog') ?>" onclick='prod_id=<?php echo $ident; ?>; submit_reveiw("<?php echo __('The Name field is required.','sp_catalog'); ?>","<?php echo __('The Message field is required.','sp_catalog'); ?>","<?php echo __('Sorry, the code you entered was invalid.','sp_catalog'); ?>");' />
   </td>
	</tr></table>

	</form>
	</div>	

 <?php
//    $session =& JFactory::getSession();
	
  
  
  if(isset($_POST['code_'.$ident]))
   $code=$_POST['code_'.$ident];
   else
   $code='';
   if(isset($_POST['review_'.$ident]))
   $review=$_POST['review_'.$ident];
   else
   $review='';
   

   if($review)
  	if($code!='' and $code==$_SESSION['captcha_code']   )
   		{
    	echo '<br /><center style="font-weight:bold">'.__('The review has been added successfully.','sp_catalog').'</center><br />';
  		} 
  	else
   		{   
     	echo '<br /><center style="font-weight:bold">'.__('Sorry, the code you entered was invalid.','sp_catalog').'</center><br />';
  		}

	$pos = strrpos(get_permalink(), "?");

$permalink_for_sp_cat="";
if( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_home() ){
    if($pos)
    {
	  $permalink_for_sp_cat=get_permalink($frontpage_id);
    }
    else
    {
	  $permalink_for_sp_cat=get_permalink($frontpage_id)."?s_p_c_t=1342";
    }
}
else if(is_home()){ 
	  $pos1=strrpos(site_url().'/index.php', "?");
	  if($pos1)
      {
	     $permalink_for_sp_cat=site_url().'/index.php';
      }
      else
      {
    	$permalink_for_sp_cat=site_url().'/index.php'."?s_p_c_t=1342";
      }
}
else{
      if($pos)
      {
    	$permalink_for_sp_cat=get_permalink();
      }
      else
      {
    	$permalink_for_sp_cat=get_permalink()."?s_p_c_t=1342";
      }
}
	 foreach($reviews_rows as $reviews_row)
 	{
	echo '<br /><br />
	<div style="padding:3px;'.(($params['review_author_background_color']!='')?('background-color:'.$params['review_author_background_color'].';'):'').'">'.__('Author:','sp_catalog').' <b>'.$reviews_row->name.'</b></div>

	 <div style="'.(($params['review_text_background_color']!='')?('background-color:'.$params['review_text_background_color'].';'):'').(($params['review_color']!='')?('color:'.$params['review_color'].';'):'').' padding:8px;">'.str_replace('
','<br>', stripslashes($reviews_row->content)).'</div>
	 ';
	}
	
	
	
	if($reviews_count>$reviews_perpage)
	{
 ?>
<div id="spidercatalognavigation" style="text-align:center;">
    <?php
	
	
	$r=ceil($reviews_count/$reviews_perpage);
	
 $navstyle = (($params['text_size_small'] != '') ? ('font-size:' . $params['text_size_small'] . 'px !important;') : 'font-size:12px !important;') . (($params['text_color'] != '') ? ('color:' . $params['text_color'] . ' !important;') : '');







?>
<script>
function submit_catal(page_link)
{
	if(document.getElementById('cat_form_page_nav')){
	document.getElementById('cat_form_page_nav').setAttribute('action',page_link);
	document.getElementById('cat_form_page_nav').submit();
	}
	else
	{
		window.location.href=page_link;
	}
}

</script>
<?php 


$link = ($permalink_for_sp_cat .$url . '&rev_page_'.$ident.'= ');
	if($rev_page>5){
	$link = ($permalink_for_sp_cat.$url . '&rev_page_'.$ident.'=1#rev');
echo "
&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">first</a>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;...&nbsp";
}
	
	 if($rev_page>1)
		{
			$link = ($permalink_for_sp_cat. $url . '&rev_page_'.$ident.'='.($rev_page-1).'#rev');
			echo "&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">prev</a>&nbsp;&nbsp;";
		}
	
	for ($i=$rev_page-4; $i<($rev_page+5); $i++)
	{
		 if($i<=$r and $i>=1)
		 {
			$link = ($permalink_for_sp_cat. $url . '&rev_page_'.$ident.'='.$i.'#rev');
			if($i==$rev_page)
				echo "<span style='font-weight:bold !important; color:#000000 !important; ".(($params['text_size_small'] != '') ? ('font-size:' . $params['text_size_small'] . 'px !important;') : 'font-size:12px !important;')."'>&nbsp;$i&nbsp;</span>";
			else
				echo "<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">&nbsp;$i&nbsp;</a>";
		 }
	 }
	 
	 
	if($rev_page<$r)
		{
			$link = ($permalink_for_sp_cat. $url . '&rev_page_'.$ident.'='.($rev_page+1).'#rev');
			echo "&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">next</a>&nbsp;&nbsp;";
		}
if(($r-$rev_page)>4)
{
$link = ($permalink_for_sp_cat.$url . '&rev_page_'.$ident.'='.$r.'#rev');
echo "&nbsp;...&nbsp;&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">last</a>";
}

	echo '</div>';
	}
	}
	echo '</div>';
}
}
?>
	</div><br /><br />
	<script type="text/javascript">
var SpiderCatOFOnLoad = window.onload;
window.onload = SpiderCatAddToOnload;
</script>
<?php 
 $ident++;
$content=ob_get_contents();
                ob_end_clean();
                return $content;
}






















































































function front_end_catalog_list($rows,$params,$page_num,$prod_count,$prod_in_page,$ratings,$voted,$categories,$category_list,$params1,$cat_rows,$cat_id,$child_ids,$params7,$categor,$par,$cels_or_list,$ident)
{

  
   ob_start();
   $frontpage_id = get_option('page_for_posts');
 global $ident;
$pos = strrpos(get_permalink(), "?");
$permalink_for_sp_cat="";
if( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_home() ){
    if($pos)
    {
	  $permalink_for_sp_cat=get_permalink($frontpage_id);
    }
    else
    {
	  $permalink_for_sp_cat=get_permalink($frontpage_id)."?s_p_c_t=1342";
    }
}
else if(is_home()){ 
	  $pos1=strrpos(site_url().'/index.php', "?");
	  if($pos1)
      {
	     $permalink_for_sp_cat=site_url().'/index.php';
      }
      else
      {
    	$permalink_for_sp_cat=site_url().'/index.php'."?s_p_c_t=1342";
      }
}
else{
      if($pos)
      {
    	$permalink_for_sp_cat=get_permalink();
      }
      else
      {
    	$permalink_for_sp_cat=get_permalink()."?s_p_c_t=1342";
      }
}
    $urll=site_url();

	
if ($params['enable_rating']):
?>
<style type="text/css">
.star-rating {
background: url(<?php  echo plugins_url('',__FILE__).'/Front_images/star' . $params['rating_star'] . '.png';
?>) top left repeat-x !important;
}
.star-rating li a:hover {
background: url(<?php  echo plugins_url('',__FILE__). '/Front_images/star' . $params['rating_star'] . '.png';
?>) left bottom !important;
}
.star-rating li.current-rating {
background: url(<?php  echo plugins_url('',__FILE__).'/Front_images/star' . $params['rating_star'] . '.png';
?>) left center !important;
}
.star-rating1 {
background: url(<?php  echo plugins_url('',__FILE__).'/Front_images/star' . $params['rating_star'] . '.png';
?>) top left repeat-x !important;
}
.star-rating1 li.current-rating {
background: url(<?php  echo plugins_url('',__FILE__). '/Front_images/star' . $params['rating_star'] . '.png';
?>) left center !important;
}
</style>
<?php
endif;

if ($params['rounded_corners']):
?>
<style type="text/css">
select.spidercataloginput{
margin: 0 0 24px 0 !important;
top: -11px !important;
position: relative;
}
#CatalogSearchBox, .spidercatalogbutton, .spidercataloginput
{
	font-size:11px !important;
	-webkit-border-radius: 8px !important;
	-moz-border-radius: 8px !important;
	border-radius: 8px !important;
	text-align: right !important;
	
}
#CatalogSearchBox
{
	margin-bottom:10px !important;
	text-align: right !important;
}

#productMainDiv, #productCartFull, .spidercatalogbutton, .spidercataloginput
{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
}
#productMainDiv table, #productMainDiv td, #productMainDiv tr, #productMainDiv div, #productMainDiv tbody, #productMainDiv th
{
	line-height:inherit;
}
#productMainDiv tr, td
{
	padding:inherit !important;
}
#productMainDiv img{
	max-width:inherit;
	max-height:inherit;
}
#productMainDiv ul li, #productMainDiv ul , #productMainDiv li
{
	list-style-type:none !important;
}






#productMainDiv #prodTitle
{
-webkit-border-top-right-radius: 8px;
-webkit-border-top-left-radius: 8px;
-moz-border-radius-topright: 8px;
-moz-border-radius-topleft: 8px;
border-top-right-radius: 8px;
border-top-left-radius: 8px;
}

#productCartFull tr:first-child td:first-child
{
-webkit-border-top-left-radius: 8px;
-moz-border-radius-topleft: 8px;
border-top-left-radius: 8px;
}
#productCartFull{
	margin:inherit;
}
#productCartFull table, #productCartFull tr, #productCartFull td {
	padding-bottom:0px;
	padding-left:0px;
	padding-right:0px;
	padding-top:0px;
	margin-bottom:0px;
	margin-left:0px;
	margin-right:0px;
	margin-top:0px;
}
#productCartFull{
	padding-bottom:0px;
	padding-left:0px;
	padding-right:0px;
	padding-top:0px;
	margin-bottom:0px;
	margin-left:0px;
	margin-right:0px;
	margin-top:0px;
}

#productCartFull tr:first-child td:last-child
{
-webkit-border-top-right-radius: 8px;
-moz-border-radius-topright: 8px;
border-top-right-radius: 8px;
}


#productCartFull tr:last-child td:first-child
{
-webkit-border-bottom-left-radius: 8px;
-moz-border-radius-bottomleft: 8px;
border-bottom-left-radius: 8px;
}

#productCartFull tr:last-child td:last-child
{
-webkit-border-bottom-right-radius: 8px;
-moz-border-radius-bottomright: 8px;
border-bottom-right-radius: 8px;
}



#productCartFull td table td
{
-webkit-border-radius: 0px !important;
-moz-border-radius: 0px !important;
border-radius: 0px !important;
}

#productMainDiv td, #productMainDiv tr, #productMainDiv tbody,  #productMainDiv div{
	line-height:inherit !important;
	background-color:inherit;
	color:inherit;
	opacity:inherit !important;
	
}
#category, #category table, #category tr, #category td, #category th,  #category tbody{
	border:0px;
	border-bottom:0 !important;
	border-left:0 !important;
	border-right:0 !important;
	border-top:0 !important;
	margin-left:0px;
	margin-bottom:0px;
	margin-right:0px;
	margin-top:0px;
	padding-bottom: 10px;
	padding-left: 10px;
	padding-right: 10px;
}
#productCartFull ul, #productCartFull li, #productCartFull a{
	background-color:inherit;
	list-style:none;
}
#spider_catalog_inform_table tr, #spider_catalog_inform_table td{
	text-align:left;
	vertical-align:top !important;
}
#spider_cat_price_tab{
	vertical-align:top !important;
}







#productMainDiv input,
#productMainDiv textarea {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-transition: all 0.2s linear;
  -webkit-transition-delay: 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
}






#productMainDiv textarea,
#productMainDiv input[type="text"]
 {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-background-clip: padding;
  -moz-background-clip: padding;
  background-clip: padding-box;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-appearance: none;
  background-color: white;
  border: 1px solid #cccccc;
  color: black;
  outline: 0;
  margin: 0;
  padding: 3px 4px;
  text-align: left !important;
  font-size: 13px;
  font-family: Arial, "Liberation Sans", FreeSans, sans-serif;
  height: 2.2em;
  vertical-align: top;
  *padding-top: 2px;
  *padding-bottom: 1px;
  *height: auto;
}
#productMainDiv textarea[disabled],
#productMainDiv input[type="text"][disabled]
{
  background-color: #eeeeee;
}
#productMainDiv textarea:focus,
#productMainDiv input[type="text"]:focus {
  border-color: rgba(82, 168, 236, 0.8);
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
}


#productMainDiv input[disabled],
#productMainDiv textarea[disabled] {
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  -moz-user-select: -moz-none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  user-select: none;
  color: #888888;
  cursor: default;
}

#productMainDiv input::-webkit-input-placeholder,
#productMainDiv textarea::-webkit-input-placeholder {
  color: #888888;
}

#productMainDiv input:-moz-placeholder,
#productMainDiv textarea:-moz-placeholder {
  color: #888888;
}

#productMainDiv input.placeholder_text,
#productMainDiv textarea.placeholder_text {
  color: #888888;
}

#productMainDiv {
  min-width: 100px;
}


#productMainDiv textarea {
  min-height: 80px;
  overflow: auto;
  padding: 5px;
  resize: vertical;
  width: 100%;
}

#productMainDiv optgroup {
  color: black;
  font-style: normal;
  font-weight: normal;
  font-family: Arial, "Liberation Sans", FreeSans, sans-serif;
}
#productMainDiv optgroup::-moz-focus-inner {
  border: 0;
  padding: 0;
}
#tdviewportheight div, #tdviewportheight td, #tdviewportheight{
	vertical-align:middle;



}



</style>



<?php
endif;

///category 
?>
<script>

function catt_idd_<?php echo $ident; ?>(id)
{ 

	document.getElementById("subcat_id_<?php echo $cels_or_list."_".$ident; ?>").value=id;
	
	document.cat_form_<?php echo $cels_or_list."_".$ident; ?>.submit();
	}
</script>
<?php
foreach($categor as $chidd){
if($par!=0 and $params1['show_category_details']==1 and ($cat_id!=$chidd->id or $_POST['cat_id_'.$cels_or_list.'_'.$ident.'']  or $_GET['cat_id_'.$cels_or_list.'_'.$ident.'']!=0)){
echo '<a style="cursor:pointer;" onclick="catt_idd_'.$ident.'('.$chidd->parent.')" >'.__('Back to Catalog','sp_catalog').'</a>';
}
}
if(($params1['categories'] > 0 or $cat_id!=0) and $params1['show_category_details']==1 )
{
	$category_details_width='';
	if($params['category_details_width'])
	{
		$category_details_width="width:".$params['category_details_width'].'px; ';
		
	}

echo '<div id="productMainDiv" style="'.$category_details_width.'border-width:'.$params[ 'border_width'].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';'.(($params[ 'text_size_big' ]!='')?('font-size:'.$params[ 'text_size_big' ].'px;'):'').(($params[ 'text_color']!='')?('color:'.$params[ 'text_color'].';'):'').(($params[ 'background_color' ]!='')?('background-color:'.$params[ 'background_color' ].';'):'').'">';

echo '<div id="prodTitle" style="'.(($params[ 'title_color' ]!='')?('color:'.$params[ 'title_color' ].';'):'').(($params[ 'title_background_color' ]!='')?('background-color:'.$params[ 'title_background_color' ].';'):'').'padding:10px;font-size:'.$params[ 'category_title_size' ].'px;">' .$cat_rows[0]->cat_name.'</div>';


$imgurl=explode(";;;",$cat_rows[0]->cat_image_url);
echo '<table id="category" border="0" cellspacing="10" cellpadding="10">
<tr>';

if($cat_rows[0]->cat_image_url!="" and $cat_rows[0]->cat_image_url!="******0")
{
	$url_for_image=explode('******',$imgurl[0]);
	echo '<td valign="top" style="width:'.($params[ 'category_picture_width' ]).'px;height:'.($params[ 'category_picture_height' ]).'px;">
			<table cellpadding="0" cellspacing="5" border="0" style="margin:0px;">
			<tr><td colspan="2" id="prod_main_picture_container" valign="top">
			<div style="border: #CCCCCC solid 2px;padding:5px;background-color:white;">
			<a href="'.$url_for_image[0].'" target="_blank" id="prod_main_picture_a_'.$ident.'" style="text-decoration:none;">
			<div id="prod_main_picture_'.$ident.'" style="width:'.($params[ 'category_picture_width' ]).'px;height:'.($params[ 'category_picture_height' ]).'px; background:url('.$url_for_image[0].') center no-repeat; background-size: contain;">&nbsp;</div></a></div>
			</td></tr>';

	echo'<tr><td style="text-align:justify;">';

$small_images_str='';
$small_images_count=0;

foreach($imgurl as $img)
{
if($img!=='******0')
{
	
	
$image_and_atach=explode('******',$img);
$img=$image_and_atach[0];	
	$atach=$image_and_atach[1];
if($atach)
{
	$array_with_sizes=wp_get_attachment_image_src( $atach, 'thumbnail' );
	$attach_url=$array_with_sizes[0];
}
else
{
	$attach_url=$image_and_atach[0];	
}
$small_images_str.='<a href="'.$img.'" target="_blank"><img style="max-width:50px;max-height:50px" src="'.$attach_url.'" vspace="0" hspace="0" onMouseOver="prod_change_picture(\''.$img.'\','.$ident.',this,'.$params['large_picture_width'].','.$params['large_picture_height'].');" /></a>
';
$small_images_count++;
}
}
if($small_images_count>1)
echo $small_images_str;
else
echo '&nbsp;';

echo '</td></tr>
</table></td>';
}
echo'<td valign="top" style="font-size:' . $params['description_size_list'] . 'px;">
'.$cat_rows[0]->cat_description.'
</td>
</tr></table>';

if( count($child_ids) and $params7['show_sub']==1)
{

echo '<div id="prodTitle" style="'.(($params[ 'title_color']!='')?('color:'.$params[ 'title_color'].';'):'').(($params[ 'title_background_color']!='')?('background-color:'.$params[ 'title_background_color'].';'):'').'padding:10px;font-size:'.$params[ 'category_title_size'].'px;">'.__('Subcategories','sp_catalog').'</div>';
echo '<table id="category" border="0" cellspacing="10" cellpadding="10">';
?>
<script>
function change_subcat_<?php echo $ident; ?>(id)
{
	document.getElementById("subcat_id_<?php echo $cels_or_list."_".$ident; ?>").value=id;
	
	document.cat_form_<?php echo $cels_or_list."_".$ident; ?>.submit();
	}
</script>
<?php

foreach ($child_ids as $chid)
{
 $imgurl = explode(";;;", $chid->category_image_url);

	
	echo '<tr><td>';
	echo '<table border="0" style="margin:0 !important;"> <tr> <td style="width:55px; vertical-align: middle;">';
	if (!($chid->category_image_url != "" and $chid->category_image_url != "******0"))
	echo '<a style="cursor:pointer;" onclick="change_subcat_'.$ident.'('.$chid->id.')"><img style="max-width:'. $params['list_picture_width'] .'px; max-height:'. $params['list_picture_height'] .'px" src="'.plugins_url("Front_images/noimage.jpg",__FILE__).'"  vspace="0" hspace="0"  /></a>';
	else{
		
		$askofen=explode('******',$imgurl[0]);
		if($askofen[1])
		{
			$array_with_sizes=wp_get_attachment_image_src( $askofen[1], 'thumbnail' );
			$attach_url=$array_with_sizes[0];
		}
		else
		{
			$attach_url=$askofen[0];
		}
		$imgurl[0]=$askofen[0];
	echo '<a href="' . $imgurl[0] . '" target="_blank" ><img src="' .$attach_url. '" vspace="0" hspace="0" style="max-width:'. $params['list_picture_width'] .'px; max-height:'. $params['list_picture_height'] .'px" /></a>';
	}
	echo '</td>';
	echo '<td style="vertical-align: middle;">';
    echo  '<div>'.'<a style="font-size:' . $params['description_size_list'] . 'px !important;cursor:pointer; '.(($params[ 'hyperlink_color']!='')?('color:'.$params[ 'hyperlink_color'].';'):'').'; font-size:inherit;" onclick="change_subcat_'.$ident.'('.$chid->id.')">'.$chid->name.'</a><br />';
    echo $chid->description.' </div>';
echo '</td></tr></table>';
}
	
	echo '</td></tr></table>';
}

echo '</div>';

}
	$width_spider_main_table_lists='';
	if($params['width_spider_main_table_lists'])
	{
		$width_spider_main_table_lists="width:".$params['width_spider_main_table_lists'].'px; ';
		
	}


?>
<div id="productMainDiv" style="<?php echo $width_spider_main_table_lists; ?>text-align:center">
<?php

//var_dump(get_permalink());
$frontpage_id = get_option('page_for_posts');
if ((!$params["choose_category"] and ($params1['categories'] > 0)) or !$params["search_by_name"])
  {
  echo '<script>
  document.getElementById("cat_form_page_nav1").style.display = "none";
  </script>';
  }
	   if( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_home() ){
    if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']){
		  if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']!=0)
		   $page_link=get_permalink($frontpage_id).'&cat_id_'.$cels_or_list.'_'.$ident.'='.$_POST['subcat_id_'.$cels_or_list.'_'.$ident.''];
		  else
		   $page_link=get_permalink($frontpage_id);
		  }else if($_POST['prod_name_'.$cels_or_list.'_'.$ident.''] or $_POST['page_num_'.$cels_or_list.'_'.$ident.''])
		   $page_link=get_permalink($frontpage_id).'&cat_id_'.$cels_or_list.'_'.$ident.'='.$cat_id;
		  else
		   $page_link=get_permalink($frontpage_id);
   }
	   else if(is_home())
	   { 
	      if(isset($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']) && $_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']){
		  if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']!=0)
		   $page_link=site_url().'/index.php?cat_id_'.$cels_or_list.'_'.$ident.'='.$_POST['subcat_id_'.$cels_or_list.'_'.$ident.''];
		  else
		   $page_link=site_url().'/index.php';
		  }else if((isset($_POST['prod_name_'.$cels_or_list.'_'.$ident.'']) && isset($_POST['page_num_'.$cels_or_list.'_'.$ident.''])) && ($_POST['prod_name_'.$cels_or_list.'_'.$ident.''] or $_POST['page_num_'.$cels_or_list.'_'.$ident.'']))
		   $page_link=site_url().'/index.php?cat_id_'.$cels_or_list.'_'.$ident.'='.$cat_id;
		  else
		   $page_link=site_url().'/index.php';
	   }
	   else
	   {
	     if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']){
		  if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']!=0)
		   $page_link=get_permalink().'&cat_id_'.$cels_or_list.'_'.$ident.'='.$_POST['subcat_id_'.$cels_or_list.'_'.$ident.''];
		  else
		   $page_link=get_permalink();
		  }else if($_POST['prod_name_'.$cels_or_list.'_'.$ident.''] or $_POST['page_num_'.$cels_or_list.'_'.$ident.''])
		   $page_link=get_permalink().'&cat_id_'.$cels_or_list.'_'.$ident.'='.$cat_id;
		  else
		   $page_link=get_permalink();
	   }
	 if(!isset($subcat_id)){
		$subcat_id='';
		}
    echo '<form action="'. $page_link.'" method="post" name="cat_form_'.$cels_or_list.'_'.$ident.'" id="cat_form_page_nav1" style="display:block;">
<input type="hidden" name="page_num_'.$cels_or_list.'_'.$ident.'"	value="1">
<input type="hidden" name="subcat_id_'.$cels_or_list.'_'.$ident.'" id="subcat_id_'.$cels_or_list.'_'.$ident.'" value="'. $subcat_id.'">
<div class="CatalogSearchBox" style="padding-top:10px;">';

if ($params["choose_category"] and !($params1['categories'] > 0))
{
	echo '<span style="top: -11px; position: relative;">'.__('Choose Category','sp_catalog') . '&nbsp</span>
		<select id="cat_id_'.$cels_or_list.'_'.$ident.'" name="cat_id_'.$cels_or_list.'_'.$ident.'" class="spidercataloginput" size="1" onChange="this.form.submit();"> 
		<option value="0">' . __('All','sp_catalog') . '</option> ';
    	
    foreach ($category_list as $category)
    {   if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']){
        if ($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']==$category->id){
            echo '<option value="' . $category->id . '"  selected="selected">' . stripslashes($category->name) . '</option>';
			}
			else
            echo '<option value="' . $category->id . '" >' . stripslashes($category->name) . '</option>';
			}
			else if($category->id == $cat_id)
        echo '<option value="' . $category->id . '"  selected="selected">' . stripslashes($category->name) . '</option>';
        else
            echo '<option value="' . $category->id . '" >' . stripslashes($category->name) . '</option>';
			
    }
       
    echo '</select>';
}

if ( $params["search_by_name"] and $params7['show_prod']==1)
{
	if(isset($_POST['prod_name_'.$cels_or_list.'_'.$ident.''])){
		 if($_POST['prod_name_'.$cels_or_list.'_'.$ident.'']!='')
			$prod_name=$_POST['prod_name_'.$cels_or_list.'_'.$ident.''];
		else
			$prod_name='';
		}else if(isset($_GET['prod_name_'.$cels_or_list.'_'.$ident.'']))
		    $prod_name=$_GET['prod_name_'.$cels_or_list.'_'.$ident.''];
        else
			$prod_name='';
echo '<br />
' . __('Search','sp_catalog') . '&nbsp;
<input type="text" id="prod_name_'.$cels_or_list.'_'.$ident.'" name="prod_name_'.$cels_or_list.'_'.$ident.'" class="spidercataloginput" value="'.$prod_name.'"> 
	<input type="button" onclick="this.form.submit()" value="'. __('Go','sp_catalog') .'" class="spidercatalogbutton" style="background-color:'.$params[ 'button_background_color' ].'; color:'.$params[ 'button_color' ].'; width:inherit;"><input type="button" value="'. __('Reset','sp_catalog') .'" onClick="cat_form_resett(this.form,'.$cels_or_list.','.$ident.');" class="spidercatalogbutton" style="background-color:'.$params[ 'button_background_color' ].'; color:'.$params[ 'button_color' ].'; width:inherit;">';
}
echo '</div></form>';
if(isset($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']) && $_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']!="")
{
  $subcat_id = $_POST['subcat_id_'.$cels_or_list.'_'.$ident.''];
}else{
	if($cat_id=='ALL_CAT')
	$cat_id=0;
  $subcat_id = $cat_id; 
}

if($params7['show_prod']==1){
if(count($rows))
{
echo '<table border="0" cellspacing="0" cellpadding="0" id="productCartFull" style="border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';border-bottom:none; border-right:none;'.(($params[ 'text_color' ]!='')?('color:'.$params[ 'text_color' ].';'):'').(($params[ 'background_color' ]!='')?('background-color:'.$params[ 'background_color' ].';'):'').'">'
.'<tr style="'.(($params[ 'title_color']!='')?('color:'.$params[ 'title_color'].';'):'').'">';

$parameters_exist=0;
foreach($rows as $row)
{
if($row->param!="")
$parameters_exist++;
}

echo '<TD style="border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';'.(($params[ 'title_background_color' ]!='')?('background-color:'.$params[ 'title_background_color' ].';'):'').'border-top:none; border-left:none;">'.__('Product','sp_catalog').'</TD>';

	echo '<TD style=" border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';'.(($params[ 'title_background_color' ]!='')?('background-color:'.$params[ 'title_background_color' ].';'):'').'border-top:none; border-left:none;">'.__('Name','sp_catalog');

if ($params['enable_rating'])	
	echo ' / '.__('Rating','sp_catalog');
	
echo '</TD>';


	
if($parameters_exist and $params[ 'list_show_parameters' ])
echo '<TD style="border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';'.(($params[ 'title_background_color' ]!='')?('background-color:'.$params[ 'title_background_color' ].';'):'').'border-top:none; border-left:none;">'.__('Parameters','sp_catalog').'</TD>';

if($params[ 'list_show_description' ])
echo '<TD style="border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';'.(($params[ 'title_background_color' ]!='')?('background-color:'.$params[ 'title_background_color' ].';'):'').'border-top:none; border-left:none;">'.__('Description','sp_catalog').'</TD>';


if($params['price'] or $params['market_price'])
echo '<TD style="border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';'.(($params[ 'title_background_color' ]!='')?('background-color:'.$params[ 'title_background_color' ].';'):'').'border-top:none; border-left:none;">'.__('Price','sp_catalog').'</TD>';

echo '</tr>';
}

foreach ($rows as $row)
{
$imgurl=explode(";;;",$row->image_url);
$image_and_atach=explode('******',$imgurl[0]);
$image=$image_and_atach[0];
if(isset($image_and_atach[1]))
$atach=$image_and_atach[1];
else
$atach=NULL;
if($atach)
{
	$array_with_sizes=wp_get_attachment_image_src( $atach, 'thumbnail' );
	$attach_url=$array_with_sizes[0];
}
else
{
	$attach_url=$image;	
}

 $link = $permalink_for_sp_cat . '&ident='.$ident.'&product_id=' . $row->id . '&cat_id_'.$cels_or_list.'_'.$ident.'=' . $subcat_id.'&page_num_'.$cels_or_list.'_'.$ident.'=' . $page_num . '&back=1';
if (!($row->image_url != "" and $row->image_url != "******0"))
$imgurl[0]=plugins_url("Front_images/noimage.jpg",__FILE__);

echo'<tr>'; 
	
if (!($row->image_url != "" and $row->image_url != "******0"))
       echo '<td style=" vertical-align: top !important; padding:0px;border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';border-top:none; border-left:none;"><img style=" max-width:'. $params['list_picture_width'] .'px; max-height:'. $params['list_picture_height'] .'px; border: #CCC solid 2px; margin:10px" src="'.plugins_url("Front_images/noimage.jpg",__FILE__).'" />
</td>';
else
        echo '<td style=" vertical-align: top !important; border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';border-top:none; border-left:none;"><a href="' . $image . '" target="_blank"><img style="border: #CCC solid 2px; margin:10px; max-width:'. $params['list_picture_width'] .'px; max-height:'. $params['list_picture_height'] .'px" src="'.$attach_url.'" /></a></td>';

echo '<td style="'.(($params[ 'name_price_size_list']!='')?('font-size:'.$params[ 'name_price_size_list'].'px;'):'').' border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color'].';border-style:'.$params[ 'border_style' ].';border-top:none; border-left:none;"><a href="'.$link.'" style="' . (($params['hyperlink_color'] != '') ? ('color:' . $params['hyperlink_color'] . ';') : '') . '">' . $row->name . '</a>';

	if ($row->category_id > 0 and $params['list_show_category'])
        echo '<br><div style="margin:10px;"><b>' . __('Category:','sp_catalog') . '</b>&nbsp;&nbsp;&nbsp;<span style="' . (($params['params_color'] != '') ? ('color:' . $params['params_color'] . ';') : '') . '" id="cat_' . $row->id . '">' . $categories[$row->category_id] . '</span></div>';


    if ($params['enable_rating'])
      {
        $id = $row->id;
        
        $rating = $ratings[$id] * 25;
        
        if ($voted[$id] == 0)
          {
            if ($ratings[$id] == 0)
                $title = __('Not rated Yet.','sp_catalog');

            else
                $title = $ratings[$id];           
            
            
            echo "<div id='voting" . $row->id . "_".$cels_or_list."_".$ident."' style='height:50px; padding:10px;'>
			<ul class='star-rating'>	
				<li class='current-rating' id='current-rating' style=\"width:" . $rating . "px\"></li>
				<li><a href=\"#\" onclick=\"vote(1," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"	title='" . $title . "' class='one-star'>1</a></li>
				<li><a href=\"#\" onclick=\"vote(2," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"  title='" . $title . "' class='two-stars'>2</a></li>	
				<li><a href=\"#\" onclick=\"vote(3," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"   title='" . $title . "' class='three-stars'>3</a></li>
				<li><a href=\"#\" onclick=\"vote(4," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"    title='" . $title . "' class='four-stars'>4</a></li>
				<li><a href=\"#\" onclick=\"vote(5," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"	title='" . $title . "' class='five-stars'>5</a></li>
			</ul>
			</div>";
           
          }
        
        else
          {
            if ($ratings[$id] == 0)
                $title = __('Not rated Yet.','sp_catalog');
            
            else
                $title = __('Rating:','sp_catalog') . '&nbsp;' . $ratings[$id] . '&nbsp;&nbsp;&nbsp;&nbsp;&#013;' . __('You have already rated this product.','sp_catalog');
            
            echo "<div id='voting" . $row->id . "_".$cels_or_list."_".$ident."' style='height:50px; padding:10px;'>
			<ul class='star-rating1'>	
			<li class='current-rating' id='current-rating' style=\"width:" . $rating . "px\"></li>
			<li><a  title='" . $title . "' class='one-star'>1</a></li>
			<li><a  title='" . $title . "' class='two-stars'>2</a></li>
			<li><a title='" . $title . "' class='three-stars'>3</a></li>
			<li><a title='" . $title . "' class='four-stars'>4</a></li>
			<li><a title='" . $title . "' class='five-stars'>5</a></li>
			</ul>
			</div>";
           
         }
       
      }
echo '</td>';

if($parameters_exist and $params[ 'list_show_parameters'])
{
    echo '<td style="'.(($params[ 'Parameters_size_list']!='')?('font-size:'.$params[ 'Parameters_size_list'].'px;'):'').'padding:0px;border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';border-top:none; border-left:none;vertical-align:top;"><table id="spider_catalog_inform_table" border="0" cellspacing="0" cellpadding="0" width="100%">';
         
    
    $par_data = explode("par_", $row->param);
 
    for ($j = 0; $j < count($par_data); $j++)
        if ($par_data[$j] != '')
          {
            $par1_data = explode("@@:@@", $par_data[$j]);
            $par_values = explode("	", $par1_data[1]);

            $countOfPar = 0;
            
            for ($k = 0; $k < count($par_values); $k++)
                if ($par_values[$k] != "")
                    $countOfPar++;
            
            $bgcolor = ((!($j % 2)) ? (($params['params_background_color2'] != '') ? ('background-color:' . $params['params_background_color2'] . ';') : '') : (($params['params_background_color1'] != '') ? ('background-color:' . $params['params_background_color1'] . ';') : ''));
            
            
            if ($countOfPar != 0)
              {
                echo '<tr style="' . $bgcolor . 'text-align:left"><td><b>' . stripslashes($par1_data[0]) . ':</b></td>';
                

                    echo '<td style="' . (($params['text_size_list'] != '') ? ('font-size:' . $params['text_size_list'] . 'px;') : '') . $bgcolor . (($params['params_color'] != '') ? ('color:' . $params['params_color'] . ';') : '') . 'width:' . $params['parameters_select_box_width'] . 'px;"><ul class="spidercatalogparamslist">';
                    
                    for ($k = 0; $k < count($par_values); $k++)
                        if ($par_values[$k] != "")
                            echo '<li>' . stripslashes($par_values[$k]) . '</li>';
                    
                    echo '</ul></td></tr>';
                  
              }
          }
echo '</table></td>';
}

   

if($params[ 'list_show_description' ])
{	
   $description = explode('<!--more-->', stripslashes($row->description));
   echo '<td style="border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';border-top:none; border-left:none;padding:10px">
   <div id="prodDescription" style="'. (($params['description_size_list'] != '') ? ('font-size:' . $params['description_size_list'] . 'px;') : '') .'">' . $description[0] . ' </div>
   <div id="prodMore"  style="'. (($params['description_size_list'] != '') ? ('font-size:' . $params['description_size_list'] . 'px;') : '') .'"><a href="'.$link.'" style="' . (($params['hyperlink_color'] != '') ? ('color:' . $params['hyperlink_color'] . ';') : '') . '">' . __('More','sp_catalog') . '</a></div>
   </td>';
}
	

if($params['price'] or $params['market_price'])
{
echo '<td id="spider_cat_price_tab" style="border-width:'.$params[ 'border_width' ].'px;border-color:'.$params[ 'border_color' ].';border-style:'.$params[ 'border_style' ].';border-top:none; border-left:none;">';

	if ($params['price'] and $row->cost != 0 and $row->cost != '')
	  echo '<div id="prodCost" style="font-size:' . $params['price_size_list'] . 'px;color:' . $params['price_color'] . ';">' . (($params['currency_symbol_position'] == 0) ? ($params['currency_symbol']) : '') . '&nbsp;' . $row->cost . '&nbsp;' . (($params['currency_symbol_position'] == 1) ? $params['currency_symbol'] : '') . '</div>';
		
	if ($params['market_price'] and $row->market_cost != 0 and $row->market_cost != '')
	   echo '<div id="prodCost" style="font-size:' . ($params['price_size_list'] / 1.7) . 'px;">' . __('Market Price:','sp_catalog') . ' <span style=" text-decoration:line-through;color:' . $params['price_color'] . ';"> ' . (($params['currency_symbol_position'] == 0) ? ($params['currency_symbol']) : '') . '&nbsp;' . $row->market_cost . '&nbsp;' . (($params['currency_symbol_position'] == 1) ? $params['currency_symbol'] : ' ') . '</span></div>';
	   
	echo '</td>';   
}

echo '</tr>';   
    
}

if(count($rows))
echo '</table>';
?>

<script>
function submit_catal(page_link)
{
	if(document.getElementById('cat_form_page_nav1')){
	document.getElementById('cat_form_page_nav1').setAttribute('action',page_link);
	document.getElementById('cat_form_page_nav1').submit();
	}
	else
	{
		window.location.href=page_link;
	}
}

</script>


<div id="spidercatalognavigation" style="text-align:center;">
  <?php
if ($cat_id != 0)
    $url .= '&cat_id_'.$cels_or_list.'_'.$ident.'=' . $subcat_id;
	
if ($prod_name != "")
    $url .= '&prod_name_'.$cels_or_list.'_'.$ident.'=' . $prod_name;

if ($prod_count > $prod_in_page and $prod_in_page > 0)
  {
    $r = ceil($prod_count / $prod_in_page);

    $navstyle = (($params['text_size_small'] != '') ? ('font-size:' . $params['text_size_small'] . 'px !important;') : 'font-size:12px !important;') . (($params['text_color'] != '') ? ('color:' . $params['text_color'] . ' !important;') : '');
	
    $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'= ';
	
    if ($page_num > 5)
      {
        $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'=1';
        
        echo "
&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">".__('First','sp_catalog')."</a>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;...&nbsp";
        
      }
    
    
    
    if ($page_num > 1)
      {
        $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'=' . ($page_num - 1);
        
        echo "&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">".__('Prev','sp_catalog')."</a>&nbsp;&nbsp;";
        
      }
    
    
    
    for ($i = $page_num - 4; $i < ($page_num + 5); $i++)
      {
        if ($i <= $r and $i >= 1)
          {
            $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'=' . $i;
            
            if ($i == $page_num)
                echo "<span style='font-weight:bold;color:#000000'>&nbsp;$i&nbsp;</span>";
            
            else
                echo "<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">&nbsp;$i&nbsp;</a>";
            
          }
        
      }
    
    
    
    
    
    if ($page_num < $r)
      {
        $link = $permalink_for_sp_cat .$url . '&page_num_'.$cels_or_list.'_'.$ident.'=' . ($page_num + 1);
        
        echo "&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">".__('Next','sp_catalog')."</a>&nbsp;&nbsp;";
        
      }
    
    if (($r - $page_num) > 4)
      {
        $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'=' . $r;
        
        echo "&nbsp;...&nbsp;&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">".__('Last','sp_catalog')."</a>";
        
      }
    }
 

?>
</div><?php } ?></div>

<script type="text/javascript">
var SpiderCatOFOnLoad = window.onload;
window.onload = SpiderCatAddToOnload;
</script>
<?php


    $ident++;
	$content=ob_get_contents();
                ob_end_clean();
                return $content;
	
}






























































//////////////////////////////////////////////////////////////////////										//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////										//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////     		 Front End Catalog			//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////										//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////										//////////////////////////////////////////////////////////////////////












function front_end_catalog_cells($rows, $params,$page_num,$prod_count,$prod_in_page,$ratings,$voted,$categories,$category_list,$params1,$cat_rows,$cat_id,$child_ids,$params7,$categor,$par,$cels_or_list,$ident){

        ob_start();
 global $ident;
$frontpage_id = get_option('page_for_posts');

$pos = strrpos(get_permalink(), "?");
$permalink_for_sp_cat="";
if( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_home() ){
    if($pos)
    {
	  $permalink_for_sp_cat=get_permalink($frontpage_id);
    }
    else
    {
	  $permalink_for_sp_cat=get_permalink($frontpage_id)."?s_p_c_t=1342";
    }
}
else if(is_home()){ 
	  $pos1=strrpos(site_url().'/index.php', "?");
	  if($pos1)
      {
	     $permalink_for_sp_cat=site_url().'/index.php';
      }
      else
      {
    	$permalink_for_sp_cat=site_url().'/index.php'."?s_p_c_t=1342";
      }
}
else{
      if($pos)
      {
    	$permalink_for_sp_cat=get_permalink();
      }
      else
      {
    	$permalink_for_sp_cat=get_permalink()."?s_p_c_t=1342";
      }
}
$prod_iterator = 0;
if ($params['enable_rating']):
?>
<style type="text/css">

.star-rating 					{ background: url(<?php   echo plugins_url('',__FILE__).'/Front_images/star' . $params['rating_star'] . '.png';?>) top left repeat-x !important; }

.star-rating li a:hover			{ background: url(<?php    echo plugins_url('',__FILE__).'/Front_images/star' . $params['rating_star'] . '.png'; ?>) left bottom !important; }

.star-rating li.current-rating 	{ background: url(<?php    echo plugins_url('',__FILE__).'/Front_images/star' . $params['rating_star'] . '.png';?>) left center !important; }

.star-rating1 					{ background: url(<?php    echo plugins_url('',__FILE__).'/Front_images/star' . $params['rating_star'] . '.png';?>) top left repeat-x !important; }

.star-rating1 li.current-rating	{ background: url(<?php    echo plugins_url('',__FILE__).'/Front_images/star' . $params['rating_star'] . '.png';?>) left center !important; }

</style>

<?php
endif;

if ($params['rounded_corners']):
?>
<style type="text/css">

#productMain optgroup {
  color: black;
  font-style: normal;
  font-weight: normal;
  font-family: Arial, "Liberation Sans", FreeSans, sans-serif;
}
#productMain optgroup::-moz-focus-inner {
  border: 0;
  padding: 0;
}
#productMain, #productCartFull, .spidercatalogbutton, .spidercataloginput
{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
}
#productMain table, #productMain td, #productMain tr, #productMain div, #productMain tbody, #productMain th
{
	line-height:inherit;
}
#productMain tr, td
{
	padding:inherit !important;
}

#productMain img{
	max-width:inherit;
	max-height:inherit;
}
#productMain ul li, #productMain ul , #productMain li
{
	list-style-type:none !important;
}

#productMain{
   margin: 15px;
padding: 5px;
text-align: left;
   font-size:12px !important;
	-webkit-border-radius: 8px !important;
	-moz-border-radius: 8px !important;
	border-radius: 8px !important;
	
}
#productMain #prodTitle
{
-webkit-border-top-right-radius: 8px !important;
-webkit-border-top-left-radius: 8px !important;
-moz-border-radius-topright: 8px !important;
-moz-border-radius-topleft: 8px !important;
border-top-right-radius: 8px !important;
border-top-left-radius: 8px !important;
}

select.spidercataloginput{
margin: 0 0 24px 0 !important;
top: -11px !important;
position: relative;
}
#productMainDiv, .spidercatalogbutton, .spidercataloginput
{
	font-size:12px !important;
	-webkit-border-radius: 8px !important;
	-moz-border-radius: 8px !important;
	border-radius: 8px !important;
	
}


#productMainDiv, .spidercatalogbutton, .spidercataloginput
{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
}

#productMainDiv #prodTitle
{
-webkit-border-top-right-radius: 8px;
-webkit-border-top-left-radius: 8px;
-moz-border-radius-topright: 8px;
-moz-border-radius-topleft: 8px;
border-top-right-radius: 8px;
border-top-left-radius: 8px;
}
#productMainDiv, .spidercatalogbutton
{
	font-size:10px !important;
	-webkit-border-radius: 8px !important;
	-moz-border-radius: 8px !important;
	border-radius: 8px !important;
	
}



#productMainDiv input,
#productMainDiv textarea {
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-transition: all 0.2s linear;
  -webkit-transition-delay: 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
}






#productMainDiv textarea,
#productMainDiv input[type="text"]
 {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-background-clip: padding;
  -moz-background-clip: padding;
  background-clip: padding-box;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-appearance: none;
  background-color: white;
  border: 1px solid #cccccc;
  color: black;
  outline: 0;
  margin: 0;
  padding: 3px 4px;
  text-align: left !important;
  font-size: 13px;
  font-family: Arial, "Liberation Sans", FreeSans, sans-serif;
  height: 2.2em;
  vertical-align: top;
  *padding-top: 2px;
  *padding-bottom: 1px;
  *height: auto;
}
#productMainDiv textarea[disabled],
#productMainDiv input[type="text"][disabled]
{
  background-color: #eeeeee;
}
#productMainDiv textarea:focus,
#productMainDiv input[type="text"]:focus {
  border-color: rgba(82, 168, 236, 0.8);
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
}


#productMainDiv input[disabled],
#productMainDiv textarea[disabled] {
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  -moz-user-select: -moz-none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  user-select: none;
  color: #888888;
  cursor: default;
}

#productMainDiv input::-webkit-input-placeholder,
#productMainDiv textarea::-webkit-input-placeholder {
  color: #888888;
}

#productMainDiv input:-moz-placeholder,
#productMainDiv textarea:-moz-placeholder {
  color: #888888;
}

#productMainDiv input.placeholder_text,
#productMainDiv textarea.placeholder_text {
  color: #888888;
}




#productMainDiv textarea {
  min-height: 80px;
  overflow: auto;
  padding: 5px;
  resize: vertical;
  width: 100%;
}

#productMainDiv optgroup {
  color: black;
  font-style: normal;
  font-weight: normal;
  font-family: Arial, "Liberation Sans", FreeSans, sans-serif;
}
#productMainDiv optgroup::-moz-focus-inner {
  border: 0;
  padding: 0;
}
#productMain optgroup {
  color: black;
  font-style: normal;
  font-weight: normal;
  font-family: Arial, "Liberation Sans", FreeSans, sans-serif;
}
#productMain optgroup::-moz-focus-inner {
  border: 0;
  padding: 0;
}
#productMainTable{
	padding-top:0px;
	padding-bottom:0px;
	padding-left:0px;
	padding-right:0px;
	margin-bottom:0px;
	margin-left:0px;
	margin-right:0px;
	margin-top:0px;
	border:none !important;
	border-collapse:inherit;
	
}
#productMainTable table, #productMainTable tbody, #productMainTable tr, #productMainTable td{
		padding-top:0px!important;
	padding-bottom:0px!important;
	padding-left:0px!important;
	padding-right:0px!important;
	margin-bottom:0px!important;
	margin-left:0px!important;
	margin-right:0px!important;
	margin-top:0px !important;
	padding:inherit;
	border:none !important;
	border-collapse:inherit;
	background-color:inherit;
	opacity: 1 !important;
	text-align:left;
	
}
.CatalogSearchBox input{
	margin-top:-3px !important;
}
.S_P_productMainDiv table, .S_P_productMainDiv tr, .S_P_productMainDiv td, .S_P_productMainDiv tbody, .S_P_productMainDiv table tr td 
{
		border:none !important;
	
}
#productMainDiv ul li, #productMainDiv ul , #productMainDiv li
{
	list-style-type:none !important;
}
#productMainDiv td, #productMainDiv tr, #productMainDiv tbody,  #productMainDiv div{
	line-height:inherit !important;
	background-color:inherit;
	color:inherit;
	opacity:inherit !important;
	max-width:inherit !important;
	max-height:inherit !important;
	
}
#productMainDiv, #productMainDiv div{
	max-width:1000000px !important;
}
#productMain ul li, #productMain ul , #productMain li
{
	list-style-type:none !important;
}
#productMain td, #productMain tr, #productMain tbody,  #productMain div{
	line-height:inherit !important;
	background-color:inherit;
	color:inherit;
	opacity:inherit !important;
	max-width:inherit !important;
	max-height:inherit !important;
	
}
#productMain, #productMain div{
	max-width:1000000px !important;
}
#prodMiddle , #prodMiddle a, #prodMiddle li, #prodMiddle ol{
	background-color:inherit !important;
}
#tdviewportheight div, #tdviewportheight td, #tdviewportheight{
	vertical-align:middle;



}


</style>


<?php
endif;
?>
<script>
function catt_idd_<?php echo $ident; ?>(id)
{ 

	document.getElementById("subcat_id_<?php echo $cels_or_list."_".$ident; ?>").value=id;
	
	document.cat_form_<?php echo $cels_or_list."_".$ident; ?>.submit();
	}
</script>
<?php


foreach($categor as $chidd){
if($par!=0 and $params1['show_category_details']==1 and ($cat_id!=$chidd->id or $_POST['cat_id_'.$cels_or_list.'_'.$ident.''] or $_GET['cat_id_'.$cels_or_list.'_'.$ident.'']!=0)){

echo '<a style="cursor:pointer;" onclick="catt_idd_'.$ident.'('.$chidd->parent.')" >'.__('Back to Catalog','sp_catalog').'</a>';
}
}
if(($params1['categories'] > 0 or $cat_id!=0) and $params1['show_category_details']==1 )
{

echo '<div id="productMainDiv" class="S_P_productMainDiv" style="'.(($params[ 'category_details_width']!='')?('width:'.$params[ 'category_details_width'].'px !important;'):'').' border-width:'.$params[ 'border_width'].'px;border-color:'.$params[ 'border_color'].';border-style:'.$params[ 'border_style'].';'.(($params[ 'text_size_big']!='')?('font-size:'.$params[ 'text_size_big'].'px !important;'):'').(($params[ 'text_color']!='')?('color:'.$params[ 'text_color'].';'):'').(($params[ 'background_color']!='')?('background-color:'.$params[ 'background_color'].';'):'').'">';

echo '<div id="prodTitle" style="'.(($params[ 'title_color']!='')?('color:'.$params[ 'title_color'].';'):'').(($params[ 'title_background_color']!='')?('background-color:'.$params[ 'title_background_color'].';'):'').'padding:10px;font-size:'.$params[ 'category_title_size'].'px;">' .$cat_rows[0]->cat_name.'</div>';


$imgurl=explode(";;;",$cat_rows[0]->cat_image_url);
$askofenn=explode('******',$imgurl[0]);
echo '<table id="category" border="0" cellspacing="10" cellpadding="10">
<tr>';

if($cat_rows[0]->cat_image_url!="" and $cat_rows[0]->cat_image_url!="******0")
{
	echo '<td valign="top" style="width:'.($params[ 'category_picture_width']).'px;height:'.($params[ 'category_picture_height']).'px;">
			<table cellpadding="0" cellspacing="5" border="0" style="margin:0px;">
			<tr><td colspan="2" style="width:'.($params[ 'category_picture_width']).'px;height:'.($params[ 'category_picture_height']).'px;" id="prod_main_picture_container" valign="top">
			<div style="border: #CCCCCC solid 2px;padding:5px;background-color:white;">
			<a href="'.$askofenn[0].'" target="_blank" id="prod_main_picture_a_'.$ident.'" style="text-decoration:none;">
			<div id="prod_main_picture_'.$ident.'" style="width:'.($params[ 'category_picture_width']).'px;height:'.($params[ 'category_picture_height']).'px;background:url('.$askofenn[0].') center no-repeat; background-size: contain">&nbsp;</div></a></div>
			</td></tr>';

	echo'<tr><td style="text-align:justify;">';

$small_images_str='';
$small_images_count=0;

foreach($imgurl as $img)
{
	$image_and_atach=explode('******',$img);
	
	$atach=$image_and_atach[1];
if($atach)
{
	$array_with_sizes=wp_get_attachment_image_src( $atach, 'thumbnail' );
	$attach_url=$array_with_sizes[0];
}
else
{
	$attach_url=$image_and_atach[0];	
}

	
if($image_and_atach[0]!=='')
{
$small_images_str.='<a href="'.$image_and_atach[0].'" target="_blank"><img style="max-width:50px; max-height=50px" src="'.$attach_url.'" vspace="0" hspace="0" onMouseOver="prod_change_picture(\''.$img.'\','.$ident.',this,'.$params['large_picture_width'].','.$params['large_picture_height'].');" /></a>
';
$small_images_count++;
}
}
if($small_images_count>1)
echo $small_images_str;
else
echo '&nbsp;';

echo '</td></tr>
</table></td>';
}

echo'<td valign="top" style="'.(($params['text_size_small'] != '') ? ('font-size:' . $params['text_size_small'] . 'px !important;') : '').'">
'.$cat_rows[0]->cat_description.'
</td>
</tr></table>';


if( count($child_ids) and $params7['show_sub']==1)
{

echo '<div id="prodTitle" style="'.(($params[ 'title_color']!='')?('color:'.$params[ 'title_color'].';'):'').(($params[ 'title_background_color']!='')?('background-color:'.$params[ 'title_background_color'].';'):'').'padding:10px;font-size:'.$params[ 'category_title_size'].'px;">'.__('Subcategories','sp_catalog').'</div>';
echo '<table id="category" border="0" cellspacing="10" cellpadding="10">';


?>
<script>
function change_subcat_<?php echo $ident; ?>(id)
{
	document.getElementById("subcat_id_<?php echo $cels_or_list."_".$ident; ?>").value=id;	
	document.cat_form_<?php echo $cels_or_list."_".$ident; ?>.submit();
	}
</script>
<?php

foreach ($child_ids as $chid)
{
 $imgurl = explode(";;;", $chid->category_image_url);
	
	echo '<tr><td>';
	echo '<table border="0" style="margin:0 !important;"> <tr> <td style="width:55px; vertical-align: middle;">';
	if (!($chid->category_image_url != "" and $chid->category_image_url != "******0"))
	echo '<a style="cursor:pointer;" onclick="change_subcat_'.$ident.'('.$chid->id.')"><img style="max-width:'. $params['small_picture_width'] . 'px; max-height:' . $params['small_picture_height'] . 'px" src="'.plugins_url("Front_images/noimage.jpg",__FILE__).'"  vspace="0" hspace="0"  /></a>';
	else{
		
		$askofen=explode('******',$imgurl[0]);
		if($askofen[1])
		{
			$array_with_sizes=wp_get_attachment_image_src( $askofen[1], 'thumbnail' );
			$attach_url=$array_with_sizes[0];
		}
		else
		{
			$attach_url=$askofen[0];
		}
		$imgurl[0]=$askofen[0];
	echo '<a href="' . $imgurl[0] . '" target="_blank" ><img src="' .$attach_url. '" vspace="0" hspace="0" style="max-width:'. $params['small_picture_width'] . 'px; max-height:' . $params['small_picture_height'] . 'px" /></a>';
	}
	echo '</td>';
	echo '<td style="vertical-align: middle;">';
    echo  '<div>'.'<a style="'.(($params['text_size_small'] != '') ? ('font-size:' . $params['text_size_small'] . 'px !important;') : '').';cursor:pointer; '.(($params[ 'hyperlink_color']!='')?('color:'.$params[ 'hyperlink_color'].';'):'').'; font-size:inherit;" onclick="change_subcat_'.$ident.'('.$chid->id.')">'.$chid->name.'</a><br />';
    echo $chid->description.' </div>';
echo '</td></tr></table>';

}
	
	echo '</td></tr></table>';
}


echo '</div>';
}

?>
<div id="productMainDiv" style="text-align:center; width:<?php echo $params['count_of_product_in_the_row']*$params['product_cell_width']+$params['count_of_product_in_the_row']*35 ?>px">
<?php
global $post;
$page_id=$post->ID;


$frontpage_id = get_option('page_for_posts');

if (($params["choose_category"] and !($params1['categories'] > 0)) or $params["search_by_name"])
  {
  echo '<script>
  document.getElementById("cat_form_page_nav").style.display = "none";
  </script>';
  }
   if( 'page' == get_option( 'show_on_front' ) && ( '' != get_option( 'page_for_posts' ) ) && is_home() ){
    if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']){
		  if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']!=0)
		   $page_link=get_permalink($frontpage_id).'&cat_id_'.$cels_or_list.'_'.$ident.'='.$_POST['subcat_id_'.$cels_or_list.'_'.$ident.''];
		  else
		   $page_link=get_permalink($frontpage_id);
		  }else if($_POST['prod_name_'.$cels_or_list.'_'.$ident.''] or $_POST['page_num_'.$cels_or_list.'_'.$ident.''])
		   $page_link=get_permalink($frontpage_id).'&cat_id_'.$cels_or_list.'_'.$ident.'='.$cat_id;
		  else
		   $page_link=get_permalink($frontpage_id);
   }
	   else if(is_home())
	   { 
	      if(isset($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']) && $_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']){
		  if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']!=0)
		   $page_link=site_url().'/index.php?cat_id_'.$cels_or_list.'_'.$ident.'='.$_POST['subcat_id_'.$cels_or_list.'_'.$ident.''];
		  else
		   $page_link=site_url().'/index.php';
		  }else if((isset($_POST['prod_name_'.$cels_or_list.'_'.$ident.'']) or isset($_POST['page_num_'.$cels_or_list.'_'.$ident.''])) && ($_POST['prod_name_'.$cels_or_list.'_'.$ident.''] or $_POST['page_num_'.$cels_or_list.'_'.$ident.'']))
		   $page_link=site_url().'/index.php?cat_id_'.$cels_or_list.'_'.$ident.'='.$cat_id;
		  else
		   $page_link=site_url().'/index.php';
	   }
	   else
	   {
	     if(strrpos(get_permalink(), '?')){
	     if(isset($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']) && $_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']){
		  if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']!=0)
		 
		   $page_link=get_permalink().'&cat_id_'.$cels_or_list.'_'.$ident.'='.$_POST['subcat_id_'.$cels_or_list.'_'.$ident.''];
		  else
		   $page_link=get_permalink();
		  }else if((isset($_POST['prod_name_'.$cels_or_list.'_'.$ident.'']) or isset($_POST['page_num_'.$cels_or_list.'_'.$ident.''])) && ($_POST['prod_name_'.$cels_or_list.'_'.$ident.''] or $_POST['page_num_'.$cels_or_list.'_'.$ident.'']))
		   $page_link=get_permalink().'&cat_id_'.$cels_or_list.'_'.$ident.'='.$cat_id;
		  else
		   $page_link=get_permalink();
		   }else{
		   if(isset($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']) && $_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']){
		  if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']!=0)
		 
		   $page_link=get_permalink().'?cat_id_'.$cels_or_list.'_'.$ident.'='.$_POST['subcat_id_'.$cels_or_list.'_'.$ident.''];
		  else
		   $page_link=get_permalink();
		  }else if((isset($_POST['prod_name_'.$cels_or_list.'_'.$ident.'']) && isset($_POST['page_num_'.$cels_or_list.'_'.$ident.''])) && ($_POST['prod_name_'.$cels_or_list.'_'.$ident.''] or $_POST['page_num_'.$cels_or_list.'_'.$ident.'']))
		   $page_link=get_permalink().'?cat_id_'.$cels_or_list.'_'.$ident.'='.$cat_id;
		  else
		   $page_link=get_permalink();
		   }
	   }
if(!isset($subcat_id))
$subcat_id='';
    echo '<form action="'.$page_link.'" method="post" name="cat_form_'.$cels_or_list.'_'.$ident.'" id="cat_form_page_nav" style="display:block;">
<input type="hidden" name="page_num_'.$cels_or_list.'_'.$ident.'"	value="1">
<input type="hidden" name="subcat_id_'.$cels_or_list.'_'.$ident.'" id="subcat_id_'.$cels_or_list.'_'.$ident.'" value="'. $subcat_id.'">

<div class="CatalogSearchBox" style="padding-top:10px;">';
if ($params["choose_category"] and !($params1['categories'] > 0))
{
	echo '<span style="top: -11px; position: relative;">'.__('Choose Category','sp_catalog') . '&nbsp</span>
		<select id="cat_id_'.$cels_or_list.'_'.$ident.'" name="cat_id_'.$cels_or_list.'_'.$ident.'" class="spidercataloginput" size="1" onChange="this.form.submit();"> 
		<option value="0">' . __('All','sp_catalog') . '</option> ';
    
    foreach ($category_list as $category)
    {   if($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']){
        if ($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']==$category->id){
            echo '<option value="' . $category->id . '"  selected="selected">' . stripslashes($category->name) . '</option>';
			}
			else
            echo '<option value="' . $category->id . '" >' . stripslashes($category->name) . '</option>';
			}
			else if($category->id == $cat_id)
        echo '<option value="' . $category->id . '"  selected="selected">' . stripslashes($category->name) . '</option>';
        else
            echo '<option value="' . $category->id . '" >' . stripslashes($category->name) . '</option>';
			
    }
        
    echo '</select>';
}

if ( $params["search_by_name"] and $params7['show_prod']==1)
{
	if(isset($_POST['prod_name_'.$cels_or_list.'_'.$ident.''])){
		 if($_POST['prod_name_'.$cels_or_list.'_'.$ident.'']!='')
			$prod_name=$_POST['prod_name_'.$cels_or_list.'_'.$ident.''];
		else
			$prod_name='';
		}else if(isset($_GET['prod_name_'.$cels_or_list.'_'.$ident.'']))
		    $prod_name=$_GET['prod_name_'.$cels_or_list.'_'.$ident.''];
        else
			$prod_name='';
echo '<br />
<label for="prod_name_'.$cels_or_list.'_'.$ident.'">' . __('Search','sp_catalog') . '</label>&nbsp;
<input type="text" id="prod_name_'.$cels_or_list.'_'.$ident.'" name="prod_name_'.$cels_or_list.'_'.$ident.'" class="spidercataloginput" value="'.$prod_name.'"> 
	<input type="button" onclick="this.form.submit()"  value="'. __('Go','sp_catalog') .'" class="spidercatalogbutton" style="background-color:'.$params[ 'button_background_color'].'; color:'.$params[ 'button_color'].'; width:inherit;"><input type="button" value="'. __('Reset','sp_catalog') .'" onClick="cat_form_resett(this.form,'.$cels_or_list.','.$ident.');" class="spidercatalogbutton" style="background-color:'.$params[ 'button_background_color'].'; color:'.$params[ 'button_color'].'; width:inherit;">';
}
echo '</div></form>';
if(isset($_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']) && $_POST['subcat_id_'.$cels_or_list.'_'.$ident.'']!="")
{
  $subcat_id = $_POST['subcat_id_'.$cels_or_list.'_'.$ident.''];
}else{
  $subcat_id = $cat_id; 
}
			 
if(count($rows))
echo '<table cellpadding="0" cellspacing="0" id="productMainTable" style="width:'. ($params['count_of_product_in_the_row']*$params['product_cell_width']+$params['count_of_product_in_the_row']*20).'px"><tr>';
if($params7['show_prod']==1){
    $urll=site_url();
    $perm=get_permalink();
	
   
foreach ($rows as $row)
  {
    if (($prod_iterator % $params['count_of_product_in_the_row']) === 0 and $prod_iterator > 0)
        echo "</tr><tr>";
    
    
    
    $prod_iterator++;
    $link = $permalink_for_sp_cat . '&ident='.$ident.'&product_id=' . $row->id . '&cat_id_'.$cels_or_list.'_'.$ident.'=' . $subcat_id.'&page_num_'.$cels_or_list.'_'.$ident.'=' . $page_num . '&back=1';
    
    
    
    $imgurl = explode(";;;", $row->image_url);
    
    
    
    
    
    
    
    
    
    
    
    echo '<td><div id="productMain" style="border-width:' . $params['border_width'] . 'px;border-color:' . $params['border_color'] . ';border-style:' . $params['border_style'] . ';' . (($params['text_size_small'] != '') ? ('font-size:' . $params['text_size_small'] . 'px !important;') : '') . (($params['text_color'] != '') ? ('color:' . $params['text_color'] . ';') : '') . (($params['background_color'] != '') ? ('background-color:' . $params['background_color'] . ';') : '') . ' width:' . $params['product_cell_width'] . 'px; height:' . $params['product_cell_height'] . 'px;">



<div style="height:' . ($params['product_cell_height'] - 20) . 'px;">

<div id="prodTitle" style="font-size:' . $params['title_size_small'] . 'px;' . (($params['title_color'] != '') ? ('color:' . $params['title_color'] . ';') : '') . (($params['title_background_color'] != '') ? ('background-color:' . $params['title_background_color'] . ';') : '') . '">' . stripslashes($row->name) . '</div>



<table id="prodMiddle" border="0" cellspacing="0" cellpadding="0"><tr>';
    



    
    if (!($row->image_url != "" and $row->image_url != "******0"))
      {
        $imgurl[0] = plugins_url("Front_images/noimage.jpg",__FILE__);
     
        echo '<td style="padding:10px;"><img style="max-width:' . $params['small_picture_width'] . 'px; max-height=' . $params['small_picture_height'] . 'px" src="'. $imgurl[0] . '" />

</td>';
      }
    else{
		
		$image_and_atach=explode('******',$imgurl[0]);
$image=$image_and_atach[0];
if(isset($image_and_atach[1]))
$atach=$image_and_atach[1];
else
$atach='';
if($atach)
{
	$array_with_sizes=wp_get_attachment_image_src( $atach, 'thumbnail' );
	$attach_url=$array_with_sizes[0];
}
else
{
	$attach_url=$image;	
}
        echo '<td style="padding:10px;"><a href="' . $image . '" target="_blank"><img style="max-width:'. $params['small_picture_width'] . 'px; max-height:' . $params['small_picture_height'] . 'px" src="'.$attach_url.'" /></a></td>';
    
	}
    
    
    
    
    
    
    echo '<td>';


if ($params['price'] and $row->cost != 0 and $row->cost != '')
  echo '<div id="prodCost" style="font-size:' . $params['price_size_small'] . 'px !important;color:' . $params['price_color'] . ';">' . (($params['currency_symbol_position'] == 0) ? ($params['currency_symbol']) : '') . ' ' . $row->cost . ' ' . (($params['currency_symbol_position'] == 1) ? $params['currency_symbol'] : ' ') . '</div>';
    
    
    
    
    
    if ($params['market_price'] and $row->market_cost != 0 and $row->market_cost != '')
        echo '<div id="prodCost" style="font-size:' . ($params['price_size_small'] / 1.7) . 'px !important;">' . __('Market Price:','sp_catalog') . ' <span style=" text-decoration:line-through;color:' . $params['price_color'] . ';"> ' . (($params['currency_symbol_position'] == 0) ? ($params['currency_symbol']) : '') . ' ' . $row->market_cost . ' ' . (($params['currency_symbol_position'] == 1) ? $params['currency_symbol'] : ' ') . '</span></div>';
    
    
    
     
    
    
    echo '</td></tr><tr><td>';
    
    
    
    
    
    
    
    if ($params['enable_rating'])
      {
        $id = $row->id;
        
        
        
        $rating = $ratings[$id] * 25;
        
        
        
        if ($voted[$id] == 0)
          {
            if ($ratings[$id] == 0)
                $title = __('Not rated Yet.','sp_catalog');
            
            else
                $title = $ratings[$id];
            
            
            
            echo "<div id='voting" . $row->id . "_".$cels_or_list."_".$ident."' style='height:50px; padding:10px;'>

			<ul class='star-rating'>	

				<li class='current-rating' id='current-rating' style=\"width:" . $rating . "px\"></li>

				<li><a href=\"#\" onclick=\"vote(1," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"		title='" . $title . "' class='one-star'>1</a></li>
				<li><a href=\"#\" onclick=\"vote(2," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"   	title='" . $title . "' class='two-stars'>2</a></li>	
				<li><a href=\"#\" onclick=\"vote(3," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"  	 title='" . $title . "' class='three-stars'>3</a></li>
				<li><a href=\"#\" onclick=\"vote(4," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"    	title='" . $title . "' class='four-stars'>4</a></li>
				<li><a href=\"#\" onclick=\"vote(5," . $row->id . ",'voting" . $row->id . "_".$cels_or_list."_".$ident."','" . __('Rated.','sp_catalog') . "','" . admin_url('admin-ajax.php?action=catalogstarerate') . "'); return false;\"		title='" . $title . "' class='five-stars'>5</a></li>

			</ul>

			</div>";
            
          }
        
        else
          {
            if ($ratings[$id] == 0)
                $title = __('Not rated Yet.','sp_catalog');
            
            else
                $title = __('Rating','sp_catalog') . ' ' . $ratings[$id] . '&nbsp;&nbsp;&nbsp;&nbsp;&#013;' . __('You have already rated this product.','sp_catalog');
            
            
            
            
            
            echo "<div id='voting" . $row->id . "_".$cels_or_list."_".$ident."' style='height:50px; padding:10px;'>

			<ul class='star-rating1'>	

			<li class='current-rating' id='current-rating' style=\"width:" . $rating . "px\"></li>

			<li><a  title='" . $title . "' class='one-star'>1</a></li>

			<li><a  title='" . $title . "' class='two-stars'>2</a></li>

			<li><a title='" . $title . "' class='three-stars'>3</a></li>

			<li><a title='" . $title . "' class='four-stars'>4</a></li>

			<li><a title='" . $title . "' class='five-stars'>5</a></li>

			</ul>

			</div>";
            
          }
        
      }
    
    echo '</td><td></td></tr>

		<tr><td colspan="2">';
    
    
    
    echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100%\">";
    
    
    
    if ($row->category_id > 0 and $params['cell_show_category'])
        echo '<tr style="' . (($params['params_background_color1'] != '') ? ('background-color:' . $params['params_background_color1'] . ';') : '') . ' vertical-align:middle;"><td><b>' . __('Category:','sp_catalog') . '</b></td><td style="' . (($params['params_color'] != '') ? ('color:' . $params['params_color'] . ';') : '') . '"><span id="cat_' . $row->id . '">' . $categories[$row->category_id] . '</span></td></tr>';
    
    else
        echo '<span id="cat_' . $row->id . '"></span>';
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    $par_data = explode("par_", $row->param);
    
    if($params['cell_show_parameters']){
    
    for ($j = 0; $j < count($par_data); $j++)
        if ($par_data[$j] != '')
          {
            $par1_data = explode("@@:@@", $par_data[$j]);
            
            
            
            $par_values = explode("	", $par1_data[1]);
            
            
            
            $countOfPar = 0;
            
            for ($k = 0; $k < count($par_values); $k++)
                if ($par_values[$k] != "")
                    $countOfPar++;
            
            $bgcolor = (($j % 2) ? (($params['params_background_color2'] != '') ? ('background-color:' . $params['params_background_color2'] . ';') : '') : (($params['params_background_color1'] != '') ? ('background-color:' . $params['params_background_color1'] . ';') : ''));
            
           
            if ($countOfPar != 0)
              {
                echo '<tr style="' . $bgcolor . 'text-align:left"><td><b>' .stripslashes( $par1_data[0]) . ':</b></td>';
                

                    echo '<td style="' . (($params['text_size_small'] != '') ? ('font-size:' . $params['text_size_small'] . 'px;') : '') . $bgcolor . (($params['params_color'] != '') ? ('color:' . $params['params_color'] . ';') : '') . 'width:' . $params['parameters_select_box_width'] . 'px;"><ul class="spidercatalogparamslist">';
                    
                    for ($k = 0; $k < count($par_values); $k++)
                        if ($par_values[$k] != "")
                            echo '<li>' . stripslashes($par_values[$k]) . '</li>';
                    
                    echo '</ul></td></tr>';  
              }
            
          }
    
    }
    
    
    $description = explode('<!--more-->', stripslashes($row->description));
    
    
    
    
    
    echo '</table>';
    
    
    
    echo '<div id="prodDescription">' . $description[0] . '</div></td></tr>

</table>

</div>

<div id="prodMore"><a href="' . $link . '" style="' . (($params['hyperlink_color'] != '') ? ('color:' . $params['hyperlink_color'] . ';') : '') . '">' . __('More','sp_catalog') . '</a></div></td>';
    
    
    
  }
}
  
if(count($rows))
echo '</tr></table>';
?>
<script>
function submit_catal(page_link)
{
	if(document.getElementById('cat_form_page_nav')){
	document.getElementById('cat_form_page_nav').setAttribute('action',page_link);
	document.getElementById('cat_form_page_nav').submit();
	}
	else
	{
		window.location.href=page_link;
	}
}
</script>

<div id="spidercatalognavigation" style="text-align:center;">

    <?php






if ($cat_id != 0)
    $url .= '&cat_id_'.$cels_or_list.'_'.$ident.'=' . $subcat_id;
	
if ($prod_name != "")
    $url .= '&prod_name_'.$cels_or_list.'_'.$ident.'=' . $prod_name;




if($params7['show_prod']==1){

if ($prod_count > $prod_in_page and $prod_in_page > 0)
  {
    $r = ceil($prod_count / $prod_in_page);
    
    
    
    
    
    $navstyle = (($params['text_size_small'] != '') ? ('font-size:' . $params['text_size_small'] . 'px !important;') : 'font-size:12px !important;') . (($params['text_color'] != '') ? ('color:' . $params['text_color'] . ' !important;') : '');
    
    
    
    $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'= ';
    
    if ($page_num > 5)
      {
        $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'=1';
        
        echo "

&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">".__('First','sp_catalog')."</a>&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;...&nbsp";
        
      }
    
    
    
    if ($page_num > 1)
      {
        $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'=' . ($page_num - 1);
        
        echo "&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">".__('Prev','sp_catalog')."</a>&nbsp;&nbsp;";
        
      }
    
    
    
    for ($i = $page_num - 4; $i < ($page_num + 5); $i++)
      {
        if ($i <= $r and $i >= 1)
          {
            $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'=' . $i;
            
            if ($i == $page_num)
                echo "<span style='font-weight:bold !important; color:#000000 !important; ".(($params['text_size_small'] != '') ? ('font-size:' . ($params['text_size_small']+4) . 'px !important;') : 'font-size:16px !important;') ."' >&nbsp;$i&nbsp;</span>";
            
            else
                echo "<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">&nbsp;$i&nbsp;</a>";
            
          }
        
      }
    
    
    
    
    
    if ($page_num < $r)
      {
        $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'=' . ($page_num + 1);
        
        echo "&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">".__('Next','sp_catalog')."</a>&nbsp;&nbsp;";
        
      }
    
    if (($r - $page_num) > 4)
      {
        $link = $permalink_for_sp_cat . $url . '&page_num_'.$cels_or_list.'_'.$ident.'=' . $r;
        
        echo "&nbsp;...&nbsp;&nbsp;&nbsp;<a href=\"javascript:submit_catal('{$link}')\" style=\"$navstyle\">".__('Last','sp_catalog')."</a>";
        
      }
    
  }
}
?></div></div>
<script type="text/javascript">
var SpiderCatOFOnLoad = window.onload;
window.onload = SpiderCatAddToOnload;
</script>

<?php
$ident++;
$content=ob_get_contents();
                ob_end_clean();
                return $content;
}

?>