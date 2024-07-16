<?php
  
  require_once 'config/config.php';

  require_once 'helpers/password_creator.php';

  spl_autoload_register(function($className){
    require_once 'core/'.$className.'.php';
  });
  
?>