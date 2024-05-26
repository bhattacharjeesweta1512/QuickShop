<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'product';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description','brand','size','doc','dou','username'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function insert_data($data){
       return  $rs = $this->insert($data);
    }
    public function isNameExists($name)
    {
        return $this->where('name', $name)->countAllResults() > 0;
    }
    public function fetch_all()
    {
        return $this->select('*')->orderBy('id', 'DESC')->findAll();
    }
    public function find_product($productId)
    {
       return  $this->find($productId);
    }
    public function update_product($data,$id)
    {
       
        if (!empty($data)) {
            // Perform the update operation
            return $rs = $this->set($data)->where('id', $id)->update();
        } else {
            // Return an error message or handle the empty data case accordingly
            return "No data provided for update";
        }
       
    }
    public function delete_data($id)
    {
     
     return $rs = $this->where("id",$id)->delete();
    
       
    }
}
