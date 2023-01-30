<!DOCTYPE html>
<head>
    <title>Packages</title>
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
                <p>Home > Events > Packages</p>
            </div>
            <center>
                <h2 class="nav-header-text">Packages</h2>
            </center>
            <div class="row">
				<?php
					require 'config.php';

					$eventid = $_GET['eventid']; 

					$sql = "select e.Event_type, ep.EventID, p.PackageID, p.Name
					from Event_tb e, Event_package ep, Package p
					where ep.EventID = {$eventid} and p.PackageID = ep.PackageID and e.EventID = ep.EventID
					order by p.Name;";

					$eventPackageResult = $con->query($sql);

					if($eventPackageResult->num_rows > 0){
						//read data
						while($packageRow = $eventPackageResult->fetch_assoc()){
							//Read and utilize the row data
							$packageid = $packageRow["PackageID"];
							//echo $packageRow["Event_type"]. " – " . $packageRow["EventID"] . " – " . $packageRow["PackageID"] . " – " . $packageRow["Name"] . "<BR/><BR/>";

							echo "
							<div class='packages-table'>
                    			<center>
                        			<h3 class='price-table-txtsty'>" . $packageRow["Name"] . "</h3>
                        			<hr>
                        			<ui class='ul-style'>
							";


							$sql = "select pf.PackageID, pf.FeatureID, f.Feature_description
							from Package_feature pf, Feature f
							where pf.PackageID = {$packageid} and pf.FeatureID = f.FeatureID;";

							$packageFeatureResult = $con->query($sql);

							if($packageFeatureResult->num_rows > 0){
								while($FeatureRow = $packageFeatureResult->fetch_assoc()){
									//echo $FeatureRow["FeatureID"]. " – " . $FeatureRow["Feature_description"] . "<BR/>";
									echo "<li class='list-price-tble'>" . $FeatureRow["Feature_description"] . "</li>";
								}
							}else{
								echo "<li class='list-price-tble'>No Feature</li>";
							}
							// echo "<a href='booking_page.php?eventid={$eventid}&eventname={$packageRow["Event_type"]}&packageid={$packageid}&packagename={$packageRow["Name"]}'>Book now</a>";
							// echo "<BR/><BR/>";

							echo	"
										</ui>
										<a href='booking_page.php?eventid={$eventid}&eventname={$packageRow["Event_type"]}&packageid={$packageid}&packagename={$packageRow["Name"]}'><button class='btn-book-package'>Book </button></a>
								</center>
							</div>
							";
						}
					}else{
						echo "No packages";
					}
					$con->close();
				?>
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