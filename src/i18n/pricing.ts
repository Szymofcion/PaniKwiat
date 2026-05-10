import { normalizeLang, type Lang as PricingLang } from "./lang";

export const facebookLink = "https://www.facebook.com/marketplace/profile/100058801496320/?ref=permalink";

export const pricingCopy: Record<
    PricingLang,
    {
        heading: string;
        intro: string;
        buyNow: string;
        closeLabel: string;
        dialogAria: string;
        items: {
            title: string;
            lead: string;
            details: string[];
            alt: string;
            image: string;
            gallery: string[];
        }[];
        cta: {
            heading: string;
            subheading: string;
            button: string;
        };
        meta: {
            title: string;
            description: string;
        };
    }
> = {
    pl: {
        heading: "Gotowe dekoracje i kompozycje, od razu do zamówienia",
        intro: "Wybierz gotowe aranżacje przygotowane w estetyce Pani Kwiat. Każdy produkt ma opis, zdjęcia i szybki przycisk \"Kup teraz\" kierujący prosto na Facebook Marketplace.",
        buyNow: "Kup teraz",
        closeLabel: "Zamknij podgląd",
        dialogAria: "Powiększ",
        items: [
            {
                title: "Kwiaty na każdą okazję",
                lead: "Ozdobne pudełko z kwiatami w kolorach, które sprawdzą się jako prezent na wiele okazji.",
                details: [
                    "Wysokość 40 cm, średnica pudełka 20 cm.",
                    "Kwiaty ułożone są w piance florystycznej, co przedłuża ich świeżość.",
                    "Idealne rozwiązanie dla podróżujących.",
                ],
                alt: "Ozdobne pudełko z kwiatami na każdą okazję",
                image: "/cennik/1/Kwiaty na każdą okazję.jpg",
                gallery: ["/cennik/1/Kwiaty na każdą okazję.jpg"],
            },
            {
                title: "Kwiaty na chrzest lub komunię świętą",
                lead: "Delikatna, wiosenna aranżacja w przezroczystym szklanym wazonie, przygotowana jako wystrój stołów.",
                details: [
                    "Wysokość około 30 cm.",
                    "Dostępne na terenie Wrocławia.",
                    "Cena zawiera wazon.",
                ],
                alt: "Delikatna aranżacja kwiatowa na chrzest lub komunię",
                image: "/cennik/2/Kwiaty na chrzest lub komunię świętą-1.jpg",
                gallery: [
                    "/cennik/2/Kwiaty na chrzest lub komunię świętą-1.jpg",
                    "/cennik/2/Kwiaty na chrzest lub komunię świętą-2.jpg",
                ],
            },
            {
                title: "Unikalny wianek, wieniec ozdobny",
                lead: "Dekoracyjny wianek do wnętrza, na drzwi lub jako ozdoba stołu, przygotowany w autorskim stylu Pani Kwiat.",
                details: ["Produkt gotowy do zamówienia.", "Cena dostępna po kontakcie.", "Możliwość dopasowania podobnej kompozycji do okazji."],
                alt: "Unikalny wianek ozdobny",
                image: "/cennik/3/674562666_1647858816405261_4962527916151947291_n.jpg",
                gallery: [
                    "/cennik/3/674562666_1647858816405261_4962527916151947291_n.jpg",
                    "/cennik/3/675559602_3363871810454306_5708614978700269464_n.jpg",
                    "/cennik/3/675783829_946514561322032_420060196992084675_n.jpg",
                    "/cennik/3/676466614_1473031520990777_6843671038386788551_n.jpg",
                    "/cennik/3/677663053_1450437566101738_1403299244379218340_n.jpg",
                ],
            },
        ],
        cta: {
            heading: "Sprawdź moje inne realizacje",
            subheading: "zobacz kompozycje, które możesz kupić jeszcze dziś!",
            button: "przeglądaj gotowe produkty",
        },
        meta: {
            title: "Cennik dekoracji i kompozycji kwiatowych | Pani Kwiat",
            description:
                "Gotowe kompozycje i dekoracje kwiatowe od Pani Kwiat. Sprawdź opisy, zdjęcia i zamów od razu przez Facebook Marketplace.",
        },
    },
    en: {
        heading: "Ready-made decorations and floral arrangements",
        intro: "Choose ready-made arrangements in the Pani Kwiat style. Each product includes a description, photos, and a quick \"Buy now\" button that goes straight to Facebook Marketplace.",
        buyNow: "Buy now",
        closeLabel: "Close preview",
        dialogAria: "Zoom",
        items: [
            {
                title: "Flowers for every occasion",
                lead: "A decorative flower box in colours that work beautifully as a gift for many occasions.",
                details: [
                    "Height 40 cm, box diameter 20 cm.",
                    "Flowers are arranged in floral foam to help them stay fresh longer.",
                    "A practical option for people who travel.",
                ],
                alt: "Decorative flower box for any occasion",
                image: "/cennik/1/Kwiaty na każdą okazję.jpg",
                gallery: ["/cennik/1/Kwiaty na każdą okazję.jpg"],
            },
            {
                title: "Flowers for baptism or First Communion",
                lead: "A delicate spring arrangement in a clear glass vase, prepared as table decor for a special celebration.",
                details: ["Approx. height 30 cm.", "Available in Wroclaw.", "The price includes the vase."],
                alt: "Delicate flower arrangement for baptism or First Communion",
                image: "/cennik/2/Kwiaty na chrzest lub komunię świętą-1.jpg",
                gallery: [
                    "/cennik/2/Kwiaty na chrzest lub komunię świętą-1.jpg",
                    "/cennik/2/Kwiaty na chrzest lub komunię świętą-2.jpg",
                ],
            },
            {
                title: "Unique decorative wreath",
                lead: "A decorative wreath for interiors, doors, or table styling, prepared in the original Pani Kwiat style.",
                details: ["Ready to order.", "Price available on request.", "A similar composition can be adjusted to the occasion."],
                alt: "Unique decorative wreath",
                image: "/cennik/3/674562666_1647858816405261_4962527916151947291_n.jpg",
                gallery: [
                    "/cennik/3/674562666_1647858816405261_4962527916151947291_n.jpg",
                    "/cennik/3/675559602_3363871810454306_5708614978700269464_n.jpg",
                    "/cennik/3/675783829_946514561322032_420060196992084675_n.jpg",
                    "/cennik/3/676466614_1473031520990777_6843671038386788551_n.jpg",
                    "/cennik/3/677663053_1450437566101738_1403299244379218340_n.jpg",
                ],
            },
        ],
        cta: {
            heading: "See my other creations",
            subheading: "check the arrangements you can buy today!",
            button: "browse ready products",
        },
        meta: {
            title: "Floral decoration prices | Pani Kwiat",
            description:
                "Ready-made floral arrangements and decorations from Pani Kwiat. See descriptions, photos, and order directly via Facebook Marketplace.",
        },
    },
    de: {
        heading: "Fertige Dekorationen und Blumenarrangements",
        intro: "Wähle fertige Arrangements im Stil von Pani Kwiat. Jedes Produkt enthält Beschreibung, Fotos und einen schnellen \"Jetzt kaufen\"-Button direkt zum Facebook Marketplace.",
        buyNow: "Jetzt kaufen",
        closeLabel: "Vorschau schließen",
        dialogAria: "Vergrößern",
        items: [
            {
                title: "Blumen fuer jeden Anlass",
                lead: "Eine dekorative Blumenbox in Farben, die sich als Geschenk fuer viele Anlaesse eignet.",
                details: [
                    "Hoehe 40 cm, Durchmesser der Box 20 cm.",
                    "Die Blumen sind in Floristikschaum arrangiert, damit sie laenger frisch bleiben.",
                    "Eine praktische Loesung fuer Reisende.",
                ],
                alt: "Dekorative Blumenbox fuer jeden Anlass",
                image: "/cennik/1/Kwiaty na każdą okazję.jpg",
                gallery: ["/cennik/1/Kwiaty na każdą okazję.jpg"],
            },
            {
                title: "Blumen fuer Taufe oder Erstkommunion",
                lead: "Ein zartes Fruehlingsarrangement in einer klaren Glasvase, vorbereitet als Tischdekoration.",
                details: ["Hoehe ca. 30 cm.", "Verfuegbar in Wroclaw.", "Der Preis enthaelt die Vase."],
                alt: "Zartes Blumenarrangement fuer Taufe oder Erstkommunion",
                image: "/cennik/2/Kwiaty na chrzest lub komunię świętą-1.jpg",
                gallery: [
                    "/cennik/2/Kwiaty na chrzest lub komunię świętą-1.jpg",
                    "/cennik/2/Kwiaty na chrzest lub komunię świętą-2.jpg",
                ],
            },
            {
                title: "Einzigartiger dekorativer Kranz",
                lead: "Ein dekorativer Kranz fuer Innenraeume, Tueren oder als Tischdekoration im Stil von Pani Kwiat.",
                details: ["Fertig zur Bestellung.", "Preis auf Anfrage.", "Eine aehnliche Komposition kann an den Anlass angepasst werden."],
                alt: "Einzigartiger dekorativer Kranz",
                image: "/cennik/3/674562666_1647858816405261_4962527916151947291_n.jpg",
                gallery: [
                    "/cennik/3/674562666_1647858816405261_4962527916151947291_n.jpg",
                    "/cennik/3/675559602_3363871810454306_5708614978700269464_n.jpg",
                    "/cennik/3/675783829_946514561322032_420060196992084675_n.jpg",
                    "/cennik/3/676466614_1473031520990777_6843671038386788551_n.jpg",
                    "/cennik/3/677663053_1450437566101738_1403299244379218340_n.jpg",
                ],
            },
        ],
        cta: {
            heading: "Entdecke meine weiteren Arbeiten",
            subheading: "sieh dir Kompositionen an, die du noch heute kaufen kannst!",
            button: "fertige Produkte ansehen",
        },
        meta: {
            title: "Preise für Weihnachtsdekorationen | Fertige Teller und Arrangements von Pani Kwiat",
            description:
                "Goldene Teller, dekorative Arrangements und Weihnachtskompositionen von Pani Kwiat. Preise, Maße, Fotos ansehen und direkt über Facebook Marketplace bestellen.",
        },
    },
};
