<?php $this->load->view('include/header.php'); ?>
<?php
if($this->session->flashdata('done')){
    echo '<div class="alert alert-success alert-dismissible fade show flash-data" role="alert">'.$this->session->flashdata('done').'<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';
}elseif($this->session->flashdata('error')){
    echo '<div class="alert alert-danger alert-dismissible fade show flash-data" role="alert">'.$this->session->flashdata('error').'<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';
}
$isBidder = 0;

if($this->main_model->is_logged_in()){

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

$userAbout = $userData['about'];

$userL_logout = $userData['l_logout'];
$userProvider = $userData['oauth_provider'];

}
?>
<div class="container-fluid m_top">
    <div class="col-lg-12 col-md-12 col-sm-12 it_title">
            <h3><?php echo $item->title; ?></h3>
            <?php if($this->main_model->is_logged_in() && $item->u_id == $userId){ ?>
                <a href="<?php echo base_url('users/delete/items/'.$item->id.'/?m=users/gigs/'.$userUsername); ?>" class="btn btn-danger"><span class="fa fa-trash"></span> حذف الخدمة</a>
            <?php } ?>
            <a href="<?php echo base_url('users/createChat/'.$item->id.'/'.$item->u_id.'/p'); ?>" class="btn btn-primary"><span class="fa fa-shopping-cart"></span> اطلب عمل مماثل</a>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-12 it_details">
        <div class="col-lg-12 col-md-12 col-sm-12 m_item">
        <?php 
            $images = explode(',',$item->images);
            $i = 0;
            foreach($images as $image){
            ?>

            <img class="w-100 col-12 float-right my-3" src="<?php echo base_url().'vendor/uploads/images/'.$image; ?>"><br>

            <?php 
                $i++;}
                if($item->ytlink !== 'NONE' && $item->ytlink !== ''){ ?>

                    <iframe class="d-block w-100" src="<?php echo $item->ytlink; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    <?php } ?>  
                    <div class="col-lg-12 col-md-12 col-sm-12 desc">
                        <?php echo $item->content; ?>
                    </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

            <h4>كلمات مفتاحية</h4>

            <div class="k_word">
                    <?php 
                    $tagsAll = explode(',',$item->tags);
                    foreach($tagsAll as $tag){
                    ?>
                        <a href="#" class="keyword"><?php echo $tag; ?></a>
                    <?php } ?>
                </div>

        </div>

    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 blocks">
<?php if($item->file_id){ ?>
    <div class="col-lg-12 col-md-12 col-sm-12 s_block">

        <h4>المرفقات</h4>

        <div class="col-lg-12 col-md-12 col-sm-12 rate _r sharer">

            <a target="_blank" href="<?php echo base_url('vendor/uploads/'.$item->file_id); ?>" class="download-att"><span class="fa fa-download"></span> تحميل</a>

        </div>

    </div>
<?php } ?>
    <div class="col-lg-12 col-md-12 col-sm-12 s_block">

            <h4>بواسطة</h4>

            <div class="col-lg-12 col-md-12 col-sm-12 rate _r">

                    <div class="col-lg-12 col-md-12 col-sm-12 r_u">

                        <img class="r_user" src="<?php 
                                            if($byUser->oauth_provider == 'facebook'){
                                                echo $byUser->image;
                                            }else{
                                                if($byUser->image==''){

                                                    echo base_url().'vendor/images/user.png';

                                                    }else{

                                                        echo base_url().'vendor/uploads/images/'.$byUser->image;

                                                    }
                                            }
                                            ?>" alt="user">

                        <h6 class="r_name">

                        <a href="<?php echo base_url().'user/'.$byUser->username; ?>"><?php echo $byUser->firstname.' '.$byUser->lastname; ?></a>

                        </h6>

                    </div>

                    <div class="rate-section">
                        <?php
                        $rateVal = 0;$rateNum = 1;
                            $rates = $this->main_model->getByData('rate','s_id',$byUser->id);
                            if($rates){
                                foreach($rates as $rate){
                                    $rateVal += round((($rate->pro_rate+$rate->con_rate+$rate->qua_rate+$rate->exp_rate+$rate->date_rate+$rate->again_rate)/6),2);
                                $rateNum++;}
                            }else{
                                $rateVal = 0;
                            }
                        ?>
                        <div class="sideStars" style="--rating: <?php echo round(($rateVal/$rateNum),2); ?>;" aria-label="Rating of this product is <?php echo round(($rateVal/$rateNum),2); ?> out of 5."></div> <span>(<?php echo round(($rateVal/$rateNum),2); ?>)</span>
                    </div>

                    <h6 class="r_name"><?php $this->main_model->getRate(round(($rateVal/$rateNum),2)); ?></h6>

    </div>


</div>
<div class="col-lg-12 col-md-12 col-sm-12 s_block">

                    <h4>بطاقة الصفحة</h4>

                <h6><span>القسم : </span>
                <?php

            $subCat = $this->main_model->getByData('categories','id',$item->tag_id);

            $mainCat = $this->main_model->getByData('categories','id',$subCat[0]->c_id);

            ?>
            </span> <a href="#"><?php echo $mainCat[0]->category; ?></a> | <a href="#"><?php echo $subCat[0]->category; ?></a>
                    </h6>

                <h6><span>منذ : </span>
                <?php

                $differ = $this->main_model->dateTime('diff',$item->date,$this->main_model->dateTime('current'));

                $this->main_model->differ($differ);

                ?>
                </h6>
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
</div>

<?php $this->load->view('include/footer.php'); ?>

