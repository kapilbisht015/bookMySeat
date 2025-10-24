<?php
// connection include 
include("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookMySeat</title>
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


  <!-- Hero Slider -->
  <section class="hero-slider">
    <div class="slides fade">
      <img src="images/banner1.jpg" alt="Banner 1">
    </div>
    <div class="slides fade">
      <img src="images/banner2.jpg" alt="Banner 2">
    </div>
    <div class="slides fade">
      <img src="images/banner3.jpg" alt="Banner 3">
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">❮</a>
    <a class="next" onclick="plusSlides(1)">❯</a>

    <!-- Dots -->
    <div class="dots">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
    </div>
  </section>


  <!-- Movies Section -->
  <section class="movies">
    <div class="section-header">
      <h2>🎬 Recommended Movies</h2>
      <a href="movies.php" class="see-all">See All </a>
    </div>

    <div class="card-container">
      <a href="booking_movie.php?id=2" class="card">
        <div class="card-img">
          <img src="images/param.jpg" alt="Param">
          <h3>Param Sundari</h3>
          <p>Comedy/Drama/Romantic</p>
        </div>
      </a>

      <a href="booking_movie.php?id=3" class="card">
        <img src="images/baaghi.jpg" alt="baaghi">
        <h3>Baaghi 4</h3>
        <p>Action/Thriller</p>
      </a>

      <a href="booking_movie.php?id=4" class="card">
        <img src="images/Conjuring.jpg" alt="The Conjuring">
        <h3>The Conjuring: Last Rites</h3>
        <p>Horror/Thriller</p>
      </a>

      <a href="booking_movie.php?id=1" class="card">
        <img src="images/Deamon.jpg" alt="Deamon">
        <h3>Demon Slayer: Kimetsu no Yaiba Infinity Castle</h3>
        <p>Action/Adventure/Anime</p>
      </a>

    </div>
  </section>

  <!-- Live Events Section -->
  <section class="live-events">
  <h2>The Best Of Live Events</h2>
  <div class="card-container">
    <a href="sports.php" class="card" style="background-image: url('images/icc.jpg');"></a>
    <a href="events.php" class="card" style="background-image: url('images/comedy.jpg');"></a>
    <a href="events.php" class="card" style="background-image: url('images/amusement.jpg');"></a>
    <a href="movies.php" class="card" style="background-image: url('images/theatre.jpg');"></a>
    <a href="events.php" class="card" style="background-image: url('images/kids.jpg');"></a>
  </div>
</section>

  <!-- Sports Section -->
  <section class="movies">
    <div class="section-header">
      <h2>Sports</h2>
      <a href="sports.php" class="see-all">See All </a>
    </div>

    <div class="card-container">
      <a href="booking.php?id=1" class="card">
        <div class="card-img">
          <img src="images/cricket1.jpg" alt="cricket">
          <h3>INDIA VS SRI LANKA- ICC WOMEN'S CWC 2025</h3>
          <p>ACA STADIUM, GUWAHATI</p>
        </div>
      </a>

      <a href="booking.php?id=4" class="card">
        <img src="images/mg.jpg" alt="mg">
        <h3>Mahatma Virtual Marathon- Get Medal by Courier</h3>
        <p>Your Place Your Time</p>
      </a>

      <a href="booking.php?id=2" class="card">
        <img src="images/golf.jpg" alt="The Conjuring">
        <h3>IGPL INVITATIONAL 2025- DELHI NCR BY GAURAV GHEI</h3>
        <p>Jaypee Greens Golf and spa Resort: Greater Noida</p>
      </a>

      <a href="booking.php?id=6" class="card">
        <img src="images/ride.jpg" alt="Deamon">
        <h3>RIDE FOR SOMEONE- Virtual Cyclothon</h3>
        <p>Your Place Your Time</p>
      </a>

    </div>
  </section>



  <!-- Events Section -->
  <section class="events">
    <div class="section-header">
      <h2>Events</h2>
      <a href="events.php" class="see-all">See All </a>
    </div>

    <div class="card-container">
      <a href="event_booking.php?id=1" class="card">
        <div class="card-img">
          <img src="images/comedy1.jpg" alt="comedy">
          <h3>Papa Yaar by Zakir Khan - Delhi </h3>
          <p>Indira Gandhi Indoor Stadium: New Delhi</p>
        </div>
      </a>

      <a href="event_booking.php?id=2" class="card">
        <img src="images/music.jpg" alt="Music">
        <h3>Kumar Sanu Live in Concert- Delhi</h3>
        <p>Indira Gandhi Indoor Stadium: New Delhi</p>
      </a>

      <a href="event_booking.php?id=9" class="card">
        <img src="images/performance.jpg" alt="performance">
        <h3>Saturday Open Mic - Unmukt Delhi</h3>
        <p>Unmukt studio: Delhi</p>
      </a>

      <a href="event_booking.php?id=5" class="card">
        <img src="images/	
kids.jpg" alt="kids">
        <h3>Rambo Circus - Delhi </h3>
        <p>Talkatora Stadium: Delhi</p>
      </a>

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


  <script>
    const menuToggle = document.getElementById("menu-toggle");
    const navLinks = document.getElementById("nav-links");

    menuToggle.addEventListener("click", () => {
      navLinks.classList.toggle("show");
    });


    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/Prev Controls
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    // Dot Controls
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("slides");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }

    // Auto Slide
    setInterval(() => {
      plusSlides(1);
    }, 5000); // 5 sec
  </script>


</body>

</html>