const {src, dest, watch, task}  = require('gulp');
const browserSync = require('browser-sync').create();
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const minify = require('gulp-minify');

// Static server
function bs() {
   serveSass();
   browserSync.init({
    server: {
      baseDir: "./src"
    }
  });
  watch("./*.html").on('change', browserSync.reload);
  watch("./src/sass/**/*.sass", serveSass);
  watch("./src/sass/**/*.scss", serveSass);
  watch("./js/*.js").on('change', browserSync.reload);
};

function serveSass() {
  return src("./src/sass/**/*.sass", "./src/sass/**/*.scss")
    .pipe(sass())
    .pipe(autoprefixer({
      cascade: false
  }))
    .pipe(dest("./src/css"))
    .pipe(browserSync.stream());
};

function buildCSS(done) {
  src('css/**/**.css')
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(dest('dist/css/'));
  done();
}

function buildJS(done) {
  src(['js/**.js' , 'js/**.min.js'])
  done();
}

exports.serve = bs;
exports.serve = buildCSS;

/*task('minify-css', function() {
  return src("./src/css/*.css")
    .pipe(cleanCSS({ compatibility: 'ie8' }))
        .pipe(rename({
          suffix: '.min'
        }))
    .pipe(dest("./src/css"));
});*/