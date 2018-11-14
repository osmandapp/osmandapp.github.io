Documentation about motd_config.json
================================
# Condition properties
**IP** - desired IP Address of client that should receive the message.
```
"ip" : "37.57.120.65"
```


**OS** - defines platform, should be "ios" or "android".   
```
"os": "android"
```


**Date range** - consists of two properties: 'start_date' and 'end_date'. Defines start and end date of the sale.
```
"start_date": "11-10-2018 00:00"
"end_date": "16-10-2018 00:00"
```
Important: Date fields will be propagated to the file itself and override start/end dates in the file.

**OsmAnd Version** - corresponds to 'version' property. Contains version of application. For example, Travel links will be work only from version 3.
```
"version": "3"
```

**Country** - corresponds to 'country' property. Filters by specified country, country is detected from IP.
```
"country" : "Netherlands"
```

**City** - corresponds to 'city' property. Filters by specified city, city is detected from IP.
```
"city" : "Minsk"
```

**Language** - corresponds to 'lang' property. Contains selected in application or provided by platform two-letter codes of language.
```
"lang" : "uk"
```


**File** - contains the json file's name which contains base [motd json properties](#motd-json-properties-android--ios).
```
"file": "discount.json"
```


**Fields** - contains the key-value list of properties. The main purpose of this property is to modify properties in the motd message based on the file designated by 'file' property without altering the 'file'. Each key in the list should match with the property name from [motd json properties](#motd-json-properties-android--ios). In the example below the properties 'message' and 'description' in the file designated by the 'file' property will be substituted by values from the 'fields' property. 
  ``"fields": {
				"message": "Get OsmAnd Unlimited -50%",
				"description": "Cozy autumn sale!"
			}``

### True condition
The true condition is condition which has all true properties. True property is property which is equal to request parameter or starts with/contains request parameter or in case of date range the request parameter satisfies the expression: start_date > date from request < end_date.

All 'conditions' are processed in order from beginning to the end of file to the first true conditon.

### Message modifying
After true condition is found, the 'fields' property is tested for presence of any key-value pairs. If 'fields' property is not empty then properties from 'fields' property is used for modifying original message designated by 'file' property otherwise the original message is returned without modification.




# Motd json properties (Android / IOs)
```
"message" : "Some title"
```
**message** - notification title.

```
"description" : "Some description"
```
**description** - notification description.

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
- **status_bar_color** - color (6 digit hex code) for the status bar. Optional parameter.
  - "status_bar_color" : "#fec601"
- **url** - url, that will be opened on notification click.
  - "url" : "https://osmand.net/travel?title=World_Cup_2018&lang=en" - to open travel article
  - "url" : "osmand-market-app:net.osmand.plus" - to open available market with specified app
  - "url" : "osmand-in-app:osmand_full_version_price" - to purchase full version
  - "url" : "osmand-in-app:osm_live_subscription_2,osm_free_live_subscription_2" - to open choose plan screen
  - "url" : "osmand-search-query:test query" - to open search with "test query" phrase
  - "url" : "osmand-show-poi:bank,tourism" - to show poi overlay on the map
  - "url" : "open_activity" - to open activity specified in the "activity" JSON object
- **application** - JSON object that specifies which applications must show notification.
  -   "application" : { "net.osmand" : true, "net.osmand.plus" : false } - notification will be shown only in the free app
- **show_christmas_dialog** - specify if the Christmas dialog should be displayed instead of notification. Optional parameter.
  - "show_christmas_dialog" : true
- **button_title** - button title.
  - "button_title" : "Some title"
- **button_title_color** - color (6 digit hex code) for the 'button_title' text. Optional parameter.
  - "button_title_color" : "#fec601"
- **activity** - JSON object that specifies which activity will be shown.
  - "activity" : { "activity_name" : "net.osmand.plus.myplaces.FavoritesActivity", "SOME_BOOLEAN_EXTRA" : true } - Favorites activity will be shown. Specified extras will be passed to intent.

# Procedure to deploy changes
