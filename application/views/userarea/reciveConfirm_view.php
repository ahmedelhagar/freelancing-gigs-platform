    <div class="col-lg-8 col-md-8 col-sm-12 s-pro projects">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">هل أنت متأكد من أنك تريد استلام الخدمة؟</h4>
            <p>سيتم الدفع للمستشار ... وهذا يعني أنك استلمت عملك كامل.</p>
            <hr>
            <?php
                $id1 = (int) strip_tags($this->uri->segment(3));
                $id2 = (int) strip_tags($this->uri->segment(4));
                $id3 = (int) strip_tags($this->uri->segment(5));
                if(!$item){
                    redirect(base_url('404/'));
                }
                $cmsg = '\'endRequest\'';
                $bill = $this->main_model->getFullRequest('requestedgigs','(i_id = '.$id1.') AND (u_id = '.$id2.') AND (s_id = '.$item->u_id.') AND (amount = '.$id3.')')[0];
                $promsg = $this->main_model->getFullRequest('promsg','(i_id = '.$id1.') AND (u_id = '.$item->u_id.') AND (s_id = '.$id2.') AND (caseMsg = '.$cmsg.')')[0];
            ?>
            <a href="<?php echo base_url('users/acceptPro/'.$id1.'/'.$id2.'/'.$id3); ?>" class="btn btn-success">استلام</a>
            <a href="<?php echo base_url('users/closePro/'.$id1.'/'.$id2.'/'.$id3.'/'.$bill->id.'/'.$promsg->id); ?>" class="btn btn-danger">رفض</a>
            <a href="<?php echo base_url('i/'.str_replace(' ','-',$item->title).'/'.$item->id); ?>" class="btn btn-warning">رجوع للخدمة</a>
        </div>
    </div>
