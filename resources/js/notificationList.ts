class UserNotification {

    public id: number;
    public title: string;
    public description: string;
    public type: number;
    public created_at: string;

    constructor(id: number, title: string, description: string, type: number, created_at: string) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.type = type;
        this.created_at = created_at;
    }

    public static fromJson(object: any): UserNotification {
        return new UserNotification(
            object.id,
            object.title,
            object.description,
            object.type,
            object.created_at
        );
    }

    public static fromJsonArray(array: any[]): UserNotification[] {
        return array.map(UserNotification.fromJson);
    }

    public createNotification(): HTMLLIElement {
        return document.createElement('li');
    }

}


function fetchNotifications() {
    fetch('/notificaciones').then(response => {
        if (response.ok) {
            return response.json();
        }
    }).then(data => {
        if (data) {
            loadNotifications(data);
        }
    });
}

function loadNotifications(data: object[]) {
    let notificationList = document.getElementById('notification-list') as HTMLUListElement;
    notificationList.innerHTML = '';
    let notifications = UserNotification.fromJsonArray(data);
    notifications.forEach(notification => {
        notificationList.appendChild(notification.createNotification());
    });
}

function createNotification(notification: object) {
    let li = document.createElement('li');
    li.className = 'list-group-item';
    li.innerHTML = notification['message'];
    return li;
}

function dismissNotification(event: Event) {
    let target = event.target as HTMLElement;
    let notificationId = target.parentElement.dataset['id'];
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



setInterval(fetchNotifications, 10000);
