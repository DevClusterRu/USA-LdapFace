<?php

namespace App\Models;

use CodeIgniter\Model;

class Server extends Model
{
    protected $table = 'servers';
    protected $primaryKey  = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['domain', 'url', 'login', 'password','baseDn'];
    protected $useSoftDeletes = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
