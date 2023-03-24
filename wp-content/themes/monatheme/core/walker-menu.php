<?php

class Mona_Walker_Nav_Menu extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class='menu-list submenu'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$object      = $item->object;
		$type        = $item->type;
		$title       = $item->title;
		$description = $item->description;
		$permalink   = $item->url;

		if ( $args->walker->has_children && $depth == 0 ) { //Nếu là thằng đầu tiên
			$output .= "<li class='menu-item parent dropdown" . implode( " ", $item->classes ) . "'>";
		} else if ( $args->walker->has_children && $depth != 0 ) { //nếu nó là cha khác thằng đuầ
			$output .= "<li class='submenu-item menu-item parent dropdown" . implode( " ", $item->classes ) . "'>";
		} else if ( $depth != 0 ) {
			$output .= "<li class='submenu-item menu-item" . implode( " ", $item->classes ) . "'>";
		} else {
			$output .= "<li class='menu-item" . implode( " ", $item->classes ) . "'>";
		}
		//Add SPAN if no Permalink
		if ( $permalink && $permalink != '#' ) {
			$output .= '<a class="menu-link" href="' . $permalink . '">';
		} else {
			$output .= '<a class="menu-link" href="javascript:;">';
		}

		$output .= $title;

		if ( $args->walker->has_children ) { //them icon vao cho no
			$output .= '<span class="dropdown-icon"><i class="ri-arrow-down-s-line"></i></span>';
		}
		if ( $permalink && $permalink != '#' ) {
			$output .= '</a>';
		} else {
			$output .= '</a>';
		}
	}
}

class Mona_Walker_Nav_Menu_Mobile extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class='submenu'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$object      = $item->object;
		$type        = $item->type;
		$title       = $item->title;
		$description = $item->description;
		$permalink   = $item->url;

		if ( $args->walker->has_children && $depth == 0 ) { //Nếu là thằng đầu tiên
			$output .= "<li class='menu-item parent dropdown" . implode( " ", $item->classes ) . "'>";
		} else if ( $args->walker->has_children && $depth != 0 ) { //nếu nó là cha khác thằng đuầ
			$output .= "<li class='submenu-item menu-item parent dropdown" . implode( " ", $item->classes ) . "'>";
		} else if ( $depth != 0 ) {
			$output .= "<li class='submenu-item menu-item  dropdown" . implode( " ", $item->classes ) . "'>";
		} else {
			$output .= "<li class='menu-item" . implode( " ", $item->classes ) . "'>";
		}

		$output .= $title;

		if ( $args->walker->has_children ) { //them icon vao cho no
			$output .= '<span class="dropdown-icon"><i class="ri-arrow-down-s-line"></i></span>';
		}
		if ( $permalink && $permalink != '#' ) {
			$output .= '</a>';
		} else {
			$output .= '</a>';
		}


	}

}

class Mona_Walker_Policy_Menu extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class='child'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$object      = $item->object;
		$type        = $item->type;
		$title       = $item->title;
		$description = $item->description;
		$permalink   = $item->url;

		$output .= "<li class='menus-item parent fz16 fw6" . implode( " ", $item->classes ) . "'>";

		//Add SPAN if no Permalink
		if ( $permalink && $permalink != '#' ) {
			$output .= '<a class="menus-link" href="' . $permalink . '">';
		} else {
			$output .= '<a class="menus-link" href="javascript:;">';
		}

		$output .= $title;

		if ( $permalink && $permalink != '#' ) {
			$output .= '</a>';
		} else {
			$output .= '</a>';
		}

		if ( $args->walker->has_children ) {
			$output .= '<i class="bx bxs-chevron-down"></i>';
		}
	}
}

class Mona_Walker_Nav_Menu_Product extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class='menu-list'>\n";
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$object      = $item->object;
		$type        = $item->type;
		$title       = $item->title;
		$description = $item->description;
		$permalink   = $item->url;

		$mona_menumega_option = get_field( 'mona_menumeta_on_off', $item );

		$output .= "<li class='" . ( $mona_menumega_option ? 'dropdown ' : ' ' ) . implode( " ", $item->classes ) . "'>";


		//Add SPAN if no Permalink
		if ( $permalink && $permalink != '#' ) {
			$output .= '<a class="menu-link" href="' . $permalink . '">';
		} else {
			$output .= '<a class="menu-link" href="javascript:;">';
		}
		$output .= $title;
		if ( $mona_menumega_option ) {
			$output .= '';
		}
		if ( $permalink && $permalink != '#' ) {
			$output .= '</a>';
		} else {
			$output .= '</a>';
		}

		if ( $args->walker->has_children ) {
			$output .= '<i class="bx bxs-chevron-down"></i>';
		}
		if ( $mona_menumega_option == true ) {
			$output .= self::MenuMegaContent( $item );
		}
	}

	function MenuMegaContent( $item ) {
		$mona_menumeta_sir = get_field( 'menu_mega_item_menu', $item );
		ob_start();
		if ( ! empty( $mona_menumeta_sir ) ) {
			?>
            <div class="megas">
                <div class="megas-overlay"></div>
                <div class="megas-inner">
                    <div class="container">
                        <div class="megas-wr">
                            <div class="megas-left">
								<?php if ( ! empty( $mona_menumeta_sir ) ) { ?>
                                    <ul class="menu-list">
										<?php
										foreach ( $mona_menumeta_sir as $left ) {
											$title_link = $left['sub_menu_mega_item_link'];
											$link_sel   = $left['type_menu_item_sel'];
											$title_tax  = $left['sub_menu_mega_item_link_tax'];
											if ( $link_sel == 1 ) { ?>
                                                <li class="menu-item megas-menu-item">
                                                    <a href="<?php echo $title_link['url']; ?>"
                                                       class="menu-link"><?php echo $title_link['title']; ?></a>
                                                </li>
											<?php } elseif ( $link_sel == 2 ) { ?>
                                                <li class="menu-item megas-menu-item">
                                                    <a href="<?php echo get_term_link( $title_tax->term_id ); ?>"
                                                       class="menu-link"><?php echo $title_tax->name; ?></a>
                                                </li>
											<?php }
										}
										?>
                                    </ul>
								<?php } ?>
                            </div>
							<?php if ( ! empty( $mona_menumeta_sir ) ) { ?>
                                <div class="megas-right">
									<?php
									foreach ( $mona_menumeta_sir as $right ) {
										$sel       = $right['type_menu_item'];
										$rep_img   = $right['img_menu_item_mega'];
										$rep_tax_2 = $right['menu_mega_by_list'];
										if ( $sel == 'img' ) {
											?>
											<?php if ( ! empty( $rep_img ) ) { ?>
                                                <div class="megas-menu">
                                                    <div class="megas-menu-row brand row">
														<?php foreach ( $rep_img as $rep_img ) { ?>
                                                            <div class="megas-menu-col col">
                                                                <div class="brand-item">
                                                                    <a href="<?php echo esc_url( $rep_img['link'] ); ?>"
                                                                       class="inner">
																		<?php
																		if ( ! empty( $rep_img['img'] ) ) {
																			echo wp_get_attachment_image( $rep_img['img'], 'medium' );
																		} else {
																			echo '<img src="' . get_site_url() . '/template/assets/images/default-image.jpg" alt="">';
																		}
																		?>
                                                                    </a>
                                                                </div>
                                                            </div>
														<?php } ?>
                                                    </div>
                                                </div>
											<?php } ?>
										<?php } elseif ( $sel == 'link' ) {
											if ( ! empty( $rep_tax_2 ) ) {
												?>
                                                <div class="megas-menu">
                                                    <div class="megas-menu-row row">
                                                        <div class="megas-menu-col col">
                                                            <ul class="menu-list">
                                                                <p class="tt">
																	<?php _e( 'THƯƠNG HIỆU', 'monamedia' ); ?>
                                                                </p>
																<?php
																if ( ! empty( $rep_tax_2 ) ) {
																	foreach ( $rep_tax_2 as $list_farther ) {
																		?>
                                                                        <li class="menu-item">
                                                                            <a href="<?php echo get_term_link( $list_farther['menu_mega_by_tax']->term_id ); ?>"
                                                                               class="menu-link"><?php echo $list_farther['menu_mega_by_tax']->name; ?></a>
																			<?php if ( ! empty( $list_farther['menu_mega_by_tax_lv2'] ) ) { ?>
                                                                                <ul class="menu-list">
                                                                                    <p class="tt">
																						<?php _e( 'DÒNG XE', 'monamedia' ); ?>
                                                                                    </p>
																					<?php foreach ( $list_farther['menu_mega_by_tax_lv2'] as $list_lv2 ) { ?>
                                                                                        <li class="menu-item">
                                                                                            <a href="<?php echo get_term_link( $list_lv2['menu_mega_by_tax_dong_xe']->term_id ); ?>"
                                                                                               class="menu-link">
																								<?php echo $list_lv2['menu_mega_by_tax_dong_xe']->name; ?>
                                                                                            </a>
																							<?php if ( ! empty( $list_lv2['menu_mega_by_tax_lv3'] ) ) { ?>
                                                                                                <ul class="menu-list">
                                                                                                    <p class="tt">
																										<?php _e( 'ĐỜI XE', 'monamedia' ) ?>
                                                                                                    </p>
																									<?php
																									if ( ! empty( $list_lv2['menu_mega_by_tax_lv3'] ) ) {
																										foreach ( $list_lv2['menu_mega_by_tax_lv3'] as $list_lv3 ) { ?>
                                                                                                            <li class="menu-item">
                                                                                                                <a href="<?php echo get_term_link( $list_lv3->term_id ); ?>"
                                                                                                                   class="menu-link">
																													<?php echo $list_lv3->name; ?>
                                                                                                                </a>
                                                                                                            </li>
																										<?php }
																									} ?>
                                                                                                </ul>
																							<?php } ?>
                                                                                        </li>
																					<?php } ?>
                                                                                </ul>
																			<?php } ?>
                                                                        </li>
																		<?php
																	}
																} ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
												<?php
											}
										} ?>
									<?php } ?>
                                </div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
			<?php
		}

		return ob_get_clean();
	}
}
