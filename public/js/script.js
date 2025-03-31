document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('index');
    const inputText = document.getElementById('indexs');

    const button1 = document.getElementById('addBtn')
    if(button1) {
        button1.addEventListener('click', function() {
            const newInput = input.textContent = parseInt(input.textContent) + 1;
            inputText.value = newInput; 
        })
    }

    const button2 = document.getElementById('Button')
    if(button2) {
        button2.addEventListener('click', function() {
            if(input.textContent > 1) {
            const newInput = input.textContent = parseInt(input.textContent) - 1;
            inputText.value = newInput;
            }
        })
    }
})
