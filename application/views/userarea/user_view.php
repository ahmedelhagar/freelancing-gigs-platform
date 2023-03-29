<?php $this->load->view('include/header.php'); ?>

<div class="container-fluid m_top">

    <?php

        $result = $this->main_model->is_logged_in(strip_tags($this->uri->segment(2)));

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

    // Access User Data From Url

                $c_userData = (array) $this->main_model->is_logged_in($this->uri->segment(2))[0];

      ?>

    <br />

    

<?php $this->load->view('include/userSideBar_view.php'); ?>

    

    <div class="col-lg-8 col-md-8 col-sm-12 s-pro">

        <?php if($this->main_model->is_logged_in() && $c_userData['id'] == $userId){ ?>

        <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

            <h4><a href="#">الرصيد</a></h4>

            <a href="<?php echo base_url().'users/payments/'; ?>">

                <div class="col-lg-6 col-md-6 col-sm-12 balance_block float-right">

                    <h4>الرصيد الكلي</h4>

                    <?php echo $userA_balance+$userAds_balance+$userBalance+$userC_balance; ?>$

                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 balance_block float-right black">

                    <h4>الرصيد القابل للسحب</h4>

                    <?php echo $userA_balance; ?>$

                </div>

            </a>

            <a href="<?php echo base_url().'users/payments/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 b_blocks float-right">

                    <div class="col-lg-6 col-md-6 col-sm-12 balance_block2 float-right">

                        الرصيد المتاح : <b><?php echo $userBalance+$userA_balance; ?>$</b>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 balance_block2 float-right">

                        الرصيد المعلق : <b><?php echo $userC_balance; ?>$</b>

                    </div>

                </div>

            </a>

        </div>

        </div>

        <?php } ?>

        <!--Item-->

        <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

            <h4>نبذة عني</h4>

            <div class="col-lg-12 col-md-12 col-sm-12 float-right">

                <span id="abo-txt"><?php
                    $links = array();
                    if($c_userData['about'] == ''){

                        echo 'لم يكتب نبذة شخصية بعد.';

                    }else{

                            $subTxt = mb_substr($c_userData['about'],0,160, "utf-8");

                            echo '<pre>'.$subTxt.'... </pre>';

                    }

                ?><br /> _____________________ <br /><span class="read-more">أكمل القراءة</span></span>

                <span id="allTxt"><?php

                    if($c_userData['about'] == ''){

                        echo 'لم يكتب نبذة شخصية بعد.';

                    }else{

                        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#',$c_userData['about'], $match);

                        foreach($match[0] as $link){

                            $linkCheck = $this->main_model->getByData('links','link',$link);

                            if($linkCheck && array_search($link, $match[0]) !== false){

                                $links[] = '<a target="_blank" href="'.base_url().'pages/go/?url='.base64_encode($link).'">'.$link.'</a>';

                            }elseif($linkCheck == false){

                                $this->main_model->insertData('links',array('link'=>$link,'views'=>0));

                                $links[] = '<a target="_blank" href="'.base_url().'pages/go/?url='.base64_encode($link).'">'.$link.'</a>';

                            }

                        }

                        echo '<pre>'.str_replace(array_unique($match[0]),array_unique($links),$c_userData['about']).'</pre>';

                    }

                ?><br /> _____________________ <br /><span class="hide-txt">إخفاء التفاصيل</span></span>

            </div>

        </div>

        </div>

        <!--Item-->

        <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s_block">

                        <h4>مهاراتي</h4>

                        <div class="col-lg-12 col-md-12 col-sm-12 float-right allSkills">

                                <!--Ajax Add Skills Here-->

                            <?php

                                $userSkills = $this->main_model->getFullRequest('skills','(u_id = '.$c_userData['id'].')');

                                if(!$userSkills){

                                    ?>

                            <h6>أنت لم تقم بإختيار مهارات بعد.</h6>

                            <?php

                                }else{



                            foreach($userSkills as $skill){

                                echo '<!--Skill--><div id="'.$skill->id.'_skill" class="u-skill"><div class="skill"><span class="fa fa-tag"></span> '.$skill->skill.' </div></div>';

                            }



                                } ?>

                        </div>

                    </div>

        </div>

    </div>

</div>

<?php $this->load->view('include/footer.php'); ?>