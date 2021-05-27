<?php

// Here we Create a sample data

Order::create([
    'id' => 1,
    'client_id' => 1,
    'price' => 5000,
    'product' => 'Product 1',
]);

Order::create([
    'id' => 2,
    'client_id' => 1,
    'price' => 8000,
    'product' => 'Product 1',
]);

Order::create([
    'id' => 3,
    'client_id' => 2,
    'price' => 55000,
    'product' => 'Product 1',
]);

Order::create([
    'id' => 4,
    'client_id' => 3,
    'price' => 15000,
    'product' => 'Product 1',
]);




Client::create([
    'id' => 1,
    'phone' => '+9989385545',
    'email' => 'email1@gmail.com',
]);
Client::create([
    'id' => 2,
    'phone' => '+9989385545',
    'email' => 'email1@gmail.com',
]);
Client::create([
    'id' => 3,
    'phone' => '+9989385545',
    'email' => 'email1@gmail.com',
]);


echo "The seeding is complete!";