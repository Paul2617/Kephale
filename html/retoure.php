<?php
class  Retoure 
{
    public function __construct ($link = null){
  if($link !== false){
     echo <<<HTML
     <div class='nav_bare' style='z-index: 50;' >
      <style>
      .retoure{
        width: 30px; 
        height: 30px;
        background-color: #ffffff69;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 100px;

      }
      </style>
        <section class='retoure'>
            <a style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; z-index: 50;" href="$link"><</a>
        </section>
     </div>
     HTML;
  }


    }
}