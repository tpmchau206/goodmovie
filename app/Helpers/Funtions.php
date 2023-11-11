<?php

use App\Models\Admin\Groups;
use App\Models\User;

function getAllGroups()
{
    $groups = new Groups();
    // dd($groups);
    return $groups->getAll();
}

function getUser($id)
{
    $userCheck = new User();
    return $userCheck->getUser($id);
}
