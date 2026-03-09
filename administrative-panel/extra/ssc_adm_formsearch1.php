<?php include('includes/top.php');?>
<?php include('includes/left_column.php');?>
<div id="container">
	<?php include('includes/header.php');?>
	<div id="content">
		<div class="grid_container">
			<div class="grid_12 full_block">
				<div class="widget_wrap">
					<div class="widget_top">
						<span></span>
						<h6>Search SSC Admission Form</h6>
					</div>
					
					<div class="widget_content">
						
						<?php
// define variables and set to empty values
$SSCYear = $SSCBatchNo = $SSCSession = $SSCSerialNo = "";
$SSCYear = $SSCBatchNo = $SSCSession = $SSCSerialNo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["SSCYear"])) {
    $SSCYear = "SSCYear is required";
  } else {
    $SSCYear = test_input($_POST["SSCYear"]);
    // check if SSCYear only contains letters and whitespace
    if (!preg_match("/^[0-9]+$/",$SSCYear)) {
      $SSCYear = "Only numbers allowed";
    }
  }
  
  if (empty($_POST["SSCSession"])) {
    $SSCSession = "SSCSession is required";
  } else {
    $SSCSession = test_input($_POST["SSCSession"]);
  }
  
  if (empty($_POST["SSCBatchNo"])) {
    $SSCBatchNo = "SSCBatchNo is required";
  } else {
    $SSCBatchNo = test_input($_POST["SSCBatchNo"]);
    // check if e-mail address is well-formed
    if (!preg_match("/^[0-9]+$/",$SSCBatchNo)) {
      $SSCBatchNo = "Only number allowed";
    }
  }
    
  if (empty($_POST["SSCSerialNo"])) {
    $SSCSerialNo = "";
  } else {
    $SSCSerialNo = test_input($_POST["SSCSerialNo"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/^[0-9]+$/",$SSCSerialNo)) {
      $SSCSerialNo = "Only number allowed";
    }
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>SSC Admission Form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  SSC Year: <input type="text" name="SSCYear" value="<?php echo $SSCYear;?>" maxlength="4">
  <span class="error">* 
  <br><br>
  SSC Session:
  <input type="radio" name="SSCSession" <?php if (isset($SSCSession) && $SSCSession=="annual") echo "checked";?> value="ANNUAL">Annual
  <input type="radio" name="SSCSession" <?php if (isset($SSCSession) && $SSCSession=="supply") echo "checked";?> value="SUPPLY">Supply  
  <span class="error">*
  <br><br>
  Batch No: <input type="text" name="SSCBatchNo" value="<?php echo $SSCBatchNo;?>" maxlength="4">
  <span class="error">*
  <br><br>
  Serial No: <input type="text" name="SSCSerialNo" value="<?php echo $SSCSerialNo;?>" maxlength="4">
  <span class="error">*
  <br><br>
  
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<center><h2>Admission Form</h2></center>";
$url = "SSC/".$SSCYear."/".$SSCSession."/".$SSCBatchNo."/".$SSCBatchNo."".$SSCSerialNo.".jpg";
echo "<img src='$url' style='max-width:90%;' height='auto;'>";
echo "<br>";
?>

						
					</div>
				</div>
			</div>
		</div>
		<span class="clear"></span>
	</div>
</div>
<?php include('includes/footer.php');?>
