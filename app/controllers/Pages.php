<?php
class Pages extends Controller
{
    // property declaration

    // method declaration
    public function __construct() {
        $this->userModel = $this->model('User');
    }
    public function index() {
        $users = $this->userModel->getUsers();
        $data=[
            'title' => 'Home page',
            'users' => $users
        ];
        $this->view('pages/index', $data);
    }
    public function about() {
        $this->view('pages/about');
    }
}
?>
