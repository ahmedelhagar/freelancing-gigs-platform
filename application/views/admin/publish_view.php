<?php $this->load->view('admin/include/userSideBar_view.php'); ?>
<div class="col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2">
  <div class="col-12 float-right">
    <a href="<?php echo base_url('istsharhcadmin/publish/'); ?>" class="btn btn-success my-3">الكل</a> |
    <a href="<?php echo base_url('istsharhcadmin/publish/fight'); ?>" class="btn btn-danger my-3">نزاع</a> |
    <a href="<?php echo base_url('istsharhcadmin/publish/active'); ?>" class="btn btn-success my-3">النشطة</a> | 
    <a href="<?php echo base_url('istsharhcadmin/publish/complete'); ?>" class="btn btn-success my-3">المكتملة</a> | 
    <a href="<?php echo base_url('istsharhcadmin/publish/run'); ?>" class="btn btn-success my-3">قيد التنفيذ</a> | 
    <a href="<?php echo base_url('istsharhcadmin/publish/unactive'); ?>" class="btn btn-success my-3">الغير نشطة</a> | 
    <a href="<?php echo base_url('istsharhcadmin/publish/closed'); ?>" class="btn btn-success my-3">المغلقة</a>
  </div>
<table class="table table-striped col-12 float-right px-2 py-2" style="background:#fff;">
  <thead>
    <tr>
      <th scope="col">رقم الخدمة</th>
      <th scope="col">اسم العنصر</th>
      <th scope="col">الحالة</th>
      <th scope="col">نشر / اغلاق</th>
      <th scope="col">حذف</th>
    </tr>
  </thead>
  <tbody>
    <?php if($items){$i = 1;foreach($items as $item){ ?> 
    <tr>
      <th scope="row"><?php echo $item->id; ?></th>
      <td><a href="<?php echo base_url('i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/'); ?>"><?php echo $item->title; ?></a>
      <?php
      if($item->fight !== null){
        $ser = $this->main_model->getByData('cdata','id',$item->fight);
        if($ser){
          foreach($ser as $cs){
            echo '<p>نزاع في <a href="'.base_url().'pages/ser/'.$cs->id.'">'.$cs->title.'</a></p><br>';
          }
        }
      }
      ?>
      </td>
      <td><?php
      if($item->state == 1){
        echo '<div class="item-success">نشطة</div>';
      }elseif($item->state == 3){
        echo '<div class="item-success"><span class="fa fa-check"></span> مكتملة</div>';
      }elseif($item->state == 2){
        echo '<div class="item-success">قيد التنفيذ</div>';
      }elseif($item->state == 0){
        echo '<div class="item-warning">غير نشطة</div>';
      }elseif($item->state == 10){
        echo '<div class="item-warning"><span class="fa fa-lock"></span> مغلقة</div>';
      }
      ?></td>
      <td>
      <?php if($item->state == 0 OR $item->state == 10){ ?>
      <a class="btn btn-success" style="border-radius:0px;" href="<?php echo base_url('istsharhcadmin/publishCheck/'.$item->id.'/publish'); ?>">نشر</a>
      <?php } ?>
      <?php if($item->state == 0 OR $item->state == 1){ ?>
      <a class="btn btn-warning" style="border-radius:0px;" href="<?php echo base_url('istsharhcadmin/close/'.$item->id); ?>"><span class="fa fa-lock"></span> اغلاق/رفض</a></td>
      <?php } ?>
      </td>
      <td>
        <a class="btn btn-danger" style="border-radius:0px;" href="<?php echo base_url().'istsharhcadmin/delete/items/'.$item->id.'/?m=istsharhcadmin/publish'; ?>"><span class="fa fa-trash"></span> حذف</a>
      </td>
    </tr>
    <?php $i++;}} ?>
  </tbody>
</table>
</div>
