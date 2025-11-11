<?php new html(); ?>

<body>
    <div>

    </div>
    <ul id="list" class="articles" style=" display: flex; flex-direction: column;">
        <h1></h1>
    </ul>



    </div>
    <?php new html_nav_bar('user'); ?>

    <script>
    async function loadTexts() {
        const response = await fetch("/view/user/api.php"); // 🔹 Ton API PHP
        const data = await response.json();

        const list = document.getElementById("list");
        list.innerHTML = "";

        data.forEach(item => {
            const li = document.createElement("li");

            li.innerHTML = `
    <li class="article">
       <img class="img" style="height: 320px;" src="/assets/img_home/${item.img}" alt="Article image" />
            <div class="content">
                <div class="infoProfilPub">
                    <div class="infoImgNom">
                        <img class="img" src="/assets/img_home/${item.img}" alt="">
                        <p>${item.nom}</p>
                    </div>
                        <button class="syganle"><img class="imgPoint" src="/assets/icons/point.png"> </button>

                </div>
      <div class="text-container">${item.text}</div>
       <div class="affichePlus">
      <button class="affichePlusButton">Lire plus</button>
       </div>
           <div class=" footerPub">
                <button class="follow-btn ${item.followed ? "unfollow" : ""}" data-id="${item.id}" >${item.followed ? "Ne plus suivre" : "Suivre"}</button>

                <button class="like-section aimeButton">
                    <img class="like-btn" src="${item.liked ? "/assets/icons/jaime.png" : "/assets/icons/aime.png"}" data-id="${item.id}">
                      <p class="like-count">${item.likes}</p>
                </button>

            </div>
      </li>
    `;

            // Récupérer éléments du li
            const container = li.querySelector(".text-container");
            const toggleBtn = li.querySelector(".affichePlusButton");
            const likeBtn = li.querySelector(".like-btn");
            const likeCount = li.querySelector(".like-count");
            const followBtn = li.querySelector(".follow-btn");

            // Vérifie si texte dépasse 2 lignes
            setTimeout(() => {
                if (container.scrollHeight <= container.clientHeight) {
                    toggleBtn.style.display = "none";
                }
            }, 0);

            // Lire plus / Lire moins
            toggleBtn.addEventListener("click", () => {
                container.classList.toggle("expanded");
                toggleBtn.textContent = container.classList.contains("expanded") ?
                    "Lire moins" :
                    "Lire plus";
            });

            // Gestion du like AJAX
            likeBtn.addEventListener("click", async () => {
                const res = await fetch("/view/user/like.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: item.id
                    })
                });
                const result = await res.json();

                // Met à jour l'affichage
                likeBtn.src = result.liked ? "/assets/icons/jaime.png" : "/assets/icons/aime.png";
                likeCount.textContent = result.likes;
            });

                // Gestion Suivre AJAX
    followBtn.addEventListener("click", async () => {
      const res = await fetch("/view/user/follow.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: item.id })
      });
      const result = await res.json();

      // Mettre à jour le bouton
      if (result.followed) {
        followBtn.textContent = "Ne plus suivre";
        followBtn.classList.add("unfollow");
      } else {
        followBtn.textContent = "Suivre";
        followBtn.classList.remove("unfollow");
      }
    });
            

            list.appendChild(li);
        });
    }

    loadTexts();
    </script>

</body>