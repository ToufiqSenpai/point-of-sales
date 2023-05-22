import ModalInput from "../../../components/ModalInput"

// Table option section
Array.from(document.getElementsByClassName('table-option-dropdown')).forEach((el: HTMLElement): void => {
  const quantityButton = el.children[0].children[0] as HTMLButtonElement

  const modalQuantity = new ModalInput(el.children[1], {
    title: 'Edit Quantity',
    action: `/transaction/purchase-order?action=set_quantity`,
    type: 'number',
    name: 'quantity',
    defaultInput: el.getAttribute('data-quantity'),
    hiddenInput: {
      item_id: el.getAttribute('data-item-id')
    }
  })

  // Add event listener to "quantity button"
  quantityButton.addEventListener('click', () => modalQuantity.show())
})

// Quantity product select section
Array.from(document.getElementsByClassName('set-quantity-product')).forEach((el: HTMLElement): void => {
  const input = el.children[1] as HTMLInputElement,
  decrementBtn = el.children[0] as HTMLButtonElement,
  incrementBtn = el.children[2] as HTMLButtonElement

  decrementBtn.addEventListener('click', () => {
    if(parseInt(input.value) <= 1) return
    input.value = (parseInt(input.value) - 1).toString()
  })

  incrementBtn.addEventListener('click', () => input.value = (parseInt(input.value) + 1).toString())
})

// Form section
const forms = document.getElementsByTagName('form')
const url = new URLSearchParams(location.search)
let formSubmitting: boolean = false

for(const form of forms) {
  // When the querystring not have id param
  // Skip form with search field
  if(!url.get('id') && form.elements['search']) continue

  form.action = form.action + '&id=' + url.get('id')

  form.addEventListener('submit', () => {
    formSubmitting = true
  })
}

// Before unload alert section
const dltPoForm = document.getElementById('delete-po-form') as HTMLFormElement

window.addEventListener('beforeunload', e => {
  if(!formSubmitting) {
    const confirmMessage = "Are you sure want to leave this page? This order draft will deleted."
    e.returnValue = confirmMessage

    return confirmMessage
  }
})

window.addEventListener('unload', e => {
  if(!formSubmitting) {
    dltPoForm.submit()
  }
})

// Cash and change section
const cashInput = document.getElementById('cash-input') as HTMLInputElement,
changeInput = document.getElementById('change-input') as HTMLInputElement

cashInput.addEventListener('input', e => {
  changeInput.value = '$'.concat( cashInput.value ? (parseInt(cashInput.value) - parseInt(changeInput.getAttribute('data-subtotal'))).toString() : '0')
})

// Select supplier section
const supplierSelect = document.getElementById('supplier-select') as HTMLSelectElement,
supplierForm = document.getElementById('set-supplier-form') as HTMLFormElement,
supplierIdInput = supplierForm.children[0] as HTMLInputElement

supplierSelect.addEventListener('change', () => {
  supplierIdInput.value = supplierSelect.value
  supplierForm.submit()
})