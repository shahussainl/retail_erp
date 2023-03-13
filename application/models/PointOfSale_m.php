    <?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PointOfSale_m extends CI_Model {

//this function is used to get single record 

    public function single($table, $id) {
        return $this->db->where($id)->get($table)->row();
    }

//this function is used to get single record by name

    public function singleRecordByName($table, $name) {
        return $this->db->where($name)->get($table)->row();
    }

     //this funtion will recieve table name and a condition and return  the data 

    public function getRecordWhere($table_name, $table_field_name_with_value) {
        return $this->db->where($table_field_name_with_value)->get($table_name)->result();
    }

    public function getRecordByRow($table_name, $table_field_name_with_value) {
        return $this->db->where($table_field_name_with_value)->get($table_name)->result();
    }
    public function getByRow($table_name, $table_field_name_with_value) {
        return $this->db->where($table_field_name_with_value)->get($table_name)->row_array();
    }
//this function is used to count all rows of table under a condition
    public function countAllRows($table, $arg) {
        return $this->db->where($arg)->count_all_results($table);
    }
//this function is use to get all record of a single table

    public function get($table) {
        return $this->db->get($table)->result();
    }
    public function countAll($table) {
      return   $this->db->count_all_results($table);

        
    }

//this function is use to add value in database
    public function create($table, $arg) {
         
        $result = $this->db->insert($table, $arg);
        if (!$result) {
            return 0;
        } else {
            return $this->db->insert_id();
        }
    }

//this function is use to update values in database

    public function update($table, $id, $args) {
        $row = $this->db->where($id)->update($table, $args);
        if (!$row) {
            return 0;
        } else {
            return 1;
        }
    }

//this function is used for delete record from database

    public function delete($table, $id) {
        return $this->db->where($id)->delete($table);
    }

//this function is used to return image or video file name and store image into folder

    public function upload($path,$name) {

        $file = ''; 
            $new_name = date('s') . str_replace(' ', '', $_FILES[$name]['name']);
            $adver = realpath(APPPATH . '../assets/images/' . $path . '/');

            
            $config = [
                'upload_path'   => $adver,
                'allowed_types' => 'gif|jpeg|jpg|png|mp4',
                'remove_spaces' => true,
                'image_library' => 'gd2',
                'quality'       => 60,
                'file_name'     => $new_name
            ];


            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload($name)) {
                $file = $new_name;
            } else {
                $file = $this->upload->display_errors();
            }
        return $file;
    }

//this function is used to get multiple record of base on condition
    public function singleRecordArray($table, $id) {
        return $this->db->where($id)->get($table)->result();
    }

//this function is used to upload multiple images 

    public function uploadMultipleImages($dirName, $directory_instance_id = null, $table) {

        $adver = realpath(APPPATH . "../user_uploads/" . $dirName);
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['file']['name']);
        $img_array = [];
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
                'quality'    => 60,
                'file_name' => $new_name
            ];

            $img_array[$i] = $new_name;
            $this->upload->initialize($config);
            if ($this->upload->do_upload('file')) {
                $array = [
                    'directory_instance_id' => $directory_instance_id,
                    'image_name' => $new_name
                ];
                if ($directory_instance_id != null) {
                    $this->Ajax_m->create($table, $array);
                }
            }
        }
//end fo the for loop
        return $img_array;
    }

//end of the multiple images upload----------------------

// Product code
   public function getProCate()
   {
        
           return $this->db->select('*')
                    ->from('product as p')
                    ->join('product_category as pc','pc.prdc_id=p.prd_prdc_id')
                    ->where('p.prd_is_sale',1)
                    ->where('p.prd_status',null)->get()->result();
   }

     public function getSingleProduct($prd_id=''){
            $this->db
                    ->select('*')
                    ->from('product')
                    ->join('store_items','store_items.storeitem_item_id = product.prd_id')
                    ->where('product.prd_status',null);

            if($prd_id)
            {
                $this->db->where('product.prd_id',$prd_id);
                $query  = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('prd_title','asc');
                $query  = $this->db->get();
                $result = $query->result_array();
                     // print_r($result);
            }

             return !empty($result)?$result:false;
    }

    public function getTodaySale($today)
    {
        return  $this->db->select('*')
                        ->from('pos as pos')
                        // ->join('pos_items as pos_i','pos.pos_id=pos_i.pos_id')
                        // ->join('product as pro','pro.prd_id=pos_i.prd_id')
                        // ->join('pos_assignment as pa','pa.pos_assign_id=pos.pos_assign_id')
                        ->join('pos_order_type as pot','pot.order_type_id=pos.order_type_id')
                        ->where('DATE(pos.pos_date)',$today)
                        // ->where('pos.pos_date',$today)
                        ->order_by('pos.pos_id','desc')
                        // ->join('users as user','pos.pos_created_by=user.user_id')
                        ->get()->result_array();
    }

    public function getAllOrders($today)
    {
        return  $this->db->select('*')
                        ->from('pos as pos')
                        // ->join('pos_items as pos_i','pos.pos_id=pos_i.pos_id')
                        // ->join('product as pro','pro.prd_id=pos_i.prd_id')
                        // ->join('pos_assignment as pa','pa.pos_assign_id=pos.pos_assign_id')
                        ->join('pos_order_type as pot','pot.order_type_id=pos.order_type_id')
                         ->join('users','users.user_id=pos.pos_created_by','left')
                        //->where_not_in('DATE(pos.pos_date)',$today)
                        ->order_by('pos.pos_id','desc')
                        // ->join('users as user','pos.pos_created_by=user.user_id')
                        ->get()->result_array();
    }

    public function getSingleOrder($id)
    {
         return  $this->db->select('*')
                        -> from('pos as pos')
                        -> join('pos_items as pos_i','pos.pos_id=pos_i.pos_id')
                        // -> join('pos_assignment as pa','pa.pos_assign_id=pos.pos_assign_id')
                        -> join('pos_order_type as pot','pot.order_type_id=pos.order_type_id')
                        -> join('order_tax as o_t','o_t.pos_id=pos.pos_id')
                        -> where('pos.pos_id',$id)
                        -> get()->row_array();
    }

    

     public function getallProducts($id)
    {
         return  $this->db->select('*')
                        -> from('pos as pos')
                        -> join('pos_items as pos_i','pos.pos_id=pos_i.pos_id')
                        -> join('product as pro','pro.prd_id=pos_i.prd_id')
                        -> where('pos.pos_id',$id)
                        -> get()->result_array();
    }

    public function getallTaxes($id)
    {
         return  $this->db->select('*')
                        -> from('order_tax as ot')
                        // -> join('pos as pos','pos.pos_id=ot.pos_id')
                        // -> join('pos_tax as pt','pt.pos_tax_id=ot.order_tax_id')
                        -> where('ot.pos_id',$id)
                        -> get()->result_array();
    }

    public function checkRecord($prd_id,$pos_id,$data,$toDate)
    {
         
            $res = $this->db->select('*')
                            ->from('pos_items')
                            ->where('pos_id',$pos_id)
                            ->where('prd_id',$prd_id)
                            ->where('pos_items_date',$toDate)
                            ->get()->row_array();
            // print_r($res['pos_prd_qty']);
             $items_id = $res['pos_items_id'];
             $prd_qty  = $res['pos_prd_qty']+1;

             $upQty = array(

                    'pos_prd_qty' => $prd_qty
             );
            //  echo "<pre>";
            // print_r($upQty);

            // print_r($res); 
            // exit();

            if($res)
            {
                       $this->db->where('pos_items_id',$items_id);
                return $this->db->update('pos_items',$upQty);
            }
            else
            {
                return $this->db->insert('pos_items',$data);
            }
    }


    public function getAllOrder_d($id)
    {
         return  $this->db->select('*')
                        -> from('pos as pos')
                        -> join('pos_items as pos_i','pos.pos_id=pos_i.pos_id')
                        // -> join('pos_assignment as pa','pa.pos_assign_id=pos.pos_assign_id')
                        -> join('pos_order_type as pot','pot.order_type_id=pos.order_type_id')
                        -> join('order_tax as o_t','o_t.pos_id=pos.pos_id')
                        -> where('pos.pos_id',$id)
                        -> get()->row_array();
    }

    

     public function getallPro_d($id)
    {
         return  $this->db->select('*')
                        -> from('pos as pos')
                        -> join('pos_items as pos_i','pos.pos_id=pos_i.pos_id')
                        -> join('product as pro','pro.prd_id=pos_i.prd_id')
                        -> where('pos.pos_id',$id)
                        -> get()->result_array();
    }

    public function getallTaxes_d($id)
    {
         return  $this->db->select('*')
                        -> from('order_tax as ot')
                        -> join('pos as pos','pos.pos_id=ot.pos_id')
                        // -> join('pos_tax as pt','pt.pos_tax_id=ot.pos_tax_id')
                        -> where('ot.pos_id',$id)
                        -> get()->result_array();
    }

    public function getProductDetail($dbColName, $value) {
        return $this->db
                        ->join('product_category', 'product_category.prdc_id = product.prd_prdc_id')
                        ->join('unit', 'unit.unit_id = product.prd_unit_id')
                        ->where('prd_status', null)
                        ->where('prd_is_sale', '1')
                        ->where($dbColName, $value)
                        ->get('product')->row();
    }

    public function getSinglePosDetails($id) {
        $purchase = $this->db
                        ->where('pos.pos_id', $id)
                        ->get('pos')->row();
        $a = [];
        $a['pos'] = $purchase;
        $a['items'] = $this->db
                        ->join('product', 'product.prd_id = pos_items.prd_id')
                        ->join('unit', 'unit.unit_id = product.prd_unit_id')
                        ->where('pos_id', $id)->get('pos_items')->result();
        // $a['payment_history'] = $this->db->select('*,sales_payment.sal_ref_id')
        //                 ->join('sales', 'sales.sales_id = sales_payment.salpayment_sales_id', 'left')
        //                 ->where('salpayment_sales_id', $id)->get('sales_payment')->result();

        $a['tax_history'] = $this->db
                        ->join('pos', 'pos.pos_id = order_tax.pos_id', 'left')
                        ->where('pos.pos_id', $id)->get('order_tax')->result();

        return $a;
    }
// ******* get today sales price of all order of the day

    public function TodaySalesPrice()
    {
        date_default_timezone_set('Asia/Karachi'); 
        $today = date('Y-m-d');

        return  $this->db->select('sum(pos_bill_total) as total')
                         ->from('pos as pos')
                         ->where('DATE(pos.pos_date)',$today)
                         ->where('pos.pos_status',1)->get()->row();
    }
    
    public function getAllSales()
    {
      $totalSales = 0;
      $data =   $this->db->join('chart_of_account','chart_of_account.coa_id=general_journal.general_journal_head')->where('coa_id',8)->get('general_journal')->result();
      
      foreach($data as $d)
      {
         $totalSales = $totalSales + $d->general_journal_credit; 
      }
      return $totalSales;
    }
    
    public function getTotalAvgSales()
    {
      $avgSales = 0;
      $totalSales = 0;
      $data =   $this->db->join('chart_of_account','chart_of_account.coa_id=general_journal.general_journal_head')->where('coa_id',8)->get('general_journal')->result();
      
      foreach($data as $d)
      {
         $totalSales = $totalSales + $d->general_journal_credit; 
      }
      
      
      $totalOrder = $this->db->where("`general_journal_source`='SALE' OR `general_journal_source` = 'POS-Terminal' ")->group_by('general_journal_source_id')->count_all_results('general_journal');
      if(!empty($totalOrder))
      {
        $avgSales =   $totalSales / $totalOrder;
      }
      return $avgSales;
    }
    
       public function getTotalAvgSalesItems()
    {
      $totalAvgItems = 0;
      $totalSales = 0;
      $data =   $this->db->join('chart_of_account','chart_of_account.coa_id=general_journal.general_journal_head')->where('coa_id',8)->get('general_journal')->result();
      foreach($data as $d)
      {
         $totalSales = $totalSales + $d->general_journal_credit; 
      }
      
      $salesSalesItemes = 0;
      $salesPOSSalesItemes = 0;
      
      $totalSalesOrderItem = $this->db->where('general_journal_source','SALE')->group_by('general_journal_source_id')->get('general_journal')->result();
      $totalPOSSalesOrderItem = $this->db->where('general_journal_source','POS-Terminal')->group_by('general_journal_source_id')->get('general_journal')->result();
      foreach($totalSalesOrderItem as $saleITEM)
      {
        $salesSalesItemes =  $salesSalesItemes + $this->db->select('SUM(salitem_qty) as total')->where('salitem_sales_id',$saleITEM->general_journal_source_id)->get('sales_items')->row()->total; 
      }
      foreach($totalPOSSalesOrderItem as $salePOSITEM)
      {
        $salesPOSSalesItemes =  $salesPOSSalesItemes + $this->db->select('SUM(pos_prd_qty) as total')->where('pos_id',$salePOSITEM->general_journal_source_id)->get('pos_items')->row()->total; 
      }
      
      if($salesSalesItemes + $salesPOSSalesItemes)
      {
         $totalAvgItems =  $totalSales / ($salesSalesItemes + $salesPOSSalesItemes);
      }
      
      return $totalAvgItems;
    }
    
    public function currentYearSales()
    {
     $k = 1;
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            if($i < 10){
               $k = '0'.$i; 
            }else{
                $k = $i;
            }
         $month =   date("m-Y", strtotime( date( 'Y-m-01' )." -$i months"));

          $data =  $this->db->select('SUM(general_journal_credit) as total')->join('chart_of_account','chart_of_account.coa_id=general_journal.general_journal_head')
                    ->where('MONTH(general_journal_date) ='. $k)
                    ->where('year(general_journal_date)', date('Y'))
                    ->where('coa_id',8)->get('general_journal')->row(); 
            if($data->total == '')
            {
              $result[$k] =   0;  
            }
            else
            {
              $result[$k] =   $data->total;
            }
            
        }
        return $result;
        }
   
    public function currentYearTotalSales()
    {
      $totalSales = 0;
      $data =   $this->db->join('chart_of_account','chart_of_account.coa_id=general_journal.general_journal_head')->where('year(general_journal_date)', date('Y'))->where('coa_id',8)->get('general_journal')->result();
      foreach($data as $d)
      {
         $totalSales = $totalSales + $d->general_journal_credit; 
      }  
      
      return $totalSales;
    }
   
    public function currentYearTotalPurchase()
    {
      $totalPurchase = 0;
      $data =   $this->db->join('chart_of_account','chart_of_account.coa_id=general_journal.general_journal_head')->where('year(general_journal_date)', date('Y'))->where('coa_id',16)->get('general_journal')->result();
      foreach($data as $d)
      {
         $totalPurchase = $totalPurchase + $d->general_journal_debit; 
      }  
      
      return $totalPurchase;
    }
    
    public function getCurrentYearExpense()
    {
      $k = 1;
        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            if($i < 10){
               $k = '0'.$i; 
            }else{
                $k = $i;
            }
         $month =   date("m-Y", strtotime( date( 'Y-m-01' )." -$i months"));

          $data =  $this->db->select('SUM(general_journal_debit) as total')
                    ->join('chart_of_account','chart_of_account.coa_id=general_journal.general_journal_head')
                     ->join('chart_of_account_subtype','chart_of_account_subtype.coa_subtype_id=chart_of_account.coa_subtypeid')
                    ->where('MONTH(general_journal_date) ='. $k)
                    ->where('year(general_journal_date)', date('Y'))
                    ->where('coa_subtype_typeid',4)->get('general_journal')->row(); 
            if($data->total == '')
            {
              $result[$k] =   0;  
            }
            else
            {
              $result[$k] =   $data->total;
            }
            
        }
        return $result;
    }
   
    public function getCurrentYearTotalExpense()
    {
         $totalExpense = 0;
      $data = $this->db->join('chart_of_account','chart_of_account.coa_id=general_journal.general_journal_head')->join('chart_of_account_subtype','chart_of_account_subtype.coa_subtype_id=chart_of_account.coa_subtypeid')->where('year(general_journal_date)', date('Y'))->where('coa_subtype_typeid',4)->get('general_journal')->result();
      foreach($data as $d)
      {
         $totalExpense = $totalExpense + $d->general_journal_debit; 
      }  
      
      return $totalExpense;  
    }
    
}

?>