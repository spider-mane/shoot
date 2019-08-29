const gulp = require('gulp');

/**
 * CSS build tools
 */
const sass = require('gulp-sass');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const sourcemaps = require('gulp-sourcemaps');
const postcssPresetEnv = require('postcss-preset-env');

/**
 * Javascript build tools
 */
const webpack = require("webpack-stream");

/**
 * Utilities
 */
const notify = require('gulp-notify');
const plumber = require('gulp-plumber');
const browserSync = require('browser-sync').create();

/**
 * configure build dependencies
 */
sass.compiler = require("node-sass");


// ############################## Config ##############################

// Base
const env = 'development';
const projectURL = 'http://projecturl.test';
const publicDir = './public/';
const assets = publicDir + 'assets/';

// Styles
const styleSrcDir = assets + 'src/scss/';
const styleSrcFile = 'styles.scss';
const styleDistDir = assets + 'dist/styles/';
const styleDistFile = 'styles.css';

// Scripts
const jsSrcDir = assets + 'src/js/';
const jsSrcFile = 'index.js';
const jsDistDir = assets + 'dist/scripts/';
const jsDistFile = 'script.js';

// Watch
const phpWatch = ['./**/*.php', '!vendor/**', '!node_modules/**'];
const twigWatch = publicDir + 'views/**/*.twig';
const scssWatch = `${styleSrcDir}**/*.scss`;
const jsSrcWatch = `${jsSrcDir}**/*.js`;
const cssWatch = `${styleDistDir}**/*.css`;
const jsWatch = `${jsDistDir}**/*.js`;
const reloadWatch = [...phpWatch, cssWatch, jsWatch, twigWatch];
const watchIgnore = ['vendor/**', 'node_modules/**'];

// Other
const defaultBrowser = "C:\\Program Files (x86)\\Google\\Chrome Dev\\Application\\chrome.exe";


// ############################## Functions ##############################

/**
 * error
 */
function error(err) {
  notify.onError({
    title: "Gulp error in " + err.plugin,
    message: err.toString()
  })(err);
}

/**
 * launch browsersync proxy server
 */
function watch() {
  // launch proxy
  browserSync.init({
    proxy: projectURL,
    notify: false,
    reloadOnRestart: true,
    open: false,
    browser: defaultBrowser
  });

  const watchOptions = {
    ignore: watchIgnore
  };

  // compile assets
  gulp.watch(scssWatch, exports.sass);
  gulp.watch(jsSrcWatch, exports.js);

  // reload browser
  gulp.watch(reloadWatch, watchOptions).on('change', browserSync.reload);
}

/**
 * compile sass using gulp/node-sass
 */
function compileSass() {
  const sassOptions = {
    outputStyle: 'expanded',
  };

  const postcssPlugins = [autoprefixer(), cssnano()];

  return gulp.src(styleSrcDir + styleSrcFile)
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError))
    // .pipe(postcss(postcssPlugins))
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(styleDistDir))
    .pipe(browserSync.stream());
}

/**
 * compile javascript using webpack
 */
function compileJs() {
  const webpackConfig = {
    output: {
      filename: jsDistFile
    },
    mode: env,
    module: {
      rules: [{
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader'
        }
      }]
    }
  };

  if ('production' === env) {
    webpackConfig.module.rules.use.options = {
      presets: ['@babel/preset-env']
    }
  }

  return gulp.src(jsSrcDir + jsSrcFile)
    .pipe(plumber())
    .pipe(webpack(webpackConfig))
    .pipe(gulp.dest(jsDistDir))
    .pipe(browserSync.stream());
}


// ############################## Exports ##############################

exports.js = compileJs;
exports.sass = compileSass;
exports.compile = gulp.parallel(exports.js, exports.sass);
exports.default = gulp.series(exports.compile, watch);

/**
 * use this for simple debugging
 */
exports.debug = function (cb) {
  // define variables to log to console
  let check;

  // debug code here

  // log desired values to the console
  console.log(check);
  cb(); // signal completioon
}
