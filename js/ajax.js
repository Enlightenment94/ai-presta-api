function show(x){
    el = document.getElementById("a" + x);
    console.log(x);
    if(el.style.display == "block"){
        el.style.display = "none"
    }else{
        el.style.display = "block"
    }

}

function sendx(x, a, id, gcase){
    console.log(x);
    console.log(a);
    console.log(id);
    txt = document.getElementById("a" + a).value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './request.php?x=' + x  + "&id=" +  id + "&txt=" +  txt + "&gcase=" +  gcase, true);
    xhr.setRequestHeader('Content-type', 'application/hpp');
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send();
}

function ajaxC(x){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './request.php?x=' + x, true);
    xhr.setRequestHeader('Content-type', 'application/hpp');
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            var parser = new DOMParser();
            xmlDoc = parser.parseFromString(xhr.responseText, "text/xml")
            var names = xmlDoc.getElementsByTagName("name");
            var idCategory = xmlDoc.getElementsByTagName("id_category");

            var response = "<div>";
            for (i = 0; i < names.length; i++) {
                response += "<button class='button-menu' onclick='getEl(\"" + x + "\", \"" + idCategory[i].childNodes[0].nodeValue + "\")'>" + names[i].childNodes[0].nodeValue + "</button>";
                response += "</br>";
            }
            response += "</div>";
            document.getElementById('menu-result').innerHTML = response;
            highlightActiveButton(); 
            addButtonListeners();
        }
    };
    xhr.send();
}

function ajaxP(x){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './request.php?x=' + x, true);
    xhr.setRequestHeader('Content-type', 'application/hpp');
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {

            response = decodeURI(xhr.responseText);
            console.log(response);

            var parser = new DOMParser();
            xmlDoc = parser.parseFromString(response, "text/xml")
            var names = cutAll(response, "<name>", "</name>"); 
            var id = cutAll(response, "<id_product>", "</id_product>");

            console.log(names.length);
            console.log(id.length);
            var response = "<div>";
            for (i = 0; i < id.length; i++) {
                response += "<button class='button-menu' onclick='getEl(\"" + x + "\", \"" + id[i] + "\")'>" + id[i] +  " " + names[i] + "</button>";
                response += "</br>";
            }
            response += "</div>";
            document.getElementById('menu-result').innerHTML = response;
            highlightActiveButton();
            addButtonListeners();
        }
    };
    xhr.send();
}

function ajaxM(x){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './request.php?x=' + x, true);
    xhr.setRequestHeader('Content-type', 'application/hpp');
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {

            response = decodeURI(xhr.responseText);
            console.log(response);

            var parser = new DOMParser();
            xmlDoc = parser.parseFromString(response, "text/xml")
            var names = cutAll(response, "<name>", "</name>"); 
            var id = cutAll(response, "<id_manufacturer>", "</id_manufacturer>");

            console.log(names.length);
            console.log(id.length);
            var response = "<div>";
            for (i = 0; i < id.length; i++) {
                response += "<button class='button-menu' onclick='getEl(\"" + x + "\", \"" + id[i] + "\")'>" + id[i] +  " " + names[i] + "</button>";
                response += "</br>";
            }
            response += "</div>";
            document.getElementById('menu-result').innerHTML = response;
            highlightActiveButton();
            addButtonListeners();
        }
    };
    xhr.send();
}


function getEl(x, id){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './request.php?x=' + x  + "&id=" +  id, true);
    xhr.setRequestHeader('Content-type', 'application/hpp');
    xhr.onreadystatechange = function() {
        if(xhr.readyState === 4 && xhr.status === 200) {
            var parser = new DOMParser();
            xmlDoc = parser.parseFromString(xhr.responseText, "text/xml")
            
            if(x == "c"){
                var description = xmlDoc.getElementsByTagName("description");
                var additionalDescription = xmlDoc.getElementsByTagName("additional_description");
                var metaTitle = xmlDoc.getElementsByTagName("meta_title");
                var metaKeywords = xmlDoc.getElementsByTagName("meta_keywords"); 
                var metaDescription = xmlDoc.getElementsByTagName("meta_description"); 

                console.log(description.length);
                for (i = 0; i < 1; i++) {
                    response = "<p>description:</p>";
                    description = (description[i].childNodes[0] && description[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + description + "</div>";
                    response += "<textarea id='a1' name='d'>" + description + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('1')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('c', 1, " + id + ",'description')\">send</button>";

                    response += "<p>additionalDescription:</p>";
                    additionalDescription = (additionalDescription[i].childNodes[0] && additionalDescription[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + additionalDescription + "</div>";
                    response += "<textarea id='a2' name='ad'>" + additionalDescription + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('2')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('c', 2, " + id + ", 'additional_Description')\">send</button>";

                    response += "<p>metaTitle:</p>";
                    metaTitle = (metaTitle[i].childNodes[0] && metaTitle[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + metaTitle + "</div>";
                    response += "<textarea id='a3' name='mt'>" + metaTitle + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('3')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('c', 3, " + id + ", 'meta_title')\">send</button>";

                    response += "<p>metaKeywords:</p>";
                    metaKeywords = (metaKeywords[i].childNodes[0] && metaKeywords[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" +metaKeywords+ "</div>";
                    response += "<textarea id='a4' name='mk'>" + metaKeywords + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('4')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('c', 4, " + id + ", 'meta_keywords')\">send</button>";

                    response += "<p>metaDescription:</p>";
                    metaDescription = (metaDescription[i].childNodes[0] && metaDescription[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + metaDescription + "</div>";
                    response += "<textarea id='a5' name='md'>" + metaDescription + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('5')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('c', 5, " + id + ", 'meta_description')\">send</button>";
                    
                }
            }

            if(x == "p"){
                var description = xmlDoc.getElementsByTagName("description");
                var metaTitle = xmlDoc.getElementsByTagName("meta_title");
                var metaKeywords = xmlDoc.getElementsByTagName("meta_keywords"); 
                var metaDescription = xmlDoc.getElementsByTagName("meta_description"); 

                console.log(description.length);
                for (i = 0; i < 1; i++) {
                    response = "<p>description:</p>";
                    description = (description[i].childNodes[0] && description[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + description + "</div>";
                    response += "<textarea id='a1' name='d'>" + description + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('1')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('c', 1, " + id + ")\">send</button>";

                    response += "<p>metaTitle:</p>";
                    metaTitle = (metaTitle[i].childNodes[0] && metaTitle[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + metaTitle + "</div>";
                    response += "<textarea id='a3' name='mt'>" + metaTitle + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('3')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('c', 3, " + id + ")\">send</button>";

                    response += "<p>metaKeywords:</p>";
                    metaKeywords = (metaKeywords[i].childNodes[0] && metaKeywords[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" +metaKeywords+ "</div>";
                    response += "<textarea id='a4' name='mk'>" + metaKeywords + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('4')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('c', 4, " + id + ")\">send</button>";

                    response += "<p>metaDescription:</p>";
                    metaDescription = (metaDescription[i].childNodes[0] && metaDescription[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + metaDescription + "</div>";
                    response += "<textarea id='a5' name='md'>" + metaDescription + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('5')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('c', 5, " + id + ")\">send</button>";
                }

            }

            if(x == "m"){
                console.log(xhr.responseText);
                var description = xmlDoc.getElementsByTagName("description");
                var shortDescription = xmlDoc.getElementsByTagName("short_description");
                var metaTitle = xmlDoc.getElementsByTagName("meta_title");
                var metaKeywords = xmlDoc.getElementsByTagName("meta_keywords"); 
                var metaDescription = xmlDoc.getElementsByTagName("meta_description"); 

                console.log(description.length);
                for (i = 0; i < 1; i++) {
                    response = "<p>description:</p>";
                    description = (description[i].childNodes[0] && description[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + description + "</div>";
                    response += "<textarea id='a1' name='d'>" + description + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('1')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('m', 1, " + id + ", 'description')\">send</button>";

                    response += "<p>shortDescription:</p>";
                    shortDescription = (shortDescription[i].childNodes[0] && shortDescription[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + shortDescription + "</div>";
                    response += "<textarea id='a2' name='sd'>" + shortDescription + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('2')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('m', 2, " + id + ", 'short_description')\">send</button>";

                    response += "<p>metaTitle:</p>";
                    metaTitle = (metaTitle[i].childNodes[0] && metaTitle[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + metaTitle + "</div>";
                    response += "<textarea id='a3' name='mt'>" + metaTitle + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('3')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('m', 3, " + id + ", 'meta_title')\">send</button>";

                    response += "<p>metaKeywords:</p>";
                    metaKeywords = (metaKeywords[i].childNodes[0] && metaKeywords[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" +metaKeywords+ "</div>";
                    response += "<textarea id='a4' name='mk'>" + metaKeywords + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('4')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('m', 4, " + id + ", 'meta_keywords')\">send</button>";

                    response += "<p>metaDescription:</p>";
                    metaDescription = (metaDescription[i].childNodes[0] && metaDescription[i].childNodes[0].nodeValue) || '';
                    response += "<div class='area'>" + metaDescription + "</div>";
                    response += "<textarea id='a5' name='md'>" + metaDescription + "</textarea>";
                    response += "<button class='cbtn' onclick=\"show('5')\">edit</button>";
                    response += "<button class='cbtn' onclick=\"sendx('m', 5, " + id + ", 'meta_description')\">send</button>";
                }
            }

            console.log(response);
            document.getElementById('content-result').innerHTML = response;
        }
    };
    xhr.send();
}

var buttons = ""
    var activeButtonIndex = 0
    function highlightActiveButton() {
        buttons = document.querySelectorAll('.button-menu');
        buttons.forEach((button, index) => {
            if (index === activeButtonIndex) {
                button.classList.add('active');
                button.click(); 
            } else {
                button.classList.remove('active');
            }
        });
    }

    function handleButtonClick(index) {
        activeButtonIndex = index;
        highlightActiveButton();
    }

    function addButtonListeners() {
        buttons = document.querySelectorAll('.button-menu');
        buttons.forEach((button, index) => {
        button.addEventListener('click', () => {
                handleButtonClick(index);
            });
        });
    }

    window.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') {
            // Przesunięcie w lewo
            activeButtonIndex = (activeButtonIndex - 1 + buttons.length) % buttons.length;
            highlightActiveButton();
        } else if (event.key === 'ArrowRight') {
            // Przesunięcie w prawo
            activeButtonIndex = (activeButtonIndex + 1) % buttons.length;
            highlightActiveButton();
        }
        
    });

    highlightActiveButton(); 