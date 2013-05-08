<?php

foreach($this->category as $key => $value) {
    echo '<img src='.ROOT.'images/icons/'.'category_'.$value['cat_id'].'.jpg'." width=$this->width"." height=$this->height".'>';
    echo '<a href='.ROOT.'category/writing/'.$value['order'].'>'.$value['name'].'</a><br>';
}

?>