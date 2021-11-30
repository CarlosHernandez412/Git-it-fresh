var grandtotal = 0;
var arraylist = [];
function init(){
    var firstTime = sessionStorage.getItem("first");
        if(!firstTime) {
            sessionStorage.setItem("first","1");
            
        } else {
            arraylist = JSON.parse(sessionStorage.arraylist);
            grandtotal = JSON.parse(sessionStorage.getItem("gt"));
			var allItems = JSON.parse(sessionStorage.arraylist);

        for (var i = 0; i < allItems.length; i++) {					
				var node = document.createElement("LI");
				var textnode = document.createTextNode(allItems[i]);
                node.appendChild(textnode);
				document.getElementById("myList").appendChild(node);
            }
            document.getElementById("grand").innerHTML = "Grand Total = " + grandtotal;
            } 
        }

        function leave() {
                sessionStorage.removeItem("gt");
                sessionStorage.removeItem("first");
                arraylist = [];
                //save arraylist to memory
                sessionStorage.arraylist = JSON.stringify(arraylist);
                location.reload();
        }

//Corn function
function checkCorn() {
    var quantity = document.getElementById("Corn").value;
    if (quantity >= 50) {
        document.getElementById("Cornavailable").innerHTML = "Delivery time may be longer because of large order.";
    }
    else {
        document.getElementById("Cornavailable").innerHTML = "Item is in stock.";
    }
}
function addspag(){
        var node = document.createElement("LI");
        var item = document.getElementById("Corn").value;
        var price = 0.96; 
        total = price * item;
        grandtotal =  grandtotal + total;
        document.getElementById("Corn").value = "";
        if (item < 1) {
            document.getElementById("Cornavailable").innerHTML = "Quantity must be between 1 and 25.";
        }
        else if (item > 25){
            document.getElementById("Cornavailable").innerHTML = "Quantity must be between 1 and 25.";
        }
        else {
        var full = item + " x Corn " + price + " = " + total.toFixed(2);
        arraylist.push(full);
        var textnode = document.createTextNode(full);
            node.appendChild(textnode);
            grandtotal = parseFloat(grandtotal.toFixed(2));
            document.getElementById("grand").innerHTML = "Grand Total = " + grandtotal.toFixed(2);
            document.getElementById("myList").appendChild(node);
//new		
		sessionStorage.setItem("gt",grandtotal);
        }        
    }


//Carrot
function checkCarrot() {
    var quantity = document.getElementById("Carrot").value;
    if (quantity >= 50) {
        document.getElementById("Carrotavailable").innerHTML = "Delivery time may be longer because of large order.";
    }
    else {
        document.getElementById("Carrotavailable").innerHTML = "Item is in stock.";
    }
}
function addCarrot(){
    var node = document.createElement("LI");
    var item = document.getElementById("Carrot").value;
    var price = 0.48;
    total = price * item;
    grandtotal =  grandtotal + total;
    document.getElementById("Carrot").value = "";
    if (item < 1) {
        document.getElementById("Carrotavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else if (item > 25){
        document.getElementById("Carrotavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else {
        var full = item + " x Carrot w/ Banana " + price + " = " + total.toFixed(2);
        arraylist.push(full);
        var textnode = document.createTextNode(full);
        node.appendChild(textnode);
        document.getElementById("grand").innerHTML = "Grand Total = " + grandtotal.toFixed(2);
        document.getElementById("myList").appendChild(node);
    }
}

//ROW 2
//Apple
function checkApple() {
    var quantity = document.getElementById("Apple").value;
    if (quantity >= 50) {
        document.getElementById("Appleavailable").innerHTML = "Delivery time may be longer because of large order.";
    }
    else {
        document.getElementById("Appleavailable").innerHTML = "Item is in stock.";
    }
}
function addApple(){
    var node = document.createElement("LI");
    var item = document.getElementById("Apple").value;
    var price = 0.54;
    total = price * item;
    grandtotal =  grandtotal + total;
    document.getElementById("Apple").value = "";
    if (item < 1) {
        document.getElementById("Appleavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else if (item > 25){
        document.getElementById("Appleavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else {
        var full = item + " x Apple " + price + " = " + total.toFixed(2);
        arraylist.push(full);
        var textnode = document.createTextNode(full);
        node.appendChild(textnode);
        document.getElementById("grand").innerHTML = "Grand Total = " + grandtotal.toFixed(2);
        document.getElementById("myList").appendChild(node);
    }
}

//Banana
function checkBanana() {
    var quantity = document.getElementById("Banana").value;
    if (quantity >= 50) {
        document.getElementById("Bananaavailable").innerHTML = "Delivery time may be longer because of large order.";
    }
    else {
        document.getElementById("Bananaavailable").innerHTML = "Item is in stock.";
    }
}
function addBanana(){
    var node = document.createElement("LI");
    var item = document.getElementById("Banana").value;
    var price = 0.57;
    total = price * item;
    grandtotal =  grandtotal + total;
    document.getElementById("Banana").value = "";
    if (item < 1) {
        document.getElementById("Bananaavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else if (item > 25){
        document.getElementById("Bananaavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else {
        var full = item + " x Garlic Parmesan Banana " + price + " = " + total.toFixed(2);
        arraylist.push(full);
        var textnode = document.createTextNode(full);
        node.appendChild(textnode);
        document.getElementById("grand").innerHTML = "Grand Total = " + grandtotal.toFixed(2);
        document.getElementById("myList").appendChild(node);
    }
}

//ROW 3
//Milk
function checkMilk() {
    var quantity = document.getElementById("Milk").value;
    if (quantity >= 50) {
        document.getElementById("Milkavailable").innerHTML = "Delivery time may be longer because of large order.";
    }
    else {
        document.getElementById("Milkavailable").innerHTML = "Item is in stock.";
    }
}
function addMilk(){
    var node = document.createElement("LI");
    var item = document.getElementById("Milk").value;
    var price = 4.10;
    total = price * item;
    grandtotal =  grandtotal + total;
    document.getElementById("Milk").value = "";
    if (item < 1) {
        document.getElementById("Milkavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else if (item > 25){
        document.getElementById("Milkavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else {
        var full = item + " x Milk " + price + " = " + total.toFixed(2);
        arraylist.push(full);
        var textnode = document.createTextNode(full);
        node.appendChild(textnode);
        document.getElementById("grand").innerHTML = "Grand Total = " + grandtotal.toFixed(2);
        document.getElementById("myList").appendChild(node);
    }
}

//Cheddar Cheese
function checkCheddarCheese() {
    var quantity = document.getElementById("Cheddar Cheese").value;
    if (quantity >= 50) {
        document.getElementById("CheddarCheeseavailable").innerHTML = "Delivery time may be longer because of large order.";
    }
    else {
        document.getElementById("CheddarCheeseavailable").innerHTML = "Item is in stock.";
    }
}
function addCheddarCheese(){
    var node = document.createElement("LI");
    var item = document.getElementById("Cheddar Cheese").value;
    var price = 3.76;
    total = price * item;
    grandtotal =  grandtotal + total;
    document.getElementById("Cheddar Cheese").value = "";
    if (item < 1) {
        document.getElementById("CheddarCheeseavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else if (item > 25){
        document.getElementById("CheddarCheeseavailable").innerHTML = "Quantity must be between 1 and 25.";
    }
    else {
        var full = item + " x Cheddar Cheese " + price + " = " + total.toFixed(2);
        arraylist.push(full);
        var textnode = document.createTextNode(full);
        node.appendChild(textnode);
        document.getElementById("grand").innerHTML = "Grand Total = " + grandtotal.toFixed(2);
        document.getElementById("myList").appendChild(node);
    }
}


