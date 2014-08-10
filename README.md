Silverstripe Sharex
===================

A SilverStripe module for integrating with ShareX (http://getsharex.com/).


Installation
============

Upload this folder to your server, dev/build and then move onto setting up ShareX with a custom destination.


ShareX Settings
========================

You'll need to set up a custom destination in ShareX. In Destinations > Destination Settings > Custom uploaders you can use these settings:

![ShareX Settings](/docs/sharex-settings.png)


Module configuration
====================

You'll also need to set a secret in your mysite/_config. Not doing so will allow anyone to upload to your site.

```yaml
ShareXUploadHandler:
  secret: "your_secret_here"
```

Remember when changing anything in a _config/*.yml file you'll need to /dev/build or ?flush.
