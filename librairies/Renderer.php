<?php




class Renderer {




        /**
         * @param string $path
         * @param array $varaibles
         */
    public static function render(string $path, array $varaibles= []){

        extract($varaibles);  // fait en sorte de parser le tab associatifs dans des variables normale

        ob_start();
        require('templates/'. $path .'.html.php');
        $pageContent = ob_get_clean();

        require('templates/layout.html.php');

    }
}
