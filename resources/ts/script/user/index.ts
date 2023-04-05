import { Modal } from "flowbite";

const popupEl = document.getElementById('popup-modal')

// options with default values
const popupOptions = {
    placement: 'bottom-right',
    backdrop: 'dynamic',
    backdropClasses: 'bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40',
    closable: true
}

// @ts-ignore
const popupModal = new Modal(popupEl, popupOptions);

popupModal.show()
