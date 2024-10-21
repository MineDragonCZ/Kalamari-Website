
<div class="as-button" style="position: fixed; top: 15px; right: 15px;" onclick="switchModes(true);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dark/Light mode">
	<span class="mode-switcher text-lg"></span>
</div>
<div class="row flex-nowrap m-0 p-0" style="height: 100dvh !important; overflow-y: auto;">
	<div class="col-auto p-0">
		<div class="ps-3 d-flex flex-column flex-shrink-0 col-12 p-3 embed-karta-right main-nav-sided" style="--color: var(--secondary); background: var(--navback); height: 100dvh !important;">
			<a href="/dashboard" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none">
				<img loading="lazy" src="/tools/src/imgs/kalamari.png" alt="" height="30" style="padding-left: 2px;" class="mainNavbar-logo-large ms-3 align-text-top">
				<img loading="lazy" src="/tools/src/imgs/kalamari_icon.png" alt="" height="30" style="padding-left: 2px;" class="mainNavbar-logo-small ms-3 align-text-top">
			</a>
			<ul class="list-unstyled flex-column ps-1 mb-auto" id="mainNavbar" style="height: 75dvh !important; overflow-y: auto;"></ul>
			<ul class="list-unstyled ps-1 mb-0">
				<li class="nav-item nav-item-panel">
					<ul class="navbar-nav toggleDown" style="z-index: 99 !important; position: relative;" id="toggle_nav_elm_user">
						<li class="nav-item text-md nav-item-panel py-2 ps-4">
							<a class="nodecor" href="#" onclick="logout();">Odhlásit se <i class="fa-solid fa-right-from-bracket fa-fw"></i></a>
						</li>
					</ul>
					<a class="nav-link no-wrap" onclick="toggleDropdown(this); return false;" targetElm="toggle_nav_elm_user" toggled="false">
						<div id="usernameDiv"></div>
					</a>
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