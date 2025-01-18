<?php  
session_start();  
include '../Admin/a.sales.php'; // Include your database connection file  

// Handle addition of new sale  
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {  
    $quantity = $_POST['quantity'];  
    $pricePerOrder = $_POST['price_per_order'];  
    $subtotal = $quantity * $pricePerOrder; // Calculate subtotal  
    $kupid = $_POST['kupid']; // Assuming you have a way to select KUPID  

    $conn = getConnection();  
    $sql = 'INSERT INTO ORDERDETAIL (QUANTITY, PRICEPERORDER, SUBTOTAL, KUPID) VALUES (:quantity, :price_per_order, :subtotal, :kupid)';  
    $stmt = oci_parse($conn, $sql);  
    oci_bind_by_name($stmt, ':quantity', $quantity);  
    oci_bind_by_name($stmt, ':price_per_order', $pricePerOrder);  
    oci_bind_by_name($stmt, ':subtotal', $subtotal);  
    oci_bind_by_name($stmt, ':kupid', $kupid);  
    oci_execute($stmt);  
    oci_free_statement($stmt);  
    oci_close($conn);  
}  

// Handle deletion of sale  
if (isset($_GET['delete'])) {  
    $orderDetailId = $_GET['delete'];  

    $conn = getConnection();  
    $sql = 'DELETE FROM ORDERDETAIL WHERE ORDERDETAILID = :order_detail_id';  
    $stmt = oci_parse($conn, $sql);  
    oci_bind_by_name($stmt, ':order_detail_id', $orderDetailId);  
    oci_execute($stmt);  
    oci_free_statement($stmt);  
    oci_close($conn);  
}  

// Fetch all sales  
$conn = getConnection();  
$sql = 'SELECT * FROM ORDERDETAIL ORDER BY ORDERDETAILID DESC';  
$stmt = oci_parse($conn, $sql);  
oci_execute($stmt);  
$sales = oci_fetch_all($stmt, $results, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);  
oci_free_statement($stmt);  
oci_close($conn);  
?>  

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Sales Management</title>  
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">  
</head>  
<body class="bg-gray-100">  
    <?php include '../Homepage/header.php'; ?>  

    <div class="p-8">  
        <h2 class="text-2xl font-bold mb-6">Manage Sales</h2>  

        <!-- Add Sale Form -->  
        <form action="a_sales.php" method="POST" class="mb-8">  
            <input type="number" name="quantity" placeholder="Quantity" required class="p-2 border border-gray-300 rounded">  
            <input type="number" name="price_per_order" placeholder="Price Per Order" step="0.01" required class="p-2 border border-gray-300 rounded ml-2">  
            <input type="number" name="kupid" placeholder="KUPID" required class="p-2 border border-gray-300 rounded ml-2"> <!-- Assuming you have a way to select KUPID -->  
            <button type="submit" name="add" class="bg-blue-500 text-white p-2 rounded">Add Sale</button>  
        </form>  

        <!-- Sales Table -->  
        <table class="min-w-full bg-white border border-gray-300">  
            <thead>  
                <tr>  
                    <th class="border px-4 py-2">Order Detail ID</th>  
                    <th class="border px-4 py-2">Quantity</th>  
                    <th class="border px-4 py-2">Price Per Order</th>  
                    <th class="border px-4 py-2">Subtotal</th>  
                    <th class="border px-4 py-2">KUPID</th>  
                    <th class="border px-4 py-2">Actions</th>  
                </tr>  
            </thead>  
            <tbody>  
                <?php foreach ($results as $sale): ?>  
                    <tr>  
                        <td class="border px-4 py-2"><?= htmlspecialchars($sale['ORDERDETAILID']) ?></td>  
                        <td class="border px-4 py-2"><?= htmlspecialchars($sale['QUANTITY']) ?></td>  
                        <td class="border px-4 py-2"><?= htmlspecialchars($sale['PRICEPERORDER']) ?></td>  
                        <td class="border px-4 py-2"><?= htmlspecialchars($sale['SUBTOTAL']) ?></td>  
                        <td class="border px-4 py-2"><?= htmlspecialchars($sale['KUPID']) ?></td>  
                        <td class="border px-4 py-2">  
                            <a href="a_sales.php?delete=<?= htmlspecialchars($sale['ORDERDETAILID']) ?>" class="text-red-500">Delete</a>  
                        </td>  
                    </tr>  
                <?php endforeach; ?>  
            </tbody>  
        </table>  
    </div>  
</body>  
</html>