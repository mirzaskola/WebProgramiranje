<?php


Flight::route('GET /comments', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  $total = Flight::commentService()->get_comments($search, $offset, $limit, $order, TRUE);
  header('total-comments: ' . $total['total']);
  Flight::json(Flight::commentService()->get_comments($search, $offset, $limit, $order));

});



 Flight::route('GET /comments/post_comment/@id', function($id){
  Flight::json(Flight::commentService()->get_comments_by_post_id($id));
});


 Flight::route('POST /user/comments', function(){
  $data = Flight::request()->data->getData();
  Flight::commentService()->add_comment(Flight::get("user"),$data);
  Flight::json(["message"=>"Comment succsessfully added"]);
});



 Flight::route('GET /user/comments/@id', function($id){
  Flight::json(Flight::commentService()->get_comment_by_comment_id(Flight::get("user")["id"], $id));
});


Flight::route('PUT /user/comments/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::commentService()->update_comment(Flight::get("user"), $id, $data));
});
?>