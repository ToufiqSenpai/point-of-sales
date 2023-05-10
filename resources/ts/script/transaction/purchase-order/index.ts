// import ModalDelete from "../../../components/ModalDelete"
import ModalInput from "../../../components/ModalInput"
import clickOutsideCloser from "../../../utils/clickOutsideCloser"

// Date section
const transactionDate = document.getElementById('transaction-date')

const today = new Date()

transactionDate.innerHTML = `${String(today.getDate()).padStart(2, '0')}-${String(today.getMonth() + 1).padStart(2, '0')}-${today.getFullYear()}`
transactionDate.setAttribute('datetime', today.toISOString())

// Table option section
const optionContainers = document.getElementsByClassName('table-option-dropdown')

for(const optionContainer of optionContainers) { 
  const modalQuantity = new ModalInput(optionContainer.children[2])
  const modalDiscount = new ModalInput(optionContainer.children[3])

  const menuDropdownBtn = (optionContainer.children[0] as HTMLElement)
  const menuDropdown = (optionContainer.children[1] as HTMLElement)
  clickOutsideCloser(menuDropdownBtn, () => menuDropdown.style.display = 'none')

  Array.from(menuDropdown.children[0].children).forEach((el: HTMLElement, index) => {
    switch(index) {
      case 0:
        el.addEventListener('click', () => modalQuantity.show())
        break
      case 1:
        el.addEventListener('click', () => modalDiscount.show())
        break
      default:
        break
    }
  })

  menuDropdownBtn.addEventListener('click', e => {
    if(menuDropdown.style.display == 'none') {
      menuDropdown.style.display = 'block'
    } else {
      menuDropdown.style.display = 'none'
    }
  })
}