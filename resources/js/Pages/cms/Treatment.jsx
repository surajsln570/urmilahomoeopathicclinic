import { useState, useRef } from 'react'
import { useForm, router, usePage } from '@inertiajs/react'
import { Button } from '@/components/ui/button'
import { Card } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Textarea } from '@/components/ui/textarea'
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
    DialogFooter,
} from '@/components/ui/dialog'
import { Stethoscope, Plus, Pencil, Trash2 } from 'lucide-react'

export default function Treatment({ treatments }) {
    const { flash } = usePage().props
    const [showModal, setShowModal] = useState(false)
    const [editingId, setEditingId] = useState(null)
    const [preview, setPreview] = useState(null)
    const fileInputRef = useRef(null)

    const form = useForm({
        disease: '',
        symptoms: '',
        description: '',
        image: null,
    })

    const openCreateModal = () => {
        setEditingId(null)
        form.reset()
        form.clearErrors()
        setPreview(null)
        if (fileInputRef.current) fileInputRef.current.value = ''
        setShowModal(true)
    }

    const openEditModal = (treatment) => {
        setEditingId(treatment.id)
        form.setData({
            disease: treatment.disease,
            symptoms: treatment.symptoms,
            description: treatment.description,
            image: null,
        })
        form.clearErrors()
        setPreview(null)
        if (fileInputRef.current) fileInputRef.current.value = ''
        setShowModal(true)
    }

    const handleFileChange = (e) => {
        const file = e.target.files[0]
        form.setData('image', file)
        if (file) {
            const reader = new FileReader()
            reader.onload = () => setPreview(reader.result)
            reader.readAsDataURL(file)
        } else {
            setPreview(null)
        }
    }

    const submit = (e) => {
        e.preventDefault()
        if (editingId) {
            // Laravel needs _method spoofing for PUT + file uploads via multipart
            form.transform((data) => ({ ...data, _method: 'PUT' }))
            form.post(`/treatment/${editingId}`, {
                onSuccess: () => setShowModal(false),
            })
        } else {
            form.post('/treatment', {
                onSuccess: () => setShowModal(false),
            })
        }
    }

    const deleteTreatment = (id) => {
        if (confirm('Delete this treatment?')) {
            router.delete(route('treatment.delete', id))
        }
    }

    return (
        <div className="space-y-6">
            <div className="rounded-lg bg-gradient-to-r from-indigo-400 via-blue-600 to-cyan-200 p-6 text-white shadow-lg">
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold">Treatment Management</h1>
                        <p className="mt-2 text-blue-100">Manage all treatments from one place.</p>
                    </div>
                    <Button onClick={openCreateModal} className="bg-white text-indigo-600 hover:bg-white/90">
                        <Plus className="mr-2 h-4 w-4" />
                        Add Treatment
                    </Button>
                </div>
            </div>

            {flash?.success && (
                <div className="rounded-lg border border-green-200 bg-green-50 p-4 text-green-700">
                    {flash.success}
                </div>
            )}

            <div className="flex flex-col gap-3">
                {treatments.length === 0 ? (
                    <Card className="border-2 border-dashed py-20 text-center">
                        <div className="text-7xl">🩺</div>
                        <h2 className="mt-6 text-2xl font-bold text-slate-700">No Treatments Available</h2>
                        <p className="mt-2 text-slate-500">Click below to create your first treatment.</p>
                        <Button onClick={openCreateModal} className="mt-6 mx-auto">
                            <Plus className="mr-2 h-4 w-4" />
                            Add Treatment
                        </Button>
                    </Card>
                ) : (
                    treatments.map((treatment) => (
                        <Card
                            key={treatment.id}
                            className="flex items-center justify-between p-4 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                        >
                            <div className="flex items-center gap-4">
                                {treatment.image ? (
                                    <img
                                        src={`/${treatment.image}`}
                                        className="h-16 w-16 rounded-lg object-cover"
                                        alt={treatment.disease}
                                    />
                                ) : (
                                    <div className="flex h-16 w-16 items-center justify-center rounded-lg bg-slate-200">
                                        <Stethoscope className="h-8 w-8 text-slate-400" />
                                    </div>
                                )}
                                <h2 className="text-xl font-bold text-slate-800">{treatment.disease}</h2>
                            </div>

                            <div className="flex items-center gap-2">
                                <Button size="sm" variant="secondary" onClick={() => openEditModal(treatment)}>
                                    <Pencil className="mr-1 h-4 w-4" />
                                    Edit
                                </Button>
                                <Button size="sm" variant="destructive" onClick={() => deleteTreatment(treatment.id)}>
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
                        <DialogTitle>{editingId ? 'Edit Treatment' : 'Add Treatment'}</DialogTitle>
                        <DialogDescription>Fill in the treatment details.</DialogDescription>
                    </DialogHeader>

                    <form onSubmit={submit} className="space-y-5">
                        <div className="space-y-2">
                            <Label htmlFor="disease">Disease Name</Label>
                            <Input
                                id="disease"
                                value={form.data.disease}
                                onChange={(e) => form.setData('disease', e.target.value)}
                                required
                            />
                            {form.errors.disease && <p className="text-sm text-red-600">{form.errors.disease}</p>}
                        </div>

                        <div className="space-y-2">
                            <Label htmlFor="symptoms">Symptoms</Label>
                            <Textarea
                                id="symptoms"
                                rows={2}
                                value={form.data.symptoms}
                                onChange={(e) => form.setData('symptoms', e.target.value)}
                                required
                            />
                            {form.errors.symptoms && <p className="text-sm text-red-600">{form.errors.symptoms}</p>}
                        </div>

                        <div className="space-y-2">
                            <Label htmlFor="description">Description</Label>
                            <Textarea
                                id="description"
                                rows={2}
                                value={form.data.description}
                                onChange={(e) => form.setData('description', e.target.value)}
                                required
                            />
                            {form.errors.description && <p className="text-sm text-red-600">{form.errors.description}</p>}
                        </div>

                        <div className="space-y-2">
                            <Label htmlFor="image">Treatment Image</Label>
                            <div className="rounded-2xl border-2 border-dashed border-slate-300 p-4">
                                {preview && (
                                    <img src={preview} className="mb-4 h-20 rounded-lg object-cover" alt="Preview" />
                                )}
                                <input
                                    ref={fileInputRef}
                                    id="image"
                                    type="file"
                                    accept="image/*"
                                    onChange={handleFileChange}
                                    className="block w-full text-sm"
                                />
                            </div>
                            {form.errors.image && <p className="text-sm text-red-600">{form.errors.image}</p>}
                        </div>

                        <DialogFooter>
                            <Button type="button" variant="outline" onClick={() => setShowModal(false)}>
                                Cancel
                            </Button>
                            <Button type="submit" disabled={form.processing}>
                                {form.processing ? 'Saving...' : 'Save Treatment'}
                            </Button>
                        </DialogFooter>
                    </form>
                </DialogContent>
            </Dialog>
        </div>
    )
}

