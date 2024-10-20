<?php
$pageTitle = "Průběžná klasifikace";
include("../tools/inc/page.php");
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
		var response = await fetchDataFromBAK('/api/3/marks', null, "GET", true);
		var json = await response.json();

		var table = $("#marksTable");
		var subjects = {};
		var marks = {};
		var options = {};

		for(let i = 0; json.MarkOptions && i < json.MarkOptions.length; i++){
			var option = json.MarkOptions[i];
			options[option.Id] = option;
		}

		/* REMAP FROM ARRAYS TO OBJECTS */
		for(let i = 0; i < json.Subjects.length; i++){
			var subject = json.Subjects[i];
			marks[subject.Subject.Id] = {};
			subjects[subject.Subject.Id] = subject;
			//subjects[subject.Subject.Id].AverageText = '0';
			var sum = 0;
			var count = 0;
			for(let j = 0; j < subject.Marks.length; j++){
				var mark = subject.Marks[j];
				marks[subject.Subject.Id][mark.Id] = mark;
				if(options[mark.markText]) marks[subject.Subject.Id][mark.Id]["desc"] = options[mark.markText].Name.capitalize();

				if(typeof mark.Weight == "number" && parseInt(mark.MarkText) != NaN){
					sum += (parseInt(mark.MarkText) * mark.Weight / (mark.IsPoints ? 100 : 1));
					count += mark.Weight;
				}
			}
			/*if(count != 0){
				subjects[subject.Subject.Id].AverageText = (sum/count).toFixed(2).toLocaleString();
			}*/
		}

		/* PRINT INTO TABLE */
		var content = '<tbody>';
		let index = 0;
		for(const [subjectId, subjectData] of Object.entries(subjects)){
			content += `<tr>`;
			content += `<td width="350px" style="vertical-align: middle;">`;
			content += `
				<div class="left card-title p-0 ps-3 no-wrap">${subjectData.Subject.Name}</div>
			`;
			content += `</td>`;
			content += `<td width="50px" class="hoverable-card-trigger">`;
			content += `
				<div class="right card-desc p-0 no-wrap">${subjectData.AverageText}</div>
				<div class="hoverable-card back-karta" style="">
					<span class="card-desc text-sm">Vážený průměr za pololetí</span>
				</div>
			`;
			content += `</td>`;
			let i = 0;
			for(const [markId, markData] of Object.entries(marks[subjectId])){
				var backColor = '#b8b8b8';
				if(markData.IsNew) backColor = '#48fe06';
				//if(parseInt(markData.MarkText) != NaN && ((parseInt(markData.MarkText) > 4 && !markData.IsPoints) || (parseInt(markData.MarkText) < 25 && markData.IsPoints))) backColor = '#ff0000';
				content += `<td width="150px" class="timetable-hour hoverable-card-trigger embed-karta-left" style="background: ${backColor}22; --color: ${backColor};">`;
				content += `
					<div class="row h-100">
						<div class="col-12 align-self-center center card-title" style="font-size: ${(markData.Weight + 4)*4}px;">${markData.MarkText}${markData.IsPoints ? '%' : ''}</div>
						<div class="col-12 align-self-end center card-desc text-sm no-wrap">${markData.Weight}<br/>${new Date(markData.MarkDate).toLocaleDateString()}</div>
					</div>
						
					<div class="hoverable-card back-karta" style="width: 350px;">
						<div class="card-desc left text-sm">${subjectData.Subject.Name}</div>
						<table class="col-12">
							<tr>
								<td><span class="card-desc text-sm">Známka:</span></td>
								<td><span class="text-sm">${markData.MarkText}${markData.IsPoints ? '%' : ''}</span></td>
							</tr>
							<tr>
								<td><span class="card-desc text-sm">Datum:</span></td>
								<td><span class="text-sm">${new Date(markData.MarkDate).toLocaleDateString()}</span></td>
							</tr>
							<tr>
								<td><span class="card-desc text-sm">Váha:</span></td>
								<td><span class="text-sm">${markData.Weight}</span></td>
							</tr>
							<tr>
								<td><span class="card-desc text-sm">Typ:</span></td>
								<td><span class="text-sm">${markData.Type} (${markData.TypeNote})</span></td>
							</tr>
							<tr>
								<td><span class="card-desc text-sm">Titulek:</span></td>
								<td><span class="text-sm">${markData.Caption}</span></td>
							</tr>
							<tr>
								<td><span class="card-desc text-sm">Pořadí:</span></td>
								<td><span class="text-sm">${markData.ClassRankText}</span></td>
							</tr>
							<tr>
								<td><span class="card-desc text-sm">Téma:</span></td>
								<td><span class="text-sm">${markData.Theme}</span></td>
							</tr>
						</table>
					</div>
				`;
				content += `</td>`;
				i++;
			}
			for(let j = i; index == 0 && j < (100/15); j++){
				content += `<td width="150px" style="border: none"></td>`;
			}
			content += `</tr>`;
			index++;
		}
		content += `</tbody>`;
		table.html(content);

	}
	updateMarksTable();
</script>