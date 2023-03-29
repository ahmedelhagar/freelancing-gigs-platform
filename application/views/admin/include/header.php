<!doctype html>

<html lang="ar" dir="rtl">

<head>

    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php $ettings = (array) $this->main_model->getByData('settings', 'id', 1)[0];?>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo base_url(); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- font aweasome -->

    <link href="<?php echo base_url(); ?>vendor/fontaweasome/css/all.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'vendor/css/home.css'; ?>">

    <link rel="shortcut icon" href="<?php echo $ettings['icon']; ?>" type="image/x-icon">
    <?php echo $ettings['head']; ?>


    <title><?php echo $title; ?></title>

</head>

<body class="admin-panel">
    <div id="load"></div>

    <header>

        <nav class="top_nav">

            <a class="a_logo" href="<?php echo base_url(); ?>"><img src="<?php echo $ettings['logo']; ?>"
                    alt="مكسب"></a>

            <div class="nav-item dropdown tags">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">

                    الأقسام <span class="fa fa-table"></span>

                </a>

                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                    <?php
$cats = $this->main_model->getFullRequest('categories', '(c_id IS NULL)');
if ($cats) {foreach ($cats as $cat) {?>
                    <a class="dropdown-item d_it" href="<?php echo base_url('pages/search/?cat=' . $cat->id); ?>"><span
                            class="<?php echo $cat->icon; ?>"></span> <?php echo $cat->category; ?></a>
                    <?php }}?>

                </div>

            </div>

            <div id="s_mob" class="fa fa-search"></div>

            <div class="br_line"></div>

            <form action="<?php echo base_url('pages/search/'); ?>" method="get" class="search">

                <input autocomplete="off" type="text" placeholder="ابحث عن ما تريد هنا" name="search"
                    class="form-control">

                <button type="submit">

                    <span class="fa fa-search"></span>

                </button>

            </form>

            <div class="u_notf">

                <?php if (!$this->main_model->is_admin_logged_in()) {?>

                <a href="<?php echo base_url() . 'register/'; ?>" class="btn btn-success">

                    <span class="fa fa-user-plus"></span>

                    تسجيل</a>

                <a href="<?php echo base_url() . 'login/'; ?>" class="btn btn-danger">

                    <span class="fa fa-sign-in-alt"></span>

                    دخول</a>

                <?php }?>

                <div class="nav-item dropdown tags use">

                    <?php if ($this->main_model->is_admin_logged_in()) {?>
                    <?php if ($this->uri->segment(1) == 'i') {?>

                    <a href="<?php echo base_url() . 'istsharhcadmin/close/' . (int) strip_tags($this->uri->segment(3)); ?>"
                        class="btn btn-warning">

                        <span class="fa fa-trash"></span>

                        اغلاق/رفض</a>

                    <?php }?>
                    <a href="<?php echo base_url() . 'istsharhcadmin/'; ?>" class="btn btn-success">

                        <span class="fa fa-home"></span>

                        لوحة التحكم</a>

                    <a class="dropdown-item" href="<?php echo base_url() . 'logout/'; ?>">

                        <span class="fa fa-sign-out-alt"></span>

                        تسجيل الخروج</a>

                </div>

                <?php }?>

            </div>

        </nav>

    </header>