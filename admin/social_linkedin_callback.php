<?php
include 'includes/session.php';
use Happyr\LinkedIn\LinkedIn;
require '../vendor/autoload.php';


// LinkedIn App Credentials
$clientId = '77coo63irl6wod';
$clientSecret = 'OnnooCit3keTi4ZV';
$redirectUri = 'http://localhost/admin/linkedin_callback.php'; // Replace with your redirect URI

$linkedin = new LinkedIn($clientId, $clientSecret);

// Check if LinkedIn returned an error
if (isset($_GET['error'])) {
    echo 'Error: ' . htmlspecialchars($_GET['error_description']);
    exit;
}

// Check if 'code' parameter is present
if (isset($_GET['code'])) {
    try {
        // Exchange authorization code for access token
        $accessToken = $linkedin->getAccessToken($_GET['code'], $redirectUri);
        // Store access token in session
        $_SESSION['linkedin_access_token'] = $accessToken;
        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        echo 'Error obtaining access token: ' . $e->getMessage();
    }
} else {
    echo 'No authorization code found.';
}
?>
