var gulp = require('gulp'),
    less = require('gulp-less'),
    bower = require('gulp-bower'),
    sourcemaps = require('gulp-sourcemaps'),
    concat = require('gulp-concat'),
    uglify = require('gulp-uglify'),
    minifyCss = require('gulp-minify-css'),
    replace       = require('gulp-replace'),
    autoprefixer  = require('gulp-autoprefixer'),
    livereload = require('gulp-livereload'),
    jshint = require('gulp-jshint'),
    fs = require('fs'),
    pkg = JSON.parse(fs.readFileSync('./package.json', 'utf8')),
    dest = '../ts-framework/dist/wp-content/plugins/' + (pkg.name).toLowerCase(),
    dist = 'dist/' + (pkg.name).toLowerCase(),
    src = './src',
    src_js = src + '/assets/js/*.*',
    src_php = src + '/php/**/*.*',
    bower_dir = src + '/assets/bower_components';

    // Error Log
    function errorLog(error){
        console.error.bind(error);
        this.emit('end');
    }

// Styles
gulp.task('styles', function() {
    gulp.src(src + '/assets/less/admin.less' )
        .pipe(less({
          paths: [ '.' ]
        }))
        .on('error', errorLog)
        .pipe(gulp.dest(dest + '/assets/css'))
        .pipe(gulp.dest(dist + '/assets/css'));
});
// Styles
gulp.task('styles_external', function() {
    gulp.src(src + '/assets/less/shortcodes.less')
        .pipe(less({
          paths: [ '.' ]
        }))
        .pipe(minifyCss())
        .on('error', errorLog)
        .pipe(gulp.dest(dest + '/assets/css'))
        .pipe(gulp.dest(dist + '/assets/css'));
});
//
// Scripts
gulp.task('scripts', function() {
    gulp.src(src_js)
        .on('error', errorLog)
        .pipe(gulp.dest(dest + '/assets/js'))
        .pipe(livereload());
});
//
// External Scripts
gulp.task('scripts_external', function() {
    gulp.src([
            bower_dir + '/bootstrap/js/tab.js', 
            bower_dir + '/bootstrap/js/collapse.js',
            bower_dir + '/bootstrap/js/alert.js'
        ])
        .pipe(uglify({
            preserveComments : 'all'
        }))
        .pipe(concat('bootstrap.js'))
        .on('error', errorLog)
        .pipe(gulp.dest(dest + '/assets/js/'))
        .pipe(gulp.dest(dist + '/assets/js/'));
});

// Markup
gulp.task('markup', function() {
    gulp.src(src_php)
        .pipe(replace( /{PKG_VERSION}/g, '\'' + pkg.version + '\'' ))
        .pipe(gulp.dest(dest))
        .pipe(gulp.dest(dist));
});

// Bowler
gulp.task('bower', function() {
    return bower()
        .pipe(gulp.dest(bower_dir));
});

// Watch
gulp.task('watch',function(){
    
    livereload.listen();
    
    gulp.watch(src + '/assets/less/admin.less', ['styles']);
    gulp.watch(src_js, ['scripts']);
    gulp.watch(src_php, ['markup']);
});

gulp.task('default', ['styles', 'scripts_external', 'scripts', 'styles_external', 'markup', 'bower', 'watch'])