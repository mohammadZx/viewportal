<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => 'Farid',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'Farid',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('../temp/'),
	'font_path' => public_path('font/'),
	'font_data' => [
	   'fa' => [
		  'R'  => '/IRANSansWeb.ttf',
		  'useOTL' => 0xFF,
		  'useKashida' => 75,
	   ],
	   'en' => [
		'R'  => '/IRANSansWeb.ttf',
	   ]
	]
 ];