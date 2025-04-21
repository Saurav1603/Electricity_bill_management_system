<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'db.php';
    $bill_id = $_POST['bill_id'];
    $payment_status = $_POST['payment_status'];
    $query = "UPDATE bills SET payment_status='$payment_status' WHERE id='$bill_id'";
    if ($conn->query($query)) {
        header("Location: admin_panel.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
