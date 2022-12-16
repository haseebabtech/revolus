<?php 
if ($f == 'load_postsV3') {
    $load = sanitize_output(Wo_LoadPage('home/load-postsV3'));
    echo $load;
    exit();
}
