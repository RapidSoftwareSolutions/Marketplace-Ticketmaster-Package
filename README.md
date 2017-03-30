[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Ticketmaster/functions?utm_source=RapidAPIGitHub_TicketmasterFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Ticketmaster Package
Ticketmaster
* Domain: [Ticketmaster](http://ticketmaster.com)
* Credentials: apiKey, clientSecret

## How to get credentials: 
0. Go to [Ticketmaster website](http://ticketmaster.com)
1. Register or log in
2. Create your application at [Developers page](https://developer-acct.ticketmaster.com) to get apiKey and clientSecret

## Ticketmaster.getAccessToken
Get user access token

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Client key from Ticketmaster
| clientSecret| credentials| Client secret from Ticketmaster
| redirectUri | String     | Redirect uri for your application
| code        | String     | Code provided by user

## Ticketmaster.getUser
Get user information

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| user access token

## Ticketmaster.refreshAccessToken
Get user access token

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Client key from Ticketmaster
| clientSecret| credentials| Client secret from Ticketmaster
| refreshToken| String     | Refresh token received in getAccessToken block

## Ticketmaster.createEvents
Publish events accessible within the Discovery API.

| Field                | Type       | Description
|----------------------|------------|----------
| apiKey               | credentials| Api key for PUBLISHING API
| active               | Boolean    | true if the entity is active; inactive entity won’t appear in Discovery API.
| additionalInfos      | JSON       | Map of locale to value for any additional informations on the event.
| attractions          | Array      | List of attractions in the event.
| classifications      | Array      | List of classifications for the event.
| startDate            | JSON       | The start date of the event.
| accessDate           | JSON       | The access date of the event.
| endDate              | JSON       | The end date of the event.
| timezone             | String     | The timezone of the event.
| descriptions         | JSON       | Map of locale to value for the description of the event.
| infos                | JSON       | Map of locale to value for any informations on the event.
| images               | Array      | List of images of the event.
| names                | JSON       | Map of locale to value for the names of the event.
| placeNames           | JSON       | Map of locale to value for the names of the place.
| placeAddressLine1    | JSON       | map of locale to value for the first line of the address.
| placeAddressLine2    | JSON       | map of locale to value for the second line of the address.
| placeAreaNames       | JSON       | map of locale to value for the names of the area.
| placeCityNames       | JSON       | map of locale to value for the names of the city.
| placeCountryCode     | String     | the code of the country of the event.
| placeCountryNames    | JSON       | map of locale to value for the names of the country.
| placeLatitude        | String     | the latitude of the event location.
| placeLongitude       | String     | the longitude of the event location.
| placePostalcode      | String     | the postal code of the place of the event.
| placeStateNames      | JSON       | map of locale to value for the names of the state.
| placeStateCode       | JSON       | the code of the state of the event.
| pleaseNotes          | JSON       | map of locale to value for any notes related to the event.
| priceRangesType      | String     | type of price
| priceRangesCurrency  | String     | currency code (as defined by ISO-4217)
| priceRangesMin       | String     | minimum price
| priceRangesMax       | String     | maximum price
| promoterId           | String     | id of the promoter
| promoterNames        | JSON       | map of locale to value for the names of the promoter
| promoterDescriptions | JSON       | map of locale to value for the descriptions of the promoter
| publicVisibilityStart| String     | the start date and time of visibility for this event on the Discovery API in UTC.
| publicVisibilityEnd  | String     | the end date and time of visibility for this event on the Discovery API in UTC.
| publicVisibilityState| Boolean    | true if the event should be visible on the Discovery API, false otherwise. (if not specified: true)
| publicSalesEnd       | String     | the date and time of the end of the public sales period in UTC.
| publicSalesStart     | String     | the date and time of the start of the public sales period in UTC.
| publicSalesTBD       | Boolean    | true if the public sale date start is to be determined, false otherwise.
| sourceId             | String     | the publisher’s id of the event.
| sourceName           | String     | the publisher’s name.
| test                 | Boolean    | true if this is a test event data, false otherwise (real event).
| url                  | String     | the URL of the event on the publisher’s site.
| venue                | JSON       | the URL of the event on the publisher’s site.
| version              | String     | the publisher’s version for this event.

## Ticketmaster.searchEvents
Find events and filter your search by location, date, availability, and much more.

| Field              | Type       | Description
|--------------------|------------|----------
| apiKey             | credentials| Client key from Ticketmaster
| sort               | String     | Sorting order of the search result. Example value: relevance,desc
| latLong            | String     | Filter events by latitude and longitude
| radius             | String     | Radius of the area in which we want to search for events.
| unit               | String     | Unit of the radius. Possible values:miles, km
| startDateTime      | String     | Filter events with a start date after this date
| endDateTime        | String     | Filter events with a start date before this date
| onsaleStartDateTime| String     | Filter events with onsale start date after this date
| onsaleEndDateTime  | String     | Filter events with onsale end date before this date
| countryCode        | String     | Filter events by country code
| stateCode          | String     | Filter events by state code
| venueId            | String     | Filter events by venue id
| attractionId       | String     | Filter events by attraction id
| segmentId          | String     | Filter events by segment id
| segmentName        | String     | Filter events by segment name
| classificationName | String     | Filter events by classification name: name of any segment, genre, sub-genre, type, sub-type
| classificationId   | String     | Filter events by classification id: id of any segment, genre, sub-genre, type, sub-type
| marketId           | String     | Filter events by market id
| promoterId         | String     | Filter events by promoter id
| dmaId              | String     | Filter events by dma id
| includeTBA         | String     | True, to include events with date to be announce (TBA). String enum:[yes, no, only]
| includeTBD         | String     | True, to include event with a date to be defined (TBD). String enum:[yes, no, only]
| clientVisibility   | String     | Filter events by clientName
| keyword            | String     | Keyword to search on
| eventId            | String     | Filter entities by its id
| source             | String     | Filter entities by its source name. String enum:[ticketmaster, universe, frontgate, tmr]
| includeTest        | String     | True if you want to have entities flag as test in the response. Only, if you only wanted test entities. String enum:[yes, no, only]
| pageNumber         | Number     | Page number
| pageSize           | Number     | Page size
| locale             | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.getSingleEvent
Get details for a specific event using the unique identifier for the event. This includes the venue and location, the attraction(s), and the Ticketmaster Website URL for purchasing tickets for the event.

| Field  | Type       | Description
|--------|------------|----------
| apiKey | credentials| Client key from Ticketmaster
| eventId| String     | ID of the event
| locale | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.getSingleEventImages
Get images for a specific event using the unique identifier for the event.

| Field  | Type       | Description
|--------|------------|----------
| apiKey | credentials| Client key from Ticketmaster
| eventId| String     | ID of the event
| locale | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.searchAttractions
Find attractions (artists, sports, packages, plays and so on) and filter your search by name, and much more.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Client key from Ticketmaster
| sort        | String     | Sorting order of the search result. Example value: relevance,desc
| keyword     | String     | Keyword to search on
| attractionId| String     | Filter attractions by its id
| source      | String     | Filter entities by its source name. String enum:[ticketmaster, universe, frontgate, tmr]
| includeTest | String     | True if you want to have entities flag as test in the response. Only, if you only wanted test entities. String enum:[yes, no, only]
| pageNumber  | Number     | Page number
| pageSize    | Number     | Page size
| locale      | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.getSingleAttraction
Get details for a specific attraction using the unique identifier for the attraction.

| Field       | Type       | Description
|-------------|------------|----------
| apiKey      | credentials| Client key from Ticketmaster
| attractionId| String     | ID of the attraction
| locale      | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.searchClassification
Find classifications and filter your search by name, and much more. Classifications help define the nature of attractions and events.

| Field           | Type       | Description
|-----------------|------------|----------
| apiKey          | credentials| Client key from Ticketmaster
| sort            | String     | Sorting order of the search result. Example value: relevance,desc
| keyword         | String     | Keyword to search on
| classificationId| String     | Filter classifications by its id
| source          | String     | Filter entities by its source name. String enum:[ticketmaster, universe, frontgate, tmr]
| includeTest     | String     | True if you want to have entities flag as test in the response. Only, if you only wanted test entities. String enum:[yes, no, only]
| pageNumber      | Number     | Page number
| pageSize        | Number     | Page size
| locale          | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.getSingleClassification
Get details for a specific segment, genre, or sub-genre using its unique identifier.

| Field           | Type       | Description
|-----------------|------------|----------
| apiKey          | credentials| Client key from Ticketmaster
| classificationId| String     | ID of the classification
| locale          | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.getSingleGenre
Get details for a specific genre using its unique identifier.

| Field  | Type       | Description
|--------|------------|----------
| apiKey | credentials| Client key from Ticketmaster
| genreId| String     | ID of the classification
| locale | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.getSingleSegment
Get details for a specific segment using its unique identifier.

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| Client key from Ticketmaster
| segmentId| String     | ID of the segment
| locale   | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.searchVenues
Find venues and filter your search by name, and much more.

| Field      | Type       | Description
|------------|------------|----------
| apiKey     | credentials| Client key from Ticketmaster
| sort       | String     | Sorting order of the search result. Example value: relevance,desc
| keyword    | String     | Keyword to search on
| venueId    | String     | Filter venues by its id
| source     | String     | Filter entities by its source name. String enum:[ticketmaster, universe, frontgate, tmr]
| includeTest| String     | True if you want to have entities flag as test in the response. Only, if you only wanted test entities. String enum:[yes, no, only]
| pageNumber | Number     | Page number
| pageSize   | Number     | Page size
| locale     | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.
| countryCode| String     | Filter events by country code
| stateCode  | String     | Filter events by state code

## Ticketmaster.getSingleVenue
Get details for a specific venue using the unique identifier for the venue.

| Field  | Type       | Description
|--------|------------|----------
| apiKey | credentials| Client key from Ticketmaster
| venueId| String     | ID of the venue
| locale | String     | The locale in ISO code format. Multiple comma-separated values can be provided. When omitting the country part of the code (e.g. only 'en' or 'fr') then the first matching locale is used.

## Ticketmaster.getEventOffers
Returns Event Offers.

| Field  | Type       | Description
|--------|------------|----------
| apiKey | credentials| Client key from Ticketmaster
| eventId| String     | ID of the event

## Ticketmaster.createCart
Returns Event Offers.

| Field             | Type       | Description
|-------------------|------------|----------
| apiKey            | credentials| Client key from Ticketmaster
| pollingCallbackUrl| String     | Client webhook URI where response will be posted if the operation polls.
| products          | Array      | Container of add product requests.

## Ticketmaster.getSingleCart
Returns the cart.

| Field | Type       | Description
|-------|------------|----------
| apiKey| credentials| Client key from Ticketmaster
| cartId| String     | ID of the cart

## Ticketmaster.updateCartProducts
This operation allows users to add or remove products to/from a cart.

| Field             | Type       | Description
|-------------------|------------|----------
| apiKey            | credentials| Client key from Ticketmaster
| pollingCallbackUrl| String     | Client webhook URI where response will be posted if the operation polls.
| products          | Array      | Container of add product requests.
| cartId            | String     | ID of the cart

## Ticketmaster.getDeliveries
Returns the deliveries.

| Field | Type       | Description
|-------|------------|----------
| apiKey| credentials| Client key from Ticketmaster
| cartId| String     | ID of the cart

## Ticketmaster.addDeliveriesToCart
This operation allows users to add deliveries to a cart.

| Field             | Type       | Description
|-------------------|------------|----------
| apiKey            | credentials| Client key from Ticketmaster
| pollingCallbackUrl| String     | Client webhook URI where response will be posted if the operation polls.
| deliveries        | Array      | Container of add delivery requests.
| cartId            | String     | ID of the cart

## Ticketmaster.addDeliveriesToCart
This operation allows users to add one or more payments to a cart.

| Field             | Type       | Description
|-------------------|------------|----------
| apiKey            | credentials| Client key from Ticketmaster
| pollingCallbackUrl| String     | Client webhook URI where response will be posted if the operation polls.
| payments          | Array      | Container of add payments requests.
| cartId            | String     | ID of the cart

## Ticketmaster.getPayments
This operation returns available payment options

| Field | Type       | Description
|-------|------------|----------
| apiKey| credentials| Client key from Ticketmaster
| cartId| String     | ID of the cart

## Ticketmaster.getOptions
This operation returns available payment options plus information about deliveries

| Field | Type       | Description
|-------|------------|----------
| apiKey| credentials| Client key from Ticketmaster
| cartId| String     | ID of the cart

## Ticketmaster.emptyCart
This operation empties the cart.

| Field | Type       | Description
|-------|------------|----------
| apiKey| credentials| Client key from Ticketmaster
| cartId| String     | ID of the cart

## Ticketmaster.completeCartPurchase
This operation empties the cart.

| Field             | Type       | Description
|-------------------|------------|----------
| apiKey            | credentials| Client key from Ticketmaster
| cartId            | String     | ID of the cart
| pollingCallbackUrl| String     | Client webhook URI where response will be posted if the operation polls.

