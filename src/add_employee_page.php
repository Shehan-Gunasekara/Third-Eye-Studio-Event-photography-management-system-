<?php session_start();
	require 'config.php';
    
	if(isset($_SESSION['username'], $_SESSION['role'])){
		if($_SESSION['role']!="admin"){  
            header('Location: login_page.php');
		}else{
            if(isset($_POST['btnsubmitemployee'])){
                $accountrole = $_POST['accountrole'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $address = $_POST['address'];
                $mobilenumber = $_POST['mobilenumber'];
                $email = $_POST['email'];
                $dob = $_POST['dob'];
                $username = $_POST['username'];
                $password = $_POST['password'];

                if($accountrole == 'Admin'){
                    $sql = "select count(*) as regAdminCount from Administrator where Username='".$username."'";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);
                    $count = $row['regAdminCount'];
                    $sql = "select count(*) as regClientCount from Client where Username='".$username."'";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);
                    $count += $row['regClientCount'];
                    $sql = "select count(*) as regEmployeeCount from Employee where Username='".$username."'";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);
                    $count += $row['regEmployeeCount'];
                    if($count > 0){
                        echo "Username already taken";
                    }else{
                        $sql = "select count(*) as regEmailCount from Administrator_email where email='".$email."'";
                        $result = $con->query($sql);
                        $row = mysqli_fetch_array($result);

                        $count = $row['regEmailCount'];
                        if($count > 0){
                            echo "Email already taken";
                        }else{
                            $sql = "select count(*) as regMnoCount from Administrator_mobile_number where Mobile_number='".$mobilenumber."'";
                            $result = $con->query($sql);
                            $row = mysqli_fetch_array($result);

                            $count = $row['regMnoCount'];
                            if($count > 0){
                                echo "Mobile number already taken";
                            }else{
                                $sql = "insert into Administrator(First_name, Last_name, Address, Date_of_birth, Username, Password) 
                                values ('".$firstname."', '".$lastname."', '".$address."', '".$dob."', '".$username."', '".$password."')";
                                $con->query($sql);
                                $sql = "select AdministratorID from Administrator where Username='".$username."'";
                                $result = $con->query($sql);
                                $row = mysqli_fetch_array($result);
                                $adminid = $row['AdministratorID'];
                                $sql = "insert into Administrator_email (Email, AdministratorID) values ('".$email."','".$adminid."')";
                                $con->query($sql);
                                $sql = "insert into Administrator_mobile_number (Mobile_number, AdministratorID) values ('".$mobilenumber."','".$adminid."')";
                                $con->query($sql);
                            }
                        } 
                    }
                }else{
                    $sql = "select count(*) as regAdminCount from Administrator where Username='".$username."'";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);
                    $count = $row['regAdminCount'];
                    $sql = "select count(*) as regClientCount from Client where Username='".$username."'";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);
                    $count += $row['regClientCount'];
                    $sql = "select count(*) as regEmployeeCount from Employee where Username='".$username."'";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);
                    $count += $row['regEmployeeCount'];
                    if($count > 0){
                        echo "Username already taken";
                    }else{
                        $sql = "select count(*) as regEmailCount from Employee_email where email='".$email."'";
                        $result = $con->query($sql);
                        $row = mysqli_fetch_array($result);

                        $count = $row['regEmailCount'];
                        if($count > 0){
                            echo "Email already taken";
                        }else{
                            $sql = "select count(*) as regMnoCount from Employee_mobile_number where Mobile_number='".$mobilenumber."'";
                            $result = $con->query($sql);
                            $row = mysqli_fetch_array($result);

                            $count = $row['regMnoCount'];
                            if($count > 0){
                                echo "Mobile number already taken";
                            }else{
                                $sql = "insert into Employee(First_name, Last_name, Address, Date_of_birth, position, Username, Password) 
                                values ('".$firstname."', '".$lastname."', '".$address."', '".$dob."', '".$accountrole."', '".$username."', '".$password."')";
                                $con->query($sql);
                                $sql = "select EmployeeID from Emplyee where Username='".$username."'";
                                $result = $con->query($sql);
                                $row = mysqli_fetch_array($result);
                                $employeeid = $row['EmployeeID'];
                                $sql = "insert into Employee_email (Email, AdministratorID) values ('".$email."','".$employeeid."')";
                                $con->query($sql);
                                $sql = "insert into Employee_mobile_number (Mobile_number, AdministratorID) values ('".$mobilenumber."','".$employeeid."')";
                                $con->query($sql);
                            }
                        }
                    }
                }
            }
        }
	}else{
		header('Location: login_page.php');
	}
	$con->close();
?>

<!DOCTYPE html>
<head>
    <title>Add new emplyee</title>
	<script src="js/employee.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
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
                <p>Home > Profile > Admin > Add emplyee</p>
            </div>
            <h2 class="nav-header-text">Add new employee</h2>
            <form method="post" action="" onsubmit="return checkedData()">
                <select id="accountrole" name="accountrole" class="booking-select-form">
                    <option value="Admin">Admin</option>
                    <option value="Manager">Manager</option>
                    <option value="Photographer">Photographer</option>
                    <option value="Editor">Editor</option>
                </select><br/>
                <input type="text" id="fname" name="firstname" placeholder="First Name" class="txtbx-form-input">
                <input type="text" id="lname" name="lastname" placeholder="Last Name" class="txtbx-form-input"><br>
                <input type="text" id="address" name="address" placeholder="Street Address" class="txtbx-form-input-large"><br>
                <input type="text" id="mnum" name="mobilenumber" placeholder="Phone Number" class="txtbx-form-input"><br>
                <input type="email" id="email" name="email" placeholder="Email" class="txtbx-form-input"><br>
                <input type="text" id="username" name="username" placeholder="Username" class="txtbx-form-input"><br>
                <input type="password" id="password" name="password" placeholder="Password" class="txtbx-form-input"><br>
                <input type="date" id="dob" name="dob" class="form-datepicker"><br>
                <input type="submit" id="emsubmit" name="btnsubmitemployee" class="form-book-btn" value="Add employee" onclick="checkData()">
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