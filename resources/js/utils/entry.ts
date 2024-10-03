// @ts-ignore
declare global {
    interface Window {
        notifications: {
            notify: (message: string, type: string) => void
        }
    }
}

import './betterLogger'
import './chartLoader'
import './copyButton'
import './notifications'
import './humanReadableTimestamps'
import './preload'
