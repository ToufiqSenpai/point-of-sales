// Invoice datetime section
const invoiceDatetime = document.getElementById('invoice-datetime') as HTMLTimeElement
invoiceDatetime.innerHTML = new Date(invoiceDatetime.dateTime).toLocaleDateString().replaceAll('/', '-')

// Print button section
const printBtn = document.getElementById('print-btn')

printBtn.addEventListener('click', () => window.print())