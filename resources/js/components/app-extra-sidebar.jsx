import { NavMain } from './nav-main';
import { Sidebar, SidebarContent } from './ui/sidebar';
import { usePage } from '@inertiajs/react';
import { Home, User } from 'lucide-react';

export function AppExtraSidebar() {
    const { auth } = usePage().props;
    const user = auth?.user;


    const mainNavItems = [
        {
            title: 'Test1',
            url: '/dashboard',
            icon: Home,
        },
        {
            title: 'Test2',
            url: user.username ? `/user/${user.username}` : '/user',
            icon: User,
        },
    ];

    return (
        <Sidebar
            side="right"
            variant="inset"
            collapsible="none"
            className="bg-transparent fixed top-16 right-0 w-64 h-[calc(100vh-4rem)] shadow-md hidden xl:flex">
            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>
        </Sidebar>
    );
}
