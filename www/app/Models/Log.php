<?php

namespace App\Models;

use CodeIgniter\Model;

class Log extends Model
{
    protected $table = 'logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id', 'log'];
    protected $useSoftDeletes = true;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
