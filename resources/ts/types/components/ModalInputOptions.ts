interface ModalInputOptions {
  title: string
  type: string
  action: string
  name: string
  defaultInput?: string
  hiddenInput?: {
    [key: string]: string
  }
}

export default ModalInputOptions