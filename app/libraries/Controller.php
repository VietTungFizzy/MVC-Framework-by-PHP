<?php
class Controller {
    /**
     * Instantiate model
     * 
     * @param model
     * 
     * @return an instance of a model
     */
    public function model($model) 
    {
        require_once('../app/models/'.$model. '.php');
        return new $model();
    }

    /**
     * Load a view
     * 
     * @param name_of_view,  data 
     */
    public function view($view, $data=[]) {
        if (file_exists ('../app/views/'.$view.'.php')) {
            require_once('../app/views/'.$view.'.php');
        } else {
            exit("Views does not exists");
        }
    }
}
?>