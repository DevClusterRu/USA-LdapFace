<?php
namespace App\Models;
use CodeIgniter\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['name', 'username', 'email', 'password', 'role_id','phone'];
    protected $useSoftDeletes = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}