<!DOCTYPE html>
<head>
    <title>Event details</title>
    <?php session_start();
        require 'config.php';

        if(isset($_SESSION['username'], $_SESSION['role'])) {
            if($_SESSION['role']=="admin" || $_SESSION['role']=="client" || $_SESSION['role']=="editor" || $_SESSION['role']=="photographer" || $_SESSION['role']=="manager"){
                $username = $_SESSION['username'];
                $role = $_SESSION['role'];
                
                if(isset($_GET['bookingid'])){
                    $bookingid = $_GET['bookingid'];
                    if(isset($_GET['addorremove'], $_GET['employeeid'])){
                        if($_GET['addorremove']=='add'){
                            $sql = "insert into Booking_employee (BookingID, EmployeeID)
                                    values (".$_GET['bookingid'].", ".$_GET['employeeid'].")";
                            $con->query($sql);
                        }elseif($_GET['addorremove']=='remove'){
                            $sql = "delete from Booking_employee 
                                    where BookingID=".$_GET['bookingid']." and EmployeeID=".$_GET['employeeid'];
                            $con->query($sql);
                        }

                    }

                    $sql = "select c.First_name, c.Last_name, e.EventID, e.Event_type, p.PackageID, p.Name, b.event_date, b.Payment_state, b.Progress 
                    from booking b, event_tb e, package p, Client c
                    where b.BookingID = ".$_GET['bookingid']." and b.ClientID = c.ClientID and e.EventID = b.EventID and p.PackageID = b.PackageID";
                    $result = $con->query($sql);
                    $row = mysqli_fetch_array($result);

                    $eventid = $row['EventID'];
                    $eventtype = $row['Event_type'];
                    $packageid = $row['PackageID'];
                    $packagename = $row['Name'];
                    $eventdate = $row['event_date'];
                    $firstname = $row['First_name'];
                    $lastname = $row['Last_name'];
                    $paymentstate = $row['Payment_state'];
                    $progress = $row['Progress'];

                    
                    if(isset($_POST['submitpayment'])){
                        $sql = "update booking 
                        set Payment_state='".$_POST['payment']."' 
                        where BookingID = ".$bookingid;
                        $con->query($sql);
                        header('Location: event_description_page.php?bookingid='.$bookingid.'');
                        echo "<script>
                        alert('Payment statement updated');
                        </script>";
                    }

                    if(isset($_POST['submitprogress'])){
                        $sql = "update booking 
                        set Progress='".$_POST['progress']."' 
                        where BookingID = ".$bookingid;
                        $con->query($sql);
                        header('Location: event_description_page.php?bookingid='.$bookingid.'');
                        echo "<script>
                        alert('Payment statement updated');
                        </script>";
                    }

                    if(isset($_POST['submitrawimg'])){
                        $countfiles = count($_FILES['file']['name']);
                        for($i=0;$i<$countfiles;$i++){
                            $filename = $_FILES['file']['name'][$i];
                            move_uploaded_file($_FILES['file']['tmp_name'][$i],"album/".$_GET['bookingid']."/raw/".$filename);
                        }
                    }

                    if(isset($_POST['submiteditimg'])){
                        $countfiles = count($_FILES['file']['name']);
                        for($i=0;$i<$countfiles;$i++){
                            $filename = $_FILES['file']['name'][$i];
                            move_uploaded_file($_FILES['file']['tmp_name'][$i],"album/".$_GET['bookingid']."/edited/".$filename);
                        }
                    }
                    if(isset($_POST['submitdownloadraw']) || isset($_POST['submitdownloadedit'])){
                        if(isset($_POST['submitdownloadraw'])){
                            $dir = "album/".$_GET['bookingid']."/raw/";
                        }elseif(isset($_POST['submitdownloadedit'])){
                            $dir = "album/".$_GET['bookingid']."/edited/";
                        }
                        $zip_file = 'file.zip';

                        // Get real path for our folder
                        $rootPath = realpath($dir);

                        // Initialize archive object
                        $zip = new ZipArchive();
                        $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

                        // Create recursive directory iterator
                        /** @var SplFileInfo[] $files */
                        $files = new RecursiveIteratorIterator(
                            new RecursiveDirectoryIterator($rootPath),
                            RecursiveIteratorIterator::LEAVES_ONLY
                        );

                        foreach ($files as $name => $file)
                        {
                            // Skip directories (they would be added automatically)
                            if (!$file->isDir())
                            {
                                // Get real and relative path for current file
                                $filePath = $file->getRealPath();
                                $relativePath = substr($filePath, strlen($rootPath) + 1);

                                // Add current file to archive
                                $zip->addFile($filePath, $relativePath);
                            }
                        }

                        // Zip archive will be created only after closing object
                        $zip->close();


                        header('Content-Description: File Transfer');
                        header('Content-Type: application/octet-stream');
                        header('Content-Disposition: attachment; filename='.basename($zip_file));
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($zip_file));
                        readfile($zip_file);
                    }
                }else{
                    header('Location: index.php');
                }
            }else{
                header('Location: login_page.php');
            }
        }else{
            header('Location: login_page.php');
        }
    ?>
    <script src="js/event.js"></script>
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
            <h2 class="nav-header-text">Event Details</h2>
            <div class="row">
                <div class="event-section-two-col">
                    <h2 class="event-id">Booking ID: <?php echo $bookingid ?></h2>
                    <h2 class="event-id">Event ID: <?php echo $eventid ?></h2>
                    <p class="event-descript">Event Type: <?php echo $eventtype; ?> <br> 
                    Date: <?php echo $eventdate; ?> <br> 
                    Client Name: <?php echo $firstname." ".$lastname; ?> <br>  
                    Payment: <?php echo $paymentstate; ?><br>
                    Progress: <?php echo $progress; ?></p>
                </div>
                <div class="event-section-two-col">
                    <?php

                        echo "<h2 class='event-id'>Package ID: $packageid </h2>";
                        echo "<h2 class='event-id'>Package name: $packagename </h2>";

                        $sql = "select pf.FeatureID, f.Feature_description
                        from Package_feature pf, Feature f
                        where pf.PackageID = {$packageid} and pf.FeatureID = f.FeatureID;";
                        $result = $con->query($sql);

                        echo "<p class='event-descript'>";
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo $row['Feature_description']."<br/>";
                            }
                        }
                        echo "</p>";
                    ?>

                    
                    
                    <br/>
                    <?php
                        if($_SESSION['role']=="admin" ||  
                        $_SESSION['role']=="manager"){
                            echo "<form method='post' action='' onsubmit=\"return checkedpayment()\">
                            <select id='payment' name='payment'>
                                <option value='Pending'>Pending</option>
                                <option value='Completed'>Completed</option>
                            </select>
                            <input type='submit' name='submitpayment' value='Update payment' onclick=\"checkpayment()\">
                            </form>";
                        }

                        if($_SESSION['role']=="admin" || 
                        $_SESSION['role']=="editor" || 
                        $_SESSION['role']=="photographer" || 
                        $_SESSION['role']=="manager"){
                            echo "<form method='post' action='' onsubmit=\"return checkedprogress()\">
                            <select id='progress' name='progress'>
                                <option value='Pending'>Pending</option>
                                <option value='Shooting'>Shooting</option>
                                <option value='Editing'>Editing</option>
                                <option value='Finalizing'>Finalizing</option>
                                <option value='Completed'>Completed</option>
                            </select>
                            <input type='submit' name='submitprogress' value='Update progress' onclick=\"checkprogress()\">
                        </form><br/>
                        
                            <form method='post' action='' enctype='multipart/form-data'>
                            <input type='file' name='file[]' id='file' multiple>
                            <input type='submit' name='submitrawimg' value='Upload raw images'>
                        </form>
                        <br/>

                        <form method='post' action='' enctype='multipart/form-data'>
                            <input type='file' name='file[]' id='file' multiple>
                            <input type='submit' name='submiteditimg' value='Upload edited images'>
                        </form>
                        <br/>    

                        <form method='post' action=''>
                            <input type='submit' name='submitdownloadraw' value='Download raw images'>
                        </form>
                        <br/>";
                        }

                        if($_SESSION['role']=="admin" || 
                        $_SESSION['role']=="editor" || 
                        $_SESSION['role']=="photographer" || 
                        $_SESSION['role']=="manager" || ($_SESSION['role']=="client" && $progress == 'Completed')){
                            echo "<form method='post' action=''>
                                    <input type='submit' name='submitdownloadedit' value='Download edited images'>
                                </form>";
                        }
                        
                        
                        
                    ?>
                </div>
            </div>
            <h2 class="nav-header-text">Hired photographers to the Event</h2>
            <div class="row">
                <?php
                    $sql = "select em.EmployeeID, em.First_name 
                    from booking_employee be, employee em 
                    where be.BookingID = ".$bookingid." and em.EmployeeID = be.EmployeeID and em.Position = 'Photographer'";
                    $result = $con->query($sql);
                    
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo"
                            <div class='four-col-profile'>
                                <center>
                                    <i class='fa fa-user-circle-o' style='font-size: 120px; text-align: center; margin-top: 50px; margin-bottom: 50px;' ></i>
                                    <h3 class='profile-names-grid'>".$row['First_name']."</h3>";
                                    if($_SESSION['role']=="manager" || $_SESSION['role']=="admin"){
                                        echo "<a href = 'event_description_page.php?bookingid=".$bookingid."&addorremove=remove&employeeid=".$row['EmployeeID']."'><button class='btn-remove-f-event'>Remove from This Event</button></a>";
                                    }
                            echo "       
                                </center>
                            </div>
                            ";
                        }
                    }else{
                        echo "<p class='para-default'>No any hired photographer</p>";
                    }
                ?>
            </div>
            <?php
                if($_SESSION['role']=="admin" || $_SESSION['role']=="manager"){
                    echo "<h2 class='nav-header-text'>Available photographers to hire for this Event</h2>";
                }
            ?>
            
            <div class="row">
                <?php
                    if($_SESSION['role']=="admin" || $_SESSION['role']=="manager"){
                            $sql = "select EmployeeID, First_name 
                        from employee
                        where Position = 'Photographer' and  EmployeeID not in (select em.EmployeeID
                        from booking_employee be, employee em 
                        where be.BookingID = ".$bookingid." and em.EmployeeID = be.EmployeeID and em.Position = 'Photographer')";
                        $result = $con->query($sql);
                        
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo"
                                <div class='four-col-profile'>
                                    <center>
                                        <i class='fa fa-user-circle-o' style='font-size: 120px; text-align: center; margin-top: 50px; margin-bottom: 50px;' ></i>
                                        <h3 class='profile-names-grid'>".$row['First_name']."</h3>";
                                        if($_SESSION['role']=="manager" || $_SESSION['role']=="admin"){
                                            echo "<a href = 'event_description_page.php?bookingid=".$bookingid."&addorremove=add&employeeid=".$row['EmployeeID']."'><button class='btn-remove-f-event'>Add to This Event</button></a>";
                                        }
                                echo   "</center>
                                </div>
                                ";
                            }
                        }else{
                            echo "<p class='para-default'>No any Available photographer</p>";
                        }
                    }
                ?>
            </div>

            <h2 class="nav-header-text">Hired editors to the Event</h2>
            <div class="row">
                <?php
                    $sql = "select em.EmployeeID, em.First_name 
                    from booking_employee be, employee em 
                    where be.BookingID = ".$bookingid." and em.EmployeeID = be.EmployeeID and em.Position = 'Editor'";
                    $result = $con->query($sql);
                    
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo"
                            <div class='four-col-profile'>
                                <center>
                                    <i class='fa fa-user-circle-o' style='font-size: 120px; text-align: center; margin-top: 50px; margin-bottom: 50px;' ></i>
                                    <h3 class='profile-names-grid'>".$row['First_name']."</h3>";
                                    if($_SESSION['role']=="manager" || $_SESSION['role']=="admin"){
                                        echo "<a href = 'event_description_page.php?bookingid=".$bookingid."&addorremove=remove&employeeid=".$row['EmployeeID']."'><button class='btn-remove-f-event'>Remove from This Event</button></a>";
                                    }
                            echo    "</center>
                            </div>
                            ";
                        }
                    }else{
                        echo "<p class='para-default'>No any hired photographer</p>";
                    }
                ?>
            </div>
            <?php
                if($_SESSION['role']=="admin" || $_SESSION['role']=="manager"){
                    echo "<h2 class='nav-header-text'>Available editors to hire for this Event</h2>";
                }
            ?>
            
            <div class="row">
                <?php
                    if($_SESSION['role']=="admin" || $_SESSION['role']=="manager"){
                        $sql = "select EmployeeID, First_name 
                        from employee
                        where Position = 'Editor' and  EmployeeID not in (select em.EmployeeID
                        from booking_employee be, employee em 
                        where be.BookingID = ".$bookingid." and em.EmployeeID = be.EmployeeID and em.Position = 'Editor')";
                        $result = $con->query($sql);
                        
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo"
                                <div class='four-col-profile'>
                                    <center>
                                        <i class='fa fa-user-circle-o' style='font-size: 120px; text-align: center; margin-top: 50px; margin-bottom: 50px;' ></i>
                                        <h3 class='profile-names-grid'>".$row['First_name']."</h3>";
                                        if($_SESSION['role']=="manager" || $_SESSION['role']=="admin"){
                                            echo "<a href = 'event_description_page.php?bookingid=".$bookingid."&addorremove=add&employeeid=".$row['EmployeeID']."'><button class='btn-remove-f-event'>Add to This Event</button></a>";
                                        }
                                echo    "</center>
                                </div>
                                ";
                            }
                        }else{ 
                            echo "<p class='para-default'>No any Available editor</p>";
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