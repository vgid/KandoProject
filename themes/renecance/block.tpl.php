  <?php if($block->subject) { ?><h2 class="title"><?php print $block->subject; ?></h2><?php } ?>
  <div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="block">
    <div class="content"><div class="padding"><?php print $block->content; ?></div></div>
  </div>
