<?php

class Purchase_m extends CI_Model {

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


    public function getProductDetail($dbColName,$value){
        return $this->db
                ->join('product_category','product_category.prdc_id = product.prd_prdc_id')
                ->join('unit','unit.unit_id = product.prd_unit_id')
                ->where('prd_status',null)
                ->where('prd_is_sale','1')
                ->where($dbColName,$value)
                ->get('product')->row();
    }
    public function getPurchaseNo(){
        return $this->db->count_all_results('purchase');
    }
    public function getSinglePurchaseVoucherDetail($id){
        $purchase =  $this->db
                            ->where('purchase.purchase_id',$id)
                            ->get('purchase')->row();
        $a = [];
        $a['purchase'] = $purchase;
        $a['items'] = $this->db
                ->join('product','product.prd_id = purchase_items.puritem_item_id')
                ->join('unit','unit.unit_id = product.prd_unit_id')
                ->where('puritem_purchase_id', $id)->get('purchase_items')->result();
        $a['payment_history'] = $this->db->select('*,purchase_payment.pur_ref_id')
                ->join('purchase','purchase.purchase_id = purchase_payment.purpayment_id','left')
                ->where('purpayment_purchase_id', $id)->get('purchase_payment')->result();
                
        return $a;
    }


// ***** New purchase Section <Usman Code>
    public function getProCate()
    {
        
           return $this->db->select('*')
                    ->from('product as p')
                    ->join('product_category as pc','pc.prdc_id=p.prd_prdc_id')
                    ->where('p.prd_is_purchase',1)
                    ->where('p.prd_status',null)->get()->result();
    }

    public function getProductDet($dbColName, $value) {
        return $this->db
                        ->join('product_category', 'product_category.prdc_id = product.prd_prdc_id')
                        ->join('unit', 'unit.unit_id = product.prd_unit_id')
                        ->where('prd_status', null)
                        ->where('prd_is_purchase', '1')
                        ->where($dbColName, $value)
                        ->get('product')->row();
    }

    public function getPaidBills()
    {
        $data = $this->db->select('*')
                        ->from('purchase as purc')
                        ->join('users as us','us.user_id=purc.purchase_vendor_id')
                        ->where('purc.purchase_status',1)
                        ->order_by('purc.purchase_id','DESC')
                        ->get()->result();
        $arr = [];
        $count = 1;
        foreach($data as $single_bill){
        $arr[$count]['info'] = $single_bill;
        $arr[$count]['items'] = $this->db->where('puritem_purchase_id',$single_bill->purchase_id)->join('product','`product`.`prd_id` = `purchase_items`.`puritem_item_id`')->get('purchase_items')->result();
        $arr[$count]['payments'] = $this->db->where('purpayment_purchase_id',$single_bill->purchase_id)->get('purchase_payment')->result();
        $count++;
        }
       return $arr;
    }
    public function getCancelBills()
    {
        $data = $this->db->select('*')
                        ->from('purchase as purc')
                        ->join('users as us','us.user_id=purc.purchase_vendor_id')
                        ->where('purc.purchase_status',2)
                        ->order_by('purc.purchase_id','DESC')
                        ->get()->result();
        $arr = [];
        $count = 1;
        foreach($data as $single_bill){
        $arr[$count]['info'] = $single_bill;
        $arr[$count]['items'] = $this->db->where('puritem_purchase_id',$single_bill->purchase_id)->join('product','`product`.`prd_id` = `purchase_items`.`puritem_item_id`')->get('purchase_items')->result();
        $arr[$count]['payments'] = $this->db->where('purpayment_purchase_id',$single_bill->purchase_id)->get('purchase_payment')->result();
        $count++;
        }
       return $arr;
    }

    public function getPartialBills()
    {
        $data = $this->db->select('*')
                        ->from('purchase as purc')
                        ->join('users as us','us.user_id=purc.purchase_vendor_id')
                        ->where('purc.purchase_status',0)
                        ->order_by('purc.purchase_id','DESC')
                        ->get()->result();
        $arr = [];
        $count = 1;
        foreach($data as $single_bill){
        $arr[$count]['info'] = $single_bill;
        $arr[$count]['items'] = $this->db->where('puritem_purchase_id',$single_bill->purchase_id)->join('product','`product`.`prd_id` = `purchase_items`.`puritem_item_id`')->get('purchase_items')->result();
        $arr[$count]['payments'] = $this->db->where('purpayment_purchase_id',$single_bill->purchase_id)->get('purchase_payment')->result();
        $count++;
        }
       return $arr;
    }

     public function getSinglePosDetails($id) {
         $purchase =  $this->db
                ->join('users','purchase.purchase_vendor_id=users.user_id')
                ->where('purchase.purchase_id',$id)
                ->get('purchase')->row();
        $a = [];
        $a['purchase'] = $purchase;
        $a['items'] = $this->db
                ->join('product','product.prd_id = purchase_items.puritem_item_id')
                ->join('unit','unit.unit_id = product.prd_unit_id')
                ->where('puritem_purchase_id', $id)->get('purchase_items')->result();
        $a['payment_history'] = $this->db->select('*,purchase_payment.pur_ref_id')
                ->join('purchase','purchase.purchase_id = purchase_payment.purpayment_id','left')
                ->where('purpayment_purchase_id', $id)->get('purchase_payment')->result();
                
        return $a;

        return $a;
    }
}