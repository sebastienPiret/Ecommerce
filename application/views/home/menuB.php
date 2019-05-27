

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
    <div class="container">
        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-12 d-flex justify-content-center mb-5 id='myBtnContainer'">
                <?php if($allCategories): ?>
                    <button type="button" class="btn active btn-outline-black waves-effect filter" data-rel="all" onclick="filterSelection('all')">All</button>
                    <?php foreach ($allCategories as $category): ?>
                        <button type="button" class="btn btn-outline-black waves-effect filter" onclick="filterSelection('<?php echo $category->nom; ?>')" data-rel="<?php echo $category->id; ?>"><?php echo $category->nom; ?></button>
                    <?php endforeach; ?>
                <?php else: ?>
                    Categorie pas dispo
                <?php endif; ?>
            </div>
            <!-- Grid column -->

            <!-- Grid row -->
            <div class="col-md-12 d-flex justify-content-center " id="gallery">
                <div id="pills-tabContent" class="tab-content absolute">
                    <?php if($allItems): ?>
                    <?php foreach ($allItems as $item): ?>
                    <!--<div class="tab-pane fade show active" id="<?php echo $item->nomCategorie; ?>" role="tabpanel" aria-labelledby="<?php echo $item->nomCategorie; ?>-tab">-->

                    <div class="single-menu-list row justify-content-between align-items-center  column <?php echo $item->nomCategorie; ?>">
                        <div class="col-lg-9">
                            <img src="<?php echo base_url('assets/custom/img/item/'.$item->path) ?>" class="img-responsive img-edit">

                            <a href="#"><h4><?php echo $item->nom; ?></h4></a>
                            <p><?php echo $item->description; ?></p>
                        </div>

                        <div class="col-lg-3 flex-row d-flex price-size">
                            <div class="s-price col">
                                <h4>€</h4>
                                <span><?php echo $item->price; ?> Euros</span>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                    Item pas dispo
                <?php endif; ?>
            </div>
        </div>
        <!-- Grid row
    <div class="col-md-12 d-flex justify-content-center " id="gallery">
        <div id="pills-tabContent" class="tab-content absolute">
            <?php if($allItems): ?>
                <?php foreach ($allItems as $item): ?>
                <div class="tab-pane fade show active" id="<?php echo $item->nomCategorie; ?>" role="tabpanel" aria-labelledby="<?php echo $item->nomCategorie; ?>-tab">

                    <div class="single-menu-list row justify-content-between align-items-center mb-3 pics animation all <?php echo $item->idCategorie; ?>">
                        <div class="col-lg-9">
                        <img src="<?php echo base_url('assets/custom/img/item/'.$item->path) ?>" class="img-responsive img-edit">

                            <a href="#"><h4><?php echo $item->nom; ?></h4></a>
                            <p><?php echo $item->description; ?></p>
                        </div>

                        <div class="col-lg-3 flex-row d-flex price-size">
                            <div class="s-price col">
                                <h4>€</h4>
                                <span><?php echo $item->price; ?> Euros</span>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                Item pas dispo
            <?php endif; ?>
        </div>
    </div>
     Grid row -->
    </div>
    </div>
</section>





