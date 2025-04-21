<?php
require 'db.php';

$message = ""; // Message for success/error feedback

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'], $_POST['units_consumed'])) {
    $user_id = $_POST['user_id'];
    $units_consumed = $_POST['units_consumed'];

    // Validate input
    if (!is_numeric($user_id) || !is_numeric($units_consumed) || $units_consumed <= 0) {
        $message = "<p class='error'>Invalid input. Please enter valid numbers.</p>";
    } else {
        $rate_per_unit = 5; // Example rate
        $total_amount = $units_consumed * $rate_per_unit;

        // Use prepared statement for security
        $query = "INSERT INTO bills (user_id, bill_date, units_consumed, total_amount, payment_status) 
                  VALUES (?, NOW(), ?, ?, 'Unpaid')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iii", $user_id, $units_consumed, $total_amount);

        if ($stmt->execute()) {
            $message = "<p class='success'>Bill generated successfully.</p>";
        } else {
            $message = "<p class='error'>Error: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generate Bill</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Generate Bill</h2>
    
    <?php echo $message; ?>

    <form method="POST">
        <label>User ID:</label>
        <input type="number" name="user_id" required><br>

        <label>Units Consumed:</label>
        <input type="number" name="units_consumed" required><br>

        <button type="submit">Generate Bill</button>
    </form>
</body>
</html>
