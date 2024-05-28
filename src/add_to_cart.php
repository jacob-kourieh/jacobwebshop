<?php
// Include the database connection file
include 'db_connect.php';

// Start a new session or resume the existing session
session_start();

// Check if the request method is POST and 'product_id' is set in the POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    // Get the product ID from the POST data and convert it to an integer
    $product_id = intval($_POST['product_id']);
    
    // Check if the cart session variable is not set, initialize it as an empty array
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    
    // Check if the product ID is not already in the cart, initialize its quantity to 0
    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = 0;
    }
    
    // Increment the quantity of the product in the cart by 1
    $_SESSION['cart'][$product_id]++;
    
    // Return a success status in JSON format
    echo json_encode(['status' => 'success']);
} else {
    // Return an error status in JSON format if the request method is not POST or 'product_id' is not set
    echo json_encode(['status' => 'error']);
}
?>
