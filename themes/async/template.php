<?php

function phptemplate_stylesheet_import($stylesheet, $media = 'all') {
  if (strpos($stylesheet, 'misc/drupal.css') == 0) {
    return theme_stylesheet_import($stylesheet, $media);
  }
}

function async_preprocess_page(&$vars) {
   $vars['persistent_mission'] = variable_get('site_mission', '');
}

function async_filter_tips_more_info() { return ''; }

function credits(){
  return "<h5><a href=\"http://www.realizzazione-siti-vicenza.com\" title=\"Drupal development, E-commerce\">F</a> &amp; <a href=\"http://www.posizionamentoo.com\" title=\"Posizionamento motori ricerca\">P</a></h5>";
}

?>
