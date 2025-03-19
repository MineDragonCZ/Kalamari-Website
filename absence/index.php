<?php
$pageTitle = ($isSubjectsTable ? "Zameškanost v předmětech" : "Přehled absence");
include(dirname(__FILE__) . "/../tools/inc/page.php");
?>

<div class="mx-5">
	<div class="col-12">
		<div class="col-12" style="overflow-x: auto;">
			<table id="absenceTable" class="pb-5 table table-striped table-borderless" style="margin-bottom: 250px;"></table>
		</div>
	</div>
</div>

<?= (new Footer())->getHTML(); ?>

<script>
	setupLoginChecker();

	async function updateAbsenceTable() {
		var isSubjectsTable = <?= ($isSubjectsTable ? "true" : "false"); ?>;
		var response = await fetchDataFromBAK('/api/3/absence/student', null, "GET", true);
		var json = await response.json();

		var table = $("#absenceTable");

		/* REMAP FROM ARRAYS TO OBJECTS */

		/* PRINT INTO TABLE */
		var content = "";
		if(isSubjectsTable){
			content += `<thead>`;
			content += `<td><b>Předmět</b></td>`;
			content += `<td class="center"><b>Celkem hodin</b></td>`;
			content += `<td class="center"><b>Absence</b></td>`;
			content += `<td class="center"><b>%</b></td>`;
			content += `<td class="center"><b>Možno zameškat</b></td>`;
			content += `</thead>`;
			for(let i = 0; i < json.AbsencesPerSubject.length; i++){

				var subject = json.AbsencesPerSubject[i];
				var totalMissed = subject.Base + subject.Late + subject.Soon;
				var percentage = (subject.LessonsCount > 0 ? ((totalMissed / subject.LessonsCount) * 100) : 0);
				var percentageString = (subject.LessonsCount > 0 ? (percentage.toFixed(2) + "%") : "-");
				var color = '#24aa13';
				if(percentage >= 20)
					color = '#d47216';
				if(percentage >= 25)
					color = '#d41616';

				var moznoZameskatX = -(totalMissed - 0.25*subject.LessonsCount)/0.75;

				// moznoZameskatX > moznoZameskat
				var moznoZameskat = moznoZameskatX.toFixed(0);
				if(moznoZameskat > moznoZameskatX) moznoZameskat = (moznoZameskatX.toFixed(0) - 1);
				if(moznoZameskat < 0) moznoZameskat = 0;

				content += `<tr class="bordered-row" style="--back: ${color}77; background: ${color}22;">`;
				content += `<td>${subject.SubjectName}</td>`;
				content += `<td class="center">${subject.LessonsCount}</td>`;
				content += `<td class="center">${totalMissed}</td>`;
				content += `<td class="center" style="color: ${color};">${percentageString}</td>`;
				content += `<td class="center">${moznoZameskat}</td>`;
				content += `</tr>`;
			}
		}
		else {}
		table.html(content);
	}
	updateAbsenceTable();
</script>