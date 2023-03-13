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
              <li class="active"><a href="<?= base_url('PointOfSale/PointSale'); ?>"><i class="fa fa-laptop"></i> POS Terminal</a></li>
            <li class="active"><a href="<?= base_url('PointOfSale/allPosSales'); ?>"><i class="fa fa-cart-arrow-down"></i> Sales Archive</a></li>
            <li class="pull-right"><a class="view-option" data-optview="list"><i class="fa fa-list"></i></a></li>
            <li class="pull-right"><a class="view-option" data-optview="table"><i class="fa fa-table"></i></a></li>
          </ul>
        </div>
      </div>
    </nav>