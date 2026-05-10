<?php

declare(strict_types=1);

$strings = pk_header_strings();
$contact = pk_contact_details();
$defaults = pk_defaults();
?>
<dialog id="pk-contact-modal" class="pk-contact-modal" data-astro-cid-fziqq5va="">
    <div data-astro-cid-bbe6dxrz="">
        <div class="wrapper-form" data-astro-cid-bbe6dxrz="">
            <div class="phone-wrapper" data-astro-cid-bbe6dxrz="">
                <h3 data-astro-cid-bbe6dxrz=""><?php echo nl2br(esc_html($strings['form_phone_heading'])); ?></h3>
                <hr data-astro-cid-bbe6dxrz="" />
                <a href="<?php echo esc_url($contact['phone_href']); ?>" class="phone" data-astro-cid-bbe6dxrz="">
                    <span data-astro-cid-bbe6dxrz=""><?php echo esc_html($contact['phone']); ?></span>
                </a>
            </div>
            <div class="form-wrapper" data-astro-cid-bbe6dxrz="">
                <h3 data-astro-cid-bbe6dxrz=""><?php echo esc_html($strings['form_heading']); ?></h3>
                <?php if ($strings['form_shortcode'] !== '') : ?>
                    <?php echo do_shortcode($strings['form_shortcode']); ?>
                <?php else : ?>
                    <form target="_blank" action="https://formsubmit.co/<?php echo esc_attr($contact['email']); ?>" method="POST" data-astro-cid-bbe6dxrz="">
                        <div class="form-group" data-astro-cid-bbe6dxrz="">
                            <div class="form-row" data-astro-cid-bbe6dxrz="">
                                <div class="col" data-astro-cid-bbe6dxrz="">
                                    <label data-astro-cid-bbe6dxrz=""><?php echo esc_html($contact['labels']['name_label']); ?></label>
                                    <input type="text" name="name" class="form-control" placeholder="<?php echo esc_attr($contact['labels']['name_placeholder']); ?>" required data-astro-cid-bbe6dxrz="" />
                                </div>
                                <div class="col" data-astro-cid-bbe6dxrz="">
                                    <label data-astro-cid-bbe6dxrz=""><?php echo esc_html($contact['labels']['phone_label']); ?></label>
                                    <input type="text" name="phone" class="form-control" placeholder="<?php echo esc_attr($contact['labels']['phone_placeholder']); ?>" required data-astro-cid-bbe6dxrz="" />
                                </div>
                                <div class="col" data-astro-cid-bbe6dxrz="">
                                    <label data-astro-cid-bbe6dxrz=""><?php echo esc_html($contact['labels']['email_label']); ?></label>
                                    <input type="email" name="email" class="form-control" placeholder="<?php echo esc_attr($contact['labels']['email_placeholder']); ?>" required data-astro-cid-bbe6dxrz="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-astro-cid-bbe6dxrz="">
                            <label data-astro-cid-bbe6dxrz=""><?php echo esc_html($contact['labels']['message_label']); ?></label>
                            <textarea placeholder="<?php echo esc_attr($contact['labels']['message_placeholder']); ?>" class="form-control" name="message" rows="6" required data-astro-cid-bbe6dxrz=""></textarea>
                        </div>
                        <input type="text" name="_honey" style="display:none" data-astro-cid-bbe6dxrz="" />
                        <input type="hidden" name="_next" value="<?php echo esc_url(home_url('/')); ?>" data-astro-cid-bbe6dxrz="" />
                        <input type="hidden" name="_captcha" value="false" data-astro-cid-bbe6dxrz="" />
                        <div class="btn-form-wrapper" data-astro-cid-bbe6dxrz="">
                            <div data-astro-cid-bbe6dxrz="">
                                <input type="checkbox" id="pk-rodo" name="rodo" value="1" data-astro-cid-bbe6dxrz="" />
                                <label for="pk-rodo" data-astro-cid-bbe6dxrz=""><?php echo esc_html($contact['labels']['consent']); ?></label>
                            </div>
                            <button type="submit" class="btn btn-primary" data-astro-cid-bbe6dxrz="">
                                <?php echo esc_html($contact['labels']['submit']); ?>
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <form method="dialog" data-astro-cid-fziqq5va="">
        <button type="submit" class="close-button-form" data-dialog-close data-astro-cid-bbe6dxrz="">X</button>
    </form>
</dialog>

