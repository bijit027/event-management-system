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

    $addEventCategory = add_submenu_page(
        "event-management-system",
        __("Event Categories", "event-management-system"),
        __("Event Categories", "event-management-system"),
        "manage_options",
        "event-management-system#/eventCategory",
        [$this, "adminMenuPage"]
    );
    $addEventOrganizer = add_submenu_page(
      "event-management-system",
      __("Event Organizer", "event-management-system"),
      __("Event Organizer", "event-management-system"),
      "manage_options",
      "event-management-system#/eventOrganizer",
      [$this, "adminMenuPage"]
  );

    add_action("load-" . $hook, [$this, "initHooks"]);
    add_action("load-" . $addEventCategory, [$this, "initHooks"]);
    add_action("load-" . $addEventOrganizer, [$this, "initHooks"]);


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