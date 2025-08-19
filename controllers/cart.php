<?php
session_start();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle delete item request
if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    // Remove item from session cart
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($item_id) {
        return $item['id'] != $item_id;
    });
    // Re-index array
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    if (isset($_POST['ajax'])) {
        echo json_encode(['success' => true, 'message' => 'Item removed successfully']);
        exit;
    }
}

// Sample cart data (in real application, this would come from database)
if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = [
        [
            'id' => 1,
            'imageUrl' => 'https://static5.lenskart.com/media/catalog/product/pro/1/thumbnail/628x301/9df78eab33525d08d6e5fb8d27136e95//v/i/vincent-chase-vc-e13456-c2-eyeglasses_g_0190_02_02_22.jpg',
            'brand' => 'Vincent Chase',
            'sizeCollection' => 'Blue Block Screen Glasses',
            'reviews' => '4.5 stars',
            'rating' => '1200 reviews',
            'price' => 1500
        ]
    ];
}

// Calculate totals
$total_item_price = 0;
$total_discount = 1000;
foreach ($_SESSION['cart'] as $item) {
    $total_item_price += $item['price'];
}
$total_payable = $total_item_price - $total_discount;
$cart_count = count($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Lenskart</title>
    <link rel="stylesheet" href="../assets/css/cart.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="cart-page">
        <header class="header">
            <div class="logo">
                <img src="https://static.lenskart.com/media/desktop/img/site-images/main_logo.svg" alt="Lenskart Logo" />
            </div>
            <div class="secure">
                <span>100% safe and secure</span>
            </div>
        </header>

        <div class="cart-header">
            <span class="cart-title">Cart (<?php echo $cart_count; ?> item<?php echo $cart_count != 1 ? 's' : ''; ?>)</span>
        </div>

        <div class="CardBothSide">
            <div class="CardMap">
                <?php if (empty($_SESSION['cart'])): ?>
                    <div class="empty-cart">
                        <p>Your cart is empty</p>
                        <a href="../pages/eyeglasses.php" class="continue-shopping">Continue Shopping</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="content" id="cart-item-<?php echo $item['id']; ?>">
                            <div class="cart-section">
                                <div class="cart-item">
                                    <img src="<?php echo htmlspecialchars($item['imageUrl']); ?>" alt="<?php echo htmlspecialchars($item['brand']); ?>" />
                                    <div class="item-details">
                                        <span class="item-title">
                                            <?php echo htmlspecialchars($item['brand']); ?>: <?php echo htmlspecialchars($item['sizeCollection']); ?><br>
                                            <?php echo htmlspecialchars($item['reviews']); ?>, <?php echo htmlspecialchars($item['rating']); ?>
                                        </span>
                                        <span class="item-price">₹<?php echo number_format($item['price']); ?></span>
                                        <span class="final-price">Final Price ₹<?php echo number_format($item['price']); ?></span>
                                        <div class="item-actions">
                                            <a href="#" onclick="removeItem(<?php echo $item['id']; ?>)">Remove |</a>
                                            <a href="#">Repeat</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="login-reminder">
                                    <span>Login to see items from your existing bag and wishlist</span>
                                    <button onclick="window.location.href='../pages/login.php'">→</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <?php if (!empty($_SESSION['cart'])): ?>
                <div class="cardBillSide">
                    <div class="bill-details">
                        <div class="bill-header">
                            <span>Bill Details</span>
                        </div>
                        <div class="bill-item">
                            <span>Total item price</span>
                            <span>₹<?php echo number_format($total_item_price); ?></span>
                        </div>
                        <div class="bill-item">
                            <span>Total discount</span>
                            <span>-₹<?php echo number_format($total_discount); ?></span>
                        </div>
                        <div class="bill-total">
                            <span>Total payable</span>
                            <span>₹<?php echo number_format($total_payable); ?></span>
                        </div>
                        <div class="discount-code">
                            <span>LKFLASH applied</span>
                            <span>You are saving ₹<?php echo number_format($total_discount); ?></span>
                            <a href="#" onclick="removeDiscount()">REMOVE</a>
                        </div>
                        <button class="checkout-btn" onclick="proceedToCheckout()">Proceed To Checkout</button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <!-- Hidden form for item removal -->
    <form id="deleteForm" method="POST" style="display: none;">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="item_id" id="deleteItemId">
        <input type="hidden" name="ajax" value="1">
    </form>

    <script>
        function removeItem(itemId) {
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                // Create FormData for AJAX request
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('item_id', itemId);
                formData.append('ajax', '1');

                fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove item from DOM
                            const itemElement = document.getElementById('cart-item-' + itemId);
                            if (itemElement) {
                                itemElement.remove();
                            }

                            // Reload page to update totals
                            setTimeout(() => {
                                window.location.reload();
                            }, 500);
                        } else {
                            alert('Error removing item. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error removing item. Please try again.');
                    });
            }
        }

        function removeDiscount() {
            alert('Discount code removed');
            // In real application, this would make an AJAX call to remove discount
            window.location.reload();
        }

        function proceedToCheckout() {
            // Redirect to checkout page
            window.location.href = '../pages/checkout.php';
        }

        // Add loading states for better UX
        document.addEventListener('DOMContentLoaded', function() {
            const removeLinks = document.querySelectorAll('.item-actions a[onclick*="removeItem"]');
            removeLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const itemId = this.getAttribute('onclick').match(/\d+/)[0];
                    removeItem(itemId);
                });
            });
        });
    </script>
</body>

</html>