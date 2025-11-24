import { normalizeLang, type Lang } from "./lang";

export type SiteLang = Lang;

export const siteCopy: Record<SiteLang, {
    meta: { title: string; description: string };
    nav: { links: { href: string; label: string; sub: string }[]; ariaOpen: string; ariaClose: string };
    header: { question: string; contact: string };
    hero: {
        heading: string;
        paragraph: string;
        contactCta: string;
        readyCta: string;
        learnMore: string;
        disclaimer: string;
    };
    contactForm: {
        phoneHeading: string;
        phoneCta: string;
        formHeading: string;
        nameLabel: string;
        phoneLabel: string;
        emailLabel: string;
        messageLabel: string;
        namePlaceholder: string;
        phonePlaceholder: string;
        emailPlaceholder: string;
        messagePlaceholder: string;
        consent: string;
        submit: string;
    };
    cta: { heading: string; subheading: string; button: string };
    about: { title: string; heading: string; paragraphs: string[]; contactCta: string };
    main: {
        title: string;
        viewPhotos: string;
        sections: [
            {
                numeral: string;
                heading: string;
                body: string;
                cards: [string, string, string, string];
            },
            {
                numeral: string;
                heading: string;
                body: string;
                priceNote: string;
            },
            {
                numeral: string;
                heading: string;
                body: string;
                priceNote: string;
                cards: [string, string, string];
            },
            {
                numeral: string;
                heading: string;
                body: string;
                list: string[];
            }
        ];
        christmas: { heading: string; body: string };
    };
    opinion: { heading: string; items: { author: string; text: string }[] };
    footer: { help: string; copyright: string };
}> = {
    pl: {
        meta: {
            title: "Pani Kwiat – odkryj piękno i energię drzemiące w kwiatach",
            description:
                "Kwiaty przeobrażają w pachnący ogród każde miejsce swoją obecnością, kolorem, zapachem i formą wyczarowaną ręką artysty.",
        },
        nav: {
            ariaOpen: "Otwórz menu",
            ariaClose: "Zamknij menu",
            links: [
                { href: "/#skomponuj", label: "Skomponuj dekorację", sub: "Daj się ponieść fantazji" },
                { href: "/#dekoracje", label: "Gotowe od ręki", sub: "gotowe produkty" },
                { href: "/cennik", label: "Cennik", sub: "sprawdź ceny" },
                { href: "/#kimjestem", label: "Kim jestem?", sub: "poznajmy się" },
                { href: "/#opinie", label: "Poznaj opinie", sub: "Mówią o mnie..." },
                { href: "/#footer", label: "Kontakt", sub: "porozmawiajmy" },
            ],
        },
        header: { question: "Masz pytanie?", contact: "Skontaktuj się ze mną" },
        hero: {
            heading: "Odkryj piękno i energię,\ndrzemiące w kwiatach",
            paragraph:
                "Kwiaty przeobrażają w pachnący ogród każde miejsce swoja obecnością, kolorem, zapachem i formą wyczarowaną ręką artysty.",
            contactCta: "Skontaktuj się ze mną",
            readyCta: "sprawdź gotowe produkty",
            learnMore: "Dowiedz się więcej",
            disclaimer:
                "Kwiaty wyrażają nasze uczucia, miłość, przywiązanie, pamięć. Ich piękno ozdobi każde miejsce, w którym przebywamy, nasze domy, biura, są dopełnieniem uroczystości rodzinnych, koncertów, ślubów i ostatnich pożegnań. Kwiaty zdobią hotele, witryny sklepowe, stoły, gdzie pośród porcelany i srebra cieszą nasze oczy i pieszczą nasze zmysły.",
        },
        contactForm: {
            phoneHeading: "Skontaktuj się ze mną\ntelefonicznie",
            phoneCta: "501 744 994",
            formHeading: "Lub przez formularz kontaktowy",
            nameLabel: "Wprowadź imię: *",
            phoneLabel: "Wprowadź numer telefonu: *",
            emailLabel: "Wprowadź adres e-mail: *",
            messageLabel: "Wiadomość: *",
            namePlaceholder: "Wprowadź imię...",
            phonePlaceholder: "Wprowadź numer telefonu...",
            emailPlaceholder: "Wprowadź adres e-mail...",
            messagePlaceholder: "Napisz wiadomość...",
            consent:
                "Wyrażam zgodę na przetwarzanie moich danych osobowych w celu realizacji tego zapytania.*",
            submit: "Wyślij wiadomość",
        },
        cta: {
            heading: "Szukasz dekoracji na już?",
            subheading: "zobacz kompozycje, które możesz kupić jeszcze dziś!",
            button: "przeglądaj gotowe produkty",
        },
        about: {
            title: "Pani Kwiat - Idealne dekoracje kwiatowe na każdą okazję",
            heading: "Kim jestem?",
            paragraphs: [
                "Swoją przygodę z kwiatami rozpoczęłam w Londynie w 1994 roku. Ukończyłam tam prywatną szkołę układania kwiatów Jane Packer. W niej poznałam wszystkie tajniki technik florystycznych jak również tworzenia kompozycji. Po kilku latach pracy w tamtejszej kwiaciarni, wróciłam do Polski, gdzie od wielu lat prowadzę swoją firmę florystyczną. Moim klientami, była TV, salony samochodowe miedzy innymi Team z Długołeki, Pizza Hut, Starbucks, festiwal Chopinowski w Dusznikach, przegląd Piosenki Aktorskiej. Przez wiele lat byłam dekoratorem kościoła na Popowicach.",
                "Ostatnich kilka lat spędziłam w Brisbane ( Australia), gdzie pośród 12 florystów z różnych stron świata rozwijałam swoje umiejętości i uczyłam się florystyki, nie tylko europejskiej, ale także miałam okazje poznać trendy ogólnoświatowe poprzez różnorodność narodową naszego zespołu. Jestem w Polsce. Zapraszam Państwa do odwieszenia mojej strony internetowej i kontaktu ze mną.",
            ],
            contactCta: "Skontaktuj się ze mną",
        },
        main: {
            title: "Skomponuj idealną dekorację na dowolną okazję",
            viewPhotos: "Zobacz zdjęcia",
            sections: [
                {
                    numeral: "I",
                    heading: "Dekoracje ślubne",
                    body: "Wielkim wydarzeniem w naszym życiu jest uroczystość zaślubin. Niewątpliwie kwiaty są jej nieodzownym atrybutem. Zachęcam do stworzenia niepowtarzalnej oprawy kwiatowej przygotowanej specjalnie dla Państwa. Nie tylko pod względem doboru kolorów, ale również dostosowanej do charakteru, temperamentu i urody Państwa Młodych. Dla Niej skomponowana wiązanka ślubna, dla Niego butonierka. Będzie ona spójna z wystrojem sali, kościoła, samochodu i tortu. Dla druhen i dziewczynek wianki, małe wiązanki i przypinki do włosów.",
                    cards: [
                        "Bukiety ślubne",
                        "Wystrój sal i kościołów",
                        "Wianki i tiary z żywych kwiatów",
                        "Ozdobne wianki dla ukochanych zwierząt",
                    ],
                },
                {
                    numeral: "II",
                    heading: "Ringi, wieńce, serca",
                    body: "Wianki na każda okazję, urodziny, ozdobny wianek na drzwi, lub jako dekoracje stołu ze świecą. Zrobimy je dla Ciebie z żywych, suchych i sztucznych kwiatów. Będzie on przepiękną ozdobą w witrynach sklepowych. Możemy położyć go na trumnie w ostatnim pożegnaniu.",
                    priceNote: "Cena od 250 zł. w zależności od wielkości i użytych kwiatów.",
                },
                {
                    numeral: "III",
                    heading: "Wiązanki pogrzebowe",
                    body: "Każdy z nas na swojej życiowej drodze staje przed trumną osoby, która odeszła z tego świata. W hołdzie i pamięci naszym Ukochanym mamy ofertę, w której można stworzyć lub wybrać z bogatej kolekcji kompozycje, które będą odzwierciedleniem lub uhonorowaniem życia osoby zmarłej.",
                    priceNote:
                        "Zrobione z żywych lub sztucznych kwiatów, w zależności od życzeń klienta i pory roku. Cena w zależności od rodzaju i wielkości kompozycji aranżacje na trumnę od 500 zł.",
                    cards: ["Wiązanki pogrzebowe", "Serca kwiatowe", "Aranżacje na trumnę"],
                },
                {
                    numeral: "IV",
                    heading: "Pozostałe dekoracje",
                    body: "Zapraszamy do zapoznania się z naszą ofertą, która obejmuje resztę produktów. W niej pudełka kwiatowe na każda okazję, w każdej wielkości i kolorystyce, na ceremonie chrztu, w rocznice urodzin, na imieniny, czy z gratulacjami. Mamy również bukiety na każdą okazję z żywych i suchych kwiatów. Proponujemy aranżacje w wazach i innych ozdobnych pojemnikach. Mogą to być małe wiązanki lub tez ogromne bukiety sceniczne, kościelne, na eventy, promocje w salonach samochodowych i w salach konferencyjnych. Mamy również kosze upominkowe.",
                    list: [
                        "Bukiety ślubne",
                        "Pudełka kwiatowe, walizki itp.",
                        "Wazy, wazoniki i inne pojemniki",
                        "Dekoracje sal, salonów samochodowych",
                        "Dekoracje promocyjne w salonach samochodowych",
                        "Kancelarie prawne",
                        "Restauracje",
                    ],
                },
            ],
            christmas: {
                heading: "Święta Bożego Narodzenia",
                body: "Zbliżają się Święta Bożego Narodzenia. Już za parę chwil będziemy wypatrywać pierwszej gwiazdki i płatków śniegu. Zasiądziemy do stołu w gronie Bliskich nam osób, radując się ich obecnością. Dopełnieniem tego niezwykłego czasu są wszelkiego rodzaju ozdoby świąteczne. Choinki, stroiki, wieńce i anioły. Zapraszam do kontaktu ze mną. Na Twoje życzenie powstanie dekoracja, która będzie podkreślała ten niezwykły świąteczny nastrój. Pomagamy również ubierać choinki.",
            },
        },
        opinion: {
            heading: "Co mówią o mnie moi Klienci?",
            items: [
                {
                    author: "Magda P.",
                    text: "Znakomita jakość i niezwykła kreatywność! Pani Joanna to mistrzyni florystyki, która potrafi zachwycić każdego. Jej bukiety są idealne na każdą okoliczność, a obsługa klienta jest na najwyższym poziomie. Jeśli szukasz wyjątkowych kwiatów, to jest to miejsce, którego potrzebujesz! Pani Joanna posiada nie tylko niesamowity talent, ale także ogromną wiedzę o kwiatach. Każdy bukiet jest dopracowany w najdrobniejszych szczegółach, a jej podejście do klienta jest ciepłe i profesjonalne. Dodatkowo, sklep oferuje szeroką gamę kwiatów, od klasycznych róż po egzotyczne gatunki, co pozwala na stworzenie naprawdę unikalnych i osobistych aranżacji. Gorąco polecam!",
                },
                {
                    author: "Katarzyna M.",
                    text: "Pani Joanna tworzy magiczne kompozycje, które przekraczają wszelkie oczekiwania. Każdy bukiet jest unikatowy i wykonany z niezwykłą starannością. Jej kwiaty dodają splendoru każdej uroczystości. Absolutnie polecam! Pani Joanna z pasją opowiada o każdym kwiecie, pomagając stworzyć idealną kompozycję. Obsługa jest zawsze uprzejma i pomocna, a atmosfera sklepu sprawia, że chce się wracać. Niezależnie od okazji, czy to ślub, rocznica, czy po prostu chęć sprawienia radości bliskim, kwiaty od Pani Joanny zawsze są strzałem w dziesiątkę.",
                },
                {
                    author: "Robert L.",
                    text: "Zamówienia od Pani Joanny zawsze realizowane są z niezwykłą starannością – kwiaty są zawsze świeże, pięknie ułożone i starannie zapakowane. Gorąco polecam wszystkim, którzy cenią sobie wygodę, jakość i piękno!",
                },
                {
                    author: "Aleksandra P.",
                    text: "Bukiet, który zamówiłem, przekroczył moje oczekiwania – kwiaty były świeże, pięknie ułożone i pachnące. Szybka dostawa i profesjonalne podejście do klienta sprawiają, że na pewno jeszcze nie raz skorzystam z usług tego sklepu. Polecam każdemu, kto szuka wyjątkowych kwiatów z dostawą prosto pod drzwi!",
                },
                {
                    author: "Julia T.",
                    text: "Wspaniałe doświadczenie zakupowe! Sklep online Pani Joanny oferuje nie tylko przepiękne bukiety i wiązanki, ale również znakomitą obsługę klienta. Proces zamawiania jest bardzo prosty, a możliwość personalizacji bukietów online to wielki plus. Kwiaty przybyły dokładnie na czas, pięknie zapakowane i w nienagannym stanie. To była moja pierwsza, ale na pewno nie ostatnia wizyta w tym sklepie!",
                },
            ],
        },
        footer: {
            help: "Potrzebujesz pomocy w doborze kwiatów? zadzwoń!",
            copyright:
                "Copyright © Pani Kwiat - Realizacja strony internetowej: Manufaktura Programowania & Studio Projektowe Bonsai Design",
        },
    },
    en: {
        meta: {
            title: "Pani Kwiat – discover the beauty and energy hidden in flowers",
            description:
                "Flowers transform any place into a fragrant garden with their presence, colour, scent and the form crafted by an artist.",
        },
        nav: {
            ariaOpen: "Open menu",
            ariaClose: "Close menu",
            links: [
                { href: "/#skomponuj", label: "Compose a decoration", sub: "Let your imagination flow" },
                { href: "/#dekoracje", label: "Ready to buy", sub: "ready-made products" },
                { href: "/cennik", label: "Pricing", sub: "check prices" },
                { href: "/#kimjestem", label: "Who am I?", sub: "let's meet" },
                { href: "/#opinie", label: "Read reviews", sub: "What clients say" },
                { href: "/#footer", label: "Contact", sub: "let's talk" },
            ],
        },
        header: { question: "Any questions?", contact: "Contact me" },
        hero: {
            heading: "Discover the beauty and energy\nwithin flowers",
            paragraph:
                "Flowers turn any place into a fragrant garden with their presence, colours, scent and the forms shaped by an artist's hand.",
            contactCta: "Contact me",
            readyCta: "see ready products",
            learnMore: "Learn more",
            disclaimer:
                "Flowers express our feelings, love, attachment and remembrance. Their beauty adorns every place we stay—our homes and offices—and accompanies family celebrations, concerts, weddings and farewells. Flowers decorate hotels, shop windows and tables, where among porcelain and silver they delight our eyes and senses.",
        },
        contactForm: {
            phoneHeading: "Contact me by phone",
            phoneCta: "+48 501 744 994",
            formHeading: "Or via contact form",
            nameLabel: "Enter your name: *",
            phoneLabel: "Enter your phone number: *",
            emailLabel: "Enter your email address: *",
            messageLabel: "Message: *",
            namePlaceholder: "Type your name...",
            phonePlaceholder: "Type your phone number...",
            emailPlaceholder: "Type your email...",
            messagePlaceholder: "Write your message...",
            consent: "I agree to the processing of my data for the purpose of this enquiry.*",
            submit: "Send message",
        },
        cta: {
            heading: "Looking for decorations right now?",
            subheading: "see the arrangements you can buy today!",
            button: "browse ready products",
        },
        about: {
            title: "Pani Kwiat - Perfect floral decorations for every occasion",
            heading: "Who am I?",
            paragraphs: [
                "I began my flower journey in London in 1994, graduating from the private Jane Packer flower school. There I learned the full range of floristry techniques and composition. After several years working in a London florist, I returned to Poland and have been running my own studio for many years. My clients have included TV, car showrooms such as Team in Długołęka, Pizza Hut, Starbucks, the Chopin Festival in Duszniki, and the Acting Song Review. For many years I decorated a church in Popowice.",
                "I spent the last few years in Brisbane (Australia), where, among 12 florists from around the world, I honed my skills and learned floristry beyond Europe, discovering global trends thanks to our diverse team. I'm back in Poland—please visit my website and get in touch.",
            ],
            contactCta: "Contact me",
        },
        main: {
            title: "Compose the perfect decoration for any occasion",
            viewPhotos: "See photos",
            sections: [
                {
                    numeral: "I",
                    heading: "Wedding decorations",
                    body: "A wedding is one of life's great events, and flowers are its essential element. I encourage you to create a one-of-a-kind floral setting prepared just for you—matched to your colours, but also to the character, temperament, and style of the couple. For her, a tailored bridal bouquet; for him, a boutonniere. Everything stays cohesive with the hall, church, car, and cake décor. For bridesmaids and flower girls: wreaths, small bouquets, and hair pins.",
                    cards: [
                        "Wedding bouquets",
                        "Decor for venues and churches",
                        "Crowns and tiaras from fresh flowers",
                        "Decorative wreaths for beloved pets",
                    ],
                },
                {
                    numeral: "II",
                    heading: "Hoops, wreaths, hearts",
                    body: "Wreaths for any occasion—birthdays, a door accent, or a table piece with a candle. We craft them from fresh, dried, or faux flowers. They beautifully dress shop windows and can be placed on a coffin for a final farewell.",
                    priceNote: "Price from 250 PLN, depending on size and flowers used.",
                },
                {
                    numeral: "III",
                    heading: "Funeral arrangements",
                    body: "We all eventually stand by a loved one's coffin. To honour their memory, I offer a wide collection or bespoke pieces that reflect and celebrate the life of the departed.",
                    priceNote:
                        "Made with fresh or artificial flowers, depending on your wishes and season. Pricing depends on type and size; coffin arrangements start at 500 PLN.",
                    cards: ["Funeral sprays", "Floral hearts", "Coffin arrangements"],
                },
                {
                    numeral: "IV",
                    heading: "Other decorations",
                    body: "Discover the rest of the collection: flower boxes for any occasion, in every size and colour palette—for christenings, birthdays, name days or congratulations. Bouquets for all occasions from fresh and dried flowers. Arrangements in vases and decorative vessels—small posies or large stage, church and event bouquets, showrooms and conference setups. Gift hampers are also available.",
                    list: [
                        "Bridal bouquets",
                        "Flower boxes, cases and more",
                        "Vases and decorative vessels",
                        "Venue and car showroom décor",
                        "Promotional décor in showrooms",
                        "Law firms",
                        "Restaurants",
                    ],
                },
            ],
            christmas: {
                heading: "Christmas season",
                body: "Christmas is coming soon. We'll be watching for the first star and snowflakes, sitting at the table with loved ones. Decorations complete this special time: trees, centerpieces, wreaths and angels. Get in touch and I will prepare décor that highlights the festive mood. I also help decorate Christmas trees.",
            },
        },
        opinion: {
            heading: "What do my clients say?",
            items: [
                {
                    author: "Magda P.",
                    text: "Outstanding quality and incredible creativity! Joanna is a master florist who impresses everyone. Her bouquets fit any occasion and customer service is top-notch. If you're looking for exceptional flowers, this is the place. Joanna combines talent with deep knowledge—every bouquet is perfected in detail, and her approach is warm and professional. With a wide range from classic roses to exotic blooms, you can create truly unique arrangements. Highly recommended!",
                },
                {
                    author: "Katarzyna M.",
                    text: "Joanna creates magical compositions that exceed expectations. Each bouquet is unique and crafted with great care, adding splendour to every event. Absolutely recommended! Joanna passionately explains every flower, helping you build the perfect arrangement. Service is always friendly, and the shop's atmosphere makes you want to return. For weddings, anniversaries, or just to delight someone—her flowers are always a hit.",
                },
                {
                    author: "Robert L.",
                    text: "Orders from Joanna are always handled with great care—flowers are fresh, beautifully arranged, and carefully packed. Highly recommended for anyone who values convenience, quality, and beauty!",
                },
                {
                    author: "Aleksandra P.",
                    text: "The bouquet I ordered exceeded expectations—fresh, beautifully arranged, and fragrant. Fast delivery and professional service mean I'll be back. Recommended to anyone seeking exceptional flowers delivered to the door!",
                },
                {
                    author: "Julia T.",
                    text: "A wonderful shopping experience! Joanna's online shop offers not only stunning bouquets and arrangements, but also great customer service. Ordering is simple, and the ability to personalise bouquets online is a big plus. The flowers arrived on time, beautifully packed and pristine. It was my first visit, but certainly not the last!",
                },
            ],
        },
        footer: {
            help: "Need help choosing flowers? Call!",
            copyright:
                "Copyright © Pani Kwiat - Website by Manufaktura Programowania & Studio Projektowe Bonsai Design",
        },
    },
    de: {
        meta: {
            title: "Pani Kwiat – entdecke die Schönheit und Energie der Blumen",
            description:
                "Blumen verwandeln jeden Ort in einen duftenden Garten – mit ihrer Präsenz, Farbe, ihrem Duft und der Form, die die Hand eines Künstlers zaubert.",
        },
        nav: {
            ariaOpen: "Menü öffnen",
            ariaClose: "Menü schließen",
            links: [
                { href: "/#skomponuj", label: "Dekoration zusammenstellen", sub: "der Fantasie freien Lauf lassen" },
                { href: "/#dekoracje", label: "Sofort verfügbar", sub: "fertige Produkte" },
                { href: "/cennik", label: "Preisliste", sub: "Preise prüfen" },
                { href: "/#kimjestem", label: "Wer bin ich?", sub: "lernen wir uns kennen" },
                { href: "/#opinie", label: "Meinungen", sub: "Was man über mich sagt" },
                { href: "/#footer", label: "Kontakt", sub: "lass uns sprechen" },
            ],
        },
        header: { question: "Hast du eine Frage?", contact: "Kontaktiere mich" },
        hero: {
            heading: "Entdecke die Schönheit und Energie\nin Blumen",
            paragraph:
                "Blumen verwandeln jeden Ort in einen duftenden Garten – durch ihre Präsenz, Farbe, ihren Duft und die Formen, die die Hand eines Künstlers schafft.",
            contactCta: "Kontaktiere mich",
            readyCta: "fertige Produkte ansehen",
            learnMore: "Mehr erfahren",
            disclaimer:
                "Blumen drücken unsere Gefühle, Liebe, Verbundenheit und Erinnerung aus. Ihre Schönheit schmückt jeden Ort, an dem wir sind – unsere Häuser und Büros – und begleitet Familienfeiern, Konzerte, Hochzeiten und Abschiede. Blumen dekorieren Hotels, Schaufenster und Tische; zwischen Porzellan und Silber erfreuen sie Augen und Sinne.",
        },
        contactForm: {
            phoneHeading: "Kontaktiere mich telefonisch",
            phoneCta: "+48 501 744 994",
            formHeading: "Oder über das Kontaktformular",
            nameLabel: "Name eingeben: *",
            phoneLabel: "Telefonnummer eingeben: *",
            emailLabel: "E-Mail-Adresse eingeben: *",
            messageLabel: "Nachricht: *",
            namePlaceholder: "Name eingeben...",
            phonePlaceholder: "Telefonnummer eingeben...",
            emailPlaceholder: "E-Mail eingeben...",
            messagePlaceholder: "Nachricht schreiben...",
            consent:
                "Ich stimme der Verarbeitung meiner personenbezogenen Daten zum Zweck dieser Anfrage zu.*",
            submit: "Nachricht senden",
        },
        cta: {
            heading: "Du brauchst sofort Dekorationen?",
            subheading: "sieh dir Kompositionen an, die du heute kaufen kannst!",
            button: "fertige Produkte ansehen",
        },
        about: {
            title: "Pani Kwiat - Perfekte Blumendekorationen für jeden Anlass",
            heading: "Wer bin ich?",
            paragraphs: [
                "Meine Reise mit Blumen begann 1994 in London, wo ich die private Floristikschule von Jane Packer absolvierte. Dort lernte ich alle Techniken und Kompositionsregeln. Nach einigen Jahren Arbeit in einem Londoner Blumenladen kehrte ich nach Polen zurück und führe seit vielen Jahren mein eigenes Studio. Zu meinen Kunden gehörten TV, Autohäuser wie Team in Długołęka, Pizza Hut, Starbucks, das Chopin-Festival in Duszniki und das Schauspielerlied-Festival. Viele Jahre lang dekorierte ich eine Kirche in Popowice.",
                "Die letzten Jahre verbrachte ich in Brisbane (Australien), wo ich unter 12 Floristen aus aller Welt meine Fähigkeiten weiterentwickelte und neben der europäischen auch internationale Trends kennenlernte. Jetzt bin ich zurück in Polen – besuchen Sie meine Website und nehmen Sie Kontakt auf.",
            ],
            contactCta: "Kontaktiere mich",
        },
        main: {
            title: "Stelle die perfekte Dekoration für jeden Anlass zusammen",
            viewPhotos: "Fotos ansehen",
            sections: [
                {
                    numeral: "I",
                    heading: "Hochzeitsdekorationen",
                    body: "Die Trauung ist ein großes Ereignis, und Blumen sind ihr unverzichtbares Attribut. Ich lade ein, ein einzigartiges Blumenarrangement zu gestalten, das nur für euch vorbereitet ist – nicht nur farblich, sondern auch abgestimmt auf Charakter, Temperament und Stil des Paares. Für sie ein individuell komponierter Brautstrauß, für ihn eine Boutonniere. Alles bleibt stimmig mit dem Dekor der Halle, Kirche, des Autos und der Torte. Für Brautjungfern und Blumenmädchen: Kränze, kleine Sträuße und Haarnadeln.",
                    cards: [
                        "Brautsträuße",
                        "Dekor von Sälen und Kirchen",
                        "Kränze und Tiaras aus frischen Blumen",
                        "Dekorative Kränze für geliebte Tiere",
                    ],
                },
                {
                    numeral: "II",
                    heading: "Ringe, Kränze, Herzen",
                    body: "Kränze für jeden Anlass – Geburtstage, als Türschmuck oder Tischdekoration mit Kerze. Wir fertigen sie aus frischen, getrockneten oder künstlichen Blumen. Sie sind ein wunderschöner Akzent in Schaufenstern und können beim letzten Abschied auf den Sarg gelegt werden.",
                    priceNote: "Preis ab 250 PLN, je nach Größe und verwendeten Blumen.",
                },
                {
                    numeral: "III",
                    heading: "Trauergebinde",
                    body: "Wir alle stehen irgendwann vor dem Sarg eines geliebten Menschen. Zu Ehren und im Andenken bieten wir eine breite Kollektion oder maßgeschneiderte Kompositionen, die das Leben der Verstorbenen widerspiegeln.",
                    priceNote:
                        "Gefertigt aus frischen oder künstlichen Blumen – je nach Wunsch und Jahreszeit. Preis abhängig von Art und Größe, Arrangements für den Sarg ab 500 PLN.",
                    cards: ["Trauersträuße", "Blumenherzen", "Arrangements für den Sarg"],
                },
                {
                    numeral: "IV",
                    heading: "Weitere Dekorationen",
                    body: "Entdecke unser weiteres Angebot: Blumenboxen für jeden Anlass, in jeder Größe und Farbwelt – für Taufen, Geburtstage, Namenstage oder Glückwünsche. Sträuße aus frischen und getrockneten Blumen. Arrangements in Vasen und dekorativen Gefäßen. Das können kleine Sträuße oder große Bühnen- und Kirchenbouquets sein, Event- und Showroom-Dekor, Setups für Konferenzen. Es gibt auch Geschenkkörbe.",
                    list: [
                        "Brautsträuße",
                        "Blumenboxen, Koffer usw.",
                        "Vasen und dekorative Gefäße",
                        "Dekor von Sälen und Autohäusern",
                        "Promotion-Dekor in Autohäusern",
                        "Anwaltskanzleien",
                        "Restaurants",
                    ],
                },
            ],
            christmas: {
                heading: "Weihnachtszeit",
                body: "Weihnachten steht vor der Tür. Bald schauen wir nach dem ersten Stern und Schneeflocken, sitzen mit unseren Liebsten am Tisch. Festliche Dekorationen runden diese Zeit ab: Bäume, Gestecke, Kränze und Engel. Melde dich – ich gestalte auf Wunsch eine Dekoration, die die besondere Weihnachtsstimmung betont. Ich helfe auch beim Schmücken von Tannenbäumen.",
            },
        },
        opinion: {
            heading: "Was sagen meine Kunden?",
            items: [
                {
                    author: "Magda P.",
                    text: "Hervorragende Qualität und enorme Kreativität! Joanna ist eine Meisterin der Floristik, die jeden begeistert. Ihre Sträuße passen zu jedem Anlass, und der Service ist erstklassig. Wer besondere Blumen sucht, ist hier richtig. Joanna verbindet Talent mit großem Wissen – jedes Bouquet ist bis ins Detail ausgearbeitet, ihre Art ist herzlich und professionell. Dank des breiten Angebots von klassischen Rosen bis zu exotischen Sorten entstehen wirklich einzigartige Arrangements. Sehr zu empfehlen!",
                },
                {
                    author: "Katarzyna M.",
                    text: "Joanna kreiert magische Kompositionen, die alle Erwartungen übertreffen. Jeder Strauß ist einzigartig und mit großer Sorgfalt gefertigt, er verleiht jeder Feier Glanz. Absolut empfehlenswert! Joanna erzählt mit Leidenschaft über jede Blume und hilft, die perfekte Komposition zu bauen. Der Service ist stets freundlich, die Atmosphäre lädt zum Wiederkommen ein. Ob Hochzeit, Jubiläum oder einfach Freude schenken – ihre Blumen treffen immer ins Schwarze.",
                },
                {
                    author: "Robert L.",
                    text: "Bestellungen bei Joanna werden stets mit größter Sorgfalt ausgeführt – die Blumen sind frisch, wunderschön arrangiert und sorgfältig verpackt. Wärmstens empfohlen für alle, die Bequemlichkeit, Qualität und Schönheit schätzen!",
                },
                {
                    author: "Aleksandra P.",
                    text: "Der Strauß, den ich bestellt habe, übertraf die Erwartungen – frisch, schön gebunden und duftend. Schnelle Lieferung und professioneller Service, ich werde sicher wieder bestellen. Empfohlen für alle, die außergewöhnliche Blumen bis vor die Tür möchten!",
                },
                {
                    author: "Julia T.",
                    text: "Ein großartiges Einkaufserlebnis! Der Online-Shop von Joanna bietet nicht nur wunderschöne Sträuße und Bouquets, sondern auch hervorragenden Service. Die Bestellung ist sehr einfach, und die Möglichkeit, Bouquets online zu personalisieren, ist ein großes Plus. Die Blumen kamen pünktlich, schön verpackt und makellos an. Es war mein erster Besuch, aber sicher nicht der letzte!",
                },
            ],
        },
        footer: {
            help: "Brauchst du Hilfe bei der Blumenauswahl? Ruf an!",
            copyright:
                "Copyright © Pani Kwiat - Website von Manufaktura Programowania & Studio Projektowe Bonsai Design",
        },
    },
};

export { normalizeLang };
