

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    About Us
                </h1>
                <p class="text-white link-nav"><a href="<?php echo base_url('home'); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="<?php echo base_url('login'); ?>"> Login</a></p>
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

<!-- message -->
<div>
    <?php if (userLoggedIn()):?>
        <div class="alert alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span> </button>
        <?php echo 'Welcome '.$this->session->userdata('prenom').' '.$this->session->userdata('nom').'.';?>
    <?php endif; ?>
</div>

<!-- Login form -->
<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img id="icon" alt="Bienvenue!!" />
        </div>

        <!-- Login Form -->
        <form action="<?php echo site_url('login/checkUser');?>" method="post">
            <input type="text" id="email" class="fadeIn second" name="login" placeholder="Email Address" value="<?php echo set_value('login'); ?>">
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="Password" >
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="<?php echo base_url('registration'); ?>">Not yet registred?</a>
        </div>

    </div>
</div>