<?php
$totalMessages = $db->query("SELECT COUNT(*) FROM $table")->fetchColumn();

$numberElementsByPage = 6;

$pageNumber = ceil($totalMessages / $numberElementsByPage);

$page = $_GET["page"];
if (isset($page) && (int)$page > 0 && $page !== null) {
    $currentPage = intval($_GET["page"]);

    if ($currentPage > $pageNumber) {
        $currentPage = $pageNumber;
    }
} else {
    $currentPage = 1;
}

$offset = ($currentPage - 1) * $numberElementsByPage;