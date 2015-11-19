<?php
/*
Plugin Name: deleteNginxCache
Plugin URI: https://luispc.com/
Description: シンプルに分かりやすく記事投稿時にNginxのキャッシュを削除する - The simple. When you post new article or update, delete nginx cache to reflect changes.
Author: rluisr
Version: 1.0.0
Author URI:http://luispc.com/
*/

require_once 'action_fook.php';

function admin_nginx_cache()
{
    add_menu_page(
        'deleteNginxCache', //Tab
        'deleteNginxCache', //Dashboard
        'administrator',
        'deleteNginxCache',
        'menu_nginx_cache'
    );
}

function menu_nginx_cache()
{
    if (isset($_POST['dir']) && check_admin_referer('check_referer')) {
        update_option('dir_nginx_cache', $_POST['dir']);
    }
    $dir = get_option('dir_nginx_cache');
    $wp_n = wp_nonce_field('check_referer');
    echo <<<EOD
<div>
    <h1>deleteNginxCache</h1>
    <p>----------------------------------------------------------------------------------------------</p>
    <form action="" method="post">
    {$wp_n}
        <h2>Where is Cache directory of Nginx?</h2>
        <p>Example: /var/cache/nginx</p>
        <p><input type="text" name="dir" value="{$dir}" /></p>
        <p><input type="submit" value="Save" /></p>
    </form>
    <p>----------------------------------------------------------------------------------------------</p>
    <p>If you have any problems, Please contact me <a href="https://twitter.com/lu_iskun">@lu_iskun</a> or <a href="https://github.com/rluisr/deleteNginxCache">github</a>.</p>
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
            @rrmdir($file);
        else
            @unlink($file);
    }
    rmdir($dir);
}
?>
