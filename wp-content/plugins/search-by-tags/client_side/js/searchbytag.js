
var fl_popup_in = false;
var fl_link_in = false;

var tag_max_length_google = 18;
var tag_max_length_wp = 9;
var tag_max_length_wiki = 13;

var sbt_mouseX;


jQuery(document).ready(function(){
    jQuery(document).mousemove( function(e) {
    sbt_mouseX = e.pageX; 
    });  
});


function popup_mouseenter(){
    fl_popup_in = true;
}

function popup_mouseleave(){
    fl_popup_in = false;
    if(!fl_link_in){
        setTimeout('hide_popup()',1000);
    } 
}

function show_searchByTags_click(el,tag_name,tag_link){
        var pos = jQuery(el).position();
        if (tag_name.length>tag_max_length_google) {
            short_tag_name = tag_name.substr(0,tag_max_length_google)+'...';
        } else  short_tag_name = tag_name;   
        jQuery('.SearchByTag-popup a.sbt-google-search').attr('href','http://www.google.com?cx=partner-pub-9761369273396159:6077738498&ie=UTF-8&q='+encodeURI(tag_name));
        jQuery('.SearchByTag-popup a.sbt-google-search').html('Search <strong>'+short_tag_name+'</strong> on Google');
        if (tag_name.length>tag_max_length_wp) {
            short_tag_name = tag_name.substr(0,tag_max_length_wp)+'...';
        } else  short_tag_name = tag_name;   
        jQuery('.SearchByTag-popup a.sbt-wp-search').attr('href',tag_link);
        jQuery('.SearchByTag-popup a.sbt-wp-search').html('View all posts tagged as <strong>'+short_tag_name+'</strong>');
        if (tag_name.length>tag_max_length_wiki) {
            short_tag_name = tag_name.substr(0,tag_max_length_wiki)+'...';
        } else  short_tag_name = tag_name;   
        jQuery('.SearchByTag-popup a.sbt-wiki-search').attr('href','http://en.wikipedia.org/wiki/'+encodeURI(tag_name));
        jQuery('.SearchByTag-popup a.sbt-wiki-search').html('Find <strong>'+short_tag_name+'</strong> related info in WikiPedia');
        jQuery('.SearchByTag-popup').css('height',l_height);
        jQuery('.SearchByTag-popup').css({
            top: (pos.top - l_height) + 'px',
            left: (sbt_mouseX-240) + 'px'
        }).toggle();
}
function show_searchByTags_enter(el,tag_name,tag_link){

    var pos = jQuery(el).position();

    fl_link_in = true;
    if (tag_name.length>tag_max_length_google) {
            short_tag_name = tag_name.substr(0,tag_max_length_google)+'...';
        } else  short_tag_name = tag_name;   
        jQuery('.SearchByTag-popup a.sbt-google-search').attr('href','http://www.google.com?cx=partner-pub-9761369273396159:6077738498&ie=UTF-8&q='+encodeURI(tag_name));
        jQuery('.SearchByTag-popup a.sbt-google-search').html('Search <strong>'+short_tag_name+'</strong> on Google');
        jQuery('.SearchByTag-popup a.sbt-wp-search').attr('href',tag_link);
        if (tag_name.length>tag_max_length_wp) {
            short_tag_name = tag_name.substr(0,tag_max_length_wp)+'...';
        } else  short_tag_name = tag_name;  
        jQuery('.SearchByTag-popup a.sbt-wp-search').html('View all posts tagged as <strong>'+short_tag_name+'</strong>');
        jQuery('.SearchByTag-popup a.sbt-wiki-search').attr('href','http://en.wikipedia.org/wiki/'+encodeURI(tag_name));
        if (tag_name.length>tag_max_length_wiki) {
            short_tag_name = tag_name.substr(0,tag_max_length_wiki)+'...';
        } else  short_tag_name = tag_name;   
        jQuery('.SearchByTag-popup a.sbt-wiki-search').html('Find <strong>'+short_tag_name+'</strong> related info in WikiPedia');
        jQuery('.SearchByTag-popup').css('height',l_height);
        jQuery('.SearchByTag-popup').css({
            top:(pos.top - l_height + 10) + 'px',
            left: (sbt_mouseX-240) + 'px'
        }).show();

}
function show_searchByTags_leave(){
    fl_link_in = false;
    setTimeout('hide_popup()',1000);

}

function hide_popup(){
if(!fl_popup_in && !fl_link_in){
        jQuery('.SearchByTag-popup').hide();
    } 
}    

function ie7_css_correct(){
    if ( jQuery.browser.msie ) {
        if( jQuery.browser.version ==7 ){
            jQuery('div.SearchByTag-popup-content ul').css('margin-left','-5px');
            jQuery('div.SearchByTag-popup-content ul li').css('margin-left','0');
        }
    }
}


