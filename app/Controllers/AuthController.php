<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{

    public function show()
    {      
        return view('login');
       
    }
    public function login()
    {      
       
        // Load the required helpers and services
        helper('form');
        $session = \Config\Services::session();

        // Check if the form is submitted

            // Retrieve input data
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            // Load the UserModel
            $userModel = new UserModel();
           
            // Retrieve user data by username
            $user = $userModel->getUserByUsername($username);
           

            if ($user && (md5($password)==$user['password_hash'])) {
               
                // Authentication successful
                $session->set('isLoggedIn', true);
                $session->set('username', $username);
               
                if ($this->request->getUserAgent() !== $session->userAgent) {
                    $session->regenerate(true); // Regenerate session ID
                    
                }
                $ret['message'] ="You are successfully logged in ";
                $ret['status'] = 1;
                $ret['username'] =$_SESSION['username'];
                $ret['isLoggedIn'] =$_SESSION['isLoggedIn'];
               return $this->response->setJSON($ret);

            } else {
                // Authentication failed
              
                $data['error'] = 'Invalid username or password';
            }
        

       
    }

    public function logout()
    {
        // Load the session service
        $session = \Config\Services::session();

        // Destroy session data
        $session->destroy();

        return redirect()->to('/');
    }
}
