
// const savedBtns = document.querySelectorAll(".left-side button")
// const rightSide = document.querySelector('.right-side')
// const saved_worksheets = document.querySelector('.saved-worksheets')


// function checkForMaterials(btn){
//   const getText = btn.textContent.trim()
//   if(getText==='Lessons'){
//     rightSide.style.display = 'flex'
//     saved_worksheets.style.display = 'none'
//   }else if(getText==='Worksheets'){
//     rightSide.style.display = 'none'
//     saved_worksheets.style.display = 'flex'
//   }else if(getText==='Games'){

//   }else if(getText==='Arts & Crafts'){
   
//   }else if(getText==='Experiments'){
    
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



const savedBtns = document.querySelectorAll(".left-side button");
const rightSide = document.querySelector('.right-side');
const saved_worksheets = document.querySelector('.saved-worksheets');

function checkForMaterials(btn){
  const getText = btn.textContent.trim();
  if(getText==='Lessons'){
    rightSide.style.display = 'flex';
    saved_worksheets.style.display = 'none';
  } else if(getText==='Worksheets'){
    rightSide.style.display = 'none';
    saved_worksheets.style.display = 'flex';
    if (!saved_worksheets.hasAttribute('data-loaded')) {
      fetchWorksheets();
    }
  }
}



function fetchWorksheets() {
  fetch('../includes/displayWorksheets.php')
  .then(response => response.json())
  .then(data => {
      if (!data.success) {
          console.error('Error:', data.error);
          return;
      }
      const worksheets = data.worksheets;
      const worksheetContainer = document.querySelector('.saved-worksheets');
      worksheetContainer.innerHTML = '';

      worksheets.forEach(worksheet => {
          const worksheetHTML = `
              <a href="${worksheet.pdf_link}" target="_blank" class="a_tag_worksheet">
                  <div class="worksheet worksheetLoad">
                      <img src="${worksheet.image_path}" alt="Worksheet Image" class="worksheet-image img-fluid">
                      <p class='worksheet-title textLoad'>${worksheet.title}</p>
                  </div>
              </a>`; 
          worksheetContainer.insertAdjacentHTML('beforeend', worksheetHTML);
      });

      const worksheet_images = document.querySelectorAll('.worksheet-image')
      const titles = document.querySelectorAll('.worksheet-title')

      worksheet_images.forEach((img)=>{
        img.addEventListener('load',e=>{
          const get_el = img.parentElement;
          get_el.classList.remove('worksheetLoad')
        })
      })

      

      titles.forEach((tit)=>{
        worksheet_images.forEach((img)=>{
          img.addEventListener('load',e=>{
            tit.classList.remove('textLoad')
          })
        })
      })
      
  })
  .catch(error => console.error('Error loading worksheets:', error));
}



savedBtns.forEach((btn) => {
  btn.addEventListener('click', e => {
    savedBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    checkForMaterials(btn);
  });
});


