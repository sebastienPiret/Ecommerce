
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
            <div class="erreur" style="color: red;">

            </div>
            <div class="card-body">
                <h2>Historique de vos commandes</h2>
                <div class="row cart">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="10%"></th>
                            <th width="5%">Numéro de commande</th>
                            <th width="15%">Total commande</th>
                            <th width="20%">nom client</th>
                            <th width="18%">détail</th>
                            <th width="20%">détail</th>
                            <th width="12%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if($order){ foreach($order as $orderSpec){    ?>
                            <tr>
                                <td></td>
                                <td><?php echo $orderSpec["id"]; ?></td>
                                <td><?php echo $orderSpec["Total"].' Euros'; ?></td>
                                <td><?php echo $orderSpec["prenom"].' '.$orderSpec["nom"]; ?></td>
                                <td><?php echo $orderSpec["mail"]; ?></td>
                                <td><?php echo $orderSpec["nomItem"]; ?></td>
                            </tr>
                        <?php } }else{ ?>
                        <tr><td colspan="6"><p>Your've not made order already.....</p></td>
                            <?php } ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
        </div>
        <!-- /.container-fluid -->