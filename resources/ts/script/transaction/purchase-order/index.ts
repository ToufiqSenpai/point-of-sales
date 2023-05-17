import * as qs from 'qs'

// Form section
const forms = document.getElementsByTagName('form')
const url = new URLSearchParams(location.search)

for(const form of forms) {
  // When the querystring not have t-id param
  // Skip form with search field
  if(!url.get('t-id') && form.elements['search']) continue

  const input = document.createElement('input')
  
  input.type = 'hidden'
  input.name = 't-id'
  input.value = url.get('t-id')

  form.appendChild(input)
}
