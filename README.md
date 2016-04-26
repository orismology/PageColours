# Piwik PageColours Plugin

## Description

Replaces the rainbow of colourful folder icons in Piwik's "Visitors in Real-time" widget with colourful folder icons that match user-defined url patterns.

Considered in early beta - not stable, but it hasn't broken anything yet.

If you decide to use it, here's some things you need to know:

* The plugin needs to be installed to /plugins/PageColours (if you download as a zip from GitHub it will download as PageColours-master)
* You can add additional icons to /plugins/PageColours/assets/icons
* The custom page colours setting should be a JSON encoded string of the following format:
    
```javascript
    {
    "string to match": [ "match type", "colour" ],
    "second string": [ "match type", "colour" ]
    }
```
    
So, to colour all blog pages green and all docs pages red...

```javascript
    {
    "/blog/": [ "*", "green.png" ],
    "/docs/": [ "*", "red.png" ]
    }
```
    
The match types are explained on the plugin settings page.

This syntax is subject to change - yet another reason why you probably shouldn't use this.

## FAQ

__Should I Use This?__
Probably not, or at least, not yet. 

It's very experimental, very clobbered together, and probably full of bugs. It doesn't sanitise input, writes directly to the filesystem, and probably has a bunch of security holes.

Eventually, this should evolve to the point where it is stable and easy to use, but right now you use it at your own risk. It *shouldn't* break anything, but I can't guarantee that.


## Changelog

0.1.2 Minor language and style changes

0.1.1 Fixed bug: Page colours will no longer overwrite icons for goals, events or downloads. You will need to re-save plugin settings in order to re-generate the override stylesheet.

0.1.0 First Version

## Support

Please direct any feedback to @orismology on twitter, or create an issue in the orismology/PageColours repo. I can't promise much support, this was cobbled together in a weekend by someone who knew literally nothing about Piwik plugins (and, to be honest, still doesn't).
