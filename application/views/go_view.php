<?php $this->load->view('include/header.php'); ?>
<div class="container-fluid m_top">
    <!--Item-->
    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">
        <div class="col-lg-12 col-md-12 col-sm-12 s_block text-center">
                <h4 class="mt-0">أنت تغادر الموقع</h4>
                أنت تتجه خارج موقع مُكسب لا تقوم بدفع أي مبالغ مالية خارج الموقع
                <b>الموقع غير مسئول عن عمليات دفع أو تعامل تتم خارجه</b>
                <p class="mb-0"><b>تم عرض الصفحة عدد (<?php echo $views; ?>) مرة</b></p>
                <div class="col-lg-12 col-md-12 col-sm-12 float-right">
                    <a target="_blank" href="<?php echo $go; ?>" class="btn btn-primary go-btn">اذهب للرابط >>></a></div>
        </div>
    </div>
</div>
<?php $this->load->view('include/footer.php'); ?>