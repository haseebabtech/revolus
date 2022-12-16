<?php
if ($wo['loggedin'] == false) {
	  header("Location: " . Wo_SeoLink('index.php?link1=welcome'));
	  exit();
}
$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'authorizepayment';
$wo['title']       = $wo['lang']['authorizepayment'];
$wo['content']     = Wo_LoadPage('authorizepay/authorizepayment');