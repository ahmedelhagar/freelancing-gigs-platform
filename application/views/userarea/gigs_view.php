<?php $this->load->view('include/header.php'); ?>

<div class="container-fluid m_top">

    <?php

$viewUser = (array) $this->main_model->is_logged_in($this->uri->segment(2));
$viewUser = $viewUser[0];

$posUser = (array) $this->main_model->is_logged_in($this->uri->segment(3));
$posUser = $posUser[0];

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
<?php if($this->main_model->is_logged_in() && $userviewed[0]->username == $userUsername){ ?>
<div class="col-lg-6 col-md-6 col-sm-12 my-th">

<a href="<?php echo base_url().'users/gigs/'.$userviewed[0]->username; ?>">

    <div class="col-lg-12 col-md-12 col-sm-12 m-products">

        <span class="fa fa-list"></span>

        خدماتي

    </div>

</a>

</div>
<div class="col-lg-6 col-md-6 col-sm-12 my-th">

<a href="<?php echo base_url().'users/gigs/'.$userviewed[0]->username.'/done'; ?>">

    <div class="col-lg-12 col-md-12 col-sm-12 m-projects">

        <span class="fa fa-shopping-cart"></span>

        مشترياتي/مبيعاتي

    </div>

</a>

</div>
<?php if($this->main_model->is_logged_in() && $userviewed[0]->username == $userUsername && (strip_tags($this->uri->segment(4)) == 'done' || strip_tags($this->uri->segment(5)) == 'mine' || strip_tags($this->uri->segment(5)) == 'bought')){ ?>
<div class="col-lg-4 col-md-4 col-sm-12 my-th">

<a href="<?php echo base_url().'users/gigs/'.$userviewed[0]->username.'/done'; ?>">

    <div class="col-lg-12 col-md-12 col-sm-12 m-products <?php if($this->uri->segment(4) == 'done' && $this->uri->segment(5) == ''){echo 'active-user-tab';} ?>">

        <span class="fa fa-list"></span>

        الكل

    </div>

</a>

</div>
<div class="col-lg-4 col-md-4 col-sm-12 my-th">

    <a href="<?php echo base_url().'users/gigs/'.$userviewed[0]->username.'/done/bought'; ?>">

        <div class="col-lg-12 col-md-12 col-sm-12 m-projects <?php if($this->uri->segment(4) == 'done' && $this->uri->segment(5) == 'bought'){echo 'active-user-tab';} ?>">

            <span class="fa fa-shopping-cart"></span>

            مشترياتي

        </div>

    </a>

</div>
<div class="col-lg-4 col-md-4 col-sm-12 my-th">

    <a href="<?php echo base_url().'users/gigs/'.$userviewed[0]->username.'/done/mine'; ?>">

        <div class="col-lg-12 col-md-12 col-sm-12 m-gigs <?php if($this->uri->segment(4) == 'done' && $this->uri->segment(5) == 'mine'){echo 'active-user-tab';} ?>">

            <span class="fa fa-shopping-cart"></span>

            مبيعاتي

        </div>

    </a>

</div>
<?php } ?>
<?php if($this->main_model->is_logged_in() && $userviewed[0]->username == $userUsername && (strip_tags($this->uri->segment(4)) == '' || strip_tags($this->uri->segment(4)) == 'accepted' || strip_tags($this->uri->segment(4)) == 'notAccepted')){ ?>
<div class="col-lg-4 col-md-4 col-sm-12 my-th">

<a href="<?php echo base_url().'users/gigs/'.$userviewed[0]->username; ?>">

    <div class="col-lg-12 col-md-12 col-sm-12 m-products <?php if($this->uri->segment(4) == ''){echo 'active-user-tab';} ?>">

        <span class="fa fa-list"></span>

        الكل

    </div>

</a>

</div>
<div class="col-lg-4 col-md-4 col-sm-12 my-th">

    <a href="<?php echo base_url().'users/gigs/'.$userviewed[0]->username.'/notAccepted'; ?>">

        <div class="col-lg-12 col-md-12 col-sm-12 m-projects <?php if($this->uri->segment(4) == 'notAccepted'){echo 'active-user-tab';} ?>">

            <span class="fa fa-shopping-cart"></span>

            غير نشطة

        </div>

    </a>

</div>
<div class="col-lg-4 col-md-4 col-sm-12 my-th">

    <a href="<?php echo base_url().'users/gigs/'.$userviewed[0]->username.'/accepted'; ?>">

        <div class="col-lg-12 col-md-12 col-sm-12 m-gigs <?php if($this->uri->segment(4) == 'accepted'){echo 'active-user-tab';} ?>">

            <span class="fa fa-shopping-cart"></span>

            نشطة

        </div>

    </a>

</div>
<?php } ?>
<?php } ?>
        <h3 class="projects">تصفح خدمات <?php echo $userviewed[0]->firstname.' '.$userviewed[0]->lastname; ?></h3>

            <?php if($records){foreach($records as $product){ ?>

              <div class="b_item col-lg-4 col-md-4 col-sm-6">

                  <div class="service">

                      <?php

                          $image = explode(',',$product->images);

                          $vthumb = 'vthumb_'.$image[0];
                          $vlink = base_url().'vendor/uploads/images/'.$vthumb;
                          
                          $headers = get_headers($vlink, 1);
                            if (strpos($headers['Content-Type'], 'image/') !== false) {
                                $vlink = $vlink;
                            } else {
                                $vlink = base_url().'vendor/uploads/images/'.$image[0];
                            }   
    
                          ?>
    
                          <a href="<?php
    
    echo base_url().'i/'.str_replace(' ','-',$product->title).'/'.$product->id.'/';
    
    ?>"><img src="<?php echo $vlink; ?>" alt="<?php echo $product->title; ?>"></a>

                      <h6><a href="<?php

echo base_url().'i/'.str_replace(' ','-',$product->title).'/'.$product->id.'/';

?>"><?php echo $product->title; ?></a></h6>

                      <a href="<?php

echo base_url().'i/'.str_replace(' ','-',$product->title).'/'.$product->id.'/';

?>"><div class="buy_this"><?php
$count = $this->main_model->getFullRequest('requestedgigs','(i_id = '.$product->id.')','count');
if($count > 0){
echo $count.' عمليات شراء تمت لهذه الخدمة';
}else{
echo 'كن أول مشتري';
}
?></div></a>

                  </div>

              </div>

            <?php }}else{

                echo '<h3 class="no-data">لايوجد خدمات لعرضها</h3>';

            } ?>

        </div>

        <!-- Pagination -->

      <ul class="pagination justify-content-center pager"><?php echo $links; ?></ul>

    </div>

    

</div>

<?php $this->load->view('include/footer.php'); ?>