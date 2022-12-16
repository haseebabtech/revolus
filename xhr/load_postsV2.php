<?php 
if ($f == 'load_postsV2') {
    $load = sanitize_output(Wo_LoadPage('home/load-postsV2'));
    echo $load;
    exit();
}
