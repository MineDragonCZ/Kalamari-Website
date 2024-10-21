<!DOCTYPE html>
<html lang="cs">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=720, maximum-scale=1.0">
	<title>Kalamáři | <?= $pageTitle; ?></title>

	<!-- Primary Meta Tags -->
	<meta name="description" content="">
	<meta name="author" content="Vojtěch Šín">
	<meta name="keywords" content="Kalamáři,Školní systém,API,Bakaláři,REST,Škola,Rozvrh,Timetable">

	<!-- Scheme color -->
	<meta name="theme-color" content="#00A2E2">
	<meta name="msapplication-navbutton-color" content="#00A2E2">
	<meta name="apple-mobile-web-app-status-bar-style" content="#00A2E2">
	<meta content="notranslate" name="google">

	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="https://kalamari.zabak.eu/">
	<meta property="og:image" content="https://kalamari.zabak.eu/tools/src/imgs/kalamari.png">

	<!-- Twitter -->
	<!--<meta property="twitter:card" content="summary_large_image">-->
	<meta property="twitter:url" content="https://kalamari.zabak.eu/">
	<meta property="twitter:image" content="https://kalamari.zabak.eu/tools/src/imgs/kalamari.png">

	<!-- Links CSS and JS -->
	<link rel="icon" type="image/x-icon" href="/tools/src/imgs/kalamari_icon.png">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<link rel="stylesheet" href="https://zabak.eu/tools/src/css/main-01062024-8.css">
	<link rel="stylesheet" href="/tools/src/css/main17.css">
	
	<!-- EXTERNAL -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<script src="https://kit.fontawesome.com/0dd034efb8.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<!-- INTERNAL -->
	<script src="/tools/src/js/cookies.js"></script>
	<script src="/tools/src/js/main.js?t=<?= time(); ?>"></script>
	<script src="/tools/src/js/pagesManager.js?t=<?= time(); ?>"></script>
	<script src="/tools/src/js/bakalariAPIFetch.js?t=<?= time(); ?>"></script>

	<script defer>
		// Sušenky
		if(!getCookie("susenky")){
			setTimeout(() => {
				Swal.fire({
					title: 'Sušenky!',
					html: 'Tento web používá soubory cookie.<br/>Pokračováním s tímto faktem souhlasíte.',
					icon: 'warning',
					//iconColor: '#12BA39',
					confirmButtonText: 'Jasně, chápu!',
				}).then((e) => {
					if(e.isDismissed || e.isConfirmed || e.isDenied){
						setCookie("susenky", "1");
					}
				});
				updateSwalButtons();
			}, 10);
		}

	</script>
</head>
<body>