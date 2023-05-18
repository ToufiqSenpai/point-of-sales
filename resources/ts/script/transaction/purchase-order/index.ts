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
  const moreButton = el.children[0] as HTMLSpanElement,
  dropdown = el.children[1] as HTMLDivElement

  /* More button section */
  // Add event listener to "more button"
  moreButton.addEventListener('click', () => {
    if(dropdown.style.display == 'none') dropdown.style.display = 'block'
    else dropdown.style.display = 'none'
  })

  /* When dropdown is opened, and user click outside, close the dropdown */
  clickOutsideCloser(moreButton, () => dropdown.style.display = 'none')

  /* Dropdown section */
  for(const span of dropdown.getElementsByTagName('span')) {
    span.addEventListener('click', () => )
  }
})