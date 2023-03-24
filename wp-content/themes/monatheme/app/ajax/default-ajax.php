<?php
add_action( 'wp_ajax_mona_ajax_default', '_default' ); // login
add_action( 'wp_ajax_nopriv_mona_ajax_default', '_default' ); // no login

function _default() {

}


add_action( 'wp_ajax_mona_ajax_pagination_products', 'mona_ajax_pagination_products' ); // login
add_action( 'wp_ajax_nopriv_mona_ajax_pagination_products', 'mona_ajax_pagination_products' ); // no login
function mona_ajax_pagination_products() {
	$form = array();
	parse_str( $_POST['formdata'], $form );
	$paged         = $_POST['paged'] ? $_POST['paged'] : 1;
	$post_per_page = 12;
	$offset        = ( $paged - 1 ) * $post_per_page;
	$order         = 'DESC';
	$argsProduct   = array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => $post_per_page,
		'paged'          => $paged,
		// 'offset' => $offset,
		'order'          => $order,
		'meta_query'     => [
			'relation' => 'OR',
		],
		'tax_query'      => [
			'relation' => 'AND',
		]
	);

	if ( isset( $form['category_vehicle_brand'] ) ) {
		$argsProduct['tax_query'][] = array(
			'taxonomy' => 'category_vehicle_brand',
			'field'    => 'slug',
			'terms'    => @$form['category_vehicle_brand'],
		);
	}

	if ( isset( $form['product_cat'] ) ) {
		$argsProduct['tax_query'][] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => @$form['product_cat'],
		);
	}

	if ( isset( $form['pa_dung_luong'] ) && ! empty( $form['pa_dung_luong'] ) ):
		$argsProduct['tax_query'][] = array(
			'taxonomy' => 'pa_dung-luong',
			'field'    => 'slug',
			'terms'    => (array) @$form['pa_dung_luong'],
			'operator' => "IN"
		);
	endif;


	if ( isset( $form['pa_coc_binh'] ) && ! empty( $form['pa_coc_binh'] ) ):
		$argsProduct['tax_query'][] = array(
			'taxonomy' => 'pa_coc-binh',
			'field'    => 'slug',
			'terms'    => (array) @$form['pa_coc_binh'],
			'operator' => "IN"
		);
	endif;

	if ( isset( $form['pa_dien_ap'] ) && ! empty( $form['pa_dien_ap'] ) ):
		$argsProduct['tax_query'][] = array(
			'taxonomy' => 'pa_dien-ap',
			'field'    => 'slug',
			'terms'    => (array) @$form['pa_dien_ap'],
			'operator' => "IN"
		);
	endif;

	if ( isset( $form['sort'] ) && ! empty( $form['sort'] ) ) {
		if ( $form['sort'] == 'price-asc' ) {
			$argsProduct['orderby']  = 'meta_value_num';
			$argsProduct['meta_key'] = '_price';
			$argsProduct['order']    = 'ASC';
		} else if ( $form['sort'] == 'price-desc' ) {
			$argsProduct['orderby']  = 'meta_value_num';
			$argsProduct['meta_key'] = '_price';
			$argsProduct['order']    = 'DESC';
		} else if ( $form['sort'] == 'name-asc' ) {
			$argsProduct['orderby'] = 'title';
			$argsProduct['order']   = 'ASC';
		} else if ( $form['sort'] == 'name-desc' ) {
			$argsProduct['orderby'] = 'title';
			$argsProduct['order']   = 'DESC';
		} else if ( $form['sort'] == 'new' ) {
			$argsProduct['orderby'] = 'date';
			$argsProduct['order']   = 'DESC';
		}
	} else {
		$argsProduct['orderby'] = 'date';
		$argsProduct['order']   = 'DESC';
	}

	$loop = new WP_Query( $argsProduct );

	if ( $loop && $loop->have_posts() ) {
		ob_start(); ?>

        <div class="home-prodbox-list">
			<?php
			while ( $loop->have_posts() ) {
				$loop->the_post();
				?>
                <div class="home-prodbox-item">
                    <div class="col">
						<?php
						/**
						 * GET TEMPLATE PART
						 * BOX PRODUCT
						 */
						$slug = '/partials/loop/box';
						$name = 'product';
						echo get_template_part( $slug, $name );
						?>
                    </div>
                </div>
			<?php }
			wp_reset_query(); ?>

        </div>
        <div class="pagimain pagination-products-ajax">
			<?php mona_pagination_links_products( $loop, $paged ); ?>
        </div>
		<?php

	} else { ?>
        <div class="mona-mess-empty">
            <p><?php echo __( 'Nội dung đang được cập nhật', 'monamedia' ) ?></p>
        </div>

	<?php }

	echo wp_send_json_success(
		[
			'title'         => __( 'Thông báo!', 'monamedia' ),
			'message'       => __( 'Load thêm thành công!', 'monamedia' ),
			'title_close'   => __( 'Đóng', 'monamedia' ),
			'products_html' => ob_get_clean()
		]
	);
	wp_die();

}

add_action( 'wp_ajax_mona_ajax_loading_filter', 'mona_ajax_loading_filter' ); // login
add_action( 'wp_ajax_nopriv_mona_ajax_loading_filter', 'mona_ajax_loading_filter' ); // no login
function mona_ajax_loading_filter() {
	$form = array();
	parse_str( $_POST['formdata'], $form );
	$car_brand = [];
	$link      = get_permalink( MONA_WC_PRODUCTS );
	if ( isset( $form['car-brand'] ) && ! empty( $form['car-brand'] ) && $form['car-brand'] !== 'all' ) {
		$term_brand = get_term_by( 'slug', $form['car-brand'], 'category_vehicle_brand' );
		$link       = get_term_link( $term_brand->term_id, 'category_vehicle_brand' );
		if ( ! empty( $term_brand ) ) {
			$car_model = get_terms( array(
				'taxonomy'   => 'category_vehicle_brand',
				'hide_empty' => false,
				'parent'     => $term_brand->term_id
			) );
		}
	}
	if ( isset( $form['car-model'] ) && ! empty( $form['car-model'] ) && $form['car-model'] !== 'all' ) {
		$term_model = get_term_by( 'slug', $form['car-model'], 'category_vehicle_brand' );
		$link       = get_term_link( $term_model->term_id, 'category_vehicle_brand' );

		if ( ! empty( $term_model ) ) {
			$car_year = get_terms( array(
				'taxonomy'   => 'category_vehicle_brand',
				'hide_empty' => false,
				'parent'     => $term_model->term_id
			) );
		}
	}

	if ( isset( $form['car-year'] ) && ! empty( $form['car-year'] ) && $form['car-year'] !== 'all' ) {
		$term_model = get_term_by( 'slug', $form['car-year'], 'category_vehicle_brand' );
		$link       = get_term_link( $term_model->term_id, 'category_vehicle_brand' );
	}


	ob_start(); ?>
    <div class="about-filter-item col">
        <select class="select-custom-main" name="car-brand"
                data-placeholder="<?php esc_html_e( 'Hãng', 'monamedia' ); ?>">
            <option
                    value="all"><?php esc_html_e( 'Hãng', 'monamedia' ); ?></option>
			<?php
			$terms = get_terms( array(
				'taxonomy'   => 'category_vehicle_brand',
				'hide_empty' => false,
				'parent'     => 0
			) );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				$selected = '';
				foreach ( $terms as $term ) {
					$selected = '';
					if ( ( $term->slug ) === $form['car-brand'] ) {
						$selected = 'selected';
					}

					echo '<option value="' . esc_attr( $term->slug ) . '" ' . $selected . '>' . esc_html( $term->name ) . '</option>';
				}
			}
			?>
        </select>
    </div>
    <div class="about-filter-item col">
        <select class="select-custom-main" name="car-model" data-placeholder="Dòng xe">
            <option value="all"><?php echo __( 'Dòng xe', 'monamedia' ); ?></option>
			<?php
			if ( content_exists( $car_model ) ) {
				?>
				<?php
				foreach ( $car_model as $term_model ) {
					$selected = '';
					if ( ( $term_model->slug ) === $form['car-model'] ) {
						$selected = 'selected';
					}
					echo '<option value="' . esc_attr( $term_model->slug ) . '" ' . $selected . '>' . esc_html( $term_model->name ) . '</option>';
				}
				?>
				<?php
			}
			?>
        </select>
    </div>
    <div class="about-filter-item col">
        <select class="select-custom-main" name="car-year" data-placeholder="Đời xe">
            <option value="all"><?php echo __( 'Đời xe', 'monamedia' ); ?></option>
			<?php
			if ( content_exists( $car_year ) ) {
				?>
				<?php
				foreach ( $car_year as $term_year ) {
					$selected = '';
					if ( ( $term_year->slug ) === $form['car-year'] ) {
						$selected = 'selected';
					}
					echo '<option value="' . esc_attr( $term_year->slug ) . '" ' . $selected . '>' . esc_html( $term_year->name ) . '</option>';
				}
				?>
				<?php
			}
			?>
        </select>
    </div>
    <div class="about-filter-btn col">
        <a href="<?php echo esc_url( $link ) ?>" target="_blank" class="btn-find">
            <i class="fal fa-search"></i>
            <span class="txt"><?php echo __( 'Tìm', 'monamedia' ); ?></span>
        </a>
    </div>


	<?php

	echo wp_send_json_success(
		[
			'title'         => __( 'Thông báo!', 'monamedia' ),
			'message'       => __( 'Load thêm thành công!', 'monamedia' ),
			'title_close'   => __( 'Đóng', 'monamedia' ),
			'products_html' => ob_get_clean()
		]
	);
	wp_die();

}
