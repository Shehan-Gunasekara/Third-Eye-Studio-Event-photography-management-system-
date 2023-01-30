<!DOCTYPE html>
<head>
    <title>Event manager Profile</title>
    <?php session_start();
        require 'config.php';

        if(isset($_SESSION['username'], $_SESSION['role'])) {
            if($_SESSION['role']=="manager"){
                $username = $_SESSION['username'];
                $role = $_SESSION['role'];

                $sql = "select EmployeeID, First_name from Employee where Username='".$username."'";
                $result = $con->query($sql);
                
                $row = mysqli_fetch_array($result);
                $managerid = $row['EmployeeID'];
                $firstname = $row['First_name'];

                if(isset($_GET['bookingid'], $_GET['addorremove'])){
                    if($_GET['addorremove']=='add'){
                        $sql = "insert into Booking_employee (BookingID, EmployeeID) values (".$_GET['bookingid'].",".$managerid.")";
                        $result = $con->query($sql);
                    }elseif($_GET['addorremove']=='remove'){
                        $sql = "delete from Booking_employee where BookingID=".$_GET['bookingid']." and EmployeeID=".$managerid;
                        $result = $con->query($sql);
                    }
                }

            }else{
                header('Location: login_page.php');
            }
        }else{
            header('Location: login_page.php');
        }
    ?>
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
                <p>Home > Profile > Manager</p>
            </div>
            <h2 class="nav-header-text">Manager Profile</h2>
            <div class="row">
                <div class="profile-col-one">
                    <img src="img/profile.jpg" width="150px">
                </div>
                <div class="profile-col-two" >
                    <h2 class="profile-name-text"><?php echo $firstname ?></h2>
                </div>
            </div>
            <h2 class="nav-header-text">Events you manage</h2>
            <div class="row">
                    <?php
                        $sql = "select b.BookingID, ev.EventID, c.First_name, ev.Event_type, p.Name, b.event_date, b.Payment_state, b.Progress 
                        from booking b, event_tb ev, package p, Client c, booking_employee be, employee em 
                        where b.ClientID = c.ClientID and ev.EventID = b.EventID and p.PackageID = b.PackageID and be.EmployeeID = ".$managerid." and be.BookingID = b.BookingID and be.EmployeeID = em.EmployeeID";
                        $result = $con->query($sql);
                        
                        if($result->num_rows > 0){
                        //read data
                            while($row = $result->fetch_assoc()){
                                //Read and utilize the row data
                                echo "
                                <div class='events-three-lay'>
                                    <h4 class='event-id'>Event ID: ".$row['EventID']."</h4>
                                    <p class='event-descript'>Event Type: ".$row['Event_type']." <br> Date: ".$row['event_date']." <br> Client Name: ".$row['First_name']." <br>  Payment: ".$row['Payment_state']."</p>
                                    <a href='event_description_page.php?bookingid=".$row['BookingID']."' class='event-link'> View More </a>
                                    <a class='event-link' href = 'event_manager_profile_page.php?bookingid=".$row['BookingID']."&addorremove=remove'> Remove </a>
                                </div>
                                ";
                            }
                        }else{
                            echo "<p class='para-default'>No booking events you manage</p>";
                        }
                        
                    ?> 
            </div>
            <h2 class="nav-header-text">Events Without a manager</h2>
            <div class="row">
                    <?php
                        $sql = "select distinct b.BookingID, ev.EventID, c.First_name, ev.Event_type, p.Name, b.event_date, b.Payment_state, b.Progress 
                        from booking b, event_tb ev, package p, Client c, booking_employee be, employee em 
                        where b.ClientID = c.ClientID and ev.EventID = b.EventID and p.PackageID = b.PackageID and be.BookingID = b.BookingID and be.EmployeeID = em.EmployeeID
                        and b.BookingID not in (select b.BookingID
                        from booking_employee be, employee em, Booking b 
                        where be.BookingID = b.BookingID and em.EmployeeID = be.EmployeeID and em.Position = 'Manager')";
                        $result = $con->query($sql);
                        
                        if($result->num_rows > 0){
                        //read data
                            while($row = $result->fetch_assoc()){
                                //Read and utilize the row data
                                echo "
                                <div class='events-three-lay'>
                                    <h4 class='event-id'>Event ID: ".$row['EventID']."</h4>
                                    <p class='event-descript'>Event Type: ".$row['Event_type']." <br> Date: ".$row['event_date']." <br> Client Name: ".$row['First_name']." <br>  Payment: ".$row['Payment_state']."</p>
                                    <a class='event-link' href = 'event_manager_profile_page.php?bookingid=".$row['BookingID']."&addorremove=add'> Add </a>
                                </div>
                                ";
                            }
                        }else{
                            echo "<p class='para-default'>No Booking events without an event manager</p>";
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