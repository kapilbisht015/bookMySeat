<?php 
// connection include 
include("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movies</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
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

<section class="movie-banner">
  <img src="images/about.PNG" alt="Movies Banner">
</section>

<h1>Movies in Delhi</h1>
<section class="card-container">
<?php
  $sql = "SELECT * FROM movies";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<a href='booking_movie.php?id=" . $row['id'] . "' class='card'>";
          echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
          echo "<h3>" . $row['name'] . "</h3>";
          echo "<p>" . $row['details'] . "</p>";
          echo "<p><strong>₹" . $row['price'] . "</strong></p>";
          echo "</a>";
      }
  } else {
      echo "<p>No movies found.</p>";
  }
?>
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



  <script>
    const menuToggle = document.getElementById("menu-toggle");
  const navLinks = document.getElementById("nav-links");

  menuToggle.addEventListener("click", () => {
    navLinks.classList.toggle("show");
  });
  </script>

</body>
</html>
