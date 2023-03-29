<?php $this->load->view('include/header.php'); ?>

<div class="container-fluid m_top">

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
$viewUser = (array) $this->main_model->is_logged_in($this->uri->segment(2))[0];

$posUser = (array) $this->main_model->is_logged_in($this->uri->segment(3))[0];

      if($this->main_model->is_logged_in()){

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

                $userAbout = $userData['about'];

                $userL_logout = $userData['l_logout'];

          // Check if activated

        if($userState == 0 && $this->uri->segment(1) !== 'user' && $this->uri->segment(2) !== 'p' && $userUsername !== $this->uri->segment(3)){

            //Not Activated

                redirect(base_url().'activate/reactivate/');

        }

        }

    elseif($viewUser){

                $userId = $viewUser['id'];

                $userFirstname = $viewUser['firstname'];

                $userLastname = $viewUser['lastname'];

                $userUsername = $viewUser['username'];

                $userEmail = $viewUser['email'];

                $userCountry = $viewUser['country'];

                $userMobile = $viewUser['mobile'];

                $userAddress = $viewUser['address'];

                $userPostal = $viewUser['postal'];

                $userIp = $viewUser['ip'];

                $userRate = $viewUser['rate'];

                $userA_balance = $viewUser['a_balance'];

                $userAds_balance = $viewUser['ads_balance'];

                $userBalance = $viewUser['balance'];

                $userC_balance = $viewUser['c_balance'];

                $userDate = $viewUser['date'];

                $userState = $viewUser['state'];

                $userAll_balance = $viewUser['all_balance'];

                $userImage = $viewUser['image'];

                $userAbout = $viewUser['about'];

                $userL_logout = $viewUser['l_logout'];

      }

    elseif($posUser){

                $userId = $posUser['id'];

                $userFirstname = $posUser['firstname'];

                $userLastname = $posUser['lastname'];

                $userUsername = $posUser['username'];

                $userEmail = $posUser['email'];

                $userCountry = $posUser['country'];

                $userMobile = $posUser['mobile'];

                $userAddress = $posUser['address'];

                $userPostal = $posUser['postal'];

                $userIp = $posUser['ip'];

                $userRate = $posUser['rate'];

                $userA_balance = $posUser['a_balance'];

                $userAds_balance = $posUser['ads_balance'];

                $userBalance = $posUser['balance'];

                $userC_balance = $posUser['c_balance'];

                $userDate = $posUser['date'];

                $userState = $posUser['state'];

                $userAll_balance = $posUser['all_balance'];

                $userImage = $posUser['image'];

                $userAbout = $posUser['about'];

                $userL_logout = $posUser['l_logout'];

      }

      ?>  

    <br />

    

<?php $this->load->view('include/userSideBar_view.php'); ?>

    

    <div class="col-lg-8 col-md-8 col-sm-12 s-pro projects">
    <?php if($item->kind == 1){
                              //Gigs
                        ?>
                        <div class="b_item col-lg-4 col-md-4 col-sm-12" style="float: none;margin: auto;">

<div class="service">
  <?php
  $image = explode(',',$item->images);

  $vthumb = 'vthumb_'.$image[0];
  ?>
    <a href="<?php

echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/';

?>"><img src="<?php echo base_url().'vendor/uploads/images/'.$vthumb; ?>" alt="<?php echo $item->title; ?>"></a>

    <h6><a href="<?php

echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/';

?>"><?php echo $item->title; ?></a></h6>

    <a href="<?php

echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/';

?>"><div class="buy_this"><?php
$count = $this->main_model->getFullRequest('requestedgigs','(i_id = '.$item->id.')','count');
if($count > 0){
echo $count.' عمليات شراء تمت لهذه الخدمة';
}else{
echo 'كن أول مشتري';
}
?></div></a>

</div>

</div>
                      <?php }elseif($item->kind == 2){
                          //Projects
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 project my-3">

<h4 class="project-title"><a href="<?php

    echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/';

    ?>"><?php echo $item->title; ?></a></h4>

<div class="project-snip"><span class="fa fa-clock"></span>

    منذ

    <?php

    $differ = $this->main_model->dateTime('diff',$item->date,$this->main_model->dateTime('current'));

    $this->main_model->differ($differ);

    ?>

    <?php

    $subCat = $this->main_model->getByData('categories','id',$item->tag_id);

    $mainCat = $this->main_model->getByData('categories','id',$subCat[0]->c_id);

    ?>

    | <span class="fa fa-tags"></span> قسم : <a href="#"><?php echo $mainCat[0]->category; ?></a> | <span class="fa fa-tag"></span> تصنيف : <a href="#"><?php echo $subCat[0]->category; ?></a></div>

<div class="col-lg-12 col-md-12 col-sm-12 project-content">

<?php echo preg_replace('!\s+!', ' ',mb_substr(strip_tags($item->content),0,150, "utf-8")); ?>...

</div>

<div class="budget">بميزانية

    <?php 

        $budget = explode(',',$item->price);

        if($budget[0] == $budget[1]){

            echo $budget[0].' $';

        }elseif($budget[0] > $budget[1]){

            echo ' من '.$budget[1].' إلى '.$budget[0].' $';

        }else{

            echo ' من '.$budget[0].' إلى '.$budget[1].' $';

        }

    ?></div>

</div>
                      <?php } ?>
        <div class="col-12 float-right s_block" style="margin-top:10px !important;">
            <h4>تقييم <?php echo $user->firstname.' '.$user->lastname; ?></h4>
            <?php $titles = array('NONE','الاحترافية بالتعامل','التواصل والمتابعة','جودة العمل المسلّم','الخبرة بمجال المشروع','التسليم فى الموعد','التعامل معه مرّة أخرى');$x=1;while($x <= 6){ ?>
            <div class="rater-section">
                <div class="rate-secCon">
                    <div class="rate-title float-right">
                        <?php echo $titles[$x]; ?>
                    </div>
                    <div class="float-left pro-rate">
                        <div class="fa fa-star rating-star rating-starCo" onmouseover="rate(1,<?php echo $x; ?>);" id="rs1_<?php echo $x; ?>"></div>
                        <div class="fa fa-star rating-star" onmouseover="rate(2,<?php echo $x; ?>);" id="rs2_<?php echo $x; ?>"></div>
                        <div class="fa fa-star rating-star" onmouseover="rate(3,<?php echo $x; ?>);" id="rs3_<?php echo $x; ?>"></div>
                        <div class="fa fa-star rating-star" onmouseover="rate(4,<?php echo $x; ?>);" id="rs4_<?php echo $x; ?>"></div>
                        <div class="fa fa-star rating-star" onmouseover="rate(5,<?php echo $x; ?>);" id="rs5_<?php echo $x; ?>"></div>
                        <span id="rNum<?php echo $x; ?>" data="1">(1)</span>
                    </div>
                </div>
            </div>
            <?php $x++;} ?>
            <div class="col-12 float-right all-rate">
                <div class="rate-section">
                    <div class="Stars" style="--rating: 1;" aria-label="Rating of this product is 1 out of 5."></div> <span id="allRate" data="1">(1)</span>
                </div>
            </div>
            <form class="col-12 float-right" action="<?php echo base_url('users/rateCheck/'.strip_tags($this->uri->segment(3)).'/'.strip_tags($this->uri->segment(4)).'/'.strip_tags($this->uri->segment(5)).'/'.strip_tags($this->uri->segment(6)).'/'); ?>" method="post">
                <input type="hidden" name="pro_rate" id="rs_i1" value="1">
                <input type="hidden" name="con_rate" id="rs_i2" value="1">
                <input type="hidden" name="qua_rate" id="rs_i3" value="1">
                <input type="hidden" name="exp_rate" id="rs_i4" value="1">
                <input type="hidden" name="date_rate" id="rs_i5" value="1">
                <input type="hidden" name="again_rate" id="rs_i6" value="1">
                <textarea name="comment" id="rate-comment" placeholder="أضف تعليق"></textarea>
                <button class="btn btn-success rate-go" type="submit">
                    <span class="fa fa-star"></span>
                        تقييم
                </button>
            </form>
        </div>
    </div>

    

</div>

<?php $this->load->view('include/footer.php'); ?>