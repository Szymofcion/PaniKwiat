<?php

declare(strict_types=1);

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', function (): void {
    if (!class_exists(Container::class) || !class_exists(Field::class)) {
        return;
    }

    Container::make('theme_options', __('Pani Kwiat', 'pani-kwiat'))
        ->set_page_file('pani-kwiat-settings')
        ->set_page_menu_title(__('Pani Kwiat', 'pani-kwiat'))
        ->set_icon('dashicons-admin-customizer')
        ->add_tab(__('Dane wspolne', 'pani-kwiat'), pk_carbon_global_option_fields())
        ->add_tab('PL', pk_carbon_option_fields_for_lang('pl', 'PL'))
        ->add_tab('EN', pk_carbon_option_fields_for_lang('en', 'EN'))
        ->add_tab('DE', pk_carbon_option_fields_for_lang('de', 'DE'));

    Container::make('post_meta', __('Strona glowna', 'pani-kwiat'))
        ->show_on_post_type('page')
        ->where('post_template', '=', 'default')
        ->add_tab(__('Start', 'pani-kwiat'), pk_carbon_home_hero_fields())
        ->add_tab(__('Oferta', 'pani-kwiat'), pk_carbon_home_offer_fields())
        ->add_tab(__('Marketplace', 'pani-kwiat'), pk_carbon_home_cta_fields())
        ->add_tab(__('O mnie', 'pani-kwiat'), pk_carbon_home_about_fields())
        ->add_tab(__('Opinie', 'pani-kwiat'), pk_carbon_home_opinion_fields());

    Container::make('post_meta', __('Cennik', 'pani-kwiat'))
        ->show_on_post_type('page')
        ->where('post_template', '=', 'template-pricing.php')
        ->add_tab(__('Tresc strony', 'pani-kwiat'), pk_carbon_pricing_fields());
});

function pk_carbon_global_option_fields(): array
{
    return [
        Field::make('text', 'pk_contact_phone', __('Telefon', 'pani-kwiat'))
            ->set_width(50)
            ->set_help_text(__('Numer widoczny w naglowku, stopce i oknie kontaktowym.', 'pani-kwiat')),
        Field::make('text', 'pk_contact_email', __('E-mail', 'pani-kwiat'))
            ->set_width(50)
            ->set_help_text(__('Adres do kontaktu i formularza zapasowego.', 'pani-kwiat')),
        Field::make('text', 'pk_marketplace_url', __('Link do Marketplace', 'pani-kwiat'))
            ->set_help_text(__('Przycisk "gotowe dekoracje" oraz sekcja CTA kieruja w to miejsce.', 'pani-kwiat')),
    ];
}

function pk_carbon_home_hero_fields(): array
{
    return [
        Field::make('textarea', 'pk_hero_heading', __('Naglowek glowny', 'pani-kwiat'))
            ->set_width(50),
        Field::make('textarea', 'pk_hero_paragraph', __('Krotki opis pod naglowkiem', 'pani-kwiat'))
            ->set_width(50),
        Field::make('text', 'pk_hero_contact_cta', __('Przycisk kontaktowy', 'pani-kwiat'))
            ->set_width(33),
        Field::make('text', 'pk_hero_ready_cta', __('Przycisk gotowych dekoracji', 'pani-kwiat'))
            ->set_width(33),
        Field::make('text', 'pk_hero_learn_more', __('Etykieta "dowiedz sie wiecej"', 'pani-kwiat'))
            ->set_width(33),
        Field::make('textarea', 'pk_hero_disclaimer', __('Tekst pod strzalka', 'pani-kwiat'))
            ->set_help_text(__('Krotkie dopowiedzenie wyswietlane pod sekcja startowa.', 'pani-kwiat')),
    ];
}

function pk_carbon_home_offer_fields(): array
{
    return [
        Field::make('text', 'pk_main_title', __('Tytul sekcji oferty', 'pani-kwiat'))
            ->set_width(50),
        Field::make('text', 'pk_view_photos_label', __('Przycisk "zobacz zdjecia"', 'pani-kwiat'))
            ->set_width(50),
        pk_carbon_offer_sections_field(),
    ];
}

function pk_carbon_home_cta_fields(): array
{
    return [
        Field::make('text', 'pk_cta_heading', __('Naglowek sekcji', 'pani-kwiat'))
            ->set_width(50),
        Field::make('text', 'pk_cta_subheading', __('Podtytul sekcji', 'pani-kwiat'))
            ->set_width(50),
        Field::make('text', 'pk_cta_button', __('Tekst przycisku', 'pani-kwiat'))
            ->set_help_text(__('Przycisk prowadzi do linku Marketplace z ustawien motywu.', 'pani-kwiat')),
    ];
}

function pk_carbon_home_about_fields(): array
{
    return [
        Field::make('text', 'pk_about_title', __('Tytul sekcji', 'pani-kwiat'))
            ->set_width(50),
        Field::make('text', 'pk_about_heading', __('Naglowek obok zdjecia', 'pani-kwiat'))
            ->set_width(50),
        Field::make('image', 'pk_about_image', __('Zdjecie sekcji', 'pani-kwiat'))
            ->set_width(40),
        Field::make('text', 'pk_about_contact_cta', __('Tekst przycisku kontaktowego', 'pani-kwiat'))
            ->set_width(60),
        Field::make('complex', 'pk_about_paragraphs', __('Akapity opisu', 'pani-kwiat'))
            ->setup_labels([
                'plural_name' => __('Akapity', 'pani-kwiat'),
                'singular_name' => __('Akapit', 'pani-kwiat'),
            ])
            ->set_layout('tabbed-vertical')
            ->set_collapsed(true)
            ->add_fields([
                Field::make('textarea', 'text', __('Tresc akapitu', 'pani-kwiat')),
            ])
            ->set_header_template('<% if (text) { %><%- text %><% } else { %>Akapit<% } %>'),
    ];
}

function pk_carbon_home_opinion_fields(): array
{
    return [
        Field::make('text', 'pk_opinion_heading', __('Naglowek sekcji', 'pani-kwiat'))
            ->set_width(50),
        Field::make('complex', 'pk_opinion_items', __('Opinie klientow', 'pani-kwiat'))
            ->setup_labels([
                'plural_name' => __('Opinie', 'pani-kwiat'),
                'singular_name' => __('Opinia', 'pani-kwiat'),
            ])
            ->set_layout('tabbed-vertical')
            ->set_collapsed(true)
            ->add_fields([
                Field::make('text', 'author', __('Autor', 'pani-kwiat'))
                    ->set_width(35),
                Field::make('textarea', 'text', __('Tresc opinii', 'pani-kwiat'))
                    ->set_width(65),
            ])
            ->set_header_template('<% if (author) { %><%- author %><% } else { %>Opinia klienta<% } %>')
            ->set_help_text(__('Kolejnosc opinii odpowiada kolejnosci na stronie.', 'pani-kwiat')),
    ];
}

function pk_carbon_pricing_fields(): array
{
    return [
        Field::make('text', 'pk_pricing_heading', __('Naglowek strony', 'pani-kwiat'))
            ->set_width(50),
        Field::make('textarea', 'pk_pricing_intro', __('Wstep', 'pani-kwiat'))
            ->set_width(50),
        Field::make('text', 'pk_pricing_cta_heading', __('Naglowek sekcji CTA', 'pani-kwiat'))
            ->set_width(50),
        Field::make('text', 'pk_pricing_cta_subheading', __('Podtytul sekcji CTA', 'pani-kwiat'))
            ->set_width(50),
        Field::make('text', 'pk_pricing_cta_button', __('Tekst przycisku', 'pani-kwiat'))
            ->set_help_text(__('Przycisk prowadzi do linku Marketplace z ustawien motywu.', 'pani-kwiat')),
    ];
}

function pk_carbon_option_fields_for_lang(string $lang, string $label): array
{
    return [
        Field::make('text', 'pk_header_question_' . $lang, sprintf(__('[%s] Tekst "Masz pytanie?"', 'pani-kwiat'), $label))
            ->set_width(50),
        Field::make('text', 'pk_header_contact_' . $lang, sprintf(__('[%s] Tekst przy telefonie', 'pani-kwiat'), $label))
            ->set_width(50),
        Field::make('text', 'pk_footer_help_' . $lang, sprintf(__('[%s] Naglowek stopki', 'pani-kwiat'), $label))
            ->set_width(50),
        Field::make('textarea', 'pk_footer_copyright_' . $lang, sprintf(__('[%s] Stopka copyright', 'pani-kwiat'), $label))
            ->set_width(50),
        Field::make('textarea', 'pk_form_phone_heading_' . $lang, sprintf(__('[%s] Naglowek telefonu w oknie kontaktu', 'pani-kwiat'), $label))
            ->set_width(50),
        Field::make('text', 'pk_form_heading_' . $lang, sprintf(__('[%s] Naglowek formularza', 'pani-kwiat'), $label))
            ->set_width(50),
        Field::make('text', 'pk_form_shortcode_' . $lang, sprintf(__('[%s] Shortcode formularza', 'pani-kwiat'), $label))
            ->set_help_text(__('Jesli pole jest puste, motyw uzyje prostego formularza zapasowego.', 'pani-kwiat')),
    ];
}

function pk_carbon_offer_sections_field()
{
    return Field::make('complex', 'pk_offer_sections', __('Sekcje oferty', 'pani-kwiat'))
        ->setup_labels([
            'plural_name' => __('Sekcje oferty', 'pani-kwiat'),
            'singular_name' => __('Sekcja oferty', 'pani-kwiat'),
        ])
        ->set_layout('tabbed-vertical')
        ->set_collapsed(true)
        ->add_fields([
            Field::make('text', 'numeral', __('Numer rzymski', 'pani-kwiat'))
                ->set_width(20),
            Field::make('text', 'heading', __('Naglowek sekcji', 'pani-kwiat'))
                ->set_width(80),
            Field::make('textarea', 'body', __('Opis sekcji', 'pani-kwiat')),
            Field::make('text', 'price_note', __('Dodatkowa informacja o cenie', 'pani-kwiat'))
                ->set_help_text(__('Pole opcjonalne. Mozna zostawic puste.', 'pani-kwiat')),
            Field::make('image', 'main_image', __('Glowne zdjecie sekcji', 'pani-kwiat'))
                ->set_width(40),
            Field::make('complex', 'main_gallery', __('Galeria glowna', 'pani-kwiat'))
                ->setup_labels([
                    'plural_name' => __('Zdjecia', 'pani-kwiat'),
                    'singular_name' => __('Zdjecie', 'pani-kwiat'),
                ])
                ->set_layout('tabbed-horizontal')
                ->set_collapsed(true)
                ->set_width(60)
                ->add_fields([
                    Field::make('image', 'image', __('Zdjecie', 'pani-kwiat')),
                ])
                ->set_header_template(__('Zdjecie', 'pani-kwiat')),
            Field::make('complex', 'list', __('Lista punktow', 'pani-kwiat'))
                ->setup_labels([
                    'plural_name' => __('Punkty listy', 'pani-kwiat'),
                    'singular_name' => __('Punkt listy', 'pani-kwiat'),
                ])
                ->set_layout('tabbed-vertical')
                ->set_collapsed(true)
                ->add_fields([
                    Field::make('text', 'text', __('Tresc punktu', 'pani-kwiat')),
                ])
                ->set_header_template('<% if (text) { %><%- text %><% } else { %>Punkt listy<% } %>'),
            Field::make('complex', 'cards', __('Karty pod sekcja', 'pani-kwiat'))
                ->setup_labels([
                    'plural_name' => __('Karty', 'pani-kwiat'),
                    'singular_name' => __('Karta', 'pani-kwiat'),
                ])
                ->set_layout('tabbed-vertical')
                ->set_collapsed(true)
                ->add_fields([
                    Field::make('text', 'title', __('Tytul karty', 'pani-kwiat'))
                        ->set_width(60),
                    Field::make('image', 'cover_image', __('Zdjecie karty', 'pani-kwiat'))
                        ->set_width(40),
                    Field::make('complex', 'gallery', __('Galeria karty', 'pani-kwiat'))
                        ->setup_labels([
                            'plural_name' => __('Zdjecia', 'pani-kwiat'),
                            'singular_name' => __('Zdjecie', 'pani-kwiat'),
                        ])
                        ->set_layout('tabbed-horizontal')
                        ->set_collapsed(true)
                        ->add_fields([
                            Field::make('image', 'image', __('Zdjecie', 'pani-kwiat')),
                        ])
                        ->set_header_template(__('Zdjecie', 'pani-kwiat')),
                ])
                ->set_header_template('<% if (title) { %><%- title %><% } else { %>Karta oferty<% } %>'),
        ])
        ->set_header_template('<% if (numeral) { %><%- numeral %> <% } %><% if (heading) { %><%- heading %><% } else { %>Sekcja oferty<% } %>')
        ->set_help_text(__('Kazda sekcja odpowiada jednemu blokowi oferty na stronie glownej.', 'pani-kwiat'));
}
