<?php


Flight::route('GET /admin/categories', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  $total = Flight::categoryService()->get_categories($search, $offset, $limit, $order, TRUE);
  header('total-categories: ' . $total['total']);
  Flight::json(Flight::categoryService()->get_categories($search, $offset, $limit, $order));
});




Flight::route('POST /admin/categories', function(){
 $data = Flight::request()->data->getData();
 Flight::categoryService()->add_category($data);
});


Flight::route('GET /admin/categories', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  Flight::json(Flight::categoryService()->get_categories($search, $offset, $limit, $order));
});



Flight::route('GET /admin/categories/@id', function($id){
  Flight::json(Flight::categoryService()->get_by_id($id));
});


Flight::route('PUT /admin/categories/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::categoryService()->update($id, $data));
});



Flight::route('GET /user/categories/@id', function($id){
  Flight::json(Flight::categoryService()->get_by_id($id));
});



Flight::route('GET /user/categories', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  Flight::json(Flight::categoryService()->get_categories($search, $offset, $limit, $order));
});



?>