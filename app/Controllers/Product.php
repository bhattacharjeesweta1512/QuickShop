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
        if (!$validation->withRequest($this->request)->run()) {
            // If validation fails, return to the create form with errors
            return redirect()->to('products/create')->withInput()->with('errors', $validation->getErrors());
        } else {
            

            $data = [
                "name" => $this->request->getVar('name'),
                "description" => $this->request->getVar('description'),
                "color" => $this->request->getVar('color'),
                "size" => $this->request->getVar('size'),
            ];
           
            // If validation passes, proceed with storing the product
            // Logic to store the product in the database
            // Redirect to a success page or display a success message
        }
    }
}
