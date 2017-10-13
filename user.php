<?php


  class User 
  {

      private $_validation_key, $_email, $_user_fname, $_user_lname;
      private $_user_id, $_user_passwrd; 


      public function __construct($uid, $password)
      {                     
         $this->_user_id = $uid;
         $this->_user_passwrd = $password;        
        
       }//end of constructor


       
        /* 
            if password matches hashed value in user database table,
            then password is valid
        */  
       
        private function is_password_valid() {   
           /* need to add validation logic here */         
           return true;
        }

        public function is_logged_in() {
           if(is_password_valid()){
              return true;
           }
           return false;
        }

        /* use md5 to generate email key */
        private function generate_key() {
           return md5(uniqid(rand(), true));
        }
     
        /* when new user is created, an email is sent to the new user to validate email */
        public function validate_key($key) {
            /* need to add logic to validate key in registration email */
            return true;
        }
       
        public get_first_name() {
           return $_user_fname;
        }
     
        public get_last_name() {
           return $_user_lname;
        }

        public get_user_email() {
           return $_email;
        }
        
  }
?>
