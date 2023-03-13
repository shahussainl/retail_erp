<?php

class Login extends CI_Controller {

    public function index() {
        $this->load->view('login');
    }

    public function loginUser() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $condition = [
            'user_email' => $email,
        ];
        $returnedData = $this->API_m->singleRecordArray('users', $condition);
        $size = sizeof($returnedData);
        if ($size == 1) {
            foreach ($returnedData as $user) {
                if ($this->password->verify_hash($password, $user->user_password)) {

                    $sessionData = [
                        'user_id' => $user->user_id,
                        'user_email' => $user->user_email,
                        'role' => $user->user_role,
                    ];
                    $this->session->set_userdata('user', $sessionData);

                    $activity = [
                    
                    'notify_operation'     => 'session start',
                    'notify_activity_on'   => 'Login',
                    'activity_name'        =>  'login',
                    'notify_created_for'   => $this->session->userdata('user')['user_id'],
                    'modify_date'          => date('Y-m-d H:i:s')
                ];


        $this->Notifications_m->InsertActivity('notifications',$activity);

                    redirect('Dashboard');
                } else {
                    redirect('Login');
                }
            }
        } else {
            redirect('Login');
        }
    }
    public function logout(){

        $activity = [
                    
                    'notify_operation'     => 'session destroy',
                    'notify_activity_on'   => 'Logout',
                    'activity_name'        =>  'logout',
                    'notify_created_for'   => $this->session->userdata('user')['user_id'],
                    'modify_date'          => date('Y-m-d H:i:s')
                ];


        $this->Notifications_m->InsertActivity('notifications',$activity);

        unset($_SESSION['user']);
        redirect('Login');
    }

}
