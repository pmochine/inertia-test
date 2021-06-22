<?php

namespace Inertiatest;

use Inertiatest\Course\Models\Course;
use Inertiatest\Course\Models\Enrollment;

/**
 * Adds functions to the user as trait
 */
trait Inertiatest
{

    /**
     * A student has many enrroled Courses.
     *
     * @return  [type]
     */
    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrollment', 'student_id', 'course_id')
            ->using(Enrollment::class)
            ->as('enrollment')
            ->withPivot('progress')
            ->withTimestamps();
    }
}
