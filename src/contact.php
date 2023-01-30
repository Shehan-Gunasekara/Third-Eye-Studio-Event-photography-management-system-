<!DOCTYPE html>
<head>
    <title>Contact</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/font-awesome.min.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                            case "Manager":
                                echo "<li class='navbarli-right'><a class='navbarlia' href='event_manager_profile_page.php'>Profile</a></li>";
                                break;
                            case "Photographer":
                                echo "<li class='navbarli-right'><a class='navbarlia' href='photographer_profile_page.php'>Profile</a></li>";
                                break;
                            case "Editor":
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

    <div class="row">
        <div class="column">
            <div class="head-nav-item">
                <p>Home > Contact</p>
            </div>
            
            <div class="contact-block">
                <div class="row">
                    <div class="two-column-str">
                        <h3 class="contat-header-sty">GET IN TUCH</h3>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63492.955785248254!2d80.51572813255787!3d5.951991096208302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae138d151937cd9%3A0x1d711f45897009a3!2sMatara!5e0!3m2!1sen!2slk!4v1633185858332!5m2!1sen!2slk" width="450" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        <h4 class="fa-fa-ic-text"><i class="fa fa-location-arrow">&nbsp;&nbsp;178/F, Matara.</i></h4>
                        <h4 class="fa-fa-ic-text"><i class="fa fa-envelope-open">&nbsp;&nbsp;info@thirdeyestudio.com</i></h4>
                        <h4 class="fa-fa-ic-text"><i class="fa fa-phone">&nbsp;&nbsp;+64 76456456</i></h4>
                    </div>
                    <div class="two-column-str">
                        <h3 class="contat-header-sty">MAIL US</h3>
                        <form>
                            <input class="contact-form-txtbx" type="text" id="name" name="contactname" placeholder="Your Name">
                            <input class="contact-form-txtbx" type="text" id="mail" name="contactemail" placeholder="Your email">
                            <textarea class="contact-form-txtarea" name="message"  placeholder="Your Message"></textarea>
                            <input class="contact-form-submit-btn" type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>   
        
        </div>
    </div>
    
  

<!--Footer Start-->
<footer>
        <h2 class="footer-text">Third Eye Studio</h2>
        <p class="footer-tagline">A camera that puts a world of possibilities at your fingertips. Literally.</p>
    </footer>
</body>
</html>