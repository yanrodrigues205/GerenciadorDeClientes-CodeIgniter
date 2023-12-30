<?php

namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $generate;
    protected $fields = ["name", "email", "password"];

   
    public function __construct(){
        parent::__construct();
        $database = \Config\Database::connect();
        $this->generate = $database->table("users");
    }

    /**
     * @param $data = {
     *      name,
     *      email,
     *      password 
     * }
     */

    public function insertUser($data)
    {
        
        $add = $this->generate->insert($data);
        if($add)
        {
            return $add;
        }
        else
        {
            return false;
        }
    }
}