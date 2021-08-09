<?php


Flight::route('GET /admin/ratings', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  $total = Flight::ratingService()->get_ratings($search, $offset, $limit, $order, TRUE);
  header('total-ratings: ' . $total['total']);
  Flight::json(Flight::ratingService()->get_ratings($search, $offset, $limit, $order));
});

Flight::route('GET /ratings/get_avg_rating/@id', function($id){
  Flight::json(Flight::ratingService()->get_avg_rating($id));
});

Flight::route('POST /user/ratings', function(){
  $data = Flight::request()->data->getData();
  Flight::ratingService()->add_post_rating(Flight::get("user"),$data);
  Flight::json(["message"=>"Rating added"]);
});

?>
