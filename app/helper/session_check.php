<?php

function sessionCheck()
{
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['notLogin'] = "Harap login terlebih dahulu sebelum menerbitkan informasi";
    }
}
