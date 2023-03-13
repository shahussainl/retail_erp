<?php

class Tasks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    public function index() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('tasks/index');
        $this->load->view('include/footer');
    }
    
    public function ongoing() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['tasks'] = $this->Project_m->getTaskOnGoing();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('tasks/ongoing');
        $this->load->view('include/footer');
    }
    public function changePriority($task_id, $priority, $project_id) {

        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], ['priority' => $priority]);
        redirect('Tasks/ongoing');
    }

    public function changeTaskType($task_id, $task_type, $project_id) {

        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], ['task_type' => $task_type]);
        redirect('Tasks/ongoing');
    }

    public function changeTaskStatus($task_id, $task_status, $project_id) {

        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], ['task_status' => $task_status]);
        
        $record = [
            "task_id" =>$task_id,
            "task_rec_date" =>date('Y-m-d H:i:s'),
            "task_updated_by" => $this->session->userdata('user')['user_id'],
            "task_status" =>$task_status,
        ];
        $this->API_m->create('tasks_record',$record);
        redirect('Tasks/ongoing');
    }
    
    public function Completed() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['tasks'] = $this->API_m->singleRecordArray('tasks',['task_status' => 'Lock']);
        
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('tasks/completed');
        $this->load->view('include/footer');
    }
    
    public function Kanban() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['new'] = $this->Project_m->getProjectDetailsByStatus(0);
        $result['enagage'] = $this->Project_m->getProjectDetailsByStatus(1);
        $result['lead'] = $this->Project_m->getProjectDetailsByStatus(2);
        $result['qualified'] = $this->Project_m->getProjectDetailsByStatus(3);
        
//        echoprint_r($result['new']);
        
        
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('tasks/index');
        $this->load->view('include/footer');
    }
    
    public function Notes() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['notes'] = $this->API_m->get('notes');
        $result['projects'] = $this->API_m->singleRecordArray('projects',['is_trash' => '0']);
        
//        echoprint_r($result['new']);
        
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('tasks/notes');
        $this->load->view('include/footer');
    }
    
    public function Calender(){
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['notes'] = $this->API_m->get('notes');
        
//        echoprint_r($result['new']);
        
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('tasks/calender');
        $this->load->view('include/footer');
    }

    public function updateProjectStatus()
    {
        echo $this->API_m->updateRecord('projects',['project_id'=>$_POST['id']],['project_status'=>$_POST['status']]);
    }
    
      public function changeCheckedTaskStatus() {
        $task_status = $this->input->post('status');
        if(isset($_POST['task']))
        {
          foreach($_POST['task'] as $task)
          {
               $this->API_m->updateRecord('tasks', ['task_id' => $task], ['task_status' => $task_status]);

                $record = [
                    "task_id" => $task,
                    "task_rec_date" => date('Y-m-d H:i:s'),
                    "task_updated_by" => $this->session->userdata('user')['user_id'],
                    "task_status" => $task_status,
                ];
                $this->API_m->create('tasks_record', $record);
            }
        }
        
        redirect('Tasks/ongoing');  
    }
    
          public function deleteCheckedTask() {
        $task_status = $this->input->post('status');
        if(isset($_POST['task']))
        {
          foreach($_POST['task'] as $task)
          {
                
                $this->API_m->delete('tasks_record', ['task_id' => $task]);
                $this->API_m->delete('tasks', ['task_id' => $task]);
           }
        }
        
        redirect('Tasks/ongoing');  
    }
}
?>