<?php

declare(strict_types=1);

$header = pk_header_strings();
$contact = pk_contact_details();
$pricingPage = is_page_template('template-pricing.php');
$menuItems = pk_menu_items($pricingPage);
$languages = pk_language_switcher();
$defaults = pk_defaults();
?>
<header class="header section" data-astro-cid-3ef6ksr2>
    <div class="container" data-astro-cid-3ef6ksr2>
        <div class="header-wrapper" data-astro-cid-3ef6ksr2>
            <p data-astro-cid-3ef6ksr2><strong data-astro-cid-3ef6ksr2><?php echo esc_html($header['question']); ?></strong> <?php echo esc_html($header['contact']); ?></p>
            <!-- 📞 Telefon -->
            <a href="<?php echo esc_url($contact['phone_href']); ?>" class="header-phone" data-astro-cid-3ef6ksr2>
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="11" viewBox="0 0 13 11" fill="none" data-astro-cid-3ef6ksr2>
                    <path d="M8.80458 7.09895L8.5202 7.38208C8.5202 7.38208 7.84333 8.05458 5.99645 6.21833C4.14958 4.38208 4.82645 3.70958 4.82645 3.70958L5.0052 3.53083C5.44708 3.09208 5.48895 2.38708 5.10333 1.87208L4.31583 0.820202C3.83833 0.182702 2.91645 0.0983271 2.36958 0.642077L1.38833 1.61708C1.1177 1.88708 0.936453 2.23583 0.958328 2.62333C1.01458 3.6152 1.46333 5.74833 3.96583 8.23708C6.6202 10.8758 9.11083 10.9808 10.129 10.8858C10.4515 10.8558 10.7315 10.6921 10.9571 10.4671L11.8446 9.58458C12.4446 8.98895 12.2758 7.96708 11.5083 7.5502L10.3146 6.90083C9.81083 6.62708 9.19833 6.7077 8.80458 7.09895Z" fill="white" data-astro-cid-3ef6ksr2></path>
                </svg>
                <span data-astro-cid-3ef6ksr2><?php echo esc_html($contact['phone']); ?></span>
            </a>

            <!-- ✉️ E-mail -->
            <a href="<?php echo esc_url($contact['email_href']); ?>" class="header-phone" data-astro-cid-3ef6ksr2>
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" data-astro-cid-3ef6ksr2>
                    <g clip-path="url(#clip0_437_77)" data-astro-cid-3ef6ksr2>
                        <path d="M17.8418 3.57614L12.3828 9.00001L17.8418 14.4239C17.9405 14.2176 18.0004 13.9896 18.0004 13.7461V4.25392C18.0004 4.01039 17.9405 3.7824 17.8418 3.57614Z" fill="white" data-astro-cid-3ef6ksr2></path>
                        <path d="M16.418 2.67188H1.58207C1.33855 2.67188 1.11056 2.73175 0.904297 2.83043L7.88151 9.77249C8.49843 10.3894 9.50165 10.3894 10.1186 9.77249L17.0958 2.83043C16.8895 2.73175 16.6615 2.67188 16.418 2.67188Z" fill="white" data-astro-cid-3ef6ksr2></path>
                        <path d="M0.158555 3.57614C0.0598711 3.7824 0 4.01039 0 4.25392V13.7461C0 13.9896 0.0598711 14.2177 0.158555 14.4239L5.61758 9.00001L0.158555 3.57614Z" fill="white" data-astro-cid-3ef6ksr2></path>
                        <path d="M11.6368 9.7457L10.8643 10.5182C9.83634 11.5461 8.16371 11.5461 7.13578 10.5182L6.36332 9.7457L0.904297 15.1696C1.11056 15.2683 1.33855 15.3281 1.58207 15.3281H16.418C16.6615 15.3281 16.8895 15.2683 17.0958 15.1696L11.6368 9.7457Z" fill="white" data-astro-cid-3ef6ksr2></path>
                    </g>
                    <defs data-astro-cid-3ef6ksr2>
                        <clipPath id="clip0_437_77" data-astro-cid-3ef6ksr2>
                            <rect width="18" height="18" fill="white" data-astro-cid-3ef6ksr2></rect>
                        </clipPath>
                    </defs>
                </svg>
                <span style="text-transform: lowercase;" data-astro-cid-3ef6ksr2><?php echo esc_html($contact['email']); ?></span>
            </a>
        </div>
    </div>
</header>

<div class="py-0 navigation" data-astro-cid-3ef6ksr2 data-astro-cid-dmqpwcec>
    <div class="container mx-auto" data-astro-cid-3ef6ksr2 data-astro-cid-dmqpwcec>
        <div class="relative flex flex-col w-full py-5 mx-auto xl:items-center xl:justify-between xl:flex-row" data-astro-cid-3ef6ksr2 data-astro-cid-dmqpwcec>
            <div class="flex flex-row items-center justify-between xl:justify-start" data-astro-cid-3ef6ksr2 data-astro-cid-dmqpwcec>
                <a href="<?php echo esc_url(pk_lang_home_url()); ?>" class="lg:pr-8 text-black inline-flex items-center gap-3" aria-label="Strona główna" data-astro-cid-3ef6ksr2 data-astro-cid-dmqpwcec>
                    <svg width="170" height="52" viewBox="0 0 170 52" fill="none" xmlns="http://www.w3.org/2000/svg" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec="">
                        <path d="M89.5149 0.285706V14.3042H87.8457V0.285706H89.5149Z" fill="#151515" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec=""></path>
                        <path d="M84.5057 0.285706V14.3042H82.8904L75.379 3.29749H75.2444V14.3042H73.5752V0.285706H75.1905L82.7289 11.3198H82.8635V0.285706H84.5057Z" fill="#151515" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec=""></path>
                        <path d="M61.333 14.3042H59.583L64.6444 0.285706H66.3675L71.4289 14.3042H69.679L65.5598 2.50347H65.4521L61.333 14.3042ZM61.9791 8.82822H69.0328V10.3341H61.9791V8.82822Z" fill="#151515" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec=""></path>
                        <path d="M50.1436 14.3042V0.285706H54.8012C55.8825 0.285706 56.7665 0.484209 57.453 0.881217C58.144 1.27366 58.6556 1.80529 58.9876 2.47609C59.3197 3.1469 59.4857 3.89528 59.4857 4.72124C59.4857 5.5472 59.3197 6.29786 58.9876 6.97323C58.6601 7.6486 58.153 8.18707 57.4665 8.58864C56.78 8.98565 55.9005 9.18415 54.8281 9.18415H51.4897V7.67826H54.7742C55.5146 7.67826 56.1091 7.54821 56.5578 7.2881C57.0066 7.02799 57.3319 6.67662 57.5338 6.23398C57.7402 5.78677 57.8434 5.28253 57.8434 4.72124C57.8434 4.15995 57.7402 3.65799 57.5338 3.21535C57.3319 2.77271 57.0043 2.4259 56.5511 2.17491C56.0979 1.91937 55.4967 1.7916 54.7473 1.7916H51.8128V14.3042H50.1436Z" fill="#151515" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec=""></path>
                        <path d="M147.704 22.3155V20.5273H152.628V13.732L159.38 12.2298V20.5273H169.578V22.3155H159.38V44.0606C159.427 47.6371 160.646 49.473 163.037 49.5684C165.382 49.5207 167.07 47.3748 168.101 43.1307L170 43.4884C169.86 44.2513 169.672 44.9905 169.438 45.7058C168.125 49.7115 165.475 51.7143 161.49 51.7143C161.115 51.7143 160.716 51.6904 160.294 51.6428C155.183 51.1659 152.628 47.804 152.628 41.5571V22.3155H147.704Z" fill="#8CAE6B" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec=""></path>
                        <path d="M139.616 51.6428C136.099 51.5951 133.989 49.4492 133.285 45.2051C132.91 46.1588 132.371 47.0649 131.668 47.9232C129.511 50.4029 126.65 51.6428 123.087 51.6428C121.633 51.6428 120.297 51.4043 119.078 50.9275C115.842 49.6399 114.225 47.0887 114.225 43.2738C114.225 42.5585 114.295 41.867 114.436 41.1994C115.608 36.1446 121.821 33.5457 133.074 33.4027V28.8248C133.028 23.913 131.105 21.4095 127.307 21.3141C126.369 21.3141 125.572 21.481 124.916 21.8148C124.025 22.3394 123.274 23.5554 122.665 25.4629C122.524 25.9397 122.407 26.2974 122.313 26.5358C121.75 28.1095 120.742 28.8963 119.289 28.8963C118.914 28.8963 118.538 28.8486 118.163 28.7532C116.757 28.324 116.053 27.3465 116.053 25.8205C116.053 25.0098 116.311 24.1992 116.827 23.3885C118.562 20.8134 122.266 19.5259 127.94 19.5259C135.771 19.5736 139.733 23.2693 139.827 30.613V45.6343C139.873 47.9709 140.46 49.1869 141.585 49.2823C143.039 49.2346 143.929 47.5179 144.258 44.1321L146.086 44.2037C146.04 45.3005 145.899 46.278 145.664 47.1364C144.914 50.1406 142.898 51.6428 139.616 51.6428ZM125.971 48.71C126.674 48.71 127.401 48.5431 128.151 48.2093C130.636 47.1125 132.277 44.8951 133.074 41.5571V35.334C130.308 35.3817 128.057 35.6201 126.322 36.0493C122.946 36.9076 121.258 38.9581 121.258 42.2008C121.258 42.8684 121.305 43.4884 121.399 44.0606C121.868 47.1602 123.392 48.71 125.971 48.71Z" fill="#8CAE6B" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec=""></path>
                        <path d="M108.668 49.1392C108.996 49.1392 109.277 49.1631 109.512 49.2108C110.121 49.3061 110.426 49.8784 110.426 50.9275H93.7568V49.1392C94.9291 49.1392 95.8434 49.0677 96.4999 48.9246C98.0004 48.4955 98.7506 47.2079 98.7506 45.062V22.1725H93.7568V20.3842H105.503V49.1392H108.668ZM106.276 10.3701C106.276 11.0854 106.136 11.753 105.854 12.3729C105.057 13.9942 103.721 14.8049 101.845 14.8049C101.189 14.8049 100.556 14.6618 99.9463 14.3757C98.3052 13.6127 97.4846 12.2775 97.4846 10.3701C97.4846 9.65476 97.6487 8.9633 97.9769 8.29569C98.7741 6.67435 100.064 5.86368 101.845 5.86368C102.549 5.86368 103.229 6.03058 103.885 6.36439C105.479 7.22274 106.276 8.55797 106.276 10.3701Z" fill="#8CAE6B" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec=""></path>
                        <path d="M58.1679 22.1725H53.3147L61.4033 45.4197L66.7487 28.6817L63.9353 20.3842H75.822V22.1725H71.1799L78.9167 45.3482L86.2316 22.1725H81.5191V20.3842H91.788C91.788 20.6704 91.7646 20.9326 91.7177 21.1711C91.577 21.8387 91.0378 22.1725 90.1 22.1725C89.8656 22.1725 89.6311 22.1963 89.3967 22.244C88.6464 22.3871 88.0368 23.1501 87.5679 24.533L78.9167 51.2851H77.299C76.455 51.2851 75.7751 51.1659 75.2593 50.9275C74.5091 50.4983 73.665 48.9246 72.7272 46.2065L67.8038 31.7575L61.5439 51.2851H59.7152C58.965 51.2851 58.3554 51.1898 57.8865 50.999C56.9018 50.5698 55.9171 48.9723 54.9324 46.2065L46.3516 22.1725H43.3271V20.3842H58.1679V22.1725Z" fill="#8CAE6B" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec=""></path>
                        <path d="M18.7795 50.9275H0V49.0677H5.62681V9.86936H0V8.00958H18.7795V9.86936H13.1527V28.8963L33.6202 9.86936H27.9934V8.00958H40.7944C40.7944 8.24802 40.7709 8.48645 40.724 8.72488C40.6303 9.48787 40.0441 9.86936 38.9657 9.86936C38.5437 9.86936 38.1216 9.91704 37.6996 10.0124C36.9025 10.2509 35.5192 11.2523 33.5499 13.0167L21.8039 24.1038L39.669 49.0677H41.0757C41.3102 49.0677 41.5446 49.0915 41.7791 49.1392C42.5293 49.2823 42.9044 49.8784 42.9044 50.9275H31.6508L16.3178 29.2539L13.1527 32.1867V49.0677H16.9508C17.1852 49.0677 17.4197 49.0915 17.6541 49.1392C18.4044 49.2823 18.7795 49.8784 18.7795 50.9275Z" fill="#8CAE6B" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec=""></path>
                    </svg>
                </a>
                <button id="nav-toggle" class="inline-flex items-center justify-center p-2 text-slate-400 hover:text-black focus:outline-none focus:text-black xl:hidden" aria-label="Otwórz menu" aria-expanded="false" type="button" data-astro-cid-3ef6ksr2 data-astro-cid-dmqpwcec>
                    <svg class="w-6 h-6" stroke="#222" fill="none" style="transform: rotate(180deg);" viewBox="0 0 24 24" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec>
                        <path id="icon-menu" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h14M4 12h32M4 18h14" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec></path>
                        <path id="icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" data-astro-cid-3ef6ksr2="" data-astro-cid-dmqpwcec></path>
                    </svg>
                </button>
            </div>

            <div id="nav-overlay" class="hidden navigation-overlay" data-astro-cid-3ef6ksr2 data-astro-cid-dmqpwcec></div>

            <nav id="primary-nav" class="flex-col xl:items-center flex-grow hidden xl:pb-0 xl:flex xl:justify-end xl:flex-row xl:flex-nowrap gap-2 xl:gap-x-2" data-astro-cid-3ef6ksr2 data-astro-cid-dmqpwcec>
                <?php foreach ($menuItems as $item) : ?>
                    <a
                        data-astro-cid-3ef6ksr2
                        class="px-2 py-2 text-sm menu-link <?php echo pk_is_menu_item_active($item['url']) ? 'active' : ''; ?>"
                        href="<?php echo esc_url($item['url']); ?>"
                        data-astro-cid-dmqpwcec
                    >
                        <?php echo esc_html($item['title']); ?>
                        <span data-astro-cid-3ef6ksr2 data-astro-cid-dmqpwcec><?php echo esc_html($item['description']); ?></span>
                    </a>
                <?php endforeach; ?>
                <div class="lang-switch mt-2 xl:mt-0 xl:ml-2 flex-shrink-0" data-astro-cid-dmqpwcec>
                    <?php foreach ($languages as $language) : ?>
                        <a class="lang-pill <?php echo $language['current'] ? 'active' : ''; ?>" href="<?php echo esc_url($language['url']); ?>" data-astro-cid-dmqpwcec>
                            <span data-astro-cid-dmqpwcec><?php echo esc_html($language['code']); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </nav>
        </div>
    </div>
</div>
