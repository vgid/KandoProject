<?php

/* Common Drupal methods definitons using in Artisteer theme export */

/**
 * Generate the HTML representing a given menu with Artisteer style.
 *
 * @param $mid
 *   The block navigation content.
 *
 * @ingroup themeable
 */
function art_navigation_links_worker($content = NULL, $showSubMenus) {
  if (!$content) {
    return '';
  }
  
  $output = $content;
  $menu_str = ' class="menu"';
  if(strpos($output, $menu_str) !== false) {
    $empty_str = '';
    $pattern = '/class="menu"/i';
    $replacement = 'class="art-menu"';
    $output = preg_replace($pattern, $replacement, $output, 1);
    $output = str_replace($menu_str, $empty_str, $output);
  }
  
  $version = phpversion();
  if ($version > 5) {	  
    $output = art_menu_xml_parcer($output, $showSubMenus);
  }
  else {
    $output = preg_replace('~(<a [^>]*>)([^<]*)(</a>)~', '$1<span class="l"></span><span class="r"></span><span class="t">$2</span>$3', $output);
  }
  
  // used to support Menutrails module
  $output = str_replace("active-trail", "active-trail active", $output);
  return $output;
}

function art_menu_xml_parcer($content, $showSubMenus)
{
  $doc = new DOMDocument();
  $doc->loadXML($content);
  $parent = $doc->documentElement;
  $elements = $parent->childNodes;
  
  $nodesToDelete = array();  
  foreach ($elements as $element) {
    if (is_a($element, "DOMElement") && $element->tagName == "li") {
	  $children = $element->childNodes;
	  foreach ($children as $child) {
	    if (is_a($child, "DOMElement") &&($child->tagName == "a")) {
			$caption = $child->nodeValue;
			$child->nodeValue = "";

			$spanL = $doc->createElement("span");
			$spanL->setAttribute("class", "l");
			$spanL->nodeValue = " ";
			$child->appendChild($spanL);

			$spanR = $doc->createElement("span");
			$spanR->setAttribute("class", "r");
			$spanR->nodeValue = " ";
			$child->appendChild($spanR);

			$spanT = $doc->createElement("span");
			$spanT->setAttribute("class", "t");
			$child->appendChild($spanT);

			$spanT->nodeValue = $caption;
		}
		else if (!$showSubMenus) {
		   $nodesToDelete[] = $child;
		}
      }
    }
  }
  
  foreach($nodesToDelete as $node) {
    if ($node != null) {
	  $node->parentNode->removeChild($node);
    }
  }
  
  return $doc->saveHTML();
}

/**
 * Allow themable wrapping of all comments.
 */
function art_comment_woker($content, $type = null) {
  static $node_type;
  if (isset($type)) $node_type = $type;
  return '<div id="comments">'. $content . '</div>';
}

/*
 * Split out taxonomy terms by vocabulary.
 *
 * @param $node
 *   An object providing all relevant information for displaying a node:
 *   - $node->nid: The ID of the node.
 *   - $node->type: The content type (story, blog, forum...).
 *   - $node->title: The title of the node.
 *   - $node->created: The creation date, as a UNIX timestamp.
 *   - $node->teaser: A shortened version of the node body.
 *   - $node->body: The entire node contents.
 *   - $node->changed: The last modification date, as a UNIX timestamp.
 *   - $node->uid: The ID of the author.
 *   - $node->username: The username of the author.
 *
 * @ingroup themeable
 */
function art_terms_worker($node) {
  $output = '';
  if (isset($node->links)) {
    $output = '&nbsp;&nbsp;|&nbsp;';
  }
  $terms = $node->taxonomy;
  
  if ($terms) {
    $links = array();
    ob_start();?><?php
	$output .= ob_get_clean();
    $output .= t('Tags: ');
    foreach ($terms as $term) {
      $links[] = l($term->name, taxonomy_term_path($term), array('rel' => 'tag', 'title' => strip_tags($term->description)));
    }  
    $output .= implode(', ', $links);
    $output .= ', ';
  }
  
  $output = substr($output, 0, strlen($output)-2); // removes last comma with space
  return $output;
}

/**
 * Return a themed set of links.
 *
 * @param $links
 *   A keyed array of links to be themed.
 * @param $attributes
 *   A keyed array of attributes
 * @return
 *   A string containing an unordered list of links.
 */
function art_links_woker($links, $attributes = array('class' => 'links')) {
  $output = '';

  if (count($links) > 0) {
    $output = '';

    $num_links = count($links);
    $index = 0;

    foreach ($links as $key => $link) {
      $class = $key;

      if (strpos ($class, "read_more") !== FALSE) {
        break;
      }
      
      // Automatically add a class to each link and also to each LI
      if (isset($link['attributes']) && isset($link['attributes']['class'])) {
        $link['attributes']['class'] .= ' ' . $key;
      }
      else {
        $link['attributes']['class'] = $key;
      }

      if ($index > 0) {
	    $output .= '&nbsp;&nbsp;|&nbsp;';
	  }
	  
      // Add first and last classes to the list of links to help out themers.
      $extra_class = '';
      if ($index == 1) {
        $extra_class .= 'first ';
      }
      if ($index == $num_links) {
        $extra_class .= 'last ';
      }

	  if ($class) {
        if (strpos ($class, "comment") !== FALSE) {
		  ob_start();?><?php
		  $output .= ob_get_clean();
        }
		else {
		  ob_start();?><?php
		  $output .= ob_get_clean();
        }
      }

      $index++;
      $output .= get_html_link_output($link);
    }
  }
  
  return $output;
}

function get_html_link_output($link) {
  $output = '';
  // Is the title HTML?
  $html = isset($link['html']) && $link['html'];
  
  // Initialize fragment and query variables.
  $link['query'] = isset($link['query']) ? $link['query'] : NULL;
  $link['fragment'] = isset($link['fragment']) ? $link['fragment'] : NULL;

  if (isset($link['href'])) {
    if (get_drupal_version() == 5) {
      $output = l($link['title'], $link['href'], $link['attributes'], $link['query'], $link['fragment'], FALSE, $html);
    }
    else {
      $output = l($link['title'], $link['href'], array('language' => $link['language'], 'attributes'=>$link['attributes'], 'query'=>$link['query'], 'fragment'=>$link['fragment'], 'absolute'=>FALSE, 'html'=>$html));
    }
  }
  else if ($link['title']) {
    if (!$html) {
      $link['title'] = check_plain($link['title']);
    }
    $output = $link['title'];
  }
  
  return $output;
}

/**
 * Format the forum body.
 *
 * @ingroup themeable
 */
function art_content_replace($content) {
  $first_time_str = '<div id="first-time"';
  $article_str = 'class="art-article"';
  $pos = strpos($content, $first_time_str);
  if($pos !== false)
  {
    $output = str_replace($first_time_str, $first_time_str . $article_str, $content);
    $output = <<< EOT
<div class="art-Post">
        <div class="art-Post-tl"></div>
        <div class="art-Post-tr"></div>
        <div class="art-Post-bl"></div>
        <div class="art-Post-br"></div>
        <div class="art-Post-tc"></div>
        <div class="art-Post-bc"></div>
        <div class="art-Post-cl"></div>
        <div class="art-Post-cr"></div>
        <div class="art-Post-cc"></div>
        <div class="art-Post-body">
    <div class="art-Post-inner">
    
<div class="art-PostContent">
    
      $output

    </div>
    <div class="cleared"></div>
    

    </div>
    
        </div>
    </div>
    
EOT;
  }
  else 
  {
    $output = $content;
  }
  return $output;
}

function art_placeholders_output($var1, $var2, $var3) {
  $output = '';
  if (!empty($var1) && !empty($var2) && !empty($var3)) {
    $output .= <<< EOT
      <table class="position" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr valign="top">
          <td width="33%">$var1</td>
          <td width="33%">$var2</td>
          <td>$var3</td>
        </tr>
      </table>
EOT;
  }
  else if (!empty($var1) && !empty($var2)) {
    $output .= <<< EOT
      <table class="position" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr valign="top">
          <td width="33%">$var1</td>
          <td>$var2</td>
        </tr>
      </table>
EOT;
  }
  else if (!empty($var2) && !empty($var3)) {
    $output .= <<< EOT
      <table class="position" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr valign="top">
          <td width="67%">$var2</td>
          <td>$var3</td>
        </tr>
      </table>
EOT;
  }
  else if (!empty($var1) && !empty($var3)) {
    $output .= <<< EOT
      <table class="position" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr valign="top">
          <td width="50%">$var1</td>
          <td>$var3</td>
        </tr>
      </table>
EOT;
  }
  else {
    if (!empty($var1)) {
      $output .= <<< EOT
        <div id="var1">$var1</div>
EOT;
    }
    if (!empty($var2)) {
      $output .= <<< EOT
        <div id="var1">$var2</div>
EOT;
    }
    if (!empty($var3)) {
      $output .= <<< EOT
        <div id="var1">$var3</div>
EOT;
    }
  }
  
  return $output;
}

function art_get_content_cell_style($left, $right, $content) {
  if (!empty($left) && !empty($right))
    return 'art-content';
  if (!empty($right))
    return 'art-content-sidebar1';
  if (!empty($left) > 0)
    return 'art-content-sidebar2';
  return 'content-wide';
}

function art_submitted_worker($submitted, $date, $name) {
  $output = '';
  ob_start();?><?php
  $output .= ob_get_clean();
  $output .= $date;
  $output .= '&nbsp;|&nbsp;';
  ob_start();?><?php
  $output .= ob_get_clean();
  $output .= $name;
  return $output;
}

function is_art_links_set($links) {
  $size = sizeof($links);
  if ($size == 0) {
    return FALSE;
  }
  
  //check if there's "Read more" in node links only  
  $read_more_link = $links['node_read_more'];
  if ($read_more_link != NULL && $size == 1) {
	return FALSE;
  }
  
  return TRUE;
}
