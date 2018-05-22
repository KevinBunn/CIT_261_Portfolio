var listOne = document.getElementById("1");
var listTwo = document.getElementById("2");
var listThree = document.getElementById("3");

var colors = ["blue", "green", "orange", "pink", "not yellow"];
var objects = [listOne, listTwo, listThree];

for (let i = 0; i < objects.length; i++) {
    console.log(objects[i].innerHTML);
}

for (let i = 0; i < colors.length; i++) {
    console.log(colors[i] + "\n");
}