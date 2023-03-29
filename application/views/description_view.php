<?php if($this->main_model->is_admin_logged_in()){
    $this->load->view('admin/include/header.php');
}else{
    $this->load->view('include/header.php');
} ?>
<div class="container-fluid m_top">
    <!--Item-->
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">
    <h4 class="text-center">كيف يعمل الموقع؟</h4>
        <div class="col-lg-12 col-md-12 col-sm-12 float-right">
        <?php if($this->main_model->is_admin_logged_in()){ ?>
            <a class="btn btn-success" style="border-radius:0px;margin-bottom:15px;" href="<?php
                if($this->uri->segment(2) == 'descGigs'){
                    echo base_url('istsharhcadmin/addPdesc');
                }else{echo base_url('istsharhcadmin/addGdesc');}
                ?>">أضف عنصر جديد</a>
        <?php } ?>
            <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere">
                <h5><?php if($this->uri->segment(2) == 'descGigs'){echo 'شرح الخدمات';}else{echo 'شرح المشاريع';} ?></h5>
                <?php if($items){foreach($items as $item){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere-item commer">
                    <h6>
                        <a href="<?php echo base_url().'pages/desc/'.$item->id; ?>">
                            <?php echo $item->title; ?>
                        </a>
                    </h6>
                    <p><?php echo mb_substr(strip_tags($item->content),0,150, "utf-8").'...'; ?></p>
                    <div class="fromDateuH">منذ 
                    <?php
                        $differ = $this->main_model->dateTime('diff',$item->date,$this->main_model->dateTime('current'));

                        $this->main_model->differ($differ);
                    ?> | بواسطة الادارة
                    </div>
                </div>
                
                <?php }}else{
                    if($this->uri->segment(2) == 'descGigs'){$pros = 'خدمات';}else{$pros = 'مشاريع';}
                    echo '<h3>لايوجد شروحات '.$pros.' بعد.</h3>';} ?>
                <!-- Pagination -->
                <ul class="pagination justify-content-center pager"><?php echo $links; ?></ul>
            </div>
        </div>
    </div>
</div>
<?php if($this->main_model->is_admin_logged_in()){
    $this->load->view('admin/include/footer.php');
}else{
    $this->load->view('include/footer.php');
} ?>