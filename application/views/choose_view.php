<?php if($this->main_model->is_admin_logged_in()){
    $this->load->view('admin/include/header.php');
}else{
    $this->load->view('include/header.php');
} ?>
<div class="container-fluid m_top">
    <!--Item-->
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">
    <h4 class="text-center">كيف يعمل الموقع؟</h4>

        <div class="col-lg-6 col-md-6 col-sm-12 my-th">

            <a href="<?php echo base_url().'pages/descPro'; ?>">

            <div class="col-lg-12 col-md-12 col-sm-12 m-projects">

                    <span class="fa fa-list"></span>

                    شرح المشاريع

                </div>

            </a>

            </div>

        <div class="col-lg-6 col-md-6 col-sm-12 my-th">

            <a href="<?php echo base_url().'pages/descGigs'; ?>">

            <div class="col-lg-12 col-md-12 col-sm-12 m-products">

                    <span class="fa fa-list"></span>

                    شرح الخدمات

            </div>

            </a>

        </div>

    </div>
</div>
<?php if($this->main_model->is_admin_logged_in()){
    $this->load->view('admin/include/footer.php');
}else{
    $this->load->view('include/footer.php');
} ?>