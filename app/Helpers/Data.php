<?php
if (!function_exists('dataTreee')) {
    function dataTree($array, $parent, $check = 0, $level = 0)
    {
        $data = '';
        foreach ($array as  $val) {
            if ($val['parent_id'] == $parent) {
                if ($val['id'] == $check)
                    $data .= "<option data-parent=" . $val['parent_id'] . " value=" . $val['id'] . " selected>" . str_repeat('--', $level) . $val['name'] . "</option>";
                else $data .= "<option data-parent=" . $val['parent_id'] . " value=" . $val['id'] . ">" . str_repeat('--', $level) . $val['name'] . "</option>";
                $childData = dataTree($array, $val['id'], $check, $level + 1);
                if (!empty($childData)) {
                    $data .= $childData;
                }
            }
        }
        return $data;
    }
}
if (!function_exists('deleteImgFromFile')) {
    function deleteImgFromFile($path)
    {
        $image_path = public_path() . '\storage\\' . $path;
        if (file_exists($image_path))
            unlink($image_path);
    }
}

if (!function_exists('menuMultipleLevel')) {
    function menuMultipleLevel($array, $parent, $check = 0, $level = 3)
    {
        $data = '';
        foreach ($array as  $val) {
            if ($val['parent_id'] == $parent) {
                $childData = menuMultipleLevel($array, $val['id'], $check, $level + 1);
                if (!empty($childData)) {
                    $data .= "<li><a class='' style='color:black;' data-toggle='collapse' href='#cate-" . $val['id'] . "' role='button'>
                    <i class='bi bi-caret-down'></i><span class='menu-title ml-2'>" . $val['name'] . "</span></a>
                                      <div class='collapse' id='cate-" . $val['id'] . "'>
                                        <ul class='nav flex-column sub-menu mt-1 ml-" . $level . "'>";
                    $data .= $childData;
                    $data .= "</ul></div></li>";
                } else {
                    $data .= "<li>
                    <input type='radio' class='mr-2 category' name='categories' value=" . $val['id'] . " id=category-" . $val['id'] . ">
                    <label for=category-" . $val['id'] . ">" . $val['name'] . "</label></li>";
                }
            }
        }
        return $data;
    }
}
