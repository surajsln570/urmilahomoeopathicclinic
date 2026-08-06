import { Input } from "@/components/ui/input";

export default function DataTableToolbar({
    globalFilter,
    setGlobalFilter,
}) {
    return (
        <div className="flex items-center justify-between">

            <Input
                placeholder="Search..."
                className="max-w-sm"
                value={globalFilter}
                onChange={(e) =>
                    setGlobalFilter(e.target.value)
                }
            />

        </div>
    );
}
