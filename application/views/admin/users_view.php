<?php $this->load->view('admin/include/userSideBar_view.php'); ?>
<div class="container-fluid allUsers col-lg-8 col-md-8 col-sm-12 float-right px-2 py-2">
    <h3>كل الأعضاء</h3>
    <form action="<?php echo base_url().'istsharhcadmin/userSearch'; ?>" method="get" class="users-search">
      <input name="search_user" type="text" placeholder="اكتب اسم المستخدم">
      <input class="bt btn-success" type="submit" value="بحث">
    </form>
    <div class="container-fluid float-right">
                <br/>
                <a href="<?php echo base_url().'istsharhcadmin/allUsers'; ?>" type="button" class="btn btn-primary">
                  كل الأعضاء
                </a></div>
    <?php foreach($records as $user){
    ?>
    <div class="col-lg-3 col-md-3 col-sm-12 float-right user-cpad">
        <div class="col-lg-12 col-md-12 col-sm-12 float-right user-card">
            <a href="<?php echo base_url().'user/'.$user->username; ?>"><img src="<?php 
                    if($user->oauth_provider == 'facebook'){
                        echo $user->image;
                    }else{
                        if($user->image =='' OR $user->oauth_provider == 'google'){

                            echo base_url().'vendor/images/user.png';

                            }else{

                                echo base_url().'vendor/uploads/images/'.$user->image;

                            }
                    }
                    ?>"></a>
                    <p><a href="<?php echo base_url().'user/'.$user->username; ?>"><?php echo $user->username; ?></a></p>
            <div class="user-ctitle">
                <a class="del-link" href="<?php echo base_url().'istsharhcadmin/delete/users/'.$user->id.'/?m=istsharhcadmin/allUsers'; ?>"><span class="fa fa-trash"></span> حذف</a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $user->id; ?>">
                  بيانات العضو
                </button><br><br>
                <a class="btn btn-success" href="<?php echo base_url('istsharhcadmin/loginAs/'.$user->id); ?>">سجل الدخول مكانه</a>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h5>رقم العضو : <?php echo $user->id; ?></h5>
                        <h5>اسم المستخدم : <?php echo $user->username; ?></h5>
                        <h5>الاسم الأول : <?php echo $user->firstname; ?></h5>
                        <h5>الاسم الأخير : <?php echo $user->lastname; ?></h5>
                        <h5>البريد : <?php echo $user->email; ?></h5>
                         <?php $country = (array) $this->main_model->getByData('countries','code',$user->country)[0]; ?>
                        <h5>الهاتف : <?php echo $country['tel'].$user->mobile.'+'; ?></h5>
                        <h5>العنوان : <?php echo $user->address; ?></h5>
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Pagination -->
      <ul class="pagination justify-content-center pager"><?php echo $links; ?></ul>
</div>