<?php $this->load->view('admin/include/userSideBar_view.php');
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

<div class="col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2">
<a href="<?php echo base_url('istsharhcadmin/insertadmin'); ?>" class="btn btn-success"> اضف مشرف</a><br><br>
<table class="table table-striped col-12 float-right" style="background:#fff;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم المشرف</th>
      <th scope="col">حذف</th>
    </tr>
  </thead>
  <tbody>
  <?php if($admins){$i = 1;foreach($admins as $admin){ ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $admin->username; ?></td>
      <td><a href="<?php echo base_url('istsharhcadmin/delete/admins/'.$admin->id.'?m=istsharhcadmin/admins'); ?>">حذف</a></td>
    </tr>
    <?php $i++;}} ?>
  </tbody>
</table>
</div>