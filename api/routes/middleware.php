<?php

//might add guest middleware but not really needed



/* user  middleware */
Flight::route('/user/*', function(){
  try {
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ["HS256"]);
    if (Flight::request()->method != "GET" && $user["user_role"] == 1){
      throw new Exception("Read only user can't change anything.", 403);
    }
    Flight::set('user', $user);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});

/* admin  middleware */
Flight::route('/admin/*', function(){
  try {
    $user = (array)\Firebase\JWT\JWT::decode(Flight::header("Authentication"), Config::JWT_SECRET, ["HS256"]);
    if ($user["user_role"] != 2){
      throw new Exception("Admin access required", 403);
    }
    Flight::set('user', $user);
    return TRUE;
  } catch (\Exception $e) {
    Flight::json(["message" => $e->getMessage()], 401);
    die;
  }
});

?>