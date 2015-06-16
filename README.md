# fortune-tech

## Instructions for using grunt to compile sass and js, etc.

You need to have node and npm installed. 

If you need to install them, go to http://nodejs.org to get them.

### Install grunt if you do not already have it

Before setting up Grunt, ensure that your npm is up-to-date by running

		npm update -g npm

This may require sudo on certain systems.

Now you are ready to install the grunt CLI.

		npm install -g grunt-cli

### Install project dependencies

Go to the theme directory

		npm install

This should install all code dependencies for running the grunt tasks as well as all the code dependencies for the site itself.  Grunt dependencies are listed in package.json, and site dependencies (e.g., js libraries) are listed in bower.json.

If you get an error when running `npm install`, you may not have SASS and COMPASS installed. Run:

		gem install sass
		gem install compass



### Run grunt to compile sass, compress js, etc.

The project is set up for two different environments, development and production.  If the constant WP_ENV is defined as development, development environment is used, otherwise, it will assume a production environment (which means minified css and js, etc.).

So, you should have a line in your wp-config.php file that tells wordpress which environment you're running under, like this:

		define('WP_ENV', 'development');			// Use development or production

If you do not have the WP_ENV set, it will assume the production environment.


#### Development

		grunt dev (or just grunt)

By default, running grunt will run the javascript through jshint, compile sass, run the css through the auto-prefixer then concatentate all the js into one file.

Most likely, you'll want grunt to continually watch your files so that any new, saved change will trigger another compilation.  To do this, use

		grunt watch

This will watch the js and sass files, and when anything changes, it will run the grunt dev task.

#### Production

		grunt build

This will jshint, compile and compress sass, run the auto-prefixer, minify the jss, and add a version hash (so that you don't have to manually break the cache when you deploy new code).

### SASS

To convert the prototype css to sass, the existing css styles were moved into the _global.scss.  For development going forward, the sass styles should go to more a more meaningful placement. The sass files have been separated into mostly empty files with this in mind.

* Site-wide variables should go in _variable.scss
* Global styles should go in _global.scss
* main.scss is where all the all the sub-sheets will be imported.  If you want to add a new stylesheet, for example, for a new page, you will want to create a new sheet and include it in main.scss
* _bootstrap.scss contains all the bootstrap sass components.  Components that are not used can be commented out to save css space.
* layouts/_sidebar.scss for use with the default wordpress sidebar
* layouts/_posts.scss for styling of posts
* layouts/_pages.scss for styling common to pages
* layouts/_header.scss to style the common header
* layouts/_footer.scss to style the common footer
* layouts/_general.scss to style the common wordpress body wrappers
* layouts/pages/_home.scss for styles aimed at the home page only.  If you want to target a particular page, add a new stylesheet within layouts/pages and add an import to main.scss

### Javascript

Currently, there is only a _main.js file for javascript.  However, if you want to a new js module, just create a new js file starting with an underscore in the title, for example: _carousel.js, and place it in the js directory.  Plugins can be added to the js/plugins directory.  If you're adding a bigger framework, it's probably best to add it using bower, as described below.

### Adding new packages

If you want to add a new js (or css) library, add it using bower:

		bower install [package] --save

This will download the library to the assets/vendor directory, and add it to bower.json, meaning it will be installed by anyone running npm install when they set up the code.  

If the library is javascript, you will also need to add the relevant file(s) to the jsFileList in the Gruntfile so that it will become part of the standard build stream.  

If the library contains css that you want to use, that can be added to the sass/main.scss file.  For instance, openwebicons is currently imported there with the following line:

		@import "../vendor/openwebicons/css/openwebicons-bootstrap.css";
