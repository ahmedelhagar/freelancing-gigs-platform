<?php

class Istsharhcadmin extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        // Load facebook library
        $this->load->library('facebook');
        $this->load->model('main_model');
        $this->load->library("pagination");
    }
    public function notfound()
    {
        $this->load->view('notfound');
    }
    public function index()
    {
        if (!$this->main_model->is_admin_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'istsharhcadmin/login');
        }
        // URL :- http://localhost/ci_main/
        $data['title'] = 'استشارة | الصفحة الرئيسية';
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/home_view', $data);
        $this->load->view('admin/include/footer', $data);
    }
    public function blocks()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('blocks');
            $uId = $this->session->userdata('id');
            $data['pages'] = $this->main_model->getFullRequest('site_blocks', ' (state = 1) ORDER BY `id` DESC');
            $data['title'] = 'الصفحات | موقع استشارة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/homeBlocks_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function acceptEbid()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('items');
            $editbid_id = (int) strip_tags($this->uri->segment(3));
            $data['editedbid'] = $this->main_model->getFullRequest('editedbid', '(id = ' . $editbid_id . ')')[0];
            if (!$data['editedbid']) {
                redirect(base_url() . '404/');
            }
            $bid_id = $data['editedbid']->bid_id;
            $i_id = $data['editedbid']->i_id;
            $data['item'] = $this->main_model->getFullRequest('items', '(id = ' . $i_id . ')');
            $data['bid'] = $this->main_model->getFullRequest('bids', '(id = ' . $bid_id . ') AND (i_id = ' . $i_id . ')');
            if ($data['editedbid'] && $data['item'] && $data['bid']) {
                if (isset($data['item'][0]->kind) && $data['item'][0]->kind == 2 && $data['item'][0]->state == 2) {
                    $userData = (array) $this->main_model->getByData('users', 'id', $data['item'][0]->u_id)[0];
                    $state = $userData['state'];
                    $id = $userData['id'];
                    if ($state == 0) {
                        redirect(base_url() . '404/');
                    }
                    $aviBa = (int) $userData['balance'] + $userData['a_balance'];
                    $bidAmount = (int) $data['bid'][0]->amount;
                    $editedBidAmount = (int) $data['editedbid']->amount;
                    $msg = 'قبول العرض الجديد';
                    if ($editedBidAmount < $bidAmount) {
                        //Add To Project Owner
                        $minusAmount = $bidAmount - $editedBidAmount;
                    } elseif ($editedBidAmount > $bidAmount) {
                        //Add To User
                        $minusAmount = $editedBidAmount - $bidAmount;
                    } else {
                        $minusAmount = 999999999999999;
                    }
                    if ($aviBa >= $minusAmount) {
                        if ($editedBidAmount < $bidAmount) {
                            //Add To Project Owner
                            $minusAmount = $bidAmount - $editedBidAmount;
                            $newBalance = $userData['balance'] + $minusAmount;
                            $newABalance = $userData['a_balance'];
                            $newCBalance = $userData['c_balance'] - $minusAmount;
                            if ($bidAmount == $minusAmount) {
                                //Stop Project
                                $this->main_model->update('items', 'id', $data['bid'][0]->i_id, array(
                                    'bid_id' => null,
                                    'state' => 10,
                                ));
                                $msg = 'إلغاء المشروع';
                            }
                        } elseif ($editedBidAmount > $bidAmount) {
                            //Add To User
                            $minusAmount = $editedBidAmount - $bidAmount;
                            $newBalance = $userData['balance'] - $minusAmount;
                            $newCBalance = $userData['c_balance'] + $minusAmount;
                            if ($newBalance < 0) {
                                $newABalance = $userData['a_balance'] + $newBalance;
                                $newBalance = 0;
                            } else {
                                $newABalance = $userData['a_balance'];
                            }
                        }
                        $newAllBalance = $userData['all_balance'] - $bidAmount;
                        $this->main_model->update('users', 'id', $id, array(
                            'all_balance' => $newAllBalance,
                            'a_balance' => $newABalance,
                            'c_balance' => $newCBalance,
                            'balance' => $newBalance,
                        ));
                        if ($bidAmount !== $minusAmount) {
                            //Update Bid
                            $this->main_model->update('bids', 'id', $data['editedbid']->bid_id, array(
                                'bid' => $data['editedbid']->bid,
                                'amount' => $data['editedbid']->amount,
                                'days' => $data['editedbid']->days,
                                'date' => $this->main_model->dateTime('current'),
                            ));
                            $this->main_model->deleteData('editedbid', 'id', $data['editedbid']->id);
                        }
                    } else {
                        $this->session->set_flashdata('error', 'يوجد مشكلة ما ... رصيدك غير كافي برجاء شحن حسابك أولاً');
                        redirect(base_url() . 'users/payments');
                    }
                    //Alert
                    $this->main_model->alert('تم قبول طلبك', 'تم قبول طلبك ' . $msg . ' ' . '<a target="_blank" href="' . base_url() . 'i/' . str_replace(' ', '-', $data['item'][0]->title) . '/' . $data['item'][0]->id . '/' . '">' . $data['item'][0]->title . '</a> يمكنك مشاهدة <a href="' . base_url() . 'users/chat/' . $data['item'][0]->u_id . '/' . '">المحادثة</a>', $data['bid'][0]->u_id);
                    $this->session->set_flashdata('done', 'تم ' . $msg . ' بنجاح');
                    redirect(base_url() . 'istsharhcadmin/closeRequests');
                } else {
                    redirect(base_url() . '404/');
                }
            } else {
                redirect(base_url() . '404/');
            }
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function closeRequests()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('items');
            $data['title'] = 'طلبات الالغاء | موقع استشارة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/closeReq_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function insertSkillCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('skills');
            $this->main_model->insertData('skills', array(
                'skill' => strip_tags($this->input->post('skill')),
                'state' => 0,
            ));
            // Set flash data
            $this->session->set_flashdata('done', 'تم اضافة المهارة بنجاح');
            redirect(base_url('istsharhcadmin/skills/'));
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function insertSkill()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('skills');
            $data['title'] = 'الصفحات | موقع استشارة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/skillsForm_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function skills()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $uId = $this->session->userdata('id');
            $data['skills'] = $this->main_model->getFullRequest('skills', ' (state = 0) ORDER BY `id` DESC');
            $this->main_model->creds('skills');
            $data['title'] = 'الدول | موقع استشارة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/skills_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function admins()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $uId = $this->session->userdata('id');
            $data['admins'] = $this->main_model->getFullRequest('admins', ' (state = 1) ORDER BY `id` DESC');
            $this->main_model->creds('admins');
            $data['title'] = 'المشرفيين | موقع استشارة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/admins_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function insertAdminCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('admins');
            $this->main_model->insertData('admins', array(
                'username' => strip_tags($this->input->post('username')),
                'email' => strip_tags($this->input->post('email')),
                'creds' => implode(',', $this->input->post('creds')),
                'password' => $this->encryption->encrypt(strip_tags($this->input->post('password'))),
                'state' => 1,
            ));
            // Set flash data
            $this->session->set_flashdata('done', 'تم اضافة المشرف بنجاح');
            redirect(base_url('istsharhcadmin/admins/'));
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function insertAdmin()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('admins');
            $data['title'] = 'المشرفين | موقع استشارة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/adminsForm_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function insertCountryCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('countries');
            $this->main_model->insertData('countries', array(
                'country' => strip_tags($this->input->post('country')),
                'code' => strip_tags($this->input->post('code')),
            ));
            // Set flash data
            $this->session->set_flashdata('done', 'تم اضافة الدولة بنجاح');
            redirect(base_url('istsharhcadmin/countries/'));
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function insertCountry()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('countries');
            $data['title'] = 'الصفحات | موقع استشارة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/countriesForm_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function countries()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('countries');
            $uId = $this->session->userdata('id');
            $data['countries'] = $this->main_model->getFullRequest('countries', ' (id IS NOT NULL) ORDER BY `id` DESC');

            $data['title'] = 'الدول | موقع استشارة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/countries_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function footerPages()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $uId = $this->session->userdata('id');
            $config = array();
            $config["base_url"] = base_url() . "istsharhcadmin/footerPages/";

            $config["total_rows"] = $this->main_model->getAllData('site_pages', 'count');

            $config["per_page"] = 15;

            $config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["links"] = $this->pagination->create_links();
            if ($page) {
                $limitval = $page . ',' . $config["per_page"];
            } else {
                $limitval = $config["per_page"];
            }

            $data['pages'] = $this->main_model->getFullRequest('site_pages', ' (state = 1) ORDER BY `id` DESC LIMIT ' . $limitval);

            $data["total_rows"] = $config["total_rows"];

            $data['title'] = 'الصفحات | موقع استشارة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/spages_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function userSearch()
    {
        if (!$this->main_model->is_admin_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'istsharhcadmin/login');
        }
        $this->main_model->creds('users');
        $data['title'] = 'البحث عن الأعضاء';
        $data['links'] = '';
        $data['records'] = $this->main_model->search('users', array(), 'username', $this->input->get('search_user'));
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/users_view', $data);
        $this->load->view('admin/include/footer', $data);
    }
    public function allUsers()
    {
        if (!$this->main_model->is_admin_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'istsharhcadmin/login');
        }
        // URL :- http://localhost/ci_main/
        $data['title'] = 'استشارة | الصفحة الرئيسية';
        $config = array();
        $this->main_model->creds('users');
        $config["base_url"] = base_url() . "istsharhcadmin/allUsers/";

        $config["total_rows"] = $this->main_model->record_count('', 'users');

        $config["per_page"] = 20;

        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['records'] = $this->main_model->getAllDataAdv('users', 'id', 'DESC', '', '', $config["per_page"], $page, '', '');
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/users_view', $data);
        $this->load->view('admin/include/footer', $data);
    }
    public function loginAs()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('users');
            $u_id = (int) $this->uri->segment(3);
            $user = (array) $this->main_model->getByData('users', 'id', $u_id)[0];
            $this->session->set_userdata($user);
            redirect(base_url() . 'user/' . $this->session->userdata('username'));
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function addPdesc()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('tuts');
            $data['title'] = 'اضافة شرح';
            $this->load->view('admin/include/header.php', $data);
            $this->load->view('admin/include/userSideBar_view.php', $data);
            $this->load->view('admin/addCommGig_view', $data);
            $this->load->view('admin/include/footer.php', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function addPdescCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('tuts');
            $data['title'] = 'اضافة تعليق';
            ///*Form Validation
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.',
            );
            $this->form_validation->set_rules('title', 'عنوان موضوعك', 'required|min_length[10]', $rul);
            $this->form_validation->set_rules('content', 'وصف موضوعك', 'required|min_length[10]', $rul);
            // Check if validation true
            if ($this->form_validation->run() == true) {
                $data['p_bidTitle'] = strip_tags($this->input->post('title'));
                $data['p_bidContent'] = $this->input->post('content');
                // Accepted Validation
                //*Insert Product
                $insertProduct = $this->main_model->insertData('cdata', array(
                    'title' => $data['p_bidTitle'],
                    'content' => $data['p_bidContent'],
                    'state' => 0,
                    'co_id' => null,
                    'u_id' => 0,
                    'kind' => 2,
                    'date' => $this->main_model->dateTime('current'),
                ));
                $data['title'] = 'لوحة التحكم في حسابك في موقع استشارة - إضافة شرح | موقع استشارة';
                // Set flash data
                $this->session->set_flashdata('done', 'تم اضافة الشرح بنجاح');
                redirect(base_url('pages/desc/' . $insertProduct));
            } else {
                $data['p_bidTitle'] = strip_tags($this->input->post('title'));
                $data['p_bidContent'] = strip_tags($this->input->post('content'));
                $this->load->view('admin/addCommGig_view', $data);
            }
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function addGdesc()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('tuts');
            $data['title'] = 'اضافة شرح';
            $this->load->view('admin/include/header.php', $data);
            $this->load->view('admin/include/userSideBar_view.php', $data);
            $this->load->view('admin/addComm_view', $data);
            $this->load->view('admin/include/footer.php', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function addGdescCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('tuts');
            $data['title'] = 'اضافة تعليق';
            ///*Form Validation
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.',
            );
            $this->form_validation->set_rules('title', 'عنوان موضوعك', 'required|min_length[10]', $rul);
            $this->form_validation->set_rules('content', 'وصف موضوعك', 'required|min_length[10]', $rul);
            // Check if validation true
            if ($this->form_validation->run() == true) {
                $data['p_bidTitle'] = strip_tags($this->input->post('title'));
                $data['p_bidContent'] = $this->input->post('content');
                // Accepted Validation
                //*Insert Product
                $insertProduct = $this->main_model->insertData('cdata', array(
                    'title' => $data['p_bidTitle'],
                    'content' => $data['p_bidContent'],
                    'state' => 0,
                    'co_id' => null,
                    'u_id' => 0,
                    'kind' => 1,
                    'date' => $this->main_model->dateTime('current'),
                ));
                $data['title'] = 'لوحة التحكم في حسابك في موقع استشارة - إضافة شرح | موقع استشارة';
                // Set flash data
                $this->session->set_flashdata('done', 'تم اضافة الشرح بنجاح');
                redirect(base_url('pages/desc/' . $insertProduct));
            } else {
                $data['p_bidTitle'] = strip_tags($this->input->post('title'));
                $data['p_bidContent'] = strip_tags($this->input->post('content'));
                $this->load->view('admin/addComm_view', $data);
            }
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function login()
    {
        if ($this->main_model->is_admin_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'istsharhcadmin/');
        } else {
            $data['title'] = 'دخول في لوحة تحكم موقع استشارة - موقع استشارة';
            //echo urldecode($this->uri->segment(2)); Arabic letters Function in url
            $this->load->view('admin/login_view', $data);
        }
    }
    public function loginCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'istsharhcadmin/');
        } else {
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'is_unique' => '%s مسجل لدينا بالفعل',
                'matches' => 'يجب عليك إدخال %s .',
                'integer' => 'يجب عليك إدخال %s .',
                'valid_email' => 'يجب عليك إدخال %s صحيح.',
            );
            $this->form_validation->set_rules('email', 'البريد الالكتروني', 'required|valid_email', $rul);
            $this->form_validation->set_rules('password', 'كلمة السر', 'required', $rul);
            // Check if val. true
            if ($this->form_validation->run() == true) {
                $email = strip_tags($this->input->post('email'));
                $password = strip_tags($this->input->post('password'));
                $records = $this->main_model->getByData('admins', 'email', $email);
                if ($records == true) {
                    foreach ($records as $row) {
                        $password_f = $row->password;
                        $email_f = $row->email;
                        if ($password == $this->encryption->decrypt($password_f) and $email == $email_f) {
                            $row_arr = (array) $row;
                            $this->session->set_userdata($row_arr);
                            redirect(base_url() . 'istsharhcadmin/');
                        } else {
                            redirect(base_url() . 'istsharhcadmin/login/wrong');
                        }
                    }
                } else {
                    redirect(base_url() . 'istsharhcadmin/login/wrong');
                }
            } else {
                $this->login();
            }
        }
    }
    public function logout()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
    public function addTag()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $data['title'] = 'لوحة التحكم | موقع استشارة';
            $this->main_model->creds('cats');
            $data['mtags'] = $this->main_model->getAllDataCond('categories', 'state', 0, 'c_id', null);
            $this->load->view('admin/addTag_view', $data);
        } else {
            redirect(base_url());
        }
    }
    public function addTagCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('cats');
            $data['title'] = 'لوحة التحكم | موقع استشارة';
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'is_unique' => '%s مسجل لدينا بالفعل',
                'matches' => 'يجب عليك إدخال %s .',
                'integer' => 'يجب عليك إدخال %s .',
                'valid_email' => 'يجب عليك إدخال %s صحيح.',
            );
            $this->form_validation->set_rules('tag', 'اسم التصنيف', 'required', $rul);
            if ($this->input->post('type') == 1) {
                if ($this->input->post('cat') == 0) {
                    $this->form_validation->set_rules('events', 'التصنيف الأساسي', 'required', $rul);
                    $c_id = $this->input->post('events');
                } else {
                    $c_id = null;
                }
            } else {
                $c_id = null;
            }
            // Check if val. true
            if ($this->form_validation->run() == true) {
                if ($c_id == null) {
                    $state = $this->input->post('cat');
                } else {
                    $state = 1;
                }
                $this->main_model->insertData('categories', array(
                    'category' => $this->input->post('tag'),
                    'icon' => $this->input->post('icon'),
                    'state' => $state,
                    'c_id' => $c_id,
                ));
                // Success
                $data['state'] = 1;
                $data['mtags'] = $this->main_model->getAllDataCond('categories', 'state', 0, 'c_id', null);
                $this->load->view('admin/addTag_view', $data);
            } else {
                $this->addTag();
            }

        } else {
            redirect(base_url() . 'istsharhcadmin/login');
        }
    }
    public function publish()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('items');
            $state = strip_tags($this->uri->segment(3));
            if ($state == 'active') {
                $stateTerm = ' AND (state = 1)';
            } elseif ($state == 'complete') {
                $stateTerm = ' AND (state = 3)';
            } elseif ($state == 'run') {
                $stateTerm = ' AND (state = 2)';
            } elseif ($state == 'unactive') {
                $stateTerm = ' AND (state = 0)';
            } elseif ($state == 'closed') {
                $stateTerm = ' AND (state = 10)';
            } elseif ($state == 'fight') {
                $stateTerm = ' AND (fight IS NOT NULL)';
            } else {
                $stateTerm = '';
            }
            $data['items'] = $this->main_model->getFullRequest('items', '(kind = 1)' . $stateTerm . ' ORDER BY state ASC');
            $data['title'] = 'الخدمات';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/publish_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . 'istsharhcadmin/login/');
        }
    }
    public function projects()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('items');
            $state = strip_tags($this->uri->segment(3));
            if ($state == 'active') {
                $stateTerm = ' AND (state = 1)';
            } elseif ($state == 'complete') {
                $stateTerm = ' AND (state = 3)';
            } elseif ($state == 'run') {
                $stateTerm = ' AND (state = 2)';
            } elseif ($state == 'unactive') {
                $stateTerm = ' AND (state = 0)';
            } elseif ($state == 'closed') {
                $stateTerm = ' AND (state = 10)';
            } elseif ($state == 'fight') {
                $stateTerm = ' AND (fight IS NOT NULL)';
            } else {
                $stateTerm = '';
            }
            $data['items'] = $this->main_model->getFullRequest('items', '(kind = 2)' . $stateTerm . ' ORDER BY state ASC');
            $data['title'] = 'المشاريع';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/projects_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . 'istsharhcadmin/login/');
        }
    }
    public function publishCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('items');
            $item = $this->main_model->getByData('items', 'id', $this->uri->segment(3));
            if ($item) {
                $this->main_model->update('items', 'id', $item[0]->id, array(
                    'state' => 1,
                ));
                if ($item[0]->kind == 1) {
                    $msgTit = 'تمت الموافقة على خدمتك';
                } else {
                    $msgTit = 'تمت الموافقة على مشروعكم';
                    if ($item[0]->for_user !== NULL) {
                        $this->main_model->alert('مشروع خاص','تم دعوتك على مشروع خاص : <a href="'.base_url().'i/'.str_replace(' ','-',$item[0]->title).'/'.$item[0]->id.'/'.'">'.$item[0]->title.'</a>',$item[0]->for_user);
                    }
                }
                $itemLink = base_url() . 'i/' . str_replace(' ', '-', $item[0]->title) . '/' . $item[0]->id . '/';
                $this->main_model->alert($msgTit . ' : <a target="_blank" href="' . $itemLink . '">' . $item[0]->title . '</a>', $msgTit . ' ويمكنك معاينته', $item[0]->u_id);
                redirect(base_url() . 'istsharhcadmin/' . $this->uri->segment(4));
            } else {
                redirect(base_url() . '404/');
            }
        }
    }
    public function close()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('items');
            $i_id = strip_tags($this->uri->segment(3));
            $data['item'] = $this->main_model->getFullRequest('items', '(kind != 5) AND (id = ' . $i_id . ')')[0];
            if (!$data['item']) {
                redirect(base_url() . 'istsharhcadmin/404/');
            }
            $data['title'] = 'العناصر';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/close_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . 'istsharhcadmin/login/');
        }
    }
    public function closeCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('items');
            $item = $this->main_model->getByData('items', 'id', $this->uri->segment(3));
            if ($item) {
                if ($item[0]->kind == 2 && $item[0]->state == 2) {
                    $bid = $this->main_model->getByData('bids', 'id', $item[0]->bid_id)[0];
                    if (!$bid) {
                        redirect(base_url('404/'));
                    }
                    $bidder = $this->main_model->getByData('users', 'id', $bid->u_id)[0];
                    $owner = $this->main_model->getByData('users', 'id', $item[0]->u_id)[0];
                    $newBalance = $owner->balance + $bid->amount;
                    $newCBalance = $owner->c_balance - $bid->amount;
                    $newAllBalance = $owner->all_balance + $bid->amount;
                    $this->main_model->update('users', 'id', $owner->id, array(
                        'all_balance' => $newAllBalance,
                        'c_balance' => $newCBalance,
                        'balance' => $newBalance,
                    ));
                }
                $this->main_model->update('items', 'id', $item[0]->id, array(
                    'state' => 10,
                ));
                $itemLink = base_url() . 'i/' . str_replace(' ', '-', $item[0]->title) . '/' . $item[0]->id . '/';
                $msg = strip_tags($this->input->post('msg'));
                if ($item[0]->kind < 2) {
                    $itemKind = 'خدمتك';
                } else {
                    $itemKind = 'مشروعك';
                }
                echo $this->main_model->alert('تم اغلاق '.$itemKind.' '.$item[0]->title,'تم اغلاق '.$itemKind.' <a href="'.$itemLink.'">'.$item[0]->title.'</a> والسبب : '.$msg, $item[0]->u_id);
                redirect(base_url() . 'istsharhcadmin/' . $this->uri->segment(4));
            } else {
                redirect(base_url() . '404/');
            }
        }
    }
    public function withdraws()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('withdraws');
            $data['title'] = 'طلبات السحب';
            $data['requests'] = $this->main_model->getAllData('requestedbalance');
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/withdraw_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . 'istsharhcadmin/login');
        }
    }
    public function requestDone()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('withdraws');
            $data['title'] = 'طلبات السحب';
            $r_id = (int) strip_tags($this->uri->segment(3));
            $rB = $this->main_model->getByData('requestedbalance', 'id', $r_id)[0];
            $this->main_model->update('requestedbalance', 'id', $r_id, array(
                'state' => 1,
            ));
            $userData = (array) $this->main_model->getByData('users', 'id', $rB->u_id)[0];
            $userId = $userData['id'];
            $totalAmount = $rB->amount;
            $newCBalance = $userData['c_balance'] - $totalAmount;
            $this->main_model->update('users', 'id', $userId, array(
                'c_balance' => $newCBalance,
            ));
            $this->main_model->alert('تم ارسال المبلغ المطلوب', 'لقد تم ارسال مبلغ ' . $totalAmount . 'على حسابك في paypal', $userId);
            $this->session->set_flashdata('done', 'تم تعديل حالة الطلب');
            redirect(base_url() . 'istsharhcadmin/withdraws/');
        } else {
            redirect(base_url() . 'istsharhcadmin/login');
        }
    }
    public function delete()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $tables = array('items', 'categories', 'countries', 'skills', 'admins', 'editedbid', 'requestedgigs');
            if (in_array($this->uri->segment(3), $tables)) {
                $table = $this->uri->segment(3);
            } else {
                redirect(base_url() . '404/');
            }
            $data['item'] = $this->main_model->getByData($table, 'id', $this->uri->segment(4));
            $reUrl = explode('/', $this->input->get('m'));
            $this->main_model->deleteData($this->uri->segment(3), 'id', $data['item'][0]->id);
            if ($table == 'items' or $table == 'portfolio') {
                //Delete Images
                define('EXT', '.' . pathinfo(__FILE__, PATHINFO_EXTENSION));
                define('PUBPATH', str_replace(SELF, '', FCPATH)); // added
                $images = explode(',', $data['item'][0]->images);
                foreach ($images as $image) {
                    $myFile = PUBPATH . 'vendor/uploads/images/' . $image;
                    unlink($myFile) or die("يوجد خطأ ما");
                }
            }
            redirect(base_url() . $this->input->get('m'));
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function support()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('cs');
            $data['tickets'] = $this->main_model->getFullRequest('cdata', '(kind = 3) AND (state = 0)');
            foreach ($data['tickets'] as $ticket) {
                $this->main_model->update('cdata', 'id', $ticket->id, array(
                    'seen' => 1,
                ));
            }
            $data['title'] = 'الدعم الفني';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/support_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function bills()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('items');
            $data['title'] = 'الفواتير';
            $bill_id = (int) strip_tags($this->input->get('id'));
            if ($bill_id > 0) {
                $idTerm = '= ' . $bill_id;
            } else {
                $idTerm = 'IS NOT NULL';
            }
            $data['bills'] = $this->main_model->getFullRequest('requestedgigs', '(id ' . $idTerm . ') ORDER BY id DESC');
            if (!$data['bills'] && $bill_id > 0) {
                redirect(base_url() . '404/');
            }
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/bills_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function bill()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('items');
            $data['title'] = 'فاتورة';
            $bill_id = (int) strip_tags($this->uri->segment(3));
            $data['bill'] = $this->main_model->getByData('requestedgigs', 'id', $bill_id)[0];
            if (!$data['bill']) {
                redirect(base_url() . '404/');
            }
            $data['item'] = $this->main_model->getByData('items', 'id', $data['bill']->i_id)[0];
            $data['gUs'] = $this->main_model->getByData('gigupdates', 'i_id', $data['bill']->i_id);
            $this->load->view('admin/bill_view', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function apps()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('apps');
            $data['title'] = 'استشارة | الاعدادات';
            $data['settings'] = (array) $this->main_model->getByData('settings', 'id', 1)[0];
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/apps_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function appsCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('apps');
            $data['title'] = 'لوحة التحكم | موقع استشارة';
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'is_unique' => '%s مسجل لدينا بالفعل',
                'matches' => 'يجب عليك إدخال %s .',
                'integer' => 'يجب عليك إدخال %s .',
                'valid_email' => 'يجب عليك إدخال %s صحيح.',
            );
            $this->form_validation->set_rules('show', 'الاظهار والاخفاء', 'required', $rul);
            $this->form_validation->set_rules('facebook', 'حساب الـ facebook', 'required', $rul);
            $this->form_validation->set_rules('twitter', 'حساب الـ twitter', 'required', $rul);
            $this->form_validation->set_rules('instagram', 'حساب الـ instagram', 'required', $rul);
            $this->form_validation->set_rules('email', 'حساب الـ instagram', 'required', $rul);
            $this->form_validation->set_rules('percent', 'عمولة الموقع', 'required', $rul);
            $this->form_validation->set_rules('pause', 'مدة تعليق الرصيد', 'required', $rul);
            $this->form_validation->set_rules('template', 'قالب البريد', 'required', $rul);
            // Check if val. true
            if ($this->form_validation->run() == true) {
                if (!empty($this->input->post('gigs'))) {
                    $gigs = implode(',', $this->input->post('gigs'));
                } else {
                    $gigs = '';
                }
                if (!empty($this->input->post('projects'))) {
                    $projects = implode(',', $this->input->post('projects'));
                } else {
                    $projects = '';
                }
                $this->main_model->update('settings', 'id', '1', array(
                    'facebook' => $this->input->post('facebook'),
                    'twitter' => $this->input->post('twitter'),
                    'instagram' => $this->input->post('instagram'),
                    'head' => $this->input->post('head'),
                    'body' => $this->input->post('body'),
                    'icon' => $this->input->post('icon'),
                    'logo' => $this->input->post('logo'),
                    'email' => $this->input->post('email'),
                    'percent' => $this->input->post('percent'),
                    'pause' => $this->input->post('pause'),
                    'gigs' => $gigs,
                    'projects' => $projects,
                    'template' => str_replace(base_url(), '<-base_url->', $this->input->post('template')),
                    'show_state' => (int) strip_tags($this->input->post('show')),
                ));
                // Success
                $data['state'] = 1;
                $data['settings'] = (array) $this->main_model->getByData('settings', 'id', 1)[0];
                $this->load->view('admin/include/header', $data);
                $this->load->view('admin/apps_view', $data);
                $this->load->view('admin/include/footer', $data);
            } else {
                $this->apps();
            }

        } else {
            redirect(base_url() . 'istsharhcadmin/login');
        }
    }
    public function editBlock()
    {
        if (is_numeric($this->uri->segment(3)) && $this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('blocks');
            $data['page'] = $this->main_model->getByData('site_blocks', 'id', $this->uri->segment(3));
            if (!$data['page']) {
                redirect(base_url() . 'istsharhcadmin/login');
            }
            $data['title'] = 'تعديل صفحة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/editblock_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . 'istsharhcadmin/login');
        }
    }
    public function editBlockCheck()
    {
        if (is_numeric($this->uri->segment(3)) && $this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('blocks');
            $data['page'] = $this->main_model->getByData('site_blocks', 'id', $this->uri->segment(3));
            if (!$data['page']) {
                redirect(base_url() . 'istsharhcadmin/login');
            }
            $data['title'] = 'تعديل صفحة';
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'is_unique' => '%s مسجل لدينا بالفعل',
                'matches' => 'يجب عليك إدخال %s .',
                'integer' => 'يجب عليك إدخال %s .',
                'valid_email' => 'يجب عليك إدخال %s صحيح.',
            );
            $this->form_validation->set_rules('title', 'عنوان الصفحة', 'required', $rul);
            $this->form_validation->set_rules('content', 'محتوى الصفحة', 'required', $rul);
            if ($this->form_validation->run()) {
                $this->main_model->update('site_blocks', 'id', $this->uri->segment(3), array(
                    'title' => strip_tags($this->input->post('title')),
                    'link' => strip_tags($this->input->post('link')),
                    'content' => strip_tags($this->input->post('content')),
                ));
                redirect(base_url() . 'istsharhcadmin/editBlock/' . $this->uri->segment(3) . '/done');
            } else {
                $this->editBlock();
            }
        } else {
            redirect(base_url() . 'istsharhcadmin/login');
        }
    }
    public function editPage()
    {
        if (is_numeric($this->uri->segment(3)) && $this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('pages');
            $data['page'] = $this->main_model->getByData('site_pages', 'id', $this->uri->segment(3));
            if (!$data['page']) {
                redirect(base_url() . 'istsharhcadmin/login');
            }
            $data['title'] = 'تعديل صفحة';
            $this->load->view('admin/include/header', $data);
            $this->load->view('admin/editpage_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            redirect(base_url() . 'istsharhcadmin/login');
        }
    }
    public function editPageCheck()
    {
        if (is_numeric($this->uri->segment(3)) && $this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('pages');
            $data['page'] = $this->main_model->getByData('site_pages', 'id', $this->uri->segment(3));
            if (!$data['page']) {
                redirect(base_url() . 'istsharhcadmin/login');
            }
            $data['title'] = 'تعديل صفحة';
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'is_unique' => '%s مسجل لدينا بالفعل',
                'matches' => 'يجب عليك إدخال %s .',
                'integer' => 'يجب عليك إدخال %s .',
                'valid_email' => 'يجب عليك إدخال %s صحيح.',
            );
            $this->form_validation->set_rules('title', 'عنوان الصفحة', 'required', $rul);
            $this->form_validation->set_rules('content', 'محتوى الصفحة', 'required', $rul);
            if ($this->form_validation->run()) {
                $this->main_model->update('site_pages', 'id', $this->uri->segment(3), array(
                    'title' => strip_tags($this->input->post('title')),
                    'content' => $this->input->post('content'),
                ));
                redirect(base_url() . 'istsharhcadmin/editPage/' . $this->uri->segment(3) . '/done');
            } else {
                $this->editPage();
            }
        } else {
            redirect(base_url() . 'istsharhcadmin/login');
        }
    }
    public function edit()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('blog');
            $tables = array('tickets', 'items', 'pages');
            if (in_array($this->uri->segment(3), $tables)) {
                $table = $this->uri->segment(3);
            } else {
                redirect(base_url() . '404/');
            }
            $data['item'] = $this->main_model->getAllDataCond($table, 'id', $this->uri->segment(4), 'u_id', 0);
            if ($data['item'][0]->u_id == 0) {
                $data['title'] = 'تعديل | موقع استشارة';
                if ($this->uri->segment(5) == 'blog') {
                    $data['mtags'] = $this->main_model->getAllDataCond('tags', 'state', 5, 'c_id', null);
                    foreach ($data['mtags'] as $mtag) {
                        $data['subtags'] = $this->main_model->getFullRequest('tags', 'state = 5 AND c_id = ' . $mtag->id);
                        $msubtag[$mtag->id] = $data['subtags'];
                    }
                    $data['msubtag'] = $msubtag;
                    $this->load->view('blog/blogForm_view', $data);
                } else {
                    redirect(base_url() . '404/');
                }
            }
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function addBlog()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('blog');
            $data['title'] = 'لوحة التحكم في حسابك في موقع استشارة - إضافة تدوينة | موقع استشارة';
            $data['mtags'] = $this->main_model->getAllDataCond('categories', 'state', 0, 'c_id', null);
            foreach ($data['mtags'] as $mtag) {
                $data['subtags'] = $this->main_model->getFullRequest('categories', 'c_id = ' . $mtag->id);
                $msubtag[$mtag->id] = $data['subtags'];
            }
            $data['msubtag'] = $msubtag;
            $this->load->view('blog/blogForm_view', $data);
        } else {
            redirect(base_url() . 'istsharhcadmin/login');
        }
    }
    public function addBlogCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $this->main_model->creds('blog');
            $data['mtags'] = $this->main_model->getAllDataCond('categories', 'state', 0, 'c_id', null);
            foreach ($data['mtags'] as $mtag) {
                $data['subtags'] = $this->main_model->getFullRequest('categories', 'state = 5 AND c_id = ' . $mtag->id);
                $msubtag[$mtag->id] = $data['subtags'];
            }
            $data['msubtag'] = $msubtag;
            $data['title'] = 'لوحة التحكم في حسابك في موقع استشارة - إضافة فعالية | موقع استشارة';
            // Access User Data Securly
            $userId = 0;
            ///*Form Validation
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'min_length' => '%s قصير جداُ.',
                'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                'in_list' => 'برجاء اختيار %s موجود.',
            );
            $data['mtags2'] = (array) $this->main_model->getAllDataCond('categories', 'state', 0, 'c_id', null);
            $data['subtags2'] = (array) $this->main_model->getByData('categories', 'c_id', $this->input->post('mtag'));
            if ($this->input->post('mtag')) {
                foreach ($data['subtags2'] as $tag) {
                    $stags[] = $tag->id;
                }}
            foreach ($data['mtags2'] as $mtag) {
                $mtags[] = $mtag->id;
            }
            $this->form_validation->set_rules('title', 'عنوان التدوينة', 'required|alpha_numeric_spaces', $rul);
            $this->form_validation->set_rules('content', 'التدوينة', 'required|min_length[30]', $rul);
            $this->form_validation->set_rules('tags', 'الكلمات المفتاحية', 'required', $rul);
            $this->form_validation->set_rules('mtag', 'تصنيف رئيسي', 'required|in_list[' . $this->main_model->list_rule($mtags) . ']', $rul);
            if ($this->input->post('mtag')) {
                $this->form_validation->set_rules('subtag', 'تصنيف فرعي', 'required|in_list[' . $this->main_model->list_rule($stags) . ']', $rul);
            }
            // Check if validation true
            if ($this->form_validation->run() == true) {
                $data['p_title'] = $this->input->post('title');
                $data['p_content'] = $this->input->post('content');
                $data['p_tags'] = $this->input->post('tags');
                $data['p_mtag'] = $this->input->post('mtag');
                $data['p_subtag'] = $this->input->post('subtag');
                // Accepted Validation
                //Upload Images Settings

                // load library only once
                $this->load->library('upload');

                $config['upload_path'] = './vendor/uploads/images/';
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 5000;
                $config['max_width'] = 5000;
                $config['max_height'] = 5000;
                $config['encrypt_name'] = true;

                $this->upload->initialize($config);
// Loop For 4 Images
                $imgnum = 1;
                define('EXT', '.' . pathinfo(__FILE__, PATHINFO_EXTENSION));
                define('PUBPATH', str_replace(SELF, '', FCPATH)); // added
                if (!$this->upload->do_upload('img' . $imgnum)) {
                    $data['error'] = $this->upload->display_errors();
                    //If Statement For Changing Lang
                    if ($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>') {
                        $data['error'] = 'امتداد الملف غير مسموح.';
                    }
                    // Upload Errors
                    $this->load->view('userarea/eventForm_view', $data);
                } else {
                    // Image
                    $data['img' . $imgnum] = array('upload_data' => $this->upload->data());
                    /// resize Image
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $data['img' . $imgnum]['upload_data']['full_path'];
                    $config['create_thumb'] = true;
                    $config['maintain_ratio'] = true;
                    $config['width'] = 2400;
                    $config['height'] = 1200;
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    /// resize Image for thumb
                    $config_thumb['image_library'] = 'gd2';
                    $config_thumb['source_image'] = $data['img' . $imgnum]['upload_data']['full_path'];
                    $config_thumb['create_thumb'] = true;
                    $config_thumb['maintain_ratio'] = true;
                    $config_thumb['width'] = 810;
                    $config_thumb['height'] = 480;
                    $config_thumb['new_image'] = $data['img' . $imgnum]['upload_data']['file_path'] . "vthumb_" . $data['img' . $imgnum]['upload_data']['file_name'];
                    $this->image_lib->initialize($config_thumb);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    $myFile = PUBPATH . 'vendor/uploads/images/' . $data['img' . $imgnum]['upload_data']['file_name'];
                    unlink($myFile) or die("يوجد خطأ ما");
                    $userNewFile1 = explode('.', $data['img' . $imgnum]['upload_data']['file_name']);
                    $images[$imgnum] = $userNewFile1[0] . '_thumb.' . $userNewFile1[1];
                    $data['thumbnails'] = $images;
                    ///*Insert Event
                    $insertProduct = $this->main_model->insertData('items', array(
                        'title' => $data['p_title'],
                        'content' => $data['p_content'],
                        'tags' => $data['p_tags'],
                        'images' => $data['thumbnails'][1],
                        'tag_id' => $data['p_subtag'],
                        'date' => $this->main_model->dateTime('current'),
                        'u_id' => 0,
                        'state' => 1,
                        'kind' => 5,
                    ));
                    $data['state'] = 1;
                    $itemId = (array) $this->main_model->getAllDataCond('items', 'u_id', 0, 'images', $data['thumbnails'][1])[0];
                    $this->load->view('blog/blogForm_view', $data);
                }
            } else {
                $data['mtags'] = $this->main_model->getAllDataCond('categories', 'state', 0, 'c_id', null);
                foreach ($data['mtags'] as $mtag) {
                    $data['subtags'] = $this->main_model->getFullRequest('categories', 'c_id = ' . $mtag->id);
                    $msubtag[$mtag->id] = $data['subtags'];
                }
                $data['msubtag'] = $msubtag;
                $this->load->view('blog/blogForm_view', $data);
            }
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function editCheck()
    {
        if ($this->main_model->is_admin_logged_in()) {
            $tables = array('tickets', 'items', 'pages');
            if (in_array($this->uri->segment(3), $tables)) {
                $table = $this->uri->segment(3);
            } else {
                echo 'here0'; //redirect(base_url().'404/');
            }
            $data['item'] = $this->main_model->getAllDataCond($table, 'id', $this->uri->segment(4), 'u_id', 0);
            if ($data['item'][0]->u_id == 0) {
                $data['title'] = 'تعديل | موقع استشارة';
                if ($this->uri->segment(5) == 'blog') {
                    $data['mtags'] = $this->main_model->getAllDataCond('tags', 'state', 5, 'c_id', null);
                    foreach ($data['mtags'] as $mtag) {
                        $data['subtags'] = $this->main_model->getFullRequest('tags', 'state = 5 AND c_id = ' . $mtag->id);
                        $msubtag[$mtag->id] = $data['subtags'];
                    }
                    $data['msubtag'] = $msubtag;
                    $data['title'] = 'لوحة التحكم في حسابك في موقع استشارة - تعديل تدوينة | موقع استشارة';
                    $userId = 0;
                    ///*Form Validation
                    $rul = array(
                        'required' => 'يجب عليك إدخال %s .',
                        'min_length' => '%s قصير جداُ.',
                        'alpha_numeric_spaces' => 'لا تدخل رموزاً في %s.',
                        'valid_url' => 'برجاء إدخال رابط صالح في %s.',
                        'is_natural_no_zero' => 'برجاء إدخال أرقام فقط في خانة %s وتكون أعلى من 1.',
                        'in_list' => 'برجاء اختيار %s موجود.',
                    );
                    $data['mtags2'] = (array) $this->main_model->getAllDataCond('tags', 'state', 5, 'c_id', null);
                    $data['subtags2'] = (array) $this->main_model->getByData('tags', 'c_id', $this->input->post('mtag'));
                    if ($this->input->post('mtag')) {
                        foreach ($data['subtags2'] as $tag) {
                            $stags[] = $tag->id;
                        }}
                    foreach ($data['mtags2'] as $mtag) {
                        $mtags[] = $mtag->id;
                    }
                    $this->form_validation->set_rules('title', 'عنوان التدوينة', 'required|alpha_numeric_spaces', $rul);
                    $this->form_validation->set_rules('content', 'وصف التدوينة', 'required|min_length[100]', $rul);
                    $this->form_validation->set_rules('tags', 'الكلمات المفتاحية', 'required', $rul);
                    $this->form_validation->set_rules('mtag', 'تصنيف رئيسي', 'required|in_list[' . $this->main_model->list_rule($mtags) . ']', $rul);
                    if ($this->input->post('mtag')) {
                        $this->form_validation->set_rules('subtag', 'تصنيف فرعي', 'required|in_list[' . $this->main_model->list_rule($stags) . ']', $rul);
                    }
                    // Check if validation true
                    if ($this->form_validation->run() == true) {
                        $data['p_title'] = $this->input->post('title');
                        $data['p_content'] = $this->input->post('content');
                        $data['p_tags'] = $this->input->post('tags');
                        $data['p_mtag'] = $this->input->post('mtag');
                        $data['p_subtag'] = $this->input->post('subtag');
                        if ($this->input->post('p_id')) {
                            $data['p_id'] = $this->input->post('p_id');
                        } else {
                            $data['p_id'] = '';
                        }
                        // Accepted Validation
                        //Upload Images Settings

                        // load library only once
                        $this->load->library('upload');

                        $config['upload_path'] = './vendor/uploads/images/';
                        $config['allowed_types'] = 'jpeg|jpg|png';
                        $config['max_size'] = 5000;
                        $config['max_width'] = 5000;
                        $config['max_height'] = 5000;
                        $config['encrypt_name'] = true;

                        $this->upload->initialize($config);
                        // Loop For 4 Images
                        $imgnum = 1;
                        define('EXT', '.' . pathinfo(__FILE__, PATHINFO_EXTENSION));
                        define('PUBPATH', str_replace(SELF, '', FCPATH)); // added
                        if (!$this->upload->do_upload('img' . $imgnum)) {
                            $data['error'] = $this->upload->display_errors();
                            //If Statement For Changing Lang
                            if ($data['error'] == '<p>The filetype you are attempting to upload is not allowed.</p>') {
                                $data['error'] = 'امتداد الملف غير مسموح.';
                            }
                            if ($data['error'] == '<p>You did not select a file to upload.</p>') {
                                ///*update Event
                                $updateProduct = $this->main_model->update('items', 'id', $data['item'][0]->id, array(
                                    'title' => $data['p_title'],
                                    'content' => $data['p_content'],
                                    'mtag' => $data['p_mtag'],
                                    'tags' => $data['p_tags'],
                                    'subtag' => $data['p_subtag'],
                                ));
                                redirect(base_url() . 'users/edit/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/done');
                            }
                            // Upload Errors
                            $this->load->view('userarea/eventForm_view', $data);
                        } else {
                            // Image
                            $data['img' . $imgnum] = array('upload_data' => $this->upload->data());
                            /// resize Image
                            $config['image_library'] = 'gd2';
                            $config['source_image'] = $data['img' . $imgnum]['upload_data']['full_path'];
                            $config['create_thumb'] = true;
                            $config['maintain_ratio'] = true;
                            $config['width'] = 800;
                            $config['height'] = 400;
                            $this->image_lib->initialize($config);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                            /// resize Image for thumb
                            $config_thumb['image_library'] = 'gd2';
                            $config_thumb['source_image'] = $data['img' . $imgnum]['upload_data']['full_path'];
                            $config_thumb['create_thumb'] = true;
                            $config_thumb['maintain_ratio'] = true;
                            $config_thumb['width'] = 270;
                            $config_thumb['height'] = 160;
                            $config_thumb['new_image'] = $data['img' . $imgnum]['upload_data']['file_path'] . "vthumb_" . $data['img' . $imgnum]['upload_data']['file_name'];
                            $this->image_lib->initialize($config_thumb);
                            $this->image_lib->resize();
                            $this->image_lib->clear();
                            $myFile = PUBPATH . 'vendor/uploads/images/' . $data['img' . $imgnum]['upload_data']['file_name'];
                            unlink($myFile) or die("يوجد خطأ ما");
                            $userNewFile1 = explode('.', $data['img' . $imgnum]['upload_data']['file_name']);
                            $images[$imgnum] = $userNewFile1[0] . '_thumb.' . $userNewFile1[1];
                            $data['thumbnails'] = $images;
                            $myFile2 = PUBPATH . 'vendor/uploads/images/' . $data['item'][0]->image;
                            unlink($myFile2) or die("يوجد خطأ ما");
                            $myFile3 = PUBPATH . 'vendor/uploads/images/' . $this->main_model->vthumb($data['item'][0]->image);
                            unlink($myFile3) or die("يوجد خطأ ما");
                            ///*update Event
                            $updateProduct = $this->main_model->update('items', 'id', $data['item'][0]->id, array(
                                'title' => $data['p_title'],
                                'content' => $data['p_content'],
                                'mtag' => $data['p_mtag'],
                                'tags' => $data['p_tags'],
                                'subtag' => $data['p_subtag'],
                                'image' => $data['thumbnails'][1],
                            ));
                            redirect(base_url() . 'istsharhcadmin/edit/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/done');
                        }
                    } else {
                        $this->load->view('blog/blogForm_view', $data);
                    }
                } else {
                    redirect(base_url() . '404/');
                }
            } else {
                redirect(base_url() . '404/');
            }
        } else {
            redirect(base_url() . '404/');
        }
    }
}