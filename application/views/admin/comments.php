<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href='http://fonts.googleapis.com/css?family=Asap:400,700' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=1024" />
	<title>Administración - Fixmedia</title>
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
    <section id="container">
        <p class="message"><?= $this->session->flashdata('admin_message'); ?></p>
        <table>
            <? foreach ($comments as $comment) :?>
            <tr>
                <td><a class="confirm-delete" href="<?= site_url('admin/delete_comment/'.$comment->id); ?>">Eliminar comentario</a></td>
                <td><?= $comment->created_at->format('d/m/Y H:m:s'); ?></td>
                <td><a href="<?= site_url($this->router->reverseRoute('user-profile', array('username' => $comment->user->username))); ?>"><?= $comment->user->name; ?></a></td>
                <td><a href="<?= site_url($this->router->reverseRoute('reports-view', array('slug' => $comment->report->report->slug))); ?>"><?=$comment->report->report->title;?></a></td>
                <td><?= $comment->content; ?></td>
            </tr>
            <? endforeach; ?>
        </table>
    </section>
</body>