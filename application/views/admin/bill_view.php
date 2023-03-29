<?php $this->load->view('admin/include/header.php'); ?>

<div class="container-fluid m_top">
<br />

    

<?php $this->load->view('admin/include/userSideBar_view.php'); ?>

    

    <div class="col-lg-8 col-md-8 col-sm-12 s-pro projects" style="margin-top:0px;">
            <table class="table table-striped col-12 float-right px-2 py-2" style="background:#fff;">
            <h3>الفاتورة</h3>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم الخدمة</th>
      <th scope="col">السعر</th>
    </tr>
  </thead>
  <tbody id="cartContent">
    <tr>
      <th scope="row">1</th>
      <td>
      <?php
        $allGigs = array();$allGigsPrice = 0;$gigsUp = array();$gigsUpPrice = 0;
      ?>
        <p><b><a href="<?php echo base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/'; ?>" style="margin-top:5px;float:right;"><?php echo $item->title; ?></a></b></p>
        <div class="cartAdds">
        <?php if($gUs){ ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 s_block">
                        <h4>تطويرات الخدمة</h4>
                        <?php foreach($gUs as $gu){ 
                            $gUcontent = explode(', ',$gu->content);
                            $gUamount = explode(', ',$gu->amount);
                            $gUdays = explode(', ',$gu->days);
                            $guNums = explode(', ',$bill->ui_rep);
                            $i = 0;
                        while($i <= count($gUcontent)-1){ ?>
                        <div class="gU">
                            <h5><?php echo $gUcontent[$i]; ?> في مدة <?php echo $gUdays[$i].' يوم'; ?> - بسعر <?php echo $gUamount[$i].'$'; ?><div class="float-left"><?php
                            if(isset($guNums[$i])){
                                $gigsUp[] = $guNums[$i].'X'.$gUamount[$i].'$';
                                $gigsUpPrice += $guNums[$i]*$gUamount[$i];
                                echo $guNums[$i].'X'.$gUamount[$i].'$';
                                }else{echo '0';}
                                ?></div></h5>
                        </div>

                        <?php $i++;}} ?>
                    </div>
                    <?php } ?>
        </div>
      </td>
      <td>
        <?php echo $item->price.'$'; ?>
      </td>
    </tr>
  </tbody>
</table>
<div class="col-12 float-right billPrice">
    <h6>الحساب</h6>
    <p>سعر الخدمة : </p>
    <p><?php echo $item->price.'$'; ?></p>
    <p>اجمالي الاضافات : </p>
    <p><?php 
    $alli2 = 1;foreach($gigsUp as $gigUp){
        if($alli2 == count($gigsUp)){
            echo $gigUp;
        }else{
            echo $gigUp.'+';
        }
    $alli2++;} ?> = <?php echo $gigsUpPrice; ?>$</p>
    <p>الاجمالي : </p>
    <p><?php echo $gigsUpPrice.'$ +'.$item->price.'$'; ?> = <?php echo $gigsUpPrice+$item->price; ?>$</p>
    <h6 class="text-center"><?php echo $gigsUpPrice+$item->price.'$'; ?> - <?php
        if($bill->state == 2){
            echo 'تم الاستلام';
        }else{
            echo 'الفاتورة قيد التنفيذ';
        }
    ?></h6>
</div>
    </div>
</div>

<?php $this->load->view('admin/include/footer.php'); ?>