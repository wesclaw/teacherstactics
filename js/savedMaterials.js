
const savedBtns = document.querySelectorAll(".left-side button")



// function checkForMaterials(btn){
  
 
// }

savedBtns.forEach((btn)=>{
  btn.addEventListener('click',e=>{
    savedBtns.forEach((b)=>{
      b.classList.remove('active')
    })
    btn.classList.add('active')
    // checkForMaterials(btn)
  })
})



// function checkForMaterials(btn){
//   const getText = btn.textContent.trim()
//   if(getText==='Lessons'){
//     rightSide.classList.add('noMaterialsClass')
//     rightSide.innerHTML = `<h4>You currently don't have any saved lessons</h4>`

//   }else if(getText==='Worksheets'){
//     rightSide.classList.add('noMaterialsClass')
//     rightSide.innerHTML = `<h4>You currently don't have any saved worksheets</h4>`
//   }else if(getText==='Games'){
//     rightSide.classList.add('noMaterialsClass')
//     rightSide.innerHTML = `<h4>You currently don't have any saved games</h4>`
//   }else if(getText==='Arts & Crafts'){
//     rightSide.classList.add('noMaterialsClass')
//     rightSide.innerHTML = `<h4>You currently don't have any saved crafts</h4>`
//   }else if(getText==='Experiments'){
//     rightSide.classList.add('noMaterialsClass')
//     rightSide.innerHTML = `<h4>You currently don't have any saved experiments</h4>`
//   }
// }

// savedBtns.forEach((btn)=>{
//   btn.addEventListener('click',e=>{
//     savedBtns.forEach((b)=>{
//       b.classList.remove('active')
//     })
//     btn.classList.add('active')
//     checkForMaterials(btn)
//   })
// })

