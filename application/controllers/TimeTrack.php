<?php

defined('BASEPATH') or exit('No direct script access  allowed!');

// ************ Usman Code
class TimeTrack extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user')['user_id']) {
            redirect('Login');
        }
        date_default_timezone_set('Asia/Karachi');
    }

    public function index() {
        $user_id = $this->session->userdata('user')['user_id'];
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['timer'] = $this->TimeTrack_m->get_all_times_logs($user_id);
        $result['getTodayRecord'] = $this->TimeTrack_m->getTodayRecord($user_id);
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('timetrack/timer_dash', $result);
        $this->load->view('include/footer');
    }

// ******** Usman, Code for start New Timer Activity
    public function StartActivity() {

        $status = $_POST['status'];


        $data = array(
            'user_id' => $this->session->userdata('user')['user_id'],
            'timer_date' => date('Y-m-d H:i:s'),
            'timer_current_day' => date('Y-m-d')
        );

        $timer_id = $this->TimeTrack_m->create('timer', $data);
        $timer_record = array(
            'timer_id' => $timer_id,
            'timer_record_status' => $status,
            'timer_record_date' => date('Y-m-d H:i:s')
        );


        $this->TimeTrack_m->create('timer_record', $timer_record);


        print_r($timer_id);


        // print_r($time_data);
        // exit();
        // redirect('TimeTrack/');
    }

// ************* Timer Activity Cycle (Pause, Resume, Close)
    public function TimerActivity() {

        $status = $_POST['status'];
        $timer_id = $_POST['timer_id'];

        $timer_record = array(
            'timer_id' => $timer_id,
            'timer_record_status' => $status,
            'timer_record_date' => date('Y-m-d H:i:s')
        );


        $this->TimeTrack_m->create('timer_record', $timer_record);
    }

    public function record() {
        $user_id = $this->session->userdata('user')['user_id'];
        $result['user_info'] = $this->Login_m->activeUserInfo();
        $result['allDays'] = $this->TimeTrack_m->getTotalDays($user_id);
        $this->load->view('include/header', $result);
        $this->load->view('include/sidebar');
        $this->load->view('timetrack/all_record',$result);
        $this->load->view('include/footer');
    }

}

?>