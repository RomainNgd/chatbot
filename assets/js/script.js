let i = 0;

let input = document.getElementById( 'message' );
const scroller = document.getElementById( 'message-box' );
const select = document.getElementById( 'palette' );

input.addEventListener( 'keydown', function(e) {
    if( e.code === "Enter" || e.code === "NumpadEnter" )
    {
        if( input.value != '' )
        {
            sendMessage();
        }
    }
} )

palette.addEventListener( 'change', function(){
    selectColor();
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
    button.classList.remove('button-animation-hover')
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
        element.insertAdjacentHTML( "beforeend", '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48.22 48" class="picture-ai"><defs><style>.cls-1{fill:#fff;}.cls-2{fill:#7b39eb;}.cls-2,.cls-3,.cls-4{stroke:#fff;stroke-miterlimit:10;}.cls-3{fill:none;}.cls-4{fill:#ffbf85;stroke-width:2px;}</style></defs><g id="fond_icone"><path class="cls-2" d="M33.65,3.72H14.88C7.11,3.72,.81,10.02,.81,17.8v4.21c0,4.82,2.43,9.08,6.13,11.61v7.38l7.73-4.93c.07,0,.15,.01,.22,.01h18.77c7.77,0,14.07-6.3,14.07-14.07v-4.21c0-7.77-6.3-14.07-14.07-14.07Z"/><ellipse class="cls-2" cx="24" cy="42.47" rx="4.19" ry="1.91"/></g><g id="Calque_2"><rect class="cls-3" x="4.88" y="12.15" width="38.17" height="16.98" rx="8.49" ry="8.49"/><g><g><circle class="cls-4" cx="12.76" cy="19.36" r="3.32"/><circle class="cls-4" cx="35.17" cy="19.36" r="3.32"/></g><path class="cls-1" d="M19.02,24.34c3.62,1.81,6.48,2.04,9.89,0-1.93,4.07-7.81,3.77-9.89,0h0Z"/></g></g></svg><div class="message-ai">' + message +"</div>" );
        box.appendChild(element)
        i++;
    }
}

function closeChat()
{
    let chat = document.getElementById( 'chatbox' );
    let button = document.getElementById( 'chat-button' );

    chat.classList.add( 'close-chatbox' );
    chat.classList.remove( 'hide-chatbox', 'open-chatbox' );
    button.classList.remove( 'hide-button' );
    button.classList.add('button-animation', 'open-button')
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
    let request = escapeHtml( message.value);

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
            message = "Enchanté, je suis Billy, à votre service."
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
    element.insertAdjacentHTML( "beforeend", '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48.22 48" class="picture-ai"><defs><style>.cls-1{fill:#fff;}.cls-2{fill:#7b39eb;}.cls-2,.cls-3,.cls-4{stroke:#fff;stroke-miterlimit:10;}.cls-3{fill:none;}.cls-4{fill:#ffbf85;stroke-width:2px;}</style></defs><g id="fond_icone"><path class="cls-2" d="M33.65,3.72H14.88C7.11,3.72,.81,10.02,.81,17.8v4.21c0,4.82,2.43,9.08,6.13,11.61v7.38l7.73-4.93c.07,0,.15,.01,.22,.01h18.77c7.77,0,14.07-6.3,14.07-14.07v-4.21c0-7.77-6.3-14.07-14.07-14.07Z"/><ellipse class="cls-2" cx="24" cy="42.47" rx="4.19" ry="1.91"/></g><g id="Calque_2"><rect class="cls-3" x="4.88" y="12.15" width="38.17" height="16.98" rx="8.49" ry="8.49"/><g><g><circle class="cls-4" cx="12.76" cy="19.36" r="3.32"/><circle class="cls-4" cx="35.17" cy="19.36" r="3.32"/></g><path class="cls-1" d="M19.02,24.34c3.62,1.81,6.48,2.04,9.89,0-1.93,4.07-7.81,3.77-9.89,0h0Z"/></g></g></svg><div class="message-ai"><img src="./assets/img/loading.png" class="loading"></div>' );
    box.appendChild( element );
    box.scrollTop += 9999
    setTimeout(()=>{
        element.innerHTML = ''
        element.insertAdjacentHTML( "beforeend", '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48.22 48" class="picture-ai"><defs><style>.cls-1{fill:#fff;}.cls-2{fill:#7b39eb;}.cls-2,.cls-3,.cls-4{stroke:#fff;stroke-miterlimit:10;}.cls-3{fill:none;}.cls-4{fill:#ffbf85;stroke-width:2px;}</style></defs><g id="fond_icone"><path class="cls-2" d="M33.65,3.72H14.88C7.11,3.72,.81,10.02,.81,17.8v4.21c0,4.82,2.43,9.08,6.13,11.61v7.38l7.73-4.93c.07,0,.15,.01,.22,.01h18.77c7.77,0,14.07-6.3,14.07-14.07v-4.21c0-7.77-6.3-14.07-14.07-14.07Z"/><ellipse class="cls-2" cx="24" cy="42.47" rx="4.19" ry="1.91"/></g><g id="Calque_2"><rect class="cls-3" x="4.88" y="12.15" width="38.17" height="16.98" rx="8.49" ry="8.49"/><g><g><circle class="cls-4" cx="12.76" cy="19.36" r="3.32"/><circle class="cls-4" cx="35.17" cy="19.36" r="3.32"/></g><path class="cls-1" d="M19.02,24.34c3.62,1.81,6.48,2.04,9.89,0-1.93,4.07-7.81,3.77-9.89,0h0Z"/></g></g></svg><div class="message-ai">' + message +"</div>" );
        box.appendChild( element );
        document.getElementById('message').removeAttribute('readonly')
        box.scrollTop += 9999
    }, 2500)
}

function selectColor()
{
    let palette = document.getElementById( 'palette' )
    let r = document.querySelector( ':root' )
    let rs = getComputedStyle( r )

    switch( palette.value ){
        case ( 'violet' ):
            r.style.setProperty('--light-color', '#f0f2f5')
            r.style.setProperty('--main-color', '#857dff')
            r.style.setProperty('--main-dark-color', '#7B39EB')
            r.style.setProperty('--gray-color', '#e4e6eb')
            break
        case ( 'vert' ):
            r.style.setProperty('--light-color', '#f1f5f0')
            r.style.setProperty('--main-color', '#7fff7d')
            r.style.setProperty('--main-dark-color', '#12b50d')
            r.style.setProperty('--gray-color', '#e6ebe4')
            break
        case ( 'bleu' ):
            r.style.setProperty('--light-color', '#f1f5f0')
            r.style.setProperty('--main-color', '#4538ff')
            r.style.setProperty('--main-dark-color', '#397aeb')
            r.style.setProperty('--gray-color', '#e6ebe4')
            break
    }
}

function escapeHtml( text ) {
    var map = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#039;'
    };
    
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}