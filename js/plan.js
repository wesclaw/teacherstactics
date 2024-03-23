const go_back_btn = document.getElementById('go_back_btn').addEventListener('click',()=>{
  location.href = 'lessonPlans.php'
})

// this code finds any sentence ending in ':' and then wrapping the whole sentence in <br> tags and then setting the sentences to a <b> tag.

const full_lesson = document.querySelector('.full_lesson');
const lessonText = full_lesson.textContent;
const regex = /([^.!?:]*?:)(?=\s|$)/g;
const modifiedText = lessonText.replace(regex, '<br><b>$1</b><br>');
full_lesson.innerHTML = modifiedText;

const games_sections = document.querySelectorAll('.games-section');

games_sections.forEach(games_section => {
    const games = games_section.textContent;
    const regex_games = /([^.!?:]*?:)(?=\s|$)/g;
    const modifiedText_games = games.replace(regex_games, '<div style="text-align: center;"><b>$1</b></div>');
    games_section.innerHTML = modifiedText_games;
});

window.addEventListener('scroll', function() {
  const sections = document.querySelectorAll('div[id^="section"]');
  const sidebarLinks = document.querySelectorAll('#on-this-page ul li a');

  const offset = 550; 

  sections.forEach((section, index) => {
      const sectionTop = section.offsetTop;
      if (pageYOffset >= sectionTop - offset) {
          sidebarLinks.forEach(link => {
              link.classList.remove('active');
          });
          sidebarLinks[index].classList.add('active');
      }
  });
});

// checking for OTHER IDEAS 

const section9 = document.getElementById('section9')
const otherIdeas = document.querySelector('.otherIdeas')
const link_for_other_ideas = document.querySelector('.link_for_other_ideas')

function checkForOtherIdeas(){
  if(otherIdeas.textContent===""){
    link_for_other_ideas.remove()
    section9.remove()  

  }
}

checkForOtherIdeas()

// checking for PROJECTS

const link_for_projects = document.querySelector('.link_for_projects')
const section6 = document.getElementById('section6')
const project_text = document.querySelector('.project_text')

function checkForProjects() {
  if(project_text.textContent===''){
    link_for_projects.remove()
    section6.remove()
  }
}

checkForProjects()

// checking for EXPERIMENTS

const experiments_text = document.querySelector('.experiments_text')
const link_for_experiments = document.querySelector('.link_for_experiments') 
const section5 = document.getElementById('section5')

function check_for_experiments(){
  if(experiments_text.textContent===''){
    link_for_experiments.remove()
    section5.remove()
  }
}

check_for_experiments()