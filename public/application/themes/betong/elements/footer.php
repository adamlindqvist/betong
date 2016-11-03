<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

	<?php
	$a = new GlobalArea('Footer');
	// $a->enableGridContainer();
	$a->display($c);
	?>

<?php $this->inc('elements/footer_bottom.php'); ?>