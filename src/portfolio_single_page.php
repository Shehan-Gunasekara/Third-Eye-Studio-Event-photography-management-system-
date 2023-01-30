<!DOCTYPE html>
<head>
    <title>Portfolio</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/portfoliod2.css">
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

    <div class="row">
      <div class="column">
          <div class="head-nav-item">
              <p>Home > Portfolio</p>
          </div>
          <center>
            <h2 class="nav-header-text">PORTFOLIO</h2>
        </center>
    </div>
    </div>

<!-- Portfolio Gallery Grid -->
<main class="grid">
    <?php require 'config.php';
        if(isset($_GET['albumid'])){
            $albumid = $_GET['albumid'];
            $dir    = "album/{$albumid}/edited/";
            $files1 = scandir($dir);
            $arrayLength = count($files1);
        
            $i = 2;
            while ($i < $arrayLength)
            {
                echo "<img src='album/{$albumid}/edited/{$files1[$i]}'>";
                $i++;
            }
            $con->close();
        }else{
            header('Location: portfolio_page.php');
        }
        
    ?>
</main>
  
    
  

<!--Footer Start-->
<footer>
        <h2 class="footer-text">Thied Eye Studio</h2>
        <p class="footer-tagline">A camera that puts a world of possibilities at your fingertips. Literally.</p>
    </footer>
</body>
</html>