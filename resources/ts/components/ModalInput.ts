import ModalInputOptions from "../types/components/ModalInputOptions";
import ModalOptions from "../types/components/ModalOption";
import Modal from "./Modal";

class ModalInput extends Modal {
  private input: HTMLInputElement
  private currentValue: string
  private options: ModalInputOptions

  public constructor(modalEl: Element, options?: ModalInputOptions) {
    super(modalEl)

    this.input = modalEl.getElementsByTagName('input')[0]
    this.options = options
  }

  public override show(): void {
    super.show()
    this.options?.onShow(this.input)
    this.closeEventListener()

    this.currentValue = this.input.value
  }

  public override hidden(): void {
    super.hidden()
    this.options?.onHidden(this.input)

    this.input.value = this.currentValue
  }

  protected override closeEventListener(): void {
    super.closeEventListener()

    
  }
}

export default ModalInput