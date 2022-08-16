<?php

namespace EMS\Includes;

class Admin
{
  function __construct()
  {
    add_action('admin_menu', [$this, 'addMenu']);
  }

  public function addMenu()
  {
    $hook = add_menu_page(
      __('Event Management', 'event-management-system'),
      __('Event Management', 'event-management-system'),
      'manage_options',
      'event-management-system',
      [$this, 'adminMenuPage'],
      'dashicons-text',
      10
    );

    add_submenu_page(
        'event-management-system',
        __('ALL Events', 'event-management-system'),
        __('ALL Events', 'event-management-system'),
        'manage_options',
        'event-management-system',
        [$this, 'adminMenuPage']
    );

    $addEvent = add_submenu_page(
        "event-management-system",
        __("Add Event", "event-management-system"),
        __("Add Event", "event-management-system"),
        "manage_options",
        "event-management-system#/addEvent",
        [$this, "adminMenuPage"]
    );

    add_action("load-" . $hook, [$this, "initHooks"]);
    add_action("load-" . $addEvent, [$this, "initHooks"]);


  }

  public function initHooks()
  {
    add_action('admin_enqueue_scripts', [$this, 'enqueueScripts']);
  }

  public function adminMenuPage()
  {
    echo '<div id="ems-admin-app"></div>';
  }

  public function enqueueScripts()
  {
    // wp_enqueue_style('wpsfb-admin-style');
    wp_enqueue_style("ElementPlus");
    wp_enqueue_script('ems-admin-script');
  }
}