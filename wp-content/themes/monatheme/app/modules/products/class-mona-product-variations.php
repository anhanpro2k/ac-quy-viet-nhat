<?php 
class MonaProductVariations {

    public static function Variations_html( $productId = '',  $attribute_primary_taxonomy = '',  $attribute_primary_first_slug = '' ){
        if(  empty($productId) ){
            $productId = get_the_ID();
        }

        ob_start();
    
        $product    = wc_get_product($productId);
        $variations = self::Variations( $productId );
        $variation_first_attributes = self::Variation_first_attributes( $productId );

        if( !empty($variations) && empty($attribute_primary_taxonomy) && empty($attribute_primary_first_slug) ){
            $first = true;
            foreach ($variations as $variation_attributes => $attributes_array) {
                foreach ($attributes_array as $key_attribute_slug => $attribute_item) {
                    if( !empty($attribute_item['parent']) && $first ){
                        $attribute_primary_taxonomy = $variation_attributes;
                        $attribute_primary_first_slug = $key_attribute_slug;
                        $first = false;
                    }
                }
            }
        }

        if( !empty($variations) && !empty( $attribute_primary_taxonomy ) && !empty( $attribute_primary_first_slug ) ){
            if( !empty($variations[$attribute_primary_taxonomy]) ){
                $taxonomy_primary = str_replace( 'attribute_', '', $attribute_primary_taxonomy );
        ?>
        <div id="taxonomy-<?php echo $taxonomy_primary ?>" class="product-attributes taxonomy-<?php echo $taxonomy_primary; ?> prodt-color mb-16">
            <p class="fw-7">
                <?php 
                $attribute_label_name = wc_attribute_label($taxonomy_primary);
                if( !empty( $attribute_label_name ) ){
                    echo $attribute_label_name;
                } ?>
            </p>
            <div class="prodt-color-check recheck-block">

                <?php 
                    foreach ($variations[$attribute_primary_taxonomy] as $attribute_primary_slug => $attribute_primary_item) {
                        $term_item = get_term_by('slug', $attribute_primary_slug, $taxonomy_primary);
                        $mona_attribute_taxonomy_thumbnail = get_field('mona_attribute_taxonomy_thumbnail', $term_item);
                        $flagChecked = false;
                        if ( $attribute_primary_item['default'] ) {
                            $flagChecked = true;
                        }
                        $mona_attribute_taxonomy_thumbnail = get_field('mona_attribute_taxonomy_thumbnail', $term_item);
                    ?>
                <label for="<?php echo $term_item->slug; ?>" class="option radio-item mona-variation-item <?php echo $flagChecked ? 'checked' : ''; ?> recheck-item">
                    <input type="radio" name="<?php echo $taxonomy_primary;?>"  id="<?php echo $term_item->slug; ?>" 
                    value="<?php echo $term_item->slug; ?>" class="recheck-input" hidden <?php echo $flagChecked ? 'checked' : ''; ?>>
                    <?php if( !empty( $mona_attribute_taxonomy_thumbnail ) ){ ?>
                    <div class="prodt-color-dot">
                        <?php echo wp_get_attachment_image($mona_attribute_taxonomy_thumbnail, 'box-s'); ?>
                    </div>
                    <?php }else{ ?> 
                    <div class="prodt-color-dot text"><?php echo $term_item->name; ?></div>
                    <?php } ?>
                </label>
                <?php }  ?>

            </div>
        </div>
        <?php } } ?>

        <?php
        if( !empty($variations[$attribute_primary_taxonomy][$attribute_primary_first_slug]['relationship']) ){
            foreach ($variations[$attribute_primary_taxonomy][$attribute_primary_first_slug]['relationship'] as $attribute_relationship_name => $attribute_relationship_array) {
                $taxonomy_primary = str_replace( 'attribute_', '', $attribute_relationship_name );
        ?>
        <div id="taxonomy-<?php echo $taxonomy_primary ?>" class="product-attributes taxonomy-<?php echo $taxonomy_primary; ?> prodt-color mb-16">
            <p class="fw-7">
                <?php 
                $attribute_label_name = wc_attribute_label($taxonomy_primary);
                if( !empty( $attribute_label_name ) ){
                    echo $attribute_label_name;
                } ?>
            </p>
            <div class="prodt-color-check recheck-block">

                <?php 
                    foreach ($variations[$attribute_primary_taxonomy] as $attribute_primary_slug => $attribute_primary_item) {
                        $term_item = get_term_by('slug', $attribute_primary_slug, $taxonomy_primary);
                        $mona_attribute_taxonomy_thumbnail = get_field('mona_attribute_taxonomy_thumbnail', $term_item);
                        $flagChecked = false;
                        // check default attribute
                        $default_attributes = $product->get_default_attributes();
                        if ( ! empty ( $default_attributes ) ) {
                            if ( $default_attributes[$taxonomy_primary] === $attribute_relationship_slug ) { 
                                $flagChecked = true;
                            }
                        }
                        $mona_attribute_taxonomy_thumbnail = get_field('mona_attribute_taxonomy_thumbnail', $term_item);
                    ?>
                <label for="<?php echo $term_item->slug; ?>" class="option radio-item mona-variation-item <?php echo $flagChecked ? 'checked' : ''; ?> recheck-item">
                    <input type="radio" name="<?php echo $taxonomy_primary;?>"  id="<?php echo $term_item->slug; ?>" 
                    value="<?php echo $term_item->slug; ?>" class="recheck-input" hidden <?php echo $flagChecked ? 'checked' : ''; ?>>
                    <?php if( !empty( $mona_attribute_taxonomy_thumbnail ) ){ ?>
                    <div class="prodt-color-dot">
                        <?php echo wp_get_attachment_image($mona_attribute_taxonomy_thumbnail, 'box-s'); ?>
                    </div>
                    <?php }else{ ?> 
                    <div class="prodt-color-dot text"><?php echo $term_item->name; ?></div>
                    <?php } ?>
                </label>
                <?php }  ?>

            </div>
        </div>
        <?php } } 

        return ob_get_clean();
    }

    public static function Variation_first_id( $productId = '' )
    {
        if ( empty ( $productId ) ) {
            $productId = get_the_ID();
        }
        $variation_first_attributes = self::Variation_first_attributes( $productId );
        $data_store  = WC_Data_Store::load( 'product' );
        $variation_first_id = $data_store->find_matching_product_variation( new \WC_Product( $productId ), $variation_first_attributes );
        return  $variation_first_id;
    }

    public static function Variation_first_attributes( $productId = '' )
    {
        if ( empty ( $productId ) ) {
            $productId = get_the_ID();
        }
        $variation_first_attributes = [];
        $product              = wc_get_product($productId);
        $product_type = '';
        $product_type = $product->get_type();
        if( $product_type == 'variable' ) {
            $variations           = self::Variations( $productId );
            $typeVariation = count( $product->get_attributes() ) > 1 ? 'multiple' : 'single';
            if( $typeVariation == 'single'){
                if( !empty( $variations ) ){
                    $first = true;
                    foreach ($variations as $attribute_name => $items) {
                        foreach ($items as $item_slug => $item) {
                            if( $first ){
                                if( !empty( $item['slug'] ) ){
                                    $variation_first_attributes[$attribute_name] = $item['slug'];
                                    $first = false;
                                } 
                            }
                        }
                    }
                }
            } elseif ( $typeVariation == 'multiple' ) {
                if( !empty($variations) ){
                    $first = true;
                    foreach ($variations as $variation_attributes => $attributes_array) {
                        foreach ($attributes_array as $key_attribute_slug => $attribute_item) {
                            if( !empty($attribute_item['parent']) && $first ){
                                if( !empty( $attribute_item['relationship'] ) ){
                                    foreach ($attribute_item['relationship'] as $key_relationship_slug => $relationship_items) {
                                        if( !empty( $relationship_items ) ){
                                            foreach ($relationship_items as $relationship_item_slug => $relationship_item) {
                                                if( $first && $relationship_item['disabled'] == 'no' && $relationship_item['variation_id'] != 0 && $relationship_item['variation_id'] > 0){
                                                    $variation_first_attributes = $relationship_item['variation_attributes'];
                                                    $first = false;
                                                }
                                            }
                                        }
                                    }

                                }
                            }
                        }
                    }
                }
            }
        }
        return  $variation_first_attributes;
    }

    public static function Variations( $productId = '' )
    {
        if ( empty ( $productId ) ) {
            $productId = get_the_ID();
        }
        $variation_attributes = [];
        $product              = wc_get_product($productId);
        $product_type = '';
        $product_type = $product->get_type();
        if( $product_type == 'variable' ){
            $variations           = $product->get_available_variations();
            $count                = 0;
            foreach ( $product->get_attributes() as $attribute_name  => $attribute ) {
                if ( $attribute['variation'] ) {
                    $childItemVariations = $product->get_variation_attributes()[$attribute_name];
                    if ( ! empty ( $childItemVariations ) ) {
                        foreach ( $childItemVariations as $varChildKey => $varChildValue ) {
                            $varChildTerm = get_term_by( 'slug', $varChildValue, str_replace( 'attribute_', '', $attribute_name ) );
                            if ( ! empty ( $varChildTerm ) ) {
                                $variation_attributes['attribute_' . $attribute_name][$varChildValue] = [
                                    'term_id' => $varChildTerm->term_id,
                                    'name'    => $varChildTerm->name,
                                    'slug'    => $varChildTerm->slug,
                                ];
                                if ( $count == 0 ) {
                                    $variation_attributes['attribute_' . $attribute_name][$varChildValue]['parent'] = true;
                                }
                                // check default attribute
                                $variation_attributes['attribute_' . $attribute_name][$varChildValue]['default'] = 0;
                                $default_attributes = $product->get_default_attributes();
                                if ( ! empty ( $default_attributes ) ) {
                                    if ( $default_attributes[$attribute_name] === $varChildTerm->slug ) {
                                        $variation_attributes['attribute_' . $attribute_name][$varChildValue]['default'] = 1;
                                    }
                                }
                                // relation
                                $listAttributeRelations = self::getAttributeRelation( $productId, $attribute_name, $varChildValue );
                                if( !empty( $listAttributeRelations ) ){
                                    $variation_attributes['attribute_' . $attribute_name][$varChildValue]['relationship'] = $listAttributeRelations;
                                }else{
                                    $variation_attributes['attribute_' . $attribute_name][$varChildValue]['variation_id'] = self::findVariationId( $productId , [ 'attribute_' . $attribute_name => $varChildTerm->slug ] );
                                }
                            }
                        }
                    }
                    $count++;
                }
            }
        }
        return  $variation_attributes;
    }

    public static function getAttributeRelation( $productId = '', $attributUnset = '', $attributValue = '' )
    {
        if ( empty ( $attributUnset ) || empty ( $attributValue ) ) {
            return false;
        }
        if ( empty ( $productId ) ) {
            $productId = get_the_ID();
        }
        $findAttributes       = [];
        $variation_attributes = [];
        $product              = wc_get_product( $productId );
        $variations           = $product->get_available_variations();
        foreach ( $product->get_attributes() as $attribute_name  => $attribute ) {
            if ( $attribute['variation'] ) {
                $childItemVariations = $product->get_variation_attributes()[$attribute_name];
                if ( ! empty ( $childItemVariations ) && $attribute_name != $attributUnset ) {
                    foreach ( $childItemVariations as $varChildKey => $varChildValue ) {
                        $varChildTerm = get_term_by( 'slug', $varChildValue, str_replace( 'attribute_', '', $attribute_name ) );
                        if ( ! empty ( $varChildTerm ) ) {
                            $variation_attributes['attribute_' . $attribute_name][$varChildValue] = [
                                'term_id' => $varChildTerm->term_id,
                                'name'    => $varChildTerm->name,
                            ];
                            // array
                            $totalCheck     = 0;
                            $listCheckItems = self::checkAttributeRelation( $product, $attributUnset, $attributValue );
                            if ( ! empty ( $listCheckItems ) ) {
                                $totalCheck = count ( $listCheckItems );
                                if ( count ( $listCheckItems ) >= 2 ) {
                                    unset( $listCheckItems['attribute_' . $attribute_name] );
                                }
                                // check
                                if ( $totalCheck <= 1 ) {
                                    foreach ( $listCheckItems as $checkkey => $subCheckItems ) {
                                        if ( ! empty ( $subCheckItems ) ) {
                                            $count = 0;
                                            foreach ( $subCheckItems as $subCheckKey => $subCheckValue ) {
                                                $variation_attributes['attribute_' . $attribute_name][$varChildValue]['compare'][$count]['attribute_' . $attributUnset] = $attributValue;
                                                $variation_attributes['attribute_' . $attribute_name][$varChildValue]['compare'][$count]['attribute_' . $attribute_name] = $varChildValue;
                                                $count++;
                                            }
                                        }
                                    }
                                } else {
                                    foreach ( $listCheckItems as $checkkey => $subCheckItems ) {
                                        if ( ! empty ( $subCheckItems ) ) {
                                            $count = 0;
                                            foreach ( $subCheckItems as $subCheckKey => $subCheckValue ) {
                                                $variation_attributes['attribute_' . $attribute_name][$varChildValue]['compare'][$count]['attribute_' . $attributUnset] = $attributValue;
                                                $variation_attributes['attribute_' . $attribute_name][$varChildValue]['compare'][$count]['attribute_' . $attribute_name] = $varChildValue;
                                                $variation_attributes['attribute_' . $attribute_name][$varChildValue]['compare'][$count][$checkkey] = $subCheckValue['slug'];
                                                $count++;
                                            }
                                        }
                                    }
                                }
                            } else {
                                $variation_attributes['attribute_' . $attribute_name][$varChildValue]['compare'] = [];
                            }
                            //check disabled
                            $disabled     = 'yes';
                            $variation_id = 0;
                            $checkListCompare = $variation_attributes['attribute_' . $attribute_name][$varChildValue]['compare'];
                            if ( ! empty ( $checkListCompare ) ) {
                                foreach ( $checkListCompare as $comKey => $comAttrbutes ) {
                                    $findVariationId = self::findVariationId( $productId, $comAttrbutes );
                                    if ( ! empty ( $findVariationId ) && $findVariationId > 0 ) {
                                        $disabled     = 'no';
                                        $variation_id = $findVariationId;
                                        $variation_attributes['attribute_' . $attribute_name][$varChildValue]['variation_attributes'] = $comAttrbutes;
                                        continue;
                                    }
                                }
                            }
                            // result status 
                            $variation_attributes['attribute_' . $attribute_name][$varChildValue]['disabled'] = $disabled;
                            $variation_attributes['attribute_' . $attribute_name][$varChildValue]['variation_id'] = $variation_id;
                            // unset 
                            unset( $variation_attributes['attribute_' . $attribute_name][$varChildValue]['compare'] );
                        }
                    }

                }
            }
        }
        return  $variation_attributes;
        
    }

    public static function checkAttributeRelation( $productId = '', $attributUnset = '', $attributValue = '' )
    {
        if ( empty ( $attributUnset ) || empty ( $attributValue ) ) {
            return false;
        }

        if ( empty ( $productId ) ) {
            $productId = get_the_ID();
        }

        $findAttributes       = [];
        $variation_attributes = [];
        $product              = wc_get_product( $productId );
        $variations           = $product->get_available_variations();
        foreach ( $product->get_attributes() as $attribute_name  => $attribute ) {
            if ( $attribute['variation'] ) {
                $childItemVariations = $product->get_variation_attributes()[$attribute_name];
                if ( ! empty ( $childItemVariations ) && $attribute_name != $attributUnset ) {
                    foreach ( $childItemVariations as $varChildKey => $varChildValue ) {
                        $varChildTerm = get_term_by( 'slug', $varChildValue, str_replace( 'attribute_', '', $attribute_name ) );
                        if ( ! empty ( $varChildTerm ) ) {
                            $variation_attributes['attribute_' . $attribute_name][$varChildValue] = [
                                'term_id' => $varChildTerm->term_id,
                                'name'    => $varChildTerm->name,
                                'slug'    => $varChildTerm->slug,
                            ];
                        }
                    }

                } 
            }
        }
        return  $variation_attributes;
        
    }

    public static function findVariationId( $productId = [], $attributes = [] )
    {
        $data_store  = WC_Data_Store::load( 'product' );
        $variationId = $data_store->find_matching_product_variation( new \WC_Product( $productId ), $attributes );
        return $variationId;
    }


}