<?php
if ($this->main_model->is_admin_logged_in()) {
    $this->load->view('admin/include/header.php');
} else {
    $this->load->view('include/header.php');
}
?>
<?php
if ($this->session->flashdata('done')) {
    echo '<div class="alert alert-success alert-dismissible fade show flash-data" role="alert">' . $this->session->flashdata('done') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';
} elseif ($this->session->flashdata('error')) {
    echo '<div class="alert alert-danger alert-dismissible fade show flash-data" role="alert">' . $this->session->flashdata('error') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';
}
$isBidder = 0;

if ($this->main_model->is_logged_in()) {

    $userData = (array) $this->main_model->is_logged_in(1)[0];

    if ($item->kind == 2) {
// Access User Bid Securly
        $isBidder = $this->main_model->getFullRequest('bids', '(i_id = ' . $item->id . ') AND (u_id = ' . $userData['id'] . ')', 'count');
    }

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

    $userAbout = $userData['about'];

    $userL_logout = $userData['l_logout'];
    $userProvider = $userData['oauth_provider'];

    $bidData = false;
    if ($item->kind == 2 && isset($item->bid_id)) {
        $bidData = $this->main_model->getFullRequest('bids', '(id = ' . $item->bid_id . ')')[0];
    }

    if (strip_tags($this->uri->segment(2)) == 'addBid' or strip_tags($this->uri->segment(2)) == 'addEditBid') {
        $byUser = $this->main_model->getByData('users', 'id', $item->u_id)[0];
    }
}

?>
<div class="container-fluid m_top">
    <div class="col-lg-12 col-md-12 col-sm-12 it_title">
        <?php if ($item->state == '10' || $item->state == '0') {?>
        <div class="alert alert-warning fade show float-right col-12" role="alert">الصفحة مغلقة/معطلة حالياً</div>
        <?php }?>
        <h3><?php echo $item->title; ?></h3>
        <?php
            if(isset($bidData)){
                $bidDataArr = $bidData;
            }else{
                $bidDataArr = false;
            }
        ?>
        <?php if ($item->kind == 2 && $this->main_model->is_logged_in() && $item->u_id == $userId && $bidDataArr == false) {?>
        <a href="<?php echo base_url('users/editProject/' . $item->id . '/'); ?>" class="btn btn-success"><span
                class="fa fa-cogs"></span> تعديل المشروع</a>
        <?php } elseif ($item->kind == 2 && $this->main_model->is_logged_in() && $item->u_id == $userId && ($item->state == 0 or $item->state == 10)) {?>
        <a href="<?php echo base_url('users/editProject/' . $item->id . '/'); ?>" class="btn btn-success"><span
                class="fa fa-cogs"></span> تعديل المشروع</a>
        <?php }?>
        <?php if ($item->kind == 1 && $this->main_model->is_logged_in() && $item->u_id == $userId) {?>
        <a href="<?php echo base_url('users/editGig/' . $item->id . '/'); ?>" class="btn btn-success"><span
                class="fa fa-cogs"></span> تعديل الخدمة</a>
        <a href="<?php echo base_url('users/delete/items/' . $item->id . '/?m=users/gigs/' . $userUsername); ?>"
            class="btn btn-danger"><span class="fa fa-trash"></span> حذف الخدمة</a>
        <?php if ($item->state == '1') {?>
        <a href="<?php echo base_url('users/closeCheck/' . $item->id . '/'); ?>" class="btn btn-warning"><span
                class="fa fa-pause"></span> ايقاف الخدمة</a>
        <?php }?>
        <?php if ($item->state == '10') {?>
        <a href="<?php echo base_url('users/closeCheck/' . $item->id . '/'); ?>" class="btn btn-warning"><span
                class="fa fa-play"></span> طلب تشغيل الخدمة</a>
        <?php }?>
        <?php }?>
        <?php if ($item->kind == 2 && $this->main_model->is_logged_in() && $item->u_id == $userId && $item->state == '2') {?>
        <a href="<?php echo base_url('users/addser/' . $item->id); ?>" style="border-radius:0px;margin-right:10px;"
            class="btn btn-danger"><span class="fa fa-balance-scale-right"></span> نزاع</a>
        <?php }?>
        <?php if ($item->kind == 1 && $this->main_model->is_logged_in() && $item->state == 1 && $item->u_id !== $userId) {?>
        <a onClick="<?php echo 'return addToCart(' . $item->id . ')'; ?>"
            style="color:#fff;cursor:pointer;margin-right: 10px;" class="btn btn-success"><span
                class="fa fa-shopping-cart"></span> أضف لسلة المشتريات</a>
        <?php if ($rGigs == false) {?>
        <a id="buyGigBtn" href="<?php echo base_url('users/buyGigBill/' . $item->id . '/'); ?>"
            class="btn btn-success"><span class="fa fa-shopping-cart"></span> اشتري الخدمة</a>
        <?php } else {?>

        <div class="btn-group pro-op">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="fa fa-cogs"></span>
                خيارات
            </button>
            <div class="dropdown-menu">
                <?php if ($item->u_id !== $userId) {foreach ($rGigs as $rGig) {
                    $messages = $this->main_model->getFullRequest('messages','(f_id = '.$rGig->u_id.') AND (to_id = '.$item->u_id.')');
                    if($messages){
                ?>
                <a href="<?php echo base_url('users/acceptProConfirm/' . $item->id . '/' . $rGig->u_id . '/' . $rGig->amount); ?>"
                    class="dropdown-item">
                    <span class="fa fa-trophy"></span>
                    استلام طلبية الـ
                    <p><?php echo $rGig->amount; ?>$</p>
                </a>
                <?php } ?>
                <a href="<?php echo base_url('users/addser/' . $item->id); ?>" class="dropdown-item">
                    <span class="fa fa-balance-scale-right"></span>
                    نزاع
                </a>
                <?php }}?>
                <a id="buyGigBtn" href="<?php echo base_url('users/buyGigBill/' . $item->id . '/'); ?>"><span
                        class="fa fa-shopping-cart"></span> اشتري الخدمة مرة أخرى</a>
            </div>
        </div>
        <?php }?>
        <a href="<?php echo base_url('users/createChat/' . $item->id . '/' . $item->u_id); ?>"
            class="btn btn-primary"><span class="fa fa-comment"></span> راسل البائع</a>
        <?php } elseif ($isBidder == 0 && $this->main_model->is_logged_in() && $item->state == 1 && $item->u_id !== $userId) {?>
        <a href="#addBid" class="btn btn-primary"><span class="fa fa-comment"></span> قدم عرض</a>
        <?php
} elseif ($this->main_model->is_logged_in() && $item->state == 2 && $bidData->u_id == $userId) {
    ?>
        <a href="<?php echo base_url('users/addser/' . $item->id); ?>" style="border-radius:0px;margin-right:10px;"
            class="btn btn-danger"><span class="fa fa-balance-scale-right"></span> نزاع</a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger float-left" style="border-radius:0px;margin-right:10px;"
            data-toggle="modal" data-target="#exampleModal1">
            <span class="fa fa-times"></span>
            طلب الغاء
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">طلب الغاء المشروع</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php

    $atrr2 = array(

        'class' => 'bidForm',

        'method' => 'post',

    );

    echo form_open_multipart(base_url('users/addEditBid/' . $this->uri->segment(3)), $atrr2);

    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>');

    if (isset($error) && $error !== '') {

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error .

            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';

    } elseif (isset($state) && $state !== '') {

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">

    تم طلب تعديل العرض بنجاح.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';

    }

    ?>
                        <input type="hidden" name="bidAmount" placeholder="0" value="0" class="bidAmount">
                        <input type="hidden" name="bidDur" placeholder="0" value="0" class="bidDur">
                        <input type="hidden" name="bid_id" value="<?php echo $bidData->id; ?>">
                        <textarea name="bidContent" class="bidContent" placeholder="سبب طلب الالغاء"></textarea>
                        <?php

    $submit = array(

        'type' => 'submit',

        'autocomplete' => 'off',

        'class' => 'regbtn a_Projectbtn',

        'name' => 'submit',

    );

    echo form_button($submit, '<span class="fa fa-envelope"></span> طلب');

    ?>



                        <p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>





                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-left" style="border-radius:0px;margin-right:10px;"
            data-toggle="modal" data-target="#exampleModal">
            تعديل العرض
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">طلب تعديل العرض</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php

    $atrr2 = array(

        'class' => 'bidForm',

        'method' => 'post',

    );

    echo form_open_multipart(base_url('users/addEditBid/' . $this->uri->segment(3)), $atrr2);

    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>');

    if (isset($error) && $error !== '') {

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error .

            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';

    } elseif (isset($state) && $state !== '') {

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">

    تم طلب تعديل العرض بنجاح.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';

    }

    ?>
                        <input type="number" name="bidAmount" placeholder="0" value="<?php echo $bidData->amount; ?>"
                            class="bidAmount1">
                        <label for="bidAmount">دولار</label>
                        <input type="number" name="bidDur" placeholder="0" value="<?php echo $bidData->days; ?>"
                            class="bidDur">
                        <input type="hidden" name="bid_id" value="<?php echo $bidData->id; ?>">
                        <label for="bidDur">يوم</label>
                        <p>أرباحك بعد خصم عمولة الموقع <span
                                class="earns-after earns-after1"><?php echo round(($bidData->amount - ($bidData->amount * 0.15)), 2); ?></span>
                            دولار</p>
                        <textarea palceholder="تفاصيل العرض" name="bidContent"
                            class="bidContent"><?php echo $bidData->bid; ?></textarea>
                        <?php

    $submit = array(

        'type' => 'submit',

        'autocomplete' => 'off',

        'class' => 'regbtn a_Projectbtn',

        'name' => 'submit',

    );

    echo form_button($submit, '<span class="fa fa-envelope"></span> طلب');

    ?>



                        <p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>





                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-group pro-op">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span class="fa fa-cogs"></span>
                خيارات
            </button>
            <div class="dropdown-menu">
                <a href="<?php echo base_url('users/donePro/' . $bidData->id . '/' . $bidData->i_id); ?>"
                    class="dropdown-item">
                    <span class="fa fa-trophy"></span>
                    تسليم المشروع</a>
            </div>
        </div>
        <?php }?>
    </div>
    <?php if ($item->kind == 2) {?>
    <div class="proccess-prec">
        <div
            class="proccess-sec<?php if ($item->state == 2 or $item->state == 3) {?> done-pro<?php } elseif ($item->state == 1) {?> in-pro<?php }?>">
            <span class="fa fa-briefcase"></span>
            <p>العروض</p>
        </div>
        <div
            class="proccess-sec<?php if ($item->state == 2) {?> in-pro<?php } elseif ($item->state == 3) {?> done-pro<?php }?>">
            <span class="fa fa-envelope"></span>
            <p>بدأ العمل</p>
        </div>
        <div class="proccess-sec<?php if ($item->state == 3) {?> done-pro<?php }?>">
            <span class="fa fa-check"></span>
            <p>تم التنفيذ</p>
        </div>
    </div>
    <?php }?>
    <div class="col-lg-8 col-md-8 col-sm-12 it_details">

        <div class="col-lg-12 col-md-12 col-sm-12 m_item">

            <?php if ($item->kind == 1) {?>
            <!--Slider-->
            <div id="carouselExampleIndicators" class="carousel slide" data-interval="false" data-ride="carousel">

                <div class="carousel-inner">
                    <?php
$images = explode(',', $item->images);
    $i = 0;
    foreach ($images as $image) {
        $headers = get_headers(base_url().'vendor/uploads/images/'.$image, 1);
        if (strpos($headers['Content-Type'], 'image/') !== false) {
            $imageLink = base_url().'vendor/uploads/images/'.$image;
        } else {
            $imageLink = base_url().'vendor/uploads/images/vthumb_'.$image;
        }  
        ?>
                    <div class="carousel-item <?php if ($i == 0) {echo 'active';}?>">

                        <img class="d-block w-100" src="<?php echo $imageLink; ?>"
                            alt="slide">

                    </div>
                    <?php
$i++;}
    if ($item->ytlink !== 'NONE' && $item->ytlink !== '') {?>
                    <div class="carousel-item">

                        <iframe class="d-block w-100"
                            src="<?php echo str_replace('watch?v=', 'embed/', $item->ytlink); ?>" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>

                    </div>

                </div>
                <?php }?>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="next">

                    <span class="fa fa-arrow-left" aria-hidden="true"></span>

                    <span class="sr-only">Previous</span>

                </a>

                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="prev">

                    <span class="fa fa-arrow-right" aria-hidden="true"></span>

                    <span class="sr-only">Next</span>

                </a>

                <div class="col-lg-12 col-md-12 col-sm-12 desc">

                    <ol class="carousel-indicators">

                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>

                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>

                        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>

                        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>

                    </ol>

                </div>

            </div>
        </div>
        <!--End Slider-->
        <?php }?>

        <div class="col-lg-12 col-md-12 col-sm-12 desc descrip">
            <pre>
                <?php echo $item->content; ?>
            </pre>
        </div>

        <?php //if($item->kind == 2 OR $rates){ ?>
    </div>
    <?php //} ?>
    <?php if ($item->kind == 1 && $this->main_model->is_logged_in() && $item->state == 1 && $item->u_id !== $userId) {?>
    <?php if ($gUs) {?>
    <div class="col-lg-12 col-md-12 col-sm-12 s_block">
        <h4>تطويرات الخدمة</h4>
        <?php foreach ($gUs as $gu) {
    $gUcontent = explode(', ', $gu->content);
    $gUamount = explode(', ', $gu->amount);
    $gUdays = explode(', ', $gu->days);
    $i = 0;
    while ($i <= count($gUcontent) - 1) {?>
        <div class="gU">
            <h5><?php echo $gUcontent[$i]; ?> في مدة <?php echo $gUdays[$i] . ' يوم'; ?> - بسعر
                <?php echo $gUamount[$i] . '$'; ?><input min="0" type="number"
                    class="form-control col-3 float-left text-center" placeholder="عدد مرات الشراء"
                    id="gu_num_<?php echo $i; ?>"></h5>
        </div>

        <?php $i++;}}?>
    </div>
    <?php }?>
    <div class="col-lg-12 col-md-12 col-sm-12 s_block">
        <h4>هل أعجبك المنتج؟</h4>
        <a href="<?php echo base_url('users/buyGigBill/' . $item->id . '/'); ?>" class="btn btn-success"><span
                class="fa fa-shopping-cart"></span> اشتري الخدمة</a>

        <a href="<?php echo base_url('users/createChat/' . $item->id . '/' . $item->u_id); ?>"
            class="btn btn-primary"><span class="fa fa-comment"></span> راسل البائع</a>
    </div>
    <?php } elseif (!$this->main_model->is_logged_in() && $item->kind == 1) {
    ?>
    <div class="col-lg-12 col-md-12 col-sm-12 s_block">
        <h4>هل أعجبك المنتج؟</h4>
        <a href="<?php echo base_url('pages/login/?url=' . base64_encode(current_url())); ?>"
            class="btn btn-success"><span class="fa fa-shopping-cart"></span> اشتري الخدمة</a>

        <a href="<?php echo base_url('pages/login/?url=' . base64_encode(current_url())); ?>"
            class="btn btn-primary"><span class="fa fa-comment"></span> راسل البائع</a>
    </div>
    <?php
}?>
    <?php if ($this->main_model->is_logged_in() && $item->kind == 2 && $item->bid_id !== null) {
    $choosedBid = $this->main_model->getFullRequest('bids', '(id = ' . $item->bid_id . ')')[0];
    $editBids = $this->main_model->getFullRequest('editedbid', '(i_id = ' . $item->id . ') AND (bid_id = ' . $choosedBid->id . ') ORDER BY id DESC');
    if ($editBids && ($item->u_id == $userId or $userId == $choosedBid->u_id)) {$i = 0;foreach ($editBids as $editBid) {
        ?>
    <div class="col-12 float-right alert alert-<?php
if ($editBid->amount < 1) {
            echo 'danger';
        } else {
            echo 'primary';
        }
        ?>" style="margin-top:20px;" role="alert">
        <h5 class="alert-heading"><b>
            <?php
if ($editBid->amount < 1) {
            ?>
            طلب إلغاء المشروع
            <?php
} else {
            ?>
            طلب تعديل عرض
            <?php
}
        ?>
        </b></h5>
        <p>رسالة المشتري : <?php echo $editBid->bid; ?></p>
        <?php
if ($editBid->amount < 1) {
            ?>
        <hr>
        <p><b>في انتظار رأي الادارة ...</b></p>
        <?php
} else {
            ?>
        <hr>
        <p class="mb-0">بمبلغ <?php echo $editBid->amount; ?>$ في خلال <?php echo $editBid->days; ?> يوم</p><br>
        <?php if ($item->u_id == $userId && $i < 1) {?>
        <a class="btn btn-success" style="border-radius:0px;"
            href="<?php echo base_url('users/acceptEbid/' . $editBid->id); ?>"><span class="fa fa-save"></span> قبول
            العرض</a>
        <?php
$itemLinkF = 'i/' . str_replace(' ', '-', $item->title) . '/' . $item->id . '/';
                ?>
        <a class="btn btn-danger" style="border-radius:0px;"
            href="<?php echo base_url('users/delete/editedbid/' . $editBid->id . '?m=' . $itemLinkF); ?>"><span
                class="fa fa-trash"></span> رفض الطلب</a>
        <?php }?>
        <?php
}
        ?>
    </div>
    <?php $i++;}}}?>
    <?php if($item->state == 1){if ($isBidder == 0) {if ($this->main_model->is_logged_in() && $item->u_id !== $userId && $userState == 1 && $item->kind == 2) {?>
    <div class="col-lg-12 col-md-12 col-sm-12 s_block" id="addBid">
        <h4>قدم عرضك</h4>
        <div class="col-lg-12 col-md-12 col-sm-12 rate">
            <?php

    $atrr2 = array(

        'class' => 'bidForm',

        'method' => 'post',

    );

    echo form_open_multipart(base_url('users/addBid/' . $this->uri->segment(3)), $atrr2);

    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>');

    if (isset($error) && $error !== '') {

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error .

            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';

    } elseif (isset($state) && $state !== '') {

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">

    تم اضافة العرض بنجاح.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';

    }
    $bidMinValue = 0;
    $bidVal = explode(',', $item->price);
    if ($bidVal[0] < $bidVal[1]) {
        $bidMinValue = $bidVal[0];
    } else {
        $bidMinValue = $bidVal[1];
    }
    ?>
            <input type="number" name="bidAmount" min="<?php echo $bidMinValue; ?>" oninvalid="this.setCustomValidity('برجاء اضافة رقم أكبر من أو يساوي <?php echo $bidMinValue; ?>')" placeholder="0" class="bidAmount">
            <label for="bidAmount">دولار</label> -
            <input type="number" name="bidDur" placeholder="0" class="bidDur">
            <label for="bidDur">يوم</label>
            <p>أرباحك بعد خصم عمولة الموقع <span class="earns-after">0</span> دولار</p>
            <textarea palceholder="تفاصيل العرض" name="bidContent" class="bidContent"></textarea>
            <?php

    $submit = array(

        'type' => 'submit',

        'autocomplete' => 'off',

        'class' => 'regbtn a_Projectbtn',

        'name' => 'submit',

    );

    echo form_button($submit, '<span class="fa fa-plus"></span> اضافة');

    ?>



            <p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>





            <?php echo form_close(); ?>
        </div>

    </div>
    <?php }}} ?>

    <?php if ($item->kind == 1) {?>
    <?php if (isset($userId) && $item->u_id == $userId) {?>
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

            <h4>فواتير الخدمة</h4>

            <?php $bills = $this->main_model->getByData('requestedgigs', 'i_id', $item->id);
    if($bills){foreach ($bills as $bill) {
        ?>
            <div class="col-lg-12 col-md-12 col-sm-12 s-pro projects" style="margin-top:0px;">
                <table class="table table-striped col-12 float-right px-2 py-2" style="background:#fff;">
                    <h6>الفاتورة <?php echo $bill->id; ?></h6>
                    <div class="col-lg-12 col-md-12 col-sm-12 float-right buye">
                        <?php
$rater = $this->main_model->getByData('users', 'id', $bill->u_id)[0];
        ?>
                        <img src="<?php
if ($rater->oauth_provider == 'facebook') {
            echo $rater->image;
        } else {
            if ($rater->image == '') {

                echo base_url() . 'vendor/images/user.png';

            } else {

                echo base_url() . 'vendor/uploads/images/' . $rater->image;

            }
        }
        ?>" class="user user-home" alt="user">

                        <h6 class="r_name">

                            <a href="<?php echo base_url() . 'user/' . $rater->username; ?>">

                                <?php echo $rater->firstname . ' ' . $rater->lastname; ?>

                            </a>


                        </h6>

                    </div><br>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">اسم الخدمة</th>
                            <th scope="col">السعر</th>
                        </tr>
                    </thead>
                    <tbody id="cartContent">
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <?php
$allGigs = array();
        $allGigsPrice = 0;
        $gigsUp = array();
        $gigsUpPrice = 0;
        ?>
                                <p><b><a href="<?php echo base_url() . 'i/' . str_replace(' ', '-', $item->title) . '/' . $item->id . '/'; ?>"
                                            style="margin-top:5px;float:right;"><?php echo $item->title; ?></a></b></p>
                                <div class="cartAdds">
                                    <?php if ($gUs) {?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 s_block">
                                        <h4>تطويرات الخدمة</h4>
                                        <?php foreach ($gUs as $gu) {
            $gUcontent = explode(', ', $gu->content);
            $gUamount = explode(', ', $gu->amount);
            $gUdays = explode(', ', $gu->days);
            $guNums = explode(', ', $bill->ui_rep);
            $i = 0;
            while ($i <= count($gUcontent) - 1) {
                if(isset($guNums[$i])){
                    $guNums[$i] = (int) $guNums[$i];
                }else{
                    $guNums[$i] = 0;
                }
                if ($guNums[$i] > 0) {
                    ?>
                                        <div class="gU">
                                            <h5><?php echo $gUcontent[$i]; ?> في مدة <?php echo $gUdays[$i] . ' يوم'; ?>
                                                -
                                                بسعر <?php echo $gUamount[$i] . '$'; ?><div class="float-left"><?php
if (isset($guNums[$i])) {
                        $gigsUp[] = $guNums[$i] . 'X' . $gUamount[$i] . '$';
                        $gigsUpPrice += $guNums[$i] * $gUamount[$i];
                        echo $guNums[$i] . 'X' . $gUamount[$i] . '$';
                    } else {echo '0';}
                    ?></div>
                                            </h5>
                                        </div>

                                        <?php }else{$not = 1;}
                $i++;}if(isset($not)){echo '<h5>لايوجد تطويرات مشتراه.</h5>';}}?>
                                    </div>
                                    <?php }?>
                                </div>
                            </td>
                            <td>
                                <?php echo $item->price . '$'; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-12 float-right billPrice">
                    <h6>الحساب</h6>
                    <p>سعر الخدمة : </p>
                    <p><?php echo $item->price . '$'; ?></p>
                    <p>اجمالي الاضافات : </p>
                    <p><?php
$alli2 = 1;foreach ($gigsUp as $gigUp) {
            if ($alli2 == count($gigsUp)) {
                echo $gigUp;
            } else {
                echo $gigUp . '+';
            }
            $alli2++;}?> = <?php echo $gigsUpPrice; ?>$</p>
                    <p>الاجمالي : </p>
                    <p><?php echo $gigsUpPrice . '$ +' . $item->price . '$'; ?> =
                        <?php echo $gigsUpPrice + $item->price; ?>$
                    </p>
                    <h6 class="text-center"><?php echo $gigsUpPrice + $item->price . '$'; ?> - <?php
if ($bill->state == 2) {
            echo 'تم الاستلام';
        } else {
            echo 'الفاتورة قيد التنفيذ';
            $promsg = $this->main_model->getFullRequest('promsg', '(s_id = ' . $rater->id . ') AND (i_id = ' . $item->id . ')');
            $messages = $this->main_model->getFullRequest('messages','(f_id = '.$bill->u_id.') AND (to_id = '.$item->u_id.')');
            if (!$promsg) {
                if($messages){
                ?>
                        <a class="btn btn-success"
                            href="<?php echo base_url('users/donePro/' . $bill->u_id . '/' . $bill->i_id . '/' . $bill->amount); ?>">طلب
                            استلام</a>
                        <?php
            }else {
                echo ' - يجب أن يوجد محادثة بينك أنت والعميل.';
            }
} else {
                echo ' - تم تقديم طلب استلام وفي انتظار الرد ...';
            }
        }
        ?>
                    </h6>
                </div>
            </div>
            <?php }}else{echo '<h4 class="text-center">لايوجد فواتير بعد</h4>';} ?>

        </div>

    </div>

    <?php }?>
    <div class="col-lg-6 col-md-6 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

            <h4>منتجات مشابهة</h4>

            <ul class="pro-as">
                <?php if ($same) {foreach ($same as $sam) {?>
                <?php

    $image = explode(',', $sam->images);

    $vthumb = 'vthumb_' . $image[0];

    ?>
                <a href="<?php echo base_url() . 'i/' . str_replace(' ', '-', $sam->title) . '/' . $sam->id . '/'; ?>"
                    class="pro-a">
                    <li><img src="<?php echo base_url() . 'vendor/uploads/images/' . $vthumb; ?>"
                            alt="خدمة" /><?php echo $sam->title; ?></li>
                </a>
                <?php }} else {echo 'لايوجد عناصر.';}?>
            </ul>

        </div>

    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

            <h4>منتجات لنفس المستشار</h4>

            <ul class="pro-as">

                <?php if ($userGigs) {foreach ($userGigs as $userGig) {?>
                <?php

    $image = explode(',', $userGig->images);

    $vthumb = 'vthumb_' . $image[0];

    ?>
                <a href="<?php echo base_url() . 'i/' . str_replace(' ', '-', $userGig->title) . '/' . $userGig->id . '/'; ?>"
                    class="pro-a">
                    <li><img src="<?php echo base_url() . 'vendor/uploads/images/' . $vthumb; ?>"
                            alt="خدمة" /><?php echo $userGig->title; ?></li>
                </a>
                <?php }} else {echo 'لايوجد عناصر.';}?>

            </ul>

        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 rate">

        <div class="rate-section">
            <?php
$rateVal = 0;
    $rateNum = 0;
    if ($rates) {
        foreach ($rates as $rate) {
            $rateVal += round((($rate->pro_rate + $rate->con_rate + $rate->qua_rate + $rate->exp_rate + $rate->date_rate + $rate->again_rate) / 6), 2);
            ?>
            <div class="col-lg-12 col-md-12 col-sm-12 float-right item-rate-sec"
                style="background:#fff;padding:10px;border:1px solid #ddd;margin-top:10px;">
                <p><?php
$item = $this->main_model->getByData('items', 'id', $rate->i_id)[0];
            ?><a href="<?php echo base_url() . 'i/' . str_replace(' ', '-', $item->title) . '/' . $item->id . '/'; ?>"><?php echo $item->title; ?></a>
                </p>
                <?php $titles = array('NONE', 'الاحترافية بالتعامل', 'التواصل والمتابعة', 'جودة العمل المسلّم', 'الخبرة بمجال المشروع', 'التسليم فى الموعد', 'التعامل معه مرّة أخرى');
            $x = 1;while ($x <= 6) {?>
                <div class="rater-section">
                    <div class="rate-secCon">
                        <div class="rate-title float-right">
                            <?php echo $titles[$x]; ?>
                        </div>
                        <div class="float-left pro-rate">
                            <?php
$ratess = array($rate->pro_rate, $rate->con_rate, $rate->qua_rate, $rate->exp_rate, $rate->date_rate, $rate->again_rate);
                $i = 1;while ($i <= $ratess[$x - 1]) {?>
                            <div class="fa fa-star orange"></div>
                            <?php $i++;}?>
                            <?php $nume = 5 - $ratess[$x - 1];
                $y = 1;while ($y <= $nume) {
                    ?>
                            <div class="fa fa-star"></div>
                            <?php
$y++;}
                ?>
                            <span><?php echo $ratess[$x - 1]; ?></span>
                        </div>
                    </div>
                </div>
                <?php $x++;}?>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right">
                    <div class="sideStars"
                        style="--rating: <?php echo round((($rate->pro_rate + $rate->con_rate + $rate->qua_rate + $rate->exp_rate + $rate->date_rate + $rate->again_rate) / 6), 2); ?>;"
                        aria-label="Rating of this product is <?php echo round((($rate->pro_rate + $rate->con_rate + $rate->qua_rate + $rate->exp_rate + $rate->date_rate + $rate->again_rate) / 6), 2); ?> out of 5.">
                    </div>
                    <span>(<?php echo round((($rate->pro_rate + $rate->con_rate + $rate->qua_rate + $rate->exp_rate + $rate->date_rate + $rate->again_rate) / 6), 2) ?>)</span>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 s_block">

                    <h4>رأي المشتري</h4>

                    <ul class="commenters">

                        <li class="comm b_border">

                            <div class="col-lg-12 col-md-12 col-sm-12 buye">
                                <?php
$rater = $this->main_model->getByData('users', 'id', $rate->u_id)[0];
            ?>
                                <img src="<?php
if ($rater->oauth_provider == 'facebook') {
                echo $rater->image;
            } else {
                if ($rater->image == '') {

                    echo base_url() . 'vendor/images/user.png';

                } else {

                    echo base_url() . 'vendor/uploads/images/' . $rater->image;

                }
            }
            ?>" class="user user-home" alt="user">

                                <h6 class="r_name">

                                    <a href="<?php echo base_url() . 'user/' . $rater->username; ?>">

                                        <?php echo $rater->firstname . ' ' . $rater->lastname; ?>

                                    </a>


                                </h6>

                                <h6><span class="fa fa-clock-o"></span> <?php echo $rate->date; ?></h6>

                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 buye-comm">

                                <h6><?php echo $rate->comment; ?></h6>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>
            <?php
$rateNum++;}
    } else {
        $rateVal = 0;
        $rateNum = 1;
    }
    ?>
            <div class="col-12 float-right text-center"
                style="background:#fff;padding:10px;border:1px solid #ddd;margin-top:10px;">
                <h3>الاجمالي</h3>
                <div class="sideStars" style="--rating: <?php echo round(($rateVal / $rateNum), 2); ?>;"
                    aria-label="Rating of this product is <?php echo round(($rateVal / $rateNum), 2); ?> out of 5.">
                </div>
                <span>(<?php echo round(($rateVal / $rateNum), 2); ?>)</span>
            </div>
        </div>

    </div>
    <?php } else {?>
    <div class="col-lg-12 col-md-12 col-sm-12 s_block">

        <h4>العروض المقدمة</h4>

        <ul class="commenters">
            <?php if ($bids) {foreach ($bids as $bid) {
    //Access Bid User
    $bidder = (array) $this->main_model->is_logged_in($bid->u_id, 'id')[0];
    ?>
            <li class="comm b_border">

                <div class="col-lg-12 col-md-12 col-sm-12 buye">

                    <img src="<?php
if ($bidder['oauth_provider'] == 'facebook') {
        echo $bidder['image'];
    } else {
        if ($bidder['image'] == '') {

            echo base_url() . 'vendor/images/user.png';

        } else {

            echo base_url() . 'vendor/uploads/images/' . $bidder['image'];

        }
    }
    ?>" alt="المشتري" />

                    <h6><a href="<?php echo base_url('user/' . $bidder['username']); ?>"><?php
echo $bidder['firstname'] . ' ' . $bidder['lastname'];
    ?></a></h6>

                    <h6><span class="fa fa-clock-o"></span>
                        منذ
                        <?php

    $differ = $this->main_model->dateTime('diff', $bid->date, $this->main_model->dateTime('current'));

    $this->main_model->differ($differ);

    ?></h6>
                    <?php if ($this->main_model->is_logged_in()) {?>
                    <?php if ($item->u_id == $this->session->userdata('id') && $item->state == 1) {
        ?>
                    <a href="<?php echo base_url('users/hireConfirm/' . $bid->id . '/' . $item->id); ?>"
                        class="btn btn-success hire">
                        <span class="fa fa-briefcase"></span>
                        توظيف
                    </a>
                    <a href="<?php echo base_url('users/createProjectChat/' . $item->id . '/' . $bid->u_id); ?>"
                        class="btn btn-primary" style="float: left;margin-left: -15px;border-radius: 0px;"><span
                            class="fa fa-comment"></span> راسل المستشار</a>
                    <?php }?>
                    <?php if ($bid->u_id == $this->session->userdata('id') && $item->state < 3) {
        ?>
                    <div class="btn-group bid-opt">
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            خيارات
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-item" id="edit-bid">
                                <span class="fa fa-cogs"></span>
                                تعديل
                            </div>
                        </div>
                    </div>
                    <?php

        $atrr2 = array(

            'class' => 'bidForm',
            'id' => 'bidEdit',
            'method' => 'post',

        );

        echo form_open_multipart(base_url('users/editBid/' . $bid->id), $atrr2);

        echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>

                                        </button></div>');

        if (isset($error) && $error !== '') {

            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error .

                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                                        <span aria-hidden="true">&times;</span>

                                        </button></div>';

        }
        ?>
                    <input type="number" name="bidAmount" placeholder="0" value="<?php echo $bid->amount; ?>"
                        class="bidAmount">
                    <label for="bidAmount">دولار</label> -
                    <input type="number" name="bidDur" placeholder="0" value="<?php echo $bid->days; ?>" class="bidDur">
                    <label for="bidDur">يوم</label>
                    <p>أرباحك بعد خصم عمولة الموقع <span class="earns-after">0</span> دولار</p>
                    <textarea palceholder="تفاصيل العرض" name="bidContent"
                        class="bidContent"><?php echo $bid->bid; ?></textarea>
                    <?php

        $submit = array(

            'type' => 'submit',

            'autocomplete' => 'off',

            'class' => 'regbtn a_Projectbtn',

            'name' => 'submit',

        );

        echo form_button($submit, '<span class="fa fa-cogs"></span> تعديل');

        ?>
                    <div class="btn btn-danger" id="done-bid">
                        <span class="fa fa-times"></span>
                        إلغاء
                    </div>
                    <p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>





                    <?php echo form_close(); ?>
                    <?php
}
    }
    ?>
                    <?php if ($item->state == 2 && $bid->id == $item->bid_id) {?>
                    <div class="btn btn-success hire">
                        <span class="fa fa-check"></span>
                        تم اختيار هذا العرض
                    </div>
                    <?php }?>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 buye-comm">
                    <?php if ($this->main_model->is_logged_in()) {
        if ($userId == $item->u_id or $bid->u_id == $this->session->userdata('id')) {
            ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center float-right dets-blocks">
                        <p><?php echo $bid->amount; ?> دولار</p>
                        <p><?php echo $bid->days; ?> يوم</p>
                    </div>
                    <h6 id="bid-con"><?php echo $bid->bid; ?></h6>
                    <?php
}
    } else {
        ?>
                    <h6 id="bid-con">
                        <?php echo preg_replace('!\s+!', ' ', mb_substr(strip_tags($bid->bid), 0, 150, "utf-8")) . '...'; ?>
                    </h6>
                    <?php
}
    ?>

                </div>

            </li>
            <?php }} else {echo '<h5>لا يوجد عروض بعد</h5>';}?>
        </ul>
    </div>
    <?php }?>
    <div class="col-lg-12 col-md-12 col-sm-12 s_block">

        <h4>المهارات</h4>

        <div class="k_word">
            <?php
$skillsAll = explode(',', $item->skills);
foreach ($skillsAll as $skill) {
    ?>
            <a href="#" class="keyword"><?php echo $skill; ?></a>
            <?php }?>
        </div>

    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 s_block">

        <h4>كلمات مفتاحية</h4>

        <div class="k_word">
            <?php
$tagsAll = explode(',', $item->tags);
foreach ($tagsAll as $tag) {
    ?>
            <a href="#" class="keyword"><?php echo $tag; ?></a>
            <?php }?>
        </div>

    </div>

</div>

<div class="col-lg-4 col-md-4 col-sm-12 blocks">

    <div class="col-lg-12 col-md-12 col-sm-12 s_block">

        <h4>بواسطة</h4>

        <div class="col-lg-12 col-md-12 col-sm-12 rate _r">

            <div class="col-lg-12 col-md-12 col-sm-12 r_u">

                <img class="r_user" src="<?php
if ($byUser->oauth_provider == 'facebook') {
    echo $byUser->image;
} else {
    if ($byUser->image == '') {

        echo base_url() . 'vendor/images/user.png';

    } else {

        echo base_url() . 'vendor/uploads/images/' . $byUser->image;

    }
}
?>" alt="user">

                <h6 class="r_name">

                    <a
                        href="<?php echo base_url() . 'user/' . $byUser->username; ?>"><?php echo $byUser->firstname . ' ' . $byUser->lastname; ?></a>

                </h6>

            </div>

            <div class="rate-section">
                <?php
$rateVal = 0;
$rateNum = 0;
$rates = $this->main_model->getByData('rate', 's_id', $byUser->id);
if ($rates) {
    foreach ($rates as $rate) {
        $rateVal += round((($rate->pro_rate + $rate->con_rate + $rate->qua_rate + $rate->exp_rate + $rate->date_rate + $rate->again_rate) / 6), 2);
        $rateNum++;}
} else {
    $rateVal = 0;
    $rateNum = 1;
}
?>
                <div class="sideStars" style="--rating: <?php echo round(($rateVal / $rateNum), 2); ?>;"
                    aria-label="Rating of this product is <?php echo round(($rateVal / $rateNum), 2); ?> out of 5.">
                </div>
                <span>(<?php echo round(($rateVal / $rateNum), 2); ?>)</span>
            </div>

            <h6 class="r_name"><?php $this->main_model->getRate(round(($rateVal / $rateNum), 2));?></h6>

        </div>

    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 rate price">
        <?php if ($item->kind == 1) {?>
        <div class="i-price"><?php echo $item->price; ?></div>
        <?php } else {?>
        <div class="i-price"><?php
$price = explode(',', $item->price);
    echo implode(' - ', $price);
    ?></div>
        <?php }?>
        <div class="i-currency">$</div>

    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 s_block">

        <h4>بطاقة الصفحة</h4>

        <h6><span>القسم : </span>
            <?php

$subCat = $this->main_model->getByData('categories', 'id', $item->tag_id);

$mainCat = $this->main_model->getByData('categories', 'id', $subCat[0]->c_id);

?>
            </span> <a href="#"><?php echo $mainCat[0]->category; ?></a> | <a
                href="#"><?php echo $subCat[0]->category; ?></a>
        </h6>

        <h6><span>منذ : </span>
            <?php

$differ = $this->main_model->dateTime('diff', $item->date, $this->main_model->dateTime('current'));

$this->main_model->differ($differ);

?>
        </h6>
        <h6><span>مدة التنفيذ : </span>
            <?php
echo $item->duration;
?>
            يوم</h6>
        <?php if ($item->kind == 1) {
    $buysCount = $this->main_model->getFullRequest('requestedgigs', '(i_id = ' . $item->id . ')', 'count');
    if (!$buysCount) {
        $buysCount = 0;
    }
    ?>
        <h6><span class="fa fa-shopping-cart"></span> <?php echo $buysCount; ?> اشتروا هذه الخدمة.</h6>
        <h6><span>رقم الخدمة : </span>
            <?php
                echo $item->id;
            ?></h6>
        <?php }else{ ?>
            <h6><span>رقم المشروع : </span>
            <?php
                echo $item->id;
            ?></h6>
        <?php } ?>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 s_block">

        <h4>شارك</h4>

        <div class="col-lg-12 col-md-12 col-sm-12 rate _r sharer">

            <a href="#"><span class="fab fa-facebook"></span></a>

            <a href="#"><span class="fab fa-twitter"></span></a>

            <a href="#"><span class="fab fa-linkedin"></span></a>

        </div>

    </div>

</div>

<?php
if ($this->main_model->is_admin_logged_in()) {
    $this->load->view('admin/include/footer.php');
} else {
    $this->load->view('include/footer.php');
}
?>