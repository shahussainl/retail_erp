<?php

class Notifications_m extends CI_Model 
{


	//this function is use to add value in database
    public function InsertActivity($table, $arg) {
         
        $result = $this->db->insert($table, $arg);
        // if (!$result) {
        //     return 0;
        // } else {
            // return $this->db->insert_id();
        // }
    }

    //this function is used to get single record 

    public function single($table, $id) {
        return $this->db->where($id)->get($table)->row();
    }

    public function getRecordWhere($table_name, $table_field_name_with_value) {
        return $this->db->where($table_field_name_with_value)->get($table_name)->result();
    }

    public function getAllNotifications($table,$table_field,$status)
    {
         return $this->db->where($table_field)->where($status)->order_by('notify_id','desc')->get($table)->result();
    }

}