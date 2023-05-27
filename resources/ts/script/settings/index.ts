const shopImage = document.getElementById('store-image') as HTMLImageElement,
fileInput = document.getElementById('input-file') as HTMLInputElement

fileInput.addEventListener('change', function(e) {
  if(this.files) {
    shopImage.src = URL.createObjectURL(this.files[0])
  }
})