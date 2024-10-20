<!DOCTYPE html>
<html lang="cs">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=720, maximum-scale=1.0">
	<title>Bakaláři v2 | <?= $pageTitle; ?></title>

	<!-- Links CSS and JS -->
	<link rel="icon" type="image/x-icon" href="https://bakalari.cz/favicons/favicon-32x32.png">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<link rel="stylesheet" href="https://zabak.eu/tools/src/css/main-01062024-8.css">
	<link rel="stylesheet" href="/tools/src/css/main16.css">
	
	<!-- EXTERNAL -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" defer></script>
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