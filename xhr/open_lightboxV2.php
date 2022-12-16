<?php 
if ($f == 'open_lightboxV2') {
    $html = '';
    if (!empty($_GET['post_id'])) {
        $wo['story'] = Wo_PostDataV2($_GET['post_id']);
        if (!empty($wo['story'])) {
           $html = Wo_LoadPage('lightbox/content');
        }
    }
    $data = array(
        'status' => 200,
        'html' => $html
    );
    header("Content-type: application/json");
    echo json_encode($data);
    exit();
}
