<?php $this->load->view('include/header.php'); ?>

<div class="container-fluid m_top">
<div class="col-12 float-right">
    <div class="col-lg-6 col-md-6 col-sm-6 my-th">

        <a href="<?php echo base_url().'pages/searchFor/2'; ?>">

            <div class="col-lg-12 col-md-12 col-sm-12 m-projects">

                <span class="fa fa-list"></span>

                مشاريع

            </div>

        </a>

    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 my-th">

        <a href="<?php echo base_url().'pages/searchFor/1'; ?>">

            <div class="col-lg-12 col-md-12 col-sm-12 m-gigs">

                <span class="fab fa-angellist"></span>

                خدمات

            </div>

        </a>

    </div>
    </div>
    <form class="sp-form col-lg-12 col-md-12 col-sm-12" action="#" method="get">

        <input type="text" name="search" class="sp-inp"<?php if($this->input->get('search')){echo 'value ="'.$this->input->get('search').'"';} ?> placeholder="أنا ابحث عن ...">

        <button type="submit" name="go" class="sp-btn">

            <span class="fa fa-search"></span> تصفية النتائج

        </button>

    </form>
    
    <div class="col-lg-3 col-md-3 col-sm-12 cates">

        <ul class="u-list">
        <?php if($mtags){foreach($mtags as $mtag){ ?>
            <li><a href="<?php echo base_url('pages/search/?cat='.$mtag->id); ?>"><h5><?php echo $mtag->category; ?></h5></a>
            <!-- class="a-active"-->
                <ul>
                <?php
                    $subtags = $this->main_model->getAllDataCond('categories','state',1,'c_id',$mtag->id);
                    if($subtags){
                        foreach($subtags as $subtag){
                ?>
                    <li><a href="#" id="subtag-filter-<?php echo $subtag->id; ?>" onclick="getTagResults(<?php echo $subtag->id; ?>,<?php echo $searchFor; ?>);"><?php echo $subtag->category; ?> <span class="nums"><?php
                        $count = $this->main_model->getFullRequest('items','(tag_id = '.$subtag->id.') AND (state = 1) AND (kind = '.$searchFor.') AND (for_user IS NULL)','count');
                        if($count){
                            echo $count;
                        }else{
                            echo '0';
                        }
                    ?></span></a></li>
                    <?php
                        }
                    }
                ?>
                </ul>

            </li>
            <?php }} ?>

        </ul>
        <div class="adv-filters">
            <h4>اعدادات متقدمة للبحث</h4>
            <!--<form action="<?php //echo base_url('pages/searchFilter'); ?>" method="post">-->
            <?php if(get_cookie('searchFor') == '1'){ ?>
            <h6>التقييمات</h6>
            <input type="hidden" value="0" id="tag_id_input">
                <select name="rates" class="search-select-filter form-control" style="background:#fff;" id="rates-filter">
                    <option value="5"><span>(⭐⭐⭐⭐⭐5)</span></option>
                    <option value="4"><span> (⭐⭐⭐⭐4) أو أكثر</span></option>
                    <option value="3"><span> (⭐⭐⭐3) أو أكثر</span></option>
                    <option value="2"><span> (⭐⭐2) أو أكثر</span></option>
                    <option value="1"><span> (⭐1) أو أكثر</span></option>
                    <option selected value=""><span> غير محدد</span></option>
                </select><br>
            <?php } ?>
            <h6>مستوى البائع</h6>
            <select name="prof" class="search-select-filter form-control" style="background:#fff;" id="prof-filter">
                <option value="three">بائع محترف</option>
                <option value="two">بائع مميز</option>
                <option value="one">بائع ضعيف</option>
                <option value="zero">لم يحصل على فرصة بعد</option>
                <option selected value=""><span> غير محدد</span></option>
            </select><br>
            <h6>الدولة</h6>
            <select name="country" class="search-select-filter" style="background:#fff;" id="country-filter">
            <?php $countries = $this->main_model->getAllData('countries');
                if($countries){foreach($countries as $country){
            ?>
                <option value="<?php echo $country->code; ?>"><?php echo $country->country; ?></option>
            <?php }} ?>
            <option selected value=""><span> غير محدد</span></option>
            </select><br>
            <h6>حالة البائع</h6>
            <select name="active" class="search-select-filter form-control" style="background:#fff;" id="active-filter">
                <option value="on">نشط الان</option>
                <option value="off">غير نشط الان</option>
                <option selected value="all">الكل</option>
            </select><br>
            <input type="submit" onclick="getAdvResults();" value="تصفية متقدمة" class="btn btn-success" style="border-radius:0px;">
            <!--</form>-->
        </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 i-conts">

                  <div class="b_items">

                      <?php if($results){foreach($results as $item){
                          if($item->kind == 1){
                              //Gigs
                        ?>
                        <div class="b_item col-lg-4 col-md-4 col-sm-6">

<div class="service">
  <?php
  $image = explode(',',$item->images);

  $vthumb = 'vthumb_'.$image[0];
  ?>
    <a href="<?php

echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/';

?>"><img src="<?php echo base_url().'vendor/uploads/images/'.$vthumb; ?>" alt="<?php echo $item->title; ?>"></a>

    <h6><a href="<?php

echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/';

?>"><?php echo $item->title; ?></a></h6>

    <a href="<?php

echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/';

?>"><div class="buy_this"><?php
$count = $this->main_model->getFullRequest('requestedgigs','(i_id = '.$item->id.')','count');
if($count > 0){
echo $count.' عمليات شراء تمت لهذه الخدمة';
}else{
echo 'كن أول مشتري';
}
?></div></a>

</div>

</div>
                      <?php }elseif($item->kind == 2){
                          //Projects
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 project my-3">

<h4 class="project-title"><a href="<?php

    echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/';

    ?>"><?php echo $item->title; ?></a></h4>

<div class="project-snip"><span class="fa fa-clock"></span>

    منذ

    <?php

    $differ = $this->main_model->dateTime('diff',$item->date,$this->main_model->dateTime('current'));

    $this->main_model->differ($differ);

    ?>

    <?php

    $subCat = $this->main_model->getByData('categories','id',$item->tag_id);

    $mainCat = $this->main_model->getByData('categories','id',$subCat[0]->c_id);

    ?>

    | <span class="fa fa-tags"></span> قسم : <a href="#"><?php echo $mainCat[0]->category; ?></a> | <span class="fa fa-tag"></span> تصنيف : <a href="#"><?php echo $subCat[0]->category; ?></a></div>

<div class="col-lg-12 col-md-12 col-sm-12 project-content">

<?php echo preg_replace('!\s+!', ' ',mb_substr(strip_tags($item->content),0,150, "utf-8")); ?>...

</div>

<div class="budget">بميزانية

    <?php 

        $budget = explode(',',$item->price);

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
                      
                      <?php }}else{echo '<h3>لايوجد نتائج في هذه الصفحة</h3>';} ?>
          </div>

    </div>
    <div class="col-12 float-right">
    <!-- Pagination -->

    <ul class="pagination justify-content-center pager"><?php echo $links; ?></ul>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.26.0/slimselect.min.css" rel="stylesheet"></link>
<script type="text/javascript">
new SlimSelect({
  select: '#country-filter'
})
</script>
<?php $this->load->view('include/footer.php'); ?>