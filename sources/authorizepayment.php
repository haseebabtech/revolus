<?php 
if ($wo['loggedin'] == false) {
  header("Location: " . Wo_SeoLink('index.php?link1=welcome'));
  exit();
}
$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'payment';
$wo['title']       = $wo['lang']['payment'];
$wo['content']     = Wo_LoadPage('authorizepay/payment');