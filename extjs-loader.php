<?php

/*
Plugin Name: ExtJS Loader
Plugin URI: http://blog.prbonogeek.org
Description: Load ExtJS libraries into posts when in the ExtJS Category
Version: 0.1
Author: Sean Kellogg
Author URI: http://blog.probonogeek.org
*/

class ExtJSLoader {

  var $pluginurl;

  function ExtJSLoader() {

    $this->pluginurl = apply_filters( 'extjsloader_url', $wpurl . '/wp-content/plugins/extjs-loader/' );
    $this->load_on_cat_id = 10;

    add_action( 'wp_head', array(&$this, 'MatchCategory'), 1000 );
    add_action( 'wp_head', array(&$this, 'AddStylesheet'), 1000 );
    add_action( 'wp_head', array(&$this, 'AddJavascript'), 1000 );

  }

  function MatchCategory(){

    $cats = get_the_category( the_ID() );

    foreach( $cats as $cat ){
      if ($cat->term_id == $this->load_on_cat_id ){
        $this->load_extjs = true;
        return;
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
$ExtJSLoader = new ExtJSLoader();

?>