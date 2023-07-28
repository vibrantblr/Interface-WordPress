<?php 
$post_id = get_the_ID(); 
$custom_form_script = $footer_cta_link = '';
if(!empty($post_id)){
    $custom_form_script = get_field('custom_form_script', $post_id);
    $footer_cta_link = get_field('footer_cta_link', $post_id);
}
?>
<!--schedule demo form-->
<div class="offcanvas offcanvas-end schedule-demo-wrapper" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header p-0"> 
        <button type="button" class="btn-close position-relative d-flex justify-content-center align-items-center p-0" data-bs-dismiss="offcanvas" aria-label="Close">
            <img src="<?php echo THEME_IMG; ?>close.svg" class="img-fluid" alt="Close icon">
        </button>
    </div>
    <!-- Form will load from custom.js file on click event -->
    <div class="offcanvas-body"></div>
</div>
<?php if(!empty($custom_form_script)){ ?>
    <div class="offcanvas offcanvas-end schedule-demo-wrapper" tabindex="-1" id="offCanCusForm" aria-labelledby="offCanCusFormLabel">
        <div class="offcanvas-header p-0">
            <button type="button" class="btn-close position-relative d-flex justify-content-center align-items-center p-0" data-bs-dismiss="offcanvas" aria-label="Close">
                <img src="<?php echo THEME_IMG; ?>close.svg" class="img-fluid" alt="Close icon">
            </button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="schedule-demo-content-wrap">
                <div>
                    <img class="img-fluid" src="<?php echo THEME_IMG; ?>case-study-offcanvas.png" alt="Schedule demo">
                    <h2 class="fw-600 text-black">Download Case Study</h2>
                    <p class="fs-16 fw-300 ibm fst-italic">We’ll send it to the email you enter below</p>
                </div>
                <div class="demo-forms-section">
                    <?php if(is_page('contact-us')){ // because contact form has same form in desktop view without offcanvar popup - to avoid conflict
                        if(wp_is_mobile()){ ?>
                            <script src="//digital-assistants.interface-ai.com/js/forms2/js/forms2.min.js"></script>
                            <?php echo $custom_form_script; ?>
                        <?php }
                    }else{ ?>
                        <script src="//digital-assistants.interface-ai.com/js/forms2/js/forms2.min.js"></script>
                        <?php echo $custom_form_script; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php if( $footer_cta_link == '#offCanPartnerForm'){ ?>
    <div class="offcanvas offcanvas-end schedule-demo-wrapper" tabindex="-1" id="offCanPartnerForm" aria-labelledby="offCanPartnerFormLabel">
        <div class="offcanvas-header p-0">
            <button type="button" class="btn-close position-relative d-flex justify-content-center align-items-center p-0" data-bs-dismiss="offcanvas" aria-label="Close">
                <img src="<?php echo THEME_IMG; ?>close.svg" class="img-fluid" alt="Close icon">
            </button>
        </div>
        <div class="offcanvas-body p-0">
            <div class="schedule-demo-content-wrap">
                <div>
                    <img class="img-fluid" src="<?php echo THEME_IMG; ?>case-study-offcanvas.png" alt="Schedule demo">
                    <h2 class="fw-600 text-black">Become A Partner</h2>
                    <p class="fs-16 fw-300 ibm fst-italic">Our sales staff will reach out to you shortly</p>
                </div>
                <div class="demo-forms-section">
                    <script src="//digital-assistants.interface-ai.com/js/forms2/js/forms2.min.js"></script>
                    <form id="mktoForm_1039"></form>
                    <script>MktoForms2.loadForm("//digital-assistants.interface-ai.com", "644-XUA-838", 1039);</script>
                </div>
            </div>
        </div>
    </div>
<?php } ?>