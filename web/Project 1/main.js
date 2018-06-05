var taskRow = document.getElementsByClassName("tf-task-content-row");

function arrowDrag(event) {
  event.preventDefault();
  console.log("dragging");
}

for (let taskContent of taskRow) {
	taskContent.addEventListener("touchstart", function(event) {
    let touches = event.touches;
		if (!taskContent.querySelector('div')) {
			let newContent = document.createElement('div');
      newContent.style.marginLeft = Math.round((touches[0].pageX - 70)/101)*101;
			newContent.className = "task-content";
      let leftArrowDiv = document.createElement('div');
      leftArrowDiv.className = "task-section-arrow-left";
      let leftArrow = document.createElement('div');
      leftArrow.className = "task-arrow-left";
      //leftArrow.style.paddingTop = (littleTing.clientHeight/2);
      leftArrow.innerHTML = "&#8592";
      leftArrow.addEventListener("touchmove", arrowDrag, false);
      leftArrowDiv.appendChild(leftArrow);
      newContent.appendChild(leftArrowDiv);
      let rightArrowDiv = document.createElement('div');
      rightArrowDiv.className = "task-section-arrow-right";
      let rightArrow = document.createElement('div');
      rightArrow.addEventListener("touchmove", arrowDrag, false);
      rightArrow.innerHTML = "&#8594";
      rightArrow.classList = "task-arrow-right";
      rightArrowDiv.appendChild(rightArrow);
      newContent.appendChild(rightArrowDiv);
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

