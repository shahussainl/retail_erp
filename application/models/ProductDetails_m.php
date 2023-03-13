<?php

class ProductDetails_m extends CI_Model {

     public function getProductDetail(){
          $query = [];   
          $data = $this->db
                            ->join('product_category','product_category.prdc_id = product.prd_prdc_id')
                            ->join('unit','unit.unit_id = product.prd_unit_id')
                            ->where('prd_status',null)
                            ->get('product')->result();

           foreach($data as $d)
           {
             $query[$d->prd_id]['p'] = $d;
             $query[$d->prd_id]['i']  = $this->db
                                                    ->where('product_images.prdimg_prd_id',$d->prd_id)
                                                    ->order_by('product_images.prdimg_id','DESC')
                                                    ->get('product_images')->row();
           }

      return $query;
    }


    public function getProductWidget(){
          $query = [];   
          $data = $this->db
                            ->join('product_category','product_category.prdc_id = product.prd_prdc_id','left')
                            ->join('unit','unit.unit_id = product.prd_unit_id','left')
                            ->where('prd_status',null)
                            ->get('product')->result();

           foreach($data as $d)
           {
             $query[$d->prd_id]['p'] = $d;
             $query[$d->prd_id]['i']  = $this->db
                                                    ->where('product_images.prdimg_prd_id',$d->prd_id)
                                                    ->order_by('product_images.prdimg_id','DESC')
                                                    ->get('product_images')->row();
           }

      return $query;
    }

}

?>