var taskRow = document.getElementsByClassName("tf-task-content-row");

for (let taskContent of taskRow) {
	taskContent.addEventListener("touchstart", function() {
		if (!taskContent.contains(task)) {
			let newContent = document.createElement('div');
			newContent.className = "task-content";
			taskContent.appendChild(newContent);
		}
	});
}

// const hikelist = [
// 	{
// 	name: 'Kevin',
// 	imgSrc: 'gargib',
// 	imgAlt: 'image that is fake',
// 	distance: '3 miles',
// 	difficulty: 'easy',
// 	decription: 'soo sick hike',
// 	directions: 'just around the riverbend'
// 	}
// ]

// for (let taskContent of taskRow) {
// 	taskContent.addEventListener("touchstart", function() {
// 		console.log("click");
// 		elementToChange = document.getElementById("random-stuff");
// 		let ul = document.createElement('ul');
// 		let item = document.createElement('li');
// 		let image = document.createElement('img');
// 		image.src = hikelist.imgSrc;
// 		image.alt = hikelist.imgAlt;
// 		item.appendChild(image);
// 		ul.appendChild(item);
// 		elementToChange.appendChild(ul);
// 	});
// }

//var listOne = document.getElementById("1");
//var listTwo = document.getElementById("2");
//var listThree = document.getElementById("3");
//
//var colors = ["blue", "green", "orange", "pink", "not yellow"];
//var objects = [listOne, listTwo, listThree];
//var numbers = [1,5,345,3434,23423];
//
//for (let object of objects) {
//    console.log(object.innerHTML);
//}
//
//for (let i = 0; i < colors.length; i++) {
//    console.log(colors[i] + "\n");
//}

//const newArray = numbers.map(function(number){
//  return number * -1;
//});
//console.log(newArray);
//
// ***OR***
//
//const negatives = numbers.map(number => number * -1);
//console.log(negatives);

