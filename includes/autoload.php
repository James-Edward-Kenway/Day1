<?php

// loading important files
include_once './includes/CommandLine.php';
include_once './includes/Model.php';
include_once './includes/Order.php';
include_once './includes/Client.php';

// include_once './includes/seed.php';

// loading all models from data.json
$orders = Order::all();
$clients = Client::all();