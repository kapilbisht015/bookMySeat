<?php
include("db_connect.php");
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_name'] = $row['name'];  
            $_SESSION['user_id'] = $row['id'];
            header("Location: index.php");
            exit();
        } else {
            $error = "⚠️ Wrong password!";
        }
    } else {
        $error = "⚠️ User not found!";
    }
}
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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




  <!-- Login Section -->
  <section class="auth-section">
    <h1>Login</h1>
    <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

    <form class="auth-form" method="POST" action="">
       <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" class="btn">Login</button>
      <p>Don’t have an account? <a href="signup.php">Signup here</a></p>
    </form>
  </section>


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
