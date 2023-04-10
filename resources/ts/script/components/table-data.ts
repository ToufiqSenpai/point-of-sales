import ModalDelete from "../../components/ModalDelete";

const deleteActionBtn = document.getElementsByClassName('table-delete-btn')

for(const button of deleteActionBtn) {
    const modalDelete = new ModalDelete(button.nextElementSibling)

    button.addEventListener('click', () => modalDelete.show())
}

export {}
