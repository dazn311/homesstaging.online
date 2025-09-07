<?php

namespace Utils;

class Router
{
    protected array $spParams = [];
    protected array $routes = [];
    protected string $params;
    protected string $uri;
    protected mixed $method;
    public static array $route_params = [];

    public function __construct()
    {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'],'/');
        $this->params = trim(parse_url($_SERVER['REQUEST_URI'])['query'] ?? '');//document=4
        $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @throws \Exception
     */
    public function match(): void
    {
        $isMatches = false;

        if (empty($this->uri) && empty($this->params) && ($this->method == 'GET')) {
            require CONTROLLERS . "/pages/index.php";
            die();
        }
        foreach ($this->routes as $route) {
            if (empty($route['uri']) && (in_array($this->method, $route['method']))) {
                if ($route['middleware']) {
                    $middleware = MIDDLEWARE[$route['middleware']] ?? false;
                    if (!$middleware) {
                        throw new \Exception("Incorrect middleware {$route['middleware']}");
                    }
                    (new $middleware)->handle(); //IUser;
                }
                if ($this->params && $route['params']) { //'documents=2'
                    if (preg_match("#{$route['params']}#", $this->params, $matches)) {

                        if (isset($matches['key']) && isset($matches['id'])) {
                            $isMatches = true;
                            $key = $matches['key'];
                            $id = $matches['id'];
                            self::$route_params[$key] = $id;
                            if ($this->method == 'GET') {
                                require CONTROLLERS . '/' . $route['controller'] . ".php";
                                die();
                            }
                            if ($this->method == 'POST') {
                                require CONTROLLERS . '/' . $route['controller'] . ".php";
                                die();
                            }

                        }
                    }
                }
            }
        }
        if (!$isMatches) {
            require CONTROLLERS . "/api/no-find-route.php";
            abort();
        }
    }

    public function only(string $middleware = 'auth|guest'): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

    public function add(string $uri, string $params, string $controller, mixed $method): static
    {
        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [strtoupper($method)];
        }
        $this->routes[] = [
            'uri' => $uri,
            'params' => $params,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];
        return $this;
    }

    public function get(string $uri, string $params,string $controller): static
    {
        return $this->add($uri, $params, $controller, 'GET');
    }

    public function post(string $uri, string $params, string $controller): static
    {
        return $this->add($uri, $params, $controller, 'POST');
    }

    public function delete(string $uri, string $params, string $controller): static
    {
        return $this->add($uri, $params, $controller, 'DELETE');
    }

}