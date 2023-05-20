import ModalInputOptions from "../types/components/ModalInputOptions";
import Modal from "./Modal";

class ModalInput extends Modal {
  public constructor(modalEl: Element, options: ModalInputOptions) {
    super(modalEl)

    const form = modalEl.children[0] as HTMLFormElement
    const input = form.children[2].children[0] as HTMLInputElement

    form.children[1].innerHTML = options.title;
    form.action = options.action
    
    input.name = options.name
    input.type = options.type
    options.defaultInput && (input.value = options.defaultInput)

    for(const list in options.hiddenInput) {
      const input = document.createElement('input')

      input.value = options.hiddenInput[list]
      input.type = 'hidden'
      input.name = list

      form.appendChild(input);
    }
  }

  public override show(): void {
    super.show()
    this.closeEventListener()
  }

  protected override closeEventListener(): void {
    super.closeEventListener()

    const btn = this.modalEl.children[0].children[3].children[0] as HTMLButtonElement
    btn.addEventListener('click', () => super.hidden())
  }
}

export default ModalInput