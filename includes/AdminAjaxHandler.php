<?php

namespace EMS\Includes;

class AdminAjaxHandler extends Models
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
                "function" => [$this, "insertEventData"]
            ],
            "ems_insert_event_category_data" => [
                "function" => [$this, "insertEventCategoryData"]
            ],
            "ems_get_event_category_data" => [
                "function" => [$this, "getEventCategoryData"]
            ],
            "ems_insert_event_organizer_data" => [
                "function" => [$this, "insertEventOrganizerData"]
            ],
            "ems_get_organizer_data" => [
                "function" => [$this, "getOrganizerData"]
            ],
            "ems_get_single_category_data" => [
                "function" => [$this, "getSingleCategoryData"]
            ],
            "ems_get_single_organizer_data" => [
                "function" => [$this, "getSingleOrganizerData"]
            ],
            "ems_delete_organizer" => [
                "function" => [$this, "deleteOrganizer"]
            ],
            "ems_delete_category" => [
                "function" => [$this, "deleteCategory"]
            ],
            "ems_insert_registration_data" => [
                "function" => [$this, "insertRegistrationData"]
            ],
            "ems_get_event_registration_data" => [
                "function" => [$this, "getRegistrationData"]
            ],
            "ems_get_single_registration_data" => [
                "function" => [$this, "getSingleRegistrationData"]
            ],
            
            
            

        ];
    }


    public function insertEventData()
    {
        if (!wp_verify_nonce($_POST["ems_nonce"], "ems_ajax_nonce")) {
            return wp_send_json_error("Busted! Please login!", 400);
        }

        $value = ["title", "details", "category","organizer", "onlineEvent", "url", "startingDate",
                "startingTime","endingDate","endingTime","location","limit","deadline"];
        $field_keys = $this->handleEmptyField($value);
        $eventData = $this->senitizeInputValue($field_keys);

        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            parent::updateEventData($id, $eventData);
        } else {
            parent::addEventData($eventData);
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
            'post_status' => 'any',
        );
        $data =   get_posts($args);
        if (is_wp_error($data)) {
            return false;
    }
        wp_send_json_success($data, 200);
    }

    public function getSingleEventData(){
        $id = intval($_GET["id"]);
        parent::fetchSingleEventData($id);
    }

    public function deleteEvent(){
        $id = intval($_POST["id"]);
        parent::deleteEventData($id);
    }

    public function getSingleCategoryData(){
        $id = intval($_GET["id"]);

        parent::fetchSingleCategory($id);
    }
    public function insertEventCategoryData(){
        if (!wp_verify_nonce($_POST["ems_nonce"], "ems_ajax_nonce")) {
            return wp_send_json_error("Busted! Please login!", 400);
        }

        $value = ["title"];
        $field_keys = $this->handleEmptyField($value);
        $categoryData = $this->senitizeInputValue($field_keys);

        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            parent::updateCategoryData($id, $categoryData);
        } else {
            parent::addCategoryData($categoryData);
        }

    }

    public function getEventCategoryData(){
        parent::getAllCategoryData();
    }

    public function insertEventOrganizerData(){

        if (!wp_verify_nonce($_POST["ems_nonce"], "ems_ajax_nonce")) {
            return wp_send_json_error("Busted! Please login!", 400);
        }

        $value = ["name","details"];
        $field_keys = $this->handleEmptyField($value);
        $organizerData = $this->senitizeInputValue($field_keys);
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $prevValue = sanitize_text_field($_POST['prevValue']);
            parent::updateOrganizerData($id, $organizerData, $prevValue);
        } else {
            parent::addOrganizerData($organizerData);
        }
    }

    public function getOrganizerData(){
        parent::getAllOrganizerData();
    }

    public function deleteOrganizer(){
        $id = intval($_POST["id"]);
        parent::deleteOrganizerData($id);

    }

    public function getSingleOrganizerData(){
        $id = intval($_GET["id"]);
        parent::getSingleOrganizer($id);
    }

    public function deleteCategory(){
        $id = intval($_POST["id"]);
        parent::deleteCategoryData($id);
    }

    public function insertRegistrationData(){

        $value = ["eventId", "eventTitle", "name","email"];
        $field_keys = $this->handleEmptyField($value);
        $registrationData = $this->senitizeInputValue($field_keys);

        parent::addRegistrationData($registrationData); 
        
    }

    public function getRegistrationData(){
        parent::fetchRegistrationData();
    }

    public function getSingleRegistrationData(){
        $id = intval($_GET["id"]);
        parent::fetchSingleRegistrationData($id);

    }

    public function senitizeInputValue($field_keys)
    {
        $inputValue = $field_keys;
        $data = [];
        foreach ($inputValue as $field_key) {
            if($field_key == 'details'){
                if(sanitize_textarea_field($_POST[$field_key]) != '' ){
                $data[$field_key] = sanitize_textarea_field($_POST[$field_key]);
                }else{
                    $this->sanitizationError($field_key);
                }
            }elseif($field_key == 'url'){
                if(sanitize_url($_POST[$field_key]) != '' ){
                    $data[$field_key] = sanitize_url($_POST[$field_key]);
                }else{
                    $this->sanitizationError($field_key);
                }
            }
            else{
                if(sanitize_text_field($_POST[$field_key]) != '' ){
                    $data[$field_key] = sanitize_text_field($_POST[$field_key]);
                }else{
                    $this->sanitizationError($field_key);
                }
            }
        }
        
        return $data;
    }

    public function handleEmptyField($value)
    {
        $inputValue = $value;
        $errors = [];
        foreach ($inputValue as $field_key) {
            if (empty($_POST[$field_key])) {
                $errors[$field_key] = "Please enter " . $field_key;
            }
        }
        if (!empty($errors)) {
            return wp_send_json_error($errors, 400);
        }
        return $inputValue;
    }

    public function sanitizationError($field_key){
        return wp_send_json_error(
            [
                $field_key => __('Something suspicious in '.$field_key, " event-management-system"),
            ],
            400);
    }
    
   
}