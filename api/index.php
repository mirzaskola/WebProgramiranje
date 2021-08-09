<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/../vendor/autoload.php';
require_once dirname(__FILE__).'/services/UserService.class.php';
require_once dirname(__FILE__).'/services/GameService.class.php';
require_once dirname(__FILE__).'/services/PostService.class.php';
require_once dirname(__FILE__).'/services/CategoryService.class.php';
require_once dirname(__FILE__).'/services/CommentService.class.php';
require_once dirname(__FILE__).'/services/RatingService.class.php';

Flight::set('flight.log_errors', TRUE);

/* error handling for our API */
Flight::map('error', function(Exception $ex){
  Flight::json(["message" => $ex->getMessage()], $ex->getCode() ? $ex->getCode() : 500);
});

/* utility function for reading query parameters from URL */
Flight::map('query', function($name, $default_value = NULL){
  $request = Flight::request();
  $query_param = @$request->query->getData()[$name];
  $query_param = $query_param ? $query_param : $default_value;
  return urldecode($query_param);
});


/* utility function for getting header parameters */
Flight::map('header', function($name){
    $headers = getallheaders();
    return @$headers[$name];
  });

//jwt token generation
Flight::map('jwt', function($user){
    $jwt = \Firebase\JWT\JWT::encode(["exp" => (time() + Config::JWT_TOKEN_TIME), "id" => $user["id"], "r" => $user["role"]], Config::JWT_SECRET);
    return ["token" => $jwt];
  });


/* register Business Logic layer services */
Flight::register('userService', 'UserService');
Flight::register('gameService', 'GameService');
Flight::register('postService', 'PostService');
Flight::register('categoryService', 'CategoryService');
Flight::register('commentService', 'CommentService');
Flight::register('ratingService', 'RatingService');



//include routes
require_once dirname(__FILE__)."/routes/user.php";
require_once dirname(__FILE__)."/routes/rating.php";
require_once dirname(__FILE__)."/routes/post.php";
require_once dirname(__FILE__)."/routes/middleware.php";
require_once dirname(__FILE__)."/routes/game.php";
require_once dirname(__FILE__)."/routes/comment.php";
require_once dirname(__FILE__)."/routes/category.php";




Flight::start();

?>
