<?php $this->load->view('include/header.php'); ?>
<script src="<?php echo base_url().'vendor/js/ckeditor.js'; ?>"></script>
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
                <h4 class="pt-10">إضافة مُنتج</h4>
                <?php 
                    $atrr2 = array(
                        'class' => 'col-lg-12 col-md-12 col-sm-12 float-right f-box',
                        'method' => 'post'
                    );
                    echo form_open_multipart(base_url().'users/insertProductCheck/',$atrr2);

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
                        تم إضافة المُنتج وسيتم إعلامك عند قبوله.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>';
                    }
                ?>
                
                <p class="a_rules text-center">يجب إدخال الحقول التي تحتوي على  <code>*</code>.</p>
                    <label class="float-right mb-0">عنوان المُنتج <code>*</code></label>
                
<?php
                        $title = array(
                            'type'=>'text',
                            'autocomplete'=>'off',
                            'class'=>'form-control text-right float-right',
                            'name'=>'title',
                            'placeholder'=>'عنوان المُنتج'
                        );
                if($this->uri->segment(2) == 'insertProductCheck' && isset($p_title)){
                    $title['value'] = $p_title;
                }
                                echo form_input($title);
?>
                <p class="a_rules">أدخل عنواناً واضحاً باللغة العربية يصف الخدمة التي تريد أن تقدمها. لا تدخل رموزاً أو كلمات مثل "حصرياً"، "لأول مرة"، "لفترة محدود".. الخ.</p>
                
                
                    <label class="float-right mb-0">وصف المُنتج <code>*</code></label>
<?php
                        $content = array(
                            'autocomplete'=>'off',
                            'class'=>'form-control text-right float-right',
                            'name'=>'content',
                            'placeholder'=>'اكتب هنا وصف كامل مع كل تفاصيل المُنتج.'
                        );
                if($this->uri->segment(2) == 'insertProductCheck' && isset($p_content)){
                    $content['value'] = $p_content;
                }
                                echo form_textarea($content);
?>
                <p class="a_rules">أدخل وصف الخدمة بدقة يتضمن جميع المعلومات والشروط . يمنع وضع البريد الالكتروني، رقم الهاتف أو أي معلومات اتصال أخرى.</p>
                
                
                    <label class="float-right mb-0">رابط الفيديو</label>
                
<?php
                        $ytlink = array(
                            'type'=>'text',
                            'autocomplete'=>'off',
                            'class'=>'form-control text-right float-right',
                            'name'=>'ytlink',
                            'placeholder'=>'رابط الفيديو'
                        );
                if($this->uri->segment(2) == 'insertProductCheck' && isset($p_ytlink)){
                    $ytlink['value'] = $p_ytlink;
                }
                                echo form_input($ytlink);
?>
                <p class="a_rules">رابط فيديو شرح المُنتج من على Youtube فقط - غير ضروري - .</p>
                
<label class="float-right mb-0">اختر تصنيف المُنتج <code>*</code></label>
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
                
                    <label class="float-right mb-0">سعر المُنتج بالدولار <code>*</code></label>
    <div class="col-auto float-right">
      <label class="sr-only float-right" for="te">00000</label>
      <div class="input-group mb-2">
<?php
                        $price = array(
                            'type'=>'number',
                            'autocomplete'=>'off',
                            'class'=>'form-control text-center float-right',
                            'name'=>'price',
                            'placeholder'=>'سعر المُنتج',
                            'id' => 'inlineFormInputGroup',
                            'min'=>1
                        );
          if($this->uri->segment(2) == 'insertProductCheck' && isset($p_price)){
                    $price['value'] = $p_price;
                }
                                echo form_input($price);
?>
<div class="input-group-prepend">
          <div class="input-group-text"><span id="telnum">
              <span class="fa fa-dollar-sign"></span>
              </span></div>
        </div>
      </div>
<p class="a_rules">أقل سعر مسموح به هو 1$.</p>
        <div class="ac_price">
            <div class="af_price">
                <h6>أرباحك بدون نظام التسويق بالعمولة</h6>
                <div id="af_price">
                    0$
                </div>
            </div>
            <div class="bf_price">
                <h6>أرباحك في نظام التسويق بالعمولة</h6>
                <div id="bf_price">
                    0$
                </div>
            </div>
        </div>
                <label class="float-right mb-0">اختر صور المُنتج <code>*</code></label>
<?php
                        $p_img1 = array(
                            'type'=>'file',
                            'class'=>'form-control',
                            'name'=>'img1',
                            'id'=>'p_img1'
                        );
                                echo '<div class="col-lg-12 col-md-12 col-sm-12 float-right">'.form_input($p_img1).'</div>';
?>
<?php
                        $p_img2 = array(
                            'type'=>'file',
                            'class'=>'form-control',
                            'name'=>'img2',
                            'id'=>'p_img2'
                        );
                                echo '<div class="col-lg-12 col-md-12 col-sm-12 float-right">'.form_input($p_img2).'</div>';
?>
<?php
                        $p_img3 = array(
                            'type'=>'file',
                            'class'=>'form-control',
                            'name'=>'img3',
                            'id'=>'p_img3'
                        );
                                echo '<div class="col-lg-12 col-md-12 col-sm-12 float-right">'.form_input($p_img3).'</div>';
?>
<?php
                        $p_img4 = array(
                            'type'=>'file',
                            'class'=>'form-control',
                            'name'=>'img4',
                            'id'=>'p_img4'
                        );
                                echo '<div class="col-lg-12 col-md-12 col-sm-12 float-right">'.form_input($p_img4).'</div>';
?>

                <div class="pc-imgholder" id="dropContainer1">
                    <label id="p_img_label1" for="p_img1">+ <span class="fa fa-image"></span></label>
                </div>
                <div class="pc-imgholder" id="dropContainer2">
                    <label id="p_img_label2" for="p_img2">+ <span class="fa fa-image"></span></label>
                </div>
                <div class="pc-imgholder" id="dropContainer3">
                    <label id="p_img_label3" for="p_img3">+ <span class="fa fa-image"></span></label>
                </div>
                <div class="pc-imgholder" id="dropContainer4">
                    <label id="p_img_label4" for="p_img4">+ <span class="fa fa-image"></span></label>
                </div>
                <p class="a_rules">الإمتدادات المسموحة JPG,PNG,JPEG.</p>
        
                <label class="float-right">اختر ملف المُنتج <code>*</code></label>
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
                            <span>اختر ملف المُنتج</span>
                            <span class="a_exts">الامتدادات المسموحة : ZIP,RAR,PDF,PNG,JPG</span>
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
        if($this->uri->segment(2) == 'insertProductCheck' && isset($p_tags)){
                    $tags['value'] = $p_tags;
                }
                                echo form_input($tags);
?>
                <p class="a_rules">مثال: تطوير مواقع, ووردبريس, تصميم.</p>
        
<div class="form-check col-lg-12 col-md-12 col-sm-12 float-right text-right">
<?php
                        $affiliate = array(
                            'type'=>'checkbox',
                            'class'=>'form-check-input',
                            'id'=>'Check1',
                            'name'=>'affiliate',
                            'value'=>'1'
                        );
                                echo form_input($affiliate);
?>
    <label class="form-check-label" for="Check1">أريد أن يتم التسويق لمُنتجي <a href="#">بنظام التسويق بالعمولة</a>.</label>
</div>
        
        <?php
                        $submit = array(
                            'type'=>'submit',
                            'autocomplete'=>'off',
                            'class'=>'btn btn-success regbtn a_productbtn',
                            'name'=>'submit'
                        );
                                echo form_button($submit,'<span class="fa fa-plus"></span> أضف المُنتج');
?>

<p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>
        
        
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    CKEDITOR.replace( 'content' , {
      extraPlugins: 'bidi',
      // Setting default language direction to right-to-left.
      contentsLangDirection: 'rtl',
        height: 270,
    });
</script>
<?php $this->load->view('include/footer.php'); ?>