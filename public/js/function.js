//Create a table of user-validated ingredients
function countCard() {
    let arrayCardValid = [];
    arrayCards.forEach((ingredient) => {
        if (ingredient.valid) {
            arrayCardValid.push(ingredient.name.toLowerCase());
        }
    });
    return arrayCardValid;
}

//Validates recipes against the user's choice of ingredients
function searchRecipe() {
    var cards = countCard();
    for (var repice in arrayRepices) {
        arrayRepices[repice].validRecipe(cards);
    }
}

//Mixing a painting
function randomize(array) {
    var i, j, tmp;
    for (i = array.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        tmp = array[i];
        array[i] = array[j];
        array[j] = tmp;
    }
    return array;
}

// user screen size detection
function viewportSize() {
    var d = document.documentElement;
    return {
        height: d.clientHeight,
        width: d.clientWidth,
    };
}

//Positioning of the 2 visible cards
function possitionCard(pos) {
    let heightWindow = viewportSize().height;
    let widthtWindow = viewportSize().width;

    var pos2;
    if (pos == arrayCards.length - 1) {
        pos2 = 0;
    } else {
        pos2 = pos + 1;
    }
    if ((arrayCards[pos2].name.length > 10) & (widthtWindow < 550)) {
        textBelow.style.fontSize = "2.4rem";
    } else {
        textBelow.removeAttribute("style");
    }
    textBelow.textContent = arrayCards[pos2].name;
    imgBelow.setAttribute("alt", arrayCards[pos2].name);
    imgBelow.setAttribute(
        "src",
        "./images/ingredients/" + arrayCards[pos2].picture + ".jpg"
    );

    if ((arrayCards[pos].name.length > 10) & (widthtWindow < 550)) {
        textUp.style.fontSize = "2.4rem";
    } else {
        textUp.removeAttribute("style");
    }
    textUp.textContent = arrayCards[pos].name;
    imgUp.setAttribute("alt", arrayCards[pos].name);
    imgUp.setAttribute(
        "src",
        "./images/ingredients/" + arrayCards[pos].picture + ".jpg"
    );

    // Decrease the size of images on shorter screens to avoid too much scrolling

    if ((heightWindow < 900) & (widthtWindow > 550)) {
        imgBelow.setAttribute("height", "300px");
        imgBelow.setAttribute("width", "300px");
        imgUp.setAttribute("height", "300px");
        imgUp.setAttribute("width", "300px");
    } else {
        imgBelow.removeAttribute("height");
        imgBelow.removeAttribute("width");
        imgUp.removeAttribute("height");
        imgUp.removeAttribute("width");
    }
}

//Moving card
function moveCard(way, move) {
    posRotate = randomize(posRotate);
    posRotateCard = randomize(posRotateCard);
    cardsI.classList.add("horizTranslate");
    const transition = document.querySelector(".horizTranslate");
    cardsI.style.transform = "translateX(" + way + move + "px)";

    transition.ontransitionend = () => {
        cardsI.style.zIndex = 1;
        for (let i = 0; i < cards.length - 1; i++) {
            cards[i].classList.replace(
                cards[i].classList.item(0),
                posRotate[i]
            );
            cards[i + 1].classList.replace(
                cards[i + 1].classList.item(0),
                posRotateCard[i]
            );
        }
        cardsI.style.transform = "translateX(" + 0 + "px)";
        transition.ontransitionend = () => {
            possitionCard(posCard);
            cardsI.classList.replace(
                cardsI.classList.item(0),
                posRotateCard[3]
            );
            cardsI.style.zIndex = 10;
        };
    };
}

//Creates the recipe grid
function recipeDisplay() {
    let repiceDiv = document.querySelector(".repice");
    let html = "";
    let imgClass;
    let divClass;
    searchRecipe();
    repiceDiv.style.zIndex = 0;
    for (var repice in arrayRepices) {
        if (arrayRepices[repice].valid) {
            imgClass = "validImg";
            divClass = "validDiv";
        } else {
            imgClass = "grayImg";
            divClass = "grayDiv";
        }
        html +=
            "<div class='tooltip " +
            divClass +
            " divsRepice' id='" +
            arrayRepices[repice].id +
            "'><img class='rounded " +
            imgClass +
            "' alt='" +
            arrayRepices[repice].name +
            "' width='200px' height='200px' src ='./images/recettes/" +
            arrayRepices[repice].picture +
            ".jpg'/><span class='tooltiptext'>" +
            arrayRepices[repice].name +
            "</span></div>";
    }
    repiceDiv.innerHTML = html;

    var divsRepice = document.querySelectorAll(".divsRepice");
    for (var i = 0; i < divsRepice.length; i++) {
        divsRepice[i].addEventListener("click", function () {
            openModal(this.getAttribute("id"));
        });
    }
}
// Creates a modal and its content for each card
function openModal(id) {
    var repiceModal = document.querySelector(".modal");
    let div = "";
    for (var repice in arrayRepices) {

        if (arrayRepices[repice].id == id) {
            repiceModal = arrayRepices[repice];
            break;
        }
    }
    if (repiceModal.valid) {
        div += '<div class="modal-content">';
        div += '<span class="close">&times;</span>';
        div += '<p class= "modal-name">' + repiceModal.name + "</p>";
        div +=
            '<p class= "modal-number">Pour ' +
            repiceModal.number +
            " personnes" +
            "</p>";
        div +=
            '<p class= "modal-time">Durée : ' + repiceModal.time + " min</p>";
        div +=
            '<p class= "modal-picture"><img class="center"+ ' +
            repiceModal.name +
            " src ='./images/recettes/" +
            repiceModal.picture +
            ".jpg'/></p>";

        var global = repiceModal.lists;
        for (var list in global) {
            if (list != "Principale") {
                div += "<ul><li>" + list + "</li></ul>";
            } else {
                /*Force the name change*/
                div += "<ul><li>Ingredient</li></ul>";
            }
            for (var j = 0; j < global[list].length; j++) {
                div += "<li>" + global[list][j] + "</li>";
            }
        }
        var globalP = repiceModal.preparations;
        for (var list in globalP) {
            if (list != "Principale") {
                div += "<ul>" + list + "</ul>";
            } else {
                /*Force the name change*/
                div += "<ul>Recette</ul>";
            }
            for (var j = 0; j < globalP[list].length; j++) {
                if (list != "Conseil") {
                    div += "<li>" + globalP[list][j] + "</li>";
                }
            }
        }
        div += "<li>" + globalP.Conseil + "</li>";

        modal.style.display = "block";
        modal.innerHTML = div;

        //Click condition on the modal
        var close = document.querySelector(".close");
        close.onclick = function () {
            modal.style.display = "none";
        };
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
        var close = document.querySelector(".modal");
        modal.onclick = function (event) {
            modal.style.display = "none";
        };
    }
}
