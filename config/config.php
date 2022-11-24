<?php

  class Constants{

    protected $app_config = array(
      'dbconfig' => [
        'principal' => [
          'db_host_name' => 'localhost',
          'db_user_name' => 'root',
          'db_password' => '',
          /**
           * Lo ideal es dejar un usuario, contrasenia con permisos a la medida
           * Lo dejo con valores por defecto por facilidad
           * 
           * // 'db_user_name' => 'app_konecta_cafeteria',
           * // 'db_password' => 'k0N3c74_cafeteria*2022',
          **/        
          'db_name' => 'kna_cafeteria',
          'db_type' => 'mysql',
          'db_port' => '3306',
          'db_manager' => 'MysqliManager',
          'collation' => 'utf8_general_ci',
          'charset' => 'utf8',
        ]
      ]
    );

  }

?>