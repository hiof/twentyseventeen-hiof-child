# Twenty Seventeen Hiof child theme

## About

A Østfold University College version of the Twenty Seventeen wordpress theme

## Copyright

- This project is distributed under a GNU General Public License v3 - Take a look at the COPYING file for details.

## Required knowledge

This package require knowledge of the following technologies, technics and modules:

- [Javascript](https://en.wikipedia.org/wiki/JavaScript)
    - [ES2015](https://en.wikipedia.org/wiki/ECMAScript#6th_Edition)
    - [Babel](https://babeljs.io)
    - [jQuery](https://jquery.com)
    - [JSON](http://jsonapi.org)
- [CSS](https://en.wikipedia.org/wiki/Cascading_Style_Sheets)
    - [Sass](http://sass-lang.com)
- [HTML](https://en.wikipedia.org/wiki/HTML)
    - [Handlebars](http://handlebarsjs.com)
- [Bootstrap](http://getbootstrap.com)
- [Node.js](https://nodejs.org)
    - [NPM](https://www.npmjs.com)
- [Grunt](http://gruntjs.com) and Grunt tasks (see `Gruntfile.js` for details)
- [Bower](http://bower.io)
- [SSH](https://en.wikipedia.org/wiki/Secure_Shell)
- [Git](https://git-scm.com)
    - [Github](https://github.com)

## Install

Install [Git](http://git-scm.com) if it's not already installed on your computer. Then run (this will download this project to the folder the shell has open):

    $ git clone https://github.com/hiof/twentyseventeensper-hiof.git


Install [Node.js](http://nodejs.org)) if it's not already installed on your computer. Then run (this will install the project dependencies):

    $ sudo npm install -g grunt-cli
    $ npm install
    $ bower install

### Development

While working on this theme we recommend [vccw](http://vccw.cc) as a local development environment. Rename the downloaded project folder to `vw`. The continuous-build configuration in this project require that the `vw` folder is a sibling to the parent directory of this project.

This project require the [Twenty Seventeen](https://github.com/WordPress/twentyseventeen) to be downloaded and installed in the wordpress `themes` folder.

The following command is available within the project folder to continuously watch for changes within the /app/ folder and deploy changes to `../vw/wordpress/wp-content/themes/` directory.

- `$ grunt watch`


### Build

The following commands are now available within the project folder `$ grunt build`.

- $ grunt build: Builds the code to /dist folder ready for deploy

### Deploy

Copy the content of the /dist folder to your wp-content folder.


## Releases


[Github releases](https://github.com/hiof/twentyseventeen-hiof/releases)


## Roadmap

- [ ] v1.0.0
