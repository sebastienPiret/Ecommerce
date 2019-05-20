
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Category</h1>

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
                    <h6 class="m-0 font-weight-bold text-primary">Add category</h6>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <?php echo form_open_multipart('admin/addCategory','','') ?>
                        <div class="form-group">
                            <?php echo form_input('categoryName','','placeholder="Category Name" class="form-control"'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_submit('addCategory','Add category','class="btn btn-primary"'); ?>
                        </div>
                        <?php echo form_close(); ?>

                    </div>

                    <div class="col-md-6 col-md-offset-3">
                        <table classe="table table-dashed">
                            <thead>
                            <tr>
                                <th scope="col">Num   </th>
                                <th scope="col">Categorie</th>
                            </tr>
                            </thead>
                        <tbody>
                        <?php $query=$this->modAdmin->displayCategory(); ?>
                        <?php if(count($query)>0):?>
                            <?php for ($i=0;$i<count($query);$i++)
                            {
                                echo '<tr>';
                                echo '<td scope="row">'.$i.'     </td>';
                                echo '<td>'.$query[$i].'</td>'; // access attributes
                                echo '</tr>';
                            } ?>
                        <?php else: ?>
                            Categories not available
                        <?php endif; ?>
                        </tbody>
                        </table>
                    </div>
                </div>

            </div>



        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->