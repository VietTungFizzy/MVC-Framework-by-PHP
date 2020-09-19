<?php
//Core app class
class Core
{
    // property declaration
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    // method declaration
    public function __construct() {
        $url = $this->getURL();

        if (file_exists ('../app/controllers/'. ucwords($url[0], '.php'))) {
            //Will set a new controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }


        if(!empty($this->currentController)) {
            //Require controller
            require_once('../app/controllers/'. $this->currentController .'.php');
            $this->currentController = new $this->currentController; 

            //Check for second part
            if(isset($url[1])) {
                if(method_exists ( $this->currentController ,$url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            //Get parameters
            $this->params = $url ? array_values($url) : [];

            //Call a callback with array of params
            call_user_func_array ([$this->currentController, $this->currentMethod] ,  $this->params);
        }
    }
    public function getURL() {
        if(isset($_GET["url"])) {
            $url = rtrim ( $_GET["url"], '/');    
            $url = filter_var ( $url , FILTER_SANITIZE_URL);
            $url = explode ( '/', $url);
            return $url;
        }
    }
}
?>
