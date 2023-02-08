class UserNotification {

    public id: number;
    public title: string;
    public description: string;
    public type: number;
    public url: string;
    public created_at: string;

    constructor(id: number, title: string, description: string, type: number, url : string, created_at: string) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.type = type;
        this.url = url;
        this.created_at = created_at;
    }

    public static fromJson(object: any): UserNotification {
        return new UserNotification(
            object.id,
            object.titulo,
            object.descripcion,
            object.tipo,
            object.url,
            object.created_at
        );
    }

    public static fromJsonArray(array: any[]): UserNotification[] {
        for (let i = 0; i < array.length; i++) {
            array[i] = UserNotification.fromJson(array[i]);
        }
        return array;
    }


    public createNotification(): string {
        return `<li class="d-flex justify-content-between noti-element">
                            <a href="${this.url}" class="top-text-block">
                                <div class="top-text-heading">
                                    <b>${this.title}</b>
                                </div>
                                <span class="top-text-description">${this.description}</span>
                            </a>
                            <button href="#" class="border-0 my-auto me-3 btn-noti" data-id="${this.id}">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </li>`;
    }

}


function fetchNotifications() {
    fetch('/notificaciones').then(response => {
        if (response.ok) {
            return response.json();
        }
    }).then(data => {
        if (data.data) {
            loadNotifications(data.data);
        }
    });
}

function loadNotifications(data: object[]) {
    let notificationList = document.getElementById('notification-list') as HTMLUListElement;
    notificationList.innerHTML = '';
    let notifications = UserNotification.fromJsonArray(data);

    if (notifications.length === 0) {
        notificationList.innerHTML = '<li class="d-flex justify-content-center text-primary">No hay notificaciones</li>';
    }

    notifications.forEach(notification => {
        notificationList.innerHTML += notification.createNotification();
    });

    let dismissButtons = document.getElementsByClassName('btn-noti');
    for (let i = 0; i < dismissButtons.length; i++) {
        dismissButtons[i].addEventListener('click', dismissNotification);
    }

}

function dismissNotification(event: Event) {
    let target = event.target as HTMLElement;
    let notificationId = target.parentElement.dataset['id'];

    //Get nearest parent with class .noti-element
    let notificationElement = target.closest('.noti-element');
    notificationElement.remove();

    fetch('/notificaciones/dismiss/' + notificationId).then(response => {
        if (response.ok) {
            return response.json();
        }
    }).then(data => {
        if (data && data.success) {
            fetchNotifications();
        }
    })
}


fetchNotifications();
setInterval(fetchNotifications, 10000);
