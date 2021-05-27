<?php

include_once './includes/CommandLine.php';
include_once './includes/Model.php';
include_once './includes/Order.php';
include_once './includes/Client.php';

// include_once './includes/seed.php';

$orders = Order::all();
$clients = Client::all();