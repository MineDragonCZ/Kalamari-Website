function switchHost(newHost) {
	setCookie("bak_host", newHost);
}
function switchCity(newCity) {
	setCookie("bak_city", newCity);
}
function setAccessToken(token) {
	setCookie("bak_token", token);
}
function getAccessToken() {
	return getCookie("bak_token");
}
function setRefreshToken(token) {
	setCookie("bak_refresh_token", token);
}
function getRefreshToken() {
	return getCookie("bak_refresh_token");
}

function setUser(userObject) {
	setCookie("bak_user", JSON.stringify(userObject));
}
function getUser() {
	if (!getCookie("bak_user")) return null;
	try {
		return JSON.parse(getCookie("bak_user"));
	}
	catch (error) {
		console.log(error);
		return null;
	}
}

function logout() {
	setAccessToken(null);
	setUser(null);
	alertSuccess("Odhlášení proběhlo úspěšně!");
	setTimeout(() => {
		window.location.href = "/login";
	}, 1000);
}

async function getCitiesList() {
	var response = await fetch("/fetchSchools.php", {
		method: "GET"
	});
	var json = await response.json();
	return json;
}

async function getSchoolsList() {
	if (!getCookie("bak_city")) return [];
	var response = await fetch("/fetchSchools.php?city=" + encodeURI(getCookie("bak_city")), {
		method: "GET"
	});
	var json = await response.json();
	return json;
}

async function fetchDataFromBAK(endpoint, requestBody, requestMethod, checkLogin, isTimerChecker) {
	const host = getCookie("bak_host");
	if (!host) {
		setUser(null);
		if(window.location.pathname != "/login/")
			window.location.href = "/login?returnPath=" + window.location.pathname;
		return false;
	}
	var head = { "Content-Type": "application/x-www-form-urlencoded", "Authorization": "Bearer " + getAccessToken() };
	if (!getAccessToken()) head = { "Content-Type": "application/x-www-form-urlencoded" };
	var data = {
		method: requestMethod,
		headers: head
	};
	if (requestBody) data.body = requestBody;
	var response = await fetch(host + endpoint, data);
	if (checkLogin) {
		if (response.status != 200) {
			if (isTimerChecker) {
				setTimeout(() => {
					alertWarning("Byli jste odhlášeni!");
					setUser(null);
					window.location.href = "/login?returnPath=" + window.location.pathname;
				}, 1000);
			}
			else
				window.location.href = "/login?returnPath=" + window.location.pathname;
		}
	}
	return response;
}

function setupLoginChecker() {
	var loginChecker = async (isTimer) => {
		fetchDataFromBAK("/api/3/webmodule", null, "GET", true, isTimer);
	}
	setInterval(() => {
		loginChecker(true);
	}, 10000);
	loginChecker(false);
}

function setupLogoutChecker() {
	var interval;
	var logoutChecker = async () => {
		var response = await fetchDataFromBAK("/api/3/webmodule", null, "GET", false);
		if(response.status == 200){
			if(getFromLink("returnPath") && getFromLink("returnPath") != "/login/"){
				window.location.href = getFromLink("returnPath");
			}
			else
				window.location.href = "/dashboard/";
		}
		else
			clearInterval(interval);
	}
	interval = setInterval(() => {
		logoutChecker();
	}, 10000);
	logoutChecker();
}

async function updateUserPermissionsAndNavbar() {
	var json = getUser();
	if(!json){
		const host = getCookie("bak_host");
		if (!host) return;
		var response = await fetchDataFromBAK("/api/3/user", null, "GET", false);
		if (response.status != 200) return;
		json = await response.json();
		setUser(json);
	}
	$("#usernameDiv").html(`
		<div class="row align-items-center m-0 p-0">
			<div class="col-auto text-xl m-0 p-0">
				<i class="fa-solid fa-user"></i>
			</div>
		<div class="col m-0 p-0 ps-2">
			<div style="margin-bottom: -10px;"><linkTitle>${json.FullName}</linkTitle></div>
			<linkTitle class="card-desc text-sm">${json.UserTypeText.capitalize()}</linkTitle>
		</div>
	`);

	/* SETUP NAVBAR */
	var modules = json.EnabledModules;
	var enabledModules = [];
	var nav = $("#mainNavbar");
	var translates = JSON.parse($("#mainNavbarTranslates").html());
	var content = '';
	for(let i = 0; i < modules.length; i++){
		enabledModules.push(modules[i].Module);
		for(let j = 0; j < modules[i].Rights.length; j++){
			enabledModules.push(modules[i].Module + "::" + modules[i].Rights[j]);
		}
	}
	for(const [key, data] of Object.entries(translates)){
		var perm = data.permission;
		if(perm && !enabledModules.includes(perm)){
			continue;
		}
		if(!data.subs){
			var active = (window.location.pathname == data.link);
			content += `<li class="nav-item nav-item-panel">
				<a class="nav-link no-wrap${active ? " pp-active" : ""}" target="${data.target}" href="${data.link}">
					<i class="${data.icon}"></i><linkTitle> ${data.name}</linkTitle>
				</a>
			</li>`;
			continue;
		}
		var subLinks = ``;
		var anyActiveLinks = false;
		for(const [subKey, subData] of Object.entries(data.subs)){
			var perm = subData.permission;
			if(perm && !enabledModules.includes(perm)){
				continue;
			}
			var active = (window.location.pathname == subData.link);
			anyActiveLinks |= active;
			subLinks += `
				<li class="nav-item text-md nav-item-panel py-2 ps-4">
					<a class="nodecor${active ? " pp-active" : ""}" target="${subData.target}" href="${subData.link}">${subData.name}</a>
				</li>`;
		}
		content += `
			<li class="nav-item nav-item-panel">
				<a class="nav-link no-wrap" onclick="toggleDropdown(this); return false;" targetElm="toggle_nav_elm_${key}" toggled="${anyActiveLinks ? "true" : "false"}">
					<i class="${data.icon}"></i><linkTitle> ${data.name} <i class="fa-solid fa-caret-down"></i></linkTitle>
				</a>
				<ul class="navbar-nav toggleDown" style="z-index: 99 !important; position: relative;" id="toggle_nav_elm_${key}">
		`;
		content += subLinks;
		content += `
				</ul>
			</li>
		`;
	}
	nav.html(content);
}
setTimeout(updateUserPermissionsAndNavbar, 10);
