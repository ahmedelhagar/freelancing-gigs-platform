    <div class="col-lg-8 col-md-8 col-sm-12 s-pro projects">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">هل أنت متأكد لإتمام عملية التوظيف؟</h4>
            <p>هل انت متأكد انك تريد توظيف المستشار لتنفيذ مشروعك؟ بالضغط على زر تأكيد سيتم الدفع ولن تستطيع الغاء المشروع الا عند طلب المستشار الالغاء وسيتوجب موافقتك أنت والادارة عليه.</p>
            <hr>
            <?php
                $id1 = (int) strip_tags($this->uri->segment(3));
                $id2 = (int) strip_tags($this->uri->segment(4));
                $item = $this->main_model->getFullRequest('items','(id = '.$id2.') AND (u_id = '.$this->session->userdata('id').')')[0];
                if(!$item){
                    redirect(base_url('404/'));
                }
            ?>
            <a href="<?php echo base_url('users/hire/'.$id1.'/'.$id2); ?>" class="btn btn-success">تأكيد</a>
            <a href="<?php echo base_url('i/'.str_replace(' ','-',$item->title).'/'.$item->id); ?>" class="btn btn-danger">رجوع</a>
        </div>
    </div>
