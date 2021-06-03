var posRotateCard = ["rotate-1", "rotate-2", "-rotate-1", "-rotate-2"];
let widthtWindow = viewportSize().width;
if (widthtWindow < 550) {
    var posRotate = posRotateCard;
    var move = 500;
} else {
    var posRotate = ["rotate-6", "rotate-12", "-rotate-6", "-rotate-12"];
    var move = 650;
}

var posCard = 0;

var modal = document.getElementById("myModal");
var span = document.getElementsByClassName("close")[0];

var cards = document.querySelectorAll(".cards");
var cardsI = document.querySelector(".cardsI");
var keep = document.querySelector(".keep");
keep.style.cursor = "pointer";
var sweep = document.querySelector(".sweep");
sweep.style.cursor = "pointer";

var textBelow = document.querySelector(".textBelow");
var imgBelow = document.querySelector(".imgBelow");
var textUp = document.querySelector(".textUp");
var imgUp = document.querySelector(".imgUp");

//Positioning of the superimposed cards
for (let i = 0; i < cards.length; i++) {
    cards[i].style.zIndex = i + 2;
}
cardsI.style.zIndex = 10;

arrayCards = randomize(arrayCards);
possitionCard(posCard);

keep.addEventListener("click", function () {
    arrayCards[posCard].changeValid(true);
    posCard++;
    if (posCard == arrayCards.length) {
        posCard = 0;
    }
    moveCard("+", move);
    recipeDisplay();
});

sweep.addEventListener("click", function () {
    arrayCards[posCard].changeValid(false);
    posCard++;
    if (posCard == arrayCards.length) {
        posCard = 0;
    }
    moveCard("-", move);
    recipeDisplay();
});

randomize(arrayRepices);
recipeDisplay();
