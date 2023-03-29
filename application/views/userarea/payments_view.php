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

        

        <!-- Button trigger modal -->

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">

          شحن رصيد

        </button>



        <!-- Modal -->

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog text-center" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <h5 class="modal-title text-center" id="exampleModalLabel">شحن رصيدك</h5>

                <button type="button" class="close mx-0" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

<?php 

    $atrr = array(

        'class' => 'col-lg-12 col-md-12 col-sm-12 float-right',

        'method' => 'post'

    );

    echo form_open(base_url().'payment/process',$atrr);

                

    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button></div>');

?>

              <div class="modal-body">

                  

                    <div class="col-auto">

                      <label class="sr-only float-right" for="inlineFormInputGroup">0</label>

                      <div class="input-group mb-2">

<?php

                        $amount = array(

                            'type'=>'number',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-center float-right',

                            'name'=>'amount',

                            'id'=>'inlineFormInputGroup',

                            'placeholder'=>'0',

                            'min'=>10

                            );

                                echo form_input($amount);

?>

                          <div class="input-group-prepend">

                          <div class="input-group-text">$</div>

                        </div>

                      </div>

                    </div>

                      <h6>* المبلغ النهائي بعد اضافة رسوم إجرائية بنسبة 2.75% على عملية الدفع</h6>

                      <div class="f-pay">0$</div>

                      <code>أقل مبلغ يمكنك شحنه هو 10$.</code>

                  

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>

<?php

                        $submit = array(

                            'type'=>'submit',

                            'class'=>'btn btn-primary',

                            'name'=>'submit'

                            );

                                echo form_button($submit,'شحن');

?>

              </div>

        <?php echo form_close(); ?>

            </div>

          </div>

        </div>

        

        

        <!-- Button trigger modal -->

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">

          سحب رصيد

        </button>



        <!-- Modal -->

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog text-center" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <h5 class="modal-title text-center" id="exampleModalLabel">سحب رصيدك</h5>

                <button type="button" class="close float-left mx-0" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

              <?php 

    $atrr = array(

        'class' => 'col-lg-12 col-md-12 col-sm-12 float-right',

        'method' => 'post'

    );

    echo form_open(base_url().'users/withdraw',$atrr);

                

    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button></div>');

?>

              <div class="modal-body">

                  

                    <div class="col-auto">

                      <label class="sr-only float-right" for="inlineFormInputGroup">0</label>

                      <div class="input-group mb-2">

                            <?php

                                                    $amount = array(

                                                        'type'=>'number',

                                                        'autocomplete'=>'off',

                                                        'class'=>'form-control text-center float-right',

                                                        'name'=>'amount',

                                                        'id'=>'inlineFormInputGroup',

                                                        'placeholder'=>'0',

                                                        'min'=>10

                                                        );

                                                            echo form_input($amount);

                            ?>

                        <div class="input-group-prepend">

                          <div class="input-group-text">$</div>

                        </div>

                      </div>

                    </div>
                    <div class="col-auto">

<label class="sr-only float-right" for="inlineFormInputGroup">0</label>

<div class="input-group mb-2">

      <?php

                              $email = array(

                                  'type'=>'email',

                                  'autocomplete'=>'off',

                                  'class'=>'form-control text-center float-right',

                                  'name'=>'email',
                                  'style'=> 'direction: ltr;',
                                  'id'=>'inlineFormInputGroup',

                                  'placeholder'=>'بريدك في PAYPAL'

                                  );

                                      echo form_input($email);

      ?>

  <div class="input-group-prepend">

    <div class="input-group-text">@</div>

  </div>

</div>

</div>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>

<?php

                        $submit = array(

                            'type'=>'submit',

                            'class'=>'btn btn-primary',

                            'name'=>'submit'

                            );

                                echo form_button($submit,'سحب');

?>

              </div>

        <?php echo form_close(); ?>

            </div>

          </div>

        </div>

        <div class="container-fluid">

            <!--Item-->

            <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

                <div class="col-lg-12 col-md-12 col-sm-12 s_block">

                    <h4>الرصيد</h4>

                        <div class="col-lg-6 col-md-6 col-sm-12 balance_block float-right">

                            <h4>الرصيد الكلي</h4>

                            <?php echo $userA_balance+$userAds_balance+$userBalance+$userC_balance; ?>$

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 balance_block float-right black">

                            <h4>الرصيد القابل للسحب</h4>

                            <?php echo $userA_balance; ?>$

                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 b_blocks float-right">

                            <div class="col-lg-6 col-md-6 col-sm-12 balance_block2 float-right">

                                الرصيد المتاح : <b><?php echo $userBalance+$userA_balance; ?>$</b>

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 balance_block2 float-right">

                                الرصيد المعلق : <b><?php echo $userC_balance; ?>$</b>

                            </div>

                        </div>

                </div>

            </div>



            <!--Item-->

            <div class="col-lg-6 col-md-6 col-sm-10 float-right">
            <h4 class="float-right">السحب</h4>
              <?php if($requested){foreach ($requested as $request) { ?>
                  <div class="col-lg-12 col-md-12 col-sm-12 s_block" style="margin-top:20px !important;">

                      <h4>عملية سحب برقم <b><?php echo $request->id; ?></b></h4>

                      <b><?php echo $request->amount; ?>$</b>
                      عن طريق PAYPAL
                      باستخدام بريد <b><?php echo $request->email; ?></b>
                      بتاريخ <?php echo $request->date; ?>
                      الحالة :
                      <b><?php if($request->state == 1){echo 'تمت بنجاح';}else{echo 'في انتظار التأكيد ....';} ?></b>
                  </div>
              <?php }} ?>
            <h4 class="float-right">الايداع</h4>
              <?php if($payments){foreach ($payments as $payment) { ?>
                  <div class="col-lg-12 col-md-12 col-sm-12 s_block" style="margin-top:20px !important;">

                      <h4>عملية ايداع برقم <b><?php echo $payment->id; ?></b></h4>

                      <b><?php echo $payment->clearAmount; ?>$</b>
                      ايداع PAYPAL
                      بتاريخ <?php echo $payment->date; ?>
                  </div>
              <?php }} ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-10 float-right">
            <h4 class="float-right">المشاريع</h4>
              <?php if($projects){foreach ($projects as $project){
              $item = $this->main_model->getByData('items','id',$project->i_id)[0];
              $bid = $this->main_model->getByData('bids','id',$item->bid_id)[0];
              if($item){if($bid){
              ?>
                  <div class="col-lg-12 col-md-12 col-sm-12 s_block" style="margin-top:20px !important;">

                      <h4>عملية <?php
                      if($project->s_id == $userId){
                        echo 'دفع';
                      }else{
                        echo 'ربح';
                      }
                      ?> برقم <b><?php echo $project->id; ?></b></h4>

                      <b><?php 
                      echo $bid->amount;
                      ?>$</b>
                      المشروع <a href="<?php echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/'; ?>"><?php echo $item->title; ?></a>
                  </div>
              <?php }}}} ?>
              <h4 class="float-right">الخدمات</h4>
              <?php if($gigs){foreach ($gigs as $gig){
                  $item = $this->main_model->getByData('items','id',$gig->i_id)[0];
                  if($item){
              ?>
                  <div class="col-lg-12 col-md-12 col-sm-12 s_block" style="margin-top:20px !important;">

                      <h4>عملية <?php
                      if($gig->s_id == $userId){
                        echo 'ربح';
                      }else{
                        echo 'دفع';
                      }
                      ?> برقم <b><?php echo $gig->id; ?></b></h4>

                      <b><?php 
                      echo $gig->amount;
                      ?>$</b>
                      المشروع <a href="<?php echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/'; ?>"><?php echo $item->title; ?></a>
                  </div>
              <?php }}} ?>
            </div>

            

        </div>

        

    </div>

</div>

<?php $this->load->view('include/footer.php'); ?>