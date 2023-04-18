document.addEventListener('DOMContentLoaded', ()=>{
    const btn = document.getElementById('envoyer')
    btn.addEventListener('click', ()=>{
        let message = getMessage();
        display(message, 'user')
        response(message).then(result =>{
            display(result, 'bot')
        })
    .catch(error=>{
            display('je ne comprend pas votre message désolé veuillez reformulez')
        })
    })
})

function display(string, people){
    const box = document.getElementById('box')
    box.insertAdjacentHTML('beforeend', '<div> <b>' + people + '</b>' + string + '</div>')
}

function response(message){

    return  fetch('src/chatApi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            message: message,
            method: 'returnRespons'
        })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                return data.result;

            } else {
                console.error(data.error);
            }
        })
        .catch(error => console.log(error));
}

function getMessage(){
    let input = document.getElementById('message')
    console.log(input.value)
    return input.value
}
