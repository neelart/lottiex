<?php
namespace Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

// Prevent direct access to files
if (!defined("ABSPATH")) {
    exit();
}

class LottieAnimationLBX extends Widget_Base {

    // Widget name
    public function get_name() {
        return "lottiebox_lottie_animation";
    }

    // // Widget title
    // public function get_title() {
    //     return esc_html__("🥝Lottiex ✨😍✨", "lottiebox JSON Animation");
    // }

    // // Widget icon
    // public function get_icon() {
    //    return 'eicon-lottie'; 
    // }


    // Widget title
public function get_title() {
    return esc_html__("🥝Lottiex ✨😍✨", "lottiebox JSON Animation");
}

// Widget icon
public function get_icon() {
    return 'eicon-lottie';
}


    // Widget categories
    public function get_categories() {
        return ["lottiebox"];
    }

    // Widget keywords
    public function get_keywords() {
        return ["l", "animation", "json", "lottiefiles", "motion", "lottiebox", "bodymoving", "hover", "click", "mouse over out effect", "On Scroll", "Animated", "Lottie", "lo", "Image", "js", "lot", "loti", "dutopia", "pro", "effects", "lotti", "a", ];
    }

    // Widget controls
    protected function register_controls() {
        // Content section
        $this->start_controls_section("content_section", ["label" => esc_html__("lottiebox Animation 😍⭐👌", "lottiebox") , "description" => esc_html__("Instructions for editing this widget...", "lottiebox") , "tab" => Controls_Manager::TAB_CONTENT, ]);

        // Image with hyperlink control
        $this->add_control("lottiebox_notify1", ["type" => Controls_Manager::RAW_HTML, "raw" => '<div style="display: flex; justify-content: space-between;">
    
        <a href="https://codecanyon.net/downloads" target="_blank" style="width: 100%; margin-right: 0px;">
            <img src="https://lottiex.artora.in/0_img/lottix_logo_notif.svg" alt="Image description 2" style="width: 100%; height: auto;">
        </a>
        
    </div>', ]);

        // Image with hyperlink control
        $this->add_control("lottiebox_image_with_hyperlink", [
        //   'label' => esc_html__('Image with Hyperlink', 'lottiebox'),
        "type" => Controls_Manager::RAW_HTML, "raw" => '<div><a href="https://go.artora.in/lbx-web" target="_blank"><img src="' . plugins_url("assets/images/header1.svg", plugin_dir_path(__FILE__)) . '" alt="Button image" style="width: 100%; height: auto;"><div style="height: 20px;"></div><p>Copy animation URL & Paste here👇🏻.</p></a></div>', ]);

        // Lottie animation URL control
        $this->add_control("lbx_json_url", ["type" => Controls_Manager::URL, "placeholder" => esc_html__("Enter your Lottie animation URL", "lottiebox") , "default" => ["url" => "https://framerusercontent.com/assets/k717NQplCBnQaUcqQ5pdMy52o.json", ], ]);

        // Button control
        $this->add_control("lottiebox_buttons", [
        //   'label' => esc_html__('Custom Button', 'lottiebox'),
        "type" => Controls_Manager::RAW_HTML, "raw" => '<div><a href="https://go.artora.in/lbx-web" target="_blank" style="color: grey;"><img src="' . plugins_url("assets/images/lottibox_btn1.svg", plugin_dir_path(__FILE__)) . '" alt="Button image" style="width: 100%; height: auto;"></a></div>', ]);

        $this->add_control("lbx_trigger", ["label" => esc_html__("🥝Animation Trigger", "lottiebox") , "type" => Controls_Manager::SELECT, "default" => "autoplay", "separator" => "before", "options" => ["autoplay" => esc_html__("Auto Play", "lottiebox") , "mouseoverout" => esc_html__("Hover & Out", "lottiebox") , "hover" => esc_html__("Hover", "lottiebox") , "click" => esc_html__("Click", "lottiebox") , "reverse_2nd_click" => esc_html__("Reverse on 2nd Click", "lottiebox") , "on_scroll" => esc_html__("On Scroll", "lottiebox") , "default" => esc_html__("Still", "lottiebox") , ], ]);

        $this->add_control("lbx_scrollbased", ["label" => esc_html__("Scroll Animation", "lottiebox") , "type" => Controls_Manager::SWITCHER, "label_on" => esc_html__("Inline", "lottiebox") , "label_off" => esc_html__("Body", "lottiebox") , "return_value" => "lbx_inline", "default" => "yes", "description" => __('Note: If you select "Body", Animation will start and end based on the whole page\'s height. In Inline, You need to give offset and duration for animation.', "lottiebox") , "separator" => "after", "condition" => ["lbx_trigger" => "on_scroll"], ]);
        $this->add_control("lbx_section_duration", ["label" => esc_html__("Duration", "lottiebox") , "type" => Controls_Manager::SLIDER, "range" => ["px" => ["min" => 50, "max" => 2000, "step" => 1]], "default" => ["unit" => "px", "size" => 500], "condition" => ["lbx_trigger" => "on_scroll", "lbx_scrollbased" => "lbx_inline", ], ]);

        $this->add_control("lbx_section_offset", ["label" => esc_html__("Offset", "lottiebox") , "type" => Controls_Manager::SLIDER, "range" => ["px" => ["min" => - 1000, "max" => 1000, "step" => 1]], "default" => ["unit" => "px", "size" => 0], "condition" => ["lbx_trigger" => "on_scroll", "lbx_scrollbased" => "lbx_inline", ], ]);

        $this->add_control("lbx_custom_time", ["label" => esc_html__("🥝Custom ⌚Time", "lottiebox") , "type" => Controls_Manager::SWITCHER, "label_on" => esc_html__("ON", "lottiebox") , "label_off" => esc_html__("OFF", "lottiebox") , "separator" => "before", "condition" => ["lbx_trigger" => ["hover", "click", "mouseoverout", "on_scroll", ], ], ]);

        $this->add_control("lbx_start_time", ["label" => esc_html__("Start Frame number", "lottiebox") , "type" => Controls_Manager::NUMBER, "min" => 0, "max" => 5000, "step" => 1, "condition" => ["lbx_trigger" => ["hover", "click", "mouseoverout", "on_scroll", ], "lbx_custom_time" => "yes", ], ]);

        $this->add_control("lbx_end_time", ["label" => esc_html__("End Frame number", "lottiebox") , "type" => Controls_Manager::NUMBER, "min" => 0, "max" => 5000, "step" => 1, "condition" => ["lbx_trigger" => ["hover", "click", "mouseoverout", "on_scroll", ], "lbx_custom_time" => "yes", ], ]);

        $this->add_control("loop", ["label" => esc_html__("🥝Animation Stoper", "lottiebox") , "type" => Controls_Manager::SWITCHER, "label_on" => esc_html__("Setting", "lottiebox") , "label_off" => esc_html__("OFF", "lottiebox") , "return_value" => "true", "default" => "false", "separator" => "before", "condition" => ["lbx_trigger!" => "default"], ]);

        $this->add_control("loop_counter", ["label" => esc_html__("Stop after ⏰ ", "lottiebox") , "type" => Controls_Manager::NUMBER, "min" => - 1, "max" => 100, "step" => 1, "description" => esc_html__("This feature will start working when you set the minimum value to 1 for stopping the animation after one cycle.", "lottiebox") , "condition" => ["loop" => "true"], ]);

        $this->add_control("speed", ["label" => esc_html__("🥝Animation Speed", "lottiebox") , "type" => Controls_Manager::SLIDER, "range" => ["x" => ["min" => 0.1, "max" => 1, "step" => 0.1, ], ], "default" => ["unit" => "x", "size" => 1], "condition" => ["lbx_trigger!" => ["default", "on_scroll"]], "separator" => "before", ]);
        $this->add_control("lbx_link_enable", ["label" => esc_html__("🥝Hyperlink on lottie", "lottiebox") , "type" => Controls_Manager::SWITCHER, "label_on" => esc_html__("ON", "lottiebox") , "label_off" => esc_html__("OFF", "lottiebox") , "default" => "no", "separator" => "before", ]);

        // Add a description to the `lbx_link` control
        $this->add_control("lbx_link", ["label" => esc_html__("Link Type", "lottiebox") , "type" => Controls_Manager::SELECT, "default" => "url", "options" => ["url" => esc_html__("🔗URL", "lottiebox") , "page" => esc_html__("🌐My Page", "lottiebox") , ], "separator" => "before", "description" => esc_html__("If enabled, the Lottie animation will be clickable. You can choose between URL and Existing Page for the link.", "lottiebox") , "condition" => ["lbx_link_enable" => "yes"], ]);

        // Add a control for the link URL if the `lbx_link` option is set to `url`
        $this->add_control("lbx_link_url", ["label" => esc_html__("Link URL", "lottiebox") , "type" => Controls_Manager::URL, "dynamic" => ["active" => true], "placeholder" => esc_html__("https://www.demo-link.com", "lottiebox") , "default" => ["url" => "#"], "condition" => ["lbx_link" => "url", "lbx_link_enable" => "yes"], ]);

        // Add a control for the linked page if the `lbx_link` option is set to `page`
        $this->add_control("lbx_link_page", ["label" => esc_html__("Linked Page", "lottiebox") , "type" => Controls_Manager::SELECT2, "options" => $this->get_pages() , "condition" => ["lbx_link" => "page", "lbx_link_enable" => "yes"], ]);

        $this->add_control("lbx_cursor", ["label" => esc_html__("🥝Cursor", "lottiebox") , "type" => Controls_Manager::SWITCHER, "label_on" => esc_html__("ON", "lottiebox") , "label_off" => esc_html__("OFF", "lottiebox") , "default" => "no", "separator" => "before", ]);

        $this->add_control("lbx_cursor_select", ["label" => esc_html__("Select", "lottiebox") , "type" => Controls_Manager::SELECT, "default" => "pointer", "options" => ["pointer" => esc_html__("Default", "lottiebox") , "alias" => esc_html__("Alias", "lottiebox") , "all-scroll" => esc_html__("All Scroll", "lottiebox") , "crosshair" => esc_html__("Crosshair", "lottiebox") , "e-resize" => esc_html__("E Resize", "lottiebox") , "grab" => esc_html__("Grab", "lottiebox") , "help" => esc_html__("Help", "lottiebox") , "wait" => esc_html__("Wait", "lottiebox") , "zoom-in" => esc_html__("Zoom In", "lottiebox") , ], "condition" => ["lbx_cursor" => "yes"], ]);

        // Image with hyperlink control
        $this->add_control("lottiebox_notify2", ["type" => Controls_Manager::RAW_HTML, "raw" => '<div style="display: flex; justify-content: space-between;">
    
        <a href="https://codecanyon.net/downloads" target="_blank" style="width: 100%; margin-right: 0px;">
            <img src="https://lottiex.artora.in/0_img/img_nothing_updater.svg" alt="Image description 2" style="width: 100%; height: auto;">
        </a>
        
    </div>', ]);

        $this->end_controls_section();

        /* Setting option end */

        /*Renderer start*/
        $this->start_controls_section("section_render_option", ["label" => esc_html__("Render JSON", "lottiebox") , "tab" => Controls_Manager::TAB_CONTENT, ]);
        $this->add_control("anim_renderer", ["label" => esc_html__("Render as", "lottiebox") , "type" => Controls_Manager::SELECT, "default" => "svg", "options" => ["svg" => esc_html__("SVG", "lottiebox") , "canvas" => esc_html__("Canvas", "lottiebox") , ], "separator" => "before", ]);
        $this->end_controls_section();
        /*Renderer option end*/

        /*Help Support & Update start*/
        $this->start_controls_section("help_support_update", ["label" => esc_html__("👋🏼Help Support & Update", "lottiebox") , ]);

        // Image with hyperlink control
        $this->add_control("lottiebox_image_help_support_update", ["type" => Controls_Manager::RAW_HTML, "raw" => '<div style="display: flex; justify-content: space-between;">
        <a href="https://go.artora.in/lbx-help" target="_blank" style="width: 50%; margin-right: 10px;">
            <img src="https://lottiex.artora.in/0_img/support_help.svg" alt="Image description 2" style="width: 100%; height: auto;">
        </a>
        
        <a href="https://codecanyon.net/downloads" target="_blank" style="width: 50%; margin-right: 10px;">
            <img src="https://lottiex.artora.in/0_img/support_update.svg" alt="Image description 2" style="width: 100%; height: auto;">
        </a>

    </div>', ]);

        $this->end_controls_section();
        /*Help Support & Update end*/

        /*style start*/

        /* lottiebox Style start */

        $this->start_controls_section("section_lotties_option", ["label" => esc_html__("lottiebox Style", "lottiebox") , "tab" => Controls_Manager::TAB_STYLE, ]);

        // Image with hyperlink control
        $this->add_control("lottiebox_image2_with_hyperlink", ["type" => Controls_Manager::RAW_HTML, "raw" => '<div><img src="' . plugins_url("assets/images/lottibox_style_editor.svg", plugin_dir_path(__FILE__)) . '" alt="Button image" style="width: 100%; height: auto;"></div>', ]);

        // Begin Group Control
        $this->add_group_control(Group_Control_Css_Filter::get_type() , ["name" => "css_filters", "label" => esc_html__("🎨 css filters", "lottiebox") , "selector" => "{{WRAPPER}} .lottieboxs-lotties-animation-wrapper", "separator" => "after", ]);

        // Image with hyperlink control
        $this->add_control("lottiebox_image_promo", [
        //   'label' => esc_html__('Image with Hyperlink', 'lottiebox'),
        "type" => Controls_Manager::RAW_HTML, "raw" => '<div><img src="' . plugins_url("assets/images/color_hint.svg", plugin_dir_path(__FILE__)) . '" alt="Button image" style="width: 100%; height: auto;"></div>', ]);

        $this->add_control("lottie_opacity", ["label" => esc_html__("🎚️ Opacity", "lottiebox") , "type" => Controls_Manager::SLIDER, "range" => ["px" => ["min" => 0, "max" => 1, "step" => 0.1]], "default" => ["unit" => "", "size" => 1], "selectors" => ["{{WRAPPER}} .lottieboxs-lotties-animation-wrapper" => "opacity: {{SIZE}};", ], ]);
        // End Group Control
        // Rotate
        $this->add_control("premium_lottie_rotate", ["label" => esc_html__("💫 Rotate", "lottiebox") , "type" => Controls_Manager::SLIDER, "description" => esc_html__("Set rotation value in degrees", "lottiebox") , "range" => ["px" => ["min" => - 180, "max" => 180]], "default" => ["size" => 0], "selectors" => ["{{WRAPPER}} .lottieboxs-lotties-animation-wrapper" => "transform: rotate({{SIZE}}deg)", ], ]);

        // Position X
        $this->add_responsive_control("lottie_position_x", ["label" => esc_html__("◀️   Left and Right   ▶️", "lottiebox") , "type" => Controls_Manager::SLIDER, "size_units" => ["px", "%"], "range" => ["px" => ["min" => - 1000, "max" => 1000, "step" => 1], "%" => ["min" => - 100, "max" => 100, "step" => 1], ], "default" => ["unit" => "%", "size" => 0], "selectors" => ["{{WRAPPER}} .lottieboxs-lotties-animation-wrapper" => "transform: translateX({{SIZE}}{{UNIT}}) translateY({{lottie_position_y.SIZE}}{{lottie_position_y.UNIT}}) rotate({{premium_lottie_rotate.SIZE}}deg);", ], ]);

        // Position Y
        $this->add_responsive_control("lottie_position_y", ["label" => esc_html__("🔼   UP and Down   🔽", "lottiebox") , "type" => Controls_Manager::SLIDER, "size_units" => ["px", "%"], "range" => ["px" => ["min" => - 1000, "max" => 1000, "step" => 1], "%" => ["min" => - 100, "max" => 100, "step" => 1], ], "default" => ["unit" => "%", "size" => 0], "selectors" => ["{{WRAPPER}} .lottieboxs-lotties-animation-wrapper" => "transform: translateX({{lottie_position_x.SIZE}}{{lottie_position_x.UNIT}}) translateY({{SIZE}}{{UNIT}}) rotate({{premium_lottie_rotate.SIZE}}deg);", ], ]);

        $this->add_responsive_control("content_align", ["label" => esc_html__("Alignment", "lottiebox") , "type" => Controls_Manager::CHOOSE, "options" => ["left" => ["title" => esc_html__("Left", "lottiebox") , "icon" => "fa fa-align-left", ], "center" => ["title" => esc_html__("Center", "lottiebox") , "icon" => "fa fa-align-center", ], "right" => ["title" => esc_html__("Right", "lottiebox") , "icon" => "fa fa-align-right", ], ], "default" => "center", "prefix_class" => "text-%s", "separator" => "before", ]);

        $this->add_responsive_control("max_width", ["label" => esc_html__("Maximum Width", "lottiebox") , "type" => Controls_Manager::SLIDER, "size_units" => ["px", "%"], "range" => ["px" => ["min" => 0, "max" => 1000, "step" => 5], "%" => ["min" => 0, "max" => 100], ], "default" => ["unit" => "%", "size" => 100], "separator" => "before", "render_type" => "ui", "selectors" => ["{{WRAPPER}} .lottieboxs-lotties-animation-wrapper" => "max-width: {{SIZE}}{{UNIT}};", ], ]);

        $this->add_responsive_control("minimum_height", ["label" => esc_html__("Minimum Height", "lottiebox") , "type" => Controls_Manager::SLIDER, "size_units" => ["px", "%"], "range" => ["px" => ["min" => 0, "max" => 1000, "step" => 5], "%" => ["min" => 0, "max" => 100], ], "render_type" => "ui", "selectors" => ["{{WRAPPER}} .lottieboxs-lotties-animation-wrapper" => "min-height: {{SIZE}}{{UNIT}};", ], ]);

        $this->add_responsive_control("lbx_margin", ["label" => esc_html__("Margin", "lottiebox") , "type" => Controls_Manager::DIMENSIONS, "size_units" => ["px", "%", "em"], "selectors" => ["{{WRAPPER}} .lottieboxs-lotties-animation-wrapper" => "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};", ], "separator" => "before", ]);

        // Image with hyperlink control
        $this->add_control("lottiebox_image_help_support_update2", ["type" => Controls_Manager::RAW_HTML, "raw" => '<div style="display: flex; justify-content: space-between;">
        <a href="https://go.artora.in/lbx-help" target="_blank" style="width: 50%; margin-right: 5px;">
            <img src="https://lottiex.artora.in/0_img/support_help.svg" alt="Image description 2" style="width: 100%; height: auto;">
        </a>

        <a href="https://go.artora.in/lbx-contact" target="_blank" style="width: 50%; margin-right: 5px;">
            <img src="https://lottiex.artora.in/0_img/support_contact.svg" alt="Image description 2" style="width: 100%; height: auto;">
        </a>

    </div>', "separator" => "before", ]);

    // Image with hyperlink control
    $this->add_control("lottiebox_footer", ["type" => Controls_Manager::RAW_HTML, "raw" => '<div style="display: flex; justify-content: space-between;">
    
    <a href="https://go.artora.in/lbx-contact" target="_blank" style="width: 100%; margin-right: 0px;">
    <img src="' . plugins_url("assets/images/lottibox_promo1.svg", plugin_dir_path(__FILE__)) . '" alt="Button image" style="width: 100%; height: auto;">
    </a>
    
</div>', "separator" => "before", ]);

        $this->end_controls_section();
        /* lottiebox Style end */

        /*style end*/

        // ⭐ Get pages for lbx_link
        
    }

    public function get_pages() {
        $args = ["post_type" => "page", "posts_per_page" => - 1];

        $pages = get_posts($args);

        $options = [];
        foreach ($pages as $page) {
            $options[$page
                ->ID] = $page->post_title;
        }

        return $options;
    }

    public function json_check_and_validate_html_tag($chk_tag) {
        return in_array(strtolower($chk_tag) , $this->json_html_tag_check_and_verify()) ? $chk_tag : "div";
    }
    protected function render() {
        // Get the settings for display
        $settings = $this->get_settings_for_display();

        // Generate a unique ID for the animation wrapper
        $id = uniqid("lottieboxs-lbx");

        // Set custom start and end times if specified
        $lbx_start_time = $lbx_end_time = "";
        if (!empty($settings["lbx_custom_time"]) && $settings["lbx_custom_time"] == "yes") {
            $lbx_start_time = $settings["lbx_start_time"] != "" ? $settings["lbx_start_time"] : 1;
            $lbx_end_time = $settings["lbx_end_time"] != "" ? $settings["lbx_end_time"] : 100;
        }

        // Set scroll-based animation options
        $lbx_scrollbased = !empty($settings["lbx_scrollbased"]) ? $settings["lbx_scrollbased"] : "lbx_inline";
        $lbx_section_duration = 500;
        if (!empty($settings["lbx_section_duration"]["size"])) {
            $lbx_section_duration = $settings["lbx_section_duration"]["size"];
        }
        $lbx_section_offset = 0;
        if (!empty($settings["lbx_section_offset"]["size"])) {
            $lbx_section_offset = $settings["lbx_section_offset"]["size"];
        }

        // Set loop options
        $loop = - 1;
        if (!empty($settings["loop"]) && $settings["loop"] == "true" && !empty($settings["loop_counter"])) {
            $loop = $settings["loop_counter"];
        }

        // Set maximum width and minimum height options
        $max_width = !empty($settings["max_width"]["size"]) ? $settings["max_width"]["size"] . $settings["max_width"]["unit"] : "100%";
        $minimum_height = !empty($settings["minimum_height"]["size"]) ? $settings["minimum_height"]["size"] . $settings["minimum_height"]["unit"] : "";

        // Set animation speed and action options
        $speed = !empty($settings["speed"]["size"]) ? $settings["speed"]["size"] : "1.0"; // default speed to 1x
        $lbx_trigger = "";

        if (!empty($settings["lbx_trigger"])) {
            $lbx_trigger = $settings["lbx_trigger"];
        }

        // Set animation renderer and content alignment options
        if ($settings["anim_renderer"]) {
            $anim_renderer = esc_attr($settings["anim_renderer"]);
        }
        $content_align = $settings["content_align"];
        $style_atts = $classes = "";
        if ($content_align) {
            $classes .= " align-" . $content_align;
        }
        if (!empty($anim_renderer)) {
            $classes .= " renderer-" . $anim_renderer;
        }
        if (!empty($anim_renderer) && $anim_renderer == "html") {
            $style_atts .= "position: relative;";
        }
        if (!empty($content_align) && $content_align == "right") {
            $style_atts .= "margin-left: auto;";
        }
        elseif (!empty($content_align) && $content_align == "center") {
            $style_atts .= "margin-right: auto;";
            $style_atts .= "margin-left: auto;";
        }

        // Begin setting animation options for Lottie animation wrapper 📐
        $lbx_opt = "";
        if ($settings["lbx_json_url"]["url"] != "") {
            $PATHINFO_EXTENSION = pathinfo($settings["lbx_json_url"]["url"], PATHINFO_EXTENSION);
            if ($PATHINFO_EXTENSION != "json") {
                echo '<h3 class="posts-not-found">' . esc_html__("😱 Uh-oh! It's not a JSON file. 🙈", "lottiebox") . "</h3>";
                return false;
            }
            else {
                // Setting animation parameters 🎬 🪄🌞
                $lbx_opt = 'data-id="' . $id . '"';
                $lbx_opt .= ' data-path="' . $settings["lbx_json_url"]["url"] . '"';
                $lbx_opt .= ' data-loop="' . $loop . '"';
                $lbx_opt .= ' data-anim_renderer="' . $anim_renderer . '"';
                $lbx_opt .= ' data-width="' . $max_width . '"';
                $lbx_opt .= ' data-height="' . $minimum_height . '"';
                $lbx_opt .= ' data-playspeed="' . $speed . '"';
                $lbx_opt .= ' data-play_action="' . $lbx_trigger . '"';
                $lbx_opt .= ' data-lbx_scrollbased="' . $lbx_scrollbased . '"';
                $lbx_opt .= ' data-lbx_section_duration="' . $lbx_section_duration . '"';
                $lbx_opt .= ' data-lbx_section_offset="' . $lbx_section_offset . '"';
                $lbx_opt .= ' data-lbx_start_time="' . $lbx_start_time . '"';
                $lbx_opt .= ' data-lbx_end_time="' . $lbx_end_time . '"';
            }
        }
        else {
            echo '<h3 class="posts-not-found">' . esc_html__("🐲 No Lottie found", "lottiebox") . "</h3>";
            return false;
        }
        // End setting animation options for Lottie animation wrapper 📐
        // Set custom start and end times if specified
        $lbx_start_time = $lbx_end_time = "";
        if (!empty($settings["lbx_custom_time"]) && $settings["lbx_custom_time"] == "yes") {
            $lbx_start_time = $settings["lbx_start_time"] != "" ? $settings["lbx_start_time"] : 1;
            $lbx_end_time = $settings["lbx_end_time"] != "" ? $settings["lbx_end_time"] : 100;
        }

        // Set scroll-based animation options
        $lbx_scrollbased = !empty($settings["lbx_scrollbased"]) ? $settings["lbx_scrollbased"] : "lbx_inline";
        $lbx_section_duration = 500;
        if (!empty($settings["lbx_section_duration"]["size"])) {
            $lbx_section_duration = $settings["lbx_section_duration"]["size"];
        }
        $lbx_section_offset = 0;
        if (!empty($settings["lbx_section_offset"]["size"])) {
            $lbx_section_offset = $settings["lbx_section_offset"]["size"];
        }

        // Generate the HTML output ⭐
        $lbx_op = "";

        // LBX link setting
        if (!empty($settings["lbx_link"]) && $settings["lbx_link"] == "url" && !empty($settings["lbx_link_url"]["url"])) {
            $lbx_op = '<a class="lottiebox-lotties-link" href="' . $settings["lbx_link_url"]["url"] . '">' . $lbx_op;
        }
        elseif (!empty($settings["lbx_link"]) && $settings["lbx_link"] == "page" && !empty($settings["lbx_link_page"])) {
            $lbx_op = '<a class="lottiebox-lotties-link" href="' . get_permalink($settings["lbx_link_page"]) . '">' . $lbx_op;
        }

        // Add the rest of the code
        if (!empty($settings["lbx_cursor"]) && $settings["lbx_cursor"] == "yes" && !empty($settings["lbx_cursor_select"])) {
            $style_atts .= "cursor:" . $settings["lbx_cursor_select"] . ";";
        }
        $lbx_op .= '<div id="' . esc_attr($id) . '" class="lottieboxs-lotties-animation-wrapper lottieboxs-' . esc_attr($id) . " " . $classes . '"  style="' . $style_atts . '" ' . $lbx_opt . ">";
        $lbx_op .= "</div>";

        // Add the closing `a` tag if the `lbx_link` function is enabled
        if (!empty($settings["lbx_link"])) {
            $lbx_op .= "</a>";
        }

        echo $lbx_op;
    }
}

Plugin::instance()
    ->widgets_manager
    ->register(new LottieAnimationLBX());

