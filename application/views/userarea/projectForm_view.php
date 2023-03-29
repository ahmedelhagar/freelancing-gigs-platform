<?php $this->load->view('include/header.php'); ?>

<div class="container-fluid m_top">

    <?php

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

        // Check if activated

        if($userState == 0){

            //Not Activated

                redirect(base_url().'activate/reactivate/');

        }

      ?>

    <br />

    

<?php $this->load->view('include/userSideBar_view.php'); ?>

    

    <div class="col-lg-8 col-md-8 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

            <div class="col-lg-12 col-md-12 col-sm-12 s_block">

                <h4 class="pt-10">إضافة مشروع</h4>

                <?php 

                    $atrr2 = array(

                        'class' => 'col-lg-12 col-md-12 col-sm-12 float-right f-box',

                        'method' => 'post'

                    );

                    $Puser_id = (int) strip_tags($this->uri->segment(3));
                    if($Puser_id == 0){
                        $Puser_id = '';
                    }
                    if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
                        $action = 'users/editProjectCheck/'.$item[0]->id;
                        $Puser_id = '';
                    }else{
                        $action = 'users/insertProjectCheck/';
                    }
                    echo form_open_multipart(base_url().$action.$Puser_id,$atrr2);

                if(isset($Puser_id) && $Puser_id > 0){
                    $pUser = $this->main_model->getByData('users','id',$Puser_id)[0];
?>
                <a href="<?php echo base_url('user/'.$pUser->username); ?>">
                        <div class="col-lg-12 col-md-12 col-sm-12 float-right chat-user">
                            <img src="<?php 
                                    if($pUser->oauth_provider == 'facebook'){
                                        echo $pUser->image;
                                    }else{
                                        if($pUser->image==''){
                
                                            echo base_url().'vendor/images/user.png';
                
                                            }else{
                
                                                echo base_url().'vendor/uploads/images/'.$pUser->image;
                
                                            }
                                    }
                                    ?>" />
                            <span><?php echo $pUser->firstname.' '.$pUser->lastname; ?></span>
                        </div>
                    </a>
<?php
                }
                    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button></div>');
                    if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
                        $stateMsg = 'تم تعديل المشروع وسيتم اعلامك عند قبوله.';
                    }else{
                        $stateMsg = 'تم إضافة المشروع وسيتم إعلامك عند قبوله.';
                    }
                    if(isset($error) && $error !== ''){

                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$error.

                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button></div>';

                    }elseif(isset($state) && $state !== ''){

                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$stateMsg.' <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button></div>';

                    }

                ?>

                

                <p class="a_rules text-center">يجب إدخال الحقول التي تحتوي على  <code>*</code>.</p>

                    <label class="float-right mb-0">عنوان المشروع <code>*</code></label>

                

<?php

                        $title = array(

                            'type'=>'text',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'title',

                            'placeholder'=>'عنوان المشروع'

                        );

                if($this->uri->segment(2) == 'insertProjectCheck' && isset($p_title)){

                    $title['value'] = $p_title;

                }
                if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
                    $title['value'] = $item[0]->title;
                }
                                echo form_input($title);

?>

                <p class="a_rules">أدخل عنواناً واضحاً باللغة العربية يصف المشروع التي تريد أن تقدمها. لا تدخل رموزاً أو كلمات مثل "حصرياً"، "لأول مرة"، "لفترة محدود".. الخ.</p>

                

                

                    <label class="float-right mb-0">وصف المشروع <code>*</code></label>

<?php

                        $content = array(

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'content',

                            'placeholder'=>'اكتب هنا وصف كامل مع كل تفاصيل المشروع.'

                        );

                if($this->uri->segment(2) == 'insertProjectCheck' && isset($p_content)){

                    $content['value'] = $p_content;

                }
                if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
                    $content['value'] = $item[0]->content;
                }
                                echo form_textarea($content);

?>

                <p class="a_rules">أدخل وصف المشروع بدقة يتضمن جميع المعلومات والشروط . يمنع وضع البريد الالكتروني، رقم الهاتف أو أي معلومات اتصال أخرى.</p>

                

                

<label class="float-right mb-0">اختر تصنيف المشروع <code>*</code></label>

<select class="form-control float-right" id="mtag" name="mtag">
    <option value="0">-- غير مُصنف --</option>
    <?php if (isset($mtags)) {foreach ($mtags as $mtag) {
        $selected = '';
        if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
        if($item_mtag[0]->id == $mtag->id){
            $selected = 'selected';
        }
    }
        ?>
    <option <?php echo $selected; ?> value="<?php echo $mtag->id; ?>"><?php echo $mtag->category; ?></option>
    <?php }} ?>
</select>
<div id="parent">
<?php if(isset($msubtag)){foreach($msubtag as $k_mtag => $a_stag){ ?>
    <div class="s-tags" id="<?php echo $k_mtag; ?>" <?php
    if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
        if($item_mtag[0]->id == $k_mtag){
            echo 'style="display:block;"';
        }
    }
        ?>>
        <label class="float-right mb-0">اختر تصنيف الصفحة الفرعي<code>*</code></label>
        <select class="form-control float-right" name="subtag_" id="subtag_">
            <option value="0">-- غير مُصنف --</option>
            <?php if ($a_stag) {foreach ($a_stag as $_stag) {
                $selected = '';
            if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
                if($item_subtag[0]->id == $_stag->id){
                    $selected = 'selected';
                }
            }
                ?>
                <option <?php echo $selected; ?> value="<?php echo $_stag->id; ?>"><?php echo $_stag->category; ?></option>
            <?php }}else{ ?>
                <option value="0">لا يوجد</option>
            <?php } ?>
        </select>
    </div>
<?php }} ?>
    </div>
<?php
                $subtag = array(
                            'type'=>'hidden',
                            'name'=>'subtag'
                        );
        if($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck'){
            $subtag['value'] = $item[0]->tag_id;
        }
                echo form_input($subtag);
        ?>

        <label class="float-right mb-0">ميزانية المشروع بالدولار <code>*</code></label>

        <select name="price" id="price-badget" class="form-control">
            <option <?php if(($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck') AND $item[0]->price == '25,50'){echo 'selected';} ?> value="25,50">25 - 50 دولار</option>
            <option <?php if(($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck') AND $item[0]->price == '50,100'){echo 'selected';} ?> value="50,100">50 - 100 دولار</option>
            <option <?php if(($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck') AND $item[0]->price == '100,250'){echo 'selected';} ?> value="100,250">100 - 250 دولار</option>
            <option <?php if(($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck') AND $item[0]->price == '250,500'){echo 'selected';} ?> value="250,500">250 - 500 دولار</option>
            <option <?php if(($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck') AND $item[0]->price == '500,1000'){echo 'selected';} ?> value="500,1000">500 - 1000 دولار</option>
            <option <?php if(($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck') AND $item[0]->price == '1000,2500'){echo 'selected';} ?> value="1000,2500">1000 - 2500 دولار</option>
            <option <?php if(($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck') AND $item[0]->price == '2500,5000'){echo 'selected';} ?> value="2500,5000">2500 - 5000 دولار</option>
            <option <?php if(($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck') AND $item[0]->price == '5000,10000'){echo 'selected';} ?> value="5000,10000">5000 - 10000 دولار</option>
        </select>
    <?php 
        $skills = $this->main_model->getFullRequest('skills','(state = 0) AND (u_id IS NULL)');
        if($skills){ ?>
        <label class="float-right mb-0">المهارات <code>*</code></label>
    <!-- Skills -->
    <select id="skills" name="skills[]" multiple>
    <?php foreach($skills as $skill){
          if(($this->uri->segment(2) == 'editProject' OR $this->uri->segment(2) == 'editProjectCheck') AND $item[0]->skills !== null){
              $editSkills = explode(',',$item[0]->skills);
              foreach($editSkills as $editSkill){
        ?>
        <option <?php if($editSkill == $skill->skill){echo 'selected';} ?> value="<?php echo $skill->skill; ?>"><?php echo $skill->skill; ?></option>
    <?php
              }
          }else{
    ?>
        <option value="<?php echo $skill->skill; ?>"><?php echo $skill->skill; ?></option>
    <?php }} ?>
    </select><br><br>
    <?php }
    ?>
    

    <label class="float-right mb-0">مدة التنفيذ <code>*</code></label>

    <div class="col-auto float-right">

      <label class="sr-only float-right" for="te">00000</label>

      <div class="input-group mb-2">

<?php

                        $duration = array(

                            'type'=>'number',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-center float-right',

                            'name'=>'duration',

                            'placeholder'=>'مدة التنفيذ',

                            'min'=>1

                        );

          if($this->uri->segment(2) == 'insertProjectCheck' && isset($p_duration)){

                    $duration['value'] = $p_duration;

                }
                if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
                    $duration['value'] = $item[0]->duration;
                }

                                echo form_input($duration);

?>

<div class="input-group-prepend">

          <div class="input-group-text"><span id="telnum">

              <span class="fa fa-clock"></span> يوم

              </span></div>

        </div>

      </div>

<p class="a_rules">اكتب عدد الأيام التي ستنفذ فيها المشروع.</p>

        

                     <label class="float-right">ارفق ملف <code>اختياري</code></label>

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

                        <span class="a_ext">

                            <span>اختر ملف أو قم بإدراجه هنا</span>

                            <span class="a_exts">الامتدادات المسموحة : ZIP,RAR,PDF,PNG,JPG</span>

                            <span class="a_exts">إذا أردت رفع أكثر من ملف فيمكنك رفع ملف مضغوط واحد.</span>

                        </span>

                    </label>

                </div>

        

        <label class="float-right mb-0">كلمات مفتاحية <code>*</code></label>

                

<?php

                        $tags = array(

                            'type'=>'text',

                            'autocomplete'=>'off',

                            'class'=>'form-control text-right float-right',

                            'name'=>'tags'

                        );

        if($this->uri->segment(2) == 'insertProjectCheck' && isset($p_tags)){

                    $tags['value'] = $p_tags;

                }
                if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
                    $tags['value'] = $item[0]->tags;
                }
                                echo form_input($tags);

?>

                <p class="a_rules">مثال: تطوير مواقع, ووردبريس, تصميم.</p>



        

        <?php

                        $submit = array(

                            'type'=>'submit',

                            'autocomplete'=>'off',

                            'class'=>'btn btn-success regbtn a_Projectbtn',

                            'name'=>'submit'

                        );
                        if ($this->uri->segment(2) == 'editProject' or $this->uri->segment(2) == 'editProjectCheck') {
                            echo form_button($submit,'<span class="fa fa-save"></span> حفظ');
                        }else{
                            echo form_button($submit,'<span class="fa fa-plus"></span> أضف المشروع');
                        }
?>



<p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>

        

        

                <?php echo form_close(); ?>

            </div>

        </div>

    </div>

</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"></link>
<script>
new SlimSelect({
    'placeholder': true, 
    placeholder: 'المهارات',
    select: '#skills'
})
</script>
<?php $this->load->view('include/footer.php'); ?>