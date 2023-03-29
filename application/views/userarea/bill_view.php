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
            <table class="table table-striped col-12 float-right px-2 py-2" style="background:#fff;">
            <h3>الفاتورة</h3>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم الخدمة</th>
      <th scope="col">عدد المرات X السعر</th>
    </tr>
  </thead>
  <tbody id="cartContent">
  <?php
            $cart = $this->main_model->getByData('cart','u_id',$this->session->userdata('id'))[0];
            $allGigs = array();$allGigsPrice = 0;$gigsUp = array();$gigsUpPrice = 0;
            if($cart){
            $cartItems = array_count_values(explode(',',$cart->i_ids));
            if($cart->i_ids !== '' AND $cart->i_ids !== null){$i = 1;foreach($cartItems as $cartItem => $itemNum){
              if($cartItem !== ''){
                $item = $this->main_model->getByData('items','id',$cartItem)[0];
        ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td>
        <p><b><a href="<?php echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/'; ?>" style="margin-top:5px;float:right;"><?php echo $item->title; ?></a></b></p>
        <div class="cartAdds">
        <?php
        $allGigs = array();$allGigsPrice = 0;$gigsUp = array();$gigsUpPrice = 0;
        $cartgus = $this->main_model->getFullRequest('cartgu','(cart_id = '.$cart->id.') AND (i_id = '.$item->id.') AND (gigsIds IS NOT NULL)');
        $gu = $this->main_model->getFullRequest('gigupdates','(i_id = '.$item->id.')')[0];
        if($gu){if($cartgus){ ?>
          <div class="col-lg-12 col-md-12 col-sm-12 s_block">
              <h4>تطويرات الخدمة</h4>
              <?php
              $x=1;foreach($cartgus as $cartgu){
                echo '<p class="text-center">رقم '.$x.'</p>';
                $x++;
                $cartguIds = explode(', ',$cartgu->gigsIds);
                $cartReps = explode(', ',$cartgu->ui_rep);
                $i = 0;
                while($i <= (count($cartguIds)-1)){
                  $gu = $this->main_model->getFullRequest('gigupdates','(i_id = '.$item->id.')')[0];
                  $guContent = explode(', ',$gu->content);
                  $guAmount = explode(', ',$gu->amount);
                  $guDays = explode(', ',$gu->days);
                  if(isset($guContent[$cartguIds[$i]])){
                  ?>
                  <div class="gU">
                      <h5><?php echo $guContent[$cartguIds[$i]]; ?> في مدة <?php echo $guDays[$cartguIds[$i]].' يوم'; ?> - بسعر <?php echo '$'.$guAmount[$cartguIds[$i]]; ?><div class="float-left"><?php
                    $gigsUp[] = $cartReps[$i].' X $'.$guAmount[$cartguIds[$i]];
                      $gigsUpPrice += $cartReps[$i]*$guAmount[$cartguIds[$i]];
                      echo $cartReps[$i].' X $'.$guAmount[$cartguIds[$i]];
                      ?></div></h5>
                  </div>
                  <?php
                  }
                $i++;}
                echo '<br>';
              }
              ?>
          </div>
          <?php }} ?>
        </div>
      </td>
      <td>
        <?php
        $allGigs[] = $itemNum.' X $'.$item->price;
        $allGigsPrice += $itemNum*$item->price;
        echo $itemNum.' X $'.$item->price;
        
        ?>
      </td>
    </tr>
    <?php $i++;}} ?>
    <?php }else{
    ?>
    <h4 class="cart-empty">السلة فارغة</h4>
    <?php
    } ?>
    <?php }else{
      ?>
      <h4 class="cart-empty">السلة فارغة</h4>
      <?php
      } ?>
  </tbody>
</table>
<div class="col-12 float-right billPrice">
    <h6>الحساب</h6>
    <p>اجمالي الخدمات : </p>
    <p class="bill-data"><?php 
    $alli = 1;foreach($allGigs as $allGig){
        if($alli == count($allGigs)){
            echo $allGig;
        }else{
            echo $allGig.'+';
        }
    $alli++;}
    ?> = $<?php echo $allGigsPrice; ?></p>
    <p>قيمة الاضافات : </p>
    <p class="bill-data"><?php 
    $alli2 = 1;foreach($gigsUp as $gigUp){
        if($alli2 == count($gigsUp)){
            echo $gigUp;
        }else{
            echo $gigUp.'+';
        }
    $alli2++;} ?> = $<?php echo $gigsUpPrice; ?></p>
    <p>المجموع الكلي : </p>
    <p class="bill-data"><?php echo '$'.$gigsUpPrice.' + $'.$allGigsPrice.' = $'.($gigsUpPrice+$allGigsPrice); ?></p>
    <h6 class="text-center"><?php echo '$'.($gigsUpPrice+$allGigsPrice); ?></h6>
    <div class="col-12 float-right text-center">
      <a style="margin-bottom:10px;border-radius:0px;" href="<?php echo base_url('users/purchase/?items='.$cart->i_ids); ?>" class="btn btn-success"><span class="fa fa-credit-card"></span> دفع</a>
    </div>
</div>
    </div>
</div>

<?php $this->load->view('include/footer.php'); ?>