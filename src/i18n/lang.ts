export type Lang = "pl" | "en" | "de";

export const normalizeLang = (lang?: string): Lang => {
    if (lang === "en" || lang === "de") return lang;
    return "pl";
};
