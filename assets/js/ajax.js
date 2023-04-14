document.addEventListener('DOMContentLoaded', ()=>{
    const btn = document.getElementById('envoyer')
    btn.addEventListener('click', ()=>{
        let message = getMessage();
        display(message, 'user')
        let reponse = response(message)
        display(reponse, 'bot')

    })
})

function display(string, people){
    const box = document.getElementById('box')
    box.insertAdjacentHTML('beforeend', '<div> <b>' + people + '</b>' + string + '</div>')
}

async function response(message){

    let reponse
    await fetch('src/chatApi.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            method: 'myMethod'
        })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                reponse = data.result
                console.log(reponse)

            } else {
                console.error(data.error);
            }
        })
        .catch(error => console.log(error));
    return reponse
}

function getMessage(){
    let input = document.getElementById('message')
    console.log(input.value)
    return input.value
}
