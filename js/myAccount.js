const changeBtn = document.querySelector('.change_btn')
const user = document.querySelector('.user')
const body = document.querySelector('body')

changeBtn.addEventListener('click',e=>{
  const popUpContainer = document.createElement('div')
  popUpContainer.classList.add('pop-up-container')
  const popUp = document.createElement('div')
  popUp.classList.add('pop-up')
  const h4 = document.createElement('h4')
  h4.classList.add('h4')
  h4.textContent = 'Choose A Teacher'

  popUp.append(h4)

  const wrapper = document.createElement('div')
  wrapper.classList.add('wrapper')

  const profileImages = ["../user/userImages/man1.png", "../user/userImages/man2.png", "../user/userImages/girl1.png", "../user/userImages/girl2.png", "../user/userImages/girl3.png"]

  for(let i=0;i<5;i++){
    
    const btn = document.createElement('button')
    btn.classList.add('btn-for-images-holder')
    const img_el = document.createElement('img')
    wrapper.append(btn)
    img_el.classList.add('img_el')
    img_el.src = profileImages[i]
    btn.append(img_el)
    popUp.append(wrapper)
  }

    const inputBtn = document.createElement('button')
    inputBtn.classList.add('btn-for-images-holder')
    const chooseImage = document.createElement('button')
    chooseImage.classList.add('img_el')
    chooseImage.style.border = '3px dashed #6563ff'
  
    chooseImage.innerHTML = 
    `<img src="../icons/uploadImage.png" class="img">
    Upload
    </img>`

    inputBtn.append(chooseImage)
    wrapper.append(inputBtn)
    popUpContainer.append(popUp)
    body.append(popUpContainer)
})

window.addEventListener('click',e=>{
  if(e.target.classList.contains('pop-up-container')){
    e.target.remove()
  }
})