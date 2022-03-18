<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSelectedGroup extends Model
{
    protected $table = 'user_selected_group';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['user_id', 'group_id'];
    protected $useSoftDeletes = false;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
