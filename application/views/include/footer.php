<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- js mark.js for dataTables highlighting -->

<script src="https://raw.githubusercontent.com/julmot/datatables.mark.js/master/dist/datatables.mark.js"></script>

<!-- jQuery 3 -->

<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>


<!-- DataTables -->
<script src="<?= base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!--select 2 js-->
<script src="<?= base_url('assets/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
<!-- Morris.js charts -->
<script src="<?= base_url('assets/bower_components/raphael/raphael.min.js'); ?>"></script>
<script src="<?= base_url('assets/bower_components/morris.js/morris.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'); ?>"></script>
<!-- jvectormap -->
<script src="<?= base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/bower_components/jquery-knob/dist/jquery.knob.min.js'); ?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/bower_components/moment/min/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
<!-- datepicker -->
<script src="<?= base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<!-- Slimscroll -->
<script src="<?= base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/dist/js/pages/dashboard.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/dist/js/demo.js'); ?>"></script>
<script src="<?= base_url('assets/custom_js/my_js.js'); ?>"></script>
<script src="<?= base_url('assets/plugins/iCheck/icheck.min.js'); ?> "></script>

<!-- fullCalendar -->
<script src="<?= base_url('assets/bower_components/moment/moment.js'); ?>"></script>
<script src="<?= base_url('assets/bower_components/fullcalendar/dist/fullcalendar.min.js'); ?>"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
        $('#example2').removeAttr('width').DataTable({
            paging: false,
            columnDefs: [
                {width: 200, targets: 0}
            ],
            fixedColumns: true
        });
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        $('#datepicker').datepicker({
            autoclose: true
        });

        $('#currentdatepicker').datepicker({
            autoclose: true
        });

        $('#currentdatepicker').datepicker();
        $('.currentdatepicker').datepicker();

        //usman code

        // js code for task buttons 
        $("#new_task").hide();
        $("#btn_new_task").show();
        // $("#show_task").show();
        $("#btn_new_task").css({"backgroundColor": "#17a2b8"});
        $("#btn_new_task").click(function () {
            $("#btn_show_task").show();
            $("#btn_new_task").hide();
            $("#btn_show_task").css({"backgroundColor": "#17a2b8"});
            $("#btn_new_task").css({"backgroundColor": "#007bff"});
            $("#show_task").hide(500);
            $("#new_task").show(500);
        });
        $("#btn_show_task").click(function () {
            $("#btn_new_task").show();
            $("#btn_show_task").hide();
            $("#btn_new_task").css({"backgroundColor": "#17a2b8"});
            $("#btn_show_task").css({"backgroundColor": "#007bff"});
            $("#show_task").show(500);
            $("#new_task").hide(500);
        });

// js code for Notes buttons
        $("#new_note").hide();
        $("#btn_new_note").show();
        // $("#show_note").show();
        $("#btn_new_note").css({"backgroundColor": "#17a2b8"});
        $("#btn_new_note").click(function () {
            $("#btn_show_note").show();
            $("#btn_new_note").hide();
            $("#btn_show_note").css({"backgroundColor": "#17a2b8"});
            $("#btn_new_note").css({"backgroundColor": "#007bff"});
            $("#show_note").hide(500);
            $("#new_note").show(500);
        });
        $("#btn_show_note").click(function () {
            $("#btn_new_note").show();
            $("#btn_show_note").hide();
            $("#btn_new_note").css({"backgroundColor": "#17a2b8"});
            $("#btn_show_note").css({"backgroundColor": "#007bff"});
            $("#show_note").show(500);
            $("#new_note").hide(500);
        });

//  js code for Files buttons

        $("#new_file").hide();
        $("#btn_new_file").show();
        // $("#show_file").show();
        $("#btn_new_file").css({"backgroundColor": "#17a2b8"});
        $("#btn_new_file").click(function () {
            $("#btn_show_file").show();
            $("#btn_new_file").hide();
            $("#btn_show_file").css({"backgroundColor": "#17a2b8"});
            $("#btn_new_file").css({"backgroundColor": "#007bff"});
            $("#show_file").hide(500);
            $("#new_file").show(500);
        });
        $("#btn_show_file").click(function () {
            $("#btn_new_file").show();
            $("#btn_show_file").hide();
            $("#btn_new_file").css({"backgroundColor": "#17a2b8"});
            $("#btn_show_file").css({"backgroundColor": "#007bff"});
            $("#show_file").show(500);
            $("#new_file").hide(500);
        });


// main tag close
    });


    function base_url() {
        return "<?php echo base_url(); ?>";
    }

    // $(function () {
    //Initialize Select2 Elements




//        //Timepicker
//        $('.timepicker').timepicker({
//            showInputs: false
//        });
    // });
//Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });
    $(function () {
        $('#example1').DataTable();
        $('#example2').DataTable();
        $('#example3').DataTable({
            // 'paging': true,
            // 'lengthChange': true,
            // 'searching': true,
            // 'ordering': true,
            // 'info': true,
            // 'autoWidth': true,

        });

    });
</script>
<!--usman script-->
<!-- js code for time and date -->
<script>
    function show2() {
        if (!document.all && !document.getElementById)
            return;
        thelement = document.getElementById ? document.getElementById("tick2") : document.all.tick2;
        var Digital = new Date();
        var hours = Digital.getHours();
        var minutes = Digital.getMinutes();
        var seconds = Digital.getSeconds();
        var dn = "PM";
        if (hours < 12)
            dn = "AM";
        if (hours > 12)
            hours = hours - 12;
        if (hours == 0)
            hours = 12;
        if (minutes <= 9)
            minutes = "0" + minutes;
        if (seconds <= 9)
            seconds = "0" + seconds;
        var ctime = hours + ":" + minutes + ":" + seconds + " " + dn;
        thelement.innerHTML = ctime;
        setTimeout("show2()", 1000);

    }

    window.onload = show2;

    setInterval(function () {
        // location.load('.timeRefresh');
        $(".timeRefresh").load(location.href + " .timeRefresh");
    }, 1000);

    //-->
</script>
<script type="text/javascript">
    var inputLocalFont = document.getElementById("product_images");
    inputLocalFont.addEventListener("change", previewImages, false); //bind the function to the input

    function previewImages() {
        var fileList = this.files;
        var anyWindow = window.URL || window.webkitURL;
        for (var i = 0; i < fileList.length; i++) {

            //get a blob to play with
            var objectUrl = anyWindow.createObjectURL(fileList[i]);

            // $('.bgPic').css('background-image', 'url("' + objectUrl + '")');
            // 'url("' + imageUrl + '")')

            $('#preview-area').append(`<div class="col-sm-6 col-md-3 col-lg-3 mt-4" style="height: 400px !important;">
                <div class="card">
                    <img class="card-img-top" src="`+ objectUrl +`">
                    <div class="card-block">
                       <div class="meta">
                            <textarea class="form-control" placeholder="Enter little description" name="title[]"></textarea>
                        </div>
                      
                    </div>
                 
                </div>
            </div>`);
            
            // for the next line to work, you need something class="preview-area" in your html
            // $('#preview-area').append('<div class="col-md-4"><img src="' + objectUrl + '" style="max-height:215px !important;" /><br><input type="text" class="form-control" name="title[]" /></div><br>');
            // get rid of the blob
            window.URL.revokeObjectURL(fileList[i]);
        }


    }
//    var inputLocalFont2 = document.getElementById("product_images_2");
//    inputLocalFont2.addEventListener("change", previewImages2, false); //bind the function to the input

    function previewImages2(obj) {

        var fileList = obj.files;
        var anyWindow = window.URL || window.webkitURL;
        for (var i = 0; i < fileList.length; i++) {

            //get a blob to play with
            var objectUrl = anyWindow.createObjectURL(fileList[i]);

            $('.preview-area_2').append(`<div class="col-sm-6 col-md-3 col-lg-3 mt-4" style="height: 400px !important;">
                <div class="card">
                    <img class="card-img-top" src="`+ objectUrl +`">
                    <div class="card-block">
                       <div class="meta">
                            <textarea class="form-control" name="title[]"></textarea>
                        </div>
                      
                    </div>
                 
                </div>
            </div>`);

            // for the next line to work, you need something class="preview-area" in your html

            // $(obj).parent().parent().parent().find('.preview-area_2').append('<div class="col-md-4"><img src="' + objectUrl + '" style="max-height:215px !important;" /><input type="text" class="form-control" name="title[]" /></div>');
            // get rid of the blob 
            window.URL.revokeObjectURL(fileList[i]);
        }


    }
</script>
<!--full calender script-->
<script type="text/javascript">
    $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function init_events(ele) {
            ele.each(function () {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
            });
        }

        init_events($('#external-events div.external-event'));
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        $('#calendar1').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            //Random default events
            
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css('background-color');
                copiedEventObject.borderColor = $(this).css('border-color');
                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar1').fullCalendar('renderEvent', copiedEventObject, true);
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },
              events: [
                        {
                          title: 'some of the reason',
                          start: '2019-07-01'
                        }
                      ]
        });
    });
</script>
<script type="text/javascript">
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#user_img").change(function () {
        readURL(this);
    });

</script>
<script>
$('.view-option').click(function(){
   var view = $(this).data('optview');
   if(view == "list"){
     $('.table-view').removeClass('data-show'); 
     $('.table-view').addClass('data-hide');
      $('.list-view').addClass('data-show'); 
     $('.list-view').removeClass('data-hide'); 
   }else{
       $('.list-view').removeClass('data-show'); 
     $('.list-view').addClass('data-hide');
      $('.table-view').addClass('data-show'); 
     $('.table-view').removeClass('data-hide');
   }
});
</script>
</body>
</html>
