<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;


class Product extends Controller
{
    

    public function create()
    {
        

        // Load the form view
        return view('product_form');
    }
    public function store()
    {
      
        helper('security');
        
        // Load the validation library
        $validation = \Config\Services::validation();

        // Set validation rules
        $validation->setRules([
            'name' => 'required|max_length[50]',
            'description' => 'required|max_length[255]',
            'brand' => 'required|max_length[50]',
            'size' => 'required'
        ]);

        // Validate the input
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed
            $errors = $validation->getErrors();
            return $this->response->setJSON(['message' => 'Please fill all the data' ]);
        }

        // CSRF token validation (assuming you have a method named validateCSRFToken())
        if (!$this->validateCSRFToken()) {
            return $this->response->setJSON(['message' => 'CSRF token validation failed']);
        }

        // Retrieve form data
        // filte sanitize string replaced by htmlspecialchars
        $name = htmlspecialchars($this->request->getVar('name'));
        $username = htmlspecialchars($this->request->getVar('hidden_username'));
        $description = htmlspecialchars($this->request->getVar('description'));
        $brand = htmlspecialchars($this->request->getVar('brand'));
        $size = htmlspecialchars($this->request->getVar('size'));

        // Check if the name already exists
        $productModel = new ProductModel();
        if ($productModel->isNameExists($name)) {
            return $this->response->setJSON(['message' => 'Name already exists', 'status' => 0]);
        }
           
        // Insert data into the database
        $data = [
            "username" => $username,
            "name" => $name,
            "description" => $description,
            "brand" => $brand,
            "size" => $size,
            
        ];
        $result = $productModel->insert_data($data);

        // Check if data insertion was successful
        if ($result) {
            return $this->response->setJSON(['message' => 'Product added successfully', 'status' => 1]);
        } else {
            return $this->response->setJSON(['message' => 'Product not added successfully', 'status' => 0]);
        }
    }






    public function uploadCSV()
    {   
       
        $uploadedFiles = $this->request->getVar();
       

        foreach ($uploadedFiles['csv_file'] as $file) {
            if ($file->isValid() && $file->getExtension() === 'csv') {
                // Load the CSV file
                $csv = array_map('str_getcsv', file($file->getTempName()));

                // Remove header row if needed
                array_shift($csv);

                // Process each row
                foreach ($csv as $row) {
                    $productName = $row[0];
                    $productDescription = $row[1];
                    // Add more fields as needed...

                    // Check if the product exists
                    $ProductModel = new ProductModel();
                    $existingProduct = $ProductModel->where('name', $productName)->first();

                    if ($existingProduct) {
                        $ProductModel = new ProductModel();
                        // Update existing product
                        $ProductModel->update($existingProduct['id'], [
                            'description' => $productDescription,
                            // Update other fields as needed...
                        ]);
                    } else {
                        // Insert new product
                        $ProductModel->insert([
                            'name' => $productName,
                            'description' => $productDescription,
                            // Insert other fields as needed...
                        ]);
                    }
                }
            } else {
                return redirect()->back()->withInput()->with('error', 'Please upload valid CSV files.');
            }
        }

        return redirect()->to(site_url('product'))->with('success', 'Products uploaded and updated successfully.');
    }
    private function validateCSRFToken()
    {
        $token = $this->request->getPost(csrf_token());
        return ($token);
    }
    public function getProducts()
    {
    
    
        
        $productModel = new ProductModel();
        $rs = $productModel->fetch_all(); // Fetch all products from the database
        
        return $this->response->setJSON($rs); // Return products as JSON response
    
        
    }
    public function fetchProductDetails($productId)
    {
        // Load the ProductModel
        $productModel = new ProductModel();
            
        // Fetch product details from the database
        $rs = $productModel->find_product($productId);

        if ($rs) {
            // If product found, return it as JSON response
            return $this->response->setJSON($rs);
        } else {
            // If product not found, return error response
            return $this->response->setJSON('Product not found');
        }
    }
    public function updateProducts()
    { 
        $id = $this->request->getVar('edit_id');
        $data = [
           
            "description" => $this->request->getVar('edit_description'),
        "brand" =>  $this->request->getVar('edit_brand'),
        "size" =>  $this->request->getVar('edit_size')
    ];
    $productModel = new ProductModel();
    $rs = $productModel->update_product($data,$id);
   
    if($rs >0){
        $ret['status'] = 1;
        $ret['message'] = "Product Updated Successfully";
    }else{
        $ret['status'] = 0;
        $ret['message'] = "Product Not Updated Successfully";
    }

    return $this->response->setJSON($ret);

        
    }
    public function delete($id)
{
    
   $productModel = new ProductModel();

        // Delete the product by ID
        $rs = $productModel->delete_data($id);
        if($rs > 0 ) {
            $ret['status']  = 1;
            $ret['message'] = "Product deleted successfully";
        }else{
            $ret['status']  = 0;
            $ret['message'] = "Product Not deleted successfully";
        }
        return $this->response->setJSON($ret);}
    // Load the product model
   

   
}
class ProductController extends ResourceController
{
    protected $modelName = 'App\Models\ProductModel';
    protected $format = 'json';

    public function index()
    {
        // Retrieve all products
        $model = new ProductModel();
        $products = $model->findAll();
        
        return $this->respond($products);
    }

    public function create()
    {
        // Handle product creation
        $model = new ProductModel();
        $data = $this->request->getJSON();
        $product = $model->insert($data);

        return $this->respondCreated($product);
    }

    public function update($id = null)
    {
        // Handle product update
        $model = new ProductModel();
        $data = $this->request->getJSON();
        $product = $model->update($id, $data);

        return $this->respond($product);
    }

    public function delete($id = null)
    {
        // Handle product deletion
        $model = new ProductModel();
        $model->delete($id);

        return $this->respondDeleted();
    }

}
