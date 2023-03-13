<?php

class Stock_m extends CI_Model {

    public function getAllStock() {
        $result = [];
        $items = $this
                        ->db
                        ->join('unit', 'unit.unit_id = product.prd_unit_id')
                        ->get('product')->result();

        foreach ($items as $itm) {
            $result[$itm->prd_id]['item'] = $itm;
            $result[$itm->prd_id]['image'] = $this->db->where('prdimg_prd_id', $itm->prd_id)->limit(1)->order_by('prdimg_id', 'DESC')->get('product_images')->row();
            $result[$itm->prd_id]['qty'] = $this->db->select('SUM(storeitem_quantity) as total')->where('status', '+')->where('storeitem_item_id', $itm->prd_id)->get('store_items')->row();
            $result[$itm->prd_id]['qtyMinus'] = $this->db->select('SUM(storeitem_quantity) as total')->where('status', '-')->where('storeitem_item_id', $itm->prd_id)->get('store_items')->row();
            $result[$itm->prd_id]['last_stock'] = $this->db->select('date')->where('status', '+')->where('storeitem_item_id', $itm->prd_id)->order_by('storeitem_id', 'DESC')->get('store_items')->row();
        }

        return $result;
    }

    public function singleProduct($id) {

        $result = [];
        $result['item'] = $this->db->join('product_category', 'product_category.prdc_id=product.prd_prdc_id')
                        ->join('unit', 'unit.unit_id=product.prd_unit_id')
                        ->where('prd_id', $id)->get('product')->row();
        $result['image'] = $this->db->where('prdimg_prd_id', $id)->limit(1)->order_by('prdimg_id', 'DESC')->get('product_images')->row();
        $result['detail'] = $this->db->where('storeitem_item_id', $id)->get('store_items')->result();
        return $result;
    }

    public function getSingleProductPurchases($prd_id) {
        $totalPurcahse = '0';
        $a = $this->db
                ->select_sum('puritem_price')
                ->select_sum('puritem_qty')
                ->join('purchase', 'purchase.purchase_id = purchase_items.puritem_purchase_id')
                ->where('purchase_status != 3')
                ->where('puritem_item_id', $prd_id)
                ->get('purchase_items')
                ->row();
        if (!empty($a)) {
            $totalPurcahse = $a->puritem_price * $a->puritem_qty;
        }
        return $totalPurcahse;
    }

    public function getSingleProductPurchasesAVGUnitPrice($prd_id) {
        $order = '0';
        $totalPurcahse = '0';
        $unitPrice = 0;
        $qty = '0';
        $total = '0';
        $abc = '0';
        $a = $this->db
                ->select('puritem_price')
                ->select('puritem_qty')
                ->join('purchase', 'purchase.purchase_id = purchase_items.puritem_purchase_id')
                ->where('purchase_status != 3')
                ->where('puritem_item_id', $prd_id)
                ->get('purchase_items')
                ->result();
        if (!empty($a)) {
            foreach ($a as $l) {
                $qty += $l->puritem_qty;
                $pricePrice = $l->puritem_price * $l->puritem_qty;
                $total = $total + $pricePrice;
            }
        }
        if(!empty($qty)){
            $abc = $total / $qty;
        }
        return $abc;
    }

    public function getSingleProductSale($prd_id) {
        $totalSalePolised = '0';
        $totalSalePOS = '0';
        $a = $this->db
                ->select_sum('salitem_price')
                ->select_sum('salitem_qty')
                ->join('sales', 'sales.sales_id = sales_items.salitem_sales_id')
                ->where('sales_status', '0')
                ->where('salitem_item_id', $prd_id)
                ->get('sales_items')
                ->row();
        if (!empty($a)) {
            $totalSalePolised = $a->salitem_price * $a->salitem_qty;
        }

        $b = $this->db
                ->select_sum('pos_prd_price')
                ->select_sum('pos_prd_qty')
                ->join('pos', 'pos.pos_id = pos_items.pos_id')
                ->where('pos_status != 2')
                ->where('pos_items.prd_id', $prd_id)
                ->get('pos_items')
                ->row();
        if (!empty($b)) {
            $totalSalePOS = $b->pos_prd_price * $b->pos_prd_qty;
        }
        $total = $totalSalePolised + $totalSalePOS;
        return $total;
    }

    public function getAvgSalePrice($prd_id) {
        $totalSalePolised = '0';
        $totalSalePOS = '0';
        $sale_orders = 0;
        $totalPOSOrders = 0;
        $total = 0;
        $qty = 0;
        $polqty = 0;
        $t = 0;

        $a = $this->db
                ->select('salitem_price')
                ->select('salitem_qty')
                ->join('sales', 'sales.sales_id = sales_items.salitem_sales_id')
                ->where('sales_status', '0')
                ->where('salitem_item_id', $prd_id)
                ->get('sales_items')
                ->result();

        if (!empty($a)) {
            foreach ($a as $f) {
                $polqty += $a->salitem_qty;
                $totalSalePolised += $a->salitem_price * $a->salitem_qty;
            }
            $totalSalePolised = $totalSalePolised / $polqty;
        }

        $b = $this->db
                ->select('pos_prd_price')
                ->select('pos_prd_qty')
                ->join('pos', 'pos.pos_id = pos_items.pos_id')
                ->where('pos_status != 2')
                ->where('pos_items.prd_id', $prd_id)
                ->get('pos_items')
                ->result();
        if (!empty($b)) {
            foreach ($b as $d) {
                $t += $d->pos_prd_price * $d->pos_prd_qty;
                $qty += $d->pos_prd_qty;
            }
            $total = $t / $qty;
        }
        if ($totalSalePolised != 0 && $total != 0) {
            $avg = ($totalSalePolised + $total) / 2;
        } else {
            if ($totalSalePolised == 0) {
                $avg = $total;
            } else {
                $avg = $totalSalePolised;
            }
        }



        return $avg;
    }
    
    public function getGraphDetails($id){
        $data = $this->db
                ->select('date,status,storeitem_quantity')
                ->where('storeitem_item_id',$id)
                ->get('store_items')
                ->result();
        $qty = 0;
        $arg = [];
   
        foreach($data as $d){
            $date = strtotime($d->date);
            if($d->status == '+'){
                $qty += $d->storeitem_quantity;
            }else{
                $qty -= $d->storeitem_quantity;
            }
   
            $arg[] = [
                $date,
                $qty
            ]; 
        }
        
            return json_encode($arg);
        
    }

}

?>