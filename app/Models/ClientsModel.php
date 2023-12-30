<?php
namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ClientsModel extends Model
{
    protected $table = "clients";
    protected $generate;
    protected $allowedFields = ['name', 'email', 'phone', 'address'];

    public function __construct()
    {
        parent::__construct();
        $database = \Config\Database::connect();
        $this->generate = $database->table('clients');
    }

    /**
     * @param $data = {
     *      name,
     *      email,
     *      phone,
     *      address
     * }
     */
    public function insertClient($data)
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