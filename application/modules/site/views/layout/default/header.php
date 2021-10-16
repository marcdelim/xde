<!doctype html>
<html lang="en">
	<head>
		<title><?= isset($header_data) ? $header_data.' | '.$this->config->item('site')['system_name'] : $this->config->item('site')['system_name']?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

		<link rel="apple-touch-icon" sizes="76x76" href="<?=$assets_path.'site/img/apple-icon.png'; ?>">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<link rel="icon" type="image/png" sizes="96x96" href="<?=$assets_path.'site/img/favicon.png'; ?>">
	</head>
	<body>
		<div id="wrapper">