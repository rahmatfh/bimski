<?php
if (!file_exists($mod . '.php')) {

    echo "page not found!";
} else {
    include $mod . '.php';
}
