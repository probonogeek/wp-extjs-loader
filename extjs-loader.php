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

    add_action( 'wp_head', array(&$this, 'AddStylesheet'), 1000 );
    add_action( 'wp_head', array(&$this, 'AddJavascript'), 1000 );

  }

  // Stick the stylesheet in the header
  function AddStylesheet() {
    echo '  <link type="text/css" rel="stylesheet" href="' . $this->pluginurl . 'extjs/resources/css/ext-all.css"></link>' . "\n";
  }

  function AddJavascript() {
    echo '  <script type="text/javascript" src="' . $this->pluginurl . 'extjs/adapter/ext/ext-base.js"></script>' . "\n";
    echo '  <script type="text/javascript" src="' . $this->pluginurl . 'extjs/ext-all.js"></script>' . "\n";
  }

}

// Initiate the plugin class
$ExtJSLoader = new ExtJSLoader();

?>