<?php
use Abraham\TwitterOAuth\TwitterOAuth;

/*
 * A Controller that will be a REST server using Twitter API
 */

class Search extends Application {

    function index() {
    	// Adds the required libraries in order for twitteroauth to operate
    	require_once "application/helpers/Format.php";
        require_once "application/core/REST_Controller.php";
        require "assets/assets/twitteroauth-0.4.1/autoloader.php";

        // Gets the post data after user inputs and sends data
        $ajaxData = $this->input->get_post('terms');
  
  		//Credentials for twitteroauth
        $access_token = "129586390-CiZA2LBI8HqHScm1QA3S5T1VQIEMm4JphAMt9zkK";
        $access_token_secret = "b4hYDICxgk1u1auN5HP4Sit0MdIw4d8IFSdieok52VlJr";

        //Makes a connection from TwitterOAuth
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);

        //Get'ts the tweets that have the word(s) taken from ajax call
        $statues = $connection->get("search/tweets", array("count" => 25, "q" => $ajaxData));

        //JSON data is now in the jsonobj object and ready to be used
        $jsonobjString = json_encode($statues, JSON_PRETTY_PRINT);
        $jsonObj = json_decode($jsonobjString, true);
        // print_r($jsonObj);

        // Create a 2D array that will hold the tweets header information and text
        $newArrayOfJSON = array();
       	foreach ($jsonObj['statuses'] as $tweet)
		{
			$tempArray = array(
				"user_name" => $tweet['user']['screen_name'],
				"profile_image" => $tweet['user']['profile_image_url'],
				"tweet_text" => $this->linkify_twitter_status($tweet['text']),
				"create_date" => $tweet['created_at'],
				);
			$newArrayOfJSON[] = $tempArray;
		    // echo "name         : ". $tweet['user']['screen_name'] ."\n";
		    // echo "profile image: ". $tweet['user']['profile_image_url'] ."\n";
		    // echo "text         : ". $tweet['text'] ."\n";
		    // echo "created_on   : ". $tweet['created_at'] ."\n";
		};
		// Send the data back to the ajax request
		echo (json_encode($newArrayOfJSON));
        // echo $jsonobjString;


    }
    //A function that will replace all th url, hashtag, and usernames 
    //with the proper tag around it
    function linkify_twitter_status($status_text)
    {
      // linkify URLs
      $status_text = preg_replace(
        '/(https?:\/\/\S+)/',
        '<a href="\1">\1</a>',
        $status_text
      );

      // linkify twitter users
      $status_text = preg_replace(
        '/(^|\s)@(\w+)/',
        '\1@<a href="http://twitter.com/\2">\2</a>',
        $status_text
      );

      // linkify tags
      $status_text = preg_replace(
        '/(^|\s)#(\w+)/',
        '\1#<a href="http://search.twitter.com/search?q=%23\2">\2</a>',
        $status_text
      );

      return $status_text;
    }

}
