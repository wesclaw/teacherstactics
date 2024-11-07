const savedBtns = document.querySelectorAll(".left-side button");
const rightSide = document.querySelector('.right-side');
const saved_worksheets = document.querySelector('.saved-worksheets');
const deletePlanBtn = document.querySelectorAll('.deletePlan')

/////how to prevent the default for the deleteworksheet btn
// const delete_worksheet_btn = document.querySelectorAll('.delete_worksheet_btn')

deletePlanBtn.forEach((btn)=>{
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    const getPlan = e.currentTarget.parentElement;
    const getTitle = getPlan.querySelector('.title').textContent.trim(); 

    fetch('../includes/removePlan.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ title: getTitle })
    })
    .then(response => {
      if (response.ok) {
        return response.json(); // Assuming your PHP file returns a JSON response
      }
      throw new Error('Network response was not ok.');
    })
    .then(data => {
      getPlan.parentElement.remove();
    })
    .catch((error) => {
      console.error('Error:', error);
    });
  });
})


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
                   <button class='delete_worksheet_btn'>X</button>
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


