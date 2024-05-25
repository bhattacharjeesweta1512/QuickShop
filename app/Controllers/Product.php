<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;

class Product extends Controller
{
    public function create()
    {
        // Load the form view
        return view('product_form');
    }

    public function store()
    {
       
        // Load the validation library
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[255]',
            'description' => 'max_length[1000]',
        ]);

        // Validate the input
        // if (!$validation->withRequest($this->request)->run()) {
        //     $ret['message'] = "Duplicate Name found";
        //     $ret['status'] = 0;
            
        // } else {
            $name = $this->request->getVar('name');

            $data = [
                "name" => $this->request->getVar('name'),
                "description" => $this->request->getVar('description'),
                "brand" => $this->request->getVar('brand'),
                "size" => $this->request->getVar('size'),
            ];
           
            $ProductModel  = new ProductModel();
            if ($ProductModel->isNameExists($name)) {
                $ret['message'] = "Name Already exists";
                $ret['status'] = 0;
            }
            $rs = $ProductModel->insert_data($data);
           
            if($rs>0){
                $ret['message'] = "Product Added successfully";
                $ret['status'] = 1;
            }else{
                $ret['message'] = "Product Not Added successfully";
                $ret['status'] = 0;
            }
            return $this->response->setJSON($ret);
            // If validation passes, proceed with storing the product
            // Logic to store the product in the database
            // Redirect to a success page or display a success message
        // }
    }
    public function getProducts()
    {
        
        $productModel = new ProductModel();
        $rs = $productModel->fetch_all(); // Fetch all products from the database
        
        return $this->response->setJSON($rs); // Return products as JSON response
    }
}
