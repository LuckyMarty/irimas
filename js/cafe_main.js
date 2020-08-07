
 $ini = 0;
function cotisation(e) {

        switch ($ini) {
            case 0:
                e.previousSibling.value = 0;
                e.value = 0;
                return $ini = 1;
                break;
            case 1:
                e.previousSibling.value = 1;
                e.value = 1;
                return $ini = 2;
                break;
            case 2:
                e.previousSibling.value = "2";
                e.value = "2";
                return $ini = 0;
                break;
        } 
}