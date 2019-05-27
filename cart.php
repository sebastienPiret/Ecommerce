

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Shopping cart
                </h1>
                <p class="text-white link-nav"><a href="<?php echo base_url('home'); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="<?php echo base_url('cart'); ?>"> cart</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- message -->
<div>
    <?php if ($this->session->flashdata('class')):?>
        <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span> </button>
        <?php echo $this->session->flashdata('message');?>
    <?php endif; ?>
</div>


<div class="container">
    <h2>Shopping Cart</h2>
    <div class="row cart">
        <table class="table">
            <thead>
            <tr>
                <th width="10%"></th>
                <th width="30%">Product</th>
                <th width="15%">Price</th>
                <th width="13%">Quantity</th>
                <th width="20%">Subtotal</th>
                <th width="12%"></th>
            </tr>
            </thead>
            <tbody>
            <?php if($this->cart->total_items() > 0){ foreach($cartItems as $item){    ?>
                <tr>
                    <td>
                        <?php $imageURL = !empty($item["image"])?base_url('assets/custom/img/item/'.$item["image"]):base_url('assets/custom/img/item/no.png'); ?>
                        <img src="<?php echo $imageURL; ?>" width="50"/>
                    </td>
                    <td><?php echo $item["name"]; ?></td>
                    <td><?php echo '$'.$item["price"].' USD'; ?></td>
                    <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
                    <td><?php echo '$'.$item["subtotal"].' Euros'; ?></td>
                    <td>
                        <a href="<?php echo base_url('cart/removeItem/'.$item["rowid"]); ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
            <?php } }else{ ?>
            <tr><td colspan="6"><p>Your cart is empty.....</p></td>
                <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <td><a href="<?php echo base_url('home/menu'); ?>" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a></td>
                <td colspan="3"></td>
                <?php if($this->cart->total_items() > 0){ ?>
                    <td class="text-left">Grand Total: <b><?php echo '$'.$this->cart->total().' Euros'; ?></b></td>
                    <td><a href="<?php echo base_url('checkout/'); ?>" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
                <?php } ?>
            </tr>
            </tfoot>
        </table>
    </div>

    <h2>Historique de vos commandes</h2>
    <div class="row cart">
        <table class="table">
            <thead>
            <tr>
                <th width="10%"></th>
                <th width="5%">Numéro de commande</th>
                <th width="15%">Total commande</th>
                <th width="25%">Date de commanden</th>
                <th width="13%">item ID</th>
                <th width="20%">détail</th>
                <th width="12%"></th>
            </tr>
            </thead>
            <tbody>
            <?php if($order ){ foreach($order as $orderSpec){    ?>
                <tr>
                    <td></td>
                    <td><?php echo $orderSpec["id"]; ?></td>
                    <td><?php echo $orderSpec["Total"].' Euros'; ?></td>
                    <td><?php echo $orderSpec["created"]; ?></td>
                    <td><?php echo $orderSpec["item_ID"]; ?></td>
                    <td><?php echo $orderSpec["subtotal"].'€'; ?></td>
                </tr>
            <?php } }else{ ?>
            <tr><td colspan="6"><p>Your've not made order already.....</p></td>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>

