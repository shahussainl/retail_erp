<?php

class Accommodation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    public function index() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['accommodation'] = $this->Accommodation_m->getAllAccommodationDetail('accommodation');
        $result['categories'] = $this->API_m->singleRecordArray('accommodation_category', ['category_status' => 0]);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/all_accomodation', $result);
        $this->load->view('include/footer');
    }

    public function addAccommodation() {
        $acc_title = $this->input->post('acc_title');
        $acc_size = $this->input->post('acc_size');
        $acc_category = $this->input->post('acc_category');
        $acc_price = $this->input->post('price');
        $data = [
            'title' => $acc_title,
            'accommodation_category' => $acc_category,
            'accommodation_size' => $acc_size,
            'acc_price' => $acc_price,
        ];

        $this->API_m->create('accommodation', $data);

        redirect('Accommodation/index');
    }

    public function updateAccommodation() {
        $accommodation_id = $this->input->post('accommodation_id');
        $acc_title = $this->input->post('acc_title');
        $acc_size = $this->input->post('acc_size');
        $acc_category = $this->input->post('acc_category');
        $price = $this->input->post('price');
        $data = [
            'title' => $acc_title,
            'accommodation_category' => $acc_category,
            'accommodation_size' => $acc_size,
            'acc_price' => $price,
        ];
        $this->API_m->updateRecord('accommodation', ['accommodation_id' => $accommodation_id], $data);

        redirect('Accommodation/index');
    }

    public function trashAccommodation($id) {
        $condition = [
            "accommodation_id" => $id
        ];
        $data = [
            'accommodation_status' => '1'
        ];
        $this->API_m->updateRecord('accommodation', $condition, $data);
        redirect('Accommodation/index');
    }

    public function categories() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['categories'] = $this->API_m->singleRecordArray('accommodation_category', ['category_status' => 0]);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/all_categories', $result);
        $this->load->view('include/footer');
    }

    public function addCategory() {
        $category_name = $this->input->post('category_name');
        $data = [
            'category_name' => $category_name
        ];
        $this->API_m->create('accommodation_category', $data);

        redirect('Accommodation/categories');
    }

    public function updateCategory() {
        $category_id = $this->input->post('category_id');
        $category_name = $this->input->post('category_name');
        $data = [
            'category_name' => $category_name
        ];
        $this->API_m->updateRecord('accommodation_category', ['category_id' => $category_id], $data);
        redirect('Accommodation/categories');
    }

    public function trashCategory($id) {
        $condition = [
            'category_id' => $id,
        ];
        $data = [
            "category_status" => 1
        ];
        $this->API_m->updateRecord('accommodation_category', $condition, $data);
        redirect('Accommodation/categories');
    }

    public function reservation() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['accommodation'] = $this->Accommodation_m->getAllAccommodationDetail('accommodation');

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/reservation', $result);
        $this->load->view('include/footer');
    }

    public function addReservation() {
        $accommodation_id = $this->input->post('accommodation_id');
        $cnic = $this->input->post('cnic');

        $exsist = $this->API_m->singleRecord('users', ['cnic' => $cnic]);
        if ($exsist) {
            $user_id = $exsist->user_id;
        } else {
            $userData = [
                'user_fname' => 'CUSTOMER',
                'user_role' => '2',
                'user_role' => $this->password->hash(1234),
                'cnic' => $cnic
            ];
            $user_id = $this->API_m->create('users', $userData);
        }

        $data = [
            "user_id"=>$user_id,
            "created_by"=> $this->session->userdata('user')['user_id'],
            "accommodation_id"=> $accommodation_id,
            "creation_date"=> date('Y-m-d')
        ];
        $this->API_m->create('reservation',$data);
        redirect('Accommodation/reservation');
    }

}
