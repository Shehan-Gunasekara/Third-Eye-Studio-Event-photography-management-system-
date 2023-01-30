<!DOCTYPE html>
<head>
    <title>Portfolio</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/portfoliod2.css">
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

    
<div id="myBtnContainer">
  <button class="btn active" onclick="filterSelection('all')"> Show all</button>
  <?php require 'config.php';
    $sql = "select E.Event_type, e.EventID, a.BookingID, a.Album_name
          from event_tb e, Booking b, Album a
          where a.BookingID = b.BookingID and e.EventID = b.EventID and b.Progress = 'Completed'";
          
    $result = $con->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          echo "<button class='btn' onclick=\"filterSelection('".$row["Event_type"]."')\">".$row["Event_type"]."</button>";
        }
    }  
  ?>
</div>


<!-- Portfolio Gallery Grid -->
<div class="row">
  <?php require 'config.php';
    $sql = "select e.Event_type, e.EventID, a.BookingID, a.Album_name
          from event_tb e, Booking b, Album a
          where a.BookingID = b.BookingID and e.EventID = b.EventID and b.Progress = 'Completed'";
          
    $result = $con->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          $albumid = $row["BookingID"];
        	$dir    = "album/{$albumid}/edited/";
        	$files1 = scandir($dir);
    
          echo"
		  <a href='portfolio_single_page.php?albumid={$albumid}'>
          <div class='column ".$row["Event_type"]."'>
            <div class='content'>
                <img src='album/{$albumid}/edited/{$files1[2]}' alt='".$row["Event_type"]."' style='width:100%'>
                <h4>".$row["Album_name"]."</h4>
            </div>
          </div>
		  </a>"
		  ;
        }
    }
    $con->close();
  ?>
</div>
        
        
  <script>

      filterSelection("all") // Execute the function and show all columns
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
  }
}

// Show filtered elements
function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
  </script>      
  

<!--Footer Start-->
<footer>
        <h2 class="footer-text">Third Eye Studio</h2>
        <p class="footer-tagline">A camera that puts a world of possibilities at your fingertips. Literally.</p>
    </footer>
</body>
</html>