# Silex-Assetic Demo

To dump assets, you need to make sure that ```web/assets/css``` is writable by the web server. I've left auto_dump_assets enabled, make sure to disable this before pushing things live.

By default, Assetic will compile all your stylesheets into one file (configured in the twig view as ```output```.) If you enable debug mode, it will run any filters you specify, but output each file individually for testing.