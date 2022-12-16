let i = 0;

let input = document.getElementById( 'message' );

input.addEventListener( 'keydown', function(e) {
    if( e.code === "Enter" || e.code === "NumpadEnter" )
    {
        if( input.value != '' )
        {
            sendMessage();
        }
    }
} )

function openChat()
{
    let chat = document.getElementById( 'chatbox' );
    let button = document.getElementById( 'chat-button' );
    let box = document.getElementById( 'message-box' );
    let element = document.createElement( 'div' );
    let message = "Bonjour, je suis Billy votre assistant automatique. Que puis-je faire pour vous ?"

    chat.classList.remove( 'close-chatbox' );
    chat.classList.add( 'open-chatbox' );
    button.classList.remove('button-animation')
    button.classList.remove( 'open-button' );
    button.classList.add( 'hide-button' )
    // insertAdjacentHTML( "beforeend", "<img src='./assets/img/bot-logo.png' height='25' width='auto' class='picture-ai'><div class='message-ai'>" + message +"</div>" );
    if( i == 0 )
    {
        let date = new Date;
        date = date.toLocaleString()
        box.insertAdjacentHTML('beforeend', `<p id="date">${date}</p>`)
        element.classList.add( 'ai-box' );
        element.insertAdjacentHTML( "beforeend", "<img src='./assets/img/bot-logo.png' class='picture-ai'><div class='message-ai'>" + message +"</div>" );
        box.appendChild(element)
        i++;
    }
}

function closeChat()
{
    let chat = document.getElementById( 'chatbox' );
    let button = document.getElementById( 'chat-button' );

    chat.classList.add( 'close-chatbox' );
    chat.classList.remove( 'hide-chatbox' );
    chat.classList.remove( 'open-chatbox' );
    button.classList.remove( 'hide-button' );
    button.classList.add('button-animation')
    button.classList.add( 'open-button' );
}

function reset(){
    document.getElementById('message-box').innerHTML = ''
    i = 0
    openChat()
}

function sendMessage()
{
    let message = document.getElementById( 'message' );
    let box = document.getElementById( 'message-box' );
    let element = document.createElement( 'div' );
    let request = message.value;

    if( request != '' )
    {
        element.classList.add( 'user-box' );
        element.insertAdjacentHTML( "beforeend", "<div class='message-user'>" + message.value +"</div><img src='./assets/img/user.png' class='picture-user'>" );
        box.appendChild( element );
        message.value = "";

        aiInterpretation( request );
        box.scrollTop += 9999
    }
}

function aiInterpretation( request )
{
    let obj = { presentation: [ "bonjour", "suis", "salut"], deconnexion: [ "au revoir", "déco", "deco", "disconnected", "déconnexion", "deconnexion", "bye" ], search: [ "cherche", "voudrai", "voudrais", "voudrait", "veux", "article", "articles", "achat", "acheter", "renseignement", "aimerai", "veux", "souhaite", "souhaiterai" ] }
    let product = {}
    let result = { imax: 0, theme: '' }
    let split = request.toLowerCase().split( /[\s,'?!./]+/ )

    for( var key in split )
    {
        if( split[ key ] == '' )
        {
            split.splice( key, 1 );
        }
    }

    for( var prop in obj )
    {
        var keyword = `${ obj[ prop ] }`.split( /[,]+/ )
        var i = 0

        split.forEach( word => {
            var correspondance = keyword.indexOf( word )

            if( correspondance > -1 )
            {
                i++
            }
        } );

        if( i > 0 && result.imax < i )
        {
            result.imax = i;
            result.theme = `${ prop }`
        }
    }

   return iaResponse( result )
}

function iaResponse( request )
{
    let message = '';
    let box = document.getElementById( 'message-box' );
    let element = document.createElement( 'div' );
    let articles = [ 'nike', 'addidas', 'puma', 'reebok' ];

    switch ( request.theme ){
        case ( 'presentation' ):
            message = "Enchanté, je suis arAI, à votre service."
            break;
        case ( 'deconnexion' ):
            message = "À la prochaine ! 😊"
            break;
        case ( 'search' ):
            message = "Vous recherchez un article en particulier. Quel marque vous intéresse ?<p>Marques disponibles:</p>";
            articles.forEach( marque => { message += "<button type='button' class='marque' value='" + marque + "'>" + marque + "</button><br>" } )
            break;
        default:
            message = "Désolé, je n'ai pas compris votre message.";
            break;
        }
    element.classList.add( 'ai-box' );
    document.getElementById('message').setAttribute('readonly', 'readonly')
    element.insertAdjacentHTML( "beforeend", "<img src='./assets/img/bot-logo.png' class='picture-ai'><div class='message-ai'><img src='./assets/img/loading.png' class='loading'></div>" );
    box.appendChild( element );
    box.scrollTop += 9999
    setTimeout(()=>{
        element.innerHTML = ''
        element.insertAdjacentHTML( "beforeend", "<img src='./assets/img/bot-logo.png' class='picture-ai'><div class='message-ai'>" + message +"</div>" );
        box.appendChild( element );
        document.getElementById('message').removeAttribute('readonly')
        box.scrollTop += 9999
    }, 2500)
}