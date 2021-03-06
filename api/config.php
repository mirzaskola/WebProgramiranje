<?php
class Config{
    
    const DATE_FORMAT = "Y-m-d H:i:s";


    public static function DB_HOST(){
        return Config::get_env("DB_HOST", "127.0.0.1");
      }
      public static function DB_USERNAME(){
        return Config::get_env("DB_USERNAME", "root");
      }
      public static function DB_PASSWORD(){
        return Config::get_env("DB_PASSWORD", "4815162342");
      }
      public static function DB_SCHEME(){
        return Config::get_env("DB_SCHEME", "blogdb");
      }
      public static function DB_PORT(){
        return Config::get_env("DB_PORT", "3306");
      }
      public static function get_env($name, $default){
        return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
      }
}
const JWT_SECRET = "y4KvQcZVqn3F7uxQvcFk";
const JWT_TOKEN_TIME = 604800;
?>