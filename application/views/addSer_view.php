<?php $this->load->view('include/header.php'); 
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
        <div class="col-lg-9 col-md-9 col-sm-12 mx-auto">
            <div class="col-lg-12 col-md-12 col-sm-12 float-right unHere">
                <?php 
                if($this->main_model->is_logged_in()){
                    $pram = '';
                    $i_id = (int) strip_tags($this->uri->segment(3));
                    $item = $this->main_model->getByData('items','id',$i_id)[0];
                    if($item){
                        $itemLink = base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/';
                        echo '<h4>نزاع عن <a target="_blank" href="'.$itemLink.'">'.$item->title.'</a></h4><br>';
                        $pram = $item->id;
                    }
                ?>
                <form action="<?php echo base_url('users/addSerCheck/'.$pram); ?>" method="post">
                    <input type="text" name="title" class="form-control" style="border-radius:0px;" placeholder="عنوان التذكرة"><br>
                    <textarea name="content" class="form-control" style="border-radius:0px;" placeholder="اكتب المحتوى"></textarea><br>
                    <input type="submit" class="btn btn-success regbtn" style="border-radius:0px;" value="ارسال" name="submit">
                </form>
                <?php
                }else{
                    echo '<div class="col-12 float-right alert alert-warning" role="alert">عليك <a href="'.base_url('pages/login').'">تسجيل الدخول</a> لإضافة تعليق</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer.php');?>