<?php new html(); ?>

<body>
<?php  new Retoure('/user/parametre'); ?>

     <div style=" margin-bottom: 5rem;"></div>
    

    <div class='div_blok'>

        <section class='section'>
            <h1 style="font-size: 1.2rem;" >Supermarché</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero aut odio modi laborum minima facilis et,
                pariatur, saepe ipsa ea vel iusto officiis ut sit autem minus aliquam, sed quibusdam.</p>
            <div style=" margin-bottom: 1.5rem;"></div>
            <a class='a_linc_botton' href="/offre/"> Créer un compte supermarché </a>
            <div style=" margin-bottom: 1rem;"></div>
        </section>

        <section class='section'>
            <h1 style="font-size: 1.2rem;">Boutique</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero aut odio modi laborum minima facilis et,
                pariatur, saepe ipsa ea vel iusto officiis ut sit autem minus aliquam, sed quibusdam.</p>
            <div style=" margin-bottom: 1.5rem;"></div>
            <a class='a_linc_botton' href="/offre/boutique"> Créer une Boutique </a>
            <div style=" margin-bottom: 1rem;"></div>
        </section>

        <section class='section'>
            <h1 style="font-size: 1.2rem;">Restaurant</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Libero aut odio modi laborum minima facilis et,
                pariatur, saepe ipsa ea vel iusto officiis ut sit autem minus aliquam, sed quibusdam.</p>
            <div style=" margin-bottom: 1.5rem;"></div>
            <a class='a_linc_botton' href="/offre/"> Créer un Restaurant </a>
            <div style=" margin-bottom: 1rem;"></div>
        </section>
    </div>
    <div style=" margin-bottom: 10rem;"></div>
    <?php new html_nav_bar(info: 'offre'); ?>
</body>