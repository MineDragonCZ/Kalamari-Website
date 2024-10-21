<?php
$pageTitle = "404 - Not found";
include(dirname(__FILE__) . "/../tools/inc/page.php");
?>

<div class="h-title center">
	Požadovaná stránka nenalezena!
</div>

<?= (new Footer())->getHTML(); ?>