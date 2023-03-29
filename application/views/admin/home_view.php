<?php $this->load->view('admin/include/userSideBar_view.php'); ?>
<div class="container-fluid allUsers col-lg-8 col-md-8 col-sm-12 float-right">
    <div class="col-lg-6 col-md-6 col-sm-12 float-right statics">
                <?php 
                        $alltcks = 0;
                        $allorders = $this->main_model->getFullRequest('items','(kind = 2)','count');
                        $allsold = $this->main_model->getFullRequest('items','(kind = 1)','count');
                        $usersnum=$this->main_model->getFullRequest('users','(id IS NOT NULL)','count');
                        $ticks = $this->main_model->getFullRequest('cdata','(kind = 3)','count');
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 stats">
                    <h3><?php if($ticks){echo $ticks;}else{echo $alltcks;} ?></h3>
                    <p>إجمالي عدد تذاكر الدعم الفني</p>
                </div>
        <div class="col-lg-12 col-md-12 col-sm-12 stats">
                    <h3><?php echo $usersnum; ?></h3>
                    <p>عدد أعضاء الموقع</p>
        </div>
                
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 float-right statics">
        <div class="col-lg-12 col-md-12 col-sm-12 stats">
                    <h3><?php echo $allorders; ?></h3>
                    <p>إجمالي عدد المشاريع</p>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 stats">
            <h3><?php echo $allsold; ?></h3>
            <p>إجمالي عدد الخدمات</p>
        </div>
    </div>
</div>