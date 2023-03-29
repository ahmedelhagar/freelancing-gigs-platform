<?php $this->load->view('include/header.php'); ?>

      <div class="container-fluid m_top">

        <div class="col-lg-12 col-md-12 col-sm-12 ban_con">

              <div class="banner">

                  <img src="<?php echo base_url().'vendor/images/banner.png'; ?>" class="b_img col-lg-4 col-md-4 col-sm-12" alt="مكسب">

                      <div class="col-lg-8 col-md-8 col-sm-12 b_txt">

                          <h3>أفضل الخدمات الإلكترونية في الوطن العربي.</h3>

                          <h6>نختار مُستشارينا لك بعناية.</h6>

                      </div>

              </div>

        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 float-right cat-sections">
                <h3>كيف يعمل نظام المشاريع؟</h3>
                <div class="col-lg-3 col-md-3 col-sm-6 float-right cat-section">
                    <a href="#">
                        <span class="fa fa-plus"></span>
                        <p>أضف مشروعك.</p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 float-right cat-section">
                    <a href="#">
                        <span class="fa fa-dollar-sign"></span>
                        <p>انتظر العروض من مستشارينا.</p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 float-right cat-section">
                    <a href="#">
                        <span class="fa fa-envelope"></span>
                        <p>اختر العرض والمستشار المناسب</p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 float-right cat-section">
                    <a href="#">
                        <span class="fa fa-gift"></span>
                        <p>استلم العمل وقيم المستشار</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 why_">

                <h3>كيف يعمل نظام الخدمات؟</h3>

                <div class="col-lg-4 col-md-4 col-sm-12 why_i">

                    <span class="fa fa-plus"></span>

                    <h6>الاضافة</h6>

                    أضف خدمة تتعلق بمهارتك

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 why_i">

                    <span class="fa fa-dollar-sign"></span>

                    <h6>البيع والتنفيذ</h6>

                يصلك طلب شراء ... لتقم بالتنفيذ.

                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 why_i">

                    <span class="fa fa-gift"></span>

                    <h6>التسليم والتقييم</h6>

                قم بتسليم عملك لتحصل على الثمن المدفوع وعلى تقييمك.

                </div>
            </div>
        <?php if($records){ ?>
            <div class="col-lg-12 col-md-12 col-sm-12 regi">
<br>
              <h3>خدمات مختارة</h3>
              <?php foreach($records as $product){ ?>
              <div class="b_item col-lg-3 col-md-3 col-sm-6">
              
                <div class="service">

                    <?php

                        $image = explode(',',$product->images);

                        $vthumb = 'vthumb_'.$image[0];

                    ?>

                    <a href="<?php

                echo base_url().'i/'.str_replace(' ','-',$product->title).'/'.$product->id.'/';

                ?>"><img src="<?php echo base_url().'vendor/uploads/images/'.$vthumb; ?>" alt="<?php echo $product->title; ?>"></a>

                    <h6><a href="<?php

                echo base_url().'i/'.str_replace(' ','-',$product->title).'/'.$product->id.'/';

                ?>"><?php echo $product->title; ?></a></h6>

                    <a href="<?php

                echo base_url().'i/'.str_replace(' ','-',$product->title).'/'.$product->id.'/';

                ?>"><div class="buy_this"><?php
                $count = $this->main_model->getFullRequest('requestedgigs','(i_id = '.$product->id.')','count');
                if($count > 0){
                echo $count.' عمليات شراء تمت لهذه الخدمة';
                }else{
                echo 'كن أول مشتري';
                }
                ?></div></a>

                </div>

                </div>

                <?php } ?>

        </div>
<?php 
}
if($projects){ ?>
        <div class="col-lg-12 col-md-12 col-sm-12 regi">
<br>
              <h3>مشاريع مختارة</h3>
              
            <?php foreach($projects as $project){ ?>

<div class="col-lg-12 col-md-12 col-sm-12 project">

    <h4 class="project-title"><a href="<?php
if($project->for_user !== null){
if($this->main_model->is_logged_in()){
if($userviewed[0]->id == $userData['id'] OR $userData['id'] == $project->for_user){
        echo base_url().'i/'.str_replace(' ','-',$project->title).'/'.$project->id.'/';
}
}else{
echo '#';
}
}else{
echo base_url().'i/'.str_replace(' ','-',$project->title).'/'.$project->id.'/';
}

        ?>"><?php
        if($project->for_user !== null){
            if($this->main_model->is_logged_in()){
                if($userviewed[0]->id == $userData['id'] OR $userData['id'] == $project->for_user){
                    echo $project->title;
                }
            }else{
                echo 'مشروع خاص';
            }
            echo '<div class="private-pro">خاص</div>';
        }else{
            echo $project->title;
        }
        ?></a></h4>

    <div class="project-snip"><span class="fa fa-clock"></span>

        منذ

        <?php

        $differ = $this->main_model->dateTime('diff',$project->date,$this->main_model->dateTime('current'));

        $this->main_model->differ($differ);

        ?>

        <?php

        $subCat = $this->main_model->getByData('categories','id',$project->tag_id);

        $mainCat = $this->main_model->getByData('categories','id',$subCat[0]->c_id);

        ?>

        | <span class="fa fa-tags"></span> قسم : <a href="#"><?php echo $mainCat[0]->category; ?></a> | <span class="fa fa-tag"></span> تصنيف : <a href="#"><?php echo $subCat[0]->category; ?></a></div>

    <div class="col-lg-12 col-md-12 col-sm-12 project-content">

    <?php
        if($project->for_user !== null){
            if($this->main_model->is_logged_in()){
                if($userviewed[0]->id == $userData['id'] OR $userData['id'] == $project->for_user){
                    echo preg_replace('!\s+!', ' ',mb_substr(strip_tags($project->content),0,150, "utf-8")).'...';
                }
            }else{
                echo 'مشروع خاص';
            }
        }else{
            echo preg_replace('!\s+!', ' ',mb_substr(strip_tags($project->content),0,150, "utf-8")).'...';
        }
        ?>

    </div>

    <div class="budget">بميزانية

        <?php 

            $budget = explode(',',$project->price);

            if($budget[0] == $budget[1]){

                echo $budget[0].' $';

            }elseif($budget[0] > $budget[1]){

                echo ' من '.$budget[1].' إلى '.$budget[0].' $';

            }else{

                echo ' من '.$budget[0].' إلى '.$budget[1].' $';

            }

        ?></div>

</div>

    <?php } ?>

</div>
<?php
}
?>
        </div>
            <div class="col-lg-12 col-md-12 col-sm-12 float-right cat-sections">
                <h3>تصفح أقسام الموقع</h3>
                <p>لتجد الإلهام وتبدأ مشروعك</p>
                <?php if($cats){foreach($cats as $cat){ ?>
                <div class="col-lg-3 col-md-3 col-sm-6 float-right cat-section">
                    <a href="<?php echo ('pages/search/?cat='.$cat->id); ?>">
                        <span class="<?php echo $cat->icon; ?>"></span>
                        <p><?php echo $cat->category; ?></p>
                    </a>
                </div>
                <?php }} ?>
            </div>

          <div class="col-lg-12 col-md-12 col-sm-12 why_">

              <h3>لماذا استشارة؟</h3>

              <div class="col-lg-4 col-md-4 col-sm-12 why_i">

                  <span class="fa fa-rocket"></span>

                  <h6>السرعة</h6>

                  استلم أعمالك في سرعة أقصى مما تتصور.

              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 why_i">

                  <span class="fa fa-gift"></span>

                  <h6>هدية</h6>

                 مُستشارينا كالهدية لأعمالك بسبب خبراتهم.

              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 why_i">

                  <span class="fa fa-history"></span>

                  <h6>15 يوم</h6>

                 يُمكنك إسترجاع أموالك خلال 15 يوم.

              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 why_i">

                  <span class="fa fa-lock"></span>

                  <h6>الأمان</h6>

                 سنُحافظ على بياناتك في أمان.

              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 why_i">

                  <span class="fa fa-star"></span>

                  <h6>الصراحة</h6>

                 شاهد تقييمات المُشتريين السابقيين قبلك.

              </div>

              <div class="col-lg-4 col-md-4 col-sm-12 why_i">

                  <span class="fa fa-comments"></span>

                  <h6>مناقشة</h6>

                 مراسلة صاحب الخدمة قبل الشراء.

              </div>

          </div>

          <div class="col-lg-12 col-md-12 col-sm-12 float-right cat-sections mb-3">
          <div class="col-lg-2 col-md-2 col-sm-6 float-right py-2">
          <a href="<?php echo $blocks[0]->link; ?>">
                <div class="col-lg-12 col-md-12 col-sm-12 float-right cat-section with-img" style="background-image:url(<?php echo base_url('vendor/images/s1.jpg'); ?>);">
                    <p><?php echo $blocks[0]->content; ?></p>
                    <p class="ms-tit"><?php echo $blocks[0]->title; ?></p>
                </div>
            </a>
          </div>
            <div class="col-lg-2 col-md-2 col-sm-6 float-right py-2">
            <a href="<?php echo $blocks[1]->link; ?>">
                <div class="col-lg-12 col-md-12 col-sm-12 float-right cat-section with-img" style="background-image:url(<?php echo base_url('vendor/images/s2.jpg'); ?>);">
                    <p><?php echo $blocks[1]->content; ?></p>
                    <p class="ms-tit"><?php echo $blocks[1]->title; ?></p>
                </div>
            </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 float-right py-2">
            <a href="<?php echo $blocks[2]->link; ?>">
                <div class="col-lg-12 col-md-12 col-sm-12 float-right cat-section with-img" style="background-image:url(<?php echo base_url('vendor/images/s3.jpg'); ?>);">
                    <p><?php echo $blocks[2]->content; ?></p>
                    <p class="ms-tit"><?php echo $blocks[2]->title; ?></p>
                </div>
            </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 float-right py-2">
            <a href="<?php echo $blocks[3]->link; ?>">
                <div class="col-lg-12 col-md-12 col-sm-12 float-right cat-section with-img" style="background-image:url(<?php echo base_url('vendor/images/s5.jpg'); ?>);">
                    <p><?php echo $blocks[3]->content; ?></p>
                    <p class="ms-tit"><?php echo $blocks[3]->title; ?></p>
                </div>
            </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 float-right py-2">
            <a href="<?php echo $blocks[4]->link; ?>">
                <div class="col-lg-12 col-md-12 col-sm-12 float-right cat-section with-img" style="background-image:url(<?php echo base_url('vendor/images/s4.jpg'); ?>);">
                    <p><?php echo $blocks[4]->content; ?></p>
                    <p class="ms-tit"><?php echo $blocks[4]->title; ?></p>
                </div>
            </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 float-right py-2">
                <a href="<?php echo $blocks[5]->link; ?>">
                    <div class="col-lg-12 col-md-12 col-sm-12 float-right cat-section with-img" style="background-image:url(<?php echo base_url('vendor/images/s6.jpg'); ?>);">
                        <p><?php echo $blocks[5]->content; ?></p>
                        <p class="ms-tit"><?php echo $blocks[5]->title; ?></p>
                    </div>
                </a>
            </div>
        </div>

          <div class="col-lg-12 col-md-12 col-sm-12 regi">

              <h3>ماذا تنتظر؟ ... سجل الان بـ</h3>

              <div class="col-lg-12 col-md-12 col-sm-12 reg_acc">

                  <a href="<?php echo base_url().'register'; ?>"><div class="more btn btn-success"><span class="fa fa-user"></span> حساب عادي</div></a>

                  <h6>تستطيع البيع والشراء لتزيد أرباحك أو تنفيذ مشاريعك.</h6>

              </div>

          </div>

<?php $this->load->view('include/footer.php'); ?>

