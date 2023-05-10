function clickOutsideCloser(el: Element, fn: () => void) {
  document.addEventListener('click', e => {
  // @ts-ignore
  if(!el.contains(e.target))
    fn()
  })
}

export default clickOutsideCloser