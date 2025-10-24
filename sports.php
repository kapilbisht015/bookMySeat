<?php 
// connection include 
include("db_connect.php");
?>

<!-- sports.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sports</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
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


    
  </header>

<!-- Sports Banner -->
<section class="sports-banner">
  <img src="images/worldcup.jpg" alt="Sports Banner">
  <div class="banner-content">
  </div>
</section>

<!-- Filters Section -->
<div class="filters-container">
  <h2>Filters</h2>
  <form method="GET" action="sports.php">

    <!-- Date Filter -->
    <div class="filter-group">
      <h4>Date</h4>
      <button type="submit" name="date" value="today">Today</button>
      <button type="submit" name="date" value="tomorrow">Tomorrow</button>
      <button type="submit" name="date" value="weekend">This Weekend</button>
      <button type="submit" name="date" value="">All</button>
    </div>
    
    <!-- Sports Filter -->
    <div class="filter-group">
      <h4>Sports</h4>
      <button type="submit" name="sport" value="cricket">Cricket</button>
      <button type="submit" name="sport" value="running">Running</button>
      <button type="submit" name="sport" value="golf">Golf</button>
      <button type="submit" name="sport" value="cycling">Cycling</button>
      <button type="submit" name="date" value="">All</button>
    </div>

  </form>
</div>


<h1>Sports in Delhi</h1>
<section class="card-container">
<?php
  // Base query
  $sql = "SELECT * FROM sports_events WHERE city = 'Delhi'";

  // Sports filter
  if (!empty($_GET['sport'])) {
      $sport = $conn->real_escape_string($_GET['sport']);
      $sql .= " AND category = '$sport'";
  }

  // Date filter
  if (!empty($_GET['date'])) {
      $dateFilter = $_GET['date'];
      $today = date("Y-m-d");

      if ($dateFilter == "today") {
          $sql .= " AND date = '$today'";
      } elseif ($dateFilter == "tomorrow") {
          $tomorrow = date("Y-m-d", strtotime("+1 day"));
          $sql .= " AND date = '$tomorrow'";
      } elseif ($dateFilter == "weekend") {
          $start = date("Y-m-d", strtotime("saturday this week"));
          $end = date("Y-m-d", strtotime("sunday this week"));
          $sql .= " AND date BETWEEN '$start' AND '$end'";
      }
  }

  // Run query
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<a href='booking.php?id=" . $row['id'] . "' class='card'>";
          echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
          echo "<h3>" . $row['name'] . "</h3>";
          echo "<p>" . $row['details'] . "</p>";
          echo "</a>";
      }
  } else {  
      echo "<p>No events found.</p>";
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
