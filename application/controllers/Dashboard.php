<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    public function index() {
        $today = date('Y-m-d');
        $user_id = $this->session->userdata('user')['user_id'];
        $result['todaySale']         = $this->PointOfSale_m->getAllSales();
        $result['avgSales']    = $this->PointOfSale_m->getTotalAvgSales();
        $result['avgSalesItems']    = $this->PointOfSale_m->getTotalAvgSalesItems();
        $result['user_info']         = $this->Login_m->activeUserInfo();
        $result['notify']            = $this->Notifications_m->getRecordWhere('notifications',['notify_created_for' => $user_id]);   
        $result['currency'] = $this->API_m->currentCurrency();
        $result['currentYearTotalSales'] = $this->PointOfSale_m->currentYearTotalSales();
        $result['currentYearSales'] = $this->PointOfSale_m->currentYearSales();
        
        $result['currentYearTotalPurchase'] = $this->PointOfSale_m->currentYearTotalPurchase();
       
        $result['getCurrentYearTotalExpense'] = $this->PointOfSale_m->getCurrentYearTotalExpense();
        $result['getCurrentYearExpense'] = $this->PointOfSale_m->getCurrentYearExpense();
       
        $result['getCurrentYearProfiltLost'] = $result['currentYearTotalSales'] - ($result['currentYearTotalPurchase'] + $result['getCurrentYearTotalExpense'] );
  
//         echo '<pre>';
//         print_r($result['currentYearSales']);
//         die;
        
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('dashboard',$result);
        $this->load->view('include/footer');
    }

}

?>