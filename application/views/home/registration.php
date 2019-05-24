

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    Registration
                </h1>
                <p class="text-white link-nav"><a href="<?php echo base_url('home'); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="<?php echo base_url('registration'); ?>"> Registration</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- message -->
<div>
    <?php if ($this->session->flashdata('class')):?>
    <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible role="alert">
    <button type=""button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span> </button>
    <?php echo $this->session->flashdata('message');?>
    <?php endif; ?>
</div>


<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img id="icon" alt="Bienvenue!" />
        </div>

        <!-- Login Form -->
        <form action="<?php echo site_url('registration/newUser'); ?>" method="post">

            <input type="text" name="nom" id="first_name" class="fadeIn second" placeholder="First Name" value="<?php echo set_value('nom'); ?>">

            <input type="text" name="prenom" id="last_name" class="fadeIn second" placeholder="Last Name"value="<?php echo set_value('prenom'); ?>">

            <input type="email" name="email" id="email" class="fadeIn third" placeholder="Email Address" value="<?php echo set_value('email'); ?>">

            <input type="password" name="mdp" id="password" class="fadeIn third" placeholder="Password">

            <input type="password" name="mdp_confirmation" id="password_confirmation" class="fadeIn third" placeholder="Confirm Password">

            <input type="submit" value="Register" class="fadeIn fourth">

        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="<?php echo base_url('home/login'); ?>">Go to login page</a>
        </div>

    </div>
</div>