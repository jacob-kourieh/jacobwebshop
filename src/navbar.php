<?php
// Get the current page's file name from the URL
$current_page = basename($_SERVER['REQUEST_URI']);

// Check if a session has not started yet, then start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get the total number of items in the cart from the session, default to 0 if not set
$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>


<nav class="bg-gray-800">
  <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <div class="flex flex-shrink-0 items-center">
          <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
        </div>
        <div class="hidden sm:ml-6 sm:block">
          <div class="flex space-x-4">
            <a href="/index.php" class="<?php echo $current_page == 'index.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> rounded-md px-3 py-2 text-sm font-medium">Home</a>
            <a href="/src/products.php" class="<?php echo $current_page == 'products.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> rounded-md px-3 py-2 text-sm font-medium">Products</a>
            <a href="/src/about.php" class="<?php echo $current_page == 'about.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> rounded-md px-3 py-2 text-sm font-medium">About</a>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
  <a href="/src/cart.php" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
    <span class="absolute -inset-1.5"></span>
    <span class="sr-only">View cart</span>
    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.342 2.725M5 7h14l1 9H6m0 0a2 2 0 100 4 2 2 0 000-4zm9 4a2 2 0 100-4 2 2 0 000 4z" />
    </svg>
    <span id="cart-count" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full"><?php echo $cart_count; ?></span>
  </a>
</div>

    </div>
  </div>
  <div class="sm:hidden" id="mobile-menu" style="display: none;">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <a href="/index.php" class="<?php echo $current_page == 'index.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> block rounded-md px-3 py-2 text-base font-medium">Home</a>
      <a href="/src/products.php" class="<?php echo $current_page == 'products.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> block rounded-md px-3 py-2 text-base font-medium">Products</a>
      <a href="/src/about.php" class="<?php echo $current_page == 'about.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?> block rounded-md px-3 py-2 text-base font-medium">About</a>
    </div>
  </div>
</nav>

<script>
  // Toggle the mobile menu visibility when the button is clicked
  document.getElementById('mobile-menu-button').addEventListener('click', function() {
    var menu = document.getElementById('mobile-menu');
    if (menu.style.display === 'none' || menu.style.display === '') {
      menu.style.display = 'block';
    } else {
      menu.style.display = 'none';
    }
  });

  // Hide the mobile menu when a link is clicked
  var mobileLinks = document.querySelectorAll('#mobile-menu a');
  mobileLinks.forEach(function(link) {
    link.addEventListener('click', function() {
      document.getElementById('mobile-menu').style.display = 'none';
    });
  });
</script>
