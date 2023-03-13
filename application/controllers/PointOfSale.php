<?php

class PointOfSale extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    // public function index()
    // {
    //     $status_id = 1;
    //     $result['user_info']    = $this->Login_m->activeUserInfo();
    //     $result['tables']       = $this->PointOfSale_m->get('pos_assignment'); 
    //     $result['tbl_status']   = $this->PointOfSale_m->getRecordByRow('pos',['pos_status'=>$status_id]); 
    //     $this->load->view('include/header', $result);
    //     $this->load->view('include/sidebar');
    //     $this->load->view('PointOfSale/index',$result);
    //     $this->load->view('include/footer');
    // }

    public function PointSale() {
        // $result['table_id']     = $id;
        // print_r($id);
        // print_r($_POST);
        // exit();
        // ************ Sale
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        $result['taxes'] = $this->API_m->get('tax');
        $result['sal_vouchers'] = $this->API_m->singleRecordArray('sales', ['sales_status' => '0', 'post_status' => '0', 'is_ref' => null, 'is_invoice' => 0]);
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();
        //**************./sales
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['products'] = $this->PointOfSale_m->getProCate();
        // $result['orderTypes']   = $this->PointOfSale_m->get('pos_order_type');
        // $result['pos_tax']      = $this->PointOfSale_m->get('pos_tax');
        // $result['allOrders']    = $this->PointOfSale_m->get('pos');
        // $result['cartItems']    = $this->cart->contents();
        //  echo "<pre>";
        // print_r($result);
        // exit();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('PointOfSale/PointSale', $result);
        $this->load->view('include/footer');
    }

    // public function posPlaceOrder()
    // {
    //    $item = $this->input->post('item');
    //    echo '<pre>';print_r($this->input->post());die();exit();
    //    // $tax_id = array();
    //    $tax_id= array();
    //    // echo "<pre>";
    //    // print_r($_POST['pos_tax_value']);       
    //   if(!empty($_POST['pos_tax_value']))
    //   {
    //      $tax_id = $_POST['pos_tax_value'];
    //    // print_r($_POST['pos_tax_value']);       
    //   }
    //   date_default_timezone_set('Asia/Karachi'); 
    // 	$itms = $_POST['itm'];
    //  //   echo "<pre>";
    // 	// print_r($itms);
    // 	// exit();
    // 	$insertPOS = array(
    //            'pos_created_by'     => $this->session->userdata('user')['user_id'],
    //            'pos_fullname'       => $this->input->post('pos_fullname'),
    //            'pos_contact'        => $this->input->post('pos_contact'),
    //            'order_type_id'      => 3,
    //            // 'pos_assign_id'      => $this->input->post('table_id'),
    //            'pos_discount_type'  => $this->input->post('discount_price'),
    //            'pos_discount_price' => $this->input->post('discountPrice'),
    //            'pos_grand_total'    => $this->input->post('grand_total'),
    //            'pos_address'        => $this->input->post('pos_address'),
    //            'pos_date'		     => date('Y-m-d')
    // 	      );
    //        // echo "<pre>";
    //        // print_r($insertPOS);
    //        // exit();
    // 	$pos = $this->PointOfSale_m->create('pos',$insertPOS);
    //    if($pos)
    //    {
    //       foreach($tax_id as $key)
    //       {
    //            $tax_res = $this->PointOfSale_m->getByRow('pos_tax',['pos_tax_value'=>$key]);    
    //         $tax_data = 
    //                   array(
    //                    'pos_id'        => $pos,
    //                    'pos_tax_id'    => $tax_res['pos_tax_id'],
    //                    'pos_tax_type'  => $tax_res['pos_tax_type'],
    //                    'pos_tax_value' => $tax_res['pos_tax_value']
    //                     );
    //            $this->PointOfSale_m->create('order_tax',$tax_data);
    //       }
    //    }
    // 	if($pos)
    // 	{
    // 		foreach($itms as $itm)
    //  	{
    //  		// echo $value['qty'].'<br>';
    //  		$data = array(
    //           'pos_id'  		=> $pos,
    //           'prd_id'  		=> $itm['prd_id'],
    //           'pos_prd_price'   => $itm['prd_price'],
    //           'pos_prd_qty'     => $itm['qty'],
    //           'pos_items_date'  => date('Y-m-d')
    //       );
    //  		$insert = $this->PointOfSale_m->create('pos_items',$data);
    //  	}
    //  $this->cart->destroy();		
    // 	}
    //    redirect('PointOfSale/TodaySale');
    // }
// ********* PointOfSale functions

    public function getProductDetail() {
        $value = $this->input->post('value');
        $dbColName = $this->input->post('dbColName');
        $product_detail = $this->PointOfSale_m->getProductDetail($dbColName, $value);

        echo json_encode($product_detail);
    }

    public function CreateOrder($status_id) {

        date_default_timezone_set('Asia/Karachi');

        $bill_total = $this->input->post('bill_total');
        $discounted_price = $this->input->post('discounted_price');
        $discount_off = $this->input->post('discountOff');
        $discount_value = $this->input->post('discountValue');
        $discount_type = strtoupper($this->input->post('discountType'));
        $additional_info = $this->input->post('additional_info');
        $code = $this->input->post('code');
        $prd_id = $this->input->post('prd_id');
        $unit = $this->input->post('unit');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        $paid_amount = $this->input->post('paid_amount');
        $balance = $this->input->post('balance');
        $taxes_value = $this->input->post('taxes_value');
        $taxes_type = $this->input->post('taxes_type');
        $taxes_title = $this->input->post('taxes_title');
        $taxes_on = $this->input->post('taxes_on');
        $pos_status = $status_id;
        $totalTax = $bill_total - $discounted_price;
        $discount_allowed = $sub_total - $discounted_price;
        $dataPos = array(
            'pos_created_by' => $this->session->userdata('user')['user_id'],
            'pos_date' => date('Y-m-d H:i:s'),
            'pos_additional_note' => $additional_info,
            'pos_bill_total' => $bill_total,
            'pos_discount_price' => $discounted_price,
            'pos_discounted_off' => $discount_off,
            'pos_discount_value' => $discount_value,
            'pos_discount_type' => $discount_type,
            'pos_balance' => $balance,
            'pos_paid_amount' => $paid_amount,
            'pos_status' => $pos_status
        );
        $pos_id = $this->PointOfSale_m->create('pos', $dataPos);

        // echo "<pre>";
        // print_r($pos_id);
        // exit();
        for ($key = 0; $key < sizeof($prd_id); $key++) {



            $dataPosItems = array(
                "pos_id" => $pos_id,
                "prd_id" => $prd_id[$key],
                "pos_prd_qty" => $quantity[$key],
                "pos_item_unit" => $unit[$key],
                "pos_prd_price" => $price[$key],
                "pos_items_date" => date('Y-m-d')
            );

            if ($prd_id[$key] != 0) {
                $pos_item_id = $this->PointOfSale_m->create('pos_items', $dataPosItems);
                if($status_id == 1 || $balance == 0):
                $dataStore = [
                    'storeitem_item_id' => $prd_id[$key],
                    'storeitem_quantity' => $quantity[$key],
                    'date' => date('Y-m-d'),
                    'status' => '-'
                ];
                $this->API_m->create('store_items', $dataStore);
                endif;
            }
        }
        for ($i = 0; $i < sizeof($taxes_value); $i++) {

            if ($taxes_value[$i] != 0) {

                $taxamount = array(
                    'pos_id' => $pos_id,
                    'pos_tax_title' => $taxes_title[$i],
                    'pos_tax_value' => $taxes_value[$i],
                    'pos_tax_type' => strtoupper($taxes_type[$i]),
                    'pos_tax_on' => $taxes_on[$i]
                );


                $this->PointOfSale_m->create('order_tax', $taxamount);
            }
        }

        if ($status_id == 1) {
            $dataGJ_dr1 = [
                'general_journal_head' => '1',
                'general_journal_debit' => $bill_total,
                'general_journal_credit' => '0',
                'general_journal_particulars' => '',
                'general_journal_source' => 'POS-Terminal',
                'general_journal_source_id' => $pos_id,
                'general_journal_date' => date('Y-m-d'),
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_dr1);
            $dataGJ_cr1 = [
                'general_journal_head' => '8',
                'general_journal_debit' => '0',
                'general_journal_credit' => $sub_total,
                'general_journal_particulars' => '',
                'general_journal_source' => 'POS-Terminal',
                'general_journal_source_id' => $pos_id,
                'general_journal_date' => date('Y-m-d'),
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_cr1);
            $dataGJ_dr2 = [
                'general_journal_head' => '10',
                'general_journal_debit' => $discount_allowed,
                'general_journal_credit' => '0',
                'general_journal_particulars' => '',
                'general_journal_source' => 'POS-Terminal',
                'general_journal_source_id' => $pos_id,
                'general_journal_date' => date('Y-m-d'),
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_dr2);
            $dataGJ_cr2 = [
                'general_journal_head' => '5',
                'general_journal_debit' => '0',
                'general_journal_credit' => $totalTax,
                'general_journal_particulars' => '',
                'general_journal_source' => 'POS-Terminal',
                'general_journal_source_id' => $pos_id,
                'general_journal_date' => date('Y-m-d'),
                'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
                'general_journal_time' => date('h:i:s')
            ];
            $this->API_m->create('general_journal', $dataGJ_cr2);
        }

        redirect('PointOfSale/PointSale');
    }

    public function allPosSales() {
        date_default_timezone_set('Asia/Karachi');
        $today = date('Y-m-d');
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['posSales'] = $this->PointOfSale_m->getAllOrders($today);
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('PointOfSale/allOrders', $result);
        $this->load->view('include/footer');
    }

    public function TodaySale() {

        date_default_timezone_set('Asia/Karachi');
        $today = date('Y-m-d');
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['posSales'] = $this->PointOfSale_m->getTodaySale($today);
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('PointOfSale/TodaySale', $result);
        $this->load->view('include/footer');
    }

    public function SingleView($id) {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        // $result['orderTypes']    = $this->PointOfSale_m->get('pos_order_type');
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['pos_data'] = $this->PointOfSale_m->getSinglePosDetails($id);
//         print_r($result['pos_data']);
        $result['products'] = $this->PointOfSale_m->getProCate();
        $result['prefix'] = $this->API_m->prefix();
        $result['taxes'] = $this->API_m->get('pos_tax');
        $result['all_tax'] = $this->API_m->singleRecordArray('order_tax',['pos_id'=>$id]);
//         echo "<pre>";
//        print_r($result['all_tax']);
//         exit();

        $result['user'] = $this->API_m->singleRecord('users',['user_id' => $result['pos_data']['pos']->cancel_by]);
        
        // $result['pos_tbl']       = $this->PointOfSale_m->get('pos_assignment');
        // $result['singleOrder']   = $this->PointOfSale_m->getSingleOrder($id);
        // $result['AllProducts']   = $this->PointOfSale_m->getallProducts($id);
        $result['AllTaxes'] = $this->PointOfSale_m->getallTaxes($id);
        $result['AllTaxes_d'] = $this->PointOfSale_m->getallTaxes_d($id);
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('PointOfSale/singleOrder', $result);
        $this->load->view('include/footer');
    }

    public function payOrder($status_id) {

        date_default_timezone_set('Asia/Karachi');

        $bill_total = $this->input->post('bill_total');
        $discounted_price = $this->input->post('discounted_price');
        $discount_off = $this->input->post('discountOff');
        $discount_value = $this->input->post('discountValue');
        $discount_type = strtoupper($this->input->post('discountType'));
        $additional_info = $this->input->post('additional_info');
        $code = $this->input->post('code');
        $prd_id = $this->input->post('prd_id');
        $unit = $this->input->post('unit');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        $paid_amount = $this->input->post('paid_amount');
        $balance = $this->input->post('balance');
        $taxes_value = $this->input->post('taxes_value');
        $taxes_type = $this->input->post('taxes_type');
        $taxes_title = $this->input->post('taxes_title');
        $taxes_on = $this->input->post('taxes_on');
        $pos_status = $status_id;
        $totalTax =  $bill_total - $discounted_price;
        $discount_allowed = $sub_total - $discounted_price;
        $pos_status = $status_id;


        $pos_id = $_POST['pos_id'];


        $PayOrder = array(
            'pos_status' => $pos_status,
            'pos_paid_amount' => $bill_total,
        );
        
        
        

        $dataGJ_dr1 = [
            'general_journal_head' => '1',
            'general_journal_debit' => $bill_total,
            'general_journal_credit' => '0',
            'general_journal_particulars' => '',
            'general_journal_source' => 'POS-Terminal',
            'general_journal_source_id' => $pos_id,
            'general_journal_date' => date('Y-m-d'),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr1);
        $dataGJ_cr1 = [
            'general_journal_head' => '8',
            'general_journal_debit' => '0',
            'general_journal_credit' => $sub_total,
            'general_journal_particulars' => '',
            'general_journal_source' => 'POS-Terminal',
            'general_journal_source_id' => $pos_id,
            'general_journal_date' => date('Y-m-d'),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr1);
        $dataGJ_dr2 = [
            'general_journal_head' => '10',
            'general_journal_debit' => $discount_allowed,
            'general_journal_credit' => '0',
            'general_journal_particulars' => '',
            'general_journal_source' => 'POS-Terminal',
            'general_journal_source_id' => $pos_id,
            'general_journal_date' => date('Y-m-d'),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_dr2);
        $dataGJ_cr2 = [
            'general_journal_head' => '5',
            'general_journal_debit' => '0',
            'general_journal_credit' => $totalTax,
            'general_journal_particulars' => '',
            'general_journal_source' => 'POS-Terminal',
            'general_journal_source_id' => $pos_id,
            'general_journal_date' => date('Y-m-d'),
            'general_journal_posted_by' => $this->session->userdata('user')['user_id'],
            'general_journal_time' => date('h:i:s')
        ];
        $this->API_m->create('general_journal', $dataGJ_cr2);

        $this->PointOfSale_m->update('pos', ['pos_id' => $pos_id], $PayOrder);
        
        //decrease from store 
        $getItemStore = $this->API_m->singleRecordArray('pos_items', ['pos_id' => $pos_id]);
        foreach($getItemStore as $store)
        {
                $dataStore = [
                    'storeitem_item_id' => $store->prd_id ,
                    'storeitem_quantity' => $store->pos_prd_qty,
                    'date' => date('Y-m-d'),
                    'status' => '-'
                ];
              $this->API_m->create('store_items', $dataStore);       
        }
        
        //end of the store items
        
        
        redirect('PointOfSale/TodaySale');
    }

    public function cancelOrder($status_id) {
        $pos_status = $status_id;
        $pos_id = $_POST['invoice_id'];

        // echo "<pre>";
        // print_r($pos_id);
        // echo $pos_status;
        // exit();
        $CancelOrder = array(
            'pos_status' => $pos_status,
            'cancelation_reason' => $this->input->post('Cancelreason'),
            'cancel_by' => $this->session->userdata('user')['user_id'],
            'cancelation_date' => date('Y-m-d')
        );

        $this->PointOfSale_m->update('pos', ['pos_id' => $pos_id], $CancelOrder);
        redirect('PointOfSale/TodaySale');
    }

    public function UpdateOrder() {
        // $pos_id                = $this->input->post('pos_id');
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        date_default_timezone_set('Asia/Karachi');

        $pos_id = $this->input->post('pos_id');
        $bill_total = $this->input->post('bill_total');
        $discounted_price = $this->input->post('discounted_price');
        $discount_off = $this->input->post('discountOff');
        $discount_value = $this->input->post('pos_discount_value');
        $discount_type = strtoupper($this->input->post('discountType'));
        $additional_info = $this->input->post('additional_info');
        $code = $this->input->post('code');
        $prd_id = $this->input->post('prd_id');
        $unit = $this->input->post('unit');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $sub_total = $this->input->post('sub_total');
        $paid_amount = $this->input->post('paid_amount');
        $balance = $this->input->post('balance');
        $taxes_value = $this->input->post('pos_tax_value');
        $taxes_type = $this->input->post('pos_tax_type');
        $taxes_title = $this->input->post('pos_tax_title');
        $taxes_on = $this->input->post('pos_tax_on');
        $pos_status = '0';



        // *** update pos table data

        $dataPos = array(
            'pos_created_by' => $this->session->userdata('user')['user_id'],
            'pos_date'             => date('Y-m-d H:i:s'),
            'pos_additional_note' => $additional_info,
            'pos_bill_total' => $bill_total,
            'pos_discount_price' => $discounted_price,
            'pos_discounted_off' => $discount_off,
            'pos_discount_value' => $discount_value,
            'pos_discount_type' => $discount_type,
            'pos_balance' => $balance,
            'pos_paid_amount' => $paid_amount,
            'pos_status' => $pos_status
        );
        $this->PointOfSale_m->update('pos', ['pos_id' => $pos_id], $dataPos);


        // *** delete pos items old record
        $this->PointOfSale_m->delete('pos_items', ['pos_id' => $pos_id]);

        // **** Insert new pos items record
        for ($key = 0; $key < sizeof($prd_id); $key++) {


            if (!empty($prd_id[$key])) {
                $dataPosItems = array(
                    "pos_id" => $pos_id,
                    "prd_id" => $prd_id[$key],
                    "pos_prd_qty" => $quantity[$key],
                    "pos_item_unit" => $unit[$key],
                    "pos_prd_price" => $price[$key],
                    "pos_items_date" => date('Y-m-d')
                );



                $this->PointOfSale_m->create('pos_items', $dataPosItems);
            }
        }

        // order tax deletion/creation (updating).
        $this->PointOfSale_m->delete('order_tax', ['pos_id' => $pos_id]);

        // echo "<pre>";
        // print_r($taxes_title);
        // print_r($taxes_value);
        // print_r($taxes_type);
        // print_r($taxes_on);
        // exit();

//echo $pos_id;
//exit();

        for ($i = 0; $i < sizeof($taxes_value); $i++) {

            if (!empty($taxes_value[$i]) && $taxes_value[$i] != '0.00') {

                $taxamount = array(
                    'pos_id' => $pos_id,
                    'pos_tax_title' => $taxes_title[$i],
                    'pos_tax_value' => $taxes_value[$i],
                    'pos_tax_type' => strtoupper($taxes_type[$i]),
                    'pos_tax_on' => $taxes_on[$i]
                );


                $this->PointOfSale_m->create('order_tax', $taxamount);
            }
        }

        redirect('PointOfSale/SingleView/' . $pos_id);
    }

// ******* POS Reports

    public function PosReport() {

        $result['completed'] = $this->PointOfSale_m->countAllRows('pos', ['pos_status' => '1']);
        $result['hold'] = $this->PointOfSale_m->countAllRows('pos', ['pos_status' => '0']);
        $result['cancel'] = $this->PointOfSale_m->countAllRows('pos', ['pos_status' => '2']);
        $result['totalOrders'] = $this->PointOfSale_m->countAll('pos');

        $result['user_info'] = $this->Login_m->activeUserInfo();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('PointOfSale/PosReports', $result);
        $this->load->view('include/footer');
    }

}

?>