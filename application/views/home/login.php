

<!-- start banner Area -->
<section class="banner-area relative about-banner" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="about-content col-lg-12">
                <h1 class="text-white">
                    About Us
                </h1>
                <p class="text-white link-nav"><a href="<?php echo base_url('home'); ?>">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="<?php echo base_url('home/login'); ?>"> Login</a></p>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img id="icon" alt="Bienvenue!!" />
        </div>

        <!-- Login Form -->
        <form>
            <input type="text" id="email" class="fadeIn second" name="login" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
            <input type="text" id="password" class="fadeIn third" name="login" placeholder="Password">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="<?php echo base_url('registration'); ?>">Not yet registred?</a>
        </div>

    </div>
</div>