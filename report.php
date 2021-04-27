<?php
ob_start();
session_start();
include('includes/connection.php');
include ('includes/app.php');

if(!$_SESSION["id"]){
    header("location: index.php");
}
else{
    $userid=$_SESSION["id"];
    $username=$_SESSION["name"];
}

?>

<!DOCTYPE html>
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <title>User Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/main-color.css" id="colors">

    <style>

        @media print {
            .donotprint{
                display: none;
            }
        }

    </style>
</head>
<body>

<!-- Dashboard -->
<div id="dashboard">

    <?php
    include ('includes/sidebar.php');
    ?>

    <!-- Content
    ================================================== -->
    <div class="dashboard-content">

        <!-- Titlebar -->
        <div id="titlebar">
            <div class="row">
                <div class="col-md-12">
                    <h2>Reporting</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Reporting</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">

        <div class="col-lg-12 col-md-12">
				<div class="dashboard-list-box margin-top-0">
				
                    <div class='row'>
                        <div class='col-sm-6'>
                            <select onchange='getReport()' name="" id="order_type">
                                <option value="1">Dine-in</option>
                                <option value="2">Takeaway</option>
                                <option value="3">Delivery</option>
                            </select>    
                        </div>

                        <div class='col-sm-6'>
                            <input onchange='getReport()' type="date" id='date'>
                        </div>
                    </div>

					<ul>
                        <span id='report'></span>
					</ul>
				</div>
			</div>

        </div>

    </div>
    <!-- Content / End -->

</div>
<!-- Dashboard / End -->

<script>
    function getReport() {

            var date=document.getElementById('date').value;
            var order_type=document.getElementById('order_type').value;
            var str = new Array();
            str.push(date);
            str.push(order_type);
            var xhttp;
            if (!str) {
                document.getElementById("hide").innerHTML = "";
                return;
            }
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var value = this.responseText;
                    document.getElementById("report").innerHTML = value;
                }
            };
            xhttp.open("GET", "includes/reporting.php?data=" + str, true);
            xhttp.send();
        
    }
</script>