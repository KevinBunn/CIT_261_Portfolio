//
// Mouse Events
//
var clickParagraph = document.getElementById('click');
clickParagraph.addEventListener('click',() => console.log('click') ); clickParagraph.addEventListener('mousedown',() => console.log('down') ); clickParagraph.addEventListener('mouseup',() => console.log('up') );

// double click
var dblclickParagraph = document.getElementById('dblclick'); dblclickParagraph.addEventListener('dblclick', highlight);
// add the highlight class to the element
function highlight(event){ event.target.classList.toggle('highlight'); }

// mouse over
var mouseParagraph = document.getElementById('mouse'); mouseParagraph.addEventListener('mouseover', highlight); mouseParagraph.addEventListener('mouseout', highlight);
mouseParagraph.addEventListener('mousemove', () => console.log('You Moved!') )

//
// Keyboard events
//
addEventListener('keydown', (event) => console.log(`You pressed the ${event.key} character`));
addEventListener('keyup', (event) => console.log(`You stopped pressing the key on ${new Date}`));
addEventListener('keypress', (event) => console.log(`You pressed the ${event.key} character`));

//
// Touch events mobile
//
addEventListener('touchstart', () => console.log('Touch started');
addEventListener('touchend', () => console.log('Touch stopped');
// events.touches.length for how many fingers or touching
// events.touches[1]

//
// Event Propagation
//
// Bubbling
ulElement = document.getElementById('list'); liElement = document.querySelector('#list li');
ulElement.addEventListener('click', (event) => console.log('Clicked on ul') );
liElement.addEventListener('click', (event) => console.log('Clicked on li') );

// Capturing
// ulElement.addEventListener('click', (event) => console.log('Clicked on ul'),true);
// liElement.addEventListener('click', (event) => console.log('Clicked on li'),true);
