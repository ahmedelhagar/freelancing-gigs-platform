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
<table class="table table-striped col-12 float-right" style="background:#fff;">
  <thead>
    <tr>
      <th scope="col">رقم المشروع</th>
      <th scope="col">رقم الطلب</th>
      <th scope="col">عنوان المشروع</th>
      <th scope="col">صاحب الطلب</th>
      <th scope="col">التاريخ</th>
      <th scope="col">قبول الطلب</th>
      <th scope="col">حذف</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $editedBids = $this->main_model->getAllData('editedbid');
    if($editedBids){$i = 1;foreach($editedBids as $editedBid){
    $item = $this->main_model->getFullRequest('items','(id = ' .$editedBid->i_id.') AND (state = 2)');
    if($item){
      $item = $item[0];
      $user = $this->main_model->getFullRequest('users','(id = ' .$item->u_id.')');
      $user = $user[0];
    ?>
    <tr>
      <th scope="row"><?php echo $item->id; ?></th>
      <th scope="row"><?php echo $editedBid->id; ?></th>
      <td><?php echo $item->title; ?></td>
      <td><a href="<?php echo base_url('user/'.$user->username); ?>"><?php echo $user->firstname.' '.$user->lastname; ?></a></td>
      <td><?php echo $editedBid->date; ?></td>
      <td><a href="<?php echo base_url('istsharhcadmin/acceptEbid/'.$editedBid->id); ?>">قبول</a></td>
      <td><a href="<?php echo base_url('istsharhcadmin/delete/editedbid/'.$editedBid->id.'?m=istsharhcadmin/closeRequests'); ?>">حذف</a></td>
    </tr>
    <?php }$i++;}} ?>
  </tbody>
</table>
</div>