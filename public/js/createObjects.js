/*Creating Recipe Objects from JSON*/
var arrayRepices = [];
repices.forEach((repice) => {
    arrayRepices.push(new Recipe(repice));
});

/*Creation of ingredient cards*/
var listIngredients = [
    "Noix de coco",
    "Kiwis",
    "Oranges",
    "Citrons",
    "Framboises",
    "Fraises",
    "Amandes",
    "Miel",
    "Pêches",
    "Beurre",
    "Lait",
    "Oeufs",
    "Farine",
    "Chocolat blanc",
    "Chocolat",
    "Cerises",
    "Sucre",
    "Pommes",
];
var arrayCards = [];
listIngredients.forEach((ingredient) => {
    arrayCards.push(new Card(ingredient));
});
