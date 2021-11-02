<?php 

$config['site'] = array(
	'system_name' => 'Dashboard',
	'system_description' => 'Requesting of Payment',
	'system_slug' => 'WMS',
	'company' => 'MetroPac Movers, Inc.',
	'powered_by' => 'IT Dept.',
	'mail' => array(
		'protocol' => 'smtp',
		'host' => 'ssl://smtp.gmail.com',
		'user' => 'robinand000@gmail.com',
		'pwd' => 'figure09',
		'port' => 465,
		'test_recipients' => array(
								'robinand.adriano@gmail.com'
							 )
	),
	'userByPass' => hash('sha512','asdf1234'),
	'defaultPass' => hash('sha512','password')
);