<?php

/*
DESCRIPTION: Main document of the Webex bot application

The application listens to a webhook from Webex Teams generated by addressing
the bot in a message and decides how to respond to it. The response is based on
the bot logic defined in webexbot.php
*/

include_once("includes/webexbot.php"); # Imports WebexBot class

# Bot data is read from setup.json
$setup_string = file_get_contents("setup.json");
$setup_array = json_decode($setup_string, true);

# Identifying the bot
$ACCESS_TOKEN = $setup_array["access_token"];
$BOT_ID = $setup_array["bot_id"];

# Initialize a new bot instance after receiving a new message
$bot = new WebexBot($ACCESS_TOKEN, $BOT_ID);

# The bot listens to the message and decides whether and how to respond
$bot->listen();

# Display info on the bot and the message received - use for troubleshooting
$bot->print_info();

# The bot sends a response if necessary
$bot->answer();

# The bot instance is deleted
exit();

?>
