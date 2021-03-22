<?php
    class User {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }
        public function register($data){
            $this->db->query('INSERT INTO register (lastname, firstname, addresss, contact_num, email, passwordd) 
            VALUES(:lastname, :firstname, :addresss, :contact, :email, :passwordd)');
            //Bind Values
            $this->db->bind(':lastname', $data['lastname']);
            $this->db->bind(':firstname', $data['firstname']);
            $this->db->bind(':addresss', $data['addresss']);
            $this->db->bind(':contact', $data['contact']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':passwordd', $data['passwordd']);
            //Execute the function
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        public function login($email, $passwordd){
            $this->db->query('SELECT * FROM register WHERE email = :email');
           
            //bind value
            $this->db->bind(':email', $email);
            
            $row = $this->db->single();
            
            $hashedPassword = $row->passwordd;
            
            if(password_verify($passwordd, $hashedPassword)){
                return $row;
            }else{
                return false;
            }

        }
        //find user by email. Email is passed in by the controller
        public function findUserByEmail($email){
            //Prepared statement
            $this->db->query('SELECT * FROM register WHERE email = :email');
            //Email param will be binded with the email variable
            $this->db->bind(':email', $email);
            //Check if email is already registered
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }

        
       
    }
