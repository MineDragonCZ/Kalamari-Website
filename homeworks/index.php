<?php
$pageTitle = "Domácí úkoly";
include(dirname(__FILE__) . "/../tools/inc/page.php");
?>

<div class="mx-5">
	<div class="col-12">
		<div class="mb-2 alert" style="--border: #0FD1F7c5; --back: #0FD1F722; --style: none;">
			<div class="row align-items-center">
				<div class="col-auto ms-3">
					<span class="text-xxl" style="color: #0FD1F7c5;"><i class="fa-solid fa-circle-info"></i></span>
				</div>
				<div class="col">
					<h3>Zobrazení zadaných domácích úkolů</h3>
					<span class="card-desc">
						Na této stránce naleznete veškeré úkoly, které byly zadány maximálně 14 dní nazpět.
					</span>
				</div>
			</div>
		</div>
		<div class="col-12" style="overflow-x: auto;">
			<table id="homeworksTable" class="pb-5 table table-striped table-borderless" style="margin-bottom: 250px; vertical-align: middle;"></table>
		</div>
	</div>
</div>

<?= (new Footer())->getHTML(); ?>

<script>
	setupLoginChecker();

	async function updateHomeworksTable() {
		var response = await fetchDataFromBAK('/api/3/homeworks/', null, "GET", true);
		var json = await response.json();
		
		var table = $("#homeworksTable");

		/* PRINT INTO TABLE */
		var content = "";
		content += `<thead>`;
		content += `<td width="250px"><b>Zadáno / Termín</b></td>`;
		content += `<td width="100px"><b>Předmět</b></td>`;
		content += `<td><b>Zadání</b></td>`;
		//content += `<td><b>Dokončeno</b></td>`;
		content += `</thead>`;
		for(let i = 0; i < json.Homeworks.length; i++){
			var homework = json.Homeworks[i];
			content += `<tr>`;
			content += `<td class="card-desc no-wrap text-sm">${new Date(homework.DateStart).toLocaleDateString()} / ${new Date(homework.DateStart).toLocaleDateString()}</td>`;
			content += `<td class="text-orange"><b>${homework.Subject.Abbrev}</b></td>`;
			content += `<td class="card-desc text-sm">${homework.Content.replaceAll("\n", "<br/>")}</td>`;
			/*content += `
			<td>
				<input type="checkbox" class="btn-check" id="homework_checked_${homework.ID}" autocomplete="off">
				<label class="btn btn-outline-primary" for="homework_checked_${homework.ID}">Dokončeno</label>
			</td>
			`;*/
			content += `</tr>`;
		}
		table.html(content);
	}
	updateHomeworksTable();
</script>