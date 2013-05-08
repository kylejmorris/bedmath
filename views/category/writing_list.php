<?php
foreach($this->pagination as $value) {
	echo '<a href='.ROOT.'category/writing/'.$this->cat_id.'/'.$value.'/'.$this->limit.'/'.$this->order.'>'.$value.', </a>';
}
$thumbWidth = $this->thumbWidth; 
$thumbHeight = $this->thumbHeight; 
if(!empty($this->list)) { 
    foreach($this->list as $key => $value) {
        if($value['activated']==1) { //Check to see if content is activated before displaying in list
	    echo "<img src=".IMAGE_ROOT.$value['image_name'].'.'.$value['file_type'].' width='.$thumbWidth.' height='.$thumbHeight.'>'; //generate image url using data from $value array.
            echo "<a href=".ROOT."read/writing/".$value['content_id'].">".$value['title']."</a>".'<br>'; //Displaying every value based on array key
            echo $value['description'].'<br>';
            echo '<b>Views: </b>'.$value['views'].'<br>'; //View count on content
            echo '<b>Unlocks: </b>'.$value['unlock_count'].'<br>'; //Unlock count on content
	    echo '<b>Author: </b>'.$value['author'].'<br>'; //Authors username
        }
    }
} else {
    echo 'no content in this category, sorry pal!';
}
?>