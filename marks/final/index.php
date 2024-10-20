<?php
$pageTitle = "Pololetní klasifikace";
include("../../tools/inc/page.php");
?>

<div class="mx-5">
	<div class="col-12">
		<div class="col-12" style="overflow-x: auto;">
			<table id="marksTable" class="pb-5 table table-striped table-borderless" style="margin-bottom: 250px;"></table>
		</div>
	</div>
</div>

<?= (new Footer())->getHTML(); ?>

<script>
	setupLoginChecker();

	async function updateMarksTable() {
		var response = await fetchDataFromBAK('/api/3/marks/final', null, "GET", true);
		var json = await response.json();

		var table = $("#marksTable");

		var subjects = {};
		var marks = {};
		var data = {};

		/* REMAP FROM ARRAYS TO OBJECTS */
		for (let i = 0; i < json.CertificateTerms.length; i++) {
			var term = json.CertificateTerms[i];
			var termMarks = term.FinalMarks;
			var termSubjects = term.Subjects;

			if (!data[term.Grade]) data[term.Grade] = {};
			data[term.Grade][term.Semester] = term;
			for (let j = 0; j < termMarks.length; j++) {
				var termMark = termMarks[j];
				if (!marks[termMark.SubjectId]) marks[termMark.SubjectId] = {};
				if (!marks[termMark.SubjectId][term.Grade]) marks[termMark.SubjectId][term.Grade] = {};
				marks[termMark.SubjectId][term.Grade][term.Semester] = termMark;
			}
			for (let j = 0; j < termSubjects.length; j++) {
				var termSubject = termSubjects[j];
				subjects[termSubject.Id] = termSubject;
			}
		}

		/* PRINT INTO TABLE */
		var content = "";
		var colsCount = 1;
		for (const [grade, semesters] of Object.entries(data)) {
			for (const [semester, semesterData] of Object.entries(semesters)) {
				colsCount++;
			}
		}
		content += `<tbody>`;
		for (let i = 0; i < 6; i++) {
			content += `<tr>`;
			content += `<td><b>`;
			if(i == 0) content += `Ročník:`;
			else if(i == 1) content += `Pololetí/Semestr:`;
			else if(i == 2) content += `Průměr:`;
			else if(i == 3) content += `Zameškáno (Celkem/Neoml.):`;
			else if(i == 4) content += `Hodnocení:`;
			else if(i == 5) content += `Vysvědčení:`;
			content += `</b></td>`;
			let k = 0;
			for (const [grade, semesters] of Object.entries(data)) {
				var backColor = (k / Math.max(Object.entries(data).length, 1)) * 360;
				k++;
				var isGradeStart = true;
				for (const [semester, semesterData] of Object.entries(semesters)) {
					content += `<td class="center${isGradeStart ? ' bordered-row' : ''}" style="--back: hsla(${backColor}, 100%, 50%, 50%); background: hsla(${backColor}, 100%, 50%, 15%);"`;
					if (i == 0) {
						content += ` colspan="${Object.entries(semesters).length}"><b>${semesterData.GradeName ? (semesterData.GradeName.capitalize() + (semesterData.SchoolYear ? ` <span class="card-desc">(${semesterData.SchoolYear})</span>` : '')) : ""}</b>`;
						content += `</td>`;
						break;
					}
					else if (i == 1){
						content += `><span class="card-desc no-wrap">${semesterData.SemesterName}</span>`;
					}
					else if (i == 2) {
						content += `><span class="card-desc no-wrap">${semesterData.MarksAverage ? semesterData.MarksAverage.toLocaleString() : ""}</span>`;
					}
					else if (i == 3) {
						content += `><span class="card-desc no-wrap">${semesterData.AbsentHours ? semesterData.AbsentHours.toLocaleString() : "0"}/${semesterData.NotExcusedHours ? semesterData.NotExcusedHours.toLocaleString() : "0"}</span>`;
					}
					else if (i == 4) {
						content += `><span class="card-desc no-wrap">${semesterData.AchievementText ? semesterData.AchievementText.capitalize() : ""}</span>`;
					}
					else if (i == 5) {
						content += `><span class="card-desc no-wrap">${semesterData.CertificateDate ? new Date(semesterData.CertificateDate).toLocaleDateString() : ""}</span>`;
					}
					content += `</td>`;
					isGradeStart = false;
				}
			}
			content += `</tr>`;
		}
		content += `<tr><td class="center text-lg" colspan="${colsCount}"><b>Jednotlivé předměty</b></td>`;
		content += `</tr>`;
		for(const [subjectId, subjectData] of Object.entries(subjects)){
			content += `<tr>`;
			content += `<td><b>${subjectData.Name}</b>`;
			content += `</td>`;
			let i = 0;
			for (const [grade, semesters] of Object.entries(data)) {
				var backColor = (i / Math.max(Object.entries(data).length, 1)) * 360;
				i++;
				let isGradeStart = true;
				for (const [semester, semesterData] of Object.entries(semesters)) {
					var mark = marks[subjectId] ? (marks[subjectId][grade] ? marks[subjectId][grade][semester] : undefined) : undefined;
					content += `<td class="center${isGradeStart ? ' bordered-row' : ''}" style="--back: hsla(${backColor}, 100%, 50%, 50%); background: hsla(${backColor}, 100%, 50%, 15%);">${mark ? ("<b>" + mark.MarkText + "</b>") : "-"}`;
					content += `</td>`;
					isGradeStart = false;
				}
			}
			content += `</tr>`;
		}
		content += `</tbody>`;
		table.html(content);
	}
	updateMarksTable();
</script>
<style>
	.bordered-row {
		font-weight: normal;
	}
</style>