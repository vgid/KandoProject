	<?php // $Id$

/**
 * @file
 * Main template file
 *
 * @see template_preprocess_page(), preprocess/preprocess-page.inc
 * http://api.drupal.org/api/function/template_preprocess_page/6
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">
    <head>
      <?php print $head; ?>
      <title><?php print $head_title; ?></title>
      <?php print $styles; ?>
      <?php print $ie_styles; ?>
      <?php print $scripts; ?>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="/web/scripts/jquery.jWizard.js"></script>
	<script type="text/javascript" src="/web/scripts/easySlider1.5.js" type="text/javascript"></script>
	<script language="javascript">
              var i = 1;
		$(document).ready(function() {
		   $('#wizard').jWizard({
				hideCancelButton: true,
				hideButtons: true
			});
		   $('.slidershow').easySlider();
		});

		function goBack() {
		    var jWizard = $('#wizard').data('jWizard');
		    i--;
		    document.getElementById("nextbutton").style.visibility = "visible";
		    document.getElementById("nextbuttontop").style.visibility = "visible";
		    if (i < 1) {
		      i = 1;
		      document.getElementById("backbutton").style.visibility = "hidden";
		      document.getElementById("backbuttontop").style.visibility = "hidden";
		    } else {
		      document.getElementById("backbutton").style.visibility = "visible";
		      document.getElementById("backbuttontop").style.visibility = "visible";
		    }
		    jWizard.changeStep(i-1);
		}

		function goNext() {
	           var jWizard = $('#wizard').data('jWizard');
		    i++;
		    document.getElementById("backbutton").style.visibility = "visible";
		    document.getElementById("backbuttontop").style.visibility = "visible";
		    if (i >= 15) {
		      i = 15;
		      document.getElementById("nextbutton").style.visibility = "hidden";
		      document.getElementById("nextbuttontop").style.visibility = "hidden";
		    } else {
		      document.getElementById("nextbutton").style.visibility = "visible";
		      document.getElementById("nextbuttontop").style.visibility = "visible";
		    }
		    jWizard.changeStep(i-1);
		}
	</script>
	<style>
		#slider28 li{ 
			height:450px;
			overflow:hidden; 
			width:640px;
		}

		#slider42 li{ 
			height:450px;
			overflow:hidden;
			width:628px; 
		}

		#slider46 li{ 
			height:280px;
			width:388px;
			overflow:hidden; 
		}

		#slider47 li{ 
			height:500px;
			width:750px;
			overflow:hidden; 
		}

		#slider48 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider49 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider51 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider52 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider53 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider54 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider55 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider56 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider57 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider58 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider59 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider60 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider61 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider62 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider63 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider64 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}
		
		#slider65 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}
		
		#slider66 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}	

		#slider67 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider68 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider69 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider70 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider71 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}

		#slider72 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}	

		#slider73 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}	
		
		#slider75 li{ 
			height:420px;
			width:628px;
			overflow:hidden; 
		}			
	</style>		
    </head>
  <body<?php print $attributes; ?>>
  <?php if (!empty($admin)) print $admin; // support for: http://drupal.org/project/admin ?>
  <div id="wrapper">
<?php if (!drupal_is_front_page()) { ?>
    <div<?php print $header_attributes; ?>>
      <div id="header-inner">
        <?php if ($logo): ?>
        <a href="<?php print $base_path; ?>" title="<?php print $site_name; ?>" id="logo"><img src="<?php print $logo; ?>" alt="<?php if ($site_name): print $site_name;  endif; ?>" /></a>
        <?php endif; ?>
        <?php if ($site_name): ?>
        <span id="site-name"> <a href="<?php print $base_path; ?>" title="<?php print $site_name; ?>"><?php print $site_name; ?></a> </span>
        <?php endif; ?>
        <?php if ($site_slogan): ?>
          <span id="site-slogan"><?php print $site_slogan; ?></span>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($primary_links): ?>
      <div id="navigation"><?php print $primary_links; ?></div>
    <?php endif; ?>
<?php } ?>

    <div id="container" class="layout-region">
      <?php if ($left): ?>
        <div id="sidebar-left" class="sidebar">
          <div class="inner">
            <?php print $left; ?>
          </div>
        </div>
      <!-- END HEADER -->
      <?php endif; ?>
      <div id="main">
        <div class="main-inner">
          <?php if ($breadcrumb): ?>
            <div class="breadcrumb clearfix"><?php print $breadcrumb; ?></div>
          <?php endif; ?>
          <?php if ($show_messages && $messages != ""): ?>
          <?php print $messages; ?>
          <?php endif; ?>
          <?php if ($is_front && $mission): ?>
            <div class="mission"><?php print $mission; ?></div>
          <?php endif; ?>
          <?php if ($contenttop): ?>
            <div id="content-top"><?php print $contenttop; ?></div>
            <!-- END CONTENT TOP -->
          <?php endif; ?>


          <?php if ($title): ?>
            <h1 class="title"><?php print $title; ?></h1>
          <?php endif; ?>
          <?php if ($help): ?>
            <div class="help"><?php print $help; ?></div>
          <?php endif; ?>
          <?php print $tabs; ?>
          <div id="content" class="clearfix">
            <?php print $content; ?>
          </div>
          <!-- END CONTENT -->
          <?php if ($contentbottom): ?>
            <div id="content-bottom"><?php print $contentbottom; ?></div>
          <?php endif; ?>
        </div>
        <!-- END MAIN INNER -->
      </div>
      <!-- END MAIN -->
      <?php if ($right): ?>
        <div id="sidebar-right" class="sidebar">
          <div class="inner">
          <?php print $right; ?>
          </div>
        </div>
      <!-- END SIDEBAR RIGHT -->
      <?php endif; ?>
    </div>
    <!-- END CONTAINER -->
    <div class="push">&nbsp;</div>
  </div>
  <!-- END WRAPPER -->
  <div id="footer" class="layout-region">
    <div id="footer-inner">
      <?php print $contentfooter; ?>
      <?php print $footer_message; ?>
    </div>
  </div>
  <?php print $closure; ?>
  </body>
</html>