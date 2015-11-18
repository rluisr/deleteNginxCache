<?php
/*
Plugin Name: delNginxCache
Plugin URI: https://luispc.com/
Description: 記事投稿時にNginxのキャッシュを削除する - When you post new article,delete nginx cache.
Author: luis
Version: 0.1
Author URI:http://luispc.com/
*/

add_action('publish_post', 'delete_nginx_cache');
add_action('admin_menu', 'admin_nginx_cache');

function admin_nginx_cache()
{
    add_menu_page(
        'test',
        'test1',
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
    <h2>deleteNginxCache</h2>
    <form action="" method="post">
        <p><input type="text" name="dir" value="{$dir}" /></p>
        <p><input type="submit" value="Save" /></p>
    </form>
</div>
EOD;

}

function delete_nginx_cache()
{
    $dir = get_option('dir_nginx_cache');
    $fileName = "${dir}/*";
    foreach (glob($fileName) as $a) {
        unlink($a);
    }
}

?>
