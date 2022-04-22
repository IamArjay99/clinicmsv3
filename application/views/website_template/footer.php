
<div id="modal" class="modal custom-modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark">
        <h4 class="modal-title font-weight-bolder text-white" id="modalTitle">Login</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
            style="background: transparent;
                outline: none;
                border: 1px solid gray;
                border-radius: 50%;">
            <span class="text-light" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
            <div class="row">
                <div class="col-12 my-2">
                    <label for="username">Email</label>
                    <input class="form-control valid validate" name="username" id="username" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your email'" placeholder="Enter your email" required>
                </div>
                <div class="col-12 my-2">
                    <label for="password">Password</label>
                    <input class="form-control valid validate" name="password" id="password" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your password'" placeholder="Enter your password" required>
                </div>
                <div class="col-12 my-2">
                    <button type="submit" class="button button-contactForm boxed-btn w-100 py-2">Login</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


<footer>
<div class="footer-wrapper">
<div class="footer-area footer-padding">
<div class="container">
<div class="row justify-content-between">
<div class="col-lg-9 col-12">
<div class="single-footer-caption mb-50">
<div class="single-footer-caption mb-20">

<div class="footer-logo mb-35">
<a href="#"><img src="<?=base_url()?>assets/website/assets/img/logo/xlogo.png.pagespeed.ic.RElERxDpcp.png" alt=""></a>
</div>
<p style="line-height: 1.6;">There are many variations of passages of lorem ipsum available be the majority.</p>

<div class="footer-social pt-30">
<a href="https://www.facebook.com/CBSUAOFFICIALPAGE"><i class="fab fa-facebook"></i></a>
<a href="#"><i class="fab fa-instagram"></i></a>
<!-- <a href="#"><i class="fab fa-linkedin-in"></i></a> -->
<a href="#"><i class="fab fa-youtube"></i></a>
</div>
</div>
</div>
</div>
<!-- <div class="col-xl-4  col-lg-4 col-md-7 col-sm-12">
<div class="map mb-50">
<iframe src="../../maps/embed.html?pb=!1m18!1m12!1m3!1d3610.1786539269224!2d55.27218771500953!3d25.197196983896188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43348a67e24b%3A0xff45e502e1ceb7e2!2sBurj%20Khalifa!5e0!3m2!1sen!2sbd!4v1588690958350!5m2!1sen!2sbd" width="100%" height="334" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
</div> -->
<div class="col-xl-3 col-12">
<div class="single-footer-caption mb-50">
<div class="footer-tittle mb-30">
<h4>PHONE</h4>
<ul>
<li>0948-518-9064</li>
</ul>
</div>
<div class="footer-tittle mb-30">
<h4>WORKING TIME</h4>
<ul>
<li>08:00 AM – 05:00 PM</li>
<li>Saturday Offline</li>
<li>Sunday Offline</li>
</ul>
</div>
<div class="footer-tittle mb-30">
<h4>OUR CLINIC ADDRESS</h4>
<ul>
<li>Impig Sipocot Camarines Sur, at Central Bicol State University of Agriculture beside BAC OFFICE near AVR.</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- <div class="footer-bottom-area">
<div class="container">
<div class="footer-border">
<div class="row">
<div class="col-xl-12 ">
<div class="footer-copy-right text-center">
<p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by <a href="../../index-2.htm" target="_blank" rel="nofollow noopener">Colorlib</a></p>
</div>
</div>
</div>
</div>
</div>
</div> -->
</div>
</footer>

<div id="back-top">
<a class="wrapper" title="Go to Top" href="#">
<div class="arrows-container">
<div class="arrow arrow-one">
</div>
<div class="arrow arrow-two">
</div>
</div>
</a>
</div>


<style>

    .message {
        position: relative;
    }

    .message-icon {
        position: fixed;
        bottom: 0;
        right: 0;
        margin-bottom: 20px;
        margin-right: 30px;
        background: #126131;
        height: 50px;
        width: 50px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items:center;
        transition: 500ms;
    }

    .message-icon:hover {
        transform: scale(1.1);
    }

    .message-icon span {
        position: absolute;
        top: 0;
        right: 0;
        background: red;
        color: white;
        padding: 2px 5px;
        border-radius: 6px;
        margin-top: -8px;
        margin-right: -2px;
        font-size: 14px;
    }

    .message-display {
        min-height: 60vh;
        height: auto;
        max-height: 70vh;
        width: 400px;
        background: transparent;
        position: fixed;
        bottom: 0;
        right: 0;
        z-index: 99;
        margin-bottom: 46px;
        margin-right: 53px;
        border-radius: 10px 10px 0 10px;
        padding: 10px;
    }

    .message-content {
        height: 43vh;
        border: 1px solid #e3e7ed;
        overflow-y: auto;
        margin-bottom:20px;
        position: relative;
        padding: 10px;
    }

    .message-content .sender {
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .message-content .receiver {
        display: flex;
        justify-content: start;
        align-items: center;
    }

    .message-content small {
        float: right;
    }

    .message-content .sender .message {
        margin: 5px 0;
        background: lightblue;
        font-size: 1rem;
        padding: 5px 7px;
        margin-right: 8px;
        border-radius: 5px 5px 0 5px;
        max-width: 80%;
        width: auto;
    }

    .message-content .receiver .message {
        margin: 5px 0;
        background: #8bc34a61;
        font-size: 1rem;
        padding: 5px 7px;
        margin-left: 8px;
        border-radius: 5px 5px 5px 0;
        max-width: 80%;
        width: auto;
    }

    .message-content .sender img, .message-content .receiver img {
        align-self: end;
    }

</style>

<?php 
    $sessionID = !$this->session->has_userdata('patientID') ? false : $this->session->userdata('patientID');
    if ($sessionID) {
        echo '
        <div class="message">
            <div class="message-display" style="display: none;" id="messageDisplay">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 py-1">Clinic Administrator</h4>
                        <span class="hide-message font-weight-bolder" style="cursor: pointer;">_</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="message-content my-1" id="messageContent"></div>

                        <div class="form-group mb-0">
                            <div class="input-group">
                                <textarea class="form-control"
                                    placeholder="Type a message..."
                                    rows="1"
                                    name="message"
                                    style="resize: none; font-size: 1rem;"
                                    website="true"></textarea>
                                <div class="input-group-append">
                                    <button class="btn px-2 py-3"
                                        id="btnSend"
                                        website="true"><i class="fas fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="message-icon">
                <a href="#" class="message-link">
                    <span id="messageCount">0</span>
                    <i class="fas fa-envelope fa-1x text-white"></i>
                </a>
            </div>
        </div>';
    }
?>





<script>eval(mod_pagespeed_AZPrxOHD6w);</script>

<script src="<?=base_url()?>assets/website/assets/js/owl.carousel.min.js slick.min.js.pagespeed.jc.A9wRWS-Olo.js"></script><script>eval(mod_pagespeed_36GbvHB$oz);</script>
<script>eval(mod_pagespeed_TNl5xh$XeD);</script>
<script src="<?=base_url()?>assets/website/assets/js/jquery.slicknav.min.js hover-direction-snake.min.js wow.min.js jquery.magnific-popup.js jquery.nice-select.min.js jquery.counterup.min.js waypoints.min.js contact.js.pagespeed.jc.p7voW.js"></script><script>eval(mod_pagespeed_fuD3CPnIbX);</script>
<script>eval(mod_pagespeed_wnYb3wQQyM);</script>

<script>eval(mod_pagespeed_LIDbHpTVIR);</script>
<script>eval(mod_pagespeed_pmzWk1e0gP);</script>
<script>eval(mod_pagespeed_vbFg7Qlkr4);</script>
<script>eval(mod_pagespeed_lw_6tIUWzn);</script>
<script>eval(mod_pagespeed_FHIexq8fYp);</script>

<script>eval(mod_pagespeed_Xn761XBRUt);</script>
<script src="<?=base_url()?>assets/website/assets/js/jquery.form.js jquery.validate.min.js mail-script.js jquery.ajaxchimp.min.js plugins.js main.js.pagespeed.jc.cjXfRQVb1g.js"></script><script>eval(mod_pagespeed_DIAWMIE313);</script>
<script>eval(mod_pagespeed_twE$0mMo8n);</script>
<script>eval(mod_pagespeed_TLeJEVBw$U);</script>
<script>eval(mod_pagespeed_c9m0A0tSab);</script>

<script>eval(mod_pagespeed_Ulb0te0aYE);</script>
<script>eval(mod_pagespeed_YbfRHBnIIs);</script>
<script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/toastDemo.js') ?>"></script>
<!-- <script async="" src="../../gtag/js-2.js?id=UA-23581568-13"></script> -->
<script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
<!-- <script defer="" src="../../beacon.min-1.js" data-cf-beacon='{"rayId":"650134a09b662254","version":"2021.5.1","si":10}'></script> -->
<!-- <script defer="" src="../../beacon.min.js/v64f9daad31f64f81be21cbef6184a5e31634941392597-2" integrity="sha512-gV/bogrUTVP2N3IzTDKzgP0Js1gg4fbwtYB6ftgLbKQu/V8yH2+lrKCfKHelh4SO3DPzKj4/glTO+tNJGDnb0A==" data-cf-beacon='{"rayId":"6b854e786abf472d","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.11.0","si":100}' crossorigin="anonymous"></script> -->
<script src="<?= base_url('assets/js/system-operations.js') ?>"></script>
<script src="<?= base_url('assets/js/custom-general.js') ?>"></script>
<script src="<?= base_url('assets/js/messages.js') ?>"></script>
</body>
</html>

<script>

    $(document).ready(function(){

        // ----- MODAL CLOSE -----
        $(document).on('click', `[class="close"]`, function() {
            $('#modal').modal("hide");
        })
        // ----- END MODAL CLOSE -----

        
        let content     = loginContent();
        let sessionID   = $("body").attr("sessionid");

        // ----- GLOBAL VARIABLES -----
        let yearList        = getTableData(`years WHERE is_deleted = 0`);
        let courseList      = getTableData(`courses WHERE is_deleted = 0`);
        let patientTypeList = getTableData('patient_type WHERE is_deleted = 0');
        let patientList     = getTableData(`patients WHERE is_deleted = 0`);
        let serviceList     = getTableData(`services WHERE is_deleted = 0`);
        let patientIDList   = [];
        patientList.map(i => {
            patientIDList.push({patient_id: i.patient_id, patient_code: i.patient_code})
        })
        // ----- END GLOBAL VARIABLES -----

        $(document).on("click",".login",function(){
            $(".modal").modal("hide");
            $(".modal-dialog").removeClass("modal-lg").addClass("modal-md");
            $(".modal-title").text("LOGIN");
            $(".modal-body").html(content);
            setTimeout(() => {
                $(".modal").modal("show");
            }, 120);
        });

        $(document).on("click",".register",function(){
            $(".modal").modal("hide");
            $(".modal-dialog").removeClass("modal-md").addClass("modal-lg");
            let content = registerContent();

            $(".modal-title").text("REGISTER");
            $(".modal-body").html(content);
            $(`[name="patient_code"]`).inputmask({
                    mask:        "99-9999",
                    placeholder: "00-0000"
            });
            setTimeout(() => {
                $(".modal").modal("show");
                generateInputsID("#modal");
            }, 120);
        });

        function loginContent(){
            let html = `    
            <form action="${base_url}login/authenticateWebsite" method="POST" id="loginForm">
                <div class="alert alert-danger d-none" id="loginError"></div>
                <div class="row">
                    <div class="col-12 my-2">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control valid validate" name="email" id="email" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your email'" placeholder="Enter your email" required>
                    </div>
                    </div>
                    <div class="col-12 my-2">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control valid validate" name="password" id="password" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your password'" placeholder="Enter your password" required>
                        </div>
                    </div>
                    <div class="col-12 my-2">
                        <button type="submit" class="button button-contactForm boxed-btn w-100 py-2">Login</button>
                    </div>
                </div>
            </form>`;
            return html;
        }

        // ----- REGISTER -----
        function registerContent(){

            let html = `
            <div class="row p-3">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Patient ID <code>*</code></label>
                        <input type="text" 
                            class="form-control validate inputmask"
                            name="patient_code"
                            minlength="2"
                            maxlength="20"
                            data-inputmask-alias="99-9999"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>First Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="firstname"
                            minlength="2"
                            maxlength="20"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" 
                            class="form-control validate"
                            name="middlename"
                            minlength="2"
                            maxlength="20">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Last Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="lastname"
                            minlength="2"
                            maxlength="20"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Suffix</label>
                        <select class="form-control validate"
                            name="suffix">
                            <option value="" selected>Select suffix</option>    
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="I"  >I</option>
                            <option value="II" >II</option>
                            <option value="III">III</option>
                            <option value="IV" >IV</option>
                            <option value="V"  >V</option>
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Email <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="email"
                            minlength="2"
                            maxlength="50"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Password <code>*</code></label>
                        <div class="input-group">
                            <input type="password" 
                                class="form-control validate"
                                name="password"
                                minlength="2"
                                maxlength="50"
                                style="border-right: none;"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text"
                                    style="background: rgb(0 0 0 / 0%); border-left: none; height: 100%;">
                                    <i class="fas fa-eye" style="cursor: pointer;" display="true"
                                        onClick="
                                            let element = document.querySelector('[name=password]');
                                            let display = this.getAttribute('display') == 'true';
                                            let classes = display ? 'fas fa-eye-slash' : 'fas fa-eye';
                                            this.classList = classes;
                                            this.setAttribute('display', display ? 'false' : 'true');
                                            element.setAttribute('type', display ? 'text' : 'password');
                                        "></i>
                                </span>
                            </div>
                        </div>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Confirm Password <code>*</code></label>
                        <div class="input-group">
                            <input type="password" 
                                class="form-control validate"
                                name="confirmPassword"
                                minlength="2"
                                maxlength="50"
                                style="border-right: none;"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text"
                                    style="background: rgb(0 0 0 / 0%); border-left: none; height: 100%;">
                                    <i class="fas fa-eye" style="cursor: pointer;" display="true"
                                        onClick="
                                            let element = document.querySelector('[name=confirmPassword]');
                                            let display = this.getAttribute('display') == 'true';
                                            let classes = display ? 'fas fa-eye-slash' : 'fas fa-eye';
                                            this.classList = classes;
                                            this.setAttribute('display', display ? 'false' : 'true');
                                            element.setAttribute('type', display ? 'text' : 'password');
                                        "></i>
                                </span>
                            </div>
                        </div>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Age <code>*</code></label>
                        <input type="number" 
                            class="form-control validate"
                            name="age"
                            min="1"
                            minlength="2"
                            maxlength="50"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Gender <code>*</code></label>
                        <select class="form-control validate"
                            name="gender"
                            required>
                            <option value="" selected>Select gender</option>    
                            <option value="Male"  >Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Occupation Type <code>*</code></label>
                        <select class="form-control validate"
                            name="patient_type_id"
                            required>
                            ${getPatientTypeOptionDisplay()}
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Course</label>
                        <select class="form-control validate"
                            name="course_id"
                            disabled>
                        ${getCourseOptionDisplay()}
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Year</label>
                        <select class="form-control validate"
                            name="year_id"
                            disabled>
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Section</label>
                        <input type="text" 
                            class="form-control validate"
                            name="section"
                            minlength="1"
                            maxlength="50"
                            disabled>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button style="
                    background: green;
                    color: white;
                    padding: 5px 30px;
                    border-radius: 5px;
                    outline: none;
                    border: 1px solid green;" 
                    id="btnSaveRegister">Save</button>
            </div>`;

            return html;
        }

        function validatePassword() {
            let invalid   = $(`[name="password"]`).closest('.form-group').find('.invalid-feedback');
            let password  = $(`[name="password"]`).val();
            let element   = $(`[name="password"]`);
            let validated = element.hasClass('validated');

            let errors = [];
            if (password.length < 8) {
                errors.push("Your password must be at least 8 characters"); 
            }

            if (password.search(/.*[a-z].*/) < 0) {
                errors.push("Your password must contain at least one lower letter.");
            }

            if (password.search(/.*[A-Z].*/) < 0) {
                errors.push("Your password must contain at least one upper letter.");
            }

            if (password.search(/[0-9]/) < 0) {
                errors.push("Your password must contain at least one digit."); 
            }

            if (errors.length) {
                validated ? element.removeClass("is-valid").removeClass("no-error").addClass("is-invalid").addClass('has-error') : element.removeClass("is-valid").removeClass("no-error").removeClass("is-invalid").removeClass("has-error");
                invalid.text(errors[0]);
                return false;
            } else {
                validated ? element.removeClass("is-invalid").removeClass("has-error").addClass("is-valid").addClass("no-error") : element.removeClass("is-invalid").removeClass('has-error').removeClass("is-valid").removeClass("no-error");
                invalid.text('');
                return true;
            }
        }

        function comparePassword() {
            let password  = $(`[name="password"]`).val();
            let compare   = $(`[name="confirmPassword"]`).val();
            let invalid   = $(`[name="confirmPassword"]`).closest('.form-group').find('.invalid-feedback');
            let element   = $(`[name="confirmPassword"]`);
            let validated = element.hasClass('validated');

            if (password == compare) {
                validated ? element.removeClass("is-invalid").removeClass("has-error").addClass("is-valid").addClass("no-error") : element.removeClass("is-invalid").removeClass('has-error').removeClass("is-valid").removeClass("no-error");
                invalid.text('');
                return true;
            } else {
                validated ? element.removeClass("is-valid").removeClass("no-error").addClass("is-invalid").addClass('has-error') : element.removeClass("is-valid").removeClass("no-error").removeClass("is-invalid").removeClass("has-error");
                invalid.text('Password not match');
                return false;
            }
        }

        $(document).on('keyup', `[name="password"]`, function() {
            validatePassword();
        })

        $(document).on('keyup', `[name="confirmPassword"]`, function() {
            comparePassword();
        })

        function validateEmail(patientID = 0, email = '') {
            return patientID ? !patientList.filter(p => p.email == email && p.patient_id != patientID).length : !patientList.filter(p => p.email == email).length;
        }

        // ----- VALIDATE PATIENT ID -----
        function validatePatientID(patientID = 0, patientCode = '') {
            let arr = patientIDList.filter(id => id.patient_id != patientID && id.patient_code == patientCode);
            let flag = arr.length ? false : true;
            if (!flag) {
                showNotification('danger', 'Patient ID is already exists!');
            }
            return flag;
        }
        // ----- END VALIDATE PATIENT ID -----

        $(document).on("click", `#btnSaveRegister`, function() {
            let patientCode = $(`[name="patient_code"]`).val();
            
            let validate       = validateForm("modal");
            let checkPatientID = validatePatientID(0, patientCode);
            let checkEmail     = validateEmail(0, $(`[name="email"]`).val()?.trim());
            let checkPassword  = validatePassword() && comparePassword();

            if (checkPassword) {
                if (checkEmail) {
                    if (validate && checkPatientID) {
                        $("#modal").modal("hide");
    
                        let data = getFormData("modal");
                            data["tableName"] = "patients";
                            data["feedback"]  = $(`[name="patient_code"]`).val();
                            data["method"]    = "add";
                            data['tableData[is_verified]'] = '0';
                        delete data.tableData['confirmPassword'];
            
                        sweetAlertConfirmation("add", "Patient", "modal", null, data, true);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: "Error!",
                        text: "Email already exists!",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
        // ----- END REGISTER -----



    

        $(document).on("click", "#contactForm", function(e){
            let message = $("#message").val();
            let name    = $("#name").val();
            let email   = $("#email").val();
            let subject = $("#subject").val();
            let tableData   =   getTableData("system_setup");
            if(message && name && email && subject ){
                e.preventDefault();
                window.location.href = `mailto:${tableData[0]["email"]}?subject=${subject}"&body=Hi my Name is:${name}, %0D %0D"  ${message}`;
            }
        });



        // ----- MAKING APPOINTMENT -----
        $(document).on("click", `.make-appointment`, function() {
            $("#modal").modal("hide");
            $(".modal-dialog").addClass("modal-lg");

            if (sessionID) {
                let content = appointmentModalContent();
                $(".modal-title").text("MAKE APPOINTMENT");
                $(".modal-body").html(content);
                setTimeout(() => {
                    $("#modal").modal("show");
                }, 120);
            } else {
                $(".modal").modal("hide");
                $(".modal-dialog").removeClass("modal-lg").addClass("modal-md");
                $(".modal-title").text("LOGIN");
                $(".modal-body").html(content);
                setTimeout(() => {
                    $(".modal").modal("show");
                }, 120);
            }

        })
        // ----- END MAKING APPOINTMENT -----
        function appointmentModalContent(){
            let tableData = getTableData("patients",`CONCAT(lastname,", ",firstname," ",middlename) AS fullname`, `patient_id='${sessionID}'`);
            let html     = `
                                <div class="row p-3">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Patient <code>*</code></label>
                                            <input type="button"
                                                class="form-control text-left"
                                                value="${tableData[0]["fullname"]}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Service Type <code>*</code></label>
                                            <select class="form-control validate"
                                                name="service_id" id="service_id"
                                                required>
                                                ${getServiceOptionDisplay()}
                                            </select>
                                            <div class="d-block invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Date Appointment</label>
                                            <input type="date"
                                                class="form-control text-left"
                                                name="date_appointment" id="date_appointment"
                                                min="${moment().format("YYYY-MM-DD")}"
                                                value="">
                                            <div class="d-block invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Purpose <code>*</code></label>
                                            <textarea class="form-control validate"
                                                name="purpose"
                                                minlength="2"
                                                maxlength="200"
                                                rows="3"
                                                style="resize: none;"
                                                id="purpose"
                                                required></textarea>
                                            <div class="d-block invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <button type="submit" class="button boxed-btn w-100 py-2" id="btnSaveAppointment">Save</button>
                                    </div>
                                </div>`;
            return html;
        }

        // ----- MAKING APPOINTMENT -----
            $(document).on("click", `#btnSaveAppointment`, function() {
            
                let validate = validateForm("modal");
                if (validate) {
                    $("#modal").modal("hide");

                    let data = getFormData("modal");

                        data["tableName"] = "clinic_appointments";
                        data["tableData"]["date_appointment"] = moment($("[name=date_appointment]").val()).format("YYYY-MM-DD");
                        data["tableData"]["patient_id"]     = sessionID;
                        data["tableData"]["is_website"]     = 1;
                        data["tableData"]["is_read"]        = 0;
                        data["feedback"]  = "Appointment";
                        data["method"]    = "add";

                    sweetAlertConfirmation("add", "Appointment", "modal", null, data, true);
                }
            })
        // ----- END MAKING APPOINTMENT -----

        // ----- PATIENT OPTION DISPLAY -----
            function getPatientOptionDisplay(patientID = 0) {
                let html = `<option value="" selected>Select patient</option>`;
                patientList.map(patient => {
                    let {
                        patient_id = "",
                        firstname  = "",
                        middlename = "",
                        lastname   = "",
                        suffix     = "",
                    } = patient;

                    let fullname = `${firstname} ${middlename} ${lastname} ${suffix}`;

                    html += `
                    <option value="${patient_id}"
                        ${patient_id == patientID ? "selected" : ""}>${fullname}</option>`;
                })
                return html;
            }
        // ----- END PATIENT OPTION DISPLAY -----

        // ----- SERVICE OPTION DISPLAY -----
            function getServiceOptionDisplay(serviceID = 0) {
                let html = `<option value="" selected>Select service</option>`;
                serviceList.map(service => {
                    let {
                        service_id = "",
                        name       = "",
                    } = service;

                    html += `
                    <option value="${service_id}"
                        ${service_id == serviceID ? "selected" : ""}>${name}</option>`;
                })
                return html;
            }
        // ----- END SERVICE OPTION DISPLAY -----

        // ----- PATIENT TYPE OPTIONS DISPLAY -----
            function getPatientTypeOptionDisplay(patientTypeID = 0, isAll = false) {
                let html = isAll ? `<option value="0">All</option>` : `<option value="" selected>Select patient type</option>`;
                patientTypeList.map(type => {
                    let {
                        patient_type_id,
                        name
                    } = type;

                    html += `
                    <option value="${patient_type_id}"
                        ${patient_type_id == patientTypeID ? "selected" : ""}>${name}</option>`;
                })
                return html;
            }
        // ----- END PATIENT TYPE OPTIONS DISPLAY -----

            // ----- COURSE OPTIONS DISPLAY -----
            function getCourseOptionDisplay(courseID = 0) {
                let html = `<option value="" selected>Select course</option>`;
                courseList.map(course => {
                    let {
                        course_id,
                        name
                    } = course;

                    html += `
                    <option value="${course_id}"
                        ${course_id == courseID ? "selected" : ""}>${name}</option>`;
                })
                return html;
            }
        // ----- END COURSE OPTIONS DISPLAY -----

        // ----- YEAR OPTIONS DISPLAY -----
            function getYearOptionDisplay(courseID = 0, yearID = 0) {
                let html = `<option value="" selected>Select year</option>`;
                yearList.filter(yr => yr.course_id == courseID)
                .map(year => {
                    let {
                        year_id,
                        name
                    } = year;

                    html += `
                    <option value="${year_id}"
                        ${year_id == yearID ? "selected" : ""}>${name}</option>`;
                })
                return html;
            }
        // ----- END YEAR OPTIONS DISPLAY -----



        // ----- CHANGE PATIENT TYPE -----
        $(document).on("change", `[name="patient_type_id"]`, function() {
            let patientType = $(this).val();

            $(`[name="course_id"]`).val('').trigger('change');
            $(`[name="year_id"]`).val('').trigger('change');
            $(`[name="section"]`).val('');

            if (patientType && patientType == 2) {
                $(`[name="course_id"]`).removeAttr("disabled").attr("required", true);
                $(`[name="year_id"]`).removeAttr("disabled").attr("required", true);
                $(`[name="section"]`).removeAttr("disabled").attr("required", true);
            } else {
                $(`[name="course_id"]`).attr("disabled", true);
                $(`[name="year_id"]`).attr("disabled", true);
                $(`[name="section"]`).attr("disabled", true);
                $(`[name="course_id"]`).removeClass("is-valid").removeClass("is-invalid").removeClass("no-error").removeClass("has-error");
                $(`[name="year_id"]`).removeClass("is-valid").removeClass("is-invalid").removeClass("no-error").removeClass("has-error");
                $(`[name="section"]`).removeClass("is-valid").removeClass("is-invalid").removeClass("no-error").removeClass("has-error");
                $(`[name="course_id"]`).closest(`.form-group`).find(`.invalid-feedback`).text('');
                $(`[name="year_id"]`).closest(`.form-group`).find(`.invalid-feedback`).text('');
                $(`[name="section"]`).closest(`.form-group`).find(`.invalid-feedback`).text('');
            }
        })
        // ----- END CHANGE PATIENT TYPE -----


        // ----- CHANGE COURSE -----
        $(document).on("change", `[name="course_id"]`, function() {
            let courseID = $(this).val();
            let options  = getYearOptionDisplay(courseID);
            $(`[name="year_id"]`).html(options);
        })
        // ----- END CHANGE COURSE -----



        // ----- LOGIN -----
        $(document).on('submit', '#loginForm', function(e) {
            e.preventDefault();
            let base_url = $(`body`).attr("base_url");
            $.ajax({
                method: "POST",
                url: `${base_url}login/authenticateWebsite`,
                data: {
                    email:    $(`[name="email"]`).val(),
                    password: $(`[name="password"]`).val(),
                },
                dataType: 'json',
                async: false,
                success: function(data) {
                    let result = data.split('|');
                    if (result[0] == 'true') {
                        window.open('welcome', '_self');
                    } else {
                        let html = `<b class="text-danger">Error! </b>${result[1]}`;
                        $('#loginError').removeClass('d-none').html(html);
                    }
                }
            })
        })
        // ----- END LOGIN -----


    });

    
</script>