<?php
class ImgFile
{
    public function __construct()
    {
            echo <<<HTML
     <section class='section'>
        <input type="file" id="file" name="image">
        <label for="file">
        <img src="/assets/icons/home.svg" alt="">
        <h2>Ajouter une image de profile</h2>
        </label>
                    </section>
     HTML;


    }
}