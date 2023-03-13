<?php

class Sales_m extends CI_Model {

    public function getProductDetail($dbColName, $value) {
        return $this->db
                        ->join('product_category', 'product_category.prdc_id = product.prd_prdc_id','left')
                        ->join('unit', 'unit.unit_id = product.prd_unit_id','left')
                        ->where('prd_is_sale = 1 AND (prd_status=0  OR prd_status IS NULL)')
                        ->where($dbColName, $value)
                        ->get('product')->row();
    }

    public function getSalesNo() {
        return $this->db->count_all_results('sales');
    }

    public function getSingleSaleVoucherDetail($id) {
        $purchase = $this->db
                        ->join('users','users.user_id = sales.sales_vendor_id')
                        ->where('sales.sales_id', $id)
                        ->get('sales')->row();
        $a = [];
        $a['sales'] = $purchase;
        $a['items'] = $this->db
                        ->join('product', 'product.prd_id = sales_items.salitem_item_id')
                        ->join('unit', 'unit.unit_id = product.prd_unit_id')
                        ->where('salitem_sales_id', $id)->get('sales_items')->result();
        $a['payment_history'] = $this->db->select('*,sales_payment.sal_ref_id')
                        ->join('sales', 'sales.sales_id = sales_payment.salpayment_sales_id', 'left')
                        ->where('salpayment_sales_id', $id)->get('sales_payment')->result();

        $a['tax_history'] = $this->db
                        ->join('sales', 'sales.sales_id = tax_amount.sales_item_id', 'left')
                        ->where('sales_item_id', $id)->get('tax_amount')->result();

        return $a;
    }

//    this function is used to get total sales income
    public function getTotalSales() {
        return $this->db->select_sum('general_journal_credit')->where('general_journal_head', 8)->get('general_journal')->row();
    }

    public function getTotalDiscountAllowed() {
        return $this->db->select_sum('general_journal_debit')->where('general_journal_head', 10)->get('general_journal')->row();
    }

    public function getTotalSaleReceivable() {
        return $this->db->select('(sum(`general_journal_debit`) - sum(`general_journal_credit`)) AS `sales_receivable`')
                        ->where('`general_journal_head` = 13')
                        ->get('general_journal')->row();
    }

    public function getOpenInvDetails() {
        $a = $this->db->where('post_status = 1 AND sales_status != 1  AND sale_closing_status != "1" and (is_ref = 0 OR is_ref IS Null)')
                        ->get('sales')->result();

        $result = [];
        foreach ($a as $b) {
            $result[$b->sales_id]['sales_data'] = $b;
            $result[$b->sales_id]['pay_amt'] = $this->db->select_sum('salpayment_amount')
                            ->where('salpayment_sales_id', $b->sales_id)
                            ->get('sales_payment')->row();
        }
        return $result;
    }

    public function getOpenInvBalance() {
        $a = $this->db->where('post_status = 1 AND sales_status != 1  AND sale_closing_status != "1" and (is_ref = 0 OR is_ref IS Null)')
                        ->get('sales')->result();

        $result = [];
        foreach ($a as $b) {
            $result[$b->sales_id]['sales_data'] = $b;
            $result[$b->sales_id]['pay_amt'] = $this->db->select_sum('salpayment_amount')
                            ->where('salpayment_sales_id', $b->sales_id)
                            ->get('sales_payment')->row();
        }
        $totalamt = 0;
        $paidamt = 0;
        foreach ($result as $r) {

            $totalamt = $totalamt + $r['sales_data']->sales_bill_total;
            $paidamt = $r['pay_amt']->salpayment_amount;
        }
        return $totalamt - $paidamt;
    }

    public function getClosedInvBalance() {
        $a = $this->db->where('post_status = 1 AND sales_status != 1  AND sale_closing_status = "1" and (is_ref = 0 OR is_ref IS Null)')
                        ->get('sales')->result();
        $totalamt = 0;
        foreach ($a as $r) {
            $totalamt = $totalamt + $r->sales_bill_total;
        }
        return $totalamt;
    }

    public function monthlySalesAvg() {
        $a = $this->db
                        ->select('MONTH(general_journal_date) as month')
                        ->select_sum('general_journal_credit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account.coa_id', '8')
                        ->where('YEAR(general_journal_date)', date('Y'))
                        ->group_by('MONTH(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = 1; $i <= 12; $i++) {
            foreach ($a as $re) {
                if ($re->month == $i) {
                    $arr[$i] = $re->general_journal_credit;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }
        return $arr;
    }
    
    public function yearlySalesAvg() {
        $currentYear = date('Y');
        $prevYear = $currentYear - 5;
        $nextYear = $currentYear + 6;
        $a = $this->db
                        ->select('YEAR(general_journal_date) as year')
                        ->select_sum('general_journal_credit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account.coa_id', '8')
                        ->where('YEAR(general_journal_date) >' . $prevYear)
                        ->where('YEAR(general_journal_date) <=' . $nextYear)
                        ->group_by('YEAR(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = $prevYear; $i <= $nextYear; $i++) {
            foreach ($a as $re) {
                if ($re->year == $i) {
                    $arr[$i] = $re->general_journal_credit;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }
        return $arr;
    }

    public function monthlyRevenueAvg() {
        $a = $this->db
                        ->select('MONTH(general_journal_date) as month')
                        ->select_sum('general_journal_debit')
                        ->select_sum('general_journal_credit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account_subtype.coa_subtype_typeid', '2')
                        ->where('YEAR(general_journal_date)', date('Y'))
                        ->group_by('MONTH(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = 1; $i <= 12; $i++) {
            foreach ($a as $re) {
                if ($re->month == $i) {
                    $arr[$i] = $re->general_journal_credit - $re->general_journal_debit;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }
        return $arr;
        
    }
    public function monthlyDiscountAvg() {
        $a = $this->db
                        ->select('MONTH(general_journal_date) as month')
                        ->select_sum('general_journal_debit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account.coa_id', '10')
                        ->where('YEAR(general_journal_date)', date('Y'))
                        ->group_by('MONTH(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = 1; $i <= 12; $i++) {
            foreach ($a as $re) {
                if ($re->month == $i) {
                    $arr[$i] = $re->general_journal_debit;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }
        return $arr;
    }
    public function yearlyDiscountAvg() {
        $currentYear = date('Y');
        $prevYear = $currentYear - 5;
        $nextYear = $currentYear + 6;
        $a = $this->db
                        ->select('YEAR(general_journal_date) as year')
                        ->select_sum('general_journal_debit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account.coa_id', '10')
                        ->where('YEAR(general_journal_date) >' . $prevYear)
                        ->where('YEAR(general_journal_date) <=' . $nextYear)
                        ->group_by('YEAR(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = $prevYear; $i <= $nextYear; $i++) {
            foreach ($a as $re) {
                if ($re->year == $i) {
                    $arr[$i] = $re->general_journal_debit;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }
        return $arr;
    }
    public function yearlyRevenueAvg() {
        $currentYear = date('Y');
        $prevYear = $currentYear - 5;
        $nextYear = $currentYear + 6;
        $a = $this->db
                        ->select('YEAR(general_journal_date) as year')
                        ->select_sum('general_journal_debit')
                ->select_sum('general_journal_credit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account_subtype.coa_subtype_typeid', '2')
                        ->where('YEAR(general_journal_date) >' . $prevYear)
                        ->where('YEAR(general_journal_date) <=' . $nextYear)
                        ->group_by('YEAR(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = $prevYear; $i <= $nextYear; $i++) {
            foreach ($a as $re) {
                if ($re->year == $i) {
                    $arr[$i] = $re->general_journal_credit ;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }
        return $arr;
    }

    public function totalExpense() {

        $general_journal_debit = 0;
        $data =  $this->db
                                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                                        ->where('chart_of_account_subtype.coa_subtype_typeid', '4')
                                        ->where('general_journal.general_journal_source', 'PAYMENT')
                                        ->get('general_journal')->result();
        foreach($data as $d)
        {
            $general_journal_debit = $general_journal_debit + $d->general_journal_debit;
        }
       return  $general_journal_debit;
    }

    public function expenseAccountHeads() {

        return $this->db
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->join('chart_of_account_type', 'chart_of_account_type.coa_type_id = chart_of_account_subtype.coa_subtype_typeid')
                        ->where('chart_of_account_subtype.coa_subtype_typeid', '4')
                        ->get('chart_of_account')->result();
    }

    public function getPendingExpense() {

        $data =  $this->db
                        ->join('voucher', 'voucher.voucher_id = voucher_heads.voucher_id')
                        ->where('voucher.voucher_type', 'PAYMENT')
                        ->where('voucher.post_status', '0')
                        ->get('voucher_heads')->result();
        $total = 0;
        foreach($data as $d)
        {
            $total = $total + $d->amount;
        }
        return $total;
    }

    public function salaryPaid() {
        $general_journal_debit = 0;
        $data =  $this->db
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->where('chart_of_account.coa_subtypeid', '9')
                        ->where('general_journal.general_journal_source', 'PAYMENT')
                        ->get('general_journal')->result();
        
        foreach($data as $d)
        {
            $general_journal_debit = $general_journal_debit + $d->general_journal_debit;
        }
        
        return $general_journal_debit;
    }

    public function getExpenseMonthly() {

        $a = $this->db
                        ->select('MONTH(general_journal_date) as month')
                        ->select_sum('general_journal_debit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account_subtype.coa_subtype_typeid', '4')
                        ->where('general_journal.general_journal_source', 'PAYMENT')
                        ->where('YEAR(general_journal_date)', date('Y'))
                        ->group_by('MONTH(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = 1; $i <= 12; $i++) {
            foreach ($a as $re) {
                if ($re->month == $i) {
                    $arr[$i] = $re->general_journal_debit;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }

        return $arr;
    }

    public function getSalaryPaidMonthly() {



        $a = $this->db
                        ->select('MONTH(general_journal_date) as month')
                        ->select_sum('general_journal_debit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account.coa_subtypeid', '9')
                        ->where('general_journal.general_journal_source', 'PAYMENT')
                        ->where('YEAR(general_journal_date)', date('Y'))
                        ->group_by('MONTH(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = 1; $i <= 12; $i++) {
            foreach ($a as $re) {
                if ($re->month == $i) {
                    $arr[$i] = $re->general_journal_debit;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }

        return $arr;
    }

    public function getTotalExpense() {
        $amount = 0;
        $data =  $this->db
                        ->join('voucher', 'voucher.voucher_id = voucher_heads.voucher_id')
                        ->where('voucher.voucher_type', 'PAYMENT')
                        ->get('voucher_heads')->result();
        foreach($data as $d)
        {
          $amount = $amount + $d->amount;
        }
        
        return $amount;
    }

    public function getExpenseYearly() {

        $currentYear = date('Y');
        $prevYear = $currentYear - 5;
        $nextYear = $currentYear + 6;
        $a = $this->db
                        ->select('YEAR(general_journal_date) as year')
                        ->select_sum('general_journal_debit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account_subtype.coa_subtype_typeid', '4')
                        ->where('general_journal.general_journal_source', 'PAYMENT')
                        ->where('YEAR(general_journal_date) >' . $prevYear)
                        ->where('YEAR(general_journal_date) <=' . $nextYear)
                        ->group_by('YEAR(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = $prevYear; $i <= $nextYear; $i++) {
            foreach ($a as $re) {
                if ($re->year == $i) {
                    $arr[$i] = $re->general_journal_debit;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }

        return $arr;
    }

    public function getSalaryPaidYearly() {

        $currentYear = date('Y');
        $prevYear = $currentYear - 5;
        $nextYear = $currentYear + 6;

        $a = $this->db
                        ->select('YEAR(general_journal_date) as year')
                        ->select_sum('general_journal_debit')
                        ->join('chart_of_account', 'chart_of_account.coa_id = general_journal.general_journal_head')
                        ->join('chart_of_account_subtype', 'chart_of_account_subtype.coa_subtype_id = chart_of_account.coa_subtypeid')
                        ->where('chart_of_account.coa_subtypeid', '9')
                        ->where('general_journal.general_journal_source', 'PAYMENT')
                        ->where('YEAR(general_journal_date) >' . $prevYear)
                        ->where('YEAR(general_journal_date) <=' . $nextYear)
                        ->group_by('YEAR(general_journal_date)')
                        ->get('general_journal')->result();
        $arr = [];
        for ($i = $prevYear; $i <= $nextYear; $i++) {
            foreach ($a as $re) {
                if ($re->year == $i) {
                    $arr[$i] = $re->general_journal_debit;
                }
                if (empty($arr[$i])) {
                    $arr[$i] = 0;
                }
            }
        }

        return $arr;
    }
    
    public function all_sale_vouchers(){
       $qry =  $this->db
               ->join('users','users.user_id = sales.sales_vendor_id','left')
               ->where('sales_status',0)
                ->get('sales')
                ->result();
        $arr = [];
        $count = 1;
        foreach($qry as $single_bill){
        $arr[$count]['info'] = $single_bill;
        $arr[$count]['items'] = $this->db->where('salitem_sales_id',$single_bill->sales_id)->join('product','`product`.`prd_id` = `sales_items`.`salitem_item_id`')->get('sales_items')->result();
        $arr[$count]['receipt'] = $this->db->where('salpayment_sales_id',$single_bill->sales_id)->get('sales_payment')->result();
        $count++;
        }      
        
     return $arr;
    }
    
    
    public function sale_vouchers_condition($condition){
       $qry =  $this->db
               ->join('users','users.user_id = sales.sales_vendor_id')
               ->where($condition)
                ->get('sales')
                ->result();
        $arr = [];
        $count = 1;
        foreach($qry as $single_bill){
        $arr[$count]['info'] = $single_bill;
        $arr[$count]['items'] = $this->db->where('salitem_sales_id',$single_bill->sales_id)->join('product','`product`.`prd_id` = `sales_items`.`salitem_item_id`')->get('sales_items')->result();
        $arr[$count]['receipt'] = $this->db->where('salpayment_sales_id',$single_bill->sales_id)->get('sales_payment')->result();
        $count++;
        }       
        
     return $arr;
     
    }
    public function receipt_vouchers(){
       $qry =  $this->db
               ->join('sales','sales.sales_id = receipt.inv_id')
               ->join('users','users.user_id = sales.sales_vendor_id')
                ->get('receipt')
                ->result();
        
        
     return $qry;
     
    }

}
