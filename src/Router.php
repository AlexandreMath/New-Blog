<?php
namespace App;

class Router 
{
    /**
     * @var String
     */
    private $viewPath;

    /**
     * @var AltoRouter
     */
    private $router;
    
    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new \AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }

    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }

    public function url(string $name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }

    public function run(): self
    {
        $css = '/css/';
        $match = $this->router->match();
        $view = $match['target'];
        $params = $match['params'];
        $router = $this;
        ob_start();
        require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
        $content = ob_get_clean();
        if($match['name'] === 'admin'){
            require $this->viewPath . DIRECTORY_SEPARATOR . 'admin/dashboard.php';
        }
        else{ require $this->viewPath . DIRECTORY_SEPARATOR . 'layouts/default.php'; }
        return $this;
    }
}
