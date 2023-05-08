class Modal {
  private modalEl: Element
  
  public constructor(modalEl: Element) {
    this.modalEl = modalEl
    
    const btnCancel = modalEl.getElementsByClassName('btn-cancel')
    btnCancel[0].addEventListener('click', () => this.hidden())

    modalEl.addEventListener('click', e => {
        if(e.target !== e.currentTarget) return
        this.hidden()
    })
  }
  
  public show(): void {
    const modal = this.modalEl as HTMLElement
    modal.style.visibility = 'visible'
    modal.style.backgroundColor = 'rgba(0,0,0,0.5)';

    const innerModal = this.modalEl.firstElementChild as HTMLElement
    innerModal.style.opacity = '1'
    innerModal.style.transform = 'translate(-50%,-50%)'
  }

  public hidden(): void {
    const modal = this.modalEl as HTMLElement
    modal.style.visibility = 'hidden'
    modal.style.backgroundColor = 'rgba(0,0,0,0)';

    const innerModal = this.modalEl.firstElementChild as HTMLElement
    innerModal.style.opacity = '0'
    innerModal.style.transform = 'translate(-50%,-30%)'
  }
}

export default Modal