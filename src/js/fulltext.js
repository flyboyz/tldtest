export default () => {
  let welcomeScreen = document.querySelector('.welcome-screen')
  let cardShowText = document.querySelectorAll('.card .show-text')

  if (welcomeScreen !== null) {
    const blockHeight = welcomeScreen.clientHeight
    const contentHeight = welcomeScreen.children[0].clientHeight

    let text = welcomeScreen.querySelector('.text')

    if (blockHeight < contentHeight) {
      let element = document.createElement('div')
      element.classList.add('show-text')

      text.append(element)

      element.addEventListener('click', (e) => {
        welcomeScreen.classList.add('open')
        element.remove()
      })
    }
  }

  if (cardShowText !== null) {
    cardShowText.forEach((el) => {
      el.addEventListener('click', (e) => {
        e.currentTarget.closest('.card__footer').querySelector('p').style.display = 'block'
      })
    })
  }
}