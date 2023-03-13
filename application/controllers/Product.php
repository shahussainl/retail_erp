<?php

class Product extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    public function index() {
        $result['user_info']        = $this->Login_m->activeUserInfo();
        $result['products']         = $this->ProductDetails_m->getProductDetail();
        $result['prodWidget']       = $this->ProductDetails_m->getProductWidget();
        // $result['ProdImages']       = $this->ProductDetails_m->getProImage();
        $result['product_category'] = $this->API_m->getRecordWhere('product_category', ['prdc_status' => null]);
        $result['currency_symbol']  = $this->Admin_m->getSelectedCurrency();

        $result['units']            = $this->API_m->get('unit');
//        echo '<pre>';
//        print_r($result['products']);
//        die;
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/products', $result);
        $this->load->view('include/footer');
    }

    public function category() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['product_category'] = $this->API_m->getRecordWhere('product_category', ['prdc_status' => null]);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/product_categories', $result);
        $this->load->view('include/footer');
    }

    public function addNewCategoryView() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/add_product_categories');
        $this->load->view('include/footer');
    }

    public function updateCategoryView($id) {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['product_category'] = $this->API_m->singleRecord('product_category', ['prdc_id' => $id]);
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/update_product_category', $result);
        $this->load->view('include/footer');
    }

    public function addProductCategory() {

        $category_name = $this->input->post('product_category');
        $data = [
            'prdc_name' => $category_name,
            'prdc_created_date' => date('Y-m-d'),
        ];
        $this->API_m->create('product_category', $data);

// notifications
        date_default_timezone_set('Asia/Karachi');

        $activity = [
            'notify_operation' => 'Create',
            'notify_activity_on' => 'ProductCategory',
            'activity_name' => $category_name,
            'notify_created_for' => $this->session->userdata('user')['user_id'],
            'modify_date' => date('Y-m-d H:i:s')
        ];


        $this->Notifications_m->InsertActivity('notifications', $activity);
        redirect('Product/category');
    }

    public function updateProductCategory() {
        $category_name = $this->input->post('product_category');
        $cate_id = $this->input->post('product_category_id');
        $id = [
            'prdc_id' => $cate_id,
        ];
        $data = [
            'prdc_name' => $category_name,
            'prdc_update_date' => date('Y-m-d'),
        ];
        $this->API_m->updateRecord('product_category', $id, $data);

// Notifications
        date_default_timezone_set('Asia/Karachi');
        $activity = [
            'notify_operation' => 'Update',
            'notify_activity_on' => 'ProductCategory',
            'activity_name' => $category_name,
            'notify_created_for' => $this->session->userdata('user')['user_id'],
            'modify_date' => date('Y-m-d H:i:s')
        ];
        $this->Notifications_m->InsertActivity('notifications', $activity);

        redirect('Product/category');
    }

    public function deleteCategory($id) {
        $i = [
            'prdc_id' => $id,
        ];
        $data = [
            'prdc_status' => '1',
            'prdc_update_date' => date('Y-m-d'),
        ];

// notifications
        $row = $this->Notifications_m->single('product_category', $i);
        $pro_prdc = $row->prdc_name;
        date_default_timezone_set('Asia/Karachi');
        $activity = [
            'notify_operation' => 'Delete',
            'notify_activity_on' => 'ProductCategory',
            'activity_name' => $pro_prdc,
            'notify_created_for' => $this->session->userdata('user')['user_id'],
            'modify_date' => date('Y-m-d H:i:s')
        ];
        $this->Notifications_m->InsertActivity('notifications', $activity);

        $this->API_m->updateRecord('product_category', $i, $data);

        redirect('Product/category');
    }

    public function addNewProductView() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['product_category'] = $this->API_m->getRecordWhere('product_category', ['prdc_status' => null]);
        $result['units'] = $this->API_m->get('unit');

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/add_product', $result);
        $this->load->view('include/footer');
    }

    public function updateProductView($id) {
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['product_category'] = $this->API_m->singleRecordArray('product_category', ['prdc_status' => null]);
        $result['product'] = $this->API_m->singleRecord('product', ['prd_id' => $id]);
        $result['products_images'] = $this->API_m->singleRecordArray('product_images', ['prdimg_prd_id' => $id]);
        $result['units'] = $this->API_m->get('unit');

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/update_product', $result);
        $this->load->view('include/footer');
    }

    public function addProduct() {

         // echo "<pre>";
         // print_r($_POST);
         // exit();
        $product_category = $this->input->post('product_category');
        $product_name = $this->input->post('product_name');
        $product_code = $this->input->post('product_code');
        $product_price = $this->input->post('product_price');
        $discount_price = $this->input->post('discount_price');
        $product_description = $this->input->post('product_description');
        $product_unit = $this->input->post('product_unit');
        $prd_is_sale = $this->input->post('prd_is_sale');
        $prd_is_purchase = $this->input->post('prd_is_purchase');
        if ($prd_is_sale == 'on') {
            $prd_is_sale = '1';
        } else {
            $prd_is_sale = '0';
        }

        if ($prd_is_purchase == 'on') {
            $prd_is_purchase = '1';
        } else {
            $prd_is_purchase = '0';
        }




        $titles = $this->input->post('title');

        $data = [
            'prd_prdc_id' => $product_category,
            'prd_title' => $product_name,
            'prd_code' => $product_code,
            'prd_desc' => $product_description,
            'prd_price' => $product_price,
            'prd_unit_id' => $product_unit,
            'prd_wholesales_price' => $discount_price,
            'prd_created_date' => date('Y-m-d'),
            'prd_is_sale' => $prd_is_sale,
            'prd_is_purchase' => $prd_is_purchase,
            'prd_is_raw' => $this->input->post('raw-product')
        ];
        $product_id = $this->API_m->create('product', $data);

//        if ($prd_is_purchase == '1' || $prd_is_sale == '1') {
//            $stockData = [
//                'storeitem_item_id' => $product_id,
//                'storeitem_quantity' => '0',
//                'storeitem_updated_date' => date('Y-m-d')
//            ];
//            $this->API_m->create('store_items', $stockData);
//        }

        $adver = realpath(APPPATH . "../img_uploads/product_images");
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['file']['name']);

        for ($i = 0; $i < $cpt; $i++) {

            $_FILES['file']['name'] = $files['file']['name'][$i];
            $_FILES['file']['type'] = $files['file']['type'][$i];
            $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
            $_FILES['file']['error'] = $files['file']['error'][$i];
            $_FILES['file']['size'] = $files['file']['size'][$i];

            if (!$_FILES["file"]['name']) {
                $new_name = '';
            } else {
                $new_name = date('s') . str_replace(' ', '', $_FILES["file"]['name']);
            }

            $config = [
                'upload_path' => $adver,
                'allowed_types' => 'gif|png|jpg|jpeg',
                'remove_spaces' => TRUE,
                'image_library' => 'gd2',
                'quality' => 60,
                'file_name' => $new_name
            ];
            echo $adver;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $imgData = [
                    'prdimg_prd_id' => $product_id,
                    'prd_image' => $new_name,
                    'prdimg_title' => $titles[$i],
                ];
                $this->API_m->create('product_images', $imgData);
            }
        }


        date_default_timezone_set('Asia/Karachi');
        $activity = [
            'notify_operation' => 'Create',
            'notify_activity_on' => 'Product',
            'activity_name' => $product_name,
            'notify_created_for' => $this->session->userdata('user')['user_id'],
            'modify_date' => date('Y-m-d H:i:s')
        ];
        $this->Notifications_m->InsertActivity('notifications', $activity);



        redirect('Product/index');
    }

    public function updateProduct() {
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $product_id = $this->input->post('product_id');
        $product_category = $this->input->post('product_category');
        $product_name = $this->input->post('product_name');
        $product_code = $this->input->post('product_code');
        $product_price = $this->input->post('product_price');
        $discount_price = $this->input->post('discount_price');
        $product_description = $this->input->post('product_description');
        $product_unit = $this->input->post('product_unit');
        $prd_is_sale = $this->input->post('prd_is_sale');
        $prd_is_purchase = $this->input->post('prd_is_purchase');
        if ($prd_is_sale == 'on') {
            $prd_is_sale = '1';
        } else {
            $prd_is_sale = '0';
        }

        if ($prd_is_purchase == 'on') {
            $prd_is_purchase = '1';
        } else {
            $prd_is_purchase = '0';
        }

        if ($prd_is_purchase == '1' || $prd_is_sale == '1') {

            $exsistData = $this->API_m->singleRecord('store_items', ['storeitem_item_id' => $product_id]);
            if (empty($exsistData)) {
                $stockData = [
                    'storeitem_item_id' => $product_id,
                    'storeitem_quantity' => '0',
                ];
                $this->API_m->create('store_items', $stockData);
            }
        }

        $where = [
            'prd_id' => $product_id
        ];

        $data = [
            'prd_prdc_id' => $product_category,
            'prd_title' => $product_name,
            'prd_code' => $product_code,
            'prd_desc' => $product_description,
            'prd_price' => $product_price,
            'prd_wholesales_price' => $discount_price,
            'prd_updated_date' => date('Y-m-d'),
            'prd_unit_id' => $product_unit,
            'prd_is_sale' => $prd_is_sale,
            'prd_is_purchase' => $prd_is_purchase,
            'prd_is_raw' => $this->input->post('raw-product')
        ];
        $this->API_m->updateRecord('product', $where, $data);

        if ($_FILES['file']['name'][0] != '') {

            $titles = $this->input->post('title');
            $adver = realpath(APPPATH . "../img_uploads/product_images");
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['file']['name']);

            for ($i = 0; $i < $cpt; $i++) {

                $_FILES['file']['name'] = $files['file']['name'][$i];
                $_FILES['file']['type'] = $files['file']['type'][$i];
                $_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
                $_FILES['file']['error'] = $files['file']['error'][$i];
                $_FILES['file']['size'] = $files['file']['size'][$i];

                if (!$_FILES["file"]['name']) {
                    $new_name = '';
                } else {
                    $new_name = date('s') . str_replace(' ', '', $_FILES["file"]['name']);
                }

                $config = [
                    'upload_path' => $adver,
                    'allowed_types' => 'gif|png|jpg|jpeg',
                    'remove_spaces' => TRUE,
                    'image_library' => 'gd2',
                    'quality' => 60,
                    'file_name' => $new_name
                ];

                $this->upload->initialize($config);
                if ($this->upload->do_upload('file')) {
                    $imgData = [
                        'prdimg_prd_id' => $product_id,
                        'prd_image' => $new_name,
                        'prdimg_title' => $titles[$i],
                    ];
                    $this->API_m->create('product_images', $imgData);
                }
            }
        }
// notifications
        date_default_timezone_set('Asia/Karachi');
        $activity = [
            'notify_operation' => 'Update',
            'notify_activity_on' => 'Product',
            'activity_name' => $product_name,
            'notify_created_for' => $this->session->userdata('user')['user_id'],
            'modify_date' => date('Y-m-d H:i:s')
        ];
        $this->Notifications_m->InsertActivity('notifications', $activity);



        redirect('Product/index');
    }

    public function deleteProductPic($id, $pro_id) {

// notifications
        date_default_timezone_set('Asia/Karachi');

        $row = $this->Notifications_m->single('product_images', ['prdimg_id' => $id]);
        $pro_img = $row->prdimg_title;
        $activity = [
            'notify_operation' => 'Update',
            'notify_activity_on' => 'Product',
            'activity_name' => $pro_img,
            'notify_created_for' => $this->session->userdata('user')['user_id'],
            'modify_date' => date('Y-m-d H:i:s')
        ];
        $this->Notifications_m->InsertActivity('notifications', $activity);



        $this->API_m->delete('product_images', ['prdimg_id' => $id]);
        redirect('Product/index');
    }

    public function deleteProduct($id) {

        $i = [
            'prd_id' => $id,
        ];


// notifications
        $row = $this->Notifications_m->single('product', $i);
        $pro_title = $row->prd_title;
        // print_r($row);
        // exit();
        date_default_timezone_set('Asia/Karachi');
        $activity = [
            'notify_operation' => 'Delete',
            'notify_activity_on' => 'Product',
            'activity_name' => $pro_title,
            'notify_created_for' => $this->session->userdata('user')['user_id'],
            'modify_date' => date('Y-m-d H:i:s')
        ];
        $this->Notifications_m->InsertActivity('notifications', $activity);
        $data = [
            'prd_status' => '1',
            'prd_updated_date' => date('Y-m-d'),
        ];
        $this->API_m->updateRecord('product', $i, $data);
        redirect('Product/index');
    }

    public function units() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['units'] = $this->API_m->singleRecordArray('unit',['is_trash' => 0]);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/units', $result);
        $this->load->view('include/footer');
    }

    public function addUnit() {
        $unit_name = $this->input->post('unit_name');
        $data = [
            "unit_name" => $unit_name
        ];
        $this->API_m->create('unit', $data);
        redirect('Product/units');
    }

    public function updateUnit() {
        $unit_id = $this->input->post('unit_id');
        $unit_name = $this->input->post('unit_name');
        $data = [
            "unit_name" => $unit_name,
        ];
        $this->API_m->updateRecord('unit', ['unit_id' => $unit_id], $data);
        redirect('Product/units');
    }
    public function deleteUnit($id){
        $data = [
            "is_trash" => '1',
        ];
        $this->API_m->updateRecord('unit', ['unit_id' => $id], $data);
        redirect('Product/units');
    }
    
    
    public function deleteCheckedProduct()
    {   
        // echo "<pre>";
        // $prd_id = $_POST['Checkd_id'];
        // print_r($prd_id);
        // exit();
         $status = array(
            'prd_status' =>'0'
         );
       if(isset($_POST['Checkd_id']))
        {
          foreach($_POST['Checkd_id'] as $pro_id)
          {
              $this->API_m->updateRecord('product',['prd_id' => $pro_id],$status);
          }
        }
        
        redirect('Product/index');  
    }
    


}

?>