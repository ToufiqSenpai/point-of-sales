const shopImage = document.getElementById('shop-image') as HTMLImageElement,
fileInput = document.getElementById('input-file') as HTMLInputElement

fileInput.addEventListener('change', function(e) {
  if(this.files[0]) {
    shopImage.src = URL.createObjectURL(this.files[0])
  }
})