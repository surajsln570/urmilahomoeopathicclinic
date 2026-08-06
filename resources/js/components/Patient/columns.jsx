import { ArrowUpDown } from "lucide-react";
import { Button } from "@/components/ui/button";

export const patientColumns = (onEdit, onView) => [
    {
        accessorKey: "registrationNumber",
        header: ({ column }) => (
            <Button
                variant="ghost"
                onClick={() =>
                    column.toggleSorting(column.getIsSorted() === "asc")
                }
            >
                Reg No
                <ArrowUpDown className="ml-2 h-4 w-4" />
            </Button>
        ),
    },
    {
        accessorKey: "name",
        header: ({ column }) => (
            <Button
                variant="ghost"
                onClick={() =>
                    column.toggleSorting(column.getIsSorted() === "asc")
                }
            >
                Name
                <ArrowUpDown className="ml-2 h-4 w-4" />
            </Button>
        ),
    },
    {
        accessorKey: "age",
        header: "Age",
    },
    {
        accessorKey: "sex",
        header: "Sex",
    },
    {
        accessorKey: "bloodGroup",
        header: "Blood Group",
    },
    {
        accessorKey: "mobile",
        header: "Mobile",
    },
    {
        id: "actions",
        header: "Actions",
        cell: ({ row }) => (
            <div className="flex gap-2">
                <Button
                    size="sm"
                    variant="outline"
                    onClick={() => onView(row.original)}
                >
                    View
                </Button>

                <Button
                    size="sm"
                    onClick={() => onEdit(row.original)}
                >
                    Edit
                </Button>
            </div>
        ),
    },
];
