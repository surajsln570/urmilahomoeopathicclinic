import { useState } from 'react'
import { useForm, router, usePage } from '@inertiajs/react'
// import DashboardLayout from '@/Layouts/DashboardLayout'
import { Button } from '@/components/ui/button'
import { Card } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Checkbox } from '@/components/ui/checkbox'
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
    DialogFooter,
} from '@/components/ui/dialog'
import { Clock, Plus, Pencil, Trash2 } from 'lucide-react'

export default function TimeSlots({ timeSlots }) {
    const { flash } = usePage().props
    const [showModal, setShowModal] = useState(false)
    const [editingId, setEditingId] = useState(null)

    const form = useForm({
        day: '',
        start_time: '',
        end_time: '',
        status: true,
    })

    const openCreateModal = () => {
        setEditingId(null)
        form.reset()
        form.clearErrors()
        setShowModal(true)
    }

    const openEditModal = (slot) => {
        setEditingId(slot.id)
        form.setData({
            day: slot.day,
            start_time: slot.start_time,
            end_time: slot.end_time,
            status: !!slot.status,
        })
        form.clearErrors()
        setShowModal(true)
    }

    const submit = (e) => {
        e.preventDefault()
        if (editingId) {
            form.put(`/appointment/time-slots/${editingId}`, {
                onSuccess: () => setShowModal(false),
            })
        } else {
            form.post('/appointment/time-slots', {
                onSuccess: () => setShowModal(false),
            })
        }
    }

    const deleteSlot = (id) => {
        if (confirm('Delete this time slot?')) {
            router.delete(`/appointment/time-slots/${id}/delete`)
        }
    }

    const formatTime = (time) => {
        const [h, m] = time.split(':')
        const date = new Date()
        date.setHours(h, m)
        return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
    }

    const days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']

    return (
        <div className="space-y-6">
            <div className="rounded-lg bg-gradient-to-r from-indigo-400 via-blue-600 to-cyan-200 p-6 text-white shadow-lg">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold">Time Slot Management</h1>
                        <p className="mt-2 text-blue-100">Manage all weekly time slots from one place.</p>
                    </div>
                    <Button onClick={openCreateModal} className="bg-white text-indigo-600 hover:bg-white/90">
                        <Plus className="mr-2 h-4 w-4" />
                        Add Time Slot
                    </Button>
                </div>
            </div>

            {flash?.success && (
                <div className="rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
                    {flash.success}
                </div>
            )}

            <div className="flex flex-col gap-3">
                {timeSlots.length === 0 ? (
                    <Card className="border-2 border-dashed py-20 text-center">
                        <div className="text-7xl">🕒</div>
                        <h2 className="mt-6 text-2xl font-bold text-slate-700">No Time Slots Available</h2>
                        <p className="mt-2 text-slate-500">Click below to create your first time slot.</p>
                        <Button onClick={openCreateModal} className="mt-6 mx-auto">
                            <Plus className="mr-2 h-4 w-4" />
                            Add Time Slot
                        </Button>
                    </Card>
                ) : (
                    timeSlots.map((slot) => (
                        <Card key={slot.id} className="flex items-center justify-between p-4 transition hover:shadow-lg">
                            <div className="flex items-center gap-6">
                                <div className="flex h-14 w-14 items-center justify-center rounded-full bg-indigo-100">
                                    <Clock className="h-6 w-6 text-indigo-600" />
                                </div>
                                <div>
                                    <h2 className="text-lg font-bold text-slate-800">{slot.day}</h2>
                                    <p className="text-sm text-slate-500">
                                        {formatTime(slot.start_time)} &mdash; {formatTime(slot.end_time)}
                                    </p>
                                </div>
                                <Badge variant={slot.status ? 'default' : 'destructive'}>
                                    {slot.status ? 'Active' : 'Inactive'}
                                </Badge>
                            </div>

                            <div className="flex items-center gap-2">
                                <Button size="sm" variant="secondary" onClick={() => openEditModal(slot)}>
                                    <Pencil className="mr-1 h-4 w-4" />
                                    Edit
                                </Button>
                                <Button size="sm" variant="destructive" onClick={() => deleteSlot(slot.id)}>
                                    <Trash2 className="mr-1 h-4 w-4" />
                                    Delete
                                </Button>
                            </div>
                        </Card>
                    ))
                )}
            </div>

            <Dialog open={showModal} onOpenChange={setShowModal}>
                <DialogContent className="sm:max-w-lg">
                    <DialogHeader>
                        <DialogTitle>{editingId ? 'Edit Time Slot' : 'Add Time Slot'}</DialogTitle>
                        <DialogDescription>Fill in the time slot details.</DialogDescription>
                    </DialogHeader>

                    <form onSubmit={submit} className="space-y-5">
                        <div className="space-y-2">
                            <Label htmlFor="day">Day</Label>
                            <Select value={form.data.day} onValueChange={(v) => form.setData('day', v)}>
                                <SelectTrigger id="day">
                                    <SelectValue placeholder="Select a day" />
                                </SelectTrigger>
                                <SelectContent>
                                    {days.map((d) => (
                                        <SelectItem key={d} value={d}>{d}</SelectItem>
                                    ))}
                                </SelectContent>
                            </Select>
                            {form.errors.day && <p className="text-sm text-red-600">{form.errors.day}</p>}
                        </div>

                        <div className="space-y-2">
                            <Label htmlFor="start_time">Start Time</Label>
                            <Input
                                id="start_time"
                                type="time"
                                value={form.data.start_time}
                                onChange={(e) => form.setData('start_time', e.target.value)}
                                required
                            />
                            {form.errors.start_time && <p className="text-sm text-red-600">{form.errors.start_time}</p>}
                        </div>

                        <div className="space-y-2">
                            <Label htmlFor="end_time">End Time</Label>
                            <Input
                                id="end_time"
                                type="time"
                                value={form.data.end_time}
                                onChange={(e) => form.setData('end_time', e.target.value)}
                                required
                            />
                            {form.errors.end_time && <p className="text-sm text-red-600">{form.errors.end_time}</p>}
                        </div>

                        <div className="flex items-center gap-2">
                            <Checkbox
                                id="status"
                                checked={form.data.status}
                                onCheckedChange={(checked) => form.setData('status', checked)}
                            />
                            <Label htmlFor="status">Active</Label>
                        </div>

                        <DialogFooter>
                            <Button type="button" variant="outline" onClick={() => setShowModal(false)}>
                                Cancel
                            </Button>
                            <Button type="submit" disabled={form.processing}>
                                Save Time Slot
                            </Button>
                        </DialogFooter>
                    </form>
                </DialogContent>
            </Dialog>
        </div>
    )
}

// TimeSlots.layout = (page) => <DashboardLayout>{page}</DashboardLayout>
