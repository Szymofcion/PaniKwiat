export type BlogPost = {
    slug: string;
    title: string;
    date: string;
    displayDate: string;
    excerpt: string;
    cover: string;
    gallery: string[];
    paragraphs: string[];
};

export const blogPosts: BlogPost[] = [
    {
        slug: "przebudzenie",
        title: "Przebudzenie",
        date: "2026-05-10",
        displayDate: "10 maja 2026",
        excerpt: "Wiosna, sezonowe kwiaty i pierwsze przygotowania do komunii, ślubów oraz Dnia Mamy.",
        cover: "/blog/przebudzenie/img-3023.jpg",
        gallery: [
            "/blog/przebudzenie/img-3023.jpg",
            "/blog/przebudzenie/img-3025.jpg",
            "/blog/przebudzenie/img-3037.jpg",
            "/blog/przebudzenie/img-3047.jpg",
            "/blog/przebudzenie/img-3107.jpg",
            "/blog/przebudzenie/img-3118.jpg",
            "/blog/przebudzenie/img-3529.jpg",
            "/blog/przebudzenie/img-3532.jpg",
            "/blog/przebudzenie/img-3544.jpg",
            "/blog/przebudzenie/img-3552.jpg",
            "/blog/przebudzenie/img-4897.jpg",
        ],
        paragraphs: [
            "Święta Wielkiej Nocy już za nami. Całe zamieszanie przed nimi, ruch, pośpiech już minęły. To one dla mnie co roku odmierzają czas nadejścia wiosny.",
            "Rozpoczyna się kolejny okres w roku, który nazywam przebudzeniem. Wiąże się on nie tylko z faktem powoli rozpoczynającej się wiosny, ale również z coraz bardziej intensywnym czasem w pracy florysty.",
            "Tak jak w przyrodzie życie rozkwita. Na drzewach kwiaty i pąki liści. W lasach i ogrodach wczesnowiosenne kwiaty już dawno pokazały swoje kolory. Ptaki budują gniazda, a niektóre z nich już karmią młode.",
            "Za chwilę maj, czas komunii, ślubów i pięknego święta Dnia Mamy. Jako florystka mam coraz więcej zamówień, pytań i spotkań z klientami. Omawiam koncepcje i przygotowuję kosztorysy na wspomniane wyżej wydarzenia. W mojej głowie powstają pomysły na nowe kompozycje.",
            "Po długiej zimie, braku słońca, to najprzyjemniejszy okres w roku, zaraz po przyjemności wyjazdów wakacyjnych i związanych z nimi przygodami.",
            "Na giełdzie kwiatowej pojawiają się kolejne sezonowe kwiaty, które wypierają lubiane przez wszystkich tulipany, hiacynty i żonkile. Dominują kolory wiosny. Słonecznie żółty, niebieski i biały. Można kupić coraz więcej kwiatów uprawianych u nas w Polsce, oprócz tych sprowadzanych z zagranicy.",
            "Nastawienie kupujących jest również bardziej optymistyczne. Ludzie cieszą się nadejściem kolejnej wiosny i lata.",
            "Długie lata obserwowałam wiosnę i jej rozpoczęcie w Australii. Oto kilka zdjęć z moich podróży po Polsce i Brisbane.",
        ],
    },
];

export const getBlogPost = (slug: string) => blogPosts.find((post) => post.slug === slug);
