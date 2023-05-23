const accordionsSidebar = document.getElementsByClassName('accordion-sidebar')

for(let i = 0; i < accordionsSidebar.length; i++) {
    const accordion = accordionsSidebar[i] as HTMLElement

    if(accordion.nextElementSibling) {
        const anchors = accordion.nextElementSibling.getElementsByTagName('a')

        for (const anchor of anchors) {
            if(anchor.getAttribute('href') == location.pathname) {
                const span = anchor.firstElementChild as HTMLElement

                span.style.width = '8px'
                span.style.height = '8px'
                span.style.backgroundColor = 'rgb(34 197 94)'
                span.style.marginRight = '22px'
                span.style.marginLeft = '14px'

                anchor.style.color = 'rgb(31 41 55)'
                anchor.parentElement.classList.remove('hover:bg-gray-100')

                accordion.style.backgroundColor = 'rgb(220 252 231)'
                accordion.style.color = 'rgb(34 197 94)'
                accordion.classList.remove('hover:bg-gray-100');

                (accordion.nextElementSibling as HTMLElement).style.maxHeight = `${accordion.nextElementSibling.scrollHeight}px`
            }
        }

        accordion.addEventListener('click', function(e) {
            const panel = this.nextElementSibling as HTMLElement
            if(panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        })
    } else {
        const href = accordion.getAttribute('href')

        if(href.endsWith(location.pathname)) {
            accordion.style.backgroundColor = 'rgb(220 252 231)'
            accordion.style.color = 'rgb(34 197 94)'
            accordion.classList.remove('hover:bg-gray-100')
        }
    }
}

export {}