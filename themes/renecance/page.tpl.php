<!-- Designed by Gross Design Studio -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language ?>" xml:lang="<?php print $language ?>">

<head>
<title><?php print $head_title ?></title>
<?php print $head ?>
<?php print $styles ?>
<?php print $scripts ?>
<!--[if lt IE 7]>
<style type="text/css" media="all">@import "<?php print base_path() . path_to_theme() ?>/ie.css";</style>
<![endif]-->	
</head>

<body>

<div id="bodyBackground">
  <div id="container">
    <div id="topArnament"></div>
    <div id="allBody">
      <div id="header">
        <div id="logoTopNavigation">
          <?php
          if ($logo) {
		    $site_name = check_plain($site_name);
            print '<a href="'. check_url($base_path) .'" title="'. $site_name .'">';            
			if ($logo) {
              print '<img src="'. check_url($logo) .'" alt="'. $site_name .'" id="logo" />';
            }            
			print '</a>';
			if ($site_name) {
              print '<a href="'. check_url($base_path) .'" title="'. $site_name .'">';            			
			  print '<h1>'. $site_name .'</h1>';
			  print '</a>';			  
			}
			if ($site_slogan) {
			  print '<span> </span><h2>'. $site_slogan .'</h2>';
			}			
          }		  

		  if (isset($primary_links)) { 
	  	    print theme('links', $primary_links, array('id' => 'primarylinks')); 
		  }  
		  ?>
        </div>
        <div id="mainImage"></div>
      </div>
			<?php 
				  if ($center_top) {
				    print '<div id="center-top">';
					print $center_top;
					print '</div>';
				  }
			?>		  
      <div id="<?php 
		if ($sidebar_right) {
			echo 'content-global'; 
		}else{
			echo 'content-stand-alone';
		}?>"><?php print $header ?>
        <div id="<?php 
		if ($sidebar_right) {
			echo 'left'; 
		}else{
			echo 'null';
		}?>">
			<?php if ($mission) { ?><div id="mission"><?php print $mission ?></div><?php } ?>
			<h1 class="title"><?php print $breadcrumb ?><?php print $title ?></h1>
			<?php if($tabs) { ?><div class="tabs"><?php print $tabs ?></div><?php } ?>
			<?php print $help ?>
			<?php print $messages ?>
			<?php print $content; ?>
			<?php print $feed_icons; ?>
        </div>
		<?php if ($sidebar_left or $sidebar_right) { ?>
        <div id="right">	
			<?php 
				  if ($sidebar_right) {
					print $sidebar_right;
				  }
			?>	
        </div>
		<?php } ?>
        <span class="clear"></span>      
		</div>
    </div>
    <div id="bottomArnamentCopyright">
      <?php
	  if (isset($secondary_links)) { 
		print theme('links', $secondary_links, array('id' => 'secondarylinks')); 
		print '<span class="clear"></span>';
	  }			  
	  if($footer_message) {
		print '<p>' . $footer_message . '</p>';
	  }
	  ?>
      <div class="by">Designed by: <a href="http://www.grossdesign.it/">Gross Design Studio</a></div>
    </div>
    <div id="pencil"><img alt="Realizzazione Siti Internet" src="<?php print base_path() . path_to_theme() ?>/images/pencil.png" width="75" height="395" /></div>
  </div>
</div>
<?php print $closure ?>
</body>
</html>