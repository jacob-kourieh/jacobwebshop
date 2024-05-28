<?php
// Include the database connection file
include 'db_connect.php';

// Check if the 'id' parameter is set in the GET request, if not, terminate the script with a message
if (!isset($_GET['id'])) {
    die("Product not found.");
}

// Convert the 'id' parameter to an integer
$product_id = intval($_GET['id']);

// Prepare and execute the SQL query to fetch the product with the given ID
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

// Check if the product exists, if not, terminate the script with a message
if ($result->num_rows == 0) {
    die("Product not found.");
}

// Fetch the product details as an associative array
$product = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Web Shop</title>
    <link href="../dist/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <?php include 'navbar.php'; ?>
    <main class="p-4">
        <div class="max-w-4xl mx-auto bg-white p-4 rounded shadow">
            <div class="flex flex-col md:flex-row">
                <img src="./<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="w-full md:w-1/3 object-cover rounded" style="height: 30rem;">
                <div class="md:ml-4">
                    <h2 class="text-3xl mt-2 md:mt-0"><?php echo $product['name']; ?></h2>
                    <p class="text-xl text-gray-700 font-bold">$<?php echo $product['price']; ?></p>
                    <p class="mt-4"><?php echo $product['description']; ?></p>
                    <form id="add-to-cart-form">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="button" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded" id="add-to-cart-button">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-blue-500 text-white p-4 text-center">
        &copy; <?php echo date("Y"); ?> Webshop
    </footer>

    <script>
        $(document).ready(function() {
            // Handle the add to cart button click event
            $('#add-to-cart-button').click(function() {
                // Get the product ID from the hidden input field
                var productId = $('input[name="product_id"]').val();
                // Make an AJAX POST request to add the product to the cart
                $.ajax({
                    type: 'POST',
                    url: 'add_to_cart.php',
                    data: { product_id: productId },
                    success: function(response) {
                        // On success, update the cart count in the navigation bar
                        var currentCount = parseInt($('#cart-count').text());
                        $('#cart-count').text(currentCount + 1);
                    },
                    error: function() {
                        // On error, alert the user
                        alert('Failed to add product to cart.');
                    }
                });
            });
        });
    </script>
</body>
</html>
