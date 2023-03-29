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
                <h4 class="pt-10">إضافة تدوينة</h4>
                <?php 
                    $atrr2 = array(
                        'class' => 'col-lg-12 col-md-12 col-sm-12 float-right f-box',
                        'method' => 'post'
                    );
                    echo form_open_multipart(base_url().'users/insertPostCheck/',$atrr2);

                    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>');
                    if(isset($error) && $error !== ''){
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$error.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>';
                    }elseif(isset($state) && $state !== ''){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        تم إضافة التدوينة.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>';
                    }
                ?>
                
                <p class="a_rules text-center">يجب إدخال الحقول التي تحتوي على  <code>*</code>.</p>
                    <label class="float-right mb-0">عنوان التدوينة <code>*</code></label>
                
<?php
                        $title = array(
                            'type'=>'text',
                            'autocomplete'=>'off',
                            'class'=>'form-control text-right float-right',
                            'name'=>'title',
                            'placeholder'=>'عنوان التدوينة'
                        );
                if($this->uri->segment(2) == 'insertPostCheck' && isset($p_title)){
                    $title['value'] = $p_title;
                }
                                echo form_input($title);
?>
                <p class="a_rules">أدخل عنواناً واضحاً باللغة العربية يصف التدوينة التي تريد أن تقدمها. لا تدخل رموزاً أو كلمات مثل "حصرياً"، "لأول مرة"، "لفترة محدود".. الخ.</p>
                
                
                    <label class="float-right mb-0">ملاحظات إضافية</label>
<?php
                        $content = array(
                            'autocomplete'=>'off',
                            'class'=>'form-control text-right float-right',
                            'name'=>'content',
                            'placeholder'=>'اكتب هنا ملاحظاتك.'
                        );
                if($this->uri->segment(2) == 'insertPostCheck' && isset($p_content)){
                    $content['value'] = $p_content;
                }
                                echo form_textarea($content);
?>
                <p class="a_rules">أدخل أي ملاحظات تود إرفاقها لنا.</p>
                
                
<label class="float-right mb-0">اختر تصنيف التدوينة <code>*</code></label>
<select class="form-control float-right" name="category">
    <option value="0">-- غير مُصنف --</option>
<?php
    $mainCategories = $this->main_model->getByData('categories','state',0);
    foreach($mainCategories as $m_cat){
        $subCats = $this->main_model->getByData('categories','c_id',$m_cat->id);
        ?>
          <optgroup label="<?php echo $m_cat->category; ?>">
              <?php foreach($subCats as $subCat){ ?>
            <option value="<?php echo $subCat->id; ?>"><?php echo $subCat->category; ?></option>
              <?php } ?>
          </optgroup>
<?php
    }
?>
        </select>
                 <label class="float-right">ارفق ملف التدوينة<code>*</code></label>
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
                            <span class="a_exts">الامتدادات المسموحة : ZIP,RAR,DOCX</span>
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
        if($this->uri->segment(2) == 'insertPostCheck' && isset($p_tags)){
                    $tags['value'] = $p_tags;
                }
                                echo form_input($tags);
?>
                <p class="a_rules">مثال: تطوير مواقع, ووردبريس, تصميم.</p>

        
        <?php
                        $submit = array(
                            'type'=>'submit',
                            'autocomplete'=>'off',
                            'class'=>'btn btn-success regbtn a_Postbtn',
                            'name'=>'submit'
                        );
                                echo form_button($submit,'<span class="fa fa-plus"></span> أضف التدوينة');
?>

<p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>
        
        
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer.php'); ?>