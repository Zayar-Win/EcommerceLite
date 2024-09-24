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
            icon: 'fa-cogs',
            path: route('admin.attributes.index'),
            title: 'Attributes',
            component: 'Admin/Attributes/Index',
            url:'/admin/attributes',
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
            icon: 'fa-box-open',
            path: route('admin.orders.index'),
            title: 'Manage Order',
            component: 'Admin/Orders/Index',
            url:'/admin/orders',
        },
        {
            icon: 'fa-credit-card',
            path: route('admin.payments.index'),
            title: 'Manage Payment',
            component: 'Admin/Payments/Index',
            url:'/admin/payments',
        },
        {
            icon: 'fa-list',
            path: route('admin.categories.index'),
            title: 'Manage Category',
            component: 'Admin/Categories/Index',
            url:'/admin/categories',
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
