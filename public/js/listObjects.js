/*Recipe and ingredient items*/
class Recipe {
    constructor(repice) {
        this.name = repice.name;
        this.id = repice.id;
        this.number = repice.number;
        this.time = repice.time;
        this.picture = repice.picture;
        this.ingredients = repice.ingredients;
        this.lists = repice.lists;
        this.preparations = repice.preparations;
        this.valid = false;
    }
    validRecipe(ingredients) {
        this.valid = false;
        if (ingredients.length > 0) {
            let arrayCommun = ingredients.filter((e) =>
                this.ingredients.includes(e)
            );
            if (arrayCommun.length == ingredients.length) {
                this.valid = true;
            }
        }
    }
}

class Card {
    constructor(ingredient) {
        this.name = ingredient;
        this.picture = this.checkWriting(ingredient);
        this.valid = false;
    }
    changeValid(value) {
        this.valid = value;
    }
    checkWriting(text) {
        var text = text.toLowerCase().replace(/ /g, "");
        var accents = "àáâäôöèéêëçîïûü";
        var accentsOut = "aaaaooeeeeciiuu";
        var textArray = text.split("");
        var out = "";
        var x;
        for (let i = 0; i < textArray.length; i++) {
            if ((x = accents.indexOf(textArray[i])) != -1) {
                textArray[i] = accentsOut[x];
            }
            out += textArray[i];
        }
        return out;
    }
}
