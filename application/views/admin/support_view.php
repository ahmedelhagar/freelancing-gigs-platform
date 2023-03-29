<?php $this->load->view('admin/include/userSideBar_view.php'); ?>

<table class="table table-striped col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2" style="background:#fff;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">عنوان التذكرة</th>
      <th scope="col">بواسطة</th>
    </tr>
  </thead>
  <tbody>
  <?php if($tickets){$i = 1;foreach($tickets as $ticket){ ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><a href="<?php echo base_url('pages/ser/'.$ticket->id); ?>"><?php echo $ticket->title; ?> <span class="cs-alert-num"><?php
                    $count = $this->main_model->getFullRequest('cdata','(kind = 3) AND (seen = 0) AND (co_id = '.$ticket->id.')','count');
                    if($count > 0){
                        echo $count;
                    }else{
                        echo 0;
                    }
                    ?></span></a></td>
      <?php
        $user = $this->main_model->getByData('users','id',$ticket->u_id)[0];
      ?>
      <td><a href="<?php echo base_url('user/'.$user->username); ?>"><?php echo $user->firstname.' '.$user->lastname; ?></a></td>
    </tr>
    <?php $i++;}} ?>
  </tbody>
</table>