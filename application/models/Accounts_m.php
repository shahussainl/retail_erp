<?php

class Accounts_m extends CI_Model {

    public function get_subtype($id){
        return $this->db
                ->where('coa_subtype_typeid',$id)
                ->get('chart_of_account_subtype')
                ->result();
    }


    public function single($table, $id) {
        return $this->db->where($id)->get($table)->row();
    }


//this function is use to get all record of a single table

    public function get($table) {
        return $this->db->get($table)->result();
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

   
}
