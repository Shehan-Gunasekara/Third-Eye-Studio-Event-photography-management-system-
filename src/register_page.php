<?php
    include "config.php";

    if(isset($_POST['btn_submit'])){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if ($username != "" && $password != ""){

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
                $sql = "select count(*) as regEmailCount from client_email where email='".$email."'";
                $result = $con->query($sql);
                $row = mysqli_fetch_array($result);

                $count = $row['regEmailCount'];
                if($count > 0){
                    echo "Email already taken";
                }else{
                    echo $username;
                    echo $password;
                    $sql = "insert into Client (Username, Password) 
                    values ('".$username."','".$password."')";
                    $con->query($sql);
                    $sql = "select ClientID from Client where Username='".$username."'";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);
                    $clientid = $row['ClientID'];
                    $sql = "insert into client_email (Email, ClientID) values ('".$email."','".$clientid."')";
                    $con->query($sql);
                }
            }
        }else{
            echo "Invalid username and password";
        }
    }
    $con->close();
?>
<!DOCTYPE html>
<head>
    <title>Signup</title>
    <script src="js/register.js">
    </script>
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

    <center>
        <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-12">
                <div class="form-block">
                    <h3 style="font-size: 30px; font-family:  Roboto, Oxygen, Ubuntu, Cantarell; margin-top: -10px;">
                         SIGN UP</h3>
                         <hr>
                    <img src="img/discover.png" width="150px" style="margin-bottom: 10px; margin-top: 20px;">
                    <hr class="styline">
                    <form method="post" action="" onsubmit="return checkPassword()">
                        <input type="text" name="username" class="form-control" placeholder="Enter your username" id="username">
                        <br>
                        <input type="text"  name="email" class="form-control" placeholder="Enter your email address" id="email">
                        <br>
                        
                        <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter your Password" id="password"><br>
                        <input type="password" name="cnfrmpwd" class="form-control" id="cnfrmpwd" placeholder="Confirm Password" id="passwordconfirm"><br>
                        <br>
                        Accept privacy policy and terms:
                        <input type="checkbox" id="checkPolicy" onclick="enableButton()"><br>
                        <input type="submit" name="btn_submit" id="submitBtn" class="form-login-btn" value="Register" disabled onclick="checkPassword()">
                    </form>
                    <p class="new-member-reg"><a href="login_page.php"> Already User? login here.</a></p>
                  
              </div>
            </div>
          </div>
        
    </center>
    
  

<!--Footer Start-->
<footer>
        <h2 class="footer-text">Third Eye Studio</h2>
        <p class="footer-tagline">A camera that puts a world of possibilities at your fingertips. Literally.</p>
    </footer>
</body>
</html>