<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends ResourceController
{
    protected AuthModel $authModel;
    public function __construct()
    {
        $this->authModel = new AuthModel();
    }
    public function index() : string
    {
        return view('login');
    }

    public function __init__()
    {
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");

       
    }

    public function remove()
    {
        $session = session();
        $session->destroy();

        return redirect()->to("/");
    }
}