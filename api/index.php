<?php

$product = [
    'title' => 'iPhone 15',
    'price' => 100000
];
header('Content-type: application/json; charset=utf-8');
echo json_encode($product);