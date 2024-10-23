const changeBtn = document.querySelector('.change_btn')
const user = document.querySelector('.user')
const body = document.querySelector('body')

let selectedImageSrc = null;

function updateProfileImage() {
  fetch('../includes/getProfileImage.php')
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              const profileImageElement = document.querySelector('.image-edit');
              profileImageElement.src = data.profileImageUrl; 
          } else {
              console.error('Error fetching profile image:', data.error);
          }
      })
      .catch(error => console.error('Fetch error:', error));
}

function sendFileUploadToDb(){
  const saveImageBtn = document.querySelector('.saveImageBtn')

  if (!selectedImageSrc) {
    console.error("No image selected to upload.");
    return;
  }
  console.log('Sending file to server:', selectedImageSrc);

  fetch(selectedImageSrc)
    .then(res => res.blob())
    .then(blob => {
      const file = new File([blob], "profile_image.jpg", { type: blob.type });
      const formData = new FormData();
      formData.append('image', file);

      saveImageBtn.textContent = "Saving...";

      fetch('../includes/uploadFileDb.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      // .then(result => console.log('Success:', result))

      .then(result=>{
        if(result.status==='success'){
          window.location.reload();
        }
      })
     
      .catch(error => console.error('Error:', error));
    });
}

function saveImageToDb(e){
  const img_els = document.querySelectorAll('.img_el')
  const lastImageEl = document.querySelector('.last-image-el')

  if(lastImageEl.style.border === '4px dashed black'){
    const urlBlob = lastImageEl.firstChild.src;
    selectedImageSrc = urlBlob;
    sendFileUploadToDb()
    return 
    // THIS RETURN IS HOW THE IMAGE IS FETCHED BACK FROM SERVER. I DONT KNOW HOW BUT IT IS.
  }

  img_els.forEach((img)=>{
    if(img.style.border === '4px dashed black'){
      selectedImageSrc = img.src;
    }
  })

  if(selectedImageSrc) {
    fetch('../includes/uploadImage.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ imagePath: selectedImageSrc }), 
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        console.log('Image saved to database');

        updateProfileImage(); 

      } else {
        console.error('Error saving image:', data.error);
      }
    })
    .catch(error => console.error('Fetch error:', error));
  } else {
    console.log('No image selected');
  }
  window.location.reload()
}

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
    const lastImage = document.querySelector('.last-image-el')
    img_els.forEach((img)=>{
      img.style.border = '2px solid black'
      lastImage.style.border = '4px dashed #6563ff'
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

    const saveImageBtn = document.createElement('button')
    saveImageBtn.disabled = true

    if(saveImageBtn.disabled===true){
      saveImageBtn.classList.add('imageBtnDisabled')
    }
    
    saveImageBtn.textContent = 'Save'

    saveImageBtn.addEventListener('click', saveImageToDb) 
    
    chooseImage.innerHTML = 
    `<img src="../icons/uploadImage.png" class="img">
    Upload`

    chooseImage.addEventListener('click', ()=> {
      const fileInput = document.createElement('input');
      fileInput.type = 'file';
      fileInput.accept = '.NEF, .jpg, .jpeg, .png, image/*';
      
      fileInput.style.display = 'none';

      fileInput.addEventListener('change', (event) => {
          const selectedFile = event.target.files[0];
          const lastImageEl = document.querySelector('.last-image-el')
          if (selectedFile) {
           const imageURL = URL.createObjectURL(selectedFile);
           lastImageEl.innerHTML = `<img src="${imageURL}" alt='Need .png file' class="newImage">`
           const img_els = document.querySelectorAll('.img_el')
           img_els.forEach((img)=>{
            img.style.border = '2px solid black'
           })
           lastImageEl.style.border = '4px dashed black'
           saveImageBtn.disabled = false;
           saveImageBtn.classList.add('saveImageBtn')
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

