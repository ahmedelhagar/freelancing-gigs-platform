<?php $this->load->view('include/header.php'); ?>

<div class="container-fluid m_top">

        <?php 

    $atrr = array(

    'class' => 'col-lg-4 col-md-4 col-sm-12 login'

    );

    echo form_open(base_url().'users/createUserNameCheck',$atrr);

    ?>

        <span class="fa fa-user"></span>

        <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">',

    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

    <span aria-hidden="true">&times;</span>

    </button></div>'); ?>

        <?php

        $username = array(

        'type'=>'text',

        'autocomplete'=>'off',

        'class'=>'form-control',

        'name'=>'username',

        'placeholder'=>'اسم المستخدم'

        );

            echo form_input($username);

        ?>

        <?php

        $button=array(

        'type'=>'submit',

        'class'=>'btn btn-success regbtn',

        'name'=>'login',

        'content'=>'

        <span class="fa fa-lock"></span>

        انشاء

        '

        );

        echo form_button($button);

        ?>

    <p><img class="f-loader" src="<?php echo base_url(); ?>vendor/images/loader.gif" /></p>

    <?php echo form_close(); ?>

</div>

<?php $this->load->view('include/footer.php'); ?>