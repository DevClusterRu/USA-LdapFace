<?php

namespace App\Models;

use CodeIgniter\Model;

class Group extends Model
{
    protected $table = 'group_policy';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['group_name', 'company_id','dn','group_description'];
    protected $useSoftDeletes = false;
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}
