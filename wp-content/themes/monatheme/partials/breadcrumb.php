<?php
global $post;
$current = get_queried_object();

$array = [
	[ 'url' => get_the_permalink( MONA_PAGE_HOME ), 'title' => get_the_title( MONA_PAGE_HOME ) ],
];

if ( wp_get_post_parent_id( get_the_ID() ) ) {
	$parentId = wp_get_post_parent_id( get_the_ID() );
	$array[]  = [
		'url'   => get_permalink( $parentId ),
		'title' => get_the_title( $parentId ),
	];
}

if ( is_home() ) {
	$array[] = [
		'url'   => '',
		'title' => get_the_title( MONA_PAGE_BLOG ),
	];
} elseif ( is_singular( 'post' ) ) {
	$array[] = [
		'url'   => get_permalink( MONA_PAGE_BLOG ),
		'title' => get_the_title( MONA_PAGE_BLOG ),
	];

	$array[] = [
		'url'   => '',
		'title' => get_the_title( $post->ID ),
	];
} elseif ( is_product() ) {
	$product_id        = get_the_ID();
	$product_terms     = get_the_terms( $product_id, 'product_cat' );
	$product_cat_id    = $product_terms[0]->term_id;
	$product_cat_level = get_taxonomy_level( $product_cat_id, 'product_cat' );

	$array[] = [
		'url'   => get_permalink( MONA_WC_PRODUCTS ),
		'title' => get_the_title( MONA_WC_PRODUCTS ),
	];

	if ( $product_cat_level > 1 ) {
		$product_cat_parent_id   = $product_terms[0]->parent;
		$product_cat_parent_url  = get_term_link( $product_cat_parent_id, 'product_cat' );
		$product_cat_parent_name = get_term( $product_cat_parent_id, 'product_cat' )->name;

		$array[] = [
			'url'   => $product_cat_parent_url,
			'title' => $product_cat_parent_name,
		];
	}

	$product_cat_url  = get_term_link( $product_cat_id, 'product_cat' );
	$product_cat_name = $product_terms[0]->name;

	$array[] = [
		'url'   => $product_cat_url,
		'title' => $product_cat_name,
	];

	$array[] = [
		'url'   => '',
		'title' => get_the_title( $product_id ),
	];
} elseif ( is_post_type_archive( 'product' ) ) {
	$array[] = [ 'url' => '', 'title' => get_the_title( MONA_WC_PRODUCTS ) ];
} else if ( is_tax( 'product_cat' ) ) {
	$array[] = [ 'url' => get_permalink( MONA_WC_PRODUCTS ), 'title' => get_the_title( MONA_WC_PRODUCTS ) ];

	$term      = get_queried_object();
	$ancestors = get_ancestors( $term->term_id, 'product_cat' );
	if ( ! empty( $ancestors ) ) {
		$ancestors = array_reverse( $ancestors );
		foreach ( $ancestors as $ancestor ) {
			$array[] = [
				'url'   => get_term_link( $ancestor ),
				'title' => get_term_field( 'name', $ancestor, 'product_cat' )
			];
		}
	}
	$array[] = [ 'url' => get_term_link( $term ), 'title' => $term->name ];
} else if ( is_tax( 'category_vehicle_brand' ) ) {
	$array[] = [ 'url' => get_permalink( MONA_WC_PRODUCTS ), 'title' => get_the_title( MONA_WC_PRODUCTS ) ];

	$term      = get_queried_object();
	$ancestors = get_ancestors( $term->term_id, 'category_vehicle_brand' );
	if ( ! empty( $ancestors ) ) {
		$ancestors = array_reverse( $ancestors );
		foreach ( $ancestors as $ancestor ) {
			$array[] = [
				'url'   => get_term_link( $ancestor ),
				'title' => get_term_field( 'name', $ancestor, 'category_vehicle_brand' )
			];
		}
	}
	$array[] = [ 'url' => get_term_link( $term ), 'title' => $term->name ];
} else if ( is_page( MONA_WC_CART ) ) {
	$array[] = [
		'url'   => get_permalink( MONA_WC_CART ),
		'title' => get_the_title( MONA_WC_CART ),
	];
} else if ( is_page( MONA_WC_CHECKOUT ) ) {
	$array[] = [
		'url'   => get_permalink( MONA_WC_CHECKOUT ),
		'title' => get_the_title( MONA_WC_CHECKOUT ),
	];
} else if ( is_page_template( 'page-template/policy-template.php' ) ) {
	$array[] = [
		'url'   => '',
		'title' => 'Chính sach1',
	];
	$array[] = [
		'url'   => '',
		'title' => get_the_title( $post->ID ),
	];

} else if ( is_page( MONA_WC_THANKYOU ) ) {
	$array[] = [
		'url'   => get_permalink( MONA_WC_THANKYOU ),
		'title' => get_the_title( MONA_WC_THANKYOU ),
	];
} else if ( is_page( MONA_WC_MYACCOUNT ) ) {
	$array[] = [
		'url'   => get_permalink( MONA_WC_MYACCOUNT ),
		'title' => get_the_title( MONA_WC_MYACCOUNT ),
	];
} elseif ( is_category() ) {
	$category  = get_queried_object();
	$ancestors = array_reverse( get_ancestors( $category->term_id, 'category' ) );
	$array[]   = [
		'url'   => get_permalink( MONA_PAGE_BLOG ),
		'title' => get_the_title( MONA_PAGE_BLOG ),
	];
	foreach ( $ancestors as $ancestor ) {
		$array[] = [
			'url'   => get_category_link( $ancestor ),
			'title' => get_cat_name( $ancestor ),
		];
	}
	$array[] = [
		'url'   => get_category_link( $category ),
		'title' => $category->name,
	];
} elseif ( is_search() ) {
	$array[] = [
		'url'   => '',
		'title' => __( 'Search Result', 'monamedia' ),
	];
} else {
	$array[] = [
		'url'   => '',
		'title' => get_the_title( $post->ID ),
	];
}
?>

<div class="breadcrumb">
    <ul class="breadcrumb-list">
		<?php foreach ( $array as $key_link => $item_link ) : ?>
			<?php if ( $key_link + 1 != count( $array ) ) : ?>
                <li class="breadcrumb-item">
                    <a href="<?php echo $item_link['url'] ?>"
                       class="breadcrumb-link"><?php echo $item_link['title'] ?></a>
                </li>
			<?php else : ?>
                <li class="breadcrumb-item">
                    <a class="breadcrumb-link"><?php echo $item_link['title'] ?></a>
                </li>
			<?php endif; ?>
		<?php endforeach; ?>
    </ul>
</div>
