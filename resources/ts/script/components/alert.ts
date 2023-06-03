const alertDisplay = document.getElementById('alert')

if(alertDisplay) {
    alertDisplay.style.top = '3%'

    setTimeout(() => {
        alertDisplay.style.top = '-50%'
    }, 4000)
}

export {}
