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

    public function getCLientByID($id = null)
    {
        $client = $this->model->where("id", $id)->first();

        if($client)
        {
            return $this->respond([
                "statusCode" => 200,
                "error" => false,
                "message" => "created user success!",
                "client" => $client
            ]);
        }

        return $this->respond([
            "statusCode" => 400,
            "error" => true,
            "message" => "internal error in request get client by id!",
        ]);
    }

    public function alter()
    {
        try
        {
            $id = $this->request->getVar("id");
            $dataRequest = [
                "name" => $this->request->getVar("name"),
                "email" => $this->request->getVar("email"),
                "phone" => $this->request->getVar("phone"),
                "address" => $this->request->getVar("address")
            ];
            $update = $this->model->update($id, $dataRequest);

            if($update != false)
            {
                $data = $this->model->where('id', $id)->first();
                return $this->respond([
                    "statusCode" => 200,
                    "error" => false,
                    "message" => "created user success!",
                    "client" => $data
                ]);
            }

            return $this->respond([
                "statusCode" => 400,
                "error" => true,
                "message" => "internal error in request edit client!",
            ]);
        }
        catch(Exception $err)
        {

            return $this->respond([
                "statusCode" => 500,
                "error" => $err,
                "message" => "internal error in request edit client!",
            ]);
        }
        
    }
    
    public function drop()
    {
        try
        {
            $id = $this->request->getVar("id");
            $delete = $this->model->where('id', $id)->delete();

            if(!$delete)
            {
                return $this->respond([
                    "statusCode" => 400,
                    "error" => false,
                    "message" => "error in drop user!"
                ]);
            }

            return $this->respond([
                "statusCode" => 200,
                "error" => false,
                "message" => "successfull!",
                "id" => $id

            ]);

        }
        catch(Exception $err)
        {
            return $this->respond([
                "statusCode" => 500,
                "error" => $err,
                "message" => "internal error in request drop client!",
            ]);
        }
    }

}