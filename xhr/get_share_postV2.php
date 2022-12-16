<?php 
if ($f == 'get_share_postV2') {
    $data['html'] = Wo_LoadPage('lightbox/share_postV2');
    $data['status'] = 200;
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}


