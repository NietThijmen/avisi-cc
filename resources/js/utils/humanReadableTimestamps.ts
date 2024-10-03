const updateTimeForElement = (element: Element) => {
    const timestamp = element.getAttribute('data-timestamp')
    let date = new Date(timestamp)
    date = new Date(date.getTime() - date.getTimezoneOffset() * 60000)

    // Format the date like:
    // 5 seconds ago
    // 5 minutes ago
    // 5 hours ago
    // 5 days ago
    // 5 months ago

    const now = new Date()
    const diff = now.getTime() - date.getTime()
    const seconds = Math.floor(diff / 1000)
    const minutes = Math.floor(seconds / 60)
    const hours = Math.floor(minutes / 60)
    const days = Math.floor(hours / 24)
    const months = Math.floor(days / 30)


    let humanReadable = ''

    if (months > 0) {
        humanReadable = `${months} months ago`
    } else if (days > 0) {
        humanReadable = `${days} days ago`
    } else if (hours > 0) {
        humanReadable = `${hours} hours ago`
    } else if (minutes > 0) {
        humanReadable = `${minutes} minutes ago`
    } else {
        humanReadable = `${seconds} seconds ago`
    }

    // @ts-ignore
    element.innerText = humanReadable
}

window.addEventListener('load', () => {
    const elements = document.querySelectorAll('[data-timestamp]')
    console.info(`Human readable timestamps found: ${elements.length}`)

    elements.forEach(element => {
        updateTimeForElement(element)
    })

    setInterval(() => {
        elements.forEach(element => {
            updateTimeForElement(element)
        })
    }, 1000)
})
