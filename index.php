<?php
session_start();
function buttonToggle()
{
  if (!isset($_SESSION['loggedIn'])) {
    return '<a href="login.php"><button title="Login/ Register" id="loginBtn" class="btn flex">Join Now</button></a>';
  }
  $hrefSetter = $_SESSION['loggedIn'] === 'admin' ? 'admin.php' : 'profile.php';
  return '<a href="' . $hrefSetter . '"><button title="Dashboard" id="dashboardBtn" class="btn flex">Dashboard</button></a>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Anjaneya Arena | Premium Fitness Center</title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=dashboard" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="icon" href="assets/icon.png">
  <link rel="stylesheet" href="css/websiteMain.css" />
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
  <header>
    <div class="flex">
      <a class="flex" href="#">
        <img width="70" height="78" src="assets/logo.png" alt="Anjaneya Arena Logo" />
        <h1 class="ffCinzel brandName">Anjaneya<br />Arena</h1>
      </a>
      <nav class="flex">
        <ul class="flex navList">
          <li class="listItem"><a href="#">Home</a></li>
          <li class="listItem"><a href="#membership">Membership</a></li>
          <li class="listItem"><a href="#about">About Us</a></li>
          <li class="listItem"><a href="#contact">Contact Us</a></li>
        </ul>
        <?php
        echo buttonToggle();
        ?>
        <div title="Menu" class="hamburger">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </nav>
    </div>
  </header>
  <main>
    <section class="hero">
      <div class="flex slider">
        <div class="textContainer">
          <div>
            <p class="ffPlayfair heroText">
              NO <span class="ffCinzel">MERCY</span>
            </p>
            <p class="ffPlayfair heroText">
              ONLY <span class="ffCinzel">MUSCLE</span>
            </p>
            <p class="ffPlayfair">Welcome to Anjaneya Arena</p>
            <button class="ctaBtn">JOIN US NOW</button>
          </div>
        </div>
      </div>
      <div class="flex slider">
        <div class="textContainer">
          <div>
            <p class="ffPlayfair heroText">
              TRAIN <span class="ffCinzel">HARD</span>
            </p>
            <p class="ffPlayfair heroText">
              STAY <span class="ffCinzel">STRONG</span>
            </p>
            <p class="ffPlayfair">The Anjaneya Way</p>
            <button class="ctaBtn">TRAIN WITH US</button>
          </div>
        </div>
      </div>
      <div class="flex slider">
        <div class="textContainer">
          <div>
            <p class="ffPlayfair heroText">
              NO <span class="ffCinzel">LIMITS</span>
            </p>
            <p class="ffPlayfair heroText">
              ONLY <span class="ffCinzel">PROGRESS</span>
            </p>
            <p class="ffPlayfair">Anjaneya Arena Awaits</p>
            <button class="ctaBtn">Push Your Limits</button>
          </div>
        </div>
      </div>
    </section>
    <section class="container">
      <h2 class="flex ffPlayfair sectionTitle">Welcome to Excellence</h2>
      <div class="flex overviewFlex">
        <div class="overviewCard">
          <i class="fa-solid fa-dumbbell"></i>
          <h3>Modern Equipment</h3>
          <p>
            Experience fitness with our premium collection of latest generation equipment.
          </p>
        </div>
        <div class="overviewCard">
          <i class="fa-solid fa-id-card"></i>
          <h3>Certified Trainers</h3>
          <p>
            Train with certified professionals who are dedicated to your success.
          </p>
        </div>
        <div class="overviewCard">
          <i class="fa-solid fa-people-group"></i>
          <h3>Helpful Community</h3>
          <p>
            Join a helpful fitness community that inspires and motivates everyone.
          </p>
        </div>
        <div class="overviewCard">
          <i class="fa-solid fa-trophy"></i>
          <h3>Results Guaranteed</h3>
          <p>
            Our proven methods guarantee results from your dedication and hard work.
          </p>
        </div>
      </div>
    </section>
    <section id="membership" class="container">
      <h2 class="flex ffPlayfair sectionTitle">Choose Your Path</h2>
      <div class="flex overviewFlex">
        <div class="overviewCard basic">
          <h3>Basic</h3>
          <p class="price"><span>&#8377;999</span>/month</p>
          <ul>
            <li>Locker Facility</li>
            <li>General Workout Area</li>
            <li>Basic Equipment Access</li>
            <li>Basic Fitness Assessment</li>
          </ul>
          <button class="planBtn">Enroll Now</button>
        </div>
        <div class="overviewCard premium">
          <h3 class="ffPlayfair">Premium</h3>
          <p class="price"><span>&#8377;1,999</span>/month</p>
          <ul>
            <li>All Normal Features</li>
            <li>Group Classes</li>
            <li>Nutrition Consultation</li>
            <li>Personal Trainer (2 sessions/week)</li>
          </ul>
          <button class="planBtn">Enroll Now</button>
        </div>
        <div class="overviewCard elite">
          <h3 class="ffPlayfair">Elite</h3>
          <p class="price"><span>&#8377;2,999</span>/month</p>
          <ul>
            <li>All Premium Features</li>
            <li>Exclusive Events Access</li>
            <li>Unlimited Personal Training</li>
            <li>Spa &amp; Recovery Zone Access</li>
          </ul>
          <button class="planBtn">Enroll Now</button>
        </div>
        <div class="overviewCard ultimate">
          <h3 class="ffCinzel">Ultimate</h3>
          <p class="price"><span>&#8377;3,999</span>/month</p>
          <ul>
            <li>All Elite Features</li>
            <li>Customized Fitness Plan</li>
            <li>Dedicated Parking Space</li>
            <li>Weekly Health Check-ups</li>
          </ul>
          <button class="planBtn">Enroll Now</button>
        </div>
      </div>
    </section>
    <section id="about" class="container">
      <h2 class="ffplayfair flex sectionTitle">Legacy</h2>
      <div class="flex">
        <div>
          <p>Founded in 2010, Anjaneya Arena began as a small fitness studio in the heart of the city, driven by a passion for transforming lives through strength and discipline. Inspired by the relentless power and resilience of Lord Hanuman, we adopted the mantra “No Mercy, Only Muscle”, which encapsulates our approach to training. What started with a handful of dedicated fitness enthusiasts soon grew into a thriving community of warriors committed to pushing their limits. Over the years, we expanded our facilities, upgraded our equipment, and brought in world-class trainers, all while maintaining the core philosophy that fitness is not just about physical strength but also about mental fortitude.</p>
        </div>
        <video controlsList="nodownload" src="assets/legacy_video.mp4" muted controls autoplay loop>Video displaying interior of gym</video>
      </div>
    </section>
  </main>
  <footer id="contact">
    <div class="flex footer-container">
      <div class="footer-brand">
        <a href="#" class="flex">
          <img width="70" height="78" src="assets/logo.png" alt="Anjaneya Arena Logo" />
          <h3 class="ffCinzel brandName">Anjaneya<br />Arena</h3>
        </a>
        <div class="social-links flex">
          <a href="https://www.instagram.com/_abhishek._.soni_/"><i class="fab fa-instagram"></i></a>
          <a href="https://wa.me/917727991550"><i class="fab fa-whatsapp"></i></a>
          <a href="https://x.com/"><i class="fab fa-x-twitter"></i></a>
          <a href="https://www.linkedin.com/in/abhishek-soni-662028331/"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div class="footer-contact">
        <h3>Contact Us</h3>
        <div class="contact-info">
          <address>
            Pawta Choke,<br />
            Chittorgarh, Rajasthan
          </address>
          <a href="tel:+917727991550"><i class="fas fa-phone"></i> +91 7727991550</a>
          <a href="mailto:abhishkes6904@gmail.com"><i class="fas fa-envelope"></i> abhishkes6904@gmail.com</a>
        </div>
      </div>
      <div class="footer-hours">
        <h3>Opening Hours</h3>
        <p>Monday - Friday: 6:00 AM - 10:00 PM</p>
        <p>Saturday - Sunday: 8:00 AM - 8:00 PM</p>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2024 Anjaneya Arena | All rights reserved <span>|</span> <a download="Terms-and-Conditions.pdf">Terms and Conditions</a>
    </div>
  </footer>
  <script src="js/index.js"></script>
</body>

</html>