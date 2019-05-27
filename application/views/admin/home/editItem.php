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
                <h6 class="m-0 font-weight-bold text-primary">Edit item</h6>
            </div>
            <div class="card-body">

                <?php echo form_open_multipart('admin/updateItem','','') ?>
                <input name="XID" type="hidden" value="<?php echo $item[0]['id']?>">
                <input name="oldImage" type="hidden" value="<?php echo $item[0]['path']?>">
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Nom:</label>
                    <div class="col-sm-4">
                        <?php echo form_input('itemName',$item[0]['nom'],'placeholder="Item Name" class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Prix: </label>
                    <div class="col-sm-4">
                        <?php echo form_input('itemPrice',$item[0]['price'],'placeholder="Item Price" class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Description: </label>
                    <div class="col-sm-4">
                        <?php echo form_textarea('description',$item[0]['description'],'placeholder="Description" class="form-control" rows="3" cols="12"'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Categories: </label>
                    <div class="col-sm-4">

                        <?php echo form_dropdown('itemCategory',$this->modAdmin->displayCategory(),$item[0]['categorie']-1); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <img src="<?php echo base_url('assets/custom/img/item/'.$item[0]['path']) ?>" class="img-responsive img-edit">
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-1 col-form-label col-form-label-sm">Images: </label>
                    <div class="col-sm-4">
                        <?php echo form_upload('itemImg','','class="form-control-file"'); ?>
                    </div>
                </div>
                <p style="color: red;">Image must be maximum 400 px height and width.</p>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <?php echo form_submit('updateItem','Update','class="btn btn-primary"'); ?>
                    </div>
                </div>
                <?php echo form_close(); ?>

            </div>
        </div>
        </div>
        <!-- /.container-fluid -->