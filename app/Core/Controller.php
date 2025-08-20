<?php

namespace App\Core;

class Controller
{
    /**
     * Rend une vue avec layout
     * 
     * @param string $view Nom de la vue (ex: 'contact/create')
     * @param array $data Données à passer à la vue
     * @param string $layout Layout à utiliser (défaut: 'layout')
     */
    protected function render(string $view, array $data = [], string $layout = 'layout')
    {
        // Rendre les données disponibles dans les vues
        extract($data);

        // Démarrer la capture du contenu
        ob_start();

        // Inclure la vue spécifique
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';

        if (!file_exists($viewPath)) {
            throw new \Exception("Vue non trouvée : {$view}");
        }

        include $viewPath;

        // Récupérer le contenu de la vue
        $content = ob_get_clean();

        // Inclure le layout avec le contenu
        $layoutPath = __DIR__ . '/../Views/' . $layout . '.php';

        if (!file_exists($layoutPath)) {
            throw new \Exception("Layout non trouvé : {$layout}");
        }

        include $layoutPath;
    }
}
