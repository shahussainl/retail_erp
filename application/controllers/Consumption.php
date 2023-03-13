<?php

class Consumption extends CI_Controller {

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
        
        $result['cosumption_data'] = $this->Consumption_m->getConsumptedProductData();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('consumption/all_consumption', $result);
        $this->load->view('include/footer');
    }

    public function add_new() {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_no'] = $this->API_m->getNextInsertedId('users', 'user_id');
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $total_record = $this->Sales_m->getSalesNo();
        $result['voucher_no'] = $total_record + 1;
        $result['taxes'] = $this->API_m->get('tax');
        $result['sal_vouchers'] = $this->API_m->singleRecordArray('sales', ['sales_status' => '0', 'post_status' => '0', 'is_ref' => null, 'is_invoice' => 0]);
        $result['all_sale_vouchers'] = $this->Sales_m->all_sale_vouchers();
        $result['assets'] = $this->Vouchers_m->getAllAssetsAccount();
        $result['products'] = $this->API_m->singleRecordArray('product', ('prd_is_sale = 1 AND (prd_status=0  OR prd_status IS NULL) AND prd_is_raw = 0'));
        $result['get_raw_prd'] = $this->Admin_m->get_raw_products();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('consumption/add_new', $result);
        $this->load->view('include/footer');
    }

    public function addConsumptionData() {
        $manufactor_product = $this->input->post('manufactor_product');
        $prd_id = $this->input->post('prd_id');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $total = $this->input->post('total');
        $main_product_price = $this->input->post('main_product_price');
        $additional_info = $this->input->post('additional_info');

        $ManufactorProdata = [
            "manufactor_product" => $manufactor_product,
            "manufactor_product_price" => $main_product_price,
            "additional_info" => $additional_info,
            "create_date" => date('Y-m-d'),
            "create_by" => $this->session->userdata('user')['user_id'],
        ];
        $con_id = $this->API_m->create('consumption',$ManufactorProdata);

        $size = sizeof($prd_id);
        for ($i = 0; $i < $size; $i++) {
            if (!empty($prd_id[$i])) {
                $consumptedProductData = [
                    "prd_id" => $prd_id[$i],
                    "quantity" => $quantity[$i],
                    "total" => $total[$i],
                    "price" => $price[$i],
                    "cons_id" => $con_id,
                ];
                $this->API_m->create('consumpted_items',$consumptedProductData);
            }
        }
        redirect('Consumption/add_new');
    }
    
    public function all_consumption_report() {
        
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['cosumption_data'] = $this->Consumption_m->getConsumptedProductData();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('consumption/all_cosumption_view', $result);
        $this->load->view('include/footer');
    }

}

?>