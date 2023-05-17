import * as qs from 'qs'

// Form section
const forms = document.getElementsByTagName('form')
const url = new URLSearchParams(location.search)

for(const form of forms) {
  // When the querystring not have t-id param
  // Skip form with search field
  if(!url.get('id') && form.elements['search']) continue

  form.action = form.action + '&id=' + url.get('id')
}
