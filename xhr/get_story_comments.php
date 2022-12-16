<?php
     $comments = Wo_GetStoryComments($_GET['story_id'],0,0);
    foreach($comments as $wo['comment']) {
	    echo Wo_LoadPage('comment/lightbox-contentV2');
	}
?>