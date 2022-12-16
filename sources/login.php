<?php
header("Cache-Control: no-cache, must-revalidate");

if ($wo['loggedin'] == true) {
  header("Location: https://revolus.com/home");
  exit();
}
$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'welcome';
$wo['title']       = $wo['config']['siteTitle'];
$wo['content']     = Wo_LoadPage('welcome/content');