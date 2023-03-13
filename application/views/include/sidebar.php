<!-- 
    <Usman Code>
     (some menu items are commented on basis of sir waqas orders) 
   -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       <li><a href="<?= base_url('Dashboard');?>"><i class="fa fa-laptop"></i> DASHBOARD</a></li>
        <!-- <li>
          <a href="<?// base_url('Tasks/kanban'); ?>">
            <i class="fa fa-bar-chart"></i>
            <span>Tasks</span>
          </a>
        </li> -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-shopping-cart"></i> <span>POINT OF SALE</span>
                 <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
        
        <ul class="treeview-menu">
         <li>
          <a href="<?= base_url('PointOfSale/PointSale'); ?>">
            <i class="fa fa-angle-right"></i>
            <span>POS Terminal</span>
          </a>
        </li>
         <li>
          <a href="<?= base_url('PointOfSale/allPosSales'); ?>">
            <i class="fa fa-angle-right"></i> <span>POLISH INVOICE</span>
          </a>
        </li>
        </ul>
            </li>
             <li>
          <a href="<?= base_url('Sales/index'); ?>">
            <i class="fa fa-angle-right"></i> <span>SALE INVOICE</span>
          </a> 
        </li>
             <li class="treeview">
            <a href="#">
                <i class="fa fa-dollar"></i> <span>EXPENSE</span>
                 <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
        
        <ul class="treeview-menu">
        <li>
          <a href="<?= base_url('Vouchers/paymentVouchers'); ?>">
            <i class="fa fa-angle-right"></i> <span>Expense Voucher</span>
          </a> 
        </li>
        <li>
          <a href="<?= base_url('Vouchers/expense_report'); ?>">
            <i class="fa fa-angle-right"></i> <span>Expense Report</span>
          </a> 
        </li>
        </ul>
             </li>
            <li class="" style="display:none;">
            <a href="<?= base_url('Project/index'); ?>">
                <i class="fa fa-shopping-basket"></i> <span>PROJECTS</span>
                 
            </a>
             </li> 
             
             <li class="">
            <a href="<?= base_url('Purchase/PurchasePaidBills'); ?>">
                <i class="fa fa-shopping-basket"></i> <span>PURCHASE</span>
                 
            </a>
             </li>
             
             <li class="">
            <a href="<?= base_url('Stock/index'); ?>">
                <i class="fa fa-shopping-basket"></i> <span>STOCK </span>
            </a>
             </li>
        <li>
          <a href="<?= base_url('Product/index'); ?>">
            <i class="fa fa-bar-chart"></i>
            <span>PRODUCTS</span>
          </a>
        </li>
          <li style="display:none;">
          <a href="<?= base_url('Consumption/index'); ?>">
            <i class="fa fa-bar-chart"></i>
            <span>CONSUMPTION</span>
          </a>
        </li>
        <li style="display:none;">
          <a href="<?= base_url('Project/index'); ?>">
            <i class="fa fa-bar-chart"></i>
            <span>PROJECTS</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('Accounts/generalJournalVoucherView'); ?>">
            <i class="fa fa-credit-card"></i> <span>ACCOUNTS</span>
          </a> 
        </li>
        <li>
          <a href="<?= base_url('Admin/Configuration'); ?>">
            <i class="fa fa-gears"></i> <span>SETTINGS</span>
          </a> 
        </li>
        <li>
          <a href="<?= base_url('Admin/allUsers'); ?>">
            <i class="fa fa-users"></i>
            <span>USERS</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>