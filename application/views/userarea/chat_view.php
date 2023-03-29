<?php $this->load->view('include/header.php');
if($this->session->flashdata('done')){
    echo '<div class="alert alert-success alert-dismissible fade show flash-data" role="alert">'.$this->session->flashdata('done').'<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';
}elseif($this->session->flashdata('error')){
    echo '<div class="alert alert-danger alert-dismissible fade show flash-data" role="alert">'.$this->session->flashdata('error').'<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';
}
?>

<div class="container-fluid m_top">
    <?php $this->load->view('include/userSideBar_view.php'); ?>
    <div class="col-lg-8 col-md-8 col-sm-12 s-pro">
        <div class="container-fluid s_block chat-con">
        <div class="col-lg-4 col-md-4 col-sm-12 float-right px-0">
            <div class="col-lg-12 col-md-12 col-sm-12 float-right chat-users">
                <div class="col-lg-12 col-md-12 col-sm-12 float-right chat-tabs">
                    <div class="col-lg-6 col-md-6 col-sm-12 float-right chat-tab chat-active" id="forUsers">
                        <span class="fa fa-comments"></span>
                        المحادثات
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 float-right chat-tab" id="forAlerts">
                        <span class="fa fa-bell"></span>
                        الإعلامات
                    </div>
                </div>
                    
                <div class="col-lg-12 col-md-12 col-sm-12 float-right tab-con">
                
                <?php if($users){foreach($users as $user){ ?>
                    <a href="<?php echo base_url('users/chat/'.$user->id); ?>">
                        <div class="col-lg-12 col-md-12 col-sm-12 float-right chat-user">
                            <img src="<?php 
                                    if($user->oauth_provider == 'facebook'){
                                        echo $user->image;
                                    }else{
                                        if($user->image==''){
                
                                            echo base_url().'vendor/images/user.png';
                
                                            }else{
                
                                                echo base_url().'vendor/uploads/images/'.$user->image;
                
                                            }
                                    }
                                    ?>" />
                            <span><?php echo $user->firstname.' '.$user->lastname; ?></span>
                        </div>
                    </a>
                <?php }}else{
                    echo '<h4>لا يوجد قنوات تواصل بعد.</h4>';
                } ?>
                </div>
            </div>
            <?php if(strip_tags($this->uri->segment(3))){ ?>
            <div class="col-lg-12 col-md-12 col-sm-12 float-right" id="uploader-ajax-con">
                    <h3>المرفقات</h3>
                        <!-- Progress bar -->
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <!-- Display upload status -->
                        <div id="uploadStatus"></div>
                        <!-- File upload form -->
                        <form id="uploadForm" method="POST" enctype="multipart/form-data">
                            <?php

                                                $file = array(

                                                    'type'=>'file',

                                                    'class'=>'form-control',

                                                    'name'=>'file',

                                                    'id'=>'p_file'

                                                );

                                                        echo '<div class="col-lg-12 col-md-12 col-sm-12 float-right">'.form_input($file).'</div>';

                        ?>

                                        <div class="pc-file" id="dropContainer">

                                            <label id="pc_file" for="p_file"><span class="fa fa-upload"></span>

                                                <span class="a_ext" style="max-width:200px;">

                                                    <span>اختر ملف أو قم بإدراجه هنا</span>

                                                    <span class="a_exts">ZIP,RAR,PDF,PNG,JPG</span>

                                                </span>

                                            </label>

                                        </div>
                            <input type="submit" name="submit" id="upload-btn" class="col-12 float-right chat-tab" value="ارسال"/>
                        </form>
                        <div class="col-12 float-right tab-con-files">
                            <?php if($files){foreach($files as $file){ ?>
                            <div class="file-con">
                                <p>
                                    <a href="<?php echo $file->link; ?>"><?php echo $file->client_name; ?></a>
                                </p><p class="file-date"><?php echo $file->date; ?></p>
                            </div>
                            <?php }}else{
                                echo '<h3>لايوجد مرفقات بعد</h3>';
                            } ?>
                        </div>
                </div>
                <?php } ?>
                </div>
            
                <div class="col-lg-8 col-md-8 col-sm-12 float-right chat-msgs">
                <div class="col-lg-12 col-md-12 col-sm-12 float-right chatMsgs">
                    <?php if($messages && $this->uri->segment(3)){foreach($messages as $message){ ?>
                        <div class="chatMsg <?php if($message->f_id == $this->session->userdata('id')){echo 'fromMe';} ?><?php if($message->state == 1){echo ' stateMsg';} ?>">
                            <?php
                                if($message->state == 1 && $message->to_id == $this->session->userdata('id')){
                                    $currentUserChat = $this->main_model->getByData('users','id',$message->f_id)[0];
                                    $toMsg = 'مرحبا ...  لقد قام <a href="'.base_url('user/'.$currentUserChat->username).'" target="_blank">'.$currentUserChat->username.'</a> بشراء خدمتك التالية ';
                                    echo str_replace('مرحباً ... أنا قمت بشراء الخدمة التالية ',$toMsg,$message->message);
                                }else{
                                    echo str_replace('يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة','يجب مراسلة البائع حتى يستطيع البدء بتنفيذ الخدمة',$message->message);
                                }
                                ?>
                        </div>
                        <div class="msg-date <?php if($message->f_id == $id){echo 'fromMeMsg';} ?>">
                                منذ

                                <?php

                                $differ = $this->main_model->dateTime('diff',$message->date,$this->main_model->dateTime('current'));

                                $this->main_model->differ($differ);

                                ?>
                            </div>
                    <?php }}elseif(!$messages && $this->uri->segment(3)){ ?>
                        <h3>لايوجد رسائل بعد.</h3>
                    <?php }else{ ?>
                        <h3>برجاء اختيار محادثة.</h3>
                    <?php } ?>
                </div>
                <?php if($this->uri->segment(3)){ ?>
                    <form action="#" method="post">
                        <textarea name="message" id="message" placeholder="اكتب رسالتك هنا ...."></textarea>
                        <input type="hidden" value="<?php echo $cto_id[0]->id; ?>" id="c_id">
                        <input type="hidden" value="<?php echo $id; ?>" id="u_id">
                        <?php
                            if($cto_id[0]->s_id == $id){
                                $toId = $cto_id[0]->u_id;
                            }else{
                                $toId = $cto_id[0]->s_id;
                            }
                        ?>
                        <div id="send" onClick="sendMsg(<?php echo $id; ?>,<?php echo $toId; ?>,<?php echo $cto_id[0]->id; ?>);">
                            <span class="fa fa-paper-plane"></span>
                            <p>ارسال</p>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('include/footer.php'); ?>