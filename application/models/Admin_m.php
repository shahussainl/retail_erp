<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model {
    
    public function getSelectedCurrency(){
        return $this->db->join('currency','currency.currency_id = settings.set_currency_id')->get('settings')->row();
    }

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


// get all tasks of a single project

 public function get_all_tasks($id)
 {
   $result =  $this->db->select('*')
                       ->from('projects as pro')
                       ->join('tasks as tsk','tsk.project_id=pro.project_id')
                       ->where('pro.project_id',$id)
                       ->get()->result_array();

     if($result)
     {
        return $result;
     }   
     else
     {
        return false;
     }
 }

// code for Notes 
 public function get_all_notes($id)
 {
   $result =  $this->db->select('*')
                       ->from('projects as pro')
                       ->join('notes as nt','nt.project_id=pro.project_id')
                       ->where('pro.project_id',$id)
                       ->get()->result_array();

     if($result)
     {
        return $result;
     }   
     else
     {
        return false;
     }
 }

// code for files
 public function get_all_files($id)
 {
    $result =  $this->db->select('*')
                       ->from('projects as pro')
                       ->join('files as fl','fl.project_id=pro.project_id')
                       ->where('pro.project_id',$id)
                       ->get()->result_array();

     if($result)
     {
        return $result;
     }   
     else
     {
        return false;
     }
 }
 // code for task status insertion 

    public function TaskStatusInsertion($data)
    {
        $result =  $this->db->insert('tasks_record',$data);

          if(!$result) 
          {
            return 0;
          }
          else
          {
            return $this->db->select('*')
                            ->from('tasks_record')
                            ->limit(1)
                            ->order_by('task_rec_id','desc')
                            ->get()->result_array();
          }
    }

// showing last status of task 
    public function TaskLastStatus($id)
    {
        return $this->db->select('*')
                        ->from('tasks_record')
                        ->where('task_id',$id)
                        ->limit(1)
                        ->order_by('task_rec_id','desc')
                        ->get()->row_array();
    }

    public function PriorityUpdation($data,$task_id)
    {
        $result = $this->db->where('task_id',$task_id)->update('tasks',$data);
         if($result)
         {
            return true;
         }  
         else
         {
            return false;
         }   
    }

    public function getPolisedInvoice($user_id)
    {
        $result = [];
        $row = $this->db->where('user_id',$user_id)->get('users')->row();
        
        if($row->user_role == 3)
        {
          $result =  $this->db->select('*')
                                   ->from('sales')
                                   ->join('users','users.user_id=sales.sales_vendor_id')
                                   ->where('sales_vendor_id',$user_id)
                                   ->get()->result();
        }
        else
        {
         $result =  $this->db->select('*')
                                   ->from('sales')
                                   ->join('users','users.user_id=sales.sales_vendor_id')
                                   ->where('sales_created_by',$user_id)
                                   ->get()->result();
        }
        
        return $result;
    }

     public function getSaleInvoice($user_id)
    {
        
        return $result =  $this->db->select('*')
                                   ->from('pos')
                                   ->join('users','users.user_id=pos.pos_created_by')
                                   ->where('pos_created_by',$user_id)
                                   ->get()->result();
    }

    public function getPurchaseInvoice($user_id)
    {
        $result = [];
        $row = $this->db->where('user_id',$user_id)->get('users')->row();
        
        if($row->user_role == 3)
        {
           $result =  $this->db->select('*')
                                   ->from('purchase')
                                   ->join('users','users.user_id=purchase.purchase_vendor_id')
                                   ->where('purchase_vendor_id',$user_id)
                                   ->get()->result(); 
        }
        else
        {
          $result =  $this->db->select('*')
                                   ->from('purchase')
                                   ->join('users','users.user_id=purchase.purchase_vendor_id')
                                   ->where('purchase_created_by',$user_id)
                                   ->get()->result();
        
        }
        return $result;
    }
        public function get_raw_products(){
        $qry =  $this->db
                    ->where('prd_is_raw',1)
                    ->get('product')
                    ->result();
        return $qry;
    }
}

?>