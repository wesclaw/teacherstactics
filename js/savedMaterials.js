function checkForMaterials(){
  const rightSide = document.querySelector('.right-side')
  if(rightSide.innerHTML===""){
    rightSide.classList.add('noMaterialsClass')
    rightSide.innerHTML = `<h4>You currently don't have any saved lessons</h4>`
  }
}

const savedBtns = document.querySelectorAll(".left-side button")

// savedBtns.forEach((btn)=>{
//   btn.addEventListener('click',e=>{
//     savedBtns.forEach((b)=>{
//       b.style.outline = 'none'
//     })
//     e.currentTarget.style.outline = '2px dashed black'
//   })
// })

savedBtns.forEach((btn)=>{
  // btn.classList.remove('active')
// why the fucks IS CLASS NOT WOKRING HERE !!!!!!!!!!!!!!!!!!!!!!
})

window.addEventListener('load', checkForMaterials)