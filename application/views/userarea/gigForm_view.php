<?php $this->load->view('include/header.php');?>

<script src="<?php echo base_url() . 'vendor/js/ckeditor.js'; ?>"></script>

<div class="container-fluid m_top">

    <?php

if ($this->main_model->is_logged_in()) {

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

if ($userState == 0) {

    //Not Activated

    redirect(base_url() . 'activate/reactivate/');

}

?>

    <br />



<?php $this->load->view('include/userSideBar_view.php');?>



    <div class="col-lg-8 col-md-8 col-sm-12 s-pro">

        <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

            <div class="col-lg-12 col-md-12 col-sm-12 s_block">

                <h4 class="pt-10">إضافة خدمة</h4>

                <?php

$atrr2 = array(

    'class' => 'col-lg-12 col-md-12 col-sm-12 float-right f-box',

    'method' => 'post',

);
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    $action = 'users/editGigCheck/'.$item[0]->id;
}else{
    $action = 'users/insertGigCheck/';
}

echo form_open_multipart(base_url() . $action, $atrr2);

echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button></div>');

if (isset($error) && $error !== '') {

    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $error .

        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button></div>';

} elseif (isset($state) && $state !== '') {

    if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
        $doneState = 'تم تعديل الخدمة بنجاح';
    }else{
        $doneState = 'تم إضافة الخدمة وسيتم اعلامك عند قبولها';
    }
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'.$doneState.'<button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                    </button></div>';

}

?>



                <p class="a_rules text-center">يجب إدخال الحقول التي تحتوي على  <code>*</code>.</p>

                    <label class="float-right mb-0">عنوان الخدمة <code>*</code></label>



<?php

$title = array(

    'type' => 'text',

    'autocomplete' => 'off',

    'class' => 'form-control text-right float-right',

    'name' => 'title',

    'placeholder' => 'عنوان الخدمة',

);

if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_title)) {

    $title['value'] = $p_title;

}
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    $title['value'] = $item[0]->title;
}
echo form_input($title);

?>

                <p class="a_rules">أدخل عنواناً واضحاً باللغة العربية يصف الخدمة التي تريد أن تقدمها. لا تدخل رموزاً أو كلمات مثل "حصرياً"، "لأول مرة"، "لفترة محدود".. الخ.</p>





                    <label class="float-right mb-0">وصف الخدمة <code>*</code></label>

<?php

$content = array(

    'autocomplete' => 'off',

    'class' => 'form-control text-right float-right',

    'name' => 'content',

    'placeholder' => 'اكتب هنا وصف كامل مع كل تفاصيل الخدمة.',

);

if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_content)) {

    $content['value'] = $p_content;

}
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    $content['value'] = $item[0]->content;
}

echo form_textarea($content);

?>

                <p class="a_rules">أدخل وصف الخدمة بدقة يتضمن جميع المعلومات والشروط . يمنع وضع البريد الالكتروني، رقم الهاتف أو أي معلومات اتصال أخرى.</p>





                    <label class="float-right mb-0">رابط الفيديو</label>



<?php

$ytlink = array(

    'type' => 'text',

    'autocomplete' => 'off',

    'class' => 'form-control text-right float-right',

    'name' => 'ytlink',

    'placeholder' => 'رابط الفيديو',

);

if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_ytlink)) {

    $ytlink['value'] = $p_ytlink;

}
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    $ytlink['value'] = $item[0]->ytlink;
}

echo form_input($ytlink);

?>

                <p class="a_rules">رابط فيديو شرح الخدمة من على Youtube فقط - غير ضروري - .</p>



<label class="float-right mb-0">اختر تصنيف الخدمة <code>*</code></label>

<select class="form-control float-right" id="mtag" name="mtag">
    <option value="0">-- غير مُصنف --</option>
    <?php if (isset($mtags)) {foreach ($mtags as $mtag) {
        $selected = '';
        if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
        if($item_mtag[0]->id == $mtag->id){
            $selected = 'selected';
        }
    }
        ?>
    <option <?php echo $selected; ?> value="<?php echo $mtag->id; ?>"><?php echo $mtag->category; ?></option>
    <?php }}?>
</select>
<div id="parent">
<?php if (isset($msubtag)) {foreach ($msubtag as $k_mtag => $a_stag) {?>
    <div class="s-tags" id="<?php echo $k_mtag; ?>" <?php
    if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
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
            if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
                if($item_subtag[0]->id == $_stag->id){
                    $selected = 'selected';
                }
            }
                ?>
                <option <?php echo $selected; ?> value="<?php echo $_stag->id; ?>"><?php echo $_stag->category; ?></option>
            <?php }} else {?>
                <option value="0">لا يوجد</option>
            <?php }?>
        </select>
    </div>
<?php }}?>
    </div>
<?php
$subtag = array(
    'type' => 'hidden',
    'name' => 'subtag',
);
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    $subtag['value'] = $item[0]->tag_id;
}
echo form_input($subtag);
?>



<label class="float-right mb-0">سعر الخدمة بالدولار <code>*</code></label>

    <div class="col-auto float-right">

      <label class="sr-only float-right" for="te">00000</label>

      <div class="input-group mb-2">

<?php

$price = array(

    'type' => 'number',

    'autocomplete' => 'off',

    'class' => 'form-control text-center float-right',

    'name' => 'price',

    'placeholder' => 'سعر الخدمة',

    'id' => 'inlineFormInputGroup',

    'min' => 1,

);

if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_price)) {

    $price['value'] = $p_price;

}
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    $price['value'] = $item[0]->price;
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

                <h6>أرباحك بعد سحب عمولة الموقع</h6>

                <div id="af_price">
<?php
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    echo round(($item[0]->price-($item[0]->price*0.15)),2);
}else{
    echo '0';
}
?>$

                </div>

            </div>

        </div>

                <label class="float-right mb-0">اختر صور الخدمة <code>*</code></label>

<?php

$p_img1 = array(

    'type' => 'file',

    'class' => 'form-control',

    'name' => 'img1',

    'id' => 'p_img1',

);

echo '<div class="col-lg-12 col-md-12 col-sm-12 float-right">' . form_input($p_img1) . '</div>';

?>
<input type="hidden" name="img_input1" id="img_input1">
<?php

$p_img2 = array(

    'type' => 'file',

    'class' => 'form-control',

    'name' => 'img2',

    'id' => 'p_img2',

);

echo '<div class="col-lg-12 col-md-12 col-sm-12 float-right">' . form_input($p_img2) . '</div>';

?>
<input type="hidden" name="img_input2" id="img_input2">
<?php

$p_img3 = array(

    'type' => 'file',

    'class' => 'form-control',

    'name' => 'img3',

    'id' => 'p_img3',

);

echo '<div class="col-lg-12 col-md-12 col-sm-12 float-right">' . form_input($p_img3) . '</div>';

?>
<input type="hidden" name="img_input3" id="img_input3">
<?php

$p_img4 = array(

    'type' => 'file',

    'class' => 'form-control',

    'name' => 'img4',

    'id' => 'p_img4',

);

echo '<div class="col-lg-12 col-md-12 col-sm-12 float-right">' . form_input($p_img4) . '</div>';

?>
<input type="hidden" name="img_input4" id="img_input4">

<?php
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    $images = explode(',',$item[0]->images);
    $i = 1;
    foreach($images as $image){
?>
<div class="pc-imgholder" id="dropContainer<?php echo $i; ?>">

<label class="p_img_label<?php echo $i; ?>" for="p_img<?php echo $i; ?>"><div class="pc-img"><img src="<?php echo base_url('vendor/uploads/images/'.$image); ?>"></div></label>

</div>
<?php
    $i++;}
    
    $counter = count($images)+1;
    while($counter <= 4){
?>
<div class="pc-imgholder" id="dropContainer<?php echo $counter; ?>">

<label id="p_img_label<?php echo $counter; ?>" for="p_img<?php echo $counter; ?>">+ <span class="fa fa-image"></span></label>

</div>
<?php
    $counter++;}
}else{
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
<?php
}
?>

                <p class="a_rules">الإمتدادات المسموحة JPG,PNG,JPEG.</p>



    <label class="float-right mb-0">مدة التنفيذ <code>*</code></label>

    <div class="col-auto float-right">

      <label class="sr-only float-right" for="te">00000</label>

      <div class="input-group mb-2">

<?php

$duration = array(

    'type' => 'number',

    'autocomplete' => 'off',

    'class' => 'form-control text-center float-right',

    'name' => 'duration',

    'placeholder' => 'مدة التنفيذ',

    'min' => 1,

);

if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_duration)) {

    $duration['value'] = $p_duration;

}
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
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

<p class="a_rules">اكتب عدد الأيام التي ستنفذ فيها الخدمة.</p>



        <label class="float-right mb-0">كلمات مفتاحية <code>*</code></label>



<?php

$tags = array(

    'type' => 'text',

    'autocomplete' => 'off',

    'class' => 'form-control text-right float-right',

    'name' => 'tags',

);

if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_tags)) {

    $tags['value'] = $p_tags;

}
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    $tags['value'] = $item[0]->tags;
}
echo form_input($tags);

?>

                <p class="a_rules">مثال: تطوير مواقع, ووردبريس, تصميم.</p>
                <?php
if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    $i = 1;
    if($item_gus){
    $item_gus_content = explode(', ',$item_gus[0]->content);
    $item_gus_prices = explode(', ',$item_gus[0]->amount);
    $item_gus_days = explode(', ',$item_gus[0]->days);
    foreach($item_gus_prices as $item_gus_price){
?>
<div class="container-fluid float-right gigUpdate" style="display:block;" id="gu<?php echo $i; ?>">
                <label class="float-right mb-0">عنوان الاضافة <?php echo $i; ?></label>
                <?php

    $guTitle = array(

        'type' => 'text',

        'autocomplete' => 'off',

        'class' => 'form-control text-right float-right',

        'name' => 'guTitle' . $i,
        'value' => $item_gus_content[$i-1]

    );

    if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_guTitle)) {

        $guTitle['value'] = $p_guTitle;

    }

    echo form_input($guTitle);

    ?>

                    <p class="a_rules">أقوم لك بعمل اضافي ....</p>

                    <label class="float-right mb-0">سعر الاضافة <?php echo $i; ?></label>

                        <div class="col-12 float-right">

                    <label class="sr-only float-right" for="te">00000</label>

                    <div class="input-group mb-2">

                    <?php

    $guPrice = array(

        'type' => 'number',

        'autocomplete' => 'off',

        'class' => 'form-control text-center float-right',

        'name' => 'guPrice' . $i,

        'placeholder' => 'سعر الاضافة ' . $i,

        'id' => 'inlineFormInputGroup',

        'min' => 1,
        'value' => $item_gus_prices[$i-1]

    );

    if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_guPrice)) {

        $guPrice['value'] = $p_guPrice;

    }

    echo form_input($guPrice);

    ?>

                    <div class="input-group-prepend">

                        <div class="input-group-text"><span id="telnum">

                            <span class="fa fa-dollar-sign"></span>

                            </span></div>

                    </div>

                    </div>

                    <p class="a_rules">أقل سعر مسموح به هو 1$.</p>
                    <label class="float-right mb-0">مدة تنفيذ الاضافة <?php echo $i; ?></label>

    <div class="col-12 float-right">

      <label class="sr-only float-right" for="te">00000</label>

      <div class="input-group mb-2">

<?php

    $guDuration = array(

        'type' => 'number',

        'autocomplete' => 'off',

        'class' => 'form-control text-center float-right',

        'name' => 'guDuration' . $i,

        'placeholder' => 'مدة التنفيذ',

        'min' => 1,
        'value' => $item_gus_days[$i-1]

    );

    if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_guDuration)) {

        $guDuration['value'] = $p_guDuration;

    }

    echo form_input($guDuration);

    ?>

<div class="input-group-prepend">

          <div class="input-group-text"><span id="telnum">

              <span class="fa fa-clock"></span> يوم

              </span></div>

        </div>

</div>
<p class="a_rules">اكتب عدد الأيام التي ستنفذ فيها الخدمة.</p>
</div>
</div>

                </div>
<?php
    $i++;}}else{
        $item_gus_content = array();
        $item_gus_prices = array();
        $item_gus_days = array();
    }
?>
<?php $i = count($item_gus_prices)+1;while ($i <= 5) { ?>
                <div class="container-fluid float-right gigUpdate" id="gu<?php echo $i; ?>">
                <label class="float-right mb-0">عنوان الاضافة <?php echo $i; ?></label>
                <?php

    $guTitle = array(

        'type' => 'text',

        'autocomplete' => 'off',

        'class' => 'form-control text-right float-right',

        'name' => 'guTitle' . $i,

    );

    if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_guTitle)) {

        $guTitle['value'] = $p_guTitle;

    }

    echo form_input($guTitle);

    ?>

                    <p class="a_rules">أقوم لك بعمل اضافي ....</p>

                    <label class="float-right mb-0">سعر الاضافة <?php echo $i; ?></label>

                        <div class="col-12 float-right">

                    <label class="sr-only float-right" for="te">00000</label>

                    <div class="input-group mb-2">

                    <?php

    $guPrice = array(

        'type' => 'number',

        'autocomplete' => 'off',

        'class' => 'form-control text-center float-right',

        'name' => 'guPrice' . $i,

        'placeholder' => 'سعر الاضافة ' . $i,

        'id' => 'inlineFormInputGroup',

        'min' => 1,

    );

    if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_guPrice)) {

        $guPrice['value'] = $p_guPrice;

    }

    echo form_input($guPrice);

    ?>

                    <div class="input-group-prepend">

                        <div class="input-group-text"><span id="telnum">

                            <span class="fa fa-dollar-sign"></span>

                            </span></div>

                    </div>

                    </div>

                    <p class="a_rules">أقل سعر مسموح به هو 1$.</p>
                    <label class="float-right mb-0">مدة تنفيذ الاضافة <?php echo $i; ?></label>

    <div class="col-12 float-right">

      <label class="sr-only float-right" for="te">00000</label>

      <div class="input-group mb-2">

<?php

    $guDuration = array(

        'type' => 'number',

        'autocomplete' => 'off',

        'class' => 'form-control text-center float-right',

        'name' => 'guDuration' . $i,

        'placeholder' => 'مدة التنفيذ',

        'min' => 1,

    );

    if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_guDuration)) {

        $guDuration['value'] = $p_guDuration;

    }

    echo form_input($guDuration);

    ?>

<div class="input-group-prepend">

          <div class="input-group-text"><span id="telnum">

              <span class="fa fa-clock"></span> يوم

              </span></div>

        </div>

</div>
<p class="a_rules">اكتب عدد الأيام التي ستنفذ فيها الخدمة.</p>
</div>
</div>

                </div>
                <?php $i++;} ?>
<?php
}else{
?>
<?php $i = 1;while ($i <= 5) { ?>
                <div class="container-fluid float-right gigUpdate" id="gu<?php echo $i; ?>">
                <label class="float-right mb-0">عنوان الاضافة <?php echo $i; ?></label>
                <?php

    $guTitle = array(

        'type' => 'text',

        'autocomplete' => 'off',

        'class' => 'form-control text-right float-right',

        'name' => 'guTitle' . $i,

    );

    if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_guTitle)) {

        $guTitle['value'] = $p_guTitle;

    }

    echo form_input($guTitle);

    ?>

                    <p class="a_rules">أقوم لك بعمل اضافي ....</p>

                    <label class="float-right mb-0">سعر الاضافة <?php echo $i; ?></label>

                        <div class="col-12 float-right">

                    <label class="sr-only float-right" for="te">00000</label>

                    <div class="input-group mb-2">

                    <?php

    $guPrice = array(

        'type' => 'number',

        'autocomplete' => 'off',

        'class' => 'form-control text-center float-right',

        'name' => 'guPrice' . $i,

        'placeholder' => 'سعر الاضافة ' . $i,

        'id' => 'inlineFormInputGroup',

        'min' => 1,

    );

    if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_guPrice)) {

        $guPrice['value'] = $p_guPrice;

    }

    echo form_input($guPrice);

    ?>

                    <div class="input-group-prepend">

                        <div class="input-group-text"><span id="telnum">

                            <span class="fa fa-dollar-sign"></span>

                            </span></div>

                    </div>

                    </div>

                    <p class="a_rules">أقل سعر مسموح به هو 1$.</p>
                    <label class="float-right mb-0">مدة تنفيذ الاضافة <?php echo $i; ?></label>

    <div class="col-12 float-right">

      <label class="sr-only float-right" for="te">00000</label>

      <div class="input-group mb-2">

<?php

    $guDuration = array(

        'type' => 'number',

        'autocomplete' => 'off',

        'class' => 'form-control text-center float-right',

        'name' => 'guDuration' . $i,

        'placeholder' => 'مدة التنفيذ',

        'min' => 1,

    );

    if ($this->uri->segment(2) == 'insertGigCheck' && isset($p_guDuration)) {

        $guDuration['value'] = $p_guDuration;

    }

    echo form_input($guDuration);

    ?>

<div class="input-group-prepend">

          <div class="input-group-text"><span id="telnum">

              <span class="fa fa-clock"></span> يوم

              </span></div>

        </div>

</div>
<p class="a_rules">اكتب عدد الأيام التي ستنفذ فيها الخدمة.</p>
</div>
</div>

                </div>
                <?php $i++;}}?>
        <?php if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') { ?>
        <div class="gigUplus" id="gigUplus<?php echo count($item_gus_prices); ?>">
            <span class="fa fa-plus"></span>
            <p>أضف تطوير للخدمة</p>
        </div>
        <?php }else{ ?>
        <div class="gigUplus" id="gigUplus0">
            <span class="fa fa-plus"></span>
            <p>أضف تطوير للخدمة</p>
        </div>
        <?php } ?>
        <?php

$submit = array(

    'type' => 'submit',

    'autocomplete' => 'off',

    'class' => 'btn btn-success regbtn a_Gigbtn',

    'name' => 'submit',

);


if ($this->uri->segment(2) == 'editGig' or $this->uri->segment(2) == 'editGigCheck') {
    echo form_button($submit, '<span class="fa fa-save"></span> حفظ');
}else{
    echo form_button($submit, '<span class="fa fa-plus"></span> أضف الخدمة');
}

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

<?php $this->load->view('include/footer.php');?>