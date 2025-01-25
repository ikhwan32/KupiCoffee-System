<?php
require_once '../Homepage/session.php';

// // Initialize the cart if it doesn't exist
// if (!isset($_SESSION['cart'])) {
//     $_SESSION['cart'] = [];
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: rgb(255, 206, 223);
            background-size: cover;
            padding-top: 70px;
        }

        .container {
            display: inline-block;
            margin: 20px auto;
            padding: 20px;
            background-color: rgb(255, 206, 223);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 30px;
            font-weight: bold;
            color: #7a2005;
            margin-top: 20px;
            margin-bottom: 30px;
            text-align: center;
        }

        .order {
            max-width: 600px;
            margin: 15px auto;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            background-color: rgb(255, 253, 159);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .order img {
            width: 150px;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        .order .details {
            text-align: left;
            flex-grow: 1;
        }

        .order strong {
            font-size: 20px;
            color: #7a2005;
            display: block;
            margin-bottom: 10px;
        }

        .order .details p {
            margin: 5px 0;
            font-size: 16px;
            font-weight: bold;
        }

        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #7a2005;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
        }

        .floating-button:hover {
            background-color: #ffb300;
        }
    </style>
</head>
<body>

<?php include '../Homepage/header.php'; ?>

<div class="container">
    <h1>Your Orders List</h1>

    <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $index => $order): ?>
            <div class="order">
                <div class="details">
                    <strong>Order <?php echo $index + 1; ?></strong>
                    <p>Milk: <?php echo isset($order['milk']) ? htmlspecialchars($order['milk']) : 'Not specified'; ?></p>
                    <p>Type: <?php echo isset($order['type']) ? htmlspecialchars($order['type']) : 'Not specified'; ?></p>
                    <p>Size: <?php echo isset($order['size']) ? htmlspecialchars($order['size']) : 'Not specified'; ?></p>
                    <p>Cream: <?php echo isset($order['cream']) ? htmlspecialchars($order['cream']) : 'Not specified'; ?></p>
                    <p>Bean: <?php echo isset($order['bean']) ? htmlspecialchars($order['bean']) : 'Not specified'; ?></p>
                    <p>Date: <?php echo isset($order['date']) ? htmlspecialchars($order['date']) : 'Not specified'; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-orders">No orders in cart.</p>
    <?php endif; ?>
</div>

<?php if (!empty($_SESSION['cart'])): ?>
    <button class="floating-button" onclick="window.location.href='../Customer/c_readyOrder.php';">Ready to Order</button>
<?php endif; ?>

</body>
</html>