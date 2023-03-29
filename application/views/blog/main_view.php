<div class="container-fluid float-right" style="background: #f1f1f1;margin-top: 80px;">
<?php if($this->main_model->is_admin_logged_in()){ ?>
<br />
    <h3 class="text-center"><a class="btn btn-success" href="<?php echo base_url().'istsharhcadmin/addBlog'; ?>"><span class="fa fa-plus"></span> أضف تدوينة</a></h3>
<?php } ?>
<?php if($recordsLimited){foreach($recordsLimited as $recordli){
    $data['subtag'] = $this->main_model->getFullRequest('categories','id = '.$recordli->tag_id);
    $data['mtag'] = $this->main_model->getAllDataCond('categories','state',0,'id',$data['subtag'][0]->c_id);
    ?>
<div class="col-lg-6 col-md-6 col-sm-12 float-right l-blog-con">
    <div class="col-lg-12 col-md-12 col-sm-12 float-right blog-post">
        <div class="bp-img col-lg-12 col-md-12 col-sm-12">
            <img src="<?php echo base_url().'vendor/uploads/images/'.$this->main_model->vthumb($recordli->images); ?>">
        </div>
        <div class="bp-details col-lg-12 col-md-12 col-sm-12">
        <a href="<?php
                echo base_url().'pages/post/'.str_replace(' ','-',$recordli->title).'/'.$recordli->id.'/';
                ?>">
            <h4><?php echo $recordli->title; ?></h4>
            <div class="dets"><?php
                        if(strlen(strip_tags($recordli->content)) <= 100){
                            echo strip_tags($recordli->content);}
                        else{echo substr(strip_tags($recordli->content),0,100).'...';}
                            ?></div>
        </a>
            <span class="info">تمت الإضافة منذ <?php 
                    $differ = $this->main_model->dateTime('diff',$recordli->date,$this->main_model->dateTime('current'));
                    $this->main_model->differ($differ);
                    ?> بواسطة istsharhAdmin <?php echo $data['mtag'][0]->category.' '.$data['subtag'][0]->category; ?></span>
                    <?php if($this->main_model->is_admin_logged_in()){ ?>
                    <h3>
                        <a class="del-link" href="<?php echo base_url().'istsharhcadmin/delete/items/'.$recordli->id.'/?m=blog'; ?>"><span class="fa fa-trash"></span> حذف</a>
                        <span class="edit"><a href="<?php echo base_url().'istsharhcadmin/edit/items/'.$recordli->id.'/blog/'; ?>"><span class="fa fa-cog"></span> تعديل</a></span>
                    </h3>
                    <?php } ?>
        </div>
    </div>
</div>
<?php }}else{
            ?>
            <h4 class="text-center float-right">لا يوجد تدوينات.</h4>
            <?php
        } ?>
<div class="container-fluid blog-con">
    <div class="col-lg-12 col-md-12 col-sm-12 float-right">
        <div class="container">
        <?php if($records){foreach($records as $record){
            $data['mtag'] = $this->main_model->getAllDataCond('tags','state',5,'id',$record->mtag);
            $data['subtag'] = $this->main_model->getAllDataCond('tags','state',5,'id',$record->subtag);
            ?>
            <div class="blog-post">
                <div class="bp-img col-lg-3 col-md-3 col-sm-12">
                    <img src="<?php echo base_url().'vendor/uploads/images/'.$this->main_model->vthumb($record->images); ?>">
                </div>
                <div class="bp-details col-lg-9 col-md-9 col-sm-12">
                <a href="<?php
                echo base_url().'pages/post/'.str_replace(' ','-',$record->title).'/'.$record->id.'/';
                ?>">
                    <h4><?php echo $record->title; ?></h4>
                    <div class="dets"><?php
                        if(strlen(strip_tags($record->content)) <= 100){
                            echo strip_tags($record->content);}
                        else{echo substr(strip_tags($record->content),0,100).'...';}
                            ?></div>
                </a>
                    <span class="info">تمت الإضافة منذ <?php 
                    $differ = $this->main_model->dateTime('diff',$record->date,$this->main_model->dateTime('current'));
                    $this->main_model->differ($differ);
                    ?> بواسطة istsharhAdmin <?php echo $data['mtag'][0]->tag.' '.$data['subtag'][0]->category; ?></span>
                    <?php if($this->main_model->is_admin_logged_in()){ ?>
                    <h3>
                        <a class="del-link" href="<?php echo base_url().'istsharhcadmin/delete/items/'.$record->id.'/?m=istsharhcadmin/addBlog'; ?>"><span class="fa fa-trash"></span> حذف</a>
                    </h3>
                    <?php } ?>
                </div>
                <?php if($this->main_model->is_admin_logged_in()){ ?>
                    <span class="edit"><a href="<?php echo base_url().'istsharhcadmin/edit/items/'.$recordli->id.'/blog/'; ?>"><span class="fa fa-cog"></span> تعديل</a></span>
                <?php } ?>
            </div>
        <?php }}else{
            ?>
            <h4 class="text-center float-right">لا يوجد تدوينات.</h4>
            <?php
        } ?>
        </div>
    </div>
    <!-- Pagination -->
      <ul class="pagination justify-content-center pager"><?php echo $links; ?></ul>
</div>
</div>