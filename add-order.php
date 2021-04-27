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
                    <h2>Add Order</h2>
                    <!-- Breadcrumbs -->
                    <nav id="breadcrumbs">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Dashboard</a></li>
                            <li>Add Order</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Profile -->
            <div class="col-lg-12 col-md-12">
                <div class="dashboard-list-box margin-top-0">
                    <div class="dashboard-list-box-static">

                        <form action="includes/add-order.php" method="post">
                            <!-- Details -->
                            <div class="my-profile">
                                <label>Table</label>
                                <select required name="table">
                                    <?php
                                    $sql = "SELECT * from booking_table where status=0";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"><?php echo 'Table '.$row['table_number'].' '.$row['shape'].' Persons '.$row['person'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                                <label>Items</label>

                                <?php
                                $sql1 = "SELECT * from category";
                                $result1 = $conn->query($sql1);
                                if ($result1->num_rows > 0) {
                                while ($row = $result1->fetch_assoc()) {
                                $category_id=$row['id'];
                                $category_name=$row['category'];
                                ?>


                                <h3  style="color: red;text-align: center; font-weight:bold"><?php echo $category_name?></h3>

                                <div class="row">
                                    <?php
                                    $sql = "SELECT * from menu where category_id='$category_id'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                    <div class="col-sm-6">
                                        <div style="" class="checkboxes in-row margin-bottom-20">
                                            <input onclick="dothis(<?php echo $row['id'];?>)" id="<?php echo $row['id'];?>" type="checkbox" name="item[]" value="<?php echo $row['id'];?>">
                                            <label  for="<?php echo $row['id'];?>"><?php echo $row['item']?></label>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <label ><?php echo $row['price'];?></label>
                                    </div>

                                    <div class="col-sm-4">
                                        <input onfocus="this.oldvalue = this.value;" onchange="dothis(<?php echo $row['id'];?>)" id="<?php echo 'a'.$row['id'];?>" name="qty[]"  min="0" value="0" type="number" >
                                    </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                                        }
                                    }
                                ?>

                                <h4>Note</h4>
                                <textarea required name="note"></textarea>

                                <h4>Total</h4>
                                <input required  id="total"  type="text" name="total" >

                            </div>

                            <button name="addorder" type="submit" class="button margin-top-15">Place Order</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-- Content / End -->

</div>
<!-- Dashboard / End -->

<script>
    function dothis(id) {
        var old_value=document.getElementById('a'+id).oldvalue;
        //var old_value=textbox.oldvalue;
        if(document.getElementById(id).checked===true){
        //change(id);
        //alert(id);
        var str = new Array();
        str.push(id);

        var xhttp;
        if (!str) {
            document.getElementById("hide").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var value = this.responseText;
                var t = document.getElementById("total").value;
                var qty_s = document.getElementById('a'+id).value;
                var qtyy=Number(qty_s);
                var res=value*qtyy;
                var vv = parseFloat(res);

                var tt = Number(vv) + Number(t);
                document.getElementById("total").value = tt.toFixed(2);

                 if(!(old_value == null)){
                    var change_res=value*old_value;
                    var change_vv = parseFloat(change_res);
                    alert('Item added to order');
                    perform(change_vv);
                 }
            }
        };
        xhttp.open("GET", "includes/caltotal.php?q=" + str, true);
        xhttp.send();
    }
    else{
        //alert(id);
        var str = new Array();
        str.push(id);

        var xhttp;
        if (!str) {
            document.getElementById("hide").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var value = this.responseText;
                var t = document.getElementById("total").value;

                var qty_s = document.getElementById('a'+id).value;
                var qtyy=Number(qty_s);
                var res=value*qtyy;

                var vv = parseFloat(res);
                var tt = Number(t) - Number(vv);
                document.getElementById("total").value = tt.toFixed(2);
                document.getElementById('a'+id).value=0;

            }
        };
        xhttp.open("GET", "includes/caltotal.php?q=" + str, true);
        xhttp.send();
    }
    }

    function perform(change_vv) {
        var ttt = document.getElementById("total").value;
        var change_tt = Number(ttt) - Number(change_vv);
        document.getElementById("total").value = change_tt.toFixed(2);
    }


</script>