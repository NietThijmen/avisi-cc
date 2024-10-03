const wrapper = document.createElement("div");

const generateNotification = (message: string, type: string) => {
    const notification = document.createElement("div");
    switch (type) {
        case "success":
            notification.style.backgroundColor = "#28a745";
            break;
        case "error":
            notification.style.backgroundColor = "#dc3545";
            break;
        case "info":
            notification.style.backgroundColor = "#007bff";
        default:
            console.warn(`${type} is not a valid notification type. Defaulting to info.`);
            notification.style.backgroundColor = "#007bff";
    }

    notification.style.color = "#fff";
    notification.style.padding = "10px";
    notification.style.marginBottom = "10px";
    notification.style.borderRadius = "5px";
    notification.style.boxShadow = "0 0 10px rgba(0, 0, 0, 0.1)";
    notification.style.minWidth = "200px";
    notification.style.maxWidth = "300px";
    notification.style.transition = "all 0.25s ease-in-out";
    notification.style.right = "-300px";

    notification.style.opacity = "0";
    notification.style.right = "-300px";
    notification.style.position = "relative";


    notification.innerText = message;

    // add a small progress bar to the notification

    const progress = document.createElement("div");
    progress.style.height = "5px";
    progress.style.width = "0%";
    progress.style.backgroundColor = "#fff";
    progress.style.marginTop = "5px";

    notification.appendChild(progress);

    wrapper.prepend(notification);

    notification.animate([
        {right: "-300px", opacity: 0},
        {right: "0px", opacity: 1}
    ], {
        duration: 250,
        fill: "forwards"
    });

    progress.animate([
        {width: "0%"},
        {width: "100%"}
    ], {
        duration: 5000,
        fill: "forwards"
    });

    setTimeout(() => {
        notification.animate([
            { right: "0px", opacity: 1 },
            { right: "-300px", opacity: 0}
        ], {
            duration: 250,
            fill: "forwards"
        });

        setTimeout(() => {
            wrapper.removeChild(notification);
        }, 250);
    }, 5000);
}

window.addEventListener('load', () => {
    wrapper.style.position = "fixed";
    wrapper.style.top = "10px";
    wrapper.style.right = "10px";
    wrapper.style.zIndex = "9999";
    wrapper.classList.add("transition-all");

    document.body.appendChild(wrapper);

    console.info("Notification system initialized");
});

window.addEventListener("notification", (event: CustomEvent) => {
    generateNotification(event.detail.message, event.detail.type);
});

// @ts-ignore
window.notifications = {
    notify: generateNotification
};
