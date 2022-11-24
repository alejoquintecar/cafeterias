<?php

// --- Variables
if( !isset($_SESSION["app"]) ){

  // var_dump( $GLOBALS );exit();

  $_SESSION["app"] = (object)[
    "module" => "",
    "base_url" => __DIR__."/../",
    "html" => array(),
    "block" => array(),
    "error" => ""
  ];
}