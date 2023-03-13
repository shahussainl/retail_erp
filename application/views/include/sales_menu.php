<style>
    .r-internalPage-menu{
            margin-left: 15px;
    margin-right: 15px;
    background: #fff;
    }
    .r-internalPage-menu .nav{
        width:100%;
    }
</style>
<nav class="navbar navbar-static-top m-b0">
      <div class="r-internalPage-menu">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse">
          <ul class="nav navbar-nav">
              <li class=""><a href="<?= base_url('Sales/add_new'); ?>"><i class="fa fa-plus-circle"></i> Add New Invoice</a></li>
            <li class="active"><a href="<?= base_url('Sales/index'); ?>"><i class="fa fa-edit"></i> All Invoices</a></li>
            <li><a href="<?= base_url('Sales/receipts'); ?>"><i class="fa fa-dollar"></i> Receipt</a></li>
            <li><a href="<?= base_url('Sales/canceled'); ?>"><i class="fa fa-close"></i> Canceled </a></li>
          </ul>
        </div>
      </div>
    </nav>

