<?php session_start();
    include "config.php";
    if(isset($_GET['logout'])){
        session_destroy();
        header('Location: login_page.php');
    }
    if(isset($_POST['btn_submit'])){

        $username = $_POST['txt_uname'];
        $password = $_POST['txt_pwd'];


        if ($username != "" && $password != ""){

            $sql = "select count(*) as regUserCount from Client where Username='".$username."' and Password='".$password."'";
            $result = $con->query($sql);
            $row = mysqli_fetch_array($result);

            $count = $row['regUserCount'];

            if($count > 0){
                $_SESSION['username'] = $username;
                $_SESSION['role'] = 'client';
                header('Location: client_profile_page.php');
            }else{
                $sql = "select count(*) as adminCount from Administrator where Username='".$username."' and Password='".$password."'";
                $result = $con->query($sql);
                $row = mysqli_fetch_array($result);

                $count = $row['adminCount'];

                if($count > 0){
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = 'admin';
                    header('Location: admin_profile_page.php');
                }else{
                    $sql = "select count(*) as employeeCount from Employee where Username='".$username."' and Password='".$password."'";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);

                    $count = $row['employeeCount'];

                    if($count > 0){
                        $_SESSION['username'] = $username;
                        $sql = "select Position from Employee where Username='".$username."'";
                        $result = $con->query($sql);
                        $row = mysqli_fetch_array($result);

                        switch ($row['Position']) {
                            case "Manager":
                                $_SESSION['role'] = 'manager';
                                header('Location: event_manager_profile_page.php');
                                break;
                            case "Photographer":
                                $_SESSION['role'] = 'photographer';
                                header('Location: photographer_profile_page.php');
                                break;
                            case "Editor":
                                $_SESSION['role'] = 'editor';
                                header('Location: editor_profile_page.php');
                                break;
                            default:
                            echo "
                            <script> alert('Invalid username or password');
                            </script>";
                        }
                        
                    }else{
                        echo "
            <script> alert('Invalid username or password');
            </script>";
                    }
                }
            }
        }else{
            echo "
            <script> alert('Invalid username or password');
            </script>";
        }
    }
    $con->close();
    if(isset($_SESSION['username'], $_SESSION['role'])){
        switch ($_SESSION['role']) {
            case "admin":
                header('Location: admin_profile_page.php');
                break;
            case "manager":
                header('Location: event_manager_profile_page.php');
                break;
            case "photographer":
                header('Location: photographer_profile_page.php');
                break;
            case "editor":
                header('Location: editor_profile_page.php');
                break;
            default:
            header('Location: client_profile_page.php');
        }
    }
?>

<!DOCTYPE html>
<head>
    <title>Login</title>
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

    <center>
        <div class="container">
            <div class="row align-items-center justify-content-center">
              <div class="col-md-12">
                <div class="form-block">
                    <h3 style="font-size: 30px; font-family:  Roboto, Oxygen, Ubuntu, Cantarell; margin-top: -10px;">
                         LOGIN</h3>
                         <hr>
                    <img src="img/discover.png" width="150px" style="margin-bottom: 10px; margin-top: 20px;">
                    <hr class="styline">
                    <form method="post" action="">
                        <input type="text" name="txt_uname" class="form-control" placeholder="Enter your username" id="username">
                        <br>
                        
                        <input type="password" name="txt_pwd" class="form-control" placeholder="Your Password" id="password"><br>

                        <br>
                        <input type="submit" name="btn_submit" class="form-login-btn" value="Login">
                    </form>
                    <p class="new-member-reg"><a href="register_page.php">New member? Register here.</a></p>
                  
              </div>
            </div>
          </div>
        
    </center>
    
  

<!--Footer Start-->
<footer>
        <h2 class="footer-text">Thied Eye Studio</h2>
        <p class="footer-tagline">A camera that puts a world of possibilities at your fingertips. Literally.</p>
    </footer>
</body>
</html>