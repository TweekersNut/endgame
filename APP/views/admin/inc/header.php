<?php
use APP\Helpers\URL_Helper as URL;
use APP\Models\Settings as Settings;
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title><?= $data['page_title'] ? $data['page_title'] : SITE_NAME ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="<?= isset($data['page_desc'])  ? $data['page_desc'] : 'Developed By TweekersNut Network' ?>">
	<meta name="keywords" content="<?= isset($data['page_key']) ? $data['page_key'] : 'TweekersNut,Network' ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
        <link href="<?= (new Settings)->getValue('site.favicon')->_val ?>" rel="shortcut icon"/>

        <script>
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <!-- //Meta Tags -->

        <!-- Style-sheets -->
        <!-- Bootstrap Css -->
        <link href="<?= URL_ROOT ?>admin/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
        <!-- Bootstrap Css -->
        <!-- Bars Css -->
        <link rel="stylesheet" href="<?= URL_ROOT ?>admin/css/bar.css">
        <!--// Bars Css -->
        <!-- Calender Css -->
        <link rel="stylesheet" type="text/css" href="<?= URL_ROOT ?>admin/css/pignose.calender.css" />
        <!--// Calender Css -->
        <!-- Common Css -->
        <link href="<?= URL_ROOT ?>admin/css/style.css" rel="stylesheet" type="text/css" media="all" />
        <!--// Common Css -->
        <!-- Nav Css -->
        <link rel="stylesheet" href="<?= URL_ROOT ?>admin/css/style4.css">
        <!--// Nav Css -->
        <!-- Fontawesome Css -->
        <link href="<?= URL_ROOT ?>admin/css/fontawesome-all.css" rel="stylesheet">
        <!--// Fontawesome Css -->
        <!--// Style-sheets -->

        <!--web-fonts-->
        <link href="//fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!--//web-fonts-->
        
        <!-- Map Style -->
        <link href='https://api.mapbox.com/mapbox-gl-js/v1.0.0/mapbox-gl.css' rel='stylesheet' />
    </head>

    <body>
        <div class="se-pre-con"></div>
        <div class="wrapper">
