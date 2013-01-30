<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href='http://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=1024" />
	<title><?=$page_title?> - Fixmedia</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>/images/favicon.png">
    <meta name="description" content="<?= isset($description) ? $description : ''; ?>" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index, follow" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.23.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-scrolltofixed-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.colorbox-min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/default.js?v=1.4"></script>
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles.css?v=1.4">
</head>
<body>
    <header id="header">
        <div class="wrap clearfix">
            <p class="main_title"><a href="<?php echo base_url(); ?>" title="Fixmedia.org, arregla las noticias"><img src="<?= base_url('images/logo-fixmedia.png'); ?>" alt="Fixmedia.org, arregla las noticias" title="Fixmedia.org, arregla las noticias"/></a></p>
            <nav class="top-menu">
                <ul class="menu clearfix">
                    <li>arrastra el botón <a href="javascript:(function()%7B%20%20_my_script%3Ddocument.createElement(%27SCRIPT%27)%3B%20%20_my_script.type%3D%27text/javascript%27%3B%20%20_my_script.src%3D%27http://fixmedia.org/js/bookmarklet.js%27%3B%20%20document.getElementsByTagName(%27head%27)%5B0%5D.appendChild(_my_script)%3B%7D)()%3B" class="bookmarklet">Hacer FIX</a> a tu navegador [<a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'marcador'))); ?>">+ info</a>]</li>
                    <li><a href="<?= site_url($this->router->reverseRoute('statics', array('page' => 'que-es-fixmedia'))); ?>">¿Qué es fixmedia?</a></li>
                </ul>
            </nav>
            <? if (!$logged_in) : ?>
                <a class="log_in" href="<?= site_url($this->router->reverseRoute('login')); ?>">Iniciar sesión</a>
            <? else :?>
                <section class="user">
                    <a class="welcome" href="#"><span class="user_name"><?= $the_user->name; ?></span> <?=gravatar( $the_user->email, 40, true, base_url('static/avatar-user-40.jpg'), 'x', array('title' => 'Reputación ' . $the_user->karma) )?>
                    <? if (count($the_user->unread_activity)) : ?> <span title="Notificaciones pendientes" class="unread-activity"><?= count($the_user->unread_activity); ?></span><? endif; ?></a>
                    <div class="user_info">
                        <span class="indicator"></span>
                        <div class="clearfix">
                            <div class="user_avatar">
                                <?=gravatar( $the_user->email, 100, true, base_url('static/avatar-user-100.jpg'), 'x', array('title' => 'Avatar de ' . $the_user->name) )?>
                                <a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $the_user->username))); ?>">Ver perfil</a>
                            </div>

                            <div class="user_data">
                                <h2 class="name"><?= $the_user->name; ?></h2>
                                <p class="counters">
                                    <span class="fix_count"><?= count($the_user->fixes); ?></span> fixes
                                    <span class="report_count"><?= count($the_user->subreports); ?></span> reportes
                                </p>
                                <?= karma_graphic($the_user->karma, false); ?>
                            </div>
                        </div>
                        <div class="links-wrap">
                            <? if (count($the_user->unread_activity)) : ?> <a href="<?= site_url($this->router->reverseRoute('user-activity')); ?>" class="unread-activity"><?= count($the_user->unread_activity); ?> notificaciones pendientes</a><? endif; ?>
                            <a class="log_out" href="<?= site_url($this->router->reverseRoute('logout')); ?>">Cerrar sesión</a>
                        </div>
                    </div>
                </section>
            <? endif; ?>
        </div>
    </header>
    <nav class="main-menu">
        <ul class="menu clearfix">
            <li><a href="<?= site_url($this->router->reverseRoute('reports-create')); ?>" class="button icon fixit">FIX</a></li>
            <li class="<?= is_cur_page($this, 'reports','index') ? 'current' : ''; ?>"><a class="link" href="<?= site_url(); ?>">Más urgentes</a></li>
            <li class="<?= is_cur_page($this, 'reports','recents') ? 'current' : ''; ?>"><a class="link" href="<?= site_url($this->router->reverseRoute('home-recents')); ?>">Recientes</a></li>
            <li class="<?= is_cur_page($this, 'reports','pendings') ? 'current' : ''; ?>"><a class="link" href="<?= site_url($this->router->reverseRoute('home-pending')); ?>">Pendientes</a></li>
            <li class="<?= is_cur_page($this, 'members','index') ? 'current' : ''; ?>"><a class="link" href="<?= site_url($this->router->reverseRoute('users')); ?>">Top usuarios</a></li>
            <li class="<?= is_cur_page($this, 'sources','pendings') ? 'current' : ''; ?>"><a class="link" href="<?= site_url($this->router->reverseRoute('sources')); ?>">Top fuentes</a></li>
            <li class="<?= is_cur_page($this, 'stats','index') ? 'current' : ''; ?>"><a class="link" href="<?= site_url($this->router->reverseRoute('stats')); ?>">Estadísticas</a></li>
            <li class="search">
                <form action="<?= site_url($this->router->reverseRoute('search')); ?>" method="GET">
                    <input type="text" value="<?= isset($term) ? $term : ''; ?>" name="q" placeholder="noticias, reportes, usuarios" />
                </form>
            </li>
        </ul>
    </nav>
