<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<!--[if lt IE 8]>
<html class="lt-ie10 lt-ie9 lt-ie8" lang="<?php echo Localization::activeLanguage()?>"> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie10 lt-ie9" lang="<?php echo Localization::activeLanguage()?>"> <![endif]-->
<!--[if IE 9]>
<html class="lt-ie10" lang="<?php echo Localization::activeLanguage()?>"> <![endif]-->
<!--[if gt IE 9]><!-->
<html lang="<?php echo Localization::activeLanguage() ?>"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php Loader::element('header_required', array('pageTitle' => $pageTitle)); ?>

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="<?php echo $this->getThemePath() ?>/assets/css/app.css">
	<link rel="icon" type="image/png" href="<?php echo $this->getThemePath() ?>/favicon.png" sizes="128x128">

	<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
	<script src="//s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js"></script>
	<script src="//html5base.googlecode.com/svn-history/r38/trunk/js/selectivizr-1.0.3b.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
	<![endif]-->

</head>

<?php
$u = new User();
$g = Group::getByName('Administrators');
$toolbarVisible = false;
if ($u->isSuperUser() || $u->inGroup($g)) {
	$toolbarVisible = true;
}

$p = Page::getCurrentPage();

$pageHome = (!$p->isError() && $p->getCollectionID() == HOME_CID);
$isEditing = $p->isEditMode();
$classes = $c->getPageWrapperClass() . ($toolbarVisible ? ' toolbar-visible' : '');
$classes .= $isEditing ? ' is-editing' : '';

?>
<body>
<div class="<?php echo $classes ?> ">