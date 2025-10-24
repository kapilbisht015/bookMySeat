<?php
include("db_connect.php");
require 'vendor/autoload.php';
use Razorpay\Api\Api;

session_start(); // session start kar diya

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $sql = "SELECT * FROM movies WHERE id = $id"; 
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $_SESSION['movie_id'] = $row['id'];
    $_SESSION['amount']   = $row['price'];

  } else {
    die("Movie not found.");
  }
} else {
  die("Invalid movie ID.");
}

// Razorpay Test Keys
$keyId = "rzp_test_RJVOibhhrCZ2qg";
$keySecret = "ON7QwUxi3qzMLmK5v79RAod0";

// Create Razorpay Order
$api = new Api($keyId, $keySecret);

$orderData = [
  'receipt'         => 'order_' . $row['id'] . '_' . time(),
  'amount'          => $row['price'] * 100, // paise
  'currency'        => 'INR',
  'payment_capture' => 1
];

$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $row['name']; ?> | Booking</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>

  <!-- Navbar -->
  <?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  ?>
  <nav class="navbar">
    <div class="logo">
      <a href="index.php">Book<span>My</span>Seat</a>
    </div>
    <div class="menu-toggle" id="menu-toggle">☰</div>
    <ul class="nav-links" id="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="movies.php">Movies</a></li>
      <li><a href="sports.php">Sports</a></li>
      <li><a href="events.php">Events</a></li>
      <li><a href="my_booking.php">My Tickets</a></li>
      <li><a href="about.php">About</a></li>
      
      <?php if (isset($_SESSION['user_name'])): ?>
        <li><a href="#">Welcome, <?php echo $_SESSION['user_name']; ?></a></li>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="signup.php">Signup</a></li>
      <?php endif; ?>
      <div class="search-bar">
        <input type="text" placeholder="Search...">
      </div>
    </ul>
  </nav>

  <h1 class="booking-title"><?php echo $row['name']; ?></h1>

  <div class="container">
    <div class="details">
      <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="booking-img">
    </div>
    <div class="booking-right">
      <p class="booking-details"><?php echo $row['details']; ?></p>
      <p class="booking-price"><strong>Price: ₹<?php echo $row['price']; ?></strong></p>
      <p class="booking-duration"><strong>Duration:</strong> <?php echo $row['duration']; ?> mins</p>

      <!-- Booking Form -->
      <form id="booking-form" class="booking-form">
       <input type="hidden" id="booking_id" value="<?php
    if(isset($row['id'])) { echo $row['id']; } 
    elseif(isset($event['id'])) { echo $event['id']; } 
?>">

        <!-- Language -->
        <label for="language">Language:</label>
        <select id="language">
          <option value="Hindi">Hindi</option>
          <option value="English">English</option>
          <option value="Tamil">Tamil</option>
          <option value="Japanese">Japanese</option>
        </select>

        <!-- Location -->
        <label for="location">Location:</label>
        <select id="location">
          <option value="PVR Saket">PVR Saket</option>
          <option value="INOX Nehru Place">INOX Nehru Place</option>
          <option value="Cinepolis Janakpuri">Cinepolis Janakpuri</option>
        </select>

        <!-- Date -->
        <label for="date">Date:</label>
        <select id="date">
          <?php
          for ($i = 0; $i < 7; $i++) {
            $date = date("Y-m-d", strtotime("+$i day"));
            echo "<option value='$date'>$date</option>";
          }
          ?>
        </select>

    <!-- Time Slots -->
<label for="time">Show Time:</label>
<div class="time-slots">
  <label><input type="radio" name="time" value="10:00 AM" required> 10:00 AM</label>
  <label><input type="radio" name="time" value="01:00 PM"> 01:00 PM</label>
  <label><input type="radio" name="time" value="04:00 PM"> 04:00 PM</label>
  <label><input type="radio" name="time" value="07:00 PM"> 07:00 PM</label>
</div>

<!-- Hidden inputs for booking -->
<input type="hidden" id="booking_id" value="<?php echo $row['id']; ?>">
<input type="hidden" id="booking_type" value="movie">

<?php if(isset($_SESSION['user_name'])): ?>
    <button id="pay-button-movie" class="btn">Pay Now</button>
<?php else: ?>
    <a href="login.php" class="btn">Pay Now</a>
<?php endif; ?>
</form>

    </div>
  </div>
  <script>
    const menuToggle = document.getElementById("menu-toggle");
    const navLinks = document.getElementById("nav-links");
    menuToggle.addEventListener("click", () => {
      navLinks.classList.toggle("show");
    });

  var options = {
    "key": "<?php echo $keyId; ?>",
    "amount": "<?php echo (isset($row['price']) ? $row['price'] : $event['price']) * 100; ?>",
    "currency": "INR",
    "name": "<?php echo (isset($row['name']) ? $row['name'] : $event['name']); ?>",
    "description": "Ticket Booking",
    "order_id": "<?php echo $razorpayOrderId; ?>",
    "handler": function(response) {
        // Submit to success page
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'payment_success.php';

        var input1 = document.createElement('input');
        input1.type = 'hidden';
        input1.name = 'razorpay_payment_id';
        input1.value = response.razorpay_payment_id;
        form.appendChild(input1);

        var input2 = document.createElement('input');
        input2.type = 'hidden';
        input2.name = 'order_id';
        input2.value = response.razorpay_order_id;
        form.appendChild(input2);

        var input3 = document.createElement('input');
        input3.type = 'hidden';
        input3.name = 'booking_id';
        input3.value = document.getElementById('booking_id').value;
        form.appendChild(input3);

        var input4 = document.createElement('input');
        input4.type = 'hidden';
        input4.name = 'booking_type';
        input4.value = document.getElementById('booking_type').value;
        form.appendChild(input4);

        document.body.appendChild(form);
        form.submit();
    },
    "theme": {
        "color": "#F37254"
    }
};

document.getElementById('pay-button-movie').onclick = function(e) {
    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
};

  </script>

  <!-- Footer -->
<footer class="footer">
  <div class="footer-cta">
    <p>List your Show &nbsp;&nbsp; Got a show, event, activity or a great experience? Partner with us & get listed on BookMySeat</p>
    <a href="contact.php" class="btn">Contact today!</a>
  </div>
  <div class="footer-icons">
    <div class="icon-box">
      <span>📞</span>
      <p>24/7 Customer Care</p>
    </div>
    <div class="icon-box">
      <span>🎟️</span>
      <p>Resend Booking Confirmation</p>
    </div>
    <div class="icon-box">
      <span>📩</span>
      <p>Subscribe to the Newsletter</p>
    </div>
  </div>
  <div class="footer-links">
    <div>
      <h4>Movies Now Showing in Delhi-NCR</h4>
      <p>Jolly LLB 3 | Demon Slayer | Adventure of Jetcat 7D | Mirai | The Conjuring: Last Rites</p>
    </div>
    <div>
      <h4>Upcoming Movies</h4>
      <p>Mic On | My Dear Father | Challenge (2025) | One Battle After Another</p>
    </div>
    <div>
      <h4>Movies by Genre</h4>
      <p>Drama | Adventure | Action | Thriller | Comedy | Romantic | Family | Horror</p>
    </div>
  </div>

  <p class="footer-bottom">© 2025 BookMySeat | All Rights Reserved</p>
</footer>


</body>

</html>