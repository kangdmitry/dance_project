<script type='text/javascript'>
if (!alert('Are you sure you want to delete it!')) {
<?php header('Refresh: 1, url=adminpage.php');?>
}
</script>
<?php
require_once 'includes/DBconnection/link.php';
$del = mysqli_query($link, "DELETE FROM competitions WHERE id='".$_GET['id']."'");
if ($del) {?>
<script type="text/javascript">
	alert("You succesfully delete!");
</script>
<?php 
header('Refresh: 1, url=adminpage.php'); 
}?>