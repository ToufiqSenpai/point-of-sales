// import ModalDelete from "../../../components/ModalDelete"
import ModalInput from "../../../components/ModalInput"

// Date section
const transactionDate = document.getElementById('transaction-date')

const today = new Date()

transactionDate.innerHTML = `${String(today.getDate()).padStart(2, '0')}-${String(today.getMonth() + 1).padStart(2, '0')}-${today.getFullYear()}`
transactionDate.setAttribute('datetime', today.toISOString())

// Table option section
const optionContainers = document.getElementsByClassName('table-option-dropdown')

for(const optionContainer of optionContainers) {
  const modalDiscount = new ModalInput(optionContainer.getElementsByClassName('modal-discount')[0])
  const modalQuantity = new ModalInput(optionContainer.getElementsByClassName('modal-quantity')[0])

  const menuDropdown = (optionContainer.children[1] as HTMLElement)

  optionContainer.firstElementChild.addEventListener('click', e => {
    if(menuDropdown.style.display == 'none') {
      menuDropdown.style.display = 'block'
    } else {
      menuDropdown.style.display = 'none'
    }
  })
}