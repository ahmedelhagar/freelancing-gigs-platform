<?php $this->load->view('include/header.php'); ?>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>



<div class="container-fluid m_top">

    <?php

        $result = $this->main_model->is_logged_in(strip_tags($this->session->userdata('username')));

    if($result){

        $currentUser = (array) $result[0]; /*To Get Current user*/

        // Check if activated

        if($currentUser['state'] == 0){

            //Not Activated

            if($this->session->userdata('username') == $currentUser['username']){

                echo '

                <div class="alert alert-danger" role="alert">

                  حسابك غير مُفعل يمكن أن تجد رسالة التفعيل في الرسائل الغير مرغوبة أو 

                  <b><a href="'.base_url().'activate/reactivate/"> أرسل كود تفعيل جديد</a></b>

                </div>

                ';

            }else{

                redirect(base_url().'user/');/*Not Found*/

            }

        }

    }else{

        redirect(base_url().'user/');/*Not Found*/

    }

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

                $userAbout = $userData['about'];

                $userL_logout = $userData['l_logout'];

            }

      ?>

    <div class="col-lg-12 col-md-12 col-sm-12 s-pro">

                <div class="col-lg-12 col-md-12 col-sm-12 s_block">

                    <h4>اختر طريقة الدفع</h4>

                    <div class="f-pay"><?php echo $amount.'$'; ?></div>

                    <div class="col-lg-12 col-md-12 col-sm-12 b_blocks float-right">

                            <div class="col-lg-12 col-md-12 col-sm-12 balance_block2 float-right">

                                <!-- Checkout button -->

                                <div id="paypal-button"></div>

                            </div>

                    </div>

                </div>

    </div>

    </div>

<!--

JavaScript code to render PayPal checkout button

and execute payment

-->

<script>

  paypal.Button.render({

    // Configure environment

    env: 'sandbox',

    client: {

      sandbox: '<?php echo $this->main_model->paypalClientID; ?>',

      production: '<?php echo $this->main_model->paypalClientID; ?>'

    },

    // Customize button (optional)

    locale: 'en_US',

    style: {

      size: 'responsive',

      color: 'gold',

      shape: 'pill',

    fundingicons: true,

    },

      



    // Enable Pay Now checkout flow (optional)

    commit: true,



    // Set up a payment

    payment: function(data, actions) {

      return actions.payment.create({

        transactions: [{

          amount: {

            total: '<?php echo $amount; ?>',

            currency: 'USD'

          }

        }]

      });

    },

    // Execute the payment

    onAuthorize: function(data, actions) {

      return actions.payment.execute().then(function() {

        // Show a confirmation message to the buyer

          window.location = "<?php echo base_url().'users/processCheck/'; ?>?paymentID="+data.paymentID+"&token="+data.paymentToken+"&payerID="+data.payerID+"&clearAmount=<?php echo $clearAmount; ?>";

      });

    }

  }, '#paypal-button');

</script>

<?php $this->load->view('include/footer.php'); ?>