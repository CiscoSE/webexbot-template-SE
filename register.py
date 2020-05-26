# DESCRIPTION: Webhook registration

import requests
import json

# Set the main parameters and headers
url = "https://api.ciscospark.com/v1/webhooks"

with open('setup.json') as setup:
    data = json.load(setup)

headers = {
    'Content-Type': 'application/json',
    'Authorization': 'Bearer ' + data["access_token"]
}


# Get the information about webhooks that might already exist
body = json.dumps({})

response = requests.request("GET", url, headers=headers, data = body)
webhooks = json.loads(response.text)


# Reset environment - delete all existing webhooks
for item in webhooks["items"]:
    url_id = "https://api.ciscospark.com/v1/webhooks/" + item["id"]
    requests.request("DELETE", url_id, headers=headers, data = body)
    print("Webhook deleted")


# Create and register a new webhook
body = {
    "resource": "messages",
	"event": "created",
	"targetUrl": data["target_url"],
	"name": data["webhook_name"]
}
body = json.dumps(body)

response = requests.request("POST", url, headers = headers, data = body)


# Display response
print(response.text.encode('utf8'))
