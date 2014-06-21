<?php require_once('connections/cardealer.php'); ?>
<?php
$colname_rs_vehicledetails = "-1";
if (isset($_GET['vehicleID'])) {
  $colname_rs_vehicledetails = (get_magic_quotes_gpc()) ? $_GET['vehicleID'] : addslashes($_GET['vehicleID']);
}
mysql_select_db($database_cardealer, $cardealer);
$query_rs_vehicledetails = sprintf("SELECT * FROM vehicledata, fuel, registration, manufacturer, transmission, bodytype
WHERE vehicleID = %s AND vehicledata.fuel = fuel.fuelID 
AND vehicledata.registration = registration.RegistrationID 
AND vehicledata.manufacturer = manufacturer.manufacturerID 
AND vehicledata.transmission = transmission.transmissionID 
AND vehicledata.bodytype = bodytype.bodytypeID
", $colname_rs_vehicledetails);
$rs_vehicledetails = mysql_query($query_rs_vehicledetails, $cardealer) or die(mysql_error());
$row_rs_vehicledetails = mysql_fetch_assoc($rs_vehicledetails);
//$totalRows_rs_vehicledetails = mysql_num_rows($rs_vehicledetails);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php echo $row_rs_vehicledetails['title']; ?> for sale by GT Two Cars, Forest Green, Surrey</title>
<meta name="description" content="<?php  
				echo $row_rs_vehicledetails['manufacturerName']; echo " ";
				echo $row_rs_vehicledetails['Model']; echo ", ";
				echo $row_rs_vehicledetails['body']; echo ", ";
				echo $row_rs_vehicledetails['colour']; echo ", ";
				echo $row_rs_vehicledetails['transmission']; echo ", ";
				echo $row_rs_vehicledetails['fuel']; echo ", ";
				if ($row_rs_vehicledetails['Aircon'] == 1) echo "Aircon, "; 
				if ($row_rs_vehicledetails['Alloys'] == 1) echo "Alloys, "; 
				if ($row_rs_vehicledetails['Leather'] == 1) echo "Leather, "; 
				if ($row_rs_vehicledetails['Tinted Glass'] == 1) echo "Tinted Glass, "; 
				echo number_format($row_rs_vehicledetails['mileage'],0); echo " miles, ";
				echo "&pound;"; echo number_format($row_rs_vehicledetails['price'],0); 
				echo " for sale by GT Two Cars.";?>" />
<meta name="keywords" content="<?php 
				echo $row_rs_vehicledetails['manufacturerName']; echo " "; 
				echo $row_rs_vehicledetails['Model']; 
				echo ", premium car sales, GT Two Cars, Forest Green, Surrey";?>"/>
				
<?php include('inc/headcommon.php') ?>	 
		
</head>
<body id="detailpage" class="rossored">
<div id="headerwrapper">
  <!-- header -->
  <div class="container_12">
    <?php include('inc/header.php') ?>
    <?php include('inc/topnav.php') ?>	
  </div>
</div>
  <div class="clear"></div>
  
<!-- main content -->
<div class="container_12 content" >

<!-- show if vehicle exists -->
<?php
	if ($row_rs_vehicledetails['title'] > "") // Show if vehicle exists 
	{
?>  	

	<div>
		<h1 class="pgetitle"><?php echo $row_rs_vehicledetails['title']; ?><span style="display:inline; float:right;">&pound;<?php echo number_format($row_rs_vehicledetails['price'],0); ?></span></h1>
	</div>

<!-- row --> 
<!-- slideshow -->
<div class="margintop20">
	<div class="grid_6 drop-shadow perspective">
		<div class="slideshow">		
		<?php  $i = 1;
		while ($i <= 6)
		{ 
		 if ($row_rs_vehicledetails['image'.$i] != NULL)
			{?>
				<div class="detail_lge_wrap">
					<img src="./vehicledata/<?php  echo $row_rs_vehicledetails['image'.$i]; ?>" alt="<?php echo $row_rs_vehicledetails['title'];?>" class="detail_lge object-fit" name="mainimage"/>
				</div>
	  <?php } 
		$i++;
		};	
		?>
		</div> 
	</div>
<!-- thumbs -->
	<div>
	  <?php  $i = 1;
		while ($i <= 6)
		{ 
		 if ($row_rs_vehicledetails['image'.$i] != NULL)
			{?>
				<div class="grid_2 drop-shadow perspective" style="margin-bottom:10px">
					<a href="./vehicledata/<?php echo $row_rs_vehicledetails['image'.$i]; ?>" class="colorbox" rel="group" >
					<img src="./vehicledata/<?php  echo $row_rs_vehicledetails['image'.$i]; ?>" alt="<?php echo $row_rs_vehicledetails['title'];?> thumbnail image" title="<?php echo $row_rs_vehicledetails['title']; ?> - click to enlarge" class="detail_sml object-fit" />
					</a>
				</div> 
	  <?php } 
		$i++;
		};	
		?>
	</div>
	
	<div class="grid_3">
	  <div class="feattitle"><p><strong>Registration: </strong><?php echo $row_rs_vehicledetails['regYear']; ?></p></div>	
	</div>
	<div class="grid_3">
	  <div class="feattitle"><p><strong>Mileage: </strong><?php echo number_format($row_rs_vehicledetails['mileage'],0); ?> miles</p></div>	
	</div>
	<div class="grid_3">
	  <div class="feattitle"><p><strong>Transmission: </strong><?php echo $row_rs_vehicledetails['transmission']; ?></p></div>	
	</div>
	<div class="grid_3">
	  <div class="feattitle"><p><strong>Fuel: </strong><?php echo $row_rs_vehicledetails['fuel']; ?></p></div>	
	</div>	

</div>
<div class="clear"></div>		

<!-- row --> 
<div class="margintop10"></div>

<div id="tabs">
		<ul class="tabgroup">
			<li><a href="#tabs-1"><p>Specification</p></a></li>
			<li><a href="#tabs-2"><p>Finance example</p></a></li>
		</ul>
	<div class="desc_long grid_12">
		
		<div id="tabs-1">
			<div class="grid_12 alpha omega">
			  <ul>
				<li><?php echo $row_rs_vehicledetails['manufacturerName']; ?> </li>
				<li><?php echo $row_rs_vehicledetails['Model']; ?>, </li>
				<li><?php echo $row_rs_vehicledetails['body']; ?>, </li>
				<li><?php echo $row_rs_vehicledetails['colour']; ?>, </li>
				<li><?php echo $row_rs_vehicledetails['transmission']; ?>, </li>
				<li><?php echo $row_rs_vehicledetails['fuel']; ?>, </li>
				<li><?php if ($row_rs_vehicledetails['Aircon'] == 1) echo "Aircon, "; ?></li>
				<li><?php if ($row_rs_vehicledetails['Alloys'] == 1) echo "Alloys, "; ?></li>
				<li><?php if ($row_rs_vehicledetails['Leather'] == 1) echo "Leather, "; ?></li>
				<li><?php if ($row_rs_vehicledetails['Tinted Glass'] == 1) echo "Tinted Glass, "; ?></li>
				<li><?php echo number_format($row_rs_vehicledetails['mileage'],0); ?> miles, </li>
				<li>&pound;<?php echo number_format($row_rs_vehicledetails['price'],0); ?></li>
			  </ul>	
			  <p><?php echo $row_rs_vehicledetails['description']; ?></p>
			  
			<div class="sharebtns">
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style">
				<a class="addthis_button_preferred_1"></a>
				<a class="addthis_button_preferred_2"></a>
				<a class="addthis_button_preferred_3"></a>
				<a class="addthis_button_preferred_4"></a>
				<a class="addthis_button_compact"></a>
				<a class="addthis_counter addthis_bubble_style"></a>
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50f3d466021cbbd9"></script>
				<!-- AddThis Button END -->
			</div>
			  <div style="float:right;margin:5px;"><a href="http://www.hpicheck.com" target="_blank"><img src="images/HPI_468x60.gif" alt="All our cars are HPI checked" /></a></div>
			</div>
			<div class="clear"></div>
			

		</div>	

		<div id="tabs-2">	
		<?php $price = $row_rs_vehicledetails['price'];
			$depositpercent = (0.1);  /* % */
			$rate = 3.25;  /* % */
			$term = 5; /* years */
			$deposit = ($price*$depositpercent); 
			$loan = ($price-$deposit); 			
			$interest = (($loan*$rate*$term)/100); 
			$monthlypayment = (($loan+$interest)/($term*12)); /* monthly payments */ 
			$totalpayable = ($price+$interest); 
		?>
		<h2>Depending upon your financial circumstances you could have this vehicle for &pound;<strong><?php echo number_format($monthlypayment,2) ?> per month.</strong></h2>
		<p>Deposit: &pound;<?php echo number_format($deposit,0) ?> (<?php echo ($depositpercent*100) ?>%), 
		Amount of Credit: &pound;<?php echo number_format($loan,0) ?>,
		Term: <?php echo($term) ?> years,
		Interest Payable: &pound;<?php echo number_format($interest,0) ?> (APR: <?php echo $rate ?>%),
		 - <strong>Total Amount Payable: &pound;<?php echo number_format($totalpayable,0) ?></strong></p>
		</div>
		
	</div>
</div>	
	
	<div class="paging" style="float:left;"><p><a href="#" onclick="history.go(-1);return false;">Back to stock list</a></p></div>

	<div class="morebtn"><a href="contact-us.php?vehicleID=<?php echo $row_rs_vehicledetails['vehicleID']; ?>">Enquire about this vehicle ></a></div>
	
<div class="clear"></div>	
	
	
	<!-- show if vehicle doesn't exist -->
	<?php 
	}
	else
	{ ?>

		<div><h1 class="pgetitleshort">Vehicle no longer available</h1></div>
		<div class="clear"></div>
		
		<div class="grid_9 push_1 contentbox margintop10" >
			<h2>Sorry that vehicle has now been sold.</h2>
			<p>Please click <a href="stocklist.php">here</a> to see our current stock.</p>
		</div>
		
    <div class="morebtn"><a href="stocklist.php">View current stock ></a></div>
	
		<div class="clear"></div>	
	<?php
	}
	?>
	<!-- end if vehicle doesn't exist-->
</div>

<!-- end maincontent-->
<div class="clear"></div>



<!-- footer -->
<footer id="footerwrapper">
    <?php include('inc/footer.php') ?>	
</footer>
	<?php include('inc/statcounter.php') ?>	
	
<!-- include jquery cycle - http://www.malsup.com/jquery/cycle/ -->
<script type="text/javascript" src="scripts/jquery.cycle.all.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow').cycle();
});
</script>
<!-- end jquery cycle slideshow  -->
	
<!-- jquery tabs-->
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script>
$(function() {
	$("#tabs").tabs({ 
		fx: { height: 'toggle', duration: 'slow' }
	});
});
</script>
</body>

</html>
<?php
mysql_free_result($rs_vehicledetails);
?>