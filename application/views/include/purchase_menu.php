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
            <li class="active"><a href="<?= base_url('Purchase/NewPurchase'); ?>"><i class="fa fa-plus-circle"></i> Add New Purchase</a></li>
            <li><a href="<?= base_url('Purchase/PurchasePartialPaidBills'); ?>"><i class="fa fa-refresh"></i> Payable</a></li>
            <li><a href="<?= base_url('Purchase/PurchasePaidBills'); ?>"><i class="fa fa-dollar"></i> Paid</a></li>
            <li><a href="<?= base_url('Purchase/canceledBillsView'); ?>"><i class="fa fa-close"></i> Canceled </a></li>
            
            <!-- <li><a href=" base_url('Purchase/paid'); ?>">Paid</a></li>
            <li><a href=" base_url('Purchase/canceled'); ?>">Canceled</a></li> -->

          </ul>
        
        </div>
        <!-- /.navbar-collapse -->
      </div>
    </nav>