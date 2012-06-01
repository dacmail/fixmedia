<!DOCTYPE html>
<html lang="es">
<head>
    <link href='http://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?=$page_title?> - Fixmedia</title>
    <!-- Meta Tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="30 days" />
    <meta name="rating" content="Safe for kids" />
    <meta name="copyright" content="" />
    <meta name="author" content="" />
    <meta name="contact_addr" content="" />
    <meta name="distribution" content="Global" />
    <meta name="resource-type" content="document" />
    <meta http-equiv="content-language" content="es" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/default.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles.css" />
</head>
<body>
    <header id="header">
        <p class="main_title"><a href="<?php echo base_url(); ?>">Fixmedia.org, mejora las noticias</a></p>
        <ul class="menu">
            <li><a href="<?php echo base_url("index.php/users/register"); ?>">Registro</a></li>
            <li><a href="<?php echo base_url("index.php/users/login"); ?>">Entrar</a></li>
            <li><a href="<?php echo base_url("index.php/users/logout"); ?>">Salir</a></li>
            <li><? echo anchor($this->router->reverseRoute('reports-create'), 'Añade un nuevo reporte'); ?></li>
        </ul>
    </header>
