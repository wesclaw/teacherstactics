const rightSide = document.querySelector('.right-side')

function checkForMaterials(btn){
  const getText = btn.textContent
  if(getText==='Saved Lessons'){
    rightSide.classList.add('noMaterialsClass')
    rightSide.innerHTML = `<h4>You currently don't have any saved lessons</h4>`
  }else if(getText==='Saved Worksheets'){
    rightSide.classList.add('noMaterialsClass')
    rightSide.innerHTML = `<h4>You currently don't have any saved worksheets</h4>`
  }else if(getText==='Saved Games'){
    rightSide.classList.add('noMaterialsClass')
    rightSide.innerHTML = `<h4>You currently don't have any saved games</h4>`
  }else if(getText==='Saved Crafts'){
    rightSide.classList.add('noMaterialsClass')
    rightSide.innerHTML = `<h4>You currently don't have any saved crafts</h4>`
  }else if(getText==='Saved Experiments'){
    rightSide.classList.add('noMaterialsClass')
    rightSide.innerHTML = `<h4>You currently don't have any saved experiments</h4>`
  }
}

const savedBtns = document.querySelectorAll(".left-side button")

savedBtns.forEach((btn)=>{
  btn.addEventListener('click',e=>{
    savedBtns.forEach((b)=>{
      b.classList.remove('active')
    })
    btn.classList.add('active')
    checkForMaterials(btn)
  })
})

