import { router } from '@inertiajs/react'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import {
    Table,
    TableHeader,
    TableBody,
    TableRow,
    TableHead,
    TableCell,
} from '@/components/ui/table'
import { Card } from '@/components/ui/card'
import { Pencil, Trash2 } from 'lucide-react'

export default function Users({ users }) {
    const deleteUser = (id) => {
        if (confirm('Delete this user?')) {
            router.delete(route('users.delete', id))
        }
    }

    return (
        <div className="space-y-6">
            <div>
                <h1 className="text-2xl font-bold text-slate-800">Users</h1>
                <p className="text-sm text-slate-500">Manage all system users.</p>
            </div>

            <Card className="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <Table>
                    <TableHeader className="bg-gray-100">
                        <TableRow>
                            <TableHead>Name</TableHead>
                            <TableHead>Mobile</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>Role</TableHead>
                            <TableHead className="text-center">Action</TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        {users.length === 0 ? (
                            <TableRow>
                                <TableCell colSpan={5} className="py-8 text-center text-gray-500">
                                    No Users Found
                                </TableCell>
                            </TableRow>
                        ) : (
                            users.map((user) => (
                                <TableRow key={user.id} className="hover:bg-gray-50">
                                    <TableCell className="font-medium">{user.name}</TableCell>
                                    <TableCell>{user.mobile}</TableCell>
                                    <TableCell>{user.email}</TableCell>
                                    <TableCell>
                                        <Badge className="bg-blue-100 text-blue-700 hover:bg-blue-100">
                                            {user.role_id}
                                        </Badge>
                                    </TableCell>
                                    <TableCell>
                                        <div className="flex justify-center gap-2">
                                            <Button size="sm" className="h-7 px-2 text-xs">
                                                <Pencil className="mr-1 h-3 w-3" />
                                                Edit
                                            </Button>
                                            <Button
                                                size="sm"
                                                variant="destructive"
                                                className="h-7 px-2 text-xs"
                                                onClick={() => deleteUser(user.id)}
                                            >
                                                <Trash2 className="mr-1 h-3 w-3" />
                                                Delete
                                            </Button>
                                        </div>
                                    </TableCell>
                                </TableRow>
                            ))
                        )}
                    </TableBody>
                </Table>
            </Card>
        </div>
    )
}

