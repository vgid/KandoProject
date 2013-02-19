<div class="node<?php if ($sticky) { print " sticky"; } ?><?php if (!$status) { print " node-unpublished"; } ?>">
  <?php if ($page == 0) { ?>
    <h2><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
  <?php } ?>
  <div class="content"><?php print $content?></div>
  <?php // if($node->readmore && ! $page && ! $view ) { ?>
  <?php if($node->readmore && ! $page ) { ?>
  <span class="segue"><?php print l("<span class='none'>Segue</span>", "http://www.realizzazione-siti-vicenza.com/demo-posizionamento" . $node_url, array('html' => TRUE,'attributes' => array('title' => $title)) ); ?></span>
  <?php } ?>
  <?php if ($terms ){ ?>
  <div class="tags"><?php print t("Tags:") . " " . $terms ?></div>
  <?php }?>
</div>