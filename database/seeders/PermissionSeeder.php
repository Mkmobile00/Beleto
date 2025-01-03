<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionArray=[
            [
                'name'=>'View Dashboard',
                'guard_name'=>'web'
            ],
            [
                'name'=>'View Movie',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Movie',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Movie',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Movie',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Movie',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View WebSeries',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create WebSeries',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit WebSeries',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update WebSeries',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete WebSeries',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View User',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create User',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit User',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update User',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete User',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Slider',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Slider',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Slider',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Slider',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Slider',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Language',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Language',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Language',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Language',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Language',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Featured',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Featured',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Featured',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Featured',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Featured',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Post',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Post',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Post',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Post',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Post',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Post Category',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Post Category',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Post Category',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Post Category',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Post Category',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Menu',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Menu',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Menu',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Menu',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Menu',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Video Type',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Video Type',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Video Type',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Video Type',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Video Type',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Country',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Country',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Country',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Country',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Country',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Star',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Star',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Star',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Star',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Star',
                'guard_name'=>'web'
            ],


            [
                'name'=>'View Genre',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Genre',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Genre',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Genre',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Genre',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Movie Category',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Movie Category',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Movie Category',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Movie Category',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Movie Category',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Video Quality',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Video Quality',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Video Quality',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Video Quality',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Video Quality',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Audio Quality',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Audio Quality',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Audio Quality',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Audio Quality',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Audio Quality',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Plan Content',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Plan Content',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Plan Content',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Plan Content',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Plan Content',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Plan',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Plan',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Plan',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Plan',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Plan',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Period',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Period',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Period',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Period',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Period',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Subscription',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Subscription',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Subscription',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Subscription',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Subscription',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Push Notification',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Push Notification',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Push Notification',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Push Notification',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Push Notification',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Startup Add',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Startup Add',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Startup Add',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Startup Add',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Startup Add',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Customer',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Customer',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Customer',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Customer',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Customer',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Transaction',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Stremming',
                'guard_name'=>'web'
            ],

            [
                'name'=>'Create Stremming',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Stremming',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Stremming',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Stremming',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Device',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Device',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Device',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Device',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Device',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View System Setting',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create System Setting',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit System Setting',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update System Setting',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete System Setting',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Email Setting',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Email Setting',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Email Setting',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Email Setting',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Email Setting',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Logo',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Logo',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Logo',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Logo',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Logo',
                'guard_name'=>'web'
            ],

            [
                'name'=>'View Seo',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Create Seo',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Edit Seo',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Update Seo',
                'guard_name'=>'web'
            ],
            [
                'name'=>'Delete Seo',
                'guard_name'=>'web'
            ],
            [
                'name'=>'View Role',
                'guard_name'=>'web'
            ],
            [
                'name'=>'View Permission',
                'guard_name'=>'web'
            ],
        ];
        Permission::insert($permissionArray);
    }
}
