<?php

namespace EMS\Includes;

class Assets
{
  function __construct()
  {
    if (is_admin()) {
      add_action('admin_enqueue_scripts', [$this, 'register']);
    } else {
      add_action('wp_enqueue_scripts', [$this, 'register']);
    }
  }

  public function register()
  {
    $this->register_scripts($this->get_scripts());
    wp_localize_script("ems-admin-script", "ajax_url", [
      "ajaxurl" => admin_url("admin-ajax.php"),
      "ems_nonce" => wp_create_nonce("ems_ajax_nonce"),
  ]);
  wp_localize_script("ems_frontend_script", "ajax_url", [
    "ajaxurl" => admin_url("admin-ajax.php"),
    "ems_frontend_nonce" => wp_create_nonce("ems_ajax_frontend_nonce"),
]);
    $this->register_styles($this->get_styles());
  }

  private function register_scripts($scripts)
  {
    foreach ($scripts as $handle => $script) {
      $deps      = isset($script['deps']) ? $script['deps'] : false;
      $in_footer = isset($script['in_footer']) ? $script['in_footer'] : false;
      $version   = isset($script['version']) ? $script['version'] : EMS_VERSION;

      wp_register_script($handle, $script['src'], $deps, $version, $in_footer);
    }
  }

  public function register_styles($styles)
  {
    foreach ($styles as $handle => $style) {
      $deps = isset($style['deps']) ? $style['deps'] : false;

      wp_register_style($handle, $style['src'], $deps, EMS_VERSION);
    }
  }

  public function get_scripts()
  {
    return [
      'ems-admin-script' => [
        'src' => EMS_ASSETS . '/admin/admin.js',
        'deps'      => null,
        'version' => filemtime(EMS_PLUGIN_PATH . '/assets/admin/admin.js'),
        'in_footer' => true
      ],
      "ems_frontend_script" => [
        "src" => EMS_CONTACTS_BASE_DIR . "assets/js/eventCard.js",
        "deps" => ["jquery"],
        "version" => filemtime(EMS_PLUGIN_PATH . "assets/js/eventCard.js"),
        "in_footer" => true,
    ],
    ];
  }

  public function get_styles()
  {
    return [
      "ElementPlus" => [
        "src" => EMS_ASSETS . "/ElementPlus/index.css",
    ],
    ];
  }
}