debugger;


const calculator = {
    number1: 0,
    number2: 0,
    operation: '',
    inputOutput: document.getElementById('calcInput'),
    clear: function() {
        this.inputOutput.value = "";
    },
    add: function() {
        this.inputOutput.value = parseFloat(this.number1) + parseFloat(this.number2);
    },
    subtract: function() {
        this.inputOutput.value = parseFloat(this.number1) - parseFloat(this.number2);
    },
    divide: function() {
        this.inputOutput.value = parseFloat(this.number1) / parseFloat(this.number2);
    },
    multiply: function() {
        this.inputOutput.value = parseFloat(this.number1) * parseFloat(this.number2);
    },
    equals: function(button) {
        console.log("value: " + button.value + "operation: " + this.operation);
        number2 = this.inputOutput.value;
        switch (this.operation) {
            case '/':
                this.divide();
                break;
            case 'X':
                console.log("i am here");
                this.multiply();
                break;
            case '-':
                this.subtract();
                break;
            case '+':
                this.add();
                break;
            default:
                console.log("you're all noobs");
        }
    },
    buttonClicked: function buttonClicked(button) {
      console.log(button.target.innerHTML);

      switch (button.target.innerHTML) {
        case 'M':
          break;
        case 'C':
            this.clear();
            break;
        case '/':
        case 'X':
        case '-':
        case '+':
            this.number1 = this.inputOutput.value;
            this.clear();
            this.operation = button.innerHTML;
            break;
        case '=':
              this.equals(button);
          break;
        default:
          //if it made it to here it's a number
         this.inputOutput.value = this.inputOutput.value + button.target.innerHTML;
      }
    }
};

const buttonContainer = document.querySelector(".calcButtons");
buttonContainer.addEventListener('click', (event) => calculator.buttonClicked(event));
