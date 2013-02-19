<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2002/REC-xhtml1-20020801/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>">
<head>
  <title><?php print $head_title ?></title>
  <?php print $head ?>
  <?php print $styles ?>
  <!--[if IE]>
    <link type="text/css" rel="stylesheet" media="all" href="<?php print $base_path . $directory; ?>/ie.css"/>
  <![endif]-->
  <!--[if IE 6]>
    <link type="text/css" rel="stylesheet" media="all" href="<?php print $base_path . $directory; ?>/ie6.css"/>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="web/css/style.css" /> 
  <link rel="stylesheet" type="text/css" href="web/css/jquery.jcarousel.css" />
  <link rel="stylesheet" type="text/css" href="web/css/tango/skin.css" />
  <?php print $scripts ?>
  <script type="text/javascript" src="/web/scripts/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="/web/scripts/jquery.jcarousel.js"></script>
  <script type="text/javascript">
	$(document).ready(function() {
		$('#mycarousel').jcarousel({
			auto: 5,
			scroll: 1,
			visible: 1,
			buttonNextHTML: null,
			buttonPrevHTML: null,
			animation: 'slow',
			wrap: 'last'
		});
	});
  </script>  
  
  
</head>

<body class="<?php print $body_classes; ?>">

  <?php if ($primary_links) {?> 
    <div id="primary">
    <?php print preg_replace('/<a (.*?)>(.*?)<\\/a>/i','<a \\1><span>\\2</span></a>',theme('links', $primary_links, array('class' =>'links', 'id' => 'navlist'))); ?></div>
  <?php } ?>

    <div id="header-region">
      <?php print $header ?>
    </div>
	<div id="header">
		<div id="h2">
			<table width="950" height="350" border="1">
				<tr>
					<td width="500">
						<?php if ($logo) { ?><a href="<?php print $front_page ?>" title="<?php print t('Home') ?>"><img src="<?php print $logo ?>" alt="<?php print t('Home') ?>" /></a><?php } ?>
					</td>
					<td>
						<ul id="mycarousel" class="jcarousel-skin-tango"> 
							<li><img src="/web/images/IMGP7785.JPG" width="450" height="300" alt="" /></li> 
							<li><img src="/web/images/IMGP7930.JPG" width="450" height="300" alt="" /></li> 
							<li><img src="/web/images/IMGP7943.JPG" width="450" height="300" alt="" /></li> 
							<li><img src="/web/images/IMGP7951.JPG" width="450" height="300" alt="" /></li> 
							<li><img src="/web/images/IMGP8000.JPG" width="450" height="300" alt="" /></li> 
						</ul> 
					</td>
				</tr>
			</table>
		</div>
	</div>
	
 <div id="wrapper">
  
    <?php if ($left) {
 ?>
      <div id="sidebar-left" class="clearfix">
      <?php print $left ?>
      </div>
    <?php } ?>

    <div id="main" class="clearfix"><div id="main-inner"><div id="main-inner2">
      <?php if ($mission) {
 ?><div id="mission"><?php print $mission ?></div><?php } ?>
      <div class="inner">
        <?php print $breadcrumb ?>
        <h1 class="title"><?php print $title ?></h1>
        <?php if ($tabs){
 ?><div class="tabs"><?php print $tabs ?></div><?php } ?>
        <?php print $help ?>
        <?php if ($show_messages && $messages) print $messages; ?>
        <?php print $content; ?>
        <?php print $feed_icons; ?>
      </div>
    </div></div></div>

    <?php if ($right): ?>
      <div id="sidebar-right" class="clearfix">
      <?php print $right ?>
      </div>
    <?php endif; ?>
    <br clear="all"/>
    <span class="clear"></span>
  </div>

  <br clear="all"/>
  <div id="footer">
  <?php print $footer; ?>
  <?php print $footer_message;?><br/>
    <a href="http://www.rockettheme.com/Templates/Free_Templates/Novus_-_Free_Joomla_Template/">Theme</a> <a href="http://www.avioso.com">port</a> sponsored by <a href="http://www.duplika.com">Duplika Hosting</a>.
  <?php print $closure ?>
  </div>
</body>
</html>
