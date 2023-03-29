<?php $this->load->view('include/header.php'); ?>

<div class="container-fluid m_top">

    <?php

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

        

        <div class="b_items">

            <h3 class="projects">تصفح تقييمات <?php echo $userviewed[0]->firstname.' '.$userviewed[0]->lastname; ?></h3>

            <div class="col-lg-12 col-md-12 col-sm-12 rate">

                    <div class="rate-section">
                        <?php
                        $rateVal = 0;$rateNum = 0;
                            if($rates){
                                foreach($rates as $rate){
                                    $rateVal += round((($rate->pro_rate+$rate->con_rate+$rate->qua_rate+$rate->exp_rate+$rate->date_rate+$rate->again_rate)/6),2);
                                    ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 float-right item-rate-sec" style="background:#fff;padding:10px;border:1px solid #ddd;margin-top:10px;">
                                    <p><?php
                                    $item = $this->main_model->getByData('items','id',$rate->i_id)[0];
                                    if($item){
                                    ?>
                                        <a href="<?php echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/'; ?>"><?php echo $item->title; ?></a>
                                    <?php
                                    }else{
                                    ?>
                                    تقييم على عنصر تم حذفه
                                    <?php
                                    }
                                    ?></p>
                                    <?php $titles = array('NONE','الاحترافية بالتعامل','التواصل والمتابعة','جودة العمل المسلّم','الخبرة بمجال المشروع','التسليم فى الموعد','التعامل معه مرّة أخرى');$x=1;while($x <= 6){ ?>
                                    <div class="rater-section">
                                        <div class="rate-secCon">
                                            <div class="rate-title float-right">
                                                <?php echo $titles[$x]; ?>
                                            </div>
                                            <div class="float-left pro-rate">
                                                <?php
                                                $ratess = array($rate->pro_rate,$rate->con_rate,$rate->qua_rate,$rate->exp_rate,$rate->date_rate,$rate->again_rate);
                                                $i=1;while($i <= $ratess[$x-1]){ ?>
                                                    <div class="fa fa-star orange"></div>
                                                <?php $i++;} ?>
                                                <?php $nume = 5-$ratess[$x-1];
                                                $y=1;while($y <= $nume){
                                                ?>
                                                <div class="fa fa-star"></div>
                                                <?php
                                                $y++;}
                                                ?>
                                                <span><?php echo $ratess[$x-1]; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $x++;} ?>
                                        <div class="col-lg-12 col-md-12 col-sm-12 float-right">
                                            <div class="sideStars" style="--rating: <?php echo round((($rate->pro_rate+$rate->con_rate+$rate->qua_rate+$rate->exp_rate+$rate->date_rate+$rate->again_rate)/6),2); ?>;" aria-label="Rating of this product is <?php echo round((($rate->pro_rate+$rate->con_rate+$rate->qua_rate+$rate->exp_rate+$rate->date_rate+$rate->again_rate)/6),2); ?> out of 5."></div> <span>(<?php echo round((($rate->pro_rate+$rate->con_rate+$rate->qua_rate+$rate->exp_rate+$rate->date_rate+$rate->again_rate)/6),2) ?>)</span>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

<h4>رأي المشتري</h4>

<ul class="commenters">

  <li class="comm b_border">

  <div class="col-lg-12 col-md-12 col-sm-12 buye">
<?php
$rater = $this->main_model->getByData('users','id',$rate->u_id)[0];
?>
  <img src="<?php 
                    if($rater->oauth_provider == 'facebook'){
                        echo $rater->image;
                    }else{
                        if($rater->image==''){

                            echo base_url().'vendor/images/user.png';

                            }else{

                                echo base_url().'vendor/uploads/images/'.$rater->image;

                            }
                    }
                    ?>" class="user user-home" alt="user">

                    <h6 class="r_name">

                        <a href="<?php echo base_url().'user/'.$rater->username; ?>">

                            <?php echo $rater->firstname.' '.$rater->lastname; ?>

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
                            }else{
                                $rateVal = 0;
                            }
                        ?>
                        <div class="col-12 float-right text-center" style="background:#fff;padding:10px;border:1px solid #ddd;margin-top:10px;">
                        <h3>الاجمالي</h3>
                            <div class="sideStars" style="--rating: <?php echo round(($rateVal/$rateNum),2); ?>;" aria-label="Rating of this product is <?php echo round(($rateVal/$rateNum),2); ?> out of 5."></div> <span>(<?php echo round(($rateVal/$rateNum),2); ?>)</span>
                        </div>
                    </div>

                    </div>

        </div>
    </div>

<?php $this->load->view('include/footer.php'); ?>