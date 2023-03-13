<?php

class Stock extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Karachi');
    }
    
    public function index()
    {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['stock'] = $this->Stock_m->getAllStock();
        
//        echo '<pre>';
//        print_r($result['stock']);
//        die;
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('stock/index', $result);
        $this->load->view('include/footer');
    }

    public function singleProduct($id)
    {
        $result['currency_symbol'] = $this->Admin_m->getSelectedCurrency();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['product'] = $this->Stock_m->singleProduct($id);
        $result['purchase'] = $this->Stock_m->getSingleProductPurchases($id); // calculated purchase of all product from purchase table even if its not stocked 
        $result['sales'] = $this->Stock_m->getSingleProductSale($id); // calculated all stocked product sale from sale and pos table  
        $result['sales_avg'] = $this->Stock_m->getAvgSalePrice($id); // calculated all stocked product sale from sale and pos table divide by number of order it is sold in! 
        $result['purchase_unit_price'] = $this->Stock_m->getSingleProductPurchasesAVGUnitPrice($id); // calculated purchase AVG unit price to calculate unit profit! 
        $result['graph_data'] = $this->Stock_m->getGraphDetails($id);
        
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('stock/single_product', $result);
        $this->load->view('include/footer');
    }

    
}

?>