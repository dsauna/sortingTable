
    <?php

    /*

     This is an example intended to show how to access the Lotame ReST API.

     We use simple classes available in the PHP 5.3.6 distro for simplicity

     There may be more efficient ways to parse the XML and JSON, especially using other
     libraries, but that is not the focus of the example.

     This example also does not include an error handling - You should
     make sure that you do include error handling with any code, but especially
     when working with an external API!
    */

    // make sure you install php5-curl and libxml



    // Set up our username and password
    $username = 'dsauna@gmail.com';
    $password = 'yomismo';

    // set up our request to get the token
    $restUrl = 'https://api.lotame.com/';

    // urlencode the post args
    $postargs = 'email='.urlencode($username).'&password='.urlencode($password);

    // initialize the curl session
    $session = curl_init($restUrl);

    // set up our curl options for posting the args
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $postargs);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // run curl, get the token
    $token = curl_exec($session);
    curl_close($session);

    // You can see the form of the token here



    // set our REST url to get what we want, in this case an audience list
    $restUrl = "https://api.lotame.com/as/audiences";

    // Initiate the session with the new end point
    $session = curl_init($restUrl);

    // Add the token to the header


    //first let's update the header
    curl_setopt($session,CURLOPT_HTTPHEADER,array("Authorization: $token","Accept: application/json"));
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    //Make our request
    $jsonResponse = curl_exec($session);

    // You can see the JSON we get back
    echo ("$jsonResponse");


    /*
      Lets's decode our string and then loop through, getting our
      audiences.  We are treating everything as an array.
      If we had wanted to work with objects instead we would use

        $jsonAudienceList = json_decode($jsonResponse);

      instead and then loop through objects instead of arrays.
    */
    $jsonAudienceList = json_decode($jsonResponse, true);



    // close the session
    curl_close($session);


    ?>
