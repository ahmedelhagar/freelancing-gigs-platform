<script src="<?php echo base_url(); ?>vendor/js/ckeditor.js"></script>
<?php 
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
<!--Item-->
    <div class="col-lg-8 col-md-8 col-sm-12 float-right">
        <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere">
            <?php 
            if($this->main_model->is_admin_logged_in()){
            ?>
            <form action="<?php echo base_url('istsharhcadmin/addGdescCheck/'); ?>" method="post">
                <input type="text" name="title" class="form-control" style="border-radius:0px;" placeholder="عنوان الموضوع"><br>
                <textarea name="content" id="editor" class="form-control" style="border-radius:0px;" placeholder="اكتب المحتوى"></textarea><br>
                <input type="submit" class="btn btn-success regbtn" style="border-radius:0px;" value="ارسال" name="submit">
            </form>
            <?php
            }
            ?>
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