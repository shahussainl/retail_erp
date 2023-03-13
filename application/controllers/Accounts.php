<?php

class Accounts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    public function generalJournalVoucherView() {

        $result['currency_symbol']  = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['voucher_data'] = $this->Vouchers_m->getGjAlldata();
        $result['prefix'] = $this->API_m->prefix();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/journal_voucher', $result);
        $this->load->view('include/footer');
    }

    //calender in Gj
    public function calender() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['notes'] = $this->API_m->get('notes');

//        echoprint_r($result['new']);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/calender');
        $this->load->view('include/footer');
    }

    public function chartOfAccounts() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['data'] = $this->Vouchers_m->getAllChartOfAccounts();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/chart_of_accounts', $result);
        $this->load->view('include/footer');
    }

    public function trailBalance() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['currency_symbol']  = $this->Admin_m->getSelectedCurrency();
        $result['data'] = $this->Vouchers_m->getTriBlance();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/trail_balance', $result);
        $this->load->view('include/footer');
    }

    public function paymentSources() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['data'] = $this->Vouchers_m->getAllAssetsAccountExIncome();
        $result['assets'] = $this->Vouchers_m->getSubtypeAssets();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/payment_sources', $result);
        $this->load->view('include/footer');
    }

    public function addNewSource() {
        $coa_name = $this->input->post('coa_name');
        $coa_subtypeid = $this->input->post('coa_subtypeid');
        $coa_desc = $this->input->post('coa_desc');
        $coa_code = $this->input->post('coa_code');
        $data = [
            "coa_name" => $coa_name,
            "coa_subtypeid" => $coa_subtypeid,
            "coa_desc" => $coa_desc,
            "coa_code" => $coa_code,
        ];
        $this->API_m->create('chart_of_account', $data);
        redirect('Accounts/paymentSources');
    }

}

?>