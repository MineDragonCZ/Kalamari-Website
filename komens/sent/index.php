<?php
$pageTitle = "Komens - odeslané zprávy";
include(dirname(__FILE__) . "/../../tools/inc/page.php");
?>
<div class="container-xl">
	<div class="mx-5">
		<div class="mb-2 alert" style="--border: #0FD1F7c5; --back: #0FD1F722; --style: none;">
			<div class="row align-items-center">
				<div class="col-auto ms-3">
					<span class="text-xxl" style="color: #0FD1F7c5;"><i class="fa-solid fa-circle-info"></i></span>
				</div>
				<div class="col">
					<h3>Na této stránce se pracuje!</h3>
					<span class="card-desc">
						Zatím můžete zkusit třeba rozvrhy
					</span>
				</div>
			</div>
		</div>
	</div>
</div>

<?= (new Footer())->getHTML(); ?>

<script>
	setupLoginChecker();
</script>