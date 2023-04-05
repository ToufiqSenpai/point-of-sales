const alertDisplay = document.getElementById('alert')

if(alertDisplay) {
    alertDisplay.style.top = '3%'

    setTimeout(() => {
        alertDisplay.style.top = '-8%'
    }, 4000)
}

export {}
