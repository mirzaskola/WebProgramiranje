<?php


Flight::route('GET /admin/users', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  $total = Flight::userService()->get_users($search, $offset, $limit, $order, TRUE);
  header('total-records: ' . $total['total']);
  Flight::json(Flight::userService()->get_users($search, $offset, $limit, $order));
});

Flight::route('GET /admin/users/@id', function($id){
  Flight::json(Flight::userService()->get_by_id($id));
});


Flight::route('PUT /admin/users/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::userService()->update($id, $data));
});


Flight::route('GET /user/info', function(){
  Flight::json(Flight::userService()->get_by_id(Flight::get("user")["id"]));
});


Flight::route('POST /register', function(){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::userService()->register($data));
});


Flight::route('GET /confirm/@token', function($token){
  Flight::json(Flight::jwt(Flight::userService()->confirm($token)));
});




Flight::route('POST /login', function(){
  Flight::json(Flight::jwt(Flight::userService()->login(Flight::request()->data->getData())));
});



 Flight::route('POST /forgot', function(){
  $data = Flight::request()->data->getData();
  Flight::userService()->forgot($data);
  //send reset message
  Flight::json(["message" => "Resetting your account"]);
});



Flight::route('POST /reset', function(){
  Flight::json(Flight::jwt(Flight::userService()->reset(Flight::request()->data->getData())));
});

Flight::route('GET /user/info', function(){
  Flight::json(Flight::userService()->get_by_id(Flight::get("user")["id"]));
});

?>