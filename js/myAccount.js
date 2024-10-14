const changeBtn = document.querySelector('.change_btn')
const user = document.querySelector('.user')
const body = document.querySelector('body')

changeBtn.addEventListener('click',e=>{
  const popUpContainer = document.createElement('div')
  popUpContainer.classList.add('pop-up-container')
  const popUp = document.createElement('div')
  popUp.classList.add('pop-up')
  body.append(popUpContainer)
  
  popUpContainer.append(popUp)
})