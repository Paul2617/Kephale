
const new_article = document.getElementById('new_article');
  
  function   fetchNewArticle (){
    fetch('/Kephale/api/api_new_article.php')
    .then(response => response.json())
    .then(data => {
      new_article.innerHTML = '';
         console.log(data);

      if (data.length === 0) {
        new_article.innerHTML = '<p>Aucun article trouvé.</p>';
        return;
      }

      data.forEach(article => {
        const articleHTML = `
          <a class="slider_new" href="/Kephale/articles&id_article=${article.id_article}">
            <img  class="slider_img" src="public/asset/img_article/${article.nom_image}" alt="">
            <h2>${article.prix}</h2>
          </a>
        `;
        new_article.innerHTML += articleHTML;
      });
    })
    .catch(() => {
      new_article.innerHTML = '<p>Erreur lors du chargement des new article.</p>';
    });
   }   

   // Chargement initial
document.addEventListener('DOMContentLoaded', () => {
fetchNewArticle();
   
});