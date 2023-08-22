<?php
if (!function_exists('isAdmin')) {
    function isAdmin($user)
    {
        return in_array($user->role, [1, 2]);
    }
}
function pre($text)
{
    print "<pre>";
    print_r($text);
    die;
}
?>