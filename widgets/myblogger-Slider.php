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
class MyBlogger_slider extends Widget_Base
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
		return 'myblogger-process';
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
		return __('Slider', 'myblogger-core');
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
			'myblogger-process',
			[
				'label' => __('Process', 'myblogger-core'),
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'process_sub_title',
			[
				'label' => __('Sub Title', 'myblogger-core'),
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'process_title',
			[
				'label' => __('Title', 'myblogger-core'),
				'type' => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'process_content',
			[
				'label' => esc_html__('Description', 'textdomain'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => esc_html__('Default description', 'textdomain'),
				'placeholder' => esc_html__('Type your description here', 'textdomain'),
			]
		);

		$repeater->add_control(
			'process_image',
			[
				'label' => esc_html__('Choose Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'process_author_image',
			[
				'label' => esc_html__('Choose Image', 'textdomain'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


		$this->add_control(
			'process_list',
			[
				'label' => esc_html__('Repeater List', 'textdomain'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'process_sub_title' => esc_html__('Title #1', 'textdomain'),
						'process_title' => esc_html__('Title #1', 'textdomain'),
					],
					[
						'process_sub_title' => esc_html__('Title #2', 'textdomain'),
						'process_title' => esc_html__('Title #2', 'textdomain'),
					],
				],
				'title_field' => '{{{ process_sub_title }}}',
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



		<!-- features area start -->
		<section class="features__area">
			<div class="container">
				<div class="row">
					<!-- Content Section (Tabs) -->
					<div class="col-xl-4 col-lg-4 col-md-6">
						<div class="features__wrapper-9 mr-30">
							<?php foreach ($settings['process_list'] as $key => $item):
								// Set active class for the first item
								$active = ($key == 0) ? 'active' : '';
								$index = $key + 1;
								?>
								<div class="features__content-9 features-item-content <?php echo esc_attr($active); ?>"
									rel="features-img-<?php echo esc_attr($index); ?>"
									data-target="features-img-<?php echo esc_attr($index); ?>">
									<span> <?php echo esc_html($item["process_sub_title"]); ?> </span>
									<h3 class="features__title-9"><?php echo esc_html($item["process_title"]); ?> </h3>
								</div>
							<?php endforeach; ?>
						</div>
					</div>

					<!-- Image Section -->
					<div class="col-xl-8 col-lg-8 col-md-6 d-none d-md-block">
						<div class="features__thumb-wrapper-9 pl-20">
							<div id="features-item-thumb" class="features-img-1">
								<?php foreach ($settings['process_list'] as $key => $item):
									// Set active class for the first image
									$active = ($key == 0) ? 'active' : '';
									$index = $key + 1;
									?>
									<div
										class="features__thumb-9 transition-3 features-img-<?php echo esc_attr($index); ?> <?php echo esc_attr($active); ?>">
										<img src="<?php echo esc_url($item["process_image"]['url']) ?>" alt="">
										<div class="features__thumb-9-content">
											<p><?php echo esc_html($item["process_content"]) ?> </p>

											<div class="features-users">
												<img src="<?php echo esc_url($item["process_author_image"]['url']) ?>" alt="">
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>


		<!-- features area end -->


		<?php

	}
}
$widgets_manager->register(new MyBlogger_slider());
