<?php $this->load->view('admin/include/header.php'); ?>
<?php $this->load->view('admin/include/userSideBar_view.php'); ?>
<script src="<?php echo base_url().'vendor/js/ckeditor.js'; ?>"></script>
<div class="col-lg-8 col-md-8 col-sm-12 float-right allUsers">
<div class="col-lg-12 col-md-12 col-sm-12 float-right allUsers">
    <br />
    <div class="container-fluid float-right">
    <?php
        if($mtags){ ?>
        <div class="col-lg-6 col-md-6 col-sm-12 float-right tags-block">
        <h3 class="tags-bti" id="b1">أقسام الموقع</h3>
        <?php foreach($mtags as $main){
            $sub = $this->main_model->getByData('categories','c_id',$main->id);
    ?>
        <div class="col-lg-12 col-md-12 col-sm-12 float-right tags-blocks b1">
            <h3><?php echo $main->category; ?> <a class="del-link" href="<?php echo base_url().'istsharhcadmin/delete/categories/'.$main->id.'/?m=istsharhcadmin/addTag'; ?>"><span class="fa fa-trash"></span> حذف</a></h3>
            <ul>
                <?php if($sub){foreach($sub as $subtag){ ?>
                <li><?php echo $subtag->category; ?> <a class="del-link" href="<?php echo base_url().'istsharhcadmin/delete/categories/'.$subtag->id.'/?m=istsharhcadmin/addTag'; ?>"><span class="fa fa-trash"></span> حذف</a></li>
                <?php }} ?>
            </ul>
        </div>
    <?php
        }}
    ?>
    </div>
    </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro register">
        <div class="col-lg-12 col-md-12 col-sm-12 s-pro">
            <div class="col-lg-12 col-md-12 col-sm-12 s_block">
                <h4 class="pt-10">إضافة تصنيف</h4>
                <?php 
                    $atrr2 = array(
                        'class' => 'col-lg-12 col-md-12 col-sm-12 float-right f-box',
                        'method' => 'post'
                    );
                    echo form_open_multipart(base_url().'istsharhcadmin/addTagCheck/',$atrr2);

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
                        تم إضافة التصنيف بنجاح.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>';
                    }
                ?>
                
                <p class="a_rules text-center">يجب إدخال الحقول التي تحتوي على <code>*</code>.</p>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right">
                    <?php
                    $hidden = array(
                    'type'=>'hidden',
                    'name'=>'cat',
                    'value'=>'0'
                    );
                        echo form_input($hidden);
                    ?>
                </div>
                <div id="events">
                    <label class="float-right mb-0">تحت تصنيف <code>*</code></label>
                    <select class="float-right" name="events">
                        <?php if($mtags){foreach($mtags as $mtag){ ?>
                        <option value="<?php echo $mtag->id; ?>"><?php echo $mtag->category; ?></option>
                        <?php }}else{ ?>
                        <option value="0">لايوجد</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right">
                    <div class="col-lg-6 col-md-6 col-sm-12 float-right r-type type-active" id="0">
                        <p>تصنيف</p>
                        <p>أساسي</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 float-right r-type" id="1">
                        <p>تصنيف</p>
                        <p>فرعي</p>
                    </div>
                </div>
                <?php
                    $hidden = array(
                    'type'=>'hidden',
                    'name'=>'type',
                    'value'=>'0'
                    );
                        echo form_input($hidden);
                    ?>
                <div id="c_name">
                    <label class="float-right mb-0">تحت تصنيف <code>*</code></label>
                    <select class="float-right" name="events">
                        <?php if($mtags){foreach($mtags as $mtag){ ?>
                        <option value="<?php echo $mtag->id; ?>"><?php echo $mtag->category; ?></option>
                        <?php }}else{ ?>
                        <option value="0">لايوجد</option>
                        <?php } ?>
                    </select>
                </div>
                <label class="float-right mb-0">اسم التصنيف <code>*</code></label>
                <?php 
                    $tag = array(
                        'type' => 'text',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'tag',
                        'placeholder'=>'اسم التصنيف'
                    );
                echo form_input($tag);
                ?>
                <label class="float-right mb-0">الايقونة <code dir="ltr">class="XX XX-XXXX"</code></label>
                <?php 
                    $icon = array(
                        'type' => 'text',
                        'autocomplete'=>'off',
                        'class'=>'form-control text-right float-right',
                        'name'=>'icon',
                        'placeholder'=>'XX XX-XXXX'
                    );
                echo form_input($icon);
                ?><br>
                <a class="col-12 float-right" href="https://fontawesome.com/icons" target="_blank">الايقونات</a>
                        <?php
                        $submit = array(
                            'type'=>'submit',
                            'autocomplete'=>'off',
                            'class'=>'regbtn a_Gigbtn',
                            'name'=>'submit'
                        );
                                echo form_button($submit,'<span class="fa fa-plus"></span> أضف التصنيف');
?>

                        <p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>


                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            </div>
            </div>
    <script>
        CKEDITOR.replace('content', {
            extraPlugins: 'bidi',
            // Setting default language direction to right-to-left.
            contentsLangDirection: 'rtl',
            height: 270,
        });

    </script>
    <?php $this->load->view('admin/include/footer.php'); ?>
