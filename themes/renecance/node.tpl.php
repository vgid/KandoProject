  <div class="node<?php if ($sticky) { print " sticky"; } print ' '.$zebra; ?><?php if (!$status) { print " node-unpublished"; } ?><?php if($page == 0) { print " node-listing"; } ?>">
    <?php	
	if ($picture) {
      print $picture;
    }?>
    <?php if ($page == 0) { ?><h2 class="title"><a href="<?php print $node_url?>"><?php print $title?></a></h2><?php }; ?>
    <span class="submitted"><?php print $submitted?></span>
    <?php
	if ($terms) {
	?><div class="taxonomy"><?php print $terms?></div><?php
	}
    ?>    
    <div class="content"><?php print $content?></div>

    <?php if ($links) { ?><div class="links"><?php print $links?></div><?php } ?>
  </div>
