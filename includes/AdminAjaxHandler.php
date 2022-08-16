<?php

namespace EMS\Includes;

class AdminAjaxHandler
{
    function __construct()
    {
        foreach ($this->getActions() as $action => $handler) {
            add_action("wp_ajax_{$action}", $handler["function"]);
        }
    }

    function getActions()
    {
        return [
            "ems_insert_event_data" => [
                "function" => [$this, "insertEventData"],
            ],

            "ems_get_event_data" => [
                "function" => [$this, "getEventData"]
            ],
            "ems_get_single_event_data" => [
                "function" => [$this, "getSingleEventData"]
            ],
            "ems_delete_event" => [
                "function" => [$this, "deleteEvent"]
            ],
            "ems_edit_event_data" => [
                "function" => [$this, "editEventData"]
            ]

        ];
    }




    public function insertEventData()
    {
        if (!wp_verify_nonce($_POST["ems_nonce"], "ems_ajax_nonce")) {
            return wp_send_json_error("Busted! Please login!", 400);
        }
   $eventData = array(
   'title' => $_POST['title'],
   'details' => $_POST['details'],
   'category' => $_POST['category'],
   'onlineEvent' => $_POST['onlineEvent'],
   'url' => $_POST['url'],
   'startingDate' => $_POST['startingDate'],
   'startingTime' => $_POST['startingTime'],
   'endingDate' => $_POST['endingDate'],
   'endingTime' => $_POST['endingTime'],
   'limit' => $_POST['limit'],
   'deadline' => $_POST['deadline'],
   );

   $finalData = json_encode($eventData);

   $taxInput = array(
    'category' => $_POST['category'],
   );
 

            $data = array(
                'post_title'     => $_POST['title'],
                'post_content'   =>  $finalData,
                'post_type' =>    'ems_event_data',
                'tax_input' =>     'category',
                // 'meta_input'        => $eventData ,
            );

       $formId =  wp_insert_post($data);
    

       if(!empty($formId)){
        wp_send_json_success($id, 200);

    //   $val =  wp_get_single_post($formId, ARRAY_A);

    //  $content =  json_decode($val['post_content']);
    //  $args = array(
    //     'orderby' => 'date',
    //     'order' => 'ASC',
    //     'post_type'=>'ems_event_data',
    //     'post_status' => 'any'
    // );
    //   $abcd =   get_posts($args);
    //   var_dump( $abcd);

    

        

       
       }
       
   
    }


    public function getEventData(){

           $val =  wp_get_single_post($formId, ARRAY_A);

     $content =  json_decode($val['post_content']);
     $args = array(
        'numberposts' => -1,
        'orderby' => 'date',
        'order' => 'ASC',
        'post_type'=>'ems_event_data',
        'post_status' => 'any'
    );
      $abcd =   get_posts($args);
      
      if (is_wp_error($abcd)) {
        return false;
    }
    wp_send_json_success($abcd, 200);
    die();


    }

    public function getSingleEventData(){

        $id = intval($_GET["id"]);

        // var_dump($id);
        $singleEvent =  wp_get_single_post($id, ARRAY_A);
        if (is_wp_error($singleEvent)) {
            return false;
        }
        wp_send_json_success($singleEvent, 200);
        die();



    }

    public function deleteEvent(){
        $id = intval($_POST["id"]);
        // var_dump($id);
        $delete =wp_delete_post($id);

        if (is_wp_error($delete)) {
            return false;
        }
        wp_send_json_success($delete, 200);
        die();
    }

    public function editEventData(){

        if (!wp_verify_nonce($_POST["ems_nonce"], "ems_ajax_nonce")) {
            return wp_send_json_error("Busted! Please login!", 400);
        }
   $eventData = array(
    'id' => $_POST['id'],
   'title' => $_POST['title'],
   'details' => $_POST['details'],
   'category' => $_POST['category'],
   'onlineEvent' => $_POST['onlineEvent'],
   'url' => $_POST['url'],
   'startingDate' => $_POST['startingDate'],
   'startingTime' => $_POST['startingTime'],
   'endingDate' => $_POST['endingDate'],
   'endingTime' => $_POST['endingTime'],
   'limit' => $_POST['limit'],
   'deadline' => $_POST['deadline'],
   );
   var_dump($eventData);

   $postContent = json_encode($eventData);

   
   $data = array(
    'ID' => $_POST['id'],
    'post_title'     => $_POST['title'],
    'post_content'   =>  $postContent,

    
);

$formId =  wp_update_post($data);
    

if($formId>0){
    return wp_send_json_success(
        [
            "success" => __("Successfully Edit Data", "event-management-system"),
        ],
        200);

    }
    else{
                 return wp_send_json_error(
            [
                "error" => __("Error while updating data", "event-management-system"),
            ],
            500);
    }

}
}