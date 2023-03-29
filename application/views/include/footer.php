<?php
if ($this->main_model->is_admin_logged_in()) {
    $this->load->view('admin/include/footer.php');
} else { ?>
<?php $ettings = (array) $this->main_model->getByData('settings','id',1)[0]; ?>
<?php

      if($this->main_model->is_logged_in()){

                    // Access User Data Securly

                $userData = (array) $this->main_model->is_logged_in(1)[0];

                $userId = $userData['id'];

                $userFirstname = $userData['firstname'];

                $userLastname = $userData['lastname'];

                $userUsername = $userData['username'];

                $userEmail = $userData['email'];

                $userCountry = $userData['country'];

                $userMobile = $userData['mobile'];

                $userAddress = $userData['address'];

                $userPostal = $userData['postal'];

                $userIp = $userData['ip'];

                $userRate = $userData['rate'];

                $userA_balance = $userData['a_balance'];

                $userAds_balance = $userData['ads_balance'];

                $userBalance = $userData['balance'];

                $userC_balance = $userData['c_balance'];

                $userDate = $userData['date'];

                $userState = $userData['state'];

                $userAll_balance = $userData['all_balance'];

                $userImage = $userData['image'];

                $userL_logout = $userData['l_logout'];
                $userProvider = $userData['oauth_provider'];

            }

      ?>
        <footer class="col-lg-12 col-md-12 col-sm-12">

            <div  class="col-lg-3 col-md-3 col-sm-12 links">

                <ul>
                <?php if($this->main_model->is_logged_in()){ ?>
                    <li><a href="<?php echo base_url().'user/'.$userUsername; ?>">حسابي</a></li>
                <?php } ?>
                <?php
                $pages = $this->main_model->getFullRequest('site_pages',' (state = 1)');
                unset($pages[3]);
                unset($pages[4]);
                unset($pages[5]);
                if($pages){foreach($pages as $page){ ?>
                    <li><a href="<?php echo base_url('pages/spage/'.$page->id); ?>"><?php echo $page->title; ?></a></li>
                <?php }} ?>
                    <li><a href="<?php echo base_url('pages/description'); ?>">كيف يعمل الموقع</a></li>
                    <li><a href="<?php echo base_url('pages/community'); ?>">قسم المنتجات الغير موجودة</a></li>

                    <li><a href="<?php echo base_url().'pages/blog/'; ?>">مدونة استشارة</a></li>

                    <li><a href="<?php echo base_url('pages/service'); ?>">الدعم الفني</a></li>

                </ul>

            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 links">


            </div>

            <div  class="col-lg-3 col-md-3 col-sm-12 links">

                <div class="f_item">

                    <span class="fa fa-envelope enve"></span>

                    <p class="f_ti" style="margin-top: 8px;">بريدنا</p>

                    <p><?php echo $ettings['email']; ?></p>

                </div>
                <?php if($ettings['show_state'] == 1){ ?>
                <div class="f_item">

                    <div>

                        <a href="<?php echo $ettings['instagram']; ?>"><span class="fab fa-instagram"></span></a>

                        <a href="<?php echo $ettings['facebook']; ?>"><span class="fab fa-facebook"></span></a>

                        <a href="<?php echo $ettings['twitter']; ?>"><span class="fab fa-twitter"></span></a>


                   </div>

                </div>
                <?php } ?>
            </div>

        </footer>

          <h6 class="h_footer">
          <?php
                $pages = $this->main_model->getFullRequest('site_pages',' (state = 1)');
                unset($pages[0]);
                unset($pages[1]);
                unset($pages[2]);
                if($pages){foreach($pages as $page){ ?>
                    <a href="<?php echo base_url('pages/spage/'.$page->id); ?>"><?php echo $page->title; ?></a>
        <?php }} ?>

              <span>جميع الحقوق محفوظة لموقع استشارة</span>

          </h6>

      </div>

      

      <!-- Bootstrap core JavaScript -->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="<?php echo base_url(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url().'vendor/js/home.js'; ?>"></script>
        <?php if($this->main_model->is_logged_in()){ ?>

<script type="text/javascript">
$('input[id^="guUp"]').change(function() {
    var rep_id = $(this).attr('dataId');
    var cartgu_id = $(this).attr('dataGuId');
    var gu_id = $(this).attr('dataReqGu');
       // your code go here
      $.ajax({
          url:"<?php echo base_url('users/cartRequests/'); ?>",
          type:"POST",
          dataType: "json",
          async: true,
          data: {
              'rep_id' : rep_id,
              'cartgu_id' : cartgu_id,
              'gu_id' : gu_id,
              'rep' : $(this).val(),
              'request' : 'gu',
          },
          success:function(response){
              if(response.done == 1){
                console.log(response);
              }
              }
      });
    });
  function cartItem(i_id,cart_id){
       // your code go here
      $.ajax({
          url:"<?php echo base_url('users/cartRequests/'); ?>",
          type:"POST",
          dataType: "json",
          async: true,
          data: {
              'i_id' : i_id,
              'cart_id' : cart_id,
              'rep' : $('#cart_'+i_id).val(),
              'request' : 'repeat',
          },
          success:function(response){
              if(response.done == 1){
                $('.selected-val').removeAttr('selected');
                $('.selected-val').removeAttr('class');
                $('#cart_option_'+i_id+'_'+response.result).attr('selected','selected');
                $('#cart_option_'+i_id+'_'+response.result).attr('class','selected-val');
              }
              }
      });
  }
function addToCart(id){
       // your code go here
      $.ajax({
          url:"<?php echo base_url('users/addToCart/'); ?>"+id,
          type:"POST",
          dataType: "json",
          async: true,
          data: {
              'id' : id,
              'request' : 'add',
          },
          success:function(response){
              if(response.done == 1){
                var allCarts = '';
                for (var i=0; i<response.cartItems.length; i++) {
                    allCarts += '<div class="d_item"><p><span class="cart-num">X '+response.cartItems[i]['num']+'</span> <b><a href="'+response.cartItems[i]['link']+'" style="margin-top:5px;float:right;">'+response.cartItems[i]['title']+'</a></b></p></div>';
                }
                $('.mini-cartItems').html(allCarts);
                $('.cart-alert').html('<span class="fa fa-bell"></span>');
              }
              }
      });
  }
  function removeFromCart(id){
       // your code go here
      $.ajax({
          url:"<?php echo base_url('users/addToCart/'); ?>"+id,
          type:"POST",
          dataType: "json",
          async: true,
          data: {
              'id' : id,
              'request' : 'remove',
          },
          success:function(response){
            var allCarts = '';
              if(response.done == 1){
                    for (var i=0; i<response.cartItems.length; i++) {
                        allCarts += '<tr><th scope="row">'+i+'</th><td><p><b><a href="'+response.cartItems[i]['link']+'" style="margin-top:5px;float:right;">'+response.cartItems[i]['title']+'</a></b></p></td><td><select name="cart_'+response.cartItems[i]['id']+'" id="cart_'+response.cartItems[i]['id']+'">'+response.cartItems[i]['options']+'</select></td><td><span class="fa fa-times" onClick="return removeFromCart('+response.cartItems[i]['id']+')" style="color:red;"></span></td></tr>';
                    }
                $('#cartContent').html(allCarts);
              }else{
                allCarts += '<h4 class="cart-empty">السلة فارغة</h4>';
                $('#cartContent').html(allCarts);
              }
              }
      });
  }
  $('#cartCheck').click(function() {
      $('.cart-alert').html('');
  });
function seen(id){
       // your code go here
      $.ajax({
          url:"<?php echo base_url('users/fetchalerts/'); ?>",
          type:"POST",
          dataType: "json",
          async: true,
          data: {
              'id' : id,
              'request' : 'seen',
          },
          success:function(response){
              if(response.done == 1){
                  $('.al-num').html('');
              }
              }
      });
  }

    setInterval(function(){
       $.ajax({
          url:"<?php echo base_url('users/fetchalerts/'); ?>",
          type:"POST",
          dataType: "json",
          async: true,
          data: {
              'id' : <?php echo $this->session->userdata('id'); ?>,
              'request' : 'unseen',
          },
          success:function(response){
                  if(response.done == 1){
                      $('.al-num').html('<div class="alerts-nums">'+response.nums+'</div>');
                      var allAlerts = '';
                      for (var i=0; i<response.alerts.length; i++) {
                          allAlerts += '<div class="d_item"><p><b>'+response.alerts[i].title+'</b></p>'+response.alerts[i].description+'</div>';
                      }
                      $('.allalerts').html(allAlerts);
                  }
              }
      });
      }, 20000);
</script>
<?php } ?>

<?php if($this->uri->segment(1) == 'users' && $this->uri->segment(2) == 'rate'){ ?>
    <script type="text/javascript">
        function rate(num,rsec){
            for(var x = 1 ; x<=6 ;x++){
                $('#rs'+x+'_'+rsec+'').removeClass('rating-starCo');
            }
            for(var i = 1 ; i<=num ;i++){
                $('#rs'+i+'_'+rsec+'').addClass('rating-starCo');
            }
            $('#rNum'+rsec+'').html('('+num+')');
            $('#rNum'+rsec+'').attr('data',num);
            $('#rs_i'+rsec+'').val(num);
            var allRate = parseFloat((parseInt($('#rNum1').attr('data'))+parseInt($('#rNum2').attr('data'))+parseInt($('#rNum3').attr('data'))+parseInt($('#rNum4').attr('data'))+parseInt($('#rNum5').attr('data'))+parseInt($('#rNum6').attr('data')))/6).toFixed(2);
            $('.Stars').attr('style','--rating: '+allRate+';');
            $('.Stars').attr('aria-label','Rating of this product is '+allRate+' out of 5.');
            $('#allRate').html('('+allRate+')');
            $('#allRate').attr('data',allRate);
        }
    </script>
<?php } ?>
<?php if($this->uri->segment(1) == 'pages' && $this->uri->segment(2) == 'search' && $this->uri->segment(3) !== ''){ ?>
    <script type="text/javascript">
    var parts = window.location.search.substr(1).split("&");
    var $_GET = {};
    for (var i = 0; i < parts.length; i++) {
        var temp = parts[i].split("=");
        $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
    }
        function getTagResults(tag_id,kind){
            
            // your code go here

            $.ajax({

            url:"<?php echo base_url('pages/searchFilter/'); ?>",

            type:"POST",

            dataType: "json",

            async: true,

            data: {
            'tag_id' : tag_id,
            'search' : $_GET['search'],
            'kind' : kind
            },

            success:function(response){

                if(response.done == 1){
                    $('.a-active').removeClass('a-active');
                    $('#subtag-filter-'+tag_id+'').addClass('a-active');
                    var allItems = '';
                    if(response.kind == 1){
                        //GIGS
                        for (var i=0; i<response.results.length; i++) {
                            allItems += '<div class="b_item col-lg-4 col-md-4 col-sm-6"><div class="service"><a href="'+response.results[i].link+'"><img src="'+response.results[i].image+'" alt="'+response.results[i].title+'"></a><h6><a href="'+response.results[i].link+'">'+response.results[i].title+'</a></h6><a href="'+response.results[i].link+'"><div class="buy_this">'+response.results[i].counter+'</div></a></div></div>';
                        }
                        $('.b_items').html(allItems);
                    }else if(response.kind == 2){
                        //Projects
                        for (var i=0; i<response.results.length; i++) {
                            allItems += '<div class="col-lg-12 col-md-12 col-sm-12 project my-3"><h4 class="project-title"><a href="'+response.results[i].link+'">'+response.results[i].title+'</a></h4><div class="project-snip"><span class="fa fa-clock"></span>منذ '+response.results[i].date+'<span class="fa fa-tags"></span> قسم : <a href="#">'+response.results[i].mtag+'</a> | <span class="fa fa-tag"></span> تصنيف : <a href="#">'+response.results[i].subtag+'</a></div><div class="col-lg-12 col-md-12 col-sm-12 project-content">'+response.results[i].content+'</div><div class="budget">الميزانية '+response.results[i].price+' $</div></div>';
                        }
                        $('.b_items').html(allItems);
                    }
                    if(response.results === false){
                        $('.b_items').html('<h3>لايوجد نتائج في هذه الصفحة</h3>');
                    }
                }
                $('#tag_id_input').val(tag_id);
                }

            });

            }
            function getAdvResults(){
            var rates = $('#rates-filter').val(),
                prof = $('#prof-filter').val(),
                country = $('#country-filter').val(),
                active = $('#active-filter').val();
            // your code go here

            $.ajax({

            url:"<?php echo base_url('pages/searchFilter/'); ?>",

            type:"POST",

            dataType: "json",

            async: true,

            data: {
            'tag_id' : $('#tag_id_input').val(),
            'search' : $_GET['search'],
            'rates' : rates,
            'prof' : prof,
            'country' : country,
            'active' : active
            },

            success:function(response){

                if(response.done == 1){
                    $('.a-active').removeClass('a-active');
                    $('#subtag-filter-'+$('#tag_id_input').val()+'').addClass('a-active');
                    $('.a-active').removeClass('a-active');
                    $('#subtag-filter-'+$('#tag_id_input').val()+'').addClass('a-active');
                    var allItems = '';
                    if(response.kind == 1){
                        //GIGS
                        for (var i=0; i<response.results.length; i++) {
                            allItems += '<div class="b_item col-lg-4 col-md-4 col-sm-6"><div class="service"><a href="'+response.results[i].link+'"><img src="'+response.results[i].image+'" alt="'+response.results[i].title+'"></a><h6><a href="'+response.results[i].link+'">'+response.results[i].title+'</a></h6><a href="'+response.results[i].link+'"><div class="buy_this">'+response.results[i].counter+'</div></a></div></div>';
                        }
                        $('.b_items').html(allItems);
                    }else if(response.kind == 2){
                        //Projects
                        for (var i=0; i<response.results.length; i++) {
                            allItems += '<div class="col-lg-12 col-md-12 col-sm-12 project my-3"><h4 class="project-title"><a href="'+response.results[i].link+'">'+response.results[i].title+'</a></h4><div class="project-snip"><span class="fa fa-clock"></span>منذ '+response.results[i].date+'<span class="fa fa-tags"></span> قسم : <a href="#">'+response.results[i].mtag+'</a> | <span class="fa fa-tag"></span> تصنيف : <a href="#">'+response.results[i].subtag+'</a></div><div class="col-lg-12 col-md-12 col-sm-12 project-content">'+response.results[i].content+'</div><div class="budget">الميزانية '+response.results[i].price+' $</div></div>';
                        }
                        $('.b_items').html(allItems);
                    }
                    if(response.results === false){
                        $('.b_items').html('<h3>لايوجد نتائج في هذه الصفحة</h3>');
                    }
                }

                }

            });

            }
    </script>
<?php } ?>

<?php if($this->uri->segment(1) == 'users' && $this->uri->segment(2) == 'chat' && $this->uri->segment(3) !== ''){ ?>
    <script type="text/javascript">
        function sendMsg(f_id,to_id,c_id){
            // your code go here

            $.ajax({

            url:"<?php echo base_url('users/sendMsg/'); ?>",

            type:"POST",

            dataType: "json",

            async: true,

            data: {
            'message' : $('#message').val(),
            'f_id' : f_id,
            'to_id' : to_id,
            'c_id' : c_id
            },

            success:function(response){

                if(response.sent == 1){

                    $('#message').val('');
                        $.ajax({
                            url:"<?php echo base_url('users/fetchmsgs/'); ?>",
                            type:"POST",
                            dataType: "json",
                            async: true,
                            data: {
                                'c_id' : $('#c_id').val()
                            },
                            success:function(response){
                                    if(response.done == 1){
                                        var allAlerts = '';
                                        for (var i=0; i<response.messages.length; i++) {
                                            if(response.messages[i].f_id == <?php echo $this->session->userdata('id'); ?>){
                                                if(response.messages[i].differ == ''){
                                                    if(response.messages[i].state == 1){
                                                        allAlerts += '<div class="chatMsg fromMe stateMsg">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">الان</div>';
                                                    }else{
                                                        allAlerts += '<div class="chatMsg fromMe">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">الان</div>';
                                                    }
                                                }else{
                                                    if(response.messages[i].state == 1){
                                                        allAlerts += '<div class="chatMsg fromMe stateMsg">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">منذ '+response.messages[i].differ+'</div>';
                                                    }else{
                                                        allAlerts += '<div class="chatMsg fromMe">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">منذ '+response.messages[i].differ+'</div>';
                                                    }
                                                }
                                            }else {
                                                if(response.messages[i].differ == ''){
                                                    if(response.messages[i].state == 1){
                                                        allAlerts += '<div class="chatMsg stateMsg">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">الان</div>';
                                                    }else{
                                                        allAlerts += '<div class="chatMsg">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">الان</div>';
                                                    }
                                                }else{
                                                    if(response.messages[i].state == 1){
                                                        allAlerts += '<div class="chatMsg stateMsg">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">منذ '+response.messages[i].differ+'</div>';
                                                    }else{
                                                        allAlerts += '<div class="chatMsg">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">منذ '+response.messages[i].differ+'</div>';
                                                    }
                                                }
                                            }
                                        }
                                        $('.chatMsgs').html(allAlerts);
                                    }
                                }
                        });
                    $(".chatMsgs").animate({ scrollTop: $('.chatMsgs').prop("scrollHeight")}, 1000);
                }

                }

            });

            }
            setInterval(function(){
                 $.ajax({
                    url:"<?php echo base_url('users/fetchmsgs/'); ?>",
                    type:"POST",
                    dataType: "json",
                    async: true,
                    data: {
                        'c_id' : $('#c_id').val()
                    },
                    success:function(response){
                            if(response.done == 1){
                                var allAlerts = '';
                                for (var i=0; i<response.messages.length; i++) {
                                    if(response.messages[i].f_id == <?php echo $this->session->userdata('id'); ?>){
                                        if(response.messages[i].state == 1){
                                            allAlerts += '<div class="chatMsg fromMe stateMsg">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">منذ '+response.messages[i].differ+'</div>';
                                        }else{
                                            allAlerts += '<div class="chatMsg fromMe">'+response.messages[i].message+'</div><div class="msg-date fromMeMsg">منذ '+response.messages[i].differ+'</div>';
                                        }
                                    }else {
                                        if(response.messages[i].state == 1){
                                            allAlerts += '<div class="chatMsg stateMsg">'+response.messages[i].message+'</div><div class="msg-date">منذ '+response.messages[i].differ+'</div>';
                                        }else{
                                            allAlerts += '<div class="chatMsg">'+response.messages[i].message+'</div><div class="msg-date">منذ '+response.messages[i].differ+'</div>';
                                        }
                                    }
                                }
                                $('.chatMsgs').html(allAlerts);
                            }
                        }
                });
                }, 5000);
                function getChats(){
                    $.ajax({
                    url:"<?php echo base_url('users/fetchTabs/'); ?>",
                    type:"POST",
                    dataType: "json",
                    async: true,
                    data: {
                        'fetchFor' : 'chats'
                    },
                    success:function(response){
                            if(response.done == 1){
                                var allChats = '';
                                for (var i=0; i<response.chats.length; i++) {
                                    if(response.chats !== 0){
                                        allChats += '<a href="'+response.chats[i].link+'"><div class="col-lg-12 col-md-12 col-sm-12 float-right chat-user"><img src="'+response.chats[i].image+'" /><span>'+response.chats[i].firstname+' '+response.chats[i].lastname+'</span></div></a>';
                                    }else if(response.chats == 0){
                                        $('.tab-con').html('<h4>لا يوجد قنوات تواصل بعد.</h4>');
                                    }
                                }
                                $('.tab-con').html(allChats);
                            }
                        }
                });
                }
                function getAlerts(){
                    $.ajax({
                    url:"<?php echo base_url('users/fetchTabs/'); ?>",
                    type:"POST",
                    dataType: "json",
                    async: true,
                    data: {
                        'chat' : '<?php echo (int) strip_tags($this->uri->segment(3)); ?>',
                        'fetchFor' : 'alerts'
                    },
                    success:function(response){
                            if(response.done == 1){
                                var allAlerts = '';
                                for (var i=0; i<response.alerts.length; i++) {
                                    if(response.alerts[i].caseMsg == 'endRequest'){
                                        if(response.items[i].kind < 2){
                                            //Gig
                                            var linkPrams = '/'+response.items[i].billU_id+'/'+response.items[i].billAmount;
                                            var cancelLink = '<a target="_blank" class="btn btn-danger accept-pro" href="<?php echo base_url(); ?>users/closePro/'+response.alerts[i].i_id+linkPrams+'/'+response.items[i].billId+'/'+response.alerts[i].id+'"><span class="fa fa-trash"></span> رفض</a>';
                                        }else{
                                            var linkPrams = '';
                                            var cancelLink = '<a target="_blank" class="btn btn-danger accept-pro" href="<?php echo base_url(); ?>users/closeProj/'+response.alerts[i].i_id+'/'+response.alerts[i].id+'"><span class="fa fa-trash"></span> رفض</a>';
                                        }
                                        if(response.alerts[i].u_id !== $('#u_id').val()){
                                            var message = '<div class="chatMsg stateMsg"><p>قام مُستشارك بطلب تسليم <a target="_blank" href="'+response.items[i].link+'">'+response.items[i].title+'</a></p><p><a target="_blank" class="btn btn-success accept-pro" href="<?php echo base_url(); ?>users/acceptPro/'+response.alerts[i].i_id+linkPrams+'"><span class="fa fa-trophy"></span> استلام</a>'+cancelLink+'</p></div>';
                                        }else{
                                            var message = '<div class="chatMsg stateMsg"><p>لقد قمت بعمل طلب تسليم <a target="_blank" href="'+response.items[i].link+'">'+response.items[i].title+'</a></p></div>';
                                        }
                                    }else if(response.alerts[i].caseMsg == 'ended'){
                                        var message = '<div class="chatMsg stateMsg"><p>لقد تم استلام <a target="_blank" href="'+response.items[i].link+'">'+response.items[i].title+'</a> بنجاح</p></div>';
                                    }
                                    allAlerts += message;
                                }
                                $('.tab-con').html(allAlerts);
                            }
                        }
                });
                }
                var inputFile = $('#p_file');
                // File upload via Ajax
                $("#upload-btn").on('click', function(e){
                    var fileToUpload = inputFile[0].files[0];
                    // make sure there is file to upload
                    if (fileToUpload != 'undefined') {
                        // provide the form data
                        // that would be sent to sever through ajax
                        var formData = new FormData();
                        formData.append("file", fileToUpload);
                    }
                    e.preventDefault();
                    $.ajax({
                        xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                $(".progress-bar").width(parseFloat(percentComplete).toFixed(2) + '%');
                                $(".progress-bar").html(parseFloat(percentComplete).toFixed(2)+'%');
                            }
                        }, false);
                        return xhr;
                    },
                    url:"<?php echo base_url('users/uploader/'.strip_tags($this->uri->segment(3))); ?>",
                    type:"POST",
                    dataType: "json",
                    async: true,
                    contentType: false,
                    cache: false,
                    processData:false,
                    data: formData,
                    beforeSend: function(){
                        $(".progress-bar").width('0%');
                        $('.progress').fadeIn();
                        $('#upload-btn').fadeOut();
                    },
                    error:function(){
                        $('#uploadStatus').html('<p style="color:#EA4335;">برجاء اختيار ملف صالح.</p>');
                        $('#upload-btn').fadeIn();
                        $('.progress').fadeOut();
                    },
                    success:function(response){
                            if(response.done == 1){
                                $('#upload-btn').fadeIn();
                                $('.progress').fadeOut();
                            }
                        }
                });
                });
                setInterval(function(){
                        $.ajax({
                        url:"<?php echo base_url('users/fetchTabs/'); ?>",
                        type:"POST",
                        dataType: "json",
                        async: true,
                        data: {
                            'chat' : '<?php echo (int) strip_tags($this->uri->segment(3)); ?>',
                            'fetchFor' : 'files'
                        },
                        success:function(response){
                                if(response.done == 1){
                                    var allFiles = '';
                                    for (var i=0; i<response.files.length; i++) {
                                        allFiles += '<div class="file-con"><p><a href="'+response.files[i].link+'">'+response.files[i].client_name+'</a></p><p class="file-date">'+response.files[i].date+'</p></div>';
                                    }
                                    $('.tab-con-files').html(allFiles);
                                }
                            }
                    });
                    },5000);
            $('.chat-tab').click(function() {
                $('.tab-con').html('');
                $('.chat-active').removeClass('chat-active');
                $(this).addClass('chat-active');
                if($(this).attr('id') == 'forUsers'){
                    getChats();
                }else if($(this).attr('id') == 'forAlerts'){
                    getAlerts();
                }
            })
    </script>
<?php } ?>

<?php if($this->uri->segment(1) == 'users' && $this->uri->segment(2) == 'skills'){ ?>

        <script type="text/javascript">

            $('#skills').keyup(function() {

                    var skillToSearch = $(this).val();

                if(skillToSearch != ''){

                $.ajax({

                    url:"<?php echo base_url('users/skillsRequest/'); ?>",

                    type:"POST",

                    dataType: "json",

                    async: true,

                    data: {

                        'skill' : skillToSearch,

                        'request' : 'select',

                    },

                    success:function(response){

                        $('.searchitems').html('');

                        if(!response.skills.length){

                            $('.searchResult').html('<ul class="searchitems" id="searchitems"><span class="s-empty"><b>لايوجد نتيجة مشابهة للمكتوب في الحقل</b></span></ul>');

                        }else{

                        for (var i=0; i<response.skills.length; i++) {

                            var node = document.createElement("LI");                 // Create a <li> node

                            var textnode = document.createTextNode(response.skills[i].skill);         // Create a text node

                            node.appendChild(textnode);                              // Append the text to <li>

                            document.getElementById("searchitems").appendChild(node);     // Append <li> to <ul> with id="myList"

                            node.setAttribute("id",response.skills[i].id);

                            node.setAttribute("onClick",'return addRequest('+response.skills[i].id+')');

                            $('.s-empty').html('');

                        }

                    }

                    }

                });

            }else{

                $('.searchResult').html('<ul class="searchitems" id="searchitems"><span class="s-empty"><b>لايوجد نتيجة مشابهة للمكتوب في الحقل</b></span></ul>');

            }

            });

            function addRequest(id){

                 // your code go here

                $.ajax({

                    url:"<?php echo base_url('users/skillsRequest/'); ?>",

                    type:"POST",

                    dataType: "json",

                    async: true,

                    data: {

                        'skill' : id,

                        'request' : 'add',

                    },

                    success:function(response){

                        if(response.minus > 0){

                            $('#'+id).remove();

                            if($('.searchitems').children().length == 0){

                            $('.searchResult').html('<ul class="searchitems" id="searchitems"><span class="s-empty"><b>لايوجد نتيجة مشابهة للمكتوب في الحقل</b></span></ul>');

                        }

                        }else{

                            $('.searchResult').html('<ul class="searchitems" id="searchitems"><span class="s-empty"><b>لقد تم إضافة اخر مهارة ولا تستطيع إضافة المزيد.</b></span></ul>');

                        }

                        $('#min-num').html(response.minus);

                        $('#min-num2').html(response.minus);

                        }

                });

                $.ajax({

                    url:"<?php echo base_url('users/skillsRequest/'); ?>",

                    type:"POST",

                    dataType: "json",

                    async: true,

                    data: {

                        'request' : 'userSkills',

                    },

                    success:function(response){

                        var allSkills = '';

                            for (var i=0; i<response.skills.length; i++) {

                                allSkills += '<!--Skill--><div id="'+response.skills[i].id+'_skill" class="u-skill"><div class="skill"><span class="fa fa-tag"></span> '+response.skills[i].skill+' <span onClick="return delSkill('+response.skills[i].id+')" class="fa fa-times delSkill"></span></div></div>';

                            }

                        $('.allSkills').html(allSkills);

                        }

                });

              }

            function delSkill(id){

                 // your code go here

                $.ajax({

                    url:"<?php echo base_url('users/skillsRequest/'); ?>",

                    type:"POST",

                    dataType: "json",

                    async: true,

                    data: {

                        'skill' : id,

                        'request' : 'delete',

                    },

                    success:function(response){

                        if(response.skills == 1){

                            $('#'+id+'_skill').remove();

                            $('#min-num').html(response.minus);

                            $('#min-num2').html(response.minus);

                        }

                        }

                });

            }
            

        </script>

<?php } ?>
<?php if($this->uri->segment(1) == 'users') { ?>
    <script type="text/javascript">
        $('#mtag').on('change',function() {
            $('.s-tags').fadeOut();
            $('#'+$(this).val()).fadeIn();
        });
        $('select[id^="subtag_"]').on('change',function() {
            $('input[name=subtag]').val($(this).val());
        });
    </script>
<?php } ?>
<?php echo $ettings['body']; ?>
  </body>

</html>
<?php } ?>