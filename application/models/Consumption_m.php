<?php

class Consumption_m extends CI_Model {
    public function getConsumptedProductData(){
        $a = $this->db->join('product','product.prd_id = consumption.manufactor_product')->get('consumption')->result();
        $result = [];
        foreach($a as $b){
            $result[$b->consumption_id]['consumption'] = $b;
            $result[$b->consumption_id]['consumpted_items'] = $this->db->join('product','product.prd_id = consumpted_items.prd_id')->where('consumpted_items.cons_id',$b->consumption_id)->get('consumpted_items')->result();
        }
        
        return $result;
    }
}