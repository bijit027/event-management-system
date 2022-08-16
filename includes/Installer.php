<?php

namespace EMS\Includes;

class Installer
{
  function __construct()
  {
    add_action( 'init', 'wporg_register_taxonomy_course' );
  }

  public function run()
  {
    $this->add_version();
    
  }

 public function wporg_register_taxonomy_course() {
  $args = array(
    'capability_type' => 'post',
    'public'          => false,
    'show_ui'         => false,
);
register_post_type( 'ems_system', $args );



  }
  public function add_version()
  {
    $is_installed = get_option('ems_is_installed');
    if (!$is_installed) {
      update_option('ems_is_installed', time());
    }
    update_option('ems_is_installed', EMS_VERSION);
  }
}