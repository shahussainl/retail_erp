<?php

class Vouchers_m extends CI_Model {
    public function getAllExpenseAccount(){
        return $this->db
                ->join('chart_of_account_subtype','chart_of_account_subtype.coa_subtype_id=chart_of_account.coa_subtypeid')
                ->where('coa_subtype_typeid','4')
                ->or_where('coa_subtype_typeid','3')
                ->get('chart_of_account')
                ->result();
    }
    public function getAllAssetsAccount(){
        return $this->db
                ->join('chart_of_account_subtype','chart_of_account_subtype.coa_subtype_id=chart_of_account.coa_subtypeid')
                ->where('coa_subtype_typeid','1')
                ->or_where('coa_subtype_typeid','2')
                ->get('chart_of_account')
                ->result();
    }
    public function getAllAssetsAccountExIncome(){ // assets except incomes
        return $this->db
                ->join('chart_of_account_subtype','chart_of_account_subtype.coa_subtype_id=chart_of_account.coa_subtypeid')
                ->where('coa_subtype_typeid','1')
                ->get('chart_of_account')
                ->result();
    }
    public function getAllExpenseAccountInIncome(){ // expense include incomes
        return $this->db
                ->join('chart_of_account_subtype','chart_of_account_subtype.coa_subtype_id=chart_of_account.coa_subtypeid')
                ->where('coa_subtype_typeid','4')
                ->or_where('coa_subtype_typeid','2')
                ->or_where('coa_subtype_typeid','3')
                ->get('chart_of_account')
                ->result();
    }
    
    public function getAllChartOfAccounts(){
        return $this->db
                ->join('chart_of_account_subtype','chart_of_account_subtype.coa_subtype_id=chart_of_account.coa_subtypeid')
                ->join('chart_of_account_type','chart_of_account_type.coa_type_id=chart_of_account_subtype.coa_subtype_typeid')
                ->get('chart_of_account')
                ->result();
    }
    
    public function getSubtypeAssets() {
        return $this->db
                ->join('chart_of_account_type','chart_of_account_type.coa_type_id=chart_of_account_subtype.coa_subtype_typeid')
                ->where('coa_subtype_typeid',1)
                ->get('chart_of_account_subtype')->result();
    }


    public function getExpsendVoucherHead() {
        return $this->db
                ->join('chart_of_account_subtype','chart_of_account_subtype.coa_subtype_id=chart_of_account.coa_subtypeid')
                ->where('coa_subtype_typeid',4)
                ->get('chart_of_account')->result();
    }

    public function getSingleVoucherInformation($id){
        $a =  $this->db
                ->where('voucher_id',$id)
                ->get('voucher')->result();
        $result = [];
        foreach($a as $b){
            $result[$b->voucher_id]['voucher'] = $b;
            $result[$b->voucher_id]['voucher_heads'] = $this->API_m->singleRecordArray('voucher_heads', ['voucher_id'=>$b->voucher_id]);
        }
        return $result;
    }
    
    public function getGjAlldata() {
        return $this->db
                ->join('chart_of_account','chart_of_account.coa_id=general_journal.general_journal_head')
                ->get('general_journal')->result();
    }
   
     public function getSingleVoucherPrintableInformation($id){
        $result = [];
        $result['voucher'] = $this->db->select('*,cancalBy.user_fname as fname,cancalBy.user_lname as lname')->join('users as cancalBy','cancalBy.user_id=voucher.voucher_cancelation_by','left')->join('users','users.user_id=voucher.voucher_created_by')->where('voucher_id',$id)->get('voucher')->row();
        $result['voucher_heads'] = $this->db->select('from_coa.coa_name as from,for_coa.coa_name as for,voucher_heads.amount as amount')->join('chart_of_account as from_coa','from_coa.coa_id=voucher_heads.from_A_H')->join('chart_of_account as for_coa','for_coa.coa_id=voucher_heads.for_A_H')->where('voucher_id', $id)->get('voucher_heads')->result();
      
        return $result;
    }
    
     public function getReceiptVoucherHead() {
        return $this->db
                ->join('chart_of_account_subtype','chart_of_account_subtype.coa_subtype_id=chart_of_account.coa_subtypeid')
                ->where('coa_subtype_typeid',2)
                ->get('chart_of_account')->result();
    }
    
    public function getTriBlance()
    {
       $data =  $this->db->get('chart_of_account_subtype')->result(); 
       $result = [];
       foreach ($data as $d)
       {
          $result[$d->coa_subtype_id]['data'] = $d;    
          $result[$d->coa_subtype_id]['amount'] = $this->db->select('SUM(general_journal_debit) as debit , SUM(general_journal_credit) as credit')->join('general_journal','general_journal.general_journal_head=chart_of_account.coa_id')->where('chart_of_account.coa_subtypeid',$d->coa_subtype_id)->get('chart_of_account')->row();    
       }
       
       return $result;
       
    }
    
}
