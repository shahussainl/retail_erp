<?php

class Login_m extends CI_Model {
    public function activeUserInfo(){
        return $this->db->where('user_id', $this->session->userdata('user')['user_id'])->get('users')->row();
    }
}