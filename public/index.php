<?php 
require '../vendor/autoload.php';
define('DEBUG_TIME', microtime(true)); 

/*DEBUG*/
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
/*ENDDEBUG*/

if(isset($_GET['page']) && $_GET['page'] === '1'){
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    unset($get['page']);
    $query = http_build_query($get);
    if(!empty($query)){
        $uri = $uri . '?' . $query;
    }
    http_response_code(301);
    header('Location:' . $uri); 
    exit();
}

$router = new App\Router(dirname(__DIR__) . '/views');
$router->get('/', 'post/index', 'home')
    ->get('/blog/category/[*:slug]-[i:id]', 'category/show', 'category')
    ->get('/article/[*:slug]-[i:id]', 'post/show', 'post')
    ->get('/admin', 'admin/index', 'admin')
    ->get('/admin/article/[*:slug]-[i:id]', 'admin/show', 'admin.edit')
    ->get('/admin/article/new', 'admin/new', 'admin.new')
    ->post('/admin/article/[i:id]/delete', 'admin/delete', 'admin.delete')
    ->get('/login', 'login/login', 'login')
    ->get('/logout', 'login/logout', 'logout')
    ->get('/contact', 'pages/contact', 'contact')
    ->post('/login', 'login/login', 'check')
    ->post('/contact', 'pages/contact', 'email')
    ->run();
