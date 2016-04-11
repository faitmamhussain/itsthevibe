<!Document HTML>
<html>
<head>
<title>Cron Job File</title>
</head>
<body>
<?php 
include "../../../wp-load.php";

global $wpdb; ?>
<div class="formstyle">
	<div class="headtitle">Import feeds after every three hours interval</div>
	<form action="action.php" method="post" name="interval" id="submit">
		<label>Please Enter the feed url whcih you want to import feeds :</label> 
		<div class="input_fields_wrap">
			<?php 
			$datainput = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."feeds_url");
			if(!empty($datainput)){
				foreach($datainput as $inputurl){
					echo '<div><input type="text" name="feed_url_int[]" value="'.$inputurl->url.'" /></div>';
				}
			}
			?>
		</div>
		<input type="submit" name="import_feed" value="Save Urls" id="clickButton" />
	</form>
</div>

</body>

<script>
window.onload = function(){
  document.getElementById('clickButton').click();
};
</script>
</html>