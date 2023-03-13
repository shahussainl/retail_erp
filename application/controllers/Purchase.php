<?php

class Purchase extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Karachi');
    }

    public function index() {
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Purchase_m->getPurchaseNo();
        $result['voucher_no'] = $total_record + 1;
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['pur_vouchers'] = $this->API_m->singleRecordArray('purchase', ('post_status = 0 AND (is_ref =0 OR is_ref IS NULL) AND (purchase_status = 0 OR purchase_status IS Null)'));
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('purchase/all_purchases_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function payable() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Purchase_m->getPurchaseNo();
        $result['voucher_no'] = $total_record + 1;
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['pur_vouchers'] = $this->API_m->singleRecordArray('purchase', ('post_status = 1 AND pur_closing_status = 0  AND (is_ref = 0 OR is_ref is null) AND  ( `purchase_status` = 0 OR `purchase_status` is null)'));

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('purchase/all_purchases_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function referenceBills() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Purchase_m->getPurchaseNo();
        $result['voucher_no'] = $total_record + 1;
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['pur_vouchers'] = $this->API_m->singleRecordArray('purchase', ['post_status' => '1', 'is_ref' => '1', 'pur_closing_status' => '0']);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('purchase/all_purchases_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function paid() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Purchase_m->getPurchaseNo();
        $result['voucher_no'] = $total_record + 1;
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['pur_vouchers'] = $this->API_m->singleRecordArray('purchase', ['purchase_status' => '1']);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('purchase/all_purchases_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function canceled() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Purchase_m->getPurchaseNo();
        $result['voucher_no'] = $total_record + 1;
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['pur_vouchers'] = $this->API_m->singleRecordArray('purchase', ['purchase_status' => '2']);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('purchase/all_purchases_vouchers', $result);
        $this->load->view('include/footer');
    }

    public function add_new() {
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Purchase_m->getPurchaseNo();
        $result['voucher_no'] = $total_record + 1;
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('purchase/add_new', $result);
        $this->load->view('include/footer');
    }

    public function getProductDetail() {
        $value = $this->input->post('value');
        $dbColName = $this->input->post('dbColName');
        $product_detail = $this->Purchase_m->getProductDetail($dbColName, $value);

        echo json_encode($product_detail);
    }

    public function savePurcahseVoucher() {
        $vendor_id = $this->input->post('vendor_id');
        $purchase_da = $this->input->post('purchase_date');
        $date = DateTime::createFromFormat('m/d/Y', $purchase_da);
        $purchase_date = $date->format("Y-m-d");
        $voucher_no = $this->input->post('voucher_no');
        $additional_info = $this->input->post('additional_info');
        $code = $this->input->post('code');
        $prd_id = $this->input->post('prd_id');
        $unit = $this->input->post('unit');
//        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        $paid_amount = $this->input->post('paid_amount');
        $balance = $this->input->post('balance');

        $userExsistance = $this->API_m->singleRecord('users', ['user_id' => $vendor_id]);
        if (!$userExsistance) {
            $userData = [
                'pin_no' => $vendor_id,
                'user_fname' => 'Vendor',
                'user_lname' => 'Supplier',
                'user_role' => '2',
                'user_password' => $this->password->hash(1234),
            ];
            $this->API_m->create('users', $userData);
        }

        $dataPurchase = [
            'purchase_number' => $voucher_no,
            'purchase_date' => $purchase_date,
            'purchase_vendor_id' => $vendor_id,
            'purchase_created_by' => $this->session->userdata('user')['user_id'],
            'purchase_created_date' => date('Y-m-d'),
            'purchase_additional_note' => $additional_info,
        ];

        $purchase_id = $this->API_m->create('purchase', $dataPurchase);
        $size = sizeof($code);

        for ($i = 0; $i < $size; $i++) {
            if (!empty($prd_id[$i])) {
                $dataPurchaseItems = [
                    "puritem_purchase_id" => $purchase_id,
                    "puritem_item_id" => $prd_id[$i],
                    "puritem_qty" => $quantity[$i],
                    "puritem_unit" => $unit[$i],
                    "puritem_price" => $price[$i]
                ];
                $this->API_m->create('purchase_items', $dataPurchaseItems);
                $productRecord = $this->API_m->singleRecord('store_items', ['storeitem_item_id' => $prd_id[$i]]);
               $dataStore = [
                   'storeitem_quantity'     => $quantity[$i],
                   'storeitem_item_id'      => $prd_id[$i],
                   'date'                   => date('Y-m-d'),
                   'status'                 => '+'
               ];
               $this->API_m->create('store_items', $dataStore);
            }
        }

        $dataPurchasePayment = [
            'purpayment_purchase_id' => $purchase_id,
            'purpayment_amount' => $paid_amount,
            'purpayment_date' => date('Y-m-d'),
            'purchasepayment_by' => '1'
        ];
        $this->API_m->create('purchase_payment', $dataPurchasePayment);
        redirect('Purchase/singlePurchaseVoucher/' . $purchase_id);
    }

    public function singlePurchaseVoucher($purchase_id) {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['voucher_data'] = $this->Purchase_m->getSinglePurchaseVoucherDetail($purchase_id);
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('purchase/singlePurchaseVoucher', $result);
        $this->load->view('include/footer');
    }

    public function updatePurcahseVoucher() {
        $purchase_id = $this->input->post('purchase_id'); // main voucher id
        $receive_payment = $this->input->post('receive_payment');

        $vendor_id = $this->input->post('vendor_id');
        $post_status = $this->input->post('post_status');

        $purchase_da = $this->input->post('purchase_date');
        $date = DateTime::createFromFormat('m/d/Y', $purchase_da);
        $purchase_date = $date->format("Y-m-d");

//        $voucher_no = $this->input->post('voucher_no');
        $additional_info = $this->input->post('additional_info');
        $code = $this->input->post('code');
        $prd_id = $this->input->post('prd_id');
        $unit = $this->input->post('unit');
//        $item = $this->input->post('item');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        $paid_amount = $this->input->post('paid_amount');
        $balance = $this->input->post('balance');
        $voucher = $this->API_m->getMaxId('purchase', 'purchase_id');

        $voucher_no = $voucher->purchase_id + 1;

        $account_head = $this->input->post('account_head');
        $particulars = $this->input->post('particulars');

        if ($post_status > 0) {
            $remainingBalance = $balance - $receive_payment;
            if ($remainingBalance == 0) {
                $this->API_m->updateRecord('purchase', ['purchase_id' => $purchase_id], ['pur_closing_status' => '1']); // when the balance left is zero then close the voucher
            }
        }

        if ($post_status > 0) {
            $dataPurchase = [
                'purchase_number' => $voucher_no,
                'purchase_date' => $purchase_date,
                'purchase_vendor_id' => $vendor_id,
                'purchase_created_by' => $this->session->userdata('user')['user_id'],
                'purchase_created_date' => date('Y-m-d'),
                'purchase_additional_note' => $additional_info,
                'pur_ref_id' => $purchase_id,
                'is_ref' => '1',
                'post_status' => '1'
            ];

            $newVoucherId = $this->API_m->create('purchase', $dataPurchase); //create new refrence voucher
        }

        if ($post_status == 0) {   // to update voucher when its not posted
            $dataMainPurchase = [
                'purchase_date' => $purchase_date,
                'purchase_vendor_id' => $vendor_id,
                'purchase_created_by' => $this->session->userdata('user')['user_id'],
                'purchase_created_date' => date('Y-m-d'),
                'purchase_additional_note' => $additional_info,
            ];
            $this->API_m->updateRecord('purchase', ['purchase_id' => $purchase_id], $dataMainPurchase);
        }
        if ($post_status == 0) {
            $this->API_m->delete('purchase_items', ['puritem_purchase_id' => $purchase_id]); //delete old items from the main voucher
        }
        $size = sizeof($prd_id);

        for ($i = 0; $i < $size; $i++) {
            if (!empty($prd_id[$i])) {
                if ($post_status == 0) {
                    $dataPurchaseItemsMain = [
                        "puritem_purchase_id" => $purchase_id,
                        "puritem_item_id" => $prd_id[$i],
                        "puritem_qty" => $quantity[$i],
                        "puritem_unit" => $unit[$i],
                        "puritem_price" => $price[$i]
                    ];
                    $this->API_m->create('purchase_items', $dataPurchaseItemsMain); //add updated items to main voucher
                }
                if ($post_status > 0) {
                    $dataPurchaseItems = [
                        "puritem_purchase_id" => $newVoucherId,
                        "puritem_item_id" => $prd_id[$i],
                        "puritem_qty" => $quantity[$i],
                        "puritem_unit" => $unit[$i],
                        "puritem_price" => $price[$i]
                    ];

                    $this->API_m->create('purchase_items', $dataPurchaseItems); //add items to refrence voucher
                }
                // update item quantity in stock
               $productRecord = $this->API_m->singleRecord('store_items', ['storeitem_item_id' => $prd_id[$i]]);
               $oldQuantity = $productRecord->storeitem_quantity;
               $newQuantity = $oldQuantity + $quantity[$i];
               $dataStore = [
                   'storeitem_quantity'     => $newQuantity,
                   'storeitem_updated_date' => date('Y-m-d')
               ];
               $this->API_m->updateRecord('store_items', ['storeitem_item_id' => $prd_id[$i]], $dataStore);
            }
        }

        if ($post_status == 1) {
            $dataGJ_dr = [
                'general_journal_head' => '7',
                'general_journal_debit' => $receive_payment,
                'general_journal_credit' => '0',
                'general_journal_particulars' => $particulars,
                'general_journal_source' => 'PURCHASE',
                'general_journal_source_id' => $newVoucherId,
                'general_journal_date' => date("Y-m-d"),
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_dr);

            $dataGJ_cr = [
                'general_journal_head' => $account_head,
                'general_journal_debit' => '0',
                'general_journal_credit' => $receive_payment,
                'general_journal_particulars' => $particulars,
                'general_journal_source' => 'PURCHASE',
                'general_journal_source_id' => $newVoucherId,
                'general_journal_date' => date("Y-m-d"),
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_cr);
        }
        if ($post_status > 0) {
            // create payment history
            $dataPurchasePayment = [
                'pur_ref_id' => $newVoucherId,
                'purpayment_purchase_id' => $purchase_id,
                'purpayment_amount' => $receive_payment,
                'purpayment_date' => date('Y-m-d'),
                'purchasepayment_by' => '1'
            ];

            $this->API_m->create('purchase_payment', $dataPurchasePayment);
        }
        redirect('Purchase/singlePurchaseVoucher/' . $purchase_id);
    }

    public function deletePurchaseVoucher() {
        $dataStore = [
            'purchase_status' => '1',
            'cancel_reason' => $this->input->post('reason'),
            'cancel_by' => $this->session->userdata('user')['user_id'],
            'cancelation_date' => date('Y-m-d'),
        ];

        $this->API_m->updateRecord('purchase', ['purchase_id' => $this->input->post('purcahse_id')], $dataStore);

        redirect('Purchase/singlePurchaseVoucher/' . $this->input->post('purcahse_id'));
    }

    public function postPurcahseVoucher() {
        if ($this->input->post('liability') == 0) {
            $data = [
                'post_status' => 1,
                'pur_closing_status' => 1,
            ];
        } else {
            $data = [
                'post_status' => 1,
            ];
        }
        $this->API_m->updateRecord('purchase', ['purchase_id' => $this->input->post('purcahse_id')], $data);

        $dataGJ_dr = [
            'general_journal_head' => '16',
            'general_journal_debit' => $this->input->post('purcahse'),
            'general_journal_credit' => '0',
            'general_journal_particulars' => $this->input->post('particulars'),
            'general_journal_source' => 'PURCHASE',
            'general_journal_source_id' => $this->input->post('purcahse_id'),
            'general_journal_date' => date("Y-m-d"),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr);

        $dataGJ_cr = [
            'general_journal_head' => $this->input->post('account_head'),
            'general_journal_debit' => '0',
            'general_journal_credit' => $this->input->post('paid'),
            'general_journal_particulars' => $this->input->post('particulars'),
            'general_journal_source' => 'PURCHASE',
            'general_journal_source_id' => $this->input->post('purcahse_id'),
            'general_journal_date' => date("Y-m-d"),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr);

        $dataGJ_cr2 = [
            'general_journal_head' => '7',
            'general_journal_debit' => '0',
            'general_journal_credit' => $this->input->post('liability'),
            'general_journal_particulars' => $this->input->post('particulars'),
            'general_journal_source' => 'PURCHASE',
            'general_journal_source_id' => $this->input->post('purcahse_id'),
            'general_journal_date' => date("Y-m-d"),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr2);

        redirect('Purchase/singlePurchaseVoucher/' . $this->input->post('purcahse_id'));
    }

// ************* Purchase Section  <Usman Code>

    public function NewPurchase() {
        // $result['table_id']     = $id;
        // print_r($id);
        // print_r($_POST);
        // exit();
        // ************ Sale
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        // $result['taxes']            = $this->API_m->get('tax');
        $result['sal_vouchers'] = $this->API_m->singleRecordArray('sales', ['sales_status' => '0', 'post_status' => '0', 'is_ref' => null, 'is_invoice' => 0]);
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();
        //**************./sales
        $v_role_id = 2;
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['vendors'] = $this->Purchase_m->getRecordWhere('users', ['user_role' => $v_role_id]);
        $result['products'] = $this->Purchase_m->getProCate();
        // $result['orderTypes']   = $this->PointOfSale_m->get('pos_order_type');
        // $result['pos_tax']      = $this->PointOfSale_m->get('pos_tax');
        // $result['allOrders']    = $this->PointOfSale_m->get('pos');
        // $result['cartItems']    = $this->cart->contents();
        //  echo "<pre>";
        // print_r($result);
        // exit();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('purchase/NewPurchase', $result);
        $this->load->view('include/footer');
    }

    public function getProducts() {
        $value = $this->input->post('value');
        $dbColName = $this->input->post('dbColName');
        $product_detail = $this->Purchase_m->getProductDet($dbColName, $value);

        echo json_encode($product_detail);
    }

    public function getVendors() {
        // print_r($this->input->post('vendor_id'));
        $v_id = $this->input->post('vendor_id');
        $vendorDetails = $this->Purchase_m->single('users', ['user_id' => $v_id]);
        // print_r($vendorDetails);
        echo json_encode($vendorDetails);
    }

    public function CreatePurchase($status_id) {
        date_default_timezone_set('Asia/Karachi');
        // echo "<pre>";
        // print_r($_POST);
        // print_r($status_id);
        // exit();
        // $prd_id = $this->input->post('prd_id');
        // echo '<pre>';print_r($this->input->post());die();exit();
        // echo "<pre>";
        // print_r($prd_id);
        // echo "<br>";
        // print_r(sizeOf($prd_id));
        // exit();
        $vendor_id = '';


        if (empty($this->input->post('purchase_vendor_id'))) {
            $UserData = array(
                'user_fname' => $this->input->post('user_fname'),
                'user_contact' => $this->input->post('user_contact'),
                'user_address' => $this->input->post('user_address'),
                'user_role' => '2'
            );
            // echo "<pre>";
            // print_r($UserData);
            // exit();
            $vendor_id = $this->Purchase_m->create('users', $UserData);
        } else {
            $vendor_id = $this->input->post('purchase_vendor_id');
        }

        // echo "<pre>";
        // print_r($vendor_id);
        // exit();


        $purchase_vendor_id = $vendor_id;
        $bill_total = $this->input->post('bill_total');
        $additional_info = $this->input->post('additional_info');
        $code = $this->input->post('code');
        $prd_id = $this->input->post('prd_id');
        $unit = $this->input->post('unit');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        $paid_amount = $this->input->post('paid_amount');
        //$balance = $this->input->post('balance');
        $pur_status = $status_id;
        $is_close = 0;

        if (($bill_total - $paid_amount) == 0) {
            $is_close = 1;
            $pur_status = 1;
        }

        $total_record = $this->Purchase_m->getPurchaseNo();


        $dataPos = array(
            'purchase_vendor_id' => $purchase_vendor_id,
            'purchase_number' => $total_record + 1,
            'purchase_created_by' => $this->session->userdata('user')['user_id'],
            'purchase_date' => date('Y-m-d H:i:s'),
            'purchase_created_date' => date('Y-m-d H:i:s'),
            'purchase_additional_note' => $additional_info,
            'purchase_bill_total' => $bill_total,
            'is_purchase_close' => $is_close,
            'purchase_status' => $pur_status
        );
        $purchase_id = $this->Purchase_m->create('purchase', $dataPos);

        $mypayment = [
            'purpayment_purchase_id' => $purchase_id,
            'purpayment_amount' => $paid_amount,
            'purpayment_date' => date('Y-m-d'),
            'purchasepayment_by' => $this->session->userdata('user')['user_id'],
        ];

        if ($paid_amount != '0.00') {
            $this->API_m->create('purchase_payment', $mypayment);
        }
//        print_r($mypayment);
//        die;
        // echo "<pre>";
        // print_r($purchase_id);
        // exit();
        for ($key = 0; $key < sizeof($prd_id); $key++) {



            $dataPurchaseItems = array(
                "puritem_purchase_id" => $purchase_id,
                "puritem_item_id" => $prd_id[$key],
                "puritem_qty" => $quantity[$key],
                "puritem_unit" => $unit[$key],
                "puritem_price" => $price[$key],
                "puritem_date" => date('Y-m-d H:i:s'),
                "puritem_status" => '1'
            );

            if ($prd_id[$key] != 0) {
                $this->Purchase_m->create('purchase_items', $dataPurchaseItems);

//                if(($bill_total - $paid_amount) == 0)
//                {
//                    $dataStore = [
//                     'storeitem_quantity' => $quantity[$key],
//                     'storeitem_item_id' => $prd_id[$key], 
//                     'date' => date('Y-m-d'),
//                     'status' => '+'
//                    ];
//                
//                $this->API_m->create('store_items', $dataStore); 
//                }
            }
        }
        if ($status_id == 1) {

            $dataGJ_dr3 = [
                'general_journal_head' => '16',
                'general_journal_debit' => $bill_total,
                'general_journal_credit' => '0',
                'general_journal_particulars' => '',
                'general_journal_source' => 'purchase POS',
                'general_journal_source_id' => $purchase_id,
                'general_journal_date' => date('Y-m-d'),
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_dr3);

            $dataGJ_cr3 = [
                'general_journal_head' => '1',
                'general_journal_debit' => '0',
                'general_journal_credit' => $bill_total,
                'general_journal_particulars' => '',
                'general_journal_source' => 'purchase POS',
                'general_journal_source_id' => $purchase_id,
                'general_journal_date' => date('Y-m-d'),
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_cr3);
        }

        if ($pur_status == '0') {
            redirect('Purchase/PurchasePartialPaidBills');
        } else {
            redirect('Purchase/PurchasePaidBills');
        }
    }

    public function addToStock() {
        $stock_date = $this->input->post('stock_date');
        $purchase_id = $this->input->post('purchase_id');

        $stock_date = date('Y-m-d', strtotime($stock_date));

        $this->API_m->updateRecord('purchase',['purchase_id' =>$purchase_id],['is_stock' => '1','stock_date'=>$stock_date]);
        $items = $this->API_m->singleRecordArray('purchase_items', ['puritem_purchase_id' => $purchase_id]);
        foreach ($items as $itm) {
            $dataStore = [
                'storeitem_quantity' => $itm->puritem_qty,
                'storeitem_item_id' => $itm->puritem_item_id,
                'date' => $stock_date,
                'status' => '+'
            ];

            $this->API_m->create('store_items', $dataStore);
        }

        redirect('Purchase/PurchasePaidBills');
    }
    public function canceledBillsView() {
        date_default_timezone_set('Asia/Karachi');
        // $today = date('Y-m-d');
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['PaidBills'] = $this->Purchase_m->getCancelBills();
        $result['prefix'] = $this->API_m->prefix();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('Purchase/cancelBills', $result);
        $this->load->view('include/footer');
    }
    public function PurchasePaidBills() {
        date_default_timezone_set('Asia/Karachi');
        // $today = date('Y-m-d');
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['PaidBills'] = $this->Purchase_m->getPaidBills();
        $result['prefix'] = $this->API_m->prefix();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('Purchase/PurchasePaidBills', $result);
        $this->load->view('include/footer');
    }

    public function PurchasePartialPaidBills() {
        date_default_timezone_set('Asia/Karachi');
        // $today = date('Y-m-d');
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['PartialsBills'] = $this->Purchase_m->getPartialBills();
        $result['prefix'] = $this->API_m->prefix();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('Purchase/PurchasePartialPaidBill', $result);
        $this->load->view('include/footer');
    }

    public function SinglePurchaseView($id) {
        // echo "<pre>";
        // print_r($id);
        // exit();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        // $result['orderTypes']    = $this->PointOfSale_m->get('pos_order_type');
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['prefix'] = $this->API_m->prefix();
        $result['record'] = $this->API_m->get_last_Rec('settings');
        $result['purchase_data'] = $this->Purchase_m->getSinglePosDetails($id);
        $result['products'] = $this->Purchase_m->getProCate();
        $result['payments'] = $this->API_m->singleRecordArray('purchase_payment', ['purpayment_purchase_id' => $id]);
        $result['paidAmount'] = $this->API_m->getSinglePurchaseAmount($id);

        $v_role_id = 2;
        $result['vendors'] = $this->Purchase_m->getRecordWhere('users', ['user_role' => $v_role_id]);
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('Purchase/SinglePurchaseView', $result);
        $this->load->view('include/footer');
    }
    
    public function SinglePurchasePrint($id) {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        // $result['orderTypes']    = $this->PointOfSale_m->get('pos_order_type');
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['prefix'] = $this->API_m->prefix();
        $result['record'] = $this->API_m->get_last_Rec('settings');
        $result['purchase_data'] = $this->Purchase_m->getSinglePosDetails($id);
        $result['products'] = $this->Purchase_m->getProCate();
        $result['payments'] = $this->API_m->singleRecordArray('purchase_payment', ['purpayment_purchase_id' => $id]);
        $result['paidAmount'] = $this->API_m->getSinglePurchaseAmount($id);

        $v_role_id = 2;
        $result['vendors'] = $this->Purchase_m->getRecordWhere('users', ['user_role' => $v_role_id]);
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('Purchase/print_purchase', $result);
        $this->load->view('include/footer');
    }

    public function PostPurchase($status_id) {
        date_default_timezone_set('Asia/Karachi');

        $bill_total = $this->input->post('bill_total');
        $paid_amount = $this->input->post('paid_amount');


        $purchase_status = $status_id;
        $purchase_id = $_POST['purchase_id'];
        $this->API_m->updateRecord('purchase', ['purchase_id' => $purchase_id], ['purchase_paid_amount' => $paid_amount]);

//         echo "<pre>";
//         print_r($bill_total);
//        // echo $purchase_id;
//         exit();

        $PostPurchase = array(
            'purchase_status' => $purchase_status
        );

        $dataGJ_dr3 = [
            'general_journal_head' => '16',
            'general_journal_debit' => $bill_total,
            'general_journal_credit' => '0',
            'general_journal_particulars' => '',
            'general_journal_source' => 'purchase POS',
            'general_journal_source_id' => $purchase_id,
            'general_journal_date' => date('Y-m-d'),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr3);

        $dataGJ_cr3 = [
            'general_journal_head' => '1',
            'general_journal_debit' => '0',
            'general_journal_credit' => $bill_total,
            'general_journal_particulars' => '',
            'general_journal_source' => 'purchase POS',
            'general_journal_source_id' => $purchase_id,
            'general_journal_date' => date('Y-m-d'),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr3);

        $this->Purchase_m->update('purchase', ['purchase_id' => $purchase_id], $PostPurchase);
        redirect('Purchase/PurchasePaidBills');
    }

    public function CancelPurchase($status_id) {
        date_default_timezone_set('Asia/Karachi');
        $purchase_status = $status_id;
        $purchase_id = $this->input->post('purchase_id');
        $cancelReason = $this->input->post('Cancelreason');
        $cancel_by = $this->session->userdata('user')['user_id'];

        // echo "<pre>";
        // print_r($purchase_id);
        // echo "<br>";
        // echo $purchase_status;
        // echo "<br>";
        // echo $cancelReason;
        // echo "<br>";
        // echo $cancel_by;
        // exit();
        $CancelPurchase = array(
            'purchase_status' => $purchase_status,
            'cancel_by' => $cancel_by,
            'cancel_reason' => $cancelReason,
            'cancelation_date' => date('Y-m-d H:i:s')
        );

        $this->Purchase_m->update('purchase', ['purchase_id' => $purchase_id], $CancelPurchase);
        redirect('Purchase/PurchasePaidBills');
    }

    public function UpdatePurchase() {
        date_default_timezone_set('Asia/Karachi');
        // $pos_id                = $this->input->post('pos_id');
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $purchase_vendor_id = $this->input->post('purchase_vendor_id');

        $purchase_id = $this->input->post('purchase_id');
        $bill_total = $this->input->post('bill_total');
        $additional_info = $this->input->post('additional_info');
        $code = $this->input->post('code');
        $prd_id = $this->input->post('prd_id');
        $unit = $this->input->post('unit');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        //$paid_amount = $this->input->post('paid_amount');
        //$balance = $this->input->post('balance');
        $pur_status = '0';


        // *** update pos table data

        $dataPos = array(
            'purchase_created_by' => $this->session->userdata('user')['user_id'],
            'purchase_date' => date('Y-m-d H:i:s'),
            'purchase_created_date' => date('Y-m-d H:i:s'),
            'purchase_additional_note' => $additional_info,
            'purchase_bill_total' => $bill_total,
            //'purchase_balance' => $balance,
            // 'purchase_paid_amount' => $paid_amount,
            'purchase_status' => $pur_status
        );

        $this->Purchase_m->update('purchase', ['purchase_id' => $purchase_id], $dataPos);


        // *** delete Purchase items old record
        $this->Purchase_m->delete('purchase_items', ['puritem_purchase_id' => $purchase_id]);

        // **** Insert new pos items record
        for ($key = 0; $key < sizeof($prd_id); $key++) {


            if (!empty($prd_id[$key])) {
                $dataPurchaseItems = array(
                    "puritem_purchase_id" => $purchase_id,
                    "puritem_item_id" => $prd_id[$key],
                    "puritem_qty" => $quantity[$key],
                    "puritem_unit" => $unit[$key],
                    "puritem_price" => $price[$key],
                    "puritem_date" => date('Y-m-d H:i:s'),
                    "puritem_status" => '1'
                );


                $this->Purchase_m->create('purchase_items', $dataPurchaseItems);
            }
        }


        redirect('Purchase/SinglePurchaseView/' . $purchase_id);
    }

    public function installment_payment($purchase_id) {
        $is_close = 0;
        $is_post = 0;
        $remaining = $this->input->post('remain_blance') - $this->input->post('payment');

        if ($remaining == 0) {
            $is_close = 1;
            $is_post = 1;

//            $purchase_product = $this->db->where('puritem_purchase_id', $purchase_id)->get('purchase_items')->result();
//            foreach ($purchase_product as $purItem):
//                $productRecord = $this->API_m->singleRecord('store_items', ['storeitem_item_id' => $purItem->puritem_item_id]);
//                $oldQuantity = $productRecord->storeitem_quantity;
////                $dataStore = [
////                    'storeitem_quantity' => $purItem->puritem_qty,
////                    'storeitem_item_id' => $purItem->puritem_item_id,
////                    'date' => date('Y-m-d'),
////                    'status' => '+'
////                ];
////
////                $this->API_m->create('store_items', $dataStore);
//            endforeach;
        }
        $purchase = array(
            'is_purchase_close' => $is_close,
            'purchase_status' => $is_post,
        );

        $this->Purchase_m->update('purchase', ['purchase_id' => $purchase_id], $purchase);

        $mypayment = [
            'purpayment_purchase_id' => $purchase_id,
            'purpayment_amount' => $this->input->post('payment'),
            'purpayment_date' => date('Y-m-d'),
            'purchasepayment_by' => $this->session->userdata('user')['user_id'],
        ];

        $this->API_m->create('purchase_payment', $mypayment);

        $dataGJ_dr3 = [
            'general_journal_head' => '16',
            'general_journal_debit' => $this->input->post('payment'),
            'general_journal_credit' => '0',
            'general_journal_particulars' => '',
            'general_journal_source' => 'purchase POS',
            'general_journal_source_id' => $purchase_id,
            'general_journal_date' => date('Y-m-d'),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr3);

        $dataGJ_cr3 = [
            'general_journal_head' => '1',
            'general_journal_debit' => '0',
            'general_journal_credit' => $this->input->post('payment'),
            'general_journal_particulars' => '',
            'general_journal_source' => 'purchase POS',
            'general_journal_source_id' => $purchase_id,
            'general_journal_date' => date('Y-m-d'),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr3);

        redirect('Purchase/SinglePurchaseView/' . $purchase_id);
    }

    public function deletePurchaseItem() {
        echo json_encode($this->API_m->delete('purchase_items', ['puritem_id' => $this->input->post('id')]));
    }

}

?>