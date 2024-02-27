<?php
if (!function_exists('isAdmin')) {
    function isAdmin($user)
    {
        return in_array($user->role, [1, 2]);
    }
}
if (!function_exists('pre')) {
    function pre($text)
    {
        print "<pre>";
        print_r($text);
        exit();
    }
}
if (!function_exists('getCategories')) {
    function getCategories()
    {
        return \App\Models\ProductArt::all();
    }
}

if (!function_exists('getcountries')) {
    function getcountries()
    {
        return \App\Models\Country::all();
    }
}

if (!function_exists('getCountryNameById')) {
    function getCountryNameById($countryId) {
        return App\Models\Country::find($countryId)->name;
    }
}

if (!function_exists('getUnitByVolumeType')) {
    function getUnitByVolumeType($volumeType)
    {
        switch ($volumeType)
        {
            case 1:
                return ['unit' => 'ml', 'image' => asset('frontend/img/ml-icon.svg')];
            case 2:
                return ['unit' => 'caps', 'image' => asset('frontend/img/caps-icon.svg')];
            case 3:
                return ['unit' => 'tabs', 'image' => asset('frontend/img/tabs-icon.svg')];
            default:
                return ['unit' => '', 'image' => asset('frontend/img/spec-icon.svg')];
        }
    }
}

if (!function_exists('getArtIcon')) {
    function getArtIcon($artName)
    {
        $imagePaths = [
            "Inject"    => "inject.svg",
            "Peptides"  => "peptides.svg",
            "Capsules"  => "capsules.svg",
            "Sarms"     => "sarms.svg",
            "Tablets"   => "tablets.svg",
            "Liquids"   => "liquid.svg",
        ];

        $imageName = $imagePaths[$artName] ?? 'spec-icon.svg';

        return ['image' => asset("frontend/img/{$imageName}")];
    }
}

?>