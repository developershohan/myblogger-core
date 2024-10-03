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
		//Hero content
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'myblogger-core'),
			]
		);

		$this->add_control(
			'hero_sub_title',
			[
				'label' => __('Sub Title', 'myblogger-core'),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'hero_title',
			[
				'label' => __('Title', 'myblogger-core'),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'hero_description',
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


		//Hero Button
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
				'label' => esc_html__('Link', 'textdomain'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
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

				//Hero Social 
		$this->start_controls_section(
			'hero_social',
			[
				'label' => __('Social Media', 'myblogger-core'),
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'hero_social_url',
			[
				'label' => __('Url', 'myblogger-core'),
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'hero_social_icon',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
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
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_title' => esc_html__( 'Title #1', 'textdomain' ),
					],
					[
						'list_title' => esc_html__( 'Title #2', 'textdomain' ),
					],
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
		if (!empty($settings['hero_button_link']['url'])) {
			$this->add_link_attributes('hero_button_arg', $settings['hero_button_link']);
			$this->add_render_attribute('hero_button_arg',[
				'id' => 'custom-widget-id',
				'class' => 'tp-btn-5 tp-link-btn-3',
			]
		);
		}

		?>


		<!-- slider area start -->
		<section class="slider__area p-relative fix">
			<div class="slider__item-9">
				<div class="container">
					<div class="row align-items-end">
						<div class="col-xl-7 col-lg-6 col-md-7">
							<div class="slider__content-9">
								<span class="slider__title-pre-9"><?php echo esc_html($settings['hero_sub_title']); ?></span>
								<h3 class="slider__title-9"><?php echo esc_html($settings['hero_title']); ?></h3>
								<p><?php echo esc_html($settings['hero_description']); ?></p>

								<div class="slider__btn-9 mb-85">
									<a <?php echo $this->get_render_attribute_string( 'hero_button_arg' ); ?> ?>
										<?php echo esc_html($settings['hero_button_title']); ?>
										<span>
											<i class="fa-regular fa-arrow-right"></i>
										</span>
									</a>
								</div>

								<div class="slider__social-9 d-flex flex-wrap align-items-center">
									<span>Check out my:</span>


									<ul>

									<?php foreach ($settings['list']  as $item) : ?>

										<li>
											<a href="<?php echo esc_url($item['hero_social_url']); ?>">
											<?php \Elementor\Icons_Manager::render_icon( $item['hero_social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
											</a>
										</li>

									<?php endforeach ?>	
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-5 col-lg-6 col-md-5 order-first order-md-last">
							<div class="slider__thumb-9 p-relative scene">
								<div class="slider__shape">
									<div class="slider__shape-20">
										<img class="layer" data-depth=".2" src="<?php echo get_template_directory_uri(); ?> /assets/img/slider/9/slider-shape-1.png" alt="">
									</div>
									<div class="slider__shape-21">
										<img class="layer" data-depth=".3" src="<?php echo get_template_directory_uri(); ?> /assets/img/slider/9/slider-shape-2.png" alt="">
									</div>
								</div>
								<img class="slider__thumb-9-main" src="<?php echo esc_url($settings['hero_image']['url']) ?> " alt="">

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- slider area end -->


		<?php

	}
}
$widgets_manager->register(new Test_Element());
