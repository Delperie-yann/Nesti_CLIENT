document.addEventListener("DOMContentLoaded", function () {
    var total = 0;
    var listElement = document.querySelectorAll('#but');
    listElement.forEach(element => {
        element.addEventListener('click', add);
    });
    class Products {
        constructor(type, price, number) {
            this.type = type;
            this.price = price;
            this.number = number;

        }
    }

    function add() {
        var text = event.target.dataset.name;
        var price = event.target.dataset.price;
        var number = event.target.dataset.quantity;
        var nb = 1
        if (window.localStorage.getItem("Nesti_" + text) != null) {
            var j = JSON.parse(window.localStorage.getItem("Nesti_" + text))
            nb = (j.number) + 1
        }
        var product = new Products(text, price, nb);
        window.localStorage.setItem("Nesti_" + text, JSON.stringify(product))
        alert("le produt " + text + " a été ajoué au panier")

    }

    start();

    function start() {


        var content = document.querySelector('#nameCast');
        if (content != null) {
            for (var i = 0; i < localStorage.length; i++) {
                var marker = localStorage.key(i).split('_')[0];

                if (marker == 'Nesti') {
                    var localvalue = localStorage.getItem(localStorage.key(i));
                    console.log(localvalue);

                    var j = JSON.parse(localvalue);
                    var nbof = Number(j.price) * Number(j.number);
                    content.innerHTML +=
                        '<tr><th id="name" scope="row" >'
                        + j.type + '</th><td id="number">'
                        + Number(j.number) + '</td><td>' + '<button  id="minus" class="btn btn-secondary ml-2">-</button><button  id="add" class="btn btn-secondary ml-2">+</button><button id="supp" class="btn btn-danger ml-2">X</button>' + '</td><td>'
                        + Number(j.price) + '</td><td id="somme">'
                        + nbof + '</td></tr></tbody>';



                    total += nbof;
                }
            }
        
        var totalLabel = document.querySelector('#result');
        if (totalLabel != null) {
            totalLabel.innerHTML = total + " €";
        }
        var panier = content.querySelectorAll('td>:nth-child(3)');

        panier.forEach(element => {

            element.addEventListener('click', deletep);

        });
        var addButton = content.querySelectorAll('td>:nth-child(2)');

        addButton.forEach(element => {

            element.addEventListener('click', rise);


        });
        var decrButton = content.querySelectorAll('td>:nth-child(1)');
   
        decrButton.forEach(element => {

            element.addEventListener('click', decreases);


        });
    } }



    function deletep() {
        var textEnter = event.target;

        var content = textEnter.querySelector('tr');
        var product = document.querySelectorAll('tr');
        product.forEach(element => {

            var datain = element.querySelectorAll('button')

            datain.forEach(ele => {
                if (ele == textEnter) {

                    var valueIn = element.querySelector('#name').textContent;
                    element.remove();

                    var j = JSON.parse(window.localStorage.getItem("Nesti_" + valueIn))
                    total -= Number(j.price * j.number);
                    var totalLabel = document.querySelector('#result');
                    totalLabel.innerHTML = total + "€";
                    window.localStorage.removeItem("Nesti_" + valueIn);
                }
            })

        });


    }

    function rise() {
        var textEnter = event.target;
        var nb = 1;

        var content = textEnter.querySelector('tr');
        var product = document.querySelectorAll('tr');
        product.forEach(element => {

            var datain = element.querySelectorAll('button')

            datain.forEach(ele => {
                if (ele == textEnter) {

                    var valueIn = element.querySelector('#name').textContent;

                    var j = JSON.parse(window.localStorage.getItem("Nesti_" + valueIn))

                    var price = j.price;
                    var nb = j.number + 1
                    var product = new Products(valueIn, price, nb);
                    window.localStorage.setItem("Nesti_" + valueIn, JSON.stringify(product))
                    var numb = element.querySelector('#number');
                    var numbTotal = element.querySelector('#somme');
                    numb.innerHTML = nb;
                    numbTotal.innerHTML = nb * price;
                    total += Number(price);
                    var totalLabel = document.querySelector('#result');
                    totalLabel.innerHTML = total + "€";
                }
            })


        });
    }

    function decreases() {
        var textEnter = event.target;
        var nb = 1;

        var content = textEnter.querySelector('tr');
        var product = document.querySelectorAll('tr');
        product.forEach(element => {

            var datain = element.querySelectorAll('button')

            datain.forEach(ele => {
                if (ele == textEnter) {

                    var valueIn = element.querySelector('#name').textContent;
                    var j = JSON.parse(window.localStorage.getItem("Nesti_" + valueIn))
                    var price = j.price;
                    var nb = j.number - 1
                    if (nb >= 0) {
                        var product = new Products(valueIn, price, nb);
                        window.localStorage.setItem("Nesti_" + valueIn, JSON.stringify(product))
                        var numb = element.querySelector('#number');

                        var numbTotal = element.querySelector('#somme');

                        numb.innerHTML = nb
                        numbTotal.innerHTML = nb * price;
                        total -= Number(price);
                        var totalLabel = document.querySelector('#result');
                        totalLabel.innerHTML = total + "€";
                    }

                }
            })


        });
    }





});
