<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use Exception;
use App\Models\ClientsModel;

class ClientsController extends ResourceController
{
    protected $model;
  
    public function __construct()
    {
        $this->model = new ClientsModel();
    }

    /**
     * index function
     * @method : GET 
     */
    public function index()
    {
        return view("clients");
    }


    public function getAllClients()
    {
        $clients['data_clients'] = $this->model->orderBy('id', 'DESC')->findAll();
        return json_encode($clients);
    }

    /**
     * insert function
     * @method : POST
     */
    public function insert()
    {
        try{
            
            $data_client = [
                "name" => $this->request->getVar("name"),
                "email" => $this->request->getVar("email"),
                "phone" => $this->request->getVar("phone"),
                "address" => $this->request->getVar("address")
            ];

          
            $add = $this->model->insertClient($data_client);
            $client = $this->model->where("id", $add)->first();

            return $this->respond([
                "statusCode" => 200,
                "error" => false,
                "message" => "created user success!",
                "client" => $client
            ]);

            if(!$add)
            {
                return $this->respond([
                    "statusCode" => 400,
                    "error" => true,
                    "message" => "internal error in request insert client!",
                ]);
            }
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