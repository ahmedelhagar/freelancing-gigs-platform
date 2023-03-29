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
      <th scope="col">#</th>
      <th scope="col">اسم الخدمة</th>
      <th scope="col">قيمة الطلب بالـ $</th>
      <th scope="col">حالة الطلب</th>
      <th scope="col">حذف</th>
    </tr>
  </thead>
  <tbody>
  <?php if($bills){$i = 1;foreach($bills as $bill){ ?>
    <tr>
      <th scope="row"><?php echo $bill->id; ?></th>
      <td><?php
        $item = $this->main_model->getByData('items','id',$bill->i_id)[0];
        ?><a href="<?php echo base_url('i/'.str_replace(' ','-',$item->title).'/'.$item->id); ?>"><?php echo $item->title; ?></a> -
        <a href="<?php echo base_url('istsharhcadmin/bill/'.$bill->id); ?>">تصفح الفاتورة</a></td>
      <td><?php echo $bill->amount; ?></td>
      <td><?php
          if($bill->state == 2){
              echo 'تم الاستلام';
          }else{
              echo 'الفاتورة قيد التنفيذ';
          }
      ?></td>
      <td><a href="<?php echo base_url('istsharhcadmin/delete/requestedgigs/'.$bill->id.'?m=istsharhcadmin/bills'); ?>">حذف</a></td>
    </tr>
    <?php $i++;}} ?>
  </tbody>
</table>
<form action="<?php echo base_url('istsharhcadmin/bills'); ?>" method="get">
  <a href="<?php echo base_url('istsharhcadmin/bills'); ?>" class="btn btn-success">الكل</a><br>
    <input type="text" placeholder="رقم الطلب" name="id">
    <input type="submit" value="تصفية" class="btn btn-success">
</form>
</div>