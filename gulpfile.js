/**
 * Setup
 */

// Requiring gulp
const { series, src, dest, watch, task } = require('gulp');
const gulp = require('gulp');


// Plugins
const sourcemaps = require('gulp-sourcemaps');
const rename = require('gulp-rename');
const notify = require('gulp-notify');

const uglify = require('gulp-uglify-es').default;
const concat = require('gulp-concat');
const babel = require('gulp-babel');

const sass = require('gulp-sass');
sass.compiler = require('node-sass');
const cleanCSS = require('gulp-clean-css');
const autoprefixer = require('gulp-autoprefixer');

// Paths
const scriptPath = 'library/js/';
const stylesPath = 'library/scss/';
const outputPath = 'library/dist/';


/**
 * Javascript
 */

// Optimise js
function scripts() {
  return src([
    // scriptPath + 'gsap/*.js', 
    scriptPath + 'vendor/*.js', 
    scriptPath + 'functions/*.js', 
    scriptPath + '*.js',
  ])
    // .pipe(sourcemaps.init())
    .pipe(babel({
        presets: ['@babel/preset-env']
    }))
    .pipe(uglify())
    .pipe(concat('main.js'))
    .pipe(rename({suffix: '.min'}))
    // .pipe(sourcemaps.write())
    .pipe( dest(outputPath + 'js/') )
    .pipe( notify({ message: '\n\n✅  ===> Main JS file built\n', onLast: true }) );
};


function optimiseGsap() {
  return src([
    scriptPath + 'gsap/*.js',
  ])
    .pipe(uglify())
    .pipe(concat('gsap.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe( dest(outputPath + 'js/') )
    .pipe( notify({ message: '\n\n✅  ===> GSAP js file built\n', onLast: true }) );
}


/**
 * CSS
 */

// Compile SASS to CSS. Writes a sourcemap. Autoprefix.
// Minify CSS. Add suffix '.min'. Move to /css/min
function styles() {
    return src(stylesPath + 'styles.scss')
      // .pipe( sourcemaps.init() )
      .pipe( sass().on('error', sass.logError) )
      .pipe( cleanCSS({compatibility: 'ie8'}) )
      .pipe( autoprefixer() )
      .pipe( rename({suffix: '.min'}) )
      // .pipe( sourcemaps.write('./') )
      .pipe( dest(outputPath + 'css/') )
      .pipe( notify({ message: '\n\n✅  ===> SASS compiled\n', onLast: true }) );
};


/**
 * Watch
 */

 // Watch all sass files
 watch([stylesPath + '**/*.scss', stylesPath + 'styles.scss'], styles);

 // Watch js files
 watch([scriptPath + 'vendor/*.js', scriptPath + 'functions/*.js', scriptPath + '*.js'], scripts);

 // Watch gsap files
 watch([scriptPath + 'gsap/*.js'], scripts);


/**
 * Create gulp commands
 */

exports.scripts = scripts;
exports.styles = styles;
exports.default = series(scripts, optimiseGsap, styles);

// exports.default = function() {
//   watch(stylesPath + 'sass/**/*.scss', styles);
// }
