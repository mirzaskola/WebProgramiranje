<?php?><?php



Flight::route('GET /admin/posts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  $total = Flight::postService()->get_posts($search, $offset, $limit, $order, TRUE);
  header('total-posts: ' . $total['total']);
  Flight::json(Flight::postService()->get_posts($search, $offset, $limit, $order));
});




Flight::route('GET /posts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  Flight::json(Flight::postService()->get_posts($search, $offset, $limit,$order));
});


Flight::route('POST /admin/posts', function(){
 $data = Flight::request()->data->getData();
 Flight::postService()->add_post($data);
});


Flight::route('GET /admin/posts', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  Flight::json(Flight::postService()->get_posts($search, $offset, $limit, $order));
});


 Flight::route('GET /admin/posts/@id', function($id){
  Flight::json(Flight::postService()->get_by_id($id));
});


Flight::route('PUT /admin/posts/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::postService()->update($id, $data));
});

?>