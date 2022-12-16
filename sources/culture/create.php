<?php 
if ($wo['loggedin'] == false || $wo['config']['user_status'] == 0) {
	  header("Location: " . Wo_SeoLink('index.php?link1=welcome'));
	  exit();
}

$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'culture';
$wo['title']       = $wo['lang']['create_culture'];
$wo['content']     = Wo_LoadPage('culture/create');

