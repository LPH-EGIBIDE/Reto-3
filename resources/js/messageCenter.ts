class Chatter {
    id: number;
    name: string;
    avatar: string;

    constructor(id: number, name: string, avatar: string) {
        this.id = id;
        this.name = name;
        this.avatar = avatar;
    }

    static fromJSON(json: object): Chatter {
        return new Chatter(json['id'], json['name'], json['avatar']);
    }

    static fromJSONList(json: object[]): Chatter[] {
        let chatters: Chatter[] = [];
        for (let i = 0; i < json.length; i++) {
            chatters.push(Chatter.fromJSON(json[i]));
        }
        return chatters;
    }

    static getChattersList(): Chatter[] {
        //Fetch request to the server with fetch API
        return [];

    }
}

function getChatterList() {
    //Fetch request to the server with fetch API


}

function chatterTemplate(chatter: Chatter) {
    return `
        <li class="chatter">
            <a href="/message-center/${chatter.id}">
                <img src="${chatter.avatar}" alt="${chatter.name}" class="avatar">
                <span class="name">${chatter.name}</span>
            </a>
        </li>
    `;
}

function loadChattersList() {
    //Query the server for the list of chatters
    let chattersList = document.getElementById('chattersList') as HTMLUListElement;
}
