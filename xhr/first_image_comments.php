<?php
   $image_id = Wo_GetAlbumImageFromPostId($_GET['post_id']);
    $comments = Wo_GetPostCommentsV2($_GET['post_id'],0,0,$image_id);
    foreach($comments as $wo['comment']) {
	    echo Wo_LoadPage('comment/lightbox-content');
	}
?>