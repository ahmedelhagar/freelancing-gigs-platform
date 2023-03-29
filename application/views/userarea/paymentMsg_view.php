<?php $this->load->view('include/header.php'); ?>
<div class="container-fluid m_top">
    <?php
        $result = $this->main_model->is_logged_in(strip_tags($this->session->userdata('username')));
    if($result){
        $currentUser = (array) $result[0]; /*To Get Current user*/
        // Check if activated
        if($currentUser['state'] == 0){
            //Not Activated
            if($this->session->userdata('username') == $currentUser['username']){
                echo '
                <div class="alert alert-danger" role="alert">
                  حسابك غير مُفعل يمكن أن تجد رسالة التفعيل في الرسائل الغير مرغوبة أو 
                  <b><a href="'.base_url().'activate/reactivate/"> أرسل كود تفعيل جديد</a></b>
                </div>
                ';
            }else{
                redirect(base_url().'user/');/*Not Found*/
            }
        }
    }else{
        redirect(base_url().'user/');/*Not Found*/
    }
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
            }
      ?>
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro text-center">
        <?php
            if($state == 1){
            ?>
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">عملية دفع ناجحة!</h4>
          <p>تمت عملية الدفع بنجاح وإضافة مبلغ <b><?php echo $clearAmount; ?>$</b> إلى حسابك.</p>
          <hr>
          <p class="mb-0">نتمنى أن نكون على قدر ثقتك ... ونعتز بخدمتك.</p>
        </div>
        <?php
            }elseif($state == 0){
            ?>
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">لقد تمت إضافة الرصيد من قبل!</h4>
          <p>يمكنك مشاهدة رصيدك من <a href="<?php echo base_url().'users/payments/'; ?>">هنا</a>.</p>
          <hr>
          <p class="mb-0">أو يمكنك الذهاب للصفحة الرئيسية من <a href="<?php echo base_url(); ?>">هنا</a>.</p>
        </div>
        <?php
            }elseif($state == 2){
            ?>
        <div class="alert alert-danger" role="alert">
          <h4 class="alert-heading">يوجد خطأ ما في عملية تحويل الرصيد!</h4>
          <p>يمكنك التحدث لأحد ممثلي خدمة العملاء من <a href="<?php echo base_url(); ?>">هنا</a>.</p>
          <hr>
          <p class="mb-0">أو يمكنك الذهاب للصفحة الرئيسية من <a href="<?php echo base_url(); ?>">هنا</a>.</p>
        </div>
        <?php
            }elseif($state == 3){
            ?>
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">يوجد خطأ ما في عملية الدفع!</h4>
          <p>الحد الأدنى لعملية الشحن هي 10$ يمكنك إعادة الشحن من <a href="<?php echo base_url().'users/payments/'; ?>">هنا</a>.</p>
          <hr>
          <p class="mb-0">أو يمكنك الذهاب للصفحة الرئيسية من <a href="<?php echo base_url(); ?>">هنا</a>.</p>
        </div>
        <?php
            }elseif($state == 4){
            ?>
        <div class="alert alert-warning" role="alert">
          <h4 class="alert-heading">يوجد خطأ في عملية الدفع!</h4>
          <p>أنت لا تمتلك رصيد كافي لإتمام هذه العملية ... رصيدك من <a href="<?php echo base_url().'users/payments/'; ?>">هنا</a>.</p>
          <hr>
          <p class="mb-0">أو يمكنك الذهاب للصفحة الرئيسية من <a href="<?php echo base_url(); ?>">هنا</a>.</p>
        </div>
        <?php
            }elseif($state == 5){
            ?>
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">لقد تمت عملية التحويل بنجاح!</h4>
          <p>تم تحويل مبلغ <b><?php echo $adsAmount; ?>$</b> إلى حسابك الإعلاني ... شاهد رصيدك من <a href="<?php echo base_url().'users/payments/'; ?>">هنا</a>.</p>
          <hr>
          <p class="mb-0">أو يمكنك الذهاب للصفحة الرئيسية من <a href="<?php echo base_url(); ?>">هنا</a>.</p>
        </div>
        <?php
            }
        ?>
    </div>
</div>
<?php $this->load->view('include/footer.php'); ?>