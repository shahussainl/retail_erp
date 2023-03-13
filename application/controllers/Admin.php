<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
    }

    public function index() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $this->load->view('include/header', $result);
        $this->load->view('admin/index');
        $this->load->view('include/footer');
    }

    public function allUsers() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['users'] = $this->API_m->get('users');

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/all_users', $result);
        $this->load->view('include/footer');
    }

    public function addUser() {
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $contact = $this->input->post('contact');
        $address = $this->input->post('address');
        $password = $this->input->post('password');

        $role = $this->input->post('role');
        $pass = $this->password->hash($password);
        $img_name = $this->API_m->upload('user_images');

        $data = [
            "user_fname" => $first_name,
            "user_lname" => $last_name,
            "user_email" => $email,
            "user_contact" => $contact,
            "user_address" => $address,
            "user_role" => $role,
            "users_img" => $img_name,
            "user_password" => $pass,
        ];

        $this->API_m->create('users', $data);
        redirect('Admin/allUsers');
    }

    public function updateUserView($id) {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['users'] = $this->API_m->singleRecord('users', ['user_id' => $id]);

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/update_user', $result);
        $this->load->view('include/footer');
    }

    public function userDetail($user_id) {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['user'] = $this->API_m->singleRecord('users', ['user_id' => $user_id]);
        $result['sal_published'] = $this->Admin_m->getPolisedInvoice($user_id);
        $result['sal_vouchers'] = $this->Admin_m->getSaleInvoice($user_id);
        $result['pur_vouchers'] = $this->Admin_m->getPurchaseInvoice($user_id);
        $result['tasks'] = $this->API_m->get_all_tasks($user_id);
        $result['assign_to_me'] = $this->API_m->getAssignToMe($user_id);
        $result['prefix'] = $this->API_m->prefix();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/user_detail', $result);
        $this->load->view('include/footer');
    }

    public function updateUser() {

        $id = $this->input->post('user_id');

        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $contact = $this->input->post('contact');
        $address = $this->input->post('address');
        $role = $this->input->post('role');
        $img_name = $this->input->post('old_img_name');

        if ($_FILES['file']['name'] != '') {
            $img_name = $this->API_m->upload('user_images');
        }

        $data = [
            "user_fname" => $first_name,
            "user_lname" => $last_name,
            "user_email" => $email,
            "user_contact" => $contact,
            "user_address" => $address,
            "user_role" => $role,
            "users_img" => $img_name
        ];

        $arg = [
            'user_id' => $id,
        ];

        $this->API_m->updateRecord('users', $arg, $data);
        redirect('Admin/userDetail/' . $id);
    }

    public function emailVerification() {
        $count = $this->API_m->countAllRows('users', ['user_email' => $this->input->post('email')]);
        echo $count;
    }

//    public function Dashboard() {
//
//        $this->load->view('admin/header');
//        $this->load->view('admin/top_header');
//        $this->load->view('admin/asidebar_left');
//        $this->load->view('admin/dashboard');
//        $this->load->view('admin/asidebar_right');
//        $this->load->view('admin/footer');
//    }
// Usman Code  start

    public function Projects() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $data['data'] = $this->Admin_m->get('projects');
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/projects', $data);
        $this->load->view('include/footer');
    }

    public function AddNewProjects() {


        // $cus_role_id = '3';
        $emp_role_id = '4';

        $result['employee'] = $this->Admin_m->getRecordWhere('users', ['user_role' => $emp_role_id]);
        // $result['customer']    = $this->Admin_m->getRecordWhere('users',['user_role'=>$cus_role_id]);
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/Addprojects', $result);
        $this->load->view('include/footer');
    }

    public function ProjectDetails($id) {

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

// Project Crud
    public function DeleteProject($id) {
        $this->Admin_m->delete('projects', ['project_id' => $id]);

        redirect('Admin/Projects/');
    }

    public function AddNewProject() {
//         echo "<pre>";
//         extract($_POST);
//         print_r($_POST);
//         print_r($_FILES);
//         exit();

        $firstImage = '';
        // $projectOwner  = implode(" : ", $this->input->post('project_owner'));
        $projectemp = implode(" : ", $this->input->post('project_invite_emp'));
//        $projectemp    = $this->input->post('project_invite_emp');

        if ($_FILES['file']['name'] != '') {

            $firstImage = $this->Admin_m->upload('projects', "file");
        }
        // echo "<pre>";
        // 	print_r($_POST);
        // 	print_r($_FILES);
        // 	exit();
        $_POST['project_image'] = $firstImage;
        // $_POST['project_owner']      = $projectOwner;
        $_POST['project_invite_emp'] = $projectemp;

        //      echo "<pre>";
        // print_r($_POST);
        // exit();

        $this->Admin_m->create('projects', $_POST);
        redirect('Project/index');
    }

    public function UpdateProjects($id) {
        // echo "<pre>";
        // print_r($id);
        // exit();
        // $cus_role_id  = '3';
        $emp_role_id = '4';

        $result['employee'] = $this->Admin_m->getRecordWhere('users', ['user_role' => $emp_role_id]);
        // $result['customer']    = $this->Admin_m->getRecordWhere('users',['user_role'=>$cus_role_id]);
        $result['single'] = $this->Admin_m->single('projects', ['project_id' => $id]);
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/UpdateProject', $result);
        $this->load->view('include/footer');
    }

    public function update_projects($id) {
        // echo "<pre>";
        // print_r($id);
        // print_r($_POST);
        // print_r($_FILES);
        // exit();
        $firstImage = '';

        // $projectOwner = implode(" : ", $this->input->post('project_owner'));
        $projectemp = implode(" : ", $this->input->post('project_invite_emp'));
//        $projectemp   = $this->input->post('project_invite_emp');

        if ($_FILES['file']['name'] != '') {
            $firstImage = $this->Admin_m->upload('projects', "file");
        } else {
            $firstImage = $this->input->post('old_img_name');
        }




        // echo "<pre>";
        // print_r($id);
        // print_r($_POST);
        // print_r($firstImage);
        // print_r($_FILES);
        // exit();
        // $_POST['project_owner']      = $projectOwner;
        $_POST['project_invite_emp'] = $projectemp;

        $_POST['project_image'] = $firstImage;
        unset($_POST['old_img_name']);


        $this->Admin_m->update('projects', ['project_id' => $id], $_POST);

        redirect('Admin/projects');
    }

// Project crud ./end
    public function Tasks() {
        $result['user_info'] = $this->Login_m->activeUserInfo();

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/tasks');
        $this->load->view('include/footer');
    }

    public function TasksDetails($id) {
        // print_r($id);
        // exit();
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $data['last_status'] = $this->Admin_m->TaskLastStatus($id);
        $data['single_task'] = $this->Project_m->getSingleTaskDetails($id);
        //$data['all_project_tasks'] = $this->Admin_m->project_tasks();
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/tasksDetails', $data);
        $this->load->view('include/footer');
    }

    public function AddNewTask() {

        date_default_timezone_set('Asia/Karachi');
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $priority = '';
        $task_res_person = implode(" : ", $this->input->post('task_res_person'));
//        $task_res_person          =  $this->input->post('task_res_person');

        $_POST['task_res_person'] = $task_res_person;
        if (!empty($_POST['priority'])) {
            $priority = $_POST['priority'];
        } else {
            $priority = 'low';
        }
        $_POST['priority'] = $priority;
        $_POST['created_by'] = $this->session->userdata('user')['user_id'];
        $_POST['created_date'] = date('Y-m-d');
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $link_id = $_POST['project_id'];
        $this->Admin_m->create('tasks', $_POST);
        redirect('Project/Project_tasks/' . $link_id);
    }

    public function UpdateTask() {
        $title = $this->input->post('title');
        $dbColName = $this->input->post('dbColName');
        $task_id = $this->input->post('task_id');
        $data = [
            $dbColName => $title
        ];
        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], $data);
    }

    public function UpdateTaskStatus() {
        $title = $this->input->post('title');
        $dbColName = $this->input->post('dbColName');
        $task_id = $this->input->post('task_id');
        $data = [
            $dbColName => $title
        ];
        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], $data);


        $record = [
            "task_id" => $task_id,
            "task_rec_date" => date('Y-m-d H:i:s'),
            "task_updated_by" => $this->session->userdata('user')['user_id'],
            "task_status" => $title,
        ];
        $this->API_m->create('tasks_record', $record);
    }

    // delete single task function


    public function DeleteTask($task_id, $pro_id) {
        // print_r($file_id);
        // exit;

        $this->Admin_m->delete('tasks', ['task_id' => $task_id]);

        redirect('Project/project_tasks/' . $pro_id);
    }

    public function AddTaskStatus() {
        date_default_timezone_set('Asia/Karachi');
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $task_id = $_POST['task_id'];
        $status = $_POST['status'];

        $data = array(
            'task_id' => $task_id,
            'task_status' => $status,
            'task_updated_by' => $this->session->userdata('user')['user_id'],
            'task_rec_date' => date('Y-m-d H:i:s')
        );

        // echo "<pre>";
        // print_r($data);
        // exit();

        $result = $this->Admin_m->TaskStatusInsertion($data);

        // print_r($result);
        // exit();
    }

    public function PriorityUpdation() {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $task_id = $_POST['task_id'];
        $priority = $_POST['priority'];

        $data = array(
            "priority" => $priority
        );

        $result = $this->Admin_m->PriorityUpdation($data, $task_id);

        print_r($result);
        // print_r($result);
        // exit();
    }

    public function AddNewNote() {
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        // echo "<pre>";
        // print_r($_POST);
        // exit();
        $link_id = $_POST['project_id'];
        $_POST['created_by'] = $this->session->userdata('user')['user_id'];
        $this->Admin_m->create('notes', $_POST);
        redirect('project/project_notes/' . $link_id);
    }

    // delete Note function 
    public function DeleteNote($note_id, $pro_id) {
        // print_r($file_id);
        // exit;

        $this->Admin_m->delete('notes', ['note_id' => $note_id]);

        redirect('Admin/ProjectDetails/' . $pro_id);
    }

    public function AddNewFile() {

        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // exit();

        $firstImage = '';

        if ($_FILES['file']['name'] != '') {

            $firstImage = $this->Admin_m->upload('files', "file");
        }
        // echo "<pre>";
        //  print_r($_POST);
        //  print_r($_FILES);
        //  exit();
        $_POST['upload_file'] = $firstImage;
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_FILES);
        // exit();

        $link_id = $_POST['project_id'];
        $this->Admin_m->create('files', $_POST);

        redirect('Admin/ProjectDetails/' . $link_id);
    }

    public function DeleteFile($file_id, $pro_id) {
        // print_r($file_id);
        // exit;

        $this->Admin_m->delete('files', ['file_id' => $file_id]);

        redirect('Admin/ProjectDetails/' . $pro_id);
    }

    // ************** visitor list 

    public function visitorList() {

        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['visitors'] = $this->Admin_m->get('visitor_list');
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/visitorList', $result);
        $this->load->view('include/footer');
    }

    // public function AddNewVisitor()
    // {
    //     $result['user_info'] = $this->Login_m->activeUserInfo();
    //     $this->load->view('include/header',$result);
    //     $this->load->view('include/sidebar');
    //     $this->load->view('admin/AddNewVisitor');
    //     $this->load->view('include/footer');
    // }

    public function AddVisitor() {
        // print_r($_POST);
        // exit();

        $_POST['visit_created_by'] = $this->session->userdata('user')['user_id'];
        $_POST['visit_date'] = date('Y-m-d H:i:s');

        $this->Admin_m->create('visitor_list', $_POST);

        redirect('Admin/visitorList/');
    }

    public function DeleteVisitor($id) {
        $this->Admin_m->delete('visitor_list', ['visitor_id' => $id]);
        redirect('Admin/visitorList/');
    }

    // public function Up_Visitor($id)
    // {
    //     $result['user_info'] = $this->Login_m->activeUserInfo();
    //     $result['visitor']   = $this->Admin_m->single('visitor_list',['visitor_id'=>$id]);
    //     $this->load->view('include/header',$result);
    //     $this->load->view('include/sidebar');
    //     $this->load->view('admin/updatevisitor',$result);
    //     $this->load->view('include/footer');
    // }

    public function update_visitorList($id) {
        // echo "<pre>";
        // print_r($_POST);
        // exit();

        $_POST['visit_created_by'] = $this->session->userdata('user')['user_id'];
        $_POST['visit_date'] = date('Y-m-d H:i:s');

        $this->Admin_m->update('visitor_list', ['visitor_id' => $id], $_POST);

        redirect('Admin/visitorList');
    }

    public function deleteUserProfileImage() {
        echo $this->API_m->updateRecord('users', ['user_id' => $_POST['id']], ['users_img' => '']);
    }

    public function changePriority($task_id, $priority, $id) {

        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], ['priority' => $priority]);
        redirect('Admin/userDetail/' . $id);
    }

    public function changeTaskType($task_id, $task_type, $id) {

        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], ['task_type' => $task_type]);
        redirect('Admin/userDetail/' . $id);
    }

    public function changeTaskStatus($task_id, $task_status, $id) {

        $this->API_m->updateRecord('tasks', ['task_id' => $task_id], ['task_status' => $task_status]);

        $record = [
            "task_id" => $task_id,
            "task_rec_date" => date('Y-m-d H:i:s'),
            "task_updated_by" => $this->session->userdata('user')['user_id'],
            "task_status" => $task_status,
        ];
        $this->API_m->create('tasks_record', $record);

        redirect('Admin/userDetail/' . $id);
    }

    public function DeleteUserCreatedTask($task_id, $id) {
        $this->Admin_m->delete('tasks', ['task_id' => $task_id]);

        redirect('Admin/userDetail/' . $id);
    }

//    Syed Umair Shah code
    public function Configuration() {
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['record'] = $this->API_m->get_last_Rec('settings');
        $result['title'] = "Dashboard";
        $result['currencies'] = $this->API_m->get('currency');

        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('admin/home', $result);
        $this->load->view('include/footer');
        // redirect('Admin_c');
    }

    public function deleteLogo($id) {
        $this->API_m->updateRecord('settings', ['app_id' => $id], ['app_logo' => '']);
        redirect('Admin/Configuration');
    }

    public function deleteBackImage($id) {
        $this->API_m->updateRecord('settings', ['app_id' => $id], ['app_theme' => '']);
        redirect('Admin/Configuration');
    }

    public function put_data() {

        $r = $this->API_m->get_last_Rec('settings');
        // $q=$r->app_id;
//         echo"<pre>";
//         print_r($_FILES);
        // echo"</pre>";
//         exit;


        if ($_FILES['app_logo']['name'] != '') {

            $_FILES['file'] = $_FILES['app_logo'];
            $app_logo = $this->API_m->upload('configuration');
        } else {

            $app_logo = $this->input->post('old_logo');
        }
        if ($_FILES['app_theme']['name'] != '') {
            $_FILES['file'] = $_FILES['app_theme'];
            $app_theme = $this->API_m->upload('configuration');
        } else {
            $app_theme = $this->input->post('old_back_img');
        }


        $arr = array(
            'app_logo' => $app_logo,
            'app_theme' => $app_theme,
            'bill_prefix' => $this->input->post('bill_prefix'),
            'app_name' => $this->input->post('app_name'),
            'app_full_address' => $this->input->post('app_full_address'),
            'app_contact' => $this->input->post('app_contact'),
            'app_email' => $this->input->post('app_email'),
            'website' => $this->input->post('website'),
            'ntn' => $this->input->post('ntn'),
            'set_currency_id' => $this->input->post('set_currency_id')
        );

        if ($r) {

            $id = $r->app_id;

            $this->API_m->updateRecord("settings", ['app_id' => $id], $arr);
            redirect('Admin/configuration');
        } else {
//      echo "<pre>";
            // print_r($_POST);
            // exit();

            $this->API_m->create('settings', $arr);
            redirect('Admin/configuration');
        }
    }

    public function delete_rec($id) {
// print_r($id);
// exit();
        $this->API_m->delete("settings", ['app_id' => $id]);
        redirect('Admin/configuration');
    }

}

?>