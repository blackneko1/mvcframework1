<?php
class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }
 
    public function register (){
        $data = [
            'lastname' => '',
            'firstname' => '',
            'addresss' => '',
            'contact' => '',
            'email' => '',
            'passwordd' => '',
            'confirmPassword' => '',
            'lastnameError' => '',
            'firstnameError' => '',
            'addressError' => '',
            'contactError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'lastname' => trim($_POST['lastname']),
                'firstname' => trim($_POST['firstname']), 
                'addresss' => trim($_POST['addresss']),
                'contact' => trim($_POST['contact']),
                'email' =>  trim($_POST['email']),
                'passwordd' =>  trim($_POST['passwordd']),
                'confirmPassword' =>  trim($_POST['confirmPassword']),
                'lastnameError' => '',
                'firstnameError' => '',
                'addressError' => '',
                'contactError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];

            $nameValidation = "/^[a-z ,.'-]+$/i";
            $passwordValidation ="/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
            $contactValidation ="/[0-9]/";  
            //Validate username on letters
            if(empty($data['lastname'])){
                $data['lastnameError'] = 'Please enter Last Name.';
            }elseif(!preg_match($nameValidation, $data['lastname'])){
                $data['lastnameError'] = 'Last Name can only contain Letters.';
            }
            //validate addresss
            if(empty($data['addresss'])){
                $data['addressError'] = 'Please enter address';
            }
            //Validate firstname on letters
            if(empty($data['firstname'])){
                $data['firstnameError'] = 'Please enter First Name.';
            }elseif(!preg_match($nameValidation, $data['firstname'])){
                $data['firstnameError'] = 'First Name can only contain Letters.';
            }
            //Contact number validation
            if(empty($data['contact'])){
                $data['contactError'] = 'Please enter Contact Number.';
            }elseif(!preg_match($contactValidation, $data['contact'])){
                $data['contactError'] = 'contact number can only contain numbers.';
            }
            //Validate email
            if(empty($data['email'])){
                $data['emailError'] = 'Please enter email address.';
            }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['emailError'] = 'Please enter the correct format.';
            }else{
                //check if email exists
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['emailError'] = 'Email is already exist.';
                }
            }
            //Validate password on length and numeric values
            if(empty($data['passwordd'])){
                $data['passwordError'] = 'Please enter password.';
            }elseif(strlen($data['passwordd']) < 6 ){
                $data['passwordError'] = 'Password must be at least 8 characters.';
            }elseif(!preg_match($passwordValidation, $data['passwordd'])){
                $data['passwordError'] = 'Minimum eight characters, at least one letter and one number:.';
            }
            
            //Validation confirm password
            if(empty($data['confirmPassword'])){
                $data['confirmPasswordError'] = 'Please enter password.';
            }else{
                if($data['passwordd'] != $data['confirmPassword']){
                 $data['confirmPasswordError'] = 'Password do not match.';    
                }
            }
            //Make sure that erros are empty
            if(empty($data['lastnameError']) && empty($data['firstnameError']) && empty($data['addressError']) && empty($data['contactError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])){

                //hash password
                $data['passwordd'] = password_hash($data['passwordd'], PASSWORD_DEFAULT);
                //Register user from model function 
                if($this->userModel->register($data)){
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login');
                } else{
                    die('Something went wrong.');
                }
            }

        }

        $this->view('users/register', $data);

    }
    public function login(){
        $data = [
            'title' => 'Login page',
            'email' => '',
            'passwordd' => '',
            'emailError' => '',
            'passwordError' => ''
        ];
        //CHECK FOR POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //SANITIZE POST DATA
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'passwordd' => trim($_POST['passwordd']),
                'emailError' => '',
                'passwordError' => '',
            ];
            //validate email
            if(empty($data['email'])){
                $data['emailError'] = 'Please enter your email.';    
            }
            //validate password
            if(empty($data['passwordd'])){
                $data['passwordError'] = 'Please enter your password.';    
            }
            //check if all errors are empty
            if(empty($data['emailError']) && empty($data['passwordError'])){
                $loggedInUser = $this->userModel->login($data['email'], $data['passwordd']);
                
                if($loggedInUser){
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['passwordError'] = 'Password or Username Incorrect. Please try again.';
                    $this->view('users/login', $data);
                }
            }
        }else {
            $data = [
                'email' => '',
                'passwordd' => '',
                'emailError' => '',
                'passwordError' => ''
            ];
        }

        $this->view('users/login', $data);
    }
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->sh_id;
        $_SESSION['lastname'] = $user->lastname;
        $_SESSION['firstname'] = $user->firstname;
        $_SESSION['addresss'] = $user->addresss;
        $_SESSION['contact'] = $user->contact_num;
        $_SESSION['email'] = $user->email;
        header('location:' . URLROOT . '/pages/index');
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['lastname']);
        unset($_SESSION['firstname']);
        unset($_SESSION['addresss']);
        unset($_SESSION['contact']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/users/login');
    }

}