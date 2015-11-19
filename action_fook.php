<?php
/*
 * This file is Wordpress API or Action fook list.
 */

add_action('post_updated', 'delete_nginx_cache');
add_action('create_category', 'delete_nginx_cache');
add_action('trashed_post', 'delete_nginx_cache');
add_action('untrashed_post', 'delete_nginx_cache');
add_action('deleted_post', 'delete_nginx_cache');
add_action('post_updated', 'delete_nginx_cache');
add_action('publish', 'delete_nginx_cache');
add_action('admin_menu', 'admin_nginx_cache');

?>