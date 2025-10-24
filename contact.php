<?php 
// connection include 
include("db_connect.php");
$success = "";
$error = "";

if (isset($_POST['submit'])) {  
    // Sanitize input
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    if (!empty($name) && !empty($email) && !empty($message)) {
        
        $eventId = isset($_GET['id']) ? intval($_GET['id']) : null;

        $stmt = $conn->prepare("INSERT INTO contact (name, email, message, event_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $name, $email, $message, $eventId);

        if ($stmt->execute()) {
            $success = "Thank you! Your message has been saved.";
        } else {
            $error = "Database error: " . $conn->error;
        }

        $stmt->close();
    } else {
        $error = "All fields are required.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link rel="stylesheet" href="css/style.css">
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
  </ul>

  <div class="search-bar">
    <input type="text" placeholder="Search...">
  </div>
</nav>


  <!-- Contact Section -->
  <section class="contact-section">
    <h1>Contact Us</h1>
    <p>If you have any questions or feedback, feel free to reach out to us.</p>

    <div class="contact-container">
      <!-- Contact Form -->
      <form class="contact-form" method="POST" action="">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
    <button type="submit" name="submit" class="btn">Send Message</button>
</form>

      <!-- Contact Info -->
      <div class="contact-info">
        <h2>Our Office</h2>
        <p>BookMySeat HQ,<br> New Delhi, India</p>
        <p>Email: support@BookMySeat.com</p>
        <p>Phone: +91 98765 43210</p>
      </div>
    </div>
  </section>

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

  

</body>
</html>
