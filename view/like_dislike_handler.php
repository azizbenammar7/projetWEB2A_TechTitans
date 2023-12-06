<?php
include '../controller/pubC.php';

$pubC = new PubC();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['publication_id'])) {
    $action = $_POST['action'];
    $publicationId = $_POST['publication_id'];

    // Perform necessary database update based on $action and $publicationId
    if ($action === 'like') {
        $pubC->likePublication($publicationId);
    } elseif ($action === 'dislike') {
        $pubC->dislikePublication($publicationId);
    }

    // Return the updated count as JSON
    $response = [
        'success' => true,
        'newCount' => $pubC->getLikeDislikeCount($publicationId, $action), // Implement this function in pubC.php
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
} else {
    // Invalid request
    http_response_code(400);
    exit('Invalid request');
}
?>
