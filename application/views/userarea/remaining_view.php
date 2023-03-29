<?php $this->load->view('include/header.php');
if ($this->session->flashdata('done')) {
    echo '<div class="alert alert-success alert-dismissible fade show flash-data" role="alert">' . $this->session->flashdata('done') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';
} elseif ($this->session->flashdata('error')) {
    echo '<div class="alert alert-danger alert-dismissible fade show flash-data" role="alert">' . $this->session->flashdata('error') . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">

<span aria-hidden="true">&times;</span>

</button></div>';
}
?>

<div class="container-fluid m_top">

    <?php

$viewUser = (array) $this->main_model->is_logged_in($this->uri->segment(2));
$viewUser = $viewUser[0];

$posUser = (array) $this->main_model->is_logged_in($this->uri->segment(3));
$posUser = $posUser[0];

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

          // Check if activated

        if($userState == 0 && $this->uri->segment(1) !== 'user' && $this->uri->segment(2) !== 'p' && $userUsername !== $this->uri->segment(3)){

            //Not Activated

                redirect(base_url().'activate/reactivate/');

        }

        }

    elseif($viewUser){

                $userId = $viewUser['id'];

                $userFirstname = $viewUser['firstname'];

                $userLastname = $viewUser['lastname'];

                $userUsername = $viewUser['username'];

                $userEmail = $viewUser['email'];

                $userCountry = $viewUser['country'];

                $userMobile = $viewUser['mobile'];

                $userAddress = $viewUser['address'];

                $userPostal = $viewUser['postal'];

                $userIp = $viewUser['ip'];

                $userRate = $viewUser['rate'];

                $userA_balance = $viewUser['a_balance'];

                $userAds_balance = $viewUser['ads_balance'];

                $userBalance = $viewUser['balance'];

                $userC_balance = $viewUser['c_balance'];

                $userDate = $viewUser['date'];

                $userState = $viewUser['state'];

                $userAll_balance = $viewUser['all_balance'];

                $userImage = $viewUser['image'];

                $userAbout = $viewUser['about'];

                $userL_logout = $viewUser['l_logout'];

      }

    elseif($posUser){

                $userId = $posUser['id'];

                $userFirstname = $posUser['firstname'];

                $userLastname = $posUser['lastname'];

                $userUsername = $posUser['username'];

                $userEmail = $posUser['email'];

                $userCountry = $posUser['country'];

                $userMobile = $posUser['mobile'];

                $userAddress = $posUser['address'];

                $userPostal = $posUser['postal'];

                $userIp = $posUser['ip'];

                $userRate = $posUser['rate'];

                $userA_balance = $posUser['a_balance'];

                $userAds_balance = $posUser['ads_balance'];

                $userBalance = $posUser['balance'];

                $userC_balance = $posUser['c_balance'];

                $userDate = $posUser['date'];

                $userState = $posUser['state'];

                $userAll_balance = $posUser['all_balance'];

                $userImage = $posUser['image'];

                $userAbout = $posUser['about'];

                $userL_logout = $posUser['l_logout'];

      }

      ?>  

    <br />

    

<?php $this->load->view('include/userSideBar_view.php'); ?>

    

    <div class="col-lg-8 col-md-8 col-sm-12 s-pro projects">
        <?php if($remains){foreach($remains as $remain){ ?>
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">عملية غير مكتملة على خدمة : <?php 
                $item = $this->main_model->getFullRequest('items','(id = '.$remain->id.')');
                if($item){
                    echo '<a href="'.base_url().'i/'.str_replace(' ','-',$item[0]->title).'/'.$item[0]->id.'/'.'">'.$item[0]->title.'</a>';
                }
            ?></h4>
            <p>لقد قمت بدفع <?php echo '$'.$remain->paid; ?> من اجمالي قيمة طلبية بمبلغ <?php echo '$'.($remain->paid+$remain->remaining); ?> وتبقى مبلغ مديونية بقيمة <?php echo '$'.$remain->remaining; ?> حتى يتم تنفيذ الطلبية.</p>
            <hr>
            <p class="mb-0"><a href="<?php echo base_url('users/completeRemain/'.$remain->id); ?>" class="btn btn-success"><span class="fa fa-credit-card"></span> ادفع المديونية</a></p>
        </div>
        <?php }} ?>
    </div>
</div>

<?php $this->load->view('include/footer.php'); ?>