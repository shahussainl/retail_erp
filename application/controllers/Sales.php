<?php

class Sales extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    public function index() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        $result['taxes'] = $this->API_m->get('tax');
        $result['sal_vouchers'] = $this->API_m->singleRecordArray('sales', ['sales_status' => '0', 'post_status' => '0', 'is_ref' => null, 'is_invoice' => 0]);
        $result['all_sale_vouchers'] = $this->Sales_m->all_sale_vouchers();
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();
        $result['products'] = $this->API_m->singleRecordArray('product', ('prd_is_sale = 1 AND (prd_status=0  OR prd_status IS NULL)'));
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/all_sale_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function add_new() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $a = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_no'] = $a + 1;


        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        $result['taxes'] = $this->API_m->get('tax');
        $result['sal_vouchers'] = $this->API_m->singleRecordArray('sales', ['sales_status' => '0', 'post_status' => '0', 'is_ref' => null, 'is_invoice' => 0]);
        $result['all_sale_vouchers'] = $this->Sales_m->all_sale_vouchers();
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();
        $result['products'] = $this->API_m->singleRecordArray('product', ('prd_is_sale = 1 AND (prd_status=0  OR prd_status IS NULL)'));
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/add_new', $result);
        $this->load->view('include/footer');
    }

    public function invoices() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        $result['taxes'] = $this->API_m->get('tax');
        $result['sal_vouchers'] = $this->API_m->singleRecordArray('sales', ('post_status = 0 AND is_invoice = 1 AND sales_status != 1  AND sale_closing_status != "1" and (is_ref = 0 OR is_ref IS Null)'));
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/all_sale_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function partialInvoices() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        $result['taxes'] = $this->API_m->get('tax');
        $result['sal_vouchers'] = $this->API_m->singleRecordArray('sales', ('post_status = 1 AND sales_status != 1  AND sale_closing_status != "1" and (is_ref = 0 OR is_ref IS Null)'));
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/all_sale_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function closed() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        $result['taxes'] = $this->API_m->get('tax');
        $result['sal_vouchers'] = $this->API_m->singleRecordArray('sales', ('sale_closing_status = 1 AND sales_status = 0 OR sales_status IS Null'));
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/all_sale_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function receipts() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        $result['taxes'] = $this->API_m->get('tax');
        $result['rec_vouchers'] = $this->Sales_m->receipt_vouchers('receipt');
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/all_reciept_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function reciptVoucher($id) {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $recipt_voucher_id = $id;
        $result['recipt_data'] = $this->API_m->singleRecord('receipt', ['rec_id' => $recipt_voucher_id]);

        $mainVoucher_id = $result['recipt_data']->inv_id;
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['voucher_data'] = $this->Sales_m->getSingleSaleVoucherDetail($mainVoucher_id);
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();
        // echo '<pre>';print_r($result);die();
        $result['taxes'] = $this->API_m->get('tax');
        $result['prefix'] = $this->API_m->prefix();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/singleSaleReciptVoucher', $result);
        $this->load->view('include/footer');
    }

    public function canceled() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        $result['taxes'] = $this->API_m->get('tax');
        $result['all_sale_vouchers'] = $this->Sales_m->sale_vouchers_condition(['sales_status' => '1']);
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/all_sale_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function getProductDetail() {
        $value = $this->input->post('value');
        $dbColName = $this->input->post('dbColName');
        $product_detail = $this->Sales_m->getProductDetail($dbColName, $value);

        echo json_encode($product_detail);
    }

    public function saveSalesVoucher() {

        $item = $this->input->post('item');
//         echo '<pre>';print_r($this->input->post());die();exit();


        $vendor_id = $this->input->post('vendor_id');
        $sales_da = $this->input->post('sales_date');
        $sales_date = date("Y-m-d", strtotime($sales_da));
        $voucher_no = $this->input->post('voucher_no');
        $bill_total = $this->input->post('bill_total');
        $discounted_price = $this->input->post('discounted_price');
        $discount_off = $this->input->post('discountOff');
        $discount_value = $this->input->post('discount_value');
        $discount_type = strtoupper($this->input->post('discountType'));
        $additional_info = $this->input->post('additional_info');
        $code = $this->input->post('code');
        $prd_id = $this->input->post('prd_id');
        $unit = $this->input->post('unit');
        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $discountValue = $this->input->post('discount_value');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        $paid_amount = $this->input->post('paid_amount');
        $balance = $this->input->post('balance');

        $invoce_type = $this->input->post('type');
        $is_invoice = '0';
        $is_backed = '0';
        $post_status = '0';
        $posting_date = '';
        $receive_amt = '0';
        $account_head = '0';
        $particulars = '0';
        $myCustomeStatus = 0;

        if ($invoce_type == 1) {
            $is_invoice = '0';
        } elseif ($invoce_type == 2) {
            $is_invoice = '1';


            $dataProject = [
                "project_name" => $this->input->post('customer_full_name') . " Project",
                "deal" => $sub_total,
            ];

            $this->API_m->create('projects', $dataProject);
        } elseif ($invoce_type == 3) {
            $dataProject = [
                "project_name" => $this->input->post('customer_full_name') . " Project",
                "deal" => $sub_total,
            ];

            $this->API_m->create('projects', $dataProject);
            $is_invoice = '1';
            $myCustomeStatus = 1;
            $posting_date = date("Y-m-d", strtotime($this->input->post('posting_date')));
            $receive_amt = $this->input->post('receive_amt');
            $account_head = $this->input->post('account_head');
            $particulars = $this->input->post('particulars');
            $post_status = '1';
            $balance = $bill_total - $receive_amt;
        }

        $sale_closing_status = 0;


        if ($sales_date < date('Y-m-d')) {
            $is_backed = '1';
        }

        $taxes_value = $this->input->post('taxes_value');
        // print_r(sizeof($taxes_value));die();
        $taxes_type = $this->input->post('taxes_type');
        $taxes_title = $this->input->post('taxes_title');
        $taxes_on = $this->input->post('taxes_on');

        $userExsistance = $this->API_m->singleRecord('users', ['user_id' => $vendor_id]);
        if (!$userExsistance) {
            $userData = [
                'pin_no' => $vendor_id,
                'user_fname' => $this->input->post('customer_full_name'),
                'user_address' => $this->input->post('customer_address'),
                'user_contact' => $this->input->post('customer_contact'),
                'user_lname' => ' ',
                'user_role' => '3',
                'user_password' => $this->password->hash(1234),
            ];
            $this->API_m->create('users', $userData);
        }

        $dataSales = [
            'sales_number' => $voucher_no,
            'sales_date' => $sales_date,
            'sales_vendor_id' => $vendor_id,
            'sales_created_by' => $this->session->userdata('user')['user_id'],
            'sales_created_date' => date('Y-m-d'),
            'sales_additional_note' => $additional_info,
            'sales_bill_total' => $bill_total,
            'sales_discounted_price' => $discounted_price,
            'sales_discount_off' => $discount_off,
            'sales_discount_value' => $discount_value,
            'sales_discount_type' => $discount_type,
            'is_invoice' => $is_invoice,
            'is_backed' => $is_backed,
            'post_status' => $post_status,
            'posted_date' => $posting_date,
            'sale_closing_status' => $sale_closing_status
        ];

        $sales_id = $this->API_m->create('sales', $dataSales);

        for ($key = 0; $key < sizeof($item); $key++) {


            if (!empty($prd_id[$key])) {

                $dataSalesItems = [
                    "salitem_sales_id" => $sales_id,
                    "salitem_item_id" => $prd_id[$key],
                    "salitem_qty" => $quantity[$key],
                    "salitem_unit" => $unit[$key],
                    "salitem_price" => $price[$key],
                    "discount_price" => ''
                ];


                for ($i = 0; $i < sizeof($taxes_value); $i++) {

                    if ($taxes_value[$i] != 0) {

                        $taxamount = [
                            'sales_item_id' => $sales_id,
                            'tax_name' => $taxes_title[$i],
                            'tax_value' => $taxes_value[$i],
                            'tax_type' => strtoupper($taxes_type[$i]),
                            'tax_on' => $taxes_on[$i]
                        ];

                        $this->API_m->create('tax_amount', $taxamount);
                    }
                }

                $sales_item_id = $this->API_m->create('sales_items', $dataSalesItems);
                if ($myCustomeStatus == 1):
                    $dataStore = [
                        'storeitem_item_id' => $item[$key]['prd_id'],
                        'storeitem_quantity' => $item[$key]['quantity'],
                        'date' => date('Y-m-d'),
                        'status' => '-'
                    ];
                    $this->API_m->create('store_items', $dataStore);
                endif;
            }
        }


        if ($invoce_type != 1 && $invoce_type != 2) {

            $close = $balance - $paid_amount;
            if ($close == 0) {
                $this->API_m->updateRecord('sales', ['sales_id' => $sales_id], ['sale_closing_status' => '1']);
            }
            $dataSales = [
                'inv_id' => $sales_id,
                'rec_date' => $sales_date,
                'created_by' => $this->session->userdata('user')['user_id'],
                'created_date' => $posting_date,
                'rec_amount' => $receive_amt,
            ];

            $reciptNum = $this->API_m->create('receipt', $dataSales);

            $dataSalesPayment = [
                'salpayment_sales_id' => $sales_id,
                'salpayment_amount' => $receive_amt,
                'salpayment_date' => $posting_date,
                'salpayment_by' => $this->session->userdata('user')['user_id'],
            ];
            $this->API_m->create('sales_payment', $dataSalesPayment);

            $dataGJ_cr = [
                'general_journal_head' => '8',
                'general_journal_debit' => '0',
                'general_journal_credit' => $sub_total,
                'general_journal_particulars' => $particulars,
                'general_journal_source' => 'SALE',
                'general_journal_source_id' => $reciptNum,
                'general_journal_date' => $posting_date,
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_cr);

            $tax_payable = $bill_total - $discounted_price;
            $dataGJ_cr2 = [
                'general_journal_head' => '5',
                'general_journal_debit' => '0',
                'general_journal_credit' => $tax_payable,
                'general_journal_particulars' => $particulars,
                'general_journal_source' => 'SALE',
                'general_journal_source_id' => $reciptNum,
                'general_journal_date' => $posting_date,
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_cr2);

            $dataGJ_dr = [
                'general_journal_head' => $account_head,
                'general_journal_debit' => $receive_amt,
                'general_journal_credit' => '0',
                'general_journal_particulars' => $particulars,
                'general_journal_source' => 'SALE',
                'general_journal_source_id' => $reciptNum,
                'general_journal_date' => $posting_date,
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_dr);

            $dataGJ_dr2 = [
                'general_journal_head' => '13',
                'general_journal_debit' => $balance - $paid_amount,
                'general_journal_credit' => '0',
                'general_journal_particulars' => $particulars,
                'general_journal_source' => 'SALE',
                'general_journal_source_id' => $reciptNum,
                'general_journal_date' => $posting_date,
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];

            $this->API_m->create('general_journal', $dataGJ_dr2);

            $discount_allowed = $sub_total - $discounted_price;
            $dataGJ_dr3 = [
                'general_journal_head' => '10',
                'general_journal_debit' => $discount_allowed,
                'general_journal_credit' => '0',
                'general_journal_particulars' => $particulars,
                'general_journal_source' => 'SALE',
                'general_journal_source_id' => $reciptNum,
                'general_journal_date' => $posting_date,
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_dr3);
        }
        redirect('Sales/singleSaleVoucher/' . $sales_id);
    }

    public function updateSalesVoucherData() {

        //die;
        $sales_id = $this->input->post('sales_id');
        $account_head = $this->input->post('account_head');
        $particulars = $this->input->post('particulars');

        $item = $this->input->post('item');
        // echo '<pre>';print_r($item);die();



        $post_status = $this->input->post('post_status');
        $sales_payment_id = $this->input->post('sales_payment_id');
        $vendor_id = $this->input->post('vendor_id');
        $sales_da = $this->input->post('sales_date');
        $date = DateTime::createFromFormat('m/d/Y', $sales_da);
        $sales_date = $date->format("Y-m-d");
        $voucher_no = $this->input->post('voucher_no');
        $bill_total = $this->input->post('bill_total');
        $discounted_price = $this->input->post('discounted_price');
        $discount_off = $this->input->post('discountOff');
        $discount_value = $this->input->post('discount_value');
        $discount_type = strtoupper($this->input->post('discountType'));

        $discount_flat_check = strtoupper($this->input->post('discount_flat_check'));
        $discount_percent_check = strtoupper($this->input->post('discount_percent_check'));




        $additional_info = $this->input->post('additional_info');
        $code = $this->input->post('code');
        $salitem_id = $this->input->post('salitem_id');
        $prd_id = $this->input->post('prd_id');
        $unit = $this->input->post('unit');
        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $discountValue = $this->input->post('discount_value');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        $paid_amount = $this->input->post('paid_amount');
        $balance = $this->input->post('balance');
        $pay = $this->input->post('receive_payment');


        $taxes_value = $this->input->post('taxes_value');
        // print_r(sizeof($taxes_value));die();
        $taxes_type = $this->input->post('taxes_type');
        $taxes_title = $this->input->post('taxes_title');
        $taxes_on = $this->input->post('taxes_on');

        if ($post_status > 0) {
            $remainingBalance = $balance - $pay;
            if ($remainingBalance == 0) {
                $this->API_m->updateRecord('sales', ['sales_id' => $sales_id], ['sale_closing_status' => '1']); // when the balance left is zero then close the voucher
            }
        }


        if ($post_status == 0) {
            $dataSalesMain = [
                'sales_number' => $voucher_no,
                'sales_date' => $sales_date,
                'sales_vendor_id' => $vendor_id,
                'sales_created_by' => $this->session->userdata('user')['user_id'],
                'sales_created_date' => date('Y-m-d'),
                'sales_additional_note' => $additional_info,
                'sales_bill_total' => $bill_total,
                'sales_discounted_price' => $discounted_price,
                'sales_discount_off' => $discount_off,
                'sales_discount_value' => $discount_value,
                'sales_discount_type' => $discount_type,
                'is_ref' => '',
                'sal_ref_id' => '',
            ];
            $this->API_m->updateRecord('sales', ['sales_id' => $sales_id], $dataSalesMain);
        }
        if ($post_status > 0) {
            $da = $this->input->post('payment_in');
            $date0 = DateTime::createFromFormat('m/d/Y', $da);
            $sales_date = $date0->format("Y-m-d");
        }
        if ($post_status > 0) {
            $dataSales = [
                'inv_id' => $voucher_no,
                'rec_date' => $sales_date,
                'created_by' => $this->session->userdata('user')['user_id'],
                'created_date' => date('Y-m-d'),
                'rec_amount' => $pay,
            ];

            $reciptNum = $this->API_m->create('receipt', $dataSales);
        }
        if ($post_status == 0) {
            $this->API_m->delete('sales_items', ['salitem_sales_id' => $sales_id]);
        }
        for ($key = 0; $key <= sizeof($prd_id); $key++) {
            if (!empty($prd_id[$key])) {
                if ($post_status == 0) {
                    $dataSalesItemsMain = [
                        "salitem_sales_id" => $sales_id,
                        "salitem_item_id" => $prd_id[$key],
                        "salitem_qty" => $quantity[$key],
                        "salitem_unit" => $unit[$key],
                        "salitem_price" => $price[$key],
                        "discount_price" => $price[$key],
                    ];
                    $this->API_m->create('sales_items', $dataSalesItemsMain);
                }


//                echo '<pre>';print_r($dataSalesItems);print_r($dataSalesItemsMain);
            }
        }
//                 die();
        if ($post_status == 0) {
            $this->API_m->delete('tax_amount', ['sales_item_id' => $sales_id]);
            for ($i = 0; $i < sizeof($taxes_value); $i++) {

                if ($taxes_value[$i] != 0) {
                    $taxamount = [
                        'sales_item_id' => $sales_id, //this is sale voucher id not sale item id
                        'tax_name' => $taxes_title[$i],
                        'tax_value' => $taxes_value[$i],
                        'tax_type' => strtoupper($taxes_type[$i]),
                        'tax_on' => $taxes_on[$i]
                    ];

                    $this->API_m->create('tax_amount', $taxamount);
                }
            }
        }

        if ($post_status > 0) {
            $dataGJ_dr = [
                'general_journal_head' => $account_head,
                'general_journal_debit' => $pay,
                'general_journal_credit' => '0',
                'general_journal_particulars' => $particulars,
                'general_journal_source' => 'SALE',
                'general_journal_source_id' => $reciptNum,
                'general_journal_date' => $sales_date,
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_dr);

            $dataGJ_cr = [
                'general_journal_head' => '13',
                'general_journal_debit' => '0',
                'general_journal_credit' => $pay,
                'general_journal_particulars' => $particulars,
                'general_journal_source' => 'SALE',
                'general_journal_source_id' => $reciptNum,
                'general_journal_date' => $sales_date,
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_cr);
        }

        if ($post_status > 0) {
            $dataSalesPayment = [
                'salpayment_sales_id' => $sales_id,
                'salpayment_amount' => $pay,
                'salpayment_date' => $sales_date,
                'salpayment_by' => '1',
                'sal_ref_id' => $reciptNum,
            ];
            $this->API_m->create('sales_payment', $dataSalesPayment);
        }

//        echo '<pre>';
//        print_r($dataSales);
//        print_r($dataSalesItems);
//        print_r($dataStore);
//        print_r($taxamount );
//        print_r($dataSalesPayment);
//        die();
        redirect('Sales/singleSaleVoucher/' . $sales_id);
    }

    public function singleSaleVoucher($id) {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['voucher_data'] = $this->Sales_m->getSingleSaleVoucherDetail($id);
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();
        // echo '<pre>';print_r($result);die();
        $result['products'] = $this->API_m->singleRecordArray('product', ('prd_is_sale = 1 AND (prd_status=0  OR prd_status IS NULL)'));
        $result['taxes'] = $this->API_m->get('tax');
        $result['prefix'] = $this->API_m->prefix();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/updateSingleSaleVoucher', $result);
        $this->load->view('include/footer');
    }

    public function updateSalesVoucher() {
        $purchase_id = $this->input->post('purchase_id');
        $receive_payment = $this->input->post('receive_payment');

        $dataPurchasePayment = [
            'salpayment_sales_id' => $purchase_id,
            'salpayment_amount' => $receive_payment,
            'salpayment_date' => date('Y-m-d'),
            'salpayment_by' => '1'
        ];

        $this->API_m->create('sales_payment', $dataPurchasePayment);
        redirect('Sales/singleSaleVoucher/' . $purchase_id);
    }

    public function deleteSaleVoucher() {
        $id = $this->input->post('sale_id');
        $dataStore = [
            'sales_status' => '1',
            'cancel_reason' => $this->input->post('reason'),
            'cancel_by' => $this->session->userdata('user')['user_id'],
            'cancelation_date' => date('Y-m-d'),
        ];

        $this->API_m->updateRecord('sales', ['sales_id' => $id], $dataStore);

        redirect('Sales/singleSaleVoucher/' . $id);
    }

    public function postSaleVoucher() {
        $sales_id = $this->input->post('sales_id');
        $sales_amt = $this->input->post('sales_amt');
        $paid = $this->input->post('paid');
        $account_receivable = $this->input->post('account_receivable');
        $discount_allowed = $this->input->post('discount_allowed');
        $tax_payable = $this->input->post('tax_payable');
        $account_head = $this->input->post('account_head');
        $particulars = $this->input->post('particulars');
        $posting_date = $this->input->post('posting_date');
        $voucher_date = $this->input->post('voucher_date');

        $p_date = date("Y-m-d", strtotime($posting_date));

        $v_date = date("Y-m-d", strtotime($voucher_date));
        $account_receivable = $account_receivable - $paid;

        $a = $this->API_m->singleRecord('sales', ['sales_id' => $sales_id]);

        if ($a->is_invoice == '0') {
            $dataProject = [
                "project_name" => $this->input->post('customer_full_name') . " Project",
                "deal" => $sub_total,
            ];

            $this->API_m->create('projects', $dataProject);
        }

        if ($account_receivable == 0) {


            $data = [
                'post_status' => 1,
                'sale_closing_status' => 1,
                'posted_date' => $p_date,
            ];
        } else {
            $data = [
                'post_status' => 1,
                'posted_date' => $p_date,
            ];
        }

        $this->API_m->updateRecord('sales', ['sales_id' => $sales_id], $data);

        //store items
        $sales_items = $this->db->where('salitem_sales_id', $sales_id)->get('sales_items')->result();

        foreach ($sales_items as $item) {
            $dataStore = [
                'storeitem_item_id' => $item->salitem_item_id,
                'storeitem_quantity' => $item->salitem_qty,
                'date' => date('Y-m-d'),
                'status' => '-'
            ];
            $this->API_m->create('store_items', $dataStore);
        }
        // end store 

        $dataSales = [
            'inv_id' => $sales_id,
            'rec_date' => $v_date,
            'created_by' => $this->session->userdata('user')['user_id'],
            'created_date' => $p_date,
            'rec_amount' => $paid,
        ];

        $reciptNum = $this->API_m->create('receipt', $dataSales);

        $dataSalesPayment = [
            'salpayment_sales_id' => $sales_id,
            'salpayment_amount' => $paid,
            'salpayment_date' => $p_date,
            'salpayment_by' => '1',
            'sal_ref_id' => $reciptNum,
        ];
        $this->API_m->create('sales_payment', $dataSalesPayment);


        $dataGJ_cr = [
            'general_journal_head' => '8',
            'general_journal_debit' => '0',
            'general_journal_credit' => $sales_amt,
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr);

        $dataGJ_cr2 = [
            'general_journal_head' => '5',
            'general_journal_debit' => '0',
            'general_journal_credit' => $tax_payable,
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr2);

        $dataGJ_dr = [
            'general_journal_head' => $account_head,
            'general_journal_debit' => $paid,
            'general_journal_credit' => '0',
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr);

        $dataGJ_dr2 = [
            'general_journal_head' => '13',
            'general_journal_debit' => $account_receivable,
            'general_journal_credit' => '0',
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr2);

        $dataGJ_dr3 = [
            'general_journal_head' => '10',
            'general_journal_debit' => $discount_allowed,
            'general_journal_credit' => '0',
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr3);


        redirect('Sales/singleSaleVoucher/' . $sales_id);
    }

    function changeStatusToInvoice($id,$userName) {
        $dataProject = [
            "project_name" => $userName . " Project",
            
        ];
        $this->API_m->create('projects', $dataProject);
        
        
        $data = [
            'is_invoice' => '1'
        ];
        $this->API_m->updateRecord('sales', ['sales_id' => $id], $data);

        redirect('Sales/singleSaleVoucher/' . $id);
    }

    public function report() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['total_sales'] = $this->Sales_m->getTotalSales();
        $result['discount_allowed'] = $this->Sales_m->getTotalDiscountAllowed();
        $result['sales_receivable'] = $this->Sales_m->getTotalSaleReceivable();
        $result['closed_inv'] = $this->API_m->countAllRows('sales', ['sale_closing_status' => '1']);
        $result['open_inv'] = $this->API_m->countAllRows('sales', 'post_status = 1 AND sales_status != 1  AND sale_closing_status != "1" and (is_ref = 0 OR is_ref IS Null)');
        $result['open_inv_balance'] = $this->Sales_m->getOpenInvBalance();
        $result['getClosedInvBalance'] = $this->Sales_m->getClosedInvBalance();
        $result['open_inv_detail'] = $this->Sales_m->getOpenInvDetails();
        $result['monthlySalesAvg'] = $this->Sales_m->monthlySalesAvg();
        $result['disc_monthly'] = $this->Sales_m->monthlyDiscountAvg();
        $result['disc_yearly'] = $this->Sales_m->yearlyDiscountAvg();
        $result['sale_yearly'] = $this->Sales_m->yearlySalesAvg();
        $result['monthlyRevenueAvg'] = $this->Sales_m->monthlyRevenueAvg();
        $result['yearlyRevenueAvg'] = $this->Sales_m->yearlyRevenueAvg();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/report', $result);
        $this->load->view('include/footer');
    }

    public function print_bill($id) {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['salesInfo'] = $this->API_m->getSalePrint($id);
        $result['prefix'] = $this->API_m->prefix();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('sales/printSalesBill', $result);
        $this->load->view('include/footer');
    }

    public function cancelCheckSales() {
        $dataStore = [
            'sales_status' => '1',
            'cancel_reason' => $this->input->post('reason'),
            'cancel_by' => $this->session->userdata('user')['user_id'],
            'cancelation_date' => date('Y-m-d'),
        ];
        if (isset($_POST['sale_id'])) {
            foreach ($_POST['sale_id'] as $sale_id) {
                $this->API_m->updateRecord('sales', ['sales_id' => $sale_id], $dataStore);
            }
        }
        redirect('Sales/index');
    }

    public function changeCheckSalesStatus() {
        $data = [
            'is_invoice' => '1'
        ];
        if (isset($_POST['sale_id'])) {
            foreach ($_POST['sale_id'] as $sale_id) {
                $this->API_m->updateRecord('sales', ['sales_id' => $sale_id], $data);
            }
        }

        redirect('Sales/index');
    }

    public function makeInvoice($sale_id) {
        $data = [
            'is_invoice' => '1'
        ];

        $this->API_m->updateRecord('sales', ['sales_id' => $sale_id], $data);
        redirect('Sales/index');
    }

    public function cancelSingleReport() {
        $dataStore = [
            'sales_status' => '1',
            'cancel_reason' => $this->input->post('reason'),
            'cancel_by' => $this->session->userdata('user')['user_id'],
            'cancelation_date' => date('Y-m-d'),
        ];

        $this->API_m->updateRecord('sales', ['sales_id' => $this->input->post('id')], $dataStore);
        redirect('Sales/index');
    }

    public function postSaleVoucherInvoice() {

        $sales_id = $this->input->post('sales_id');
        $sale_order = $this->API_m->singleRecord('sales', ['sales_id' => $sales_id]);
        $taxAmount = 0;
        $subTotal = 0;
        $sale_order_items = $this->API_m->singleRecordArray('sales_items', ['salitem_sales_id' => $sales_id]);
        if (!empty($sale_order_items)) {
            foreach ($sale_order_items as $itm) {
                $subTotal = $subTotal + ($itm->salitem_price * $itm->salitem_qty);
            }
        }
        $sale_order_tax = $this->API_m->singleRecordArray('tax_amount', ['sales_item_id' => $sales_id]);
        if (!empty($sale_order_tax)) {
            foreach ($sale_order_tax as $tx) {
                if ($tx->tax_type == '%') {
                    $taxAmount = $taxAmount + ($subTotal / 100 * $tx->tax_on);
                } else {
                    $taxAmount = $taxAmount + $tx->tax_on;
                }
            }
        }

        $sales_amt = $sale_order->sales_bill_total;
        $paid = 0;
        if (!empty($this->input->post('paid'))) {
            $paid = $this->input->post('paid');
        }
        $account_receivable = $sale_order->sales_bill_total - $paid;
        $discount_allowed = $sale_order->sales_discounted_price;
        $tax_payable = $taxAmount;

        $account_head = $this->input->post('account_head');
        $particulars = $this->input->post('particulars');
        $posting_date = $this->input->post('posting_date');
        $voucher_date = $sale_order->sales_date;


        $date = DateTime::createFromFormat('m/d/Y', $posting_date);
        $p_date = $date->format("Y-m-d");

//        $date2 = DateTime::createFromFormat('m/d/Y', $voucher_date);
        $v_date = $voucher_date;

        if ($account_receivable == 0) {
            $data = [
                'post_status' => 1,
                'sale_closing_status' => 1,
                'posted_date' => $p_date,
            ];
        } else {
            $data = [
                'post_status' => 1,
                'posted_date' => $p_date,
            ];
        }

        $this->API_m->updateRecord('sales', ['sales_id' => $sales_id], $data);

        $dataSales = [
            'inv_id' => $sales_id,
            'rec_date' => $v_date,
            'created_by' => $this->session->userdata('user')['user_id'],
            'created_date' => $p_date,
            'rec_amount' => $paid,
        ];

        $reciptNum = $this->API_m->create('receipt', $dataSales);

        $dataSalesPayment = [
            'salpayment_sales_id' => $sales_id,
            'salpayment_amount' => $paid,
            'salpayment_date' => $p_date,
            'salpayment_by' => '1',
            'sal_ref_id' => $reciptNum,
        ];
        $this->API_m->create('sales_payment', $dataSalesPayment);


        $dataGJ_cr = [
            'general_journal_head' => '8',
            'general_journal_debit' => '0',
            'general_journal_credit' => $sales_amt,
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr);

        $dataGJ_cr2 = [
            'general_journal_head' => '5',
            'general_journal_debit' => '0',
            'general_journal_credit' => $tax_payable,
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr2);

        $dataGJ_dr = [
            'general_journal_head' => $account_head,
            'general_journal_debit' => $paid,
            'general_journal_credit' => '0',
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr);

        $dataGJ_dr2 = [
            'general_journal_head' => '13',
            'general_journal_debit' => $account_receivable - $paid,
            'general_journal_credit' => '0',
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr2);

        $dataGJ_dr3 = [
            'general_journal_head' => '10',
            'general_journal_debit' => $discount_allowed,
            'general_journal_credit' => '0',
            'general_journal_particulars' => $particulars,
            'general_journal_source' => 'SALE',
            'general_journal_source_id' => $sales_id,
            'general_journal_date' => $p_date,
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr3);

        redirect('Sales/index');
    }

    public function getUserDetail() {
        $user_id = $this->input->post('user_id');
        $userData = $this->API_m->singleRecord('users', ['user_id' => $user_id]);
        echo json_encode($userData);
    }

}
