<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php $this->load->view('include/pm_menu'); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-striped table-bordered" id="notes-table">
                    <thead>
                        <tr>
                            <th>Serial#</th>
                            <th>Name</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($notes)) {
                            $sno = 1;
                            foreach ($notes as $note) {
                                ?>
                                <tr>
                                    <td><?= $sno; ?></td>
                                    <td><?= $note->note_title; ?></td>
                                    <td><?= $note->note_description; ?></td>
                                </tr>
                                <?php
                                $sno++;
                            }
                        } else {
                            echo "No Data Available!";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
    $(document).ready(function () {
        $('#notes-table').DataTable({
            "dom": '<"toolbar">frtip',
            "paging": false,
            language: {search: "NOTES", searchPlaceholder: "Filter and Search..."},
        });
        $("div.toolbar").html('<a href="#" style="float:right;" data-toggle="control-sidebar" class="btn btn-primary site-button">ADD NOTE</a>');

        $('.scroll-modal-btn').click(function () {
            $('.modal')
                    .prop('class', 'modal fade') // revert to default
                    .addClass($(this).data('direction'));
            var modal_id = $(this).data('id');
            $('#' + modal_id).modal('show');
        });
    });
</script>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-light">
    <!-- Title -->
    <h1 class="control-sidebar-heading">
        ADD NEW NOTE
        <i class="fa fa-times control-sidebar-times" data-toggle="control-sidebar"></i>
    </h1>
    <!-- Title -->
    <form action="<?= base_url('Project/AddNewNote') ?>" method="post">
        <div class="box box-control-sidebar">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Projects</label>
                            <select name="project_id" class="form-control">
                                <option value=""></option>
                                <?php if (!empty($projects)) { ?>
                                    <?php foreach ($projects as $p) { ?>
                                        <option value="<?= $p->project_id; ?>"><?= $p->project_name; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Note</label>
                            <input type="text" name="note_title" class="form-control" id="inputName" placeholder="" required>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="note_description" id="inputExperience" placeholder="Description about Note"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">CREATE NOTE</button>
                        <input type="reset" value="RESET" class="btn btn-warning">

                    </div>
                </div>
            </div>
        </div>
    </form> 
</aside>