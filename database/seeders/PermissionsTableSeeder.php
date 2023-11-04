<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //permission for posts
        Permission::create(['name' => 'posts.index']);
        Permission::create(['name' => 'posts.create']);
        Permission::create(['name' => 'posts.edit']);
        Permission::create(['name' => 'posts.delete']);

        //permission for tags
        Permission::create(['name' => 'tags.index']);
        Permission::create(['name' => 'tags.create']);
        Permission::create(['name' => 'tags.edit']);
        Permission::create(['name' => 'tags.delete']);

        //permission for categories
        Permission::create(['name' => 'categories.index']);
        Permission::create(['name' => 'categories.create']);
        Permission::create(['name' => 'categories.edit']);
        Permission::create(['name' => 'categories.delete']);

        //permission for events
        Permission::create(['name' => 'events.index']);
        Permission::create(['name' => 'events.create']);
        Permission::create(['name' => 'events.edit']);
        Permission::create(['name' => 'events.delete']);

        //permission for photos
        Permission::create(['name' => 'photos.index']);
        Permission::create(['name' => 'photos.create']);
        Permission::create(['name' => 'photos.delete']);

        //permission for videos
        Permission::create(['name' => 'videos.index']);
        Permission::create(['name' => 'videos.create']);
        Permission::create(['name' => 'videos.edit']);
        Permission::create(['name' => 'videos.delete']);

        //permission for sliders
        Permission::create(['name' => 'sliders.index']);
        Permission::create(['name' => 'sliders.create']);
        Permission::create(['name' => 'sliders.delete']);

        //permission for roles
        Permission::create(['name' => 'roles.index']);
        Permission::create(['name' => 'roles.create']);
        Permission::create(['name' => 'roles.edit']);
        Permission::create(['name' => 'roles.delete']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index']);

        //permission for users
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.delete']);

        //permission for students
        Permission::create(['name' => 'students.index']);
        Permission::create(['name' => 'students.create']);
        Permission::create(['name' => 'students.edit']);
        Permission::create(['name' => 'students.delete']);

        //permission for teachers
        Permission::create(['name' => 'teachers.index']);
        Permission::create(['name' => 'teachers.create']);
        Permission::create(['name' => 'teachers.edit']);
        Permission::create(['name' => 'teachers.delete']);

        //permission for subjects
        Permission::create(['name' => 'subjects.index']);
        Permission::create(['name' => 'subjects.create']);
        Permission::create(['name' => 'subjects.edit']);
        Permission::create(['name' => 'subjects.delete']);

        //permission for classes
        Permission::create(['name' => 'classes.index']);
        Permission::create(['name' => 'classes.create']);
        Permission::create(['name' => 'classes.edit']);
        Permission::create(['name' => 'classes.delete']);

        //permission for profiles
        Permission::create(['name' => 'profiles.index']);
        Permission::create(['name' => 'profiles.create']);
        Permission::create(['name' => 'profiles.edit']);
        Permission::create(['name' => 'profiles.delete']);

        //permission for academicacievments
        Permission::create(['name' => 'academicacievments.index']);
        Permission::create(['name' => 'academicacievments.create']);
        Permission::create(['name' => 'academicacievments.edit']);
        Permission::create(['name' => 'academicacievments.delete']);
    }
}