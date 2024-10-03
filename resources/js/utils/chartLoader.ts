window.addEventListener('DOMContentLoaded', () => {
    const chartComponents = document.querySelectorAll('.chart-component');
    if(chartComponents.length === 0) return;

    // @ts-ignore
    import('chart.js/auto').then(Chart => {
        document.dispatchEvent(new CustomEvent('chart:init', {detail: Chart}));

        console.info(`Chart.js initialized (rendering ${chartComponents.length} charts)`);
    })
})
