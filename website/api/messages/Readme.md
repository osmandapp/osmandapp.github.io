Documentation about motd_config.json
================================
# Condition properties
### IP  
  Desired IP Address of client that should receive the message
### OS  
  Defines platform, should be "ios" or "android".
### Date range  
  Consists of two properties: 'start_data' and 'end_date'. Defines start and end date of the sale.
### OsmAnd Version
  Corresponds to 'version' property. Contains version of application.
### Langauge
  Corresponds to 'lang' property. Contains selected application or default platform language.  

### True condition. 
The true condition is condition which has all true properties. True property is property which is equal to request parameter or starts with/contains request parameter or in case of date range the request parameter satisfies the expression: start_date > date from request < end_date.

All 'condition' are processed in order from top to bottom to the first true conditon.

### Message modifying
After true condition is found, the 'fields' property is tested for presence of any key-value pairs. If 'fields' property is not empty then properties from 'fields' property is used for modifying original message designated by 'file' property otherwise the original message is returned without modification.

# Example with test ip



# Motd json properties (Android / IOs)
- **message** - notification title.
  - "message" : "Some title"
- **description** - notification description.
  - "description" : "Some description"
- **start** - start of the period in which the notification will be active.
  - "start" : "10-06-2018 00:00"
- **end** - end of the period in which the notification will be active.
  - "end" : "30-06-2018 23:59"
- **show_start_frequency** - number of app starts in which one notification will be shown.
  - "show_start_frequency" : 3 - once per three app starts
- **show_day_frequency** - number of days in which one notification will be shown.
  - "show_day_frequency" : 2 - once per two days
- **max_total_show** - total amount of displays of this specific notification.
  - "max_total_show" : 10
- **icon** - id of the icon for the notification.
  - "icon" : "ic_action_travel"
- **icon_color** - color (6 digit hex code) for the 'icon'. Optional parameter.
  - "icon_color" : "#ffffff"
- **bg_color** - color (6 digit hex code) for the notification background. Optional parameter.
  - "bg_color" : "#fec601"
- **title_color** - color (6 digit hex code) for the 'message' text. Optional parameter.
  - "title_color" : "#000000"
- **description_color** - color (6 digit hex code) for the 'description' text. Optional parameter.
  - "description_color" : "#000000"
- **url** - url, that will be opened on notification click.
  - "url" : "https://osmand.net/travel?title=World_Cup_2018&lang=en" - to open travel article
  - "url" : "osmand-market-app:net.osmand.plus" - to open available market with specified app
  - "url" : "osmand-in-app:osmand_full_version_price" - to purchase full version
  - "url" : "osmand-in-app:osm_live_subscription_2,osm_free_live_subscription_2" - to open choose plan screen
  - "url" : "osmand-search-query:test query" - to open search with "test query" phrase
  - "url" : "osmand-show-poi:bank,tourism" - to show poi overlay on the map
- **application** - JSON object that specifies which applications must show notification.
  -   "application" : { "net.osmand" : true, "net.osmand.plus" : false } - notification will be shown only in the free app
- **show_christmas_dialog** - specify if the Christmas dialog should be displayed instead of notification. Optional parameter.
  - "show_christmas_dialog" : true

# Procedure to deploy changes
