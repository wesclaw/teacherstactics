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

const section9 = document.getElementById('section9')
const otherIdeas = document.querySelector('.otherIdeas')
const link_for_other_ideas = document.querySelector('.link_for_other_ideas')

function checkForOtherIdeas(){
  if(otherIdeas.textContent===""){
    link_for_other_ideas.remove()
    section9.remove()  

  }
  console.log(otherIdeas)
}

checkForOtherIdeas()