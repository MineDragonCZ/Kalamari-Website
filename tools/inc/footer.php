<?php

class Footer {
    public function __construct() {
    }
	public function getHTML(){
		return '
			</div>
			<div class="col-12 p-0 m-0 align-self-end">
				<footer class="py-5">
					<div class="px-4 text-center"
						<span><span>S ❤️ vytvořil Vojtěch Šín | Provozováno na systému</span> <img src="https://www.bakalari.cz/images/bakalari-logo.svg" width="109" height="22" class="ml-3"></span><br/>
						<span>Děkuji autorovi <a href="https://github.com/bakalari-api/bakalari-api-v3" target="_blank">této dokumentace</a> za její vytvoření.</span><br/>
						<span>Ano! Jedná se o open-source projekt! <a href="https://github.com/MineDragonCZ/FrontEnd-Bakalari-2.0" target="_blank">GitHub Repozitář</a></span>
					</div>
				</footer>
			</div>
		';
	}
}

?>