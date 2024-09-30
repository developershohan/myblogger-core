<?php
namespace MybloggerCore\Widgets;

use Elementor\Conditions;
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
class MyBlogger_iconBox extends Widget_Base
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
		return 'myblogger-icon-box';
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
		return __('myblogger-icon-box', 'myblogger-core');
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


		//Hero Social 
		$this->start_controls_section(
			'myblogger-icon-box',
			[
				'label' => __('Icon Box', 'myblogger-core'),
			]
		);



		$this->add_control(
			'icon-box-sub-title',
			[
				'label' => __('Sub Title', 'myblogger-core'),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'icon-box_title',
			[
				'label' => __('Title', 'myblogger-core'),
				'type' => Controls_Manager::TEXT,
			]
		);


		$this->add_control(
			'icon_select',
			[
				'label' => esc_html__('Set Icon', 'textdomain'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => esc_html__('Icon', 'textdomain'),
					'svg' => esc_html__('Svg', 'textdomain'),
					'image' => esc_html__('Image', 'textdomain'),
				],
			]
		);
		$this->add_control(
			'icon-box-icon',
			[
				'label' => esc_html__('Icon', 'textdomain'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
				'condition' => [
					'icon_select' => 'icon',
				]
			]
		);
		$this->add_control(
			'icon-box-svg',
			[
				'label' => esc_html__('Description', 'textdomain'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__('Default description', 'textdomain'),
				'placeholder' => esc_html__('Type your description here', 'textdomain'),
				'condition' => [
					'icon_select' => 'svg',
				]
			]
		);

		$this->add_control(
			'icon-box-image',
			[
				'label' => esc_html__('Choose Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_select' => 'image'
				]
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
		?>



		<!-- services area start -->

			<div class="services__item-9 mb-30 transition-3">
				<div class="services__item-9-top d-flex align-items-start justify-content-between">
					<div class="services__icon-9">
						<span>
							<?php if ($settings['icon_select'] == 'icon'): ?>
								<?php \Elementor\Icons_Manager::render_icon($settings['icon-box-icon'], ['aria-hidden' => 'true']); ?>
							<?php elseif ($settings['icon_select'] == 'svg'): ?>
								<?php echo $settings['icon-box-svg'] ?>
							<?php else: ?>
								<img src="<?php echo esc_url($settings['icon-box-image']['url']) ?>"
									alt="<?php echo esc_attr($settings['icon-box_title']) ?>">
							<?php endif; ?>

							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/services/9/services-icon-shape.png"
								alt="">

						</span>
					</div>
					<div class="services__btn-9">
						<a href="services-details.html"><i class="fa-light fa-arrow-up-right"></i></a>
					</div>
				</div>
				<div class="services__content-9">
					<span class="services-project">
						<?php echo esc_html($settings['icon-box-sub-title']); ?>
					</span>
					<h3 class="services__title-9">
						<a href="services-details.html"><?php echo esc_html($settings['icon-box_title']); ?></a>
					</h3>
				</div>
			</div>

		<!-- services area end -->


		<?php

	}
}
$widgets_manager->register(new MyBlogger_iconBox());
