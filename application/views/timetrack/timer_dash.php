<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Karachi'); 
// ********* Usman code

$mydate = date('Y-m-d');



//             $cur_date = $timer['timer_record_date'];
//             $date = DateTime::createFromFormat('Y-m-d H:i:s',$cur_date);
//             $newdate = $date->format("F d Y H:i:s");
// echo $newdate;
// echo "<br>";

// exit();


?>    <!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
        <?php $this->load->view('include/time_track_menu'); ?>
    <!-- Content Header (Page header) -->
    <!--    <div class="col-md-12">-->

    <section class="content">
        <div class="">

            <!-- /.box-header -->
            <div class="row">
                <div class="col-md-9">
                   <!-- Default box -->
                    <div class="box">
                      <div class="box-header with-border">
                        <h3 class="box-title"> 
                         <i class="fa  fa-check" style="font-size: 24px;"></i>
                          <span style="font-size: 24px;"><strong id="strtday">Start your day</strong></span>
                        </h3>
                        <div class="box-tools pull-right">
                          Date: <span id=tick2></span>&nbsp;<strong>|</strong> 
                            <?php 
                            $date = new DateTime();
                                    echo $date->format('l, F jS, Y'); 
                            ?>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="row">
                <div class="col-sm-6">
                  <form action="" method="post">
                     <input type="hidden" name="timer_id" class="timer_id" id="timer_id" value="<?= $timer['timer_id']; ?>">
                     <button type="button" class="btn btn-success time-start" id="time-start"   value="start" > Start  </button>
                     <button type="button" class="btn btn-primary time-pause" id="time-pause"   value="pause" > Pause  </button>
                     <button type="button" class="btn btn-info time-resume"   id="time-resume"  value="resume"> Resume </button>
                     <button type="button" class="btn btn-dark time-close"    id="time-close"   value="close" > Close  </button>
                  </form><br>
                  <p class="timeRefresh"><strong class="bg-primary text-danger">&nbsp;&nbsp;&nbsp;
                                  <?php 
                                    $tstatus = '';
                                   if($timer['timer_current_day']==$mydate)
                                   {
                                      
                                      if(!empty($timer['timer_record_status']=='start'))
                                      {
                                       $tstatus .='Started';
                                      }
                                      elseif(!empty($timer['timer_record_status']=='pause'))
                                      {
                                        $tstatus .='Paused';
                                      }
                                      elseif(!empty($timer['timer_record_status']=='resume'))
                                      {
                                        $tstatus .='Resumed';
                                      }
                                      elseif(!empty($timer['timer_record_status']=='close'))
                                      {
                                        $tstatus .='Closed';
                                      }
                                      elseif(empty($timer))
                                      {
                                       $tstatus .='Not Started'; 
                                      }
                                    // elseif($timer['timer_current_day']!=$mydate)
                                    // {
                                    //  $tstatus .='Not Started';  
                                    // }
                                  }
                                  else
                                  {
                                    $tstatus .='Not Started'; 
                                  }

                                    echo ' Time Now :  '.$tstatus;
                                  
                                  ?> &nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                                      <input type="hidden" class="CheckStartStatus" value="<?php echo $tstatus; ?>" >
                                   </p>
                </div>
              </div>
                      </div>
                      <!-- /.box-body -->
<!--                      <div class="box-footer">
                        Footer
                      </div>-->
                      <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- ./col-md-9 -->
                <div class="col-md-3">
                  <div class="box">
                    <div class="box-header text-center">
                      <b class="box-title">Activity Logs</b>
                      <?php if (!empty($user_info)) { 
                          $username = $user_info->user_fname.' '.$user_info->user_lname;
                          $user_id = $user_info->user_id;
                         ?>
                          <!-- <span class="hidden-xs"><?= $username.' - '.$user_id;  ?></span> -->
                      <?php } ?>
                    </div>
                    
                  <div class="box-body box-profile">

                    <ul class="list-group list-group-unbordered">
                      <li class="list-group-item">
                        <b>Activity status</b>   
                        <a class="pull-right TimerStatus">
                                <?php if($timer['timer_current_day']==$mydate){ echo $timer['timer_record_status']; } ?> 
                              </a>
                      </li>
                      <li class="list-group-item">
                        <b>Date/Time</b>   <a class="pull-right TimerStatusDate">
                          <?php
                           
                         if($timer['timer_current_day']==$mydate)
                          {
                            $cur_date  = $timer['timer_record_date'];
                            $date      = DateTime::createFromFormat('Y-m-d H:i:s',$cur_date);
                            $newdate   = $date->format("F d Y H:i:s");
                             echo $newdate;
                         }  ?></a>
                      </li>
                      <li class="list-group-item">
                        <b>Today</b>      <a class="pull-right "><b class="CurrentDay">
                          <?php
                           if($timer['timer_current_day']==$mydate)
                            {
                                $cur_day  = $timer['timer_current_day'];
                                $day    = DateTime::createFromFormat('Y-m-d',$cur_day);
                                $newday = $day->format("F d Y");
                                 echo $newday;
                            } 
                          ?>
                            <input type="hidden" class="CurDay" value="<?= $timer['timer_current_day']; ?>">
                            <input type="hidden" class="dbDate" value="<?= $mydate; ?>">
                          </b></a>
                      </li>
                      <!-- <li class="list-group-item">
                        <b>Task Priority</b> <a class="pull-right taskreload">j</a>
                      </li>
                      <li class="list-group-item">
                        <b>Responsible</b>   <a class="pull-right">n</a>
                      </li> -->
                      
                    </ul>
                  </div>
                  <!-- /.box-body -->

                </div>
                    
                    <div class="details">
                        <?php if(!empty($getTodayRecord)):?>
                        <div class="box">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                            <th>Time</th>
                            <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($getTodayRecord as $dayRecord): ?>
                                
                                  <tr>
                                  <td><?= date('h:i:s a',strtotime($dayRecord->timer_record_date)) ?></td>
                                  <td><?= $dayRecord->timer_record_status ?></td>
                                  </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        
                    </div>
                        <?php endif; ?>
                        </div>
                    
                <!-- /.box -->
              </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    // $(document).ready(function () {
    //     $('#products-table').DataTable({
    //         "dom": '<"toolbar">frtip',
    //         "paging": false,

    //         language: {search: "General Journal", searchPlaceholder: "Filter and Search..."}

    //     });
        
//        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">NEW PAYMENT</a>');
//                $('.scroll-modal-btn').click(function () {
//            $('.modal')
//                    .prop('class', 'modal fade') // revert to default
//                    .addClass($(this).data('direction'));
//            var modal_id = $(this).data('id');
//            $('#' + modal_id).modal('show');
//        });
    //  });
  </script> 

<script>
  // js Code By Usman Khan
  $(document).ready(function(){

    var curDay = $('.CurDay').val();
    var dbDate = $('.dbDate').val();
    // if(curDay!==dbDate)
    // {
    //     $('.time-pause').hide();
    //     $('.time-resume').hide();
    //     $('.time-start').show();
    //     $('.time-close').hide();
    // }

    var btn_status = $('.CheckStartStatus').val();
    // alert(CheckStartStatus);
    if(btn_status==='Not Started')
    {
      $('.time-pause').hide();
      $('.time-resume').hide();
      $('.time-start').show();
      $('.time-close').hide();

    }
    else if(btn_status==='Started')
    {
      $('.time-pause').show();
      $('.time-resume').hide();
      $('.time-start').hide();
      $('.time-close').show();

    }
    else if(btn_status==='Paused')
    {
      $('.time-pause').hide();
      $('.time-resume').show();
      $('.time-start').hide();
      $('.time-close').show();

    }
    else if(btn_status==='Resumed')
    {
      $('.time-pause').show();
      $('.time-resume').hide();
      $('.time-start').hide();
      $('.time-close').show();

    }
    else if(btn_status==='Closed')
    {
      $('.time-pause').hide();
      $('.time-resume').hide();
      $('.time-start').hide();
      $('.time-close').hide();
      $('#strtday').html('Your day has been Closed!');
      $("#strtday").css("color", "red");

    }

    

    
    $('.time-start').click(function(){

        var status     = $(this).val();
        // alert(status);
      $('.time-start').hide();
      $('.time-pause').show();
      $('.time-close').show();
      $('.time-resume').hide();
    

        $.ajax({
        url:"<?php echo base_url('TimeTrack/StartActivity/'); ?>",
        method:"POST",
        data:{status:status},
        success:function(data)
        {
          // alert(data);
          $('.timer_id').val(data);
          $('.TimerStatus').load(location.href+ ' .TimerStatus');
          $('.TimerStatusDate').load(location.href+ ' .TimerStatusDate');
          $('.CurrentDay').load(location.href+ ' .CurrentDay');
          $('.timeRefresh').load(location.href+ ' .timeRefresh');
          $('.timer_id').load(location.href+ ' .timer_id');
          $('.details').load(location.href+ ' .details');


          
          // $('.time-start').hide();
          // $('.time-pause').show();
          // $('.time-resume').hide();
          // // alert(data);
        }

      });

    });

    $('.time-pause').click(function(){

      var status     = $(this).val();
      var timer_id   = $('#timer_id').val();
          
          $('.time-pause').hide();
          $('.time-resume').show();
          $('.time-close').show();
          $('.time-start').hide();
// alert('time pause');
        $.ajax({
        url:"<?php echo base_url('TimeTrack/TimerActivity/'); ?>",
        method:"POST",
        data:{timer_id:timer_id,status:status},
        success:function(data)
        {
          $('.TimerStatus').load(location.href+ ' .TimerStatus');
          $('.TimerStatusDate').load(location.href+ ' .TimerStatusDate');
          $('.timeRefresh').load(location.href+ ' .timeRefresh');
          $('.CurrentDay').load(location.href+ ' .CurrentDay');
          $('.timer_id').load(location.href+ ' .timer_id');
          $('.details').load(location.href+ ' .details');

         
          
           // alert(btn_status);
        }

      });

          // alert('pause button clicked!');
  });
    $('.time-resume').click(function(){

        var status        = $(this).val();
        var timer_id      = $('#timer_id').val();

           $('.time-pause').show();
           $('.time-close').show();
           $('.time-resume').hide();
           $('.time-start').hide();
        // alert('time-resume');
        $.ajax({
        url:"<?php echo base_url('TimeTrack/TimerActivity/'); ?>",
        method:"POST",
        data:{timer_id:timer_id,status:status},
        success:function(data)
        {
          $('.TimerStatus').load(location.href+ ' .TimerStatus');
          $('.TimerStatusDate').load(location.href+ ' .TimerStatusDate');
          $('.timeRefresh').load(location.href+ ' .timeRefresh');
          $('.CurrentDay').load(location.href+ ' .CurrentDay');
          $('.timer_id').load(location.href+ ' .timer_id');
          $('.details').load(location.href+ ' .details');

          

 // alert(btn_status);
          // alert(data);
        }

      });

          // alert('dispute button clicked!');
    });

    // js code for close btn

    $('.time-close').click(function(){

        var status        = $(this).val();
        var timer_id      = $('#timer_id').val();

           $('.time-pause').hide();
           $('.time-close').hide();
           $('.time-resume').hide();
           $('.time-start').hide();
        // alert('time-resume');
        $.ajax({
        url:"<?php echo base_url('TimeTrack/TimerActivity/'); ?>",
        method:"POST",
        data:{timer_id:timer_id,status:status},
        success:function(data)
        {
          $('.TimerStatus').load(location.href+ ' .TimerStatus');
          $('.TimerStatusDate').load(location.href+ ' .TimerStatusDate');
          $('.timeRefresh').load(location.href+ ' .timeRefresh');
          $('.CurrentDay').load(location.href+ ' .CurrentDay');
          $('.timer_id').load(location.href+ ' .timer_id');
          $('.details').load(location.href+ ' .details');
          $('#strtday').html('Your day has been Closed!');
          $("#strtday").css("color", "red");

 // alert(btn_status);
          // alert(data);
        }

      });

          // alert('dispute button clicked!');
    });

    if(curDay!=dbDate)
    {
        $('.time-pause').hide();
        $('.time-resume').hide();
        $('.time-start').show();
        $('.time-close').hide();
        $('#strtday').html('Start your day');
        $("#strtday").css("color", "black");
        $('.timeRefresh').load(location.href+ ' .timeRefresh');
    }


  });

// ./Js Code by Usman khan
</script>
