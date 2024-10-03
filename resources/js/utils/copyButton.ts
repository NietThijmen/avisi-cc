window.addEventListener('load', () => {
    const elements = document.querySelectorAll('[data-copy]');

    console.info(`Copy button initialized for ${elements.length} elements`);

    elements.forEach((element) => {
        element.addEventListener('click', () => {
            const target = element.getAttribute('data-copy');
            navigator.clipboard.writeText(target);

            // @ts-ignore
            window.notifications.notify('Copied to clipboard', 'success');
        });
    });
})
