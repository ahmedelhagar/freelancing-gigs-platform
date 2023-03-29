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

                $userProvider = $userData['oauth_provider'];

            }

      ?>

    <div class="col-lg-12 col-md-12 col-sm-12 s-pro text-center">

        <div class="container-fluid">

            <!--Item-->

            <div class="col-lg-3 col-md-3 col-sm-12 s-pro">

                <div class="col-lg-12 col-md-12 col-sm-12 s_block settl">

                    <h4>إعدادات</h4>

                    <div class="a-link al-active"><a href="<?php echo base_url().'users/settings/'; ?>"><span class="fa fa-user"></span> الملف الشخصي</a></div>

                    <?php $minus = $this->main_model->getFullRequest('skills','( u_id = '.$userId.' )','1'); ?>

                    <div class="a-link"><a href="<?php echo base_url().'users/skills/'; ?>"><span class="fa fa-tasks"></span> مهاراتي <span class="minus"><span id="min-num2"><?php echo 20-$minus; ?></span> متبقية</span></a></div>

                </div>

            </div>

            <!--Item-->

            <div class="col-lg-9 col-md-9 col-sm-12 s-pro">

                <div class="col-lg-12 col-md-12 col-sm-12 s_block">

                    <?php 

                    $atrr2 = array(

                        'class' => 'col-lg-12 col-md-12 col-sm-12 float-right f-box',

                        'method' => 'post'

                    );

                    echo form_open_multipart(base_url().'users/settingsCheck/',$atrr2);



                    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button></div>');

                    if($error !== ''){

                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$error.

                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button></div>';

                    }

                    if(isset($state) && $state == 1){

                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">

                        تم تعديل البيانات بنجاح

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button></div>';

                    }

                ?>

                    

                    

    <label class="float-right mb-0">اسمك الأول</label>

<?php

                        $firstName = array(

                            'type'=>'text',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'firstname',

                            'placeholder'=>'اسمك الأول'

                        );

                    $firstName['value']=$userFirstname;

                                echo form_input($firstName);

?>

    <label class="float-right mb-0">اسمك الأخير</label>

<?php

                        $lastName = array(

                            'type'=>'text',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'lastname',

                            'placeholder'=>'اسمك الأخير أو العائلة'

                        );

                    $lastName['value']=$userLastname;

                                echo form_input($lastName);

?>
<?php if($userProvider !== 'facebook'){ ?>
    <label class="float-right mb-0">صورة ملفك الشخصي</label><br />

        

<?php

                        $image = array(

                            'type'=>'file',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'userfile',

                            'id'=>'userfile'

                        );

                                echo form_input($image).'<label for="userfile" />';

                                ?>

                                <div class="col-lg-3 col-md-3 col-sm-12 float-right file-img">

                                <img id="blah" class="user" src="<?php 
                    if($userProvider == 'facebook'){
                        echo $userImage;
                    }else{
                        if($userImage=='' OR $userProvider == 'google'){

                            echo base_url().'vendor/images/user.png';

                            }else{

                                echo base_url().'vendor/uploads/images/'.$userImage;

                            }
                    }
                    ?>" alt="<?php echo $userFirstname.' '.$userLastname; ?>" />

                                </div>

                                <?php

                                echo '<div class="col-lg-9 col-md-9 col-sm-12 float-right txxx"><span class="fa fa-upload"></span> <span class="selected-files">اختر صورة</span></div></label><br />';

?>

    <input type="hidden" value="<?php 
                    if($userProvider == 'facebook'){
                        echo $userImage;
                    }else{
                        if($userImage=='' OR $userProvider == 'google'){

                            echo base_url().'vendor/images/user.png';

                            }else{

                                echo base_url().'vendor/uploads/images/'.$userImage;

                            }
                    }
                    ?>" id="img-name">
<?php }else{echo '<h3>لتغيير صورة حسابك قم بتغييرها في Facebook</h3>';} ?>
    <label class="float-right mb-0">نبذة عنك</label>

<?php

                        $about = array(

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'about',

                            'placeholder'=>'اكتب هنا نبذة شخصية تصف فيها نفسك'

                        );

                                echo form_textarea($about,$userAbout);

?>

    <label class="float-right mb-0">الدولة</label><br />

        <?php

        $ipadd = $this->input->ip_address();

        $c_code = $this->main_model->ip_info($ipadd, "Country Code");

        if($c_code == ''){$c_code='EG';}

        foreach($countries as $country){

            $counts[$country->code] = $country->country;

            echo '<input type="hidden" id="'.$country->code.'" value="'.$country->tel.'">';

        }
        if(!isset($userCountry)){
            $userCountry = $c_code;
        }
        echo form_dropdown(array('name'=>'country','id'=>'country','class'=>'form-control'),$counts,$userCountry); ?>





    <label class="float-right mb-0">رقم هاتفك</label>

    <div class="col-auto">

      <label class="sr-only float-right" for="te">00000</label>

      <div class="input-group mb-2">

<?php

                        $mobile = array(

                            'type'=>'text',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'mobile',

                            'placeholder'=>'رقم هاتفك'

                        );

                    $mobile['value']=$userMobile;

                                echo form_input($mobile);

?>

                    <div class="input-group-prepend">

          <div class="input-group-text"><span id="telnum">

              <?php

                  $telnum = $this->main_model->getByData('countries','code',$userCountry);

                  echo $telnum[0]->tel;

              ?>

              </span>+</div>

        </div>

      </div>

    </div>

                    

    <label class="float-right mb-0">عنوانك</label>

<?php

                        $address = array(

                            'type'=>'text',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'address',

                            'placeholder'=>'عنوانك'

                        );

                    $address['value']=$userAddress;

                                echo form_input($address);

?>

    <label class="float-right mb-0">الرقم البريدي</label>

<?php

                        $postal = array(

                            'type'=>'text',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'postal',

                            'placeholder'=>'الرقم البريدي'

                        );

                    $postal['value']=$userPostal;

                                echo form_input($postal);

?>

<?php

                        $submit = array(

                            'type'=>'submit',

                            'autocomplete'=>'off',

                            'class'=>'btn btn-success regbtn',

                            'name'=>'submit'

                        );

                                echo form_button($submit,'<span class="fa fa-save"></span> حفظ');

?>



<p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>

                    <?php echo form_close(); ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $this->load->view('include/footer.php'); ?>