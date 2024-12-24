<?php

namespace laundry\App;

class View
{

    public static function render(string $view, $model)
    {
        if($view == "Home/index" || $view == 'User/register' || $view == '/users/login' || $view == 'User/login'){
            require __DIR__ . '/../View/headers.php';
        
        }else{
            
            require __DIR__ . '/../View/header.php';
        }
        require __DIR__ . '/../View/' . $view . '.php';
        require __DIR__ . '/../View/footer.php';
    }

    public static function redirect(string $url)
    {
        header("Location: $url");
        if (getenv("mode") != "test") {
            exit();
        }
    }

}