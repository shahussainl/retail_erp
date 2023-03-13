<?php

class Project extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    public function index() {
        $emp_role_id = '4';
        $result['employee'] = $this->Admin_m->getRecordWhere('users', ['user_role' => '4']);
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['data'] = $this->Project_m->getProjectDetail();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('project/index');
        $this->load->view('include/footer');
    }

    public function changeProjectStatus($status, $project_id) {
        $this->API_m->updateRecord('projects', ['project_id' => $project_id], ['project_status' => $status]);
        redirect('Project/index');
    }

    public function single($id) {
        $emp_role_id = '4';

        $result['user_info'] = $this->Login_m->activeUserInfo();
        $data['tasks'] = $this->Admin_m->get_all_tasks($id);
        $data['notes'] = $this->Admin_m->get_all_notes($id);
        $data['files'] = $this->Admin_m->get_all_files($id);
        $data['employee'] = $this->Admin_m->getRecordWhere('users', ['user_role' => $emp_role_id]);
// $data['tasks']	    =  $this->Admin_m->get('tasks');
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/projectsDetails', $data);
        $this->load->view('include/footer');
    }

    public function project_tasks($id) {
        $emp_role_id = '4';
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $data['tasks'] = $this->Admin_m->get_all_tasks($id);
        $data['notes'] = $this->Admin_m->get_all_notes($id);
        $data['files'] = $this->Admin_m->get_all_files($id);
        $data['employee'] = $this->Admin_m->getRecordWhere('users', ['user_role' => $emp_role_id]);
// $data['tasks']	    =  $this->Admin_m->get('tasks');
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');

        $this->load->view('admin/project_tasks', $data);
        $this->load->view('include/footer');
    }

    public function project_notes($id) {
        $emp_role_id = '4';
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $data['tasks'] = $this->Admin_m->get_all_tasks($id);
        $data['notes'] = $this->Admin_m->get_all_notes($id);
        $data['files'] = $this->Admin_m->get_all_files($id);
        $data['employee'] = $this->Admin_m->getRecordWhere('users', ['user_role' => $emp_role_id]);
        // $data['tasks']	    =  $this->Admin_m->get('tasks');
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/project_notes', $data);
        $this->load->view('include/footer');
    }

    public function project_uploads($id) {
        $emp_role_id = '4';
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $data['tasks'] = $this->Admin_m->get_all_tasks($id);
        $data['notes'] = $this->Admin_m->get_all_notes($id);
        $data['files'] = $this->Admin_m->get_all_files($id);
        $data['employee'] = $this->Admin_m->getRecordWhere('users', ['user_role' => $emp_role_id]);
        // $data['tasks']	    =  $this->Admin_m->get('tasks');
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/project_uploads', $data);
        $this->load->view('include/footer');
    }

    public function changePriority($task_id, $priority, $project_id) {

        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], ['priority' => $priority]);
        redirect('Project/Project_tasks/' . $project_id);
    }

    public function changeTaskType($task_id, $task_type, $project_id) {

        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], ['task_type' => $task_type]);
        redirect('Project/Project_tasks/' . $project_id);
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
        
        redirect('Project/Project_tasks/' . $project_id);
    }

    public function addNote() {
        $note = $this->input->post('note');
        $pro_id = $this->input->post('project_id');
        $data = [
            'project_id' => $pro_id,
            'note_title' => $note,
            'note_description' => $note,
            'created_by' => $this->session->userdata('user')['user_id']
        ];

        $this->API_m->create('notes', $data);
        redirect('Tasks/kanban');
    }

    public function trashProject($id) {
        $this->API_m->updateRecord('projects', ['project_id' => $id], ['is_trash' => '1']);
        redirect('Tasks/kanban');
    }

    public function AddNewNote() {
        $project_id = $this->input->post('project_id');
        $note_title = $this->input->post('note_title');
        $note_description = $this->input->post('note_description');
        $data = [
            "project_id" => $project_id,
            "note_title" => $note_title,
            "note_description" => $note_description
        ];
        $this->API_m->create('notes',$data);
        redirect('Tasks/Notes');
    }
    
    public function project_calendar($id) {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        
//        echoprint_r($result['new']);
        
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/calender');
        $this->load->view('include/footer');
    }
    
    
     public function changeCheckProjectStatus() {
          $status = $this->input->post('status');
          if(isset($_POST['proj_id']))
          {
              foreach($_POST['proj_id'] as $prj_id)
              {
              $this->API_m->updateRecord('projects', ['project_id' => $prj_id], ['project_status' => $status]);
              }
          }
        redirect('Project/index');
    }
  
    public function deleteProject() {
          if(isset($_POST['proj_id']))
          {
              foreach($_POST['proj_id'] as $prj_id)
              {
              $task = $this->API_m->singleRecord('tasks', ['project_id' => $prj_id]);
              $this->API_m->delete('tasks_record', ['task_id' => $task->task_id]);
              $this->API_m->delete('tasks', ['project_id' => $prj_id]);
              $this->API_m->delete('projects', ['project_id' => $prj_id]);
              }
          }
        redirect('Project/index');
    }


}

?>