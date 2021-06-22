Hey! Thanks for your help and time!

This "package" is based by https://github.com/nWidart/laravel-modules

My problem:

    Inertiatest\Browser\Tests\Unit\BrowseTest::browse_shows_all_topics
    InvalidArgumentException: View [app] not found.

This happens if you PHPunit test the test `browse_shows_all_topics`, found in `src/Modules/Browser/Tests/Feature/BrowseTest.php`

Solution?

Probably you need to add a dummy `app.blade.php` file and load it through a Provider or TestCase.php