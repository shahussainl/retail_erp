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
            <li><a href="#">Project Board</a></li>
            <li><a href="<?= base_url('project/project_tasks/'.$this->uri->segment(3)); ?>">Tasks</a></li>
             <li><a href="<?= base_url('project/project_notes/'.$this->uri->segment(3)); ?>">Notes</a></li>
            <li><a href="<?= base_url('project/project_uploads/'.$this->uri->segment(3)); ?>">Uploads</a></li>
            <li><a href="<?= base_url('project/project_calendar/'.$this->uri->segment(3)); ?>">Calendar</a></li>
            <!-- <li><a href="#">Report</a></li>
            <li class="dropdown pull-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
                <li class="divider"></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li> -->
          </ul>
        
        </div>
        <!-- /.navbar-collapse -->
      </div>
    </nav>