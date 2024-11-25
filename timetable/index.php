<?php
$pageTitle = "Rozvrh hodin";
include(dirname(__FILE__) . "/../tools/inc/page.php");
?>

<div class="mx-5">
	<div class="col-12">
		<div class="row justify-content-center mb-3">
			<div class="col-6" id="dateSelectorWrapper">
				<input type="date" id="dateSelector" onchange="dateString = this.value; updateTimeTable();" class="form-control">
			</div>
		</div>
		<div class="col-12" style="overflow-x: auto;">
			<table id="timetable" class="table table-stripped table-borderless" style="margin-bottom: 250px;"></table>
		</div>
	</div>
</div>

<?= (new Footer())->getHTML(); ?>

<script>
	setupLoginChecker();

	var dateString = new Date().toISOString().split('T')[0];
	var linkDate = getFromLink("d");
	var isStatic = <?= ($isStaticTable ? "true" : "false"); ?>;
	if(linkDate){
		dateString = linkDate;
	}

	function updateDate(){
		if(!isStatic){
			pushLink("timetable", "?d=" + dateString);
			$("#dateSelector").val(dateString);
		}
		else
			$("#dateSelectorWrapper").html('');
	}

	async function updateTimeTable() {
		updateDate();
		var response;
		if(!isStatic)
			response = await fetchDataFromBAK('/api/3/timetable/actual?date=' + dateString, null, "GET", true);
		else
			response = await fetchDataFromBAK('/api/3/timetable/permanent', null, "GET", true);
		var json = await response.json();

		var table = $("#timetable");

		var hours = json.Hours;
		var days = {};
		var classes = {};
		var groups = {};
		var subjects = {};
		var teachers = {};
		var rooms = {};
		var cycles = {};
		var students = {};

		/*
			REMAP TO OBJECTS
		*/
		for(let i = 0; i < json.Days.length; i++){
			var day = json.Days[i];
			var index = day.DayOfWeek;
			days[index] = {
				hours: {},
				data: day
			};
			for(let j = 0; j < day.Atoms.length; j++){
				var atom = day.Atoms[j];
				days[index]["hours"][atom.HourId] = atom;
			}
		}
		for(let i = 0; i < json.Classes.length; i++){
			var current = json.Classes[i];
			classes[current.Id] = current;
		}
		for(let i = 0; i < json.Groups.length; i++){
			var current = json.Groups[i];
			groups[current.Id] = current;
		}
		for(let i = 0; i < json.Subjects.length; i++){
			var current = json.Subjects[i];
			subjects[current.Id] = current;
		}
		for(let i = 0; i < json.Teachers.length; i++){
			var current = json.Teachers[i];
			teachers[current.Id] = current;
		}
		for(let i = 0; i < json.Rooms.length; i++){
			var current = json.Rooms[i];
			rooms[current.Id] = current;
		}
		for(let i = 0; i < json.Cycles.length; i++){
			var current = json.Cycles[i];
			cycles[current.Id] = current;
		}
		for(let i = 0; i < json.Students.length; i++){
			var current = json.Students[i];
			students[current.Id] = current;
		}


		/*
			CREATE TABLE IN HTML DOM
		*/
		content = '';
		content += `<thead>`;
		content += `<th width="${50/(hours.length + 0.5)}%">`;
		content += `</th>`;
		for (let i = 0; i < hours.length; i++){
			var hour = hours[i];
			content += `<th width="${100/(hours.length + 0.5)}%">`;
			content += `<div class="center card-title">${hour.Caption}</div>`;
			content += `<div class="center card-desc no-wrap">${hour.BeginTime} - ${hour.EndTime}</div>`;
			content += `</th>`;
		}
		content += `</thead>`;
		content += `<tbody>`;
		for (const [dayIndex, day] of Object.entries(days)) {
			content += `<tr>`;
			var atoms = day.hours;
			var data = day.data;

			content += `<td class="timetable-hour">`
			content += `
				<div class="row justify-content-center align-items-center h-100">
					<div class="center card-title">${getDayName(data.DayOfWeek, true)}</div>
					<div class="center card-desc no-wrap">${new Date(data.Date).toLocaleDateString()}</div>
				</div>
			`;
			content += `</td>`

			for (let i = 0; i < hours.length; i++){
				var hour = hours[i];
				if(data.DayType != "WorkDay"){
					var backColor = "#1ac5db";
					switch(data.DayType){
						case "Weekend":
							backColor = "#b8b8b8";
							break;
						case "Celebration":
							backColor = "#1a5adb";
							break;
						case "Holiday":
							backColor = "#1ac5db";
							break;
						case "DirectorDay":
							backColor = "#48fe06";
							break;
						case "Undefined":
							backColor = "#ff0000";
							break;
						default:
							break;
					}
					content += `<td class="timetable-hour" colspan="${hours.length}" style="background: ${backColor}22;">`
					content += `
						<div class="row justify-content-center align-items-center h-100">
							<div class="center card-title">${data.DayDescription.capitalize()}</div>
						</div>
					`;
					content += `</td>`
					break;
				}

				var hourId = hour.Id;
				var atom = atoms[hourId];
				if(atom){
					var subjectShort = null;
					var subjectTitle = "";
					var subjectDesc = "";
					var subjectTheme = "";
					var subjectGroups = [];
					var homeworks = "";
					var backColor = "#b8b8b8";
					/* GET SUBJECT */
					if(atom.SubjectId)
						subjectShort = subjects[atom.SubjectId];
					else if(atom.Change && atom.Change.ChangeSubject)
						subjectShort = subjects[atom.Change.ChangeSubject];
					if(subjectShort){
						subjectTitle = subjectShort.Name;
						subjectShort = subjectShort.Abbrev;
					}
					if(atom.Change && !subjectShort){
						if(atom.Change.TypeAbbrev){
							subjectTitle = atom.Change.TypeName;
							subjectShort = atom.Change.TypeAbbrev;
						}
					}

					/* SUBJECT DESC */
					subjectDesc = atom.Description;
					subjectTheme = atom.Theme;
					if(atom.Change && atom.Change.Description){
						subjectDesc = atom.Change.Description;
					}

					/* SUBJECT GROUPS */
					for(var j = 0; j < atom.GroupIds.length; j++){
						var groupId = atom.GroupIds[j];
						subjectGroups.push(groups[groupId].Abbrev);
					}

					/* GET COLOR OF THE CARD */
					if(atom.Change && atom.Change.ChangeType){
						switch(atom.Change.ChangeType.toLowerCase()){
							case "canceled":
								if(subjectShort)
									backColor = "#00fffb";
								else
									backColor = "#ff0000";
								break;
							case "substitution":
								backColor = "#eeff00";
								break;
							case "added":
								backColor = "#48fe06";
								break;
							case "removed":
								backColor = "#ff0000";
								break;
							case "roomchanged":
								backColor = "#d3871d";
								break;
							default:
								break;
						}
					}

					if(atom.Homeworks && atom.Homeworks.length > 0){
						homeworks += 'DÚ:<br/><ul>';
						for(let i = 0; i < atom.Homeworks.length; i++){
							var homework = atom.Homeworks[i];
							homeworks += `<li>${homework.Text.replaceAll("\n", "<br/>")}</li>`;
						}
						homeworks += '</ul>';
					}
					var isNow = false;
					try{
						var startTime = new Date(data.Date);
						startTime.setHours(parseInt(hour.BeginTime.split(":")[0]));
						startTime.setMinutes(parseInt(hour.BeginTime.split(":")[1]));

						var endTime = new Date(data.Date);
						endTime.setHours(parseInt(hour.EndTime.split(":")[0]));
						endTime.setMinutes(parseInt(hour.EndTime.split(":")[1]));
						isNow = (new Date(data.Date).setHours(0, 0, 0, 0) == new Date().setHours(0, 0, 0, 0));
						isNow &= (startTime < new Date().getTime());
						isNow &= (endTime > new Date().getTime());
					}
					catch(error){}

					content += `<td class="timetable-hour hoverable-card-trigger${isNow ? ' bordered-karta-orange' : ''}" style="${isNow ? 'border-bottom-width: 2px; ' : ''}background: ${backColor}22;">`
					content += `
						<div class="row justify-content-center align-items-center h-100">
							<div class="col-6 card-desc text-sm no-wrap">${subjectGroups.join("<br/>")}</div>
							<div class="col-6 card-desc text-sm no-wrap" style="text-align: right !important;">${(atom.RoomId ? rooms[atom.RoomId].Abbrev : "")}${(homeworks ? ' <i class="fa-solid fa-book"></i>' : "")}</div>
							<div class="col-12 center card-title">${subjectShort ? subjectShort : ""}</div>
							<div class="col-12 center card-desc text-sm">${teachers[atom.TeacherId] ? teachers[atom.TeacherId].Abbrev : ""}</div>
						</div>
							
						<div class="hoverable-card back-karta">
							<span>${subjectTitle}</span><br/>
							<span class="card-desc text-sm no-wrap">
								${subjectDesc ? ("" + subjectDesc + "<br/>") : ""}
								${subjectTheme ? ("Téma: " + subjectTheme + "<br/>") : ""}
								${teachers[atom.TeacherId] && teachers[atom.TeacherId].Abbrev ? ("Učitel: " + teachers[atom.TeacherId].Name + "<br/>") : ""}
								${homeworks}
							</span>
						</div>
					`;
					content += `</td>`
				}
				else {
					content += `<td class="timetable-hour">`
					content += `</td>`
				}
			}
			content += `</tr>`
		}
		content += `</tbody>`;

		table.html(content);
	}
	updateTimeTable();
</script>