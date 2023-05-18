import ModalOptions from "../types/components/ModalOption"
import Modal from "./Modal"

class ModalDelete extends Modal {
    public constructor(modalEl: Element) {
        super(modalEl)
    }

    public override show(): void {
        super.show()
        this.closeEventListener()
    }

    protected override closeEventListener(): void {
        const btnCancel = this.modalEl.children[0].children[5]
        btnCancel.addEventListener('click', () => this.hidden())

        super.closeEventListener()
    }
}

export default ModalDelete
