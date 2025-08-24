<?php

namespace Utils;

class Router
{
    protected array $routes = [];
    protected string $uri;
    protected mixed $method;
    public static array $route_params = [];

    public function __construct()
    {
        $this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
        $this->method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @throws \Exception
     */
    public function match(): void
    {
        $isMatches = false;
        foreach ($this->routes as $route) {
            if ((preg_match("#^{$route['uri']}$#", $this->uri, $matches)) && (in_array($this->method, $route['method']))) {
                if ($route['middleware']) {
                    $middleware = MIDDLEWARE[$route['middleware']] ?? false;
                    if (!$middleware) {
                        throw new \Exception("Incorrect middleware {$route['middleware']}");
                    }
                    (new $middleware)->handle(); //IUser;
                }
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        self::$route_params[$key] = $match;
                    }
                }
                $isMatches = true;
                require CONTROLLERS . "/{$route['controller']}";
                break;
            }
        }
        if (!$isMatches) {
            if (preg_match("#^api/\w+#", $this->uri, $matches)) {
                require CONTROLLERS . "/api/no-find-route.php";
            }
            abort();
        }
    }

    public function only(string $middleware = 'auth|guest'): static
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $middleware;
        return $this;
    }

    public function add(string $uri, string $controller, mixed $method): static
    {
        if (is_array($method)) {
            $method = array_map('strtoupper', $method);
        } else {
            $method = [$method];
        }
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
        ];
        return $this;
    }

    public function get(string $uri,string $controller): static
    {
        return $this->add($uri, $controller, 'GET');
    }

    public function post(string $uri, string $controller): static
    {
        return $this->add($uri, $controller, 'POST');
    }

    public function delete(string $uri, string $controller): static
    {
        return $this->add($uri, $controller, 'DELETE');
    }

}