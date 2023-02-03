class ChatBubble extends HTMLElement {
    constructor() {
        super();
        this.appendChild(document.getElementById('chat-bubble-template').content.cloneNode(true));
    }
    static get observedAttributes() {
        return ['position', "content"];
    }
    get position() {
        return this.getAttribute('position');
    }
    set position(value) {
        this.setAttribute('position', value);
    }
    get content() {
        return this.getAttribute('content');
    }
    set content(value) {
        this.setAttribute('content', value);
    }
    attributeChangedCallback(name, oldValue, newValue) {
        if (name === "content") {
            this.querySelector("span").textContent = newValue;
        }
        if (name === 'position') {
            this.querySelector('.chat-bubble').classList.remove('chat-bubble--right', 'chat-bubble--left');
            this.querySelector('.chat-bubble').classList.add(`chat-bubble--${newValue}`);
            this.querySelector('.col-lg-6').classList.toggle('offset-lg-6', newValue === 'right');
        }
    }
}
customElements.define('chat-bubble', ChatBubble);
