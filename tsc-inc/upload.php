<?php
define('WP_USE_THEMES', false);
require_once '../../../../wp-load.php';
require_once(ABSPATH .'wp-admin/includes/image.php');
require_once(ABSPATH .'wp-admin/includes/file.php');
require_once(ABSPATH .'wp-admin/includes/media.php');

if (isset($_POST['attachment'])) {
  wp_delete_attachment($_POST['attachment'], true);
}

foreach ($_FILES as $file => $data) {
  if ($data['error'] === UPLOAD_ERR_OK) {
    $attachment = media_handle_upload($file, null);
  }
}

echo wp_get_attachment_image($attachment, 'profile_image_full', 0, array('id' => $attachment, 'class'=>"img-responsive"));
?>
<script>

	
		window._init();

</script>
