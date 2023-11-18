//Vintage pl
/*
class AiRussiangoldCategory extends AiPrestaCategory{
    function category_description($language, $category, $keywords){
        $prompt = "Wygeneruj treść w języku " . $language . ". Stwórz teraz opis kategori, który będzie zoptymalizowany pod kątem SEO i będzie składał się z 400 słów. Tematem kategori są wyroby jubilerskie i wyroby ze złota. Opisz szczegółowo tę konkretną kategorię " . $category . ". Początek tekstu niech będzie orginalny i inny w każdej kategorii. Tekst ma być gotowy do użytku nie wymagać żadnych poprawek!";

        $content = $this->ai($prompt, 800);
        return $content;
    }

    function category_additional_description($language, $category, $keywords){
        $prompt = "Wygeneruj treść w języku " . $language . ". Stwórz teraz opis kategorii, który będzie zoptymalizowany pod kątem SEO i będzie składał się z 200 słów. Tematem kategorii są wyroby jubilerskie i wyroby ze złota. Opisz szczegółowo tę konkretną kategorię " . $category . ". Możesz skorzystać z dostarczonych słów kluczowych, które znajdują się w tablicy: " . $keywords. " Wykorzystaj je, aby stworzyć treści jeszcze bardziej efektywne. Jest to dodatkowy opis kategorii ma zawierać bardziej zwięzłą treść.";

        $content = $this->ai($prompt, 500);
        return $content;
    }

    function category_meta_title($language, $category, $keywords){
        $prompt = "Wygeneruj treść w języku " . $language . ". Stwórz teraz opis kategorii, który będzie zoptymalizowany pod kątem SEO i będzie składał się z mniej niż 60 znaków do pola meta title. Tematem kategorii są wyroby jubilerskie i wyroby ze złota. Opisz szczegółowo tę konkretną kategorię " . $category . ". Możesz skorzystać z dostarczonych słów kluczowych, które znajdują się w tablicy: " . $keywords. " Wykorzystaj je, aby stworzyć treści jeszcze bardziej efektywne.";

        $content = $this->ai($prompt, 300);
        return $content;
    }

    
    function category_meta_keywords($language, $category, $keywords){
        $prompt = "Wygeneruj treść w języku " . $language . ", są to słowa kluczowe meta keywords zrób to dokładnie pod SEO. Opis stwórz dla kategorii o nazwie " . $category . ". Tematem sklepu który opisujesz jest sklep jublierski sprzedający złoto i wyroby jublierskie.";

        $content = $this->ai($prompt, 200);
        return $content;
    }

    function category_meta_description($language, $category, $keywords){
        $prompt = "Wygeneruj treść w języku " . $language . ". Stwórz teraz opis kategorii, który będzie zoptymalizowany pod kątem SEO i będzie składał się z 120 słów do pola meta title. Tematem kategorii są wyroby jubilerskie i wyroby ze złota. Opisz szczegółowo tę konkretną kategorię " . $category . ". Możesz skorzystać z dostarczonych słów kluczowych, które znajdują się w tablicy: " . $keywords. " Wykorzystaj je, aby stworzyć treści jeszcze bardziej efektywne.";

        $content = $this->ai($prompt, 200);
        return $content;
    }
};*/