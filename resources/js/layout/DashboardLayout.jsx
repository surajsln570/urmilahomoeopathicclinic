import { Link, usePage } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import { Avatar, AvatarFallback } from "@/components/ui/avatar";
import { Separator } from "@/components/ui/separator";
import {
    Accordion,
    AccordionItem,
    AccordionTrigger,
    AccordionContent,
} from "@/components/ui/accordion";
import {
    LayoutDashboard,
    Users,
    CalendarDays,
    FileText,
    Settings,
    LogOut,
    Menu,
} from "lucide-react";
import { useState } from "react";
import NavItem from "@/components/NavItem";

export default function DashboardLayout({ children }) {
    const { url } = usePage();
    const [open, setOpen] = useState(true);

    const navItems = [
        {
            title: "Dashboard",
            href: "/dashboard",
            icon: LayoutDashboard,
        },
        {
            title: "Users",
            href: "/users",
            icon: Users,
        },
        {
            title: "Appointment",
            icon: CalendarDays,
            children: [
                {
                    title: "All Appointments",
                    href: "/appointment/dash-appointment",
                },
                {
                    title: "Time Slots",
                    href: "/appointment/time-slots",
                },
            ],
        },
        {
            title: "CMS",
            icon: FileText,
            children: [
                {
                    title: "Hero Image",
                    href: "/heroimage",
                },
                {
                    title: "Treatments",
                    href: "/dash-treatment",
                },
            ],
        },
        {
            title: "Patients",
            icon: FileText,
            children: [
                {
                    title: "View Patients",
                    href: "/patients",
                },
            ],
        },
    ];

    return (
        <div className="flex h-screen bg-slate-100">
            {/* Sidebar */}
            <aside
                className={`bg-white border-r transition-all relative duration-300 ${open ? "w-64" : "w-20"
                    }`}
            >
                <div className="flex items-center justify-between p-4 h-16">
                    {open && (
                        <h1 className="text-xl font-bold text-blue-600">
                            HMS Admin
                        </h1>
                    )}

                    <Button
                        variant="ghost"
                        size="icon"
                        onClick={() => setOpen(!open)}
                    >
                        <Menu className="h-5 w-5" />
                    </Button>
                </div>

                <Separator />

                <nav className="space-y-1">
                    {navItems.map((item) => (
                        <NavItem key={item.title} item={item} />
                    ))}
                </nav>

                <div className="absolute bottom-4 left-0 w-full px-3">
                    <Button
                        variant="destructive"
                        className={`w-full ${!open && "justify-center"
                            }`}
                    >
                        <LogOut className="h-5 w-5" />
                        {open && <span className="ml-2">Logout</span>}
                    </Button>
                </div>
            </aside>

            {/* Main */}
            <div className="flex flex-1 flex-col">
                {/* Navbar */}
                <header className="h-16 border-b bg-white px-6 flex items-center justify-between">
                    <div>
                        <h2 className="text-xl font-semibold">
                            Hospital Management System
                        </h2>
                        <p className="text-sm text-muted-foreground">
                            Welcome back 👋
                        </p>
                    </div>

                    <div className="flex items-center gap-3">
                        <Avatar>
                            <AvatarFallback>SS</AvatarFallback>
                        </Avatar>

                        <div className="text-right">
                            <p className="font-medium">Suraj Singh</p>
                            <p className="text-sm text-muted-foreground">
                                Administrator
                            </p>
                        </div>
                    </div>
                </header>

                {/* Page Content */}
                <main className="flex-1 overflow-auto p-6 bg-slate-50">
                    {children}
                </main>
            </div>
        </div>
    );
}
