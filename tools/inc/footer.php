<?php

class Footer {
    public function __construct() {
    }
	public function getHTML(){
		return '
			<footer class="py-5">
				<div class="container-xl px-xl-0 px-4 text-center"
					<span><span>© Vojtěch Šín 2024 - Všechna práva vyhrazena. Provozováno na systému</span> <img src="https://www.bakalari.cz/images/bakalari-logo.svg" width="109" height="22" class="ml-3"></span>
				</div>
			</footer>
		';
	}
}

?>