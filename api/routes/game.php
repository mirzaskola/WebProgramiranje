<?php



Flight::route('GET /admin/games', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  $total = Flight::gameService()->get_games($search, $offset, $limit, $order, TRUE);
  header('total-games: ' . $total['total']);
  Flight::json(Flight::gameService()->get_games($search, $offset, $limit, $order));
});



Flight::route('GET /games', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-game_name");
  Flight::json(Flight::gameService()->get_games($search, $offset, $limit, $order));
});


Flight::route('POST /admin/games', function(){
 $data = Flight::request()->data->getData();
 Flight::gameService()->add_game($data);
});



Flight::route('GET /admin/games', function(){
  $offset = Flight::query('offset', 0);
  $limit = Flight::query('limit', 25);
  $search = Flight::query('search');
  $order = Flight::query('order', "-id");

  Flight::json(Flight::gameService()->get_games($search, $offset, $limit, $order));
});


Flight::route('GET /games/@id', function($id){
  Flight::json(Flight::gameService()->get_by_id($id));
});


Flight::route('PUT /admin/games/@id', function($id){
  $data = Flight::request()->data->getData();
  Flight::json(Flight::gameService()->update($id, $data));
});

?>