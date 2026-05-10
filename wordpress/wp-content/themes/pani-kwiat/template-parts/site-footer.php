<?php

declare(strict_types=1);

$header = pk_header_strings();
$contact = pk_contact_details();
?>
<footer id="footer" data-astro-cid-sz7xmlte="">
    <div class="container" data-astro-cid-sz7xmlte="">
        <div class="wrapper" data-astro-cid-sz7xmlte="">
            <div class="info-wrapper" data-astro-cid-sz7xmlte="">
                <div class="info-wrapper-container" data-astro-cid-sz7xmlte="">
                    <span style="font-family:'DM Serif Display',serif;font-size:34px;line-height:1;color:#fff;">Pani <span style="color:#8CAE6B;">Kwiat</span></span>
                </div>
            </div>
            <div class="contact-wrapper" data-astro-cid-sz7xmlte="">
                <h3 data-astro-cid-sz7xmlte=""><?php echo esc_html($header['help']); ?></h3>
                <div class="contact-wrapper-2-columns" data-astro-cid-sz7xmlte="">
                    <a href="<?php echo esc_url($contact['phone_href']); ?>" class="phone" data-astro-cid-sz7xmlte="">
                        <span data-astro-cid-sz7xmlte=""><?php echo esc_html($contact['phone']); ?></span>
                    </a>
                    <a href="<?php echo esc_url($contact['email_href']); ?>" class="phone mail" data-astro-cid-sz7xmlte="">
                        <span data-astro-cid-sz7xmlte=""><?php echo esc_html($contact['email']); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<section class="copyright" data-astro-cid-sz7xmlte="">
    <div class="container" data-astro-cid-sz7xmlte="">
        <p data-astro-cid-sz7xmlte=""><?php echo esc_html($header['copyright']); ?></p>
    </div>
</section>

