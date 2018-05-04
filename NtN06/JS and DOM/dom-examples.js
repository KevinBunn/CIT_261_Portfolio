const heroes = document.getElementsByClassName('hero');
document.getElementsByClassName('villain').length; 

// instead of document.getElementById()
document.querySelector('#bats'); 

// alternate of getElementsByClassName
document.querySelectorAll('.hero');

// last item in a list
const wonderWoman = document.querySelector('li:last-child');

// grab any element
const ul = document.querySelector('ul#roster');
// grab another to traverse down farther
const batman = ul.querySelector('li#bats')

//
// DOM is a tree we can navagate
//
const heroes = document.getElementById('roster');
heroes.childNodes // returns all nodes, each space is a text node
heroes.children // this will only contain list item
heroes.firstChild 
heroes.lastChild


wonderWoman.previousSibling
wonderWoman.nextSibling

wonderWoman.setAttribute('id','amazon');
wonderWoman.getAttribute('id');
// << 'amazon'

//
// Classes
//
wonderWoman.classList // returnes all classes
wonderWoman.classList.add('warrior');
wonderWoman.classList.remove('warrior');

// Toggle adds a class if it isn't there already, or removes if already there
wonderWoman.classList.toggle('hero');

wonderWoman.classList.contains('hero');

//
// Dynamic Markup
//
const flash = document.createElement('li'); // empty element
const flashText = document.createTextNode('Flash'); // text for empty element
flash.appendChild(flashText); // add it to element.
// OR simpler
const flash = document.createElement('li'); 
flash.textContent = 'Flash';

// ideally create a function for this
function createElement (tag,text) { 
    const el = document.createElement(tag); 
    el.textContent = text; 
    return el 
}
const aquaman = createElement('li','Aquaman');

heroes.insertBefore(aquaman,wonderWoman);
heroes.removeChild(aquaman);
heroes.appendChild(aquaman);

//
// Updating CSS
//
const heroes = document.getElementById('roster'); 
const superman = heroes.children[0];
superman.style.border = "red 2px solid";
superman.style['background color'] = 'blue';
superman.style.display = 'none'; // quick hide

// Return all styles
getComputedStyle(superman);
// can get more specific
getComputedStyle(superman).getPropertyCSSValue('color').cssText;
// https://developer.mozilla.org/en-US/docs/Web/API/CSSStyleDeclaration









