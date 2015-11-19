<?php
/*
Plugin Name: deleteNginxCache
Plugin URI: https://luispc.com/
Description: 記事投稿時にNginxのキャッシュを削除する - When you post new article or update, delete nginx cache to reflect changes.
Author: luis
Version: 1.0.0
Author URI:http://luispc.com/
*/

add_action('post_updated', 'delete_nginx_cache');
add_action('create_category', 'delete_nginx_cache');
add_action('trashed_post', 'delete_nginx_cache');
add_action('untrashed_post', 'delete_nginx_cache');
add_action('deleted_post', 'delete_nginx_cache');
add_action('post_updated', 'delete_nginx_cache');
add_action('publish', 'delete_nginx_cache');
add_action('admin_menu', 'admin_nginx_cache');

function admin_nginx_cache()
{
    add_menu_page(
        'deleteNginxCache', //タブとかの表示名
        'deleteNginxCache', //ダッシュボードでの表示名
        'administrator',
        'deleteNginxCache',
        'menu_nginx_cache'
    );
}

function menu_nginx_cache()
{
    if (isset($_POST['dir'])) {
        update_option('dir_nginx_cache', $_POST['dir']);
    }
    $dir = get_option('dir_nginx_cache');
    echo <<<EOD
<div>
    <h1>deleteNginxCache</h1>
    <p>----------------------------------------------------------------------------------------------</p>
    <form action="" method="post">
        <h2>Where is Cache directory of Nginx?</h2>
        <p>Example: /var/cache/nginx</p>
        <p><input type="text" name="dir" value="{$dir}" /></p>
        <p><input type="submit" value="Save" /></p>
    </form>
    <p>----------------------------------------------------------------------------------------------</p>
    <p>If you have any problems, Please contact me @lu_iskun or github.</p>
</div>
EOD;

}

function delete_nginx_cache()
{
    $dir = get_option('dir_nginx_cache');
    rrmdir($dir);
}

function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}
?>
