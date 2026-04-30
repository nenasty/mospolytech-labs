let expr = '';//нажимаешь на кнопки строка идет сюда

function press(val) {//val — это символ который передаёт кнопка
    if (val === '()') {
        let open = (expr.match(/\(/g) || []).length; //expr.match -ищет скобки и возвр массив
        let close = (expr.match(/\)/g) || []).length;
        val = open > close ? ')' : '(';
    }
    expr += val;//"2+3", нажали 5 стало "2+35"
    document.getElementById('display').value = expr;
}

function clearDisplay() {
    expr = ''; //чищает данные в памяти
    document.getElementById('display').value = '';//очищает то что видно на экране
}

document.addEventListener('keydown', function(e) { //следи за нажатием клавишт(е-инф о нажатой кнопки)
    if (e.key >= '0' && e.key <= '9') press(e.key);
    else if (e.key === '+') press('+');
    else if (e.key === '-') press('-');
    else if (e.key === '*') press('*');
    else if (e.key === '/') { e.preventDefault(); press('/'); }//умолчанию открывает поиск по странице при /
    else if (e.key === '(') press('(');
    else if (e.key === ')') press(')');
    else if (e.key === '.') press('.');
    else if (e.key === '^') press('^');
    else if (e.key === '!') press('!');
    
    else if (e.key === 'Enter') {
        document.querySelector('form').submit();//найди форму отправь через метод на сервер
    }

    else if (e.key === 'Backspace') {
        expr = expr.slice(0, -1);
        document.getElementById('display').value = expr; //удали и покажи новое знач на экране
    }
    
    else if (e.key === 'Escape') clearDisplay();
});