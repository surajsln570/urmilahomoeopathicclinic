import {
    flexRender,
    getCoreRowModel,
    getFilteredRowModel,
    getPaginationRowModel,
    getSortedRowModel,
    useReactTable,
} from "@tanstack/react-table";

import { useState } from "react";

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";

import DataTableToolbar from "./DataTableToolbar";
import DataTablePagination from "./DataTablePagination";

export default function DataTable({
    columns,
    data,
    loading = false,
}) {
    const [sorting, setSorting] = useState([]);
    const [columnFilters, setColumnFilters] = useState([]);
    const [globalFilter, setGlobalFilter] = useState("");

    const table = useReactTable({
        data,
        columns,

        state: {
            sorting,
            columnFilters,
            globalFilter,
        },

        onSortingChange: setSorting,
        onColumnFiltersChange: setColumnFilters,
        onGlobalFilterChange: setGlobalFilter,

        getCoreRowModel: getCoreRowModel(),
        getFilteredRowModel: getFilteredRowModel(),
        getSortedRowModel: getSortedRowModel(),
        getPaginationRowModel: getPaginationRowModel(),
    });

    return (
        <div className="space-y-4">

            <DataTableToolbar
                table={table}
                globalFilter={globalFilter}
                setGlobalFilter={setGlobalFilter}
            />

            <div className="rounded-md border">

                <Table>
                    <TableHeader>
                        {table.getHeaderGroups().map((group) => (
                            <TableRow key={group.id}>
                                {group.headers.map((header) => (
                                    <TableHead key={header.id}>
                                        {flexRender(
                                            header.column.columnDef.header,
                                            header.getContext()
                                        )}
                                    </TableHead>
                                ))}
                            </TableRow>
                        ))}
                    </TableHeader>

                    <TableBody>

                        {loading ? (

                            <TableRow>
                                <TableCell
                                    colSpan={columns.length}
                                    className="text-center py-10"
                                >
                                    Loading...
                                </TableCell>
                            </TableRow>

                        ) : table.getRowModel().rows.length ? (

                            table.getRowModel().rows.map((row) => (

                                <TableRow key={row.id}>

                                    {row.getVisibleCells().map((cell) => (

                                        <TableCell key={cell.id}>
                                            {flexRender(
                                                cell.column.columnDef.cell,
                                                cell.getContext()
                                            )}
                                        </TableCell>

                                    ))}

                                </TableRow>

                            ))

                        ) : (

                            <TableRow>
                                <TableCell
                                    colSpan={columns.length}
                                    className="text-center py-10"
                                >
                                    No Data Found
                                </TableCell>
                            </TableRow>

                        )}

                    </TableBody>

                </Table>

            </div>

            <DataTablePagination table={table} />

        </div>
    );
}
