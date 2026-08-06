import { Button } from "@/components/ui/button";

export default function DataTablePagination({
    table,
}) {
    return (
        <div className="flex justify-end gap-2">

            <Button
                variant="outline"
                onClick={() => table.previousPage()}
                disabled={!table.getCanPreviousPage()}
            >
                Previous
            </Button>

            <Button
                variant="outline"
                onClick={() => table.nextPage()}
                disabled={!table.getCanNextPage()}
            >
                Next
            </Button>

        </div>
    );
}
