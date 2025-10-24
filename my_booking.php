<?php
session_start();
include("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets | BookMySeat</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .ticket-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .ticket-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: 0.3s;
        }

        .ticket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .ticket-card h3 {
            margin: 0 0 10px;
            color: #333;
        }

        .ticket-card p {
            margin: 5px 0;
            color: #555;
        }

        .ticket-card .ticket-no {
            font-weight: bold;
            color: #007bff;
        }

        .no-ticket,
        .login-msg {
            text-align: center;
            margin-top: 50px;
            font-size: 18px;
            color: #666;
        }
    </style>
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

        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
    </nav>


    <h2 style="text-align:center; margin-top:20px;">🎟️ My Tickets</h2>

    <?php
    // Agar login hi nahi hai
    if (!isset($_SESSION['user_id'])) {
        echo "<p class='login-msg'>Please <a href='login.php'>login</a> to view your tickets.</p>";
        exit;
    }

    $user_id = $_SESSION['user_id'];

    // Query: movies + events + sports
    $sql = $sql = "SELECT b.*, 
        COALESCE(m.name, e.name, s.name) AS item_name,
        COALESCE(m.image, e.image, s.image) AS item_image,
        COALESCE(e.city, s.city, '') AS city
        FROM bookings b
        LEFT JOIN movies m ON b.movie_id = m.id
        LEFT JOIN events e ON b.event_id = e.id
        LEFT JOIN sports_events s ON b.sports_id = s.id
        WHERE b.user_id = ?";


    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();



    if ($result->num_rows > 0): ?>
        <div class="ticket-container">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="ticket-card">
                    <!-- Poster Image -->
                    <?php if (!empty($row['item_image'])): ?>
                        <img src="images/<?php echo $row['item_image']; ?>"
                            alt="<?php echo $row['item_name']; ?>"
                            style="width:100%; height:auto; border-radius:8px; margin-bottom:10px;">
                    <?php endif; ?>

                    <h3><?php echo $row['item_name']; ?></h3>
                    <?php if (!empty($row['city'])): ?>
                        <p>📍 <?php echo $row['city']; ?></p>
                    <?php endif; ?>
                    <p>Ticket No: <span class="ticket-no"><?php echo $row['ticket_no']; ?></span></p>
                    <p>Payment ID: <?php echo $row['payment_id']; ?></p>
                    <p>Amount Paid: ₹<?php echo $row['amount']; ?></p>
                    <p>Status: ✅ <?php echo ucfirst($row['status']); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="no-ticket">You have not booked any tickets yet.</p>
    <?php endif; ?>



</body>
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


</html>