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


       wp_set_object_terms($formId,$_POST['category'],'eventCategory');
    

       if($formId>0){
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

    public function addOrganizerData($organizerData){

        // $finalData = json_encode($organizerData);
        // extract($organizerData);

  
        //          $data = array(
        //              'post_title'     => $name,
        //              'post_content'   =>  $finalData,
        //              'post_type' =>    'ems_organizer_data',
                     
                    
                     

        //          );
     
        //     $formId =  wp_insert_post($data);
         
     
        //     if(!empty($formId)){
        //      wp_send_json_success($id, 200);
        //     }


        extract($organizerData);

//         $data = array(
//             'post_title'     => 'Category Data',
//             'post_content'   =>  $title,
//             'post_type'      =>  'ems_category_data',
//         );
        
//    $formId =  wp_insert_post($data);

  $id =  wp_insert_term($name,'eventOrganizer',array(
    "description" => $details
  ));

//   add_term_meta($id['term_id'],$name,$details);





   if($id['term_id']>0){
    wp_send_json_success($id, 200);
   }
        

    }

    public function updateOrganizerData($id,$organizerData){
        extract($organizerData); //It will extract name , $details
     
      $id = wp_update_term($id,'eventOrganizer', array (
            "name" => $name,
            "slug" => $name,
            "description" => $details
  
        ));

    

    //    $data = update_term_meta( $id["term_id"], $name , $details, $prevValue);

    //     var_dump($details);

        wp_send_json_success($id, 200);


    }

    // public function insertEventCategoryData($id, $categoryData){


    //     $postContent = json_encode($eventData);

    //     extract($eventData);
    //     $data = array(
    //      'ID' => $id,
    //      'post_title'     => $title,
    //      'post_content'   =>  $postContent,
     
         
    //  );
     
    //  $formId =  wp_update_post($data);
         
     
    //  if($formId>0){
    //      return wp_send_json_success(
    //          [
    //              "success" => __("Successfully Edit Data", "event-management-system"),
    //          ],
    //          200);
     
    //      }
    //      else{
    //                   return wp_send_json_error(
    //              [
    //                  "error" => __("Error while updating data", "event-management-system"),
    //              ],
    //              500);
    //      }

    // }

    public function updateEventData($id,$eventData){

        $postContent = json_encode($eventData);

        extract($eventData);
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
         $null = 0;
     var_dump($formId);
     if($formId != 0){
         return wp_send_json_success(
             [
                 "success" => __("Successfully updated Data", "event-management-system"),
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

    //         $data = array(
    //             'post_title'     => 'Category Data',
    //             'post_content'   =>  $title,
    //             'post_type'      =>  'ems_category_data',
    //         );
            
    //    $formId =  wp_insert_post($data);

      $id = wp_insert_term($title,'eventCategory');


   

       if($formId>0){
        wp_send_json_success($id, 200);
       }

     }

     public function getSingleOrganizer($id){
    //    $data = get_term_meta($id,'','true');
    $data = get_term($id);
    // var_dump($data);


    //    $title = array_keys($data); 
    //    $details= $data[$title[0]];
    //    $value = array(
    //     "name" => $title[0],
    //     "details" => $details[0]
    
    //    );
        // var_dump($value);
       wp_send_json_success($data, 200);

     }

     public function updateCategoryData($id, $categoryData){


      

        extract($categoryData);
        $termID = wp_update_term($id,'eventCategory', array (
            "name" => $title,
            "slug" => $title,
           
  
        ));

         
     
     if($termID>0){
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

     public function getAllCategoryData(){
        // $args = array(
        //     'numberposts' => -1,
        //     'orderby' => 'date',
        //     'order' => 'ASC',
        //     'post_type'=>'ems_category_data',
        //     'post_status' => 'any'
        // );
        //   $data =   get_posts($args);
        $data = get_terms( array(
            'taxonomy' => 'eventCategory',
            'hide_empty' => false,
        ) );
        //    var_dump($data);
          
          if (is_wp_error($data)) {
            return false;
        }
        wp_send_json_success($data, 200);
        die();
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

        // $args = array(
        //     'numberposts' => -1,
        //     'orderby' => 'date',
        //     'order' => 'ASC',
        //     'post_type'=>'ems_organizer_data',
        //     'post_status' => 'any'
        // );
        //   $data =   get_posts($args);
        $data = get_terms( array(
            'taxonomy' => 'eventOrganizer',
            'hide_empty' => false,
        ) );
          
          if (is_wp_error($data)) {
            return false;
        }
        wp_send_json_success($data, 200);
        die();

     }

     public function deleteOrganizerData($id){
        
       $delete = wp_delete_term( $id, 'eventOrganizer');

       if($delete == true){
        return wp_send_json_success(
            [
                "message" => __("Successfully delete data", "contact-manager"),
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

        if($delete == true){
         return wp_send_json_success(
             [
                 "message" => __("Successfully delete data", "contact-manager"),
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