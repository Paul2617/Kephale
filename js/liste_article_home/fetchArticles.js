const searchInput = document.getElementById('searchInput');
function fetchArticles(query = '') {
  fetch('/Kephale/api/api_article.php?recherche=' + encodeURIComponent(query))
    .then(response => response.json())
    .then(data => {
      const articlesDiv = document.getElementById('articles');
      articlesDiv.innerHTML = '';
         console.log(data);

      if (data.length === 0) {
        articlesDiv.innerHTML = '<p>Aucun article trouvé.</p>';
        return;
      }

      data.forEach(article => {
        const articleHTML = `
          <a href="" class='sskddjdj'>
            <img class="lvgkdjshjgh_img" src="public/asset/img_article/${article.nom_image}" alt="">
            <p><span>${article.descriptions}</span></p>
            <h2>${article.prix}</h2>
          </a>
        `;
        articlesDiv.innerHTML += articleHTML;
      });
    })
    .catch(() => {
      document.getElementById('articles').innerHTML = '<p>Erreur lors du chargement.</p>';
    });
}

searchInput.addEventListener('input', function () {
  fetchArticles(this.value);
});


document.addEventListener('DOMContentLoaded', () => {
  fetchArticles();
   
});