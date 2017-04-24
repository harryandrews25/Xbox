<?php

include_once("alexa.php");
include_once("xboxon.php");

$Alexa = new Alexa();
$Xbox = new XboxOn();

// Set alexa app specific data
$Alexa->setApplicationID("amzn1.ask.skill.12345678-1234-1234-1234-123456789123");  // Set the application ID for your skill here
$Alexa->setApplicationName("Xbox On");  // Change this to whatever you are calling your app

// Set Xbox IP address and live ID
$Xbox->setIPAddress("192.168.0.14");  // Set the public IP address of your Xbox here
$Xbox->setXboxLiveID("FD000FB966D73C38");  // Set the Xbox live ID here

// Authenticate request and execute
if($Alexa->auth()) {
    if($Xbox->ping()) {
        $Alexa->setCard("Xbox is already on.");
        $Alexa->setReprompt("");
        $Alexa->setOutputSpeech("Your xbox has already been turned on.");
    }
    else {
        if($Xbox->switchOn()) {
            $Alexa->setCard("Xbox is now on.");
            $Alexa->setReprompt("");
            $Alexa->setOutputSpeech("Your xbox is now turned on.");
        }
        else {
            $Alexa->setCard("Xbox couldn't be turned on.");
            $Alexa->setReprompt("");
            $Alexa->setOutputSpeech("Your Xbox could not be turned on. Please try again.");
        }
    }
    
    $Alexa->displayOutput();
}

?>
