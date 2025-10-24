<?php
// connection include
include("db_connect.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Signup logic
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password) 
                VALUES ('$name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Auto login
            $_SESSION['user_name'] = $name;
            $_SESSION['user_id'] = $conn->insert_id;

            echo "<script>alert('Signup successful! Welcome $name'); window.location='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error: Email already exists or something went wrong!');</script>";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <!-- Navbar -->
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

  <!-- Signup Section -->
  <section class="auth-section">
    <h1>Create an Account</h1>
    <form class="auth-form" method="POST" action="">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit" name="signup" class="btn">Signup</button>
      <p>Already have an account? <a href="login.php">Login here</a></p>
    </form>
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
