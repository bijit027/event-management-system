<?php

namespace EMS\Includes;

class Models
{
    public function addEventData($eventData){
        $finalData = json_encode($eventData);
        $taxInput = array(
            'category' => $_POST['category'],
        );
        $metaArray = array(
            'eventData' =>  $finalData,
        );
        $data = array(
            'post_title'     => $_POST['title'],
            'post_content'   =>  $finalData,
            'post_type' =>    'ems_event_data',
            'meta_input' => $metaArray,
        );

        $formId =  wp_insert_post($data);
        if(!is_wp_error($formId)){
            return wp_send_json_success(
                [
                    "message" => __("Successfully inserted data", " event-management-system"),
                ],
                200
            );
        }else{
            return wp_send_json_error(
                [
                    "error" => __("Error while inserting data", " event-management-system"),
                ],
                500
            );
        }
    }

    public function fetchSingleEventData($id){
        $singleEvent = get_post_meta($id);
        if (wp_validate_boolean($singleEvent)) {
            return wp_send_json_success($singleEvent,200);
           }else{
            return wp_send_json_error(
                [
                    "error" => __("Error while fetching data", " event-management-system"),
                ],
                500
            );
           }
    }

    public function deleteEventData($id){
        $delete =wp_delete_post($id);

        if (!empty($delete)) {
            return wp_send_json_success(
            [
                "message" => __("Successfully deleted data", " event-management-system"),
            ],
            200
        );
        }else{
            return wp_send_json_error(
            [
                "error" => __("Error while deleting data", " event-management-system"),
            ],
            500
        );
       }
    }

    public function addOrganizerData($organizerData){
        extract($organizerData); //extract $name and $details
        $id =  wp_insert_term($name,'eventOrganizer',array(
            "description" => $details
        ));

        if(!is_wp_error($id)){
            return wp_send_json_success(
                [
                    "message" => __("Successfully inserted data", " event-management-system"),
                ],
                200
            );
        }else{
            return wp_send_json_error(
                [
                    "error" => __("Error while inserting data", " event-management-system"),
                ],
                500
            );
        }  
    }

    public function updateOrganizerData($id,$organizerData){
        extract($organizerData); //It will extract $name , $details
        $formId = wp_update_term($id,'eventOrganizer', array (
            "name" => $name,
            "slug" => $name,
            "description" => $details
  
        ));
    if(!is_wp_error($formId)){
        return wp_send_json_success(
            [
                "message" => __("Successfully edited data", " event-management-system"),
            ],
            200
        );
       }else{
        return wp_send_json_error(
            [
                "error" => __("Error while editing data", " event-management-system"),
            ],
            500
        );
       }
    }

    public function updateEventData($id,$eventData){
        $postContent = json_encode($eventData);
        extract($eventData); //Extract $id, $title , $postContent, $metaArray
        $metaArray = array(
            'eventData' =>  $postContent,
        );
        $data = array(
         'ID' => $id,
         'post_title'     => $title,
         'post_content'   =>  $postContent,
         'meta_input' => $metaArray,        
     );
     
     $formId =  wp_update_post($data);
     if(!is_wp_error($formId)){
         return wp_send_json_success(
             [
                 "message" => __("Successfully updated Data", "event-management-system"),
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

     public function addCategoryData($categoryData){ 
        extract($categoryData);
        $id = wp_insert_term($title,'eventCategory');
        if(!is_wp_error( $id)){
            return wp_send_json_success(
                [
                    "message" => __("Successfully inserted data", " event-management-system"),
                ],
                200
            );
        }else{
            return wp_send_json_error(
                [
                    "error" => __("Error while inserting data", " event-management-system"),
                ],
                500
            );
        }
     }

    public function getSingleOrganizer($id){    
        $data = get_term($id);
        wp_send_json_success($data, 200);
    }

    public function updateCategoryData($id, $categoryData){
        extract($categoryData);
        $termID = wp_update_term($id,'eventCategory', array (
            "name" => $title,
            "slug" => $title,
        ));
        if(!is_wp_error($termID)){
        return wp_send_json_success(
            [
                "message" => __("Successfully Edited Data", "event-management-system"),
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

    public function getAllCategoryData(){
        $data = get_terms( array(
            'taxonomy' => 'eventCategory',
            'hide_empty' => false,
        ));
          
        if (is_wp_error($data)) {
            return false;
        }
        wp_send_json_success($data, 200);
    }

    public function fetchSingleCategory($id){
        $data = get_term($id);
        if($data){
            return wp_send_json_success($data,200);
        
            }
            else{
                return wp_send_json_error(
                [
                    "error" => __("Error while fetching data", "event-management-system"),
                ],
                500);
            }    
    }

    public function getAllOrganizerData(){
        $data = get_terms( array(
            'taxonomy' => 'eventOrganizer',
            'hide_empty' => false,
        ));
        if (is_wp_error($data)) {
            return false;
        }
        wp_send_json_success($data, 200);
    }

    public function deleteOrganizerData($id){
        
       $delete = wp_delete_term( $id, 'eventOrganizer');

        if(!is_wp_error($delete)){
        return wp_send_json_success(
            [
                "message" => __("successfully deleted data", "event-management-system"),
            ],
            200
        );
       }else{
        return wp_send_json_error(
            [
                "error" => __("Error while deleting data", "event-management-system"),
            ],
            500
        );
       }
    }

     public function deleteCategoryData($id){

        $delete = wp_delete_term( $id, 'eventCategory');

        if(!is_wp_error($delete)){
         return wp_send_json_success(
            [
                "message" => __("Successfully deleted data", "contact-manager"),
            ],
             200
         );
        }else{
        return wp_send_json_error(
            [
                "error" => __("Error while deleting data", "event-management-system"),
            ],
            500
         );
        }

    }
}