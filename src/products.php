<?php
// Include the database connection file
include 'db_connect.php';

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
    
    // Redirect to the same page to prevent form resubmission
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Web Shop</title>
    <link href="../dist/style.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Include the navigation bar -->
    <?php include 'navbar.php'; ?>
    
    <main class="p-4">
        <h2 class="text-2xl mb-4">Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <?php
            // SQL query to select product details
            $sql = "SELECT id, name, image, price FROM products";
            $result = $conn->query($sql);

            // Check if there are products found
            if ($result->num_rows > 0) {
                // Loop through each product and display it
                while($row = $result->fetch_assoc()) {
                    echo '<div class="bg-white p-4 rounded shadow">';
                    echo '<a href="product.php?id=' . $row["id"] . '">';
                    echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . '" class="w-full h-48 object-cover rounded">';
                    echo '<h3 class="text-xl mt-2">' . $row["name"] . '</h3>';
                    echo '<p class="text-gray-700 font-bold">$' . $row["price"] . '</p>';
                    echo '</a>';
                    // Form to add the product to the cart
                    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '">';
                    echo '<input type="hidden" name="product_id" value="' . $row["id"] . '">';
                    echo '<button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                // If no products found, display a message
                echo "No products found";
            }
            ?>
        </div>
    </main>
    
    <footer class="bg-blue-500 text-white p-4 text-center">
        &copy; <?php echo date("Y"); ?> Webshop
    </footer>
</body>
</html>
