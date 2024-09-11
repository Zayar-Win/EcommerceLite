export default function getSideNavLinks()
{
    return [
        {
            icon: 'fa-tv',
            path: route('admin.dashboard'),
            title: 'Dashboard',
            component: 'Admin/Dashboard',
            url:'/admin/dashboard',
            allowedRoles: ['admin','super_admin','accounting','officer_access']
        },
        {
            icon: 'fa-users',
            path: route('admin.users.index'),
            title: 'Manage Users',
            component: 'Admin/Users/Index',
            url:'/admin/users',
            allowedRoles: ['admin','super_admin']
        },
        {
            icon: 'fa-shopping-cart',
            path: route('admin.products.index'),
            title: 'Products',
            component: 'Admin/Products/Index',
            url:'/admin/products',
            allowedRoles: ['admin','super_admin','accounting']
        },
        // {
        //     icon: 'fa-receipt',
        //     path: route('admin.transactions.index'),
        //     title: 'Transactions',
        //     component: 'Admin/Transactions/Index',
        //     url:'/admin/transactions',
        //     allowedRoles: ['admin','super_admin','accounting','officer_access']
        // },
        // {
        //     icon: 'fa-ticket',
        //     path: route('admin.tickets.index'),
        //     title: 'Support Tickets',
        //     component: 'Admin/Tickets/Index',
        //     url:'/admin/tickets',
        //     allowedRoles: ['admin','super_admin','accounting','officer_access']
        // },
        // {
        //     icon: 'fa-file-alt',
        //     path: route('admin.terms-and-conditions.index'),
        //     title: 'Terms & Conditions',
        //     component: 'Admin/TermsAndCondition/Index',
        //     url:'/admin/terms-and-conditions',
        //     allowedRoles: ['admin','super_admin','accounting','officer_access']
        // },

        {
            icon: 'fa-tasks',
            title: 'Manage Plan Details',
            allowedRoles: ['admin','super_admin','accounting','officer_access'],
            subPaths: [
                {
                    title: 'Orders',
                    path: route('admin.orders.index'),
                    component: 'Admin/PersonalPlan/Form',
                    url:'/admin/orders',
                    allowedRoles: ['admin','super_admin','accounting','officer_access']
                },
                {
                    title: 'Subscribers',
                    path: route('admin.subscriber.index'),
                    component: 'Admin/BusinessPlan/Form',
                    url:'/admin/subscribers',
                    allowedRoles: ['admin','super_admin','accounting','officer_access']
                },

            ]
        },
        // {
        //     icon: 'fa-star',
        //     path: route('admin.reviews.index'),
        //     title: 'Manage Reviews',
        //     component: 'Admin/Reviews/Index',
        //     url:'/admin/reviews',
        //     allowedRoles: ['admin','super_admin','accounting','officer_access']
        // },
        // {
        //     icon: 'fa-user-friends',
        //     path: route('admin.subscribers.index'),
        //     title: 'Subscribers',
        //     component: 'Admin/Subscribers/Index',
        //     url:'/admin/subscribers',
        //     allowedRoles: ['admin','super_admin','accounting','officer_access']
        // },
        // {
        //     icon: 'fa-newspaper',
        //     title: 'Manage Blogs',
        //     allowedRoles: ['admin','super_admin','accounting','officer_access'],
        //     subPaths: [
        //         {
        //             title: 'Blogs',
        //             path: route('admin.blogs.index'),
        //             component: 'Admin/Blog/Index',
        //             url:'/admin/blogs',
        //             allowedRoles: ['admin','super_admin','accounting','officer_access']
        //         },
        //         {
        //             title: 'Tags',
        //             path: route('admin.tags.index'),
        //             component: 'Admin/Blog/Tag/Index',
        //             url:'/admin/tags',
        //             allowedRoles: ['admin','super_admin','accounting','officer_access']
        //         },

        //     ]
        // },
        // {
        //     icon: 'fa-gear',
        //     path: route('admin.settings.index'),
        //     title: 'Settings',
        //     component: 'Admin/Settings/Index',
        //     url:'/admin/settings',
        //     allowedRoles: ['admin','super_admin','accounting','officer_access']
        // },

    ];
};
