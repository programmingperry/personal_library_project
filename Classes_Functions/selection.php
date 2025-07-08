<?php 

class Genre {
    private $gID;
    private $genreTitle;

    function __construct($gID, $genreTitle) {
        $this->gID = $gID;
        $this->genreTitle = $genreTitle;
    }

    function writeSelection() {
        echo "<option value='{$this->genreTitle}'>{$this->genreTitle}</option>";
    }

}