<?php
session_start();
require "function.php";
require "config.php";
require "service/Router.php";

$response = Router::handleRequest();
$page = $response !== false ? $response["view"] : Router::NOT_FOUND;

ob_start();
include($page);
$content = ob_get_contents();
ob_end_clean();

require (VIEW_PATH."layout.php");
