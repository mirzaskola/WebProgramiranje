<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/UserDao.class.php';

use \Firebase\JWT\JWT;

class UserService extends BaseService{


  public function __construct(){
    $this->dao = new UserDao();
  }

  public function get_users($search, $offset, $limit, $order, $total = FALSE){
    return $this->dao->get_users($search, $offset, $limit, $order, $total);
  }

  public function register($user){

    try {
      $this->dao->beginTransaction();
      
      $user = parent::add([
        "user_name" => $user['user_name'],
        "user_mail" => $user['user_mail'],
        "user_password" => md5($user['password']),
        "user_role" => 1,
        "ban_status" => 0,
        "token" => md5(random_bytes(16)),

      ]);

    } catch (\Exception $e) {
      $this->dao->rollBack();
      if (strpos($e->getMessage(), 'user.uq_user_email') !== false) {
        throw new Exception("Account with same email exists in the database", 400, $e);
      }else{
        throw $e;
      }
    }

    $this->dao->commit();
    //send email with some token

    return $user;
  }

  public function confirm($token){
    $user = $this->dao->get_user_by_token($token);
    if (!isset($user['id'])) throw Exception("Invalid token");
    $this->dao->update($user['id'], ["status" => "ACTIVE", "token" => NULL]);
    
     // send email to customer and redirect 

    return $user;
  }


  public function login($user){
    $db_user = $this->dao->get_user_by_email($user["user_email"]);
    if(!isset($db_user["id"])) throw new Exception("User doesn't exist",400);

    if($db_user["user_password"] != md5($user["user_password"])) throw new Exception("Invalid password",400);
    return $db_user;
  }

  public function reset($user){
    $db_user = $this->dao->get_user_by_token($user["token"]);
    if(!isset($db_user["id"])) throw new Exception("Invalid token",400);
    if (strtotime(date(Config::DATE_FORMAT)) - strtotime($db_user['token_created_at']) > 300) throw new Exception("Token expired", 400);
    $this->dao->update($db_user['id'], ['user_password' => md5($user['user_password']), 'token' => NULL]);
    return $db_user;
  }

  public function forgot($user){
    $db_user = $this->dao->get_user_by_email($user["email"]);
    if(!isset($db_user["id"])) throw new Exception("User doesn't exist",400);
    if (strtotime(date(Config::DATE_FORMAT)) - strtotime($db_user['token_created_at']) < 300) throw new Exception("Be patient tokens is on his way", 400);
    //gen token and save
    $db_user = $this->update($db_user['id'], ['token' => md5(random_bytes(16)), 'token_created_at' => date(Config::DATE_FORMAT)]);
    
    //send recovery -todo
    
}

}
?>