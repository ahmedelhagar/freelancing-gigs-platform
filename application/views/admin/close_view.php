<?php $this->load->view('admin/include/userSideBar_view.php'); ?>
<div class="table table-striped col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2" style="background:#fff;">
<?php
  if($item->kind == 2){
    $backTo = 'projects';
  }else{
    $backTo = 'publish';
  }
?>
  <form action="<?php echo base_url('istsharhcadmin/closeCheck/'.$item->id.'/'.$backTo); ?>" method="post">
    <textarea name="msg" placeholder="رسالة الادارة" class="form-control"></textarea><br>
    <input class="btn btn-success" style="border-radius:0px;" type="submit" value="اغلاق وارسال">
  </form>
</div>