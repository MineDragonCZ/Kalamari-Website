<?php
$noNav = true;
$pageTitle = "Přihlášení";
include("../tools/inc/page.php");
?>
<div class="row justify-content-center align-items-center" style="min-height: 100dvh;">
	<div class="col-xl-6 col-lg-8 col-12">
		<div class="karta-normal mx-5">
			<div style="position: absolute; top: 5px; right: 5px;">
				<a class="nav-link" onclick="switchModes(true);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dark/Light mode"><span class="mode-switcher"></span></a>
			</div>
			<form onsubmit="logIn(); return false;">
				<div class="row">
					<div class="col-12 text-center">
						<a href="https://bakalari.cz" target="_blank"><img src="https://www.bakalari.cz/images/bakalari-logo.svg" width="450px" alt=""></a><br/>
						<br/>
						<span class="topic-title underlined-120">Přihlášení do webového rozhraní</span>
					</div>
					<div class="col-lg-6 col-12">
						<div class="input-group mt-3">
							<span class="input-group-text"><i class="fa-solid fa-city fa-fw"></i></span>
							<select name="city" id="city" class="form-select" onchange="switchCity($('#city').val()); updateSchools(false);">
								<option value="" selected="true" disabled>Vyberte...</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="input-group mt-3">
							<span class="input-group-text"><i class="fa-solid fa-school fa-fw"></i></span>
							<select name="school" id="school" class="form-select" onchange="switchHost($('#school').val());">
								<option value="" selected="true" disabled>Vyberte...</option>
							</select>
						</div>
					</div>
					<div class="col-12">
						<div class="input-group mb-3 mt-3">
							<span class="input-group-text"><i class="fas fa-user-tie fa-fw"></i></span>
							<input type="text" name="username" autocomplete="on" id="username" class="form-control" required="required" placeholder="Uživatelské jméno">
						</div>
					</div>
					<div class="col-12">
						<div class="input-group mb-3">
							<span class="input-group-text"><i class="fas fa-lock fa-fw"></i></span>
							<input type="password" name="password" autocomplete="on" id="password" class="form-control" required="required" placeholder="Heslo"> 
						</div>
					</div>
					<div class="col-12 text-center">
						<input type="submit" name="login" id="loginBtn" class="btn btn-primary mt-3 px-5" value="Přihlásit se">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	setupLogoutChecker();
	async function updateSchools(updateCities){
		var city = getCookie("bak_city");
		var schoolUrl = getCookie("bak_host");
		if(updateCities){
			$("#city").html('');
			$("#city").append('<option value="" selected="true" disabled>Vyberte...</option>');
			var json = await getCitiesList();
			for(let i = 0; i < json.length; i++){
				$("#city").append(`
					<option value="${json[i].name}"${(json[i].name == city ? ' selected="true"' : '')}>${json[i].name}</option>
				`);
			}
		}

		$("#school").html('');
		$("#school").append('<option value="" selected="true" disabled>Vyberte...</option>');
		var json = (await getSchoolsList()).schools;
		for(let i = 0; i < json.length; i++){
			$("#school").append(`
				<option value="${json[i].schoolUrl}"${(json[i].schoolUrl == schoolUrl ? ' selected="true"' : '')}>${json[i].name}</option>
			`);
		}
	}
	updateSchools(true);
	let logingIn = false;
	async function logIn(){
		if(logingIn) return;
		logingIn = true;
		var user = $("#username").val();
		var pass = $("#password").val();
		$("#loginBtn").val("Přihlašování...");
		try {
			var response = await fetchDataFromBAK("/api/login", `client_id=ANDR&grant_type=password&username=${user}&password=${pass}`, "POST");
			if(response.status != 200){
				logingIn = false;
				$("#loginBtn").val("Přihlásit se");
				alertError("Nesprávné heslo, nebo jméno!");
				return;
			}
			var json = await response.json();
			alertSuccess("Úspěšně přihlášen!");
			setTimeout(() => {
				setAccessToken(json.access_token);
				if(getFromLink("returnPath"))
					window.location.href=getFromLink("returnPath");
				else
					window.location.href="/dashboard/";
			}, 1000);
		}
		catch(error){
			alertError(error);
			$("#loginBtn").val("Přihlásit se");
			logingIn = false;
		}
	}
</script>