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

        

        <div class="col-lg-12 col-md-12 col-sm-12 float-right box-s">
        <div class="col-lg-4 col-md-4 col-sm-12 my-th">

            <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 m-products <?php if($this->uri->segment(4) == '' && $this->uri->segment(5) == ''){echo 'active-user-tab';} ?>">

                    <span class="fa fa-list"></span>

                    مشاريعي

                </div>

            </a>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 my-th">

            <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username.'/done'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 m-projects <?php if($this->uri->segment(4) == 'done' && $this->uri->segment(5) == ''){echo 'active-user-tab';} ?>">

                    <span class="fa fa-check"></span>

                    تم تنفيذها

                </div>

            </a>

        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 my-th">

            <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username.'/wait'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 m-gigs <?php if($this->uri->segment(4) == 'wait' && $this->uri->segment(5) == ''){echo 'active-user-tab';} ?>">

                    <span class="fa fa-envelope"></span>

                    قيد التنفيذ

                </div>

            </a>

        </div>
        <?php 
            if($this->uri->segment(4) == 'wait' OR $this->uri->segment(4) == 'done'){
            ?>
            <div class="col-lg-4 col-md-4 col-sm-12 my-th">

            <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username.'/'.$this->uri->segment(4); ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 m-projects <?php if(($this->uri->segment(4) == 'wait' OR $this->uri->segment(4) == 'done') AND $this->uri->segment(5) == ''){echo 'active-user-tab';} ?>">

                    <span class="fa fa-envelope"></span>

                    الكل

                </div>

            </a>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 my-th">

                <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username.'/'.$this->uri->segment(4).'/mine'; ?>">

                    <div class="col-lg-12 col-md-12 col-sm-12 m-products <?php if(($this->uri->segment(4) == 'wait' OR $this->uri->segment(4) == 'done') AND $this->uri->segment(5) == 'mine'){echo 'active-user-tab';} ?>">

                        <span class="fa fa-allergies"></span>

                        مشاريع مشتراة

                    </div>

                </a>

            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 my-th">

                <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username.'/'.$this->uri->segment(4).'/work'; ?>">

                    <div class="col-lg-12 col-md-12 col-sm-12 m-gigs <?php if(($this->uri->segment(4) == 'wait' OR $this->uri->segment(4) == 'done') AND $this->uri->segment(5) == 'work'){echo 'active-user-tab';} ?>">

                        <span class="fa fa-cog"></span>

                        مشاريع أعمل عليها

                    </div>

                </a>

            </div>
            <?php
            }
            ?>
        <?php 
            if($this->uri->segment(4) == '' OR $this->uri->segment(4) == 'refused' OR $this->uri->segment(4) == 'active' OR $this->uri->segment(4) == 'waiting' OR $this->uri->segment(4) == 'bids'){
            ?>
            <div class="col-lg-3 col-md-3 col-sm-12 my-th">

                <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username.'/refused'; ?>">

                    <div class="col-lg-12 col-md-12 col-sm-12 m-products <?php if($this->uri->segment(4) == 'refused'){echo 'active-user-tab';} ?>">

                        <span class="fa fa-times"></span>

                        المرفوض

                    </div>

                </a>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 my-th">

                <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username.'/active'; ?>">

                    <div class="col-lg-12 col-md-12 col-sm-12 m-projects <?php if($this->uri->segment(4) == 'active'){echo 'active-user-tab';} ?>">

                        <span class="fa fa-check"></span>

                        المقبول

                    </div>

                </a>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 my-th">

                <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username.'/waiting'; ?>">

                    <div class="col-lg-12 col-md-12 col-sm-12 m-gigs <?php if($this->uri->segment(4) == 'waiting'){echo 'active-user-tab';} ?>">

                        <span class="fa fa-envelope"></span>

                        في الانتظار

                    </div>

                </a>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 my-th">

                <a href="<?php echo base_url().'users/projects/'.$userviewed[0]->username.'/bids'; ?>">

                    <div class="col-lg-12 col-md-12 col-sm-12 m-products <?php if($this->uri->segment(4) == 'bids'){echo 'active-user-tab';} ?>">

                        <span class="fa fa-heart"></span>

                        عروضي

                    </div>

                </a>

            </div>
            <?php
            }
        ?>
        <h3 class="projects">تصفح مشاريع <?php echo $userviewed[0]->firstname.' '.$userviewed[0]->lastname; ?></h3>

            <?php if($records){foreach($records as $project){ ?>

        <div class="col-lg-12 col-md-12 col-sm-12 project">

            <h4 class="project-title"><a href="<?php
if($project->for_user !== null){
    if($this->main_model->is_logged_in()){
        if($userviewed[0]->id == $userData['id'] OR $userData['id'] == $project->for_user){
                echo base_url().'i/'.str_replace(' ','-',$project->title).'/'.$project->id.'/';
        }
    }else{
        echo '#';
    }
}else{
    echo base_url().'i/'.str_replace(' ','-',$project->title).'/'.$project->id.'/';
}

                ?>"><?php
                if($project->for_user !== null){
                    if($this->main_model->is_logged_in()){
                        if($userviewed[0]->id == $userData['id'] OR $userData['id'] == $project->for_user){
                            echo $project->title;
                        }
                    }else{
                        echo 'مشروع خاص';
                    }
                    echo '<div class="private-pro">خاص</div>';
                }else{
                    echo $project->title;
                }
                ?></a></h4>

            <div class="project-snip"><span class="fa fa-clock"></span>

                منذ

                <?php

                $differ = $this->main_model->dateTime('diff',$project->date,$this->main_model->dateTime('current'));

                $this->main_model->differ($differ);

                ?>

                <?php

                $subCat = $this->main_model->getByData('categories','id',$project->tag_id);

                $mainCat = $this->main_model->getByData('categories','id',$subCat[0]->c_id);

                ?>

                | <span class="fa fa-tags"></span> قسم : <a href="#"><?php echo $mainCat[0]->category; ?></a> | <span class="fa fa-tag"></span> تصنيف : <a href="#"><?php echo $subCat[0]->category; ?></a></div>

            <div class="col-lg-12 col-md-12 col-sm-12 project-content">

            <?php
                if($project->for_user !== null){
                    if($this->main_model->is_logged_in()){
                        if($userviewed[0]->id == $userData['id'] OR $userData['id'] == $project->for_user){
                            echo preg_replace('!\s+!', ' ',mb_substr(strip_tags($project->content),0,150, "utf-8")).'...';
                        }
                    }else{
                        echo 'مشروع خاص';
                    }
                }else{
                    echo preg_replace('!\s+!', ' ',mb_substr(strip_tags($project->content),0,150, "utf-8")).'...';
                }
                ?>

            </div>

            <div class="budget">بميزانية

                <?php 

                    $budget = explode(',',$project->price);

                    if($budget[0] == $budget[1]){

                        echo $budget[0].' $';

                    }elseif($budget[0] > $budget[1]){

                        echo ' من '.$budget[1].' إلى '.$budget[0].' $';

                    }else{

                        echo ' من '.$budget[0].' إلى '.$budget[1].' $';

                    }

                ?></div>

        </div>

            <?php }}else{

                echo '<h3 class="no-data">لايوجد مشاريع لعرضها</h3>';

            } ?>

        </div>

        <!-- Pagination -->

      <ul class="pagination justify-content-center pager"><?php echo $links; ?></ul>

    </div>

    

</div>

<?php $this->load->view('include/footer.php'); ?>