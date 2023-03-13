<?php

class Vouchers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    public function savePaymentVoucher() {
        $voucher_code = $this->input->post('voucher_code');
        $payee = $this->input->post('payee');
        $date = $this->input->post('date');
        $paying_via = $this->input->post('paying_via');
        $particulars = $this->input->post('particulars');
        $note = $this->input->post('note');

        // arrays
        $paying_from = $this->input->post('paying_from');
        $paying_for = $this->input->post('paying_for');
        $amount = $this->input->post('amount');
        $img_name = $this->API_m->upload('voucher_img');
        $is_back = 0;
        if ($date < date('m/d/Y')) {
            $is_back = 1;
        }

        $voucherdata = [
            'voucher_type' => 'PAYMENT',
            'voucher_interaction' => $payee,
            'voucher_date' => $date,
            'voucher_paying_via' => $paying_via,
            'voucher_particulars' => $particulars,
            'voucher_created_by' => $this->session->userdata('user')['user_id'],
            'voucher_number' => $voucher_code,
            'voucher_img' => $img_name,
            'is_back' => $is_back,
            'voucher_desc' => $note
        ];

        $vouc_id = $this->API_m->create('voucher', $voucherdata);
        $size = sizeOf($paying_from);
        for ($i = 0; $i < $size; $i++) {
            if (!empty($paying_from[$i])) {
                $voucherHeadsData = [
                    'voucher_id' => $vouc_id,
                    'from_A_H' => $paying_from[$i],
                    'for_A_H' => $paying_for[$i],
                    'amount' => $amount[$i]
                ];
                $this->API_m->create('voucher_heads', $voucherHeadsData);
            }
        }
        redirect('Vouchers/paymentVouchers');
    }

    public function receiptVouchers() {
        $a = $this->API_m->countAllRows('voucher', ['voucher_type' => 'RECEIPT']);
        $result['voucher_no'] = $a + 1;

        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['payable_accounts'] = $this->Vouchers_m->getAllExpenseAccount();
        $result['pay_from'] = $this->Vouchers_m->getAllAssetsAccount();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/receipt_voucher', $result);
        $this->load->view('include/footer');
    }

    public function saveReceiptVoucher() {
        $voucher_code = $this->input->post('voucher_code');
        $payee = $this->input->post('payer');
        $date = $this->input->post('date');
        $paying_via = $this->input->post('receiving_via');
        $particulars = $this->input->post('particulars');
        $note = $this->input->post('note');

        // arrays
        $paying_from = $this->input->post('receive_from');
        $paying_for = $this->input->post('receive_for');
        $amount = $this->input->post('amount');
        $img_name = $this->API_m->upload('voucher_img');
        $is_back = 0;
        if ($date < date('m/d/Y')) {
            $is_back = 1;
        }

        $voucherdata = [
            'voucher_type' => 'RECEIPT',
            'voucher_interaction' => $payee,
            'voucher_date' => $date,
            'voucher_paying_via' => $paying_via,
            'voucher_particulars' => $particulars,
            'voucher_created_by' => $this->session->userdata('user')['user_id'],
            'voucher_number' => $voucher_code,
            'voucher_img' => $img_name,
            'is_back' => $is_back,
            'voucher_desc' => $note
        ];

        $vouc_id = $this->API_m->create('voucher', $voucherdata);
        $size = sizeOf($paying_from);
        for ($i = 0; $i < $size; $i++) {
            if (!empty($paying_from[$i])) {
                $voucherHeadsData = [
                    'voucher_id' => $vouc_id,
                    'from_A_H' => $paying_from[$i],
                    'for_A_H' => $paying_for[$i],
                    'amount' => $amount[$i]
                ];
            $this->API_m->create('voucher_heads', $voucherHeadsData);
            }
        }
        redirect('Vouchers/receiptVoucher');
    }

    public function allVouchers() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['voucher_data'] = $this->API_m->get('voucher');

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/all_voucher', $result);
        $this->load->view('include/footer');
    }

    public function paymentVouchers() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['voucher_data'] = $this->API_m->getAllExpenseVoucher();
        $a = $this->API_m->countAllRows('voucher', ['voucher_type' => 'PAYMENT']); //TO GET LAST INSERTED VOCUHER ID
        $result['voucher_no'] = $a + 1; // TO DISPLAY CURRENT VOUCHER NUMBER
        $result['payable_accounts'] = $this->Vouchers_m->getExpsendVoucherHead();
        $result['pay_from'] = $this->Vouchers_m->getAllAssetsAccount();
        $result['exp_subtypes'] = $this->Accounts_m->get_subtype('4');
        $result['prefix'] = $this->API_m->prefix();
        $result['currency'] = $this->API_m->currentCurrency();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/all_voucher', $result);
        $this->load->view('include/footer');
    }

    public function receiptVoucher() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['voucher_data'] = $this->API_m->singleRecordArray('voucher', ['voucher_type' => 'RECEIPT']);
        $a = $this->API_m->countAllRows('voucher', ['voucher_type' => 'RECEIPT']); //TO GET LAST INSERTED VOCUHER ID
        $result['voucher_no'] = $a + 1; // TO DISPLAY CURRENT VOUCHER NUMBER
        $result['income_subtypes'] = $this->Accounts_m->get_subtype('2');
        $result['payable_accounts'] = $this->Vouchers_m->getReceiptVoucherHead();
        $result['pay_from'] = $this->Vouchers_m->getAllAssetsAccountExIncome();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/all_voucher', $result);
        $this->load->view('include/footer');
    }

    public function transferVoucher() {
        $result['user_info'] = $this->Login_m->activeUserInfo();

        $result['voucher_data'] = $this->API_m->singleRecordArray('voucher', ['voucher_type' => 'TRANSFER']);

        $a = $this->API_m->countAllRows('voucher', ['voucher_type' => 'TRANSFER']); //TO GET LAST INSERTED VOCUHER ID
        $result['voucher_no'] = $a + 1; // TO DISPLAY CURRENT VOUCHER NUMBER


        $result['payable_accounts'] = $this->Vouchers_m->getAllExpenseAccount();
        $result['pay_from'] = $this->Vouchers_m->getAllAssetsAccount();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/all_voucher', $result);
        $this->load->view('include/footer');
    }

    public function saveTransferVoucher() {
        $voucher_code = $this->input->post('voucher_code');
        $payee = $this->input->post('payer');
        $date = $this->input->post('date');
        $paying_via = $this->input->post('receiving_via');
        $particulars = $this->input->post('particulars');
        $note = $this->input->post('note');

        // arrays
        $paying_from = $this->input->post('from');
        $paying_for = $this->input->post('for');
        $amount = $this->input->post('amount');
        $img_name = $this->API_m->upload('voucher_img');
        $is_back = 0;
        if ($date < date('m/d/Y')) {
            $is_back = 1;
        }

        $voucherdata = [
            'voucher_type' => 'TRANSFER',
            'voucher_interaction' => $payee,
            'voucher_date' => $date,
            'voucher_paying_via' => $paying_via,
            'voucher_particulars' => $particulars,
            'voucher_created_by' => $this->session->userdata('user')['user_id'],
            'voucher_number' => $voucher_code,
            'voucher_img' => $img_name,
            'is_back' => $is_back,
            'voucher_desc' => $note
        ];

        $vouc_id = $this->API_m->create('voucher', $voucherdata);
        $size = sizeOf($paying_from);
        for ($i = 0; $i < $size; $i++) {
            if (!empty($paying_from[$i])) {
                $voucherHeadsData = [
                    'voucher_id' => $vouc_id,
                    'from_A_H' => $paying_from[$i],
                    'for_A_H' => $paying_for[$i],
                    'amount' => $amount[$i]
                ];

               $this->API_m->create('voucher_heads', $voucherHeadsData);
            }
        }

        redirect('Vouchers/transferVoucher');
    }

    // this function is used to update payment or receipt voucher
    public function updateVoucher($id) {

        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['single_voucher_information'] = $this->Vouchers_m->getSingleVoucherInformation($id);
        $result['payable_accounts'] = $this->Vouchers_m->getAllExpenseAccount();
        $result['pay_from'] = $this->Vouchers_m->getAllAssetsAccount();
        $result['currency'] = $this->API_m->currentCurrency();
//        print_r($result['single_voucher_information']);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/update_voucher', $result);
        $this->load->view('include/footer');
    }

    // this function is used to update payment or receipt voucher 
    public function updateMultipleVoucher() {
        $voucher_id = $this->input->post('voucher_id');
        $img = $this->input->post('image');
        if ($_FILES['file']['name'] != '') {
            $img_name = $this->API_m->upload('voucher_img');
        } else {
            $img_name = $img;
        }


        $voucher_type = $this->input->post('voucher_type');
        $voucher_code = $this->input->post('voucher_code');
        $payee = $this->input->post('payee'); // payee or payer or transfer by
        $date = $this->input->post('date');
        $paying_via = $this->input->post('paying_via');
        $particulars = $this->input->post('particulars');
        if ($voucher_type == 'RECEIPT') {
            $for = $this->input->post('receive_for');
            $from = $this->input->post('receive_from');
        } else { // for payment voucher and transfer voucher
            $from = $this->input->post('paying_from');
            $for = $this->input->post('paying_for');
        }
        $amount = $this->input->post('amount');

        $note = $this->input->post('note');

        $voucherdata = [
            'voucher_type' => $voucher_type,
            'voucher_interaction' => $payee,
            'voucher_date' => $date,
            'voucher_paying_via' => $paying_via,
            'voucher_particulars' => $particulars,
            'voucher_created_by' => $this->session->userdata('user')['user_id'],
            'voucher_number' => $voucher_code,
            'voucher_img' => $img_name,
            'voucher_desc' => $note
        ];

        $this->API_m->updateRecord('voucher', ['voucher_id' => $voucher_id], $voucherdata);

        $this->API_m->delete('voucher_heads', ['voucher_id' => $voucher_id]); // delete old account head data to upload new
        $size = sizeOf($from);
        for ($i = 0; $i < $size; $i++) {
            if (!empty($from[$i])) {
                $voucherHeadsData = [
                    'voucher_id' => $voucher_id,
                    'from_A_H' => $from[$i],
                    'for_A_H' => $for[$i],
                    'amount' => $amount[$i]
                ];
                $this->API_m->create('voucher_heads', $voucherHeadsData);
            }
        }
        if ($voucher_type == 'RECEIPT') {
            $redirectFunction = 'receiptVoucher';
        } elseif ($voucher_type == 'PAYMENT') {
            $redirectFunction = 'paymentVouchers';
        } else {
            $redirectFunction = 'transferVoucher';
        }
        // redirect('Vouchers/'.$redirectFunction);
        redirect('Vouchers/updateVoucher/' . $voucher_id);
    }

    public function postVoucher($voucher_id) {
        $postingDate = $this->input->post('posting_date');
        $single_voucher_information = $this->Vouchers_m->getSingleVoucherInformation($voucher_id);

        $this->API_m->updateRecord('voucher', ['voucher_id' => $voucher_id], ['voucher_post_date' => $postingDate]);

        foreach ($single_voucher_information as $key => $sing) {

            $voucherId = $sing['voucher']->voucher_id;
            $voucherType = $sing['voucher']->voucher_type;
            $particulars = $sing['voucher']->voucher_particulars;
            foreach ($sing['voucher_heads'] as $heads) {
                $date = DateTime::createFromFormat('m/d/Y', $sing['voucher']->voucher_date);
                $vouch_date = $date->format("Y-m-d");
                if ($voucherType == 'PAYMENT') {
                    $dataGJ_dr = [
                        'general_journal_head' => $heads->for_A_H,
                        'general_journal_debit' => $heads->amount,
                        'general_journal_credit' => '0',
                        'general_journal_particulars' => $particulars,
                        'general_journal_source' => $voucherType,
                        'general_journal_source_id' => $voucherId,
                        'general_journal_date' => $vouch_date,
                        'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                        'general_journal_time' => date('h:i:s')
                    ];
                    $this->API_m->create('general_journal', $dataGJ_dr);

                    $dataGJ_cr = [
                        'general_journal_head' => $heads->from_A_H,
                        'general_journal_debit' => '0',
                        'general_journal_credit' => $heads->amount,
                        'general_journal_particulars' => $particulars,
                        'general_journal_source' => $voucherType,
                        'general_journal_source_id' => $voucherId,
                        'general_journal_date' => $vouch_date,
                        'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                        'general_journal_time' => date('h:i:s')
                    ];
                    $this->API_m->create('general_journal', $dataGJ_cr);
                } elseif ($voucherType == 'RECEIPT' || $voucherType == 'TRANSFER') {
                    $dataGJ_dr = [
                        'general_journal_head' => $heads->from_A_H,
                        'general_journal_debit' => '0',
                        'general_journal_credit' => $heads->amount,
                        'general_journal_particulars' => $particulars,
                        'general_journal_source' => $voucherType,
                        'general_journal_source_id' => $voucherId,
                        'general_journal_date' => $vouch_date,
                        'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                        'general_journal_time' => date('h:i:s')
                    ];
                    $this->API_m->create('general_journal', $dataGJ_dr);

                    $dataGJ_cr = [
                        'general_journal_head' => $heads->for_A_H,
                        'general_journal_debit' => $heads->amount,
                        'general_journal_credit' => '0',
                        'general_journal_particulars' => $particulars,
                        'general_journal_source' => $voucherType,
                        'general_journal_source_id' => $voucherId,
                        'general_journal_date' => $vouch_date,
                        'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                        'general_journal_time' => date('h:i:s')
                    ];
                    $this->API_m->create('general_journal', $dataGJ_cr);
                }
            }
        }
        $this->API_m->updateRecord('voucher', ['voucher_id' => $voucherId], ['post_status' => '1']);
        redirect('Vouchers/updateVoucher/' . $voucherId);
    }

// this function is used to cancel a voucher    
    public function cancelVoucher() {
        $id = $this->input->post('voucher_id');
        $data = [
            'voucher_cancelation_reason' => $this->input->post('reason'),
            'voucher_cancelation_by' => $this->session->userdata('user')['user_id'],
            'voucher_cancelation_date' => date("Y-m-d"),
            'voucher_status' => '1',
        ];
        $this->API_m->updateRecord('voucher', ['voucher_id' => $id], $data);

        redirect('Vouchers/updateVoucher/' . $id);
    }

    public function AddNewExpHead() {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $_POST['coa_created_by'] = $this->session->userdata('user')['user_id'];
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $this->Accounts_m->create('chart_of_account', $_POST);


        redirect('Vouchers/paymentVouchers/');
    }

    public function AddNewIncomeHead() {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $_POST['coa_created_by'] = $this->session->userdata('user')['user_id'];
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $this->Accounts_m->create('chart_of_account', $_POST);


        redirect('Vouchers/receiptVoucher');
    }

    public function expense_report() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        
        $result['total_expense'] = $this->Sales_m->totalExpense();
        $result['expenseAccountHeads'] = $this->Sales_m->expenseAccountHeads();
        $result['getPendingExpense'] = $this->Sales_m->getPendingExpense();
        $result['salaryPaid'] = $this->Sales_m->salaryPaid();
        $result['getExpenseMonthly'] = $this->Sales_m->getExpenseMonthly();
        $result['getSalaryPaidMonthly'] = $this->Sales_m->getSalaryPaidMonthly();
        $result['getTotalExpense'] = $this->Sales_m->getTotalExpense();
        $result['getExpenseYearly'] = $this->Sales_m->getExpenseYearly();
        $result['getSalaryPaidYearly'] = $this->Sales_m->getSalaryPaidYearly();
        $result['currency'] = $this->API_m->currentCurrency();
//        echo '<pre>';print_r($result['getExpenseMonthly']);die;

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/expense_report', $result);
        $this->load->view('include/footer');
    }

    public function postedVouchers() {
        $data = $this->input->post('posting_date');
        if (isset($_POST['vocher_id'])) {
            foreach ($_POST['vocher_id'] as $voucher) {
                $this->postCheckedVoucher($voucher, $data);
            }
        }
        redirect('Vouchers/paymentVouchers');
    }

    public function cancelCheckedVoucher() {
        // this function is used to cancel a voucher    
                $data = [
                    'voucher_cancelation_reason' => $this->input->post('reason'),
                    'voucher_cancelation_by' => $this->session->userdata('user')['user_id'],
                    'voucher_cancelation_date' => date("Y-m-d"),
                    'voucher_status' => '1',
                ];
        if (isset($_POST['vocher_id'])) {
            foreach ($_POST['vocher_id'] as $voucher)
            {
              
                $this->API_m->updateRecord('voucher', ['voucher_id' => $voucher], $data);
            }
        }
        
        redirect('Vouchers/paymentVouchers');
        }

        

    public function postCheckedVoucher($voucher_id, $data) {
        $postingDate = $data;
        $single_voucher_information = $this->Vouchers_m->getSingleVoucherInformation($voucher_id);

        $this->API_m->updateRecord('voucher', ['voucher_id' => $voucher_id], ['voucher_post_date' => $postingDate]);

        foreach ($single_voucher_information as $key => $sing) {

            $voucherId = $sing['voucher']->voucher_id;
            $voucherType = $sing['voucher']->voucher_type;
            $particulars = $sing['voucher']->voucher_particulars;
            foreach ($sing['voucher_heads'] as $heads) {
                $date = DateTime::createFromFormat('m/d/Y', $sing['voucher']->voucher_date);
                $vouch_date = $date->format("Y-m-d");
                if ($voucherType == 'PAYMENT') {
                    $dataGJ_dr = [
                        'general_journal_head' => $heads->for_A_H,
                        'general_journal_debit' => $heads->amount,
                        'general_journal_credit' => '0',
                        'general_journal_particulars' => $particulars,
                        'general_journal_source' => $voucherType,
                        'general_journal_source_id' => $voucherId,
                        'general_journal_date' => $vouch_date,
                        'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                        'general_journal_time' => date('h:i:s')
                    ];
                    $this->API_m->create('general_journal', $dataGJ_dr);

                    $dataGJ_cr = [
                        'general_journal_head' => $heads->from_A_H,
                        'general_journal_debit' => '0',
                        'general_journal_credit' => $heads->amount,
                        'general_journal_particulars' => $particulars,
                        'general_journal_source' => $voucherType,
                        'general_journal_source_id' => $voucherId,
                        'general_journal_date' => $sing['voucher']->voucher_date,
                        'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                        'general_journal_time' => date('h:i:s')
                    ];
                    $this->API_m->create('general_journal', $dataGJ_cr);
                } elseif ($voucherType == 'RECEIPT' || $voucherType == 'TRANSFER') {
                    $dataGJ_dr = [
                        'general_journal_head' => $heads->from_A_H,
                        'general_journal_debit' => '0',
                        'general_journal_credit' => $heads->amount,
                        'general_journal_particulars' => $particulars,
                        'general_journal_source' => $voucherType,
                        'general_journal_source_id' => $voucherId,
                        'general_journal_date' => $sing['voucher']->voucher_date,
                        'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                        'general_journal_time' => date('h:i:s')
                    ];
                    $this->API_m->create('general_journal', $dataGJ_dr);

                    $dataGJ_cr = [
                        'general_journal_head' => $heads->for_A_H,
                        'general_journal_debit' => $heads->amount,
                        'general_journal_credit' => '0',
                        'general_journal_particulars' => $particulars,
                        'general_journal_source' => $voucherType,
                        'general_journal_source_id' => $voucherId,
                        'general_journal_date' => $sing['voucher']->voucher_date,
                        'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                        'general_journal_time' => date('h:i:s')
                    ];
                    $this->API_m->create('general_journal', $dataGJ_cr);
                }
            }
        }
        $this->API_m->updateRecord('voucher', ['voucher_id' => $voucherId], ['post_status' => '1']);
        return true;
    }
    
    public function printableVoucher($id)
    {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
       $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['single_voucher_information'] = $this->Vouchers_m->getSingleVoucherPrintableInformation($id);
        $result['prefix'] = $this->API_m->prefix();
//        echo '<pre>';
//        print_r($result['single_voucher_information']);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('vouchers/printableVoucher', $result);
        $this->load->view('include/footer');   
    }

}
