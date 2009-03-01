<?php

/*
Plugin Name: ExtJS Loader
Plugin URI: http://blog.prbonogeek.org
Description: Load ExtJS 2.2.1 libraries into posts when in the ExtJS Category
Version: 0.1
Author: Sean Kellogg
Author URI: http://blog.probonogeek.org
*/

class WpExtJSLoader {

  var $pluginurl;

  function WpExtJSLoader() {

    $this->pluginurl = apply_filters( 'wpextjsloader_url', $wpurl . '/wp-content/plugins/wp-extjs-loader/' );
    $this->load_on_cat_id = 10;

    add_action( 'wp_head', array(&$this, 'MatchCategory'), 1000 );
    add_action( 'wp_head', array(&$this, 'AddStylesheet'), 1000 );
    add_action( 'wp_head', array(&$this, 'AddJavascript'), 1000 );

  }

  function MatchCategory(){

    if ( is_single() ){

      $cats = get_the_category();

      foreach( $cats as $cat ){
        if ($cat->term_id == $this->load_on_cat_id ){
          $this->load_extjs = true;
          return;
        }
      }

    }

    $this->load_extjs = false;

  }

  // Stick the stylesheet in the header
  function AddStylesheet() {

    if ( $this->load_extjs ){
      echo '  <link type="text/css" rel="stylesheet" href="' . $this->pluginurl . 'extjs/resources/css/ext-all.css"></link>' . "\n";
    }

  }

  function AddJavascript() {

    if ( $this->load_extjs ){
      echo '  <script type="text/javascript" src="' . $this->pluginurl . 'extjs/adapter/ext/ext-base.js"></script>' . "\n";
      echo '  <script type="text/javascript" src="' . $this->pluginurl . 'extjs/ext-all.js"></script>' . "\n";
    }

  }

}

// Initiate the plugin class
$WpExtJSLoader = new WpExtJSLoader();

?>