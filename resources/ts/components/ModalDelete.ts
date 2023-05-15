import ModalOptions from "../types/components/ModalOption"
import Modal from "./Modal"

class ModalDelete extends Modal {
    public constructor(modalEl: Element, options: ModalOptions) {
        super(modalEl, options)
    }

    public override show(): void {
        super.show()
        this.closeEventListener()
        super.closeEventListener()
    }

    public override hidden(): void {
        super.hidden()
    }

    protected override closeEventListener(): void {
        const btnCancel = this.modalEl.children[0].children[5]
        btnCancel.addEventListener('click', () => this.hidden())
    }
}

export default ModalDelete
