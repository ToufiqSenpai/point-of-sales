const imgInput = document.getElementById('product-cu-img')

imgInput.getElementsByTagName('input')[0].addEventListener('change', function(e) {
    if(this.files) {
        imgInput.firstElementChild.setAttribute('src', URL.createObjectURL(this.files[0]))
    }
})

export {}
