<?php
     $comments = Wo_GetPostCommentsV2($_GET['postID'],0,0,$_GET['imageID']);
    foreach($comments as $wo['comment']) {
	    echo Wo_LoadPage('comment/lightbox-content');
	}

?>