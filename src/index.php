<!DOCTYPE html>
<head>
    <title>Third Eye Studio</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="navbar">
            <ul class="navbarul">
                <li class="navbarli-left"><a class="navbarlia" href="index.php"><img src="img/logoheader-demo.png" width="100px" ></a></li>
                <?php session_start();
					if(isset($_SESSION['username'], $_SESSION['role'])){
            echo "<li class='navbarli-right'><a class='navbarlia , iogbtnnavbar' href='login_page.php?logout=yes'>Logout</a></li>";
            switch ($_SESSION['role']) {
                case "admin":
                    echo "<li class='navbarli-right'><a class='navbarlia' href='admin_profile_page.php'>Profile</a></li>";
                    break;
                case "manager":
                    echo "<li class='navbarli-right'><a class='navbarlia' href='event_manager_profile_page.php'>Profile</a></li>";
                    break;
                case "photographer":
                    echo "<li class='navbarli-right'><a class='navbarlia' href='photographer_profile_page.php'>Profile</a></li>";
                    break;
                case "editor":
                    echo "<li class='navbarli-right'><a class='navbarlia' href='editor_profile_page.php'>Profile</a></li>";
                    break;
                default:
                    echo "<li class='navbarli-right'><a class='navbarlia' href='client_profile_page.php'>Profile</a></li>";
            }
          }else{
          echo "<li class='navbarli-right'><a class='navbarlia , iogbtnnavbar' href='login_page.php?'>Login</a></li>";
          }
				?>
				
                
                <li class="navbarli-right"><a class="navbarlia" href="contact.php">Contact</a></li>
                <li class="navbarli-right"><a class="navbarlia" href="portfolio_page.php">portfolio</a></li>
                <li class ="navbarli-right"><a class="navbarlia" href="event_page.php">Events</a></li>
              </ul>
        </div>
    </header>

    <!-- Slideshow container -->
    <div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
      <div class="numbertext">1 / 3</div>
      <img src="img/slider1.jpg" height="400px" style="width:100%;">
    </div>
  
    <div class="mySlides fade">
      <div class="numbertext">2 / 3</div>
      <img src="img/slider2.jpg" height="400px" style="width:100%;">
    </div>
  
    <div class="mySlides fade">
      <div class="numbertext">3 / 3</div>
      <img src="img/slider3.jpg" height="400px" style="width:100%;">
    </div>
  </div>
  <br>
  
  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>

  <!--Site Boddy-->
  <div class="row">
    <div class="column-home-second">
        <img src="img/e6.jpg" style="float: right; margin-right: 20px;">
    </div>
    <div class="column-home-second">
        <h2>Third Eye Studio</h2>
        <p>Founded in 2007 by renowned photographer Starshi Fernando, Third eye studio blurs the line between p
          rofessional fashion photography, personal portraiture and events. We try to narrate a story, frame by 
          frame, as we see it. For us all splendor is in the details. Hence, we take one frame at a time. Sometimes
           one frame does it all. We seek for what is not often seen and we take great pleasure narrating them, in 
           the exact way we see them. For us, this journey is an endless conversation with our own selves – in our 
           own language and we invite you to be the spectator of your own story – whilst we be the narrators. 
           Ultimately our mission is to help people to see beauty in themselves while 
           creating wonderful works of art that will be passed down through generations.</p>
    </div>
  </div>

  <div class="row">
      <h2 align ="center">Third Eye Studio</h2>
    <div class="column-home-th">
        <img src="img/e1.jpg" style="margin: 12px;">
    </div>
    <div class="column-home-th">
        <img src="img/e2.jpg" style="margin: 12px;">
    </div>
    <div class="column-home-th">
        <img src="img/e3.jpg" style="margin: 12px;">
    </div>
    <div class="column-home-th">
        <img src="img/e4.jpg" style="margin: 12px;">
    </div>
  </div>



<script>
  var slideIndex = 0;
  showSlides();
  
  function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}
    slides[slideIndex-1].style.display = "block";
    setTimeout(showSlides, 5000); // Change image every 2 seconds
  }
</script>
    
  

<!--Footer Start-->
<footer>
        <h2 class="footer-text">Third Eye Studio</h2>
        <p class="footer-tagline">A camera that puts a world of possibilities at your fingertips. Literally.</p>
    </footer>
</body>
</html>