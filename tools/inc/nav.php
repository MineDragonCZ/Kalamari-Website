<div class="row flex-nowrap m-0 p-0" style="height: 100dvh !important; overflow-y: auto;">
	<div class="col-auto p-0">
		<div class="ps-3 d-flex flex-column flex-shrink-0 col-12 p-3 embed-karta-right" style="--color: var(--secondary); background: var(--navback); height: 100dvh !important;">
			<a href="/dashboard" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none">
				<img loading="lazy" src="https://www.bakalari.cz/images/bakalari-logo.svg" alt="" height="30" class="ms-3 d-lg-inline-block d-none align-text-top">
				<img loading="lazy" src="https://bakalari.cz/favicons/favicon-32x32.png" alt="" height="30" class="ms-3 d-lg-none d-inline-block align-text-top">
			</a>
			<ul class="list-unstyled flex-column ps-0 mb-auto" id="mainNavbar" style="height: 75dvh !important; overflow-y: auto;"></ul>
			<ul class="list-unstyled ps-0">
				<li class="nav-item dropdown pt-3">
					<ul class="dropdown-content" style="z-index: 99 !important; position: relative;">
						<li class="no-wrap">
							<a class="dropdown-link" href="#" onclick="logout();">Odhlásit se <i class="fa-solid fa-right-from-bracket fa-fw"></i></a>
						</li>
					</ul>
					<a class="nav-link dropdown-button">
						<div id="usernameDiv"></div>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" onclick="switchModes(true);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dark/Light mode"><span class="mode-switcher"></span></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="col p-0 pt-5 row m-0" style="height: 100dvh !important; overflow-y: auto;">
		<div class="col-12 p-0 m-0">
			<div class="d-none" id="mainNavbarTranslates">
				<?= json_encode($config->navlinks); ?>
			</div>
			<div class="topic-title underlined-120"><?= $pageTitle; ?></div>
<style>
	body {
		height: 100dvh !important;
	}
	#mainNavbar > .nav-item > .nav-link > linkTitle {
		display: inline !important;
	}
	
	@media only screen and (max-width: 992px) {
		#mainNavbar > .nav-item > .nav-link > linkTitle {
			display: none !important;
		}
		#mainNavbar:has(.nav-item > .nav-link[toggled="true"]) > .nav-item > .nav-link > linkTitle {
			display: inline !important;
		}
	}
</style>