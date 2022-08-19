<?php

namespace EMS\Includes\Frontend;

/**
 * Shortcode handler class
 */
class Shortcode
{

    /**
     * Initializes the class
     */
    function __construct()
    {
        add_shortcode("event-management", [$this, "renderShortcode"]);
    }

    public function loadAssets()
    {
        wp_enqueue_style("ems_frontend_css", EMS_CONTACTS_BASE_DIR . "assets/css/frontend.css");
    }

    /**
     * Shortcode handler class
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function renderShortcode($atts = [], $content = "")
    {
        $atts = shortcode_atts(
            [
                "id" => "",
            ],
            $atts
        );
        $id = $atts["id"];

        if (!empty($atts["id"])) {

            return $this->renderAttributes();
        } else {

            return $this->renderAttributes();
        }
    }

    public function renderAttributes()
    {
        $this->loadAssets();
                    //Load Shortcode View Page
                    ob_start();
                    include EMS_CONTACTS_PATH . "/includes/Views/AttributeRender.php";
                    $content = ob_get_clean();
                    return $content;
    }

}