<?php
$pageTitle = "Přehled předmětů";
include(dirname(__FILE__) . "/../tools/inc/page.php");
?>

<div class="mx-5">
	<div class="col-12">
		<div class="col-12" style="overflow-x: auto;">
			<table id="subjectsTable" class="pb-5 table table-striped table-borderless" style="margin-bottom: 250px; vertical-align: middle;"></table>
		</div>
	</div>
</div>

<?= (new Footer())->getHTML(); ?>

<script>
	setupLoginChecker();

	async function updateSubjectsTable() {
		var response = await fetchDataFromBAK('/api/3/subjects/', null, "GET", true);
		var json = await response.json();
		
		var table = $("#subjectsTable");

		/* PRINT INTO TABLE */
		var content = "";
		content += `<thead>`;
		content += `<td><b>Předmět</b></td>`;
		content += `<td><b>Učitel</b></td>`;
		content += `</thead>`;
		for(let i = 0; i < json.Subjects.length; i++){
			var subject = json.Subjects[i];

			content += `<tr>`;
			content += `<td class="card-desc no-wrap">${subject.SubjectName}</td>`;
			content += `<td class="card-desc no-wrap"><b>${subject.TeacherName}</b> (${subject.TeacherAbbrev})</td>`;
			content += `</tr>`;
		}
		table.html(content);
	}
	updateSubjectsTable();
</script>