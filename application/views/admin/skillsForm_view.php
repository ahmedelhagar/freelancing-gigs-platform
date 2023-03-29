<?php $this->load->view('admin/include/userSideBar_view.php'); ?>

<div class="col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2" style="background:#fff;">
<form action="<?php echo base_url('istsharhcadmin/insertSkillCheck/'); ?>" method="post">
  <input type="text" name="skill" placeholder="اسم المهارة" class="form-control"><br>
  <input type="submit" value="اضف" class="btn btn-success">
</form>
</div>