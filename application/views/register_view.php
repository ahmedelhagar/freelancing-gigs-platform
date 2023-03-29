<?php $this->load->view('include/header.php');?>

<div class="container-fluid m_top">

    <?php

$atrr = array(

    'class' => 'col-lg-6 col-md-6 col-sm-12 register',

);

echo form_open(base_url() . 'pages/registerCheck', $atrr);

?>

    <span class="fa fa-user-plus"></span>
    <h3 class="acc-k">أريد تسجيل حساب <span>عادي</span></h3><br />

    <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button></div>'); ?>
    <div class="fb-btn">
        <!-- Display login button / Facebook profile information -->
        <?php if (!empty($authURL)) {?>
        <a href="<?php echo $authURL; ?>"><span class="fab fa-facebook"></span> الدخول بواسطة حساب الـ Facebook</a>
        <?php }?>
        <!-- Display login button / Google profile information -->
        <?php if (!empty($google_button)) {?>
        <a class="google-btn" href="<?php echo $google_button; ?>"><span class="fab fa-google"></span> الدخول بواسطة
            حساب GOOGLE</a>
        <?php }?>
    </div>
    <h5><code>جميع الحقول مطلوبة.</code></h5>

    <label>الاسم الأول</label><br />

    <?php

$f_name = array(

    'type' => 'text',

    'autocomplete' => 'off',

    'class' => 'form-control',

    'name' => 'firstname',

    'placeholder' => 'الأسم الأول',

);

echo form_input($f_name);

?>

    <label>الأسم الخير</label><br />

    <?php

$l_name = array(

    'type' => 'text',

    'autocomplete' => 'off',

    'class' => 'form-control',

    'name' => 'lastname',

    'placeholder' => 'الأسم الأخير',

);

echo form_input($l_name);

?>

    <label>اسم المستخدم</label><br />

    <?php

$u_name = array(

    'type' => 'text',

    'autocomplete' => 'off',

    'class' => 'form-control',

    'name' => 'username',

    'id' => 'user-nm',

    'placeholder' => 'اسم المستخدم',

);

echo form_input($u_name);

?>

    <label class="usernm"><?php echo base_url() . 'user/'; ?><span id="u-nm">username</span></label><br />

    <label>البريد الالكتروني</label><br />

    <?php

$email = array(

    'type' => 'email',

    'autocomplete' => 'off',

    'class' => 'form-control',

    'name' => 'email',

    'placeholder' => 'البريد الإلكتروني',

);

echo form_input($email);

?>

    <label>كلمة السر</label><br />

    <?php

$password = array(

    'type' => 'password',

    'autocomplete' => 'off',

    'class' => 'form-control',

    'name' => 'password',

    'placeholder' => '**********',

);

echo form_input($password);

?>

    <label>تأكيد كلمة السر</label><br />

    <?php

$passwordConf = array(

    'type' => 'password',

    'autocomplete' => 'off',

    'class' => 'form-control',

    'name' => 'passwordConf',

    'placeholder' => '**********',

);

echo form_input($passwordConf);

?>

    <label>الدولة</label><br />

    <?php

$ipadd = $this->input->ip_address();

$c_code = $this->main_model->ip_info($ipadd, "Country Code");

if ($c_code == '') {$c_code = 'EG';}

foreach ($countries as $country) {

    $counts[$country->code] = $country->country;

    echo '<input type="hidden" id="' . $country->code . '" value="' . $country->tel . '">';

}

echo form_dropdown(array('name' => 'country', 'id' => 'country'), $counts, $c_code);?>

    <br />



    <label>رقم الهاتف</label><br />

    <div class="col-auto">

        <label class="sr-only float-right" for="te">00000</label>

        <div class="input-group mb-2">

            <?php

$mobile = array(

    'type' => 'text',

    'autocomplete' => 'off',

    'class' => 'form-control',

    'name' => 'mobile',

    'id' => 'tel',

    'placeholder' => 'رقم الهاتف',

);

echo form_input($mobile);

?>

            <div class="input-group-prepend">

                <div class="input-group-text"><span id="telnum">

                        <?php

$telnum = $this->main_model->getByData('countries', 'code', $c_code);

echo $telnum[0]->tel;

?>

                    </span>+</div>

            </div>

        </div>

    </div>





    <label>العنوان</label><br />

    <?php

$address = array(

    'type' => 'text',

    'autocomplete' => 'off',

    'class' => 'form-control',

    'name' => 'address',

    'placeholder' => 'عنوانك',

);

echo form_input($address);

?>

    <label>الرقم البريدي</label><br />

    <?php

$postal = array(

    'type' => 'text',

    'autocomplete' => 'off',

    'class' => 'form-control',

    'name' => 'postal',

    'placeholder' => 'الرقم البريدي',

);

echo form_input($postal);

?>

    <br />

    <label>بتسجيلك في الموقع فأنت توافق على <a href="#">شروط الإستخدام</a> و <a href="#">سياسة
            الخصوصية</a>.</label><br /><br />

    <?php

$button = array(

    'type' => 'submit',

    'class' => 'btn btn-success regbtn',

    'name' => 'register',

    'content' => '

                <span class="fa fa-plus"></span>

                تسجيل

                ',

);

echo form_button($button);

?>

    <p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>

    <p>

        <a href="<?php echo base_url(); ?>login/">دخول</a> |

        <a href="<?php echo base_url() . 'pages/restPassword'; ?>">هل فقدت كلمة السر؟!</a>

    </p>

    <?php echo form_close(); ?>

    <div class="col-lg-6 col-md-6 col-sm-12 register-sb">

        <div class="col-lg-12 col-md-12 col-sm-12 register-s">

            <h3>تعليمات</h3>

            <ul>

                <li>يجب أن يتكون اسم المستخدم من حروف انجليزية وأن لايقل عن 10 حروف.</li>

                <li>يجب أن لاتقل كلمة السر عن 10 حروف.</li>

                <li>لن تستطيع التسجيل ببريد إلكتروني في أكثر من حساب.</li>

                <li>يجب أن يكون البريد الإلكتروني صحيح ليتم تأكيد الحساب من خلاله.</li>

                <li>لا تضع معلومات مزيفة حتى لايتم غلق حسابك.</li>

                <li>لكل شخص حساب واحد فقط.</li>

            </ul>

            <h3>مميزات التسجيل</h3>

            <ul>

                <li>عمولة الموقع 20% فقط.</li>

                <li>خصومات متجددة على كل المنتجات.</li>

                <li>منتجات عالية الجودة لأننا لا نوافق على أي مُنتج.</li>

            </ul>

        </div>

    </div>

</div>

<?php $this->load->view('include/footer.php');?>