<?php

class Pages extends CI_Controller
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
    public $viewed;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('cookie');
        $this->load->library("pagination");
        if ($this->main_model->is_logged_in($this->uri->segment(3), 'No')) {
            $this->viewed = $this->main_model->is_logged_in($this->uri->segment(3));
        } elseif ($this->main_model->is_logged_in($this->uri->segment(2), 'No')) {
            $this->viewed = $this->main_model->is_logged_in($this->uri->segment(2));
        } else {
            $this->viewed = $this->main_model->is_logged_in(1);
        }
        $url = strip_tags($this->input->get('url'));
        if (isset($url) && $url !== '') {
            set_cookie(array(
                'name' => 'url',
                'value' => $url,
                'expire' => time() + 86500,
            ));
        }
        if ($this->main_model->is_logged_in() && get_cookie('url') !== null) {
            $url = base64_decode(get_cookie('url'));
            delete_cookie('url');
            redirect($url);
        }
        // Load facebook library
        $this->load->library('facebook');
        if ($this->main_model->is_logged_in()) {
            if ($this->session->userdata('username') == '' && $this->uri->segment(2) !== 'createUserName') {
                redirect(base_url('users/createUserName'));
            }
        }
    }
    public function notfound()
    {
        $this->load->view('notfound');
    }
    public function index()
    {
        // URL :- http://localhost/ci_main/
        $data['userviewed'] = $this->viewed;
        if ($this->main_model->is_logged_in()) {
            $data['userData'] = (array) $this->main_model->is_logged_in(1)[0];
        }
        $data['title'] = 'استشارة | الصفحة الرئيسية';
        $data['cats'] = $this->main_model->getFullRequest('categories', '(c_id IS NULL)');
        $settings = (array) $this->main_model->getByData('settings', 'id', 1)[0];
        $gigsArr = explode(',', $settings['gigs']);
        $gigs = implode("','", $gigsArr);
        $projectsArr = explode(',', $settings['projects']);
        $projects = implode("','", $projectsArr);
        $data['records'] = $this->main_model->getFullRequest('items', '(kind = 1) AND (state = 1) AND (id IN (\'' . $gigs . '\'))');
        $data['projects'] = $this->main_model->getFullRequest('items', '(kind = 2) AND (state = 1) AND (id IN (\'' . $projects . '\'))');
        $data['blocks'] = $this->main_model->getAllData('site_blocks');
        $this->load->view('home_view', $data);
    }
    public function go()
    {
        // URL :- http://localhost/ci_main/
        $data['title'] = 'استشارة | الخروج من الموقع';
        $link = base64_decode($this->input->get('url'));
        $linkCheck = $this->main_model->getByData('links', 'link', $link);
        if ($linkCheck) {
            $views = $linkCheck[0]->views + 1;
            $clicks = $this->main_model->update('links', 'id', $linkCheck[0]->id, array('views' => $views));
            $data['views'] = $views;
            $data['go'] = $link;
        } else {
            redirect(base_url() . 'user/');
        }
        $this->load->view('go_view', $data);
    }
    public function i()
    {
        $id = (int) strip_tags($this->uri->segment(3));
        $data['item'] = $this->main_model->getByData('items', 'id', $id)[0];
        if (!$data['item']) {
            redirect(base_url() . '404/');
        }
        $data['rates'] = $this->main_model->getFullRequest('rate', '(i_id = ' . $data['item']->id . ')');
        $data['gUs'] = false;
        $data['rGigs'] = false;
        if ($data['item']->kind == 2) {
            $data['bids'] = $this->main_model->getByData('bids', 'i_id', $id);
        } else {
            $data['gUs'] = $this->main_model->getByData('gigupdates', 'i_id', $id);
            if ($this->main_model->is_logged_in()) {
                $userData = (array) $this->main_model->is_logged_in(1)[0];
                $id = $userData['id'];
                $data['rGigs'] = $this->main_model->getFullRequest('requestedgigs', '(u_id = ' . $id . ') AND (i_id = ' . $data['item']->id . ') AND (state = 0)');
            }
        }
        $data['same'] = $this->main_model->getFullRequest('items', '(tag_id = ' . $data['item']->tag_id . ') AND (id != ' . $data['item']->id . ') AND (kind = 1)');
        $data['userGigs'] = $this->main_model->getFullRequest('items', '(u_id = ' . $data['item']->u_id . ') AND (id != ' . $data['item']->id . ') AND (kind = 1)');
        $data['byUser'] = $this->main_model->getByData('users', 'id', $data['item']->u_id)[0];
        $data['title'] = 'منصة استشارة - ' . $data['item']->title;
        $this->load->view('item_view', $data);
    }
    public function search()
    {
        $data['title'] = 'صفحة البحث';
        if (get_cookie('searchFor') == '1') {
            $data['searchFor'] = $searchFor = '1';
        } else {
            $data['searchFor'] = $searchFor = '2';
        }
        $searchKeyword = strip_tags(urldecode($this->input->get('search')));
        //Get Keyword Results
        $data['mtags'] = $this->main_model->getAllDataCond('categories', 'state', 0, 'c_id', null);
        //If Main Tag
        $mainTag = (int) strip_tags($this->input->get('cat'));
        $data['subtags'] = $this->main_model->getAllDataCond('categories', 'state', 1, 'c_id', $mainTag);
        $subs = array();
        $data["links"] = '';
        if ($data['subtags']) {
            foreach ($data['subtags'] as $subtag) {
                $subs[] = $subtag->id;
            }
            $array = implode("','", $subs);
            $config = array();
            $config["base_url"] = base_url() . "pages/search/";

            $config["total_rows"] = $this->main_model->search('items', '(state = 1) AND (kind = ' . $searchFor . ') AND (tag_id IN (\'' . $array . '\')) AND (for_user IS NULL)', 'title', $searchKeyword, null, null, 'count');
            $config["per_page"] = 12;
            $config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["links"] = $this->pagination->create_links();
            $data['results'] = $this->main_model->search('items', '(state = 1) AND (kind = ' . $searchFor . ') AND (tag_id IN (\'' . $array . '\')) AND (for_user IS NULL)', 'title', $searchKeyword, $config['per_page'], $page);
        } else {
            $config = array();
            $config["base_url"] = base_url() . "pages/search/";

            $config["total_rows"] = $this->main_model->search('items', '(state = 1) AND (kind = ' . $searchFor . ') AND (for_user IS NULL)', 'title', $searchKeyword, null, null, 'count');
            $config["per_page"] = 12;
            $config["uri_segment"] = 3;

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["links"] = $this->pagination->create_links();
            $data['results'] = $this->main_model->search('items', '(state = 1) AND (kind = ' . $searchFor . ') AND (for_user IS NULL) ORDER BY id DESC', 'title', $searchKeyword, $config['per_page'], $page);
        }
        $this->load->view('search_view', $data);
    }
    public function searchFor()
    {
        if ($this->uri->segment(3) == '1') {
            set_cookie(array(
                'name' => 'searchFor',
                'value' => '1',
                'expire' => time() + 86500,
            ));
            redirect(base_url() . 'pages/search');
        } else {
            set_cookie(array(
                'name' => 'searchFor',
                'value' => '2',
                'expire' => time() + 86500,
            ));
            redirect(base_url() . 'pages/search');
        }
    }
    public function searchFilter()
    {
        if (get_cookie('searchFor') == '1') {
            $data['searchFor'] = $searchFor = '1';
        } else {
            $data['searchFor'] = $searchFor = '2';
        }
        $searchKeyword = strip_tags(urldecode($this->input->post('search')));
        $tag_id = (int) strip_tags(urldecode($this->input->post('tag_id')));

        /* Start Filter */
        //Rates Filter
        $ratesU_id = array();
        $ratesI_id = array();
        //Filter
        $rates = (int) strip_tags(urldecode($this->input->post('rates')));
        //If created
        if (isset($rates) && $rates !== 0) {
            $rateRecords = $this->main_model->getAllData('rate');
            //Get filter i_id,id
            $ratedItemId = 0;
            foreach ($rateRecords as $rateRecord) {
                $itemRates = $this->main_model->getByData('rate', 'i_id', $rateRecord->i_id);
                $rate_item = 0;
                if($ratedItemId !== $rateRecord->i_id){
                    foreach ($itemRates as $itemRate) {
                        $rate_item += round((($itemRate->pro_rate + $itemRate->con_rate + $itemRate->qua_rate + $itemRate->exp_rate + $itemRate->date_rate + $itemRate->again_rate) / 6), 2);
                    }
                    $ratedItemId = $rateRecord->i_id;
                }
                $avgRate = round(($rate_item / (count($itemRates))), 2);
                if ($avgRate >= $rates) {
                    //Get filter i_id
                    $ratesI_id[] = $rateRecord->i_id;
                    //Get filter id
                    $ratesU_id[] = $rateRecord->s_id;
                }
            }
            $ratesU_id = array_unique($ratesU_id);
            $ratesI_id = array_unique($ratesI_id);
        }
        /* End Filter */

        //Get Users For Prof And Country And Active
        $users = $this->main_model->getAllData('users');

        /* Start Filter */
        //Prof Filter
        $userIds = array();
        $prof = strip_tags(urldecode($this->input->post('prof')));
        if (isset($prof) && $prof !== '') {
            if ($prof == 'zero') {
                foreach ($users as $user) {
                    $userRate = $this->main_model->getUserRate($user->id);
                    if ($userRate <= 0) {
                        $userIds[] = $user->id;
                    }
                }
            } elseif ($prof == 'one') {
                foreach ($users as $user) {
                    $userRate = $this->main_model->getUserRate($user->id);
                    if ($userRate <= 2 && $userRate > 0) {
                        $userIds[] = $user->id;
                    }
                }
            } elseif ($prof == 'two') {
                foreach ($users as $user) {
                    $userRate = $this->main_model->getUserRate($user->id);
                    if ($userRate <= 4 && $userRate > 2) {
                        $userIds[] = $user->id;
                    }
                }
            } elseif ($prof == 'three') {
                foreach ($users as $user) {
                    $userRate = $this->main_model->getUserRate($user->id);
                    if ($userRate <= 5 && $userRate > 4) {
                        $userIds[] = $user->id;
                    }
                }
            }
        }
        $userIds = array_unique($userIds);
        /* End Filter */

        /* Start Filter */
        //Countries Filter
        $userCoIds = array();
        $country = strip_tags(urldecode($this->input->post('country')));
        if (isset($country) && $country !== '') {
            $countriesUsers = $this->main_model->getByData('users', 'country', $country);
            if ($countriesUsers) {
                foreach ($countriesUsers as $userCo) {
                    $userCoIds[] = $userCo->id;
                }
            }
        }
        $userCoIds = array_unique($userCoIds);
        /* End Filter */

        /* Start Filter */
        //Rates Filter
        $activeU_ids = array();
        $activeU_id = array();
        $offlineU_id = array();
        //Filter
        $active = '';
        $active = strip_tags($this->input->post('active'));
        //If created
        if ($active == 'on') {
            $activeUsers = $this->main_model->getByData('users', 'active', 1);
            if ($activeUsers) {
                foreach ($activeUsers as $activeUser) {
                    $checkPulse = $this->main_model->checkPulse($activeUser->pulse, $activeUser->id);
                    if ($checkPulse == 'on') {
                        $activeU_id[] = $activeUser->id;
                    }
                }
            }
        } elseif ($active == 'off') {
            $activeUsers = $this->main_model->getFullRequest('users', '(active = 0) OR (active IS NULL)');
            foreach ($activeUsers as $activeUser) {
                $checkPulse = $this->main_model->checkPulse($activeUser->pulse, $activeUser->id);
                if ($checkPulse == 'off') {
                    $offlineU_id[] = $activeUser->id;
                    $this->main_model->update('users', 'id', $activeUser->id, array(
                        'active' => 0,
                        'pulse' => $this->main_model->dateTime('current'),
                    ));
                }
            }
        } elseif ($active == 'all') {
            $activeUsers = $this->main_model->getAllData('users');
            foreach ($activeUsers as $activeUser) {
                $offlineU_id[] = $activeUser->id;
            }
        }
        $activeU_ids = array_merge($activeU_id, $offlineU_id);
        /* End Filter */

        //All Filters Emploder And Merger
        if (count($userIds) > 0 or count($userCoIds) > 0 or count($activeU_ids) > 0) {
            $filterIdsMerge = array_unique(array_merge(array_intersect($userCoIds, $activeU_ids, $userIds)));
        } else {
            $filterIdsMerge = array();
        }

        $filterI_idsMerge = array_unique(array_merge($ratesI_id));

        $filterU_ids = implode("','", $filterIdsMerge);
        $filterI_ids = implode("','", $filterI_idsMerge);
        $u_idsRequest = '';
        $i_idsRequest = '';
        if ($filterU_ids !== '') {
            $u_idsRequest = ' AND (u_id IN (\'' . $filterU_ids . '\'))';
        } elseif ($filterU_ids == '' && isset($country) && $country !== '') {
            $u_idsRequest = ' AND (u_id IN (\'0\'))';
        } elseif ($filterU_ids == '' && isset($prof) && $prof !== '') {
            $u_idsRequest = ' AND (u_id IN (\'0\'))';
        }
        if (!$activeUsers) {
            $u_idsRequest = ' AND (u_id IN (\'0\'))';
        }
        if ($filterI_ids !== '') {
            $i_idsRequest = ' AND (id IN (\'' . $filterI_ids . '\'))';
        } elseif ($filterI_ids == '' && isset($rates) && $rates > 0) {
            $i_idsRequest = ' AND (id IN (\'0\'))';
        }
        $tager = '';
        if ($tag_id) {
            $tager = 'AND (tag_id = ' . $tag_id . ')';
        }

        //Get Keyword Results
        $data['results'] = $this->main_model->search('items', '(state = 1) AND (kind = ' . $searchFor . ') AND (for_user IS NULL)' . $i_idsRequest . $u_idsRequest . $tager, 'title', $searchKeyword);
        if ($data['results']) {
            $i = 0;
            foreach ($data['results'] as $result) {
                $data['results'][$i]->link = base_url() . 'i/' . str_replace(' ', '-', $result->title) . '/' . $result->id . '/';
                $differ = $this->main_model->dateTime('diff', $data['results'][$i]->date, $this->main_model->dateTime('current'));
                ob_start(); //Start output buffer
                $this->main_model->differ($differ);
                $output = ob_get_contents(); //Grab output
                ob_end_clean(); //Discard output buffer
                $data['results'][$i]->date = $output;
                $subCat = $this->main_model->getByData('categories', 'id', $data['results'][$i]->tag_id);
                $mainCat = $this->main_model->getByData('categories', 'id', $subCat[0]->c_id);
                $data['results'][$i]->mtag = $mainCat[0]->category;
                $data['results'][$i]->subtag = $subCat[0]->category;
                $data['results'][$i]->price = implode(' - ', explode(',', $data['results'][$i]->price));
                $data['results'][$i]->content = preg_replace('!\s+!', ' ', mb_substr(strip_tags($data['results'][$i]->content), 0, 150, "utf-8")) . '...';
                if ($data['results'][$i]->images !== 'NONE') {
                    $image = explode(',', $data['results'][$i]->images);
                    $vthumb = 'vthumb_' . $image[0];
                    $data['results'][$i]->image = base_url() . 'vendor/uploads/images/' . $vthumb;
                }
                $count = $this->main_model->getFullRequest('requestedgigs', '(i_id = ' . $data['results'][$i]->id . ')', 'count');
                if ($count > 0) {
                    $data['results'][$i]->counter = $count . ' عمليات شراء تمت لهذه الخدمة';
                } else {
                    $data['results'][$i]->counter = 'كن أول مشتري';
                }
                $i++;}
        }
        $response = array(
            'done' => 1,
            'kind' => $searchFor,
            'results' => $data['results'],
        );
        echo json_encode($response);
    }
    public function restPassword()
    {
        if ($this->main_model->is_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'user/' . $this->session->userdata('username'));
        } else {
            $data['title'] = 'استعادة كلمة السر - موقع استشارة';
            // Get login URL
            $data['authURL'] = $this->facebook->login_url();
            /*END FB REGISTER & LOGIN*/
            include_once APPPATH . "libraries/vendor/autoload.php";

            $google_client = new Google_Client();

            $google_client->setClientId('626591971273-nmhlbp8ap19kh7n94rn6i7j2vj3vqq28.apps.googleusercontent.com'); //Define your ClientID

            $google_client->setClientSecret('bd4gwnlSmkQNMtOw6KnNzJAT'); //Define your Client Secret Key

            $google_client->setRedirectUri('https://istsharh.com/istsharh/pages/continueGoogleregistration'); //Define your Redirect Uri

            $google_client->addScope('email');

            $google_client->addScope('profile');
            $login_button = $google_client->createAuthUrl();
            $data['google_button'] = $login_button;
            /*END FB REGISTER & LOGIN*/
            //echo urldecode($this->uri->segment(2)); Arabic letters Function in url
            $this->load->view('reset_view', $data);
        }
    }
    public function repass()
    {
        if ($this->main_model->is_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'user/' . $this->session->userdata('username'));
        } else {
            $data['title'] = 'استعادة كلمة السر - موقع استشارة';
            // Get login URL
            $data['authURL'] = $this->facebook->login_url();
            /*END FB REGISTER & LOGIN*/
            include_once APPPATH . "libraries/vendor/autoload.php";

            $google_client = new Google_Client();

            $google_client->setClientId('626591971273-nmhlbp8ap19kh7n94rn6i7j2vj3vqq28.apps.googleusercontent.com'); //Define your ClientID

            $google_client->setClientSecret('bd4gwnlSmkQNMtOw6KnNzJAT'); //Define your Client Secret Key

            $google_client->setRedirectUri('https://istsharh.com/istsharh/pages/continueGoogleregistration'); //Define your Redirect Uri

            $google_client->addScope('email');

            $google_client->addScope('profile');
            $login_button = $google_client->createAuthUrl();
            $data['google_button'] = $login_button;
            /*END FB REGISTER & LOGIN*/
            //echo urldecode($this->uri->segment(2)); Arabic letters Function in url
            $records = $this->main_model->getByData('users_activation', 'code', $this->uri->segment(3));
            if ($records == false) {
                redirect(base_url() . '404/');
            }
            $data['user'] = $this->main_model->getByData('users', 'id', $records[0]->u_id)[0];
            $this->load->view('repass_view', $data);
        }
    }
    public function repassCheck()
    {
        if ($this->main_model->is_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'user/' . $this->session->userdata('username'));
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
            $this->form_validation->set_rules('passwordConf', 'تأكيد كلمة السر صحيحة', 'required|matches[password]', $rul);
            // Check if val. true
            if ($this->form_validation->run() == true) {
                $email = strip_tags($this->input->post('email'));
                $records = $this->main_model->getByData('users', 'email', $email);
                if ($records == true) {
                    $this->main_model->update('users', 'id', $records[0]->id, array(
                        'password' => $this->encryption->encrypt($this->input->post('password')),
                    ));
                    $this->main_model->deleteData('users_activation', 'u_id', $records[0]->id);
                    redirect(base_url() . 'login');
                } else {
                    redirect(base_url() . 'pages/restPassword/wrong');
                }
            } else {
                $this->login();
            }
        }
    }
    public function resetCheck()
    {
        if ($this->main_model->is_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'user/' . $this->session->userdata('username'));
        } else {
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'is_unique' => '%s مسجل لدينا بالفعل',
                'matches' => 'يجب عليك إدخال %s .',
                'integer' => 'يجب عليك إدخال %s .',
                'valid_email' => 'يجب عليك إدخال %s صحيح.',
            );
            $this->form_validation->set_rules('email', 'البريد الالكتروني', 'required|valid_email', $rul);
            // Check if val. true
            if ($this->form_validation->run() == true) {
                $email = strip_tags($this->input->post('email'));
                $records = $this->main_model->getByData('users', 'email', $email);
                if ($records == true) {
                    $now = new DateTime();
                    $now->setTimezone(new DateTimezone('Africa/Cairo'));
                    $dateNow = (array) $now;
                    // Declare and define two dates
                    $currentDTime = explode('.', $dateNow['date']);
                    $random_code = $this->main_model->random_number();
                    $this->main_model->deleteData('users_activation', 'u_id', $records[0]->id);
                    $this->main_model->insertData('users_activation', array(
                        'u_id' => $records[0]->id,
                        'code' => $random_code,
                        'state' => 1,
                        'time' => $currentDTime[0],
                    ));
                    // Here I`ll Send the message.
                    // Multiple recipients
                    $to = strip_tags($this->input->post('email')); // note the comma

                    // Subject
                    $subject = 'استعادة كلمة السر | موقع استشارة';

                    $message = $this->main_model->template();
                    $txtTags = array('SystemBaseUrl', 'SystemUserName', 'SystemTitle', 'SystemDescription');
                    $title = 'لقد تم طلب استعادة كلمة سر حسابك ... اتبع الرابط التالي لتغيير كلمة السر:';
                    $description = '<a href="' . base_url() . 'pages/repass/' . $random_code . '" target="_blank">' . base_url() . 'pages/repass/' . $random_code . '</a>';
                    $txtValues = array(base_url(), $records[0]->username, $title, $description);
                    $message = str_replace($txtTags, $txtValues, $message);
                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('admin@istsharh.com', 'منصة استشارة');
                    $this->email->to(strip_tags($this->input->post('email')));
                    $this->email->cc('admin@istsharh.com');
                    $this->email->bcc('admin@istsharh.com');

                    $this->email->subject($subject);
                    $this->email->message($message);

                    // Mail it
                    $this->email->send();
                    redirect(base_url() . 'pages/restPassword/done');
                } else {
                    redirect(base_url() . 'pages/restPassword/wrong');
                }
            } else {
                $this->login();
            }
        }
    }
    public function login()
    {
        if ($this->main_model->is_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'user/' . $this->session->userdata('username'));
        } else {
            $data['title'] = 'دخول في موقع استشارة - موقع استشارة';
            // Get login URL
            $data['authURL'] = $this->facebook->login_url();
            /*END FB REGISTER & LOGIN*/
            include_once APPPATH . "libraries/vendor/autoload.php";

            $google_client = new Google_Client();

            $google_client->setClientId('626591971273-nmhlbp8ap19kh7n94rn6i7j2vj3vqq28.apps.googleusercontent.com'); //Define your ClientID

            $google_client->setClientSecret('bd4gwnlSmkQNMtOw6KnNzJAT'); //Define your Client Secret Key

            $google_client->setRedirectUri('https://istsharh.com/istsharh/pages/continueGoogleregistration'); //Define your Redirect Uri

            $google_client->addScope('email');

            $google_client->addScope('profile');
            $login_button = $google_client->createAuthUrl();
            $data['google_button'] = $login_button;
            //echo urldecode($this->uri->segment(2)); Arabic letters Function in url
            $this->load->view('login_view', $data);
        }
    }
    public function loginCheck()
    {
        // Get login URL
        $data['authURL'] = $this->facebook->login_url();
        /*END FB REGISTER & LOGIN*/
        include_once APPPATH . "libraries/vendor/autoload.php";

        $google_client = new Google_Client();

        $google_client->setClientId('626591971273-nmhlbp8ap19kh7n94rn6i7j2vj3vqq28.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('bd4gwnlSmkQNMtOw6KnNzJAT'); //Define your Client Secret Key

        $google_client->setRedirectUri('https://istsharh.com/istsharh/pages/continueGoogleregistration'); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');
        $login_button = $google_client->createAuthUrl();
        $data['google_button'] = $login_button;
        if ($this->main_model->is_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'user/' . $this->session->userdata('username'));
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
                $records = $this->main_model->getByData('users', 'email', $email);
                if ($records == true) {
                    foreach ($records as $row) {
                        $password_f = $row->password;
                        $email_f = $row->email;
                        if ($password == $this->encryption->decrypt($password_f) and $email == $email_f) {
                            $row_arr = (array) $row;
                            $this->session->set_userdata($row_arr);
                            redirect(base_url() . 'user/' . $this->session->userdata('username'));
                        } else {
                            redirect(base_url() . 'pages/login/wrong');
                        }
                    }
                } else {
                    redirect(base_url() . 'pages/login/wrong');
                }
            } else {
                $this->login();
            }
        }
    }
    public function service()
    {
        $data['userviewed'] = $this->viewed;
        if ($this->main_model->is_logged_in()) {
            // Access User Data Securly
            $data['itemUser'] = $userData = $this->main_model->is_logged_in(1)[0];
            $userId = $userData->id;
            $data['title'] = 'تذاكر الدعم الفني - منصة استشارة';
            $config = array();
            $config["base_url"] = base_url() . "pages/service/";

            $config["total_rows"] = $this->main_model->getFullRequest('cdata', '(kind = 3) AND (state = 0) AND (u_id = ' . $userId . ')', 'count');
            $config["per_page"] = 12;
            $config["uri_segment"] = 3;

            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["links"] = $this->pagination->create_links();
            $data['items'] = $this->main_model->getFullRequest('cdata', '(kind = 3) AND (state = 0) AND (u_id = ' . $userId . ') order by id desc', '', $config["per_page"], $page);
            $this->load->view('service_view', $data);
        } else {
            redirect(base_url() . 'login/');
        }
    }
    public function ser()
    {
        $data['userviewed'] = $this->viewed;
        if ($this->main_model->is_logged_in() or $this->main_model->is_admin_logged_in()) {
            $data['title'] = 'مجتمع الأعضاء - منصة استشارة';
            $id = (int) strip_tags($this->uri->segment(3));
            $data['admin'] = false;
            $ifAdmin = '';
            if (!$this->main_model->is_admin_logged_in()) {
                // Access User Data Securly
                $data['itemUser'] = $userData = $this->main_model->is_logged_in(1)[0];
                $userId = $userData->id;
                $ifAdmin = 'AND (u_id = ' . $userId . ')';
            } else {
                $data['admin'] = true;
                $this->main_model->update('cdata', 'co_id', $id, array(
                    'seen' => 1,
                ));
            }
            $data['item'] = $this->main_model->getFullRequest('cdata', '(state = 0) AND (id = ' . $id . ')' . $ifAdmin)[0];
            if (!$data['item']) {
                redirect(base_url() . '404/');
            }
            $data['lastReps'] = $this->main_model->getFullRequest('cdata', '(state = 0) AND (kind = 3)' . $ifAdmin . ' LIMIT 12');
            $data['replies'] = $this->main_model->getFullRequest('cdata', '(state = 1) AND (co_id = ' . $id . ')');
            $this->load->view('ser_view', $data);
        } else {
            redirect(base_url() . 'login/');
        }
    }
    public function community()
    {
        $data['title'] = 'مجتمع الأعضاء - منصة استشارة';
        $config = array();
        $config["base_url"] = base_url() . "pages/community/";

        $config["total_rows"] = $this->main_model->getFullRequest('community', 'state = 0', 'count');
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['items'] = $this->main_model->getAllDataAdv('community', 'id', 'DESC', 'state', 0, $config["per_page"], $page, '', '');
        $data['lastReps'] = $this->main_model->getFullRequest('community', '(state = 1) LIMIT 12');
        $this->load->view('community_view', $data);
    }
    public function comm()
    {
        $data['title'] = 'مجتمع الأعضاء - منصة استشارة';
        $id = (int) strip_tags($this->uri->segment(3));
        $data['item'] = $this->main_model->getFullRequest('community', '(state = 0) AND (id = ' . $id . ')')[0];
        if (!$data['item']) {
            redirect(base_url() . '404/');
        }
        $data['lastReps'] = $this->main_model->getFullRequest('community', '(state = 1) LIMIT 12');
        $data['replies'] = $this->main_model->getFullRequest('community', '(state = 1) AND (co_id = ' . $id . ')');
        $this->load->view('comm_view', $data);
    }
    public function description()
    {
        $data['title'] = 'شرح الموقع - منصة استشارة';
        $this->load->view('choose_view', $data);
    }
    public function descPro()
    {
        $data['title'] = 'شرح الموقع - منصة استشارة';
        $config = array();
        $config["base_url"] = base_url() . "pages/descPro/";

        $config["total_rows"] = $this->main_model->getFullRequest('cdata', 'kind = 1', 'count');
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['items'] = $this->main_model->getAllDataAdv('cdata', 'id', 'DESC', 'kind', 1, $config["per_page"], $page, '', '');
        $this->load->view('description_view', $data);
    }
    public function descGigs()
    {
        $data['title'] = 'شرح الموقع - منصة استشارة';
        $config = array();
        $config["base_url"] = base_url() . "pages/descGigs/";

        $config["total_rows"] = $this->main_model->getFullRequest('cdata', 'kind = 2', 'count');
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['items'] = $this->main_model->getAllDataAdv('cdata', 'id', 'DESC', 'kind', 2, $config["per_page"], $page, '', '');
        $this->load->view('description_view', $data);
    }
    public function desc()
    {
        $data['title'] = 'مجتمع الأعضاء - منصة استشارة';
        $id = (int) strip_tags($this->uri->segment(3));
        $data['item'] = $this->main_model->getFullRequest('cdata', '(state = 0) AND (id = ' . $id . ')')[0];
        if (!$data['item']) {
            redirect(base_url() . '404/');
        }
        $data['lastReps'] = $this->main_model->getFullRequest('cdata', '(kind = ' . $data['item']->kind . ') LIMIT 12');
        $this->load->view('desc_view', $data);
    }
    public function register()
    {
        if ($this->main_model->is_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'user/' . $this->session->userdata('username'));
        } else {
            $data['title'] = 'تسجيل حساب جديد في موقع استشارة - موقع استشارة';
            // Get login URL
            $data['authURL'] = $this->facebook->login_url();
            /*END FB REGISTER & LOGIN*/
            include_once APPPATH . "libraries/vendor/autoload.php";

            $google_client = new Google_Client();

            $google_client->setClientId('626591971273-nmhlbp8ap19kh7n94rn6i7j2vj3vqq28.apps.googleusercontent.com'); //Define your ClientID

            $google_client->setClientSecret('bd4gwnlSmkQNMtOw6KnNzJAT'); //Define your Client Secret Key

            $google_client->setRedirectUri('https://istsharh.com/istsharh/pages/continueGoogleregistration'); //Define your Redirect Uri

            $google_client->addScope('email');

            $google_client->addScope('profile');
            $login_button = $google_client->createAuthUrl();
            $data['google_button'] = $login_button;
            //echo urldecode($this->uri->segment(2)); Arabic letters Function in url
            $this->load->helper('form');
            $data['countries'] = $this->main_model->getAllData('countries');
            $this->load->view('register_view', $data);
        }
    }
    public function registerCheck()
    {
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Africa/Cairo'));
        $dateNow = (array) $now;
        // Declare and define two dates
        $currentDTime = explode('.', $dateNow['date']);
        if ($this->main_model->is_logged_in()) {
            // Redirect to profile
            redirect(base_url() . 'user/' . $this->session->userdata('username'));
        } else {
            // Get login URL
            $data['authURL'] = $this->facebook->login_url();
            /*END FB REGISTER & LOGIN*/
            include_once APPPATH . "libraries/vendor/autoload.php";

            $google_client = new Google_Client();

            $google_client->setClientId('626591971273-nmhlbp8ap19kh7n94rn6i7j2vj3vqq28.apps.googleusercontent.com'); //Define your ClientID

            $google_client->setClientSecret('bd4gwnlSmkQNMtOw6KnNzJAT'); //Define your Client Secret Key

            $google_client->setRedirectUri('https://istsharh.com/istsharh/pages/continueGoogleregistration'); //Define your Redirect Uri

            $google_client->addScope('email');

            $google_client->addScope('profile');
            $login_button = $google_client->createAuthUrl();
            $data['google_button'] = $login_button;
            /*Form Validation*/
            $rul = array(
                'required' => 'يجب عليك إدخال %s .',
                'is_unique' => '%s مسجل لدينا بالفعل',
                'matches' => 'يجب عليك إدخال %s .',
                'integer' => 'يجب عليك إدخال %s .',
                'valid_email' => 'يجب عليك إدخال %s صحيح.',
                'alpha_numeric' => 'في %s يجب إدخال أرقام وحروف انجليزية فقط',
                'min_length' => 'يجب أن لا يقل {field} عن عدد {param} حروف',
                'numeric' => 'يجب أن يتكون %s من أرقام فقط',
                'alpha' => 'يجب أن يتكون %s من حروف فقط',
            );
            $this->form_validation->set_rules('username', 'اسم المستخدم', 'required|alpha_numeric|is_unique[users.username]|min_length[10]', $rul);
            $this->form_validation->set_rules('email', 'البريد الالكتروني', 'required|valid_email|is_unique[users.email]', $rul);
            $this->form_validation->set_rules('password', 'كلمة السر', 'required|min_length[10]', $rul);
            $this->form_validation->set_rules('passwordConf', 'تأكيد كلمة السر صحيحة', 'required|matches[password]', $rul);
            $this->form_validation->set_rules('firstname', 'الاسم الأول', 'required', $rul);
            $this->form_validation->set_rules('lastname', 'الاسم الاخير / اللقب', 'required', $rul);
            $this->form_validation->set_rules('mobile', 'رقم الهاتف', 'required|numeric', $rul);
            $this->form_validation->set_rules('country', 'الدولة', 'required|alpha', $rul);
            $this->form_validation->set_rules('address', 'العنوان', 'required', $rul);
            $this->form_validation->set_rules('postal', 'الرقم البريدي', 'required', $rul);
            // Check if validation true
            if ($this->form_validation->run() == true) {
                $user = array(
                    'username' => strip_tags($this->input->post('username')),
                    'email' => strip_tags($this->input->post('email')),
                    'password' => $this->encryption->encrypt($this->input->post('password')),
                    'firstname' => strip_tags($this->input->post('firstname')),
                    'lastname' => strip_tags($this->input->post('lastname')),
                    'mobile' => strip_tags($this->input->post('mobile')),
                    'country' => strip_tags($this->input->post('country')),
                    'address' => strip_tags($this->input->post('address')),
                    'postal' => strip_tags($this->input->post('postal')),
                    'rate' => 0,
                    'balance' => 0,
                    'a_balance' => 0,
                    'ads_balance' => 0,
                    'c_balance' => 0,
                    'all_balance' => 0,
                    'ip' => $this->input->ip_address(),
                    'image' => '',
                    'date' => $this->main_model->dateTime('date'),
                    'l_logout' => $this->main_model->dateTime('date') . ' ' . $this->main_model->dateTime('time'),
                    'state' => 0,
                );
                $this->main_model->insertData('users', $user);
                $userd = $this->main_model->getByData('users', 'username', $user['username']);
                $userd2 = (array) $userd[0];
                $this->session->set_userdata($userd2);
                $random_code = $this->main_model->random_number();
                $this->main_model->insertData('users_activation', array(
                    'u_id' => $userd2['id'],
                    'code' => $random_code,
                    'time' => $currentDTime[0],
                ));
                // Here I`ll Send the message.
                // Multiple recipients
                $to = strip_tags($this->input->post('email')); // note the comma

                // Subject
                $subject = 'تأكيد حسابك في موقع استشارة';

                // Message
                $message = $this->main_model->template();
                $txtTags = array('SystemBaseUrl', 'SystemUserName', 'SystemTitle', 'SystemDescription');
                $title = 'شكراً على تسجيلك في موقع استشارة يجب عليك تأكيد حسابك من الرابط التالي:';
                $description = '<a href="' . base_url() . 'activate/' . $random_code . '" target="_blank">' . base_url() . 'activate/' . $random_code . '</a>';
                $txtValues = array(base_url(), strip_tags($this->input->post('username')), $title, $description);
                $message = str_replace($txtTags, $txtValues, $message);

                /*/ To send HTML mail, the Content-type header must be set
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';

                // Additional headers
                $headers[] = 'To: '.strip_tags($this->input->post('username')).' <'.strip_tags($this->input->post('email')).'>';
                $headers[] = 'From: منصة استشارة <admin@istsharh.com>';
                $headers[] = 'Cc: admin@istsharh.com';
                $headers[] = 'Bcc: admin@istsharh.com';

                // Mail it
                mail($to, $subject, $message, implode("\r\n", $headers));*/
                $fromEm = 'admin@istsharh.com';
                $CI = &get_instance();
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
                // Redirect to profile
                redirect(base_url() . 'user/' . $this->session->userdata('username'));
            } else {
                $this->register();
            }
        }
    }
    public function continueFBregistration()
    {
        // Check if user is logged in
        if ($this->facebook->is_authenticated()) {
            /*Start FB REGISTER & LOGIN*/
            $userData = array();
            // Get user facebook profile details
            $fbUser = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = !empty($fbUser['id']) ? $fbUser['id'] : '';
            $userData['firstname'] = !empty($fbUser['first_name']) ? $fbUser['first_name'] : '';
            $userData['lastname'] = !empty($fbUser['last_name']) ? $fbUser['last_name'] : '';
            $userData['email'] = !empty($fbUser['email']) ? $fbUser['email'] : '';
            $userData['image'] = !empty($fbUser['picture']['data']['url']) ? $fbUser['picture']['data']['url'] : '';
            $userData['fb_access_token'] = $this->session->userdata()['fb_access_token'];
            $userData['ip'] = $this->input->ip_address();
            $userData['date'] = $this->main_model->dateTime('date');
            $userData['l_logout'] = $this->main_model->dateTime('date') . ' ' . $this->main_model->dateTime('time');
            $userData['state'] = 1;
            // Insert or update user data
            $userID = $this->main_model->checkUser($userData);
            // Check user data insert or update status
            if (!empty($userID)) {
                $data['userData'] = $userData;
                $this->session->set_userdata('userData', $userData);
                // Get logout URL
                $data['logoutURL'] = $this->facebook->logout_url();
                $data['title'] = 'استشارة | إكمال بيانات الحساب';
                $this->load->helper('form');
                $data['countries'] = $this->main_model->getAllData('countries');
                $userRow = (array) $this->main_model->getByData('users', 'id', $userID)[0];
                $this->session->set_userdata($userRow);
                if ($this->session->userdata('username') == '') {
                    redirect(base_url('users/createUserName'));
                } else {
                    redirect(base_url() . 'user/' . $this->session->userdata('username'));
                }
            } else {
                $data['userData'] = array();
                $this->register();
            }
        } else {
            $this->register();
        }
    }
    public function continueGoogleregistration()
    {
        include_once APPPATH . "libraries/vendor/autoload.php";

        $google_client = new Google_Client();

        $google_client->setClientId('626591971273-nmhlbp8ap19kh7n94rn6i7j2vj3vqq28.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('bd4gwnlSmkQNMtOw6KnNzJAT'); //Define your Client Secret Key

        $google_client->setRedirectUri('https://istsharh.com/istsharh/pages/continueGoogleregistration'); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');
        $login_button = $google_client->createAuthUrl();
        $data['google_button'] = $login_button;
        if (isset($_GET["code"])) {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
            if (!isset($token["error"])) {
                $google_client->setAccessToken($token['access_token']);

                $this->session->set_userdata('access_token', $token['access_token']);

                $google_service = new Google_Service_Oauth2($google_client);

                $data = $google_service->userinfo->get();

                $current_datetime = date('Y-m-d H:i:s');

                // Preparing data for database insertion
                $userData['oauth_provider'] = 'google';
                $userData['oauth_uid'] = $data['id'];
                $userData['firstname'] = $data['givenName'];
                $userData['lastname'] = $data['familyName'];
                $userData['email'] = $data['email'];
                $userData['image'] = $data['picture'];
                $userData['fb_access_token'] = '';
                $userData['ip'] = $this->input->ip_address();
                $userData['date'] = $this->main_model->dateTime('date');
                $userData['l_logout'] = $this->main_model->dateTime('date') . ' ' . $this->main_model->dateTime('time');
                $userData['state'] = 1;
                // Insert or update user data
                $userID = $this->main_model->checkUser($userData);
                // Check user data insert or update status
                if (!empty($userID)) {
                    $data['userData'] = $userData;
                    $this->session->set_userdata('userData', $userData);
                    // Get logout URL
                    $data['logoutURL'] = $this->facebook->logout_url();
                    $data['title'] = 'استشارة | إكمال بيانات الحساب';
                    $this->load->helper('form');
                    $data['countries'] = $this->main_model->getAllData('countries');
                    $userRow = (array) $this->main_model->getByData('users', 'id', $userID)[0];
                    $this->session->set_userdata($userRow);
                    if ($this->session->userdata('username') == '') {
                        redirect(base_url('users/createUserName'));
                    } else {
                        redirect(base_url() . 'user/' . $this->session->userdata('username'));
                    }
                } else {
                    $data['userData'] = array();
                    $this->register();
                }
            } else {
                // Preparing data for database insertion
                $userData['oauth_provider'] = 'google';
                $userData['oauth_uid'] = $data['id'];
                $userData['firstname'] = $data['givenName'];
                $userData['lastname'] = $data['familyName'];
                $userData['email'] = $data['email'];
                $userData['image'] = $data['picture'];
                $userData['fb_access_token'] = '';
                $userData['ip'] = $this->input->ip_address();
                $userData['date'] = $this->main_model->dateTime('date');
                $userData['l_logout'] = $this->main_model->dateTime('date') . ' ' . $this->main_model->dateTime('time');
                $userData['state'] = 1;
                $userData['rate'] = 0;
                $userData['balance'] = 0;
                $userData['a_balance'] = 0;
                $userData['ads_balance'] = 0;
                $userData['c_balance'] = 0;
                $userData['all_balance'] = 0;
                // Insert or update user data
                $userID = $this->main_model->checkUser($userData);
                // Check user data insert or update status
                if (!empty($userID)) {
                    $data['userData'] = $userData;
                    $this->session->set_userdata('userData', $userData);
                    // Get logout URL
                    $data['logoutURL'] = $this->facebook->logout_url();
                    $data['title'] = 'استشارة | إكمال بيانات الحساب';
                    $this->load->helper('form');
                    $data['countries'] = $this->main_model->getAllData('countries');
                    $userRow = (array) $this->main_model->getByData('users', 'id', $userID)[0];
                    $this->session->set_userdata($userRow);
                    if ($this->session->userdata('username') == '') {
                        redirect(base_url('users/createUserName'));
                    } else {
                        redirect(base_url() . 'user/' . $this->session->userdata('username'));
                    }
                } else {
                    $data['userData'] = array();
                    $this->register();
                }
            }
        } else {
            $this->register();
        }
    }
    public function logout()
    {
        if ($this->main_model->is_logged_in()) {
            $l_logout = (array) $this->main_model->is_logged_in(1)[0];
            $this->main_model->update('users', 'id', $l_logout['id'], array(
                'l_logout' => $this->main_model->dateTime('date') . ' ' . $this->main_model->dateTime('time'),
            ));
            $this->session->sess_destroy();
            redirect(base_url());
        } else {
            redirect(base_url());
        }
    }
    public function spage()
    {
        if (is_numeric($this->uri->segment(3))) {
            $data['page'] = $this->main_model->getByData('site_pages', 'id', $this->uri->segment(3));
            if (!$data['page']) {
                redirect(base_url() . '404/');
            }
            $data['title'] = 'صفحة ' . $data['page'][0]->title;
            $this->load->view('include/header', $data);
            $this->load->view('site_page_view', $data);
            $this->load->view('include/footer', $data);
        } else {
            redirect(base_url() . '404/');
        }
    }
    public function blog()
    {
        $data = array();
        $data['title'] = 'مدونة موقع استشارة';
        $config = array();
        $config["base_url"] = base_url() . "pages/blog/";

        $config["total_rows"] = $this->main_model->getFullRequest('items', 'kind = 5', 'count');
        if ($this->uri->segment(3) == '') {
            $config["per_page"] = 12;
        } else {
            $config["per_page"] = 10;
        }
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        $data['AllRecords'] = $this->main_model->getAllDataAdv('items', 'id', 'DESC', 'kind', 5, $config["per_page"], $page, '', '');
        $data['recordsLimited'] = $this->main_model->getAllDataAdv('items', 'id', 'DESC', 'kind', 5, 2); //select 2 posts from DB to Array
        if ($this->uri->segment(3) == '') {
            // The following lines will remove values from the first two indexes.
            unset($data['AllRecords'][0]);
            unset($data['AllRecords'][1]);
            if ($data['recordsLimited']) {
                // This line will re-set the indexes (the above just nullifies the values...) and make a     new array without the original first two slots.
                $data['records'] = array_values($data['AllRecords']);
            } else {
                $data['records'] = 0;
            }
        } else {
            if ($data['recordsLimited']) {
                $data['records'] = array_values($data['AllRecords']);
            } else {
                $data['records'] = 0;
            }
        }
        if ($this->main_model->is_admin_logged_in()) {
            $this->load->view('admin/include/header', $data);
            $this->load->view('blog/main_view', $data);
            $this->load->view('admin/include/footer', $data);
        } else {
            $this->load->view('include/header', $data);
            $this->load->view('blog/main_view', $data);
            $this->load->view('include/footer', $data);
        }

    }
    public function post()
    {
        $data['post'] = $this->main_model->getAllDataCond('items', 'kind', 5, 'id', $this->uri->segment(4));
        $data['title'] = 'استشارة | ' . $data['post'][0]->title;
        if (!$data['post']) {
            redirect(base_url() . '404/');
        }
        $this->load->view('include/header', $data);
        $this->load->view('blog/post_view', $data);
        $this->load->view('include/footer', $data);
    }
    public function sitemap()
    {

        $data['records'] = $this->items_model->getAllData2(); //select urls from DB to Array
        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view("sitemap", $data);
    }
}