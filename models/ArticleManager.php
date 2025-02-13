<?php
class ArticleManager extends Model
{
    public function getArticle(){
        return $this->recTable('article', 'Article');
    }
}
    ?>
    