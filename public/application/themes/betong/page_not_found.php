<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>


<div class="page-404">
	<?php
	$a = new Area('Page-404');
	$a->enableGridContainer();
	$a->display($c);
	?>
</div>


<?php $this->inc('elements/footer.php'); ?>
