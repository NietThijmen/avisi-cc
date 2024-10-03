// overwrite console.info with a custom function
console.info = (message) => {
    console.log(`%c[INFO]: ${message}`, 'color: #3498db');
}

// overwrite console.error with a custom function
console.error = (message) => {
    console.log(`%c[ERROR]: ${message}`, 'color: #e74c3c');
}

// overwrite console.warn with a custom function
console.warn = (message) => {
    console.log(`%c[WARNING]: ${message}`, 'color: #f39c12');
}


console.info("Better logger initialized");
