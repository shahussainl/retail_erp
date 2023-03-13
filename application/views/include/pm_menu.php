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
            <li><a href="" data-toggle="control-sidebar">New Project</a></li>
            <li><a href="<?= base_url('Tasks/kanban'); ?>">Project Board</a></li>
            <li><a href="<?= base_url('Project/index'); ?>">Projects</a></li>
            <li><a href="<?= base_url('Tasks/ongoing'); ?>">Ongoing Tasks</a></li>
            <li><a href="<?= base_url('Tasks/Completed'); ?>">Completed Tasks</a></li>
            <li><a href="<?= base_url('Tasks/Notes'); ?>">Notes</a></li>
          </ul>
        
        </div>
        <!-- /.navbar-collapse -->
      </div>
    </nav>