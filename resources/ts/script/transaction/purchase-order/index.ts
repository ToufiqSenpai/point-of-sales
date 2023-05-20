import ModalInput from "../../../components/ModalInput"
import clickOutsideCloser from "../../../utils/clickOutsideCloser"

// Form section
const forms = document.getElementsByTagName('form')
const url = new URLSearchParams(location.search)

for(const form of forms) {
  // When the querystring not have id param
  // Skip form with search field
  if(!url.get('id') && form.elements['search']) continue

  form.action = form.action + '&id=' + url.get('id')
}

// Table option section
Array.from(document.getElementsByClassName('table-option-dropdown')).forEach((el: HTMLElement): void => {
  const quantityButton = el.children[0].children[0] as HTMLButtonElement

  const modalQuantity = new ModalInput(el.children[1], {
    title: 'Edit Quantity',
    action: `/transaction/purchase-order?id=${url.get('id')}&action=set_quantity`,
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