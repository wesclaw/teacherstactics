let page = 1;
let isFetching = false;

const fetchLessons = () => {
    if (isFetching) return;
    isFetching = true;

    fetch(`lessonPlans.php?`) // Make sure the URL matches your PHP file's location
        .then(response => response.json())
        .then(data => {
            if (data.length) {
                const container = document.querySelector('.lesson-plan');
                data.forEach(item => {
                    const lessonElement = document.createElement('div');
                    lessonElement.innerHTML = `
                        <a href="plan.php?id=${item.Id}" class="lesson-link">
                            <div class="plan">
                                <img src="${item.CoverImage}" alt="Lesson Image" class="img-fluid coverImage">
                                <h3 class="title">${item.Title}</h3>
                                <p class="level">${item.Level}</p>
                                <p class="description">${item.Description}</p>
                                <div class="btn-holder">
                                    <button class="plan-btn">Show</button>
                                    <img src="icons/lock.png" class="img-fluid plan-lock">
                                </div>
                            </div>
                        </a>
                    `;
                    container.appendChild(lessonElement.firstChild);
                });
                page++;
                isFetching = false;
            } else {
                // Optionally handle when no more data is available
                console.log('No more lessons to load.');
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            isFetching = false;
        });
};

// Initial fetch
fetchLessons();

// Infinite scroll logic
window.addEventListener('scroll', () => {
    if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight - 10 && !isFetching) {
        fetchLessons();
    }
});