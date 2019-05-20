        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Item</h1>

            </div>

            <!-- message -->
            <div>
                <?php if ($this->session->flashdata('class')):?>
                <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible role="alert">
                <button type=""button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span> </button>
                <?php echo $this->session->flashdata('message');?>
            </div>
            <?php endif; ?>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Show item</h6>
            </div>
            <div class="card-body">

                <?php if($allItems): ?>
                    <table class="table table-dashed">
                    <?php foreach ($allItems as $item): ?>
                        <tr>
                            <td>
                                <?php echo $item->nom; ?>
                            </td>
                            <td>
                                <?php echo $item->price.'euros'; ?>
                            </td>
                            <td>
                                <?php echo $item->categorie; ?>
                            </td>
                            <td>
                                <img src="<?php echo $item->path; ?>">
                            </td>
                            <td>
                                <a href="" class="btn btn-info">
                                    Edit
                                </a>
                            </td>
                            <td>
                                <a href="" class="btn btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                    <?php echo $links; ?>
                <?php else: ?>
                    Item pas dispo
                <?php endif; ?>


            </div>
        </div>
        </div>
        <!-- /.container-fluid -->