<?php $this->load->view('admin/include/userSideBar_view.php'); ?>

<div class="col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2" style="background:#fff;">
<form action="<?php echo base_url('istsharhcadmin/insertAdminCheck/'); ?>" method="post">
  <input type="text" name="username" placeholder="اسم المشرف" class="form-control"><br>
  <input type="email" name="email" placeholder="xxxx@xxx.com" class="form-control"><br>
  <input type="password" name="password" placeholder="*******" class="form-control"><br>
  <h5>الصلاحيات</h5>
  <select class="col-12 float-right" name="creds[]" id="slim-select" multiple>
    <option value="blog">المدونة</option>
    <option value="pages">الصفحات</option>
    <option value="blocks">بلوكات الصفحة الرئيسية</option>
    <option value="items">العناصر</option>
    <option value="withdraws">طلبات السحب</option>
    <option value="users">الأعضاء</option>
    <option value="cats">الأقسام</option>
    <option value="countries">الدول</option>
    <option value="skills">المهارات</option>
    <option value="tuts">الشروحات</option>
    <option value="cs">تذاكر الدعم الفني</option>
  </select><br>
  <input type="submit" value="اضف" class="btn btn-success float-right my-3">
</form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"></link>
<script>
new SlimSelect({
  select: '#slim-select'
})
</script>