<?php
drupal_add_css(base_path() . path_to_theme() . '/print.css', 'module', 'print');

function renecance_regions() {
  return array(
    'sidebar_right' => t('sidebar right'),
	'center_top' => t('center top'),
  );
}

function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    $separator = ' / ';
    return implode($separator, $breadcrumb) . $separator;
  }
}
?>