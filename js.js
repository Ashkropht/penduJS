let mot = "Charleville"; // Mot à deviner
mot = mot.toUpperCase();
let lettres = mot.split(""); // Division du mot en un tableau (une lettre par entrée du tableau)
let entrees = []; // Définition d'un tableau qui accueillera les lettres entrées par le joueur
let vieRestante = 10; // Nombre de vie restante par mot
let result = document.getElementById("affichage"); // Récupération de la div pour afficher les lettres
let affVie = document.getElementById("nbVies"); // Récupération de la div pour afficher le nombre de vies restantes
let btn = document.getElementById("tester"); // Récupération du bouton de test d'une lettre
let input = document.getElementById("reponse"); // Récupération de l'input où l'utilisateur écrit les lettres
let erreur = document.getElementById("erreur"); // Récupération de la div pour afficher les erreurs
let lettresValid = []; // Définition d'un tableau servant à comparer les lettres utilisateur et celles du mot
let gStarted = false; // Booléen servant à vérifier si le timer est en route ou non
// Boucle créant une div par lettre dans le tableau lettres
for(let i=1; i <= mot.length; i++) {
    let div = document.createElement("div");
    if(mot[i-1] == "-" || mot[i-1] == " ") {
        div.setAttribute("class", "specialchars");
        div.textContent = mot[i-1];
    } else {
        div.setAttribute("class", "lettre");
    }
    div.setAttribute("id", i);
    result.appendChild(div);
}

let cases = document.querySelectorAll(".lettre"); // récupération de toutes les div créées ci-dessus (pour l'affichage des lettres)
// Ecouteur appelant la fonction main quand l'utilisateur appui sur entrée
input.addEventListener("keypress", function(b) {
    if(b.keyCode == 13) {
        main();
    }
})
// Ecouteur appelant la fonction main quand l'utilisateur clique sur le bouton btn
btn.addEventListener("click", function() {
    main();
});
// Fonction principale du programme
function main() {
    if(gStarted == false) { // Condition démarrant le timer si ce dernier ne l'est pas déjà
        let d = new Date().getTime();
        callTimer(d);
        gStarted = true;
    }
    let v = input.value.toUpperCase(); // Récupération de la valeur de l'input (convertie en majuscule)
    input.value = ""; // Reset de la valeur de l'input
    if(v == "") { // Condition vérifiant que la valeur de v est valide
        erreur.textContent = "Veuillez renseigner une lettre";
    } else if(v.length > 1) {
        erreur.textContent = "Veuillez renseigner une lettre à la fois";
    } else if(entrees.includes(v)) {
        erreur.textContent = "Vous avez déjà entré cette lettre";
    } else if (v.charCodeAt(0) < 65 || v.charCodeAt(0) > 90) {
        erreur.textContent = "Veuillez entrer un caractère valide"
    } else {
        stringCheck(v, lettres); // Si v à une valeur correcte, appel de la fonction vérifiant si v est dans le tableau lettres
        erreur.textContent = "";
    }
    if(vieRestante > 1) { // Condition gérant l'affichage de vie + game over
        affVie.textContent = "Vies restantes : " + vieRestante;
    } else if (vieRestante == 1) {
        affVie.textContent = "Vie restante : " + vieRestante;
    } else {
        affVie.textContent = "Game over";
        btn.disabled = true;
        input.disabled = true;
    }
    if(arrayCompare(lettresValid, lettres)) {
        affVie.textContent = "Victoire !";
    }
    entrees.push(v);
}

function callTimer(d) {
    let x = setInterval(function(){
        let now = new Date().getTime();
        let distance = (d + 300000) - now;
        let sec = Math.floor((distance % (1000 * 60)) / 1000);
        let t = document.getElementById("timer");
        t.innerHTML = Math.floor((distance % ((1000 * 60 * 60)) / (1000 * 60)));
        if(sec < 10) {
            t.innerHTML += " : 0" + sec;
        } else {
            t.innerHTML += " : " + sec;
        }

        if(distance < 0) {
            clearInterval(x);
            t.innerHTML = "0 : 00"
            erreur.textContent = "Temps écoulé !";
            btn.disabled = true;
            input.disabled = true;
        }
        let cpt = 0;
        if (cpt %2 == 0) {
            t.style.color = "red";
        } else {
            t.style.color = "black";
        }
    }, 100);
}

function stringCheck(value, tab) {
    let i = 1;
    tab.forEach(lettre => {
        if(value == lettre) {
            document.getElementById(i).textContent = value;
            lettresValid.push(value);
        }
    i++;
    })
    if(!tab.includes(value)) {
        vieRestante--;
    }
}

function arrayCompare(tab1, tab2){
    if(tab1.length != tab2.length) {
        return false;
    } else {
        return true;
    }    
}