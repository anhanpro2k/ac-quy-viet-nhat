<?php

/**
 * Undocumented class
 * Create widget
 */
class M_Widget_related_product extends WP_Widget {

	public $Mona_Widgets;

	/**
	 * Undocumented function
	 */
	function __construct() {

		parent::__construct(
			'M_Widget_related_product',
			__( 'Mona - Sản phẩm gần đây/nổi bật', 'monamedia' ),
			[
				'description' => __( 'Hiển thị nhập giá trị văn bản ngắn', 'monamedia' ),
			]
		);


	}

	/**
	 * Undocumented function
	 *
	 * @param [type] $args
	 * @param [type] $instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {

		$widget_id = $args['widget_id'];
		$title     = isset( $instance['title'] ) ? $instance['title'] : '';
		$type      = isset( $instance['type'] ) ? $instance['type'] : 'category';
		?>

		<?php
		$argsPost = [
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => 5,
			'order'          => 'DESC',
			'meta_query'     => [
				'relation' => 'AND',
			],
			'tax_query'      => [
				'relation' => 'AND',
			],
		];

		if ( is_single() ) {
			$argsPost['post__not_in'] = [
				get_the_ID()
			];
		}

		if ( $type == 'hot_news' ) {

			$argsPost['orderby']  = 'meta_value_num';
			$argsPost['meta_key'] = '_mona_post_view';
			$argsPost['order']    = 'DESC';

		}

		$loop = new WP_Query( $argsPost );

		if ( $loop->have_posts() ) {
			?>
            <div class="newprod sidebox">
				<?php
				if ( ! empty( $title ) ) {
					?>
                    <p class="title blur mb4 load-img"><?php echo $title; ?></p>
					<?php
				}
				?>
                <div class="newprod-list">
					<?php
					while ( $loop->have_posts() ) {
						$loop->the_post();
						?>
						<?php
						/**
						 * GET TEMPLATE PART
						 * BOX PRODUCT SIDEBAR
						 */
						$slug = '/partials/loop/box';
						$name = 'product-sidebar';
						echo get_template_part( $slug, $name );
						?>
						<?php
					}
					wp_reset_query();
					?>

                </div>
            </div>
			<?php
		}
		?>

		<?php
	}

	/**
	 * Undocumented function
	 *
	 * Widget Backend
	 *
	 * @param [type] $instance
	 *
	 * @return void
	 */
	public function form( $instance ) {

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = '';
		}

		Mona_Widgets::create_field(
			[
				'type'        => 'text',
				'name'        => $this->get_field_name( 'title' ),
				'id'          => $this->get_field_id( 'title' ),
				'value'       => $title,
				'title'       => __( 'Text', 'monamedia' ),
				'placeholder' => __( 'Nhập nội dung văn bản', 'monamedia' ),
				'docs'        => false,
			]
		);

		if ( isset( $instance['type'] ) ) {
			$type = $instance['type'];
		} else {
			$type = '';
		}

		Mona_Widgets::create_field(
			[
				'type'   => 'select',
				'name'   => $this->get_field_name( 'type' ),
				'id'     => $this->get_field_id( 'type' ),
				'value'  => $type,
				'title'  => __( 'Chọn loại tin tức', 'monamedia' ),
				'select' => [
					'related_news' => __( 'Bài viết gần đây', 'monamedia' ),
					'hot_news'     => __( 'Bài viết nổi bật', 'monamedia' ),
				],
				'docs'   => false,
			]
		);
	}

	/**
	 * Undocumented function
	 *
	 * Updating widget replacing old instances with new
	 *
	 * @param [type] $new_instance
	 * @param [type] $old_instance
	 *
	 * @return void
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = [];

		$instance['title'] = Mona_Widgets::update_field( $new_instance['title'] );
		$instance['type']  = Mona_Widgets::update_field( $new_instance['type'] );

		return $instance;

	}

}

/**
 * Undocumented function
 *
 * Register and load the widget
 * @return void
 */
function Register_M_Widget_related_product() {
	register_widget( 'M_Widget_related_product' );
}

add_action( 'widgets_init', 'Register_M_Widget_related_product' );