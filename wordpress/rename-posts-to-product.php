<?php

function rename_posts_to_products($args, $post_type)
{
    if ($post_type === 'post') {
        $args['labels']['name'] = 'Products';
        $args['labels']['singular_name'] = 'Product';
        $args['menu_icon'] = 'dashicons-portfolio'; // You can choose a different dashicon
    }
    return $args;
}
add_filter('register_post_type_args', 'rename_posts_to_products', 10, 2);