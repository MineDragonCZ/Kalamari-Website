<?php
$pageTitle = "Suplování";
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
					<h3>Zobrazení úprav rozvrhu</h3>
					<span class="card-desc">
						Na této stránce naleznete veškeré úpravy rozvrhu a to 14 dní dopředu.
					</span>
				</div>
			</div>
		</div>
		<div class="row justify-content-center mb-3">
			<div class="col-6" id="dateSelectorWrapper">
				<input type="date" id="dateSelector" onchange="dateString = this.value; updateSubstitutionTable();" class="form-control">
			</div>
		</div>
		<div class="col-12" style="overflow-x: auto;">
			<table id="substitutionTable" class="pb-5 table table-striped table-borderless" style="margin-bottom: 250px;"></table>
		</div>
	</div>
</div>

<?= (new Footer())->getHTML(); ?>

<script>
	setupLoginChecker();

	var dateString = new Date().toISOString().split('T')[0];
	var linkDate = getFromLink("d");
	if(linkDate){
		dateString = linkDate;
	}

	function updateDate(){
		pushLink("substitutions", "?d=" + dateString);
		$("#dateSelector").val(dateString);
	}

	async function updateSubstitutionTable() {
		updateDate();
		var response = await fetchDataFromBAK('/api/3/substitutions/?from=' + dateString, null, "GET", true);
		var json = await response.json();
		console.log(json);

		var table = $("#substitutionTable");

		/* REMAP FROM ARRAYS TO OBJECTS */

		/* PRINT INTO TABLE */
		var content = "";
		content += `<thead>`;
		content += `<td></td>`;
		content += `<td></td>`;
		content += `<td></td>`;
		content += `<td></td>`;
		content += `<td></td>`;
		content += `</thead>`;
		for(let i = 0; i < json.Changes.length; i++){
			var change = json.Changes[i];
			var date = new Date(change.Day);
			var day = `${getDayName(date.getDay(), false)} <span>(${date.toLocaleDateString()})</span>`;
			var hourInterval = change.Hours;
			var icon = '';
			var timeInterval = change.Time;
			var desc = change.Description;

			switch(change.ChangeType){
				case "Added":
					icon = '<i class="fa-solid fa-circle-plus fa-fw" style="color: #24aa13;"></i>';
					break;
				case "Removed":
					icon = '<i class="fa-solid fa-circle-minus fa-fw" style="color: #b01111;"></i>';
					break;
				case "Canceled":
					icon = '<i class="fa-solid fa-circle-xmark fa-fw" style="color: #b01111;"></i>';
					break;
				case "Substitution":
					icon = '<i class="fa-solid fa-repeat fa-fw" style="color: #117bb0;"></i>';
					break;
				default:
					break;
			}

			if(new Date().setHours(0,0,0,0) == date.setHours(0,0,0,0))
				content += `<tr class="bordered-row" style="--back: var(--secondary);">`;
			else
				content += `<tr>`;
			content += `<td class="text-orange">${day}</td>`;
			content += `<td class="text-orange">${hourInterval}</td>`;
			content += `<td>${icon}</td>`;
			content += `<td class="card-desc text-sm">${timeInterval}</td>`;
			content += `<td>${desc}</td>`;
			content += `</tr>`;
		}
		table.html(content);
	}
	updateSubstitutionTable();
</script>