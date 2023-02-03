class ChatBubble extends HTMLElement {
    constructor() {
        super();
        let element : HTMLElement = <HTMLElement>document.getElementById('chat-bubble-template');
        if (element instanceof HTMLTemplateElement) {
            let template = <HTMLTemplateElement>element;
            let clone = document.importNode(template.content, true);
            this.appendChild(clone);
        }
    }

    static get observedAttributes(): string[] {
        return ['position', "content"];
    }

    private get position(): string | null {
        return this.getAttribute('position');
    }

    private set position(value: string | null) {
        this.setAttribute('position', <string>value);
    }

    get content(): string | null {
        return this.getAttribute('content');
    }

    set content(value: string | null) {
        this.setAttribute('content', <string>value);
    }

    attributeChangedCallback(name: string, oldValue: string, newValue: string) {
        if (name === "content") {
            this.querySelector("span").textContent = newValue;
        }
        if (name === 'position') {
            this.querySelector('.chat-bubble').classList.remove(
                'chat-bubble--right',
                'chat-bubble--left'
            );
            this.querySelector('.chat-bubble').classList.add(
                `chat-bubble--${newValue}`
            );
            this.querySelector('.col-lg-6').classList.toggle(
                'offset-lg-6',
                newValue === 'right'
            );
        }
    }
}

customElements.define('chat-bubble', ChatBubble);
