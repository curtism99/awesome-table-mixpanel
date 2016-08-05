# awesome-table-mixpanel

This allows you to use Mixpanel's Export API to display the raw JSONL data as a user-friendly, readable table. This was built to receive and read single-page web app analytics.

Mixpanel's info on exporting raw data:

https://mixpanel.com/docs/api-documentation/exporting-raw-data-you-inserted-into-mixpanel

It is built to only include the following relevent fields from being displayed, but you may customize it:

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


Modify field filters in `js/awesomeTableJs.js` in two sections:
```
line 742

if(a.innerHTML == "event") {
    th.appendChild(a);
    this.jsonKeys.push(key);
    header.appendChild(th);
} else if (a.innerHTML == "time") {
    th.appendChild(a);
    this.jsonKeys.push(key);
    header.appendChild(th);
} else if ... etc ...
```
and
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





