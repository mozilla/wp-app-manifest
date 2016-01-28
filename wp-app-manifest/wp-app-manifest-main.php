<?php

require_once(plugin_dir_path(__FILE__) . 'wp-app-manifest-db.php');

class WebAppManifest_Main {
  private static $instance;

  public function __construct() {
    add_action('wp_head', array($this, 'add_manifest'));
    add_filter('query_vars', array($this, 'on_query_vars'), 10, 1);
    add_action('parse_request', array($this, 'on_parse_request'));
  }

  public static function init() {
    if (!self::$instance) {
      self::$instance = new self();
    }
  }

  public static function add_manifest() {
    echo '<link rel="manifest" href="' . home_url('/') . '?webappmanifest_file=manifest">';
  }

  public static function on_query_vars($qvars) {
    $qvars[] = 'webappmanifest_file';
    return $qvars;
  }

  public static function on_parse_request($query) {
    if (!array_key_exists('webappmanifest_file', $query->query_vars)) {
      return;
    }

    $file = $query->query_vars['webappmanifest_file'];

    if ($file === 'manifest') {
      header('Content-Type: application/json');
      require_once(plugin_dir_path(__FILE__) . 'lib/manifest.php');
      exit;
    }
  }
}

?>
