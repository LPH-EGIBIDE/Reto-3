class Chatter {
    id: number;
    name: string;
    avatar: string;
    unread: number;

    constructor(id: number, name: string, avatar: string, unread: number = 0) {
        this.id = id;
        this.name = name;
        this.avatar = avatar;
        this.unread = unread;
    }

    static fromJSON(json: object): Chatter {
        return new Chatter(json['id'], json['nombre']+ " " + json['apellido'], json['profile_picture'], json['unread_messages']);
    }

    static fromJSONList(json: object[]): Chatter[] {
        let chatters: Chatter[] = [];
        for (let i = 0; i < json.length; i++) {
            chatters.push(Chatter.fromJSON(json[i]));
        }
        return chatters;
    }
}

class Message {
    text: string;
    is_sender: boolean;
    date: Date;

    constructor(text: string, is_sender: boolean, date: Date) {
        this.text = text;
        this.is_sender = is_sender;
        this.date = date;
    }

    static fromJSON(json: object ): Message {
        return new Message(json['mensaje'], json['is_sender'], new Date(json['created_at']));
    }

    static fromJSONList(json: object[]): Message[] {
        let messages: Message[] = [];
        for (let i = 0; i < json.length; i++) {
            messages.push(Message.fromJSON(json[i]));
        }
        return messages;
    }
}

let chatterId: number = null;
let messageHistory: Message[] = [];

function sendMessage(action:string, formData: FormData) {
    if (formData.get('mensaje') == '' || formData.get('receiver_id') == "" || chatterId == null)
        return;
    fetch(action, {
        method: 'POST',
        body: formData
    }).then(function (response) {
        return response.json();
    }).then(function (json) {
        if (json.success){
            loadMessages(chatterId, true);
        } else {
            alert(json.error);
        }
    }).catch(function (error) {
        console.log(error);
    });
}



function loadMessages(id: number, force: boolean = false) {
    getMessages(id, force);
}

function getMessages(id: number,  force: boolean = false) {
    fetch('/mensajes/' + id).then(function (response) {
        return response.json();
    }).then(function (json) {
        if (json.success){
            loadMessagesList(json.chat, force);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


function loadMessagesList(json: object[], force: boolean = false) {
    //Query the server for the list of messages
    let messages: Message[] = Message.fromJSONList(json);
    if (!force && messageHistory.length == messages.length) {
        return;
    }
    messageHistory = messages;
    let messagesList = document.getElementById('messagesList') as HTMLUListElement;
    messagesList.innerHTML = '';
    //Reverse the messages to show the last one first´
    messages.reverse();
    for (let i = 0; i < messages.length; i++) {
        messagesList.innerHTML += messageTemplate(messages[i]);
    }
    messagesList.scrollTop = messagesList.scrollHeight;
}

function messageTemplate(message: Message): string {
    //<chat-bubble position="left" content="Mensaje recibido"></chat-bubble>

    let position = message.is_sender ? 'right' : 'left';
    let offset = message.is_sender ? 'offset-lg-6' : '';

    //return `<chat-bubble position="${position}" content="${message.text}"></chat-bubble>`;

    return `<div class="col-lg-6 ${offset}">
        <div class="chat-bubble chat-bubble--${position}">
      <span class="text-wrap text-break">
        ${message.text}
      </span>
        </div>
    </div>`;
}

function chatterTemplate(chatter: Chatter) {
    let li = document.createElement('li');
    li.classList.add('chatter');
    li.classList.add('mb-4');
    let img = document.createElement('img');
    img.width = 32;
    img.src = chatter.avatar;
    img.alt = chatter.name;
    img.classList.add('avatar');
    img.classList.add('rounded-circle');
    img.classList.add('me-3');

    let unread = document.createElement('span');
    unread.classList.add('badge');
    unread.classList.add('bg-danger');
    unread.classList.add('rounded-pill');
    unread.classList.add('mx-3');
    unread.innerText = String(chatter.unread);
    let span = document.createElement('span');
    span.classList.add('name');
    span.innerText = chatter.name;
    let hr = document.createElement('hr');
    li.appendChild(img);
    li.appendChild(span);
    if (chatter.unread > 0) {
        li.appendChild(unread);
    }
    li.appendChild(hr);
    li.addEventListener('click', function () {
        messageHistory = [];
        loadMessages(chatter.id, true);
        chatterId = chatter.id;
        let receiver_id = document.getElementById('receiver_id') as HTMLInputElement;
        receiver_id.value = String(chatter.id);
    });
    return li;
}

function loadChattersList(json: object[]) {
    //Query the server for the list of chatters
    let chatters: Chatter[] = Chatter.fromJSONList(json);
    console.log(chatters);
    let chattersList = document.getElementById('chattersList') as HTMLUListElement;
    chattersList.innerHTML = '';
    for (let i = 0; i < chatters.length; i++) {
        chattersList.appendChild(chatterTemplate(chatters[i]));
    }
}


function getChatters(){
    fetch('/mensajes/chats').then(function (response) {
        return response.json();
    }).then(function (json) {
        loadChattersList(json.chatters);
    }).catch(function (error) {
        console.log(error);
    });
}

function init() {
    getChatters();
    //Add a setInterval to get the messages every 2 seconds
    setInterval(function () {
        if (chatterId != null) {
            loadMessages(chatterId);
        }
    }, 2000);

    //Form submit
    let form = document.getElementById('messageForm') as HTMLFormElement;
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        let formData = new FormData(form);
        let mensaje = form.querySelector('textarea') as HTMLTextAreaElement;
        mensaje.value = '';

        sendMessage(form.action, formData);
    });

}

window.addEventListener('load', init);
