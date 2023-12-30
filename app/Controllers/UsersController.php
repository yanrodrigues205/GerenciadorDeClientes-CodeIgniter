<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UsersModel;
use Exception;

class UsersController extends ResourceController
{
    protected $model;
    public function __construct()
    {
        $this->model = new UsersModel();
    }

    /**
     * insert function
     * @method : POST
     */
    public function createUser()
    {
        try
        {
            
            $data_user = [
                "name" => $this->request->getVar("name"),
                "email" => $this->request->getVar("email"),
                "password" => password_hash($this->request->getVar("password"), PASSWORD_DEFAULT)
            ];

            $add = $this->model->insertUser($data_user);
            $user_add = $this->model->where("id", $add)->first();

          

            if(!$add)
            {
                return $this->respond([
                    'statusCode' => 400,
                    'message' => 'internal error in request insert user!',
                ]);
            }

            return $this->respond([
                "statusCode" => 200,
                "error" => false,
                "message" => "created user success!",
                "user" => $user_add
            ]);
        }
        catch(Exception $err)
        {
            return $this->respond([
                "statusCode" => 500,
                "error" => $err,
                "message" => "internal error in request!"
            ]);
        }
    }

    public function verifyUser(): object
    {
        try
        {  
            $email = $this->request->getVar("email"); 
            $password = $this->request->getVar("password"); 
            $verify = $this->model->where("email", $email)->first();

            if(!$verify)
            {
                return $this->respond([
                    'statusCode' => 400,
                    'message' => $email . " does not exist in the system",
                ]);
            }

            $verifyPassword = password_verify($password, $verify['password']);

            if(!$verifyPassword)
            {
                return $this->respond([
                    'statusCode' => 400,
                    'message' => $email . " does not exist in the system",
                ]);
            }

            return $this->respond([
                "statusCode" => 200,
                "error" => false,
                "message" => "successfully verified!",
                "user" => $verify
            ]);
        }
        catch(Exception $err)
        {
            return $this->respond([
                "statusCode" => 500,
                "error" => $err,
                "message" => "internal error in request!"
            ]);
        }
    }
}