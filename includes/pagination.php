<?php
function paginate($items, $page = 1, $perPage = 5) {
    $page = max(1, $page);
    $totalItems = count($items);
    $totalPages = ceil($totalItems / $perPage);
    $offset = ($page - 1) * $perPage;
    
    $paginatedItems = array_slice($items, $offset, $perPage);
    
    return [
        'items' => $paginatedItems,
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'perPage' => $perPage
    ];
}
?>

