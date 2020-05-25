window.addEventListener('online', updateOnLineStatus);
window.addEventListener('offline', updateOnLineStatus);

function updateOnLineStatus(event) {
    if (navigator.onLine) {
        sendNotification("Tu conexión a internet vuelve a ser estable", "onlineStatus");
    } else {
        sendNotification("Tu conexión a internet es inestable, te hemos perdido", "onlineStatus");
    }
}