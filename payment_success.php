<?php
session_start();
include("db_connect.php");

if(!isset($_SESSION['user_id'])) die("User not logged in!");
$user_id = $_SESSION['user_id'];
$amount  = $_SESSION['amount'];
$ticket_no = strtoupper(uniqid("TKT"));

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Status</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f7fb;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: #fff;
      border-radius: 12px;
      padding: 30px;
      max-width: 450px;
      width: 90%;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      text-align: center;
    }
    .success-icon {
      font-size: 60px;
      color: #28a745;
      margin-bottom: 15px;
    }
    h2 {
      color: #333;
      margin-bottom: 15px;
    }
    p {
      font-size: 16px;
      margin: 8px 0;
      color: #555;
    }
    .ticket {
      background: #f0f9f0;
      padding: 10px;
      border: 1px dashed #28a745;
      border-radius: 8px;
      margin: 15px 0;
      font-weight: bold;
      color: #28a745;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 20px;
      background: #3399cc;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.3s;
    }
    a:hover {
      background: #2878a0;
    }
  </style>
</head>
<body>

<div class="container">
  <?php
  if(isset($_POST['razorpay_payment_id'], $_POST['order_id'], $_POST['booking_id'], $_POST['booking_type'])) {

      $payment_id = $_POST['razorpay_payment_id'];
      $order_id   = $_POST['order_id'];
      $booking_id = intval($_POST['booking_id']);
      $booking_type = $_POST['booking_type'];

      if($booking_type === 'movie') $column = 'movie_id';
      elseif($booking_type === 'event') $column = 'event_id';
      elseif($booking_type === 'sports') $column = 'sports_id';
      else die("Invalid booking type!");

      $stmt = $conn->prepare("INSERT INTO bookings (user_id, $column, ticket_no, payment_id, amount, status) VALUES (?, ?, ?, ?, ?, 'success')");
      $stmt->bind_param("iissd", $user_id, $booking_id, $ticket_no, $payment_id, $amount);

      if($stmt->execute()){
          echo "<div class='success-icon'>✅</div>";
          echo "<h2>Payment Successful!</h2>";
          echo "<p class='ticket'>Ticket No: $ticket_no</p>";
          echo "<p>Payment ID: $payment_id</p>";
          echo "<p>Amount Paid: ₹$amount</p>";
          echo "<a href='my_booking.php'>👉 View My Bookings</a>";
      } else {
          echo "<h2 style='color:red;'>Error!</h2>";
          echo "<p>".$stmt->error."</p>";
      }

      $stmt->close();

  } else {
      echo "<h2 style='color:red;'>Payment Failed!</h2>";
      echo "<p>Invalid access or transaction failed.</p>";
  }
  ?>
</div>

</body>
</html>
