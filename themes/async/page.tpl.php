<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
<title><?php print $head_title ?></title>
<?php print $head ?>
<?php
/**
 * Nodewords doesn't correctly print canonical URL, so I print it by myself.
 */
if ($is_front) { ?>
<link rel="canonical" href="<?php print base_path() ?>" />
<?php } else { ?>
<link rel="canonical" href="<?php global $base_url; print $base_url . "/" . str_replace ( base_path() , "", check_plain(request_uri()) ); ?>" />
<?php } ?>
<?php print $styles ?>
  <link rel="stylesheet" type="text/css" href="web/css/jquery.jcarousel.css" />
  <link rel="stylesheet" type="text/css" href="web/css/tango/skin.css" />
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="<?php print base_path() . path_to_theme(); ?>/ie6.css">
<![endif]-->
<?php print $scripts ?>
  <script type="text/javascript" src="/web/scripts/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" src="/web/scripts/jquery.jcarousel.js"></script>
<script type="text/javascript"><?php /* Needed to avoid Flash of Unstyle Content in IE */ ?> </script>

  <script type="text/javascript">
	$(document).ready(function() {
		$('#mycarousel').jcarousel({
			auto: 5,
			scroll: 1,
			visible: 3,
			buttonNextHTML: null,
			buttonPrevHTML: null,
			animation: 'slow',
			wrap: 'last'
		});
	});
  </script>  

</head>
<body>
<div class="fixed"> <!--FIXED-->
  <?php if($persistent_mission) { ?><div id="mission"> <!--MISSION-->
    <?php print $persistent_mission ?>
  </div> <!--END MISSION--><?php } ?>
  <div id="top"> <!--TOP-->
    <?php if($logo || $site_name || $site_slogan) {?><div id="site-info"> <!--SITE INFO-->
    <?php if($logo) { ?><span id="site-logo"><a href="<?php print $front_page ?>" title="<?php print $site_name ?>"><img src="<?php print $logo ?>" alt="<?php print $site_name ?>" /></a></span><?php } ?>
    </div> <!--END SITE INFO--><?php } ?>
    <?php if(isset($secondary_links)){?><div id="secondary"> <!--SECONDARY LINKS-->
      <?php print theme('links', $secondary_links) ?>
    </div> <!--END SECONDARY LINKS--><?php } ?>
  </div> <!--END TOP-->
	<div id="header"> <!--HEADER-->
    <?php print $header ?>

		<div id="pictures">
			<table>
				<tr height="200" width="100%">
					<td>
						<ul id="mycarousel" class="jcarousel-skin-tango"> 
							<li><img src="/web/images/slideshow/IMGP7785.JPG" width="305" height="200" alt="" /></li> 
							<li><img src="/web/images/slideshow/IMGP7930.JPG" width="305" height="200" alt="" /></li> 
							<li><img src="/web/images/slideshow/IMGP7943.JPG" width="305" height="200" alt="" /></li> 
							<li><img src="/web/images/slideshow/IMGP7951.JPG" width="305" height="200" alt="" /></li> 
							<li><img src="/web/images/slideshow/IMGP8000.JPG" width="305" height="200" alt="" /></li> 
						</ul> 
					</td>				
				</tr>
			</table>
		</div>

  </div>
  <div id="wrapper"> <!--WRAPPER-->
    <div id="page"> <!--PAGE-->

      <div id="preface">
      <div id="preface_first" class="top_block">
		<table cellpadding="10">
			<tr>
				<td align="center">
					<b>My Mission:</b>
				</td>
			</tr>
			<tr>
				<td>
					Some text
				</td>
			</tr>			
		</table>
      </div> 
      <div id="preface_middle" class="top_block">
		<table cellpadding="10">
			<tr>
				<td align="center">
					<b>Why India:</b>
				</td>
			</tr>
			<tr>
				<td>
					Some text
				</td>
			</tr>
		</table>
      </div>
      <div id="preface_last" class="top_block">
		<table cellpadding="10">
			<tr>
				<td align="center">
					<b>About Me:</b>
				</td>
			</tr>
			<tr>
				<td>
					Some text
				</td>
			</tr>			
		</table>
      </div>
      </div>
	  
      <?php if($is_front){ ?><h1 id="title"><?php print $title ?></h1><?php } else { ?><h1 id="title"><a href="<?php global $base_url; print $base_url . "/" . str_replace ( base_path() , "", check_plain(request_uri()) ); ?>" title="<?php print $title ?>"><?php print $title ?></a></h1><?php } ?>
      <?php if($content || $content_bottom){?><div id="container"> <!--CONTAINER-->
        <?php if ($content){ ?><div id="content"> <!--CONTENT-->
          <?php if($tabs){?><div class="tabs">
            <?php print $tabs ?>
          </div><?php } ?>
          <?php if ($show_messages) { print $messages; } ?>
          <?php print $help ?>
          <?php print $content; ?>
        </div> <!--END CONTENT--><?php } ?>
        <?php if ($content_bottom){ ?><div id="content_bottom"> <!--CONTENT BOTTOM-->
          <?php print $content_bottom; ?>
        </div> <!--END CONTENT BOTTOM--><?php } ?>
      </div> <!--END CONTAINER--><?php } ?>
    </div> <!--END PAGE-->
    <div id="sidebar"> <!--SIDEBAR-->
      <?php if(isset($primary_links)){?><div id="primary" class="top_block"> <!--PRIMARY LINKS-->
        <?php print theme('links', $primary_links) ?>
      </div> <!--END PRIMARY LINKS--><?php } ?>
      <?php if ($sidebar_first){ ?><div id="sidebar_first"> <!--SIDEBAR FIRST-->
        <?php print $sidebar_first; ?>
      </div> <!--END SIDEBAR FIRST--><?php } ?>
      <?php if ($sidebar_last){ ?><div id="sidebar_top">&nbsp;</div>
      <div id="sidebar_last"> <!--SIDEBAR LAST-->
        <?php print $sidebar_last; ?>
      </div> <!--END SIDEBAR LAST-->
      <div id="sidebar_bottom">&nbsp;</div><?php } ?>
    </div> <!--END SIDEBAR-->
  </div> <!--END WRAPPER-->
  <?php if($footer){?><div id="footer"> <!--FOOTER-->
    <?php print $footer ?>
  </div> <!--END FOOTER--> <?php } ?>
  <?php if($footer_message){?><div id="footer_message"> <!--FOOTER MESSAGE-->
    <?php print $footer_message ?>
  </div> <!--END FOOTER MESSAGE--> <?php } ?>
  
</div> <!--END FIXED-->
<?php print $closure ?>
</body>
</html>