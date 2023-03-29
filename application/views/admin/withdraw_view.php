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
<table class="table table-striped col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2" style="background:#fff;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">صاحب الطلب</th>
      <th scope="col">قيمة الطلب بالدولار</th>
      <th scope="col">PAYPAL</th>
      <th scope="col">اتمام الطلب</th>
    </tr>
  </thead>
  <tbody>
  <?php if($requests){$i = 1;foreach($requests as $request){ ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><a href="<?php
      $user = $this->main_model->getByData('users','id',$request->u_id)[0];
        echo base_url('user/'.$user->username); ?>"><?php echo $user->firstname.' '.$user->lastname; ?></a></td>
        <td><?php echo $request->amount; ?></td>
        <td style="direction:ltr;"><?php echo $request->email; ?></td>
        <?php if($request->state == 0){ ?>
            <td><a class="btn btn-success" href="<?php echo base_url('istsharhcadmin/requestDone/'.$request->id); ?>">اتمام</a></td>
        <?php }else{ ?>
        <td>طلب منفذ</td>
        <?php } ?>
    </tr>
    <?php $i++;}} ?>
  </tbody>
</table>
