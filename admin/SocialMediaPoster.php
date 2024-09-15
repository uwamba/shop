<?php

use Abraham\TwitterOAuth\TwitterOAuth;
use LinkedIn\Client;
use LinkedIn\Scope;

class SocialMediaPoster
{
    private $apiID;
    private $apiSecret;
    private $consumerId;
    private $consumerSecret;
    private $oauthToken;
    private $oauthTokenSecret;


    // Constructor to initialize API credentials
    public function __construct($apiID, $apiSecret, $consumerId, $consumerSecret, $oauthToken, $oauthTokenSecret)
    {

        $this->apiID = $apiID;
        $this->apiSecret = $apiSecret;
        $this->consumerId = $consumerId;
        $this->consumerSecret = $consumerSecret;
        $this->oauthToken = $oauthToken;
        $this->oauthTokenSecret = $oauthTokenSecret;
    }

    // Post to Twitter
    public function postToTwitter($message)
    {

        $connection = new TwitterOAuth($this->consumerId, $this->consumerSecret, oauthToken: $this->oauthToken, oauthTokenSecret: $this->oauthTokenSecret);
        // $content = $connection->get("account/verify_credentials");
        $connection->setApiVersion(2);
        //$media1 = $connection->upload('media/upload', ['media' => '/path/to/file/kitten1.jpg']);
        //$media2 = $connection->upload('media/upload', ['media' => '/path/to/file/kitten2.jpg'], ['chunkedUpload' => true]);
        //$connection->setApiVersion(2);
        //$parameters = [
           // 'text' => 'Meow Meow Meow',
            //'media' => ['media_ids' => [$media1->media_id_string, $media2->media_id_string]]
        //];
        //$result = $connection->post('tweets', $parameters, ['jsonPayload' => true]);
        $parameters = [
            'text' => 'on twitter',

        ];
        $result = $connection->post('tweets', $parameters, ['jsonPayload' => true]);

        echo "Posting to Twitter: $message\n";
    }

    // Post to Facebook
    public function postToFacebook($message)
    {
        // You can use Facebook's SDK: https://github.com/facebook/php-graph-sdk
        // $fb = new \Facebook\Facebook([
        //     'app_id' => $this->apiID,
        //     'app_secret' => $this->apiSecret,
        //     'default_graph_version' => 'v10.0',
        // ]);
        // $fb->post('/me/feed', ['message' => $message]);

        echo "Posting to Facebook: $message\n";
    }

    // Post to Instagram
    public function postToInstagram($message)
    {
        // You need to use Instagram's Graph API, which works through Facebook SDKs
        // See Instagram API documentation: https://developers.facebook.com/docs/instagram-api
        // This will also require media (photo or video), as Instagram does not support plain text posting via API

        echo "Posting to Instagram: $message\n";
    }

    // Post to TikTok
    public function postToTikTok($message)
    {
        // TikTok's API might require setting up a TikTok Developer account.
        // Refer to TikTok's API documentation: https://developers.tiktok.com/

        echo "Posting to TikTok: $message\n";
    }

    // Post to LinkedIn
    public function postToLinkedIn($message)
    {
        // LinkedIn uses OAuth2 for API access. You can use the LinkedIn API for posting.
        // Documentation: https://docs.microsoft.com/en-us/linkedin/

        echo "Posting to LinkedIn: $message\n";
    }
}

// Example usage
$apiID = 'your-api-id';
$apiSecret = 'your-api-secret';
//$socialMediaPoster = new SocialMediaPoster($apiID, $apiSecret);

// Posting example
//$socialMediaPoster->postToTwitter("Hello Twitter!");
//$socialMediaPoster->postToFacebook("Hello Facebook!");
//$socialMediaPoster->postToInstagram("Hello Instagram!");
//$socialMediaPoster->postToTikTok("Hello TikTok!");
//$socialMediaPoster->postToLinkedIn("Hello LinkedIn!");
