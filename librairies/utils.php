<?php

/**
 * @param string $path
 * @param array $varaibles
 */
function render(string $path, array $varaibles= []){

    extract($varaibles);  // fait en sorte de parser le tab associatifs dans des variables normale

    ob_start();
    require('templates/'. $path .'.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');

}


/**
 * @param string $url
 * @param int|null $param
 */
function redirect(string $url, int $param=null): void
{

    if(!$param)
        header("Location:".$url.".php");
    else
        header("Location:".$url.".php?id=" . $param);


    exit();
}
