<?php $this->load->view('admin/include/userSideBar_view.php'); ?>
<script src="<?php echo base_url(); ?>vendor/js/ckeditor.js"></script>
<div class="container-fluid allUsers col-lg-8 col-md-8 col-sm-12 float-right">
    <br />
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro register" style="margin-top:0px;padding:0px !important;">
        <div class="col-lg-12 col-md-12 col-sm-12 s-pro" style="margin-top:0px;padding:0px !important;">
            <div class="col-lg-12 col-md-12 col-sm-12 s_block">
                <h4 class="pt-10">الإعدادات</h4>
                <?php 
                    $atrr2 = array(
                        'class' => 'col-lg-12 col-md-12 col-sm-12 float-right f-box',
                        'method' => 'post'
                    );
                    echo form_open_multipart(base_url().'istsharhcadmin/appsCheck/',$atrr2);

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
                        تم التعديل بنجاح.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>';
                    }
                ?>
                <p class="a_rules text-center">يجب إدخال الحقول التي تحتوي على * أو أدخل علامة #.</p>
                <label class="float-right mb-0">رابط Facebook <code>*</code></label>
                <?php 
                    $facebook = array(
                        'type' => 'text',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'facebook',
                        'value'=> $settings['facebook'],
                        'placeholder'=>'رابط Facebook'
                    );
                echo form_input($facebook);
                ?>
                <label class="float-right mb-0">رابط Twitter <code>*</code></label>
                <?php 
                    $twitter = array(
                        'type' => 'text',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'twitter',
                        'value'=> $settings['twitter'],
                        'placeholder'=>'رابط Twitter'
                    );
                echo form_input($twitter);
                ?>
                <label class="float-right mb-0">رابط Instagram <code>*</code></label>
                <?php 
                    $instagram = array(
                        'type' => 'text',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'instagram',
                        'value'=> $settings['instagram'],
                        'placeholder'=>'رابط Instagram'
                    );
                echo form_input($instagram);
                ?>
                <select name="show" class="form-control">
                    <option value="1"<?php if($settings['show_state'] == 1){echo ' selected';} ?>>اظهار وسائل التواصل</option>
                    <option value="0"<?php if($settings['show_state'] == 0){echo ' selected';} ?>>اخفاء وسائل التواصل</option>
                </select>
                <label class="float-right mb-0">البريد <code>*</code></label>
                <?php 
                    $email = array(
                        'type' => 'text',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'email',
                        'value'=> $settings['email'],
                        'placeholder'=>'E-Mail'
                    );
                echo form_input($email);
                ?>
                <label class="float-right mb-0">ايقونة الموقع <code>*</code></label>
                <?php 
                    $icon = array(
                        'type' => 'text',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'icon',
                        'value'=> $settings['icon'],
                        'placeholder'=>'https://xxxxx/'
                    );
                echo form_input($icon);
                ?>
                <label class="float-right mb-0">شعار الموقع <code>*</code></label>
                <?php 
                    $logo = array(
                        'type' => 'text',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'logo',
                        'value'=> $settings['logo'],
                        'placeholder'=>'https://xxxxx/'
                    );
                echo form_input($logo);
                ?>
                <label class="float-right mb-0">عمولة الموقع بالـ % <code>*</code></label>
                <?php 
                    $percent = array(
                        'type' => 'number',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'percent',
                        'min'=>0,
                        'value'=> $settings['percent'],
                        'placeholder'=>'0'
                    );
                echo form_input($percent);
                ?>
                <label class="float-right mb-0">مدة تعليق الرصيد <code>*</code></label>
                <?php 
                    $pause = array(
                        'type' => 'number',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'pause',
                        'min'=>0,
                        'max'=>28,
                        'value'=> $settings['pause'],
                        'placeholder'=>'0'
                    );
                echo form_input($pause);
                ?>
                <label class="float-right mb-0">قالب الرسائل <code>*</code></label>
                <textarea class="template" name="template"><?php echo $this->main_model->template(); ?></textarea>
                <label class="float-right mb-0">شيفرات الـ HEAD <code>*</code></label>
                <textarea name="head" class="form-control" dir="ltr" placeholder="أكواد html"><?php echo $settings['head']; ?></textarea>
                <label class="float-right mb-0">الخدمات المختارة <code>اتركها فارغة لتخفيها</code></label>
                <select class="col-12 float-right" name="gigs[]" id="slim-select" multiple>
                    <?php $gigs = $this->main_model->getFullRequest('items','(kind = 1) AND (state = 1)');
                        if($gigs){foreach($gigs as $gig){
                            $eGigs = explode(',',$settings['gigs']);
                       ?>
                       <option <?php if($gig->id == $eGigs[array_search($gig->id,$eGigs)]){echo 'selected';} ?> value="<?php echo $gig->id; ?>"><?php echo $gig->title; ?></option>
                    <?php
                        }}
                    ?>
                </select><br>
                <label class="float-right mb-0">المشاريع المختارة <code>اتركها فارغة لتخفيها</code></label>
                <select class="col-12 float-right" name="projects[]" id="slim-select2" multiple>
                    <?php $projects = $this->main_model->getFullRequest('items','(kind = 2) AND (state = 1)');
                        if($projects){foreach($projects as $project){
                            $eprojects = explode(',',$settings['projects']);
                       ?>
                       <option <?php if($project->id == $eprojects[array_search($project->id,$eprojects)]){echo 'selected';} ?> value="<?php echo $project->id; ?>"><?php echo $project->title; ?></option>
                    <?php
                        }}
                    ?>
                </select><br>
                <label class="float-right mb-0">شيفرات الـ BODY <code>*</code></label>
                <textarea name="body" class="form-control" dir="ltr" placeholder="أكواد html"><?php echo $settings['body']; ?></textarea>
                
                        <?php
                        $submit = array(
                            'type'=>'submit',
                            'autocomplete'=>'off',
                            'class'=>'regbtn a_Gigbtn',
                            'name'=>'submit'
                        );
                                echo form_button($submit,'<span class="fa fa-save"></span> تعديل');
?>

                        <p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>


                        <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"></link>
<script>
    CKEDITOR.replace( 'template' , {
    extraPlugins: 'bidi',
    // Setting default language direction to right-to-left.
    contentsLangDirection: 'rtl',
        height: 270,
    });
    new SlimSelect({
  select: '#slim-select'
})
new SlimSelect({
  select: '#slim-select2'
})
</script>