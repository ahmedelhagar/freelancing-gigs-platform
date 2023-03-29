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
<a href="<?php echo base_url('istsharhcadmin/insertCountry'); ?>" class="btn btn-success"> اضف دولة</a><br><br>
<table class="table table-striped col-12 float-right" style="background:#fff;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم الدولة</th>
      <th scope="col">حذف</th>
    </tr>
  </thead>
  <tbody>
  <?php if($countries){$i = 1;foreach($countries as $country){ ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $country->country; ?></td>
      <td><a href="<?php echo base_url('istsharhcadmin/delete/countries/'.$country->id.'?m=istsharhcadmin/countries'); ?>">حذف</a></td>
    </tr>
    <?php $i++;}} ?>
  </tbody>
</table>
</div>