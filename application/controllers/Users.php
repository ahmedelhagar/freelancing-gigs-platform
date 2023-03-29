<?php
class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    public $viewed;
    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('cookie');
        $this->load->library("pagination");
        if($this->main_model->is_logged_in($this->uri->segment(3),'No')){
            $this->viewed = $this->main_model->is_logged_in($this->uri->segment(3));
        }elseif($this->main_model->is_logged_in($this->uri->segment(2),'No')){
            $this->viewed = $this->main_model->is_logged_in($this->uri->segment(2));
        }else{
            $this->viewed = $this->main_model->is_logged_in(1);
        }
        if($this->main_model->is_logged_in()){
            if($this->session->userdata('username') == '' && $this->uri->segment(2) !== 'createUserName' && $this->uri->segment(2) !== 'createUserNameCheck'){
                redirect(base_url('users/createUserName'));
            }
        }
        $url = strip_tags($this->input->get('url'));
            if(isset($url) && $url !== ''){
                set_cookie(array(
                    'name'   => 'url',
                    'value'  => $url,
                    'expire' => time()+86500
                ));
            }
            if($this->main_model->is_logged_in() && get_cookie('url') !== null){
                $url = base64_decode(get_cookie('url'));
                delete_cookie('url');
                redirect($url);
            }
    }
    public function index(){
                $data['title']='لوحة التحكم في حسابك في موقع استشارة | موقع استشارة';
                $data['userviewed'] = $this->viewed;
                // Convert c_balance To a_balance
                if($this->main_model->is_logged_in()){
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $id = $userData['id'];
                $this->main_model->convertBalance($id,$userData['a_balance'],$userData['c_balance']);
                }
                $this->load->view('userarea/user_view',$data);
    }
    public function acceptProConfirm(){
    $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $i_id = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getByData('items','id',$i_id)[0];
            $data['title'] = 'تأكيد الاستلام';
            $this->load->view('include/header',$data);
            $this->load->view('include/userSideBar_view',$data);
            $this->load->view('userarea/reciveConfirm_view',$data);
            $this->load->view('include/footer',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    public function payments(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            // Convert c_balance To a_balance
                if($this->main_model->is_logged_in()){
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $id = $userData['id'];
                $data['payments'] = $this->main_model->getFullRequest('payments','(u_id = '.$userData['id'].')');
                $data['projects'] = $this->main_model->getFullRequest('promsg','(u_id = '.$userData['id'].') OR (s_id = '.$userData['id'].')');
                $data['gigs'] = $this->main_model->getFullRequest('requestedgigs','(u_id = '.$userData['id'].') OR (s_id = '.$userData['id'].')');
                $data['requested'] = $this->main_model->getFullRequest('requestedbalance','(u_id = '.$userData['id'].')');
                $this->main_model->convertBalance($id,$userData['a_balance'],$userData['c_balance']);
                }
                $data['title']='الرصيد | موقع استشارة';
                $this->load->view('userarea/payments_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    public function cartBill(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $userCart = $this->main_model->getByData('cart','u_id',$userData['id']);
            $data['title']='عربة التسوق | موقع استشارة';
            $this->load->view('userarea/bill_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    public function cartRequests(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $request = strip_tags($this->input->post('request'));
            if($request == 'repeat'){
                $cart_id = (int) strip_tags($this->input->post('cart_id'));
                $i_id = (int) strip_tags($this->input->post('i_id'));
                $rep = (int) strip_tags($this->input->post('rep'));
                $userCart = $this->main_model->getByData('cart','id',$cart_id)[0];
                $i_idsArray = explode(',',$userCart->i_ids);
                $newValues = array_diff($i_idsArray,array($i_id));
                $newValues = implode(',',$newValues);
                $i = 1;
                while($i <= $rep){
                    $newValues .= ','.$i_id;
                $i++;}
                $this->main_model->update('cart','id',$cart_id,array(
                    'i_ids' => $newValues
                ));
                $response = array(
                    'done' => 1,
                    'result' => $rep
                );
                echo json_encode($response);
            }elseif($request == 'gu'){
                $rep_id = (int) strip_tags($this->input->post('rep_id'));
                $cartgu_id = (int) strip_tags($this->input->post('cartgu_id'));
                $gu_id = (int) strip_tags($this->input->post('gu_id'));
                $rep = (int) strip_tags($this->input->post('rep'));
                $cartgu = $this->main_model->getByData('cartgu','id',$cartgu_id)[0];
                $gu = $this->main_model->getByData('gigupdates','id',$gu_id)[0];
                $cart = $this->main_model->getByData('cart','id',$cartgu->cart_id)[0];
                $guAmount = explode(', ',$gu->amount);
                $guAm = 0;
                  if(isset($guAmount[$rep_id])){
                    $guAm = $guAmount[$rep_id];
                  }
                $newTotal = $cartgu->gigsUp+$guAm;
                $ui_reps = explode(', ',$cartgu->ui_rep);
                    if(isset($ui_reps[$rep_id])){
                        $ui_reps[$rep_id] = $rep;
                    }
                $newUi_reps = implode(', ',$ui_reps);
                // Update User Cart
                $cartgu = $this->main_model->update('cartgu','id',$cartgu_id,array(
                    'ui_rep' => $newUi_reps,
                    'gigsUp' => $newTotal
                ));
                $response = array(
                    'done' => 1
                );
                echo json_encode($response);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    public function cart(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $userCart = $this->main_model->getByData('cart','u_id',$userData['id']);
            $data['title']='عربة التسوق | موقع استشارة';
            $this->load->view('userarea/cart_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    public function addToCart(){
        if($this->main_model->is_logged_in()){
            $request = strip_tags($this->input->post('request'));
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $oldI_id = $newI_id = (int) strip_tags($this->input->post('id'));
            $data['item'] = $this->main_model->getByData('items','id',$newI_id)[0];
            if(!$data['item']){
                redirect(base_url('pages/404'));
            }
            $userCart = $this->main_model->getByData('cart','u_id',$userData['id']);
            if($request == 'add'){
            if(!$userCart){
                $cart_id = $this->main_model->insertData('cart',array(
                    'u_id' => $userData['id'],
                    'i_ids' => $newI_id,
                    'date' => $this->main_model->dateTime('current')
                ));
            }else{
                $this->main_model->update('cart','id',$userCart[0]->id,array(
                    'i_ids' => $userCart[0]->i_ids.','.$newI_id,
                    'date' => $this->main_model->dateTime('current')
                ));
                $cart_id = $userCart[0]->id;
            }
            $cart = $this->main_model->getByData('cart','u_id',$this->session->userdata('id'))[0];
            $cartItems = array_count_values(explode(',',$cart->i_ids));
            foreach($cartItems as $cartItem => $itemNum){
                if($cartItem !== ''){
                    $item = $this->main_model->getByData('items','id',$cartItem)[0];
                    $data['cartItems'][] = array(
                        'num' => $itemNum,
                        'link' => base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/',
                        'title' => $item->title
                    );
                    $gigupdates = $this->main_model->getFullRequest('gigupdates','(i_id = '.$item->id.')')[0];
                    if($gigupdates){
                        $gigAmounts = explode(', ',$gigupdates->amount);
                        $gigsUp = null;$gigsIds = null;$ui_rep = null;$i=0;
                        while($i <= 4){
                            if(isset($_COOKIE['gu_num_'.$i])){
                                if($_COOKIE['gu_num_'.$i] > 0){
                                    //Get Gig Updates
                                $gigsUp += $_COOKIE['gu_num_'.$i]*$gigAmounts[$i];
                                $gigsIds .= $i.', ';
                                $ui_rep .= $_COOKIE['gu_num_'.$i].', ';
                                }
                            }
                        $i++;}
                        $this->main_model->insertData('cartgu',array(
                            'gigsIds' => $gigsIds,
                            'gigsUp' => $gigsUp,
                            'ui_rep' => $ui_rep,
                            'cart_id' => $cart_id,
                            'i_id' => $item->id,
                            'date' => $this->main_model->dateTime('current')
                        ));
                    }
                }
            }
                $response = array(
                    'done' => 1,
                    'cartItems' => $data['cartItems']
                    );
            
            echo json_encode($response);
        }elseif($request == 'remove'){
            $cart = $this->main_model->getByData('cart','u_id',$this->session->userdata('id'))[0];
            $i_idsArray = explode(',',$cart->i_ids);
            $newValues = array_diff($i_idsArray,array($oldI_id));
            $this->main_model->update('cart','u_id',$this->session->userdata('id'),array(
                'i_ids' => implode(',',$newValues)
            ));
            $this->main_model->deleteArray('cartgu',array(
                'i_id' => $oldI_id,
                'cart_id' => $cart->id
            ));
            $cart = $this->main_model->getByData('cart','u_id',$this->session->userdata('id'))[0];
            $i_idsArray = explode(',',$cart->i_ids);
            $cartItems = array_count_values($i_idsArray);
            foreach($cartItems as $cartItem => $itemNum){
                if($cartItem !== '' AND $cartItem !== null){
                    $options = '';
                    $selected = '';
                    $x=1;while($x <= 20){
                        if($x == $itemNum){$selected = 'selected';}
                        $options .= '<option '.$selected.' value="'.$x.'">'.$x.'</option>';
                    $x++;}
                    $item = $this->main_model->getByData('items','id',$cartItem)[0];
                    $data['cartItems'][] = array(
                        'num' => $itemNum,
                        'id' => $cartItem,
                        'options' => $options,
                        'link' => base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/',
                        'title' => $item->title
                    );
                }else{
                    $data['cartItems'][] = array();
                }
            }
            if($cart->i_ids !== ''){
                $response = array(
                    'done' => 1,
                    'cartItems' => $data['cartItems']
                    );
            }else{
                $response = array(
                    'done' => 0,
                    'cartItems' => $data['cartItems']
                );
            }
            echo json_encode($response);
        }else{
            redirect(base_url().'404/');
        } 
        }else{
            redirect(base_url().'404/');
        }
    }
    public function purchase(){
        $data['userviewed'] = $this->viewed;
            // Convert c_balance To a_balance
            if($this->main_model->is_logged_in()){
            $i_ids = array();
            $i_ids = explode(',',$this->input->get('items'));
            if($i_ids[0] == ''){
                unset($i_ids[0]);
            }
            foreach($i_ids as $i_id){
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $bought = FALSE;
            $userCart = $this->main_model->getByData('cart','u_id',$userData['id'])[0];
            //Check if isn`t same user
            $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')')[0];
            if(isset($data['item']) && $data['item']->u_id !== $id && $data['item']->kind == 1){
                $i = 0;
                $gigsUp = 0;
                $gigsIds = NULL;
                $ui_rep = NULL;
                $gigupdates = $this->main_model->getFullRequest('gigupdates','(i_id = '.$i_id.')')[0];
                $cartGu = $this->main_model->getFullRequest('cartgu','(cart_id = '.$userCart->id.')')[0];
                $gigAmounts = explode(', ',$gigupdates->amount);
                    if($cartGu){
                        //Get Gig Updates
                        $gigsUp = $cartGu->gigsUp;
                        $gigsIds = $cartGu->gigsIds;
                        $ui_rep = $cartGu->ui_rep;
                        $this->main_model->deleteData('cartgu','id',$cartGu->id);
                    }
                //Calculate Price
                $totalPrice = $gigsUp + $data['item']->price;
                $aviBa = (int) $userData['balance']+$userData['a_balance'];
                if($aviBa >= $totalPrice){
                    $newBalance = $userData['balance']-$totalPrice;
                        if($newBalance < 0){
                            $newABalance = $userData['a_balance']+$newBalance;
                            $newBalance = 0;
                        }else{
                            $newABalance = $userData['a_balance'];
                        }
                        $newAllBalance = $userData['all_balance'];
                        $this->main_model->update('users','id',$id,array(
                            'all_balance'=>$newAllBalance,
                            'a_balance'=>$newABalance,
                            'c_balance'=>$userData['c_balance']+$totalPrice,
                            'balance'=> $newBalance
                        ));
                $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$data['item']->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$data['item']->u_id.'))')[0];
                if(!$data['chat']){
                    $this->main_model->insertData('chats',array(
                        'u_id'=>$id,
                        's_id'=>$data['item']->u_id
                    ));
                    $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$data['item']->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$data['item']->u_id.'))')[0];
                }
                $gigUrl = '<a target="_blank" class="msgState" href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a>';
                $message = 'مرحباً ... أنا قمت بشراء الخدمة التالية '.$gigUrl.' وإجمالي ما تم دفعه هو <p class="p-amount">'.$totalPrice.'$</p> <p>يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة</p> <p>الادارة.</p>';
                //Send Message
                $this->main_model->insertData('messages',array(
                    'message'=>$message,
                    'c_id'=>$data['chat']->id,
                    'f_id'=>$id,
                    'to_id'=>$data['item']->u_id,
                    'state'=>1,
                    'date'=>$this->main_model->dateTime('current')
                ));
                //Alert
                $this->main_model->alert('تنبيه عملية','تمت عملية شراء لخدمة <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> تصفح <a href="'.base_url().'users/chat/'.$data['item']->u_id.'/'.'">المحادثة</a>',$id);
                $this->main_model->alert('تنبيه عملية','تمت عملية شراء لخدمة <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> تصفح <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$data['item']->u_id);
                //Insert Requested Gig
                $this->main_model->insertData('requestedgigs',array(
                    'i_id'=>$data['item']->id,
                    'u_id'=>$id,
                    's_id'=>$data['item']->u_id,
                    'ui_ids'=>$gigsIds,
                    'ui_rep'=>$ui_rep,
                    'amount'=>$totalPrice,
                    'state'=>0,
                    'date'=>$this->main_model->dateTime('current')
                ));
                $bought = TRUE;
                //Unset Item Id From Cart
                $editI_ids = explode(',',$userCart->i_ids);
                if($editI_ids[0] == ''){
                    unset($editI_ids[0]);
                }
                unset($editI_ids[array_search($i_id,$editI_ids)]);
                $newCartI_ids = implode(',',$editI_ids);
                if($newCartI_ids == ''){
                    $newCartI_ids = null;
                }
                $updateCart = FALSE;
                $updateCart = $this->main_model->update('cart','id',$userCart->id,array(
                    'i_ids' => $newCartI_ids
                ));
                }else{
                    $this->session->set_flashdata('error','رصيدك غير كافي برجاء شحن حسابك أولاً');
                    redirect(base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/');
                }
                //Convert Balance
                
            }else{
                redirect(base_url().'404/');
            }
            }
            if($bought){
                //Redirect to the page
                redirect(base_url().'users/gigs/'.$userData['username'].'/done');
            }
            }else{
                redirect(base_url().'404/');
            }
    }
    public function buyGigBill(){
        $data['userviewed'] = $this->viewed;
            // Convert c_balance To a_balance
            if($this->main_model->is_logged_in()){
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $i_id = (int) strip_tags($this->uri->segment(3));
            //Check if isn`t same user
            $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')');
            $data['item'] = $data['item'][0];
            if($data['item']->u_id !== $id && $data['item']->kind == 1){
                $i = 0;
                $gigsUp = 0;
                $gigsIds = NULL;
                $ui_rep = NULL;
                $gigupdates = $this->main_model->getFullRequest('gigupdates','(i_id = '.$i_id.')');
                if($gigupdates){
                    $gigupdates = $gigupdates[0];
                    $gigAmounts = explode(', ',$gigupdates->amount);
                    while($i <= 4){
                        if(isset($_COOKIE['gu_num_'.$i])){
                            if($_COOKIE['gu_num_'.$i] > 0){
                                //Get Gig Updates
                            $gigsUp += $_COOKIE['gu_num_'.$i]*$gigAmounts[$i];
                            $gigsIds .= $i.', ';
                            $ui_rep .= $_COOKIE['gu_num_'.$i].', ';
                            }
                        }
                    $i++;}
                }
                //Calculate Price
                $totalPrice = $gigsUp + $data['item']->price;
                $data['title'] = 'فاتورة';
                $data['gUs'] = $this->main_model->getByData('gigupdates','i_id',$data['item']->id);
                $this->load->view('userarea/buyBill_view',$data);
            }else{
                redirect(base_url().'404/');
            }
            }else{
                redirect(base_url().'404/');
            }
    }
    public function buyGig(){
        $data['userviewed'] = $this->viewed;
            // Convert c_balance To a_balance
            if($this->main_model->is_logged_in()){
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $i_id = (int) strip_tags($this->uri->segment(3));
            //Check if isn`t same user
            $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')');
            $data['item'] = $data['item'][0];
            if($data['item']->u_id !== $id && $data['item']->kind == 1){
                $i = 0;
                $gigsUp = 0;
                $gigsIds = NULL;
                $ui_rep = NULL;
                $gigupdates = $this->main_model->getFullRequest('gigupdates','(i_id = '.$i_id.')');
                if($gigupdates){
                    $gigupdates = $gigupdates[0];
                    $gigAmounts = explode(', ',$gigupdates->amount);
                    while($i <= 4){
                        if(isset($_COOKIE['gu_num_'.$i])){
                            if($_COOKIE['gu_num_'.$i] > 0){
                                //Get Gig Updates
                            $gigsUp += $_COOKIE['gu_num_'.$i]*$gigAmounts[$i];
                            $gigsIds .= $i.', ';
                            $ui_rep .= $_COOKIE['gu_num_'.$i].', ';
                            }
                        }
                    $i++;}
                }
                //Calculate Price
                $totalPrice = $gigsUp + $data['item']->price;
                $aviBa = (int) $userData['balance']+$userData['a_balance'];
                if($aviBa >= $totalPrice){
                    $newBalance = $userData['balance']-$totalPrice;
                        if($newBalance < 0){
                            $newABalance = $userData['a_balance']+$newBalance;
                            $newBalance = 0;
                        }else{
                            $newABalance = $userData['a_balance'];
                        }
                        $newAllBalance = $userData['all_balance'];
                        $this->main_model->update('users','id',$id,array(
                            'all_balance'=>$newAllBalance,
                            'a_balance'=>$newABalance,
                            'c_balance'=>$userData['c_balance']+$totalPrice,
                            'balance'=> $newBalance
                        ));
                $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$data['item']->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$data['item']->u_id.'))')[0];
                if(!$data['chat']){
                    $this->main_model->insertData('chats',array(
                        'u_id'=>$id,
                        's_id'=>$data['item']->u_id
                    ));
                    $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$data['item']->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$data['item']->u_id.'))')[0];
                }
                $gigUrl = '<a target="_blank" class="msgState" href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a>';
                $message = 'مرحباً ... أنا قمت بشراء الخدمة التالية '.$gigUrl.' وإجمالي ما تم دفعه هو <p class="p-amount">'.$totalPrice.'$</p> <p>يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة</p> <p>الادارة.</p>';
                //Send Message
                $this->main_model->insertData('messages',array(
                    'message'=>$message,
                    'c_id'=>$data['chat']->id,
                    'f_id'=>$id,
                    'to_id'=>$data['item']->u_id,
                    'state'=>1,
                    'date'=>$this->main_model->dateTime('current')
                ));
                //Alert
                $this->main_model->alert('تنبيه عملية','تمت عملية شراء لخدمة <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> تصفح <a href="'.base_url().'users/chat/'.$data['item']->u_id.'/'.'">المحادثة</a>',$id);
                $this->main_model->alert('تنبيه عملية','تمت عملية شراء لخدمة <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> تصفح <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$data['item']->u_id);
                //Insert Requested Gig
                $this->main_model->insertData('requestedgigs',array(
                    'i_id'=>$data['item']->id,
                    'u_id'=>$id,
                    's_id'=>$data['item']->u_id,
                    'ui_ids'=>$gigsIds,
                    'ui_rep'=>$ui_rep,
                    'amount'=>$totalPrice,
                    'state'=>0,
                    'date'=>$this->main_model->dateTime('current')
                ));
                //Redirect to the page
                redirect(base_url().'users/chat/'.$data['item']->u_id);
                }else{
                    if($aviBa > 0){
                        $remaining = $totalPrice-$aviBa;
                        $paid = $aviBa;
                        $this->main_model->update('users','id',$id,array(
                            'all_balance'=>$userData['c_balance']+$paid,
                            'a_balance'=>0,
                            'c_balance'=>$userData['c_balance']+$paid,
                            'balance'=> 0
                        ));
                        //Insert Stopped Bill
                        $this->main_model->insertData('stoppedbill',array(
                            'i_id'=>$data['item']->id,
                            'u_id'=>$id,
                            'ui_ids'=>$gigsIds,
                            'ui_rep'=>$ui_rep,
                            'paid'=>$paid,
                            'remaining'=>$remaining,
                            'date'=>$this->main_model->dateTime('current')
                        ));
                        $this->main_model->alert('تنبيه عملية','تمت عملية دفع جزء من طلبية <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> تصفح <a href="'.base_url().'users/remainingPayments'.'">المديونيات</a>',$id);
                        $this->session->set_flashdata('error','تم دفع جزء من مبلغ الطبية لأن رصيدك غير كافي برجاء شحن حسابك');
                        redirect(base_url('users/remainingPayments'));
                    }else{
                        $this->session->set_flashdata('error','رصيدك غير كافي برجاء شحن حسابك أولاً');
                        redirect(base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/');
                    }
                }
                //Convert Balance
            }else{
                redirect(base_url().'404/');
            }
            }else{
                redirect(base_url().'404/');
            }
    }
    public function remainingPayments(){
        $data['userviewed'] = $this->viewed;
            // Convert c_balance To a_balance
            if($this->main_model->is_logged_in()){
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $data['remains'] = $this->main_model->getFullRequest('stoppedbill','(u_id = '.$id.') ORDER BY id DESC');
            $data['title'] = 'العمليات الغير مكتملة';
            $this->load->view('userarea/remaining_view',$data);
            }else{
                redirect(base_url().'404/');
            }
    }
    public function completeRemain(){
        $data['userviewed'] = $this->viewed;
            // Convert c_balance To a_balance
            if($this->main_model->is_logged_in()){
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $r_id = (int) strip_tags($this->uri->segment(3));
            $data['remains'] = $this->main_model->getFullRequest('stoppedbill','(id = '.$r_id.') ORDER BY id DESC');
                if($data['remains']){
                    if($data['remains'][0]->u_id == $id){
                        $data['item'] = $this->main_model->getFullRequest('items','(id = '.$data['remains'][0]->i_id.')');
                        $data['item'] = $data['item'][0];
                        $i = 0;
                        $gigsUp = 0;
                        $gigsIds = $data['remains'][0]->ui_ids;
                        $ui_rep = $data['remains'][0]->ui_rep;
                        //Remain Price
                        $totalPrice = $data['remains'][0]->remaining;
                        $aviBa = (int) $userData['balance']+$userData['a_balance'];
                        if($aviBa >= $totalPrice){
                            $newBalance = $userData['balance']-$totalPrice;
                                if($newBalance < 0){
                                    $newABalance = $userData['a_balance']+$newBalance;
                                    $newBalance = 0;
                                }else{
                                    $newABalance = $userData['a_balance'];
                                }
                                $newAllBalance = $userData['all_balance'];
                                $this->main_model->update('users','id',$id,array(
                                    'all_balance'=>$newAllBalance,
                                    'a_balance'=>$newABalance,
                                    'c_balance'=>$userData['c_balance']+$totalPrice,
                                    'balance'=> $newBalance
                                ));
                        $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$data['item']->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$data['item']->u_id.'))')[0];
                        if(!$data['chat']){
                            $this->main_model->insertData('chats',array(
                                'u_id'=>$id,
                                's_id'=>$data['item']->u_id
                            ));
                            $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$data['item']->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$data['item']->u_id.'))')[0];
                        }
                        $gigUrl = '<a target="_blank" class="msgState" href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a>';
                        $message = 'مرحباً ... أنا قمت بشراء الخدمة التالية '.$gigUrl.' وإجمالي ما تم دفعه هو <p class="p-amount">'.$totalPrice.'$</p> <p>يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة</p> <p>الادارة.</p>';
                        //Send Message
                        $this->main_model->insertData('messages',array(
                            'message'=>$message,
                            'c_id'=>$data['chat']->id,
                            'f_id'=>$id,
                            'to_id'=>$data['item']->u_id,
                            'state'=>1,
                            'date'=>$this->main_model->dateTime('current')
                        ));
                        //Alert
                        $this->main_model->alert('تنبيه عملية','تمت عملية شراء لخدمة <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> تصفح <a href="'.base_url().'users/chat/'.$data['item']->u_id.'/'.'">المحادثة</a>',$id);
                        $this->main_model->alert('تنبيه عملية','تمت عملية شراء لخدمة <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> تصفح <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$data['item']->u_id);
                        //Insert Requested Gig
                        $this->main_model->insertData('requestedgigs',array(
                            'i_id'=>$data['item']->id,
                            'u_id'=>$id,
                            's_id'=>$data['item']->u_id,
                            'ui_ids'=>$gigsIds,
                            'ui_rep'=>$ui_rep,
                            'amount'=>$totalPrice,
                            'state'=>0,
                            'date'=>$this->main_model->dateTime('current')
                        ));
                        $this->main_model->deleteData('stoppedbill','id',$data['remains'][0]->id);
                        $this->session->set_flashdata('done','تم دفع المديونية وتنفيذ الطلبية بنجاح ... برجاء التواصل مع المستشار من <a target="_blank" href="'.base_url().'users/chat/'.$data['item']->u_id.'">هنا</a>');
                        //Redirect to the page
                        redirect(base_url().'users/remainingPayments/');
                        }else{
                            //Not Engough Balance
                            $this->session->set_flashdata('error','رصيدك غير كافي برجاء شحن حسابك أولاً');
                            redirect(base_url().'users/remainingPayments');
                        }
                    }else{
                        redirect(base_url().'404/');
                    }
                }else{
                    redirect(base_url().'404/');
                }
            }
    }
    public function fetchalerts(){
        if($this->main_model->is_logged_in()){
            $this->main_model->update('users','id',$this->session->userdata('id'),array(
                'active' => 1,
                'pulse' => $this->main_model->dateTime('current')
            ));
           if(strip_tags($this->input->post('request')) == 'seen'){
               $this->main_model->update('alerts','u_id',$this->session->userdata('id'),array(
                   'statue' => 1
               ));
            $response = array(
                        'done' => 1,
                        );
            echo json_encode($response);
           }elseif(strip_tags($this->input->post('request')) == 'unseen'){
               $nums = $this->main_model->getFullRequest('alerts','statue = 0 AND u_id = '.$this->session->userdata('id'),'count');
               $alerts = $this->main_model->getFullRequest('alerts','(u_id = '.$this->session->userdata('id').') ORDER BY `id` DESC');
               if($nums > 0){
                   $done = 1;
               }else{
                   $done = 0;
               }
               $response = array(
                       'done' => $done,
                       'nums' => $nums,
                       'alerts' => $alerts
                        );
                echo json_encode($response);
           }
        }else{
                redirect(base_url().'404/');
            }
    }
    public function createUserName(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in() && $this->session->userdata('username') == ''){
            $data['title']='انشاء اسم مستخدم | موقع استشارة';
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $this->load->view('userarea/username_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    public function createUserNameCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in() && $this->session->userdata('username') == ''){
            $data['title']='انشاء اسم مستخدم | موقع استشارة';
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'is_unique'     => '%s مسجل لدينا بالفعل',
                'matches'     => 'يجب عليك إدخال %s .',
                'integer'     => 'يجب عليك إدخال %s .',
                'valid_email'     => 'يجب عليك إدخال %s صحيح.',
                'alpha_numeric' => 'في %s يجب إدخال أرقام وحروف انجليزية فقط',
                'min_length' => 'يجب أن لا يقل {field} عن عدد {param} حروف',
                'numeric' => 'يجب أن يتكون %s من أرقام فقط',
                'alpha' => 'يجب أن يتكون %s من حروف فقط'
            );
            $this->form_validation->set_rules('username','اسم المستخدم','required|alpha_numeric|is_unique[users.username]|min_length[10]',$rul);
            if($this->form_validation->run() == true){
                $user=array(
                        'username' => strip_tags($this->input->post('username'))
                );
                $this->main_model->update('users','id',$userData['id'],$user);
                $getUser = (array) $this->main_model->getByData('users','id',$userData['id'])[0];
                $this->session->set_userdata($getUser);
                if($this->session->userdata('username') == ''){
                    redirect(base_url('users/createUserName'));
                }else{
                    redirect(base_url().'user/'.$this->session->userdata('username'));
                }
                    }else{
                        $this->createUserName();
                    }
        }else{
            redirect(base_url().'404/');
        }
    }
    public function chat(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['files'] = '';
            $data['title']='المحادثات | موقع استشارة';
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $data['id'] = $id = $userData['id'];
            $data['users'] = 0;
            $data['chats'] = $this->main_model->getFullRequest('chats','(u_id = '.$id.') OR (s_id = '.$id.')');
            $data['users'] = array();
            if($data['chats']){foreach($data['chats'] as $chat){
                if($chat->u_id !== $id){
                    $data['users'][] = $this->main_model->getFullRequest('users','(id = '.$chat->u_id.')')[0];
                }elseif($chat->s_id !== $id){
                    $data['users'][] = $this->main_model->getFullRequest('users','(id = '.$chat->s_id.')')[0];
                }
            }}
            $cu_id=(int) strip_tags($this->uri->segment(3));
            $data['messages'] = 0;
            if($cu_id){
                $data['files'] = $this->main_model->getFullRequest('files','((c_id = '.$cu_id.') AND (u_id = '.$id.')) OR ((c_id = '.$id.') AND (u_id = '.$cu_id.'))');
                $i = 0;
                if($data['files']){foreach($data['files'] as $file){
                    $data['files'][$i]->link = base_url().'users/download/'.$file->id.'/'.$id;
                $i++;}}
                $data['messages'] = $this->main_model->getFullRequest('messages','(f_id = '.$cu_id.') OR (to_id = '.$cu_id.')');
                $data['cto_id'] = $this->main_model->getFullRequest('chats','((u_id = '.$id.') AND (s_id = '.$cu_id.')) OR ((s_id = '.$id.') AND (u_id = '.$cu_id.'))');
                if(!$data['cto_id']){
                    redirect(base_url().'users/chat');
                }
            }
            $this->load->view('userarea/chat_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    public function createProjectChat(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
                //Check Chat
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $data['id'] = $id = $userData['id'];
                $i_id = (int) strip_tags($this->uri->segment(3));
                $sellerId = (int) strip_tags($this->uri->segment(4));
                $gigORp = (int) strip_tags($this->uri->segment(5));
                if($gigORp !== 0 && $gigORp == 'p'){
                    $data['item'] = $this->main_model->getFullRequest('portfolio','(id = '.$i_id.') AND (u_id = '.$sellerId.')')[0];
                }else{
                    $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')')[0];
                }
                if(!$data['item']){
                    redirect(base_url().'404/');
                }
                if($sellerId == $id){
                    redirect(base_url().'404/');
                }
                $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$sellerId.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$sellerId.'))')[0];
                if(!$data['chat']){
                    $this->main_model->insertData('chats',array(
                        'u_id'=>$id,
                        's_id'=>$sellerId
                    ));
                    $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$sellerId.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$sellerId.'))')[0];
                }
                if($gigORp == 'p'){
                    $gigUrl = '<a target="_blank" class="msgState" href="'.base_url().'users/p/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a>';
                    $message = 'مرحباً ... أود الاستفسار عن عرضك على " '.$gigUrl.' " <p>الادارة.</p>';
                    //Alert
                $this->main_model->alert('استفسار عن عمل مشابه','لقد وصلك طلب استفسار عن '.'<a target="_blank" href="'.base_url().'users/p/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a> يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$sellerId);
                }else{
                    $gigUrl = '<a target="_blank" class="msgState" href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a>';
                    $message = 'مرحباً ... أود الاستفسار عن خدمتك التالية " '.$gigUrl.' " <p>الادارة.</p>';
                    //Alert
                    $this->main_model->alert('استفسار عن خدمة','لقد وصلك طلب استفسار عن '.'<a target="_blank" href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a> يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$sellerId);
                }
                //Send Message
                $this->main_model->insertData('messages',array(
                    'message'=>$message,
                    'c_id'=>$data['chat']->id,
                    'f_id'=>$id,
                    'to_id'=>$data['item']->u_id,
                    'state'=>1,
                    'date'=>$this->main_model->dateTime('current')
                ));
                //Redirect to the page
                redirect(base_url().'users/chat/'.$sellerId);
        }else{
            redirect(base_url().'login/');
        }
    }
    public function hireConfirm(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
                //Check Chat
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $data['id'] = $id = $userData['id'];
                $data['title'] = 'تأكيد التوظيف';
                $this->load->view('include/header',$data);
                $this->load->view('include/userSideBar_view',$data);
                $this->load->view('userarea/hireConfirm_view',$data);
                $this->load->view('include/footer',$data);
        }
    }
    public function createChat(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
                //Check Chat
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $data['id'] = $id = $userData['id'];
                $i_id = (int) strip_tags($this->uri->segment(3));
                $sellerId = (int) strip_tags($this->uri->segment(4));
                $gigORp = (int) strip_tags($this->uri->segment(5));
                if($gigORp !== 0 && $gigORp == 'p'){
                    $data['item'] = $this->main_model->getFullRequest('portfolio','(id = '.$i_id.') AND (u_id = '.$sellerId.')')[0];
                }else{
                    $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.') AND (u_id = '.$sellerId.')')[0];
                }
                if(!$data['item']){
                    redirect(base_url().'404/');
                }
                if($sellerId == $id){
                    redirect(base_url().'404/');
                }
                $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$sellerId.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$sellerId.'))')[0];
                if(!$data['chat']){
                    $this->main_model->insertData('chats',array(
                        'u_id'=>$id,
                        's_id'=>$sellerId
                    ));
                    $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$sellerId.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$sellerId.'))')[0];
                }
                if($gigORp == 'p'){
                    $gigUrl = '<a target="_blank" class="msgState" href="'.base_url().'users/p/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a>';
                    $message = 'مرحباً ... أنا أود الاستفسار عن عمل مشابه لـ " '.$gigUrl.' " <p>الادارة.</p>';
                    //Alert
                $this->main_model->alert('استفسار عن عمل مشابه','لقد وصلك طلب استفسار عن '.'<a target="_blank" href="'.base_url().'users/p/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a> يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$sellerId);
                }else{
                    $gigUrl = '<a target="_blank" class="msgState" href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a>';
                    $message = 'مرحباً ... أنا أود الاستفسار عن خدمتك التالية " '.$gigUrl.' " <p>الادارة.</p>';
                    //Alert
                    $this->main_model->alert('استفسار عن خدمة','لقد وصلك طلب استفسار عن '.'<a target="_blank" href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/'.'">'.$data['item']->title.'</a> يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$sellerId);
                }
                $checkMsg = $this->main_model->getFullRequest('messages','(c_id = '.$data['chat']->id.') AND (state = 1) AND (f_id = '.$id.') AND (to_id = '.$data['item']->u_id.')');
                if(!$checkMsg){
                    //Send Message
                    $this->main_model->insertData('messages',array(
                        'message'=>$message,
                        'c_id'=>$data['chat']->id,
                        'f_id'=>$id,
                        'to_id'=>$data['item']->u_id,
                        'state'=>1,
                        'date'=>$this->main_model->dateTime('current')
                    ));
                }
                //Redirect to the page
                redirect(base_url().'users/chat/'.$data['item']->u_id);
        }else{
            redirect(base_url().'login/');
        }
    }
    public function donePro(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $bid_id = (int) strip_tags($this->uri->segment(3));
            $i_id = (int) strip_tags($this->uri->segment(4));
            $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')');
            $data['bid'] = $this->main_model->getFullRequest('bids','(id = '.$bid_id.') AND (i_id = '.$i_id.')');
            if($data['item'] && $data['bid']){
                if(isset($data['item'][0]->kind) && $data['item'][0]->kind == 2 && $data['item'][0]->state == 2){
                    $userData = (array) $this->main_model->is_logged_in(1)[0];
                    $state = $userData['state'];
                    $id = $userData['id'];
                    if($state == 0){
                        // Redirect to profile
                    redirect(base_url().'404/');
                    }
                        $this->main_model->insertData('promsg',array(
                            'u_id'=>$id,
                            's_id'=>$data['item'][0]->u_id,
                            'caseMsg'=>'endRequest',
                            'i_id'=>$data['item'][0]->id,
                            'date'=>$this->main_model->dateTime('current')
                        ));
                        //Alert
                    $this->main_model->alert('تم الارسال','تم ارسال طلب تسليم المشروع'.'<a target="_blank" href="'.base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/'.'">'.$data['item'][0]->title.'</a> يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a> | <a href="'.base_url().'users/acceptPro/'.$data['item'][0]->id.'/'.'">استلام</a>',$data['item'][0]->u_id);
                    $this->session->set_flashdata('done','تم ارسال طلب تسليم المشروع');
                    redirect(base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/');
                }elseif(isset($data['item'][0]->kind) && $data['item'][0]->kind == 1 && $data['item'][0]->state == 1){
                    //Gig
                    //Get Bill user
                    $userId = $bid_id;
                    $userB = $this->main_model->getByData('users','id',$userId)[0];
                    //Get Requested Gig Amount
                    $amount = (int) strip_tags($this->uri->segment(5));
                    $rGig = $this->main_model->getFullRequest('requestedgigs','(amount = '.$amount.') AND (i_id = '.$data['item'][0]->id.') AND (u_id = '.$userId.')')[0];
                    if(!$rGig){
                        // Redirect to 404
                    redirect(base_url().'404/');
                    }
                    //Freelancer
                    $userData = (array) $this->main_model->is_logged_in(1)[0];
                    $state = $userData['state'];
                    $id = $userData['id'];
                    if($state == 0 OR $userData['id'] !== $data['item'][0]->u_id){
                        // Redirect to 404
                    redirect(base_url().'404/');
                    }
                        $this->main_model->insertData('promsg',array(
                            'u_id'=>$data['item'][0]->u_id,
                            's_id'=>$userB->id,
                            'caseMsg'=>'endRequest',
                            'i_id'=>$data['item'][0]->id,
                            'date'=>$this->main_model->dateTime('current')
                        ));
                        //Alert
                    $this->main_model->alert('طلب استلام','قام '.$userData['username'].' بطلب تسليم الخدمة'.'<a target="_blank" href="'.base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/'.'">'.$data['item'][0]->title.'</a> يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a> | <a href="'.base_url().'users/acceptProConfirm/'.$data['item'][0]->id.'/'.$userB->id.'/'.$amount.'">استلام</a>',$userB->id);
                    $this->session->set_flashdata('done','تم ارسال طلب تسليم الخدمة');
                    redirect(base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/');
                }else{
                    redirect(base_url().'404/');
                }
            }elseif(isset($data['item'][0]->kind) && $data['item'][0]->kind == 1 && $data['item'][0]->state == 1){
                //Gig
                //Get Bill user
                $userId = $bid_id;
                $userB = $this->main_model->getByData('users','id',$userId)[0];
                //Get Requested Gig Amount
                $amount = (int) strip_tags($this->uri->segment(5));
                $rGig = $this->main_model->getFullRequest('requestedgigs','(amount = '.$amount.') AND (i_id = '.$data['item'][0]->id.') AND (u_id = '.$userId.')')[0];
                if(!$rGig){
                    // Redirect to 404
                redirect(base_url().'404/');
                }
                //Freelancer
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $state = $userData['state'];
                $id = $userData['id'];
                if($state == 0 OR $userData['id'] !== $data['item'][0]->u_id){
                    // Redirect to 404
                redirect(base_url().'404/');
                }
                    $this->main_model->insertData('promsg',array(
                        'u_id'=>$data['item'][0]->u_id,
                        's_id'=>$userB->id,
                        'caseMsg'=>'endRequest',
                        'i_id'=>$data['item'][0]->id,
                        'date'=>$this->main_model->dateTime('current')
                    ));
                    //Alert
                $this->main_model->alert('طلب استلام','قام '.$userData['username'].' بطلب تسليم الخدمة'.'<a target="_blank" href="'.base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/'.'">'.$data['item'][0]->title.'</a> يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a> | <a href="'.base_url().'users/acceptProConfirm/'.$data['item'][0]->id.'/'.$userB->id.'/'.$amount.'">استلام</a>',$userB->id);
                $this->session->set_flashdata('done','تم ارسال طلب تسليم الخدمة');
                redirect(base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/');
            }else{
                redirect(base_url().'404/');
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    public function acceptEbid(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $editbid_id = (int) strip_tags($this->uri->segment(3));
            $data['editedbid'] = $this->main_model->getFullRequest('editedbid','(id = '.$editbid_id.')')[0];
            if(!$data['editedbid']){
                redirect(base_url().'404/');
            }elseif($data['editedbid']->amount < 1){
                redirect(base_url().'404/');
            }
            $bid_id = $data['editedbid']->bid_id;
            $i_id = $data['editedbid']->i_id;
            $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')');
            $data['bid'] = $this->main_model->getFullRequest('bids','(id = '.$bid_id.') AND (i_id = '.$i_id.')');
            if($data['editedbid'] && $data['item'] && $data['bid']){
                if(isset($data['item'][0]->kind) && $data['item'][0]->kind == 2 && $data['item'][0]->state == 2){
                    $userData = (array) $this->main_model->is_logged_in(1)[0];
                    $state = $userData['state'];
                    $id = $userData['id'];
                    if($state == 0){
                        redirect(base_url().'404/');
                    }
                    $aviBa = (int) $userData['balance']+$userData['a_balance'];
                    $bidAmount = (int) $data['bid'][0]->amount;
                    $editedBidAmount = (int) $data['editedbid']->amount;
                    $msg = 'قبول العرض الجديد';
                    if($editedBidAmount < $bidAmount){
                        //Add To Project Owner
                        $minusAmount = $bidAmount-$editedBidAmount;
                    }elseif($editedBidAmount > $bidAmount){
                        //Add To User
                        $minusAmount = $editedBidAmount-$bidAmount;
                    }else{
                        $minusAmount = 999999999999999;
                    }
                    if($aviBa >= $minusAmount){
                        if($editedBidAmount < $bidAmount){
                            //Add To Project Owner
                            $minusAmount = $bidAmount-$editedBidAmount;
                            $newBalance = $userData['balance']+$minusAmount;
                            $newABalance = $userData['a_balance'];
                            $newCBalance = $userData['c_balance']-$minusAmount;
                            if($bidAmount == $minusAmount){
                                /*/Stop Project
                                $this->main_model->update('items','id',$data['bid'][0]->i_id,array(
                                    'bid_id' => NULL,
                                    'state' => 10
                                ));
                                $msg = 'إلغاء المشروع';*/
                                redirect(base_url().'404/');
                            }
                        }elseif($editedBidAmount > $bidAmount){
                            //Add To User
                            $minusAmount = $editedBidAmount-$bidAmount;
                            $newBalance = $userData['balance']-$minusAmount;
                            $newCBalance = $userData['c_balance']+$minusAmount;
                            if($newBalance < 0){
                                $newABalance = $userData['a_balance']+$newBalance;
                                $newBalance = 0;
                            }else{
                                $newABalance = $userData['a_balance'];
                            }
                        }
                        $newAllBalance = $userData['all_balance']-$bidAmount;
                        $this->main_model->update('users','id',$id,array(
                            'all_balance'=>$newAllBalance,
                            'a_balance'=>$newABalance,
                            'c_balance'=>$newCBalance,
                            'balance'=> $newBalance
                        ));
                        if($bidAmount !== $minusAmount){
                            //Update Bid
                            $this->main_model->update('bids','id',$data['editedbid']->bid_id,array(
                                'bid' => $data['editedbid']->bid,
                                'amount' => $data['editedbid']->amount,
                                'days' => $data['editedbid']->days,
                                'date'=>$this->main_model->dateTime('current')
                            ));
                            $this->main_model->deleteData('editedbid','id',$data['editedbid']->id);
                        }
                    }else{
                        $this->session->set_flashdata('error','رصيدك غير كافي برجاء شحن حسابك أولاً');
                        redirect(base_url().'users/payments');
                    }
                    //Alert
                    $this->main_model->alert('تم قبول طلبك','تم قبول طلبك '.$msg.' '.'<a target="_blank" href="'.base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/'.'">'.$data['item'][0]->title.'</a> يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$data['item'][0]->u_id.'/'.'">المحادثة</a>',$data['bid'][0]->u_id);
                    $this->session->set_flashdata('done','تم '.$msg.' بنجاح');
                    redirect(base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/');
                }else{
                    redirect(base_url().'404/');
                }
            }else{
                redirect(base_url().'404/');
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    public function hire(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $bid_id = (int) strip_tags($this->uri->segment(3));
            $i_id = (int) strip_tags($this->uri->segment(4));
            $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')');
            $data['bid'] = $this->main_model->getFullRequest('bids','(id = '.$bid_id.') AND (i_id = '.$i_id.')');
            if($data['item'] && $data['bid']){
                if(isset($data['item'][0]->kind) && $data['item'][0]->kind == 2 && $data['item'][0]->state == 1){
                    $userData = (array) $this->main_model->is_logged_in(1)[0];
                    $state = $userData['state'];
                    $id = $userData['id'];
                    if($state == 0){
                        // Redirect to profile
                    redirect(base_url().'404/');
                    }
                    $aviBa = (int) $userData['balance']+$userData['a_balance'];
                    $bidAmount = (int) $data['bid'][0]->amount;
                    if($aviBa >= $bidAmount){
                        $newBalance = $userData['balance']-$bidAmount;
                        if($newBalance < 0){
                            $newABalance = $userData['a_balance']+$newBalance;
                            $newBalance = 0;
                        }else{
                            $newABalance = $userData['a_balance'];
                        }
                        $newAllBalance = $userData['all_balance']-$bidAmount;
                        $this->main_model->update('users','id',$id,array(
                            'all_balance'=>$newAllBalance,
                            'a_balance'=>$newABalance,
                            'c_balance'=>$userData['c_balance']+$bidAmount,
                            'balance'=> $newBalance
                        ));
                        $message = '<p>تم بدأ مشروع</p><p><a target="_blank" class="msgState" href="'.base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'">'.$data['item'][0]->title.'</a></p>';
                        $c_id = $this->main_model->getFullRequest('chats','((u_id = '.$id.') AND (s_id = '.$data['bid'][0]->u_id.')) OR ((s_id = '.$id.') AND (u_id = '.$data['bid'][0]->u_id.'))');
                        if(!$c_id){
                            $this->main_model->insertData('chats',array(
                                'u_id'=>$id,
                                's_id'=>$data['bid'][0]->u_id
                            ));
                            $c_id = $this->main_model->getFullRequest('chats','((u_id = '.$id.') AND (s_id = '.$data['bid'][0]->u_id.')) OR ((s_id = '.$id.') AND (u_id = '.$data['bid'][0]->u_id.'))');
                        }
                        $this->main_model->insertData('messages',array(
                            'message'=>$message,
                            'c_id'=>$c_id[0]->id,
                            'f_id'=>$id,
                            'to_id'=>$c_id[0]->s_id,
                            'state'=>1,
                            'date'=>$this->main_model->dateTime('current')
                        ));
                    }else{
                        $this->session->set_flashdata('error','رصيدك غير كافي برجاء شحن حسابك أولاً');
                        redirect(base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/');
                    }
                    $this->main_model->update('items','id',$i_id,array(
                        'state'=>2,
                        'bid_id'=>$bid_id,
                        's_date'=> $this->main_model->dateTime('current')
                    ));
                    //Alert
                    $this->main_model->alert('تم اختيارك','تم اختيارك لمشروع'.'<a target="_blank" href="'.base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/'.'">'.$data['item'][0]->title.'</a> يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$data['bid'][0]->u_id);
                    $this->session->set_flashdata('done','تم توظيف صاحب العرض بنجاح');
                    redirect(base_url().'i/'.str_replace(' ','-',$data['item'][0]->title).'/'.$data['item'][0]->id.'/');
                }else{
                    redirect(base_url().'404/');
                }
            }else{
                redirect(base_url().'404/');
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    public function activate(){
        $data['userviewed'] = $this->viewed;
        if($this->uri->segment(2) == 'reactivate' && $this->main_model->is_logged_in()){
            $data['title']='إعادة تفعيل حسابك في موقع استشارة | موقع استشارة';
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $state = $userData['state'];
            $id = $userData['id'];
            if($state == 1){
                // Redirect to profile
            redirect(base_url().'user/');
            }
            $result = $this->main_model->getByData('users_activation','u_id',$id);
            $u_act = (array) $result[0];
            $data['time'] = $u_act['time'];
            $data['code'] = $u_act['code'];
            $this->load->view('activation_view',$data);
        }elseif($this->uri->segment(2) == 'reactivate' && $this->uri->segment(3) == 'sent'){
            $data['title']='إرسال كود تفعيل حسابك في موقع استشارة | موقع استشارة';
            $this->load->view('activation_view',$data);
        }else{
            $data['title']='تفعيل حسابك في موقع استشارة | موقع استشارة';
            $data['code']=$this->uri->segment(2);
            $result = $this->main_model->getByData('users_activation','code',$data['code']);
            if($result == true){
                // If Activate code true
                $u_act = (array) $result[0];
                $activate_result = $this->main_model->update('users','id',$u_act['u_id'],array('state'=>1));
                $this->main_model->deleteData('users_activation','code',$data['code']);
                // Redirect to done page
                $data['state']=1;
                $this->load->view('activation_view',$data);
            }else{
                // If Activate code false
                $data['title']='تفعيل حسابك في موقع استشارة | موقع استشارة';
                $data['state']=0;
                $this->load->view('activation_view',$data);
            }
        }
    }
    function processCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
                $userEmail = $userData['email'];
                $userUsername = $userData['username'];
        $payment =$this->main_model->validate(strip_tags($this->input->get('paymentID')),strip_tags($this->input->get('token')),strip_tags($this->input->get('payerID')),strip_tags($this->input->get('clearAmount')));
            $clearAmount =((int) strip_tags($this->input->get('clearAmount')));
            $amount = round(($clearAmount + ($clearAmount / 100)*2.75),2);
            $paymentAmount = $payment->transactions[0]->amount->details->subtotal;
            $payerFullName = $payment->payer->payer_info->first_name.' '.$payment->payer->payer_info->last_name;
            $payerEmail = $payment->payer->payer_info->email;
            $payerPayerId = $payment->payer->payer_info->payer_id;
            $payerToken = strip_tags($this->input->get('token'));
            $payerCountryCode = $payment->payer->payer_info->country_code;;
            $currency = $payment->transactions[0]->amount->currency;
            $state = $payment->state;
            $paymentId = strip_tags($this->input->get('paymentID'));
        if($paymentAmount == $amount && $currency == 'USD' && $state == 'approved' && $clearAmount >= 10){
            $checkPayment = $this->main_model->getByData('payments','paymentId',$paymentId);
            if($checkPayment == false){
                $payData = array(
                'clearAmount'=> $clearAmount,
                'amount'=> $paymentAmount,
                'fullName'=> $payerFullName,
                'email'=> $payerEmail,
                'payerId'=> $payerPayerId,
                'token'=> $payerToken,
                'countryCode'=> $payerCountryCode,
                'currency'=> $currency,
                'state'=> $state,
                'u_id'=> $userId,
                'date'=> $this->main_model->dateTime('date').' '.$this->main_model->dateTime('time'),
                'paymentId'=> $paymentId
            );
            $addPayment = $this->main_model->insertData('payments',$payData);
            $userData = $this->main_model->getByData('users','id',$userId);
            $newBalance = $clearAmount+$userData[0]->balance;
            $updateBalance = $this->main_model->update('users','id',$userId,array('balance' => $newBalance));
            $msgAll = (double) $newBalance+$userData[0]->a_balance+$userData[0]->ads_balance+$userData[0]->c_balance;
                $to = strip_tags($userEmail); // note the comma

            // Subject
            $subject = 'وصل شحن حسابك في موقع استشارة';

            // Message
            $message = $this->main_model->template();
            $txtTags = array('SystemBaseUrl','SystemUserName','SystemTitle','SystemDescription');
            $title = 'لقد تم شحن حسابك في موقع استشارة بمبلغ :
                </h4>
                <h4 style="
                padding: 10px;
                background: #ddd;
                text-align: center;
                border: 1px solid #b5b5b5;
            ">'.$clearAmount.' $ </h4>
            <h4>
            وأصبح إجمالي رصيدك : 
            </h4>';
            $description = $msgAll;
            $txtValues = array(base_url(),strip_tags($userUsername),$title,$description);
            $message = str_replace($txtTags,$txtValues,$message);
            
            /*/ To send HTML mail, the Content-type header must be set
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            // Additional headers
            $headers[] = 'To: '.strip_tags($userUsername).' <'.strip_tags($userEmail).'>';
            $headers[] = 'From: منصة استشارة <admin@istsharh.com>';
            $headers[] = 'Cc: admin@istsharh.com';
            $headers[] = 'Bcc: admin@istsharh.com';

            // Mail it
            mail($to, $subject, $message, implode("\r\n", $headers));*/
            $fromEm = 'admin@istsharh.com';
            $CI =& get_instance();
            $CI->load->library('email');
            $CI->email->set_mailtype("html");
            $CI->email->from($fromEm, 'منصة استشارة');
            $CI->email->to($to);
            $CI->email->cc($fromEm);
            $CI->email->bcc($fromEm);

            $CI->email->subject($subject);
            $CI->email->message($message);
            
            // Mail it
            $CI->email->send();
            $newAllBalance = $clearAmount+$userData[0]->all_balance;
            $updateAllBalance = $this->main_model->update('users','id',$userId,array('all_balance' => $newAllBalance));
                
            $data['title']='شحن حسابك في موقع استشارة | موقع استشارة';
            $data['state']=1;
            $data['clearAmount']=$clearAmount;
            $this->load->view('userarea/paymentMsg_view',$data);
            }else{
            $data['title']='شحن حسابك في موقع استشارة | موقع استشارة';
            $data['state']=0;
            $this->load->view('userarea/paymentMsg_view',$data);
            }            
        }else{
            $data['title']='شحن حسابك في موقع استشارة | موقع استشارة';
            $data['state']=2;
            $this->load->view('userarea/paymentMsg_view',$data);
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    function process(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .'
                );
            $this->form_validation->set_rules('amount','المبلغ المراد شحنه','required',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            // Accepted Validation
            if(((int) strip_tags($this->input->post('amount'))) >= 10){
                $data['amount'] = round((((int) strip_tags($this->input->post('amount'))) + (((int) strip_tags($this->input->post('amount'))) / 100)*2.75),2);
                $data['clearAmount'] = ((int) strip_tags($this->input->post('amount')));
                $data['title']='شحن حسابك في موقع استشارة | موقع استشارة';
                $this->load->view('userarea/process_view',$data);
            }else{
                // Resfused
                $data['title']='شحن حسابك في موقع استشارة | موقع استشارة';
                $data['state']=3;
                $this->load->view('userarea/paymentMsg_view',$data);
            }
        }else{
            // Resfused
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    function transaction(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .'
                );
            $this->form_validation->set_rules('adsAmount','المبلغ المراد شحنه','required',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            // Accepted Validation
            $data['adsAmount'] = ((int) strip_tags($this->input->post('adsAmount')));
            $userData = $this->main_model->getByData('users','id',$userId);
            $prevBalance = $userData[0]->a_balance+$userData[0]->balance;
            $addBalance = $data['adsAmount'];
            if($prevBalance < $addBalance){
                // Resfused
                $data['title']='شحن حساب الإعلاني موقع استشارة | موقع استشارة';
                $data['state']=4;
                $this->load->view('userarea/paymentMsg_view',$data);
            }elseif($prevBalance >= $addBalance){
                // Check if requested more than bal.
                if($addBalance >= $userData[0]->balance){
                    $updateBalance1 = $this->main_model->update('users','id',$userId,array('balance' => 0));
                    
                    $resid = $addBalance-$userData[0]->balance;
                    $newABalance = $userData[0]->a_balance-$resid;
                    $updateABalance2 = $this->main_model->update('users','id',$userId,array('a_balance' => $newABalance));
                    
                    $newAdsBalance = $userData[0]->ads_balance+$addBalance;
                    $updateABalance4 = $this->main_model->update('users','id',$userId,array('ads_balance' => $newAdsBalance));
                    // updated
                    $data['title']='شحن حساب الإعلاني موقع استشارة | موقع استشارة';
                    $data['state']=5;
                    $this->load->view('userarea/paymentMsg_view',$data);
                }elseif($addBalance < $userData[0]->balance){
                    $newBalance = $userData[0]->balance-$addBalance;
                    $updateBalance3 = $this->main_model->update('users','id',$userId,array('balance' => $newBalance));
                    
                    $newAdsBalance2 = $userData[0]->ads_balance+$addBalance;
                    $updateABalance5 = $this->main_model->update('users','id',$userId,array('ads_balance' => $newAdsBalance2));
                    // updated
                    $data['title']='شحن حساب الإعلاني موقع استشارة | موقع استشارة';
                    $data['state']=5;
                    $this->load->view('userarea/paymentMsg_view',$data);
                }
                
            }else{
                // Resfused
                $data['title']='شحن حساب الإعلاني موقع استشارة | موقع استشارة';
                $data['state']=2;
                $this->load->view('userarea/paymentMsg_view',$data);
            }
            }else{
                // Resfused
                $data['title']='شحن حساب الإعلاني موقع استشارة | موقع استشارة';
                $data['state']=2;
                $this->load->view('userarea/paymentMsg_view',$data);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    function settings(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            // Convert c_balance To a_balance
                if($this->main_model->is_logged_in()){
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $id = $userData['id'];
                $this->main_model->convertBalance($id,$userData['a_balance'],$userData['c_balance']);
                }
                $data['title']='اعدادات حسابك موقع استشارة | موقع استشارة';
                $data['countries'] = $this->main_model->getAllData('countries');
                $data['error'] = '';
                $this->load->view('userarea/userEdit_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function settingsCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .'
                );
            $this->form_validation->set_rules('firstname','الاسم الأول','required',$rul);
            $this->form_validation->set_rules('lastname','الاسم الأخير','required',$rul);
            $this->form_validation->set_rules('country','الدولة','required',$rul);
            $this->form_validation->set_rules('mobile','رقم الهاتف','required',$rul);
            $this->form_validation->set_rules('postal','الرقم البريدي','required',$rul);
            $this->form_validation->set_rules('address','العنوان','required',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            // Accepted Validation
            $this->load->library('upload');
                //Upload Settings
                $config['upload_path']          = './vendor/uploads/images/';
                $config['allowed_types']        = 'jpg|png';
                $config['max_size']             = 10240;
                $config['max_width']            = 3000;
                $config['max_height']           = 3000;
                $config['encrypt_name']           = TRUE;
                
                
                $this->upload->initialize($config);
                
            if ( ! $this->upload->do_upload('userfile'))
                {
                    $data['title']='اعدادات حسابك موقع استشارة | موقع استشارة';
                    $data['countries'] = $this->main_model->getAllData('countries');
                    $data['error'] = $this->upload->display_errors();
                    
                    if($data['error'] == '<p>You did not select a file to upload.</p>'){
                        //Don`t Need To Change Image
                        $userNewSett = array(
                            'firstname' => strip_tags($this->input->post('firstname')),
                            'lastname' => strip_tags($this->input->post('lastname')),
                            'about' => strip_tags($this->input->post('about')),
                            'country' => strip_tags($this->input->post('country')),
                            'mobile' => strip_tags($this->input->post('mobile')),
                            'address' => strip_tags($this->input->post('address')),
                            'postal' => strip_tags($this->input->post('postal'))
                        );
                        $data['error'] = '';
                        $data['state'] = 1;
                        $this->main_model->update('users','id',$userId,$userNewSett);
                        
                        $this->load->view('userarea/userEdit_view', $data);
                    }else{
                        //Changed Wrong Extinsion
                        //If Statement For Changing Lang
                        if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                            $data['error']='لقد قمت بإختيار ملف ذو امتداد غير مسموح ... يمكنك تغيير الصورة بـ JPG & PNG فقط.';
                        }
                    $this->load->view('userarea/userEdit_view',$data);
                    }
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data(),
                                      'countries' => $this->main_model->getAllData('countries'),
                                      'state' => 1,
                                      'error' => $this->upload->display_errors(),
                                      'title' => 'اعدادات حسابك موقع استشارة | موقع استشارة'
                                     );
                        /// resize
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $data['upload_data']['full_path'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']         = 50;
                        $config['height']       = 70;
                       $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
                        define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
                        $myFile = PUBPATH.'vendor/uploads/images/'.$data['upload_data']['file_name'];
                        $myFile2 = PUBPATH.'vendor/uploads/images/'.$userData['image'];
                        unlink($myFile) or die("يوجد خطأ ما");
                        $headers = get_headers($myFile2, 1);
                        if (strpos($headers['Content-Type'], 'image/') !== false) {
                            unlink($myFile2) or die("يوجد خطأ ما");
                        }
                        $userNewFile1 = explode('.',$data['upload_data']['file_name']);
                        $userNewFile = $userNewFile1[0].'_thumb.'.$userNewFile1[1];
                        $userNewSett = array(
                            'firstname' => strip_tags($this->input->post('firstname')),
                            'lastname' => strip_tags($this->input->post('lastname')),
                            'image' => $userNewFile,
                            'about' => strip_tags($this->input->post('about')),
                            'country' => strip_tags($this->input->post('country')),
                            'mobile' => strip_tags($this->input->post('mobile')),
                            'address' => strip_tags($this->input->post('address')),
                            'postal' => strip_tags($this->input->post('postal'))
                        );
                        
                        $this->main_model->update('users','id',$userId,$userNewSett);
                        
                        $this->load->view('userarea/userEdit_view', $data);
                }
            
            }else{
            $this->settings();
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    
    function skills(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            // Convert c_balance To a_balance
                if($this->main_model->is_logged_in()){
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $id = $userData['id'];
                $this->main_model->convertBalance($id,$userData['a_balance'],$userData['c_balance']);
                }
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            $data['title']='مهاراتك موقع استشارة | موقع استشارة';
            $this->load->view('userarea/skills_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function sendMsg(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $f_id = (int) strip_tags($this->input->post('f_id'));
            $to_id = (int) strip_tags($this->input->post('to_id'));
            $c_id = (int) strip_tags($this->input->post('c_id'));
            $message = strip_tags($this->input->post('message'));
            $msgData = array(
                'f_id' => $f_id,
                'to_id' => $to_id,
                'date' => $this->main_model->dateTime('current'),
                'c_id' => $c_id,
                'message' => $message
            );
            $this->main_model->insertData('messages',$msgData);
            //Alert
            $this->main_model->alert('رسالة','وصلتك رسالة '.'يمكنك مشاهدة <a href="'.base_url().'users/chat/'.$f_id.'/'.'">المحادثة</a>',$to_id);
        $response = array(
            'sent' => 1,
            );
        echo json_encode($response);
        }else{
            redirect(base_url().'404/');
        }
    }
    function fetchmsgs(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $c_id = (int) strip_tags($this->input->post('c_id'));
            $messages = $this->main_model->getFullRequest('messages','(c_id = '.$c_id.')');
            $i = 0;
            $count = count((array) $messages)-1;
            while($i <= $count){
                $differ = $this->main_model->dateTime('diff',$messages[$i]->date,$this->main_model->dateTime('current'));
                ob_start(); //Start output buffer
                $this->main_model->differ($differ);
                $output = ob_get_contents(); //Grab output
                ob_end_clean(); //Discard output buffer
                $messages[$i]->differ = $output;
                if($messages[$i]->state == 1 && $messages[$i]->to_id == $this->session->userdata('id')){
                    $currentUserChat = $this->main_model->getByData('users','id',$messages[$i]->f_id)[0];
                    $toMsg = 'مرحبا ...  لقد قام <a href="'.base_url('user/'.$currentUserChat->username).'" target="_blank">'.$currentUserChat->username.'</a> بشراء خدمتك التالية ';
                    $messages[$i]->message = str_replace('مرحباً ... أنا قمت بشراء الخدمة التالية ',$toMsg,$messages[$i]->message);
                }else{
                    $messages[$i]->message = str_replace('يجب ان يراسلك البائع حتى تستطيع البدء بتنفيذ الخدمة','يجب مراسلة البائع حتى يستطيع البدء بتنفيذ الخدمة',$messages[$i]->message);
                }
            $i++;}
        $response = array(
            'done' => 1,
            'messages' => $messages
            );
        echo json_encode($response);
        }else{
            redirect(base_url().'404/');
        }
    }
    function download(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $f_id = strip_tags($this->uri->segment(3));
            $files = $this->main_model->getFullRequest('files','((id = '.$f_id.') AND (c_id = '.$id.')) OR ((id = '.$f_id.') AND (u_id = '.$id.'))');
            $this->load->helper('download');
            $data = file_get_contents(APPPATH.'../vendor/uploads/users/'.$files[0]->filename);
            $name = $files[0]->client_name;
            force_download($name, $data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function fetchTabs(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            if(strip_tags($this->input->post('fetchFor')) == 'chats'){
                $data['chats'] = $this->main_model->getFullRequest('chats','(u_id = '.$id.') OR (s_id = '.$id.')');
                if($data['chats']){
                foreach($data['chats'] as $chat){
                    if($chat->u_id !== $id){
                        $user = $this->main_model->getFullRequest('users','(id = '.$chat->u_id.')')[0];
                    }elseif($chat->s_id !== $id){
                        $user = $this->main_model->getFullRequest('users','(id = '.$chat->s_id.')')[0];
                    }
                        unset($user->password);
                        unset($user->ads_balance);
                        unset($user->all_balance);
                        unset($user->balance);
                        unset($user->c_balance);
                        unset($user->email);
                        unset($user->mobile);
                        if($user->image == ''){
                            $user->image = base_url().'vendor/images/user.png';
                        }else{
                            $user->image = base_url().'vendor/uploads/images/'.$user->image;
                        }
                        $user->link = base_url('users/chat/'.$user->id);
                        $data['users'][] = $user;
                }
            }else{
                $data['users'] = 0;
            }
                $response = array(
                    'done' => 1,
                    'chats' => $data['users']
                    );
                echo json_encode($response);
            }elseif(strip_tags($this->input->post('fetchFor')) == 'alerts'){
                $alerts = $this->main_model->getFullRequest('promsg','(s_id = '.strip_tags($this->input->post('chat')).') OR (u_id = '.strip_tags($this->input->post('chat')).')');
                foreach($alerts as $alert){
                    $items = $this->main_model->getFullRequest('items','(id = '.$alert->i_id.')')[0];
                    $items->link = base_url().'i/'.str_replace(' ','-',$items->title).'/'.$items->id;
                    if($items->kind < 2){
                        $bill = $this->main_model->getFullRequest('requestedgigs','(i_id = '.$alert->i_id.') AND (s_id = '.$alert->u_id.') AND (u_id = '.$alert->s_id.')')[0];
                        $items->billU_id = $bill->u_id;
                        $items->billId = $bill->id;
                        $items->billAmount = $bill->amount;
                    }
                    $data['items'][] = $items;
                }
                $response = array(
                    'done' => 1,
                    'alerts' => $alerts,
                    'items' => $data['items']
                    );
                echo json_encode($response);
            }elseif(strip_tags($this->input->post('fetchFor')) == 'files'){
                $files = $this->main_model->getFullRequest('files','((c_id = '.strip_tags($this->input->post('chat')).') AND (u_id = '.$id.')) OR ((c_id = '.$id.') AND (u_id = '.strip_tags($this->input->post('chat')).'))');
                $i = 0;
                foreach($files as $file){
                    $files[$i]->link = base_url().'users/download/'.$file->id.'/'.$id;
                $i++;}
                $response = array(
                    'done' => 1,
                    'files' => $files
                    );
                echo json_encode($response);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    function closeProj(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $i_id = (int) strip_tags($this->uri->segment(3));
            $msgId = (int) strip_tags($this->uri->segment(4));//s_id in promsg
            $item = $this->main_model->getFullRequest('items','(id = '.$i_id.')')[0];
            if(!$item){
                redirect(base_url().'404/');
            }
            $data['title'] = 'رسالة';
            $data['actionParams'] = $i_id.'/'.$msgId.'/';
            $this->load->view('userarea/alertMsgPro_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function closeProjCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $i_id = (int) strip_tags($this->uri->segment(3));
            $msgId = (int) strip_tags($this->uri->segment(4));//s_id in promsg
            $item = $this->main_model->getFullRequest('items','(id = '.$i_id.')')[0];
            $msg = $this->main_model->getFullRequest('promsg','(id = '.$msgId.')')[0];
            if(!$item){
                redirect(base_url().'404/');
            }
            $bid = $this->main_model->getFullRequest('bids','(id = '.$item->bid_id.')')[0];
            $id = $bid->u_id;
            $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$item->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$item->u_id.'))')[0];
                if(!$data['chat']){
                    $this->main_model->insertData('chats',array(
                        'u_id'=>$id,
                        's_id'=>$data['item']->u_id
                    ));
                    $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$item->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$item->u_id.'))')[0];
                }
                $gigUrl = '<a target="_blank" class="msgState" href="'.base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/'.'">'.$item->title.'</a>';
                $message = 'لقد تم رفض طلب تسليم المشروع التالية: '.$gigUrl.'<p>والسبب : '.strip_tags($this->input->post('comment')).'</p>';
                //Send Message
                $this->main_model->insertData('messages',array(
                    'message'=>$message,
                    'c_id'=>$data['chat']->id,
                    'f_id'=>$id,
                    'to_id'=>$item->u_id,
                    'state'=>1,
                    'date'=>$this->main_model->dateTime('current')
                ));
            $this->main_model->alert('تم رفض طلب تسليم المشروع','تم رفض طلب تسليم المشروع <a href="'.base_url().'users/chat/'.$item->u_id.'/'.'">المحادثة</a>',$id);
            $this->main_model->deleteData('promsg','id',$msg->id);
            //Redirect To Project With FlashData
            // Set flash data 
            $this->session->set_flashdata('done', 'تم رفض الطلب وارسال السبب للمستشار.');
            redirect(base_url().'users/chat/'.$id);
        }else{
            redirect(base_url().'404/');
        }
    }
    function closePro(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $i_id = (int) strip_tags($this->uri->segment(3));
            $u_id = (int) strip_tags($this->uri->segment(4));//s_id in promsg
            $amount = (int) strip_tags($this->uri->segment(5));
            $billId = (int) strip_tags($this->uri->segment(6));
            $msgId = (int) strip_tags($this->uri->segment(7));
            $item = $this->main_model->getFullRequest('items','(id = '.$i_id.')')[0];
            $bill = $this->main_model->getFullRequest('requestedgigs','(i_id = '.$i_id.') AND (u_id = '.$u_id.') AND (s_id = '.$item->u_id.') AND (amount = '.$amount.')')[0];
            if(!isset($bill) OR $bill->u_id !== $id){
                redirect(base_url().'404/');
            }
            if(!$item){
                redirect(base_url().'404/');
            }
            $data['title'] = 'رسالة';
            $data['actionParams'] = $i_id.'/'.$u_id.'/'.$amount.'/'.$billId.'/'.$msgId;
            $this->load->view('userarea/alertMsg_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function closeProCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $i_id = (int) strip_tags($this->uri->segment(3));
            $u_id = (int) strip_tags($this->uri->segment(4));//s_id in promsg
            $amount = (int) strip_tags($this->uri->segment(5));
            $billId = (int) strip_tags($this->uri->segment(6));
            $msgId = (int) strip_tags($this->uri->segment(7));
            $item = $this->main_model->getFullRequest('items','(id = '.$i_id.')')[0];
            $msg = $this->main_model->getFullRequest('promsg','(id = '.$msgId.')')[0];
            $bill = $this->main_model->getFullRequest('requestedgigs','(i_id = '.$i_id.') AND (u_id = '.$u_id.') AND (s_id = '.$item->u_id.') AND (amount = '.$amount.')')[0];
            if(!isset($bill) OR $bill->u_id !== $id){
                redirect(base_url().'404/');
            }
            if(!$item){
                redirect(base_url().'404/');
            }
            if(!$bill){
                redirect(base_url().'404/');
            }
            $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$item->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$item->u_id.'))')[0];
                if(!$data['chat']){
                    $this->main_model->insertData('chats',array(
                        'u_id'=>$id,
                        's_id'=>$data['item']->u_id
                    ));
                    $data['chat'] = $this->main_model->getFullRequest('chats','((u_id = '.$item->u_id.') AND (s_id = '.$id.')) OR ((u_id = '.$id.') AND (s_id = '.$item->u_id.'))')[0];
                }
                $gigUrl = '<a target="_blank" class="msgState" href="'.base_url().'i/'.str_replace(' ','-',$item->title).'/'.$item->id.'/'.'">'.$item->title.'</a>';
                $message = 'لقد تم رفض طلب تسليم الخدمة التالية: '.$gigUrl.'<p>والسبب : '.strip_tags($this->input->post('comment')).'</p>';
                //Send Message
                $this->main_model->insertData('messages',array(
                    'message'=>$message,
                    'c_id'=>$data['chat']->id,
                    'f_id'=>$id,
                    'to_id'=>$item->u_id,
                    'state'=>1,
                    'date'=>$this->main_model->dateTime('current')
                ));
            $this->main_model->alert('تم رفض طلب تسليم الخدمة','تم رفض طلب تسليم الخدمة <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$item->u_id);
            $this->main_model->deleteData('promsg','id',$msg->id);
            //Redirect To Project With FlashData
            // Set flash data 
            $this->session->set_flashdata('done', 'تم رفض الطلب وارسال السبب للمستشار.');
            redirect(base_url().'users/chat/'.$item->u_id);
        }else{
            redirect(base_url().'404/');
        }
    }
    function uploader(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
        if ( ! empty($_FILES))
		{
			$config['upload_path'] = "./vendor/uploads/users";
            $config['allowed_types'] = 'gif|jpg|png|mp4|ogv|rar|zip';
            $config['max_size']             = 999999;
            $config['max_width']            = 999999;
            $config['max_height']           = 999999;
            $config['encrypt_name']           = TRUE;

			$this->load->library('upload', $config);
			if (! $this->upload->do_upload("file")) {
				echo "File cannot be uploaded";
			}
		}
		$this->load->helper('file');
        $data['upload_data'] = $this->upload->data();
        //Insert File
        $fileFullPath = APPPATH.'../vendor/uploads/users/'.$data['upload_data']['file_name'];
        $this->main_model->insertData('files',array(
            'filename' => $data['upload_data']['file_name'],
            'filesize' => $data['upload_data']['file_size'],
            'fileext' => $data['upload_data']['file_ext'],
            'client_name' => $data['upload_data']['client_name'],
            'date' => $this->main_model->dateTime('current'),
            'u_id' => $id,
            'c_id' => strip_tags($this->uri->segment(3))
        ));
        $chat = $this->main_model->getByData('chats','id',strip_tags($this->uri->segment(3)))[0];
        if($chat){
            if($chat->u_id == $id){
                //Alert
                $this->main_model->alert('تم ارفاق ملف','تم ارفاق ملف تصفح <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$chat->s_id);
            }else{
                //Alert
                $this->main_model->alert('تم ارفاق ملف','تم ارفاق ملف تصفح <a href="'.base_url().'users/chat/'.$id.'/'.'">المحادثة</a>',$chat->u_id);
            }
        }
        $response = array(
            'done' => 1
            );
        echo json_encode($response);
    }else{
        redirect(base_url().'404/');
    }
    }
    function acceptPro(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $i_id = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')')[0];
            if(isset($data['item']) && $data['item']->kind == 2 && $data['item']->bid_id !== '' && $data['item']->state == 2 && $data['item']->u_id == $id){
                //It`s a project
                //Get Bid
                $data['bid'] = $this->main_model->getFullRequest('bids','(id = '.$data['item']->bid_id.')')[0];
                //Get Freelancer User
                $data['user'] = $this->main_model->getFullRequest('users','(id = '.$data['bid']->u_id.')')[0];
                //Update Item State
                $this->main_model->update('items','id',$i_id,array(
                    'state'=>3,
                    'e_date'=>$this->main_model->dateTime('current')
                ));
                //Update Client And Freelancer Balance
                    //Client
                    $this->main_model->update('users','id',$id,array(
                        'c_balance'=>$userData['c_balance']-$data['bid']->amount,
                        'all_balance'=>$userData['all_balance']-$data['bid']->amount
                    ));
                    //Freelancer
                    $this->main_model->update('users','id',$data['user']->id,array(
                        'c_balance'=>$data['user']->c_balance+$this->main_model->perCalc($data['bid']->amount),
                        'all_balance'=>$data['user']->all_balance+$this->main_model->perCalc($data['bid']->amount)
                    ));
                //Insert C_balance
                $this->main_model->insertData('c_balance',array(
                    'balance' => $this->main_model->perCalc($data['bid']->amount),
                    'i_id' => $data['item']->id,
                    'u_id' => $data['user']->id,
                    'date' => $this->main_model->dateTime('date').' '.$this->main_model->dateTime('time')
                ));
                //Update ProMsg
                $caseMsg = 'endRequest';
                    //Get Promsg
                    $data['promsg'] = $this->main_model->getFullRequest('promsg','(caseMsg = "'.$caseMsg.'") AND (u_id = '.$data['bid']->u_id.') AND (s_id = '.$id.') AND (i_id = '.$data['item']->id.')')[0];
                    //Update
                    $this->main_model->update('promsg','id',$data['promsg']->id,array(
                        'caseMsg'=>'ended',
                        'date'=>$this->main_model->dateTime('current')
                    ));
                //Alert
                $this->main_model->alert('تهانينا','تم استلام المشروع <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> بنجاح',$data['user']->id);
                $this->main_model->alert('شكراً','تم استلام المشروع <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> بنجاح برجاء <a href="'.base_url().'users/rate/'.$data['user']->id.'/'.$data['item']->id.'/'.$data['promsg']->id.'/2'.'/">تقييم</a> المستشار',$data['item']->u_id);
                //Redirect To Project With FlashData
                // Set flash data 
                $this->session->set_flashdata('done', 'تم استلام الطلبية بنجاح برجاء تقييم المستشار');
                redirect(base_url().'users/rate/'.$data['user']->id.'/'.$data['item']->id.'/'.$data['promsg']->id.'/2');
            }elseif(isset($data['item']) && $data['item']->kind == 1 && $data['item']->bid_id == NULL && $data['item']->state == 1 && $data['item']->u_id !== $id){
                //It`s a GIG
                //Get Total Price
                $i = 0;
                $gigsUp = 0;
                $gigsIds = NULL;
                $ui_rep = NULL;
                $amount = (int) strip_tags($this->uri->segment(5));
                //Get requestedgigs
                $data['requestedgigs'] = $this->main_model->getFullRequest('requestedgigs','(u_id = '.$id.') AND (i_id = '.$data['item']->id.') AND (amount = '.$amount.') AND (state = 0)')[0];
                if(!$data['requestedgigs']){
                    //Cannot find the Sell
                    redirect(base_url().'404/');
                }
                //Calculate Price
                $totalPrice = $data['requestedgigs']->amount;
                //Get Freelancer User
                $data['freelancer'] = $this->main_model->getFullRequest('users','(id = '.$data['item']->u_id.')')[0];
                $u_id = (int) strip_tags($this->uri->segment(4));
                //Update Client And Freelancer Balance
                    //Client
                    $this->main_model->update('users','id',$id,array(
                        'c_balance'=>$userData['c_balance']-$totalPrice,
                        'all_balance'=>$userData['all_balance']-$totalPrice,
                    ));
                    //Freelancer
                    $this->main_model->update('users','id',$data['item']->u_id,array(
                        'c_balance'=>$data['freelancer']->c_balance+$this->main_model->perCalc($totalPrice),
                        'all_balance'=>$data['freelancer']->all_balance+$this->main_model->perCalc($totalPrice)
                    ));
                //Insert C_balance
                $this->main_model->insertData('c_balance',array(
                    'balance' => $this->main_model->perCalc($totalPrice),
                    'i_id' => $data['item']->id,
                    'u_id' => $data['item']->u_id,
                    'date' => $this->main_model->dateTime('date').' '.$this->main_model->dateTime('time')
                ));
                //Update requestedgigs
                    //Update
                    $this->main_model->update('requestedgigs','id',$data['requestedgigs']->id,array(
                        'state'=>1,
                        'date'=>$this->main_model->dateTime('current')
                    ));
                    //Alert
                $this->main_model->alert('تهانينا','تم استلام المشروع <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> بنجاح',$data['item']->u_id);
                $this->main_model->alert('شكراً','تم استلام المشروع <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a> بنجاح برجاء <a href="'.base_url().'users/rate/'.$data['item']->u_id.'/'.$data['item']->id.'/'.$data['requestedgigs']->id.'/1'.'/">تقييم</a> المستشار',$userData['id']);
                //Redirect To Chat With FlashData
                // Set flash data 
                $this->session->set_flashdata('done', 'تم استلام الطلبية بنجاح برجاء تقييم المستشار');
                redirect(base_url().'users/rate/'.$data['item']->u_id.'/'.$data['item']->id.'/'.$data['requestedgigs']->id.'/1');
            }else{
                //Not a project Or Gig
                redirect(base_url().'404/');
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    public function rate(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
        //Get User Id & Item Id
        $u_id = strip_tags($this->uri->segment(3));
        $i_id = strip_tags($this->uri->segment(4));
        $itemBuyId = strip_tags($this->uri->segment(5));
        $kind = strip_tags($this->uri->segment(6));
        $data['user'] = $this->main_model->getFullRequest('users','(id = '.$u_id.')')[0];
        $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')')[0];
        if($kind == $data['item']->kind AND $kind == 1 AND $data['user']->id == $data['item']->u_id){
            //Gig
            $data['itemBuy'] = $this->main_model->getFullRequest('requestedgigs','(id = '.$itemBuyId.')')[0];
            if($id == $data['item']->u_id OR $id == $data['user']->id){
                //same user
                redirect(base_url().'404/');
            }
        }elseif($kind == $data['item']->kind AND $kind == 2 AND $id == $data['item']->u_id){
            //Project
            $data['itemBuy'] = $this->main_model->getFullRequest('promsg','(id = '.$itemBuyId.')')[0];
            if($id !== $data['item']->u_id OR $id !== $data['itemBuy']->s_id){
                //same user
                redirect(base_url().'404/');
            }
        }else{
            redirect(base_url().'404/');
        }
        if($data['itemBuy']->state == 2){
            //Rated
            redirect(base_url().'404/');
        }
        //Load View
        $data['title'] = 'تقييم';
        $this->load->view('userarea/rate_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    public function rateCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            //Get User Id & Item Id
            $s_id = strip_tags($this->uri->segment(3));
            $i_id = strip_tags($this->uri->segment(4));
            $itemBuyId = strip_tags($this->uri->segment(5));
            $kind = strip_tags($this->uri->segment(6));
            $data['user'] = $this->main_model->getFullRequest('users','(id = '.$s_id.')')[0];
            $data['item'] = $this->main_model->getFullRequest('items','(id = '.$i_id.')')[0];
            if($kind == $data['item']->kind AND $kind == 1 AND $data['user']->id == $data['item']->u_id){
                //Gig
                $bit = 'requestedgigs';
                $data['itemBuy'] = $this->main_model->getFullRequest('requestedgigs','(id = '.$itemBuyId.')')[0];
                if($id == $data['item']->u_id OR $id == $data['user']->id){
                    //same user
                    redirect(base_url().'404/');
                }
            }elseif($kind == $data['item']->kind AND $kind == 2 AND $id == $data['item']->u_id){
                //Project
                $bit = 'promsg';
                $data['itemBuy'] = $this->main_model->getFullRequest('promsg','(id = '.$itemBuyId.')')[0];
                if($id !== $data['item']->u_id OR $id !== $data['itemBuy']->s_id){
                    //same user
                    redirect(base_url().'404/');
                }
            }else{
                redirect(base_url().'404/');
            }
            if($data['itemBuy']->state == 2){
                //Rated
                redirect(base_url().'404/');
            }
            $rates = $this->input->post();
            $rates['u_id'] = $id;
            $rates['i_id'] = $i_id;
            $rates['s_id'] = $s_id;
            $rates['date'] = $this->main_model->dateTime('current');
            $rates['rp_id'] = $data['itemBuy']->id;
            $this->main_model->insertData('rate',$rates);
            $this->main_model->update($bit,'id',$data['itemBuy']->id,array('state'=>2));
            //Alert
            $this->main_model->alert('تم تقييمك','تم تقييمك بنجاح في  <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a>',$s_id);
            // Set flash data 
            $this->session->set_flashdata('done', 'تم تقييم المستشار بنجاح');
            redirect(base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/');
        }else{
            redirect(base_url().'404/');
        }
    }
    public function delete(){
        if($this->main_model->is_logged_in()){
            $tables = array('items','editedbid');
            if(in_array($this->uri->segment(3),$tables)){
                $table = strip_tags($this->uri->segment(3));
            }else{
                redirect(base_url().'404/');
            }
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $id = $userData['id'];
            $i_id = strip_tags($this->uri->segment(4));
            if($table == 'items'){
                $data['item'] = $this->main_model->getFullRequest($table,'(id ='.$i_id.') AND (u_id = '.$id.')');
            }else{
                $data['item'] = $this->main_model->getFullRequest($table,'(id ='.$i_id.')');
            }
            $reUrl = explode('/',$this->input->get('m'));
            if($table == 'editedbid'){
                $data['i_item'] = $this->main_model->getFullRequest('items','(id ='.$data['item'][0]->i_id.')');
                $this->main_model->alert('تم رفض طلب تعديل عرضك','تم رفض طلب تعديل عرضك على  <a href="'.base_url().'i/'.str_replace(' ','-',$data['i_item'][0]->title).'/'.$data['i_item'][0]->id.'/">'.$data['i_item'][0]->title.'</a>',$data['item'][0]->u_id);
            }
                $this->main_model->deleteData($table,'id',$data['item'][0]->id);
                if($table == 'items' OR $table == 'portfolio'){
                //Delete Images
                define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
                define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
                $images = explode(',',$data['item'][0]->images);
                    foreach($images as $image){
                        $myFile = PUBPATH.'vendor/uploads/images/'.$image;
                        $headers = get_headers($myFile, 1);
                        if (strpos($headers['Content-Type'], 'image/') !== false) {
                            unlink($myFile) or die("يوجد خطأ ما");
                        }
                    }
                }
                redirect(base_url().$this->input->get('m'));
        }else{
            redirect(base_url().'404/');
        }
    }
    function skillsRequest(){  
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){ //Check Login
            // Access User Data Securly
                        $userData = (array) $this->main_model->is_logged_in(1)[0];
                        $userId = $userData['id'];
            //First Ajax Response
            if(strip_tags($this->input->post('skill')) !== '' && strip_tags($this->input->post('request')) == 'select'){
                $search = $this->main_model->search('skills','(u_id IS NULL AND state = 0)','skill',strip_tags($this->input->post('skill')));
                $selectedSkills = $this->main_model->getFullRequest('skills','(u_id = '.$userId.')');
                $x=0;
                if($selectedSkills !== false){
                foreach($search as $siteSkill){
                    foreach($selectedSkills as $userSkill){
                        if($siteSkill->skill == $userSkill->skill){
                            unset($search[$x]);
                        }
                    }
                $x++;
                }
        $notSelected = array_combine(range(0, count($search)-1), array_values($search));
                }else{
                    $notSelected = $search;
                }
            $response = array(
                    'skills' => $notSelected,
                    );
                echo json_encode($response);
                
            }elseif(strip_tags($this->input->post('skill')) !== '' && strip_tags($this->input->post('request')) == 'delete'){
                
                $skillData=$this->main_model->getByData('skills','id',strip_tags($this->input->post('skill')));
                if($skillData[0]->u_id == $userId){
                $this->main_model->deleteData('skills','id',strip_tags($this->input->post('skill')));
                    $minus = $this->main_model->getFullRequest('skills','( u_id = '.$userId.' )','1');
                $response = array(
                    'skills' => 1,
                    'minus' => (20-$minus),
                    );
                }else{
                    $response = array(
                    'skills' => 0,
                    'minus' => (20-$minus),
                    );
                }
                echo json_encode($response);
            }elseif(strip_tags($this->input->post('request')) == 'userSkills'){
                $userSkills = $this->main_model->getFullRequest('skills','(u_id = '.$userId.')');
                $response = array(
                    'skills' => $userSkills,
                    );
                echo json_encode($response);
            }elseif(strip_tags($this->input->post('skill')) !== '' && strip_tags($this->input->post('request')) == 'add'){
                //Second Ajax Response
                    $skillData=$this->main_model->getByData('skills','id',strip_tags($this->input->post('skill')));
                    $minus = $this->main_model->getFullRequest('skills','( u_id = '.$userId.' )','1');
                    if($skillData){
                        if((20-$minus) > 0){
                        $skill=array(
                            'skill'=>$skillData[0]->skill,
                            'u_id'=>$userId,
                            'state'=>1,
                        );
                        $insertSkill= $this->main_model->insertData('skills',$skill);
                        if($insertSkill !== false){
                            $response = array(
                                'response' => 1,
                                'skills' => strip_tags($this->input->post('skill')),
                                'minus' => (20-$minus-1),
                            );
                        }else{
                            $response = array(
                                'response' => 0,
                                'minus' => (20-$minus),
                            );
                        }
                    }else{
                            $response = array(
                                'response' => 0,
                                'minus' => (20-$minus),
                            );
                        }
                        
                    }
                    echo json_encode($response);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    function addSer(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            // Access User Data Securly
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $userId = $userData['id'];
            $data['title']='اضافة تذكرة';
            $this->load->view('addSer_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function rates(){
        $data['userviewed'] = $this->viewed;
        $data['title']='تقييمات '.$data['userviewed'][0]->username;
        $data['rates'] = $this->main_model->getFullRequest('rate','(s_id = '.$data['userviewed'][0]->id.')');
        $this->load->view('userarea/rates_view',$data);
    }
    function addSerCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='اضافة تعليق';
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
                $i_id = (int) strip_tags($this->uri->segment(3));
            ///*Form Validation
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $this->form_validation->set_rules('title','عنوان موضوعك','required|min_length[10]',$rul);
            $this->form_validation->set_rules('content','وصف موضوعك','required|min_length[10]',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_bidTitle'] = strip_tags($this->input->post('title'));
            $data['p_bidContent'] = strip_tags($this->input->post('content'));
            // Accepted Validation
                //*Insert Product
                $insertProduct = $this->main_model->insertData('cdata',array(
                    'title' => $data['p_bidTitle'],
                    'content' => $data['p_bidContent'],
                    'state' => 0,
                    'co_id' => null,
                    'u_id'=> $userId,
                    'kind' => 3,
                    'date' => $this->main_model->dateTime('current')
                ));
                $item = $this->main_model->getByData('items','id',$i_id);
                if($item){
                    $this->main_model->update('items','id',$i_id,array(
                        'fight' => $insertProduct
                    ));
                }
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة تذكرة | موقع استشارة';
                // Set flash data 
                $this->session->set_flashdata('done', 'تم ارسال التذكرة بنجاح');
                redirect(base_url('pages/ser/'.$insertProduct));
        }else{
            $data['p_bidTitle'] = strip_tags($this->input->post('title'));
            $data['p_bidContent'] = strip_tags($this->input->post('content'));
            $this->load->view('addSer_view',$data);
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    function addSerReply(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in() OR $this->main_model->is_admin_logged_in()){
            $id = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getByData('cdata','id',$id)[0];
            if(!$data['item']){
                redirect(base_url().'404/');
            }
            $data['title']='اضافة تعليق';
            if($this->main_model->is_admin_logged_in()){
                // Access User Data Securly
                $userId = 0;
            }else{
                // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            }
                $id = (int) strip_tags($this->uri->segment(3));
            ///*Form Validation
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $this->form_validation->set_rules('content','التعليق','required|min_length[5]',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_bidContent'] = strip_tags($this->input->post('content'));
            // Accepted Validation
                //*Insert Product
                $insertProduct = $this->main_model->insertData('cdata',array(
                    'content' => $data['p_bidContent'],
                    'state' => 1,
                    'co_id' => $data['item']->id,
                    'u_id'=> $userId,
                    'kind'=>3,
                    'date' => $this->main_model->dateTime('current')
                ));
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة عرض | موقع استشارة';
                if($userId !== $data['item']->u_id){
                    $this->main_model->alert('تمت اضافة تعليق','تمت اضافة تعليق على <a href="'.base_url('pages/ser/'.$data['item']->id).'">'.$data['item']->title.'</a>',$data['item']->u_id);
                }
                // Set flash data 
                $this->session->set_flashdata('done', 'تم اضافة التعليق بنجاح');
                redirect(base_url('pages/ser/'.$data['item']->id));
        }else{
            $data['p_bidContent'] = strip_tags($this->input->post('content'));
            $data['lastReps'] = $this->main_model->getFullRequest('cdata','(state = 0) AND (u_id = '.$userId.') LIMIT 12');
            $data['replies'] = $this->main_model->getFullRequest('cdata','(state = 1) AND (co_id = '.$id.')');
            $this->load->view('ser_view',$data);
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    function addComm(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            // Access User Data Securly
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $userId = $userData['id'];
            $data['title']='اضافة طلب';
            $data['lastReps'] = $this->main_model->getFullRequest('community','(state = 1) LIMIT 12');
            $this->load->view('addComm_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function addCommCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='اضافة تعليق';
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            ///*Form Validation
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $this->form_validation->set_rules('title','عنوان موضوعك','required|min_length[10]',$rul);
            $this->form_validation->set_rules('content','وصف موضوعك','required|min_length[10]',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_bidTitle'] = strip_tags($this->input->post('title'));
            $data['p_bidContent'] = strip_tags($this->input->post('content'));
            // Accepted Validation
                //*Insert Product
                $insertProduct = $this->main_model->insertData('community',array(
                    'title' => $data['p_bidTitle'],
                    'content' => $data['p_bidContent'],
                    'state' => 0,
                    'co_id' => null,
                    'u_id'=> $userId,
                    'date' => $this->main_model->dateTime('current')
                ));
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة عرض | موقع استشارة';
                // Set flash data 
                $this->session->set_flashdata('done', 'تم اضافة العرض بنجاح');
                redirect(base_url('pages/comm/'.$insertProduct));
        }else{
            $data['p_bidTitle'] = strip_tags($this->input->post('title'));
            $data['p_bidContent'] = strip_tags($this->input->post('content'));
            $this->load->view('comm_view',$data);
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    function addReply(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $id = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getByData('community','id',$id)[0];
            if(!$data['item']){
                redirect(base_url().'404/');
            }
            $data['title']='اضافة تعليق';
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            ///*Form Validation
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $this->form_validation->set_rules('content','وصف عرضك','required|min_length[10]',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_bidContent'] = strip_tags($this->input->post('content'));
            // Accepted Validation
                //*Insert Product
                $insertProduct = $this->main_model->insertData('community',array(
                    'content' => $data['p_bidContent'],
                    'state' => 1,
                    'co_id' => $data['item']->id,
                    'u_id'=> $userId,
                    'date' => $this->main_model->dateTime('current')
                ));
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة عرض | موقع استشارة';
                if($userId !== $data['item']->u_id){
                    $this->main_model->alert('تمت اضافة تعليق','تمت اضافة تعليق على <a href="'.base_url('pages/comm/'.$data['item']->id).'">'.$data['item']->title.'</a>',$data['item']->u_id);
                }
                // Set flash data 
                $this->session->set_flashdata('done', 'تم اضافة التعليق بنجاح');
                redirect(base_url('pages/comm/'.$data['item']->id));
        }else{
            $data['p_bidContent'] = strip_tags($this->input->post('content'));
            $this->load->view('comm_view',$data);
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    function addEditBid(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $id = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getByData('items','id',$id)[0];
            if(!$data['item']){
                redirect(base_url().'404/');
            }
            if($data['item']->kind == 2){
                $data['bids'] = $this->main_model->getByData('bids','i_id',$id);
            }else{
                redirect(base_url().'404/');
            }
            $i_id = strip_tags($this->uri->segment(3));
            $data['title']='اضافة عرض';
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
                // Check if is bidder
                $isBidder = $this->main_model->getFullRequest('bids','(i_id = '.$i_id.') AND (u_id = '.$userId.') AND (id = '.strip_tags($this->input->post('bid_id')).')')[0];
                if($isBidder->id !== $data['item']->bid_id){
                    redirect(base_url().'404/');
                }
            ///*Form Validation
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $this->form_validation->set_rules('bidContent','وصف عرضك','required|min_length[5]',$rul);
            $this->form_validation->set_rules('bidDur','مدة التنفيذ','required|is_natural',$rul);
            $this->form_validation->set_rules('bidAmount','قيمة العرض','required|is_natural',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_bidContent'] = strip_tags($this->input->post('bidContent'));
            $data['p_bidDur'] = strip_tags($this->input->post('bidDur'));
            $data['p_bidAmount'] = strip_tags($this->input->post('bidAmount'));
            $data['p_bid_id'] = strip_tags($this->input->post('bid_id'));
            // Accepted Validation
            $deleteReq = false;
            if($data['p_bidAmount'] < 1){
                $deleteReq = $this->main_model->getFullRequest('editedbid','(amount = '.$data['p_bidAmount'].') AND (days = '.$data['p_bidDur'].') AND (i_id = '.$i_id.') AND (u_id = '.$userId.') AND (bid_id = '.$data['p_bid_id'].')');
                if(!$deleteReq){
                    $deleteReq = false;
                }
            }
            if(!$deleteReq){
                //*Insert Product
                $insertProduct = $this->main_model->insertData('editedbid',array(
                    'bid_id' => $data['p_bid_id'],
                    'bid' => $data['p_bidContent'],
                    'days' => $data['p_bidDur'],
                    'amount' => $data['p_bidAmount'],
                    'u_id'=> $userId,
                    'i_id'=> $i_id,
                    'date' => $this->main_model->dateTime('current')
                ));
            }
                
                $data = array();$data['userviewed'] = $this->viewed;
                $id = (int) strip_tags($this->uri->segment(3));
                $data['item'] = $this->main_model->getByData('items','id',$id)[0];
                if(!$data['item']){
                    redirect(base_url().'404/');
                }
                if($data['item']->kind == 2){
                    $data['bids'] = $this->main_model->getByData('bids','i_id',$id);
                }
                //Alert
                if(strip_tags($this->input->post('bidAmount')) < 1){
                    $msg = 'عمل طلب إلغاء';
                }else{
                    $msg = 'طلب تعديل عرض';
                }
                if(!$deleteReq){
                    $this->main_model->alert('تم '.$msg,'تم '.$msg.' على <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a>',$data['item']->u_id);
                    $this->session->set_flashdata('done','تم ارسال الطلب بنجاح');
                }else{
                    $this->session->set_flashdata('error','تم ارسال الطلب سابقاً');
                }
                redirect(base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id);
        }else{
            $data['p_bidContent'] = strip_tags($this->input->post('bidContent'));
            $data['p_bidDur'] = strip_tags($this->input->post('bidDur'));
            $data['p_bidAmount'] = strip_tags($this->input->post('bidAmount'));
            $this->session->set_flashdata('error','يوجد خطأ ما برجاء المحاولة مرة أخرى.');
            redirect(base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id);
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    function addBid(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $id = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getByData('items','id',$id)[0];
            if(!$data['item']){
                redirect(base_url().'404/');
            }
            if($data['item']->kind == 2){
                $data['bids'] = $this->main_model->getByData('bids','i_id',$id);
            }else{
                redirect(base_url().'404/');
            }
            $i_id = strip_tags($this->uri->segment(3));
            $data['title']='اضافة عرض';
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
                // Check if is bidder
                $isBidder = $this->main_model->getFullRequest('bids','(i_id = '.$i_id.') AND (u_id = '.$userId.')','count');
                if($isBidder){
                    redirect(base_url().'404/');
                }
            ///*Form Validation
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $this->form_validation->set_rules('bidContent','وصف عرضك','required|min_length[10]',$rul);
            $this->form_validation->set_rules('bidDur','مدة التنفيذ','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('bidAmount','قيمة العرض','required|is_natural_no_zero',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_bidContent'] = strip_tags($this->input->post('bidContent'));
            $data['p_bidDur'] = strip_tags($this->input->post('bidDur'));
            $data['p_bidAmount'] = strip_tags($this->input->post('bidAmount'));
            // Accepted Validation
                //*Insert Product
                $insertProduct = $this->main_model->insertData('bids',array(
                    'bid' => $data['p_bidContent'],
                    'days' => $data['p_bidDur'],
                    'amount' => $data['p_bidAmount'],
                    'u_id'=> $userId,
                    'i_id'=> $i_id,
                    'date' => $this->main_model->dateTime('current')
                ));
                
                $data = array();$data['userviewed'] = $this->viewed;
                $id = (int) strip_tags($this->uri->segment(3));
                $data['item'] = $this->main_model->getByData('items','id',$id)[0];
                if(!$data['item']){
                    redirect(base_url().'404/');
                }
                if($data['item']->kind == 2){
                    $data['bids'] = $this->main_model->getByData('bids','i_id',$id);
                }
                //Alert
                $this->main_model->alert('تم اضافة عرض','تم اضافة عرض على <a href="'.base_url().'i/'.str_replace(' ','-',$data['item']->title).'/'.$data['item']->id.'/">'.$data['item']->title.'</a>',$data['item']->u_id);
                $data['state'] = 1;
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة عرض | موقع استشارة';
                $this->load->view('item_view',$data);
        }else{
            $data['p_bidContent'] = strip_tags($this->input->post('bidContent'));
            $data['p_bidDur'] = strip_tags($this->input->post('bidDur'));
            $data['p_bidAmount'] = strip_tags($this->input->post('bidAmount'));
            $this->load->view('item_view',$data);
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    function editBid(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $id = (int) strip_tags($this->uri->segment(3));
            $data['bid'] = $this->main_model->getByData('bids','id',$id)[0];
            if(!$data['bid']){
                redirect(base_url().'404/');
            }
            $data['title']='اضافة عرض';
            $i_id = $data['bid']->i_id;
            $data['items'] = $this->main_model->getByData('items','id',$i_id)[0];
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
                if($data['bid']->u_id !== $userId){
                    redirect(base_url().'404/');
                }
                // Check if is bidder
                $isBidder = $this->main_model->getFullRequest('bids','(i_id = '.$i_id.') AND (u_id = '.$userId.')','count');
                if($isBidder == 0){
                    redirect(base_url().'404/');
                }
            ///*Form Validation
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $this->form_validation->set_rules('bidContent','وصف عرضك','required|min_length[10]',$rul);
            $this->form_validation->set_rules('bidDur','مدة التنفيذ','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('bidAmount','قيمة العرض','required|is_natural_no_zero',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_bidContent'] = strip_tags($this->input->post('bidContent'));
            $data['p_bidDur'] = strip_tags($this->input->post('bidDur'));
            $data['p_bidAmount'] = strip_tags($this->input->post('bidAmount'));
            // Accepted Validation
                //*Insert Product
                $insertProduct = $this->main_model->update('bids','id',$id,array(
                    'bid' => $data['p_bidContent'],
                    'days' => $data['p_bidDur'],
                    'amount' => $data['p_bidAmount'],
                    'date' => $this->main_model->dateTime('current')
                ));
                //Alert
                $this->main_model->alert('تم تعديل عرض','قام '.$userData['firstname'].' '.$userData['lastname'].' بتعديل عرضه على <a href="'.base_url().'i/'.str_replace(' ','-',$data['items']->title).'/'.$data['items']->id.'/">'.$data['items']->title.'</a>',$data['items']->u_id);
                $data = array();$data['userviewed'] = $this->viewed;
                $id = (int) strip_tags($this->uri->segment(3));
                $data['bid'] = $this->main_model->getByData('bids','id',$id)[0];
                $i_id = $data['bid']->i_id;
                $data['items'] = $this->main_model->getByData('items','id',$i_id)[0];
                // Set flash data 
                $this->session->set_flashdata('done', 'تم تعديل العرض بنجاح');
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة عرض | موقع استشارة';
                redirect(base_url().'i/'.str_replace(' ','-',$data['items']->title).'/'.$data['items']->id.'/');
        }else{
            $data['p_bidContent'] = strip_tags($this->input->post('bidContent'));
            $data['p_bidDur'] = strip_tags($this->input->post('bidDur'));
            $data['p_bidAmount'] = strip_tags($this->input->post('bidAmount'));
            $this->load->view('item_view',$data);
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    function insertProduct(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مُنتج | موقع استشارة';
                $this->load->view('userarea/productForm_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function insertProductCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مُنتج | موقع استشارة';
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $subCat = $this->main_model->getByData('categories','state',1);
            $catsnum = count($subCat)-1;
            $z = 0;
            $catlist = '';
            while($z <= $catsnum){
                $catlist .= $subCat[$z]->id;
                if($z !== $catsnum){
                    $catlist .= ',';
                }
                $z++;
            }
            $this->form_validation->set_rules('title','عنوان المنتج','required|min_length[10]|alpha_numeric_spaces',$rul);
            $this->form_validation->set_rules('content','وصف المنتج','required|min_length[100]',$rul);
            $this->form_validation->set_rules('ytlink','رابط الفيديو','valid_url',$rul);
            $this->form_validation->set_rules('price','سعر المُنتج','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('tags','الكلمات المفتاحية','required',$rul);
            $this->form_validation->set_rules('category','تصنيف','required|in_list['.$catlist.']',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_ytlink'] = $this->input->post('ytlink');
            $data['p_price'] = $this->input->post('price');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            // Accepted Validation
                //Upload Images Settings
            
            // load library only once
                $this->load->library('upload');
            
                $config['upload_path']          = './vendor/uploads/images/';
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 5000;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $config['encrypt_name']           = TRUE;

                $this->upload->initialize($config);
// Loop For 4 Images
            $imgnum=1;
            define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
            define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
            while($imgnum <= 4){
                if ( ! $this->upload->do_upload('img'.$imgnum))
                {
                        $data['error'] = $this->upload->display_errors();
                    //If Statement For Changing Lang
                        if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                            $data['error']='امتداد الملف غير مسموح.';
                        }
                    // Upload Errors
                        $this->load->view('userarea/productForm_view', $data);
                    break;
                }
                else
                {
                    // Image
                        $data['img'.$imgnum] = array('upload_data' => $this->upload->data());
                   
                    /// resize Image for slider
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $data['img'.$imgnum]['upload_data']['full_path'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']         = 800;
                        $config['height']       = 400;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                     if($imgnum == 1){
                         $this->image_lib->clear();
                    /// resize Image for thumb
                        $config_thumb['image_library'] = 'gd2';
                        $config_thumb['source_image'] = $data['img'.$imgnum]['upload_data']['full_path'];
                        $config_thumb['create_thumb'] = TRUE;
                        $config_thumb['maintain_ratio'] = TRUE;
                        $config_thumb['width']         = 270;
                        $config_thumb['height']       = 160;
                        $config_thumb['new_image'] = $data['img'.$imgnum]['upload_data']['file_path'] . "vthumb_" . $data['img'.$imgnum]['upload_data']['file_name'];
                        $this->image_lib->initialize($config_thumb);
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                        $myFile = PUBPATH.'vendor/uploads/images/'.$data['img'.$imgnum]['upload_data']['file_name'];
                        unlink($myFile) or die("يوجد خطأ ما");
                        $userNewFile1 = explode('.',$data['img'.$imgnum]['upload_data']['file_name']);
                        $images[$imgnum] = $userNewFile1[0].'_thumb.'.$userNewFile1[1];
                    if($imgnum == 4){
                        //Upload File Settings
            
                $config2['upload_path']          = './vendor/uploads/';
                $config2['allowed_types']        = 'rar|zip|pdf|png|jpg';
                $config2['max_size']             = 100000;
                $config2['encrypt_name']           = TRUE;

                $this->upload->initialize($config2);
                        
            if ( ! $this->upload->do_upload('file'))
            {
                $data['error'] = $this->upload->display_errors();
                    //If Statement For Changing Lang
                        if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                            $data['error']='امتداد الملف غير مسموح.';
                        }elseif($data['error'] == '<p>The file you are attempting to upload is larger than the permitted size.</p>'){
                            $data['error']='الحد الأقصى لحجم الملف هو 100MB.';
                        }
                
                    // Upload Errors
                foreach($images as $image){
                    $imageLink = PUBPATH.'vendor/uploads/images/'.$image;
                    unlink($imageLink) or die("يوجد خطأ ما");
                }
                        $this->load->view('userarea/productForm_view', $data);
                
            }else{
                $data['file'] = array('upload_data' => $this->upload->data());
                if(!empty($this->input->post('affiliate'))){
                    $data['p_affiliate'] = 1;
                }else{
                    $data['p_affiliate'] = 0;
                }
                $data['thumbnails'] = $images;
                

                /*Insert File*/
                $fileFullPath = PUBPATH.'vendor/uploads/'.$data['file']['upload_data']['file_name'];
                $fileContent = file_get_contents($fileFullPath);
                $this->main_model->insertData('files',array(
                    'file' => $fileContent,
                    'filename' => $data['file']['upload_data']['file_name'],
                    'filesize' => $data['file']['upload_data']['file_size'],
                    'fileext' => $data['file']['upload_data']['file_ext'],
                    'date' => $this->main_model->dateTime('current'),
                    'u_id' => $userId
                ));
                unlink($fileFullPath) or die("يوجد خطأ ما");
                
                $file_id = $this->main_model->getByData('files','filename',$data['file']['upload_data']['file_name']);
                
                /*Insert Product*/
                $insertProduct = $this->main_model->insertData('items',array(
                    'title' => $data['p_title'],
                    'content' => $data['p_content'],
                    'ytlink' => $data['p_ytlink'],
                    'price' => $data['p_price'],
                    'tags' => $data['p_tags'],
                    'affiliate' => $data['p_affiliate'],
                    'images' => $data['thumbnails'][1].','.$data['thumbnails'][2].','.$data['thumbnails'][3].','.$data['thumbnails'][4],
                    'tag_id' => $data['p_tag_id'],
                    'date' => $this->main_model->dateTime('current'),
                    'file_id' => $file_id[0]->id,
                    'u_id' => $userId,
                    'state' => 0,
                    'kind' => 0
                ));
                
                $data = array();$data['userviewed'] = $this->viewed;
                $data['state'] = 1;
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مُنتج | موقع استشارة';
                $this->load->view('userarea/productForm_view',$data);
                
            }
                    }
                    
                }
                $imgnum++;
            }
            
            
        }else{
            $data['userviewed'] = $this->viewed;
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_ytlink'] = $this->input->post('ytlink');
            $data['p_price'] = $this->input->post('price');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            $this->load->view('userarea/productForm_view',$data);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    
    function insertPortfolio(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة خدمة | موقع استشارة';
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
                $this->load->view('userarea/portfolioForm_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function insertPortfolioCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة عمل | موقع استشارة';
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $subCat = $this->main_model->getByData('categories','state',1);
            $catsnum = count($subCat)-1;
            $z = 0;
            $catlist = '';
            while($z <= $catsnum){
                $catlist .= $subCat[$z]->id;
                if($z !== $catsnum){
                    $catlist .= ',';
                }
                $z++;
            }
            $this->form_validation->set_rules('title','عنوان العمل','required|min_length[8]|alpha_numeric_spaces',$rul);
            $this->form_validation->set_rules('content','وصف العمل','required|min_length[100]',$rul);
            $this->form_validation->set_rules('ytlink','رابط الفيديو','valid_url',$rul);
            $this->form_validation->set_rules('duration','مدة التنفيذ','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('tags','الكلمات المفتاحية','required',$rul);
            $this->form_validation->set_rules('subtag','تصنيف فرعي','required|in_list['.$catlist.']',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_ytlink'] = $this->input->post('ytlink');
            $data['p_duration'] = $this->input->post('duration');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('subtag');
            // Accepted Validation
                //Upload Images Settings
            
            // load library only once
                $this->load->library('upload');
            
                $config['upload_path']          = './vendor/uploads/images/';
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 5000;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $config['encrypt_name']           = TRUE;

                $this->upload->initialize($config);
// Loop For 4 Images
                $imgCou = 1;$imgnum = array();
                while($imgCou <= 4){
                    if($this->input->post('img_input'.$imgCou)){
                        $imgnums[] = $this->input->post('img_input'.$imgCou);
                    }
                $imgCou++;}
                define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
                define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
                foreach($imgnums as $imgnum){
                if ( ! $this->upload->do_upload('img'.$imgnum))
                {
                        $data['error'] = $this->upload->display_errors();
                    //If Statement For Changing Lang
                        if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                            $data['error']='امتداد الملف غير مسموح.';
                        }
                    // Upload Errors
                        $this->load->view('userarea/portfolioForm_view', $data);
                    break;
                }
                else
                {
                    // Image
                        $data['img'.$imgnum] = array('upload_data' => $this->upload->data());
                    /// resize Image
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $data['img'.$imgnum]['upload_data']['full_path'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']         = 800;
                        $config['height']       = 400;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        if($imgnum == 1){
                             $this->image_lib->clear();
                        /// resize Image for thumb
                            $config_thumb['image_library'] = 'gd2';
                            $config_thumb['source_image'] = $data['img'.$imgnum]['upload_data']['full_path'];
                            $config_thumb['create_thumb'] = TRUE;
                            $config_thumb['maintain_ratio'] = TRUE;
                            $config_thumb['width']         = 270;
                            $config_thumb['height']       = 160;
                            $config_thumb['new_image'] = $data['img'.$imgnum]['upload_data']['file_path'] . "vthumb_" . $data['img'.$imgnum]['upload_data']['file_name'];
                            $this->image_lib->initialize($config_thumb);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                        $myFile = PUBPATH.'vendor/uploads/images/'.$data['img'.$imgnum]['upload_data']['file_name'];
                        unlink($myFile) or die("يوجد خطأ ما");
                        $userNewFile1 = explode('.',$data['img'.$imgnum]['upload_data']['file_name']);
                        $images[$imgnum] = $userNewFile1[0].'_thumb.'.$userNewFile1[1];
                        if($imgnum == end($imgnums)){
                        
                if(!empty($this->input->post('affiliate'))){
                    $data['p_affiliate'] = 1;
                }else{
                    $data['p_affiliate'] = 0;
                }
                $data['thumbnails'] = $images;
                $thumbnails = $data['thumbnails'][1];
                foreach($imgnums as $imgnum){
                    if($imgnum > 1){
                        $thumbnails .= ','.$data['thumbnails'][$imgnum];
                    }
                }
                $fileId = 0;
                //Here Insert File Id
                //Upload File Settings
            // load library only once
            $this->load->library('upload');
            $config2['upload_path']          = './vendor/uploads/';
            $config2['allowed_types']        = 'rar|zip|pdf|png|jpg';
            $config2['max_size']             = 100000;
            $config2['encrypt_name']           = TRUE;

            $this->upload->initialize($config2);
                    
        if ( ! $this->upload->do_upload('file'))
        {
            $data['error'] = $this->upload->display_errors();
                //If Statement For Changing Lang
                    if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                        $data['error']='امتداد الملف غير مسموح.';
                        $this->load->view('userarea/portfolioForm_view', $data);
                    }elseif($data['error'] == '<p>The file you are attempting to upload is larger than the permitted size.</p>'){
                        $data['error']='الحد الأقصى لحجم الملف هو 100MB.';
                        $this->load->view('userarea/portfolioForm_view', $data);
                    }elseif($data['error'] == '<p>You did not select a file to upload.</p>'){
                        $fileId = 0;
                    }
            
        }else{    
            $data['file'] = array('upload_data' => $this->upload->data());
            $fileId = $data['file']['upload_data']['file_name'];
    }
                /*Insert Product*/
                $insertProduct = $this->main_model->insertData('portfolio',array(
                    'title' => $data['p_title'],
                    'content' => $data['p_content'],
                    'ytlink' => $data['p_ytlink'],
                    'duration' => $data['p_duration'],
                    'tags' => $data['p_tags'],
                    'affiliate' => $data['p_affiliate'],
                    'images' => $thumbnails,
                    'tag_id' => $data['p_tag_id'],
                    'date' => $this->main_model->dateTime('current'),
                    'file_id' => $fileId,
                    'u_id' => $userId,
                    'state' => 1,
                    'kind' => 1
                ));
                //Here I`ll Insert Attachments

                $data = array();$data['userviewed'] = $this->viewed;
                $data['state'] = 1;
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة عمل | موقع استشارة';
                $this->load->view('userarea/portfolioForm_view',$data);
                
                    }
                    
                }
            }
            
            
        }else{
            $data['userviewed'] = $this->viewed;
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_ytlink'] = $this->input->post('ytlink');
            $data['p_price'] = $this->input->post('price');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            $this->load->view('userarea/portfolioForm_view',$data);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    function closeCheck(){
        if($this->main_model->is_logged_in()){
            // Access User Data Securly
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $userId = $userData['id'];
            $item = $this->main_model->getFullRequest('items','(id = '.$this->uri->segment(3).') AND (u_id = '.$userId.')');
            if($item){
                if($item[0]->state == '1'){
                    $this->main_model->update('items','id',$item[0]->id,array(
                        'state' => 10
                    ));
                    $this->session->set_flashdata('done','تم ايقاف الخدمة بنجاح');
                }elseif($item[0]->state == '10'){
                    $this->main_model->update('items','id',$item[0]->id,array(
                        'state' => 0
                    ));
                    $this->session->set_flashdata('done','تم ارسال طلب لتفعيل الخدمة');
                }else{
                    $this->session->set_flashdata('error','لم يتم قبول الخدمة أصلاً ... لإيقافها.');
                    $itemLink = 'i/'.str_replace(' ','-',$item[0]->title).'/'.$item[0]->id.'/';
                    redirect(base_url().'i/'.$itemLink);
                }
                
                $itemLink = str_replace(' ','-',$item[0]->title).'/'.$item[0]->id.'/';
                //$this->main_model->alert('تم نشر موضوعك : <a target="_blank" href="'.$itemLink.'">'.$item[0]->title.'</a>','تم نشر موضوعك ويمكنك معاينته',$item[0]->u_id);
                        redirect(base_url().'i/'.$itemLink);
            }else{
                redirect(base_url().'404/');
            }
        }
    }
    function editProject(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - تعديل خدمة | موقع استشارة';
            // Access User Data Securly
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $userId = $userData['id'];
            $i_id = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getFullRequest('items','id = '.$i_id);
            $data['bids'] = $this->main_model->getFullRequest('bids','i_id = '.$i_id);
            if($data['bids']){
                redirect(base_url('404/'));
            }
            if(!$data['item']){
                redirect(base_url('404/'));
            }elseif($data['item'][0]->u_id !== $userId){
                redirect(base_url('404/'));
            }elseif($data['item'][0]->kind !== '2'){
                redirect(base_url('404/'));
            }
            $data['item_subtag'] = $this->main_model->getFullRequest('categories','id = '.$data['item'][0]->tag_id);
            $data['item_gus'] = $this->main_model->getFullRequest('gigupdates','i_id = '.$data['item'][0]->id);
            $data['item_mtag'] = $this->main_model->getAllDataCond('categories','state',0,'id',$data['item_subtag'][0]->c_id);
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
                $this->load->view('userarea/projectForm_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function editGig(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - تعديل خدمة | موقع استشارة';
            // Access User Data Securly
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $userId = $userData['id'];
            $i_id = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getFullRequest('items','id = '.$i_id);
            if(!$data['item']){
                redirect(base_url('404/'));
            }elseif($data['item'][0]->u_id !== $userId){
                redirect(base_url('404/'));
            }elseif($data['item'][0]->kind !== '1'){
                redirect(base_url('404/'));
            }
            $data['item_subtag'] = $this->main_model->getFullRequest('categories','id = '.$data['item'][0]->tag_id);
            $data['item_gus'] = $this->main_model->getFullRequest('gigupdates','i_id = '.$data['item'][0]->id);
            $data['item_mtag'] = $this->main_model->getAllDataCond('categories','state',0,'id',$data['item_subtag'][0]->c_id);
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
                $this->load->view('userarea/gigForm_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function editGigCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة خدمة | موقع استشارة';
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $subCat = $this->main_model->getByData('categories','state',1);
            $catsnum = count($subCat)-1;
            $z = 0;
            $catlist = '';
            while($z <= $catsnum){
                $catlist .= $subCat[$z]->id;
                if($z !== $catsnum){
                    $catlist .= ',';
                }
                $z++;
            }
            $this->form_validation->set_rules('title','عنوان الخدمة','required|min_length[10]|alpha_numeric_spaces',$rul);
            $this->form_validation->set_rules('content','وصف الخدمة','required|min_length[100]',$rul);
            $this->form_validation->set_rules('ytlink','رابط الفيديو','valid_url',$rul);
            $this->form_validation->set_rules('price','سعر الخدمة','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('duration','مدة التنفيذ','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('tags','الكلمات المفتاحية','required',$rul);
            $this->form_validation->set_rules('subtag','تصنيف فرعي','required|in_list['.$catlist.']',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_id'] = (int) strip_tags($this->uri->segment(3));
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_ytlink'] = $this->input->post('ytlink');
            $data['p_price'] = $this->input->post('price');
            $data['p_duration'] = $this->input->post('duration');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('subtag');

            $data['item'] = $this->main_model->getByData('items','id',$data['p_id']);
            if(!$data['item']){
                redirect(base_url('404/'));
            }elseif($data['item'][0]->u_id !== $userId || $data['item'][0]->kind !== '1'){
                redirect(base_url('404/'));
            }
            // Accepted Validation
                //Upload Images Settings
            
            // load library only once
                $this->load->library('upload');
            
                $config['upload_path']          = './vendor/uploads/images/';
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 5000;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $config['encrypt_name']           = TRUE;

                $this->upload->initialize($config);
// Loop For 4 Images
            $imgCou = 1;$imgnum = array();
            while($imgCou <= 4){
                if($this->input->post('img_input'.$imgCou)){
                    $imgnums[] = $this->input->post('img_input'.$imgCou);
                }else{
                    $unUploaded[] = $imgCou;
                }
            $imgCou++;}
            define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
            define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
            if(isset($imgnums)){
            foreach($imgnums as $imgnum){
                if ( ! $this->upload->do_upload('img'.$imgnum))
                {
                        $data['error'] = $this->upload->display_errors();
                    //If Statement For Changing Lang
                        if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                            $data['error']='امتداد الملف غير مسموح.';
                        }
                        $data['p_id'] = (int) strip_tags($this->uri->segment(3));
                        $data['item'] = $this->main_model->getByData('items','id',$data['p_id']);
                        $data['item_subtag'] = $this->main_model->getFullRequest('categories','id = '.$data['item'][0]->tag_id);
                        $data['item_gus'] = $this->main_model->getFullRequest('gigupdates','i_id = '.$data['item'][0]->id);
                        $data['item_mtag'] = $this->main_model->getAllDataCond('categories','state',0,'id',$data['item_subtag'][0]->c_id);
                        $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                            foreach($data['mtags'] as $mtag){
                                $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                                $msubtag[$mtag->id] = $data['subtags'];
                            }
                            $data['msubtag'] = $msubtag;
                    // Upload Errors
                        $this->load->view('userarea/gigForm_view', $data);
                        
                    break;
                }
                else
                {
                    // Image
                        $data['img'.$imgnum] = array('upload_data' => $this->upload->data());
                    /// resize Image
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $data['img'.$imgnum]['upload_data']['full_path'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']         = 800;
                        $config['height']       = 400;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        if($imgnum == 1){
                             $this->image_lib->clear();
                        /// resize Image for thumb
                            $config_thumb['image_library'] = 'gd2';
                            $config_thumb['source_image'] = $data['img'.$imgnum]['upload_data']['full_path'];
                            $config_thumb['create_thumb'] = TRUE;
                            $config_thumb['maintain_ratio'] = TRUE;
                            $config_thumb['width']         = 270;
                            $config_thumb['height']       = 160;
                            $config_thumb['new_image'] = $data['img'.$imgnum]['upload_data']['file_path'] . "vthumb_" . $data['img'.$imgnum]['upload_data']['file_name'];
                            $this->image_lib->initialize($config_thumb);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                        $userNewFile1 = explode('.',$data['img'.$imgnum]['upload_data']['file_name']);
                        $images[$imgnum] = $userNewFile1[0].'_thumb.'.$userNewFile1[1];
                    if($imgnum == end($imgnums)){
                        
                if(!empty($this->input->post('affiliate'))){
                    $data['p_affiliate'] = 1;
                }else{
                    $data['p_affiliate'] = 0;
                }
                $data['thumbnails'] = $images;
                $itemImages = explode(',',$data['item'][0]->images);
                foreach($unUploaded as $un){
                    if(isset($itemImages[$un-1])){
                        $newThumbs[$un-1] = $itemImages[$un-1];
                        unset($itemImages[$un-1]);
                    }
                }
                foreach($itemImages as $itemImage){
                    $myFile = PUBPATH.'vendor/uploads/images/'.$itemImage;
                    unlink($myFile) or die("يوجد خطأ ما");
                }
                $newImages = array_merge($newThumbs,$data['thumbnails']);
                $i = 1;$thumbnails = '';
                foreach($newImages as $newImage){
                    if($newImage !== ''){
                        if($i == 1){
                            $thumbnails .= $newImage;
                        }else{
                            $thumbnails .= ','.$newImage;
                        }
                    }
                $i++;}
                /*Insert Product*/
                $insertProduct = $this->main_model->update('items','id',$data['p_id'],array(
                    'title' => $data['p_title'],
                    'content' => $data['p_content'],
                    'ytlink' => $data['p_ytlink'],
                    'price' => $data['p_price'],
                    'duration' => $data['p_duration'],
                    'tags' => $data['p_tags'],
                    'affiliate' => $data['p_affiliate'],
                    'images' => $thumbnails,
                    'tag_id' => $data['p_tag_id'],
                    'date' => $this->main_model->dateTime('current'),
                    'file_id' => 0,
                    'u_id' => $userId,
                    'state' => 0,
                    'kind' => 1
                ));
                //Insert Gig Updates
                    //Get Inserted
                    $i = 1;$gUp = 0;
                    while($i <= 5){
                        if($this->input->post('guTitle'.$i) !== '' && $this->input->post('guPrice'.$i) !== '' && $this->input->post('guDuration'.$i) !== ''){
                            $data['gigUpdates']['guTitle'][] = $this->input->post('guTitle'.$i);
                            $data['gigUpdates']['guPrice'][] = $this->input->post('guPrice'.$i);
                            $data['gigUpdates']['guDuration'][] = $this->input->post('guDuration'.$i);
                            $gUp = 1;
                        }
                    $i++;}
                    if($gUp == 1){
                        $gus = $this->main_model->getByData('gigupdates','i_id',$data['item'][0]->id);
                        $guId = $gus[0]->id;
                    //Insert GigUpdate
                    $insertGigUpdate = $this->main_model->update('gigupdates','id',$guId,array(
                        'content' => implode(", ",$data['gigUpdates']['guTitle']),
                        'amount' => implode(", ",$data['gigUpdates']['guPrice']),
                        'days' => implode(", ",$data['gigUpdates']['guDuration']),
                        'date' => $this->main_model->dateTime('current')
                    ));
                }
                
                $data = array();$data['userviewed'] = $this->viewed;
                $data['p_id'] = (int) strip_tags($this->uri->segment(3));
                $data['item'] = $this->main_model->getByData('items','id',$data['p_id']);
                $data['item_subtag'] = $this->main_model->getFullRequest('categories','id = '.$data['item'][0]->tag_id);
                $data['item_gus'] = $this->main_model->getFullRequest('gigupdates','i_id = '.$data['item'][0]->id);
                $data['item_mtag'] = $this->main_model->getAllDataCond('categories','state',0,'id',$data['item_subtag'][0]->c_id);
                $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                    foreach($data['mtags'] as $mtag){
                        $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                        $msubtag[$mtag->id] = $data['subtags'];
                    }
                $data['msubtag'] = $msubtag;
                $data['state'] = 1;
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة خدمة | موقع استشارة';
                $this->load->view('userarea/gigForm_view',$data);
                
                    }
                    
                }
            }
        }else{
            //Without Images
            if(!empty($this->input->post('affiliate'))){
                $data['p_affiliate'] = 1;
            }else{
                $data['p_affiliate'] = 0;
            }
            /*Insert Product*/
            $insertProduct = $this->main_model->update('items','id',$data['p_id'],array(
                'title' => $data['p_title'],
                'content' => $data['p_content'],
                'ytlink' => $data['p_ytlink'],
                'price' => $data['p_price'],
                'duration' => $data['p_duration'],
                'tags' => $data['p_tags'],
                'affiliate' => $data['p_affiliate'],
                //'images' => $thumbnails,
                'tag_id' => $data['p_tag_id'],
                'date' => $this->main_model->dateTime('current'),
                'file_id' => 0,
                'u_id' => $userId,
                'state' => 0,
                'kind' => 1
            ));
            //Insert Gig Updates
                //Get Inserted
                $i = 1;$gUp = 0;
                while($i <= 5){
                    if($this->input->post('guTitle'.$i) !== '' && $this->input->post('guPrice'.$i) !== '' && $this->input->post('guDuration'.$i) !== ''){
                        $data['gigUpdates']['guTitle'][] = $this->input->post('guTitle'.$i);
                        $data['gigUpdates']['guPrice'][] = $this->input->post('guPrice'.$i);
                        $data['gigUpdates']['guDuration'][] = $this->input->post('guDuration'.$i);
                        $gUp = 1;
                    }
                $i++;}
                if($gUp == 1){
                    $gus = $this->main_model->getByData('gigupdates','i_id',$data['item'][0]->id);
                    $guId = $gus[0]->id;
                /*Insert GigUpdate*/
                $insertGigUpdate = $this->main_model->update('gigupdates','id',$guId,array(
                    'content' => implode(", ",$data['gigUpdates']['guTitle']),
                    'amount' => implode(", ",$data['gigUpdates']['guPrice']),
                    'days' => implode(", ",$data['gigUpdates']['guDuration']),
                    'date' => $this->main_model->dateTime('current')
                ));
            }

            $data = array();$data['userviewed'] = $this->viewed;
            $data['p_id'] = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getByData('items','id',$data['p_id']);
            $data['item_subtag'] = $this->main_model->getFullRequest('categories','id = '.$data['item'][0]->tag_id);
            $data['item_gus'] = $this->main_model->getFullRequest('gigupdates','i_id = '.$data['item'][0]->id);
                $data['item_mtag'] = $this->main_model->getAllDataCond('categories','state',0,'id',$data['item_subtag'][0]->c_id);
                $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                    foreach($data['mtags'] as $mtag){
                        $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                        $msubtag[$mtag->id] = $data['subtags'];
                    }
                $data['msubtag'] = $msubtag;
            $data['state'] = 1;
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة خدمة | موقع استشارة';
            $this->load->view('userarea/gigForm_view',$data);
        }
            
            
        }else{
            $data['p_id'] = (int) strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getByData('items','id',$data['p_id']);
            $data['item_subtag'] = $this->main_model->getFullRequest('categories','id = '.$data['item'][0]->tag_id);
            $data['item_gus'] = $this->main_model->getFullRequest('gigupdates','i_id = '.$data['item'][0]->id);
                $data['item_mtag'] = $this->main_model->getAllDataCond('categories','state',0,'id',$data['item_subtag'][0]->c_id);
                $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                    foreach($data['mtags'] as $mtag){
                        $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                        $msubtag[$mtag->id] = $data['subtags'];
                    }
                $data['msubtag'] = $msubtag;
            $data['userviewed'] = $this->viewed;
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_ytlink'] = $this->input->post('ytlink');
            $data['p_price'] = $this->input->post('price');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            $this->load->view('userarea/gigForm_view',$data);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    function insertGig(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة خدمة | موقع استشارة';
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
                $this->load->view('userarea/gigForm_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function insertGigCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة خدمة | موقع استشارة';
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.'
                );
            $subCat = $this->main_model->getByData('categories','state',1);
            $catsnum = count($subCat)-1;
            $z = 0;
            $catlist = '';
            while($z <= $catsnum){
                $catlist .= $subCat[$z]->id;
                if($z !== $catsnum){
                    $catlist .= ',';
                }
                $z++;
            }
            $this->form_validation->set_rules('title','عنوان الخدمة','required|min_length[10]|alpha_numeric_spaces',$rul);
            $this->form_validation->set_rules('content','وصف الخدمة','required|min_length[100]',$rul);
            $this->form_validation->set_rules('ytlink','رابط الفيديو','valid_url',$rul);
            $this->form_validation->set_rules('price','سعر الخدمة','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('duration','مدة التنفيذ','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('tags','الكلمات المفتاحية','required',$rul);
            $this->form_validation->set_rules('subtag','تصنيف فرعي','required|in_list['.$catlist.']',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_ytlink'] = $this->input->post('ytlink');
            $data['p_price'] = $this->input->post('price');
            $data['p_duration'] = $this->input->post('duration');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('subtag');
            // Accepted Validation
                //Upload Images Settings
            
            // load library only once
                $this->load->library('upload');
            
                $config['upload_path']          = './vendor/uploads/images/';
                $config['allowed_types']        = 'jpeg|jpg|png';
                $config['max_size']             = 5000;
                $config['max_width']            = 5000;
                $config['max_height']           = 5000;
                $config['encrypt_name']           = TRUE;

                $this->upload->initialize($config);
// Loop For 4 Images
            $imgCou = 1;$imgnums = array();
            while($imgCou <= 4){
                if($this->input->post('img_input'.$imgCou)){
                    $imgnums[] = $this->input->post('img_input'.$imgCou);
                }
            $imgCou++;}
            define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
            define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
            if($imgnums){
            foreach($imgnums as $imgnum){
                if ( ! $this->upload->do_upload('img'.$imgnum))
                {
                        $data['error'] = $this->upload->display_errors();
                    //If Statement For Changing Lang
                        if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                            $data['error']='امتداد الملف غير مسموح.';
                        }
                    // Upload Errors
                        $this->load->view('userarea/gigForm_view', $data);
                    break;
                }
                else
                {
                    // Image
                        $data['img'.$imgnum] = array('upload_data' => $this->upload->data());
                    /// resize Image
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $data['img'.$imgnum]['upload_data']['full_path'];
                        $config['create_thumb'] = TRUE;
                        $config['maintain_ratio'] = TRUE;
                        $config['width']         = 800;
                        $config['height']       = 400;
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                        if($imgnum == $imgnums[count($imgnums)-1]){
                             $this->image_lib->clear();
                        /// resize Image for thumb
                            $config_thumb['image_library'] = 'gd2';
                            $config_thumb['source_image'] = $data['img'.$imgnum]['upload_data']['full_path'];
                            $config_thumb['create_thumb'] = TRUE;
                            $config_thumb['maintain_ratio'] = TRUE;
                            $config_thumb['width']         = 270;
                            $config_thumb['height']       = 160;
                            $config_thumb['new_image'] = $data['img'.$imgnum]['upload_data']['file_path'] . "vthumb_" . $data['img'.$imgnum]['upload_data']['file_name'];
                            $this->image_lib->initialize($config_thumb);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                        }
                        $myFile = PUBPATH.'vendor/uploads/images/'.$data['img'.$imgnum]['upload_data']['file_name'];
                        unlink($myFile) or die("يوجد خطأ ما");
                        $userNewFile1 = explode('.',$data['img'.$imgnum]['upload_data']['file_name']);
                        $images[$imgnum] = $userNewFile1[0].'_thumb.'.$userNewFile1[1];
                    if($imgnum == end($imgnums)){
                        
                if(!empty($this->input->post('affiliate'))){
                    $data['p_affiliate'] = 1;
                }else{
                    $data['p_affiliate'] = 0;
                }
                $data['thumbnails'] = $images;
                if(isset($data['thumbnails'][0])){
                    $thumbnails = $data['thumbnails'][0];
                }elseif(isset($data['thumbnails'][1])){
                    $thumbnails = $data['thumbnails'][1];
                }elseif(isset($data['thumbnails'][2])){
                    $thumbnails = $data['thumbnails'][2];
                }elseif(isset($data['thumbnails'][3])){
                    $thumbnails = $data['thumbnails'][3];
                }elseif(isset($data['thumbnails'][4])){
                    $thumbnails = $data['thumbnails'][4];
                }
                foreach($imgnums as $imgnum){
                    if($imgnum > 1){
                        $thumbnails .= ','.$data['thumbnails'][$imgnum];
                    }
                }
                $thumbnails = implode(',',array_unique(explode(',',$thumbnails)));
                /*Insert Product*/
                $insertProduct = $this->main_model->insertData('items',array(
                    'title' => $data['p_title'],
                    'content' => $data['p_content'],
                    'ytlink' => $data['p_ytlink'],
                    'price' => $data['p_price'],
                    'duration' => $data['p_duration'],
                    'tags' => $data['p_tags'],
                    'affiliate' => $data['p_affiliate'],
                    'images' => $thumbnails,
                    'tag_id' => $data['p_tag_id'],
                    'date' => $this->main_model->dateTime('current'),
                    'file_id' => 0,
                    'u_id' => $userId,
                    'state' => 0,
                    'kind' => 1
                ));
                //Insert Gig Updates
                    //Get Inserted
                    $i = 1;$gUp = 0;
                    while($i <= 5){
                        if($this->input->post('guTitle'.$i) !== '' && $this->input->post('guPrice'.$i) !== '' && $this->input->post('guDuration'.$i) !== ''){
                            $data['gigUpdates']['guTitle'][] = $this->input->post('guTitle'.$i);
                            $data['gigUpdates']['guPrice'][] = $this->input->post('guPrice'.$i);
                            $data['gigUpdates']['guDuration'][] = $this->input->post('guDuration'.$i);
                            $gUp = 1;
                        }
                    $i++;}
                    if($gUp == 1){
                    /*Insert GigUpdate*/
                    $insertGigUpdate = $this->main_model->insertData('gigupdates',array(
                        'content' => implode(", ",$data['gigUpdates']['guTitle']),
                        'amount' => implode(", ",$data['gigUpdates']['guPrice']),
                        'days' => implode(", ",$data['gigUpdates']['guDuration']),
                        'i_id' => $insertProduct,
                        'date' => $this->main_model->dateTime('current')
                    ));
                }
                $data = array();$data['userviewed'] = $this->viewed;
                $data['state'] = 1;
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة خدمة | موقع استشارة';
                $this->load->view('userarea/gigForm_view',$data);
                
                    }
                    
                }
            }
        }else{
            $data['userviewed'] = $this->viewed;
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_ytlink'] = $this->input->post('ytlink');
            $data['p_price'] = $this->input->post('price');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            $data['error'] = 'برجاء اضافة صورة واجدة على الأقل.';
            $this->load->view('userarea/gigForm_view',$data);
        }
        }else{
            $data['userviewed'] = $this->viewed;
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_ytlink'] = $this->input->post('ytlink');
            $data['p_price'] = $this->input->post('price');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            $this->load->view('userarea/gigForm_view',$data);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    function insertProject(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مشروع | موقع استشارة';
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
                $this->load->view('userarea/projectForm_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function editProjectCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مشروع | موقع استشارة';
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.',
                'greater_than_equal_to' => 'برجاء إدخال %s بطريقة صحيحة.'
                );
            $subCat = $this->main_model->getByData('categories','state',1);
            $catsnum = count($subCat)-1;
            $z = 0;
            $catlist = '';
            while($z <= $catsnum){
                $catlist .= $subCat[$z]->id;
                if($z !== $catsnum){
                    $catlist .= ',';
                }
                $z++;
            }
            $this->form_validation->set_rules('title','عنوان مشروع','required|min_length[10]|alpha_numeric_spaces',$rul);
            $this->form_validation->set_rules('content','وصف مشروع','required|min_length[100]',$rul);
            $this->form_validation->set_rules('price','الميزانية','required',$rul);
            $this->form_validation->set_rules('duration','مدة التنفيذ','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('tags','الكلمات المفتاحية','required',$rul);
            $this->form_validation->set_rules('subtag','تصنيف فرعي','required|in_list['.$catlist.']',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_id'] = (int) strip_tags($this->uri->segment(3));
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_price'] = $this->input->post('price');
            $data['p_skills'] = implode(',',$this->input->post('skills'));
            $data['p_duration'] = $this->input->post('duration');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('subtag');
            
            $data['item'] = $this->main_model->getByData('items','id',$data['p_id']);
            if(!$data['item']){
                redirect(base_url('404/'));
            }elseif($data['item'][0]->u_id !== $userId || $data['item'][0]->kind !== '2'){
                redirect(base_url('404/'));
            }
            define('EXT', '.'.pathinfo(__FILE__, PATHINFO_EXTENSION));
            define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
            //Upload File Settings
            // load library only once
                $this->load->library('upload');
                $config2['upload_path']          = './vendor/uploads/';
                $config2['allowed_types']        = 'rar|zip|pdf|png|jpg';
                $config2['max_size']             = 100000;
                $config2['encrypt_name']           = TRUE;

                $this->upload->initialize($config2);
                        
            if ( ! $this->upload->do_upload('file'))
            {
                $data['error'] = $this->upload->display_errors();
                    //If Statement For Changing Lang
                        if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                            $data['error']='امتداد الملف غير مسموح.';
                            $this->load->view('userarea/projectForm_view', $data);
                        }elseif($data['error'] == '<p>The file you are attempting to upload is larger than the permitted size.</p>'){
                            $data['error']='الحد الأقصى لحجم الملف هو 100MB.';
                            $this->load->view('userarea/projectForm_view', $data);
                        }elseif($data['error'] == '<p>You did not select a file to upload.</p>'){
                            $Puser_id = (int) strip_tags($this->uri->segment(3));
                            if($Puser_id == 0){
                                $Puser_id = '';
                            }
                            $proArr = array(
                                'title' => $data['p_title'],
                                'content' => $data['p_content'],
                                'ytlink' => 'NONE',
                                'price' => $data['p_price'],
                                'skills' => $data['p_skills'],
                                'duration' => $data['p_duration'],
                                'tags' => $data['p_tags'],
                                'affiliate' => 0,
                                'images' => 'NONE',
                                'tag_id' => $data['p_tag_id'],
                                'date' => $this->main_model->dateTime('current'),
                                'u_id' => $userId,
                                'state' => 0,
                                'kind' => 2
                            );
                            if($Puser_id){
                                $proArr['for_user'] = $Puser_id;
                            }
                            /*Insert Product*/
                            $insertProduct = $this->main_model->update('items','id',$data['item'][0]->id,$proArr);
                            if($Puser_id){
                            $project = $this->main_model->getByData('items','id',$insertProduct)[0];
                            }
                            $data = array();$data['userviewed'] = $this->viewed;
                            $data['state'] = 1;
                            $data['p_id'] = (int) strip_tags($this->uri->segment(3));
                            $data['item'] = $this->main_model->getByData('items','id',$data['p_id']);
                            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مشروع | موقع استشارة';
                            $this->load->view('userarea/projectForm_view',$data);
                        }
                
            }else{    
                $data['file'] = array('upload_data' => $this->upload->data());
                /*Insert Product*/
                $insertProduct = $this->main_model->update('items','id',$data['item'][0]->id,array(
                    'title' => $data['p_title'],
                    'content' => $data['p_content'],
                    'ytlink' => 'NONE',
                    'price' => $data['p_price'],
                    'skills' => $data['p_skills'],
                    'duration' => $data['p_duration'],
                    'tags' => $data['p_tags'],
                    'affiliate' => 0,
                    'images' => 'NONE',
                    'tag_id' => $data['p_tag_id'],
                    'date' => $this->main_model->dateTime('current'),
                    'file_id' => $data['file']['upload_data']['file_name'],
                    'u_id' => $userId,
                    'state' => 0,
                    'kind' => 2
                ));
                if($data['item'][0]->file_id !== 'NONE'){
                    $myFile = PUBPATH.'vendor/uploads/'.$data['item'][0]->file_id;
                    unlink($myFile) or die("يوجد خطأ ما");
                }
                $data = array();$data['userviewed'] = $this->viewed;
                $data['state'] = 1;
                $data['p_id'] = (int) strip_tags($this->uri->segment(3));
                $data['item'] = $this->main_model->getByData('items','id',$data['p_id']);
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مشروع | موقع استشارة';
                $this->load->view('userarea/projectForm_view',$data);
        }
            
            
        }else{
            $data['userviewed'] = $this->viewed;
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_duration'] = $this->input->post('duration');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            $this->load->view('userarea/projectForm_view',$data);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    function insertProjectCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مشروع | موقع استشارة';
            $data['mtags'] = $this->main_model->getAllDataCond('categories','state',0,'c_id',NULL);
                foreach($data['mtags'] as $mtag){
                    $data['subtags'] = $this->main_model->getFullRequest('categories','c_id = '.$mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.',
                'greater_than_equal_to' => 'برجاء إدخال %s بطريقة صحيحة.'
                );
            $subCat = $this->main_model->getByData('categories','state',1);
            $catsnum = count($subCat)-1;
            $z = 0;
            $catlist = '';
            while($z <= $catsnum){
                $catlist .= $subCat[$z]->id;
                if($z !== $catsnum){
                    $catlist .= ',';
                }
                $z++;
            }
            $this->form_validation->set_rules('title','عنوان مشروع','required|min_length[10]|alpha_numeric_spaces',$rul);
            $this->form_validation->set_rules('content','وصف مشروع','required|min_length[100]',$rul);
            $this->form_validation->set_rules('price','الميزانية','required',$rul);
            $this->form_validation->set_rules('duration','مدة التنفيذ','required|is_natural_no_zero',$rul);
            $this->form_validation->set_rules('tags','الكلمات المفتاحية','required',$rul);
            $this->form_validation->set_rules('subtag','تصنيف فرعي','required|in_list['.$catlist.']',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_price'] = $this->input->post('price');
            if(!empty($this->input->post('skills'))){
                $data['p_skills'] = implode(',',$this->input->post('skills'));
            }else{
                $data['p_skills'] = '';
            }
            $data['p_duration'] = $this->input->post('duration');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('subtag');
            
            //Upload File Settings
            // load library only once
                $this->load->library('upload');
                $config2['upload_path']          = './vendor/uploads/';
                $config2['allowed_types']        = 'rar|zip|pdf|png|jpg';
                $config2['max_size']             = 100000;
                $config2['encrypt_name']           = TRUE;

                $this->upload->initialize($config2);
                        
            if ( ! $this->upload->do_upload('file'))
            {
                $data['error'] = $this->upload->display_errors();
                    //If Statement For Changing Lang
                        if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                            $data['error']='امتداد الملف غير مسموح.';
                            $this->load->view('userarea/projectForm_view', $data);
                        }elseif($data['error'] == '<p>The file you are attempting to upload is larger than the permitted size.</p>'){
                            $data['error']='الحد الأقصى لحجم الملف هو 100MB.';
                            $this->load->view('userarea/projectForm_view', $data);
                        }elseif($data['error'] == '<p>You did not select a file to upload.</p>'){
                            $Puser_id = (int) strip_tags($this->uri->segment(3));
                            if($Puser_id == 0){
                                $Puser_id = '';
                            }
                            $proArr = array(
                                'title' => $data['p_title'],
                                'content' => $data['p_content'],
                                'ytlink' => 'NONE',
                                'price' => $data['p_price'],
                                'skills' => $data['p_skills'],
                                'duration' => $data['p_duration'],
                                'tags' => $data['p_tags'],
                                'affiliate' => 0,
                                'images' => 'NONE',
                                'tag_id' => $data['p_tag_id'],
                                'date' => $this->main_model->dateTime('current'),
                                'file_id' => 'NONE',
                                'u_id' => $userId,
                                'state' => 0,
                                'kind' => 2
                            );
                            if($Puser_id){
                                $proArr['for_user'] = $Puser_id;
                            }
                            /*Insert Product*/
                            $insertProduct = $this->main_model->insertData('items',$proArr);
                            
                            $data = array();$data['userviewed'] = $this->viewed;
                            $data['state'] = 1;
                            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مشروع | موقع استشارة';
                            $this->load->view('userarea/projectForm_view',$data);
                        }
                
            }else{    
                $data['file'] = array('upload_data' => $this->upload->data());
                $proArr = array(
                    'title' => $data['p_title'],
                    'content' => $data['p_content'],
                    'ytlink' => 'NONE',
                    'price' => $data['p_price'],
                    'skills' => $data['p_skills'],
                    'duration' => $data['p_duration'],
                    'tags' => $data['p_tags'],
                    'affiliate' => 0,
                    'images' => 'NONE',
                    'tag_id' => $data['p_tag_id'],
                    'date' => $this->main_model->dateTime('current'),
                    'file_id' => $data['file']['upload_data']['file_name'],
                    'u_id' => $userId,
                    'state' => 0,
                    'kind' => 2
                );
                if($Puser_id){
                    $proArr['for_user'] = $Puser_id;
                }
                /*Insert Product*/
                $insertProduct = $this->main_model->insertData('items',$proArr);

                $data = array();$data['userviewed'] = $this->viewed;
                $data['state'] = 1;
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مشروع | موقع استشارة';
                $this->load->view('userarea/projectForm_view',$data);
        }
            
            
        }else{
            $data['userviewed'] = $this->viewed;
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_duration'] = $this->input->post('duration');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            $this->load->view('userarea/projectForm_view',$data);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    
    function insertPost(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة تدوينة | موقع استشارة';
                $this->load->view('userarea/postForm_view',$data);
        }else{
            redirect(base_url().'404/');
        }
    }
    function insertPostCheck(){
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة تدوينة | موقع استشارة';
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.',
                'greater_than_equal_to' => 'برجاء إدخال %s بطريقة صحيحة.'
                );
            $subCat = $this->main_model->getByData('categories','state',1);
            $catsnum = count($subCat)-1;
            $z = 0;
            $catlist = '';
            while($z <= $catsnum){
                $catlist .= $subCat[$z]->id;
                if($z !== $catsnum){
                    $catlist .= ',';
                }
                $z++;
            }
            $this->form_validation->set_rules('title','عنوان مشروع','required|min_length[10]|alpha_numeric_spaces',$rul);
            $this->form_validation->set_rules('tags','الكلمات المفتاحية','required',$rul);
            $this->form_validation->set_rules('category','تصنيف','required|in_list['.$catlist.']',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
            $data['p_title'] = $this->input->post('title');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            
            //Upload File Settings
            // load library only once
                $this->load->library('upload');
                $config2['upload_path']          = './vendor/uploads/';
                $config2['allowed_types']        = 'rar|zip|docx';
                $config2['max_size']             = 100000;
                $config2['encrypt_name']           = TRUE;

                $this->upload->initialize($config2);
                        
            if ( ! $this->upload->do_upload('file'))
            {
                $data['error'] = $this->upload->display_errors();
                    //If Statement For Changing Lang
                        if($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>'){
                            $data['error']='امتداد الملف غير مسموح.';
                        }elseif($data['error'] == '<p>The file you are attempting to upload is larger than the permitted size.</p>'){
                            $data['error']='الحد الأقصى لحجم الملف هو 100MB.';
                        }
                        $this->load->view('userarea/postForm_view', $data);
                
            }else{    
                $data['file'] = array('upload_data' => $this->upload->data());
                /*Insert Product*/
                $insertProduct = $this->main_model->insertData('items',array(
                    'title' => $data['p_title'],
                    'content' => 'NONE',
                    'ytlink' => 'NONE',
                    'price' => 'NONE',
                    'duration' => 'NONE',
                    'tags' => $data['p_tags'],
                    'affiliate' => 0,
                    'images' => 'NONE',
                    'tag_id' => $data['p_tag_id'],
                    'date' => $this->main_model->dateTime('current'),
                    'file_id' => $data['file']['upload_data']['file_name'],
                    'u_id' => $userId,
                    'state' => 0,
                    'kind' => 3
                ));
                
                $data = array();$data['userviewed'] = $this->viewed;
                $data['state'] = 1;
                $data['title']='لوحة التحكم في حسابك في موقع استشارة - إضافة مشروع | موقع استشارة';
                $this->load->view('userarea/postForm_view',$data);
        }
            
            
        }else{
            $data['userviewed'] = $this->viewed;
            $data['p_title'] = $this->input->post('title');
            $data['p_content'] = $this->input->post('content');
            $data['p_from'] = $this->input->post('from');
            $data['p_to'] = $this->input->post('to');
            $data['p_duration'] = $this->input->post('duration');
            $data['p_tags'] = $this->input->post('tags');
            $data['p_tag_id'] = $this->input->post('category');
            $this->load->view('userarea/postForm_view',$data);
            }
        }else{
            redirect(base_url().'404/');
        }
    }
    function projects(){
        $data['title']='مشاريع | موقع استشارة';
        $filter = strip_tags($this->uri->segment(4));
        $data['userviewed'] = $this->viewed;
        $config = array();
        if($filter == ''){
            $config["base_url"] = base_url() . "users/projects/".$this->uri->segment(3);
        }elseif($filter == 'done' OR $filter == 'wait' OR $filter == 'bids'){
            $config["base_url"] = base_url() . "users/projects/".$this->uri->segment(3).'/'.$filter.'/';
            if($filter == 'done'){
                $secondFilter = strip_tags($this->uri->segment(5));
                if($secondFilter == 'mine'){
                    $dones = $this->main_model->getFullRequest('promsg','(s_id = '.$data['userviewed'][0]->id.') AND (caseMsg = \'ended\')');
                    $waits = $this->main_model->getFullRequest('items','((u_id = '.$data['userviewed'][0]->id.') AND (state = 3) AND (kind = 2) AND (bid_id IS NOT NULL))');
                }elseif($secondFilter == 'work'){
                    $dones = $this->main_model->getFullRequest('promsg','(u_id = '.$data['userviewed'][0]->id.') AND (caseMsg = \'ended\')');
                    $waits = $this->main_model->getFullRequest('items','((for_user = '.$data['userviewed'][0]->id.') AND (state = 3) AND (kind = 2) AND (bid_id IS NOT NULL))');
                }else{
                    $dones = $this->main_model->getFullRequest('promsg','((s_id = '.$data['userviewed'][0]->id.') OR (u_id = '.$data['userviewed'][0]->id.')) AND (caseMsg = \'ended\')');
                    $waits = $this->main_model->getFullRequest('items','(((u_id = '.$data['userviewed'][0]->id.') OR (for_user = '.$data['userviewed'][0]->id.')) AND (state = 3) AND (kind = 2) AND (bid_id IS NOT NULL))');
                }
                
                $ids1 = array();
                $ids2 = array();
                if($waits){
                    foreach($waits as $wait){
                        $ids2[] = $wait->id;
                    }
                }else{
                    $ids2 = array();
                }
                if($dones){
                    foreach($dones as $done){
                        $ids1[] = $done->i_id;
                    }
                }else{
                    $ids1 = array();
                }
                $ids = array_unique(array_merge($ids1,$ids2));
            }elseif($filter == 'wait'){
                $secondFilter = strip_tags($this->uri->segment(5));
                if($secondFilter == 'mine'){
                    $waits = $this->main_model->getFullRequest('items','((u_id = '.$data['userviewed'][0]->id.') AND (state = 2) AND (kind = 2) AND (bid_id IS NOT NULL))');
                    $bids = false;
                }elseif($secondFilter == 'work'){
                    $waits = $this->main_model->getFullRequest('items','((u_id = '.$data['userviewed'][0]->id.') AND (state = 2) AND (kind = 2) AND (bid_id IS NOT NULL))');
                    $bids = $this->main_model->getFullRequest('bids','(u_id = '.$data['userviewed'][0]->id.')');
                }else{
                    $waits = $this->main_model->getFullRequest('items','(((u_id = '.$data['userviewed'][0]->id.') OR (for_user = '.$data['userviewed'][0]->id.')) AND (state = 2) AND (kind = 2) AND (bid_id IS NOT NULL))');
                    $bids = $this->main_model->getFullRequest('bids','(u_id = '.$data['userviewed'][0]->id.')');
                }
                $ids = array();
                $ids1 = array();
                $ids2 = array();
                if($bids){
                    foreach($bids as $bid){
                        $itemsUN = $this->main_model->getByData('items','id',$bid->i_id)[0];
                        if($itemsUN->state == 2){
                            $ids1[] = $itemsUN->id;
                        }
                    }
                }else{
                    $ids1 = array();
                }
                if($waits){
                    foreach($waits as $wait){
                        $ids2[] = $wait->id;
                    }
                }else{
                    $ids2 = array();
                }
                $ids = array_unique(array_merge($ids1,$ids2));
            }elseif($filter == 'bids'){
                $bids = $this->main_model->getFullRequest('bids','(u_id = '.$data['userviewed'][0]->id.')');
                $ids = array();
                $ids1 = array();
                $ids2 = array();
                if($bids){
                    foreach($bids as $bid){
                        $itemsUN = $this->main_model->getByData('items','id',$bid->i_id)[0];
                            $ids1[] = $itemsUN->id;
                    }
                }else{
                    $ids1 = array();
                }
                $ids = array_unique(array_merge($ids1,$ids2));
            }else{
                $ids1 = array();
                $ids2 = array();
                $ids = array_unique(array_merge($ids1,$ids2));
            }
        }else{
            $config["base_url"] = base_url() . "users/projects/".$this->uri->segment(3);
        }
        

        $config["total_rows"] = $this->main_model->record_count();

        $config["per_page"] = 20;

        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);
        if($filter == 'done' OR $filter == 'wait' OR $filter == 'bids'){
            $page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            if(!isset($ids)){
                $ids = array(0);
            }
            $array = implode("','",$ids);
            $data['records'] = $this->main_model->getFullRequest('items','((kind = 2) AND (id IN (\''.$array.'\')))','',$config["per_page"],$page);
        }else{
            $stateTerm = '';
            if($filter == 'refused'){
                $stateTerm = ' AND (state = 10)';
            }elseif($filter == 'active'){
                $stateTerm = ' AND (state = 1)';
            }elseif($filter == 'waiting'){
                $stateTerm = ' AND (state = 0)';
            }
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
            $data['records'] = $this->main_model->getFullRequest('items','((kind = 2) AND ((u_id = '.$data['userviewed'][0]->id.') OR (for_user = '.$data['userviewed'][0]->id.')))'.$stateTerm.' order by id desc','',$config["per_page"],$page);
        }
        $data["links"] = $this->pagination->create_links();
        $viewed = $this->main_model->is_logged_in($this->uri->segment(3));
        if(!$viewed){
            redirect(base_url().'404/');
        }
        $this->load->view('userarea/projects_view',$data);
    }
    function products(){
        $data['title']='المنتجات | موقع استشارة';
        $config = array();

        $config["base_url"] = base_url() . "users/products/".$this->uri->segment(3);

        $config["total_rows"] = $this->main_model->record_count();

        $config["per_page"] = 20;

        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['userviewed'] = $this->viewed;
        $data['records'] = $this->main_model->getAllDataAdv('items','id','DESC','kind',0,$config["per_page"],$page,'u_id',$data['userviewed'][0]->id);
        $viewed = $this->main_model->is_logged_in($this->uri->segment(3));
        if(!$viewed){
            redirect(base_url().'404/');
        }
        $this->load->view('userarea/products_view',$data);
    }
    function gigs(){
        $data['title']='الخدمات | موقع استشارة';
        $filter = strip_tags($this->uri->segment(4));
        $data['userviewed'] = $this->viewed;
        if($filter == 'done'){
            $secondFilter = strip_tags($this->uri->segment(5));
            if($secondFilter == 'mine'){
                $dones = $this->main_model->getFullRequest('requestedgigs','(s_id = '.$data['userviewed'][0]->id.')');
            }elseif($secondFilter == 'bought'){
                $dones = $this->main_model->getFullRequest('requestedgigs','(u_id = '.$data['userviewed'][0]->id.')');
            }else{
                $dones = $this->main_model->getFullRequest('requestedgigs','(u_id = '.$data['userviewed'][0]->id.') OR (s_id = '.$data['userviewed'][0]->id.')');
            }
            
            if($dones){
                foreach($dones as $done){
                    $ids[] = $done->i_id;
                }
            }else{
                $ids = array();
            }
            $array = implode("','",array_unique($ids));
        }
        $config = array();

        $config["base_url"] = base_url() . "users/gigs/".$this->uri->segment(3);

        $config["total_rows"] = $this->main_model->record_count();

        $config["per_page"] = 20;

        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['userviewed'] = $this->viewed;
        if($this->main_model->is_logged_in()){
            // Access User Data Securly
            $userData = (array) $this->main_model->is_logged_in(1)[0];
            $userId = $userData['id'];
            if($filter == 'done' && $data['userviewed'][0]->username == $userData['username']){
                $data['records'] = $this->main_model->getFullRequest('items','((kind = 1) AND (id IN (\''.$array.'\')))','',$config["per_page"],$page);
            }elseif($filter == 'accepted' && $data['userviewed'][0]->username == $userData['username']){
                $data['records'] = $this->main_model->getFullRequest('items','((kind = 1) AND (state = 1) AND (u_id = '.$data['userviewed'][0]->id.'))','',$config["per_page"],$page);
            }elseif($filter == 'notAccepted' && $data['userviewed'][0]->username == $userData['username']){
                $data['records'] = $this->main_model->getFullRequest('items','((kind = 1) AND ((state = 0) OR (state = 10)) AND (u_id = '.$data['userviewed'][0]->id.'))','',$config["per_page"],$page);
            }else{
                $data['records'] = $this->main_model->getFullRequest('items','((kind = 1) AND (u_id = '.$data['userviewed'][0]->id.'))','',$config["per_page"],$page);
            }
        }else{
            $data['records'] = $this->main_model->getFullRequest('items','((kind = 1) AND (state = 1) AND (u_id = '.$data['userviewed'][0]->id.'))','',$config["per_page"],$page);
        }
        $viewed = $this->main_model->is_logged_in($this->uri->segment(3));
        if(!$viewed){
            redirect(base_url().'404/');
        }
        $this->load->view('userarea/gigs_view',$data);
    }
    function portfolio(){
        $data['title']='معرض أعمال | موقع استشارة';
        $config = array();

        $config["base_url"] = base_url() . "users/portfolio/".$this->uri->segment(3);

        $config["total_rows"] = $this->main_model->record_count();

        $config["per_page"] = 20;

        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['userviewed'] = $this->viewed;
        $data['title']='معرض أعمال '.$data['userviewed'][0]->firstname.' '.$data['userviewed'][0]->lastname.' | موقع استشارة';
        $data['records'] = $this->main_model->getAllDataAdv('portfolio','id','DESC','kind',1,$config["per_page"],$page,'u_id',$data['userviewed'][0]->id);
        $viewed = $this->main_model->is_logged_in($this->uri->segment(3));
        if(!$viewed){
            redirect(base_url().'404/');
        }
        $this->load->view('userarea/portfolio_view',$data);
    }
    function p(){
        $id = (int) strip_tags($this->uri->segment(4));
        $data['item'] = $this->main_model->getByData('portfolio','id',$id)[0];
        if(!$data['item']){
            redirect(base_url().'404/');
        }
        $data['byUser'] = $this->main_model->getByData('users','id',$data['item']->u_id)[0];
        $data['title'] = 'منصة استشارة - '.$data['item']->title;
        $this->load->view('pItem_view',$data);
    }
    function withdraw(){
        if($this->main_model->is_logged_in()){
            $data['title']='لوحة التحكم في حسابك في موقع استشارة - سحب رصيد | موقع استشارة';
            // Access User Data Securly
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $userId = $userData['id'];
                $minimum = 50;
            /*Form Validation*/
            $rul=array(
                'required'      => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.',
                'greater_than_equal_to' => 'برجاء إدخال %s بطريقة صحيحة.',
                'less_than_equal_to'=> 'رصيدك أقل من المبلغ المطلوب سحبه'
                );
                //Calculate Price
            $totalAmount = (int) strip_tags($this->input->post('amount'));
            $aviBa = (int) $userData['a_balance'];
            $this->form_validation->set_rules('amount','عنوان مشروع','required|numeric|less_than_equal_to['.$aviBa.']',$rul);
            $this->form_validation->set_rules('email','الكلمات المفتاحية','required',$rul);
            // Check if validation true
        if($this->form_validation->run() == true){
                $newABalance = $userData['a_balance']-$totalAmount;
                    if($newABalance < 0){
                        $this->session->set_flashdata('error','رصيدك لا يغطي المبلغ المطلوب سحبه');
                        redirect(base_url().'users/payments/');
                    }else{
                        $this->main_model->update('users','id',$userId,array(
                            'a_balance'=>$newABalance,
                            'c_balance'=>$userData['c_balance']+$totalAmount
                        ));
                        $request = array(
                            'amount' => $totalAmount,
                            'email' => strip_tags($this->input->post('email')),
                            'u_id' => $userId,
                            'state' => 0,
                            'date' => $this->main_model->dateTime('current'),
                        );
                        $this->main_model->insertData('requestedbalance',$request);
                        $this->session->set_flashdata('done','تم ارسال طلب استلام ارباح');
                        redirect(base_url().'users/payments/');
                    }
        }else{
            $this->session->set_flashdata('error','يوجد خطأ ما برجاء المحاولة لاحقاً ... تذكر أن الحد الأدنى للسحب هو '.$minimum.'$');
            redirect(base_url().'users/payments/');
        }
        }else{
            redirect(base_url().'404/');
        }
    }
    
}
?>