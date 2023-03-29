<?php

$viewUser = $this->main_model->is_logged_in($this->uri->segment(2));
$viewUser = (array) $viewUser[0];

$posUser = $this->main_model->is_logged_in($this->uri->segment(3));
$posUser = (array) $posUser[0];

$userData = (array) $this->main_model->is_logged_in(1)[0];

      if($this->main_model->is_logged_in() && $userviewed[0]->username == $userData['username']){

                    // Access User Data Securly

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

          // Check if activated

        if($userState == 0 && $this->uri->segment(1) !== 'user' && $this->uri->segment(2) !== 'p' && $userUsername !== $this->uri->segment(3)){

            //Not Activated

                redirect(base_url().'activate/reactivate/');

        }

        }elseif($viewUser){

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
                $userProvider = $viewUser['oauth_provider'];

      }elseif($posUser){

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
                $userProvider = $posUser['oauth_provider'];

      }

      ?>   

<div class="<?php if($this->main_model->is_logged_in() && $userviewed[0]->username == $userData['username']){ ?>col-lg-4 col-md-4<?php }else{ ?>col-lg-6 col-md-6<?php } ?> col-sm-12 my-th">

        <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username; ?>">

            <div class="col-lg-12 col-md-12 col-sm-12 m-projects">

                <span class="fa fa-list"></span>

                مشاريعي

            </div>

        </a>

    </div>

    <div class="<?php if($this->main_model->is_logged_in() && $userviewed[0]->username == $userData['username']){ ?>col-lg-4 col-md-4<?php }else{ ?>col-lg-6 col-md-6<?php } ?> col-sm-12 my-th">

        <a href="<?php echo base_url().'users/gigs/'.$userviewed[0]->username; ?>">

            <div class="col-lg-12 col-md-12 col-sm-12 m-gigs">

                <span class="fab fa-angellist"></span>

                خدماتي

            </div>

        </a>

    </div>
    <?php if($this->main_model->is_logged_in() && $userviewed[0]->username == $userData['username']){ ?>
    <div class="col-lg-4 col-md-4 col-sm-12 my-th">

        <a href="<?php echo base_url().'users/chat/'; ?>">

            <div class="col-lg-12 col-md-12 col-sm-12 m-products">

                <span class="fa fa-list"></span>

                المحادثات

            </div>

        </a>

    </div>
    <?php
    }
    ?>

    <div class="col-lg-4 col-md-4 col-sm-12 s-pro">

        <?php if($this->main_model->is_logged_in() && $userviewed[0]->username == $userData['username']){ ?>

    <!--Item-->

    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 right-menu">

            <a href="<?php echo base_url().'users/insertProject/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-list"></span>

                    <span class="fa fa-plus"></span>

                    أضف مشروع

                </div>

            </a>

            <a href="<?php echo base_url().'users/insertGig/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fab fa-angellist"></span>

                    <span class="fa fa-plus"></span>

                    أضف خدمة

                </div>

            </a>

        </div>

    </div>

       <?php } ?>
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

    <div class="col-lg-12 col-md-12 col-sm-12 right-menu">

       <a href="<?php echo base_url().'users/rates/'.$userviewed[0]->username; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-star"></span>

                    تقييماتي

                </div>

            </a>

        </div>

    </div>

    <!--Item-->

    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

            <div class="col-lg-12 col-md-12 col-sm-12 h_block float-right">

                <a href="<?php echo base_url().'user/'.$userUsername; ?>">

                    <img src="<?php 
                    if($userProvider == 'facebook'){
                        echo $userImage;
                    }else{
                        if($userImage==''){

                            echo base_url().'vendor/images/user.png';

                            }else{

                                echo base_url().'vendor/uploads/images/'.$userImage;

                            }
                    }
                    ?>" class="user user-home" alt="user">

                    <h6 class="r_name">

                        <a href="<?php echo base_url().'user/'.$userUsername; ?>">

                            <?php echo $userFirstname.' '.$userLastname; ?>

                        </a>
                        

                    </h6>

                    <div class="col-lg-12 col-md-12 col-sm-12 rate">

                    <div class="rate-section">
                        <?php
                        $rateVal = 0;$rateNum = 0;
                            $rates = $this->main_model->getByData('rate','s_id',$userId);
                            if($rates){
                                foreach($rates as $rate){
                                    $rateVal += round((($rate->pro_rate+$rate->con_rate+$rate->qua_rate+$rate->exp_rate+$rate->date_rate+$rate->again_rate)/6),2);
                                $rateNum++;}
                                if($rateNum < 1){
                                    $rateNum = 1;
                                }
                            }else{
                                $rateVal = 0;
                                $rateNum = 1;
                            }
                        ?>
                        <div class="sideStars" style="--rating: <?php echo round(($rateVal/$rateNum),2); ?>;" aria-label="Rating of this product is <?php echo round(($rateVal/$rateNum),2); ?> out of 5."></div> <span>(<?php echo round(($rateVal/$rateNum),2); ?>)</span>
                    </div>
                    <h6 class="r_name"><?php $this->main_model->getRate(round(($rateVal/$rateNum),2)); ?></h6>
                    </div>

                </a>
                <?php if(isset($userData['username']) && $userviewed[0]->username !== $userData['username']){ ?>
                    <br>
                    <a class="btn btn-success" style="border-radius:0px;" href="<?php echo base_url('users/insertProject/'.$userId); ?>">وظفني</a>
                <?php } ?>
            </div>

            <?php if($this->main_model->is_logged_in() && $userviewed[0]->username == $userData['username']){ ?>

            <a href="<?php echo base_url().'users/settings/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 b_blocks float-right">

                    <span class="fa fa-cogs"></span>

                    اعدادات الحساب

                </div>

            </a>

            <?php } ?>

        </div>

    </div>

    

    <!--Item-->

    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

            <div class="col-lg-12 col-md-12 col-sm-12 h_block float-right">

                <a href="<?php echo base_url().'users/portfolio/'.$userviewed[0]->username; ?>">

                    <h3>أعمالي</h3>

                    <h1><?php
                    $count = $this->main_model->getFullRequest('portfolio','(kind = 1) && (u_id = '.$userviewed[0]->id.')','count');
                    if(!$count){
                        $count = 0;
                    }
                    echo $count;
                    ?></h1>

                </a>

            </div>

            <?php if($this->main_model->is_logged_in() && $userviewed[0]->username == $userData['username']){ ?>

            <a href="<?php echo base_url('users/insertPortfolio'); ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 b_blocks float-right">

                    <span class="fa fa-plus-circle"></span>

                     أضف عمل جديد

                </div>

            </a>

            <?php } ?>

        </div>

    </div>

        

</div>