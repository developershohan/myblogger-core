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
class Myblogger_Blog_Post extends Widget_Base
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
		return 'blog-post';
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
		return __('Blog Post', 'myblogger-core');
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
			'blog_post_section',
			[
				'label' => esc_html__( 'BLog Post', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_per_page',
			[
				'label' => esc_html__( 'Post Per Page', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

		$this->add_control(
			'post_cat_list',
			[
				'label' => esc_html__( 'Category Include', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => post_cat(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'post_cat_exclude',
			[
				'label' => esc_html__( 'Category Exclude', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => post_cat(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'post_in',
			[
				'label' => esc_html__( 'Post Include', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => get_all_post(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'post_not_in',
			[
				'label' => esc_html__( 'Post Exclude', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'options' => get_all_post(),
				'label_block' => true,
				'multiple' => true,
			]
		);

		$this->add_control(
			'post_order',
			[
				'label' => esc_html__( 'Order', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'asc',
				'options' => [
					'asc' => esc_html__( 'ASC', 'textdomain' ),
					'desc' => esc_html__( 'DESC', 'textdomain' ),
				],
			]
		);

		$this->add_control(
			'post_orderby',
			[
				'label' => esc_html__( 'Order by', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
			        'ID' => 'Post ID',
			        'author' => 'Post Author',
			        'title' => 'Title',
			        'date' => 'Date',
			        'modified' => 'Last Modified Date',
			        'parent' => 'Parent Id',
			        'rand' => 'Random',
			        'comment_count' => 'Comment Count',
			        'menu_order' => 'Menu Order',
				],
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
	protected function render() {
		$settings = $this->get_settings_for_display();


		// button 01
		if ( ! empty( $settings['button_text'] ) ) {
			$this->add_link_attributes( 'button_arg', $settings['button_link'] );
			$this->add_render_attribute('button_arg', 'class', 'tp-btn');
		}		
	
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $settings['post_per_page'],
			'orderby' => $settings['post_orderby'],
			'order' => $settings['post_order'],
			'post__in' => $settings['post_in'],
			'post__not_in' => $settings['post_not_in'],
		);

		if(!empty($settings['post_cat_list'] ) and !empty($settings['post_cat_exclude'] )){
			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $settings['post_cat_list'],
					'operator' => 'IN',
				),
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $settings['post_cat_exclude'],
					'operator' => 'NOT IN',
				),
			);
		}
		elseif(!empty($settings['post_cat_list'] ) || !empty($settings['post_cat_exclude'] ) ){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $settings['post_cat_exclude'] ? $settings['post_cat_exclude'] : $settings['post_cat_list'],
					'operator' => $settings['post_cat_exclude'] ? 'NOT IN' : 'IN',
				),
			);
		}



		$query = new \WP_Query( $args );


		?>


         <!-- blog area start -->
         <section class="blog__area  z-index-1">
            <div class="container">
               <div class="row">
				<?php if ( $query->have_posts() ) : while($query-> have_posts()  ) : $query->the_post(); 
					$categories = get_the_category(get_the_ID());

					// var_dump($categories);
				?>
                  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                     <div class="blog__item-9 mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="blog__thumb-9 w-img fix">
                           <a href="<?php the_permalink(); ?>">
						   <?php the_post_thumbnail(); ?>
                           </a>
                        </div>
                        <div class="blog__content-9">
                           <div class="blog__meta-9">
                              <span>
                                 <a href="#"><?php echo get_the_date(); ?></a>
                              </span>
                              <span>
                                 <?php echo esc_html($categories[0]->name); ?>
                              </span>
                           </div>
                           <h3 class="blog__title-9">
                              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                           </h3>
                        </div>
                     </div>
                  </div>
				  <?php endwhile; endif; ?>
               </div>
            </div>
         </section>
         <!-- blog area end -->

		<?php
	}
}
$widgets_manager->register(new Myblogger_Blog_Post());
