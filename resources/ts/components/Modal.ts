import ModalOptions from "../types/components/ModalOption"

class Modal {
  protected modalEl: Element

  public constructor(modalEl: Element) {
    this.modalEl = modalEl
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

  protected closeEventListener(): void {
    this.modalEl.addEventListener('click', e => {
      if (e.target !== e.currentTarget) return
      this.hidden()
    })
  }
}

export default Modal