<?php
$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'notebook';
$wo['title']       = $wo['lang']['notebook'] . ' | ' . $wo['config']['siteTitle'];
$wo['content']     = Wo_LoadPage('notebook/content');