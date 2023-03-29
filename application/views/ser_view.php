<?php
if($admin){
    $this->load->view('admin/include/header.php');
}else{
    $this->load->view('include/header.php'); 
}

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
<div class="container-fluid m_top">
    <!--Item-->
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">
        <div class="col-lg-9 col-md-9 col-sm-12 float-right">
            <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere">
                <?php if($item){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere-item">
                    <h6>
                            <?php echo $item->title; ?>
                    </h6>
                    <p><?php echo $item->content; ?></p>
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
                <?php } ?>
                <?php 
                if($this->main_model->is_logged_in() OR $this->main_model->is_admin_logged_in()){
                ?>
                <form action="<?php echo base_url('users/addSerReply/'.$item->id); ?>" method="post">
                    <textarea name="content" class="form-control" placeholder="اكتب تعليقك"></textarea><br>
                    <input type="submit" class="btn btn-success regbtn" value="تعليق" name="submit">
                </form>
                <?php
                }else{
                    echo '<div class="col-12 float-right alert alert-warning" role="alert">عليك <a href="'.base_url('pages/login').'">تسجيل الدخول</a> لإضافة تعليق</div>';
                }
                ?>
                <?php if($replies){foreach($replies as $reply){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere-item">
                    <pre><?php echo $reply->content; ?></pre>
                    <div class="fromDateuH">منذ 
                    <?php
                        $differ = $this->main_model->dateTime('diff',$reply->date,$this->main_model->dateTime('current'));

                        $this->main_model->differ($differ);
                    ?> | بواسطة <?php
                    if($reply->u_id == 0){
                        echo 'الدعم الفني';
                    }else{
                        $itemUser = $this->main_model->getByData('users','id',$item->u_id)[0];
                        echo '<a href="'.base_url().'user/'.$itemUser->username.'">'.$itemUser->firstname.' '.$itemUser->lastname.'</a>';
                    }
                    ?>
                    </div>
                </div>
                <?php }}else{echo '<h3>لايوجد ردود بعد.</h3>';} ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 float-right">
            <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere">
                <h5>اخر التذاكر</h5>
                <?php if($lastReps){foreach($lastReps as $lastRep){ ?>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere-item comm-comm">
                    <p>
                        <a href="<?php echo base_url().'pages/ser/'.$lastRep->id; ?>">
                            <?php echo mb_substr(strip_tags($lastRep->title),0,50, "utf-8").'...'; ?>
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
<?php 
if($admin){
    $this->load->view('admin/include/footer.php');
}else{
    $this->load->view('include/footer.php'); 
}
?>