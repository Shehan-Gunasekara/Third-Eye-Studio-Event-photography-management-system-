<?php session_start();
	require 'config.php';
    
	if(isset($_SESSION['username'], $_SESSION['role'])){
		if($_SESSION['role']=="client"){
			if(isset($_GET['eventid'], $_GET['packageid'], $_GET['eventname'], $_GET['packagename'])){
				$username = $_SESSION['username'];
				$eventid = $_GET['eventid'];
				$packageid = $_GET['packageid'];
				$eventname = $_GET['eventname'];
				$packagename = $_GET['packagename'];

				if(isset($_POST['btnsubmitbooking'])){
					$firstname = $_POST['firstname'];
        			$lastname = $_POST['lastname'];
        			$address = $_POST['address'];
					$mobilenumber = $_POST['mobilenumber'];
        			$dob = $_POST['dob'];
        			$eventdate = $_POST['eventdate'];

					$sql = "update Client set First_name='".$firstname."', Last_name='".$lastname."', Address='".$address."', Date_of_birth='".$dob."' 
                    		where Username='".$username."'";
					$con->query($sql);

					$sql = "select ClientID from Client where Username='".$username."'";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);
                    $clientid = $row['ClientID'];

					$sql = "select count(*) as regMnoCount from client_mobile_number where Mobile_number='".$mobilenumber."'";
					$result = $con->query($sql);
					$row = mysqli_fetch_array($result);
					$count = $row['regMnoCount'];

					if($count <= 0){
						$sql = "insert into client_mobile_number (Mobile_number, ClientID) values ('".$mobilenumber."','".$clientid."')";
                    	$con->query($sql);
					}
					
					$sql = "insert into Booking (ClientID, EventID, PackageID, event_date, Payment_state, Progress) 
					values (".$clientid.",".$eventid.",".$packageid.",'".$eventdate."','Pending','Pending')";
					$con->query($sql);

                    $sql = "select BookingID
                    from Booking
                    where ClientID = ".$clientid." and event_date = '".$eventdate."'";
					$result = $con->query($sql);
                    $row = mysqli_fetch_array($result);
                    $bookingid = $row['BookingID'];

                    $sql = "insert into Album (BookingID, Album_name) 
					values (".$bookingid.",'".$firstname." ".$lastname." Album')";
					$con->query($sql);
					$con->close();
                    mkdir("album\\".$bookingid."\\edited",0777,TRUE);
                    mkdir("album\\".$bookingid."\\raw\\",0777,TRUE);
					header('Location: client_profile_page.php');
				}
			}else{
				header('Location: event_page.php');
			}     
		}else{
			header('Location: login_page.php');
		}
	}else{
		header('Location: login_page.php');
	}
	$con->close();
?>

<!DOCTYPE html>
<head>
    <title>Booking</title>
	<script src="js/booking.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
    <header>
    <div class="navbar">
            <ul class="navbarul">
                <li class="navbarli-left"><a class="navbarlia" href="#"><img src="img/logoheader-demo.png" width="100px" ></a></li>
                <?php 
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
                <p>Home > Event > Packages > Booking</p>
            </div>
            <h2 class="nav-header-text">Package Booking</h2>
            <form method="post" action="" onsubmit="return checkedData()">
                  <input type="text" id="fname" name="firstname" placeholder="First Name" class="txtbx-form-input">
                  <input type="text" id="lname" name="lastname" placeholder="Last Name" class="txtbx-form-input"><br>
                  <input type="text" id="address" name="address" placeholder="Street Address" class="txtbx-form-input-large"><br>
                  <input type="text" id="mnum" name="mobilenumber" placeholder="Phone Number" class="txtbx-form-input"><br>
                  <input type="date" id="dob" name="dob" class="form-datepicker"><br>
                  <input type="date" id="eventdate" name="eventdate" class="form-datepicker"><br>
                  <input type="submit" id="bkinsubmit" name="btnsubmitbooking" class="form-book-btn" value="Book Now" onclick="checkData()">
            </form>
        </div>
    </div>


<!--Footer Start-->
<footer>
        <h2 class="footer-text">Third Eye Studio</h2>
        <p class="footer-tagline">A camera that puts a world of possibilities at your fingertips. Literally.</p>
    </footer>
</body>
</html>