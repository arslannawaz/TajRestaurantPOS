<!DOCTYPE html>
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>Taj</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main-color.css" id="colors">

</head>

<body class="transparent-header">

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header Container
    ================================================== -->
    <header id="header-container">

        <!-- Header -->
        <div id="header">
            <div class="container">

                <!-- Left Side Content -->
                <div class="left-side">

                    <!-- Logo -->
                    <div id="logo">
                        <a  href="index.php"><h4 style=" color: #F69322;">TAJ</h4></a>
                    </div>
<!--                    <div id="logo">-->
<!--                        <a href="index.php"><img src="images/taj-logo.jpeg" data-sticky-logo="images/logo.png" alt=""></a>-->
<!--                    </div>-->

                    <!-- Mobile Navigation -->
                    <div class="clearfix"></div>
                    <!-- Main Navigation / End -->

                </div>
                <!-- Left Side Content / End -->


            </div>
        </div>
        <!-- Header / End -->

    </header>
    <div class="clearfix"></div>
    <!-- Header Container / End -->

    <div class="main-search-container full-height alt-search-box centered" data-background-image="images/main-search-background-02.jpg">
        <div class="main-search-inner">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <div class="main-search-input">

                            <div class="main-search-input-headline">
                                <h2>Login</h2>
                            </div>

                            <div class="main-search-input-item location">

                                <form  method="post">
                                    <div class="form-group">
                                        <label for="email">Email address:</label>
                                        <input required type="email" name="email" class="form-control" placeholder="Enter email" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Password:</label>
                                        <input required type="password" name="password" class="form-control" placeholder="Enter password" id="pwd">
                                    </div>
                                    <button type="submit" name="login" class="button">Login</button>
                                </form>

                                <?php
                                include('includes/connection.php');
                                if(isset($_POST["login"])){
                                    $email=$_POST['email'];
                                    $pass=$_POST['password'];

                                    $user_email='';
                                    $user_password='';
                                    $user_id;
                                    $user_role='';
                                    $user_name='';

                                    $sql = "SELECT * from users" . " where email= '$email'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                            $user_email=$row["email"];
                                            $user_password=$row["password"];
                                            $user_id=$row["id"];
                                            $user_role=$row["role"];
                                            $user_name=$row["name"];
                                        }
                                    } else {
                                        //echo "0 results";
                                    }

                                    if($user_password==$pass) {
                                        if($user_role==1){
                                            session_start();
                                            $_SESSION['id']=$user_id;
                                            $_SESSION['name']=$user_name;
                                            $_SESSION['email']=$user_email;
                                            header("location: admin/admin-dashboard.php");
                                        }
                                        if($user_role==2){
                                            session_start();
                                            $_SESSION['id']=$user_id;
                                            $_SESSION['name']=$user_name;
                                            $_SESSION['email']=$user_email;
                                            header("location: dashboard.php");
                                        }
                                    }
                                    else{
                                        echo "<h4 style='color:red;'>Incorrect Credentials!</h4>";
                                    }
                                }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script type="text/javascript" src="scripts/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery-migrate-3.1.0.min.js"></script>
<script type="text/javascript" src="scripts/mmenu.min.js"></script>
<script type="text/javascript" src="scripts/chosen.min.js"></script>
<script type="text/javascript" src="scripts/slick.min.js"></script>
<script type="text/javascript" src="scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="scripts/waypoints.min.js"></script>
<script type="text/javascript" src="scripts/counterup.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>


<!-- Leaflet // Docs: https://leafletjs.com/ -->
<script src="scripts/leaflet.min.js"></script>

<!-- Leaflet Maps Scripts -->
<script src="scripts/leaflet-markercluster.min.js"></script>
<script src="scripts/leaflet-gesture-handling.min.js"></script>
<script src="scripts/leaflet-listeo.js"></script>

<!-- Leaflet Geocoder + Search Autocomplete // Docs: https://github.com/perliedman/leaflet-control-geocoder -->
<script src="scripts/leaflet-autocomplete.js"></script>
<script src="scripts/leaflet-control-geocoder.js"></script>


<!-- Typed Script -->
<script type="text/javascript" src="scripts/typed.js"></script>
<script>
    var typed = new Typed('.typed-words', {
        strings: [" Table"," Deals"],
        typeSpeed: 80,
        backSpeed: 80,
        backDelay: 2000,
        startDelay: 2000,
        loop: true,
        showCursor: true
    });
</script>


<!-- Style Switcher
================================================== -->
<script src="scripts/switcher.js"></script>

<div id="style-switcher">
    <h2>Color Switcher <a href="#"><i class="sl sl-icon-settings"></i></a></h2>

    <div>
        <ul class="colors" id="color1">
            <li><a href="#" class="main" title="Main"></a></li>
            <li><a href="#" class="blue" title="Blue"></a></li>
            <li><a href="#" class="green" title="Green"></a></li>
            <li><a href="#" class="orange" title="Orange"></a></li>
            <li><a href="#" class="navy" title="Navy"></a></li>
            <li><a href="#" class="yellow" title="Yellow"></a></li>
            <li><a href="#" class="peach" title="Peach"></a></li>
            <li><a href="#" class="beige" title="Beige"></a></li>
            <li><a href="#" class="purple" title="Purple"></a></li>
            <li><a href="#" class="celadon" title="Celadon"></a></li>
            <li><a href="#" class="red" title="Red"></a></li>
            <li><a href="#" class="brown" title="Brown"></a></li>
            <li><a href="#" class="cherry" title="Cherry"></a></li>
            <li><a href="#" class="cyan" title="Cyan"></a></li>
            <li><a href="#" class="gray" title="Gray"></a></li>
            <li><a href="#" class="olive" title="Olive"></a></li>
        </ul>
    </div>

</div>
<!-- Style Switcher / End -->


</body>
</html>
