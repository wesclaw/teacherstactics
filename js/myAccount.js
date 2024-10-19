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

  function selectImage(e){
    const img_els = document.querySelectorAll('.img_el')
    img_els.forEach((img)=>{
      img.style.border = '2px solid black'
    })
    e.currentTarget.style.border = '4px dashed black'
    saveImageBtn.disabled = false;
    if(saveImageBtn.disabled===false){
      saveImageBtn.classList.add('saveImageBtn')
    }
  }

  for(let i=0;i<5;i++){ 
    const btn = document.createElement('button')
    btn.classList.add('btn-for-images-holder')
    const img_el = document.createElement('img')
    wrapper.append(btn)
    img_el.classList.add('img_el')
    img_el.src = profileImages[i]
    btn.append(img_el)
    popUp.append(wrapper)

    img_el.addEventListener('click', selectImage)
  }

    const inputBtn = document.createElement('button')
    inputBtn.classList.add('btn-for-images-holder')
    const chooseImage = document.createElement('button')
    chooseImage.classList.add('last-image-el')

    // save image btn at the bottom of the popup
    const saveImageBtn = document.createElement('button')
    saveImageBtn.disabled = true

    if(saveImageBtn.disabled===true){
      saveImageBtn.classList.add('imageBtnDisabled')
    }
    
    saveImageBtn.textContent = 'Save'
    
    chooseImage.innerHTML = 
    `<img src="../icons/uploadImage.png" class="img">
    Upload
    </img>`


    chooseImage.addEventListener('click', ()=> {
      // Create a hidden file input dynamically
      const fileInput = document.createElement('input');
      fileInput.type = 'file';
      fileInput.style.display = 'none';

  
      fileInput.addEventListener('change', (event) => {
          const selectedFile = event.target.files[0];
          if (selectedFile) {
              console.log(`File selected: ${selectedFile.name}`);
          }
      });
      fileInput.click();
  });

    inputBtn.append(chooseImage)
    wrapper.append(inputBtn)
    wrapper.append(saveImageBtn)
    popUpContainer.append(popUp)
    body.append(popUpContainer)  
})

window.addEventListener('click',e=>{
  if(e.target.classList.contains('pop-up-container')){
    e.target.remove()
  }
})

