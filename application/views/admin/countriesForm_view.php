<?php $this->load->view('admin/include/userSideBar_view.php'); ?>

<div class="col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2" style="background:#fff;">
<form action="<?php echo base_url('istsharhcadmin/insertCountryCheck/'); ?>" method="post">
  <input type="text" name="country" placeholder="اسم الدولة" class="form-control"><br>
  <input type="text" name="code" placeholder="كود الدولة المكون من حرفين" class="form-control"><br>
  <a href="https://en.wikipedia.org/wiki/List_of_ISO_3166_country_codes">أكواد الدول</a><br><br>
  <input type="submit" value="اضف" class="btn btn-success">
</form>
</div>