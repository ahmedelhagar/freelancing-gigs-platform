<?php $this->load->view('admin/include/userSideBar_view.php'); ?>

<table class="table table-striped col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2" style="background:#fff;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">عنوان البلوك</th>
      <th scope="col">تعديل</th>
    </tr>
  </thead>
  <tbody>
  <?php if($pages){$i = 1;foreach($pages as $page){ ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><a href="<?php echo base_url('istsharhcadmin/editBlock/'.$page->id); ?>"><?php echo $page->title; ?></a></td>
      <td><a href="<?php echo base_url('istsharhcadmin/editBlock/'.$page->id); ?>">تعديل</a></td>
    </tr>
    <?php $i++;}} ?>
  </tbody>
</table>