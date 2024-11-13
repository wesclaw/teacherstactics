

const savedBtns = document.querySelectorAll(".left-side button");
const rightSide = document.querySelector('.right-side');
const saved_worksheets = document.querySelector('.saved-worksheets');
const deletePlanBtn = document.querySelectorAll('.deletePlan')
const saved_games = document.querySelector('.saved-games')
const saved_arts = document.querySelector('.saved-arts')
const saved_experiments = document.querySelector('.saved-experiments')

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
        return response.json(); 
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
    saved_games.style.display = 'none'
    saved_arts.style.display = 'none'
  } else if(getText==='Worksheets'){
    rightSide.style.display = 'none';
    saved_worksheets.style.display = 'flex';
    saved_games.style.display = 'none'
    saved_arts.style.display = 'none'
    saved_experiments.style.display = 'none'
    if (!saved_worksheets.hasAttribute('data-loaded')) {
      fetchWorksheets();
    }
  }else if(getText==='Games'){
    rightSide.style.display = 'none';
    saved_worksheets.style.display = 'none';
    saved_games.style.display = 'flex'
    saved_arts.style.display = 'none'
    saved_experiments.style.display = 'none'
    if (!saved_games.hasAttribute('data-loaded')) {
      fetchGames();
      saved_games.setAttribute('data-loaded', 'true');
    }
  }else if(getText==='Arts & Crafts'){
    rightSide.style.display = 'none';
    saved_worksheets.style.display = 'none';
    saved_games.style.display = 'none'
    saved_arts.style.display = 'flex'
    saved_experiments.style.display = 'none'
    if (!saved_arts.hasAttribute('data-loaded')) {
      fetchArts();
      saved_arts.setAttribute('data-loaded', 'true');
    }
  }else if(getText==='Experiments'){
    rightSide.style.display = 'none';
    saved_worksheets.style.display = 'none';
    saved_games.style.display = 'none'
    saved_arts.style.display = 'none'
    saved_experiments.style.display = 'flex'
    if (!saved_experiments.hasAttribute('data-loaded')) {
      fetchExperiments();
      saved_experiments.setAttribute('data-loaded', 'true');
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
                   <button class='delete_worksheet_btn'>
                   <img src="../icons/pinned-icon.png" class='delete-icon'>
                   </button>
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

      const worksheet_btns = document.querySelectorAll('.delete_worksheet_btn').forEach((btn)=>{
  
        btn.addEventListener('click',e=>{
          e.preventDefault()
          const getFullDiv = e.currentTarget.parentElement
          const getFullTag = getFullDiv.parentElement
          const getATag = getFullDiv.parentElement.href;
          const getFile = getATag.split('/').pop();

          fetch('../includes/removeWorksheet.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ title: getFile })
          })
          .then(response => {
            if (response.ok) {
              return response.json(); 
            }
            throw new Error('Network response was not ok.');
          })
          .then(data => {
            getFullTag.remove()
          })
          .catch((error) => {
            console.error('Error:', error);
          });
          
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


function fetchGames(){
  fetch('../includes/displayGames.php')  // Fetching game data from the server
    .then(response => response.json())  // Parse the response as JSON
    .then(data => {
      if (data.success) {  // Check if the response is successful
        const games = data.games;  

        games.forEach(game => {
          // we had to add it before we rendered the html to prevent dupilciate renders
          let isFirstMatch = true;

            const formattedDescription = game.description.replace(/(\b[\w\s]+:)/g, (match) => {
              if (isFirstMatch) {
                isFirstMatch = false;
                return `<b>${match}</b></br>`;
              } else {
                return `<br><b>${match}</b></br>`;
              }
            });
          const gameHTML = `
            <div class="game">
              <div class="top-title">
                <h4 class="title">${game.game_name}</h4>
                <button class="delete-game-btn btn">
                  <img src="../icons/pin.png" class="delete-icon">
                </button>
              </div>          
              <div class="line"></div>
              <h5>Materials:</h5>
              <ul>
                ${game.game_materials}
              </ul>
              <div class="line"></div>
              <p class="text-des">${formattedDescription}</p>
              <div class="btn-wrap">
                <button class="seemorebtn">See More</button>
              </div>
            </div>`;
    
          saved_games.insertAdjacentHTML('beforeend', gameHTML);

          const savedGamesContainer = document.querySelector('.saved-games');

          console.log(savedGamesContainer)
        
          savedGamesContainer.addEventListener('mouseover', (e) => {
            const gameElement = e.target.closest('.game');
            if (gameElement) {
              const btn = gameElement.querySelector('.seemorebtn');
              if (btn) {
                btn.classList.add('addtext');
              }
            }
          });
        
          savedGamesContainer.addEventListener('mouseout', (e) => {
            const gameElement = e.target.closest('.game');
            if (gameElement) {
              const btn = gameElement.querySelector('.seemorebtn');
              if (btn) {
                btn.classList.remove('addtext');
              }
            }
          });
        
          savedGamesContainer.addEventListener('click', (e) => {
            if (e.target.matches('.seemorebtn')) {
              const btn = e.target;
              const gameElement = btn.closest('.game');
              if (gameElement) {
                const btn = gameElement.querySelector('.seemorebtn');
                gameElement.style.overflow = 'auto';
                btn.style.display = 'none'
                gameElement.classList.add('hide-overlay');
              }
            }
          });

        });
      } else {
        console.error('Error fetching games:', data.error);  
      }
    })
    .catch(error => {
      console.error('Error fetching data:', error);  
    });
}

saved_games.addEventListener('click',e=>{
  if(e.target.className==='delete-icon'){
     const getParent = e.target.parentElement.parentElement
     const getTitle = getParent.firstElementChild.textContent.trim()
     const getFullGame = getParent.parentElement
     
     fetch('../includes/removeGame.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ title: getTitle })
    })
    .then(response => {
      if (response.ok) {
        return response.json(); 
      }
      throw new Error('Network response was not ok.');
    })
    .then(data => {
      getFullGame.remove()
    })
    .catch((error) => {
      console.error('Error:', error);
    });
  } 
})

function fetchArts(){
  fetch('../includes/displayArts.php')  
  .then(response => response.json())  
  .then(data => {
    if (data.success) {  
      const arts = data.arts;  

      arts.forEach(art => {
        let isFirstMatch = true;

        const formattedDescription = art.description.replace(/(\b[\w\s]+:)/g, (match) => {
          if (isFirstMatch) {
            isFirstMatch = false;
            return `<b>${match}</b></br>`;  
          } else {
            return `<br><b>${match}</b></br>`;  
          }
        });

        const artHTML = `
          <div class="game">
            <div class="top-title">
              <h4 class="title">${art.title}</h4>
              <button class="delete-game-btn btn">
                  <img src="../icons/pin.png" class="delete-icon">
                </button>
            </div>       
            <div class="line"></div>
            <h5>Materials:</h5>
            <ul>
              ${art.materials}
            </ul>
            <div class="line"></div>  
            <p class="text-des">${formattedDescription}</p>
            <div class="btn-wrap">
              <button class="seemorebtn">see more</button>
            </div>
          </div>`;

        saved_arts.insertAdjacentHTML('beforeend', artHTML); 
      });
    } else {
      console.error('Error fetching arts:', data.error);  
    }
  })
  .catch(error => {
    console.error('Error fetching data:', error);  
  });

  // add hover here for see more btn
  const savedArtsContainer = document.querySelector('.saved-arts');

  savedArtsContainer.addEventListener('mouseover', (e) => {
    const gameElement = e.target.closest('.game');
    if (gameElement) {
      const btn = gameElement.querySelector('.seemorebtn');
      if (btn) {
        btn.classList.add('addtext');
      }
    }
  });

  savedArtsContainer.addEventListener('mouseout', (e) => {
    const gameElement = e.target.closest('.game');
    if (gameElement) {
      const btn = gameElement.querySelector('.seemorebtn');
      if (btn) {
        btn.classList.remove('addtext');
      }
    }
  });

  savedArtsContainer.addEventListener('click', (e) => {
    if (e.target.matches('.seemorebtn')) {
      const btn = e.target;
      const gameElement = btn.closest('.game');
      if (gameElement) {
        const btn = gameElement.querySelector('.seemorebtn');
        gameElement.style.overflow = 'auto';
        btn.style.display = 'none'
        gameElement.classList.add('hide-overlay');
      }
    }
  });
}

saved_arts.addEventListener('click',e=>{
  if(e.target.className==='delete-icon'){
    const getParent = e.target.parentElement.parentElement;
    const getTitle = getParent.firstElementChild.textContent.trim()
    const getDiv = getParent.parentElement
    fetch('../includes/removeArt.php',{
      method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ title: getTitle })
    }).then(response => {
      if (response.ok) {
        return response.json(); 
      }
      throw new Error('Network response was not ok.');
    })
    .then(data => {
      getDiv.remove()
    })
    .catch((error) => {
      console.error('Error:', error);
    });
  }
})

function fetchExperiments() {
  fetch('../includes/displayExperiments.php')  // Updated to fetch from displayExperiments.php
  .then(response => response.json())  
  .then(data => {
    if (data.success) {  
      const experiments = data.experiments;  // Updated variable name to experiments

      experiments.forEach(experiment => {
        let isFirstMatch = true;

        const formattedDescription = experiment.description.replace(/(\b[\w\s]+:)/g, (match) => {
          if (isFirstMatch) {
            isFirstMatch = false;
            return `<b>${match}</b></br>`;  
          } else {
            return `<br><b>${match}</b></br>`;  
          }
        });

        const experimentHTML = `
          <div class="game experiment">  
            <div class="top-title">
              <h4 class="title">${experiment.title}</h4>
              <button class="delete-experiment-btn btn">  <!-- Updated button class -->
                  <img src="../icons/pin.png" class="delete-icon">
                </button>
            </div>       
            <div class="line"></div>
            <h5>Materials:</h5>
            <ul>
              ${experiment.materials}
            </ul>
            <div class="line"></div>  
            <p class="text-des">${formattedDescription}</p>
            <div class="btn-wrap">
              <button class="seemorebtn">see more</button>
            </div>
          </div>`;

        saved_experiments.insertAdjacentHTML('beforeend', experimentHTML);  // Updated container to saved_experiments
      });
    } else {
      console.error('Error fetching experiments:', data.error);  // Updated error log for experiments
    }
  })
  .catch(error => {
    console.error('Error fetching data:', error);  
  });

  const saved_experiments = document.querySelector('.saved-experiments')

  saved_experiments.addEventListener('mouseover', (e) => {
    const gameElement = e.target.closest('.game');
    if (gameElement) {
      const btn = gameElement.querySelector('.seemorebtn');
      if (btn) {
        btn.classList.add('addtext');
      }
    }
  });

  saved_experiments.addEventListener('mouseout', (e) => {
    const gameElement = e.target.closest('.game');
    if (gameElement) {
      const btn = gameElement.querySelector('.seemorebtn');
      if (btn) {
        btn.classList.remove('addtext');
      }
    }
  });

  saved_experiments.addEventListener('click', (e) => {
    if (e.target.matches('.seemorebtn')) {
      const btn = e.target;
      const gameElement = btn.closest('.game');
      if (gameElement) {
        const btn = gameElement.querySelector('.seemorebtn');
        gameElement.style.overflow = 'auto';
        btn.style.display = 'none'
        gameElement.classList.add('hide-overlay');
      }
    }
  });

}


saved_experiments.addEventListener('click',e=>{
  if(e.target.className==='delete-icon'){
    const getParent = e.target.parentElement.parentElement;
    const getTitle = getParent.firstElementChild.textContent.trim()
    const getDiv = getParent.parentElement;

    console.log(getTitle)
    fetch('../includes/removeExperiments.php',{
      method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ title: getTitle })
    }).then(response => {
      if (response.ok) {
        return response.json(); 
      }
      throw new Error('Network response was not ok.');
    })
    .then(data => {
      getDiv.remove()
    })
    .catch((error) => {
      console.error('Error:', error);
    });
  }
})

savedBtns.forEach((btn) => {
  btn.addEventListener('click', e => {
    savedBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    checkForMaterials(btn);
  });
});




