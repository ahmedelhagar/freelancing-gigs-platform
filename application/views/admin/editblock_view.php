<?php $this->load->view('admin/include/userSideBar_view'); ?>
<div class="col-lg-8 col-md-8 col-sm-12 text-center float-right" style="background:#fff;">
    <h3 class="text-center">تعديل</h3>
<?php 
                    $atrr2 = array(
                        'class' => 'col-lg-12 col-md-12 col-sm-12 float-right f-box',
                        'method' => 'post'
                    );
                        $mCheck = 'editBlockCheck/'.$this->uri->segment(3);
                    echo form_open_multipart(base_url().'istsharhcadmin/'.$mCheck.'/',$atrr2);

                    echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>');
                    if(isset($error) && $error !== ''){
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$error.
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>';
                    }elseif($this->uri->segment(4) == 'done'){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        تم التعديل بنجاح.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>';
                    }
                ?>

                <p class="a_rules text-center">يجب إدخال الحقول التي تحتوي على <code>*</code>.</p>
                <label class="float-right mb-0">العنوان <code>*</code></label>

                <?php
                        $title = array(
                            'type'=>'text',
                            'autocomplete'=>'off',
                            'class'=>'form-control text-right float-right',
                            'name'=>'title',
                            'placeholder'=>'العنوان',
                            'value'=>$page[0]->title
                        );
                                echo form_input($title);
?>
                
                <label class="float-right mb-0">المحتوى<code>*</code></label>
                <?php
                        $content = array(
                            'type'=>'text',
                            'autocomplete'=>'off',
                            'class'=>'form-control text-right float-right',
                            'name'=>'content',
                            'placeholder'=>'الجملة المختصرك',
                            'value'=>$page[0]->content
                        );
                                echo form_input($content);
?>
<label class="float-right mb-0">الرابط<code>*</code></label>
                <?php
                        $link = array(
                            'type'=>'text',
                            'autocomplete'=>'off',
                            'class'=>'form-control text-right float-right',
                            'name'=>'link',
                            'placeholder'=>'الرابط',
                            'value'=>$page[0]->link
                        );
                                echo form_input($link);
?>
    <br />
    <div class="container-fluid float-right" style="padding: 10px;text-align: center;">
                        <?php
                        $submit = array(
                            'type'=>'submit',
                            'autocomplete'=>'off',
                            'class'=>'regbtn a_Gigbtn',
                            'style'=>'float:none !important;',
                            'name'=>'submit'
                        );
                           echo form_button($submit,'<span class="fa fa-save"></span> حفظ');
?>

                        <p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>
    </div>

                        <?php echo form_close(); ?>
</div>
<script>
        CKEDITOR.replace('content', {
            extraPlugins: 'bidi',
            // Setting default language direction to right-to-left.
            contentsLangDirection: 'rtl',
            height: 400,
        });

    </script>