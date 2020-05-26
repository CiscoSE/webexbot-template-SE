<?php

/*
DESCRIPTION: Definition of the WebexBot class

The WebexBot class is an instance of the Webex bot created and deleted dynamically
by addressing it directly in a Webex Teams message. The class object stores all
the information about the current bot instance and the received message to determine
how to respond.
*/

include("webextools.php"); # Import get_message() and send_answer()


class WebexBot{

  var $access_token; # The bot's access token
  var $bot_id; # The bot's ID
  var $message_id; # The ID of the received message
  var $message_text; # The text of the received message
  var $room_id; # The ID of the Webex room the message was send from
  var $should_answer; # Determines whether the message should be responded to


  # Constructor
  function __construct($access_token, $bot_id){
    $this->access_token = $access_token;
    $this->bot_id = $bot_id;

    echo __CLASS__." created";
  }


  # Destructor
  function __destruct(){
    echo __CLASS__." deleted";
  }


  # Determines the message details (ID, text, room)
  public function listen(){
    $webhook_data = json_decode(file_get_contents('php://input'), true);
    $this->message_id = $webhook_data["data"]["id"];

    $message_data = get_message($this->access_token, $this->message_id);

    $this->message_text = $message_data->text;
    $this->room_id = $message_data->roomId;

    # If a message was send by the bot itself, it should not be responded to
    $person_id = $message_data->personId;
    if ($person_id == $this->bot_id){
      $this->should_answer = false;
    } else {
      $this->should_answer = true;
    }
  }


  # Display all the information about the bot instance - use for troubleshooting
  public function print_info(){
    echo $this->message_text;
    echo $this->access_token;
    echo $this->message_id;
    echo $this->message_text;
    echo $this->room_id;
    echo $this->should_answer;
  }


  /*
  Sends the right response to the right room based on the message received

  IMPORTANT: Replace the highlighted code part with your custom bot logic. Make
  sure to always provide a value for the $answer variable, i.e. the markdown response
  to the user's original message. The rest of the code should not be edited!
  */
  public function answer(){
    $access_token = $this->access_token;
    $message_text = $this->message_text;
    $room_id = $this->room_id;

    if ($this->should_answer){

      #-------------------------EDIT THIS PART----------------------------------
      $answer = "<b>ATTENTION:</b>This is an exemplary response.".
                "<br>You can add custom fuctionality for your bot by adding ".
                "logic to the provided template.".
                "<br><b><i>Have fun!</i></b>";
      #-------------------------------------------------------------------------

      send_answer($access_token, $room_id, $answer);
    }
  }

}
?>
