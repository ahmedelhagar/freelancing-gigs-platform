<?php $this->load->view('include/header.php');?>
<div class="container-fluid m_top">
    <!--Item-->
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">
        <div class="col-lg-9 col-md-9 col-sm-12 float-right">
        <?php if($this->main_model->is_logged_in()){ ?>
            <a class="btn btn-success" style="border-radius:0px;margin-bottom:15px;" href="<?php echo base_url('users/addComm'); ?>">أضف عنصر جديد</a>
        <?php } ?>
            <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere">
                <h5>الخدمات الغير موجودة</h5>
                <?php if($items){foreach($items as $item){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere-item commer">
                    <h6>
                        <a href="<?php echo base_url().'pages/comm/'.$item->id; ?>">
                            <?php echo $item->title; ?>
                        </a>
                    </h6>
                    <p><?php echo mb_substr(strip_tags($item->content),0,150, "utf-8").'...'; ?></p>
                    <div class="fromDateuH">منذ 
                    <?php
                        $differ = $this->main_model->dateTime('diff',$item->date,$this->main_model->dateTime('current'));

                        $this->main_model->differ($differ);
                    ?> | بواسطة <?php
                    $itemUser = $this->main_model->getByData('users','id',$item->u_id)[0];
                    echo '<a href="'.base_url().'user/'.$itemUser->username.'">'.$itemUser->firstname.' '.$itemUser->lastname.'</a>';
                    ?>
                    </div>
                </div>
                <?php }}else{echo '<h3>لايوجد طلبات بعد.</h3>';} ?>
                <!-- Pagination -->
                <ul class="pagination justify-content-center pager"><?php echo $links; ?></ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 float-right">
            <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere">
                <h5>اخر التعليقات</h5>
                <?php if($lastReps){foreach($lastReps as $lastRep){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere-item comm-comm">
                    <p>
                        <a href="<?php echo base_url().'pages/comm/'.$lastRep->co_id; ?>">
                            <?php echo mb_substr(strip_tags($lastRep->content),0,50, "utf-8").'...'; ?>
                        </a>
                    </p>
                    <div class="fromDateuH">منذ 
                    <?php
                        $differ = $this->main_model->dateTime('diff',$lastRep->date,$this->main_model->dateTime('current'));

                        $this->main_model->differ($differ);
                    ?> | بواسطة <?php
                    $itemUser = $this->main_model->getByData('users','id',$item->u_id)[0];
                    echo '<a href="'.base_url().'user/'.$itemUser->username.'">'.$itemUser->firstname.' '.$itemUser->lastname.'</a>';
                    ?>
                    </div>
                </div>
                <?php }}else{echo '<h3>لايوجد تعليقات بعد.</h3>';} ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer.php');?>