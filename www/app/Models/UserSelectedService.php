<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSelectedService extends Model
{
    protected $table = 'user_selected_services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['user_id', 'service_id'];
    protected $useSoftDeletes = true;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
