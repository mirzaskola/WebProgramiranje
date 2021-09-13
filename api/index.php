<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once dirname(__FILE__).'/../vendor/autoload.php';

//include routes
require_once dirname(__FILE__)."/routes/user.php";
require_once dirname(__FILE__)."/routes/rating.php";
require_once dirname(__FILE__)."/routes/post.php";
require_once dirname(__FILE__)."/routes/middleware.php";
require_once dirname(__FILE__)."/routes/game.php";
require_once dirname(__FILE__)."/routes/comment.php";
require_once dirname(__FILE__)."/routes/category.php";

//include services

require_once dirname(__FILE__).'/services/UserService.class.php';
require_once dirname(__FILE__).'/services/GameService.class.php';
require_once dirname(__FILE__).'/services/PostService.class.php';
require_once dirname(__FILE__).'/services/CategoryService.class.php';
require_once dirname(__FILE__).'/services/CommentService.class.php';
require_once dirname(__FILE__).'/services/RatingService.class.php';


Flight::set('flight.log_errors', TRUE);


Flight::map('error', function(Exception $ex){
  Flight::json(["message" => $ex->getMessage()], $ex->getCode() ? $ex->getCode() : 500);
});

/*function for reading query parameters from URL */
Flight::map('query', function($name, $default_value = NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $default_value;
  return urldecode($query_param);
});




/* register services */
Flight::register('userService', 'UserService');
Flight::register('gameService', 'GameService');
Flight::register('postService', 'PostService');
Flight::register('categoryService', 'CategoryService');
Flight::register('commentService', 'CommentService');
Flight::register('ratingService', 'RatingService');


Flight::route('GET /swagger', function(){
$openapi = @\OpenApi\scan(dirname(__FILE__)."/routes");
header('Content-Type: application/json');
echo $openapi->toJson();
});

Flight::route('/', function(){
  echo 'hello world3!';

  Flight::redirect('/docs');

});


Flight::start();

?>
