<!DOCTYPE html>
<html>
<head>
<title>Events</title>
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

    <div class="row">
        <div class="column">
            <div class="head-nav-item">
                <p>Home > Events</p>
            </div>
            <center>
                <h2 class="nav-header-text">Events</h2>
            </center>
            <p style="text-align: justify;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eros justo, imperdiet ut bibendum vitae, suscipit a enim. Phasellus tincidunt et felis ut tempor. Aliquam accumsan urna nec turpis dictum, non rhoncus ante tristique. Donec vitae tellus nec dui pharetra dapibus. Morbi est leo, interdum sit amet quam in, ornare pharetra lorem. Ut ligula massa, vestibulum quis semper sit amet, congue non lectus. Vestibulum pharetra, nisl eu sodales fermentum, nibh eros pellentesque quam, id laoreet turpis elit nec felis. Nam et lorem in neque finibus dictum vitae vitae turpis. Sed sed sodales lacus, in pulvinar elit. Phasellus vestibulum, libero eget lobortis tempus, lorem tortor elementum massa, in pulvinar eros sapien non velit. Suspendisse id porttitor est, eget posuere lectus. Maecenas eu risus vitae eros placerat volutpat. Quisque et posuere tortor. Nullam tristique tincidunt augue nec convallis. Morbi et ipsum feugiat, tempus purus at, semper magna. Sed vel scelerisque urna.
            </p><br>
			<?php
				require 'config.php';
				

				$sql = "select EventID, Event_type, Description from event_tb";
				$result = $con->query($sql);
				
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						echo"
						<div class='row'>
							<div class='event-description-column'>
								<h2 class='nav-header-text'>" . $row["Event_type"] . "</h2>
								<p style='text-align: justify;'>
								" . $row["Description"] . "
								</p>
								<a href='package_page.php?eventid={$row["EventID"]}'><button class='column-nav-btn'>Packages</button></a>
							</div>
							<div class='event-description-column'>
								<img src='img/event/{$row["EventID"]}.jpg' style='margin-top: 50px; margin-left: 20px;'>
							</div>
						</div>
						";
					}
				}else{
					echo "no results";
				}
				$con->close();
			?>
			
        </div>
    </div>
    
  

<!--Footer Start-->
<footer>
        <h2 class="footer-text">Third Eye Studio</h2>
        <p class="footer-tagline">A camera that puts a world of possibilities at your fingertips. Literally.</p>
    </footer>
</body>
</html>



