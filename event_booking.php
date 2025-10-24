<?php
require('vendor/autoload.php'); // Razorpay autoload
include("db_connect.php");

use Razorpay\Api\Api;

// Razorpay test keys
$keyId = 'rzp_test_RJVOibhhrCZ2qg';
$keySecret = 'ON7QwUxi3qzMLmK5v79RAod0';
$api = new Api($keyId, $keySecret);

if (isset($_GET['id'])) {
    $eventId = intval($_GET['id']);
    $sql = "SELECT * FROM events WHERE id = $eventId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        die("<p>Event not found!</p>");
    }
} else {
    die("<p>No event selected!</p>");
}

// Create Razorpay order
$orderData = [
    'receipt'         => 'order_rcptid_' . $event['id'] . '_' . time(), // unique receipt
    'amount'          => $event['price'] * 100, // paise
    'currency'        => 'INR',
    'payment_capture' => 1
];

$razorpayOrder = $api->order->create($orderData);
$amount = $event['price'] * 100; // JS me use ke liye
$razorpayOrderId = $razorpayOrder['id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $event['name']; ?> | Booking</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>

<body>

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
        </ul>
        <div class="search-bar"><input type="text" placeholder="Search..."></div>
    </nav>

    <div class="container">

        <img src="images/<?php echo $event['image']; ?>" alt="<?php echo $event['name']; ?>" class="booking-img">
        <div class="details">
            <h1><?php echo $event['name']; ?></h1>
            <p class="info"><?php echo $event['details']; ?></p>
            <p class="info"><strong>City:</strong> <?php echo $event['city']; ?></p>
            <p class="info"><strong>Date:</strong> <?php echo $event['date']; ?></p>
            <p class="info"><strong>Price:</strong> ₹<?php echo $event['price']; ?></p>


            <?php if (isset($_SESSION['user_name'])): ?>
                <form id="event-booking-form" method="POST" action="payment_success.php">
                    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
                    <input type="hidden" name="order_id" id="order_id">
                    <input type="hidden" name="booking_id" value="<?php echo $event['id']; ?>">
                    <input type="hidden" name="booking_type" value="event">
                    <button type="button" id="pay-button-event" class="btn">Pay Now</button>
                </form>
            <?php else: ?>
                <a href="login.php" class="btn">Pay Now</a>
            <?php endif; ?>
        </div>
    </div>

    <script>
        var options = {
            "key": "<?php echo $keyId; ?>",
            "amount": "<?php echo $amount; ?>",
            "currency": "INR",
            "name": "BookMySeat",
            "description": "<?php echo $event['name']; ?> Booking",
            "order_id": "<?php echo $razorpayOrderId; ?>",
            "handler": function(response) {
                // hidden inputs me values daal do
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('order_id').value = response.razorpay_order_id;

                // form submit
                document.getElementById('event-booking-form').submit();
            },
            "theme": {
                "color": "#3399cc"
            }
        };

        document.getElementById('pay-button-event').onclick = function(e) {
            e.preventDefault();
            var rzp1 = new Razorpay(options);
            rzp1.open();
        }
    </script>

    <!-- Footer -->
    <footer class="footer">
        <!-- Top CTA -->
        <div class="footer-cta">
            <p>List your Show &nbsp;&nbsp; Got a show, event, activity or a great experience? Partner with us & get listed on BookMySeat</p>
            <a href="contact.php" class="btn">Contact today!</a>
        </div>

        <!-- Middle Icons -->
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

        <!-- Bottom Links -->
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


    <script>
        const menuToggle = document.getElementById("menu-toggle");
        const navLinks = document.getElementById("nav-links");
        menuToggle.addEventListener("click", () => {
            navLinks.classList.toggle("show");
        });
    </script>

</body>

</html>