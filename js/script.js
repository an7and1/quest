//получаю элементы
let form = document.querySelector('.form');
let fields = form.querySelectorAll('.form-control');
let psw =  document.getElementById('psw');
let pswRepeat =  document.getElementById('pswRepeat');

//удаляю класс error кликом
for (const field of fields) {
    field.addEventListener('click', function() {
        field.classList.remove('error');
    })
}
//проверяю отсутствие незаполненных полей
let checkFieldsPresence = function () {
    let error = 0
    for (let i = 0; i < fields.length; i++) {
        if (!fields[i].value) {
            form[i].classList.add('error');
            error = 1
        }
    }
    return error === 0;
}

//проверяю совпадение паролей
let checkPasswordMatch = function () {
    if (psw.value !== pswRepeat.value) {
        psw.classList.add('error');
        pswRepeat.classList.add('error');
        return false;
    }
    return true;
}

//блокирую отправку формы при проваленной проверке
form.addEventListener('submit', function (event) {
    if (!(checkFieldsPresence() && checkPasswordMatch())){
        event.preventDefault()
    }
})