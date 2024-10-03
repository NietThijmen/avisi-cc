let preloadedLinks: string[] = [];
window.addEventListener('load', () => {
    const anchors = document.querySelectorAll('a');

    console.info(`Preload initialized for ${anchors.length} anchors`);

    anchors.forEach((anchor) => {
        anchor.addEventListener('mouseover', () => {
            if (anchor.hasAttribute('href')) {
                const href = anchor.getAttribute('href') as string;

                if(preloadedLinks.indexOf(href) !== -1) {
                    return;
                }

                const preloadLink = document.createElement('link');
                preloadLink.rel = 'prefetch';
                preloadLink.href = href;
                document.head.appendChild(preloadLink);

                console.info(`Preloaded ${href}`);

                preloadedLinks.push(href);
            }
        });
    });
});
