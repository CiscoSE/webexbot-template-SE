# Webex Teams Bot - Template

Cisco's Webex Teams offers a wonderful platform for bot creation. However, 
many people who are new to the world of ChatOps and Cisco's REST APIs are
struggling with creation of bots and their integration with existing services.
So, the goal of this project is to provide a simple to use template for
creating and setting up Webex Teams bots. It provides a ready-to-use framework
for bot development with the back-and-forth communication between the Webex
Teams client, the Webex cloud and the bot server already been implemented.
The only thing that the users need to do by themselves is creating the actual
bot functionality.

---
## Table of Contents
  * [1. Requirements](#1-requirements)
  * [2. Setup](#2-setup)
    + [Edit setup file](#edit-setup-file)
    + [Register webhook](#register-webhook)
    + [Create bot logic](#create-bot-logic)

---

## 1. Requirements

In order to run the bot in operation, you need the following:
- A web-server running PHP7
- Reachability to the Webex cloud
- Python 3.X
- Webex Teams bot credentials (**Access token** and **Bot ID**) from **developer.webex.com**

---

## 2. Setup

After copying the repository to your server, the bot need to be set up for development, testing and operation.
This is done in four steps that need to be completed in the following order:
- Install required Python libraries
- Edit `setup.json`
- Register the webhook with `register.py`
- Edit `webexbot.php` to add some functionality to the bot


### Install required Python libraries
Open up the terminal and type in:

```bash
$ pip3 install -r requirements.txt
```

### Edit setup file
The `setup.json` file serves as a container for all the environment variables needed to set up the bot.
By default, all the variables are blank, so you need to fill in your personal information:
- `target_url`: The URL of the folder inside your server where all the bot files are hosted
- `webhook_name`: An arbitrary name for the webhook
- `access_token`: Access token of the bot
- `bot_id`: Bot ID

### Register webhook
As a next step you need to create and register a webhook. For this, open up the console inside the repository folder
and type in:

```bash
$ python3 register.py
```

### Create bot logic
Now, in order to create some functionality for the bot, you need to edit `webexbot.py` inside the `/includes`
folder. Go to the `answer()` function and edit the highlighted part of the code at your will.
