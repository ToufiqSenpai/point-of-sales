import ModalInput from "../../../components/ModalInput"
import Product from "../../../types/product/Product"
import ProductCart from "../../../types/product/ProductCart"
import clickOutsideCloser from "../../../utils/clickOutsideCloser"

// Product data section
const productData = document.getElementById('__product-data')
const products: Product[] = JSON.parse(productData.getAttribute('data-product'))
const productImage: ProductImage[] = JSON.parse(productData.getAttribute('data-image'))
const cart: ProductCart[] = []

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

// Select product section
const selectProduct = document.getElementById('select-product')
const searchProductInput = selectProduct.children[0]
const productContainer = selectProduct.children[1]

for(const product of products) {
  productContainer.appendChild(appendProductFigure(product))
}

function appendProductFigure(product: Product): Element {
  const figure = document.createElement('figure')
  const div = document.createElement('div')
  const img = document.createElement('img')
  const figcaption = document.createElement('figcaption')

  figcaption.classList.add('truncate')
  figcaption.innerHTML = product.name

  img.src = `/storage/product/${productImage.find(value => value.id == product.image_id).name}`
  img.alt = 'name'
  img.classList.add('w-full', 'h-full', 'object-cover')

  div.classList.add('w-[105px]', 'h-[105px]')
  div.append(img)

  figure.classList.add('w-[105px]', 'h-[105px]')
  figure.setAttribute('data-product-id', product.id.toString())
  figure.append(div, figcaption)

  figure.addEventListener('click', () => {
    for(const [key, item] of cart.entries()) {
      if(item.id == product.id) {
        cart[key].quantity++
      } else {
        cart.push({
          id: product.id,
          name: product.name,
          price: product.base_price,
          quantity: 1
        })
      }
    }
  })

  return figure
}