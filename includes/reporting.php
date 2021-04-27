<?php
    require_once("connection.php");

    $data=explode(',',$_GET['data']);

    $total_sales=0;
    $sql_payment = "SELECT * from payment where status='$data[1]' && date='$data[0]'";
    $result1 = $conn->query($sql_payment);
    if ($result1->num_rows > 0) {
        $total_order = mysqli_num_rows($result1);
        while ($row1 = $result1->fetch_assoc()) {
            $total_sales += $row1['total_price'];
            $price = $row1['price'];
            $tax = $row1['tax'];
            $notes = $row1['notes'];
            $date = $row1['date'];
            $p_id = $row1['id'];
        }
        ?>

<li class="pending-booking">

	<div class="list-box-listing bookings">
    <div class="list-box-listing-img"><a href="#"><img src="images/review-image-01.jpg" alt=""></a></div>
			<div class="list-box-listing-content">
				<div class="inner">
					<h3>Total Number of Orders <span class="booking-status unpaid"><?php echo $total_order; ?></span></h3>

					<div class="inner-booking-list">
						<h5>Total Sales:</h5>
						<ul class="booking-list">
							<li class="highlighted">£ <?php echo $total_sales ?></li>
						</ul>
					</div>							

				</div>
			</div>
		</div>
    </div>					
</li>

<?php
    }
    else{
?>
<li class="pending-booking">

<div class="list-box-listing bookings">
<div class="list-box-listing-img"><a href="#"><img src="images/review-image-01.jpg" alt=""></a></div>
        <div class="list-box-listing-content">
            <div class="inner">
                <h3>No Order Found <span class="booking-status unpaid">0</span></h3>  						
            </div>
        </div>
    </div>
</div>					
</li>
<?php
}
?>