

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

    <h2>Order Status</h2>
    <p class="ord-succ">Your order has been placed successfully.</p>

    <!-- Order status & shipping info -->
    <div class="row col-lg-12 ord-addr-info">
        <div class="col-sm-6 adr">
            <div class="hdr">Shipping Address</div>
            <p><?php echo $order['name']; ?></p>
            <p><?php echo $order['email']; ?></p>
            <p><?php echo $order['phone']; ?></p>
            <p><?php echo $order['address']; ?></p>
        </div>
        <div class="col-sm-6 info">
            <div class="hdr">Order Info</div>
            <p><b>Reference ID</b> #<?php echo $order['id']; ?></p>
            <p><b>Total</b> <?php echo '$'.$order['grand_total'].' USD'; ?></p>
        </div>
    </div>

    <!-- Order items -->
    <div class="row ord-items">
        <?php if(!empty($order['items'])){ foreach($order['items'] as $item){ ?>
            <div class="col-lg-12 item">
                <div class="col-sm-2">
                    <div class="img" style="height: 75px; width: 75px;">
                        <?php $imageURL = !empty($item["image"])?base_url('uploads/product_images/'.$item["image"]):base_url('assets/images/pro-demo-img.jpeg'); ?>
                        <img src="<?php echo $imageURL; ?>" width="75"/>
                    </div>
                </div>
                <div class="col-sm-4">
                    <p><b><?php echo $item["name"]; ?></b></p>
                    <p><?php echo '$'.$item["price"].' USD'; ?></p>
                    <p>QTY: <?php echo $item["quantity"]; ?></p>
                </div>
                <div class="col-sm-2">
                    <p><b><?php echo '$'.$item["sub_total"].' USD'; ?></b></p>
                </div>
            </div>
        <?php } } ?>
    </div>