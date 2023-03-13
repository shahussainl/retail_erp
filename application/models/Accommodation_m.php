<?php

class Accommodation_m extends CI_Model {
    public function getAllAccommodationDetail(){
        return $this->db
                ->join('accommodation_category','accommodation_category.category_id = accommodation.accommodation_category')
                ->where('accommodation_status',0)
                ->get('accommodation')->result();
    }
}