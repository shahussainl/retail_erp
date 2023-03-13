<?php

class Project_m extends CI_Model {
    function getProjectDetailsByStatus($status){
        $a =  $this->db
                ->where('project_status',$status)
                ->where('is_trash',0)
                ->get('projects')->result();
        $result = [];
        foreach($a as $b){
            $result[$b->project_id]['project'] = $b;
            $result[$b->project_id]['notes'] = $this->db
                    ->join('users','users.user_id = notes.created_by')
                    ->where('project_id',$b->project_id)
                    ->get('notes')->result();
            $result[$b->project_id]['tasks'] = $this->db
                    ->where('project_id',$b->project_id)
                    ->where('task_status','Lock')
                    ->get('tasks')->result();
        }
        return $result;
        
    }
    
    function getProjectDetail(){
        return $this->db
                ->join('users','users.user_id = projects.project_team_lead')
                ->where('is_trash',0)
                ->get('projects')->result();
    }
    
    function getTaskOnGoing(){
        return $this->db
                ->where('task_status != "Lock" OR `task_status` is null')
                ->get('tasks')->result();
    }
    function getSingleTaskDetails($id){
        return $this->db
                ->join('projects','projects.project_id = tasks.project_id')
                ->join('users','users.user_id = tasks.created_by')
                ->where('task_id',$id)
                ->get('tasks')
                ->row();
    }
}
?>    