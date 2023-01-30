<?php session_start();
	require 'config.php';
    
	if(isset($_SESSION['username'], $_SESSION['role'])){
		if($_SESSION['role']!="admin"){  
            header('Location: login_page.php');
		}else{
            if(isset($_GET['employeeid'], $_GET['addorremove'])){
                $sql = "delete
                    from Employee_mobile_number
                    where EmployeeID=".$_GET['employeeid'];
			    $con->query($sql);
                $sql = "delete
                    from Employee_email
                    where EmployeeID=".$_GET['employeeid'];
			    $con->query($sql);
                $sql = "delete
                    from Booking_employee
                    where EmployeeID=".$_GET['employeeid'];
			    $con->query($sql);
                $sql = "delete
                    from Employee
                    where EmployeeID=".$_GET['employeeid'];
			    $con->query($sql);
                echo "<script>
                    alert('Account Deleted');
                    </script>";
            }
            $sql = "select EmployeeID, First_name, Last_name
                    from Employee
                    where position='Photographer'";
			$result = $con->query($sql);
        }
	}else{
		header('Location: login_page.php');
	}
?>

<!DOCTYPE html>
<head>
    <title>Photographers</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/font-awesome.min.css"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header>
    <div class="navbar">
            <ul class="navbarul">
                <li class="navbarli-left"><a class="navbarlia" href="index.php"><img src="img/logoheader-demo.png" width="100px" ></a></li>
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
                <p>Home > Profile > Admin > photographers</p>
            </div>
            <h2 class="nav-header-text">Photographers</h2>
            <div class="row">
                <div class="event-filter">
                </div>
            </div>
            <br><br>
            <div class="row">
                    <?php
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "<div class='four-col-profile'>
                                        <center>
                                            <i class='fa fa-user-circle-o' style='font-size: 120px; text-align: center; margin-top: 50px; margin-bottom: 50px;' ></i>
                                            <h3 class='profile-names-grid'>".$row['First_name']." ".$row['Last_name']."</h3>
                                            <a href = 'photographer_list_page.php?addorremove=remove&employeeid=".$row['EmployeeID']."'><button class='btn-view-profile'>Remove Profile</button></a>
                                        </center>
                                    </div>";
                            }
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