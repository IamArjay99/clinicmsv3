<main>

<section class="slider-area  position-relative">
<div class="slider-active">

<div class="single-slider">
<div class="slider-cap-wrapper slider-height">
<div class="hero-caption">
<h1 data-animation="fadeInUp" data-delay=".4s">A brighter clinic<br> care experienced</h1>
<p data-animation="fadeInUp" data-delay=".7s">Ensure That Student and employees have access to high Quality Health Care</p>
<a href="#" class="make-appointment">
<div class="button_base b3d_roll" data-animation="bounceIn" data-delay=".6s">
<div>Make an Appointment</div>
<div>Make an Appointment</div>
</div>
</a>

    <div class="hero-shape d-none d-sm-none d-md-none d-lg-block d-xl-block">
        <img src="<?=base_url()?>assets/website/assets/img/hero/tooth.png" alt="">
    </div>

</div>
    <div class="hero-img position-relative d-flex justify-content-center d-none d-sm-none d-md-none d-lg-block d-xl-block">
        <img src="<?=base_url()?>assets/website/assets/img/hero/h1_hero1.png" style="width: 50%" alt="" data-animation="pulse" data-transition-duration="5s">
    </div>


</div>
</div>
</div>
</section>


<section class="visit-tailor-area2 fix">

<div class="tailor-offers" style="border:10px solid black;box-shadow:6px -16px 13px -1px;"> </div>

<div class="tailor-details">
<div class="sinlge-wrapper">
<div class="single-details wow fadeInUp mb-20" data-wow-duration="1s" data-wow-delay=".3s">
<h3>Best <br> clinic specialist</h3>
<p>All Students and faculty of cbsua- sipocot can have a free check-up and free medicine.</p>
<p>Nurse conduct seminar related to health to make all students and faculty aware of their physical health how they can take care of it and avoid any harm to their body.</p>
<a href="#" class="btn_01 mt-15 make-appointment">Make an Appointment</a>
</div>
<div class="single-details wow fadeInUp mb-20 ml-90" data-wow-duration="2s" data-wow-delay=".3s">
<div class="address">
<h5>PHONE</h5>
<p>0948-518-9064</p>
</div>
<div class="address">
<h5>WORKING TIME</h5>
<p>08:00 AM – 05:00 PM
    <br> Saturday Offline
    <br> Sunday Offline
</p>
</div>
<div class="address">
<h5>OUR CLINIC ADDRESS</h5>
<p>Impig Sipocot Camarines Sur, at Central Bicol State University of Agriculture beside BAC OFFICE near AVR.</p>
</div>
</div>
</div>
</div>
</section>


<section class="testimonial-area2 section-padding">
    <div class="container-fluid fix pb-40">
        <div class="row justify-content-center">
            <div class="col-xxl6 col-xl-7 col-lg-7 col-md-6">
                <div class="testimonial-active owl-carousel ">
                    <?php foreach ($anouncement as $key => $value):?>
                        <div class="single-testimonial ">

                            <div class="testimonial-caption ">
                                <div class="testimonial-top-cap">
                                    <h5><?=$value["title"]?></h5>
                                    <p><?=$value["description"]?></p>
                                </div>

                                <div class="testimonial-founder d-flex align-items-center">
                                    <div class="founder-text">
                                        <span>- <?=$value["fullname"]?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- <div class="instagram-area fix">
<div class="container-fluid p-0">
<div class="row">
<div class="col-xl-12">
<div class="instagram-active owl-carousel">
<div class="single-instagram">
<img src="<?=base_url()?>assets/website/assets/img/gallery/xgallery1.jpg.pagespeed.ic.NL2ZViHBUw.jpg" alt="">
<a href="<?=base_url()?>assets/website/assets/img/gallery/gallery1.jpg" class="img-pop-up"><i class="ti-zoom-in"></i></a>
</div>
<div class="single-instagram">
<img src="<?=base_url()?>assets/website/assets/img/gallery/gallery2.jpg" alt="">
<a href="<?=base_url()?>assets/website/assets/img/gallery/gallery2.jpg" class="img-pop-up"><i class="ti-zoom-in"></i></a>
</div>
<div class="single-instagram">
<img src="<?=base_url()?>assets/website/assets/img/gallery/gallery3.jpg" alt="">
<a href="<?=base_url()?>assets/website/assets/img/gallery/gallery3.jpg" class="img-pop-up"><i class="ti-zoom-in"></i></a>
</div>
<div class="single-instagram">
<img src="<?=base_url()?>assets/website/assets/img/gallery/gallery2.jpg" alt="">
<a href="<?=base_url()?>assets/website/assets/img/gallery/gallery2.jpg" class="img-pop-up"><i class="ti-zoom-in"></i></a>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="appointment">
<div class="container">
<div class="row">
<div class="col-xl-12">
<div class="text-center">
<p>Make your dream smile a reality! Call us at 1-800-553-3364 or <a href="#"> Make an appointment</a></p>
</div>
</div>
</div>
</div>
</div> -->

<!-- <section class="testimonial-area2 section-padding">
<div class="container-fluid fix pb-40">
<div class="row justify-content-center">
<div class="col-xxl6 col-xl-7 col-lg-7 col-md-6">
<div class="testimonial-active owl-carousel ">

<div class="single-testimonial ">

<div class="testimonial-caption ">
<div class="testimonial-top-cap">
<img src="<?=base_url()?>assets/website/assets/img/icon/xquotes-sign.png.pagespeed.ic.MZh5gEW9oZ.png" alt="" class="quotes-sign mb-20">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non mauris nulla tincidunt fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>
</div>

<div class="testimonial-founder d-flex align-items-center">
<div class="founder-text">
<span>- Sharon Needles</span>
</div>
</div>
</div>
</div>


<div class="single-testimonial ">

<div class="testimonial-caption ">
<div class="testimonial-top-cap">
<img src="<?=base_url()?>assets/website/assets/img/icon/xquotes-sign.png.pagespeed.ic.MZh5gEW9oZ.png" alt="" class="quotes-sign mb-20">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non mauris nulla tincidunt fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>
</div>

<div class="testimonial-founder d-flex align-items-center">
<div class="founder-text">
<span>- Sharon Needles</span>
</div>
</div>
</div>
</div>


<div class="single-testimonial ">

<div class="testimonial-caption ">
<div class="testimonial-top-cap">
<img src="<?=base_url()?>assets/website/assets/img/icon/xquotes-sign.png.pagespeed.ic.MZh5gEW9oZ.png" alt="" class="quotes-sign mb-20">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non mauris nulla tincidunt fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>
</div>

<div class="testimonial-founder d-flex align-items-center">
<div class="founder-text">
<span>- Sharon Needles</span>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</section> -->


<!-- <section class="home-blog section-padding ">
<div class="container">
<div class="row justify-content-center">
<div class="cl-xl-7 col-lg-8 col-md-10">

<div class="section-tittle text-center mb-60">
<h2>Latest blog</h2>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-4 col-md-6 col-sm-6 mb-40">
<div class="single-blogs ">
<div class="blog-img">
<a href="blog_details.html"><img src="<?=base_url()?>assets/website/assets/img/gallery/xblog1.jpg.pagespeed.ic.QAxwOGk-J2.jpg" alt=""></a>
</div>
<div class="blogs-cap">
<h5><a href="blog_details.html">When a cancer diagnosis predicts future good health</a></h5>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non mauris nulla tincidunt fermentum.</p>
<a href="blog_details.html" class="browse-btn">Read More</a>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 mb-40">
<div class="single-blogs ">
<div class="blog-img">
<a href="blog_details.html"><img src="<?=base_url()?>assets/website/assets/img/gallery/xblog2.jpg.pagespeed.ic.BoXkIBVwKw.jpg" alt=""></a>
</div>
<div class="blogs-cap">
<h5><a href="blog_details.html">Spinal Stabilization Surgery: What Does It Involve?</a></h5>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non mauris nulla tincidunt fermentum.</p>
<a href="blog_details.html" class="browse-btn">Read More</a>
</div>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-6 mb-40">
<div class="single-blogs ">
<div class="blog-img">
<a href="blog_details.html"><img src="<?=base_url()?>assets/website/assets/img/gallery/xblog3.jpg.pagespeed.ic._fY9UFYzSB.jpg" alt=""></a>
</div>
<div class="blogs-cap">
<h5><a href="blog_details.html">An Endoscopic, Minimal Scarring Method Developed</a></h5>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Non mauris nulla tincidunt fermentum.</p>
<a href="blog_details.html" class="browse-btn">Read More</a>
</div>
</div>
</div>
</div>
</div>
<div class="blog-shape d-none d-xxl-block">
<img src="<?=base_url()?>assets/website/assets/img/gallery/xtooth1.png.pagespeed.ic.1iSGgsm_vQ.png" alt="">
</div>
</section> -->


</main>