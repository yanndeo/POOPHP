
<?php

    class Http {



        /**
         * @param string $url
         * @param int|null $param
         */
        public static function redirect(string $url, int $param=null): void
        {

            if(!$param)
                header("Location:".$url);
            else
                header("Location:".$url.".php?id=" . $param);


            exit();
        }

    }