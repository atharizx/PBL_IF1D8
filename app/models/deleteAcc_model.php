<?php

function deleteAcc($conn, $id)
{
    $query = "DELETE FROM adminlog WHERE id='$id'";

    $queryRun = mysqli_query($conn, $query);

    return $queryRun;
}