// JavaScript Document
var $ = jQuery.noConflict();
$(document).ready(function(){
	$('.tsc-tabs').tabs();
	$('#upload_logo_button').click(function() {
			tb_show('Upload a logo', 'media-upload.php?referer=wptuts-settings&type=image&TB_iframe=true&post_id=0', false);
			window.send_to_editor = function(html) {
			var image_url = $('img',html).attr('src');
			$('#tsc_logo_url').val(image_url);
			$('#tsc_logo_preview').attr('src',image_url+"?"+Math.random());
			tb_remove();
			}
			return false;
		});
		$('#upload_icon_button').click(function() {
			tb_show('Upload a logo', 'media-upload.php?referer=wptuts-settings&type=image&TB_iframe=true&post_id=0', false);
			window.send_to_editor = function(html) {
			var image_url = $('img',html).attr('src');
			$('#tsc_icon_url').val(image_url);
			$('#tsc_icon_preview').attr('src',image_url+"?"+Math.random());
			tb_remove();
			}
			return false;
		});
		$('#tsc_upload_app_icon_button').click(function() {
			tb_show('Set App Icon', 'media-upload.php?referer=wptuts-settings&type=image&TB_iframe=true&post_id=0', false);
			window.send_to_editor = function(html) {
				$classes = jQuery('img', html).attr('class');
				$id = $classes.replace(/(.*?)wp-image-/, '');
			d = new Date();
			var image_url = $('img',html).attr('src')+"?"+d.getTime();
			$('#tsc_app_icon_id').val($id);
			
			$('#tsc_app_icon_preview').attr('src',image_url);
			//alert(image_url);
			tb_remove();
			}
			return false;
		});
		$('#tsc_logo_url').change(function(){
			$('#tsc_logo_preview').attr('src',$(this).val());
		});
		$('#tsc_icon_url').change(function(){
			$('#tsc_icon_preview').attr('src',$(this).val());
		});
		
		
		
});