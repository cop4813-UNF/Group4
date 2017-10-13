
<?php

 
/*
 * This class object contains the functions to authenticate 
 * the user through hashing of passwords
 */


class Hash {    
  private static $salt_prefix;
  private static $salt_length;
  
  public static function init(){
    self::hash_select();    
    
  }
  
  public static function hash_function($value){
     $value = Validate::validate_string($value);
     $salt = substr(SALT, 1, self::$salt_length);
     return crypt($value, $salt);    
  }
  
  /* uses the CRYPT_BLOWFISH algorithm to hash the password */
  public static function hash_password($password){
    $options = [
    'cost' => 12,
    ];
    $password = Validate::validate_string($password);
    return password_hash($password, PASSWORD_BCRYPT, $options);
  }
  
  public static function verify_password_hash($password, $hash){
    try {
      $password = Validate::validate_string($password);
      if(! empty($password)){
         if(password_verify($password, $hash)){
            return TRUE;
         }else{
           throw new Exception("Entered password is invalid");
         }      
      }      
    }catch(Exception $e){
       Error::set_error('password', $e->getMessage());
    }
  }
  
  /* defines salt for available hashing algorithms */
  private static function hash_select(){
    try {
        if(CRYPT_BLOWFISH == 1){
          self::$salt_prefix = '$2a$10$';
          self::$salt_length = 22;
        }
        
        elseif(CRYPT_SHA512 == 1){
            self::$salt_prefix  = '$6$rounds=5000$';
            self::$salt_length = 25;
        }
        
        elseif(CRYPT_SHA256 == 1){
           self::$salt_prefix = '$5$rounds=5000$';
           self::$salt_length = 25;
        }
        elseif(CRYPT_EXT_DES == 1){
           self::$salt_prefix  =  '_J9';  
           self::$salt_length = 4;
        }
       
        elseif(CRYPT_STD_DES == 1){
            self::$salt_prefix  =  '';  
            self::$salt_length = 2;
        }
         
        elseif(CRYPT_MD5 == 1) {
           self::$salt_prefix =  '$1$';  
           self::$salt_length = 9;
        }else{
            self::$salt_prefix  = NULL;
            throw new Exception("No hashing algorithms available!");
        }          
    
    }catch(Exception $e){
      echo "Error: " . $e->getMessage();
    }
  } //end hash_select method
} //end hash class
?>
