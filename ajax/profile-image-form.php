

<div class="wrapper">
    	<div class=" overlay-float tsc-ajaxify1">
        <i class=" close-btn fa fa-times fa-lg"></i>
        	<div class="inner-div">
        			
            
              <div class="panel-body">
<form id="upload-photo" method="post" target="preview-iframe" action="<?= get_template_directory_uri() ?>/tsc-inc/upload.php" enctype="multipart/form-data" >
  <div id="preview"><img src="" alt="" /></div>
  <iframe id="preview-iframe" name="preview-iframe" style="display:none;" src=""></iframe>
  <input type="file" name="author_photo" />
  <input type="hidden" id="attachment" name="attachment" value=""/>
  <button type="submit" class="btn-btn-default" id="upload">Upload</button>
</form>
</div>
</div>
</div>
</div><script>
var $preview = $('#preview'),
    $iframe = $('#preview-iframe'),
    $attachment = $('#attachment');

$('#upload').click(function() {
  $iframe.load(function() {
    var img = $iframe.contents().find('img')[0];
    $preview.find('img').attr('src', img.src);
    $attachment.val(img.id);
  });
});

</script>