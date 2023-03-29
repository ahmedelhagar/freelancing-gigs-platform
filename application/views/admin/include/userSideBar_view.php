<div class="col-lg-12 col-md-12 col-sm-12 float-right" style="margin-top:120px;">

    <div class="col-lg-4 col-md-4 col-sm-12 s-pro" style="margin-top: 0px;">

        <?php if($this->main_model->is_admin_logged_in()){ ?>

    <!--Item-->

    <div class="col-lg-12 col-md-12 col-sm-12 s-pro" style="margin-top: 0px;">

        <div class="col-lg-12 col-md-12 col-sm-12 right-menu">
        <?php if($this->main_model->creds('blog','request')){ ?>
            <a href="<?php echo base_url().'blog/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-list"></span>

                    المدونة

                </div>

            </a>
        <?php } ?>
        <?php if($this->main_model->creds('pages','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/footerPages/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-file"></span>

                    الصفحات

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('blocks','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/blocks/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-square"></span>

                    بلوكات الصفحة الرئيسية

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('items','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/publish/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-reply"></span>

                    الخدمات

                </div>

            </a>
            <a href="<?php echo base_url().'istsharhcadmin/projects/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-reply"></span>

                    المشاريع

                </div>

            </a>
            <a href="<?php echo base_url().'istsharhcadmin/bills/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-reply"></span>

                    الفواتير

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('items','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/closeRequests/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-times"></span>

                    طلبات الالغاء

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('withdraws','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/withdraws/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-credit-card"></span>

                    طلبات السحب

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('users','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/allUsers/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-users"></span>

                    الاعضاء

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('cats','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/addTag/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-tags"></span>

                    الاقسام

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('countries','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/countries/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-flag"></span>

                    الدول

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('skills','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/skills/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-tag"></span>

                    المهارات

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('cs','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/support/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-ticket-alt"></span>

                    تذاكر الدعم الفني <span class="cs-alert-num"><?php
                    $count = $this->main_model->getFullRequest('cdata','(kind = 3) AND (seen = 0) AND (co_id IS NULL)','count');
                    if($count > 0){
                        echo $count;
                    }else{
                        echo 0;
                    }
                    ?></span>

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('tuts','request')){ ?>
            <a href="<?php echo base_url().'pages/description/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-video"></span>

                    الشروحات

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('admins','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/admins/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-users"></span>

                    المشرفين

                </div>

            </a>
            <?php } ?>
            <?php if($this->main_model->creds('apps','request')){ ?>
            <a href="<?php echo base_url().'istsharhcadmin/apps/'; ?>">

                <div class="col-lg-12 col-md-12 col-sm-12 r-mitem float-right">

                    <span class="fa fa-cogs"></span>

                    الاعدادات

                </div>

            </a>
            <?php } ?>
        </div>

    </div>

       <?php } ?>        

</div>