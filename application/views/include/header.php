<?php
if ($this->main_model->is_admin_logged_in()) {
    $this->load->view('admin/include/header.php');
} else {?>
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

    <?php

    if ($this->main_model->is_logged_in()) {

        // Access User Data Securly

        $userData = (array) $this->main_model->is_logged_in(1)[0];

        $userId = $userData['id'];

        $userFirstname = $userData['firstname'];

        $userLastname = $userData['lastname'];

        $userUsername = $userData['username'];

        $userEmail = $userData['email'];

        $userCountry = $userData['country'];

        $userMobile = $userData['mobile'];

        $userAddress = $userData['address'];

        $userPostal = $userData['postal'];

        $userIp = $userData['ip'];

        $userRate = $userData['rate'];

        $userA_balance = $userData['a_balance'];

        $userAds_balance = $userData['ads_balance'];

        $userBalance = $userData['balance'];

        $userC_balance = $userData['c_balance'];

        $userDate = $userData['date'];

        $userState = $userData['state'];

        $userAll_balance = $userData['all_balance'];

        $userImage = $userData['image'];

        $userL_logout = $userData['l_logout'];
        $userProvider = $userData['oauth_provider'];

    }

    ?>

</head>

<body>

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

                <?php if (!$this->main_model->is_logged_in()) {?>

                <a href="<?php echo base_url() . 'register/'; ?>" class="btn btn-success">

                    <span class="fa fa-user-plus"></span>

                    تسجيل</a>

                <a href="<?php echo base_url() . 'login/'; ?>" class="btn btn-danger">

                    <span class="fa fa-sign-in-alt"></span>

                    دخول</a>

                <?php }?>

                <div class="nav-item dropdown tags use">

                    <?php if ($this->main_model->is_logged_in()) {?>

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">

                        <img class="user" src="<?php
if ($userProvider == 'facebook') {
        echo $userImage;
    } else {
        if ($userImage == '') {

            echo base_url() . 'vendor/images/user.png';

        } else {

            echo base_url() . 'vendor/uploads/images/' . $userImage;

        }
    }
        ?>">

                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" href="<?php echo base_url() . 'user/' . $userUsername; ?>">

                            <span class="fa fa-user"></span>

                            <?php echo $userUsername; ?></a>

                        <a class="dropdown-item" href="<?php echo base_url() . 'logout/'; ?>">

                            <span class="fa fa-sign-out-alt"></span>

                            تسجيل الخروج</a>

                    </div>

                </div>

                <div class="r-blink nav-item dropdown tags notf" style="float: left;">
                    <?php $nums = $this->main_model->getFullRequest('alerts', 'statue = 0 AND u_id = ' . $this->session->userdata('id'), 'count');?>
                    <a class="nav-link dropdown-toggle"
                        onClick="<?php echo 'return seen(' . $this->session->userdata('id') . ')'; ?>" href="#"
                        id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-bell"></span>
                        <div class="al-num">
                            <?php
if ($nums) {
            ?>
                            <div class="alerts-nums"><?php echo $nums; ?></div>
                            <?php
}?>
                        </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php
$alerts = $this->main_model->getFullRequest('alerts', '(u_id = ' . $this->session->userdata('id') . ') ORDER BY id DESC');
        if ($alerts) {
            ?>
                        <div class="allalerts">
                            <?php foreach ($alerts as $alert) {?>
                            <div class="d_item">
                                <p><b><?php echo $alert->title; ?></b></p>
                                <?php echo $alert->description; ?>
                            </div>
                            <?php }?>
                        </div>
                        <?php } else {echo 'لايوجد اشعارات لعرضها.';}?>
                    </div>
                </div>
                <div class="nav-item dropdown tags notf" id="cartCheck" style="float: left;">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">

                        <span class="fa fa-shopping-cart"></span>

                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <div class="mini-cartItems">
                            <?php
$cart = $this->main_model->getByData('cart', 'u_id', $this->session->userdata('id'))[0];
        if ($cart) {
            $cartItems = array_count_values(explode(',', $cart->i_ids));
            if ($cart->i_ids !== '' and $cart->i_ids !== null) {foreach ($cartItems as $cartItem => $itemNum) {
                if ($cartItem !== '') {
                    $item = $this->main_model->getByData('items', 'id', $cartItem)[0];
                    ?>
                            <!--Items Here-->
                            <div class="d_item">
                                <p><span class="cart-num">X <?php echo $itemNum; ?></span> <b><a
                                            href="<?php echo base_url() . 'i/' . str_replace(' ', '-', $item->title) . '/' . $item->id . '/'; ?>"
                                            style="margin-top:5px;float:right;"><?php echo $item->title; ?></a></b></p>
                            </div>
                            <?php }}} else {
                ?>
                            <h6 class="cart-empty">السلة فارغة</h6>
                            <?php
}?>
                            <?php } else {
            ?>
                            <h6 class="cart-empty">السلة فارغة</h6>
                            <?php
}?>
                        </div>
                        <a class="goCart" href="<?php echo base_url('users/cart'); ?>">اذهب للسلة</a>
                    </div>
                    <div class="cart-alert"></div>
                </div>
                <?php }?>

            </div>

        </nav>

    </header>
    <?php
}
?>