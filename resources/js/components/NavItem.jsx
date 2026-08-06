import { useState } from "react";
import { Link, usePage } from "@inertiajs/react";
import { ChevronDown } from "lucide-react";

export default function NavItem({ item }) {
    const { url } = usePage();
    const [open, setOpen] = useState(false);

    const Icon = item.icon;

    if (!item.children) {
        return (
            <Link href={item.href}>
                <div
                    className={`flex items-center gap-3 rounded-md px-3 py-2 hover:bg-muted ${url.startsWith(item.href) ? "bg-muted font-medium" : ""
                        }`}
                >
                    {Icon && <Icon className="h-4 w-4" />}
                    <span>{item.title}</span>
                </div>
            </Link>
        );
    }

    return (
        <div>
            <button
                onClick={() => setOpen(!open)}
                className="flex w-full items-center justify-between rounded-md px-3 py-2 hover:bg-muted"
            >
                <div className="flex items-center gap-3">
                    {Icon && <Icon className="h-4 w-4" />}
                    <span>{item.title}</span>
                </div>

                <ChevronDown
                    className={`h-4 w-4 transition-transform ${open ? "rotate-180" : ""
                        }`}
                />
            </button>

            {open && (
                <div className="ml-6 mt-1 space-y-1 border-l pl-3">
                    {item.children.map((child) => (
                        <NavItem key={child.title} item={child} />
                    ))}
                </div>
            )}
        </div>
    );
}
