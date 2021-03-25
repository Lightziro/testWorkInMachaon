<?
return [
	"site_name" => "My site",
	"site_url" => "http://mysite.ru",
	"db" => [
		"user" => "admin",
		"password" => "ifghigh8y8rt347ghi",
		"name" => "my_database"
	],
	"app" => [
		"services" => [
			"resizer" => [
				"prefer_format" => "webp",
				"fallback_format" => "jpeg"
			],
		]
	],
	"info" => [
		"version" => "v.2.0",
		"description" => "Test description in test work",
		"programType" => [
			"status" => true,
			"type" => "mobile",
		],
		"dateRelease" => "25.03.2021",
	],
	"staffList" => [
		"programmer" => [
			"front-end" => [
				"chief" => "Alexey Gordon",
				"junior-developer" => "Nikita Ivanov"
			],
			"back-end" => [
				"chief" => "Sergey Borisov",
				"senior-developer" => [
					"job" => [
						[
							"first_name" => "Marat",
							"last_name" => "Rtutnikov",
						],
						[
							"first_name" => "Semen",
							"last_name" => "Rebusenov",
						]
					],
					"vacation" => [
						[
							"first_name" => "Anton",
							"last_name" => "Kuplinov",
						]
					]
				]
			]
		]
	]
];
?>
