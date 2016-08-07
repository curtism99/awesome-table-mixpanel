# awesome-table-mixpanel

This website is usedd with [Mipaanel's Export API](https://mixpanel.com/docs/api-documentation/exporting-raw-data-you-inserted-into-mixpanel) to display the raw JSONL data as a user-friendly, readable table. This table can show multiple properties of each tracked event and is used to show individual activities instead of only Mixpanel's segmentation data. This was built for events tracked on a single-page web application.

There are specific keys that are return in the Mixpanel data export. They can be [found here](https://mixpanel.com/docs/api-documentation/exporting-raw-data-you-inserted-into-mixpanel) at the bottom of the page under "Return Form".

This project is built to only include the following relevent fields from being displayed, but you may customize it:

- time
- event
- distinct_id
- city
- region
- country code
- device
- screen height
- screen width

#How To Use
Use your own Mixpanel API Secret Code in `fetch/index.php`
```
$api_secret = 'MIXPANEL_SECRET_KEY';
```


Modify field filters in `js/awesomeTableJs.js` in two following sections:
###Header Creation
```
line 742

if(a.innerHTML == "event") {
    //Modify a's field how we want it to be displayed on the table.
    a.innerHTML = "Event";
    a.innerHTML = "Event";
    th.appendChild(a);
    this.jsonKeys.push(key);
    header.appendChild(th);
} else if (a.innerHTML == "time") {
    a.innerHTML = "Time";
    th.appendChild(a);
    this.jsonKeys.push(key);
    header.appendChild(th);
} else if ... etc ...
```

###Table Population
```
line 837

if(this.jsonKeys[j] == "time") {
    //Format time and date from Unix timecode, then display
    var utcSeconds = td.innerHTML;
    var d = new Date(0); // The 0 there is the key, which sets the date to the epoch
    d.setUTCSeconds(utcSeconds);
    td.innerHTML = d;
    tr.appendChild(td);
} else if(this.jsonKeys[j] == "event") {
    tr.appendChild(td);
} else if ... etc ...
```


##This project relies on the following github repositories:

_Pick the date ranges to submit for Mixpanel Analytics query:_
https://github.com/dangrossman/bootstrap-daterangepicker

_Use the JSONL raw data dump from Mixpanel and display as a table:_
https://github.com/farshadjahanmanesh/awesomeTableJs





