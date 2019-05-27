

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    About Us
                </h1>
                <p class="text-white link-nav"><a href="<?php echo base_url('home'); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="<?php echo base_url('home/menu'); ?>"> Menu</a></p>
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

<section class="menu-list-area section-gap">
<div class="container ">
<!-- Grid row -->


    <!-- Grid column -->
    <div class="col-md-12 d-flex justify-content-center" id='myBtnContainer'>
        <?php if($allCategories): ?>
            <button type="button" class="btn active" data-rel="all" onclick="filterSelection('all')">All</button>
            <?php foreach ($allCategories as $category): ?>
                <button type="button" class="btn " onclick="filterSelection('<?php echo $category->nom; ?>')"><?php echo $category->nom; ?></button>
            <?php endforeach; ?>
        <?php else: ?>
            Categorie pas dispo
        <?php endif; ?>
    </div>
    <!-- Grid column -->

<!-- Grid row -->
    <div class="row">

            <?php if($allItems): ?>
                <?php foreach ($allItems as $item): ?>
                    <!--<div class="tab-pane fade show active" id="<?php echo $item->nomCategorie; ?>" role="tabpanel" aria-labelledby="<?php echo $item->nomCategorie; ?>-tab">-->

                        <div class="col-md-12 justify-content-center column <?php echo $item->nomCategorie; ?>">
                            <div class="content single-menu-list row justify-content-between align-items-center">
                                <div class="col-lg-9">
                                    <img src="<?php echo base_url('assets/custom/img/item/'.$item->path) ?>" class="img-responsive img-edit">

                                    <a href="#"><h4 style="color:brown;"><?php echo $item->nom; ?></h4></a>
                                    <p><?php echo $item->description; ?></p>
                                </div>

                                <div class="col-lg-3 flex-row d-flex row">

                                    <h4 style="padding: 10px;"><?php echo $item->price; ?> Euros</h4>
                                    <a href="<?php echo base_url('home/addToCart/'.$item->id); ?>" class="btn btn-success">
                                        Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>

                <?php endforeach; ?>
            <?php else: ?>
                Item pas dispo
            <?php endif; ?>
    </div>
</div>
</section>




