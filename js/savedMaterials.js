
const savedBtns = document.querySelectorAll(".left-side button")
const rightSide = document.querySelector('.right-side')
const saved_worksheets = document.querySelector('.saved-worksheets')


function checkForMaterials(btn){
  const getText = btn.textContent.trim()
  if(getText==='Lessons'){
    rightSide.style.display = 'flex'
    saved_worksheets.style.display = 'none'
  }else if(getText==='Worksheets'){
    rightSide.style.display = 'none'
    saved_worksheets.style.display = 'flex'
  }else if(getText==='Games'){

  }else if(getText==='Arts & Crafts'){
   
  }else if(getText==='Experiments'){
    
  }
}

savedBtns.forEach((btn)=>{
  btn.addEventListener('click',e=>{
    savedBtns.forEach((b)=>{
      b.classList.remove('active')
    })
    btn.classList.add('active')
    checkForMaterials(btn)
  })
})

