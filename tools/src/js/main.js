/**
 * MAIN JS FILE FOR AW WEBSITE
 * @author MineDragonCZ_
 */

// darkmode
function setRootVar(name, value) {
	var r = document.querySelector(':root');
	r.style.setProperty(name, value);
}
function getRootVar(name) {
	var r = document.querySelector(':root');
	return r.style.getPropertyValue(name);
}

function switchTheme(color) {
	setCookie("theme_color", color);
	switchModes(false);
}

function getTheme() {
	let theme = getCookie("theme_color");
	if (theme == undefined || theme == null) theme = "#00A2E2";
	return theme;
}

function resetTheme(elmToUpdate) {
	switchTheme("#00A2E2");
	elmToUpdate.value = getTheme();
}


function switchModes(change) {
	let theme = getTheme();
	let whitemode = getCookie("whitemode");
	if (change) whitemode = !whitemode;
	setCookie("whitemode", whitemode);
	if (!whitemode) {
		// darkmode
		setRootVar("--icon", "'🌘'");

		setRootVar('--primary', '#12141C');
		setRootVar('--secondary', theme);
		setRootVar('--secondary-opacity', theme + 'AA');
		setRootVar('--secondary-opacity2', theme + 'DD');
		setRootVar('--secondary-opacity3', theme + '44');
		setRootVar('--secondary-opacity4', theme + '8A');
		setRootVar('--third', '#868686');
		setRootVar('--footer', '#171924');
		setRootVar('--fifth', '#DBD3C8');

		setRootVar('--cardbacks', '#171924');
		setRootVar('--cardbacks-opacity2', '#171924DD');
		setRootVar('--cardbacks-opacity5', '#1719245D');
		setRootVar('--card-shadow', 'none');
		setRootVar('--page-title-shadow', '4px 4px 13px rgba(0,0,0,1)');
		setRootVar('--navlink', '#fff');

		setRootVar('--statusColor', '#fff');
		setRootVar('--statusBorder', '2px solid #fff');

		setRootVar('--waves1', '#12141C00');
		setRootVar('--waves2', '#12141C77');
		setRootVar('--waves3', '#12141CAA');
		setRootVar('--waves4', '#12141CDD');
		setRootVar('--waves5', '#12141CFF');

		setRootVar('--navback', 'linear-gradient(180deg, #12141Cff 0%, #12141C77 61%, #12141C00 100%)');

		setRootVar('--backimg1', 'url("/tools/src/imgs/headers/header_dark11.webp")');
		setRootVar('--backimg2', 'url("/tools/src/imgs/headers/header_dark3.webp")');
		setRootVar('--backimg2-bright', '25%');

		// btns
		setRootVar('--btn1back', 'linear-gradient(to right, ' + theme + 'FF 0%, ' + theme + 'FF 25%, ' + theme + 'AA 75%, ' + theme + 'AA 100%)');
		setRootVar('--btn-success-back', 'linear-gradient(to right, #17870BFF 0%, #17870BFF 25%, #17870BAA 75%, #17870BAA 100%)');
		setRootVar('--btn-danger-back', 'linear-gradient(to right, #910C0CFF 0%, #910C0CFF 25%, #910C0CAA 75%, #910C0CAA 100%)');

		setRootVar('--btn2color', '#DBD3C8');
		setRootVar('--btn2border', '1px solid ' + theme);
		setRootVar('--btn2color-hover', theme);
		setRootVar('--btn2border-hover', '1px solid ' + theme);
		setRootVar('--btn2color-focus', theme);
		setRootVar('--btn2border-focus', '1px solid ' + theme);

		// inputs
		setRootVar('--inputsback', '#2B2E37');
		setRootVar('--inputsback-active', theme);
		return;
	}
	else if (whitemode) {
		// lightmode
		setRootVar("--icon", "'🌞'");

		setRootVar('--primary', '#D8D8D8');
		setRootVar('--secondary', theme);
		setRootVar('--secondary-opacity', theme + 'AA');
		setRootVar('--secondary-opacity2', theme + 'DD');
		setRootVar('--secondary-opacity3', theme + '44');
		setRootVar('--secondary-opacity4', theme + '8A');
		setRootVar('--third', '#7C7C7C');
		setRootVar('--footer', '#CDD0DA');
		setRootVar('--fifth', '#46423C');

		setRootVar('--cardbacks', '#CDD0DA');
		setRootVar('--cardbacks-opacity2', '#CDD0DADD');
		setRootVar('--cardbacks-opacity5', '#CDD0DA5D');
		setRootVar('--card-shadow', '-5px 5px 45px 10px rgba(0,0,0,0.3)');
		setRootVar('--page-title-shadow', '4px 4px 13px rgba(0,0,0,1)');
		setRootVar('--navlink', '#000');

		setRootVar('--statusColor', '#000');
		setRootVar('--statusBorder', '2px solid #000');

		setRootVar('--waves1', '#D8D8D800');
		setRootVar('--waves2', '#D8D8D877');
		setRootVar('--waves3', '#D8D8D8AA');
		setRootVar('--waves4', '#D8D8D8DD');
		setRootVar('--waves5', '#D8D8D8FF');

		setRootVar('--navback', 'linear-gradient(180deg, #fff 0%, #00000000 100%)');

		setRootVar('--backimg1', 'url("/tools/src/imgs/headers/header_light11.webp")');
		setRootVar('--backimg2', 'url("/tools/src/imgs/headers/header_light3.webp")');
		setRootVar('--backimg2-bright', '125%');

		// btns
		setRootVar('--btn1back', 'linear-gradient(to right, ' + theme + 'FF 0%, ' + theme + 'FF 25%, ' + theme + 'AA 75%, ' + theme + 'AA 100%)');
		setRootVar('--btn-success-back', 'linear-gradient(to right, #17870BFF 0%, #17870BFF 25%, #17870BAA 75%, #17870BAA 100%)');
		setRootVar('--btn-danger-back', 'linear-gradient(to right, #910C0CFF 0%, #910C0CFF 25%, #910C0CAA 75%, #910C0CAA 100%)');

		setRootVar('--btn2color', '#000');
		setRootVar('--btn2border', '1px solid #000');
		setRootVar('--btn2color-hover', theme);
		setRootVar('--btn2border-hover', '1px solid #000');
		setRootVar('--btn2color-focus', theme);
		setRootVar('--btn2border-focus', '1px solid #000');

		// inputs
		setRootVar('--inputsback', '#BBBEC9');
		setRootVar('--inputsback-active', theme);
		return;
	}
}
switchModes(false);


// TOGGLER
let toggled = {};
function toggleElementState(elmId, defaultState, toggledState, attributeToChange) {
	let elm = document.getElementById(elmId);
	if (toggled[elmId] !== undefined) {
		if (toggled[elmId]) {
			toggled[elmId] = false;
			if (attributeToChange == "innerHTML") {
				elm.innerHTML = defaultState;
			}
			else if (attributeToChange == "innerHTMLMath") {
				defaultState = defaultState.replaceAll("*current*", elm.innerHTML);
				elm.innerHTML = addbits(defaultState);
			}
			else if (attributeToChange == "class")
				elm.classList.value = defaultState;
			else
				elm.setAttribute(attributeToChange, defaultState);
			return;
		}
		else {
			toggled[elmId] = true;
			if (attributeToChange == "innerHTML") {
				elm.innerHTML = toggledState;
			}
			else if (attributeToChange == "innerHTMLMath") {
				toggledState = toggledState.replaceAll("*current*", elm.innerHTML);
				elm.innerHTML = addbits(toggledState);
			}
			else if (attributeToChange == "class")
				elm.classList.value = toggledState;
			else
				elm.setAttribute(attributeToChange, toggledState);
			return;
		}
	}
	toggled[elmId] = false;
	toggleElementState(elmId, defaultState, toggledState, attributeToChange);
}
// STAY LOGGED FUNCTIONS
function setStayLoggedUser(user, pass) {
	pass = forge_sha256(pass);
	setCookie("users_pass", pass);
	setCookie("users_user", user);
	return false;
}

function setUserTokenToCookie(token, stayLogged) {
	setCookie("user_secret_token", token);
	setCookie("user_stay_logged", stayLogged);
}

function pushLink(id, link) {
	window.history.pushState({ id: "100" }, id, link);
}

function getFromLink(attr) {
	let uu = window.location.href;
	let par = (new URL(uu)).searchParams;
	return par.get(attr);
}

function replaceURLTags(input) {
	output = input;
	output = output.replaceAll("\&", "*and*");
	output = output.replaceAll("\#", "*hashtag*");
	output = output.replaceAll("\/", "*slash*");
	output = output.replaceAll("\<", "*sipka_l*");
	output = output.replaceAll("\>", "*sipka_p*");
	output = output.replaceAll("\.", "*tecka*");
	output = output.replaceAll("\:", "*drojtecka*");

	return output;
}

function replaceURLTagsBack(input) {
	output = input;
	output = output.replaceAll("*and*", "\&");
	output = output.replaceAll("*hashtag*", "\#");
	output = output.replaceAll("*slash*", "\/");
	output = output.replaceAll("*sipka_l*", "\<");
	output = output.replaceAll("*sipka_p*", "\>");
	output = output.replaceAll("*tecka*", "\.");
	output = output.replaceAll("*drojtecka*", "\:");

	return output;
}

/**
 * ALERTS / NOTIFERS
 */

function dismissAlerts() {
	alertify.dismissAll();
}

function alertSuccess(mess, time) {
	alert(mess, "success", time);
}

function alertError(mess, time) {
	alert(mess, "error", time);
}

function alertLoading(mess, time) {
	alert(mess, "info", time);
}

function alertWarning(mess, time) {
	alert(mess, "warning", time);
}

function alert(mess, type, time) {
	if (time == null || time == undefined) time = 2;
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-right',
		showConfirmButton: false,
		timer: time * 1000,
		timerProgressBar: true,
		didOpen: (toast) => {
		}
	});

	Toast.fire({
		icon: type,
		title: mess
	});
}


function setLoading(elm) {
	if (elm == null || elm == undefined) return;
	if (elm instanceof Array || elm instanceof HTMLCollection) {
		for (let i = 0; i < elm.length; i++) {
			elm[i].innerHTML = `
			<div class="row justify-content-center align-items-center" style="height: max(100%, 250px);">
				<div class="col-12" align="center">
					<div class="dotsLoader"></div>
				</div>
			</div>
			`;
		}
		return;
	}
	elm.innerHTML = `
	<div class="row justify-content-center align-items-center" style="height: max(100%, 250px);">
		<div class="col-12" align="center">
			<div class="dotsLoader"></div>
		</div>
	</div>
	`;
}

function setLoadingAsTR(elm, colspan) {
	if (elm == null || elm == undefined) return;
	elm.innerHTML = `
	<tr><td colspan="${colspan}"><div class="row justify-content-center align-items-center" style="height: max(100%, 250px);">
		<div class="col-12" align="center">
			<div class="dotsLoader"></div>
		</div>
	</div></td></tr>
	`;
}


function replace_urls(content) {
	var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i;
	return content.replace(exp, "[url ($1) ($1)]");
}

function openNotify(id, from, title) {
	let modalElm = $("#notifer_modal");
	let body = document.getElementById("n_text_" + id).innerHTML;

	modalElm.find('#n_notifyFrom').text(from);
	modalElm.find('#n_notifyTitle').text(title);
	document.getElementById('n_notifyBody').innerHTML = body;

	modalElm.find('#n_notifyid').val(id);

	modalElm.modal("show");
	dissmissNotifyId(id);
}
let notiferCSListener;
function dissmissNotifyId(id) {
	if (notiferCSListener == undefined)
		notiferCSListener = registerListenerCS(null, null, null, null);
	let request = new FormData();

	if (id == undefined || id == null) id = -1;

	request.append("notifer_dissmiss", "true");
	request.append("id", id);

	setRequestCS(notiferCSListener, request);
	disableNotify();
	postToServer(notiferCSListener);
	if (notifer_boxListener != null)
		getFromServerForce(notifer_boxListener);

	if (notiferListener != -2)
		getFromServerForce(notiferListener);
}
function dissmissNotify() {
	let elm = document.getElementById("n_notifyid");
	if (elm == undefined || elm == null) return;
	let id = elm.value;
	dissmissNotifyId(id);
}
function dissmissAllNotify() {
	dissmissNotifyId(null);
}

function openLink(newWindow, url, open) {
	Swal.fire({
		title: 'Dej si bacha!',
		html: 'Opravdu chceš otevřít tento odkaz?<br/><b>' + url + '</b>',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonText: 'Potvrdit',
		cancelButtonText: 'Zrušit',
	}).then((e) => {
		if (e.isConfirmed) {
			if (newWindow) window.open(url);
			else window.location.href = url;
		}
		return false;
	});
	updateSwalButtons();
	return false;
}

function updateSwalButtons() {
	let t = document.getElementsByClassName('swal2-confirm');
	for (let i = 0; i < t.length; i++) {
		t[i].className = 'btn btn-primary';
	}
	let tt = document.getElementsByClassName('swal2-cancel');
	for (let i = 0; i < tt.length; i++) {
		tt[i].className = 'btn btn-secondary';
	}
}


// ---------------------------------------------------
// CLIPBOARD
function copyToClip(text, alertMess) {
	var input = document.body.appendChild(document.createElement("textarea"));
	input.textContent = text;
	input.style.position = "fixed";
	input.style.opacity = "0";
	input.focus();
	input.select();
	document.execCommand('copy');
	input.parentNode.removeChild(input);
	if (!alertMess) alertMess = "Zkopírováno!";
	alertSuccess(alertMess);
}

// INSERTING TAGS INTO TEXTAREA
function insertIntoTextarea(elmId, value, curOffset) {
	var elm = document.getElementById(elmId);
	elm.focus();
	var curPosStart = elm.selectionStart;
	var curPosEnd = elm.selectionEnd;

	let x = elm.value;
	let text_to_insertStart = value.slice(0, curOffset);
	let text_to_insertEnd = value.slice(curOffset);
	elm.value = x.slice(0, curPosStart) + text_to_insertStart + x.slice(curPosStart, curPosEnd) + text_to_insertEnd + x.slice(curPosEnd);
	elm.selectionStart = (curPosStart + curOffset);
	elm.selectionEnd = (curPosEnd + curOffset);
}

// SCROLLING BY ARROWS
function Position(o) {
	let obj = o;
	if (obj == null || !obj) return [0, 0];
	var currenttop = 0;
	if (obj.offsetParent) {
		do {
			currenttop += obj.offsetTop;
		} while ((obj = obj.offsetParent));
	}
	return [currenttop, currenttop + o.offsetHeight];
}
function scrollToContent() {
	window.scroll(0, Position(document.getElementsByClassName("modals-list")[0])[0] - 35);
	//window.scroll(0, screen.height);
}

// Date utils
function getDayName(id, short) {
	if (short)
		return ['Ne', 'Po', 'Út', 'St', 'Čt', 'Pá', 'So'][id];
	return ['Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota'][id];
}

// Color utils
function HSLToRGB(h, s, l) {
	s /= 100;
	l /= 100;
	const k = n => (n + h / 30) % 12;
	const a = s * Math.min(l, 1 - l);
	const f = n => l - a * Math.max(-1, Math.min(k(n) - 3, Math.min(9 - k(n), 1)));
	return [255 * f(0), 255 * f(8), 255 * f(4)];
};

function rgbToHue(r, g, b) {
	return Math.round(
		Math.atan2(
			Math.sqrt(3) * (g - b),
			2 * r - g - b,
		) * 180 / Math.PI
	);
}

function hexToRgb(hex) {
	// Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
	var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
	hex = hex.replace(shorthandRegex, function (m, r, g, b) {
		return r + r + g + g + b + b;
	});

	var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	return result ? {
		r: parseInt(result[1], 16),
		g: parseInt(result[2], 16),
		b: parseInt(result[3], 16)
	} : null;
}

// Download img
function downloadIMG(data, name) {
	var a = $("<a>")
		.attr("href", data)
		.attr("download", name)
		.appendTo("body");

	a[0].click();

	a.remove();
}

// Teams info
function displayUserInfo(elm) {
	let t = elm.getAttribute("data-text");
	let u = elm.getAttribute("data-user");
	let tt = document.getElementById(t).innerHTML;

	$("#about_user_modal").modal("toggle");
	$("#user_about_user").html(u);
	$("#user_about_body").html(tt);
}


var sideNavToggleEvent;
if (document.createEvent) {
	sideNavToggleEvent = document.createEvent("HTMLEvents");
	sideNavToggleEvent.initEvent("sideNavToggleEvent", true, true);
	sideNavToggleEvent.eventName = "sideNavToggleEvent";
} else {
	sideNavToggleEvent = document.createEventObject();
	sideNavToggleEvent.eventName = "sideNavToggleEvent";
	sideNavToggleEvent.eventType = "sideNavToggleEvent";
}
function toggleSideNav(forceHide) {
	console.log(window.innerWidth);
	if (window.innerWidth >= 1080 && forceHide) return;

	let nav = $("#sideNavToggled");
	let parent = $("#sideNavToggledParent");
	if (!nav.hasClass("d-none")) {
		// hide
		nav.addClass("d-none");
		nav.removeClass("d-block");
		parent.removeClass("h-100");

	}
	else if (!forceHide) {
		// show
		nav.addClass("d-block");
		nav.removeClass("d-none");
		parent.addClass("h-100");
	}

	if (document.createEvent) {
		document.dispatchEvent(sideNavToggleEvent);
	} else {
		document.fireEvent(sideNavToggleEvent.eventType, sideNavToggleEvent);
	}
}

function makeUUID(length) {
	let result = '';
	const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	const charactersLength = characters.length;
	let counter = 0;
	while (counter < length) {
		result += characters.charAt(Math.floor(Math.random() * charactersLength));
		counter += 1;
	}
	return result;
}

function getMonday(d) {
	d = new Date(d);
	var day = d.getDay(),
		diff = d.getDate() - day + (day == 0 ? -6 : 1); // adjust when day is sunday
	return new Date(d.setDate(diff));
}

Date.prototype.addDays = function(days) {
    var date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
}

Object.defineProperty(String.prototype, 'capitalize', {
	value: function() {
	  return this.charAt(0).toUpperCase() + this.slice(1);
	},
	enumerable: false
  });