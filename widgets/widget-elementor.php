<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Rounded_Image_Slider_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'rounded-image-slider';
    }

    public function get_title() {
        return __('Rounded Image Slider', 'your-text-domain');
    }

    public function get_icon() {
        return 'eicon-image-slider';
    }

    public function get_categories() {
        return ['basic'];
    }
    public function get_style_depends() {
        return ['style.css'];
    }
    protected function _register_controls() {
        $this->start_controls_section(
            'section_images',
            [
                'label' => __('Images', 'your-text-domain'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __('Image', 'your-text-domain'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'your-text-domain'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'your-text-domain'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => __('Images', 'your-text-domain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ image.url }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

<div class="rounded-image-slider">
            <div class="slick-slider">
                <?php foreach ($settings['images'] as $index => $item): ?>
                    <div class="image-container">
                        <a href="<?php echo esc_url($item['link']['url']); ?>">
                            <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>">
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <script>
            jQuery(document).ready(function($) {
                // Initialize Slick slider
                $('.slick-slider').slick({
                    slidesToShow: 4, // Number of slides to show at a time
                    slidesToScroll: 1, // Number of slides to scroll at a time
                    autoplay: true, // Enable autoplay
                    autoplaySpeed: 2000, // Autoplay speed in milliseconds
                    dots: true, // Show dots navigation
                    arrows: true, // Show arrows navigation
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        }
                    ]
                });
            });
        </script>
        <?php
    }
}
