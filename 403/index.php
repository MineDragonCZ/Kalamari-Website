<?php
$pageTitle = "403 - Forbidden";
include(dirname(__FILE__) . "/../tools/inc/page.php");
?>

<div class="h-title center">
	Požadovaná stránka zabezpečena!
</div>

<?= (new Footer())->getHTML(); ?>