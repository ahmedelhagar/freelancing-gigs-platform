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
        <h3 class="projects">تصفح منتجات <?php echo $userviewed[0]->firstname.' '.$userviewed[0]->lastname; ?></h3>
            <?php if($records){foreach($records as $product){ ?>
              <div class="b_item col-lg-4 col-md-4 col-sm-6">
                  <div class="service">
                      <?php
                          $image = explode(',',$product->images);
                          $vthumb = 'vthumb_'.$image[0];
                      ?>
                      <a href="#"><img src="<?php echo base_url().'vendor/uploads/images/'.$vthumb; ?>" alt="<?php echo $product->title; ?>"></a>
                      <h6><a href="#"><?php echo $product->title; ?></a></h6>
                      <a href="#"><div class="buy_this">15 شخص اشترى هذا المنتج</div></a>
                  </div>
              </div>
            <?php }}else{
                echo '<h3 class="no-data">لايوجد منتجات لعرضها</h3>';
            } ?>
        </div>
        <!-- Pagination -->
      <ul class="pagination justify-content-center pager"><?php echo $links; ?></ul>
    </div>
    
</div>
<?php $this->load->view('include/footer.php'); ?>