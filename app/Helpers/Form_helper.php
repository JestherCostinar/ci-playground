<?php 

function form_validator($validation, $field) {
    if($validation->hasError($field)) {
        return $validation->getError($field);
    }
}

?>
