<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $pattern, callable $callback)
    {
        $this->routes['GET'][$pattern] = $callback;
    }

    public function post(string $pattern, callable $callback)
    {
        $this->routes['POST'][$pattern] = $callback;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_GET['uri'] ?? '/';

        // Nettoyer le chemin des slashes de fin
        $path = rtrim($path, '/');
        if (empty($path)) {
            $path = '/';
        }

        // Parcourir toutes les routes de la méthode HTTP
        foreach ($this->routes[$method] ?? [] as $pattern => $callback) {
            // Vérification exacte d'abord (pour les routes simples)
            if ($pattern === $path) {
                call_user_func($callback);
                return;
            }

            // Support des regex : convertir le pattern en regex
            $regexPattern = $this->convertToRegex($pattern);

            // Tester si le chemin correspond au pattern regex
            if (preg_match($regexPattern, $path, $matches)) {
                // Supprimer le match complet (index 0)
                array_shift($matches);

                // Appeler le callback avec les paramètres capturés
                call_user_func_array($callback, $matches);
                return;
            }
        }

        // Aucune route trouvée
        http_response_code(404);
        echo "Page not found";
    }

    /**
     * Convertit un pattern de route en expression régulière
     */
    private function convertToRegex(string $pattern): string
    {
        // Échapper les caractères spéciaux regex sauf nos placeholders
        $pattern = preg_quote($pattern, '#');

        // Remplacer les placeholders échappés par leurs regex
        $pattern = str_replace('\(\[0\-9\]\+\)', '([0-9]+)', $pattern);
        $pattern = str_replace('\(\[a-zA-Z0-9\]\+\)', '([a-zA-Z0-9]+)', $pattern);

        // Ancrer le pattern au début et à la fin
        return '#^' . $pattern . '$#';
    }
}
