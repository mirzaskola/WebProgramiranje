<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require dirname(__FILE__)."/../vendor/autoload.php";

require_once dirname(__FILE__).'/dao/BaseDao.class.php';

require_once dirname(__FILE__).'/dao/RatingDao.class.php';
/*
//include routes
require_once dirname(__FILE__)."/routes/user.php";
require_once dirname(__FILE__)."/routes/rating.php";
require_once dirname(__FILE__)."/routes/post.php";
require_once dirname(__FILE__)."/routes/middleware.php";
require_once dirname(__FILE__)."/routes/game.php";
require_once dirname(__FILE__)."/routes/comment.php";
require_once dirname(__FILE__)."/routes/category.php";

*/

$rating_dao = new RatingDao();

$rating = $rating_dao->get_post_rating(1);

print_r($rating);


?>
