<?php
function countAge($userDateOfBirthdate)
{
    $userDateOfBirthdate = date("Y-m-d", strtotime($userDateOfBirthdate));
    $currentYear = new DateTime("now");

    $userDOB = new DateTime($userDateOfBirthdate);

    $interval = $currentYear->diff($userDOB);

    $year = $interval->y;

    return $year;
}
