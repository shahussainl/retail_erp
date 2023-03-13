<?php
// echo "<pre>";
// print_r($tables);
// $assign='';
// if(!empty($tbl_status))
// {
//   $assign=$tbl_status[0]->pos_assign_id;
// } 
// echo $assign;
// $assign_id = $tbl_status->pos_assign_id;
// print_r($tables);
// foreach ($tables as $key) {
//     if($key->pos_assign_id==$assign_id)
//     {
//       echo "assigned!"."<br>";
//     }else{
//       echo "not assign!"."<br>";
//     }
// }
// exit();
?>
<style type="text/css">
.nav-tabs > li {
float:none;
display:inline-block;
zoom:1;
}

.nav-tabs {
text-align:center;
}
</style>
<!--<body class="hold-transition skin-blue sidebar-mini">-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="">
            <div class="row">
              <?php
                  $assign='';
                  
                  //   foreach($tbl_status as $key)
                  //   {
                  //     $assign = $key->pos_assign_id;
                  //   }
                  //   // $assign=$tbl_status[0]->pos_assign_id;
                  // } 
                foreach($tables as $tbl)
                {
                  $temp =0;
                  if(!empty($tbl_status))
                  {
                     foreach($tbl_status as $key)
                    {
                      if($tbl->pos_assign_id==$key->pos_assign_id)
                     {

                      $temp=1;
                      break;
                    
              ?>
               
              <?php
                  }
                }
              }
              if($temp==1)
              {
              ?>
               <div class="col-sm-3 btn btn-danger" style="margin: 5px;">
                     <h4 style="padding: 12px; color: white;"><span>Already Assigned</span></h4>
                  </div>
              <?php    
              }
              else
              {
              ?>
              <a href="<?= base_url('PointOfSale/PointSale/'.$tbl->pos_assign_id); ?>" style=" color: white;">
                <div class="col-sm-3 btn btn-info" style="margin: 5px;">
                   <h4 style="padding: 12px; color: white;"><?= $tbl->pos_assign_title; ?></h4>
                </div></a>
              <?php
                  }
                }
              ?>
            </div>
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    $(document).ready(function () {

//	js code for single product details

     $('.get_pro_id').click(function(){
     
        var prd_id  = $(this).find('input').val();
        
        // alert(prd_id);
        $.ajax({
        url:"<?php echo base_url('PointOfSale/getProduct'); ?>",
        method:"POST",
        data:{prod_id:prd_id},
        success:function(data)
        {
          // alert('done');
          // $('#prodData').append(data);

          $(".prodData").load(location.href + " .prodData");
          $(".formData").load(location.href + " .formData");

        }

      });

          // alert('dispute button clicked!');
    });

//	./js code for single product details

        $('#pointOfsale-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,
            language: {search: "Products", searchPlaceholder: "Filter and Search..."}
        });
       
        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
        });



        
    });
</script>

  


