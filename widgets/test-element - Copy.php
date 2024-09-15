<?php
namespace MybloggerCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Test_Element extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'test-element';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('test', 'myblogger-core');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['myblogger-category'];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends()
	{
		return ['myblogger-core'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->register_controls_section();
		$this->style_tab_content();


	}

	protected function register_controls_section()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'myblogger-core'),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __('Title', 'myblogger-core'),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'item_description',
			[
				'label' => esc_html__('Description', 'textdomain'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__('Default description', 'textdomain'),
				'placeholder' => esc_html__('Type your description here', 'textdomain'),
			]
		);

		$this->add_control(
			'hero_image',
			[
				'label' => esc_html__('Choose Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'myblogger_button_content',
			[
				'label' => __('Button', 'myblogger-core'),
			]
		);

		$this->add_control(
			'hero_button_title',
			[
				'label' => __('Title', 'myblogger-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Button text', 'textdomain'),
				'placeholder' => esc_html__('Type your Button here', 'textdomain'),
			]
		);
		$this->add_control(
			'hero_button_link',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

	}
	protected function style_tab_content()
	{
		$this->start_controls_section(
			'section_style',
			[
				'label' => __('Style', 'myblogger-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_transform',
			[
				'label' => __('Text Transform', 'myblogger-core'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __('None', 'myblogger-core'),
					'uppercase' => __('UPPERCASE', 'myblogger-core'),
					'lowercase' => __('lowercase', 'myblogger-core'),
					'capitalize' => __('Capitalize', 'myblogger-core'),
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['hero_button_link']['url'] ) ) {
			$this->add_link_attributes( 'hero_button_arg', $settings['hero_button_link'] );
		}

		echo '<div class="title">';
		echo $settings['title'];
		echo '</div>';

		?>
		<p> <?php

		echo esc_html($settings['item_description']); ?>
		</p>

		<img src="<?php echo esc_url($settings['hero_image']['url']) ?>	" alt="">

		<div class="slider__btn-9 mb-85">
			<a <?php $this->print_render_attribute_string( 'hero_button_arg' ); ?> class="tp-btn-5 tp-link-btn-3">
				<?php echo esc_html($settings['hero_button_title']) ?>
				<span>
					<i class="fa-regular fa-arrow-right"></i>
				</span>
			</a>
		</div>
		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template()
	{
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<p>{{{ settings.item_description }}}</p>
		<img src="{{{ settings.hero_image.url }}}" alt="">
		<a href="contact.html" class="tp-btn-5 tp-link-btn-3">
			{{{ settings.hero_button_title }}}
			<span>
				<i class="fa-regular fa-arrow-right"></i>
			</span>
		</a>
		<?php
	}
}
$widgets_manager->register(new Test_Element());
