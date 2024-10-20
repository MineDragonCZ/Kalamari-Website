<?php
$config->navlinks = [
	[
		"name" => "Přehled",
		"icon" => "fa-solid fa-house fa-fw",
		"link" => "/dashboard/",
		"target" => ""
	],
	[
		"permission" => "Marks",
		"name" => "Klasifikace",
		"icon" => "fa-solid fa-arrow-up-1-9 fa-fw",
		"subs" => [
			[
				"permission" => "Marks::ShowMarks",
				"name" => "Průběžná klasifikace",
				"link" => "/marks/",
				"target" => ""
			],
			[
				"permission" => "Marks::ShowFinalMarks",
				"name" => "Pololetní klasifikace",
				"link" => "/marks/final/",
				"target" => ""
			],
			[
				"permission" => "Marks::PredictMarks",
				"name" => "Předvídač známek",
				"link" => "/marks/predict/",
				"target" => ""
			],
			[
				"name" => "Výchovná opatření",
				"link" => "/marks/measures/",
				"target" => ""
			]
		]
	],
	[
		"name" => "Výuka",
		"icon" => "fa-solid fa-book fa-fw",
		"subs" => [
			[
				"permission" => "Timetable::ShowTimetable",
				"name" => "Týdenní rozvrh",
				"link" => "/timetable/",
				"target" => ""
			],
			[
				"permission" => "Timetable::ShowTimetable",
				"name" => "Stálý rozvrh",
				"link" => "/timetable/static/",
				"target" => ""
			],
			[
				"permission" => "Substitutions::ShowSubstitutions",
				"name" => "Suplování",
				"link" => "/substitutions/",
				"target" => ""
			],
			[
				"permission" => "Substitutions::ShowSubstitutions",
				"name" => "Domácí úkoly",
				"link" => "/substitutions/",
				"target" => ""
			],
			[
				"permission" => "Subjects::ShowSubjects",
				"name" => "Přehled předmětů",
				"link" => "/subjects/",
				"target" => ""
			],
			[
				"permission" => "Subjects::ShowSubjectThemes",
				"name" => "Přehled výuky",
				"link" => "/themes/",
				"target" => ""
			],
			[
				"name" => "Výukové zdroje",
				"link" => "/resources/",
				"target" => ""
			]
		]
	],
	[
		"permission" => "Absence",
		"name" => "Absence",
		"icon" => "fa-solid fa-sheet-plastic fa-fw",
		"subs" => [
			[
				"name" => "Zaměškanost",
				"link" => "/absence/subjects/",
				"target" => ""
			],
			[
				"name" => "Přehled absence",
				"link" => "/absence/",
				"target" => ""
			]
		]
	],
	[
		"permission" => "Komens",
		"name" => "Komens",
		"icon" => "fa-solid fa-message fa-fw",
		"subs" => [
			[
				"permission" => "Komens::ShowReceivedMessages",
				"name" => "Přijaté zprávy",
				"link" => "/komens/received/",
				"target" => ""
			],
			[
				"permission" => "Komens::ShowSentMessages",
				"name" => "Odeslané zprávy",
				"link" => "/komens/sent/",
				"target" => ""
			],
			[
				"permission" => "Komens::SendMessages",
				"name" => "Nová zpráva",
				"link" => "/komens/new/",
				"target" => ""
			]
		]
	],
	[
		"permission" => "Events",
		"name" => "Události",
		"icon" => "fa-solid fa-calendar-days fa-fw",
		"subs" => [
			[
				"permission" => "Events::ShowEvents",
				"name" => "Nadcházející události",
				"link" => "/events/",
				"target" => ""
			]
		]
	]
];
?>