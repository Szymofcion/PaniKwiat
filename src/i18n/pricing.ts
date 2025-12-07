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
        heading: "Gotowe dekoracje świąteczne, od razu do kupienia",
        intro: "Wybierz talerze i aranżacje przygotowane w estetyce Pani Kwiat. Każdy produkt ma wymiary, cenę i szybki przycisk \"Kup teraz\" kierujący prosto na Facebook Marketplace.",
        buyNow: "Kup teraz",
        closeLabel: "Zamknij podgląd",
        dialogAria: "Powiększ",
        items: [
            {
                title: "Złoty talerz świąteczny",
                lead: "Metaliczny talerz z zimowymi akcentami – gotowy, aby w kilka sekund odmienić stół.",
                details: ["Wysokość 20 cm, średnica 30 cm.", "Cena 145,00 zł.", "Plus koszty wysyłki."],
                alt: "Złoty talerz świąteczny z dekoracjami",
            },
            {
                title: "Talerz ozdobny",
                lead: "Neutralna, elegancka baza z subtelną kompozycją, która wpasuje się w każde wnętrze.",
                details: ["Wysokość 20 cm, średnica 30 cm.", "Cena 155,00 zł.", "Plus koszty wysyłki."],
                alt: "Dekoracyjny talerz z kompozycją",
            },
            {
                title: "Aranżacja świąteczna w wiklinowym koszu",
                lead: "Sztuczne kwiaty, bombki i światełka na wiklinowej podstawie – efektowna ozdoba na cały sezon.",
                details: ["Wysokość 70 cm, średnica 50 cm.", "Cena 360,00 zł.", "Plus koszty wysyłki."],
                alt: "Aranżacja świąteczna ze sztucznych kwiatów",
            },
        ],
        cta: {
            heading: "Sprawdź moje inne realizacje",
            subheading: "zobacz kompozycje, które możesz kupić jeszcze dziś!",
            button: "przeglądaj gotowe produkty",
        },
        meta: {
            title: "Cennik dekoracji świątecznych | Gotowe talerze i aranżacje Pani Kwiat",
            description:
                "Złote talerze, ozdobne aranżacje i kompozycje świąteczne od Pani Kwiat. Sprawdź ceny, wymiary, zdjęcia i zamów od razu przez Facebook Marketplace.",
        },
    },
    en: {
        heading: "Ready-made holiday decorations, available right away",
        intro: "Choose plates and arrangements in the Pani Kwiat style. Each product lists its size, price, and a quick \"Buy now\" button that goes straight to Facebook Marketplace.",
        buyNow: "Buy now",
        closeLabel: "Close preview",
        dialogAria: "Zoom",
        items: [
            {
                title: "Golden holiday plate",
                lead: "A metallic plate with winter accents—ready to refresh your table in seconds.",
                details: ["Height 20 cm, diameter 30 cm.", "Price 145.00 zł.", "Plus shipping costs."],
                alt: "Golden Christmas plate with decorations",
            },
            {
                title: "Decorative plate",
                lead: "A neutral, elegant base with a subtle arrangement that fits any interior.",
                details: ["Height 20 cm, diameter 30 cm.", "Price 155.00 zł.", "Plus shipping costs."],
                alt: "Decorative plate with a floral composition",
            },
            {
                title: "Christmas arrangement in a wicker basket",
                lead: "Artificial flowers, baubles, and lights on a wicker base—an eye-catching piece for the whole season.",
                details: ["Height 70 cm, diameter 50 cm.", "Price 360.00 zł.", "Plus shipping costs."],
                alt: "Christmas arrangement made of artificial flowers",
            },
        ],
        cta: {
            heading: "See my other creations",
            subheading: "check the arrangements you can buy today!",
            button: "browse ready products",
        },
        meta: {
            title: "Holiday decoration prices | Ready plates and arrangements by Pani Kwiat",
            description:
                "Golden plates, decorative arrangements, and Christmas compositions from Pani Kwiat. See prices, sizes, photos, and order directly via Facebook Marketplace.",
        },
    },
    de: {
        heading: "Fertige Weihnachtsdekorationen, sofort verfügbar",
        intro: "Wähle Teller und Arrangements im Stil von Pani Kwiat. Jedes Produkt enthält Maße, Preis und einen schnellen \"Jetzt kaufen\"-Button direkt zum Facebook Marketplace.",
        buyNow: "Jetzt kaufen",
        closeLabel: "Vorschau schließen",
        dialogAria: "Vergrößern",
        items: [
            {
                title: "Goldener Weihnachtsteller",
                lead: "Metallischer Teller mit winterlichen Akzenten – verwandelt den Tisch in wenigen Sekunden.",
                details: ["Höhe 20 cm, Durchmesser 30 cm.", "Preis 145,00 zł.", "Zzgl. Versandkosten."],
                alt: "Goldener Weihnachtsteller mit Dekoration",
            },
            {
                title: "Dekorativer Teller",
                lead: "Neutrale, elegante Basis mit dezenter Komposition, die in jedes Interieur passt.",
                details: ["Höhe 20 cm, Durchmesser 30 cm.", "Preis 155,00 zł.", "Zzgl. Versandkosten."],
                alt: "Dekorativer Teller mit Blumenkomposition",
            },
            {
                title: "Weihnachtsarrangement im Weidenkorb",
                lead: "Kunstblumen, Kugeln und Lichter auf einer Weidenbasis – eine eindrucksvolle Deko für die ganze Saison.",
                details: ["Höhe 70 cm, Durchmesser 50 cm.", "Preis 360,00 zł.", "Zzgl. Versandkosten."],
                alt: "Weihnachtsarrangement aus Kunstblumen",
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
