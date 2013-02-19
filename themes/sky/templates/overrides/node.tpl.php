<?php
// $Id$

/**
 * @file
 * Outputs contents of nodes
 *
 * @see template_preprocess_node(), preprocess/preprocess-node.inc
 * http://api.drupal.org/api/function/template_preprocess_node/6
 */
?>
<div<?php print $attributes; ?>>
 
  <div class="content clearfix">
	<font size="2.5">
	<?php print $content; ?>
	</font>
  </div>
  <?php if ($links): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
  <?php endif; ?>
</div>