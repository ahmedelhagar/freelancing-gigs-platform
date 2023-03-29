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
        <div class="container-fluid">
            <!--Item-->
            <div class="col-lg-3 col-md-3 col-sm-12 s-pro">
                <div class="col-lg-12 col-md-12 col-sm-12 s_block settl">
                    <h4>إعدادات</h4>
                    <div class="a-link"><a href="<?php echo base_url().'users/settings/'; ?>"><span class="fa fa-user"></span> الملف الشخصي</a></div>
                    <?php $minus = $this->main_model->getFullRequest('skills','( u_id = '.$userId.' )','1'); ?>
                    <div class="a-link al-active"><a href="<?php echo base_url().'users/skills/'; ?>"><span class="fa fa-tasks"></span> مهاراتي <span class="minus"><span id="min-num2"><?php echo 20-$minus; ?></span> متبقية</span></a></div>
                </div>
            </div>
            <!--Item-->
            <div class="col-lg-9 col-md-9 col-sm-12 s-pro">
                <div class="col-lg-12 col-md-12 col-sm-12 s_block">
                    <?php echo form_open('#',array('class' => 'col-lg-12 col-md-12 col-sm-12 f-box')); ?>
                            <label class="float-right mb-0">اكتب مهاراتك</label>
<?php
                            $skills = array(
                                'type'=>'text',
                                'autocomplete'=>'off',
                                'class'=>'form-control text-right float-right skillsInput mb-0',
                                'name'=>'skills',
                                'id'=>'skills',
                                'placeholder'=>'اكتب مهاراتك هنا'
                            );
                                    echo form_input($skills);
?>
                        <div class="col-lg-12 col-md-12 col-sm-12 float-right searchResult">
                            <ul class="searchitems" id="searchitems">
                                <span class="s-empty"><b>لايوجد نتيجة مشابهة للمكتوب في الحقل</b></span>
                            </ul>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 s_block">
                            <h4>مهاراتي <span class="minus">تبقى لديك <span id="min-num"><?php echo 20-$minus; ?></span> مهارة</span></h4>
                            <div class="col-lg-12 col-md-12 col-sm-12 float-right allSkills">
                                    <!--Ajax Add Skills Here-->
                                <?php
                                    $userSkills = $this->main_model->getFullRequest('skills','(u_id = '.$userId.')');
                                    if(!$userSkills){
                                        ?>
                                <h6>أنت لم تقم بإختيار مهارات بعد.</h6>
                                <?php
                                    }else{
                                        
                                foreach($userSkills as $skill){
                                    echo '<!--Skill--><div id="'.$skill->id.'_skill" class="u-skill"><div class="skill"><span class="fa fa-tag"></span> '.$skill->skill.' <span onClick="return delSkill('.$skill->id.')" class="fa fa-times delSkill"></span></div></div>';
                                }
                                    
                                    } ?>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer.php'); ?>